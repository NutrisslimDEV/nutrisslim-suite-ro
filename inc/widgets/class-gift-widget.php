<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Gift_Widget extends Widget_Base {

    public function get_name() {
        return 'gift_widget';
    }

    public function get_title() {
        return __( 'Gift', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-favorite';
    }

    public function get_categories() {
        return [ 'nutrisslim' ]; // Ensure this category exists in Elementor or replace with an existing one.
    }

    protected function _register_controls() {
        // You can register widget controls here if needed.
    }

    protected function render() {
        $cover_image = get_field('cover_image');
        $book_file = get_field('book_file');
        if (empty($book_file['url'])) {
            return;
        }
        echo '<div class="gift grid-middle-noGutter">';
        echo '<div class="gitftTitle col-8">';
        echo '<h3>' . __('FREE<br />E-book', 'nutrisslim-suiteV2') . ' ' . esc_html($book_file['title']) . '!</h3>';
        echo '<p>' . $book_file['description'] . '</p>';
        echo '</div>'; // giftTitle
        echo '<div class="gitftImg col-4">';
        echo '<img class="img-responsive" src="' . wp_get_attachment_image_url($cover_image, 'medium') . '" />';
        echo '</div>'; // giftTitle
        echo '</div>';
    }
}