
document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Hover Zoom & Thumbnail Click for Product Detail Page
    const thumbs = document.querySelectorAll('.thumb');
    const mainImg = document.querySelector('.main-image img');
    
    if (thumbs.length > 0 && mainImg) {
        thumbs.forEach(thumb => {
            thumb.addEventListener('click', function() {
                // Xóa active class ở thumb cũ
                document.querySelector('.thumb.active').classList.remove('active');
                // Thêm active class vào thumb mới
                this.classList.add('active');
                
                // Đổi src ảnh chính bằng hiệu ứng mờ nhẹ
                mainImg.style.opacity = '0.5';
                setTimeout(() => {
                    mainImg.src = this.querySelector('img').src;
                    mainImg.style.opacity = '1';
                }, 150);
            });
        });
        
        // Hiệu ứng zoom di chuột (tùy chọn mở rộng cho main-image)
        const mainImageContainer = document.querySelector('.main-image');
        mainImageContainer.addEventListener('mousemove', function(e) {
            const x = e.clientX - e.target.offsetLeft;
            const y = e.clientY - e.target.offsetTop;
            mainImg.style.transformOrigin = `${x}px ${y}px`;
            mainImg.style.transform = 'scale(1.3)';
        });
        mainImageContainer.addEventListener('mouseleave', function() {
            mainImg.style.transformOrigin = `center center`;
            mainImg.style.transform = 'scale(1)';
        });
    }

    // 2. Scroll Reveal Animations (Hiệu ứng xuất hiện khi cuộn trang)
    const revealElements = document.querySelectorAll('.reveal');
    const revealOnScroll = () => {
        let windowHeight = window.innerHeight;
        let revealPoint = 50; // Trigger before element is fully in view

        revealElements.forEach(el => {
            let elementTop = el.getBoundingClientRect().top;
            if (elementTop < windowHeight - revealPoint) {
                el.classList.add('active');
            }
        });
    }
    
    // Lắng nghe sự kiện scroll
    window.addEventListener('scroll', revealOnScroll);
    // Chạy một lần khi load trang để hiển thị các phần tử ở vùng nhìn thấy
    revealOnScroll();

    // 2.1 Mobile Navigation Drawer Toggle
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileNavDrawer = document.getElementById('mobileNavDrawer');
    const mobileNavBackdrop = document.getElementById('mobileNavBackdrop');
    const mobileNavClose = document.getElementById('mobileNavClose');

    const openMobileMenu = () => {
        if (mobileNavDrawer && mobileNavBackdrop) {
            mobileNavDrawer.classList.add('active');
            mobileNavBackdrop.classList.add('active');
            if (mobileMenuToggle) mobileMenuToggle.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    };

    const closeMobileMenu = () => {
        if (mobileNavDrawer && mobileNavBackdrop) {
            mobileNavDrawer.classList.remove('active');
            mobileNavBackdrop.classList.remove('active');
            if (mobileMenuToggle) mobileMenuToggle.classList.remove('active');
            document.body.style.overflow = '';
        }
    };

    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            if (mobileNavDrawer && mobileNavDrawer.classList.contains('active')) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });
    }

    if (mobileNavClose) {
        mobileNavClose.addEventListener('click', closeMobileMenu);
    }

    if (mobileNavBackdrop) {
        mobileNavBackdrop.addEventListener('click', closeMobileMenu);
    }

    // Close on ESC key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && mobileNavDrawer && mobileNavDrawer.classList.contains('active')) {
            closeMobileMenu();
        }
    });

    // Close when clicking internal drawer links
    const drawerLinks = document.querySelectorAll('.mobile-nav-links a');
    drawerLinks.forEach(link => {
        link.addEventListener('click', closeMobileMenu);
    });
});

// 3. Preloader Animation Dismiss
(function() {
    const hidePreloader = () => {
        const preloader = document.getElementById('page-preloader');
        if (preloader && !preloader.classList.contains('loaded')) {
            preloader.classList.add('loaded');
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 550);
        }
    };

    // Khi toàn bộ tài nguyên (CSS, Fonts, Images) tải xong
    if (document.readyState === 'complete') {
        setTimeout(hidePreloader, 200);
    } else {
        window.addEventListener('load', () => {
            setTimeout(hidePreloader, 200);
        });
    }

    // Safety timeout: Tự động tắt sau tối đa 2.5s nếu có script/font mạng ngoài bị nghẽn
    setTimeout(hidePreloader, 2500);
})();

// 4. Client-side Auto Path Fixer (Hoạt động đa môi trường: Localhost, Subdirectory Demo, Live Hosting)
(function() {
    function fixAllMediaPaths() {
        const mainScript = document.querySelector('script[src*="js/main.js"]');
        let baseUrl = window.location.origin + '/';
        if (mainScript) {
            baseUrl = mainScript.src.replace(/js\/main\.js(\?.*)?$/i, '');
        }
        if (!baseUrl.endsWith('/')) baseUrl += '/';

        // Fix background-image url(/fileman/...) va url(/upload/...)
        const styledElements = document.querySelectorAll('[style*="fileman/"], [style*="upload/"]');
        styledElements.forEach(function(el) {
            const styleAttr = el.getAttribute('style');
            if (styleAttr && (styleAttr.indexOf('/fileman/') !== -1 || styleAttr.indexOf('/upload/') !== -1)) {
                const newStyle = styleAttr.replace(/url\(\s*(['"]?)\/(fileman\/|upload\/)([^'")]+)\1\s*\)/gi, function(match, q, folder, file) {
                    return 'url(' + q + baseUrl + folder + file + q + ')';
                });
                if (newStyle !== styleAttr) {
                    el.setAttribute('style', newStyle);
                }
            }
        });

        // Fix thẻ img, source, video, audio có src bắt đầu bằng /fileman/ hoặc /upload/
        const mediaElements = document.querySelectorAll('img[src^="/fileman/"], img[src^="/upload/"], source[src^="/fileman/"], source[src^="/upload/"], video[src^="/fileman/"], video[src^="/upload/"]');
        mediaElements.forEach(function(item) {
            const currentSrc = item.getAttribute('src');
            if (currentSrc && (currentSrc.indexOf('/fileman/') === 0 || currentSrc.indexOf('/upload/') === 0)) {
                item.setAttribute('src', baseUrl + currentSrc.substring(1));
            }
        });

        // Fix thẻ link a[href]
        const linkElements = document.querySelectorAll('a[href^="/fileman/"], a[href^="/upload/"]');
        linkElements.forEach(function(link) {
            const currentHref = link.getAttribute('href');
            if (currentHref && (currentHref.indexOf('/fileman/') === 0 || currentHref.indexOf('/upload/') === 0)) {
                link.setAttribute('href', baseUrl + currentHref.substring(1));
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', fixAllMediaPaths);
    } else {
        fixAllMediaPaths();
    }
})();

