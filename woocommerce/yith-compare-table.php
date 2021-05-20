<?php
/**
 * Woocommerce Compare page
 *
 * @author  Your Inspiration Themes
 * @package YITH Woocommerce Compare
 * @version 1.1.4
 */

defined( 'YITH_WOOCOMPARE' ) || exit; // Exit if accessed directly.

global $product, $yith_woocompare; ?>

<div id="yith-woocompare" class="woocommerce">

	<?php 
        if ( empty( $products ) ) :
            echo '<p>' . esc_html( apply_filters( 'yith_woocompare_empty_compare_message', __( 'No products added in the comparison table.', 'yith-woocommerce-compare' ) ) ) . '</p>';
        else : 

		do_action( 'yith_woocompare_before_main_table', $products, $fixed ); ?>

		<table id="yith-woocompare-table" class="compare-list <?php if ( empty( $products ) ) { echo 'empty-list'; } ?> ">

			<tbody>

                <?php foreach ( $fields as $field => $name ) : ?>

                    <tr class="compare-row">

                        <?php
                            $index = 0;
                            foreach ( $products as $product_id => $product ) : ?>

                            <td class="compare-cell">
                                <?php
                                    switch ( $field ) {

                                        case 'product_info':                                           
                                                echo '<div class="remove"><a href="' . esc_url( $yith_woocompare->obj->remove_product_url( $product_id ) ) . '" data-iframe="' . esc_attr( $iframe ) . '" data-product_id="' . esc_attr( $product_id ) . '"><span class="remove">' . wp_kses_post( apply_filters( 'yith_woocompare_remove_icon', 'x' ) ) . '</span>' . wp_kses_post( apply_filters( 'yith_woocompare_remove_label', esc_html__( 'Remove', 'yith-woocommerce-compare' ) ) ) . '</a></div>';
                                                echo '<a href="' . esc_attr( $product->get_permalink() ) . '">';                                                    
                                                        echo '<div class="image-wrap">' . $product->get_image( 'yith-woocompare-image' ) . '</div>'; 
                                                echo '</a>';
                                                echo '<h2 class="product_title">' . esc_html( $product->get_title() ) . '</h2>';                                               
                                        default:
                                            echo '<h5 class="label">' . esc_html( $name ) . '</h5>';
                                            echo empty( $product->fields[ $field ] ) ? '<p class="empty-value">-</p>' : '<p class="value">' . do_shortcode( $product->fields[ $field ] ) . '</p>';  
                                        break;
                                    } 
                                ?>
                            </td>
                            <?php ++ $index;
                            endforeach
                        ?>
                    </tr>
                <?php endforeach; ?>

                <tfoot class="compare-row">
                    <tr>
                        <?php foreach ( $products as $product_id => $product ) : ?>
                            <td class="compare-cell">  <a class="elementor-button-link elementor-button" href=" <?php echo esc_attr( $product->get_permalink() ); ?> "> Lo quiero </a>  </td>
                        <?php endforeach; ?>
                    </tr>
                </tfoot>
                
			</tbody>

		</table>

		<?php do_action( 'yith_woocompare_after_main_table', $products, $fixed ); ?>

	<?php endif; ?>

</div>