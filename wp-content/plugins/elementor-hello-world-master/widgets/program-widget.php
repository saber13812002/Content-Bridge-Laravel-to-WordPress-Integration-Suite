<?php
namespace ElementorHelloWorld\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Program_Widget extends Widget_Base {

    public function get_name() {
        return 'program_widget';
    }

    public function get_title() {
        return __( 'Program Widget', 'elementor-hello-world' );
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function render() {
        $args = [
            'post_type'      => 'programs',
            'posts_per_page' => 5
        ];
        $query = new \WP_Query($args);

        if ($query->have_posts()) {
            echo '<ul>';
            while ($query->have_posts()) {
                $query->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
        } else {
            echo 'برنامه‌ای یافت نشد.';
        }

        wp_reset_postdata();
    }
}