<?php
add_action('after_setup_theme', 'disable_woocommerce_zoom_feature', 99);

function disable_woocommerce_zoom_feature() {
    remove_theme_support('wc-product-gallery-zoom');
}
add_filter( 'woocommerce_product_tabs', 'remove_additional_information_tab', 100, 1 );
function remove_additional_information_tab( $tabs ) {
    unset( $tabs['additional_information'] );
    return $tabs;
}

// Function to add content to the footer on product pages
function add_content_to_footer_on_product_page() {
    if (is_product()) {
        echo '<div class="modalHolder">';
        echo '<div class="modalwin subscrModal">';
        echo '<a href="#" class="closeMod closeModAll">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    width="191.906px" height="192.063px" viewBox="159.969 160 191.906 192.063" enable-background="new 159.969 160 191.906 192.063"
                    xml:space="preserve">
                    <polygon fill="#272727" points="340.2,160 255.8,244.3 171.8,160.4 160,172.2 244,256 160,339.9 171.8,351.6 255.8,267.8 340.2,352 
                    352,340.3 267.6,256 352,171.8 "/>
                </svg>
            </a>';
        echo '<h3 id="subscrModalTitle">' . __('Save with a subscription', 'nutrisslim-suiteV2') . '</h3>';  
        echo '<h4>' . __('Benefits of a subscription', 'nutrisslim-suiteV2') . '</h4>';
        echo '<ul>';
        echo '<li>' . __('If you subscribe today, <strong>additional 5% discount</strong> is applied on one time purchase price.', 'nutrisslim-suiteV2') . '</li>';
        echo '<li>' . __('Save time - receive your shipment every month without needing to order.', 'nutrisslim-suiteV2') . '</li>';
        //echo '<li>' . __('<strong>Free gift</strong> with every subscribed shipment, starting from the second shipment.', 'nutrisslim-suiteV2') . '</li>';
        echo '<li>' . __('You can cancel your subscription at any time in your account panel -> orders -> subscriptions section or just via mail.', 'nutrisslim-suiteV2') . '</li>';
        // echo '<li>' . __('<strong>Free shipping</strong> from the second shipment onwards.', 'nutrisslim-suiteV2') . '</li>';        
        echo '</ul>';
        echo '<p>' . __('Before your package is shipped, you will receive a reminder via email.', 'nutrisslim-suiteV2') . '</p>';
        echo '</div>';
        echo '</div>';
    }
}
add_action('wp_footer', 'add_content_to_footer_on_product_page');

function preload_product_thumbnail() {
    if (is_product() && function_exists('wc_get_product')) { // Ensure we are on a product page and WooCommerce is loaded
        global $post;
        $product = wc_get_product($post->ID); // Ensure $product is an instance of WC_Product

        if ($product instanceof WC_Product) { // Check if the object is valid
            $post_thumbnail_id = $product->get_image_id();
            if ($post_thumbnail_id) {
                $image_url = wp_get_attachment_url($post_thumbnail_id);
                echo '<link rel="preload" as="image" href="' . esc_url($image_url) . '" />';
            }
        }
    }
}
add_action('wp_head', 'preload_product_thumbnail');


function add_product_json_ld() {
    // Ensure we're on a single product page and WooCommerce is active
    if (is_product() && function_exists('wc_get_product')) {
        global $product;

        // Get the product object
        $product = wc_get_product(get_the_ID());

        // Check if the product object is valid
        if (!$product) {
            return;
        }

        // Get product details
        $product_name = $product->get_name();
        $product_image = wp_get_attachment_image_url($product->get_image_id(), 'full');
        $product_url = get_permalink($product->get_id());
        $product_price = $product->get_price();
        $product_currency = get_woocommerce_currency();
        $product_sku = $product->get_sku();
        $product_brand = get_option('blogname'); // Assuming 'pa_brand' is used for product brand

        $product_description = get_field('short_info', $product->get_id());
        if (empty($product_description)) {
            $product_description = $product->get_short_description();
        }

        // Get aggregate rating if available
        $average_rating = round($product->get_average_rating(), 2);
        $rating_count = $product->get_review_count();   
        
        $availability = $product->is_in_stock() ? "https://schema.org/InStock" : "https://schema.org/OutOfStock";        

        // Create a DateTime object for the current date
        $validDate = new DateTime();

        // Add 4 months to the current date
        $validDate->modify('+4 months');

        // Set the day to the first of the month
        $validDate->modify('first day of this month');

        // Construct JSON-LD
        $json_ld = array(
            "@context" => "https://schema.org/",
            "@type" => "Product",
            "name" => $product_name,
            "image" => $product_image,
            "description" => $product_description,
            "sku" => $product_sku ? $product_sku : "missingsku", // Fallback SKU
            "brand" => array(
                "@type" => "Brand",
                "name" => $product_brand
            ),
            "offers" => array(
                "@type" => "Offer",
                "url" => $product_url,
                "priceCurrency" => $product_currency,
                "price" => $product_price,
                "priceValidUntil" => $validDate->format('Y-m-d'),
                "itemCondition" => "https://schema.org/NewCondition",
                "availability" => $availability,
                "seller" => array(
                    "@type" => "Organization",
                    "name" => get_option('woocommerce_company_name') // Update with your store name
                )
            )
        );

        // Add aggregate rating if available
        if ($rating_count > 0) {
            $json_ld['aggregateRating'] = array(
                "@type" => "AggregateRating",
                "ratingValue" => $average_rating,
                "reviewCount" => $rating_count
            );
        }

        // Print JSON-LD in the head
        echo '<script type="application/ld+json">' . json_encode($json_ld) . '</script>';
    }
}
add_action('wp_head', 'add_product_json_ld');



/*
// Handle AJAX request to fetch ingredient data
function get_ingredient_data() {
    $ingredient_id = intval($_POST['ingredient_id']);

    $ingredient = get_term($ingredient_id, 'ingredient');
    $thumbnail = get_term_meta($ingredient_id, 'thumbnail_url', true); // Assuming you store thumbnail URL in term meta
    $description = term_description($ingredient_id, 'ingredient');

    wp_send_json_success(array(
        'thumbnail' => $thumbnail,
        'description' => wp_strip_all_tags($description)
    ));
}
add_action('wp_ajax_get_ingredient_data', 'get_ingredient_data');

// Handle AJAX request to search ingredients
function search_ingredients() {
    $term = sanitize_text_field($_GET['term']);
    $args = array(
        'taxonomy' => 'ingredient',
        'hide_empty' => false,
        'search' => $term
    );

    $ingredients = get_terms($args);
    $results = array();

    foreach ($ingredients as $ingredient) {
        $results[] = array(
            'id' => $ingredient->term_id,
            'text' => $ingredient->name
        );
    }

    wp_send_json($results);
}
add_action('wp_ajax_search_ingredients', 'search_ingredients');
add_action('wp_ajax_nopriv_search_ingredients', 'search_ingredients');
*/

/*
add_filter('woocommerce_product_tabs', 'add_reviews_tab', 98);
function add_reviews_tab($tabs) {
    if (!isset($tabs['reviews'])) {  // Only add if it's not already set
        $tabs['reviews'] = array(
            'title'    => __('Reviews', 'text-domain'),
            'priority' => 50,
            'callback' => 'woocommerce_product_reviews_tab'
        );
    }
    return $tabs;
}
function woocommerce_product_reviews_tab() {
    comments_template();
}
*/