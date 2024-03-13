<?php
define('TEXT_DOMAIN', 'growdirectorcom');
define('PATH_TO_INCLUDES', get_stylesheet_directory() . '/includes/');
define('PATH_TO_FRONT', get_stylesheet_directory_uri() . '/markup/build/');

include_once(PATH_TO_INCLUDES . 'cyr-to-lat.php');
include_once(PATH_TO_INCLUDES . 'enqueue.php');
include_once(PATH_TO_INCLUDES . 'languages.php');
include_once(PATH_TO_INCLUDES . 'menu.php');
include_once(PATH_TO_INCLUDES . 'post-views.php');
include_once(PATH_TO_INCLUDES . 'remove.php');
include_once(PATH_TO_INCLUDES . 'thumbnails.php');
include_once(PATH_TO_INCLUDES . 'users.php');
include_once(PATH_TO_INCLUDES . 'sidebars.php');
include_once(PATH_TO_INCLUDES . 'widgets.php');

/**
 * System
 */
add_theme_support('html5', ['script', 'style', 'search-form']);
/**
 * Add theme support for selective refresh for widgets.
 */
add_theme_support('customize-selective-refresh-widgets');

/**
 * Restore Classic Widgets
 */
function classic_widgets_support() {
    remove_theme_support('widgets-block-editor');
}

add_action('after_setup_theme', 'classic_widgets_support');

/**
 * Add logo in wp-admin
 */
function wp_admin_logo() {
    echo '<style>h1 a { background:url(' . PATH_TO_FRONT . 'img/logo-grow.svg) no-repeat center center !important; }</style>';
}

add_action('login_head', 'wp_admin_logo');

/**
 * Add logo in admin bar
 */
function wp_admin_bar_logo() {
    echo '<style>#wp-admin-bar-wp-logo .ab-icon::before{
		content: "" !important;
		background:url(' . PATH_TO_FRONT . 'img/logo-grow.svg) no-repeat center center;
		height: 20px;
		width: 25px;
		display: inline-block;
		}</style>';
    // Remove the media buttons from Product editor
    global $post;
    if(isset($post) && $post->post_type ==  'product'){
        remove_action( 'media_buttons', 'media_buttons' );
    }
}

add_action('admin_head', 'wp_admin_bar_logo');

/**
 * Acf options
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
}

/**
 * For tel:
 * @param $phone
 *
 * @return string|string[]|null
 */
function clean_phone($num) {
    return preg_replace("/[^0-9]/", "$1", $num);
}

/**
 * Check if current page is the Blog pages
 * @return bool
 */
function is_blog () {
    return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
}

/**
 * Remove tags support from posts
 */
function post_unregister_tags() {
    unregister_taxonomy_for_object_type('post_tag', 'post');
}

add_action('init', 'post_unregister_tags');

/**
 * Declare script for new TinyMCE Buttons
 *
 * @param $plugin_array
 *
 * @return mixed
 */
function declare_tinymce_plugin_custom_buttons( $plugin_array ) {
    $plugin_array['uppercase'] = get_template_directory_uri() . '/js/editor-tiny.js';
    $plugin_array['green_banner'] = get_template_directory_uri() . '/js/editor-tiny.js';
    $plugin_array['contact_icon'] = get_template_directory_uri() . '/js/editor-tiny.js';
    return $plugin_array;
}
/**
 * Register new TinyMCE Buttons
 *
 * @param $buttons
 *
 * @return mixed
 */
function register_tinymce_plugin_custom_buttons( $buttons ) {
    array_push( $buttons, 'uppercase' );
    array_push( $buttons, 'green_banner' );
    array_push( $buttons, 'contact_icon' );
    return $buttons;
}
/**
 * Adding the custom TinyMCE Button
 */
function add_tinymce_plugin_custom_buttons() {
    // check user permissions
    if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
        return;
    }
    // check if WYSIWYG is enabled
    if ( 'true' == get_user_option( 'rich_editing' ) ) {
        add_filter( 'mce_external_plugins', 'declare_tinymce_plugin_custom_buttons' );
        add_filter( 'mce_buttons', 'register_tinymce_plugin_custom_buttons' );
    }
}

