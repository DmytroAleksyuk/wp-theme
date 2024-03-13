<?php get_header(); ?>
    <section class="latest-blog-posts">
        <div class="latest-blog-posts__wrapper">
            <div class="container">
                <div class="latest-blog-posts__content__row">
            <?php if ( have_posts() ) : ?>
                <div class="title">
                    <h1><?php printf( __( 'Search Results for: %s', TEXT_DOMAIN ), '<span>' . get_search_query() . '</span>'); ?></h1>
                </div>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'blocks/posts_loop_item' ); ?>
                <?php endwhile; ?>
                <?php get_template_part( 'includes/pager-category' ); ?>
            <?php else : ?>
                <?php get_template_part( 'includes/not-found' ); ?>
            <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>