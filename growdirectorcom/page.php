<?php get_header();
$section_class = is_checkout() || is_cart() ? ' class="section-order"' : ' class="section-default"';
$enable_default_editor = get_field('enable_default_editor');
$enable_default_title = get_field('enable_default_title');
get_template_part('blocks/blocks'); // Flex ?>
<?php if ($enable_default_editor == 1): ?>
    <section<?php echo $section_class; ?>>
        <div class="container">
            <?php if ( is_cart() || is_checkout() ): ?>
                <h1 class="page-title">
                    <?php echo wp_trim_words(get_the_title(), 25); ?>
                </h1>
            <?php endif; ?>
            <?php the_content(); ?>
        </div>
    </section>
    <?php if (is_cart()) :
        // App banner
        echo do_shortcode('[banner_app color="dark"]');
        // Consultation banner
        echo do_shortcode('[banner_consultation]');
    endif;
endif; ?>
<?php get_footer(); ?>