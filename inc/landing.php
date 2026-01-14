<?php


// Calculate prices on subproducts
function calculate_subproduct_prices_on_landing($product_id, $subproducts, $numItems=1, $landing) {
    error_log(print_r('calculate_subproduct_prices_on_landing', true));

    // rearrange items by quantity here
    // subproducts are sent with request: product_id, quantity and eventually percent
    $subproducts = reorder_subproducts_by_quantity_desc($subproducts);

    // Get product object
    $product = wc_get_product($product_id);

    // Here we get information about prices set on landing page
    $quantity_prices = $_POST['acf']['field_661d1605e5381'];  

    // Get active price for particular number of items. If there price is defined on landing page use this
    // otherwise use prices defined on product page

    $active_price = 0;
    if ($numItems == 1) {
        if (isset($quantity_prices['row-0']['field_661d170fe5382']) && $quantity_prices['row-0']['field_661d170fe5382']) {
            $active_price = round($quantity_prices['row-0']['field_661d170fe5382'], wc_get_price_decimals());
        } else {
            $active_price = $product->get_price();
        }   
    } else if ($numItems == 2) {
        if (isset($quantity_prices['row-1']['field_661d170fe5382']) && $quantity_prices['row-1']['field_661d170fe5382']) {
            $active_price = round($quantity_prices['row-1']['field_661d170fe5382'], wc_get_price_decimals());
        } else {
            if (get_post_meta($product_id, '_price_for_two', true)) {
                $active_price = round(get_post_meta($product_id, '_price_for_two', true), wc_get_price_decimals());
            } else {
                $active_price = $product->get_price();
            }
        } 
    } else if ($numItems == 3) {
        if (isset($quantity_prices['row-2']['field_661d170fe5382']) && $quantity_prices['row-2']['field_661d170fe5382']) {
            $active_price = round($quantity_prices['row-2']['field_661d170fe5382'], wc_get_price_decimals());
        } else {
            if (get_post_meta($product_id, '_price_for_three', true)) {
                $active_price = round(get_post_meta($product_id, '_price_for_three', true), wc_get_price_decimals());
            } else if (get_post_meta($product_id, '_price_for_two', true)) {
                $active_price = round(get_post_meta($product_id, '_price_for_two', true), wc_get_price_decimals());
            } else {
                $active_price = $product->get_price();
            }
        }         
    }
    
    // if active price is 0 abort calculation
    if ( $active_price == 0 ) {
        return;
    }

    // Determine if we need to calculate percentages based on regular prices
    $calculate_percentage = true; // Assume we need to calculate unless we find a defined percentage

    // foreach of subproducts check if there is percentage set. If this subproducts has percentage set
    // do not calculate percentage based on regular price rate
    foreach ($subproducts as $subproduct) {
        if (!empty($subproduct['price'])) {
            $calculate_percentage = false; // Found a defined percentage, no need to calculate
            break;
        }
    }
    
    $subproduct_details = [];
    $total_regular_price = 0;
    $total_subproduct_price = 0;
    
    // Calculate suma of all regular prices    
    if ($calculate_percentage) {
        // Calculate the total regular prices multiplied by their quantities if percentage needs to be calculated
        foreach ($subproducts as $subproduct) {
            $subproduct_obj = wc_get_product($subproduct['products']);
            $total_regular_price += $subproduct_obj->get_regular_price() * $subproduct['quantity'];
        }
    }
    
    $n = count($subproducts);
    $i = 1;
    $adj = 0; // Adjastments on price (reminder - ostatak)

    // This is where we calculate price for each item in bundle for particular 
    // number of bundles, 1, 2 or 3
    foreach ($subproducts as $index => $subproduct) {
        $subproduct_id = $subproduct['products'];
        $subproduct_obj = wc_get_product($subproduct_id);
        $quantity = $subproduct['quantity'];
        $percentage = $subproduct['price'];

        // Add percentage if it is calculated from regular price rate
        if ($calculate_percentage) {
            // Calculate the percentage based on regular prices
            $regular_price = $subproduct_obj->get_regular_price();
            $percentage = ($regular_price * $quantity / $total_regular_price) * 100;
        }

        // error_log(print_r($subproduct, true));   
        
        // Ensure $active_price is numeric
        $active_price = is_numeric($active_price) ? (float)$active_price : 0;        
        
        // This is where we are defining total and individual prices for subitems
        $total_price_for_this_subproduct = round(($active_price * ($percentage / 100)), wc_get_price_decimals());
        // This is where we add reminder from preview item so we have only one single reminder at the end
        $total_price_for_this_subproduct = $total_price_for_this_subproduct + $adj; // Adjust price for previews item difference      
        $individual_price = round($total_price_for_this_subproduct / ($quantity * $numItems), wc_get_price_decimals());

        $subproduct_details[] = array(
            'id' => $subproduct_id,
            'quantity' => $quantity,
            'individual_price' => $individual_price,
            'percentage' => $percentage  // Store the calculated or defined percentage
        );
        
        // This is adjastment for each item in bundle.
        // This is reminder when set price of item in bundle
        $adj = round($total_price_for_this_subproduct - $individual_price * $quantity * $numItems, wc_get_price_decimals());

        // Here we set reminder to last product item (one that have lowest quantity in bundle)
        // there are lowest possibilities to have reminder on lowest quantity subitem
        // If there is only one item there will not be reminders.
        // If we have 2 subitems there is chance 50% that we don't have any reminder (adjastment for price)
        if ($i === $n) {
            $subproduct_details[$n-1]['adjastment'] = $adj;
        }

        $i++;
    }    

    // error_log(print_r('===================>', true));
    // error_log(print_r($subproduct_details, true));

    return $subproduct_details;

}

