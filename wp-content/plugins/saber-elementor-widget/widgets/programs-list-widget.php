<?php
class Elementor_Programs_List_Widget extends \Elementor\Widget_Base {
    public function get_name() { return 'programs_list'; }
    public function get_title() { return 'لیست برنامه‌ها'; }
    public function get_icon() { return 'eicon-post-list'; }
    public function get_categories() { return ['general']; }
    
    protected function render() {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'programs',
            'posts_per_page' => 5,
            'paged' => $paged
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            echo '<div class="programs-list">';
            while ($query->have_posts()) : $query->the_post();
                $post_id = get_the_ID();
                $thumbnail = get_post_meta($post_id, 'thumbnail', true);
                $producer = get_post_meta($post_id, 'producer', true);
                $id = get_post_meta($post_id, 'id', true);
                $custom_url = add_query_arg('post_id', $id , get_permalink());

                echo '<div class="program-item">';
                echo '<a href="' . get_permalink() . '">';
                echo '<img src="' . esc_url($thumbnail) . '" alt="thumbnail">';
                echo '<h3>' . get_the_title() . '</h3>';
                echo '<p>تهیه‌کننده: ' . esc_html($producer) . '</p>';
                echo '</a>';
                echo '</div>';
                echo '<a href="' . esc_url($custom_url) . '">';
                echo '<h3>' . get_the_title() . '</h3>';
            endwhile;
            echo '</div>';

            // Pagination
            $big = 999999999;
            echo paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $query->max_num_pages
            ));

            wp_reset_postdata();
        else :
            echo 'برنامه‌ای یافت نشد.';
        endif;
    }
}
