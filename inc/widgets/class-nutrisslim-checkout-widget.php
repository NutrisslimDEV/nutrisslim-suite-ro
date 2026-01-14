<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Nutrisslim_Checkout_Widget extends Widget_Base {

    public function get_name() {
        return 'nutrisslim-checkout';
    }

    public function get_title() {
        return __( 'Nutrisslim Checkout', 'nutrisslim-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-checkout';
    }

    public function get_categories() {
        return [ 'nutrisslim' ];
    }

    protected function _register_controls() {
        // Register widget controls here, if needed.
    }

    protected function render() {
?>

<style>
    .rf-company-details-checkbox span { font-weight: 300 !important; line-height: 25px; color: #282828 !important; }
    #ship-to-different-address span { font-weight: 300 !important; line-height: 25px; color: #282828 !important; text-transform: none !important; }
    .rf-company-name, .rf-vat-number { padding: 0 20px !important; }
    #billing_for_company_container { padding: 0 19px; }
    #rf-custom_company_details { border: 1px solid #EFEFF0; background-color: #FBFBFB; }

    .swiper-container {
        position: relative;
        width: 100%;
        max-width: 100%;
        overflow: hidden;
    }
    .swiper-wrapper { margin-bottom: 25px; }
    .swiper-slide {
        text-align: center;
        font-size: 18px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .swiper-button-prev, .swiper-button-next {
        color: #fff;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #1FB25A;
        display: flex;
        justify-content: center;
        align-items: center;
        top: 65%;
    }
    .swiper-button-prev:after, .swiper-button-next:after { font-size: 16px; }
    .swiper-pagination-bullet {
        background-color: #FFFFFF;
        opacity: 1;
        width: 8px;
        height: 8px;
    }
    .swiper-pagination-bullet-active {
        background-color: #1FB25A;
        width: 8px;
        height: 8px;
    }
    .swiper-horizontal>.swiper-pagination-bullets .swiper-pagination-bullet, .swiper-pagination-horizontal.swiper-pagination-bullets .swiper-pagination-bullet {
        margin: 2px;
    }

        .rf-custom-option { border: 1px solid #EFEFF0; background-color: #FBFBFB; margin-bottom: 20px; }
        .rf-custom-option h3 { font-size: 18px !important; line-height: 22px; font-weight: 600; color: #282828; margin-bottom: 15px; text-transform: inherit !important; }
        .rf-option-container { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; padding: 20px; }
        .rf-custom-checkbox { appearance: none; height: 10px; width: 10px; border-radius: 50%; border: 1px solid #282828; margin-right: 10px; }
        .rf-custom-checkbox:checked { background-color: #1FB25A; border: 1px solid #1FB25A; }
        .rf-option-container.selected { background-color: #B0E4C5; }
        .rf-option-image { width: 50px; height: 50px; }
        .rf-two-columns .option-container { width: 48%; }
	 .rf-option-title { font-size: 18px; line-height: 22px; font-weight: 300; color: #282828; }
	 .rf-option-description { font-size: 14px; line-height: 17px; font-weight: 300; color: #707070; margin-top: 10px; }
	 .flex { display: flex; }
	 .rf-option-left { display: flex; align-items: baseline; }
	 .rf-radio-container { margin-right: 10px; }
	 .rf-custom-checkbox { flex-shrink: 0; width: 10px; height: 10px; border-radius: 50%; border: 1px solid #282828; margin-right: 10px; }
	 .rf-option-left label { align-items: center; }
</style>

<?php
global $product;

echo do_shortcode('[woocommerce_checkout]');

// Enqueue JS and CSS here, if not globally enqueued

    // Enqueue Swiper CSS
    wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css');

    // Enqueue Swiper JS
    wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), null, true);

    wp_enqueue_script('custom-checkout-script', get_template_directory_uri() . '/js/checkout-coupon-custom-position.js', array('jquery'), null, true);


function custom_checkout_company_fields( $checkout ) {
    // Initially, render the company checkbox and details in a hidden container.
    echo '<div id="billing_for_company_container" style="display: none;">';

    // Checkbox to toggle company details
    woocommerce_form_field( 'billing_for_company', array(
        'type'          => 'checkbox',
        'class'         => array('form-row-wide rf-company-details-checkbox'),
        'label'         => __('Bill to a company?'),
    ), $checkout->get_value( 'billing_for_company' ));

    // Company details fields, initially hidden
    echo '<div id="rf-custom_company_details" style="margin-top: 20px;"><h3>' . __('Company Details') . '</h3>';

    woocommerce_form_field( 'company_name', array(
        'type'          => 'text',
        'class'         => array('rf-company-name form-row-wide'),
        'label'         => __('Company Name'),
        'placeholder'   => __('Enter your company name'),
        'required'      => false,
    ), $checkout->get_value( 'company_name' ));

    woocommerce_form_field( 'vat_number', array(
        'type'          => 'text',
        'class'         => array('rf-vat-number form-row-wide'),
        'label'         => __('VAT Number'),
        'placeholder'   => __('Enter your VAT number'),
        'required'      => false,
    ), $checkout->get_value( 'vat_number' ));

    echo '</div></div>'; // Close company details and container

    // JavaScript to move the company checkbox and handle its behavior
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        // Initially hide the company details div
        $('#rf-custom_company_details').hide();

        // Move the company checkbox container before the "Ship to a different address?" checkbox
        $('#billing_for_company_container').insertBefore('#ship-to-different-address').show();

        // Toggle company details visibility based on the checkbox
        $('#billing_for_company').change(function() {
            if (this.checked) {
                $('#rf-custom_company_details').slideDown();
            } else {
                $('#rf-custom_company_details').slideUp();
            }
        });
    });
    </script>
<?php     
}


function custom_checkout_additional_options() {
    ?>


    <script>
        document.querySelectorAll('.rf-custom-checkbox').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var parentDiv = this.closest('.rf-option-container');
                if (this.checked) {
                    parentDiv.classList.add('selected');
                } else {
                    parentDiv.classList.remove('selected');
                }
            });
        });
    </script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Listen for changes on any radio button within the "Datum dostave" section
    document.querySelectorAll('input[name="rf_dostava_option"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            // Reset the background color for all options
            document.querySelectorAll('.rf-custom-option .rf-option-container').forEach(function(container) {
                container.style.backgroundColor = "transparent"; // Or any other original color
            });

            // Set the background color of the selected option's container
            if (this.checked) {
                this.closest('.rf-option-container').style.backgroundColor = "#B0E4C5";
            }
        });
    });
});
	
	document.addEventListener("DOMContentLoaded", function () {
    // Listen for changes on any radio button within the "Datum dostave" section
    document.querySelectorAll('input[name="rf_nacin_dostave"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            // Reset the background color for all options
            document.querySelectorAll('.rf-custom-option .rf-option-container').forEach(function(container) {
                container.style.backgroundColor = "transparent"; // Or any other original color
            });

            // Set the background color of the selected option's container
            if (this.checked) {
                this.closest('.rf-option-container').style.backgroundColor = "#B0E4C5";
            }
        });
    });
});
</script>

    <?php
}

