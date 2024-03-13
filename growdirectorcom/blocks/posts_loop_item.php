<article class="blog-article wow fadeIn">
    <div class="bg-holder">
        <div class="blog-article-img-wrap">
            <?php echo get_the_post_thumbnail( get_the_ID(), 'full' ); ?>
            <div class="blog-article-info">
                <?php if ($post_views = get_field('post_views', get_the_ID())) {
                    if ($post_views > 1599) $post_views = __('1599+', TEXT_DOMAIN);
                } ?>
                <div class="blog-article-views views">
                    <i class="icon-eye-viewers"></i>
                    <span class="views-value"><?php echo ($post_views) ? $post_views : 0; ?></span>
                </div>
                <span class="blog-article-date"><i class="icon-date"></i><?php echo get_the_date('d/m/Y'); ?></span>
            </div>
        </div>
        <div class="blog-article-text">
            <p class="post-title">
                <?php the_title(); ?>
            </p>
            <a href="<?php the_permalink(); ?>"><?php _e('Read More', TEXT_DOMAIN); ?></a>
        </div>
    </div>
</article>