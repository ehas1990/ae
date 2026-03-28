// ========================
// AOS Init with scroll direction detection
// ========================
window.addEventListener('load', function () {
    if (typeof AOS === 'undefined') return;

    // Track scroll direction
    var lastScrollTop = 0;
    var scrollDirection = 'down';

    window.addEventListener('scroll', function () {
        var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        scrollDirection = scrollTop > lastScrollTop ? 'down' : 'up';
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    });

    // Set AOS animation based on scroll direction before each element animates
    document.querySelectorAll('[data-aos]').forEach(function (el) {
        el.setAttribute('data-aos', 'fade-up');
    });

    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: false,
        offset: 100,
        startEvent: 'load',
    });

    // Update animation direction when elements leave viewport
    var observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (m) {
            if (m.type === 'attributes' && m.attributeName === 'class') {
                var el = m.target;
                if (!el.classList.contains('aos-animate') && el.hasAttribute('data-aos')) {
                    el.setAttribute('data-aos', scrollDirection === 'down' ? 'fade-up' : 'fade-down');
                }
            }
        });
    });

    document.querySelectorAll('[data-aos]').forEach(function (el) {
        observer.observe(el, { attributes: true, attributeFilter: ['class'] });
    });
});

document.addEventListener('DOMContentLoaded', function () {

    // ========================
    // Services Slider (Swiper.js)
    // ========================
    var servicesSliderEl = document.querySelector('.services-slider');
    if (servicesSliderEl && typeof Swiper !== 'undefined') {
        var servicesSwiper = new Swiper('.services-slider', {
            slidesPerView: 4.5,
            spaceBetween: 20,
            loop: true,
            speed: 800,
            grabCursor: true,
            centeredSlides: false,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            navigation: {
                prevEl: '.services-nav__prev',
                nextEl: '.services-nav__next',
            },
            breakpoints: {
                0: {
                    slidesPerView: 1.3,
                },
                480: {
                    slidesPerView: 1.8,
                },
                768: {
                    slidesPerView: 2.5,
                },
                1024: {
                    slidesPerView: 3.5,
                },
                1280: {
                    slidesPerView: 4.5,
                },
            },
        });
    }

    // ========================
    // Industries Slider (Swiper.js)
    // ========================
    var industriesSliderEl = document.querySelector('.industries-slider');
    if (industriesSliderEl && typeof Swiper !== 'undefined') {
        var industriesSwiper = new Swiper('.industries-slider', {
            slidesPerView: 4,
            spaceBetween: 24,
            loop: true,
            speed: 800,
            grabCursor: true,
            centeredSlides: false,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            navigation: {
                prevEl: '.industries-nav__prev',
                nextEl: '.industries-nav__next',
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    spaceBetween: 16,
                },
                600: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                900: {
                    slidesPerView: 3,
                    spaceBetween: 24,
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 24,
                },
            },
        });
    }

    // ========================
    // FAQ Accordion
    // ========================
    document.querySelectorAll('.faq-item__question').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var item = btn.closest('.faq-item');
            var isActive = item.classList.contains('faq-item--active');
            document.querySelectorAll('.faq-item').forEach(function (el) {
                el.classList.remove('faq-item--active');
            });
            if (!isActive) item.classList.add('faq-item--active');
        });
    });

    // ========================
    // Products Tabs
    // ========================
    document.querySelectorAll('.products-tab').forEach(function (tab) {
        tab.addEventListener('click', function () {
            var targetId = tab.getAttribute('data-tab');
            document.querySelectorAll('.products-tab').forEach(function (t) {
                t.classList.remove('products-tab--active');
            });
            document.querySelectorAll('.products-panel').forEach(function (p) {
                p.classList.remove('products-panel--active');
            });
            tab.classList.add('products-tab--active');
            var target = document.getElementById(targetId);
            if (target) target.classList.add('products-panel--active');
        });
    });

    // ========================
    // Testimonials Slider
    // ========================
    var cards = document.querySelectorAll('.testimonial-card');
    var currentIdx = 0;

    function showTestimonial(idx) {
        cards.forEach(function (c) { c.classList.remove('testimonial-card--active'); });
        if (cards[idx]) cards[idx].classList.add('testimonial-card--active');
        currentIdx = idx;
    }

    var prevBtn = document.querySelector('.testimonials-nav__prev');
    var nextBtn = document.querySelector('.testimonials-nav__next');

    if (prevBtn) {
        prevBtn.addEventListener('click', function () {
            showTestimonial(currentIdx > 0 ? currentIdx - 1 : cards.length - 1);
            resetAutoSlide();
        });
    }
    if (nextBtn) {
        nextBtn.addEventListener('click', function () {
            showTestimonial(currentIdx < cards.length - 1 ? currentIdx + 1 : 0);
            resetAutoSlide();
        });
    }

    // Auto slide every 5 seconds
    var autoSlideTimer = null;
    function startAutoSlide() {
        if (cards.length > 1) {
            autoSlideTimer = setInterval(function () {
                showTestimonial(currentIdx < cards.length - 1 ? currentIdx + 1 : 0);
            }, 5000);
        }
    }
    function resetAutoSlide() {
        clearInterval(autoSlideTimer);
        startAutoSlide();
    }
    startAutoSlide();

    // ========================
    // Custom Cursor for Projects Section
    // ========================
    var customCursor = document.querySelector('.custom-cursor');
    var projectsSection = document.querySelector('.projects-section');

    if (customCursor && projectsSection) {
        document.addEventListener('mousemove', function (e) {
            customCursor.style.left = e.clientX + 'px';
            customCursor.style.top = e.clientY + 'px';
        });

        projectsSection.addEventListener('mouseenter', function () {
            customCursor.style.display = 'block';
        });

        projectsSection.addEventListener('mouseleave', function () {
            customCursor.style.display = 'none';
        });
    }
});
