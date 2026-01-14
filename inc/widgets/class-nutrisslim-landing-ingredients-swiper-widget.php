<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Nutrisslim_Landing_Ingredients_Swiper_Widget extends Widget_Base {

    public function get_name() {
        return 'nutrisslim_landing_ingredients_swiper';
    }

    public function get_title() {
        return __( 'Nutrisslim Landing Ingredients Swiper', 'nutrisslim-landing-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return [ 'nutrisslim-landing' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'text-domain' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
    
        $this->add_control(
            'selected_product',
            [
                'label' => __( 'Select Product', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_products(),
                'multiple' => false,
            ]
        );     
    
        $this->end_controls_section();
    }

    protected function get_products() {
        $args = [
            'post_type' => 'product',
            'posts_per_page' => -1
        ];
    
        $products = get_posts( $args );
    
        $options = [];
        foreach ( $products as $product ) {
            $options[ $product->ID ] = $product->post_title;
        }        
    
        return $options;
    } 

    protected function render() {

        $settings = $this->get_settings_for_display();
        $product = get_field('selected_product');
        $product = $product[0];
        $product_id = $settings['selected_product']; 
                
        if ($product_id) {
            $product = $product_id;
        }

        // Get the 'ingredients' field from ACF, which returns an array of term IDs
        $ingredients_ids = get_field('ingredients', $product);

        if (is_array($ingredients_ids)) {
            $n = count($ingredients_ids);
        } else {
            $n = 0; // Set default or handle error appropriately
        }      

        ?>
            <style>
            .swiper-ingradients {
                width: 100%;
                height: auto;
            }
            .swiper-ingradients .swiper-wrapper {
                display: flex;
                align-items: stretch;                
            }
            .swiper-ingradients .swiper-slide {
                text-align:center;
                display: flex;
                flex-direction: column;
                text-align: center;
                height:auto;
            }
            .swiper-ingradients .swiper-slide div.inner {
                background-color:white;
                padding:20px 10px;
                height:100%;
                width:100%;
            }
            .swiper-ingradients img {
                display:inline-block;
                height: 85px;
                width: 200px;
                object-fit: contain;                
            }
            .swiper-ingradients h3 {
                text-align:center;
                font-weight:bold;
                font-size:21px;
            }
            .swiper-ingradients p {
                font-weight:300;
            }
            .elementor-widget-nutrisslim_ingredients_swiper h2 {
                text-align:center;
                margin-bottom:30px;
            }
            </style>
        <?php        

        if (empty($ingredients_ids)) {
            // echo 'No ingredients found.';
            return;
        }

        // Enqueue Swiper's JS and CSS here, if not globally enqueued
        
        // Swiper HTML structure
        ?>

        <?php

        $title = get_field('ingredients_title');
        if (!$title) {
            $title = 'Premium Ingredients';
        }
        echo '<h2>' . esc_html__( $title, 'nutrisslim-elementor-widgets' ) . '</h2>';
        echo '<div class="swiper-ingradients">';
        if ($n < 4) {
            echo '<div class="swiper-wrapper cent">';
            $centra = 'centeredSlides: true,';
        } else {
            echo '<div class="swiper-wrapper">';
            $centra = '';
        }

        // Loop through term IDs and display each ingredient
        $m=1;
        foreach ($ingredients_ids as $term_id) {
            $term = get_term($term_id, 'ingredient');
            if (!$term || is_wp_error($term)) {
                continue;
            }

            // Get term meta for image
            $defaultImg = '/wp-content/uploads/2024/03/nutrisslim-logo-2.png';
            $image_id = get_term_meta($term_id, 'image', true);
            $image_url = wp_get_attachment_image_url($image_id, 'medium');

            if(empty($image_url)) {
                $image_url = $defaultImg;
            }
            
            echo '<div class="swiper-slide">';
            echo '<div class="inner">';
            echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($term->name) . '">';
            echo '<h3>' . $m . '. ' . esc_html($term->name) . '</h3>';
            echo '<p>' . esc_html($term->description) . '</p>';
            echo '</div>';
            echo '</div>';
            $m++;
        }

        echo '</div>'; // .swiper-wrapper
        echo '<div class="swiper-mini-pagination"></div>'; // Optional pagination
        echo '</div>'; // .swiper-container
        
        if ($m - 1 > 4) {
            $noslides = 4;
        } else {
            $noslides = $m - 1;
        }

        ?>
        <script>

document.addEventListener("DOMContentLoaded", function() {
    var ingradientsSwiper = new Swiper('.swiper-ingradients', {
        // Parameters
        slidesPerView: 1.2, // Number of slides per view on desktop
        spaceBetween: 30, // Optional space between slides
        loop: true,           // Enable looping
        centeredSlides: false, // Center slides
        pagination: {
            el: '.swiper-mini-pagination',
            clickable: true,
        },
        // Responsive breakpoints
        breakpoints: {
            // when window width is <= 480px
            480: {
                slidesPerView: 2, // Number of slides per view on mobile
                spaceBetween: 10, // Optional space between slides
                centeredSlides: false,
            },
            767: {
                slidesPerView: <?php echo $noslides; ?>, // Number of slides per view on mobile
                spaceBetween: 10, // Optional space between slides
                centeredSlides: false, // Center slides
            }                        
        }
    });    
});
           

        </script>        
        <?php

    }

    protected function _content_template() {
        // JS content template for frontend rendering if needed
    }
}

// Ensure the class gets loaded and registered.
nutrisslim_include_widgets_files();
