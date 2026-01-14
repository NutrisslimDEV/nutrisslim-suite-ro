<?php
function blogproduct_shortcode() {
    // Assuming you want to fetch and display a custom field or any dynamic content
    // global $post;
    // $product_info = get_post_meta($post->ID, 'custom_field_name', true); // Replace 'custom_field_name' with your actual custom field key

    $productref = get_field('product');
    if (!$productref) {
        // Return empty or handle the case as needed
        return ''; // Returning an empty string if $productref is not set
    }    
    $product = wc_get_product($productref[0]);
    $data = '
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
            text-align:center;
        }
        .nutrisslim-bottom-features div.contentPart {
            box-sizing: border-box;
            padding: 0 10px 1rem;
            max-width: 100%;                
            flex-basis: 50%;
            max-width: 50%;
        }
        .pricing .price-main span {
            font-family: "Fira Sans Condensed", sans-serif;
            font-weight: 700;
        }          
    </style>    
    ';

        // Ensure that $product is a WC_Product object
        if ( is_a($product, 'WC_Product') ) {
            $tag_line = get_field('tag_line', $product->get_id());
            $features = get_field('features', $product->get_id());
        }

        // Fetch the product image
        $image_id  = $product->get_image_id();
        $image_url = wp_get_attachment_image_url($image_id, 'large');

        $landing_info = get_field('quantity_prices');

        // Get sale price if it exists, otherwise get regular price
        $sale_price = $product->get_sale_price();
        $regular_price = $product->get_regular_price();

        // Determine the price to return
        $price = !empty($sale_price) && $sale_price > 0 ? $sale_price : $regular_price;

        $landing_single_price = $price;

        $tax = get_tax_rate_for_product($product->get_id(), 'SI');

        if ($landing_single_price) {
            $sale_price = $landing_single_price;
        } else {
            $sale_price_no_tax = $product->get_sale_price();
            $sale_price = $sale_price_no_tax / 100 * (100 + $tax);            
        }

        $regular_price_no_tax = $product->get_regular_price();
        $regular_price = $regular_price_no_tax / 100 * (100 + $tax);

        $savings = $regular_price - $sale_price;

        if ($regular_price > 0) { // Avoid division by zero
            $discount_percentage = (($regular_price - $sale_price) / $regular_price) * 100;
        } else {
            $discount_percentage = 0; // No discount applicable
        }
        
        $rounded_discount = floor($discount_percentage / 5) * 5;


        $data .= '<div class="nutrisslim-bottom-features">';

        $data .= '<div class="imagePart" style="position:relative;">';
        $data .= '<div class="circle-colored circle-right discount_circle">
        <div class="circle-tag">
          <div class="circle-text">
            <span class="circle-txt-large"> -' . $rounded_discount . '% </span>
            <span class="circle-txt-small">  </span>
          </div>
        </div></div>';        
        if ($image_url) {
            $data .= '<img src="' . esc_url($image_url) . '" alt="Product Image">';
        }
        $data .= '</div>';    


        $data .= '<div class="contentPart greenCheckList">';

        $data .= '<h2>' . esc_html(get_the_title($product->get_id())) . '</h2>';  

        $subtitle = get_field('subtitle', $product->get_id());

        // Display the product short description
        $data .= '<div class="product-short-description">';
        if ($subtitle) {
            $data .= '<p class="subtitle">' . $subtitle . '</p>';
        }
        $data .= apply_filters('the_content', $product->get_short_description());
        $data .= '</div>';

        // Initialize variables to store weight and consumption period
        $weightOutput = '';
        $consumptionPeriodOutput = '';

        // Check and format the weight value if it exists
        $weightValue = $product->get_weight();
        if ( !empty($weightValue) ) {
            $weightOutput = "Net " . $weightValue . " " . get_option( 'woocommerce_weight_unit' );
        }

        // Check and format the consumption period if it exists
        $consumption_period = get_field( 'consumption_period', $product->get_id() );
        if ( !empty($consumption_period) ) {
            $consumptionPeriodOutput = sprintf( __('for %s days', 'nutrisslim-suiteV2'), $consumption_period );
        }

        // Combine the output strings
        $combinedOutput = $weightOutput;
        if ( !empty($weightOutput) && !empty($consumptionPeriodOutput) ) {
            // Both values are available
            $combinedOutput .= " | " . $consumptionPeriodOutput;
        } elseif ( empty($weightOutput) && !empty($consumptionPeriodOutput) ) {
            // Only consumption period is available
            $combinedOutput = $consumptionPeriodOutput;
        }

        // Display the combined output
        if ( !empty($combinedOutput) ) {
            $data .= '<div class="product-details"><strong>' . $combinedOutput . '</strong></div>';
        }


        
        $data .= '<div class="container px-0">';
        $data .= '<div class="pricing row mx-0">';

        $data .= '<div class="price-old price-small col-12">';

        $data .= '<span class="line-through pr-2 pr-sm-4">' . __('Regular price', 'nutrisslim-suiteV2') . ': <span class="regular_price">' . wc_price($regular_price) . '</span></span>';
        $data .= '</div>'; 

        $data .= '<div class="price-main price-large col-12">';
        $data .= '<span class="primary-color"><span class="main_price">' . wc_price($sale_price) . '</span></span>';
        $data .= '</div>';       
        
        $data .= '</div>'; //pricing
        $data .= '</div>'; //container

        $data .= '<a href="#order-form-anchor" class="add-product-btn btn bold">' . __('Order now', 'nutrisslim-suiteV2') . '</a>';

        $data .= '<p><span class="price-small primary-color pt-2"><b>' . __('and save', 'nutrisslim-suiteV2') . ' <span class="savings">' . wc_price($savings) . '</span></b></span></p>';
        $data .= '<p>' . __('100% safe purchase with a no-questions-asked return policy.', 'nutrisslim-suiteV2') . '</p>';
        $data .= '</div>'; // content part

        $data .= '</div>';

        return $data;
}
add_shortcode('blogproduct', 'blogproduct_shortcode');
