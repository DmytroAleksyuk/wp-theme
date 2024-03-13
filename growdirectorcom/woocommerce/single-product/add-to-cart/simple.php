<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
        <?php // Added form elements holder and row ?>
        <div class="bottom-holder">
            <div class="row">
                <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
                <?php
                do_action( 'woocommerce_before_add_to_cart_quantity' );
                woocommerce_quantity_input(
                    array(
                        'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                        'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                        'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                    )
                );
                do_action( 'woocommerce_after_add_to_cart_quantity' );
                /**
                 * Added from price.php and short-description.php
                 */?>
                <p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></p>

            </div>
            <?php
            // /row
            // Added form elements row ?>
            <?php $custom_subtitle = get_post_meta($product->get_id(), '_custom_product_subtitle', true);
            if (!empty($custom_subtitle)) {
                echo '<div class="row"><div class="woocommerce-product-details__short-description">' . $custom_subtitle . '</div></div>';
            } ?>
            <?php
            // /row
            // Added form elements row ?>
            <div class="row">
                <?php // Change default btn to a.ajax_add_to_cart
                /**
                <button type="submit" name="add-to-cart"
                        value="<?php echo esc_attr( $product->get_id() ); ?>"
                        class="single_add_to_cart_button button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>">
                    <?php echo esc_html( $product->single_add_to_cart_text() ); ?>
                </button>
                */ ?>
                    <a href="<?php echo $product->add_to_cart_url() ?>"
                       value="<?php echo esc_attr($product->get_id()); ?>"
                       class="button single_add_to_cart_button add_to_cart_button ajax_add_to_cart"
                       data-quantity="<?php echo esc_attr(isset($quantity) ? $quantity : 1); ?>"
                       data-product_id="<?php echo get_the_ID(); ?>"
                       data-product_sku="<?php echo esc_attr($product->get_sku()) ?>"
                       aria-label="Add “<?php the_title_attribute() ?>” to your cart">
                        <?php echo esc_html($product->single_add_to_cart_text()); ?>
                    </a>
                <?php // Add cards images ?>
                <div class="payment-icons">
                    <img src="<?php echo PATH_TO_FRONT . 'img/Mastercard.svg'; ?>"
                         alt="master">
                    <img src="<?php echo PATH_TO_FRONT . 'img/Visa.svg'; ?>"
                         alt="visa">
                    <img src="<?php echo PATH_TO_FRONT . 'img/PayPal.svg'; ?>"
                         alt="paypal">
                    <span class="payment-icons-text"><?php _e('Pay by card', TEXT_DOMAIN);?></span>
                </div>
                <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
            </div>
            <?php // /bottom-holder ?>
        </div>
        <?php // /row ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>