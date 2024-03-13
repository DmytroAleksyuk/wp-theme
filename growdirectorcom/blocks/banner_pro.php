<?php
$pro_img = get_sub_field('pro_img');
$pro_title = get_sub_field('pro_title');
$pro_btn = get_sub_field('pro_btn');
?>
<section class="achieving-section fadeInUp wow">
    <div class="container">
        <?php if (!empty($pro_img)): ?>
            <div class="img-box">
                <img src="<?php echo $pro_img['url']; ?>"
                     alt="<?php echo $pro_img['alt']; ?>"/>
            </div>
        <?php endif; ?>
        <div class="align-holder">
            <?php if (!empty($pro_title)): ?>
                <h2 class="h1"><?php echo $pro_title; ?></h2>
            <?php endif; ?>
            <?php if (!empty($pro_btn)): ?>
                <a class="btn btn-green"
                   href="<?php echo esc_url($pro_btn['url']); ?>"
                   target="<?php echo esc_attr(!empty($pro_btn['target']) ? $pro_btn['target'] : '_self'); ?>">
                    <?php echo esc_html($pro_btn['title']); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>