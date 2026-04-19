<?php
function educraft_add_cpt_case_studies()
{
    register_post_type(
        'case-studies',
        array(
            'labels' => array(
                'name' => __('Case studies', 'educraft_theme'),
                'singular_name' => __('Case study', 'educraft_theme'),
                'all_items' => __('Case studies', 'educraft_theme'),

            ),
            'description' => __('This is the custom post type for case studies', 'educraft_theme'),
            'public' => true,
            'exclude_from_search' => false,
            'show_ui' => true,
            'query_var' => true,
            'menu_position' => 6,
            'has_archive' => true,
            'capability_type' => 'post',
            'hierarchical' => true,
            'menu_icon'   => 'dashicons-book',
            'show_in_rest' => true,
            'supports' => array('title', 'thumbnail', 'page-attributes', 'custom-fields', 'editor', 'excerpt'),
        )
    );
}

add_action('init', 'educraft_add_cpt_case_studies');
function  add_case_studies_taxonomies()
{
    $labels = array(
        'name' => _x('Branże', 'taxonomy general name'),
        'singular_name' => _x('Branża', 'taxonomy singular name'),
        'search_items' =>  __('Szukaj Branży'),
        'all_items' => __('Wszystkie Branże'),
        'edit_item' => __('Edytuj'),
        'update_item' => __('Aktualizuj'),
        'add_new_item' => __('Dodaj Nową'),
        'new_item_name' => __('Nowa Nazwa'),
        'menu_name' => __('Branże'),
    );

    register_taxonomy('branza', array('case-studies'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite'      => [
            'hierarchical' => true,
        ]
    ));
}
add_action('init', 'add_case_studies_taxonomies', 0);
