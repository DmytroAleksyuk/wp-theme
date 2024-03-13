<?php
$contact_title = get_sub_field('contact_title');
$contact_img = get_sub_field('contact_img');
$contact_info = get_sub_field('contact_info');
$enable_socials = get_sub_field('enable_socials');
$footer_socials = get_field('footer_socials', 'option');
$contact_form_select = get_sub_field('contact_form_select'); //id
$contact_title_h = get_query_var('blocks_counter') == 0 ? '<h1 class="h3">' . $contact_title . '</h1>' : '<h3 class="h3">' . $contact_title . '</h3>';
?>
<section class="contact-section">
    <div class="container">
        <?php if (!empty($contact_title) || !empty($contact_info) || !empty($footer_socials)): ?>
            <div class="text-holder">
                <?php if (!empty($contact_title)) : echo $contact_title_h; endif;
                if (!empty($contact_img)): ?>
                    <div class="img-box">
                        <img src="<?php echo $contact_img['url']; ?>"
                             alt="<?php echo $contact_img['alt']; ?>">
                    </div>
                <?php endif;
                if (!empty($contact_info)): ?>
                    <div class="contact-list">
                        <?php echo $contact_info; ?>
                    </div>
                <?php endif; ?>
                <?php if ($enable_socials == 1 && !empty($footer_socials)): ?>
                    <ul class="social_list">
                        <?php foreach ($footer_socials as $f_social):
                            $f_social_type = $f_social['footer_social_type'] ?? '';
                            $f_social_link = $f_social['footer_social_url'] ?? '';
                            if ($f_social_type && $f_social_link): ?>
                                <li><a class="icon-<?php echo $f_social_type; ?>"
                                       href="<?php echo esc_url($f_social_link); ?>" target="_blank"></a></li>
                            <?php endif;
                        endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($contact_form_select)): ?>
            <div class="form-holder">
                <?php echo do_shortcode('[contact-form-7 id="' . $contact_form_select[0] . '" html_class="form-contact"]'); ?>
            </div>
        <?php endif; ?>
    </div>
</section>