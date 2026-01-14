<?php

function custom_checkout_company_fields( $checkout ) {
    // Initially, render the company checkbox and details in a hidden container.
    echo '<div id="billing_for_company_container" style="display: none;">';

    // Checkbox to toggle company details
    woocommerce_form_field( 'billing_for_company', array(
        'type'          => 'checkbox',
        'class'         => array('form-row-wide rf-company-details-checkbox'),
        'label'         => __('Bill to a company?', 'nutrisslim-suiteV2'),
    ), $checkout->get_value( 'billing_for_company' ));

    // Company details fields, initially hidden
    echo '<div id="rf-custom_company_details" style="margin-top: 20px;"><h3>' . __('Company Details', 'nutrisslim-suiteV2') . '</h3>';

    woocommerce_form_field( 'company_name', array(
        'type'          => 'text',
        'class'         => array('rf-company-name form-row-wide'),
        'label'         => __('Company Name', 'nutrisslim-suiteV2'),
        'placeholder'   => __('Enter your company name', 'nutrisslim-suiteV2'),
        'required'      => false,
    ), $checkout->get_value( 'company_name' ));

    woocommerce_form_field( 'vat_number', array(
        'type'          => 'text',
        'class'         => array('rf-vat-number form-row-wide'),
        'label'         => __('VAT Number', 'nutrisslim-suiteV2'),
        'placeholder'   => __('Enter your VAT number', 'nutrisslim-suiteV2'),
        'required'      => false,
    ), $checkout->get_value( 'vat_number' ));

    echo '</div></div>'; // Close company details and container
}
add_action( 'woocommerce_after_checkout_billing_form', 'custom_checkout_company_fields' );

function customize_checkout_fields($fields) {

    $default_country = getCountry();
	
	if ($default_country == 'RO') {
        $states = WC()->countries->get_states('RO');

        // Create a placeholder option
        $placeholder_option = array(
            '' => __('Provincie *', 'nutrisslim-suiteV2') // The text you want to display
        );

        $fields['billing']['billing_state'] = array(
            'type'        => 'select',
            'label'       => __('Provincie', 'nutrisslim-suiteV2'),
            'required'    => true,
            'class'       => array('form-row-wide', 'update_totals_on_change'),
            'priority'    => 75,
            // Merge placeholder with actual states, set it as default
            'options'     => $placeholder_option + $states,
            'default'     => '',
        );

        $fields['shipping']['shipping_state'] = array(
            'type'        => 'select',
            'label'       => __('Provincie', 'nutrisslim-suiteV2'),
            'required'    => true,
            'class'       => array('form-row-wide', 'update_totals_on_change'),
            'priority'    => 75,
            'options'     => $placeholder_option + $states,
            'default'     => '',
        );
    }

    // Add a placeholder to the 'billing_email' field
    $fields['billing']['billing_email'] = array(
        'type'        => 'email',
        'label'       => __('Email address', 'nutrisslim-suiteV2'),
        'placeholder' => __('Email address *', 'nutrisslim-suiteV2'),
        'required'    => true,
        'class'       => array('form-row-wide'),
        'priority'    => 10,
    );
    $fields['billing']['billing_first_name'] = array(
        'type'        => 'text',
        'label'       => __('First name', 'nutrisslim-suiteV2'),
        'placeholder' => __('First name *', 'nutrisslim-suiteV2'),
        'required'    => true,
        'class'       => array('form-row-first'),
        'priority'    => 20,
    );
    $fields['billing']['billing_last_name'] = array(
        'type'        => 'text',
        'label'       => __('Last name', 'nutrisslim-suiteV2'),
        'placeholder' => __('Last name *', 'nutrisslim-suiteV2'),
        'required'    => true,
        'class'       => array('form-row-last'),
        'priority'    => 30,
        'clear'       => true,
    );
    if ($default_country == 'GB') {
        $fields['billing']['billing_address_1'] = array(
            'type'        => 'text',
            'label'       => __('Street address', 'nutrisslim-suiteV2'),
            'placeholder' => __('Street address *', 'nutrisslim-suiteV2'),
            'required'    => true,
            'class'       => array('form-row-last street-field'),
            'priority'    => 50,
        );
        $fields['billing']['billing_house_number'] = array(
            'type'      => 'text',
            'label'     => __('House no.', 'nutrisslim-suiteV2'),
            'placeholder' => __('House no. *', 'nutrisslim-suiteV2'),
            'class' => array('form-row-first house_number-field'),
            'required' => 1,
            'priority' => 40,
            'clear'       => true,
        ); 
        // Add billing zip code
        $fields['billing']['billing_postcode'] = array(
            'label'       => __('Postal code', 'nutrisslim-suiteV2'),
            'placeholder' => __('Postal code *', 'nutrisslim-suiteV2'),
            'required'    => true,
            'class'       => array('form-row-first'),
            'clear'       => true,
            'priority' => 60,
        );           
        $fields['billing']['billing_city'] = array(
            'type'        => 'text',
            'label'       => __('Billing City', 'nutrisslim-suiteV2'),
            'placeholder' => __('Billing City *', 'nutrisslim-suiteV2'),
            'required'    => true,
            'class'       => array('form-row-last', 'city-autocomplete-field'),
            'priority' => 70,
            'autocomplete' => 'off',
            'custom_attributes' => array(
                'data-city-autocomplete' => 'true',
                'data-province-field' => 'billing_state',
                'autocomplete' => 'off',
            ),
        );    
    } else {
        $fields['billing']['billing_address_1'] = array(
            'type'        => 'text',
            'label'       => __('Street address', 'nutrisslim-suiteV2'),
            'placeholder' => __('Street address *', 'nutrisslim-suiteV2'),
            'required'    => true,
            'class'       => array('form-row-first street-field'),
            'priority'    => 40,
        );
        $fields['billing']['billing_house_number'] = array(
            'type'      => 'text',
            'label'     => __('House no.', 'nutrisslim-suiteV2'),
            'placeholder' => __('House no. *', 'nutrisslim-suiteV2'),
            'class' => array('form-row-last house_number-field'),
            'required' => 1,
            'priority' => 50,
            'clear'       => true,
        ); 
        $fields['billing']['billing_city'] = array(
            'type'        => 'text',
            'label'       => __('Billing City', 'nutrisslim-suiteV2'),
            'placeholder' => __('Billing City *', 'nutrisslim-suiteV2'),
            'required'    => true,
            'class'       => array('form-row-first', 'city-autocomplete-field'),
            'priority' => 60,
            'autocomplete' => 'off',
            'custom_attributes' => array(
                'data-city-autocomplete' => 'true',
                'data-province-field' => 'billing_state',
                'autocomplete' => 'off',
            ),
        );    
        // Add billing zip code
        $fields['billing']['billing_postcode'] = array(
            'label'       => __('Postal code', 'nutrisslim-suiteV2'),
            'placeholder' => __('Postal code *', 'nutrisslim-suiteV2'),
            'required'    => true,
            'class'       => array('form-row-last'),
            'clear'       => true,
            'priority' => 70,
        );           
    }
    $fields['billing']['billing_phone'] = array(
        'type'        => 'tel',
        'label'       => __('Phone', 'nutrisslim-suiteV2'),
        'placeholder' => __('Phone *', 'nutrisslim-suiteV2'),
        'required'    => true,
        'class'       => array('form-row-wide'),
        'priority'    => 80,
    );

    $fields['billing']['billing_country'] = array(
        'type'        => 'select',
        'label'       => __('Land/Region', 'woocommerce'),
        'required'    => true,
        'class'       => array('form-row-wide', 'address-field', 'update_totals_on_change'),
        'priority'    => 35, // show before street; adjust to taste
        'options'     => WC()->countries->get_allowed_countries(),
        'default'     => $default_country,
    );

    $fields['shipping']['shipping_email'] = array(
        'type'        => 'email',
        'label'       => __('Email address', 'nutrisslim-suiteV2'),
        'placeholder' => __('Email address *', 'nutrisslim-suiteV2'),
        'required'    => true,
        'class'       => array('form-row-wide'),
        'priority'    => 10,
    );
    $fields['shipping']['shipping_first_name'] = array(
        'type'        => 'text',
        'label'       => __('First name', 'nutrisslim-suiteV2'),
        'placeholder' => __('First name *', 'nutrisslim-suiteV2'),
        'required'    => true,
        'class'       => array('form-row-first'),
        'priority'    => 20,
    );
    $fields['shipping']['shipping_last_name'] = array(
        'type'        => 'text',
        'label'       => __('Last name', 'nutrisslim-suiteV2'),
        'placeholder' => __('Last name *', 'nutrisslim-suiteV2'),
        'required'    => true,
        'class'       => array('form-row-last'),
        'priority'    => 30,
        'clear'       => true,
    );
    if ($default_country == 'GB') {
        $fields['shipping']['shipping_house_number'] = array(
            'type'      => 'text',
            'label'     => __('House no.', 'nutrisslim-suiteV2'),
            'placeholder' => __('House no. *', 'nutrisslim-suiteV2'),
            'class' => array('form-row-first house_number-field'),
            'required' => 1,
            'priority' => 40,
            'clear'       => true,
        );        
        $fields['shipping']['shipping_address_1'] = array(
            'type'        => 'text',
            'label'       => __('Street address', 'nutrisslim-suiteV2'),
            'placeholder' => __('Street address *', 'nutrisslim-suiteV2'),
            'required'    => true,
            'class'       => array('form-row-last street-field'),
            'priority'    => 50,
        );
        // Add shipping zip code
        $fields['shipping']['shipping_postcode'] = array(
            'label'       => __('Postal code', 'nutrisslim-suiteV2'),
            'placeholder' => __('Postal code *', 'nutrisslim-suiteV2'),
            'required'    => true,
            'class'       => array('form-row-first'),
            'clear'       => true,
            'priority' => 60,
        );        
        // Add shipping city
        $fields['shipping']['shipping_city'] = array(
            'type'        => 'text',
            'label'       => __('City', 'nutrisslim-suiteV2'),
            'placeholder' => __('City *', 'nutrisslim-suiteV2'),
            'required'    => true,
            'class'       => array('form-row-last', 'city-autocomplete-field'),
            'priority' => 70,
            'autocomplete' => 'off',
            'custom_attributes' => array(
                'data-city-autocomplete' => 'true',
                'data-province-field' => 'shipping_state',
                'autocomplete' => 'off',
            ),
        );    
    } else {
        $fields['shipping']['shipping_address_1'] = array(
            'type'        => 'text',
            'label'       => __('Street address', 'nutrisslim-suiteV2'),
            'placeholder' => __('Street address *', 'nutrisslim-suiteV2'),
            'required'    => true,
            'class'       => array('form-row-first street-field'),
            'priority'    => 40,
        );
        $fields['shipping']['shipping_house_number'] = array(
            'type'      => 'text',
            'label'     => __('House no.', 'nutrisslim-suiteV2'),
            'placeholder' => __('House no. *', 'nutrisslim-suiteV2'),
            'class' => array('form-row-last house_number-field'),
            'required' => 1,
            'priority' => 50,
            'clear'       => true,
        );
        // Add shipping city
        $fields['shipping']['shipping_city'] = array(
            'type'        => 'text',
            'label'       => __('City', 'nutrisslim-suiteV2'),
            'placeholder' => __('City *', 'nutrisslim-suiteV2'),
            'required'    => true,
            'class'       => array('form-row-first', 'city-autocomplete-field'),
            'priority' => 60,
            'autocomplete' => 'off',
            'custom_attributes' => array(
                'data-city-autocomplete' => 'true',
                'data-province-field' => 'shipping_state',
                'autocomplete' => 'off',
            ),
        );    
        // Add shipping zip code
        $fields['shipping']['shipping_postcode'] = array(
            'label'       => __('Postal code', 'nutrisslim-suiteV2'),
            'placeholder' => __('Postal code *', 'nutrisslim-suiteV2'),
            'required'    => true,
            'class'       => array('form-row-last'),
            'clear'       => true,
            'priority' => 70,
        );
    }
    $fields['shipping']['shipping_phone'] = array(
        'type'        => 'tel',
        'label'       => __('Phone', 'nutrisslim-suiteV2'),
        'placeholder' => __('Phone *', 'nutrisslim-suiteV2'),
        'required'    => true,
        'class'       => array('form-row-wide'),
        'priority'    => 80,
    );

    $fields['shipping']['shipping_country'] = array(
        'type'        => 'select',
        'label'       => __('Land/Region', 'woocommerce'),
        'required'    => true,
        'class'       => array('form-row-wide', 'address-field', 'update_totals_on_change'),
        'priority'    => 35,
        'options'     => WC()->countries->get_allowed_countries(),
        'default'     => $default_country,
    );
    
    $fields['order']['order_comments'] = array(
        'type'        => 'textarea',
        'class'       => array('notes'),
        'label'       => __('Order notes', 'nutrisslim-suiteV2'),
        'placeholder' => __('Notes about your order, e.g. special notes for delivery.', 'nutrisslim-suiteV2'),
        'priority'    => 100,
    );

    return $fields;
}
add_filter('woocommerce_checkout_fields', 'customize_checkout_fields', 9999999);

