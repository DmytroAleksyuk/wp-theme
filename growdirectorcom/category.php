<?php get_header(); ?>
<?php if (have_posts()): ?>
    <section class="blog-section">
        <div class="container">
            <div class="top-blog">
                <div class="left-holder">
                    <h1 class="h1"><?php _e('Category:', TEXT_DOMAIN); ?> <?php single_cat_title(); ?></h1>
                </div>
                <?php get_template_part('blocks/posts_filter_category');?>
            </div>
    </section>
    <section class="latest-blog-posts">
        <div class="latest-blog-posts__wrapper">
            <div class="container">
                <div class="latest-blog-posts__content__row">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('blocks/posts_loop_item'); ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>
<?php get_template_part('includes/pager-category'); ?>
<?php else:
    get_template_part('includes/not-found');
endif; ?>
<?php get_footer(); ?>