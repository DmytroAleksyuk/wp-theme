<?php
/**
 * Loads the theme's translated strings
 */
function theme_localization() {
	load_theme_textdomain( TEXT_DOMAIN, get_template_directory() . '/languages' );
}

add_action( 'after_setup_theme', 'theme_localization' );