function add_romanian_provinces($states) {
    $states['RO'] = array(
        'AB' => 'Alba',
        'AR' => 'Arad',
        'AG' => 'Argeș',
        'BC' => 'Bacău',
        'BH' => 'Bihor',
        'BN' => 'Bistrița-Năsăud',
        'BR' => 'Brăila',
        'BT' => 'Botoșani',
        'BV' => 'Brașov',
        'BZ' => 'Buzău',
        'CS' => 'Caraș-Severin',
        'CL' => 'Călărași',
        'CJ' => 'Cluj',
        'CT' => 'Constanța',
        'CV' => 'Covasna',
        'DB' => 'Dâmbovița',
        'DJ' => 'Dolj',
        'GL' => 'Galați',
        'GR' => 'Giurgiu',
        'GJ' => 'Gorj',
        'HR' => 'Harghita',
        'HD' => 'Hunedoara',
        'IL' => 'Ialomița',
        'IS' => 'Iași',
        'IF' => 'Ilfov',
        'MM' => 'Maramureș',
        'MH' => 'Mehedinți',
        'MS' => 'Mureș',
        'NT' => 'Neamț',
        'OT' => 'Olt',
        'PH' => 'Prahova',
        'SM' => 'Satu Mare',
        'SJ' => 'Sălaj',
        'SB' => 'Sibiu',
        'SV' => 'Suceava',
        'TR' => 'Teleorman',
        'TM' => 'Timiș',
        'TL' => 'Tulcea',
        'VS' => 'Vaslui',
        'VL' => 'Vâlcea',
        'VN' => 'Vrancea',
        'B'  => 'București'
    );
    return $states;
}
add_filter('woocommerce_states', 'add_romanian_provinces');

function validate_province_fields( $data, $errors ) {
    // Check billing province
    if ( isset( $_POST['billing_state'] ) && empty( $_POST['billing_state'] ) ) {
        $errors->add( 'validation', __( 'Please select a billing province.', 'woocommerce' ) );
    }

    // Check shipping province
    if ( isset( $_POST['shipping_state'] ) && empty( $_POST['shipping_state'] ) ) {
        $errors->add( 'validation', __( 'Please select a shipping province.', 'woocommerce' ) );
    }
}
add_action( 'woocommerce_after_checkout_validation', 'validate_province_fields', 10, 2 );

function disable_empty_province_option_script() {
    if ( is_checkout() ) {
        ?>
        <script type="text/javascript">
            jQuery(function($){
                // Disable the empty option for billing and shipping state
                $('#billing_state option[value=""]').prop('disabled', true);
                $('#shipping_state option[value=""]').prop('disabled', true);
            });
        </script>
        <?php
    }
}
add_action('wp_footer', 'disable_empty_province_option_script');

function save_woocommerce_states($order_id) {
    // Retrieve the state codes posted at checkout
    $billing_state_code  = !empty($_POST['billing_state']) ? sanitize_text_field($_POST['billing_state']) : '';
    $shipping_state_code = !empty($_POST['shipping_state']) ? sanitize_text_field($_POST['shipping_state']) : '';

    // If shipping state is empty, use billing state
    if (empty($shipping_state_code)) {
        $shipping_state_code = $billing_state_code;
    }

    // Get the full list of Spanish provinces
    $states = WC()->countries->get_states('RO');

    // Convert state codes to full province names
    $billing_state_full  = isset($states[$billing_state_code])  ? $states[$billing_state_code]  : $billing_state_code;
    $shipping_state_full = isset($states[$shipping_state_code]) ? $states[$shipping_state_code] : $shipping_state_code;

    // **Force WooCommerce to save the full province name**
    update_post_meta($order_id, '_billing_state', $billing_state_full);
    update_post_meta($order_id, '_shipping_state', $shipping_state_full);

    // Store state name separately (optional)
    update_post_meta($order_id, '_billing_state_custom', $billing_state_full);
    update_post_meta($order_id, '_shipping_state_custom', $shipping_state_full);

    // **Ensure the WooCommerce order object uses the full name**
    $order = wc_get_order($order_id);
    if ($order) {
        $order->set_billing_state($billing_state_full); // Use full name
        $order->set_shipping_state($shipping_state_full);
        $order->save();
    }
}
add_action('woocommerce_checkout_update_order_meta', 'save_woocommerce_states', 20, 1);


function autofill_shipping_state_script() {
    if (is_checkout()) {
        ?>
        <script type="text/javascript">
            jQuery(function($){
                // When billing state changes, update shipping state if checkbox is checked
                $('#billing_state').on('change', function(){
                    if ($('#ship-to-different-address input').is(':checked') === false) {
                        $('#shipping_state').val($(this).val()).trigger('change');
                    }
                });

                // On page load, if shipping is not checked, copy the billing state
                $(document).ready(function(){
                    if ($('#ship-to-different-address input').is(':checked') === false) {
                        $('#shipping_state').val($('#billing_state').val()).trigger('change');
                    }
                });
            });
        </script>
        <?php
    }
}
add_action('wp_footer', 'autofill_shipping_state_script');



function display_woocommerce_states_admin_order_meta($order) {
    $billing_state = get_post_meta($order->get_id(), '_billing_state_custom', true);
    $shipping_state = get_post_meta($order->get_id(), '_shipping_state_custom', true);

    if ($billing_state) {
        echo '<p><strong>' . __('Billing province:', 'woocommerce') . '</strong> ' . esc_html($billing_state) . '</p>';
    }

    if ($shipping_state) {
        echo '<p><strong>' . __('Shipping province:', 'woocommerce') . '</strong> ' . esc_html($shipping_state) . '</p>';
    }
}
add_action('woocommerce_admin_order_data_after_billing_address', 'display_woocommerce_states_admin_order_meta', 10, 1);
add_action('woocommerce_admin_order_data_after_shipping_address', 'display_woocommerce_states_admin_order_meta', 10, 1);

