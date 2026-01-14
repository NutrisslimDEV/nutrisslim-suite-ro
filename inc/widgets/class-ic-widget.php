<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class IC_Widget extends Widget_Base {

    public function get_name() {
        return 'ic_widget';
    }

    public function get_title() {
        return __( 'IC Widget', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-posts-ticker';
    }

    public function get_categories() {
        return [ 'nutrisslim' ];
    }

    protected function _register_controls() {
        // Register widget controls here if necessary.
    }

    protected function render() {

        $ic_title = get_field('ic_title');
        $ic_description = get_field('ic_description');
        $ic_icons = get_field('ic_icons'); // Assuming it's a taxonomy term field

        if ( empty($ic_title) && empty($ic_description) && empty($ic_icons) ) {
            return;
        }

        ?>
        <style>
            .ic-widget-container {
                text-align:center;
            }
            .ic-icons {
                margin-top:30px;
                display:flex;
                justify-content:center;                
            }
            .ic-icons .ic-icon {
                padding: 10px 25px;
            }
            .ic-icons .ic-icon p {
                color:black;
                font-size:21px;
                font-weight:bold;
            }
            .ic-icons .ic-icon img {
                width:38px;
                height:38px;
                object-fit:contain;
            }
        </style>
        <?php

        echo '<div class="ic-widget-container">';
        
        // IC Title
        if (!empty($ic_title)) {
            echo '<h2>' . esc_html($ic_title) . '</h2>';
        }

        // IC Description
        if (!empty($ic_description)) {
            echo $ic_description;
        }

        // IC Icons
        if (!empty($ic_icons) && is_array($ic_icons)) {
            echo '<div class="ic-icons">';
            foreach ($ic_icons as $term_id) {
                $term = get_term($term_id);
                if (!$term || is_wp_error($term)) continue;

                // Fetch the ACF image field (attachment ID) for the term
                $image_id = get_field('image', $term);
                
                // Get the image URL in the desired size
                $image_url = wp_get_attachment_image_url($image_id, 'thumbnail');
                
                if (!empty($image_url)) {
                    echo '<div class="ic-icon">';
                    echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)) . '">';
                    echo '<p>' . esc_html($term->name) . '</p>';
                    echo '</div>';
                }
            }
            echo '</div>';
        }

        echo '</div>';

    }
}
