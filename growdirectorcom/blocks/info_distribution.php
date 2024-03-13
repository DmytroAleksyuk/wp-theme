<?php
$distribution_title = get_sub_field('distribution_title');
$distribution_subtitle = get_sub_field('distribution_subtitle');
$distribution_columns = get_sub_field('distribution_columns');
$distribution_title_h = get_query_var('blocks_counter') == 0 ? '<h1>' . $distribution_title . '</h1>' : '<h2 class="h1">' . $distribution_title . '</h2>';
?>
<section class="distribution-section fadeInUp wow">
    <div class="container">
        <?php if (!empty($distribution_title)) : echo $distribution_title_h; endif; ?>
        <?php if (!empty($distribution_subtitle)): ?>
            <p class="slogan"><?php echo $distribution_subtitle; ?></p>
        <?php endif; ?>
        <?php if (!empty($distribution_columns)): ?>
            <div class="bottom-text">
                <?php foreach ($distribution_columns as $d_column):
                    $distribution_content = $d_column['distribution_content']; ?>
                    <div>
                        <?php echo $distribution_content; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>