// add_action('woocommerce_checkout_update_order_meta', 'save_custom_checkout_fields', 10, 2);
/*
function save_custom_checkout_fields($order_id, $data) {

    // error_log(print_r($data, true));

    if ( ! is_object( $order_id ) ) {
        $order = wc_get_order( $order_id );
    }

    update_post_meta($order_id, '_billing_address_2', $data['billing_house_number']);
    update_post_meta($order_id, '_shipping_address_2', $data['shipping_house_number']);    
}
*/
add_action('woocommerce_checkout_update_order_meta', 'save_custom_checkout_fields', 10, 2);
function save_custom_checkout_fields($order_id, $data) {
    // Get the order object
    $order = wc_get_order($order_id);

    // Update the billing and shipping address 2 using the order object methods
    if (isset($data['billing_house_number'])) {
        $order->set_billing_address_2(sanitize_text_field($data['billing_house_number']));
    }

    if (isset($data['shipping_house_number'])) {
        $order->set_shipping_address_2(sanitize_text_field($data['shipping_house_number']));
    }

    // Save the order
    $order->save();
}
/*
function display_only_selected_shipping_method() {
    // Get the shipping methods from the cart
    $available_shipping_methods = WC()->shipping->get_packages()[0]['rates'];
    $chosen_shipping_methods = WC()->session->get('chosen_shipping_methods');

    // Display only the chosen shipping method
    if (!empty($chosen_shipping_methods)) {
        foreach ($available_shipping_methods as $method_id => $method) {
            if (in_array($method_id, $chosen_shipping_methods)) {
                echo '<tr class="woocommerce-shipping-totals shipping">';
                echo '<th>' . __('Shipping', 'nutrisslim-suiteV2') . '</th>';
                echo '<td data-title="' . esc_attr__('Shipping', 'nutrisslim-suiteV2') . '">';
                echo '<ul id="shipping_method" class="woocommerce-shipping-methods">';
                echo '<li>';
                echo '<input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_' . esc_attr($method_id) . '" value="' . esc_attr($method_id) . '" class="shipping_method" checked="checked" />';
                echo '<label for="shipping_method_0_' . esc_attr($method_id) . '">DDDD' . wp_kses_post($method->get_label()) . '</label>';
                echo '</li>';
                echo '</ul>';
                echo '</td>';
                echo '</tr>';
            }
        }
    }
}
*/
// Hook into the WooCommerce order review section to override the shipping method display
// add_action('woocommerce_review_order_before_shipping', 'display_only_selected_shipping_method');
// add_action('woocommerce_review_order_after_shipping', 'display_only_selected_shipping_method');

function append_price_to_shipping( $total_rows, $cart ) {
    if ( ! is_checkout() ) {
        return $total_rows;
    }

    // Start output buffering
    ob_start();

    // Output original content
    foreach ( $total_rows as $key => $value ) {
        if ( $key === 'shipping' ) {
            $value['value'] .= '<span class="price">Your Price Here</span>';
        }
        echo '<tr class="' . esc_attr( $value['class'] ) . '">
                <th>' . wp_kses_post( $value['label'] ) . '</th>
                <td data-title="' . esc_attr( $value['label'] ) . '">' . wp_kses_post( $value['value'] ) . '</td>
              </tr>';
    }

    // Get the buffered content
    $output = ob_get_clean();

    return $output;
}
add_filter( 'woocommerce_cart_totals_get_rows', 'append_price_to_shipping', 10, 2 );


// Add custom fields to flat rate shipping method settings
function add_custom_fields_to_flat_rate_shipping($settings, $instance_id = null) {
    $settings['shipping_image'] = array(
        'title'       => __('Shipping Image URL', 'nutrisslim-suiteV2'),
        'type'        => 'text',
        'description' => __('Enter the URL of the shipping service image.', 'nutrisslim-suiteV2'),
        'desc_tip'    => true,
        'default'     => '',
    );
    
    $settings['delivery_type'] = array(
        'title'       => __('Delivery Type', 'nutrisslim-suiteV2'),
        'type'        => 'text',
        'description' => __('Enter the delivery type (e.g., Standard, Priority).', 'nutrisslim-suiteV2'),
        'desc_tip'    => true,
        'default'     => '',
    );

    // Add delivery from/to fields in the same row
    $settings['delivery_from'] = array(
        'title'       => __('Delivery From', 'nutrisslim-suiteV2'),
        'type'        => 'number',
        'description' => __('Enter the minimum number of delivery days.', 'nutrisslim-suiteV2'),
        'desc_tip'    => true,
        'default'     => '',
    );

    $settings['delivery_to'] = array(
        'title'       => __('Delivery To', 'nutrisslim-suiteV2'),
        'type'        => 'number',
        'description' => __('Enter the maximum number of delivery days.', 'nutrisslim-suiteV2'),
        'desc_tip'    => true,
        'default'     => '',
    );

    // Add checkbox for "Add part of shipping as fee"
    $settings['add_part_of_shipping_as_fee'] = array(
        'title'       => __('Add Part of Shipping as Fee', 'nutrisslim-suiteV2'),
        'type'        => 'checkbox',
        'description' => __('Check this box to add part of the shipping cost as a fee.', 'nutrisslim-suiteV2'),
        'desc_tip'    => true,
        'default'     => 'no',
    );

    // Add field for "Part of Fee"
    $settings['part_of_fee'] = array(
        'title'       => __('Part of Fee', 'nutrisslim-suiteV2'),
        'type'        => 'price',
        'description' => __('Enter the amount of the shipping cost to be set as a fee.', 'nutrisslim-suiteV2'),
        'desc_tip'    => true,
        'default'     => '0',
    );

    return $settings;
}
add_filter('woocommerce_shipping_instance_form_fields_flat_rate', 'add_custom_fields_to_flat_rate_shipping', 10, 2);


function calculate_delivery_date_range($from_days, $to_days) {
    $current_date = new DateTime();
    $delivery_start_date = clone $current_date;
    $delivery_end_date = clone $current_date;

    // Define the locale for Slovenian or the current language
    $locale = get_locale(); // Change this to the desired locale if necessary
    $formatter = new IntlDateFormatter($locale, IntlDateFormatter::FULL, IntlDateFormatter::NONE, null, null, 'EEEE d.M.');

    $working_days = 0;
    while ($working_days < $from_days) {
        $delivery_start_date->modify('+1 day');
        if ($delivery_start_date->format('N') < 6) { // Skip weekends
            $working_days++;
        }
    }

    $working_days = 0;
    while ($working_days < $to_days) {
        $delivery_end_date->modify('+1 day');
        if ($delivery_end_date->format('N') < 6) { // Skip weekends
            $working_days++;
        }
    }

    // Format the dates using IntlDateFormatter
    $formatted_start_date = $formatter->format($delivery_start_date);
    $formatted_end_date = $formatter->format($delivery_end_date);

    // Capitalize the first letter of the day names
    $formatted_start_date = mb_convert_case($formatted_start_date, MB_CASE_TITLE, "UTF-8");
    $formatted_end_date = mb_convert_case($formatted_end_date, MB_CASE_TITLE, "UTF-8");


    return array(
        'from' => $formatted_start_date,
        'to' => $formatted_end_date
    );
}


add_action('woocommerce_before_checkout_form', 'calculate_shipping_rates', 10);

function calculate_shipping_rates() {
    if (WC()->cart && WC()->cart->needs_shipping()) {
        WC()->cart->calculate_totals();
    }
}

// add_action('wp_ajax_nopriv_update_custom_checkout_block', 'update_custom_checkout_block');
// add_action('wp_ajax_update_custom_checkout_block', 'update_custom_checkout_block');

// function update_custom_checkout_block() {
//     // Ensure WooCommerce is available
//     if (!class_exists('nutrisslim-suiteV2')) {
//         include_once WP_PLUGIN_DIR . '/woocommerce/woocommerce.php';
//     }
    
//     // Initialize WooCommerce session
//     if (!WC()->session) {
//         WC()->session = new WC_Session_Handler();
//         WC()->session->init();
//     }

//     // Initialize WooCommerce cart
//     if (!WC()->cart) {
//         WC()->cart = new WC_Cart();
//     }

//     // Calculate totals and shipping
//     WC()->cart->calculate_totals();
//     WC()->cart->calculate_shipping();

//     // Ensure shipping rates are calculated
//     WC()->shipping->calculate_shipping(WC()->cart->get_shipping_packages());

//     $packages = WC()->shipping->get_packages();
//     $available_methods = isset($packages[0]['rates']) ? $packages[0]['rates'] : [];



//     // Log available methods
//     // error_log('Packages: ' . print_r($packages, true));    

//     // Log available methods
//     // error_log('Available methods: ---------------------------------->>>>>>>>' . print_r($available_methods, true));
//     // error_log('Available methods: ' . print_r($available_methods, true));

//     // Get the selected shipping method
//     $chosen_methods = WC()->session->get('chosen_shipping_methods');
//     $current_method = !empty($chosen_methods[0]) ? $chosen_methods[0] : '';

//     // Check if free shipping is applicable
//     $has_free_shipping = false;
//     foreach ($available_methods as $method_id => $method) {
//         if (strpos($method_id, 'free_shipping') !== false) {
//             $has_free_shipping = true;
//             unset($available_methods[$method_id]);
//             break;
//         }
//     }

//     foreach ($available_methods as $method_id => $method) {
//         // Ensure the cost is set correctly
//         if (empty($method->cost)) {
//             $instance_settings = get_option('woocommerce_flat_rate_' . $method->instance_id . '_settings');
//             $method->cost = isset($instance_settings['cost']) ? floatval($instance_settings['cost']) : 0;
//             error_log('Cost from instance settings for method ' . $method_id . ': ' . $method->cost);
//         }

