<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Nutrisslim_FAQ_Widget extends Widget_Base {

    public function get_name() {
        return 'nutrisslim_faq';
    }

    public function get_title() {
        return __( 'Nutrisslim FAQ', 'nutrisslim-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-help-o';
    }

    public function get_categories() {
        return [ 'nutrisslim', 'nutrisslim-landing' ];
    }

    public function get_html_wrapper_class() {
        return parent::get_html_wrapper_class() . ' vprasanja';
    }    

    protected function _register_controls() {
        // Optionally, add controls for the widget here.
    }

    protected function render() {
 
    ?>
<?php
        global $product;

        if ( ! $product ) {
            $pid = get_field('selected_product');
            $pid = $pid[0];
            $product = wc_get_product($pid);
        }

        // Ensure we're on a product page and ACF is active
        if ( ! $product || ! function_exists('get_field') ) {
            echo 'This widget is only available on product pages with ACF enabled.';
            return;
        }

        // Fetch FAQ items from the product
        $product_faq_items = get_field('faq', $product->get_id());

        /*
        $selected = get_field('products', $product->get_id());
        $num_of_items = count($selected);

        if ($product->get_type() === 'nutrisslim' && $num_of_items === 1 && empty($product_faq_item)) {

            if (have_rows('field_663a89fffa70d')) {
                the_row(); 
                $_product_id = get_sub_field('field_663a8a56fa70e');

                if ($_product_id) {
                    $_product = wc_get_product($_product_id);
                    if ($_product) {
                        $faqs = get_field($faq_field_name, $_product->get_id());
                    }
                }
            }            
            
        }
        */


        // Fetch FAQ items from the ACF options page
        $options_faq_items = get_field('faq', 'options');

        // Merge the two arrays. If either is not an array, ensure it's treated as an empty array.
        // $faq_items = array_merge((array)$product_faq_items, (array)$options_faq_items);

        // Initialize an empty array to hold the merged FAQ items
        $faq_items = [];

        // Add the first 4 items from $product_faq_items to $merged_faq_items
        if (is_array($product_faq_items)) {
            $faq_items = array_slice($product_faq_items, 0, 4);
        }

        // Add all items from $options_faq_items to $merged_faq_items
        if (is_array($options_faq_items)) {
            $faq_items = array_merge($faq_items, $options_faq_items);
        }


        if (empty($faq_items)) {
            echo 'No FAQ items found.';
            return;
        }
        
        echo '<h2>' . esc_html__( 'Frequently Asked Questions of Our Users', 'nutrisslim-suiteV2' ) . '</h2>';

        // Begin grid display
        echo '<div class="nutrisslim-faq">';

        echo '<div class="swiper faqGrid">';
        echo '<div class="swiper-wrapper">';

        foreach ($faq_items as $item) {
            $icon_id = $item['icon']; // Assuming this is an attachment ID
            $question = $item['question'];
            $answer = $item['answer'];

            // Display each FAQ item
            echo '<div class="swiper-slide faq-item">';
            if ($icon_id) {
                // Get the image URL from the attachment ID
                $icon_url = wp_get_attachment_image_url($icon_id, 'full'); // 'full' can be changed to any registered image size name
                if ($icon_url) {
                    echo '<img src="'. esc_url($icon_url) .'" alt="FAQ Icon">';
                }
            }
            echo '<h3 class="faq-question">'. esc_html($question) .'</h3>';
            echo '<div class="faq-answer">'. wp_kses_post($answer) .'</div>';
            echo '</div>';
        }

        echo '</div>'; // swiper-wrapper
        echo '</div>'; // faqGrid      
        echo '</div>'; // Close the grid display

    }

    protected function _content_template() {
        // JS content template for frontend rendering if needed    
    }
}