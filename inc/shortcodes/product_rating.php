<?php
function product_rating_shortcode($atts) {
    // Extract shortcode attributes with a default fallback
    $atts = shortcode_atts(array(
        'id' => null
    ), $atts, 'product_rating');

    // Use global post if no ID is specified and ensure it's a product page
    if (null === $atts['id']) {
        global $post;
        if ('product' === $post->post_type) {
            $atts['id'] = $post->ID;
        } else {
            return ''; // Return empty if not a product page and no ID provided
        }
    }

    // Get the product
    $product = wc_get_product($atts['id']);
    if (!$product) {
        return 'Product not found.';
    }

    $sku = get_post_meta( $atts['id'], '_sku', true );    

    // Fetch data from the API (with caching)
    $review_data = get_review_data_with_cache( $sku );      

    if (!$review_data) {
        $review_data['review_count'] = $product->get_review_count();
        $review_data['average_rate'] = round($product->get_average_rating(), 2);
    }

    // Get the average rating and count of reviews
    // $average = round($product->get_average_rating(), 2);
    // $count = $product->get_review_count();

    $output = '';
    if ($review_data['review_count'] > 0) {
        // Prepare the rating HTML with stars
        $output .= '<div class="rateMeta">';
        // $output .= '<span style="width:' . (($average / 5) * 100) . '%"><strong class="rating">' . $average . '</strong> ' . esc_html__(' / 5', 'woocommerce') . '</span>';
        $output .= '<img class="star" src="/wp-content/uploads/2024/03/5-stars-01-1.svg"><img class="star" src="/wp-content/uploads/2024/03/5-stars-01-1.svg"><img class="star" src="/wp-content/uploads/2024/03/5-stars-01-1.svg"><img class="star" src="/wp-content/uploads/2024/03/5-stars-01-1.svg"><img class="star" src="/wp-content/uploads/2024/03/5-stars-01-1.svg">';
        $output .= '<div class="rate">' . $review_data['average_rate'] . ' / 5</div>';
        // $output .= '<div class="star-rating" title="' . sprintf(esc_attr__('Rated %s out of 5', 'woocommerce'), $average) . '">';
        if ($review_data['review_count'] == 1) {
            $output .= '<div class="checker"><span class="check checkbelo"><img src="/wp-content/uploads/2025/05/checkGreen.svg"></span> ' . $review_data['review_count'] . ' ' . __('Recenzii verificate', 'nutrisslim-suite') . '</div>';
        } elseif ($review_data['review_count'] == 2) {
            $output .= '<div class="checker"><span class="check checkbelo"><img src="/wp-content/uploads/2025/05/checkGreen.svg"></span> ' . $review_data['review_count'] . ' ' . __('Recenzii verificate', 'nutrisslim-suite') . '</div>';
        } else {
            $output .= '<div class="checker"><span class="check checkbelo"><img src="/wp-content/uploads/2025/05/checkGreen.svg"></span> ' . $review_data['review_count'] . ' ' . _n('Recenzii verificate', 'Recenzii verificate', $review_data['review_count'], 'nutrisslim-suite') . '</div>';
        }
        // $output .= '</div>';
        $output .= '</div>'; // Close .product-rating
    }


    if ($review_data['review_count'] > 0) {
        // $output .= '<span class="review-count">' . sprintf(_n('%s review', '%s reviews', $count, 'woocommerce'), $count) . '</span>';
    }

    return $output;
}
add_shortcode('product_rating', 'product_rating_shortcode');