add_action( 'admin_head', 'add_tinymce_plugin_custom_buttons' );

/**
 * Initialization of ACF Wysiwyg toolbars for TinyMCE Button
 */
function acf_toolbars( $toolbars ) {
    return array();
}
add_filter( 'acf/fields/wysiwyg/toolbars' , 'acf_toolbars'  );

/**
 * Shortcode for footer Copyright
 * @return false|string
 */
function current_year_shortcode() {
    $curr_year = date('Y');
    return $curr_year;
}
add_shortcode('current_year', 'current_year_shortcode');

/**
 * Banner app shortcode
 */
function banner_app_shortcode ( $atts, $content = null ) {
    $attributes = shortcode_atts(
        array(
            'color' => null,
        ),
        $atts
    );
    $app_slides = get_field('app_slides', 'option');
    $app_title = get_field('app_title', 'option');
    $app_subtitle = get_field('app_subtitle', 'option');
    $app_list_items = get_field('app_list_items', 'option');
    $app_links_title = get_field('app_links_title', 'option');
    $enable_app_links = get_field('enable_app_links', 'option');
    $app_store_ios_img = get_field('app_store_ios_img', 'option');
    $app_store_ios_link = get_field('app_store_ios_link', 'option');
    $app_store_android_img = get_field('app_store_android_img', 'option');
    $app_store_android_link = get_field('app_store_android_link', 'option');
    if ( ! empty( $attributes['color']) && $attributes['color'] == 'dark' ) {
        $app_color =  ' black-mode';
    } elseif ( ! empty( $attributes['color']) && $attributes['color'] == 'light' ) {
        $app_color =  '';
    } else {
        $app_color =  '';
    }
    ob_start(); ?>
    <section class="app-section fadeInUp wow animated<?php echo $app_color; ?>">
        <div class="container">
            <div class="bg-holder">
                <?php if (!empty($app_slides)): ?>
                    <div class="img-holder">
                        <div class="app-slider-holder">
                            <div class="app-img-slider">
                            <?php foreach ($app_slides as $app_slide):
                                $app_slide = $app_slide['url'];
                                if (!empty($app_slide)): ?>
                                    <div>
                                        <img src="<?php echo $app_slide; ?>"
                                             alt="<?php echo !empty($app_slide['alt']) ? $app_slide['alt'] : ''; ?>"/>
                                    </div>
                                <?php endif;
                            endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="text-holder">
                    <h2 class="h1"><?php echo !empty($app_title) ? $app_title : __('GrowDirector app', TEXT_DOMAIN); ?></h2>
                    <?php if (!empty($app_subtitle)): ?>
                        <p class="slogan"><?php echo $app_subtitle; ?></p>
                    <?php endif; ?>
                    <?php if (!empty($app_list_items)): ?>
                        <ul class="check-list">
                            <?php foreach ($app_list_items as $a_item):
                                $app_list_item = $a_item['app_list_item']; ?>
                                <li>
                                    <?php echo $app_list_item; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <?php if ($enable_app_links == 1): ?>
                        <?php if (!empty($app_links_title)): ?>
                            <p class="bottom-text"><span><?php echo $app_links_title; ?></span></p>
                        <?php endif; ?>
                        <div class="btn-holder">
                            <?php if (!empty($app_store_ios_link)): ?>
                                <a class="app-store"
                                   href="<?php echo esc_url($app_store_ios_link); ?>"
                                   target="_blank">
                                    <img src="<?php echo !empty($app_store_ios_img['url']) ? $app_store_ios_img['url'] : PATH_TO_FRONT . 'img/appStore.svg'; ?>"
                                         alt="<?php echo !empty($app_store_ios_img['alt']) ? $app_store_ios_img['alt'] : 'ios store'; ?>"/>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($app_store_android_link)): ?>
                                <a class="google-play"
                                   href="<?php echo esc_url($app_store_android_link); ?>"
                                   target="_blank">
                                    <img src="<?php echo !empty($app_store_android_img['url']) ? $app_store_android_img['url'] : PATH_TO_FRONT . 'img/googlePlay.svg'; ?>"
                                         alt="<?php echo !empty($app_store_android_img['alt']) ? $app_store_android_img['alt'] : 'google play'; ?>"/>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php return
        ob_get_clean();
}
add_shortcode('banner_app', 'banner_app_shortcode');

