<?php
global $product;
$p_image_url = wp_get_attachment_image_url($product->get_image_id(), 'full');
$p_image_alt = get_post_meta($p_image_url, '_wp_attachment_image_alt', true);
?>
<div class="col">
    <div class="bg-holder">
        <a href="<?php the_permalink( $product->get_id() ); ?>" class="products-best-seller">
            <?php if ( ! empty( $p_image_url ) ) : ?>
                <div class="img-box">
                    <img src="<?php echo $p_image_url; ?>" alt="<?php echo $p_image_alt; ?>">
                </div>
            <?php endif; ?>
            <p class="product-name"><?php echo wp_trim_words( get_the_title(), 15 ); ?></p>
        </a>
        <div class="bottom-holder">
            <?php if ( $product->managing_stock() && ! $product->is_in_stock() ) :
                echo __( 'Sold', TEXT_DOMAIN );
            else:
                echo '<span class="price">' . $product->get_price_html() . '</span>';
            endif; ?>
            <?php woocommerce_quantity_input(
                array(
                    'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                    'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                    'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                )
            ); ?>
            <div class="bottom-box">
                <a href="<?php echo $product->add_to_cart_url() ?>"
                   value="<?php echo esc_attr($product->get_id()); ?>"
                   class="button single_add_to_cart_button add_to_cart_button ajax_add_to_cart"
                   data-quantity="<?php echo esc_attr(isset($quantity) ? $quantity : 1); ?>"
                   data-product_id="<?php echo get_the_ID(); ?>"
                   data-product_sku="<?php echo esc_attr($product->get_sku()) ?>"
                   aria-label="Add “<?php the_title_attribute() ?>” to your cart">
                    <?php _e('Add to cart', TEXT_DOMAIN); ?>
                </a>
            </div>
        </div>
    </div>
</div>