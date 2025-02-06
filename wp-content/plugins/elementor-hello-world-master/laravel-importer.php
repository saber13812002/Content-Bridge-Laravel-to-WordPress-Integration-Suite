<?php


require_once plugin_dir_path(__FILE__) . 'functions.php';

function fetch_laravel_programs() {
    $cached_data = get_transient('cached_programs');

    if ($cached_data !== false) {
        return;
    }

    $response = wp_remote_get('http://127.0.0.1:8000/api/programs');
    if (is_wp_error($response)) {
        error_log('Error fetching data from API: ' . $response->get_error_message());
        return;
    }

    $body = wp_remote_retrieve_body($response);
    error_log('API Response: ' . print_r($body, true));

    set_transient('cached_programs', $body, HOUR_IN_SECONDS);

    $programs = json_decode($body, true);
    if ($programs) {
        foreach ($programs as $program) {
            $post_data = [
                'post_title' => $program['title'],
                'post_content' => $program['description'],
                'post_status' => 'publish',
                'post_type' => 'programs'
            ];

            $post_id = wp_insert_post($post_data);
            if (is_wp_error($post_id)) {
                error_log('Error inserting post: ' . $post_id->get_error_message());
            } else {
                error_log('Post inserted successfully: ' . $post_id);
            }
        }
    }
}

register_activation_hook(__FILE__, 'fetch_laravel_programs');