// Calculate prices on subproducts
function calculate_simple_product_prices_on_landing($product_id, $numItems=1, $landing) {
    error_log(print_r('calculate_simple_product_prices_on_landing', true));

    // Get product object
    $product = wc_get_product($product_id);  

    // Here we get information about prices set on landing page
    $quantity_prices = $_POST['acf']['field_661d1605e5381'];  

    // Get active price for particular number of items. If there price is defined on landing page use this
    // otherwise use prices defined on product page

    $active_price = 0;
    if ($numItems == 1) {
        if ($quantity_prices['row-0']['field_661d170fe5382']) {
            $active_price = round($quantity_prices['row-0']['field_661d170fe5382'], wc_get_price_decimals());
        } else {
            $active_price = $product->get_price();
        }   
    } else if ($numItems == 2) {
        if ($quantity_prices['row-1']['field_661d170fe5382']) {
            $active_price = round($quantity_prices['row-1']['field_661d170fe5382'], wc_get_price_decimals());
        } else {
            $active_price = round($numItems * get_post_meta($product_id, '_price_for_two', true), wc_get_price_decimals());
        } 
    } else if ($numItems == 3) {
        if ($quantity_prices['row-2']['field_661d170fe5382']) {
            $active_price = round($quantity_prices['row-2']['field_661d170fe5382'], wc_get_price_decimals());
        } else {
            $active_price = round($numItems * get_post_meta($product_id, '_price_for_three', true), wc_get_price_decimals());
        }         
    } 
    
    // if active price is 0 abort calculation
    if ( $active_price == 0 ) {
        return;
    }

    $active_price = is_numeric($active_price) ? (float)$active_price : 0;
    $total_price_for_this_subproduct = $active_price;
    $individual_price = round($total_price_for_this_subproduct / ($quantity * $numItems), wc_get_price_decimals());
    
    $product_details[] = array(
        'id' => $product_id,
        'quantity' => 1,
        'individual_price' => $individual_price,
    );  

    // error_log(print_r('===================>', true));
    // error_log(print_r($product_details, true));

    return $product_details;

}

add_action('save_post_landing-page', 'save_nutrisslim_product_new_way', 10, 3);