//         $feeamount = isset($instance_settings['part_of_fee']) ? floatval($instance_settings['part_of_fee']) : 0;
//         $shippingamount = isset($method->cost) ? floatval($method->cost) : 0;
//         $total = $feeamount + $shippingamount;
//         $method->total = $total;

//         error_log('Calculated total for method ' . $method_id . ': ' . $method->total);
//     }

//     // Sort shipping methods by cost
//     usort($available_methods, function($a, $b) {
//         return $a->total - $b->total;
//     });

//     // Generate HTML output
//     $output = '';
//     $index = 0;
//     $selected_price = ''; // Initialize selected_price

//     if ($has_free_shipping && !empty($available_methods)) {
//         // Display free shipping
//         $lowest_price_method = reset($available_methods); // Get the lowest priced method
//         $instance_settings = get_option('woocommerce_flat_rate_' . $lowest_price_method->instance_id . '_settings');
//         $type = '';
//         if (!empty($instance_settings['delivery_type'])) {
//             $type = ' - ' . $instance_settings['delivery_type'];
//         }
//         $delivery_from = isset($instance_settings['delivery_from']) ? intval($instance_settings['delivery_from']) : 2; // Default to 2 if not set
//         $delivery_to = isset($instance_settings['delivery_to']) ? intval($instance_settings['delivery_to']) : 3; // Default to 3 if not set
//         $delivery_days = calculate_delivery_date_range($delivery_from, $delivery_to);
//         $delivery_days_text = $delivery_days['from'] . ' - ' . $delivery_days['to'];
//         $is_checked = (strpos($current_method, 'free_shipping') !== false) ? 'checked' : '';
//         $is_colored = (strpos($current_method, 'free_shipping') !== false) ? ' style="background-color:rgb(176, 228, 197);"' : '';

//         // Initialize $data_fee_value
//         $data_fee_value = '';
//         /*
//         $output .= '
//             <div class="rf-option-container"' . $is_colored . '>
//                 <div class="rf-option-left">
//                     <input data-freelabel="' . esc_attr(__('Free', 'nutrisslim-suiteV2')) . '" data-label="' . esc_attr(__('Shipping', 'nutrisslim-suiteV2')) . '<br /><small>' . esc_html($lowest_price_method->label) . $type . '</small>" type="radio" class="rf-custom-checkbox radio" name="rf_nacin_dostave" id="rf_' . esc_attr($method->id) . '" value="' . esc_attr($method->id) . '" ' . $is_checked . '>
//                     <label for="rf_' . esc_attr($method->id) . '">
//                         <div class="rf-option-title">' . esc_html($delivery_days_text) . ' (' . esc_attr(__('Free', 'nutrisslim-suiteV2')) . ')</div>
//                         <div class="rf-option-description">' . esc_html($lowest_price_method->label) . $type . '</div>
//                     </label>
//                 </div>
//                 <img src="' . esc_url($instance_settings['shipping_image']) . '" alt="' . esc_attr(__('Free shipping', 'nutrisslim-suiteV2')) . '" class="rf-option-image">
//             </div>';
//         */
        
//         $output .= '
//             <div class="rf-option-container"' . $is_colored . '>
//                 <div class="rf-option-left">
//                     <input data-freelabel="' . esc_attr(__('Free', 'nutrisslim-suiteV2')) . '" data-label="' . esc_attr(__('Shipping', 'nutrisslim-suiteV2')) . '<br /><small>' . esc_html($lowest_price_method->label) . $type . '</small>" type="radio" class="rf-custom-checkbox radio" name="rf_nacin_dostave" id="rf_' . esc_attr($method->id) . '" value="' . esc_attr($method->id) . '" ' . $is_checked . '>
//                     <label for="rf_' . esc_attr($method->id) . '">
//                         <div class="rf-option-title">' . esc_html($lowest_price_method->label) . $type . ' (' . esc_attr(__('Free', 'nutrisslim-suiteV2')) . ')</div>
//                         <div class="rf-option-description"></div>
//                     </label>
//                 </div>
//                 <img src="' . esc_url($instance_settings['shipping_image']) . '" alt="' . esc_attr(__('Free shipping', 'nutrisslim-suiteV2')) . '" class="rf-option-image">
//             </div>';        

//         // Remove the lowest priced method
//         array_shift($available_methods);
//     }

//     foreach ($available_methods as $method_id => $method) {
//         $index++;
//         $is_checked = ($current_method === $method->id) ? 'checked' : '';
//         $is_colored = ($current_method === $method->id) ? ' style="background-color:rgb(176, 228, 197);"' : '';
//         $instance_settings = get_option('woocommerce_flat_rate_' . $method->instance_id . '_settings');
//         $type = '';
//         if (!empty($instance_settings['delivery_type'])) {
//             $type = ' - ' . $instance_settings['delivery_type'];
//         }
//         $delivery_from = isset($instance_settings['delivery_from']) ? intval($instance_settings['delivery_from']) : 2; // Default to 2 if not set
//         $delivery_to = isset($instance_settings['delivery_to']) ? intval($instance_settings['delivery_to']) : 3; // Default to 3 if not set
//         $delivery_days = calculate_delivery_date_range($delivery_from, $delivery_to);      
//         $delivery_days_text = $delivery_days['from'] . ' - ' . $delivery_days['to'];
//         // $price = wc_price($method->cost);
//         $price = wc_prices_include_tax() ? wc_price(wc_get_price_including_tax($method)) : wc_price($method->cost);

//         error_log('Shipping price: ' . $price);
//         $dlabel = esc_attr(__('Shipping', 'nutrisslim-suiteV2')) . '<br /><small>' . esc_html($method->label) . $type . '</small>';

//         // Initialize $data_fee_value
//         $data_fee_value = '';

//         if (!empty($instance_settings['add_part_of_shipping_as_fee']) && $instance_settings['add_part_of_shipping_as_fee'] === 'yes' && !empty($instance_settings['part_of_fee']) && floatval($instance_settings['part_of_fee']) > 0) {
//             $data_fee_value = ' data-fee-value="' . esc_attr($instance_settings['part_of_fee']) . '"';
//             if ($has_free_shipping) {
//                 $price = wc_price(floatval($instance_settings['part_of_fee']));
//             } else {
//                 $price = wc_price($method->cost + floatval($instance_settings['part_of_fee']));
//             }
//         }
        
//         if ($instance_settings['part_of_fee']) {
//             $delivery_note = esc_html__( "Choose priority order packaging for the fastest dispatch. By selecting this option, your order will be processed before others.", "nutrisslim-suiteV2" );
//         } else {
//             $delivery_note = '';
//         }
//         /*
//         $output .= '
//             <div class="rf-option-container"' . $is_colored . '>
//                 <div class="rf-option-left">
//                     <input data-fee-label="' . esc_html($method->label) . $type . '" data-label="' . esc_html($dlabel) . '" type="radio" class="rf-custom-checkbox radio" name="rf_nacin_dostave" id="rf_' . esc_attr($method->id) . '" value="' . esc_attr($method->id) . '" ' . $is_checked . $data_fee_value . '>
//                     <label for="rf_' . esc_attr($method->id) . '">
//                         <div class="rf-option-title">' . esc_html($delivery_days_text) . ' (+' . $price . ')</div>
//                         <div class="rf-option-description">' . esc_html($method->label) . $type . '</div>
//                     </label>
//                 </div>
//                 <img src="' . esc_url($instance_settings['shipping_image']) . '" alt="' . esc_attr($method->label) . '" class="rf-option-image">
//             </div>';
//         */


        
//         $output .= '
//             <div class="rf-option-container"' . $is_colored . '>
//                 <div class="rf-option-left">
//                     <input data-fee-label="' . esc_html($method->label) . $type . '" data-label="' . esc_html($dlabel) . '" type="radio" class="rf-custom-checkbox radio" name="rf_nacin_dostave" id="rf_' . esc_attr($method->id) . '" value="' . esc_attr($method->id) . '" ' . $is_checked . $data_fee_value . '>
//                     <label for="rf_' . esc_attr($method->id) . '">
//                         <div class="rf-option-title">' . esc_html($method->label) . $type . ' (+' . $price . ')</div>
//                         <div class="rf-option-description">' . $delivery_note . '</div>
//                     </label>
//                 </div>
//                 <img src="' . esc_url($instance_settings['shipping_image']) . '" alt="' . esc_attr($method->label) . '" class="rf-option-image">
//             </div>';        

//             if ($is_checked) {   
//                 $selected_price = wc_price($method->cost);
//                 error_log('Selected method cost for ' . $method_id . ': ' . $method->cost);
//             }
//             if ($has_free_shipping) {
//                 $selected_price = '<span class="woocommerce-Price-amount amount"><bdi>' . esc_attr(__('Free', 'nutrisslim-suiteV2')) . '</bdi></span>';
//             }            
//     }

//     // error_log('Final selected price: ' . $selected_price);

//     wp_send_json_success(array(
//         'price' => $selected_price,
//         'method' => $chosen_methods,
//         'custom_block_html' => $output,
//     ));
// }


add_action('wp_ajax_nopriv_update_custom_checkout_block', 'update_custom_checkout_block');
add_action('wp_ajax_update_custom_checkout_block', 'update_custom_checkout_block');

