<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YYFNENDRGP"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-YYFNENDRGP');
    </script>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php echo is_front_page() ? get_bloginfo( 'name' ) : wp_title( '' ); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo PATH_TO_FRONT . 'img/favicon.svg'; ?>">
    <?php if ( is_single() ): ?>
        <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=640b266fe1ac6c001a8a8545&product=inline-share-buttons' async='async'></script>
    <?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper">
    <header id="header">
        <?php
        $header_logo = get_field('header_logo', 'option');
        $header_email = get_field('header_email', 'option');
        $header_phone = get_field('header_phone', 'option');
        $header_worksheet = get_field('header_worksheet', 'option');
        $header_login_title = get_field('header_login_title', 'option');
        $header_login_links = get_field('header_login_links', 'option');
        ?>
        <div class="header_contacts">
            <div class="container">
                <?php if ( ! empty( $header_worksheet ) ): ?>
                    <time class="work-time">
                        <i class="icon-clock"></i> <?php echo $header_worksheet; ?></time>
                <?php endif; ?>
                <?php if ( ! empty( $header_logo ) ): ?>
                    <a href="<?php echo get_home_url(); ?>" class="logo">
                        <img src="<?php echo $header_logo['url']; ?>" alt="<?php echo $header_logo['alt']; ?>" width="146" height="28">
                    </a>
                <?php endif; ?>
                <div class="header_contacts_right">
                    <ul class="header_contacts_list">
                        <?php if ( ! empty( $header_email ) ): ?>
                            <li>
                                <a class="mobile-hidden" href="mailto:<?php echo antispambot($header_email); ?>">
                                    <i class="icon-mail"></i><span><?php echo antispambot($header_email); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ( ! empty( $header_phone ) ): ?>
                            <li>
                                <a href="https://api.whatsapp.com/send?phone=<?php echo clean_phone($header_phone); ?>&text=Hello this is the starting message" target="_blank">
                                    <i class="icon-whatsapp"></i><span><?php echo $header_phone; ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <?php if ( ! empty( $header_login_title ) && ! empty( $header_login_links ) ): ?>
                        <div class="login_btn">
                            <i class="icon-login"></i>
                            <span><?php echo $header_login_title; ?></span>
                            <ul class="login_btn_list">
                                <?php foreach ($header_login_links as $h_login_link):
                                    $login_link = $h_login_link['login_link'] ?? ''; ?>
                                    <li>
                                        <a href="<?php echo esc_url($login_link['url']); ?>"
                                           target="<?php echo esc_attr(!empty($login_link['target']) ? $login_link['target'] : '_self'); ?>">
                                            <?php echo esc_html($login_link['title']); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div class="nav-opener">
                        <span></span>
                        <div class="mobile-cart-count"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_menu_holder">
            <div class="container">
                <div class="mobile-holder">
                    <div class="header_menu_left">
                        <?php
                        if ( has_nav_menu( 'header_main' ) ) : ?>
                            <?php if ( ! empty( $header_logo ) ): ?>
                                <a href="<?php echo get_home_url(); ?>" class="logo mobile-hidden">
                                    <img src="<?php echo $header_logo['url']; ?>" alt="<?php echo $header_logo['alt']; ?>" width="146" height="28">
                                </a>
                            <?php endif; ?>
                            <?php wp_nav_menu( array(
                                    'theme_location'  => 'header_main',
                                    'container'       => 'nav',
                                    'container_class' => 'navigation',
                                    'items_wrap'      => '<ul class="menu">%3$s</ul>',
                                    'walker'          => new Header_Walker_Nav_Menu
                                )
                            ); ?>
                        <?php endif; ?>
                    </div>
                    <div class="header_menu_right">
                        <?php echo do_shortcode("[woo_cart_but]"); ?>
                    </div>
                </div>
                <div class="mobile-menu-info">
                    <?php if (!empty($header_worksheet)): ?>
                        <time class="work-time">
                            <i class="icon-clock"></i> <?php echo $header_worksheet; ?></time>
                    <?php endif; ?>
                    <ul class="header_contacts_list">
                        <?php if (!empty($header_email)): ?>
                            <li>
                                <a href="mailto:<?php echo antispambot($header_email); ?>">
                                    <i class="icon-mail"></i><span><?php echo antispambot($header_email); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($header_phone)): ?>
                            <li>
                                <a href="https://api.whatsapp.com/send?phone=<?php echo clean_phone($header_phone); ?>&text=Hello this is the starting message"
                                   target="_blank">
                                    <i class="icon-whatsapp"></i><span><?php echo $header_phone; ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <?php if (!empty($header_login_title) && !empty($header_login_links)): ?>
                        <div class="login_btn">
                            <i class="icon-login"></i>
                            <span><?php echo $header_login_title; ?></span>
                            <ul class="login_btn_list">
                                <?php foreach ($header_login_links as $h_login_link):
                                    $login_link = $h_login_link['login_link'] ?? ''; ?>
                                    <li>
                                        <a href="<?php echo esc_url($login_link['url']); ?>"
                                           target="<?php echo esc_attr(!empty($login_link['target']) ? $login_link['target'] : '_self'); ?>">
                                            <?php echo esc_html($login_link['title']); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
        <main>
        <?php
        $enable_breadcrumbs = get_field('enable_breadcrumbs');
        if (function_exists('rank_math_the_breadcrumbs') && (is_404() || is_shop() || is_cart() || is_checkout() || is_product_category() || is_product() || is_blog() || $enable_breadcrumbs == 1)) : ?>
            <div class="breadcrumbs">
                <?php rank_math_the_breadcrumbs(); ?>
            </div>
        <?php endif; ?>