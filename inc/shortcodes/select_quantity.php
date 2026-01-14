<?php

function display_select_quantity_shortcode() {

    if (is_admin()) {
        // Get the current screen
        $current_screen = get_current_screen();
        // error_log(print_r($current_screen, true));
        // Check if we are on the post edit screen
        if ($current_screen && $current_screen->base === 'post' && $current_screen->post_type === 'landing-page') {
            return ob_get_clean();
            return ''; // Return empty string to disable execution
        }
    }
    
    ob_start(); // Start output buffering to capture all output
    $productref = get_field('selected_product');


    if (empty($productref)) {
        return ob_get_clean();
        return ''; // Return early if no product is selected
    }    

    $lid = get_the_ID();

    $subprices = get_post_meta($lid, '_subproducts_custom_prices', true);

    // error_log(print_r($productref, true));    

    if (!$productref) {
        // Return empty or handle the case as needed
        return ''; // Returning an empty string if $productref is not set
    }    
    $productID = $productref[0];
    $product = wc_get_product($productID);

    if (!$product) {
        return ''; // Return early if the product doesn't exist
    }    
    
    $regular_price = $product->get_regular_price();
    
    $sale_price = $product->get_price();        
    $price_for_two = get_post_meta( $product->get_id(), '_price_for_two', true );
    $price_for_three = get_post_meta( $product->get_id(), '_price_for_three', true );    

    $quantities = get_field('quantity_prices');

    if ( empty($quantities[0]['price']) ) {
        $quantities[0]['price'] = $sale_price;
    }
    if ( empty($quantities[1]['price']) ) {
        $quantities[1]['price'] = $price_for_two;
    } 
    if ( empty($quantities[2]['price']) ) {
        $quantities[2]['price'] = $price_for_three;
    }       
    /*
    echo '<pre>';
    print_r($quantities);
    echo '</pre>';
    */
    if (empty($quantities)) {
        // return ''; // Return early if no quantities are set
    }    
    // error_log(print_r('quantities:', true)); 
    // error_log(print_r($quantities, true)); 

    // $quantities[0]['price'] = get_custom_product_price($productID, 1, $lid);
    // $quantities[1]['price'] = get_custom_product_price($productID, 2, $lid);
    // $quantities[2]['price'] = get_custom_product_price($productID, 3, $lid);    

    // error_log(print_r($sale_price, true));

    add_product_to_cart_with_custom_price($productID, $quantities[0]['price']);   

    if ($regular_price > 0) { // Avoid division by zero
        if ($quantities[0]['price']) {
            $discount_percentage = (($regular_price - $quantities[0]['price']) / $regular_price) * 100;
        }
        if ($quantities[1]['price']) {
            $discount_percentage2 = (($regular_price - $quantities[1]['price'] / 2) / $regular_price) * 100;
        }
        if ($quantities[2]['price']) {
            $discount_percentage3 = (($regular_price - $quantities[2]['price'] / 3) / $regular_price) * 100;
        }
    } else {
        $discount_percentage = 0; // No discount applicable
    }
    
    // $rounded_discount = floor($discount_percentage / 5) * 5;
    // $rounded_discount2 = floor($discount_percentage2 / 5) * 5;
    $rounded_discount = round($discount_percentage / 1) * 1;
    $rounded_discount2 = round($discount_percentage2 / 1) * 1;
    $rounded_discount3 = round($discount_percentage3 / 1) * 1;

    $quantities[0]['percent'] = $rounded_discount;
    $quantities[1]['percent'] = $rounded_discount2;
    $quantities[2]['percent'] = $rounded_discount3;

    $attachment_id = $product->get_image_id(); // default product image id  

    $n = count($quantities);
    ?>
<div class="row mx-0">
    <!-- Content Slider -->
    <div class="slider-center col-12 px-0">
        <div class="content-slider container slick-initialized slick-slider" id="content-slider-1">
            <div class="slick-list">
                <div class="slick-track" style="opacity: 1; width: 450px;">
                    <div class="slide slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false"
                        style="width: 450px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;"
                        tabindex="0">
                        <div class="slider-flex">
                            <span class="slide-content"><?php _e('ORDER FORM', 'nutrisslim-suiteV2'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="countdown-progress-bar col-12 px-0 mx-auto mb-3"></div>
    <div class="col-12"></div>
    <!-- Product Display -->
    <div class="product-display col-sm-6 pt-sm-4 mb-auto">
        <div class="row mx-0 py-0">
            <div class="product-display-img col-12 px-0 pt-3">
                <?php
                        $image_src_array = wp_get_attachment_image_src($attachment_id, 'large');
                        $imgsrc = $image_src_array[0];
                        echo '<img width="400" height="400" src="' . $imgsrc . '" alt="Product Image">';                    
                    ?>
                <div class="circle-colored circle-right discount_circle">
                    <div class="circle-tag">
                        <div class="circle-text">
                            <span class="circle-txt-large">-<?php echo $quantities[0]['percent']; ?>%</span>
                            <span class="circle-txt-small"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 pt-3 icon-check icon-primary-color text-center">
                <h2 class="text-center primary-color product-title-offer"><?php echo get_the_title($productID); ?></h2>
                <div class="col-12 pt-3 shipping-details">
                    <p class="center-text-mobile"><b><?php _e('Shipping costs', 'nutrisslim-suiteV2'); ?> <span
                                class="shipping_cost">£4,90</span></b><br>(Royal Mail - Standard delivery 1-2 working
                        days)</p>
                </div>
                <?php if ( !empty($quantities[1]['price']) || !empty($quantities[2]['price'])) { ?>
                <div class="text-center cta-notice">
                    <h3><?php _e('Buy more, save more', 'nutrisslim-suiteV2'); ?></h3>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php
    /*
    echo '<pre>';
    print_r($quantities);
    echo '</pre>';
    */
    if ( !empty($quantities[1]['price']) || !empty($quantities[2]['price'])) {
    ?>
<div id="upsell-block" class="">
    <?php

            // Retrieve the free shipping threshold from WooCommerce settings
            $free_shipping_threshold = 0;
            $shipping_zones = WC_Shipping_Zones::get_zones();
            foreach ($shipping_zones as $zone) {
                $shipping_methods = $zone['shipping_methods'];
                foreach ($shipping_methods as $method) {
                    if ($method->id === 'free_shipping' && isset($method->min_amount)) {
                        $free_shipping_threshold = $method->min_amount;
                        break 2; // Break both loops if we find the threshold
                    }
                }
            }

            // error_log(print_r($quantities, true));
            foreach ($quantities as $key => $item) {
                $num = $key + 1;
                if ($key == 1) {
                    echo '<div class="text-center cta-notice mobile"><h3>' .  __('Buy more, save more', 'nutrisslim-suiteV2') . '</h3></div>';
                }
                if ($quantities[$key]['price']) {
 
                    $freeshipping = $quantities[$key]['price'] >= $free_shipping_threshold ? true : false;



        ?>
    <div class="offer custom_offer offer<?php echo $key . ' ' . ($key == 0 ? 'active' : ''); ?>">
        <div class="offer-container">
            <div class="text-center <?php echo ($key == 0 ? 'active' : ''); ?>">
                <h3><?php echo sprintf(__('%d package', 'nutrisslim-suiteV2'), $num); ?></h3>
            </div>
            <div class="bottom">
                <div class="upsell-card">
                    <div class="offer-right">
                        <!-- Image and discount badge section -->
                        <?php
                                if ($item['image']) {
                                    $image_src_array = wp_get_attachment_image_src($item['image'], 'medium');
                                    $imgsrc = $image_src_array[0];
                                } else {
                                    $image_src_array = wp_get_attachment_image_src($attachment_id, 'medium');
                                    $imgsrc = $image_src_array[0];                                    
                                }
                            ?>
                        <img width="400" height="500" src="<?php echo $imgsrc; ?>" alt="Product Image" />
                        <div class="circle-red circle-right">
                            <div class="circle-tag">
                                <div class="circle-text">
                                    <span class="circle-txt-large">-<?php echo $quantities[$key]['percent']; ?>%</span>
                                    <span class="circle-txt-small"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="offer-left">
                        <!-- Quantity selection and price display -->
                        <div class="cta">
                            <div class="checkbox">
                                <?php 
                                        echo '<input 
                                        data-id="' . $productID . '" 
                                        data-lid="' . get_the_ID() . '" 
                                        data-qty="' . $num . '" 
                                        data-price="' . round($quantities[$key]['price'], 2) . '" 
                                        id="checked0' . $num . '" 
                                        type="checkbox" ' . ($key == 0 ? 'checked' : '') . 
                                        (isset($quantities[$key]['gift'][0]) ? ' data-gift="' . $quantities[$key]['gift'][0] . '"' : '') . 
                                        (!empty($quantities[$key]['free_shipping']) ? ' data-free-shipping="1"' : '') . 
                                        '>';                                    
                                    ?>
                                <label for="checked0<?php echo $num; ?>">
                                    <h3><?php echo sprintf(__('Select %d package(s)', 'nutrisslim-suiteV2'), $num); ?>
                                    </h3>
                                </label>
                            </div>
                            <div class="price mt-3">
                                <div class="price-old price-small col-auto">
                                    <span
                                        class="line-through pr-2 pr-sm-4"><?php echo sprintf(__('Regular price %s', 'nutrisslim-suiteV2'), wc_price($regular_price * $num)); ?>
                                    </span>
                                </div>
                                <div class="price-main price-large col-12">
                                    <span class="offer-price"><?php echo wc_price($quantities[$key]['price']); ?></span>
                                </div>
                            </div>
                        </div>
                        <?php if (! $quantities[$key]['free_shipping']) { ?>
                        <div class="shipping-cost">
                            <span><b><?php _e('Shipping costs £4.90', 'nutrisslim-suiteV2'); ?></b></span>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php                  
                        if ($quantities[$key]['free_shipping'] || $freeshipping) {
                    ?>
                <div class="offer_shipping">
                    <div class="plus">
                        <img src="<?php echo plugins_url('assets/upsell_plus.svg', __FILE__); ?>" alt="plus">
                    </div>
                    <div class="icon">
                        <img src="<?php echo plugins_url('assets/express-delivery.png', __FILE__); ?>"
                            alt="express-delivery">
                    </div>
                    <?php _e('Free Shipping', 'nutrisslim-suiteV2'); ?>
                </div>
                <?php
                        }
                    ?>
                <?php
                        if (!empty($quantities[$key]['gift']) && isset($quantities[$key]['gift'][0])) {
                    ?>
                <div class="offer_shipping">
                    <div class="plus">
                        <img src="<?php echo plugins_url('assets/upsell_plus.svg', __FILE__); ?>" alt="plus">
                    </div>
                    <div class="icon">
                        <img src="<?php echo plugins_url('assets/free_gift.svg', __FILE__); ?>" alt="free_gift">
                    </div>
                    <?php _e('Free Gift', 'nutrisslim-suiteV2'); ?>
                </div>
                <?php
                        }
                    ?>
            </div>
        </div>
    </div>
    <?php
                } // $quantities[$key]['price']
            }
        ?>

</div>
<div id="offer-loader" class="">
    <div class="preloader-content">
        <h2><?php _e('Angebot aktualisieren ...', 'nutrisslim-suiteV2'); ?></h2>
        <img src="<?php echo plugins_url('assets/preloader-whitebg.gif', __FILE__); ?>" />
    </div>
</div>
<?php
    }

    return ob_get_clean(); // Return the buffer contents and clear the buffer

}

function conditionally_register_shortcodes() {
    if (!is_admin()) {
        add_shortcode('select_quantity', 'display_select_quantity_shortcode');
    }
}
add_action('init', 'conditionally_register_shortcodes');

function add_quantity_before_form($content) {   
    $custom_content = display_select_quantity_shortcode(); // Define your custom content    
    return $custom_content; // Return the modified content
}
add_filter('add_quantity_select', 'add_quantity_before_form');