function update_custom_checkout_block() {
    // Ensure WooCommerce is availble
    if (!class_exists('nutrisslim-suiteV2')) {
        include_once WP_PLUGIN_DIR . '/woocommerce/woocommerce.php';
    }
    
    // Initialize WooCommerce session
    if (!WC()->session) {
        WC()->session = new WC_Session_Handler();
        WC()->session->init();
    }

    // Initialize WooCommerce cart
    if (!WC()->cart) {
        WC()->cart = new WC_Cart();
    }

    // Calculate totals and shipping
    WC()->cart->calculate_totals();
    WC()->cart->calculate_shipping();

   // Ensure shipping rates are calculated
    WC()->shipping->calculate_shipping(WC()->cart->get_shipping_packages());

    $packages = WC()->shipping->get_packages();

    // error_log('Shipping packages after recalculation: ' . print_r($packages, true));

    $available_methods = isset($packages[0]['rates']) ? $packages[0]['rates'] : [];




    // Get the selected shipping method
    $chosen_methods = WC()->session->get('chosen_shipping_methods');

    
    
    // error_log('Chosen methods:' . print_r($chosen_methods, true));
    $current_method = !empty($chosen_methods[0]) ? $chosen_methods[0] : '';

    // Check if free shipping is applicable
    $has_free_shipping = false;
    foreach ($available_methods as $method_id => $method) {
        // Check if free shipping is available
        if (strpos($method_id, 'free_shipping') !== false) {
            // Free shipping found
            $has_free_shipping = true;
            $free_shipping_method = $method; // Save the free shipping method for later processing
    
            // Rebuild available_methods to include only free shipping
            $available_methods = array(
                $method_id => $method
            );
    
            // error_log('Removed all non-free shipping methods.');
    
            // Force free shipping as the chosen method in the session
            WC()->session->set('chosen_shipping_methods', array($method_id));
            // error_log('Updated chosen method to free shipping: ' . print_r(WC()->session->get('chosen_shipping_methods'), true));
    
            // Recalculate totals and shipping after modifications
            WC()->cart->calculate_shipping();
            WC()->cart->calculate_totals();
    
            break; // Exit the loop once free shipping is found
        }
    }
    
    
    

    foreach ($available_methods as $method_id => $method) {
        // Ensure the cost is set correctly
        if (empty($method->cost)) {
            $instance_settings = get_option('woocommerce_flat_rate_' . $method->instance_id . '_settings');
            $method->cost = isset($instance_settings['cost']) ? floatval($instance_settings['cost']) : 0;
        }
    
        // Fetch optional fee amount
        $feeamount = isset($instance_settings['part_of_fee']) ? floatval($instance_settings['part_of_fee']) : 0;
    
        // Add feeamount to the base cost
        $shipping_base_cost = $method->cost + $feeamount;
    
        // Dynamically determine the tax class
        $tax_class = get_option('woocommerce_shipping_tax_class');
        if ($tax_class === 'inherit') {
            $tax_class = ''; // Default to standard if set to inherit
        }
    
        // Fetch applicable tax rates for the determined tax class
        $tax_rates = WC_Tax::get_rates_for_tax_class($tax_class);
        $tax_percentage = 0;
    
        // Get the first applicable tax rate
        if (is_array($tax_rates) && !empty($tax_rates)) {
            $first_rate = reset($tax_rates);
            if (is_array($first_rate)) {
                $tax_percentage = isset($first_rate['rate']) ? floatval($first_rate['rate']) : 0;
            } elseif (is_object($first_rate)) {
                $tax_percentage = isset($first_rate->tax_rate) ? floatval($first_rate->tax_rate) : 0;
            }
        }
    
        // Calculate tax amount and total cost
        $calculated_tax = ($shipping_base_cost * $tax_percentage) / 100;
        $method->cost_with_tax = $shipping_base_cost + $calculated_tax;
        $method->total = $method->cost_with_tax;
    
       
    }
    
    
    


    // Sort shipping methods by cost
    usort($available_methods, function($a, $b) {
        return $a->total - $b->total;
    });

    // Generate HTML output
    $output = '';
    $index = 0;
    $selected_price = ''; // Initialize selected_price
    

    if ($has_free_shipping && $free_shipping_method) {
        // Force free shipping as the default method if available
        WC()->session->set('chosen_shipping_methods', array($free_shipping_method->id));
        $current_method = $free_shipping_method->id; // Set the current method to free shipping
        $is_checked = 'checked'; // Ensure free shipping is checked
    
        // Remove non-free shipping methods
        foreach ($available_methods as $method_id => $method) {
            if ($method_id !== $free_shipping_method->id) {
                unset($available_methods[$method_id]);
                error_log('Removed non-free shipping method: ' . $method_id);
            }
        }
    
        // Recalculate totals with free shipping
        WC()->cart->calculate_shipping();
        WC()->cart->calculate_totals();
    
    
        if ($free_shipping_method && isset($free_shipping_method->instance_id)) {
            $instance_settings = get_option('woocommerce_flat_rate_' . $free_shipping_method->instance_id . '_settings');
        } else {
            $instance_settings = [];
        }
    
        $type = !empty($instance_settings['delivery_type']) ? ' - ' . $instance_settings['delivery_type'] : '';
        $delivery_from = isset($instance_settings['delivery_from']) ? intval($instance_settings['delivery_from']) : 2;
        $delivery_to = isset($instance_settings['delivery_to']) ? intval($instance_settings['delivery_to']) : 3;
        $delivery_days = calculate_delivery_date_range($delivery_from, $delivery_to);
        $delivery_days_text = $delivery_days['from'] . ' - ' . $delivery_days['to'];
    
        $is_colored = (strpos($current_method, 'free_shipping') !== false) ? ' style="background-color:rgb(176, 228, 197);"' : '';
    
        $output .= '
            <div class="rf-option-container"' . $is_colored . '>
                <div class="rf-option-left">
                    <input data-freelabel="' . esc_attr(__('Gratis', 'nutrisslim-suiteV2')) . '" 
                           data-label="' . esc_html($free_shipping_method->label) . $type . '" 
                           type="radio" class="rf-custom-checkbox radio" 
                           name="rf_nacin_dostave" 
                           id="rf_' . esc_attr($free_shipping_method->id) . '" 
                           value="' . esc_attr($free_shipping_method->id) . '" ' . 'checked="checked">
                    <label for="rf_' . esc_attr($free_shipping_method->id) . '">
                        <div class="rf-option-title">' . esc_html($free_shipping_method->label) . $type . ' (' . esc_attr(__('Gratuit', 'nutrisslim-suiteV2')) . ')</div>
                        <div class="rf-option-description"></div>
                    </label>
                </div>
            </div>';
    
    } else {
        foreach ($available_methods as $method_id => $method) {
            $is_checked = ($current_method === $method->id) ? 'checked' : '';
            $is_colored = ($current_method === $method->id) ? ' style="background-color:rgb(176, 228, 197);"' : '';
            $instance_settings = get_option('woocommerce_flat_rate_' . $method->instance_id . '_settings');
            $type = !empty($instance_settings['delivery_type']) ? ' - ' . $instance_settings['delivery_type'] : '';
            $delivery_days = calculate_delivery_date_range(
                isset($instance_settings['delivery_from']) ? intval($instance_settings['delivery_from']) : 2,
                isset($instance_settings['delivery_to']) ? intval($instance_settings['delivery_to']) : 3
            );
            $delivery_days_text = $delivery_days['from'] . ' - ' . $delivery_days['to'];
            $price = wc_price($method->cost_with_tax);

            $output .= '
                <div class="rf-option-container"' . $is_colored . '>
                    <div class="rf-option-left">
                        <input data-fee-label="' . esc_html($method->label) . $type . '" 
                               data-label="' . esc_html($method->label) . $type . '" 
                               type="radio" class="rf-custom-checkbox radio" 
                               name="rf_nacin_dostave" 
                               id="rf_' . esc_attr($method->id) . '" 
                               value="' . esc_attr($method->id) . '" ' . $is_checked . '>
                        <label for="rf_' . esc_attr($method->id) . '">
                            <div class="rf-option-title">' . esc_html($method->label) . $type . ' (+' . $price . ')</div>
                        </label>
                    </div>
                    <img src="' . esc_url($instance_settings['shipping_image']) . '" 
                         alt="' . esc_attr($method->label) . '" 
                         class="rf-option-image">
                </div>';
            // ('is checked:' . $is_checked);
            if ($is_checked) {
                $price = wc_price($method->cost);
                $selected_price = $price;
            }
        }
    }

   

    wp_send_json_success(array(
        'price' => $selected_price,
        'method' => $chosen_methods,
        'custom_block_html' => $output,
    ));
}


add_action('woocommerce_checkout_create_order_shipping_item', 'add_custom_shipping_cost_to_order', 10, 4);

function add_custom_shipping_cost_to_order($item, $package_key, $package, $order) {
    $chosen_methods = WC()->session->get('chosen_shipping_methods');
    $current_method = !empty($chosen_methods[0]) ? $chosen_methods[0] : '';

    $available_methods = isset($package['rates']) ? $package['rates'] : [];

    foreach ($available_methods as $method_id => $method) {

        if ($method_id === $current_method) {
            // Check if this is a free shipping method
            if (strpos($method_id, 'free_shipping') !== false) {
                // Free shipping - set total to 0
                $item->set_total(0);
            } else {
                // Paid shipping - ensure the cost is set correctly
                if (empty($method->cost)) {
                    $instance_settings = get_option('woocommerce_flat_rate_' . $method->instance_id . '_settings');
                    $method_cost = isset($instance_settings['cost']) ? $instance_settings['cost'] : '0';

                    // Parse cost with the correct decimal separator
                    $method_cost = str_replace(',', '.', $method_cost);
                    $method->cost = floatval($method_cost);
                }

                $item->set_total($method->cost);
            }
            break; // Exit loop once current method is processed
        }
    }
}

add_filter('woocommerce_payment_gateways', 'add_custom_cod_gateway');
function add_custom_cod_gateway($gateways) {
    $gateways[] = 'WC_Gateway_COD_Custom';
    return $gateways;
}

