<?php
function register_program_post_type() {
    $args = [
        'label' => 'Programs',
        'description' => 'Programs imported from Laravel API',
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'taxonomies' => ['category', 'post_tag'],
        'menu_icon' => 'dashicons-media-code',
        'rewrite' => ['slug' => 'program'],
    ];

    register_post_type('programs', $args);
}

add_action('init', 'register_program_post_type');

function display_programs() {
    ob_start();

    $args = [
        'post_type' => 'programs',
        'posts_per_page' => 5
    ];
    $query = new \WP_Query($args);

    if ($query->have_posts()) {
        $output = '<ul>';
        while ($query->have_posts()) {
            $query->the_post();
            $output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }
        $output .= '</ul>';
    } else {
        $output = 'برنامه‌ای یافت نشد.';
    }

    wp_reset_postdata();
    return ob_get_clean();
}

add_shortcode('display_programs', 'display_programs');