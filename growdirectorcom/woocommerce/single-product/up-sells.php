<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}
global $product;
//if ($upsells) : ?>

    <section class="up-sells upsells products">
        <?php // the check has been moved from above in case of absence of upsells but the presence of a banner
        if ($upsells) :
            $heading = apply_filters('woocommerce_product_upsells_products_heading', __('You may also like&hellip;', 'woocommerce'));
            if ($heading) :
                ?>
                <h2><?php echo esc_html($heading); ?></h2>
            <?php endif; ?>

            <?php woocommerce_product_loop_start(); ?>

            <?php foreach ($upsells as $upsell) : ?>

            <?php
            $post_object = get_post($upsell->get_id());

            setup_postdata($GLOBALS['post'] =& $post_object); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

            wc_get_template_part('content', 'product');
            ?>

        <?php endforeach; ?>
            <?php woocommerce_product_loop_end();
            // the check has been moved from above in case of absence of upsells but the presence of a banner
        endif; ?>

        <?php // added additional banner
        $under_upsell_img = get_field('under_upsell_img', $product->get_id());
        if (!empty($under_upsell_img)): ?>
            <div class="socket-list-holder">
                <div class="img-box">
                    <img src="<?php echo $under_upsell_img['url']; ?>" alt="<?php echo $under_upsell_img['alt']; ?>"/>
                </div>
            </div>
        <?php endif; ?>
    </section>

<?php
// endif;
wp_reset_postdata();