<?php
register_nav_menus(
    array(
        'header_main' => __( 'Header Main Menu', TEXT_DOMAIN ),
        'footer_left' => __( 'Footer Left Menu', TEXT_DOMAIN ),
        'footer_center' => __( 'Footer Center Menu', TEXT_DOMAIN )
    )
);

/**
 * Header_Walker_Nav_Menu
 */
class Header_Walker_Nav_Menu extends Walker {

    var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class='dropdown-menu menu-slider'>\n";
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</div>\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        global $wp_query;
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $class_names = $value = '';
        $classes = empty($item->classes) ? array() : (array)$item->classes;
        // add active class
        if (in_array('current-menu-item', $classes)) {
            $classes[] = 'active';
            unset($classes['current-menu-item']);
        }
        // check for children
        $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
        if (!empty($children)) {
            $classes[] = 'dropdown';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        // li
        if ($depth == 1) {
            $output .= $indent . '<div' . $id . $value . $class_names . '>';
        } else {
            $output .= $indent . '<li ' . $id . $value . $class_names . '>';
        }
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $item_output = $args->before;
        if ($depth == 1) {
            $item_image = get_field('item_image', $item->ID);
            $item_image_url = !empty($item_image['url']) ? $item_image['url'] : '';
            $item_image_alt = !empty($item_image['alt']) ? $item_image['alt'] : 'director photo';
            $item_image_output = !empty($item_image) ? '<div class="img-menu"><img src="' . $item_image_url . '" alt="' . $item_image_alt . '"/></div>' : '';
            $item_output .= '<a class="navigation__link"' . $attributes . '>' . $item_image_output . '';
        } else {
            $item_output .= '<a' . $attributes . '>';
        }
        $item_output .= '<span>' . $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after . '</span>';
        $item_output .= '</a>';
        $item_output .= $args->after;
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function end_el(&$output, $item, $depth = 0, $args = array()) {
        // /li
        if ($depth == 1) {
            $output .= "</div>\n";
        } else {
            $output .= "</li>\n";
        }
    }
} // /Header_Walker_Nav_Menu