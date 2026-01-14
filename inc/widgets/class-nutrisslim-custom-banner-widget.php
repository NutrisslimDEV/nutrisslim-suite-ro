<?php
use Elementor\Widget_Base;

class Nutrisslim_Custom_Banner_Widget extends Widget_Base {

    public function get_name() {
        return 'nutrisslim_custom_banner';
    }

    public function get_title() {
        return __( 'Custom ACF Banner', 'nutrisslim-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return [ 'nutrisslim' ];
    }

    protected function _register_controls() {
        // No Elementor controls needed — all data comes from ACF
    }

    protected function render() {
        if (!function_exists('get_field')) {
            echo 'ACF is not active.';
            return;
        }

        // Get ACF fields directly
        $banner_image = get_field('banner_image');
        $banner_text = get_field('banner_text');
        $banner_color = get_field('banner__color');

        // Get image URL (handle both ID and URL return formats)
        if ($banner_image) {
            $banner_image_url = is_numeric($banner_image)
                ? wp_get_attachment_image_url($banner_image, 'large')
                : $banner_image;
        } else {
            $banner_image_url = '';
        }

        // Output banner
        if ($banner_image_url || $banner_text) {
            echo '<div class="nutrisslim-custom-banner" style="position: relative; background-image: url(\'' . esc_url($banner_image_url) . '\'); background-size: cover; background-position: center; min-height: 500px;">';
            echo '</div>';
            if (!empty($banner_text)) {
                            echo '<div class="nutrisslim-custom-banner-text" style="position: relative; bottom: 0; left: 0; right: 0; background-color: ' . esc_attr($banner_color) . '; color: #fff; text-align: center; padding: 20px; font-weight: bold;">';
                            echo wp_kses_post($banner_text);
                            echo '</div>';
                        }
        }
    }
}
