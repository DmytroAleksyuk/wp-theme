<?php
/**
 * Register widgets
 * @return void
 */
function theme_widgets() {
	register_widget( 'Widget_Related_Posts_With_Banner' );
}

add_action( 'widgets_init', 'theme_widgets' );

/**
 * widget Recent Posts with banner
 */
class Widget_Related_Posts_With_Banner extends WP_Widget {
    /**
     * Widget_Recent_Posts constructor.
     */
    function __construct() {
        $widget_ops = array('classname' => 'widget_recent_entries',
            'description' => __( 'Related posts with banner', TEXT_DOMAIN ) );
        parent::__construct('widget_recent_entries', __('Related articles with Banner', TEXT_DOMAIN), $widget_ops);
        $this->alt_option_name = 'widget_recent_entries';
        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
        add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ) );
    }
    /**§
     * Front-end display of widget.
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     *
     * @see WP_Widget::widget()
     *
     */
    function widget( $args, $instance ) {
        $cache = wp_cache_get('widget_recent_entries', 'widget');
        if (!is_array($cache))
            $cache = array();
        if (isset($cache[$args['widget_id']])) {
            echo $cache[$args['widget_id']];
            return;
        }
        ob_start();
        extract($args);

        $title = !empty($instance['title']) ? $instance['title'] : '';
        $number = !empty($instance['number']) ? absint($instance['number']) : 6;
        $banner_number = !empty($instance['cta_number']) ? absint($instance['cta_number']) : '';
        $banner_title = !empty($instance['cta_title']) ? $instance['cta_title'] : '';
        $banner_description = !empty($instance['cta_description']) ? $instance['cta_description'] : '';
        $banner_image = !empty($instance['cta_image']) ? $instance['cta_image'] : '';
        $banner_link = !empty($instance['cta_link']) ? $instance['cta_link'] : '';

        $r = new WP_Query(array(
                'posts_per_page' => $number,
                'post__not_in' => array(get_the_ID()),
                'no_found_rows' => true,
                'post_status' => 'publish',
                'ignore_sticky_posts' => true,
                //'orderby' => 'rand'
            )
        );
        if ($r->have_posts()) :
            $r_counter = 1;
            echo $before_widget;
            if ($title) echo $before_title . $title . $after_title; ?>
            <?php while ($r->have_posts()) : $r->the_post(); ?>
            <?php if ($r_counter === $banner_number && !empty($banner_number)) { ?>
                <article class="shop-banner wow fadeInUp">
                    <?php if ( ! empty( $banner_image ) ) { ?>
                        <div class="img-box"><img src="<?php echo $banner_image; ?>" alt="banner-img"/></div>
                    <?php } ?>
                    <div class="text">
                        <?php if ( ! empty( $banner_title ) ) { ?>
                            <strong><?php echo $banner_title; ?></strong>
                        <?php } ?>
                        <?php if ( ! empty( $banner_description ) ) { ?>
                            <p><?php echo wp_trim_words( $banner_description, 7 ); ?></p>
                        <?php } ?>
                        <?php if ( ! empty( $banner_link ) ) { ?>
                            <a href="<?php echo esc_url( $banner_link ); ?>"><?php _e('Shop Now', TEXT_DOMAIN); ?></a>
                        <?php } ?>
                    </div>
                </article>
            <?php } ?>
            <article class="wow fadeInUp">
                <div class="img-box">
                    <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
                </div>
                <div class="text">
                    <time class="time" datetime="<?php echo get_the_date('Y-m-d', get_the_ID()); ?>">
                        <?php echo get_the_date('d/m/Y', get_the_ID()); ?>
                    </time>
                    <strong><?php if (get_the_title()) the_title(); else the_ID(); ?></strong>
                    <a href="<?php the_permalink() ?>"
                       title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
                        <?php _e('Read more', TEXT_DOMAIN); ?>
                    </a>
                </div>
            </article>
            <?php $r_counter++;
        endwhile; ?>
            <?php echo $after_widget; ?>
            <?php
            wp_reset_postdata();
        endif;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set( 'widget_recent_entries', $cache, 'widget' );
    }
    /**
     * Back-end widget form.
     *
     * @param array $instance Previously saved values from database.
     *
     * @see WP_Widget::form()
     *
     */
    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : __('Related articles', TEXT_DOMAIN);
        $number = isset($instance['number']) ? absint($instance['number']) : 6;
        $banner_number = isset($instance['cta_number']) ? $instance['cta_number'] : 4;
        $banner_title = isset( $instance['cta_title'] ) ? esc_attr($instance['cta_title']) : '';
        $banner_description = isset( $instance['cta_description'] ) ? esc_attr($instance['cta_description']) : '';
        $banner_image       = ! empty( $instance['cta_image'] ) ? $instance['cta_image'] : '';
        $banner_link      = ! empty( $instance['cta_link'] ) ? $instance['cta_link'] : '';
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', TEXT_DOMAIN); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number(6) of posts to show:', TEXT_DOMAIN); ?></label>
            <input id="<?php echo $this->get_field_id('number'); ?>"
                   name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>"
                   size="1"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('cta_number'); ?>"><?php _e('*Number(4) of banner position:', TEXT_DOMAIN); ?></label>
            <input id="<?php echo $this->get_field_id('cta_number'); ?>"
                   name="<?php echo $this->get_field_name('cta_number'); ?>" type="text" value="<?php echo $banner_number; ?>"
                   size="1"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('cta_title'); ?>"><?php _e('Banner title:', TEXT_DOMAIN); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('cta_title'); ?>"
                   name="<?php echo $this->get_field_name('cta_title'); ?>" type="text"
                   value="<?php echo $banner_title; ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('cta_description')); ?>"><?php esc_attr_e('Banner description:', TEXT_DOMAIN); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('cta_description')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('cta_description')); ?>" type="text"
                   value="<?php echo esc_attr($banner_description); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('cta_image')); ?>"><?php esc_attr_e('Banner image', TEXT_DOMAIN); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('cta_image')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('cta_image')); ?>" type="text"
                   value="<?php echo esc_url($banner_image); ?>"/>
            <button class="upload_image_button button button-primary"><?php esc_attr_e('Upload Image', TEXT_DOMAIN); ?></button>
        </p>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('cta_link')); ?>"><?php esc_attr_e('Banner link:', TEXT_DOMAIN); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('cta_link')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('cta_link')); ?>" type="text"
                   value="<?php echo esc_attr($banner_link); ?>">
        </p>
        <?php
    }
    /**
     * Widget cache.
     * @return void
     */
    function flush_widget_cache() {
        wp_cache_delete( 'widget_recent_entries', 'widget' );
    }
    /**
     * Sanitize widget form values as they are saved.
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     * @see WP_Widget::update()
     *
     */
    function update($new_instance, $old_instance) {
        $instance           = $old_instance;
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? (int)$new_instance['number'] : 6;
        $instance['cta_number'] = ( ! empty( $new_instance['cta_number'] ) ) ? (int)$new_instance['cta_number'] : '';
        $instance['cta_title'] = ( ! empty( $new_instance['cta_title'] ) ) ? $new_instance['cta_title'] : '';
        $instance['cta_description'] = ( ! empty( $new_instance['cta_description'] ) ) ? $new_instance['cta_description'] : '';
        $instance['cta_image']       = ( ! empty( $new_instance['cta_image'] ) ) ? $new_instance['cta_image'] : '';
        $instance['cta_link']        = ( ! empty( $new_instance['cta_link'] ) ) ? esc_url( $new_instance['cta_link'] ) : '';

        $this->flush_widget_cache();
        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset( $alloptions['widget_recent_entries'] ) )
            delete_option( 'widget_recent_entries' );

        return $instance;
    }
    /**
     * Enqueue scripts.
     * @return void
     */
    public function scripts() {
        wp_enqueue_script( 'media-upload' );
        wp_enqueue_media();
        wp_enqueue_script( 'widgets_admin', get_template_directory_uri() . '/js/widgets.js', array( 'jquery' ) );
    }

} // class Widget_Recent_Posts_With_Banner