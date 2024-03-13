<?php $prev = get_previous_post_link('%link', ' ') ?>
<?php $next = get_next_post_link('%link', ' ') ?>
<?php if ($prev || $next) : ?>
    <div class="navigation-single">
        <?php if ($prev) : ?>
            <div class="prev">
                <?php echo $prev ?>
                <strong><?php _e('Previous article', TEXT_DOMAIN); ?></strong>
            </div><?php endif ?>
        <?php if ($next) : ?>
            <div class="next">
                <strong><?php _e('Next article', TEXT_DOMAIN); ?></strong>
                <?php echo $next ?>
            </div>
        <?php endif ?>
    </div>
<?php endif ?>