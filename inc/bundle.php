<?php
/*
function register_bundle_product_type() {
    // Define the custom product type class
    class WC_Product_Bundle extends WC_Product_Simple {
        protected $product_type = 'bundle';

        public function __construct($product = 0) {
            parent::__construct($product);
            // Directly set the product type property
            $this->product_type = 'bundle';
        }
    }
}
add_action('init', 'register_bundle_product_type');

function add_bundle_product_type($types){
    // Add custom product type
    $types['bundle'] = __('Bundle', 'your-text-domain');
    return $types;
}

add_filter('product_type_selector', 'add_bundle_product_type');
*/


function register_nutrisslim_product_type() {
    // Define the custom product type class
    class WC_Product_Nutrisslim extends WC_Product {
        protected $product_type = 'nutrisslim';

        public function __construct($product = 0) {
            parent::__construct($product);
            // Directly set the product type property
            $this->product_type = 'nutrisslim';
        }
    }
}
add_action('init', 'register_nutrisslim_product_type');

function add_nutrisslim_product_type($types){
    // Add custom product type
    $types['nutrisslim'] = __('Bundle', 'your-text-domain');
    return $types;
}

add_filter('product_type_selector', 'add_nutrisslim_product_type');




function woocommerce_product_class( $classname, $product_type ) {
    if ( $product_type == 'bundle' ) { // notice the checking here.
        $classname = 'WC_Product_Bundle';
    }
    return $classname;
}
add_filter( 'woocommerce_product_class', 'woocommerce_product_class', 10, 2 );

/*
function set_product_as_bundle($product) {
    if (isset($_POST['product-type']) && $_POST['product-type'] === 'bundle') {
        // $product->set_type('bundle');  // Explicitly set the product type
    }
}
add_action('woocommerce_admin_process_product_object', 'set_product_as_bundle', 10, 1);
*/

function add_bundle_product_tab( $tabs ) {
    $tabs['bundle_products'] = array(
        'label'    => __('Bundle Products', 'nutrisslim-suiteV2'),
        'target'   => 'bundle_products_options',
        'class'    => array('show_if_nutrisslim'),
        'priority' => -10,
    );
    return $tabs;
}

add_filter( 'woocommerce_product_data_tabs', 'add_bundle_product_tab' );

function bundle_products_options_product_tab_content() {
    global $post;
    ?>
    <style>
        #bundle_products_options thead th label {
            margin-left:0;
        }
        li.bundle_products_options {
            display:none;
        }
        .is_bundle li.bundle_products_options {
            display:none;
        }
        .is_bundle li.attribute_options {
            display:none;
        }  
        .is_bundle li.general_options {
            display:block !important;
        }
        .is_bundle #general_product_data div.options_group.pricing {
            display:block !important;
        }
    </style>
    <?php
    echo '<div id="bundle_products_options" class="panel woocommerce_options_panel" style="padding:0 10px;">';
    echo '<div class="options_group">';

    if (function_exists('acf_get_fields') && $post) {
        // Fetch fields from a specific field group
        $fields = acf_get_fields('group_663a89ffa2626');
        if ($fields) {
            // Render these fields for the current post
            acf_render_fields($post->ID, $fields);
        }
    }

    echo '</div>'; // Close options_group
    echo '</div>'; // Close bundle_products_options
}

add_action('woocommerce_product_data_panels', 'bundle_products_options_product_tab_content');


function custom_product_data_tabs($tabs) {
    // Check if the product type is 'bundle' or if the product being edited is a 'bundle'
    $product_id = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : '');
    if ($product_id) {
        $product = wc_get_product($product_id);
        $product_type = $product ? $product->get_type() : '';
    } else {
        // This might be needed for cases where we are creating a new product, where no ID exists yet.
        $product_type = isset($_POST['product-type']) ? $_POST['product-type'] : '';
    }

    // echo '===>' . $product_type;

    if ($product_type === 'nutrisslim') {
        // Only add 'show_if_bundle' class if the product type is 'bundle'
        foreach ($tabs as $key => $tab) {
            // echo '=====> ' . $key;
            if ($key == 'general') {
                $tabs[$key]['class'][] = 'show_if_nutrisslim';
            }
        }
    }

    return $tabs;
}

