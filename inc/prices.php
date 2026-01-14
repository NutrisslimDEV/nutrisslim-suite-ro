<?php

function get_tax_rate_si($product_id) {
    $product = wc_get_product($product_id);
    if (!$product) {
        return 'Product not found.';
    }

    // Set up the customer location to Slovenia
    WC()->customer->set_shipping_country('GB');
    WC()->customer->set_billing_country('GB');

    // Get the tax rates applicable to the product
    $tax_rates = WC_Tax::get_rates($product->get_tax_class(), WC()->customer);
    $tax_rate_percent = 0;

    if (!empty($tax_rates)) {
        $rate = reset($tax_rates); // Get the first rate
        $tax_rate_percent = isset($rate['rate']) ? $rate['rate'] : 0;
    }

    return $tax_rate_percent;
}

function get_tax_rate_for_product($product_id, $country_code) {
    $product = wc_get_product($product_id);
    if (!$product) {
        return 'Product not found.';
    }

    if (WC()->customer) {
        // Set up the customer location to Slovenia
        WC()->customer->set_shipping_country($country_code);
        WC()->customer->set_billing_country($country_code);
    }

    // Get the tax rates applicable to the product
    $tax_rates = WC_Tax::get_rates($product->get_tax_class(), WC()->customer);
    $tax_rate_percent = 0;

    if (!empty($tax_rates)) {
        $rate = reset($tax_rates); // Get the first rate
        $tax_rate_percent = isset($rate['rate']) ? $rate['rate'] : 0;
    }

    return $tax_rate_percent;
}

function handle_add_product_to_cart_ajax() {
    error_log(print_r('handle_add_product_to_cart_ajax', true));
    if (!isset($_POST['product_id'], $_POST['quantity'], $_POST['custom_price'])) {
        wp_send_json_error(array('message' => 'Missing data'));
    }

    $gift = intval($_POST['gift']);
    $free_shipping = intval($_POST['free_shipping']);
    $lid = intval($_POST['lid']);
    
    // Remove existing gift items from the cart
    foreach (WC()->cart->get_cart() as $key => $item) {
        if (isset($item['landinggift'])) {
            // error_log(print_r('Found landinggift in cart item', true));
            if ($item['landinggift']) {
                // error_log(print_r('Removing cart item: ' . $key, true));
                WC()->cart->remove_cart_item($key);
            }
        } else {
            // error_log(print_r('No landinggift found in cart item', true));
        }
    }

    // Add new gift product to cart if provided
    if ($gift) {
        $gift_cart_item_key = WC()->cart->add_to_cart($gift, 1);
        if ($gift_cart_item_key) {
            // Set the meta to mark this as a gift
            WC()->cart->cart_contents[$gift_cart_item_key]['landinggift'] = true;
            // error_log(print_r('Added gift to cart: ' . $gift_cart_item_key, true));
        }
    } 
    
    // Set free shipping flag
    if ($free_shipping) {
        WC()->session->set('free_shipping', true);
    } else {
        WC()->session->__unset('free_shipping');
    }    

    $landingprices = get_field('quantity_prices', $lid);

    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);
    $custom_price = floatval($_POST['custom_price']);   

    $cart = WC()->cart;
    $cart_id = $cart->generate_cart_id($product_id);
    $cart_item_id = $cart->find_product_in_cart($cart_id);

    if ($cart_item_id) {
        $cart_item = $cart->get_cart_item($cart_item_id);
        $this_product = wc_get_product($product_id);
        // Update quantities on landing page on switch quantity
        if ($this_product && $this_product->get_type() == 'nutrisslim') {
            // error_log(print_r($cart->cart_contents[$cart_item_id]['data'], true));
            // $cart->cart_contents[$cart_item_id]['data']->set_price(0);
            // $cart_item['data']->set_price(0);
            // Retrieve subproducts
            $subproducts = get_field('products', $product_id);

            // error_log(print_r($subproducts, true));
    
            // Loop through all cart items
            foreach ($cart->get_cart() as $item_id => $item) {
                if (isset($item['nutrisslim_parent_id']) && $item['nutrisslim_parent_id'] == $product_id) {
                    // Find the corresponding subproduct
                    foreach ($subproducts as $subproduct) {
                        if ($subproduct['products'] == $item['product_id']) {
                            $new_quantity = $subproduct['quantity'] * $quantity;
                            // Update the cart item quantity
                            WC()->cart->set_quantity($item_id, $new_quantity, true);
                            break;
                        }
                    }
                }
            }
        }        
        /*    
        if ($this_product && $this_product->get_type() == 'nutrisslim') {
            // Loop through all cart items
            foreach ($cart->get_cart() as $item_id => $item) {
                if (isset($item['nutrisslim_parent_id']) && $item['nutrisslim_parent_id'] == $product_id) {
                    $subproducts = get_field('products', $product_id);
                    error_log(print_r($subproducts, true));
                    
                }
            }
        }
        */
    }   

    if (!$cart_item_id) {
        $cart_item_id = $cart->add_to_cart($product_id, $quantity);
    } else {
        $cart->set_quantity($cart_item_id, $quantity, true);
    }

    if ($cart_item_id && $custom_price) {
        $cart->cart_contents[$cart_item_id]['data']->set_price($custom_price);
    }

    wp_send_json_success(array('message' => 'Product added successfully'));
}
add_action('wp_ajax_add_product_to_cart', 'handle_add_product_to_cart_ajax');
add_action('wp_ajax_nopriv_add_product_to_cart', 'handle_add_product_to_cart_ajax');


