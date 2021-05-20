jQuery(document).ready(function ($) {

    // -- Mega menu
    function inicializa (){
        $(".DSMCA_marcas-motos .swiper-slide-image").each(function(){
            let alt = $(this).attr("alt")
            $(this).attr('data-marca' , alt) 
        });

        $(".DSMCA_marcas-motos .swiper-slide-image").mouseenter(function() {
            let marca = $(this).attr("data-marca")
            if( $('.DSMCA_motos.marca-' + marca).length > 0) {
                $('.DSMCA_motos').each(function(){
                    if( $(this).is(':visible') ){
                        $(this).hide()
                    }
                })
                $('.DSMCA_motos.marca-' + marca).show();
            }
        });
    }   

    $('.item-motos').mouseenter(function(){       
        $('.DSMCA_template-mega-menu').each(function(){
            if( $(this).is(':visible') && $(this).attr('data-item') != 'motos' ){
                $(this).hide()
            }
            if( $(this).attr('data-item') == 'motos'  ){
                $(this).show()
            }
        })
        setTimeout(inicializa, 500);
    })


    // Slide product gallery
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
		prevArrow: '<img class="slick-prev slick-arrow" src="/dismerca/wp-content/uploads/left.png">',
		nextArrow: '<img class="slick-next slick-arrow" src="/dismerca/wp-content/uploads/right.png">',
        fade: true,
        cssEase: 'linear',
        asNavFor: '.slider-nav',
        autoplay: true,
        autoplaySpeed: 6000,
    });
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        arrows: false,
        centerMode: true,
        focusOnSelect: true
    });

    // add $ to price compare table
    $("#yith-woocompare-table .compare-row:nth-child(2) .value").prepend("$ ");
});