add_filter('woocommerce_product_data_tabs', 'custom_product_data_tabs');

function add_subproducts_to_cart($cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data) {
    // Check if the product being added is of the 'nutrisslim' type
    error_log(print_r('add_subproducts_to_cart', true));
    $product = wc_get_product($product_id);

    // Check if the product exists and if its type is 'nutrisslim'
    if ($product && 'nutrisslim' === $product->get_type()) {
        // Get the 'products' field from Advanced Custom Fields (ACF) for the current product
        $subproducts = get_field('products', $product_id);
        
        // THIS SHOULDN'T BE RELATED ANYMORE
        // $_adjastments = get_post_meta($product_id, '_adjastments', true);

        // error_log(print_r($_adjastments, true));
        // die();

        // Check if subproducts are available
        if ($subproducts) {
            // THIS SHOULDN'T BE RELATED ANYMORE
            // $adj = $_adjastments[$quantity];
            
            $num_of_subproducts = count($subproducts);
            // Loop through each subproduct
            foreach ($subproducts as $key => $subproduct) {
                // Prepare subproduct cart item data with custom meta to identify the parent product
                $subproduct_cart_item_data = array(
                    'nutrisslim_parent_id' => $product_id,  // Custom meta to identify the parent product
                    'nutrisslim_parent_key' => $cart_item_key  // Store the cart item key of the parent
                );

                // Calculate the quantity to add based on the parent product quantity
                $qtytoadd = $quantity * $subproduct['quantity'];                

                /*
                // Check if the quantity to add is greater than 1 and if this is the first subproduct in the bundle
                if ( (($qtytoadd > 1) && ($key == 0)) ) { 
                    // Adjust the quantity to add by subtracting 1
                    $qtytoadd = $quantity * $subproduct['quantity'] - 1;                     

                    // Prepare adjusted subproduct cart item data
                    $subproduct_cart_item_data = array(
                        'nutrisslim_parent_id' => $product_id,  // Custom meta to identify the parent product
                        'nutrisslim_parent_key' => $cart_item_key,  // Store the cart item key of the parent
                        'item_to_adjust' => true // Mark this item for adjustment
                    );                    
                    
                    // Prepare additional cart item data for the adjusted item
                    $subproduct_cart_item_data_adjastment = array(
                        'nutrisslim_parent_id' => $product_id,  // Custom meta to identify the parent product
                        'nutrisslim_parent_key' => $cart_item_key,  // Store the cart item key of the parent
                        'adjusted_item' => true // Mark this item as adjusted
                    );

                    // If the parent item has a subscription, add subscription data to the adjusted items
                    if ($cart_item_data['subscription'] && $cart_item_data['subscription'] != 0) {
                        $subproduct_cart_item_data['subitem_subscription'] = $cart_item_data['subscription'];
                        $subproduct_cart_item_data_adjastment['subitem_subscription'] = $cart_item_data['subscription'];
                    }

                    // Add the adjusted subproduct to the cart with quantity 1
                    WC()->cart->add_to_cart(
                        $subproduct['products'], 
                        1, 
                        0, 
                        array(), 
                        $subproduct_cart_item_data_adjastment
                    );                                        
                }
                */
                // FIX: For the FIRST subproduct, add as "adjusted_item" with proper flags
                // For other subproducts, add normally with correct quantities
                // This eliminates the quantity 0 bug that caused WooCommerce to filter out items
                if ($key == 0) {
                    // First subproduct: add with both adjustment flags
                    $qtyset = $quantity * $subproduct['quantity'];

                    $subproduct_cart_item_data_adjusted = array(
                        'nutrisslim_parent_id' => $product_id,
                        'nutrisslim_parent_key' => $cart_item_key,
                        'adjusted_item' => true,
                        'single_subscribe_item_to_adjust' => true
                    );

                    if (isset($cart_item_data['subscription']) && $cart_item_data['subscription'] != 0) {
                        $subproduct_cart_item_data_adjusted['subitem_subscription'] = $cart_item_data['subscription'];
                    }

                    // Add ONLY ONCE with correct quantity
                    WC()->cart->add_to_cart(
                        $subproduct['products'],
                        $qtyset,
                        0,
                        array(),
                        $subproduct_cart_item_data_adjusted
                    );
                } else {
                    // For other subproducts, add normally
                    $qtytoadd = $quantity * $subproduct['quantity'];

                    $subproduct_cart_item_data = array(
                        'nutrisslim_parent_id' => $product_id,
                        'nutrisslim_parent_key' => $cart_item_key
                    );

                    if (isset($cart_item_data['subscription']) && $cart_item_data['subscription'] != 0) {
                        $subproduct_cart_item_data['subitem_subscription'] = $cart_item_data['subscription'];
                    }

                    WC()->cart->add_to_cart(
                        $subproduct['products'],
                        $qtytoadd,
                        0,
                        array(),
                        $subproduct_cart_item_data
                    );
                }

                // Add the new product with price 1 (this line is commented out)
                // WC()->cart->add_to_cart(570, 1);               
            }
        }
    }
    
}
add_action('woocommerce_add_to_cart', 'add_subproducts_to_cart', 10, 6);

