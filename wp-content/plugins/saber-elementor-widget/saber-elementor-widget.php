<?php
/**
 * Plugin Name: Elementor Programs Widget
 * Description: پلاگینی برای افزودن ابزارک‌های نمایش اطلاعات برنامه‌ها در المنتور.
 * Version: 1.0
 * Author: Reza
 */

if (!defined('ABSPATH')) {
    exit;
}

// بررسی نصب المنتور
function check_elementor_active() {
    if (!did_action('elementor/loaded')) {
        add_action('admin_notices', function() {
            echo '<div class="error"><p>Elementor باید نصب و فعال باشد.</p></div>';
        });
        return false;
    }
    return true;
}

// بارگذاری ویجت‌ها
function register_elementor_programs_widgets($widgets_manager) {
    require_once(__DIR__ . '/widgets/program-single-widget.php');
    require_once(__DIR__ . '/widgets/programs-list-widget.php');
    // require_once(__DIR__ . '/widgets/persons-list-widget.php');
    // require_once(__DIR__ . '/widgets/schedule-widget.php');
    
    $widgets_manager->register(new \Elementor_Program_Single_Widget());
    $widgets_manager->register(new \Elementor_Programs_List_Widget());
    // $widgets_manager->register(new \Elementor_Persons_List_Widget());
    // $widgets_manager->register(new \Elementor_Schedule_Widget());
}
add_action('elementor/widgets/register', 'register_elementor_programs_widgets');



function display_program_shortcode($atts) {
    // دریافت پارامتر از URL
    $post_id = isset($_GET['post_id']) ? sanitize_text_field($_GET['post_id']) : '';
    // die($post_id);
    // اگر پارامتر وجود نداشت، پیام خطا نمایش داده می‌شود
    if (!$post_id) {
        return 'پارامتر مورد نظر یافت نشد.';
    }
    
    // جستجوی پست بر اساس پارامتر
    $args = array(
        'post_type' => 'programs',
        'meta_query' => array(
            array(
                'key' => 'id', // نام فیلد سفارشی که پارامتر را در آن ذخیره کرده‌اید
                'value' => $post_id.'',
                'compare' => '='
            )
        )
    );
    // die($post_id);
    $query = new WP_Query($args);
    
    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            
            // نمایش محتوای پست
            echo '<h2>' . get_the_title() . '</h2>';
            echo '<div class="program-content">';
            the_content();
            echo '</div>';
            
            // نمایش فیلدهای سفارشی
            $producer = get_post_meta(get_the_ID(), 'producer', true);
            $language = get_post_meta(get_the_ID(), 'language', true);
            $persons = get_post_meta(get_the_ID(), 'persons', true);
            $topics = get_post_meta(get_the_ID(), 'topics', true);
            
            echo '<div class="program-details">';
            echo '<p><strong>تهیه‌کننده:</strong> ' . esc_html($producer) . '</p>';
            echo '<p><strong>زبان:</strong> ' . esc_html($language) . '</p>';
            echo '<p><strong>مهمانان:</strong> ' . esc_html($persons) . '</p>';
            echo '<p><strong>موضوعات:</strong> ' . esc_html($topics) . '</p>';
            echo '</div>';
        }
        wp_reset_postdata();
        return ob_get_clean();
    } else {
        return 'برنامه‌ای با این مشخصات یافت نشد.';
    }
}
add_shortcode('single_program', 'display_program_shortcode');


?>
