<?php
function educraft_filter()
{
    if (is_archive('case-studies')) {
        global $wp_query;

        wp_register_script('ajaxfilter', get_stylesheet_directory_uri() . '/ajax-js/ajax.js', array('jquery'));
        wp_enqueue_script('ajaxfilter');
        wp_localize_script('ajaxfilter', 'params_filter', array(
            'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
            'posts' => json_encode($wp_query->query_vars),
            'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
            'max_page' => $wp_query->max_num_pages,
        ));
    }
}

add_action('wp_enqueue_scripts', 'educraft_filter');


function filter_cs()
{
    $page = isset($_POST['page']) ? max(1, absint($_POST['page'])) : 1;
    $category = isset($_POST['cat']) ? $_POST['cat'] : '';
    $posts_per_page = 10;
    if ($category) {
        $args = array(
            'post_type' => 'case-studies',
            'posts_per_page' => $posts_per_page,
            'paged' => $page,
            'orderby' => array(
                'meta_value_num' => 'ASC',
                'date' => 'ASC',
            ),
            'order' => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'branza',
                    'field' => 'slug',
                    'terms' => $category,
                ),
            ),
        );
    } else {
        $args = array(
            'post_type' => 'case-studies',
            'posts_per_page' => $posts_per_page,
            'paged' => $page,
            'orderby' => array(
                'meta_value_num' => 'ASC',
                'date' => 'ASC',
            ),
            'order' => 'ASC',
        );
    }




    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            get_template_part('/parts/m-tile');
        endwhile;
    else :
        $home_url = home_url();
        $contact_url = trailingslashit($home_url) . 'contact';
?>
        <h3>Brak wyników</h3><br />
        <a class="a-button" href="<?php echo $contact_url; ?>"><span>Skontaktuj się z nami</span></a>
<?php endif;
    wp_die();
}
add_action('wp_ajax_filter_cs', 'filter_cs');
add_action('wp_ajax_nopriv_filter_cs', 'filter_cs');
