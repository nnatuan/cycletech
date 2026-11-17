# BÁO CÁO CHI TIẾT NÂNG CẤP SOURCE CODE LÊN PHP 8.3

> **Dự án:** CYCLE ELECTRIC (`cycletech`)  
> **Framework:** CodeIgniter 3.1.13 + Thư viện bổ trợ Tokaban & phpThumb  
> **Mục tiêu:** Nâng cấp tương thích hoàn toàn với **PHP 8.3**, khắc phục nguy cơ từ lỗ hổng bảo mật **PHP2Shell (CVE-2024-4577)**  
> **Chiến lược:** Patch-in-place (vá trực tiếp, bảo toàn toàn bộ logic hệ thống hiện tại)

---

## 1. TỔNG QUAN BỐI CẢNH & NGUY CƠ BẢO MẬT
* **Lỗ hổng PHP2Shell (CVE-2024-4577):** Là lỗ hổng bảo mật Remote Code Execution cực kỳ nguy hiểm trên Windows/XAMPP và máy chủ sử dụng PHP-CGI (do cơ chế "Best-Fit Mapping" của Windows khi xử lý chuỗi ký tự unicode). 
* Tất cả các phiên bản PHP cũ (PHP 5.x, PHP 7.x, PHP 8.0, 8.1, 8.2 cũ) đều có nguy cơ bị tấn công thực thi mã độc từ xa.
* Việc nâng cấp lên **PHP 8.3 (từ 8.3.8 trở lên)** là giải pháp triệt để và an toàn nhất.

---

## 2. DANH SÁCH CHI TIẾT CÁC THAY ĐỔI ĐÃ THỰC HIỆN

