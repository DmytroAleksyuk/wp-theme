<?php get_header(); ?>
    <div class="container">
        <div id="post-content">
            <div id="content">
                <div class="bg-gray">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="blog-visual">
                            <div class="blog-visual-img">
                                <?php the_post_thumbnail( 'full' ); ?>
                                <div class="blog-visual-text">
                                    <?php the_title( '<h1 class="h1">', '</h1>' ); ?>
                                    <div class="blog-article-info">
                                        <div class="blog-article-category">
                                            <i class="icon-list_bullets"></i>
                                            <?php
                                            //echo get_the_category()[0]->cat_name; //if 1st
                                            //echo strip_tags( get_the_category_list( ', ' ) ); //without links
                                            the_category( '&#44;&nbsp;'); ?>
                                        </div>
                                        <?php if ($post_views = get_field('post_views', get_the_ID())) {
                                            if ($post_views > 1599) $post_views = __('1599+', TEXT_DOMAIN);
                                        } ?>
                                        <div class="blog-article-views">
                                            <i class="icon-eye-viewers"></i>
                                            <span class="views-value"><?php echo !empty($post_views) ? $post_views : 0; ?></span>
                                        </div>
                                        <span class="blog-article-date"><i class="icon-date"></i><?php the_date('d/m/Y'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="social-holder">
                                <span class="text"> <?php _e('Share:', TEXT_DOMAIN); ?> </span>
                                <div class="social-links-content">
                                    <div data-network="facebook" class="st-custom-button icon-facebook"></div>
                                    <div data-network="linkedin" class="st-custom-button icon-linkedin"></div>
                                    <div data-network="telegram" class="st-custom-button icon-telegram"></div>
                                    <div data-network="whatsapp" class="st-custom-button icon-whatsapp-2"></div>
                                </div>
                            </div>
                        </div>
                        <?php the_content(); ?>
                        <?php get_template_part( 'includes/pager-single', get_post_type() ); ?>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php get_sidebar( 'single' ); ?>
        </div>
    </div>
<?php get_footer(); ?>