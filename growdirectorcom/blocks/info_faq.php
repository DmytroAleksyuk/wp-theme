<?php
$faq_title = get_sub_field('faq_title');
$enable_faq_file = get_sub_field('enable_faq_file');
$faq_file = get_sub_field('faq_file'); //url:optional
$app_manual_text = get_field('app_manual_text', 'option');
$app_manual_file = get_field('app_manual_file', 'option');
$faq_items = get_sub_field('faq_items');
$app_faq_file = !empty($faq_file) ? $faq_file : $app_manual_file;
$faq_title_h = get_query_var('blocks_counter') == 0 ? '<h1>' . $faq_title . '</h1>' : '<h2 class="h1">' . $faq_title . '</h2>';
?>
<section class="faq-section">
    <div class="content-holder">
        <?php if (!empty($faq_title)): echo $faq_title_h; endif; ?>
        <?php if (!empty($faq_items)): ?>
            <div class="faq-list">
                <?php foreach ($faq_items as $f_item):
                    $faq_name = $f_item['faq_name']; //*
                    $faq_info = $f_item['faq_info']; ?>
                    <div class="faq-item fadeInUp wow">
                        <button class="open"></button>
                        <strong class="title"><?php echo $faq_name; ?></strong>
                        <div class="text-holder "><?php echo $faq_info; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($app_faq_file) && $enable_faq_file == 1): ?>
            <div class="btn-holder">
                <a href="<?php echo $app_faq_file; ?>" class="btn btn-green" target="_blank">
                    <?php echo !empty($app_manual_text) ? $app_manual_text : __('Download Manual', TEXT_DOMAIN); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>