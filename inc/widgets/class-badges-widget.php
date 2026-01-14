<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Badge_Widget extends Widget_Base {

    public function get_name() {
        return 'custom_svg_swiper';
    }

    public function get_title() {
        return __( 'Badges Widget', 'custom-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return [ 'nutrisslim', 'nutrisslim-landing' ];
    }

    protected function _register_controls() {
        // Register widget controls here, if needed.
    }

    protected function render() {
        // Generate a unique ID for each Swiper instance
        $unique_id = 'swiper-svg-' . uniqid();
        ?>

        <?php
        echo '<div class="swiper-badges swiper-svg ' . $unique_id . '">';
        echo '<div class="swiper-wrapper">';

        $current_language = get_locale();

        // Define the SVG images
        $svg_images = [
            get_nutrislim_assets_url() . 'badges/badge_16_' . $current_language . '.svg',
            get_nutrislim_assets_url() . 'badges/badge_12_' . $current_language . '.svg',
            get_nutrislim_assets_url() . 'badges/badge_13_' . $current_language . '.svg',
            get_nutrislim_assets_url() . 'badges/badge_14_' . $current_language . '.svg',
            get_nutrislim_assets_url() . 'badges/badge_15_' . $current_language . '.svg',
        ];

        // Loop through SVG images and display each one
        foreach ($svg_images as $index => $svg_url) {
            echo '<div class="swiper-slide">';
            echo '<div class="inner">';
            echo '<img src="' . esc_url($svg_url) . '" alt="Badge ' . ($index + 1) . '">';
            echo '</div>';
            echo '</div>';
        }

        echo '</div>'; // .swiper-wrapper
        echo '<div class="swiper-pagination"></div>'; // Optional pagination
        echo '</div>'; // .swiper-svg
        
        ?>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var svgSwiper = new Swiper('.<?php echo $unique_id; ?>', {
                    // Parameters
                    slidesPerView: 3, // Number of slides per view on desktop
                    spaceBetween: 10, // Optional space between slides
                    loop: true,           // Enable looping
                    centeredSlides: false, // Center slides
                    // Responsive breakpoints
                    autoplay: { 
                        delay: 2500, 
                        disableOnInteraction: false 
                    },
                    breakpoints: {
                        480: {
                            slidesPerView: 4, // Number of slides per view on mobile
                            spaceBetween: 10, // Optional space between slides
                            centeredSlides: false, // Center slides
                            loop: true,
                            autoplay: { 
                                delay: 2500, 
                                disableOnInteraction: false 
                            },                            
                        },                        
                        767: {
                            slidesPerView: 5, // Number of slides per view on mobile
                            spaceBetween: 10, // Optional space between slides
                            centeredSlides: false, // Center slides
                            autoplay:false
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
