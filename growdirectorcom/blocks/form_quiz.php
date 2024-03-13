<?php
$quiz_title = get_sub_field('quiz_title');
$quiz_subtitle = get_sub_field('quiz_subtitle');
$quiz_form_select = get_sub_field('quiz_form_select'); //id
$quiz_title_h = get_query_var('blocks_counter') == 0 ? '<h1>' . $quiz_title . '</h1>' : '<h2 class="h1">' . $quiz_title . '</h2>';
?>
<section class="section-quiz" id="section-quiz">
    <div class="container">
        <div class="left-part">
            <?php if (!empty($quiz_title)) : echo $quiz_title_h; endif; ?>
            <?php if (!empty($quiz_subtitle)): ?>
                <p class="slogan"><?php echo $quiz_subtitle; ?></p>
            <?php endif; ?>
        </div>
        <?php if (!empty($quiz_form_select)): ?>
            <div class="right-part">
                <?php echo do_shortcode('[contact-form-7 id="' . $quiz_form_select[0] . '" html_class="form-quiz"]'); ?>
            </div>
        <?php endif; ?>
    </div>
</section>