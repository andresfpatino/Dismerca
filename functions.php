<?php

// Disable Gutemberg
add_filter('use_block_editor_for_post', '__return_false', 10);

// Disable scripts emoji
require_once(dirname(__FILE__).'/functions/disable_scripts_emoji.php');

// Style - Scripts 
require_once(dirname(__FILE__).'/functions/wp_enqueue_scripts.php');

// Custom widgets elementor
require_once(dirname(__FILE__).'/custom_widgets/init_widgets.php');


// Change WooCommerce "Related products" text
function change_rp_text($translated, $text, $domain){
    if ($text === 'Related products' && $domain === 'woocommerce') {
        $translated = esc_html__('Vehículos relacionados', $domain);
    }
    return $translated;
}
add_filter('gettext', 'change_rp_text', 10, 3);
add_filter('ngettext', 'change_rp_text', 10, 3);


// Plugin update YITH WooCommerce Compare 
function filter_plugin_updates( $value ) {
    unset( $value->response['yith-woocommerce-compare-premium/init.php'] );
    return $value;
}
add_filter( 'site_transient_update_plugins', 'filter_plugin_updates' );

// Get brand in single product
function logo_marca(){
    global $product;
    $terms = get_the_terms( $product->ID, 'marca');
    foreach ( $terms as $term ) { 
        $logoMarca = get_field('logo_archive', $term);
        $Brandslug = $term->slug; 
    }	?>
    <a href="<?php echo get_term_link( $Brandslug, 'marca' ) ?>">
        <img class="DSMCA__brand-single" src="<?php echo esc_url($logoMarca['url']); ?>" alt="<?php echo esc_attr($logoMarca['alt']); ?>" />
    </a>      
<?php
}
add_shortcode( 'logo-marca', 'logo_marca' );


// Hide add to cart button
function remove_add_to_cart_button($product){  
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart');
    remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
}
add_action('init','remove_add_to_cart_button');


// Modify loop products 
function woo_add_acf_brand(){
    global $product; 
    $terms = get_the_terms($product->ID, 'marca');
    foreach ($terms as $term) {
      $marca = $term->name;
        echo '<span class="brand">' . $marca . '</span>';           
    }
}
add_action( 'woocommerce_shop_loop_item_title', 'woo_add_acf_brand', 2 );

function woo_add_acf_price(){
    $precio = get_field('precio_custom');
    echo '<div class="custom_price">';
        if( $precio && !empty($precio) ) {
            echo '$ ' . $precio;
        }
    echo '</div>';
}
add_action( 'woocommerce_after_shop_loop_item', 'woo_add_acf_price', 2 );


// Disable default  gallery woocommerce
function gallery_products(){
    global $product;
    $imageProduct = wp_get_attachment_image_src( get_post_thumbnail_id( $product->post->ID ), 'full' );	
    $attachment_ids = $product->get_gallery_attachment_ids(); 

    if (!empty($imageProduct)) : ?>
        <div class="DSMCA__gallery-products">
            <div class="slider-for">
                <img src="<?php echo $imageProduct[0] ?> " class="attachment-full size-full" loading="lazy">
                <?php foreach( $attachment_ids as $attachment_id ) { 
                    echo wp_get_attachment_image($attachment_id, 'full'); 
                } ?>
            </div>

            <div class="slider-nav">
                <img src="<?php echo $imageProduct[0] ?> " class="attachment-full size-full" loading="lazy">
                <?php foreach( $attachment_ids as $attachment_id ) { 
                    echo wp_get_attachment_image($attachment_id, 'full'); 
                } ?>
            </div>
        </div> 
    <?php  else: ?>
        <img src=" <?php echo get_site_url() . '/wp-content/uploads/placehold-products.png' ?> " class="attachment-full size-full" loading="lazy">
    <?php endif ;
} 

add_shortcode( 'galeria-productos', 'gallery_products' );


// Remove product tabs
add_filter( 'woocommerce_product_data_tabs', 'custom_product_data_tabs' ); 
function custom_product_data_tabs( $tabs ) {
    unset( $tabs['general'] );
    unset( $tabs['inventory'] );
    unset( $tabs['shipping'] );
    unset( $tabs['linked_product'] );
    unset( $tabs['advanced'] );
  return $tabs;
}

// function remove_zoom_gallery_support() { 
//     remove_theme_support( 'wc-product-gallery-zoom' );
//     remove_theme_support( 'wc-product-gallery-lightbox' );
// }
// add_action( 'init', 'remove_zoom_gallery_support', 99 );