// This add free shipping to the order if it has free shippin applied to the order.
add_filter('woocommerce_package_rates', 'apply_free_shipping', 10, 2);
function apply_free_shipping($rates, $package) {
    if (WC()->session->get('free_shipping')) {
        foreach ($rates as $rate_id => $rate) {
            if ('free_shipping' === $rate->method_id) {
                $rates = array($rate_id => $rate);
                break;
            }
        }
    }
    return $rates;
}


function add_product_to_cart_with_custom_price($product_id, $custom_price) {

    if (!is_admin()) {

        $quantity = 1;

        $cart = WC()->cart;

        // WC()->cart->empty_cart();
        // error_log(print_r('================> Cart is cleared', true));          

        if ($cart) {
            // First, clear the cart
            $cart->empty_cart();

            // Add the product to the cart
            $cart_item_key = $cart->add_to_cart($product_id, $quantity);

            if ($cart_item_key) {
                // Set the custom price
                $cart->cart_contents[$cart_item_key]['data']->set_price($custom_price);
            }

            // Optionally, you can save the cart here if needed
            $cart->set_session();
            $cart->maybe_set_cart_cookies();
        }

    }

}
function add_custom_price_fields() {
    // Get the number of decimals from WooCommerce settings
    $decimals = wc_get_price_decimals();    
    // Price for 2 pieces
    woocommerce_wp_text_input( array(
        'id'                => '_price_for_two',
        'label'             => __('Price for 2 pieces', 'nutrisslim-suiteV2'),
        'desc_tip'          => 'true',
        'description'       => __('Enter the special price when buying two pieces.', 'nutrisslim-suiteV2'),
        'type'              => 'number',
        'custom_attributes' => array(
            'step' => 'any',
            'min'  => '0',
            'data-decimals' => $decimals // Set the number of decimals as a data attribute
        ),
    ));

    // Price for 3 pieces
    woocommerce_wp_text_input( array(
        'id'                => '_price_for_three',
        'label'             => __('Price for 3 pieces', 'nutrisslim-suiteV2'),
        'desc_tip'          => 'true',
        'description'       => __('Enter the special price when buying three pieces.', 'nutrisslim-suiteV2'),
        'type'              => 'number',
        'custom_attributes' => array(
            'step' => 'any',
            'min'  => '0',
            'data-decimals' => $decimals // Set the number of decimals as a data attribute
        ),
    ));
}
add_action('woocommerce_product_options_pricing', 'add_custom_price_fields');

