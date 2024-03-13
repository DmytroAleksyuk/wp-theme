<?php
$download_title = get_sub_field('download_title');
$download_description = get_sub_field('download_description');
$enable_download_links = get_sub_field('enable_download_links');
$enable_download_file = get_sub_field('enable_download_file');
$download_file = get_sub_field('download_file'); //url:optional
$app_qr_ios_img = get_field('app_qr_ios_img', 'option');
$app_store_ios_img = get_field('app_store_ios_img', 'option');
$app_store_ios_link = get_field('app_store_ios_link', 'option');
$app_qr_android_img = get_field('app_qr_android_img', 'option');
$app_store_android_img = get_field('app_store_android_img', 'option');
$app_store_android_link = get_field('app_store_android_link', 'option');
$app_manual_img = get_field('app_manual_img', 'option');
$app_manual_text = get_field('app_manual_text', 'option');
$app_manual_file = get_field('app_manual_file', 'option');
$app_download_file = !empty($download_file) ? $download_file : $app_manual_file;
$download_title_h = get_query_var('blocks_counter') == 0 ? '<h1>' . $download_title . '</h1>' : '<h2 class="h2">' . $download_title . '</h2>';
?>
<section class="download-section fadeInUp wow" id="download-section">
    <div class="container">
        <div class="text-col">
            <?php if (!empty($download_title)): echo $download_title_h; endif; ?>
            <?php echo $download_description; ?>
        </div>
        <?php if ($enable_download_links == 1 || $enable_download_file == 1): ?>
            <ul class="img-list">
                <?php if ($enable_download_links == 1): ?>
                    <li>
                        <?php if (!empty($app_qr_ios_img)): ?>
                            <div class="img-box">
                                <img src="<?php echo $app_qr_ios_img['url']; ?>"
                                     alt="<?php echo !empty($app_qr_ios_img['alt']) ? $app_qr_ios_img['alt'] : 'qr ios store'; ?>"/>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($app_store_ios_link)): ?>
                            <a class="app-store"
                               href="<?php echo esc_url($app_store_ios_link); ?>"
                               target="_blank">
                                <img src="<?php echo !empty($app_store_ios_img['url']) ? $app_store_ios_img['url'] : PATH_TO_FRONT . 'img/appStore.svg'; ?>"
                                     alt="<?php echo !empty($app_store_ios_img['alt']) ? $app_store_ios_img['alt'] : 'ios store'; ?>"/>
                            </a>
                        <?php endif; ?>
                    </li>
                    <li>
                        <?php if (!empty($app_qr_android_img)): ?>
                            <div class="img-box">
                                <img src="<?php echo $app_qr_android_img['url']; ?>"
                                     alt="<?php echo !empty($app_qr_android_img['alt']) ? $app_qr_android_img['alt'] : 'qr android store'; ?>"/>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($app_store_android_link)): ?>
                            <a class="google-play"
                               href="<?php echo esc_url($app_store_android_link); ?>"
                               target="_blank">
                                <img src="<?php echo !empty($app_store_android_img['url']) ? $app_store_android_img['url'] : PATH_TO_FRONT . 'img/googlePlay.svg'; ?>"
                                     alt="<?php echo !empty($app_store_android_img['alt']) ? $app_store_android_img['alt'] : 'google play'; ?>"/>
                            </a>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
                <?php if ($enable_download_file == 1): ?>
                    <li>
                        <?php if (!empty($app_manual_img)): ?>
                            <div class="img-box">
                                <img src="<?php echo $app_manual_img['url']; ?>"
                                     alt="<?php echo !empty($app_manual_img['alt']) ? $app_manual_img['alt'] : 'app manual'; ?>"/>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($app_download_file)): ?>
                            <div class="btn-holder">
                                <a href="<?php echo $app_download_file; ?>" class="btn btn-blue" target="_blank">
                                    <?php echo !empty($app_manual_text) ? $app_manual_text : __('Download Manual', TEXT_DOMAIN); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
            </ul>
        <?php endif; ?>
    </div>
</section>