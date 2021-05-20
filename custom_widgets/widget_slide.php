<?php 

namespace Elementor;

class Widget_slide extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);  
        wp_register_script( 'widget-slide-js', get_stylesheet_directory_uri() . '/custom_widgets/js/widget-slide.js', [ 'elementor-frontend' ], '1.0.0', true );
        wp_register_style( 'widget-slide-css', get_stylesheet_directory_uri() . '/custom_widgets/css/widget-slide.css');
    }
  
    public function get_script_depends() {
       return [ 'widget-slide-js' ];
    }

    public function get_style_depends() {
        return [ 'widget-slide-css' ];
    }

    // Get widget name.
	public function get_name() { 
        return 'widget-slide'; 
    }	

    //  Get widget title.
	public function get_title() { 
        return 'Custom slide';
    }	

    // Get widget icon.
	public function get_icon() {
        return 'fa fa-arrows-alt'; 
    }

    // Get widget categories.
	public function get_categories() { 
        return [ 'basic' ]; 
    }

    //Controls widget
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'custom-slide-dismerca' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'imagen', [
                'label' => __( 'Imagen', 'custom-slide-dismerca' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

		$repeater->add_control(
			'titulo', [
				'label' => __( 'Titulo', 'custom-slide-dismerca' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'list',
			[
				'label' => __( 'Slide', 'custom-slide-dismerca' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'titulo' => __( 'Title', 'custom-slide-dismerca' )
					],
				],
				'title_field' => '{{{ titulo }}} ',
			]
		);        


		$this->end_controls_section();
	}

    /*
    * Render widget output on the frontend.
    */
	protected function render() {
        $settings = $this->get_settings_for_display(); 

        if ( $settings['list'] ) { ?>

        <div class="DSMCA__slide swiper-container">
            <div class="swiper-wrapper">                
                <?php foreach (  $settings['list'] as $item ) : ?>
                    <div class="DSMCA__item_slide swiper-slide">
                        <img class="DSMCA__item-image" src=" <?php echo $item['imagen']['url']  ?> ">
                        <h5 class="DSMCA__item-title"><?php echo $item['titulo'] ?></h5>
                    </div>
                <?php endforeach; ?>               
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>


        <?php }
	}	


	/**
	 * Render the widget output in the editor.
	 *
	 */

    protected function _content_template() { ?>
        <# if ( settings.list.length ) { #>
            <div class="DSMCA__slide swiper-container">
                <div class="swiper-wrapper">
                    <# _.each( settings.list, function( item ) { #>	
                        <div class="DSMCA__item_slide swiper-slide">
                            <img class="DSMCA__item-image" src=" {{ item.imagen.url }} ">
                            <h5 class="DSMCA__item-title"> {{{ item.titulo }}} </h5>                
                        </div>
                    <# }); #>	
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        <# } #>
        <?php
    }
    
}