function save_custom_price_fields($product) {
    // Save Price for 2 pieces
    if (isset($_POST['_price_for_two'])) {
        $product->update_meta_data('_price_for_two', sanitize_text_field($_POST['_price_for_two']));
    }

    // Save Price for 3 pieces
    if (isset($_POST['_price_for_three'])) {
        $product->update_meta_data('_price_for_three', sanitize_text_field($_POST['_price_for_three']));
    }
}

add_action('woocommerce_admin_process_product_object', 'save_custom_price_fields');


add_filter('woocommerce_sale_flash', 'custom_sale_flash_discount_percentage', 20, 3);
function custom_sale_flash_discount_percentage($html, $post, $product) {
    // Check if the product has a regular price and a sale price
    if ($product->get_regular_price() && $product->get_sale_price()) {
        $regular_price = (float) $product->get_regular_price();
        $sale_price = (float) $product->get_sale_price();
        
        // Calculate the discount percentage
        $discount_percentage = round(100 - ($sale_price / $regular_price * 100));
        
        // Return custom sale flash HTML
        return '<span class="onsale">-' . $discount_percentage . '%</span>';
    }

    // Return default sale flash if no sale price is set
    return $html;
}

function get_custom_product_price($product_id, $quantity, $lid = '', $parent = '', $realbundle = false, $is_subscr_disc = false) {
    $product = wc_get_product($product_id);


    // Basic checks to ensure product exists
    if (!$product) {
        return 'Product not found.';
    }

    // Initialize prices
    $regular_price = $product->get_regular_price();
    // Ukoliko nema sale_price regular_price je sale_price
    $sale_price = $product->get_sale_price() ? $product->get_sale_price() : $regular_price;

    // Thise are values set for 2 and 3 items
    $price_for_two_total = get_post_meta($product_id, '_price_for_two', true);
    $price_for_three_total = get_post_meta($product_id, '_price_for_three', true);

    // If values for 2 or 3 items are not set it't value is 2 or 3 times sale_price:
    if ($price_for_two_total) {
        $price_for_two = $price_for_two_total;
    } else {
        $price_for_two = 2 * $sale_price;
    }

    if ($price_for_three_total) {
        $price_for_three = $price_for_three_total;
    } else {
        $price_for_three = 3 * $sale_price;
    }      

    // Those are prices set on landing pages
    if ($lid) {
        $qPrices = get_field('quantity_prices', $lid);
        
        if (is_array($qPrices)) {
            if (isset($qPrices[0]['price']) && !empty($qPrices[0]['price'])) {
                $sale_price = $qPrices[0]['price'];
            }
    
            if (isset($qPrices[1]['price']) && !empty($qPrices[1]['price'])) {
                $price_for_two = $qPrices[1]['price'];
            }
    
            if (isset($qPrices[2]['price']) && !empty($qPrices[2]['price'])) {
                $price_for_three = $qPrices[2]['price'];
            }
        }
    }
    

    // Find product post type
    $product_type = $product->get_type();

    if ($product_type == 'simple') {
        $price_for_two = $price_for_two / 2;
        $price_for_three = $price_for_three / 3;
    }

    // Set subscription prices for simple products 
    if ($product_type == 'simple' && $is_subscr_disc) {

        $sale_price = getDiscountedPrice($sale_price, 5);
        $subscription_discount = round((($regular_price - $sale_price) / $regular_price) * 100); 

        $price_for_two = getDiscountedPrice($price_for_two, 5);
        $subscription_discount = round((($regular_price - $price_for_two) / $regular_price) * 100);      
        
        $price_for_three = getDiscountedPrice($price_for_three, 5);
        $subscription_discount = round((($regular_price - $price_for_three) / $regular_price) * 100); 
    }

    if ($product_type == 'nutrisslim' && $is_subscr_disc) {

        $sale_price = getDiscountedPrice($sale_price, 5);
        $sale_subscr_discount = round((($regular_price - $sale_price) / $regular_price) * 100); 

        $price_for_two = getDiscountedPrice($price_for_two / 2, 5);
        $for2_subscr_discount = round((($regular_price - $price_for_two / 2) / $regular_price) * 100); 
        $price_for_two = 2 * $price_for_two;     
        
        $price_for_three = getDiscountedPrice($price_for_three / 3, 5); 
        $for3_subscr_discount = round((($regular_price - $price_for_three / 3) / $regular_price) * 100); 
        $price_for_three = 3 * $price_for_three;


        if ($quantity > 3) {
            $price_for_three = $price_for_three / 3;
            $price_for_three = $price_for_three * $quantity;
        }       
    }

    if ($product_type == 'nutrisslim' && !$is_subscr_disc) {
        if (!$realbundle) {
            $sale_price = 0;
            $price_for_two = 0;
            $price_for_three = 0;    
        } else {
             
            if ($quantity > 3) {
                $price_for_three = 0;
                foreach (WC()->cart->get_cart() as $key => $item) {
                    if (isset($item['nutrisslim_parent_id']) && $item['nutrisslim_parent_id'] === $product_id) {
                        $price_for_three = $price_for_three + $item['data']->get_price() * $item['quantity'];
                    }
                }
            } 
        }
    }


    if ($parent) {

        if ($lid) {
            $subprices = get_post_meta($lid, '_subproducts_custom_prices', true);
        } else {
            $subprices = get_post_meta($parent, '_subproducts_custom_prices', true);
        }


        if (isset($subprices[$product_id][1])) {
            $sale_price = $subprices[$product_id][1];
            if ($is_subscr_disc) {
                $sale_price = getDiscountedPrice($sale_price, 5);
                $subscription_discount = round((($regular_price - $sale_price) / $regular_price) * 100);   
            }            
        }
        if (isset($subprices[$product_id][2])) {
            $price_for_two = $subprices[$product_id][2];
            if (!$price_for_two) {
                $price_for_two = $sale_price;
            }
            if ($is_subscr_disc) {
                $price_for_two = getDiscountedPrice($price_for_two, 5);
                $subscription_discount = round((($regular_price - $price_for_two) / $regular_price) * 100);    
            }
        }
        if (isset($subprices[$product_id][3])) {
            $price_for_three = $subprices[$product_id][3];
            if (!$price_for_three) {
                $price_for_three = $price_for_two;
            }            
            if ($is_subscr_disc) {
                $price_for_three = getDiscountedPrice($price_for_three, 5);
                $subscription_discount = round((($regular_price - $price_for_three) / $regular_price) * 100);   
            }
        }

    }

    // $sale_price = $product->get_sale_price() ? $product->get_sale_price() : $regular_price;
    // $sale_price = round((float)$sale_price);
//    if ($product_type == 'nutrisslim' && $is_subscr_disc) {
//        $sale_price = getDiscountedPrice($sale_price, 5);
//    }

    if ($quantity == 1) {
        $price = $sale_price;
        return $price;
    } elseif ($quantity == 2) {
        $price = $price_for_two;
        return $price;
    } elseif ($quantity == 3) {
        $price = $price_for_three;
        return $price;
    } else {
        if ($product_type == 'simple') {
            $price = $sale_price;
        } else {
            $price = $sale_price * $quantity;
        }

        return $price;
    }

}

