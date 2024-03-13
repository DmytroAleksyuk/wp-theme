<?php
$banner_shortcode_add = !empty(get_sub_field('banner_shortcode_add')) ? get_sub_field('banner_shortcode_add') : '[banner_app]';
echo do_shortcode($banner_shortcode_add); ?>