<?php
$best_seller_title = get_sub_field('best_seller_title');
$best_seller_subtitle = get_sub_field('best_seller_subtitle');
$best_seller_products = get_sub_field('best_seller_products'); //obj
$enable_seller_cart = get_sub_field('enable_seller_cart'); //last col
$best_seller_info = get_sub_field('best_seller_info');
$best_seller_btn = get_sub_field('best_seller_btn');
$best_seller_img = !empty(get_sub_field('best_seller_img')) ? get_sub_field('best_seller_img')['url'] : PATH_TO_FRONT . 'img/Cart-min.png';
$best_seller_title_h = get_query_var('blocks_counter') == 0 ? '<h1>' . $best_seller_title . '</h1>' : '<h2 class="h1">' . $best_seller_title . '</h2>';
?>
<section class="best-sellers">
    <div class="container">
        <?php if (!empty($best_seller_title)) : echo $best_seller_title_h; endif; ?>
        <?php if ( ! empty( $best_seller_subtitle ) ): ?>
            <p class="sub-text"><?php echo $best_seller_subtitle; ?></p>
        <?php endif; ?>
        <div class="three-columns wow fadeInLeftBig">
            <?php if ( !empty($best_seller_products) ) :
                foreach ( $best_seller_products as $post ) : // Must be called $post.
                    setup_postdata( $post );
                    get_template_part( 'blocks/products_seller_item' );?>
                <?php endforeach;
                wp_reset_postdata(); ?>
            <?php endif; ?>
            <?php if ( $enable_seller_cart == 1 ): ?>
            <div class="col">
                <div class="shop-banner">
                    <?php if ( ! empty( $best_seller_img ) ): ?>
                        <div class="img-holder">
                            <img src="<?php echo $best_seller_img; ?>" alt="cart-poster" />
                        </div>
                    <?php endif; ?>
                    <div class="shop-banner-text">
                        <?php if ( ! empty( $best_seller_info ) ): ?>
                            <p><?php echo $best_seller_info; ?></p>
                        <?php endif; ?>
                        <?php if ( ! empty( $best_seller_btn ) ): ?>
                            <a class="btn btn-shop"
                               href="<?php echo esc_url($best_seller_btn['url']); ?>"
                               target="<?php echo esc_attr(!empty($best_seller_btn['target']) ? $best_seller_btn['target'] : '_self'); ?>">
                                <?php echo esc_html($best_seller_btn['title']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>