<?php

class My_Elementor_Widgets {

	protected static $instance = null;

	public static function get_instance() {
		if ( ! isset( static::$instance ) ) {
			static::$instance = new static;
		}
		return static::$instance;
	}

	protected function __construct() {
		require_once('widget_blog.php');
		require_once('widget_slide.php');
		require_once('widget_lanzamientos.php');
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}

	public function register_widgets() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Widget_blog() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Widget_slide() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Widget_lanzamientos() );
	}
}

function my_elementor_init() {
	My_Elementor_Widgets::get_instance();
}
add_action( 'init', 'my_elementor_init' );