add_filter('acf/validate_value/key=field_663a89fffa70d', 'validate_subproduct_prices_total', 10, 4);

function validate_subproduct_prices_total($valid, $value, $field, $input) {
    if (!$valid) {
        return $valid;  // If field is already invalid, return the message.
    }

    // Get the product ID from the $_POST data
    $post_id = $_POST['post_ID'] ?? null;

    // If post_id is found, get the product object
    if ($post_id) {
        $product = wc_get_product($post_id);
        // Check if the product type is 'nutrisslim'
        if ($product && 'nutrisslim' === $product->get_type()) {
            // Calculate the total of all 'price' subfields in the 'products' repeater
            $total_percentage = 0;
            $empty_fields = 0;
            $fields_count = 0;

            if (is_array($value)) {
                foreach ($value as $row) {
                    if (isset($row['field_663a9629c531a'])) {
                        $fields_count++;
                        $price = floatval($row['field_663a9629c531a']);
                        if ($price == 0) {
                            $empty_fields++;
                        }
                        $total_percentage += $price;
                    }
                }
            }

            // Check if all fields are empty or if the total percentage equals 100
            if ($empty_fields === $fields_count) {
                return $valid; // All fields are empty, this is valid
            } elseif ($total_percentage != 100) {
                $valid = "Total percent of all shared subproduct prices needs to be 100%. Current total is $total_percentage%.";
            }
        }
    }

    return $valid;
}

