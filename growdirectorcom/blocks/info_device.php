<?php
$device_color_background = get_sub_field('device_color_background');
$device_title = get_sub_field('device_title');
$device_subtitle = get_sub_field('device_subtitle');
$device_img = get_sub_field('device_img');
$device_img_background = get_sub_field('device_img_background');
$device_content = get_sub_field('device_content');
$device_additional = get_sub_field('device_additional');
$device_color_class = $device_color_background == 'green' ? ' device-section-green' : '';
if ($device_img_background == 1 && $device_color_background == 'white') :
    $device_background_file = ' style="background-image: url(' . PATH_TO_FRONT . 'img/device-logo-1.svg)"';
elseif ($device_img_background == 1 && $device_color_background == 'green') :
    $device_background_file = ' style="background-image: url(' . PATH_TO_FRONT . 'img/device-logo-2.svg)"';
else :
    $device_background_file = '';
endif;
?>
<section class="device-section<?php echo $device_color_class; ?>">
    <div class="container">
        <?php if (!empty($device_title) || !empty($device_subtitle) || !empty($device_content) ): ?>
            <div class="text-holder">
                <?php if (!empty($device_title)): ?>
                    <h2 class="h1"><?php echo $device_title; ?></h2>
                <?php endif; ?>
                <?php if (!empty($device_subtitle)): ?>
                    <p class="slogan"><?php echo $device_subtitle; ?></p>
                <?php endif; ?>
                <?php echo $device_content; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($device_img) || !empty($device_additional) ): ?>
            <div class="right-holder">
                <div class="img-holder"<?php echo $device_background_file; ?>>
                    <img src="<?php echo $device_img['url']; ?>"
                         alt="<?php echo $device_img['alt']; ?>"/>
                </div>
                <?php if (!empty($device_additional)): ?>
                    <div class="green-banner fadeInUp wow">
                        <div class="simbol-box">
                            <img src="<?php echo PATH_TO_FRONT; ?>img/info-simbol.svg" alt="symbol-icon" />
                        </div>
                        <div class="text">
                            <?php echo $device_additional; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>