add_action('plugins_loaded', 'init_custom_cod_gateway');
function init_custom_cod_gateway() {
    if (!class_exists('WC_Payment_Gateway')) return;

    class WC_Gateway_COD_Custom extends WC_Gateway_COD {
        public function __construct() {
            parent::__construct();

            // Add new field
            add_filter('woocommerce_settings_api_form_fields_cod', array($this, 'custom_cod_form_fields'));
        }

        public function custom_cod_form_fields($fields) {
            $fields['cod_extra_fee'] = array(
                'title'       => __('COD Extra Fee', 'nutrisslim-suiteV2'),
                'type'        => 'number',
                'description' => __('Enter the extra fee for COD payment method (e.g., 5.00).', 'nutrisslim-suiteV2'),
                'default'     => '',
                'desc_tip'    => true,
                'custom_attributes' => array(
                    'step' => '0.01',
                    'min'  => '0'
                )
            );
            return $fields;
        }
    }
}

add_action('woocommerce_cart_calculate_fees', 'add_cod_extra_fee');
function add_cod_extra_fee() {
    if (is_admin() && !defined('DOING_AJAX')) return;

    // Ensure the chosen payment method is available
    if (isset(WC()->session->chosen_payment_method) && WC()->session->chosen_payment_method === 'cod') {
        // Use the correct option name based on the gateway ID
        $payment_gateways = WC()->payment_gateways->payment_gateways();
        if (isset($payment_gateways['cod'])) {
            $cod_gateway = $payment_gateways['cod'];
            $extra_fee_inclusive = $cod_gateway->get_option('cod_extra_fee');
            if ($extra_fee_inclusive && is_numeric($extra_fee_inclusive)) {
                // Calculate the base amount of the fee excluding tax
                $tax_class = '';
                $tax_rates = WC_Tax::get_rates($tax_class);
                $taxes = WC_Tax::calc_tax($extra_fee_inclusive, $tax_rates, true);
                $tax_amount = array_sum($taxes);
                $extra_fee_exclusive = $extra_fee_inclusive - $tax_amount;

                // Add the fee including tax
                WC()->cart->add_fee(__('Dodatkowa opłata za płatność za pobraniem', 'nutrisslim-suiteV2'), (float) $extra_fee_exclusive, true, $tax_class);
            }
        }
    }
}


add_action('wp_ajax_rf_add_to_cart_custom_price', 'rf_add_to_cart_custom_price');
add_action('wp_ajax_nopriv_rf_add_to_cart_custom_price', 'rf_add_to_cart_custom_price');

function rf_add_to_cart_custom_price() {
    error_log(print_r('rf_add_to_cart_custom_price', true));
    if (!isset($_POST['product_id']) || !isset($_POST['product_price'])) {
        wp_send_json_error('Invalid product data');
        return;
    }

    $product_id = intval($_POST['product_id']);
    $product_price = floatval($_POST['product_price']);

    $product = wc_get_product($product_id);
    if (!$product) {
        wp_send_json_error('Invalid product');
        return;
    }

    $cart_item_data = array(
        'custom_price' => $product_price,
        'offer' => 'checkout_upsell'
    );

    $added = WC()->cart->add_to_cart($product_id, 1, 0, array(), $cart_item_data);
    
    if ($added) {
        // Update the cart item price to the custom price
        wp_send_json_success();
    } else {
        wp_send_json_error('Failed to add product to cart');
    }
}

// add_filter('woocommerce_add_cart_item_data', 'add_custom_cart_item_data', 10, 2);
function add_custom_cart_item_data($cart_item_data, $product_id) {
    if (isset($_POST['offer']) && $_POST['offer'] === 'checkout_upsell') {
        $cart_item_data['offer'] = sanitize_text_field($_POST['offer']);
    }
    return $cart_item_data;
}

function move_payment_above_order_review() {
    // Remove the default payment method and order review actions
    remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
    
    // USE IT TO SWITCH ON AND OFF REALL REVIEW>>>>
    remove_action('woocommerce_checkout_order_review', 'woocommerce_order_review', 10);

    // Add the payment method section above the order review section
    add_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 5);
    // add_action('woocommerce_checkout_order_review', 'woocommerce_order_review', 20);
}
add_action('wp', 'move_payment_above_order_review');

function remove_order_review_heading() {
    // Remove the default order review heading
    remove_action('woocommerce_checkout_before_order_review_heading', 'woocommerce_checkout_order_review_heading', 10);
}
add_action('wp', 'remove_order_review_heading');

function add_h3_order_summary_title() {
    // Add an h2 title before the order review table
    echo '<h3 id="payment_method_heading_inner">' . esc_html__('Payment methods', 'nutrisslim-suiteV2') . '</h3>';
    echo '<div id="bottomicons"><img src="' . get_nutrislim_assets_url() . 'ssl-encryption.png" /><img src="' . get_nutrislim_assets_url() . 'visa-verified.jpg" /><img src="' . get_nutrislim_assets_url() . 'mastercard-securecode.png" /></div>';
}
add_action('woocommerce_checkout_order_review', 'add_h3_order_summary_title', 5);

function additional_elements() {
    echo '<h3 id="order_review_heading_inner">' . esc_html__('Your order', 'nutrisslim-suiteV2') . '<span class="toggle">' . esc_html__('Show / Hide', 'nutrisslim-suiteV2') . '</span></h3>';
    echo '<p id="final-message">' . esc_html__('This is an order with an obligation to pay. By submitting it, you agree to this. We are committed to protecting and respecting your privacy, so we will only use personal data to manage your order or account and provide information about the products you order from us.', 'nutrisslim-suiteV2') . '</p>';
}
add_action('woocommerce_review_order_before_submit', 'additional_elements', 14);
add_action('woocommerce_review_order_before_submit', 'woocommerce_order_review', 15);


// Add this code to your theme's functions.php file or your custom plugin

// Removes subitems on checkout

function hide_products_with_meta_key_in_checkout($visible, $cart_item, $cart_item_key) {
    error_log(print_r('hide_products_with_meta_key_in_checkout', true));

    // Check if the product has the specific meta key 'nutrisslim_parent_id'
    if (isset($cart_item['nutrisslim_parent_id'])) {
        return false; // Hide this item in the checkout page
    }
    return $visible; // Show this item in the checkout page
}
// ENABLE THIS TO HIDE CHILD ITEMS ON CHECKOUT ! ! ! 
add_filter( 'woocommerce_checkout_cart_item_visible', 'hide_products_with_meta_key_in_checkout', 10, 3 );

// Add this code to your theme's functions.php file or your custom plugin

function modify_nutrisslim_product_total($subtotal, $cart_item, $cart_item_key) {
    // Check if 'landing_page_id' exists in the session
    $lid = isset($_SESSION['landing_page_id']) ? $_SESSION['landing_page_id'] : '';

    $_product = $cart_item['data'];

    // Check if the product type is 'nutrisslim'
    if ($_product->get_type() == 'nutrisslim') {
        $quantity = $cart_item['quantity'];

        // Check if the item has the 'subscription' meta key
        if (isset($cart_item['subscription']) && $cart_item['subscription'] > 0) {
            $custom_price = get_custom_product_price($_product->get_id(), $quantity, $lid, '', true, true);
        } else if (isset($cart_item['regulargift'])) {
            $custom_price = 0;
        } else if (WC()->session->get('afterpurchase')) {
            $custom_price = get_custom_product_price($_product->get_id(), $quantity, $lid, '', true, true);
        } else {
            $custom_price = get_custom_product_price($_product->get_id(), $quantity, $lid, '', true);
        }

        // Ensure the custom price is calculated without applying discounts
        $custom_price_with_tax = wc_get_price_including_tax($_product, ['price' => $custom_price]);
        $custom_total = $custom_price_with_tax;

        // Format the custom total to match WooCommerce's format
        $subtotal = wc_price($custom_total);
    } else {
        // Fetch the original price directly from the product without applying discounts
        $original_price = $_product->get_price();
        $original_price_with_tax = wc_get_price_including_tax($_product, ['price' => $original_price]);
        $custom_total = $original_price_with_tax * $cart_item['quantity'];

        $subtotal = wc_price($custom_total);
    }

    return $subtotal;
}

// Apply the filter for the cart and checkout pages
add_filter('woocommerce_cart_item_subtotal', 'modify_nutrisslim_product_total', 10, 3);
add_filter('woocommerce_checkout_cart_item_subtotal', 'modify_nutrisslim_product_total', 10, 3);




// Hide items with nutrisslim_parent_id in the order details
function hide_nutrisslim_parent_id_order_items($visible, $item) {
    if ($item->get_meta('nutrisslim_parent_id')) {
        return false; // Hide this item in the order details
    }
    return $visible; // Show this item in the order details
}

add_filter('woocommerce_order_item_visible', 'hide_nutrisslim_parent_id_order_items', 10, 2);

function conditional_remove_bacs_payment_method($available_gateways) {
    // Start session if not started
    if (!session_id()) {
        session_start();
    }

    // Check if we are on the checkout page
    if (is_checkout()) {
        // Check if the "basc=true" parameter is in the URL
        if (isset($_GET['basc']) && $_GET['basc'] == 'true') {
            // Set session variable
            $_SESSION['basc'] = true;
        }

        // Check if the URL parameter is not present and the session variable is not set
        if ((!isset($_GET['basc']) || $_GET['basc'] != 'true') && !isset($_SESSION['basc'])) {
            // Remove the BACS payment method
            if (isset($available_gateways['bacs'])) {
                unset($available_gateways['bacs']);
            }
        }
    }
    return $available_gateways;
}
add_filter('woocommerce_available_payment_gateways', 'conditional_remove_bacs_payment_method');