/**
 * Banner ML shortcode
 */
function banner_ml_shortcode ( $atts = null, $content = null ) {
    $ml_title = get_field('ml_title', 'option');
    $ml_img = get_field('ml_img', 'option');
    $ml_list_items = get_field('ml_list_items', 'option');
    ob_start();
    ?>
    <section class="section-ml" style="background-image: url('<?php echo !empty($ml_img) ? $ml_img['url'] : PATH_TO_FRONT . 'img/hand.png'; ?>');">
        <div class="container">
            <div class="bg-holder">
                <h2 class="h1"><?php echo !empty($ml_title) ? $ml_title : __('Machine learning', TEXT_DOMAIN); ?></h2>
                <?php if ( ! empty( $ml_list_items ) ): ?>
                    <ul class="check-list">
                        <?php foreach ($ml_list_items as $ml_item):
                            $ml_list_item = $ml_item['ml_list_item']; ?>
                            <li>
                                <?php echo $ml_list_item; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php return
        ob_get_clean();
}
add_shortcode('banner_ml', 'banner_ml_shortcode');

/**
 * Banner Consultation form shortcode
 */
function banner_consultation_shortcode ( $atts = null, $content = null ) {
    $consultation_title = get_field('consultation_title', 'option');
    $consultation_subtitle = get_field('consultation_subtitle', 'option');
    $consultation_info = get_field('consultation_info', 'option');
    $consultation_form = get_field('consultation_form', 'option'); //id
    ob_start();
    ?>
    <section class="consultation-form">
        <div class="container">
            <div class="text-holder">
                <h2 class="h1"><?php echo !empty($consultation_title) ? $consultation_title : __('Consultation needed?', TEXT_DOMAIN); ?></h2>
                <?php
                echo !empty($consultation_subtitle) ? '<p class="slogan">' . $consultation_subtitle . '</p>' : '';
                echo $consultation_info; ?>
            </div>
            <div class="form-holder">
                <?php echo !empty($consultation_form) ? do_shortcode( '[contact-form-7 id="' . $consultation_form[0] . '" html_class="form-consultation"]' ) : '';?>
            </div>
        </div>
    </section>
    <?php return
        ob_get_clean();
}
add_shortcode('banner_consultation', 'banner_consultation_shortcode');

/**
 * Remove Contact Form 7 autop tags
 */
add_filter( 'wpcf7_autop_or_not', '__return_false' );

/*
=====================
**** WooCommerce ****
=====================
*/
/**
 * Disable WooCommerce stylesheets
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Declaring WooCommerce templates support
 */
function add_woocommerce_support() {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'add_woocommerce_support');

/**
 * Create Shortcode for WooCommerce Cart Menu Item
 */
function woo_cart_but() {
    ob_start();
    $cart_count = WC()->cart->get_cart_contents_count(); // Set variable for cart item count
    $cart_url = wc_get_cart_url();  // Set Cart URL?>
    <a class="cart-contents menu-item" href="<?php echo $cart_url; ?>" title="<?php _e('Basket', TEXT_DOMAIN); ?>">
        <span class="item-holder">
            <span><?php _e('Your cart', TEXT_DOMAIN); ?></span>
            <span class="item-counter"><?php echo $cart_count; ?> <?php _e('items', TEXT_DOMAIN); ?></span>
        </span>
        <i class="icon-cart"></i>
        <?php //if ( $cart_count > 0 ) { ?>
        <span class="counter"><?php echo $cart_count; ?></span>
        <?php //} ?>
    </a>
    <?php return ob_get_clean();
}
add_shortcode('woo_cart_but', 'woo_cart_but');
/**
 * Add AJAX Shortcode when cart contents update
 */