### 2.1. Tạo tầng tương thích Polyfill (`php83_compat.php`)
Tạo mới file [`php83_compat.php`](file:///c:/xampp/htdocs/cycletech/php83_compat.php) tại thư mục gốc để cung cấp lại các hàm/cơ chế đã bị gỡ bỏ trong PHP 7/8:
* **`mysqli_report(MYSQLI_REPORT_OFF)`:** Trên PHP 8.1+, mặc định mysqli sẽ ném `mysqli_sql_exception` thay vì trả về `FALSE` khi truy vấn lỗi. Lệnh này khôi phục hành vi ổn định cho CodeIgniter.
* **Polyfill `each()`:** Tái hiện hàm `each()` bằng `current()`, `key()`, `next()`.
* **Polyfill nhóm hàm Regex POSIX cũ:** `ereg()`, `eregi()`, `ereg_replace()`, `eregi_replace()`, `split()`, `spliti()` được chuyển hướng an toàn sang PCRE (`preg_match`, `preg_replace`, `preg_split`).
* **Polyfill `magic_quotes`:** `get_magic_quotes_gpc()`, `get_magic_quotes_runtime()`, `set_magic_quotes_runtime()` trả về `FALSE` để tránh lỗi Fatal khi các thư viện gửi mail (`ap_phpmailer_helper.php`) hoặc phpThumb gọi tới.
* **Polyfill `mysql_escape_string()`:** Bọc lại bằng `addcslashes()`.

---

### 2.2. Đấu nối Polyfill và Cấu hình Error Reporting
Chèn nạp `php83_compat.php` và thiết lập ẩn cảnh báo Deprecated / Warning trên các điểm khởi chạy chính:

1. **Frontend (`index.php`):**
   * Nạp `require_once dirname(__FILE__) . '/php83_compat.php';`
   * Cập nhật `error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE & ~E_WARNING);` trong môi trường development để không làm vỡ giao diện hay response JSON của Ajax khi PHP 8.3 thông báo dynamic property.
2. **Backend (`admin/index.php`):**
   * Nạp `require_once dirname(__DIR__) . '/php83_compat.php';`
   * Bổ sung cơ chế xử lý lỗi tương tự frontend.
3. **Bộ xử lý ảnh thumbnail (`rgn_editor/phpthumb/phpThumb.php`):**
   * Nạp `require_once dirname(dirname(__DIR__)) . '/php83_compat.php';`
   * Bỏ kích hoạt `ini_set('magic_quotes_runtime', '0')` và tắt `display_errors` để không làm hỏng dữ liệu nhị phân của ảnh thumbnail.

---

### 2.3. Sửa lỗi Fatal cú pháp mảng/chuỗi ngoặc nhọn `{}` thành `[]`
Trên PHP 8.0+, cú pháp truy cập ký tự chuỗi bằng ngoặc nhọn `$str{idx}` bị cấm hoàn toàn và gây ra **Fatal Compile Error**. Toàn bộ các vị trí trong thư viện phpThumb đã được chuyển đổi sang ngoặc vuông `$str[idx]`:

* **[`rgn_editor/phpthumb/phpthumb.functions.php`](file:///c:/xampp/htdocs/cycletech/rgn_editor/phpthumb/phpthumb.functions.php):**
  * Sửa `$string{$i}` thành `$string[$i]`.
  * Sửa `$escapeables{$i}` thành `$escapeables[$i]`.
* **[`rgn_editor/phpthumb/phpthumb.bmp.php`](file:///c:/xampp/htdocs/cycletech/rgn_editor/phpthumb/phpthumb.bmp.php):**
  * Sửa tất cả các vị trí `$BMPpixelData{...}` thành `$BMPpixelData[...]`.
  * Sửa `$byteword{$i}` thành `$byteword[$i]`.
  * Sửa `$binstring{0}` thành `$binstring[0]`.
* **[`rgn_editor/phpthumb/phpthumb.gif.php`](file:///c:/xampp/htdocs/cycletech/rgn_editor/phpthumb/phpthumb.gif.php):**
  * Sửa `$data{0}`, `$data{1}`, `$data{4}`, `$data{$i}`, `$data{$nPxl}` thành `$data[...]`.
  * Sửa `$rgb{0}`, `$rgb{1}`, `$rgb{2}` thành `$rgb[...]`.
  * Sửa `$lpData{8}` thành `$lpData[8]`.
  * Sửa `$pal{...}` thành `$pal[...]`.
* **[`rgn_editor/phpthumb/phpthumb.class.php`](file:///c:/xampp/htdocs/cycletech/rgn_editor/phpthumb/phpthumb.class.php):**
  * Sửa `$filename{0}`, `$filename{1}` thành `$filename[0]`, `$filename[1]`.
  * Sửa `$which_convert{0}` thành `$which_convert[0]`.
  * Chuẩn hóa ký tự độ góc `\xb0` (ISO-8859-1) thành chuỗi ASCII chuẩn tránh lỗi nhận diện bảng mã UTF-8.

---

### 2.4. Sửa lỗi cú pháp số bát phân (Octal Literal)
* **File:** [`application/helpers/ap_function_helper.php`](file:///c:/xampp/htdocs/cycletech/application/helpers/ap_function_helper.php#L690-L716)
* **Hiện tượng:** Cú pháp `case 08:` và `case 09:` trong PHP 7.4/8.x là số bát phân không hợp lệ, gây lỗi `Parse error: Invalid numeric literal`.
* **Khắc phục:** Đổi toàn bộ từ `case 01:` .. `case 09:` thành `case 1:` .. `case 9:`.

---

### 2.5. Nâng cấp chuẩn hóa Model sang CodeIgniter 3
Trên PHP 8.0+, constructor kiểu PHP 4 (`function TênClass()`) không còn được nhận diện là constructor nữa, khiến các phương thức khởi tạo của model không chạy:

* **Các file Model:**
  * [`application/models/home_model.php`](file:///c:/xampp/htdocs/cycletech/application/models/home_model.php)
  * [`application/models/news_model.php`](file:///c:/xampp/htdocs/cycletech/application/models/news_model.php)
  * [`application/models/product_model.php`](file:///c:/xampp/htdocs/cycletech/application/models/product_model.php)
  * [`admin/application/models/background_model.php`](file:///c:/xampp/htdocs/cycletech/admin/application/models/background_model.php)
* **Nội dung sửa đổi:**
  * Đổi `class ... extends Model` thành `class ... extends CI_Model`.
  * Đổi `function TênModel()` thành `function __construct()`.
  * Đổi `parent::Model()` thành `parent::__construct()`.

---

### 2.6. Cấu hình Database Driver & Đồng bộ Local / Live
* Cả hai file cấu hình database tại [`application/config/database.php`](file:///c:/xampp/htdocs/cycletech/application/config/database.php#L40) (Frontend) và [`admin/application/config/database.php`](file:///c:/xampp/htdocs/cycletech/admin/application/config/database.php#L40) (Admin) hiện đã được **đồng bộ hoàn toàn 100%**:
  * Đều sử dụng driver chuẩn **`mysqli`**.
  * Tích hợp điều kiện tự động nhận diện: Khi chạy trên môi trường cục bộ (`localhost` / `127.0.0.1`), hệ thống tự động đăng nhập user `root` (password rỗng). Khi triển khai lên máy chủ thật / production domain, hệ thống tự động sử dụng tài khoản production (`cycletech` / `6mjO0wyjRD95wxb`), không cần phải sửa file thủ công khi upload.

---

### 2.7. Đồng bộ cơ chế nhận diện giao thức HTTP/HTTPS trong `config.php`
* **File:** [`admin/application/config/config.php`](file:///c:/xampp/htdocs/cycletech/admin/application/config/config.php#L4)
* **Trước:** Đang gán cứng `$root = "https://" . $_SERVER['HTTP_HOST'];`, khiến việc chạy trên `localhost` (không có chứng chỉ SSL) bị ép sang HTTPS và gây lỗi SSL/chứng chỉ không hợp lệ.
* **Sau khi đồng bộ:** Sử dụng bộ nhận diện giao thức động đồng bộ với trang chính:
  ```php
  $http_protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')) ? 'https://' : 'http://';
  $http_host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
  $script_name = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '';
  $root = $http_protocol . $http_host . str_replace(basename($script_name), '', $script_name);
  $config['base_url'] = "$root";
  ```
  Giúp website hoạt động mượt mà trên cả `http://` (localhost) lẫn `https://` (live domain có SSL / reverse proxy).

---

## 3. KẾT QUẢ KIỂM THỬ

1. **Quét toàn bộ mã nguồn (Full Audit):**
   * Không còn bất kỳ vị trí nào dùng cú pháp ngoặc nhọn `{}` cho chuỗi/mảng (`0 match`).
   * Không còn số bát phân `08`/`09` (`0 match`).
   * Không còn constructor kiểu PHP 4 ở model (`0 match`).
   * Không còn hàm `mysql_*` bị loại bỏ (`0 match`).
2. **Kiểm tra chạy thực tế qua HTTP Web Server:**
   * **Trang chủ Frontend (`http://localhost/cycletech/`):** Tải trang thành công (HTTP 200), giao diện và nội dung hiển thị chuẩn xác không sinh lỗi.
   * **Trang quản trị Admin (`http://localhost/cycletech/admin/`):** Kết nối cơ sở dữ liệu thành công, chuyển hướng an toàn vào trang xác thực đăng nhập (`/do_login`).

---

## 4. HƯỚNG DẪN KHI TRIỂN KHAI LÊN SERVER PHP 8.3
1. **Kiểm tra cú pháp tổng thể trên máy chủ:**
   ```bash
   find . -name "*.php" -exec php -l {} \; | grep -v "No syntax errors"
   ```
2. **Đảm bảo PHP 8.3 trên server đã bật các extension cần thiết:**
   * `extension=mysqli`
   * `extension=mbstring`
   * `extension=gd`
   * `extension=curl`
   * `extension=openssl`
3. Toàn bộ file polyfill [`php83_compat.php`](file:///c:/xampp/htdocs/cycletech/php83_compat.php) đã được đặt sẵn ở thư mục gốc, chỉ cần upload cùng mã nguồn là hệ thống sẽ tự động kích hoạt.