add_action('wp_ajax_update_checkout_total', 'custom_update_checkout_total');
add_action('wp_ajax_nopriv_update_checkout_total', 'custom_update_checkout_total');

function custom_update_checkout_total() {
    if (!isset($_POST['additional_costs'])) {
        wp_send_json_error(['message' => 'Missing data']);
        wp_die();
    }

    $additional_costs = array_map('floatval', $_POST['additional_costs']); // Ensure costs are floats
    $total_additional_cost = array_sum($additional_costs);

    WC()->session->set('total_additional_cost', $total_additional_cost); // Store the additional cost in session

    wp_send_json_success(['message' => 'Checkout total updated']);
    wp_die();
}

add_action('woocommerce_cart_calculate_fees', 'add_custom_fees_based_on_session', 20);
function add_custom_fees_based_on_session() {
    $additional_cost = WC()->session->get('total_additional_cost');
    if ($additional_cost > 0) {
        WC()->cart->add_fee(__('Additional Cost', 'hello-elementor'), $additional_cost);
    }
}



add_action('woocommerce_checkout_before_order_review_heading', 'custom_checkout_additional_options');



function add_custom_checkout_fees() {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;

    if ( isset( $_POST['post_data'] ) ) {
        parse_str( $_POST['post_data'], $post_data );
    } else {
        $post_data = $_POST; // Fallback for final checkout processing
    }

    if (isset($post_data['priority_order'])) {
        WC()->cart->add_fee( __('Prioritetno naro�ilo', 'hello-elementor'), 1.99 );
    }

    if (isset($post_data['order_insurance'])) {
        WC()->cart->add_fee( __('Zavarovanje naro�ila', 'hello-elementor'), 5.99 );
    }
}
add_action( 'woocommerce_cart_calculate_fees', 'add_custom_checkout_fees', 20, 1 );

}
}

// Ensure the class gets loaded and registered.
nutrisslim_include_widgets_files();
