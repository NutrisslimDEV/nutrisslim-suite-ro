<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Tag_List_Section_Widget extends Widget_Base {

    public function get_name() {
        return 'tag_list_section';
    }

    public function get_title() {
        return __( 'Tag List Section', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-tags';
    }

    public function get_categories() {
        return [ 'nutrisslim' ];
    }

    protected function _register_controls() {
        // Controls can be registered here if needed.
    }

    protected function render() {
        /*
        $terms = get_terms([
            'taxonomy' => 'product_tag',
            'hide_empty' => false,
        ]);
        */

        $product_id = get_the_id();

        $terms = wp_get_post_terms($product_id, 'product_tag', [
            'hide_empty' => false,
        ]);        

        if (!is_wp_error($terms) && !empty($terms)) {
            $tags_list = array_map(function($term) {
                return sprintf('%2$s', get_term_link($term), esc_html($term->name));
            }, $terms);

            $tags_string = implode(' | ', $tags_list);
            echo '<div class="tag-list-section"><p>' . $tags_string . '</p></div>';
        } else {
            // echo '<p>No product tags found.</p>';
        }
    }
}