<?php
// Include custom jQuery
// IMPORTANT: The handle needs to stay named 'jquery' for plugins to work! 
function educraft_include_custom_jquery()
{
    wp_deregister_script('jquery');
    $filenameJQ = get_template_directory_uri() . '/jquery/jquery.min.js';
    wp_enqueue_script('jquery', $filenameJQ, array(), null, false);
}
add_action('wp_enqueue_scripts', 'educraft_include_custom_jquery');
function educraft_boilerplate_assets()
{
    $theme_version = wp_get_theme()->get('Version');

    wp_enqueue_style(
        'educraft-boilerplate-style',
        get_template_directory_uri() . '/assets/css/style.css',
        array(),
        $theme_version
    );

    wp_enqueue_script(
        'educraft-boilerplate-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        $theme_version,
        true
    );
}
add_action('wp_enqueue_scripts', 'educraft_boilerplate_assets');
