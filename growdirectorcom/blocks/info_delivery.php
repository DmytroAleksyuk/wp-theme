<?php
$delivery_chess = get_sub_field('delivery_chess');
?>
<section class="delivery-section">
    <?php if (!empty($delivery_chess)):
        foreach ($delivery_chess as $d_chess):
            $delivery_title = $d_chess['delivery_title'];
            $delivery_img = $d_chess['delivery_img'];
            $delivery_description = $d_chess['delivery_description']; ?>
            <div class="container">
                <?php if (!empty($delivery_title)): ?>
                    <h3><?php echo $delivery_title; ?></h3>
                <?php endif; ?>
                <div class="two-columns">
                    <?php if (!empty($delivery_img)): ?>
                        <div class="col-img">
                            <img src="<?php echo $delivery_img['url']; ?>"
                                 alt="<?php echo $delivery_img['alt']; ?>"/>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($delivery_description)): ?>
                        <div class="col-text">
                            <?php echo $delivery_description; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach;
    endif; ?>
</section>