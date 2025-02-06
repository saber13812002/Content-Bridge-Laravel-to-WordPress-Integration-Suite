<?php
namespace ElementorHelloWorld\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Custom_Text_Widget extends Widget_Base {

    public function get_name() {
        return 'custom_text_widget';
    }

    public function get_title() {
        return __( 'ویجت متن سفارشی', 'elementor-hello-world' );
    }

    public function get_icon() {
        return 'eicon-text';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'محتوا', 'elementor-hello-world' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'custom_text',
            [
                'label' => __( 'متن سفارشی', 'elementor-hello-world' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'این یک متن سفارشی است.', 'elementor-hello-world' ),
                'placeholder' => __( 'متن خود را وارد کنید', 'elementor-hello-world' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        echo '<div class="custom-text-widget">';
        echo esc_html( $settings['custom_text'] );
        echo '</div>';
    }

    protected function content_template() {
        ?>
        <div class="custom-text-widget">
            {{{ settings.custom_text }}}
        </div>
        <?php
    }
}