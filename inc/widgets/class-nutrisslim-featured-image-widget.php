<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Nutrisslim_Features_Image_Widget extends Widget_Base {

    public function get_name() {
        return 'nutrisslim_features_image';
    }

    public function get_title() {
        return __( 'Nutrisslim Features Image', 'nutrisslim-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-image-box';
    }

    public function get_categories() {
        return [ 'nutrisslim' ];
    }

    protected function _register_controls() {
        // Optionally, add controls for the widget here.
    }

    protected function render() {

        $featured_image_id = get_field('featured_image');
        $feature_top_left = get_field('featuretopleft');
        $feature_top_right = get_field('featuretopright');
        $feature_bottom_left = get_field('featurebottomleft');
        $feature_bottom_right = get_field('featurebottomright');
        
        if (!$featured_image_id) {
            return;
        }

        ?>
<style>
.nutrisslim-features-image {
    position: relative;
    background-size: cover;
    background-position: center;
    aspect-ratio: 425 / 152;
    min-height: 494px;
}

.nutrisslim-features-image div.feature {
    display: inline-block;
    font-weight: bold;
    text-align: center;
    font-size: 25px;
    line-height: 30px;
    background-color: #fff;
    height: 200px;
    width: 200px;
    border-radius: 200px;
    justify-content: center;
    display: flex;
    align-content: center;
    flex-wrap: wrap;
    color: #ef6d89;
}

.feature-bottom-right {
    margin-bottom: 2rem;
    margin-right: 4rem;
}

.feature-bottom-left {
    margin-bottom: 2rem;
    margin-left: 4rem;
}

.feature-top-right {
    margin-top: 2rem;
    margin-right: 4rem;
}

.feature-top-left {
    margin-top: 2rem;
    margin-left: 4rem;
}

@media (max-width: 1400px) {

    /* Adjust the min-width as needed */
    .nutrisslim-features-image {
        aspect-ratio: auto;
    }
}

@media (max-width: 767px) {

    /* Adjust the min-width as needed */
    .nutrisslim-features-image div.feature {
        font-size: 16px;
        height: 135px;
        width: 135px;
        line-height: 21px;
    }

    .feature-bottom-right {
        margin-bottom: 0.5rem;
        margin-right: 0.5rem;
    }

    .feature-bottom-left {
        margin-bottom: 0.5rem;
        margin-left: 0.5rem;
    }

    .feature-top-right {
        margin-top: 0.5rem;
        margin-right: 0.5rem;
    }

    .feature-top-left {
        margin-top: 0.5rem;
        margin-left: 0.5rem;
    }
}
</style>
<?php

        $featured_image_url = wp_get_attachment_image_url($featured_image_id, 'full');

        if (!$featured_image_url) {
            echo 'No featured image set.';
            return;
        }

        // Output the structure with inline styles for demonstration. Consider enqueuing styles for production.
        echo '<div class="nutrisslim-features-image" style="position: relative; background-image: url(\'' . esc_url($featured_image_url) . '\'); background-size: cover; background-position: center;">';
        // echo '<img src="' . esc_url($featured_image_url) . '" alt="Featured Image" style="width: 100%; height: auto;">';
        
        // This is a simplified example. You should adjust the HTML and CSS according to your design requirements.
        echo '<div class="feature feature-top-left" style="position: absolute; top: 0; left: 0;">' . esc_html($feature_top_left) . '</div>';
        echo '<div class="feature feature-top-right" style="position: absolute; top: 0; right: 0;">' . esc_html($feature_top_right) . '</div>';
        echo '<div class="feature feature-bottom-left" style="position: absolute; bottom: 0; left: 0;">' . esc_html($feature_bottom_left) . '</div>';
        echo '<div class="feature feature-bottom-right" style="position: absolute; bottom: 0; right: 0;">' . esc_html($feature_bottom_right) . '</div>';
        
        global $product;
        $price = $product->get_price();
        $consumption_period = get_field('consumption_period');

        // Get price including tax
        $price_with_tax = wc_get_price_including_tax($product);

        // Convert to float for calculation
        $price_with_tax = floatval($price_with_tax);
        $consumption_period = floatval($consumption_period);

        // Prevent division by zero
        if ($consumption_period != 0) {
            $dailyprice = wc_price($price_with_tax / $consumption_period);
        } else {
            $dailyprice = wc_price(0); // Handle the zero division case appropriately
        }

        echo '</div>';

        echo '<div class="dailyprice primary-bg-color">';
        echo '<div class="container">';
        echo '<p>' . sprintf(
            __('Using %1$s - will cost you only <br /><span class="daily">%2$s per day !</span>', 'nutrisslim-suiteV2'),
            get_the_title(),
            $dailyprice
        ) . '</p>';
        echo '</div>';
        echo '</div>';
    }

    protected function _content_template() {
        // JS content template for frontend rendering if needed
    }
}