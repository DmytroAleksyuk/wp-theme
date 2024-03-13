<?php
/**
 * Enable scripts
 */
function load_assets() {
	if ( ! is_admin() ) {
		// CSS
		// Loads our main stylesheet.
		wp_enqueue_style( 'default-theme-style', get_stylesheet_uri(), array() );
		// Main front font
		wp_enqueue_style( 'main-theme-font', PATH_TO_FRONT . 'css/fonts.css', array() );
        // Main front css
		wp_enqueue_style( 'main-theme-style', PATH_TO_FRONT . 'css/main.css', array() );
		// JS
        // remove core jquery and enabled 3.6.3 (in case of conflicts comment this 3 lines)
        wp_deregister_script('jquery');
        wp_register_script('jquery', PATH_TO_FRONT . 'js/jquery-3.6.0.min.js', array(), '', true);
        wp_enqueue_script('jquery');
        // jquery (in case of conflicts enable front 3.6.3)
        //wp_enqueue_script( 'jquery-script', 'https://code.jquery.com/jquery-3.6.3.min.js', array('jquery'), '', $in_footer );
        // Main front js
        wp_enqueue_script('main-theme-script', PATH_TO_FRONT . 'js/main.js', array(), '', true);
	}
    if ( is_admin() ) {
        // admin editor
        wp_enqueue_script('admin-theme-script', get_template_directory_uri() . '/js/editor-tiny.js', array( 'jquery' ), '', true);
    }
}

add_action( 'wp_enqueue_scripts', 'load_assets' );

/**
 * Clean default js
 * @param $input
 *
 * @return mixed
 */
function clean_script_tag($input) {
    $input = str_replace("type='text/javascript' ", '', $input);
    return str_replace("'", '"', $input);
}
add_filter('script_loader_tag', 'clean_script_tag', 10, 3 );

/**
 * Add preloading CSS
 * @param $html
 * @param $handle
 * @param $href
 * @param $media
 *
 * @return string
 */
function add_rel_preload( $html, $handle, $href, $media ) {
	if ( is_admin() ) {
		return $html;
	}

	$html = <<<EOT
<link rel='preload' as='style' onload="this.onload=null;this.rel='stylesheet'" 
id='$handle' href='$href' type='text/css' media='all' />
EOT;

	return $html;
}

add_filter( 'style_loader_tag', 'add_rel_preload', 10, 4 );

/**
 * Clean default css
 */
function remove_wp_block_library_css(){
    //wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'global-styles' );
    wp_dequeue_style( 'wp-block-library-theme' );
}
add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );