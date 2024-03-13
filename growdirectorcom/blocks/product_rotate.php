<?php
$rotate_media = get_sub_field('rotate_media');
?>
<section class="view-3d-section fadeInUp wow">
    <div class="container">
        <?php if (!empty($rotate_media)): ?>
            <div class="view-3d" id="view-3d">
                <ul>
                    <?php foreach ($rotate_media as $r_media):
                        $r_media_img = $r_media['url'];
                        if (!empty($r_media_img)): ?>
                            <li>
                                <img src="<?php echo $r_media_img; ?>"
                                     alt="<?php echo !empty($r_media['alt']) ? $r_media['alt'] : ''; ?>"/>
                            </li>
                        <?php endif;
                    endforeach; ?>
                </ul>
            </div>
            <p class="text"><?php _e( '360°', TEXT_DOMAIN ); ?></p>
        <?php endif; ?>
    </div>
</section>