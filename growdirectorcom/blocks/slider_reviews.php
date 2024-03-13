<?php
$reviews_title = get_sub_field('reviews_title');
$reviews_slides = get_sub_field('reviews_slides');
$reviews_title_h = get_query_var('blocks_counter') == 0 ? '<h1>' . $reviews_title . '</h1>' : '<h2 class="h1">' . $reviews_title . '</h2>';
?>
<section class="section-reviews fadeInUp wow">
    <div class="container">
        <?php if (!empty($reviews_title)) : echo $reviews_title_h; endif; ?>
    </div>
    <div class="bg-holder">
        <?php if (!empty($reviews_slides)): ?>
            <div class="reviews-slider">
                <?php foreach ($reviews_slides as $r_slide):
                    $review_slide_img = $r_slide['review_slide_img'];
                    if (!empty($review_slide_img)):?>
                        <div>
                            <div class="reviews-card">
                                <img src="<?php echo $review_slide_img['url']; ?>"
                                     alt="<?php echo $review_slide_img['alt']; ?>"/>
                            </div>
                        </div>
                    <?php endif;
                endforeach; ?>
            </div>
            <div class="reviews-slider-nav">
                <button type="button" class="slick-arrow icon-arrow-thin-left"></button>
                <button type="button" class="slick-arrow icon-arrow-thin-right"></button>
            </div>
        <?php endif; ?>
    </div>
</section>