// Handle the custom shipping cost update via AJAX
function custom_update_shipping_cost() {
    $shipping_method = sanitize_text_field($_POST['shipping_method']);
    $fee = isset($_POST['fee']) ? floatval($_POST['fee']) : 0;
    $feelabel = isset($_POST['feelabel']) ? sanitize_text_field($_POST['feelabel']) : '';
    /*
    error_log(print_r('-------------------------------------------->', true));
    error_log(print_r($shipping_rates, true));
    */
    $shipping_rates = WC()->session->get('shipping_for_package_0')['rates'];
    $shipping_cost = 0;
    $free_shipping_applicable = false;    

    // Check if free shipping is available
    foreach ($shipping_rates as $rate) {
        if ($rate->method_id === 'free_shipping') {
            $free_shipping_applicable = true;
            break;
        }
    }

    if ($free_shipping_applicable) {
        $shipping_cost = 0;
    } elseif (isset($shipping_rates[$shipping_method])) {
        $shipping_cost = $shipping_rates[$shipping_method]->cost;
    }    

    WC()->session->set('custom_shipping_cost', $shipping_cost);    
    WC()->session->set('custom_shipping_fee_label', $feelabel);
    WC()->session->set('custom_shipping_fee', $fee);

    // Recalculate cart totals
    WC()->cart->calculate_totals();
    wp_die();
}
add_action('wp_ajax_custom_update_shipping_cost', 'custom_update_shipping_cost');
add_action('wp_ajax_nopriv_custom_update_shipping_cost', 'custom_update_shipping_cost');


function custom_adjust_shipping_cost_and_fee($cart) {
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }

    // Get custom shipping cost and fee from session
    $custom_shipping_fee = WC()->session->get('custom_shipping_fee');
    $custom_shipping_fee_label = WC()->session->get('custom_shipping_fee_label');
    $custom_shipping_cost = WC()->session->get('custom_shipping_cost');

    // Get chosen shipping method
    $chosen_methods = WC()->session->get('chosen_shipping_methods');
    $current_method = !empty($chosen_methods[0]) ? $chosen_methods[0] : '';

    // Adjust shipping cost
    $packages = WC()->shipping()->get_packages();

    foreach ($packages as $package_key => $package) {
        foreach ($package['rates'] as $rate) {
            // Only modify the chosen shipping method, and skip free shipping
            if ($rate->get_id() === $current_method && strpos($rate->get_id(), 'free_shipping') === false) {
                $rate->set_cost($custom_shipping_cost);
                // Update the package rates
                WC()->shipping()->packages[$package_key]['rates'][$rate->get_id()] = $rate;
            }
        }
    }

    // Add the custom fee with tax calculation
    if (!empty($custom_shipping_fee_label) && $custom_shipping_fee > 0) {
        // Calculate the base amount of the fee excluding tax
        $tax_class = '';
        $tax_rates = WC_Tax::get_rates($tax_class);
        $taxes = WC_Tax::calc_tax($custom_shipping_fee, $tax_rates, true);
        $tax_amount = array_sum($taxes);
        $custom_shipping_fee_exclusive = $custom_shipping_fee - $tax_amount;

        // Add the fee including tax
        $cart->add_fee($custom_shipping_fee_label, (float) $custom_shipping_fee_exclusive, true, $tax_class);
    }
}
add_action('woocommerce_cart_calculate_fees', 'custom_adjust_shipping_cost_and_fee', 997);

add_action('woocommerce_after_checkout_validation', 'check_disallowed_emails');

function check_disallowed_emails($data) {
    // Array of disallowed emails
    $disallowed_emails = array();
    if( have_rows('blocked_emails', 'option') ) {
        while( have_rows('blocked_emails', 'option') ) {
            the_row();
            $disallowed_emails[] = get_sub_field('email');
        }
    }

    // Get the user's email from the checkout data
    $user_email = isset($data['billing_email']) ? $data['billing_email'] : '';

    // Check if the user's email is in the disallowed list
    if (in_array($user_email, $disallowed_emails)) {
        wc_add_notice('There is an issue with your order at the moment. Please contact our support for more info.', 'error');
    }
}

add_action('woocommerce_checkout_create_order_line_item', 'add_cart_item_meta_to_order_item', 10, 4);

function add_cart_item_meta_to_order_item($item, $cart_item_key, $values, $order) {
    if (isset($values['regulargift'])) {
        $item->add_meta_data('regulargift', $values['regulargift']);
    }
}

function save_subscription_price_to_order_item( $item, $cart_item_key, $values, $order ) {
    if ( isset( $values['subscription_price'] ) ) {
        $item->add_meta_data('subscription_price', $values['subscription_price']);
    }
}
add_action( 'woocommerce_checkout_create_order_line_item', 'save_subscription_price_to_order_item', 10, 4 );

function set_default_destination_country_to_first_specific_country($packages) {
    // Get the list of specific countries from WooCommerce settings
    $specific_countries = get_option('woocommerce_specific_allowed_countries');

    // Check if there are any specific countries set
    if (is_array($specific_countries) && !empty($specific_countries)) {
        // Get the first country in the list
        $first_country = reset($specific_countries);

        // Loop through each package and set the destination country
        foreach ($packages as &$package) {
            $package['destination']['country'] = $first_country;
        }
    }

    return $packages;
}

add_filter('woocommerce_cart_shipping_packages', 'set_default_destination_country_to_first_specific_country');

// PHP function to generate checkout offer HTML
function get_checkout_offer_ajax() {
    
        ob_start();
        
        $items = get_field('checkout_offer', 'option');

        // Get all product IDs currently in the cart
        $cart_product_ids = array();
        foreach (WC()->cart->get_cart() as $cart_item) {
            $cart_product_ids[] = $cart_item['product_id'];
        }

        // Initialize a variable to check if there are any products to display
        $has_available_products = false;

        echo '<div class="swiper-container checkoutOffer">';
        echo '<div class="swiper-wrapper">';
        
        foreach ($items as $item) {
            $pid = $item['product'];

            // Check if the product is already in the cart
            if (in_array($pid, $cart_product_ids)) {
                continue; // Skip this product if it's already in the cart
            }

            // If at least one product is available, set the flag to true
            $has_available_products = true;

            $price = $item['price'];
            $_product = wc_get_product($pid);            
            $offer_price = $item['price'];
            $regular_price = $_product->get_regular_price();
            if (!wc_prices_include_tax()) {
                $offer_price_with_tax = wc_get_price_including_tax( $_product, array( 'price' => $offer_price ) );
                $regular_price_with_tax = wc_get_price_including_tax( $_product, array( 'price' => $regular_price ) );
            }
            $discount_percentage = (($regular_price - $offer_price) / $regular_price) * 100;
            $discount_percentage = round($discount_percentage);   
            $short_description = get_field('short_info', $pid);

            if (empty($short_description)) {
                $short_description = $_product->get_short_description();
            }
            if (empty($short_description)) {
                $short_description = $_product->get_description();
            }

            $short_description = wp_trim_words($short_description, 15, '...');

            echo '<div class="swiper-slide">';
            echo '<div class="inner grid">';

            echo '<div class="col-5">';
            echo '<div class="image-holder"><span class="onsale">-' . $discount_percentage . '%</span><img src="' . wp_get_attachment_image_src(get_post_thumbnail_id($pid), 'medium')[0] . '" class="img-responsive"></div>';
            echo '</div>'; // col-5
            echo '<div class="col-7 descHolder">';
            echo '<h5>' . get_the_title($pid) . '</h5>';
            echo '<div class="desc"><p>' . $short_description . '</p></div>';
            echo '<div class="price">'; 
            // echo '<del>' . $regular_price_with_tax . get_woocommerce_currency_symbol() . '</del>';                            
            echo '<del style="font-weight: 600;">' . wc_price($regular_price_with_tax) . '</del>';                            
            // echo '<span>' . $offer_price_with_tax . get_woocommerce_currency_symbol() . '</span>';
            echo '<span>' . wc_price($offer_price_with_tax) . '</span>';

            echo '</div>'; // end pricecol
            echo '</div>'; // descHolder

            echo '<div class="col-12 text-center">';
            echo '<a data-pid="' . $pid . '" data-price="' . $offer_price . '" href="#" class="rf-checkout-upsell-btn">';
            echo '<img decoding="async" src="/wp-content/uploads/2024/04/Home-Ikone-NOVO_cart.svg" alt="Adaugă în coș" style="vertical-align: middle; margin-right: 8px;">' . __('Adaugă în coș', 'nutrisslim-suiteV2') . '</a>';
            echo '</div>'; // col-12

            echo '</div>'; // inner
            echo '</div>'; // swiper-slide
        }

        echo '</div>'; // swiper-wrapper
        echo '<div class="swiper-button-next"></div>';
        echo '<div class="swiper-button-prev"></div>';
        echo '</div>'; // checkoutOffer

        $ret = ob_get_clean();

        // If no available products, return an empty string
        if (!$has_available_products) {
            $ret = '';
        }

        wp_send_json_success(['html' => $ret]);

        wp_die();
}

// Register the AJAX action
add_action('wp_ajax_get_checkout_offer', 'get_checkout_offer_ajax');
add_action('wp_ajax_nopriv_get_checkout_offer', 'get_checkout_offer_ajax');


// add_action('woocommerce_checkout_process', 'set_billing_country_to_gb');
// function set_billing_country_to_gb() {
//     // Check if the billing country is set, and if not, set it to GB
//     if (WC()->session->get('billing_country') != 'GB') {
//         WC()->customer->set_billing_country('GB');
//     }
// }



