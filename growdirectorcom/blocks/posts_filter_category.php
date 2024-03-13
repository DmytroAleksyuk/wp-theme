<?php
$args = array(
    'taxonomy' => 'category',
    'hide_empty' => true
);
$terms = get_terms($args); ?>
<div class="filter-inner">
    <div class="select">
        <div class="select-option_selected">
            <span class="select-option-text"><?php _e('Select The Category', TEXT_DOMAIN); ?></span>
            <span class="select-option-icon for-img">
            </span>
        </div>
        <?php if ($terms): ?>
            <ul class="select-list">
                <li class="select-option">
                    <a class="select-option-link"
                       href="<?php echo get_permalink(get_option('page_for_posts')); ?>"><?php _e('All', TEXT_DOMAIN); ?></a>
                </li>
                <?php foreach ($terms as $item): ?>
                    <li class="select-option">
                        <a class="select-option-link"
                           href="<?php echo get_category_link($item->term_id); ?>"
                           data-id="<?php echo $item->term_id; ?>"><?php echo $item->name; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>