// Need this when rethrive price for subproduct with quantity of it's parrent
function get_quantity_by_nutrisslim_key($nutrisslim_parent_key) {
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        // Assuming 'nutrisslim_parent_key' is stored in the cart item array
        if (isset($cart_item['nutrisslim_parent_key']) && $cart_item['nutrisslim_parent_key'] == $nutrisslim_parent_key) {
            return $cart_item['quantity'];  // Return the quantity of the item
        }
    }
    return 0; // Return 0 if no matching item is found
}


// Hook into WooCommerce's cart calculation process
add_action('woocommerce_before_calculate_totals', 'custom_set_cart_item_price', 995);

function custom_set_cart_item_price($cart) {
    // Log to error log for debugging
    error_log(print_r('custom_set_cart_item_price', true));

    // Return early if in admin area and not during an AJAX operation
    if (is_admin() && !defined('DOING_AJAX')) return;

    // Start session if it hasn't been started already
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Get all items in the cart
    $cart_items = $cart->get_cart();

    // Loop through each cart item
    foreach ($cart_items as $cart_item_key => $cart_item) {
        // Retrieve landing page ID from session, if it exists
        $lid = isset($_SESSION['landing_page_id']) ? $_SESSION['landing_page_id'] : '';

        // Determine the quantity to use for price calculations
        $qtyForPrice = $cart_item['quantity'];
        
        // If the item is part of a 'nutrisslim' bundle, use the parent product's quantity
        if (isset($cart_item['nutrisslim_parent_id'])) {
            $parrent = $cart_item['nutrisslim_parent_id'];
            $qtyForPrice = $cart->get_cart_item($cart_item['nutrisslim_parent_key'])['quantity'];
        } else {
            $parrent = '';
        }

        // Check if the item is part of a subscription bundle
        if (isset($cart_item['subitem_subscription']) || isset($cart_item['subscription'])) {
            $is_subscr_disc = true;
        } else {
            $is_subscr_disc = false;
        }

        // Get the custom price for the product
        $custom_price = get_custom_product_price($cart_item['product_id'], $qtyForPrice, $lid, $parrent, false, $is_subscr_disc);

        // Log custom price for debugging
        // error_log(print_r('======>', true));
        // error_log(print_r($custom_price, true));

        // Get the product object
        $product = wc_get_product($cart_item['product_id']);

        // If the product is of type 'nutrisslim', set the price to 0
        if ($product && $product->get_type() == 'nutrisslim') {
            $custom_price = 0; // Set bundle product to 0 on landing page
        }

        // If the item is marked as a gift, set the price to 0
        if (isset($cart_item['landinggift']) && $cart_item['landinggift']) {
            $custom_price = 0; // Set gift price on landing page to 0
        }

        // If the item is marked as a gift, set the price to 0
        if (isset($cart_item['regulargift']) && $cart_item['regulargift']) {
            $custom_price = 0; // Set gift price on landing page to 0
        }

        if (isset($cart_item['offer']) && $cart_item['offer'] == 'cart_upsell') {
            $custom_price = $cart_item['price'];
        }

        // Set the custom price for the cart item
        $cart_item['data']->set_price($custom_price);
        // $cart_item['data']->set_price(11); // Uncomment to set price to a fixed value (for testing)
    }
}

