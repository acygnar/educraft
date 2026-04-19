<?php

/**
 * Header template.
 *
 * @package EducraftBoilerplate
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php wp_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="o-header">
        <div class="o-header__wrapper a-container">
            <a class="site-branding" href="<?php echo esc_url(home_url('/')); ?>">
                <?php bloginfo('name'); ?>
            </a>
            <div class="m-nav">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'header-menu',
                        'menu_id'        => 'header-menu',
                        'menu_class'     => 'm-nav__list',
                    )
                );
                ?>
            </div>
        </div>
    </header>
    <main class="site-main">