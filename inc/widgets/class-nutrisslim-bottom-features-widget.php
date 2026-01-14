<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Nutrisslim_Bottom_Features_Widget extends Widget_Base {

    public function get_name() {
        return 'nutrisslim_bottom_features';
    }

    public function get_title() {
        return __( 'Bottom Features', 'nutrisslim-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-image-box';
    }

    public function get_categories() {
        return [ 'nutrisslim' ];
    }

    protected function _register_controls() {
        // No controls are needed as the data comes directly from ACF and the product image
    }

    protected function render() {
        ?>
<style>
div.nutrisslim-bottom-features {
    box-sizing: border-box;
    display: flex;
    flex-flow: row wrap;
    margin: 0 -10px;
    align-items: center;
}

.nutrisslim-bottom-features div.imagePart {
    box-sizing: border-box;
    padding: 0 10px 1rem;
    max-width: 100%;
    flex-basis: 50%;
    max-width: 50%;
    text-align: center;
}

.nutrisslim-bottom-features div.contentPart {
    box-sizing: border-box;
    padding: 0 10px 1rem;
    max-width: 100%;
    flex-basis: 50%;
    max-width: 50%;
}
</style>
<?php
        // Ensure WooCommerce and ACF are active
        if (!function_exists('WC') || !function_exists('get_field')) {
            echo 'WooCommerce or ACF is not active.';
            return;
        }

        // Attempt to get the current product
        global $post;
        $product = wc_get_product($post->ID);

        if (!$product) {
            echo 'Not a product page.';
            return;
        }

        // Fetch ACF fields related to the product
        $tag_line = get_field('tag_line', $product->get_id());
        $features = get_field('features', $product->get_id());

        // Fetch the product image
        $image_id  = $product->get_image_id();
        $image_url = wp_get_attachment_image_url($image_id, 'large');

        echo '<div class="nutrisslim-bottom-features">';
        
        if ($image_url) {
            echo '<div class="imagePart"><img src="' . esc_url($image_url) . '" alt="Product Image"></div>';
        }

        echo '<div class="contentPart greenCheckList">';

        echo '<h3>' . esc_html(get_the_title()) . '</h3>';
        if ($tag_line) {
            echo '<p class="strong">' . esc_html($tag_line) . '</p>';
        }

        if ($features && is_array($features)) {
            echo '<ul>';
            foreach ($features as $feature) {
                echo '<li>' . esc_html($feature['feature']) . '</li>';
            }
            echo '</ul>';
        }

        echo '<form class="addToCartForm">';
        echo '<button class="elementor-button add-to-cart-icon" data-product-id="' . $product->get_id() . '" data-quantity="1" type="submit">' . __('Add to cart', 'nutrisslim-suiteV2') . '</button>';
        echo '</form>';


        // echo '<form class="addToCartForm"><button>Dodaj v kosaricico</button></form>';

        echo '</div>'; // content part

        echo '</div>';
    }
}