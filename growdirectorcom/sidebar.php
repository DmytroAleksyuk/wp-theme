<?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>
	<div id="shop-sidebar">
        <p class="filter-title"><?php _e( 'Filter:', TEXT_DOMAIN ); ?></p>
		<?php dynamic_sidebar( 'shop-sidebar' ); ?>
        <?php if ( !is_shop() ) : ?>
            <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="icon-close"></a>
        <?php endif; ?>
	</div>
<?php endif; ?>