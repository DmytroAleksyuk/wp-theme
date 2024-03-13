<?php
$benefits_left_title = get_sub_field('benefits_left_title');
$benefits_left_subtitle = get_sub_field('benefits_left_subtitle');
$benefits_right_title = get_sub_field('benefits_right_title');
$benefits_right_subtitle = get_sub_field('benefits_right_subtitle');
$benefits_products = get_sub_field('benefits_products');
$benefits_list_items = get_sub_field('benefits_list_items');
$benefits_left_title_h = get_query_var('blocks_counter') == 0 ? '<h1>' . $benefits_left_title . '</h1>' : '<h2 class="h1">' . $benefits_left_title . '</h2>';
?>
<section class="pro-section">
    <div class="container">
        <div class="two-columns">
            <div class="slider-holder wow fadeInLeftBig">
                <div class="top-text">
                    <?php if (!empty($benefits_left_title)) : echo $benefits_left_title_h; endif; ?>
                    <?php if (!empty($benefits_left_subtitle)): ?>
                        <p class="slogan"><?php echo $benefits_left_subtitle; ?></p>
                    <?php endif; ?>
                </div>
                <?php if (!empty($benefits_products)): ?>
                    <div class="bg-slider">
                        <div class="pro-slider">
                            <?php
                            $benefits_products_counter = 0;
                            foreach ($benefits_products as $key => $b_product) :
                                $benefit_product_img = $b_product['benefit_product_img'];
                                $benefit_product_link = $b_product['benefit_product_link'];
                                $benefit_product_title = $b_product['benefit_product_title'];
                                $benefit_product_info = $b_product['benefit_product_info'];
                                $benefit_wrapper = ($benefits_products_counter % 2 == 0);
                                echo ($benefit_wrapper) ? '<div>' : ''; ?>
                                    <div class="product-card-pro">
                                        <?php if (!empty($benefit_product_img)): ?>
                                            <div class="img-frame">
                                                <img src="<?php echo $benefit_product_img['url']; ?>" alt="<?php echo $benefit_product_img['alt']; ?>" />
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($benefit_product_title)): ?>
                                            <strong class="title"><?php echo $benefit_product_title; ?></strong>
                                        <?php endif; ?>
                                        <?php if (!empty($benefit_product_info)): ?>
                                            <p><?php echo $benefit_product_info; ?></p>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $benefit_product_link ) ): ?>
                                            <a href="<?php echo esc_url($benefit_product_link['url']); ?>"
                                               target="<?php echo esc_attr(!empty($benefit_product_link['target']) ? $benefit_product_link['target'] : '_self'); ?>">
                                                <?php echo esc_html($benefit_product_link['title']); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <?php echo (!$benefit_wrapper) ? '</div>' : '';
                                $benefits_products_counter++;
                            endforeach;
                            if (count($benefits_products) % 2 === 1):
                                echo '</div>';
                            endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col wow fadeInRightBig">
                <div class="bg-holder">
                    <?php if (!empty($benefits_right_title)): ?>
                        <span class="text-bunner"><?php echo $benefits_right_title; ?></span>
                    <?php endif; ?>
                    <?php if (!empty($benefits_right_subtitle)): ?>
                        <strong class="title"><?php echo $benefits_right_subtitle; ?></strong>
                    <?php endif; ?>
                    <?php if (!empty($benefits_list_items)): ?>
                        <ul class="benefits-list">
                            <?php foreach ($benefits_list_items as $b_l_items):
                            $benefit_item_img = $b_l_items['benefit_item_img'];
                            $benefit_item_title = $b_l_items['benefit_item_title'];
                            $benefit_item_info = $b_l_items['benefit_item_info']; ?>
                                <li>
                                    <?php if (!empty($benefit_item_img)): ?>
                                        <div class="icon">
                                            <img src="<?php echo $benefit_item_img['url']; ?>" alt="<?php echo $benefit_item_img['alt']; ?>" />
                                        </div>
                                    <?php endif; ?>
                                    <div class="text-box">
                                        <?php if (!empty($benefit_item_title)): ?>
                                            <strong class="benefits-title"><?php echo $benefit_item_title; ?></strong>
                                        <?php endif; ?>
                                        <?php if (!empty($benefit_item_info)): ?>
                                            <p><?php echo $benefit_item_info; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>