<?php
$specification_title = get_sub_field('specification_title');
$specification_btn = get_sub_field('specification_btn');
$specification_items = get_sub_field('specification_items');
$specification_title_h = get_query_var('blocks_counter') == 0 ? '<h1>' . $specification_title . '</h1>' : '<h2 class="h1">' . $specification_title . '</h2>';
?>
<section class="specifications-section fadeInUp wow">
    <div class="bg-holder">
        <div class="container">
            <?php if (!empty($specification_title)) : echo $specification_title_h; endif; ?>
            <?php if (!empty($specification_items)): ?>
                <div class="four-columns">
                    <?php foreach ($specification_items as $s_item):
                    $specification_item_img = $s_item['specification_item_img'];
                    $specification_item_title = $s_item['specification_item_title'];
                    $specification_item_info = $s_item['specification_item_info']; ?>
                        <div class="col">
                            <?php if (!empty($specification_item_img)): ?>
                                <img src="<?php echo $specification_item_img['url']; ?>"
                                     alt="<?php echo $specification_item_img['alt']; ?>"
                                     class="img-box"/>
                            <?php endif; ?>
                            <?php if (!empty($specification_item_title)): ?>
                                <strong><?php echo $specification_item_title; ?></strong>
                            <?php endif; ?>
                            <?php echo $specification_item_info; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if ( ! empty( $specification_btn ) ): ?>
                <div class="btn-holder">
                    <a class="btn btn-blue"
                       href="<?php echo esc_url($specification_btn['url']); ?>"
                       target="<?php echo esc_attr(!empty($specification_btn['target']) ? $specification_btn['target'] : '_self'); ?>">
                        <?php echo esc_html($specification_btn['title']); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>