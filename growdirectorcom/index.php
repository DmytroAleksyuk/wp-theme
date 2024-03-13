<?php
get_header();
$page_id = get_queried_object_id();
$blog_title = get_field('blog_title', $page_id);
$blog_subtitle = get_field('blog_subtitle', $page_id);
$blog_top_posts = get_field('blog_top_posts', $page_id); //ids
if ( ! empty( $blog_top_posts ) ) :
    $top_args = array(
        'post__in'  => $blog_top_posts,
        'orderby'   => 'post__in'
    );
else:
    $top_args = array(
        'post_status'    => 'publish',
        'posts_per_page' => 3
    );
endif;
$top_query = new WP_Query( $top_args ); ?>
    <section class="blog-section">
        <div class="container">
            <div class="top-blog">
                <div class="left-holder">
                    <?php if (!empty($blog_title)): ?>
                        <h1 class="h1"><?php echo $blog_title; ?></h1>
                    <?php endif; ?>
                    <?php if (!empty($blog_subtitle)): ?>
                        <p class="slogan"><?php echo $blog_subtitle; ?></p>
                    <?php endif; ?>
                </div>
                <?php get_template_part('blocks/posts_filter_category');?>
            </div>
            <div class="blog-grid">
                <?php
                $posts_count = 0;
                $selected_posts = array();
                $small_blocks = '';
                while ( $top_query->have_posts() ) : $top_query->the_post();
                    $selected_posts[] = get_the_ID();
                    if (++$posts_count == 1): ?>
                        <div class="item big">
                            <article>
                                <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
                                <div class="text">
                                    <h4><?php echo get_the_title(get_the_ID()); ?></h4>
                                    <a href="<?php echo get_the_permalink(get_the_ID()); ?>" class="more">
                                        <?php _e('Read More', TEXT_DOMAIN); ?>
                                    </a>
                                </div>
                            </article>
                        </div>
                    <?php else:
                        ob_start(); ?>
                        <div class="item">
                            <article>
                                <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
                                <div class="text">
                                    <h4><?php echo get_the_title(get_the_ID()); ?></h4>
                                    <a href="<?php echo get_the_permalink(get_the_ID()); ?>" class="more">
                                        <?php _e('Read More', TEXT_DOMAIN); ?>
                                    </a>
                                </div>
                            </article>
                        </div>
                        <?php
                        $small_blocks .= ob_get_clean();
                    endif; ?>
                <?php endwhile;
                wp_reset_postdata();
                if (!empty($small_blocks)): ?>
                    <div class="article-holder">
                        <?php echo $small_blocks; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php
$posts_per_page = get_option('posts_per_page') ? get_option('posts_per_page') : 12;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$p_args = [
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
    'post__not_in' => !empty($selected_posts) ? $selected_posts : '',
];
$p_query = new WP_Query($p_args);
if ($p_query->have_posts()) : ?>
    <section class="latest-blog-posts">
        <div class="latest-blog-posts__wrapper">
            <div class="container">
                <div class="latest-blog-posts__content__row">
                    <?php while ($p_query->have_posts()) : $p_query->the_post();
                        get_template_part('blocks/posts_loop_item');
                    endwhile;
                    wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    // pagination
    $total_pages = isset($p_query->max_num_pages) ? $p_query->max_num_pages : 1;
    if ($total_pages > 1) :
        $current_page = max(1, get_query_var('paged'));
        echo '<nav class="navigation pagination" role="navigation"><div class="nav-links">';
        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => 'page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text' => '<i class="icon-arrow-thin-left"></i>',
            'next_text' => '<i class="icon-arrow-thin-right"></i>',
        ));
        if ($total_pages > 1) {
            echo '</div></nav>';
        }
    endif;
else:
    get_template_part('blocks/not_found');
endif; ?>

<?php get_footer(); ?>