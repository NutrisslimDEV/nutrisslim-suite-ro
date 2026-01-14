<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Bottom_List_Section_Widget extends Widget_Base {

    public function get_name() {
        return 'bottom_list_section';
    }

    public function get_title() {
        return __( 'Bottom List Section', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-editor-list-ul';
    }

    public function get_categories() {
        return [ 'nutrisslim' ]; // Assigning the widget to the 'nutrisslim' category
    }

    protected function _register_controls() {
        // You can register widget controls here if needed.
    }

    protected function render() {
        // Assume 'lists_section' is the ACF repeater field name
        $lists_section = get_field('lists_section');

        // If $lists_section is empty or does not have a second item, stop rendering.
        if ( empty($lists_section) || !isset($lists_section[1]) || empty($lists_section[1]) ) {
            return; 
        }

        $first_section = $lists_section[1]; // Now we know it’s safe to use [1].

        ?>
        <style>
            .list-section h2 {
                text-align:center;
            }
            .lists-container {
                display:flex;
            }
            .lists-container .list {
                flex-basis: 35%;
                max-width: 35%; 
                padding:10px;
                display: flex;
                justify-content: center;
                align-items: center;                
            }
            .lists-container .middle-img {
                flex-basis: 30%;
                max-width: 30%;
                display:flex;
                flex-direction:column;
                justify-content: center;
                align-items: center;                 
            }
            .lists-container button {
                background-color: #1FB15A;
                border-radius: 35px 35px 35px 35px;
                padding: 8px 40px 8px 40px;  
                margin-top:10px;
                border-color:#0ea44b;              
            }
        </style>
        <?php

        echo '<div class="list-section top-list-section">';

        // Replace 'sub_field_name' with your actual subfield names
        if ( !empty($first_section['section_title']) ) {
            echo '<h2>' . esc_html($first_section['section_title']) . '</h2>';
        }

        echo '<div class="lists-container">';

            // Left Column
            echo '<div class="list greenCheckList checkPlus">';
                echo '<div class="inner">';
                    echo '<h3>' . esc_html($first_section['lists']['list-column'][0]['list_title']) . '</h3>';
                    echo '<ul>';
                    if ( !empty($first_section['lists']['list-column'][0]['list_items']) ) {
                        foreach ( $first_section['lists']['list-column'][0]['list_items'] as $item ) {
                            echo '<li>' . esc_html($item['list_item']) . '</li>';
                        }
                    }
                    echo '</ul>';
                echo '</div>';
            echo '</div>'; // .list

            // Middle Image + Button
            if ( !empty($first_section['image']['sizes']['medium_large']) ) {
                echo '<div class="middle-img">';
                    echo '<img width="' . esc_attr($first_section['image']['sizes']['medium_large-width']) . '" height="' . esc_attr($first_section['image']['sizes']['medium_large-height']) . '" src="' . esc_url($first_section['image']['sizes']['medium_large']) . '" class="img-responsive" />';
                    echo '<button class="elementor-button">' . esc_html__('Buy', 'nutrisslim-suiteV2') . '</button>';
                echo '</div>'; // .middle-img
            }

            // Right Column
            echo '<div class="list greenCheckList checkMinus">';
                echo '<div class="inner">';
                    echo '<h3>' . esc_html($first_section['lists']['list-column'][1]['list_title']) . '</h3>';
                    echo '<ul>';
                    if ( !empty($first_section['lists']['list-column'][1]['list_items']) ) {
                        foreach ( $first_section['lists']['list-column'][1]['list_items'] as $item ) {
                            echo '<li>' . esc_html($item['list_item']) . '</li>';
                        }
                    }
                    echo '</ul>';
                echo '</div>'; // .inner
            echo '</div>'; // .list

        echo '</div>'; // .lists-container
        echo '</div>'; // .list-section
    }
}
