<?php
$grid_layout_title = get_sub_field('grid_layout_title');
$grid_layout_title_h = get_query_var('blocks_counter') == 0 ? '<h1>' . $grid_layout_title . '</h1>' : '<h2 class="h1">' . $grid_layout_title . '</h2>';
?>

<section class="do-section">
    <div class="container">
        <?php if (!empty($grid_layout_title)) : echo $grid_layout_title_h; endif; ?>
        <?php if( have_rows('grid_layout_rows') ): //flex?>
            <div class="grid-wrapper">
                <?php while( have_rows('grid_layout_rows') ): the_row();
                    if( get_row_layout() == 'row_vertical' ):
                        $vertical_title = get_sub_field('vertical_title');
                        $vertical_img = get_sub_field('vertical_img');
                        $vertical_img_type = get_sub_field('vertical_img_type');
                        $vertical_img_position = get_sub_field('vertical_img_position') == 'top' ? 'top-img ' : '';
                        $vertical_img_type_bg = $vertical_img_type == 'cover' ? ' style="background-image: url(' . $vertical_img['url'] . ')"' : '';
                        $vertical_img_type_bg_class = $vertical_img_type == 'cover' ? 'tall-bg ' : '';
                        ?>
                        <div class="<?php echo $vertical_img_position; echo $vertical_img_type_bg_class; ?>tall wow fadeInUp"<?php echo $vertical_img_type_bg; ?>>
                            <?php if (!empty( $vertical_title ) ): ?>
                                <?php echo $vertical_title; ?>
                            <?php endif; ?>
                            <?php if ( $vertical_img_type == 'small' && !empty( $vertical_img )): ?>
                                <div class="img-frame">
                                    <img src="<?php echo $vertical_img['url']; ?>"
                                         alt="<?php echo $vertical_img['alt']; ?>" />
                                </div>
                            <?php endif; ?>
                        </div>

                    <?php elseif( get_row_layout() == 'row_horizontal' ):
                        $horizontal_title = get_sub_field('horizontal_title');
                        $horizontal_img = get_sub_field('horizontal_img');
                        $horizontal_btn = get_sub_field('horizontal_btn');
                        $horizontal_color = get_sub_field('horizontal_color');
                        $horizontal_img_type = get_sub_field('horizontal_img_type');
                        $horizontal_img_type_bg = $horizontal_img_type == 'cover' ? ' style="background-image: url(' . $horizontal_img['url'] . ')"' : '';
                        $horizontal_img_type_bg_class = $horizontal_img_type == 'cover' ? 'bg-img ' : '';
                        $horizontal_color_class = $horizontal_color == 'green' ? 'bg-green ' : ''; ?>
                        <div class="<?php echo $horizontal_color_class; echo $horizontal_img_type_bg_class; ?>x2 wow fadeInUp"<?php echo $horizontal_img_type_bg; ?>>
                            <?php if($horizontal_img_type == 'small' && ! empty( $horizontal_img )) : ?>
                                <div class="img-frame">
                                    <img src="<?php echo $horizontal_img['url']; ?>" alt="<?php echo $horizontal_img['alt']; ?>" />
                                </div>
                            <?php endif;
                            echo $horizontal_img_type == 'small' ? '<div class="text">' : ''; ?>
                            <?php if (!empty($horizontal_title ) ): ?>
                                <?php echo $horizontal_title; ?>
                            <?php endif; ?>
                            <?php if (!empty($horizontal_btn)): ?>
                                <a class="btn btn-white-border"
                                   href="<?php echo esc_url($horizontal_btn['url']); ?>"
                                   target="<?php echo esc_attr(!empty($horizontal_btn['target']) ? $horizontal_btn['target'] : '_self'); ?>">
                                    <?php echo esc_html($horizontal_btn['title']); ?>
                                </a>
                            <?php endif;
                            echo $horizontal_img_type == 'small' ? '</div>' : ''; ?>
                        </div>

                    <?php elseif( get_row_layout() == 'row_horizontal_wide' ):
                        $horizontal_wide_title = get_sub_field('horizontal_wide_title');
                        $horizontal_wide_img = get_sub_field('horizontal_wide_img');
                        $horizontal_wide_btn = get_sub_field('horizontal_wide_btn');
                        $horizontal_wide_color = get_sub_field('horizontal_wide_color');
                        $horizontal_wide_img_type = get_sub_field('horizontal_wide_img_type');
                        $horizontal_wide_img_type_bg = $horizontal_wide_img_type == 'cover' ? ' style="background-image: url(' . $horizontal_wide_img['url'] . ')"' : '';
                        $horizontal_wide_img_type_bg_class = $horizontal_wide_img_type == 'cover' ? 'bg-img ' : '';
                        $horizontal_wide_color_class = $horizontal_wide_color == 'green' ? 'bg-green ' : ''; ?>
                        <div class="<?php echo $horizontal_wide_color_class; echo $horizontal_wide_img_type_bg_class; ?>x3 wow fadeInUp"<?php echo $horizontal_wide_img_type_bg; ?>>
                            <?php if($horizontal_wide_img_type == 'small' && ! empty( $horizontal_wide_img )) : ?>
                                <div class="img-frame">
                                    <img src="<?php echo $horizontal_wide_img['url']; ?>" alt="<?php echo $horizontal_wide_img['alt']; ?>" />
                                </div>
                            <?php endif;
                            echo $horizontal_wide_img_type == 'small' ? '<div class="text">' : ''; ?>
                            <?php if (!empty($horizontal_wide_title ) ): ?>
                                <?php echo $horizontal_wide_title; ?>
                            <?php endif; ?>
                            <?php if (!empty($horizontal_wide_btn)): ?>
                                <a class="btn btn-white-border"
                                   href="<?php echo esc_url($horizontal_wide_btn['url']); ?>"
                                   target="<?php echo esc_attr(!empty($horizontal_wide_btn['target']) ? $horizontal_wide_btn['target'] : '_self'); ?>">
                                    <?php echo esc_html($horizontal_wide_btn['title']); ?>
                                </a>
                            <?php endif;
                            echo $horizontal_wide_img_type == 'small' ? '</div>' : ''; ?>
                        </div>

                    <?php elseif( get_row_layout() == 'row_square' ):
                        $square_title = get_sub_field('square_title');
                        $square_img = get_sub_field('square_img');
                        $square_btn = get_sub_field('square_btn');
                        $square_color = get_sub_field('square_color');
                        $square_img_position = get_sub_field('square_img_position') == 'bottom' ? 'reverse-column ' : '';
                        $square_img_side = get_sub_field('square_img_side')  == 'right' ? 'right-img ' : '';
                        $square_img_type = get_sub_field('square_img_type'); //conditional acf ('small' priority)
                        $square_img_type_bg = $square_img_type == 'cover' ? ' style="background-image: url(' . $square_img['url'] . ')"' : '';
                        $square_img_type_bg_class = $square_img_type == 'cover' ? 'bg-img ' : '';
                        $square_color_class = $square_color == 'green' ? 'bg-green ' : '';
                        ?>
                        <div class="<?php echo $square_img_side; echo $square_img_position; echo $square_color_class; echo $square_img_type_bg_class; ?>wow fadeInUp"<?php echo $square_img_type_bg; ?>>
                            <?php if ($square_img_type == 'small' && !empty( $square_img ) ): ?>
                                <div class="img-frame">
                                    <img src="<?php echo $square_img['url']; ?>"
                                         alt="<?php echo $square_img['alt']; ?>" />
                                </div>
                            <?php endif; ?>
                            <?php if (!empty( $square_title ) ): ?>
                                <?php echo $square_title; ?>
                            <?php endif; ?>
                            <?php if (!empty($square_btn)): ?>
                                <a class="btn btn-white-border"
                                   href="<?php echo esc_url($square_btn['url']); ?>"
                                   target="<?php echo esc_attr(!empty($square_btn['target']) ? $square_btn['target'] : '_self'); ?>">
                                    <?php echo esc_html($square_btn['title']); ?>
                                </a>
                            <?php endif; ?>
                        </div>

                    <?php endif;
                endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>