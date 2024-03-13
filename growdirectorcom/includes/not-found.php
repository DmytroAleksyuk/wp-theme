<?php
$not_found_slogan = get_field('not_found_slogan', 'option');
$not_found_text = get_field('not_found_text', 'option');
$not_found_img = get_field('not_found_img', 'option');
?>
<div class="banner-media banner-media-text">
    <div class="img-visual">
        <div class="text-box">
            <?php if (!empty($not_found_slogan)): ?>
                <p class="sub-title">
                    <?php echo $not_found_slogan; ?>
                </p>
            <?php endif; ?>
            <?php echo $not_found_text; ?>
            <div class="big-text">
                <p><?php _e('404', TEXT_DOMAIN); ?></p>
            </div>
        </div>
        <img src="<?php echo !empty($not_found_img['url']) ? $not_found_img['url'] : PATH_TO_FRONT . 'img/404.jpg'; ?>"
             alt="<?php echo !empty($not_found_img['alt']) ? $not_found_img['alt'] : 'not found'; ?>">
    </div>
</div>