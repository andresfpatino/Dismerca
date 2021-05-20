<div class="DSMCA__product-result">
   
   <?php while ($query->have_posts()) : $query->the_post() ;  ?>

       <div class="DSMCA__producto">

           <a href="<?php the_permalink();?>">
               <div class="DSMCA__wrap-thumbnail">
                   <?php if ( has_post_thumbnail() ) : $featured_img_url = get_the_post_thumbnail_url(get_the_ID()); ?>
                       <img src="<?php echo $featured_img_url; ?>"> 
                   <?php else: ?>	
                       <img src="<?php echo get_site_url() . '/wp-content/uploads/placehold-products.png'; ?>"> 
                   <?php endif; ?>	

                   <?php $promocion = get_field( 'en_promocion' ); ?>
                   <?php if ( $promocion == 'si' ) : ?>
                       <div class="DSMCA__label-sale"> <?php _e( 'Promoción', 'DSMCA' ); ?>  </div>
                   <?php endif; ?>
               </div>

               <?php
                   $terms = get_the_terms($query->ID, 'marca');
                   foreach ($terms as $term) {
                   $marca = $term->name;
                       echo '<div class="DSMCA__brand">' . $marca . '</div>';           
                   } 
               ?>

               <h4 class="DSMCA__product-title"><?php the_title(); ?> </h4>
               <?php $precio = get_field('precio_custom'); ?> 
               <div class="DSMCA__custom_price"> $ <?php echo $precio ?> </div>
           </a>
       </div> <?php
   endwhile;  wp_reset_postdata(); ?>
</div> 