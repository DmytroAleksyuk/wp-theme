<?php
$enable_media_slogan = get_sub_field('enable_media_slogan');
$media_slogan_size = get_sub_field('media_slogan_size');
$media_slogan = get_sub_field('media_slogan');
$media_image = get_sub_field('media_image');
$media_slogan_size_class = $media_slogan_size == 'big' ? ' class="big-text"' : ' class="middle-text"';
if (!empty($media_image)): ?>
    <div class="banner-media fadeInUp wow<?php echo $enable_media_slogan == 1 ? ' banner-media-text' : ''; ?>">
        <div class="img-visual">
            <?php if (!empty($media_slogan) && $enable_media_slogan == 1): ?>
                <div class="text-box">
                    <div<?php echo $media_slogan_size_class; ?>>
                       <?php echo $media_slogan; ?>
                    </div>
                </div>
            <?php endif; ?>
            <img src="<?php echo $media_image['url']; ?>"
                 alt="<?php echo $media_image['alt']; ?>">
        </div>
    </div>
<?php endif; ?>