function woo_cart_but_count($fragments) {
    ob_start();
    $cart_count = WC()->cart->get_cart_contents_count();
    $cart_url = wc_get_cart_url(); ?>
    <div class="custom-cart">
        <a class="cart-contents menu-item" href="<?php echo $cart_url; ?>"
           title="<?php _e('View your shopping cart', TEXT_DOMAIN); ?>">
            <span class="item-holder">
                <span><?php _e('Your cart', TEXT_DOMAIN); ?></span>
                <span class="item-counter"><?php echo $cart_count; ?> <?php _e('items', TEXT_DOMAIN); ?></span>
            </span>
            <i class="icon-cart"></i>
            <?php //if ( $cart_count > 0 ) { ?>
            <span class="counter"><?php echo $cart_count; ?></span>
            <?php //} ?>
        </a>
    </div>
    <?php $fragments['a.cart-contents'] = ob_get_clean();

    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'woo_cart_but_count');
/**
 * Update Cart Count After AJAX for mobile nav-opener
 * @param $fragments
 * @return mixed
 */
function mobile_opener_cart_count_fragments($fragments) {
    $fragments['div.mobile-cart-count'] = '<div class="mobile-cart-count">' . WC()->cart->get_cart_contents_count() . '</div>';

    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'mobile_opener_cart_count_fragments', 10, 1);

/**
 * Replacement woo items
 * @return void
 */
function unregister_woo() {
    // Remove breadcrumbs
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
    // Remove "Default Sorting" Dropdown WooCommerce Shop & Archive Pages
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
    // Remove cross-sells at cart
    remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
    // Remove default woocommerce sidebar
    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    // Remove Shop page result count
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    // Remove single product title
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5  );
    // Remove the price and price range from a single product and added to simple.php
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10  );
    // Remove short description and added to simple.php
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
    // Remove meta single product
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
    // Remove related products output
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
    // Remove product tabs title
    add_filter('woocommerce_product_description_heading', '__return_null');
    add_filter('woocommerce_product_additional_information_heading', '__return_null');
    // Remove product count from attributes
    add_filter( 'woocommerce_layered_nav_count', '__return_null' );
    // Remove sale badge
    add_filter('woocommerce_sale_flash', '__return_null');
    // Remove shop page product links
    //remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
    //remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
}
add_action('init', 'unregister_woo');

/*
==============
**** Shop ****
==============
*/

/**
 * Exclude 'kit' products from shop page
 */
function custom_pre_get_posts_query( $q ) {

    if( (is_shop() || is_page('shop')) && !is_filtered() ) {
        $tax_query = (array) $q->get( 'tax_query' );
        $tax_query[] = array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => array( 'kit' ), // Don't display products in the category on the shop page.
            'operator' => 'NOT IN'
        );
        $q->set( 'tax_query', $tax_query );
    }
}
add_action( 'woocommerce_product_query', 'custom_pre_get_posts_query' );

/**
 * Change number of products that are displayed per page (shop page)
 */
function new_loop_shop_per_page( $cols ) {
    $cols = 20;
    return $cols;
}
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

/** Add custom product description after title
 * @return void
 */
//function woocommerce_shop_loop_item_subtitle() {
//    global $product;
//    $short_description = apply_filters( 'woocommerce_short_description', $product->get_short_description() );
//    if( ! empty($short_description) && is_product_category() || is_shop() ){
//        echo '<div class="product-item-description">' . $short_description . '</div>';
//    }
//
//}
//add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_shop_loop_item_subtitle', 2 );

/**
 * Add wrapper to Loop Product Thumbs
 **/
if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
    function woocommerce_template_loop_product_thumbnail() {
        echo '<div class="products-img">';
        echo woocommerce_get_product_thumbnail();
        echo '</div>';
    }
}
// Remove loop_item_title for wrapper
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

/**
 *  Shop add cart quantity Ajax and price inside wrapper
 * @param $html
 * @param $product
 * @return mixed|string
 */
