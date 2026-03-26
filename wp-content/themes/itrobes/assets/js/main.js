document.addEventListener('DOMContentLoaded', function () {

    // ========================
    // Services Slider (Swiper.js)
    // ========================
    var servicesSliderEl = document.querySelector('.services-slider');
    if (servicesSliderEl && typeof Swiper !== 'undefined') {
        var totalSlides = servicesSliderEl.querySelectorAll('.swiper-slide').length;
        var servicesSwiper = new Swiper('.services-slider', {
            slidesPerView: 'auto',
            spaceBetween: 20,
            loop: true,
            loopAdditionalSlides: totalSlides,
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
                    spaceBetween: 12,
                },
                768: {
                    spaceBetween: 16,
                },
                1024: {
                    spaceBetween: 20,
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
});
