<?php
$partners_title = get_sub_field('partners_title');
$partners_btn = get_sub_field('partners_btn');
$partners_logos = get_sub_field('partners_logos');
$partners_title_h = get_query_var('blocks_counter') == 0 ? '<h1>' . $partners_title . '</h1>' : '<h2 class="h1">' . $partners_title . '</h2>';
?>
<section class="partners-section">
    <div class="container">
        <?php if (!empty($partners_title)) : echo $partners_title_h; endif; ?>
        <?php if (!empty($partners_logos)): ?>
            <div class="partners-slider wow fadeInRightBig">
                <?php foreach ($partners_logos as $p_logo):
                    $partner_logo = $p_logo['partner_logo'];
                    if (!empty($partner_logo)) : ?>
                        <div>
                            <img src="<?php echo $partner_logo['url']; ?>"
                                 alt="<?php echo $partner_logo['alt']; ?>"
                                 class="logo-partner"/>
                        </div>
                    <?php endif;
                endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if ( ! empty( $partners_btn ) ): ?>
            <div class="btn-holder">
                <a class="btn btn-blue"
                   href="<?php echo esc_url($partners_btn['url']); ?>"
                   target="<?php echo esc_attr(!empty($partners_btn['target']) ? $partners_btn['target'] : '_self'); ?>">
                    <?php echo esc_html($partners_btn['title']); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>