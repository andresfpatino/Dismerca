<?php
/**
 * Search & Filter Pro 
 *
 * Results Template Puntos de venta
 * 
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {	exit;}

if ( $query->have_posts() ){ ?>
    <div class="DSMCA__puntos-venta">
   
        <?php while ($query->have_posts()){
            $query->the_post();  ?>

            <div class="DSMCA__punto">
                <div class="DSMCA__box-title">
                    <?php 
                    $ciudad = get_field('ciudad');
                    if( $ciudad ): ?>
                        <span class="DSMCA__ciudad-ptv"><?php echo esc_html( $ciudad->name ); ?></span>
                    <?php endif; ?>
                    <p class="DSMCA__nombre-ptv"> <?php the_title(); ?> </p>
                </div>

                <a class="DSMCA__view-more-ptv" href="<?php the_permalink();?>"><?php _e( 'Más información', 'DSMCA' ); ?></a>

                <?php if ( has_post_thumbnail() ) : $featured_img_url = get_the_post_thumbnail_url(get_the_ID()); ?>
                    <img src="<?php echo $featured_img_url; ?>"> 
                <?php else: ?>	
                    <img src="<?php echo get_site_url() . '/wp-content/uploads/placehold-pto-venta.png'; ?>"> 
                <?php endif; ?>	


            </div>	
            <?php
        }  wp_reset_postdata(); ?>
    </div>
<?php }
else {
	echo "<p class='DSMCA__not-found'> !No se encontraron puntos de venta! </p>";
}
?>