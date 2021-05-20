<?php
/**
 * Search & Filter Pro 
 *
 * Results Template TVS
 * 
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {	exit;}

if ( $query->have_posts() ){ 

    // template result products
    require_once(dirname(__FILE__).'/parts/result-products.php');
    
   // page navi
    if (function_exists('wp_pagenavi')) {
        wp_pagenavi( array( 'query' => $query ) ); 
    }
    
}
else {
	echo "<p class='DSMCA__not-found'> !No se encontraron productos! </p>";
}
?>