/*
// Calculate prices on subproducts
function calculate_subproduct_prices($product_id, $subproducts, $numItems=1) {
    $product = wc_get_product($product_id);
    $active_price = 0;
    if ($numItems == 1) {
        $regular_price = $_POST['_regular_price'];
        $regular_price = str_replace(',', '.', $regular_price);
        // $regular_price = floatval($regular_price);
        $regular_price = round($regular_price, wc_get_price_decimals());
        
        $sale_price = $_POST['_sale_price'];
        $sale_price = str_replace(',', '.', $sale_price);
        // $sale_price = floatval($sale_price);
        $sale_price = round($sale_price, wc_get_price_decimals());

        // Determine the active price (sale price if set, otherwise regular price)
        $active_price = $sale_price ? $sale_price : $regular_price;    
    } else if ($numItems == 2) {
        $two_items_price = $_POST['_price_for_two'];
        $active_price = $two_items_price;
    } else if ($numItems == 3) {
        $three_items_price = $_POST['_price_for_three'];
        $active_price = $three_items_price;
    }
    
    $subproduct_details = [];
    $total_subproduct_price = 0;

    foreach ($subproducts as $index => $subproduct) {
        $subproduct_id = $subproduct['field_663a8a56fa70e'];
        $quantity = $subproduct['field_663a95dec5319'];
        $percentage = $subproduct['field_663a9629c531a'];

        $total_price_for_this_subproduct = round(($active_price * ($percentage / 100)), wc_get_price_decimals());
        $individual_price = round($total_price_for_this_subproduct / $quantity, wc_get_price_decimals());
        $total_subproduct_price += $individual_price * $quantity;

        $subproduct_details[] = array(
            'id' => $subproduct_id,
            'quantity' => $quantity,
            'individual_price' => $individual_price
        );
    }

    // error_log('active_price =====> ' . print_r($active_price, true));

    $active_price = round($active_price, wc_get_price_decimals());
    $total_subproduct_price = round($total_subproduct_price, wc_get_price_decimals());
    // Calculate the difference
    $price_difference = $active_price - $total_subproduct_price;

    // Adjust the correct price field based on whether a sale price is set
    if ($price_difference != 0) {
        $adjusted = false;
        // First check if any subproduct has a quantity of 1 to adjust
        $m = 0;
        foreach ($subproduct_details as &$subproduct) {
            if ( $subproduct['quantity'] == 1 ) {
                $subproduct_details[$m]['individual_price'] += round($price_difference, wc_get_price_decimals());
                $adjusted = true;
                break;
            }
            $m++;
        }

        // If no subproduct with quantity 1 was adjusted, adjust the parent product price
        if (!$adjusted) {
            if ($numItems == 2) {
                $product->update_meta_data('_price_for_two', $total_subproduct_price);
            } else if ($numItems == 3) {
                $product->update_meta_data('_price_for_three', $total_subproduct_price);
            } else {
                if ($sale_price) {
                    $product->set_sale_price($total_subproduct_price);
                } else {
                    $product->set_regular_price($total_subproduct_price);
                }
            }
        }
        $product->save();  // Save the changes to the product
    }

    return $subproduct_details;
}
*/
/*
// Calculate prices on subproducts
function calculate_subproduct_prices($product_id, $subproducts, $numItems=1) {
    $product = wc_get_product($product_id);
    $active_price = 0;
    if ($numItems == 1) {
        $regular_price = str_replace(',', '.', $_POST['_regular_price']);
        $regular_price = round($regular_price, wc_get_price_decimals());
        
        $sale_price = str_replace(',', '.', $_POST['_sale_price']);
        $sale_price = round($sale_price, wc_get_price_decimals());

        $active_price = $sale_price ? $sale_price : $regular_price;    
    } else if ($numItems == 2) {
        $active_price = $_POST['_price_for_two'];
    } else if ($numItems == 3) {
        $active_price = $_POST['_price_for_three'];
    }

    // Determine if we need to calculate percentages based on regular prices
    $calculate_percentage = true; // Assume we need to calculate unless we find a defined percentage
    foreach ($subproducts as $subproduct) {
        if (!empty($subproduct['field_663a9629c531a'])) {
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
            $subproduct_obj = wc_get_product($subproduct['field_663a8a56fa70e']);
            $total_regular_price += $subproduct_obj->get_regular_price() * $subproduct['field_663a95dec5319'];
        }
    }

    foreach ($subproducts as $index => $subproduct) {
        $subproduct_id = $subproduct['field_663a8a56fa70e'];
        $subproduct_obj = wc_get_product($subproduct_id);
        $quantity = $subproduct['field_663a95dec5319'];
        $percentage = $subproduct['field_663a9629c531a'];

        if ($calculate_percentage) {
            // Calculate the percentage based on regular prices
            $regular_price = $subproduct_obj->get_regular_price();
            $percentage = ($regular_price * $quantity / $total_regular_price) * 100;
        }
        
        $total_price_for_this_subproduct = round(($active_price * ($percentage / 100)), wc_get_price_decimals());
        $individual_price = round($total_price_for_this_subproduct / $quantity, wc_get_price_decimals());

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
            if ($numItems == 2) {
                $product->update_meta_data('_price_for_two', $total_subproduct_price);
            } else if ($numItems == 3) {
                $product->update_meta_data('_price_for_three', $total_subproduct_price);
            } else {
                $sale_price ? $product->set_sale_price($total_subproduct_price) : $product->set_regular_price($total_subproduct_price);
            }
        }
        $product->save(); // Save any changes to the product
    }

    error_log(print_r('=========---->', true));
    error_log(print_r($subproduct_details, true));

    return $subproduct_details;
}
*/