// Update price to custom quantity based prices.

add_action('woocommerce_before_calculate_totals', 'set_adjastments_in_cart', 996);
function set_adjastments_in_cart($cart) {
   // error_log(print_r('set_adjastments_in_cart', true));
    if (is_admin() && !defined('DOING_AJAX')) return; // Avoid running in the admin unless during an AJAX operation
/*
    if ($_SESSION['landing_page_id']) {
        $lid = $_SESSION['landing_page_id'];
    } else {
        $lid = '';
    } 
*/

    // Check if session is started and 'landing_page_id' is set
    if (session_status() === PHP_SESSION_NONE) {
        session_start(); // Start session if not already started
    }

    $lid = isset($_SESSION['landing_page_id']) ? $_SESSION['landing_page_id'] : '';
	
	
    $totalItemsinBundle = array();
    $danielGifts = array();

    foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
        $product = wc_get_product($cart_item['product_id']);
        $productitem = $cart_item['data'];
    
        // Check for 'nutrisslim' product type
        if ($product && $product->get_type() == 'nutrisslim') {
            // Check if 'regulargift' exists and is true
            if (isset($cart_item['regulargift']) && $cart_item['regulargift']) {
                array_push($danielGifts, $cart_item_key); // Add cart keys for checkout coupons
            }
            $totalItemsinBundle[$cart_item_key]['bundle_key'] = $cart_item_key;
    
            // Check if 'subscription' exists for the bundle price logic
            if (isset($cart_item['subscription']) && $cart_item['subscription']) {
                $totalItemsinBundle[$cart_item_key]['bundle_price'] = get_custom_product_price($cart_item['product_id'], $cart_item['quantity'], $lid, '', true, true);
            } else {
                $totalItemsinBundle[$cart_item_key]['bundle_price'] = get_custom_product_price($cart_item['product_id'], $cart_item['quantity'], $lid, '', true);
            }

        }
    
        // Check if 'nutrisslim_parent_key' exists and handle bundle total
        if (isset($cart_item['nutrisslim_parent_key'])) {
            $parent_key = $cart_item['nutrisslim_parent_key'];
            if (!isset($totalItemsinBundle[$parent_key]['in_bundle_total'])) {
                $totalItemsinBundle[$parent_key]['in_bundle_total'] = 0;
            }
            $totalItemsinBundle[$parent_key]['in_bundle_total'] += $cart_item['quantity'] * floatval($cart_item['data']->get_price());
        }
    
        // Additional logic for 'nutrisslim' products with 'subscription'
        if ($product && $product->get_type() == 'nutrisslim') {
            if ($cart_item['quantity'] > 3) {
                $totalItemsinBundle[$cart_item_key]['bundle_price'];
            }
            if (isset($cart_item['subscription']) && $cart_item['subscription']) {
                $totalItemsinBundle[$cart_item_key]['bundle_price'] = get_custom_product_price($cart_item['product_id'], $cart_item['quantity'], $lid, '', true, true);
            } else {
                $totalItemsinBundle[$cart_item_key]['bundle_price'] = get_custom_product_price($cart_item['product_id'], $cart_item['quantity'], $lid, '', true);
            }
        }
    
        // Check if 'custom_price' exists and set it
        if (isset($cart_item['custom_price'])) {
            $cart_item['data']->set_price($cart_item['custom_price']);
        }        
    }    

    foreach ($totalItemsinBundle as $bundle_key => $value) {
        $diff = $value['bundle_price'] - $value['in_bundle_total'];       
        if ($diff != 0) {
            foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
                if (isset($cart_item['nutrisslim_parent_key']) && $cart_item['nutrisslim_parent_key'] == $bundle_key && isset($cart_item['adjusted_item']) && $cart_item['adjusted_item'] && isset($cart->cart_contents[$value['bundle_key']]['quantity']) && $cart->cart_contents[$value['bundle_key']]['quantity'] < 4 && !isset($cart_item['single_subscribe_item_to_adjust'])) {
                    $adjusted = floatval($cart_item['data']->get_price()) + $diff;
                    $cart_item['data']->set_price($adjusted);                        
                }
                if (isset($cart_item['nutrisslim_parent_key']) && $cart_item['nutrisslim_parent_key'] == $bundle_key && isset($cart_item['single_subscribe_item_to_adjust']) && $cart_item['single_subscribe_item_to_adjust'] && isset($cart->cart_contents[$value['bundle_key']]['quantity'])) {
                    $diff = $diff / $cart_item['quantity'];
                    $adjusted = floatval($cart_item['data']->get_price()) + $diff;

                    $cart_item['data']->set_price($adjusted); 
                }
            }
        }
    }

    // Set 0 for gift in checkout.
    foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
        foreach ($danielGifts as $giftKey) {
            if (isset($cart_item['nutrisslim_parent_key']) && $cart_item['nutrisslim_parent_key'] == $giftKey) {
                $cart_item['data']->set_price(0);
            }
        }    
    }

    // Set 0 for gift in checkout.
    foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
        if (isset($cart_item['subscription']) && $cart_item['subscription']) {
            // Set subscription price here
            $subscription_price = get_custom_product_price($cart_item['product_id'], $cart_item['quantity'], $lid, '', true, true);
            WC()->cart->cart_contents[$cart_item_key]['subscription_price'] = $subscription_price;
        } 
    }    

}