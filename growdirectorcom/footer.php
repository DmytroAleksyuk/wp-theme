</main>
</div>
<footer id="footer">
    <?php
    $footer_info = get_field( 'footer_info', 'option' );
    $footer_socials = get_field( 'footer_socials', 'option' );
    $footer_signup = get_field( 'footer_signup', 'option' );
    $footer_copyright = get_field( 'footer_copyright', 'options' );
    ?>
    <div class="container">
        <div class="four-columns">
            <?php
            $locations = get_nav_menu_locations();
            if (has_nav_menu('footer_left')) :
                $left_menu_title = wp_get_nav_menu_object($locations['footer_left']); ?>
                <div class="col">
                    <strong><?php echo $left_menu_title->name; ?></strong>
                    <?php wp_nav_menu(array(
                            'theme_location' => 'footer_left',
                            'container' => false,
                            'items_wrap' => '<ul>%3$s</ul>',
                        )
                    ); ?>
                </div>
            <?php endif;
            if (has_nav_menu('footer_center')) :
                $center_menu_title = wp_get_nav_menu_object($locations['footer_center']); ?>
                <div class="col">
                    <strong><?php echo $center_menu_title->name; ?></strong>
                    <?php wp_nav_menu(array(
                            'theme_location' => 'footer_center',
                            'container' => false,
                            'items_wrap' => '<ul>%3$s</ul>',
                        )
                    ); ?>
                </div>
            <?php endif;
            if ( ! empty( $footer_info ) || ! empty( $footer_socials ) ): ?>
                <div class="col">
                    <?php if ( ! empty( $footer_info ) ): echo $footer_info; endif; ?>
                    <?php if ( ! empty( $footer_socials ) ): ?>
                        <ul class="social_list">
                            <?php foreach ($footer_socials as $f_social):
                                $f_social_type = $f_social['footer_social_type'] ?? '';
                                $f_social_link = $f_social['footer_social_url'] ?? '';
                                if ($f_social_type && $f_social_link): ?>
                                    <li><a class="icon-<?php echo $f_social_type; ?>" href="<?php echo esc_url($f_social_link); ?>" target="_blank"></a></li>
                                <?php endif;
                            endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php endif;
            if ( $footer_signup == 1 ) : ?>
                <div class="col">
                    <!-- Begin Mailchimp Signup Form -->
                    <div id="mc_embed_signup">
                        <form action="https://growdirector.us13.list-manage.com/subscribe/post?u=424a8b117fbc18f435500d67d&amp;id=e2a7068df9&amp;f_id=000e96e2f0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_self">
                            <div id="mc_embed_signup_scroll">
                                <div class="mc-field-group">
                                    <label for="mce-EMAIL"></label>
                                    <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Your Email" required>
                                </div>
                                <div id="mce-responses" class="clear foot">
                                    <div class="response" id="mce-error-response" style="display:none"></div>
                                    <div class="response" id="mce-success-response" style="display:none"></div>
                                </div>
                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                    <input type="text" name="b_424a8b117fbc18f435500d67d_e2a7068df9" tabindex="-1" value="">
                                </div>
                                <div class="mc-fake-condition">
                                    <div class="custom-checkbox">
                                        <input type="checkbox" name="terms" id="subscribe" onchange="activateButton(this)" checked/>
                                        <label for="subscribe"> </label>
                                    </div>
                                    <span>
                                        <?php _e('I confirm that I give my consent to the processing of my personal data in accordance with applicable law.', TEXT_DOMAIN); ?>
                                    </span>
                                </div>
                                <div class="optionalParent">
                                    <div class="clear foot">
                                        <input type="submit" value="Sign up for our newsletter" name="subscribe" id="mc-embedded-subscribe" class="button btn btn-blue">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--End mc_embed_signup-->
                </div>
            <?php endif; ?>
        </div>
    </div>
	<?php if ( ! empty( $footer_copyright ) ) : ?>
        <div class="bottom-footer">
            <div class="container">
                <span class="copyright">
                    <?php echo do_shortcode( $footer_copyright ); ?>
                </span>
            </div>
        </div>
	<?php endif; ?>
</footer>
<a href="#wrapper" class="btn-back"></a>
<div class="loader">
    <div class="loader_inner">
        <svg
                width="100"
                height="100"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
            <path
                    class="svg-elem-1"
                    fill="#539266"
                    d="M40.4703 27.5248C40.8174 27.0037 41.3836 26.702 42.0046 26.702C42.6073 26.702 43.1826 27.0037 43.5205 27.5065C43.5662 27.5705 43.6119 27.6528 43.6484 27.7351L63.411 62H71L44.8995 16.7279C44.3242 15.6582 43.21 15 42.0046 15C40.8356 15 39.7489 15.6308 39.1553 16.6456L39.0548 16.8102L13 61.9909H20.589L40.3699 27.6985C40.3973 27.6345 40.4338 27.5797 40.4703 27.5248Z"></path>
            <path
                    fill="#539266"
                    class="svg-elem-2"
                    d="M82.6464 59.5474L53.3709 9.41074H53.38L50.8162 5.02446C49.0069 1.9235 45.6248 0 42.0062 0C38.3877 0 35.0147 1.9235 33.1963 5.02446L32.1962 6.74122L1.35695 59.5474C-0.452315 62.6484 -0.452315 66.5044 1.35695 69.5964C3.16621 72.6973 6.53925 74.6208 10.1578 74.6208L18.4404 74.6298L18.9041 74.6208H35.051H35.1965C37.1512 74.7017 38.6786 76.2747 38.6786 78.1982V86H45.2247V78.1982C45.2247 72.6524 40.6607 68.1403 35.051 68.1403H10.0941C8.83038 68.1133 7.65754 67.4212 7.03021 66.3516C6.38469 65.246 6.38469 63.8708 7.03021 62.7653L38.9059 8.18834C39.5606 7.11873 40.7516 6.4536 42.0153 6.4536C43.2791 6.4536 44.4701 7.11873 45.1247 8.18834L76.9914 62.7563C77.6369 63.8618 77.6369 65.237 76.9914 66.3426C76.364 67.4122 75.1912 68.1043 73.9365 68.1313H62.9264H62.7355C61.4444 68.1313 60.2352 67.4392 59.5897 66.3336L44.8974 41.1664C44.3246 40.1148 43.2154 39.4676 42.0153 39.4676C40.8516 39.4676 39.7697 40.0878 39.1787 41.0855L39.0787 41.2473L26.7775 62.3069H34.3328L40.3788 51.9883C40.4061 51.9254 40.4425 51.8714 40.4788 51.8175C40.8243 51.3052 41.388 51.0086 42.0062 51.0086C42.6063 51.0086 43.1791 51.3052 43.5155 51.7995C43.5609 51.8625 43.6064 51.9434 43.6428 52.0243L53.9074 69.6053C55.7166 72.7063 59.0897 74.6298 62.7082 74.6298H64.9266L64.9175 74.6388H69.6998H71.2545H71.6454H73.8183C77.4369 74.6388 80.8099 72.7063 82.6192 69.6143C84.4557 66.5044 84.4557 62.6484 82.6464 59.5474Z"></path>
        </svg>
    </div>
</div>
<?php wp_footer(); ?>
<script>
    window.addEventListener("load", function () {
        setTimeout(tidioChat, 5000)
    });
    function tidioChat() {
        var script = document.createElement('script');
        script.src = "//code.tidio.co/rwrin4myguwzaqiifk1da4qy5roedrah.js";
        script.async = true;
        document.getElementsByTagName('head')[0].appendChild(script);
    }
</script>
</body>
</html>