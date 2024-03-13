<?php
$top_application_logo = get_sub_field('top_application_logo');
$top_application_title = get_sub_field('top_application_title');
$top_application_description = get_sub_field('top_application_description');
$enable_top_application_links = get_sub_field('enable_top_application_links');
$top_application_img = get_sub_field('top_application_img');
$app_store_ios_img = get_field('app_store_ios_img', 'option');
$app_store_ios_link = get_field('app_store_ios_link', 'option');
$app_store_android_img = get_field('app_store_android_img', 'option');
$app_store_android_link = get_field('app_store_android_link', 'option');
$top_application_title_h = get_query_var('blocks_counter') == 0 ? '<h1>' . $top_application_title . '</h1>' : '<h2 class="h1">' . $top_application_title . '</h2>';
?>
<section class="application-section">
    <div class="bg-holder">
        <div class="text-col fadeInUp wow">
            <?php if (!empty($top_application_logo)): ?>
                <div class="logo-holder">
                    <img src="<?php echo $top_application_logo['url']; ?>"
                         alt="<?php echo $top_application_logo['alt']; ?>"/>
                </div>
            <?php endif; ?>
            <?php if (!empty($top_application_title)): echo $top_application_title_h; endif; ?>
            <?php echo $top_application_description; ?>
            <?php if ($enable_top_application_links == 1): ?>
                <div class="btn-holder">
                    <?php if (!empty($app_store_ios_link)): ?>
                        <a class="app-store"
                           href="<?php echo esc_url($app_store_ios_link); ?>"
                           target="_blank">
                            <img src="<?php echo !empty($app_store_ios_img['url']) ? $app_store_ios_img['url'] : PATH_TO_FRONT . 'img/appStore.svg'; ?>"
                                 alt="<?php echo !empty($app_store_ios_img['alt']) ? $app_store_ios_img['alt'] : 'ios store'; ?>"/>
                        </a>
                    <?php endif; ?>
                    <?php if (!empty($app_store_android_link)): ?>
                        <a class="google-play"
                           href="<?php echo esc_url($app_store_android_link); ?>"
                           target="_blank">
                            <img src="<?php echo !empty($app_store_android_img['url']) ? $app_store_android_img['url'] : PATH_TO_FRONT . 'img/googlePlay.svg'; ?>"
                                 alt="<?php echo !empty($app_store_android_img['alt']) ? $app_store_android_img['alt'] : 'google play'; ?>"/>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if (!empty($top_application_img)): ?>
            <div class="img-holder fadeInRight wow">
                <img src="<?php echo $top_application_img['url']; ?>"
                     alt="<?php echo $top_application_img['alt']; ?>"/>
            </div>
        <?php endif; ?>
    </div>
</section>