function quantity_inputs_for_loop_ajax_add_to_cart($html, $product) {
    if ($product && $product->is_purchasable() && $product->is_in_stock() && !$product->is_sold_individually()) {
        // Get the necessary classes
        $quantity_input = $product->is_type('simple') && !is_product() ? woocommerce_quantity_input(array(), $product, false) : ''; // hide on single sliders
        $class = implode(' ', array_filter(array(
            'button',
            'product_type_' . $product->get_type(),
            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
            $product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '',
        )));
        // Embedding the quantity field to Ajax add to cart button
        $html = sprintf('<div class="bottom-holder"><span class="price">' . $product->get_price_html() . '</span>%s
                     <div class="bottom-box"><a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s' . $product->add_to_cart_text() . '</a></div></div>',
            $quantity_input,
            esc_url($product->add_to_cart_url()),
            esc_attr(isset($quantity) ? $quantity : 1),
            esc_attr($product->get_id()),
            esc_attr($product->get_sku()),
            esc_attr(isset($class) ? $class : 'button'),
            isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
            //esc_html($product->add_to_cart_text())
        );
    }
    return $html;
}

// Remove product price from the loop
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
add_filter('woocommerce_loop_add_to_cart_link', 'quantity_inputs_for_loop_ajax_add_to_cart', 10, 2);

/*
=================
**** Product ****
=================
*/
/**
 * Remove Admin tabs from woocommerce product data
 * @param $tabs
 * @return mixed
 */
function remove_product_tab($tabs){
    unset($tabs['inventory']);
    return($tabs);
}
add_filter('woocommerce_product_data_tabs', 'remove_product_tab', 10, 1);

/**
 * Remove Admin Product Data dropdown options and left Simple product
 *
 * @param $types
 *
 * @return mixed
 */
function remove_product_types($types) {
    unset($types['grouped']);
    unset($types['external']);

    return $types;
}
add_filter('product_type_selector', 'remove_product_types');

/**
 * Remove Admin Virtual and Downloadable checkboxes from the Product Data
 * @param $options
 * @return mixed
 */
function remove_product_types_options( $options ) {
    // remove "Virtual" checkbox
    if( isset( $options[ 'virtual' ] ) ) {
        unset( $options[ 'virtual' ] );
    }
    // remove "Downloadable" checkbox
    if( isset( $options[ 'downloadable' ] ) ) {
        unset( $options[ 'downloadable' ] );
    }
    return $options;
}
add_filter('product_type_options', 'remove_product_types_options');

/**
 *  Remove Admin ProductS type Filter
 * @param $filters
 * @return mixed
 */
function remove_products_admin_filters ( $filters ) {
    // remove "product_type" select
    if( isset( $filters[ 'product_type' ] ) ) {
        unset( $filters[ 'product_type' ] );
    }
    // remove "stock_status" inventory select
    if( isset( $filters[ 'stock_status' ] ) ) {
        unset( $filters[ 'stock_status' ] );
    }
    return $filters;
}
add_filter('woocommerce_products_admin_list_table_filters', 'remove_products_admin_filters');

/**
 * Hide Product tags
 * @return void
 */
function hide_product_tags_admin_menu() {
    remove_submenu_page( 'edit.php?post_type=product', 'edit-tags.php?taxonomy=product_tag&amp;post_type=product' );
    remove_meta_box( 'tagsdiv-product_tag', 'product', 'side' );
}
add_action( 'admin_menu', 'hide_product_tags_admin_menu', 9999 );
// admin column
function unset_columns_in_product_list( $column_headers ) {
    unset($column_headers['product_tag']);
    return $column_headers;
}
add_filter( 'manage_edit-product_columns', 'unset_columns_in_product_list' );

/**
 * Add Custom Fields to Product
 */
function woocommerce_product_custom_fields() {
    echo '<div class="product_custom_subtitle">';
    // Text Field
    woocommerce_wp_text_input(
        array(
            'id' => '_custom_product_subtitle',
            'label' => __('Subtitle price (optional)', 'woocommerce'),
            'desc_tip' => 'true'
        )
    );
    echo '</div>';
}
add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_custom_fields');
//Save Custom Fields
function woocommerce_product_custom_fields_save($post_id) {
    // Custom Product Text Field
    $product = wc_get_product($post_id);
    $custom_product_subtitle_field = isset($_POST['_custom_product_subtitle']) ? $_POST['_custom_product_subtitle'] : '';
    $product->update_meta_data('_custom_product_subtitle', sanitize_text_field($custom_product_subtitle_field));
    $product->save();

}
add_action('woocommerce_process_product_meta', 'woocommerce_product_custom_fields_save');

