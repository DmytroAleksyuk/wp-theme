<?php
// Theme thumbnails

add_theme_support( 'post-thumbnails' );
//set_post_thumbnail_size( 50, 50, true ); // Normal post thumbnails
// Add support for full and wide align images.
add_theme_support( 'align-wide' );

/**
 * Allow SVG through WordPress Media Uploader
 *
 * @param $mimes
 *
 * @return mixed
 */
function add_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'add_mime_types' );

/**
 * Remove all the image sizes keeping only the default WordPress image sizes
 */
function remove_extra_image_sizes() {
	foreach ( get_intermediate_image_sizes() as $size ) {
		if ( !in_array( $size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
			remove_image_size( $size );
		}
	}
}

add_action('init', 'remove_extra_image_sizes');

/**
 * Set default values for the upload media box
 * @return void
 */
function change_default_embed_size() {
    update_option('image_default_align', 'center' );
    update_option('image_default_size', 'full' );

}
add_action('after_setup_theme', 'change_default_embed_size');