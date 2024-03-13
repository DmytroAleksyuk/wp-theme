<?php
// Theme sidebars

function theme_sidebars() {
	register_sidebar( array(
		'id'            => 'shop-sidebar',
		'name'          => __( 'Shop Sidebar', TEXT_DOMAIN ),
		'before_widget' => '<div class="widget %2$s" id="%1$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	) );
    register_sidebar( array(
        'id'            => 'single-sidebar',
        'name'          => __( 'Post Sidebar', TEXT_DOMAIN ),
        'before_widget' => '<div class="widget %2$s" id="%1$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="h4">',
        'after_title'   => '</h3>'
    ) );
}

add_action( 'widgets_init', 'theme_sidebars' );