/**
 * Change price range for more than one active variation
 * @param $price
 * @param $product
 * @return mixed|null
 */
function change_variable_products_price_display($price, $product) {
    // Variable products only
    if (!$product->is_type('variable')) return $price;
    $prices = $product->get_variation_prices(true);
    if (empty($prices['price']))
        return apply_filters('woocommerce_variable_empty_price_html', '', $product);
    $min_price = current($prices['price']);
    $max_price = end($prices['price']);
    $prefix_html = '<span class="price-prefix">' . __( 'From:', TEXT_DOMAIN ) . '</span>';
    $prefix = $min_price !== $max_price ? $prefix_html : ''; // HERE the prefix

    return apply_filters('woocommerce_variable_price_html', $prefix . wc_price($min_price) . $product->get_price_suffix(), $product);
}

add_filter('woocommerce_get_price_html', 'change_variable_products_price_display', 10, 2);

/**
 * Change "Choose an option" from variable product options
 * @param $args
 * @return mixed
 */
function filter_dropdown_option_html( $html, $args ) {
    $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __( 'Choose an option', 'woocommerce' );
    $show_option_none_html = '<option value="">' . esc_html( $show_option_none_text ) . '</option>';

    $html = str_replace($show_option_none_html, '', $html);

    return $html;
}
add_filter( 'woocommerce_dropdown_variation_attribute_options_html', 'filter_dropdown_option_html', 12, 2 );
// disable the reset variation button on variable products
add_filter('woocommerce_reset_variations_link', '__return_empty_string');

/**
 * Move variable price after_add_to_cart_button
 * @return void
 */
function shuffle_variable_product_elements(){
    if ( is_product() ) {
        global $post;
        $product = wc_get_product( $post->ID );
        if ( $product->is_type( 'variable' ) ) {
            remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
            add_action( 'woocommerce_after_add_to_cart_button', 'woocommerce_single_variation', 20 );

        }
    }
}
add_action( 'woocommerce_before_single_product', 'shuffle_variable_product_elements' );

/**
 * Add subtitle to single product
 * @return void
 */
function woocommerce_single_item_subtitle() {
    the_title( '<h1 class="product_title entry-title">', '</h1>' );
    // Display _custom_product_subtitle field
    global $product;
    $short_description = apply_filters( 'woocommerce_short_description', $product->get_short_description() );
        if( ! empty($short_description) ){
        echo '<div class="product_subtitle">' . $short_description . '</div>';
    }

}
add_action( 'woocommerce_single_product_summary', 'woocommerce_single_item_subtitle', 5 );

/**
 * Change 'add to cart' to product
 * @return string|null
 */
