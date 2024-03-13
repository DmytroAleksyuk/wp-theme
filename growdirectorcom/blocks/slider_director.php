<?php
$director_title = get_sub_field('director_title');
$director_btn = get_sub_field('director_btn');
$director_slider = get_sub_field('director_slider');
$director_description = get_sub_field('director_description');
$director_title_h = get_query_var('blocks_counter') == 0 ? '<h1>' . $director_title . '</h1>' : '<h2>' . $director_title . '</h2>';
?>
<section class="director-section">
    <div class="container">
        <?php if (!empty($director_title_h)) : echo $director_title_h; endif; ?>
        <?php if (!empty($director_slider)): ?>
            <div class="director-slider-holder">
                <div class="director-slider">
                    <?php foreach ($director_slider as $d_slide):
                        $d_slide_img = $d_slide['url'];
                        if (!empty($d_slide_img)): ?>
                            <div>
                                <img src="<?php echo $d_slide_img; ?>"
                                     alt="<?php echo !empty($d_slide['alt']) ? $d_slide['alt'] : ''; ?>"/>
                            </div>
                        <?php endif;
                    endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (!empty($director_description)): ?>
            <p class="description"><?php echo $director_description; ?></p>
        <?php endif; ?>
        <?php if (!empty($director_btn)): ?>
            <a class="btn btn-blue"
               href="<?php echo esc_url($director_btn['url']); ?>"
               target="<?php echo esc_attr(!empty($director_btn['target']) ? $director_btn['target'] : '_self'); ?>">
                <?php echo esc_html($director_btn['title']); ?>
            </a>
        <?php endif; ?>
    </div>
</section>