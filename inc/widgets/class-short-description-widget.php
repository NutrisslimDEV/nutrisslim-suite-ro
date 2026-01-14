<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Nutrisslim_Short_Description_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'nutrisslim-short-description-widget';
    }

    public function get_title() {
        return __( 'Nutrisslim Short Description Widget', 'nutrisslim-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-editor-list-ul';
    }

    public function get_categories() {
        return [ 'nutrisslim' ]; // Category defined in your existing plugin
    }

    protected function _register_controls() {
        // Here you can define control sections to manipulate the widget settings
    }

    protected function render() {
        global $product;

        if ( ! $product ) {
            $product = wc_get_product();
        }

        if ( ! $product ) {
            echo '<div>' . __( 'Product not found', 'nutrisslim-elementor-widgets' ) . '</div>';
            return;
        }

        $subtitle = get_field('subtitle', $product->get_id());

        // Display the product short description
        echo '<div class="product-short-description">';
        if ($subtitle) {
            echo '<p class="subtitle">' . $subtitle . '</p>';
        }
        echo do_shortcode('[product_rating]');
        echo apply_filters('the_content', $product->get_short_description());
        echo '</div>';

        // Initialize variables to store weight and consumption period
        $weightOutput = '';
        $consumptionPeriodOutput = '';

        // Check and format the weight value if it exists
        $weightValue = $product->get_weight();
        if ( !empty($weightValue) ) {
            $weightOutput = "Greutate netă: " . $weightValue . " " . get_option( 'woocommerce_weight_unit' );
        }

        // Check and format the consumption period if it exists
        $consumption_period = get_field( 'consumption_period', $product->get_id() );
        if ( !empty($consumption_period) ) {
            $consumptionPeriodOutput = sprintf( __('for %s days', 'nutrisslim-suiteV2'), $consumption_period );
        }

        // Combine the output strings
        $combinedOutput = $weightOutput;
        if ( !empty($weightOutput) && !empty($consumptionPeriodOutput) ) {
            // Both values are available
            $combinedOutput .= " | " . $consumptionPeriodOutput;
        } elseif ( empty($weightOutput) && !empty($consumptionPeriodOutput) ) {
            // Only consumption period is available
            $combinedOutput = $consumptionPeriodOutput;
        }

        // Display the combined output
        if ( !empty($combinedOutput) ) {
            echo '<div class="product-details"><strong>' . $combinedOutput . '</strong></div>';
        }


    }

    protected function _content_template() {
        // For JS rendering (frontend editor)
    }
}
?>