function woocommerce_add_to_cart_button_text_single() {
    return __( 'BUY NOW', TEXT_DOMAIN );
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_add_to_cart_button_text_single' );

/**
 * Change order up-sell products.
 */
function order_upsell_products() {
    global $product;
    if (isset($product) && is_product()) {
        $upsells = $product->get_upsell_ids();
        if (!empty($upsells) && count($upsells) > 0) {
            woocommerce_upsell_display();
        }
    }
}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_product_after_tabs', 'order_upsell_products', 15 );
// Change Up-sells output args
function change_number_upsell_products( $args ) {
    $args['posts_per_page'] = 12;
    $args['orderby'] = 'menu_order';
    $args['order'] = 'asc';
    return $args;
}
add_filter( 'woocommerce_upsell_display_args', 'change_number_upsell_products', 20 );
// Change Up-sell title
function db_change_upsell_title_text() {
    return __('With this product buy', TEXT_DOMAIN);
}
add_filter( 'woocommerce_product_upsells_products_heading', 'db_change_upsell_title_text' );

/**
 * Change information tabs
 * @param $tabs
 * @return mixed
 */
function remove_information_tabs( $tabs ) {
    global $product;
    // hide empty additional_information
    if ($product -> has_attributes() || $product -> has_dimensions() || $product -> has_weight()) {
        $tabs['additional_information']['title'] = __('Specification', TEXT_DOMAIN);
    }
    unset($tabs['additional_information']);
    unset($tabs['reviews']);
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'remove_information_tabs', 100, 1 );

/**
 * Product after tabs acf: Ml banner
 */
function single_product_after_tabs() {
    global $product;
    $product_id = $product->get_id();
    $enable_banner_ml = get_field( 'enable_banner_ml', $product_id );
    $under_description_img = get_field( 'under_description_img', $product_id );
    $under_description_img_url = !empty($under_description_img) ? $under_description_img['url'] : PATH_TO_FRONT . 'img/under-description-img.jpg';
    $under_description_img_alt = !empty($under_description_img) ? $under_description_img['alt'] : 'description-image';
    if( !empty($under_description_img_url) ){
        echo '<div class="under-description-img"><img src="' . $under_description_img_url . '" alt="' . $under_description_img_alt . '"/></div>';
    }
    if( $enable_banner_ml == 1 ){
        echo do_shortcode('[banner_ml]');
    }
}
add_action( 'woocommerce_after_single_product_summary', 'single_product_after_tabs', 12 );

/**
 * Change Related products output args
 *
 * @param $args
 *
 * @return mixed
 */
function change_number_related_products($args) {
    $args['posts_per_page'] = 9;
    $args['orderby'] = 'menu_order';
    $args['order'] = 'asc';
    return $args;
}
add_filter('woocommerce_output_related_products_args', 'change_number_related_products', 20);
// Change Related products query
function related_products_by_attribute( $related_posts, $product_id ) {
    $product_taxonomy   = 'product_cat';
    $product_term_slugs = wc_get_product_terms( $product_id, $product_taxonomy, ['fields' => 'slugs'] );
    if ( empty($product_term_slugs) )
        return $related_posts;
    $related_ids = get_posts( array(
        'post_type'            => 'product',
        'ignore_sticky_posts'  => 1,
        'post__not_in'         => array( $product_id ),
        'tax_query'            => array( array(
            'taxonomy' => $product_taxonomy,
            'field'    => 'slug',
            'terms'    => $product_term_slugs,
        ) ),
        'fields'  => 'ids',
    ) );

    return count($related_ids) > 0 ? $related_ids : $related_posts;
}
add_filter( 'woocommerce_related_products', 'related_products_by_attribute', 10, 3 );

/**
 * Product acf: App banner, Related products, Form
 */
function single_product_after_related() {
    global $product;
    $product_id = $product->get_id();
    $enable_banner_app = get_field( 'enable_banner_app', $product_id );
    $enable_banner_consultation = get_field( 'enable_banner_consultation', $product_id );
    if( is_product() ) {
        // Output the related products
        woocommerce_output_related_products();
        // App banner
        if ($enable_banner_app == 1) {
            echo do_shortcode('[banner_app color="dark"]');
        }
        // Consultation banner
        if ($enable_banner_consultation == 1) {
            echo do_shortcode('[banner_consultation]');
        }
    }
}
add_action( 'woocommerce_after_main_content', 'single_product_after_related', 10, 0 );

/*
=========================
**** Cart & Checkout ****
=========================
*/
/**
 * Add Shop Button on Cart Page
 */
function add_back_to_shopp_button() {
    $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
    echo '<div class="back-to-shop"><a href="'.$shop_page_url.'" class="btn btn-default">' . __('Back to shopping', TEXT_DOMAIN) . '</a></div>';
}
add_action( 'woocommerce_proceed_to_checkout', 'add_back_to_shopp_button' );

/**
 * Change text on order button
 */
function wc_custom_order_button_text() {
    return __( 'Pay with your credit card', TEXT_DOMAIN );
}
add_filter( 'woocommerce_order_button_text', 'wc_custom_order_button_text' );

/**
 * Custom Note on Checkout
 * @return void
 */
function wooassist_custom_note() {
    echo '<p class="delivery-terms">' . __( 'Your order will be shipped within two month', TEXT_DOMAIN ) . '</p>';
}
add_action('woocommerce_review_order_before_payment','wooassist_custom_note');