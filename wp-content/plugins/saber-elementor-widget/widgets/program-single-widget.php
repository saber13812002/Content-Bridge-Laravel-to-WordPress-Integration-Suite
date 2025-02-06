<?php
class Elementor_Program_Single_Widget extends \Elementor\Widget_Base {
    public function get_name() { return 'program_single'; }
    public function get_title() { return 'برنامه تکی'; }
    public function get_icon() { return 'eicon-post'; }
    public function get_categories() { return ['general']; }
    
    protected function render() {
        global $post;
        $post_id = get_the_ID();
        $thumbnail = get_post_meta($post_id, 'thumbnail', true);
        $producer = get_post_meta($post_id, 'producer', true);
        $language = get_post_meta($post_id, 'language', true);
        $persons = get_post_meta($post_id, 'persons', true);
        $topics = get_post_meta($post_id, 'topics', true);

        echo '<div class=\"program-details\">';
        echo '<img src=\"' . esc_url($thumbnail) . '\" alt=\"thumbnail\">';
        echo '<h2>' . get_the_title() . '</h2>';
        echo '<p><strong>تهیه‌کننده:</strong> ' . esc_html($producer) . '</p>';
        echo '<p><strong>زبان:</strong> ' . esc_html($language) . '</p>';
        echo '<p><strong>مهمانان:</strong> ' . esc_html($persons) . '</p>';
        echo '<p><strong>موضوعات:</strong> ' . esc_html($topics) . '</p>';
        echo '</div>';
    }
}
?>
