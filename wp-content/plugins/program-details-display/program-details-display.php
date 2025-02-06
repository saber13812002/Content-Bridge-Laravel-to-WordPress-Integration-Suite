<?php
/*
* Plugin Name: نمایش سفارشی پست تایپ
* Description: نمایش مقادیر دلخواه در صفحه جزئیات پست تایپ برنامه ها
* Version: 1.0
* Author: صابر
*/

if (!defined('ABSPATH')) {
    exit;
}

// افزودن محتوا به صفحه جزئیات برنامه
function custom_program_display($content) {
    if (is_singular('programs')) {
        $custom_content = get_custom_program_data();
        $content = $custom_content . $content;
    }
    return $content;
}
add_filter('the_content', 'custom_program_display');

// دریافت و فرمت‌بندی داده‌های سفارشی برنامه
function get_custom_program_data() {
    $post_id = get_the_ID();
    $name = get_post_meta($post_id, 'name', true);
    $duration = get_post_meta($post_id, 'duration', true);
    $producer = get_post_meta($post_id, 'producer', true);
    $language = get_post_meta($post_id, 'language', true);
    $is_airing = get_post_meta($post_id, 'is_airing', true);
    $thumbnail = get_post_meta($post_id, 'thumbnail', true);
    $bio = get_post_meta($post_id, 'bio', true);
    $persons = get_post_meta($post_id, 'persons', true);
    $topics = get_post_meta($post_id, 'topics', true);

    $output = '<div class="program-details">';
    $output .= '<img src="' . esc_url($thumbnail) . '" alt="' . esc_attr($name) . '">';
    $output .= '<h2>' . esc_html($name) . '</h2>';
    $output .= '<p><strong>مدت زمان:</strong> ' . esc_html($duration) . '</p>';
    $output .= '<p><strong>تهیه‌کننده:</strong> ' . esc_html($producer) . '</p>';
    $output .= '<p><strong>زبان:</strong> ' . esc_html($language) . '</p>';
    $output .= '<p><strong>در حال پخش:</strong> ' . ($is_airing ? 'بله' : 'خیر') . '</p>';
    $output .= '<p><strong>توضیحات:</strong> ' . esc_html($bio) . '</p>';
    $output .= '<p><strong>مهمانان:</strong> ' . esc_html($persons) . '</p>';
    $output .= '<p><strong>موضوعات:</strong> ' . esc_html($topics) . '</p>';
    $output .= '</div>';

    return $output;
}

// افزودن استایل CSS
function add_program_details_styles() {
    echo '<style>
        .program-details {
            background-color: #f9f9f9;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .program-details img {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
        }
        .program-details h2 {
            color: #333;
            margin-bottom: 15px;
        }
        .program-details p {
            margin-bottom: 10px;
        }
    </style>';
}
add_action('wp_head', 'add_program_details_styles');