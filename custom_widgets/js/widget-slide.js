jQuery(document).ready(function ($) {
    // Slide custom widget
    const swiper = new Swiper('.DSMCA__slide', {
        slidesPerView: 3,
        spaceBetween: 20,
        grabCursor: true,
        allowTouchMove: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 6000,
            disableOnInteraction: false,
        },
        breakpoints: {
            // when window width is >= 320px
            320: {
              slidesPerView: 1
            },
            520: {
                slidesPerView: 2
            },
            971: {
              slidesPerView: 3
            }
        }
    });
});
