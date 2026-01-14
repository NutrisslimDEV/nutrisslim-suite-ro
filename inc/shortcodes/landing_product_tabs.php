<?php
function display_custom_product_tabs() {
    global $product;

    // Fetch the product ID from ACF field
    $productref = get_field('selected_product');
    if (empty($productref)) {
        return 'No product selected';
    }
    $productID = $productref[0];

    // Set the global product object
    $product = wc_get_product($productID);
    if (!$product) {
        return 'Invalid product';
    }

    // Now, mimic the tabs as done in Elementor widget
    // ob_start(); // Start output buffering to capture all output

    ?>

<?php

    $uporaba = get_field( 'uporaba', $productID );
    $warnings = get_field('warnings', $productID);
    if ($warnings) {
        $uporaba .= '<p style="margin-top:.9rem;"><strong>' . __( 'Warning:', 'nutrisslim-suiteV2' ) . '</strong></p>';
        $uporaba .= $warnings;
    } 
    $sastavnine = get_field( 'sestavine', $productID );
    $hranilne = get_field( 'hranilne_vrednosti', $productID );

    // $tabsContainer = '<div class="woocommerce-tabs wc-tabs-wrapper">';
    $tabLists = '<ul class="tabs wc-tabs" role="tablist">';
    $tabContant = '';

    if ($uporaba) {
        $tabLists .= '<li class="uporaba_tab active" id="tab-title-uporaba" role="tab" aria-controls="tab-uporaba"><a href="#tab-uporaba">' . __( 'Usage', 'nutrisslim-suiteV2' ) . '</a></li>';
        $tabContant .= '<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--uporaba panel entry-content wc-tab" id="tab-uporaba" role="tabpanel" aria-labelledby="tab-title-uporaba">' . $uporaba . '</div>';
    }

    if ($sastavnine) {
        $tabLists .= '<li class="sestavine_tab" id="tab-title-sestavine" role="tab" aria-controls="tab-sestavine"><a href="#tab-sestavine">' . __( 'Ingredients', 'nutrisslim-suiteV2' ) . '</a></li>';
        $tabContant .= '<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--sestavine panel entry-content wc-tab" id="tab-sestavine" role="tabpanel" aria-labelledby="tab-title-sestavine">' . $sastavnine . '</div>';
    }
    
    if ($hranilne) {
        $tabLists .= '<li class="hranilne_vrednosti_tab" id="tab-title-hranilne_vrednosti" role="tab" aria-controls="tab-hranilne_vrednosti"><a href="#tab-hranilne_vrednosti">' . __( 'Nutritional values', 'nutrisslim-suiteV2' ) . '</a></li>';
        $tabContant .= '<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--hranilne_vrednosti panel entry-content wc-tab"  id="tab-hranilne_vrednosti" role="tabpanel" aria-labelledby="tab-title-hranilne_vrednosti">' . $hranilne . '</div>';
    }
    
    // $comments = get_comments( array( 'post_id' => $productID, 'status' => 'approve' ) );

    // if ( !empty($comments) ) {
    //     $tabLists .= '<li class="reviews_tab" id="tab-title-reviews" role="tab" aria-controls="tab-reviews"><a href="#tab-reviews">' . __( 'Recenzje', 'nutrisslim-suiteV2' ) . '</a></li>';
    //     $tabContant .= '<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--reviews panel entry-content wc-tab" id="tab-reviews" role="tabpanel" aria-labelledby="tab-title-hranilne">' . get_comments_html_for_post($productID) . '</div>';    
    // }
    
    $tabLists .= '</ul>';


    return '<div class="woocommerce"><div class="product"><div class="woocommerce-tabs wc-tabs-wrapper">' . $tabLists . $tabContant . '</div></div></div>';

    // return ob_get_clean(); // Return the output buffer contents
}

// Register the shortcode with WordPress
add_shortcode('landing_product_tabs', 'display_custom_product_tabs');