<?php 

namespace Elementor;

class Widget_lanzamientos extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);  
        wp_register_script( 'widget-lanzamientos-js', get_stylesheet_directory_uri() . '/custom_widgets/js/widget-lanzamientos.js', [ 'elementor-frontend' ], '1.0.0', true );
        wp_register_style( 'widget-lanzamientos-css', get_stylesheet_directory_uri() . '/custom_widgets/css/widget-lanzamientos.css');
    }  
 
    public function get_script_depends() {
        return [ 'widget-lanzamientos-js' ];
    }
     
    public function get_style_depends() {
        return [ 'widget-lanzamientos-css' ];
    }    
   
    // Get widget name.
	public function get_name() { 
        return 'widget-lanzamientos'; 
    }	

    //  Get widget title.
	public function get_title() { 
        return 'Nuevos lanzamientos';
    }	

    // Get widget icon.
	public function get_icon() {
        return 'fa fa-paper-plane-o'; 
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
				'label' => __( 'Content', 'lanzamientos-dismerca' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );



		$this->end_controls_section();
	}

    /*
    * Render widget output on the frontend.
    */
	protected function render() {
        $settings = $this->get_settings_for_display(); ?>
        
        <div class="DSMCA__nuevos-lanzamientos swiper-container"> 
            <?php 
                $arg_product = array(
                    'post_type'      => 'product',
                    'publish_status' => 'published',
                    'posts_per_page' => -1,	
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_visibility',
                            'field'    => 'name',
                            'terms'    => 'featured',
                        ),
                    ),
                ); 
                $queryProducts = new \WP_Query($arg_product);
                if($queryProducts->have_posts()) : ?>
                    <div class="swiper-wrapper">   
                        <?php while($queryProducts->have_posts()) : $queryProducts->the_post() ;  ?>	
                            <div class="DSMCA__product swiper-slide">
                                <?php 
                                    $imageProduct = wp_get_attachment_image_src( get_post_thumbnail_id( $queryProducts->post->ID ), 'single-post-thumbnail' );						
                                    $terms = get_the_terms( $queryProducts->ID, 'marca');
                                    $colorLabel = '';
                                    $colorText = '';
                                    $logoMarca = '';
                                    foreach ( $terms as $term ) { 
                                        $colorLabel = get_field('color_label', $term); 
                                        $colorText = get_field('color_text', $term); 
                                        $logoMarca = get_field('logo', $term);
                                        $Brandslug = $term->slug; 
                                    }	
                                ?>  
                                <a href="<?php echo get_term_link( $Brandslug, 'marca' ) ?>">
                                    <img class="DSMCA__brand" src="<?php echo esc_url($logoMarca['url']); ?>" alt="<?php echo esc_attr($logoMarca['alt']); ?>" />
                                </a>                              
                                <h5 class="DSMCA__title" style="background-color: <?php echo $colorLabel; ?>; ">
                                    <a style="color: <?php echo $colorText; ?>;" href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
                                </h5>

                                <div class="DSMCA__gallery-product">
                                    <div class="swiper-container DSMCA__gallery-top ">
                                        <div class="swiper-wrapper">
                                            <div class="DSMCA__prod_thumb swiper-slide">
                                                <img class="DSMCA__thumb_image" src="<?php echo $imageProduct[0]; ?>">
                                            </div>
                                            <?php 
                                            global $product; 
                                            $attachment_ids = $product->get_gallery_image_ids();
                                            $i = 0;
                                            foreach( $attachment_ids as $attachment_id ) : ?>
                                                <div class="DSMCA__prod_thumb swiper-slide">
                                                    <img class="DSMCA__thumb_image" src=" <?php echo $image_link = wp_get_attachment_url( $attachment_id); ?> "> 
                                                </div>
                                                <?php if ($i == 2) { break; } $i++; ?>                                        
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-container DSMCA__gallery-thumbs ">
                                    <div class="swiper-wrapper">
                                        <div class="DSMCA__prod_thumb swiper-slide">
                                            <img class="DSMCA__thumb_image" src="<?php echo $imageProduct[0]; ?>">
                                        </div> 
                                        <?php 
                                        global $product; 
                                        $attachment_ids = $product->get_gallery_image_ids();
                                        $i = 0;
                                        foreach( $attachment_ids as $attachment_id ) : ?>
                                            <div class="DSMCA__prod_thumb swiper-slide">
                                                <img class="DSMCA__thumb_image" src=" <?php echo $image_link = wp_get_attachment_url( $attachment_id); ?> "> 
                                            </div>
                                            <?php if ($i == 1) { break; } $i++; ?>                                        
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>                                
                            </div>                        
                        <?php endwhile; wp_reset_postdata();  ?>
                    </div>
                    <div class="swiper-button-prev general"></div>
                    <div class="swiper-button-next general"></div>
                <?php endif; ?>   
        </div>
	<?php }	    
}