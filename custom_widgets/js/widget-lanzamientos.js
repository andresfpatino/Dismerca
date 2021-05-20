jQuery(document).ready(function ($) {

    const MainSlider = new Swiper('.DSMCA__nuevos-lanzamientos', {
        slidesPerView: 'auto',
        spaceBetween: 20,
        grabCursor: false,
        centeredSlides: true,
        centeredSlidesBounds: true,
        slideActiveClass: 'slide-active',
        allowTouchMove: false,  
        loop: true,
        autoplay: {
            delay: 6000,
            disableOnInteraction: false,
        }, 
        navigation: {
            nextEl: '.swiper-button-next.general',
            prevEl: '.swiper-button-prev.general',
        },    
    });

    var galleryTop = new Swiper('.DSMCA__gallery-top', {
        spaceBetween: 10,
        loop: true,
        loopedSlides: 3, //looped slides should be the same       
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    var galleryThumbs = new Swiper('.DSMCA__gallery-thumbs', {
        spaceBetween: 10,        
        slidesPerView: 3,
        loop: true,
        loopedSlides: 3, //looped slides should be the same
        centeredSlides: true,
        centeredSlidesBounds: true,
        allowTouchMove: false,  
        slideActiveClass: 'thumb-active',
        // controller: {
        //     control: galleryTop,
        // },
    });

    // galleryTop.controller.control = galleryThumbs;
    // galleryThumbs.controller.control = galleryTop;


});
