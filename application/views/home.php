<?php
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
   ?>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Hero Banner Swiper Slider -->
    <section class="hero-slider-section">
        <div class="swiper heroSwiper">
            <div class="swiper-wrapper">
                <!-- Slide 1: Video Hero Slide (video.mp4) -->
                <div class="swiper-slide hero-slide-video">
                    <video id="heroSlideVideo" class="hero-video-bg" autoplay muted loop playsinline preload="auto">
                        <source src="<?php echo base_url(); ?>video.mp4" type="video/mp4">
                        Trình duyệt của bạn không hỗ trợ thẻ video HTML5.
                    </video>
                    <div class="hero-video-overlay"></div>
                    <div class="container hero-container">
                        <div class="hero-grid">
                            <div class="hero-left">
                                <span class="hero-tagline">CYCLE ELECTRIC – TƯƠNG LAI NĂNG LƯỢNG XANH</span>
                                <h1 class="hero-title">Năng lượng sạch<br>Kiến tạo tương lai</h1>
                                <p class="hero-desc">
                                    Cycle Electric mang đến giải pháp sạc xe điện thông minh, hệ thống quan trắc và giải pháp lưu trữ năng lượng toàn diện, thúc đẩy phát triển bền vững.
                                </p>
                                <div class="hero-actions">
                                    <a href="<?php echo base_url(); ?>san-pham" class="btn-hero-primary">
                                        <span>Khám phá sản phẩm</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                    <a href="<?php echo base_url(); ?>gioi-thieu" class="btn-hero-secondary">
                                        <i class="fas fa-info-circle"></i>
                                        <span>Về chúng tôi</span>
                                    </a>
                                </div>
                            </div>

                            <div class="hero-right">
                                <div class="hero-feature-card">
                                    <div class="feature-icon-circle">
                                        <i class="fas fa-bolt"></i>
                                    </div>
                                    <div class="feature-info">
                                        <strong>Sạc nhanh</strong>
                                        <small>Tiết kiệm thời gian</small>
                                    </div>
                                </div>

                                <div class="hero-feature-card">
                                    <div class="feature-icon-circle">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div class="feature-info">
                                        <strong>An toàn</strong>
                                        <small>Bảo vệ tối đa</small>
                                    </div>
                                </div>

                                <div class="hero-feature-card">
                                    <div class="feature-icon-circle">
                                        <i class="fas fa-leaf"></i>
                                    </div>
                                    <div class="feature-info">
                                        <strong>Thân thiện</strong>
                                        <small>Vì môi trường xanh</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2: Trạm Sạc Nhanh DC Chuẩn Quốc Tế -->
                <div class="swiper-slide hero-layout-section hero-slide-2">
                    <div class="container hero-container">
                        <div class="hero-grid">
                            <div class="hero-left">
                                <span class="hero-tagline">HỆ THỐNG TRẠM SẠC TOÀN DIỆN</span>
                                <h1 class="hero-title">Công nghệ sạc nhanh<br>Chuẩn mực quốc tế</h1>
                                <p class="hero-desc">
                                    Cung cấp dải sản phẩm trụ sạc AC & DC công suất từ 7kW đến 360kW, chuẩn kết nối CCS2/GB-T tương thích mọi dòng xe điện hiện đại.
                                </p>
                                <div class="hero-actions">
                                    <a href="<?php echo base_url(); ?>san-pham" class="btn-hero-primary">
                                        <span>Khám phá sản phẩm</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                    <a href="<?php echo base_url(); ?>gioi-thieu" class="btn-hero-secondary">
                                        <i class="fas fa-info-circle"></i>
                                        <span>Về chúng tôi</span>
                                    </a>
                                </div>
                            </div>

                            <div class="hero-right">
                                <div class="hero-feature-card">
                                    <div class="feature-icon-circle">
                                        <i class="fas fa-charging-station"></i>
                                    </div>
                                    <div class="feature-info">
                                        <strong>Chuẩn CCS2 / GB-T</strong>
                                        <small>Tương thích đa dạng</small>
                                    </div>
                                </div>

                                <div class="hero-feature-card">
                                    <div class="feature-icon-circle">
                                        <i class="fas fa-tachometer-alt"></i>
                                    </div>
                                    <div class="feature-info">
                                        <strong>Công suất siêu tốc</strong>
                                        <small>Lên đến 360kW DC</small>
                                    </div>
                                </div>

                                <div class="hero-feature-card">
                                    <div class="feature-icon-circle">
                                        <i class="fas fa-cloud"></i>
                                    </div>
                                    <div class="feature-info">
                                        <strong>Quản lý Cloud</strong>
                                        <small>Vận hành tự động</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3: Lưu Trữ Năng Lượng BESS & Quan Trắc -->
                <div class="swiper-slide hero-layout-section hero-slide-3">
                    <div class="container hero-container">
                        <div class="hero-grid">
                            <div class="hero-left">
                                <span class="hero-tagline">LƯU TRỮ NĂNG LƯỢNG (BESS) & QUAN TRẮC</span>
                                <h1 class="hero-title">Tối ưu hiệu suất<br>Vận hành bền bỉ</h1>
                                <p class="hero-desc">
                                    Hệ thống lưu trữ điện năng BESS và thiết bị quan trắc bức xạ mặt trời tiêu chuẩn Class A giúp ổn định lưới điện và tối ưu hoá chi phí vận hành.
                                </p>
                                <div class="hero-actions">
                                    <a href="<?php echo base_url(); ?>san-pham" class="btn-hero-primary">
                                        <span>Khám phá sản phẩm</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                    <a href="<?php echo base_url(); ?>gioi-thieu" class="btn-hero-secondary">
                                        <i class="fas fa-info-circle"></i>
                                        <span>Về chúng tôi</span>
                                    </a>
                                </div>
                            </div>

                            <div class="hero-right">
                                <div class="hero-feature-card">
                                    <div class="feature-icon-circle">
                                        <i class="fas fa-car-battery"></i>
                                    </div>
                                    <div class="feature-info">
                                        <strong>Lưu trữ BESS</strong>
                                        <small>Hiệu quả năng lượng</small>
                                    </div>
                                </div>

                                <div class="hero-feature-card">
                                    <div class="feature-icon-circle">
                                        <i class="fas fa-satellite-dish"></i>
                                    </div>
                                    <div class="feature-info">
                                        <strong>Chuẩn Class A</strong>
                                        <small>Đo đạc chính xác</small>
                                    </div>
                                </div>

                                <div class="hero-feature-card">
                                    <div class="feature-icon-circle">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <div class="feature-info">
                                        <strong>Giám sát SCADA</strong>
                                        <small>Dữ liệu thời gian thực</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custom Swiper Pagination Dots -->
            <div class="hero-swiper-pagination"></div>
        </div>
    </section>

    <!-- Swiper JS & Initialization -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof Swiper !== 'undefined') {
                var heroSwiper = new Swiper(".heroSwiper", {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    loop: true,
                    speed: 800,
                    autoplay: {
                        delay: 6000,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true
                    },
                    pagination: {
                        el: ".hero-swiper-pagination",
                        clickable: true
                    },
                    on: {
                        init: function() {
                            var vid = document.getElementById('heroSlideVideo');
                            if (vid) {
                                vid.play().catch(function(){});
                            }
                        },
                        slideChange: function() {
                            var activeSlide = this.slides[this.activeIndex];
                            if (activeSlide) {
                                var vid = activeSlide.querySelector('video');
                                if (vid) {
                                    vid.currentTime = 0;
                                    vid.play().catch(function(){});
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>

    <!-- Danh Mục Sản Phẩm (Category Grid) -->
    <section class="category-section-layout container">
        <div class="cat-header-wrap">
            <span class="cat-badge-subtitle">DANH MỤC SẢN PHẨM</span>
            <h2 class="cat-section-title">Giải pháp sạc toàn diện cho xe điện</h2>
            <div class="cat-title-underline"></div>
        </div>

        <?php
        $category_presets = [
            'tru-sac-xe-dien' => [
                'title' => 'TRỤ SẠC XE ĐIỆN',
                'desc' => 'AC & DC - Đa dạng công suất',
                'icon' => 'fas fa-charging-station'
            ],
            'thiet-bi-quan-trac' => [
                'title' => 'THIẾT BỊ QUAN TRẮC',
                'desc' => 'Giám sát thông minh',
                'icon' => 'fas fa-satellite-dish'
            ],
            'bo-loc-song-hai' => [
                'title' => 'BỘ LỌC SÓNG HÀI',
                'desc' => 'Ổn định hệ thống điện',
                'icon' => 'fas fa-bolt'
            ],
            'bo-luu-tru-nang-luong' => [
                'title' => 'BỘ LƯU TRỮ NĂNG LƯỢNG (BESS)',
                'desc' => 'Lưu trữ linh hoạt - Hiệu quả cao',
                'icon' => 'fas fa-car-battery'
            ],
            'lam-mat-tu-dien' => [
                'title' => 'LÀM MÁT & PHỤ KIỆN TỦ ĐIỆN RITTAL',
                'desc' => 'Bền bỉ - Tối ưu vận hành',
                'icon' => 'fas fa-fan'
            ],
            'dong-ho-do-da-nang' => [
                'title' => 'ĐỒNG HỒ ĐO ĐA NĂNG',
                'desc' => 'Chính xác - Tin cậy',
                'icon' => 'fas fa-tachometer-alt'
            ],
            'bien-tan-inverter' => [
                'title' => 'BIẾN TẦN INVERTER',
                'desc' => 'Hiệu suất cao - Tiết kiệm điện',
                'icon' => 'fas fa-microchip'
            ]
        ];

        // Lấy danh sách danh mục thực tế từ Database
        $db_materials = function_exists('get_material_product_all') ? get_material_product_all() : [];
        ?>

        <div class="cat-grid-layout">
            <?php 
            if (!empty($db_materials)):
                foreach ($db_materials as $mat):
                    $c_slug = function_exists('get_clean_material_slug') ? get_clean_material_slug($mat) : (!empty($mat['ccode']) ? $mat['ccode'] : '');
                    $c_title = !empty($mat['cmaterial_products']) ? $mat['cmaterial_products'] : '';
                    
                    // Tìm icon và mô tả tương ứng
                    $c_icon = !empty($mat['cicon']) ? $mat['cicon'] : '';
                    $c_desc = 'Giải pháp chuyên dụng & chất lượng cao';

                    if (!empty($c_slug) && isset($category_presets[$c_slug])) {
                        if (empty($c_icon)) $c_icon = $category_presets[$c_slug]['icon'];
                        $c_desc = $category_presets[$c_slug]['desc'];
                    } elseif (!empty($mat['ccode']) && isset($category_presets[$mat['ccode']])) {
                        if (empty($c_icon)) $c_icon = $category_presets[$mat['ccode']]['icon'];
                        $c_desc = $category_presets[$mat['ccode']]['desc'];
                    } else {
                        // Tìm kiếm theo tiền tố ccode hoặc slug
                        foreach ($category_presets as $k_code => $val) {
                            if (strpos($c_slug, $k_code) !== false || strpos($k_code, $c_slug) !== false) {
                                if (empty($c_icon)) $c_icon = $val['icon'];
                                $c_desc = $val['desc'];
                                break;
                            }
                        }
                    }
                    if (empty($c_icon)) $c_icon = 'fas fa-layer-group';
                    $link_url = base_url() . 'danh-muc/' . $c_slug;
            ?>
                <a href="<?php echo $link_url; ?>" class="cat-card-item">
                    <div class="cat-card-icon">
                        <i class="<?php echo $c_icon; ?>"></i>
                    </div>
                    <div class="cat-card-content">
                        <h3 class="cat-card-title"><?php echo htmlspecialchars($c_title); ?></h3>
                        <p class="cat-card-desc"><?php echo htmlspecialchars($c_desc); ?></p>
                    </div>
                    <div class="cat-card-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>
            <?php 
                endforeach;
            else:
                // Fallback nếu CSDL chưa có dữ liệu
                foreach ($category_presets as $c_code => $c_item):
                    if ($c_code == 'bien-tan-inverter') continue;
            ?>
                <a href="<?php echo base_url(); ?>danh-muc/<?php echo $c_code; ?>" class="cat-card-item">
                    <div class="cat-card-icon">
                        <i class="<?php echo $c_item['icon']; ?>"></i>
                    </div>
                    <div class="cat-card-content">
                        <h3 class="cat-card-title"><?php echo $c_item['title']; ?></h3>
                        <p class="cat-card-desc"><?php echo $c_item['desc']; ?></p>
                    </div>
                    <div class="cat-card-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>
            <?php 
                endforeach;
            endif; 
            ?>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="section-padding container">
        <h2 class="section-title reveal">Sản Phẩm Nổi Bật</h2>
        <div class="related-grid">
            <?php 
            $list_products_home = get_product_home();
            if (!empty($list_products_home)) {
                $delay = 0;
                foreach ($list_products_home as $row) {
                    $img_src = (!empty($row['cimage_resize'])) 
                        ? base_url().'upload/images_product/resize_images/'.$row['cimage_resize'] 
                        : ((!empty($row['cimage'])) ? base_url().'upload/images_product/full_images/'.$row['cimage'] : base_url().'images/logo.png');
                    $delay_style = ($delay > 0) ? ' style="transition-delay: '.$delay.'s;"' : '';
            ?>
                <div class="product-card reveal"<?php echo $delay_style; ?>>
                    <a href="<?php echo base_url(); ?>san-pham/<?php echo $row['ccode']; ?>">
                        <img src="<?php echo $img_src; ?>" alt="<?php echo htmlspecialchars($row['cproducts']); ?>">
                    </a>
                    <h3>
                        <a href="<?php echo base_url(); ?>san-pham/<?php echo $row['ccode']; ?>">
                            <?php echo htmlspecialchars($row['cproducts']); ?>
                        </a>
                    </h3>
                    <a href="<?php echo base_url(); ?>san-pham/<?php echo $row['ccode']; ?>" class="btn btn-outline btn-sm">Xem Chi Tiết</a>
                </div>
            <?php 
                    $delay += 0.05;
                    if ($delay > 0.2) {
                        $delay = 0; // Reset delay theo từng hàng 4 item
                    }
                }
            } 
            ?>
        </div>
    </section>
<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
?>