function save_nutrisslim_product_new_way($post_id, $post, $update) {
    // Check if this is an autosave routine. If it is, our form has not been submitted, so we don't want to do anything.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
        return;

    // Check the user's permissions.
    if (isset($_POST['post_type']) && 'landing_page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return;
    } else {
        if (!current_user_can('edit_post', $post_id))
            return;
    }

    $selected_product_key = 'field_661797e1385ae';

    if (!isset($_POST['acf'][$selected_product_key]) || empty($_POST['acf'][$selected_product_key])) {
        return;
    }

    $selected_product = $_POST['acf'][$selected_product_key]; 
    $product_id = $selected_product[0];
    $product = wc_get_product($product_id);


    if ('nutrisslim' === $product->get_type() && function_exists('get_field') && function_exists('update_field')) {

        // $on_product_prices = get_post_meta($product_id, '_subproducts_custom_prices', true); // cene na product page

        $field_key = 'field_663a89fffa70d';
        $subproducts = get_field($field_key, $product_id);  
        // $quantity_prices = get_field('quantity_prices', $post_id); 
        // error_log(print_r($subproducts, true));


        $prices_qty_1 = calculate_subproduct_prices_on_landing($product_id, $subproducts, 1, $post_id);
        $prices_qty_2 = calculate_subproduct_prices_on_landing($product_id, $subproducts, 2, $post_id); // get prices for 2 items   
        $prices_qty_3 = calculate_subproduct_prices_on_landing($product_id, $subproducts, 3, $post_id); // get prices for 3 items        
                
        $merged_prices = merge_price_arrays([$prices_qty_1, $prices_qty_2, $prices_qty_3], [1, 2, 3]);
        
        // error_log(print_r('This is meredged prices saved on landing', true));
        // error_log(print_r($merged_prices, true));

        update_post_meta($post_id, '_subproducts_custom_prices', $merged_prices);              

    } else if ('simple' === $product->get_type() && function_exists('get_field') && function_exists('update_field')) {
        /*
        // $on_product_prices = get_post_meta($product_id, '_subproducts_custom_prices', true); // cene na product page

        $field_key = 'field_663a89fffa70d';
        $subproducts = get_field($field_key, $product_id);  
        // $quantity_prices = get_field('quantity_prices', $post_id); 
        // error_log(print_r($subproducts, true));


        $prices_qty_1 = calculate_simple_product_prices_on_landing($product_id, 1, $post_id);
        $prices_qty_2 = calculate_simple_product_prices_on_landing($product_id, 2, $post_id); // get prices for 2 items   
        $prices_qty_3 = calculate_simple_product_prices_on_landing($product_id, 3, $post_id); // get prices for 3 items        
                
        $merged_prices = merge_price_arrays([$prices_qty_1, $prices_qty_2, $prices_qty_3], [1, 2, 3]);
        
        // error_log(print_r($merged_prices, true));

        update_post_meta($product_id, '_subproducts_custom_prices', $merged_prices);              
        */
    }
}

// Adding lid to product meta.
add_action('woocommerce_checkout_create_order_line_item', 'add_landing_page_id_to_order_items', 10, 4);

function add_landing_page_id_to_order_items($item, $cart_item_key, $values, $order) {
    if (isset($_SESSION['landing_page_id']) && !empty($_SESSION['landing_page_id'])) {
        $landing_page_id = sanitize_text_field($_SESSION['landing_page_id']); // Sanitize the session value
        $item->add_meta_data('lid', $landing_page_id, true);
    }
}

