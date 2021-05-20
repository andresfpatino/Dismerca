<?php 

namespace Elementor;

class Widget_blog extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);  
        wp_register_style( 'widget-blog-css', get_stylesheet_directory_uri() . '/custom_widgets/css/widget-blog.css');
    }  
    
    public function get_style_depends() {
        return [ 'widget-blog-css' ];
    }    
   
    // Get widget name.
	public function get_name() { 
        return 'widget-blog'; 
    }	

    //  Get widget title.
	public function get_title() { 
        return 'Custom blog';
    }	

    // Get widget icon.
	public function get_icon() {
        return 'fa fa-newspaper-o'; 
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
				'label' => __( 'Content', 'blog-dismerca' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );

		$this->add_control(
			'post-per-page',
			[
				'label' => __( 'Post per page', 'blog-dismerca' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => -1,
				// 'min' => 5,
				// 'max' => 100,
				// 'step' => 5,
			]
		);


		$this->end_controls_section();
	}

    /*
    * Render widget output on the frontend.
    */
	protected function render() {
        $settings = $this->get_settings_for_display(); ?>

        <div class="DSMCA__blog-grid"> 
            <?php 
                $arg_Post = array(
                    'post_type'      => 'post',
                    'publish_status' => 'published',
                    'posts_per_page' => $settings['post-per-page']			
                );      

                $queryPosts = new \WP_Query($arg_Post);

                if($queryPosts->have_posts()) : ?>
                   
                    <?php while($queryPosts->have_posts()) : $queryPosts->the_post() ; 
                        $featured_img_url = get_the_post_thumbnail_url(); ?>	

                        <div class="DSMCA__wrap_post" style="background-image: url('<?php echo $featured_img_url; ?>');">
                            <time class="DSMCA__post-date" datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date(); ?></time>
                            <div class="DSMCA__post-content-wrap">
                                <h4 class="DSMCA__post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <a class="DSMCA__read-more" href=" <?php the_permalink(); ?> "> 
                                    <?php echo _e('Leer más','DSMCA');  ?>
                                </a>
                            </div>  
                                                        
                        </div>
                    <?php endwhile; wp_reset_postdata();  ?>

                <?php endif; ?>   
        </div>
	<?php }	
    
}