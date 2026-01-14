<?php

// add_action( 'admin_enqueue_scripts', 'enqueue_select2_scripts' );
function enqueue_select2_scripts() {
    wp_enqueue_script( 'select2' );
    wp_enqueue_style( 'select2' );
    wp_enqueue_script( 'woocommerce_admin' ); // WooCommerce admin scripts which include select2 initialization
}

// Add custom discount type to coupon discount types.
add_filter( 'woocommerce_coupon_discount_types', 'add_gift_product_coupon_discount_type' );
function add_gift_product_coupon_discount_type( $discount_types ) {
    $discount_types['gift_product'] = __( 'Gift Product', 'woocommerce-gift-product-coupon' );
    return $discount_types;
}

// Add custom fields for gift product selection.
add_action( 'woocommerce_coupon_options', 'add_gift_product_coupon_fields', 10, 0 );
function add_gift_product_coupon_fields() {
    ?>
    <div class="options_group">
        <p class="form-field">
            <label for="gift_product"><?php _e( 'Gift Product', 'woocommerce-gift-product-coupon' ); ?></label>
            <select id="gift_product" name="gift_product" class="wc-product-search" style="width: 50%;" data-placeholder="<?php _e( 'Search for a product&hellip;', 'nutrisslim-suiteV2' ); ?>" data-action="woocommerce_json_search_products_and_variations">
                <?php
                $product_id = get_post_meta( get_the_ID(), 'gift_product', true );
                $product = wc_get_product( $product_id );
                if ( $product_id && $product ) {
                    echo '<option value="' . esc_attr( $product_id ) . '" selected="selected">' . esc_html( $product->get_name() ) . '</option>';
                }
                ?>
            </select>
            <?php echo wc_help_tip( __( 'Select the product to gift when this coupon is applied.', 'woocommerce-gift-product-coupon' ) ); ?>
        </p>
    </div>
    <?php
}

// Save custom coupon fields.
add_action( 'woocommerce_coupon_options_save', 'save_gift_product_coupon_fields', 10, 2 );
function save_gift_product_coupon_fields( $post_id, $coupon ) {
    $gift_product = isset( $_POST['gift_product'] ) ? sanitize_text_field( $_POST['gift_product'] ) : '';
    update_post_meta( $post_id, 'gift_product', $gift_product );
}

// Apply gift product when the coupon is applied.
add_action( 'woocommerce_cart_calculate_fees', 'apply_gift_product_coupon', 20, 1 );
function apply_gift_product_coupon( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
        return;
    }

    if ( empty( WC()->cart->get_applied_coupons() ) ) {
        remove_gift_product_from_cart();
        return;
    }

    $gift_product_id = null;

    foreach ( WC()->cart->get_applied_coupons() as $coupon_code ) {
        $coupon = new WC_Coupon( $coupon_code );
        if ( $coupon->get_discount_type() === 'gift_product' ) {
            $gift_product_id = get_post_meta( $coupon->get_id(), 'gift_product', true );
            break;
        }
    }

    if ( $gift_product_id ) {
        $found = false;
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            if ( $cart_item['product_id'] == $gift_product_id && isset( $cart_item['regulargift'] ) && $cart_item['regulargift'] ) {
                $found = true;
                break;
            }
        }

        if ( ! $found ) {
            $price = get_post_meta( $gift_product_id, '_price', true );
            if ( $price ) {
                $discount = -floatval( $price );
                WC()->cart->add_fee( sprintf( __( 'Gift Product Discount', 'woocommerce-gift-product-coupon' ) ), $discount, true );
                WC()->cart->add_to_cart( $gift_product_id, 1, 0, array(), array( 'regulargift' => true ) );
            }
        }
    } else {
        remove_gift_product_from_cart();
    }
}

// Remove gift product from the cart.
function remove_gift_product_from_cart() {
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        if ( isset( $cart_item['regulargift'] ) && $cart_item['regulargift'] ) {
            WC()->cart->remove_cart_item( $cart_item_key );
        }
    }
}

// Set the price of the gift product to zero.
// add_action('woocommerce_before_calculate_totals', 'set_gift_product_price_to_zero', 10, 1);

function set_gift_product_price_to_zero($cart) {
    $file_path = plugin_dir_path(__FILE__) . 'cart_content.txt';
    $content = '';

    foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
        $content .= "Product ID: " . $cart_item['product_id'] . "\n";
        $content .= "Quantity: " . $cart_item['quantity'] . "\n";
        $content .= "Is Gift Product: " . (isset($cart_item['regulargift']) ? 'Yes' : 'No') . "\n";

        // Adding all meta data
        foreach ($cart_item as $key => $value) {
            if (!is_array($value) && !is_object($value)) {
                $content .= "$key: $value\n";
            }
        }

        // Adding separator for clarity
        $content .= "----------------------------------\n";

        if (isset($cart_item['regulargift']) && $cart_item['regulargift']) {
            $content .= "Before setting to zero:\n";
            $content .= "line_total: " . $cart_item['line_total'] . "\n";
            $content .= "line_subtotal: " . $cart_item['line_subtotal'] . "\n";
            $content .= "line_tax: " . $cart_item['line_tax'] . "\n";
            $content .= "line_subtotal_tax: " . $cart_item['line_subtotal_tax'] . "\n";

            // Set prices to zero
            $cart_item['data']->set_price(0);
            $cart_item['line_total'] = 0;
            $cart_item['line_subtotal'] = 0;
            $cart_item['line_tax'] = 0;
            $cart_item['line_subtotal_tax'] = 0;

            // Append "*gift" to the product name
            $cart_item['data']->set_name($cart_item['data']->get_name() . ' *gift');

            // Update the cart item
            WC()->cart->cart_contents[$cart_item_key] = $cart_item;

            $content .= "After setting to zero:\n";
            $content .= "line_total: " . $cart_item['line_total'] . "\n";
            $content .= "line_subtotal: " . $cart_item['line_subtotal'] . "\n";
            $content .= "line_tax: " . $cart_item['line_tax'] . "\n";
            $content .= "line_subtotal_tax: " . $cart_item['line_subtotal_tax'] . "\n";
            $content .= "Product name: " . $cart_item['data']->get_name() . "\n";
        }

        // Adding separator for clarity
        $content .= "==================================\n";
    }

    file_put_contents($file_path, $content);
}



// Helper function to get products array for dropdown.
function wc_get_products_array() {
    $args = array(
        'status' => 'publish',
        'limit'  => -1,
    );
    $products = wc_get_products( $args );
    $product_options = array( '' => __( 'Select a product', 'woocommerce-gift-product-coupon' ) );
    foreach ( $products as $product ) {
        $product_options[ $product->get_id() ] = $product->get_name();
    }
    return $product_options;
}
