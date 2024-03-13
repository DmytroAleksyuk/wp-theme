<?php
$preview_blog_title = get_sub_field('preview_blog_title');
$preview_blog_subtitle = get_sub_field('preview_blog_subtitle');
$preview_blog_posts = get_sub_field('preview_blog_posts'); //obj
?>
<section class="blog-section">
    <div class="container">
        <?php if (!empty($preview_blog_title)): ?>
            <h2 class="h1"><?php echo $preview_blog_title; ?></h2>
        <?php endif; ?>
        <?php if (!empty($preview_blog_subtitle)): ?>
            <p class="slogan"><?php echo $preview_blog_subtitle; ?></p>
        <?php endif; ?>
        <?php if (!empty($preview_blog_posts)) : ?>
            <div class="blog-grid">
                <?php $posts_count = 0;
                foreach ($preview_blog_posts as $p):
                    $posts_count++;
                    echo $posts_count == 2 ? '<div class="article-holder">' : ''; ?>
                    <div class="item<?php echo $posts_count == 1 ? ' big' : '' ?>">
                        <article>
                            <?php echo get_the_post_thumbnail( $p->ID, 'full' ); ?>
                            <div class="text">
                                <h4><?php echo wp_trim_words(get_the_title($p->ID), 15, '...'); ?></h4>
                                <a href="<?php echo get_the_permalink($p->ID); ?>"
                                   class="more"><?php _e('Read More', TEXT_DOMAIN); ?></a>
                            </div>
                        </article>
                    </div>
                    <?php echo $posts_count == 3 ? '</div>' : '';
                endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>