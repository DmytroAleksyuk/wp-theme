<?php
$application_slider_position = get_sub_field('application_slider_position');
$application_slides = get_sub_field('application_slides');
$application_icon = get_sub_field('application_icon');
$application_title = get_sub_field('application_title');
$application_description = get_sub_field('application_description');
$application_link = get_sub_field('application_link');
$application_href = !empty($application_link) ? esc_url($application_link['url']) : '#download-section' ;
$application_slider_float = $application_slider_position  == 'right' ? ' variants-section-reverse' : '';
?>
<section class="variants-section<?php echo $application_slider_float; ?>">
    <div class="container">
        <?php if (!empty($application_slides)): ?>
            <div class="img-box">
                <div class="slider-box">
                    <div class="variants-slider">
                        <?php foreach ($application_slides as $a_slide):
                        $a_slide_img = $a_slide['url'];
                        if (!empty($a_slide_img)): ?>
                            <div>
                                <img src="<?php echo $a_slide_img; ?>" alt="<?php echo !empty($a_slide['alt']) ? $a_slide['alt'] : ''; ?>" />
                            </div>
                        <?php endif;
                        endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="text-holder fadeInUp wow">
            <?php if (!empty($application_icon)): ?>
                <div class="icon-holder">
                    <img src="<?php echo $application_icon['url']; ?>" alt="<?php echo !empty($application_icon['alt']) ? $application_icon['alt'] : ''; ?>" />
                </div>
            <?php endif; ?>
            <?php echo !empty($application_title) ? '<h2>' . $application_title .'</h2>' : ''; ?>
            <?php echo $application_description; ?>
            <a class="btn btn-blue"
               href="<?php echo $application_href; ?>"
               target="<?php echo esc_attr(!empty($application_link['target']) ? $application_link['target'] : '_self'); ?>">
                <?php echo esc_attr(!empty($application_link['title']) ? $application_link['title'] : __('Download app', TEXT_DOMAIN)); ?>
            </a>
        </div>
    </div>
</section>