/*
//add_action('save_post_landing-page', 'save_nutrisslim_product_details_on_landing', 10, 3);
function save_nutrisslim_product_details_on_landing($post_id, $post, $update) {
    // Check if this is an autosave routine. If it is, our form has not been submitted, so we don't want to do anything.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
        return;

    // Check the user's permissions.
    if (isset($_POST['post_type']) && 'landing_page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return;
    } else {
        if (!current_user_can('edit_post', $post_id))
            return;
    }

    $selected_product_key = 'field_661797e1385ae';

    if (!isset($_POST['acf'][$selected_product_key]) || empty($_POST['acf'][$selected_product_key])) {
        return;
    }   

    $selected_product = get_field('selected_product'); 
    $product_id = $selected_product[0];   

    $product = wc_get_product($product_id);

    if ('nutrisslim' === $product->get_type() && function_exists('get_field') && function_exists('update_field')) {
        $field_key = 'field_663a89fffa70d';
        $subproducts = get_field($field_key, $product_id);

        $prices_qty_1 = calculate_subproduct_prices_on_landing($product_id, $subproducts, 1, $post_id);
        $prices_qty_2 = calculate_subproduct_prices_on_landing($product_id, $subproducts, 2, $post_id); // get prices for 2 items   
        $prices_qty_3 = calculate_subproduct_prices_on_landing($product_id, $subproducts, 3, $post_id); // get prices for 3 items         
        
        $merged_prices = merge_price_arrays([$prices_qty_1, $prices_qty_2, $prices_qty_3], [1, 2, 3]);

        error_log(print_r('============+>', true));
        error_log(print_r($merged_prices, true));          

        update_post_meta($post_id, '_subproducts_custom_prices', $merged_prices);

        // $retrieved_array = get_post_meta($post_id, '_subproducts_custom_prices', true);

        // error_log(print_r('============+>', true));
        // error_log(print_r($retrieved_array, true));        

    }
    
}


function calculate_subproduct_prices_on_landing($product_id, $subproducts, $numItems=1, $landing) {
    // $landing argument is for landing php for calculation prices on bondle product.

    $product = wc_get_product($product_id);
    $active_price = 0;
    $quantity_prices = get_field('quantity_prices', $landing);

    if ($numItems == 1) {
        if ($quantity_prices[0]['price']) { // check if price on landing page for one bundle is set
            $active_price = $quantity_prices[0]['price']; // than set it as active
        } else { // otherwise, take it from product page.
            $regular_price = str_replace(',', '.', $product->get_regular_price());
            $regular_price = round($regular_price, wc_get_price_decimals());
            
            $sale_price = str_replace(',', '.', $product->get_sale_price());
            $sale_price = round($sale_price, wc_get_price_decimals());
    
            $active_price = $sale_price ? $sale_price : $regular_price;  
        }  
    } else if ($numItems == 2) {
        if ($quantity_prices[1]['price']) {
            $active_price = $quantity_prices[1]['price'];
        } else {
            $active_price = get_post_meta($product_id, '_price_for_two', true);
        }
    } else if ($numItems == 3) {
        if ($quantity_prices[2]['price']) {
            $active_price = $quantity_prices[2]['price'];
        } else {
            $active_price = get_post_meta($product_id, '_price_for_three', true);
        }
    }     


    // Determine if we need to calculate percentages based on regular prices
    $calculate_percentage = true; // Assume we need to calculate unless we find a defined percentage
    foreach ($subproducts as $subproduct) {      
        if (!empty($subproduct['price'])) {
            $calculate_percentage = false; // Found a defined percentage, no need to calculate
            break;
        }        
    }

    $subproduct_details = [];
    $total_regular_price = 0;
    $total_subproduct_price = 0;

    if ($calculate_percentage) {
        // Calculate the total regular prices multiplied by their quantities if percentage needs to be calculated
        foreach ($subproducts as $subproduct) {
            // get subproduct object depending on shell we calculate prices on landing page or regular product
            $subproduct_obj = wc_get_product($subproduct['products']);
            $qty = $subproduct['quantity'];         
            $total_regular_price += $subproduct_obj->get_regular_price() * $qty;
        }
    }  

    foreach ($subproducts as $index => $subproduct) {

        $subproduct_id = $subproduct['products'];
        $subproduct_obj = wc_get_product($subproduct_id);
        $quantity = $subproduct['quantity'];
        $percentage = $subproduct['price'];

        if ($calculate_percentage) {
            // Calculate the percentage based on regular prices          
            $regular_price = $subproduct_obj->get_regular_price();
            $percentage = ($regular_price * $quantity / $total_regular_price) * 100;
        }      
        $devider = ($index + 1) * $quantity;
        $total_price_for_this_subproduct = round(($active_price * ($percentage / 100)), wc_get_price_decimals());
        $individual_price = round($total_price_for_this_subproduct / $quantity, wc_get_price_decimals());               

        error_log(print_r('Indi=======+>', true));
        error_log(print_r($individual_price, true)); 

        $subproduct_details[] = array(
            'id' => $subproduct_id,
            'quantity' => $quantity,
            'individual_price' => $individual_price,
            'percentage' => $percentage  // Store the calculated or defined percentage
        );
        $total_subproduct_price += $individual_price * $quantity;
    }       

    // Calculate the difference and adjust prices accordingly
    $price_difference = $active_price - $total_subproduct_price;

    if ($price_difference != 0) {
        $adjusted = false;
        foreach ($subproduct_details as &$subproduct) {
            if ($subproduct['quantity'] == 1) {
                $subproduct['individual_price'] += round($price_difference, wc_get_price_decimals());
                $adjusted = true;
                break;
            }
        }
        if (!$adjusted) {
            // Update the product's pricing information based on the adjustments needed
            // Get the current value of the repeatable field
            // $quantity_prices = get_field('quantity_prices', $landing); 
            if ($numItems == 2) {
                // Update the price for the second row
                if (isset($quantity_prices[1])) {
                    update_post_meta($landing, '_new_val_for_2', $total_subproduct_price);
                }
            } else if ($numItems == 3) {               
                // Update the price for the second row
                if (isset($quantity_prices[2])) {                  
                    update_post_meta($landing, '_new_val_for_3', $total_subproduct_price);
                }
            } else {
                // Update the price for the second row
                if (isset($quantity_prices[0])) {
                    update_post_meta($landing, '_new_val_for_1', $total_subproduct_price);
                }                    
            }
        }
    }  

    return $subproduct_details;
}
*/