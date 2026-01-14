<?php
use Elementor\Widget_Base;

class Simple_Order_Button_Widget extends Widget_Base {

    // Widget name
    public function get_name() {
        return 'simple_order_button_widget';
    }

    // Widget title
    public function get_title() {
        return __( 'Simple Order Button Widget', 'text-domain' );
    }

    // Widget icon
    public function get_icon() {
        return 'eicon-button';
    }

    // Widget category
    public function get_categories() {
        return [ 'nutrisslim-landing' ];
    }

    // No need to register controls since you don't require settings
    protected function _register_controls() {
        // No controls required
    }

    // Rendering the button in the frontend
    protected function render() {
        // Get product via ACF (selected_product field)
        $product = get_field('selected_product');
        
        // Check if ACF returned a product array and get the first product (assuming it's an array)
        if (is_array($product) && isset($product[0])) {
            $product = $product[0];  // If it's an array, get the first item
        }

        // Ensure we have a valid product ID
        if (!$product) {
            echo __( 'Product not found', 'text-domain' );
            return; // Stop further processing if no product is found
        }

        // Get product object using WooCommerce
        $productObj = wc_get_product($product);

        if (!$productObj) {
            echo __( 'Invalid product', 'text-domain' );
            return; // Stop if product is invalid
        }

        // Fetching prices
        $regular_price = $productObj->get_regular_price();
        $price_for_one = $productObj->get_price();

        ?>
        <a href="#order-form-anchor" class="elementor-button onow org-btn">
            <span class="crossline"><?php echo wc_price($regular_price); ?></span> 
            <?php echo wc_price($price_for_one); ?> 
            <?php echo __('Order now', 'nutrisslim-suiteV2'); ?>
        </a>
        <?php
    }

    // Template for rendering inside Elementor's editor (JavaScript-based)
    protected function _content_template() {
        ?>
        <# 
        // Fake prices for live preview since PHP cannot be used here
        var regular_price = settings.regular_price || '€100.00'; // Default value for preview
        var price_for_one = settings.price_for_one || '€80.00';  // Default value for preview
        #>
        <a href="#order-form-anchor" class="elementor-button add-to-cart-icon onow">
            <span class="crossline">{{{ regular_price }}}</span> 
            {{{ price_for_one }}} 
            <?php echo __('Order now', 'nutrisslim-suiteV2'); ?>
        </a>
        <?php
    }    

}
