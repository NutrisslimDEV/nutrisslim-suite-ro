<?php
use Elementor\Widget_Base;

class Nutrisslim_ACF_Media_Content_Widget extends Widget_Base {

    public function get_name() {
        return 'nutrisslim_acf_media_content';
    }

    public function get_title() {
        return __( 'ACF Media Content', 'nutrisslim-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'nutrisslim' ];
    }

    protected function _register_controls() {
        // No controls are needed as the data comes directly from ACF.
    }

    protected function render() {
        if (!function_exists('get_field')) {
            echo 'ACF is not active.';
            return;
        }

        ?>
        <?php

        $current_acf_field = 'media_content';
        $media_contents = get_field('media_content');

        if (!$media_contents) {
            // echo 'No media content found.';
            return;
        }
        /*
        echo '<pre>';
        print_r($media_contents);
        echo '</pre>';
        */

        // Render each media content section
        foreach ($media_contents as $media_content) {
            $image_id = $media_content['image'];
            $description = $media_content['description'];

            if ($media_content['title']) {
                echo '<div class="subsection media-content-subsection-single ' . $media_content['style'] . '">';
                if ($description) {
                    echo '<div class="content-holder">' . $media_content['title'] . '</div>';
                }
                echo '</div>';
            }

            if ($image_id) {
                echo '<div class="subsection media-content-subsection ' . $media_content['style'] . '">';
                if ($image_id) {
                    $image_url = wp_get_attachment_image_url($image_id, 'large'); // Get the URL of the 'large' size image.
                    if ($image_url) {
                        echo '<div class="img-holder"><img src="' . esc_url($image_url) . '" alt="' . get_the_title() . '" style="max-width: 100%; height: auto;"></div>';
                    }
                }
                if ($description) {
                    echo '<div class="content-holder">' . $description . '</div>';
                }
                echo '</div>';
            } else {
                echo '<div class="subsection media-content-subsection-single ' . $media_content['style'] . '">';
                if ($description) {
                    echo '<div class="content-holder">' . $description . '</div>';
                }
                echo '</div>';
            }

            // New block for option_with_icons
            if (!empty($media_content['option_with_icons'])) {
                echo '<div class="option-with-icons-wrapper">';

                foreach ($media_content['option_with_icons'] as $option) {

                    // Main image (main_slika)
                    $main_slika_url = $option['main_slika'];

                    // Radio button layout value (vrstni_red)
                    $layout = $option['vrstni_red'];

                    // Start layout container
                    echo '<div class="option-row layout-' . esc_attr($layout) . '">';

                    if ($layout === 'slika-levo') {
                        // IMAGE LEFT
                        if ($main_slika_url) {
                            echo '<div class="option-main-img"><img src="' . esc_url($main_slika_url) . '" alt="" style="max-width:100%; height:auto;"></div>';
                        }

                        // Content right
                        echo '<div class="option-content">';
                        if (!empty($option['ikone_in_besedilo'])) {
                            echo '<div class="icons-text-group">';
                            foreach ($option['ikone_in_besedilo'] as $item) {
                                $icon_url = $item['ikona']; // Assuming image URL is returned directly
                                $besedilo = $item['besedilo'];

                                echo '<div class="icon-text-item">';

                                // Icon image
                                if ($icon_url) {
                                    echo '<div class="icon"><img src="' . esc_url($icon_url) . '" alt="" style="width:50px; height:auto;"></div>';
                                }

                                // Text (besedilo)
                                if ($besedilo) {
                                    echo '<div class="text">' . $besedilo . '</div>';
                                }

                                echo '</div>'; // icon-text-item
                            }
                            echo '</div>'; // icons-text-group
                        }
                        echo '</div>'; // option-content

                    } else {
                        // IMAGE RIGHT (reverse order)

                        // Content left
                        echo '<div class="option-content">';
                        if (!empty($option['ikone_in_besedilo'])) {
                            echo '<div class="icons-text-group">';
                            foreach ($option['ikone_in_besedilo'] as $item) {
                                $icon_url = $item['ikona'];
                                $besedilo = $item['besedilo'];

                                echo '<div class="icon-text-item">';

                                // Icon image
                                if ($icon_url) {
                                    echo '<div class="icon"><img src="' . esc_url($icon_url) . '" alt="" style="width:50px; height:auto;"></div>';
                                }

                                // Text (besedilo)
                                if ($besedilo) {
                                    echo '<div class="text">' . $besedilo . '</div>';
                                }

                                echo '</div>'; // icon-text-item
                            }
                            echo '</div>'; // icons-text-group
                        }
                        echo '</div>'; // option-content

                        // Image right
                        if ($main_slika_url) {
                            echo '<div class="option-main-img"><img src="' . esc_url($main_slika_url) . '" alt="" style="max-width:100%; height:auto;"></div>';
                        }
                    }

                    echo '</div>'; // option-row
                }

                echo '</div>'; // option-with-icons-wrapper
            }

            // Render Banner Section
            if (!empty($media_content['enable_banner']) && in_array('Enable', $media_content['enable_banner'])) {

                $banner_image = $media_content['banner_image'];
                $banner_text = $media_content['banner'];
                $banner_color = $media_content['banner_color'];

                if ($banner_image) {
                    $banner_image_url = is_numeric($banner_image)
                        ? wp_get_attachment_image_url($banner_image, 'large')
                        : $banner_image;
                } else {
                    $banner_image_url = '';
                }

                // Render banner with background image
                echo '<div class="nutrisslim-banner" style="position: relative; background-image: url(\'' . esc_url($banner_image_url) . '\'); background-size: cover; background-position: center; min-height: 500px;">';

                if (!empty($banner_text)) {
                    echo '<div class="nutrisslim-banner-text" style="position: absolute; bottom: 0; left: 0; right: 0; background-color: ' . esc_attr($banner_color) . '; color: #fff; text-align: center; padding: 20px; font-weight: bold;">';
                    echo wp_kses_post($banner_text);
                    echo '</div>';
                }

                echo '</div>'; // .nutrisslim-banner
            }
        }
    }
}