function reorder_subproducts_by_quantity_desc($subproducts) {
    // This function rearrange array and sort it by quantity.
    // need this to be able to recalculate larger quantities first so we can add adjustments only to items with lowest quantity.
    usort($subproducts, function($a, $b) {
        return $b['field_663a95dec5319'] - $a['field_663a95dec5319'];
    });
    return $subproducts;
}

// Calculate prices on subproducts
function calculate_subproduct_prices($product_id, $subproducts, $numItems=1) {

    error_log(print_r('calculate_subproduct_prices', true));

    if (!isset($_POST['_regular_price']) || !isset($_POST['_price_for_two']) || !isset($_POST['_price_for_three'])) {
        return;
    }

    // rearrange items by quantity here
    // subproducts are sent with request: product_id, quantity and eventually percent
    $subproducts = reorder_subproducts_by_quantity_desc($subproducts);

    $product = wc_get_product($product_id);
    $active_price = 0;
    if ($numItems == 1) {
        $regular_price = str_replace(',', '.', $_POST['_regular_price']);
        $regular_price = round($regular_price, wc_get_price_decimals());
        
        if ($_POST['_sale_price']) {
            $sale_price = str_replace(',', '.', $_POST['_sale_price']);
            $sale_price = round($sale_price, wc_get_price_decimals());    
        }

        $active_price = $sale_price ? $sale_price : $regular_price;    
    } else if ($numItems == 2) {
        $active_price = $_POST['_price_for_two'];
    } else if ($numItems == 3) {
        $active_price = $_POST['_price_for_three'];
    }

    // Here we get active bundle price for different number of items.
    // there is only one active price per function execute

    // Determine if we need to calculate percentages based on regular prices
    $calculate_percentage = true; // Assume we need to calculate unless we find a defined percentage

    // foreach of subproducts check if there is percentage set. If this subproducts has percentage set
    // do not calculate percentage based on regular price rate
    foreach ($subproducts as $subproduct) {
        if (!empty($subproduct['field_663a9629c531a'])) {
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
            $subproduct_obj = wc_get_product($subproduct['field_663a8a56fa70e']);
            $total_regular_price += $subproduct_obj->get_regular_price() * $subproduct['field_663a95dec5319'];
        }
    }

    $n = count($subproducts);
    $i = 1;
    $adj = 0; // Adjastments on price
    // error_log(print_r('counted =========---->' . $n, true));
    // error_log(print_r($subproducts, true)); 

    // This is where we calculate price for each item in bundle for particular 
    // number of bundles, 1, 2 or 3
    foreach ($subproducts as $index => $subproduct) {
        $subproduct_id = $subproduct['field_663a8a56fa70e'];
        $subproduct_obj = wc_get_product($subproduct_id);
        $quantity = $subproduct['field_663a95dec5319'];
        $percentage = $subproduct['field_663a9629c531a'];

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

    // error_log(print_r('=========---->', true));
    // error_log(print_r($subproduct_details, true));

    // Calculate the difference and adjust prices accordingly

    return $subproduct_details;
}

// Function to merge the price arrays
function merge_price_arrays($arrays, $quantities) {
    $result = [];
    
    foreach ($quantities as $qty_index => $qty) {
        if (isset($arrays[$qty_index]) && is_array($arrays[$qty_index])) {
            foreach ($arrays[$qty_index] as $item) {
                $id = $item['id'];
                $price = $item['individual_price'];
    
                // Initialize the sub-array if not already set
                if (!isset($result[$id])) {
                    $result[$id] = [];
                }
    
                // Set the individual price for this quantity
                $result[$id][$qty] = $price;
            }
        }
    }

    return $result;
}

// Function to extract adjustment values
function extract_adjustment($prices_array, $qty) {
    if (!$prices_array) {
        return;
    }
    $last_item = end($prices_array);
    if (isset($last_item['adjastment'])) {
        return array(
            'id' => $last_item['id'],
            'qty' => $qty,
            'adjastment' => $last_item['adjastment']
        );
    }
    return null;
}

add_action('woocommerce_admin_process_product_object', 'save_nutrisslim_product_details', 10, 1);
function save_nutrisslim_product_details($product) {
    if ('nutrisslim' === $product->get_type() && function_exists('get_field') && function_exists('update_field')) {
        $product_id = $product->get_id();
        $field_key = 'field_663a89fffa70d'; // this is "products" field key 
        
        // error_log('New data: ' . print_r($_POST['acf'][$field_key], true));
        // error_log('Old data: ' . print_r(get_field($field_key, $product_id), true));

        if (isset($_POST['acf'][$field_key]) && !empty($_POST['acf'][$field_key])) {
            $subproducts = $_POST['acf'][$field_key];
        } else {
            // $subproducts = get_field($field_key, $product_id);
        }    

        $prices_qty_1 = calculate_subproduct_prices($product_id, $subproducts);
        $prices_qty_2 = calculate_subproduct_prices($product_id, $subproducts, 2); // get prices for 2 items   
        $prices_qty_3 = calculate_subproduct_prices($product_id, $subproducts, 3); // get prices for 3 items

        // error_log('prices_qty_1: ' . print_r($prices_qty_1, true));
        // error_log('prices_qty_2: ' . print_r($prices_qty_2, true));
        // error_log('prices_qty_3: ' . print_r($prices_qty_3, true));

        // I THINK WE DON'T NEED THIS ANYMORE
        /*
        $adjastment = array();

        // Extract adjustment values for each quantity
        $adjustment_data_1 = extract_adjustment($prices_qty_1, 1);
        $adjustment_data_2 = extract_adjustment($prices_qty_2, 2);
        $adjustment_data_3 = extract_adjustment($prices_qty_3, 3);   
        
        // Store adjustment values in the $adjastment array
        if ($adjustment_data_1) {
            $adjastment[1] = $adjustment_data_1['adjastment'];
        }

        if ($adjustment_data_2) {
            $adjastment[2] = $adjustment_data_2['adjastment'];
        }

        if ($adjustment_data_3) {
            $adjastment[3] = $adjustment_data_3['adjastment'];
        } 
        */
        // error_log('Adjastments: ' . print_r($adjastment, true));

        // $subproduct_prices = array();

        // Call the function with all three arrays
        $merged_prices = merge_price_arrays([$prices_qty_1, $prices_qty_2, $prices_qty_3], [1, 2, 3]);

        // error_log('merged_price: ' . print_r($merged_prices, true));

        update_post_meta($product_id, '_subproducts_custom_prices', $merged_prices);


        // I THINK WE DON'T NEED THIS ANYMORE 
        // update_post_meta($product_id, '_adjastments', $adjastment);

        // error_log('updatedprices: ' . print_r($merged_prices, true));

        // $retrieved_array = get_post_meta($product_id, '_subproducts_custom_prices', true);

        // error_log('updatedprices: ' . print_r($retrieved_array, true));
    }
}

// Transfer custom cart item meta to order items
add_action('woocommerce_checkout_create_order_line_item', 'add_custom_order_item_meta', 10, 4);
function add_custom_order_item_meta($item, $cart_item_key, $values, $order) {
    if (isset($values['nutrisslim_parent_id'])) {
        $item->add_meta_data('nutrisslim_parent_id', $values['nutrisslim_parent_id'], true);


    }
}

// Display custom cart item meta in the order edit screen
add_action('woocommerce_before_order_itemmeta', 'display_custom_order_item_meta', 10, 3);
function display_custom_order_item_meta($item_id, $item, $product) {
    $order = wc_get_order($item->get_order_id());
    foreach ($order->get_items() as $order_item_id => $order_item) {
        if ($order_item_id == $item_id) {
            $meta_value = wc_get_order_item_meta($order_item_id, 'nutrisslim_parent_id', true);            
            if ($meta_value) {
                // echo '<p><strong>' . __('Parent ID:', 'your-theme-textdomain') . '</strong> ' . esc_html($meta_value) . '</p>';
            }
        }
    }
}

