<?php
$top_video_title = get_sub_field('top_video_title');
$top_video_subtitle = get_sub_field('top_video_subtitle');
$top_video_left_btn = get_sub_field('top_video_left_btn');
$top_video_right_btn = get_sub_field('top_video_right_btn');
$top_video_right_url = get_sub_field('top_video_right_url');
$top_video_cover_file = get_sub_field('top_video_cover_file');
$top_video_left_btn_href = !empty($top_video_left_btn) ? esc_url($top_video_left_btn['url']) : '#section-quiz';
$top_video_title_h = get_query_var('blocks_counter') == 0 ? '<h1>' . $top_video_title . '</h1>' : '<h2 class="h1">' . $top_video_title . '</h2>';
?>
<section class="visual-section">
    <div class="container">
        <div class="text-box">
            <?php if (!empty($top_video_title_h)): echo $top_video_title_h; endif; ?>
            <?php if ( ! empty( $top_video_subtitle ) ): ?>
                <p><?php echo $top_video_subtitle; ?></p>
            <?php endif; ?>
            <div class="btn-holder">
                <a class="btn btn-blue"
                   href="<?php echo $top_video_left_btn_href; ?>"
                   target="<?php echo esc_attr(!empty($top_video_left_btn['target']) ? $top_video_left_btn['target'] : '_self'); ?>">
                    <?php echo esc_attr(!empty($top_video_left_btn['title']) ? $top_video_left_btn['title'] : __('Find the right kit', TEXT_DOMAIN)); ?>
                </a>
                <?php if ( ! empty( $top_video_right_url ) ): ?>
                    <a href="<?php echo esc_url($top_video_right_url); ?>" class="btn btn-video lightbox fancybox.iframe">
                      <span class="img-border">
                        <img src="<?php echo PATH_TO_FRONT; ?>img/play-button.svg" alt="play button" />
                      </span>
                        <?php echo !empty($top_video_right_btn) ? $top_video_right_btn : __( 'Watch Video', TEXT_DOMAIN ); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <?php if ( ! empty( $top_video_cover_file ) ): ?>
            <div class="img-box">
                <?php if ( $top_video_cover_file['type'] == 'image' ): ?>
                    <img src="<?php echo $top_video_cover_file['url']; ?>"
                         alt="top-banner">
                <?php endif;
                if ( $top_video_cover_file['type'] == 'video' ): ?>
                    <video src="<?php echo $top_video_cover_file['url']; ?>" width="616" autoplay loop muted playsinline></video>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>