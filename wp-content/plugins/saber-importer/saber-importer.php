<?php




/**
 * Plugin Name: JSON Program Importer
 * Description: پلاگینی برای وارد کردن داده‌های JSON به یک پست تایپ سفارشی در وردپرس.
 * Version: 1.0
 * Author: Saber
 */



if (!defined('ABSPATH')) {
    exit;
}

// ثبت پست تایپ سفارشی
function create_programs_post_type() {
    register_post_type('programs', array(
        'labels'      => array(
            'name'          => __('Programs'),
            'singular_name' => __('Program')
        ),
        'public'      => true,
        'publicly_queryable'    => true,
        'has_archive' => true,
        'supports'    => array('title', 'editor', 'custom-fields'),
    ));
}
add_action('init', 'create_programs_post_type');

// افزودن دکمه به داشبورد
function json_importer_admin_menu() {
    add_menu_page('JSON Importer', 'JSON Importer', 'manage_options', 'json-importer', 'json_importer_page');
}
add_action('admin_menu', 'json_importer_admin_menu');

function json_importer_page() {
    ?>
    <div class="wrap">
        <h1>JSON Importer</h1>
        <p>برای دریافت و ذخیره داده‌های JSON روی دکمه زیر کلیک کنید.</p>
        <form method="post">
            <input type="hidden" name="json_import" value="1">
            <button type="submit" class="button button-primary">دریافت و ذخیره JSON</button>
        </form>
    </div>
    <?php
    if (isset($_POST['json_import'])) {
        fetch_and_store_json_data();
    }
}

function fetch_and_store_json_data() {
    $json_url = 'http://127.0.0.1:8000/api/programs'; // آدرس JSON را اینجا قرار دهید
    $response = wp_remote_get($json_url);
    
    if (is_wp_error($response)) {
        echo '<p>خطا در دریافت JSON</p>';
        return;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (!$data || !isset($data['data'])) {
        echo '<p>داده‌های نامعتبر</p>';
        return;
    }

    // حذف تمام داده‌های قبلی
    $existing_posts = get_posts(['post_type' => 'programs', 'numberposts' => -1]);
    foreach ($existing_posts as $post) {
        wp_delete_post($post->ID, true);
    }

    // ذخیره داده‌های جدید
    foreach ($data['data'] as $program) {
        $post_id = wp_insert_post([
            'post_title'   => $program['title'],
            'post_content' => "[single_program]",
            'post_status'  => 'publish',
            'post_type'    => 'programs',
        ]);
        
        if ($post_id) {
            update_post_meta($post_id, 'name', $program['name']);
            update_post_meta($post_id, 'duration', $program['duration']);
            update_post_meta($post_id, 'producer', $program['producer']);
            update_post_meta($post_id, 'language', $program['language']);
            update_post_meta($post_id, 'is_airing', $program['is_airing']);
            update_post_meta($post_id, 'thumbnail', $program['thumbnail']);
            update_post_meta($post_id, 'bio', $program['bio']);
            update_post_meta($post_id, 'id', $program['id']);
            
            // ذخیره مهمانان
            $persons = array_map(function ($p) {
                return $p['full_name'] . ' (' . $p['role_type'] . ')';
            }, $program['persons']);
            update_post_meta($post_id, 'persons', implode(', ', $persons));
            
            // ذخیره موضوعات
            $topics = array_map(function ($t) {
                return $t['topic_name'];
            }, $program['topics']);
            update_post_meta($post_id, 'topics', implode(', ', $topics));
        }
    }
    echo '<p>داده‌ها با موفقیت ذخیره شدند.</p>';
}