// add_filter('woocommerce_calculated_total', 'cwc_handle_tax_logic', 10, 2);

function cwc_handle_tax_logic($total, $cart) {
    if (is_admin() && !defined('DOING_AJAX')) {
        return $total; // Avoid running in the admin panel
    }
    if (!wc_prices_include_tax()) {
 
        // Initialize adjusted total
        $adjusted_total = 0;

        // 1. Adjust cart item prices to avoid double tax
        foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
            $product = $cart_item['data'];

            // Retrieve the product price
            $product_price = $product->get_price();

            // Check if the price already includes tax
            $price_with_tax = wc_get_price_including_tax($product);
            $price_without_tax = wc_get_price_excluding_tax($product);

            // Determine the price to use
            if ($product_price == $price_with_tax) {
                // Price already includes tax, use it directly
                $adjusted_total += $product_price * $cart_item['quantity'];
            } else {
                // WooCommerce can apply tax as usual
                $adjusted_total += $price_without_tax * $cart_item['quantity'];
            }
        }

        // 2. Add shipping costs only if the total is below the free shipping threshold
        if ($cart->get_shipping_total() > 0) {
            $free_shipping_threshold = 0;

            // Get WooCommerce free shipping method thresholds
            $shipping_methods = WC()->session->get('chosen_shipping_methods'); // Get chosen shipping methods
            $zones = WC_Shipping_Zones::get_zones(); // Retrieve shipping zones

            // Loop through zones to find free shipping thresholds
            foreach ($zones as $zone) {
                foreach ($zone['shipping_methods'] as $method) {
                    if ($method->id === 'free_shipping' && isset($method->instance_settings['min_amount'])) {
                        $free_shipping_threshold = (float) $method->instance_settings['min_amount'];
                    }
                }
            }

            // Check if cart total exceeds the free shipping threshold
            $cart_total = $cart->get_cart_contents_total() + $cart->get_shipping_total() - $cart->get_discount_total();
            if ($cart_total < $free_shipping_threshold) {
                // If cart total is below the threshold and no free shipping is chosen, add shipping costs
                if (!in_array('free_shipping', $shipping_methods)) {
                    $adjusted_total += $cart->get_shipping_total() + $cart->get_shipping_tax();
                }
            }
        }

        // 3. Add cart fees (including tax if applicable)
        $fee_total = $cart->get_fee_total(); // Fees without tax
        $fee_tax_total = $cart->get_fee_tax(); // Total tax applied to fees
        $adjusted_total += ($fee_total + $fee_tax_total);

        // 4. Subtract discounts
        $adjusted_total -= $cart->get_discount_total();

        // Return the adjusted total, rounded to 2 decimals
        return round($adjusted_total, 2);
    } 
}

/* IZRAČUNAJ TOTAL PRODUKTOV V CHECKOUTU */

add_filter('woocommerce_cart_subtotal', 'nutri_combined_cart_total', 10, 3);

function nutri_combined_cart_total($cart_subtotal, $compound, $cart) {
    // Ensure session landing page ID
    $lid = isset($_SESSION['landing_page_id']) ? $_SESSION['landing_page_id'] : '';
    $total = 0;
    foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
        // error_log('Cart item: ' . $cart_item['line_subtotal']);
        // Skip products that have a parent_id other than 0
        $_product = $cart_item['data'];

        // error_log('Product type: ' . $_product->get_type());

		//if ($cart_item['nutrisslim_parent_id'] > 0) {
		if (isset($cart_item['nutrisslim_parent_id']) && $cart_item['nutrisslim_parent_id'] > 0) {	
			
            $_product = $cart_item['data'];
            $quantity = $cart_item['quantity'];
            // Only calculate price for 'nutrisslim' type products
            if ($_product->get_type() == 'nutrisslim') {
                if (isset($cart_item['subscription']) && $cart_item['subscription'] > 0) {
                    $custom_price = get_custom_product_price($_product->get_id(), $quantity, $lid, '', true, true);
                } elseif (isset($cart_item['regulargift'])) {
                    $custom_price = 0;
                } else {
                    $custom_price = get_custom_product_price($_product->get_id(), $quantity, $lid, '', true);
                }
                $custom_total = $custom_price; // Correct price for parent product
            } else {
                // Default subtotal for non-nutrisslim products
                $custom_total = $cart_item['line_subtotal'];
            }
           
        } elseif (isset($cart_item['offer']) && $cart_item['offer']){
            $custom_total = $cart_item['line_subtotal'];
            // error_log('Offer price: ' . $cart_item['line_subtotal']);
        } else {
            $custom_total = $cart_item['line_subtotal'];
        }


        $total += $custom_total; // Add to total
        // error_log('Custom total: ' . $custom_total . ' Total: ' . $total);

		// echo '<script>console.log("SUBTOTAL: - '.$total.'");</script>';
    }
    // Format and return the combined cart subtotal
    return wc_price($total);
}



add_filter('woocommerce_cart_calculate_fees', 'round_woocommerce_fees_to_two_decimals', 10, 2);

function round_woocommerce_fees_to_two_decimals($cart) {
    foreach ($cart->get_fees() as $fee) {
        $fee->amount = round($fee->amount, 2);
    }
}

add_filter('woocommerce_cart_totals_fee_html', 'display_fee_with_tax', 10, 2);

function display_fee_with_tax($fee_html, $fee) {
    // Ensure $fee is an object and has the necessary properties
    if (is_object($fee) && isset($fee->amount, $fee->tax)) {
        // Calculate the fee total including tax
        $fee_total_incl_tax = $fee->amount;

        // Return the fee display with tax included
        return wc_price($fee_total_incl_tax);
    }

    // If $fee is not valid, return the original HTML
    return $fee_html;
}

/**
 * Scroll to WooCommerce checkout notices/errors when they appear.
 * - Loads only on the checkout (not the thank-you page).
 * - Depends on wc-checkout + jQuery to ensure correct load order.
 */
add_action('wp_enqueue_scripts', function () {
    if (function_exists('is_checkout') && is_checkout() && !is_order_received_page()) {

        // Register a tiny inline script that depends on Woo's checkout script.
        // If you prefer a file, enqueue it instead with deps ['jquery','wc-checkout'].
        $inline_js = <<<JS
(function($){
    'use strict';

    /**
     * Computes a safe scroll offset accounting for things like the WP admin bar
     * and common sticky headers. Adjust selector as needed for your theme header.
     */
    function getScrollOffset(){
        var offset = 16; // base padding
        var \$admin = $('#wpadminbar');
        if (\$admin.length && \$admin.is(':visible')) {
            offset += \$admin.outerHeight();
        }
        var \$stickyHeader = $('.site-header.is-sticky:visible, .elementor-sticky--active:visible').first();
        if (\$stickyHeader.length) {
            offset += \$stickyHeader.outerHeight();
        }
        // Optional: allow manual override via global
        if (typeof window.WC_SCROLL_NOTICE_OFFSET === 'number') {
            offset = window.WC_SCROLL_NOTICE_OFFSET;
        }
        return offset;
    }

    /**
     * Finds and scrolls to the first visible WooCommerce notice on checkout.
     * Targets errors, infos, and messages rendered in standard Woo containers.
     */
    function scrollToCheckoutNotice(){
        // Containers Woo uses around notices on checkout
        var \$groups  = $('.woocommerce-NoticeGroup-checkout, .woocommerce-notices-wrapper');
        // Actual notices Woo outputs
        var \$notice = \$groups.find('.woocommerce-error, .woocommerce-info, .woocommerce-message').filter(':visible').first();

        if (!\$notice.length) {
            // Fallback: sometimes Woo places errors directly inside the group without extra wrappers
            \$notice = \$groups.filter(':visible').first();
        }
        if (!\$notice.length) return;

        // Compute target position and animate
        var targetTop = Math.max(0, Math.round(\$notice.offset().top - getScrollOffset()));
        $('html, body').stop(true).animate({ scrollTop: targetTop }, 300);

        // Accessibility: ensure it can receive focus, then focus it
        if (!\$notice.attr('tabindex')) {
            \$notice.attr('tabindex', '-1');
        }
        \$notice.trigger('focus');
    }

    /**
     * Wire up events:
     * - 'checkout_error' fires when AJAX validation returns errors.
     * - 'updated_checkout' fires after fragments update (e.g., fees/shipping/validation).
     * - MutationObserver catches any 3rd-party plugins that inject notices outside the normal events.
     */
    function bindNoticeScrolling(){
        // Woo core events
        $(document.body)
            .on('checkout_error', scrollToCheckoutNotice)
            .on('updated_checkout', function(){ setTimeout(scrollToCheckoutNotice, 10); });

        // Observe dynamic changes to the notice containers (covers edge cases)
        var targets = document.querySelectorAll('.woocommerce-NoticeGroup-checkout, .woocommerce-notices-wrapper');
        targets.forEach(function(node){
            try {
                new MutationObserver(function(){
                    // Debounce slightly to wait for layout
                    clearTimeout(node.__wcNoticeTimer);
                    node.__wcNoticeTimer = setTimeout(scrollToCheckoutNotice, 20);
                }).observe(node, { childList: true, subtree: true });
            } catch(e){}
        });

        // Initial run (in case notices already exist on load)
        $(function(){ scrollToCheckoutNotice(); });
    }

    // Ensure jQuery + checkout script have run
    $(bindNoticeScrolling);

})(jQuery);
JS;

        // Ensure wc-checkout is enqueued first, then add our inline code after it.
        wp_enqueue_script('wc-checkout');
        wp_add_inline_script('wc-checkout', $inline_js, 'after');
    }
});