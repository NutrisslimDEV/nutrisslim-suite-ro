<?php
function custom_product_image_shortcode() {
    global $product;

    // Check if the global product object is available
    if (!is_a($product, 'WC_Product')) {
        return 'This shortcode must be used within a WooCommerce product context.';
    }

    // Get the product image URL
    $image_id = $product->get_image_id();
    $image_url = wp_get_attachment_image_url($image_id, 'full');
    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);

    // Generate image HTML if image exists
    if (!empty($image_url)) {
        $output = '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '" class="woocommerce-product-gallery__image">';
    } else {
        $output = '<p>No image available.</p>';
    }

    // Check if the product is on sale and add the sale badge with percentage
    if ($product->is_on_sale() && $product->get_regular_price() && $product->get_sale_price()) {
        $regular_price = (float) $product->get_regular_price();
        $sale_price = (float) $product->get_sale_price();
        $discount_percentage = round(100 - ($sale_price / $regular_price * 100));
        $output .= '<span class="onsale">-' . $discount_percentage . '%</span>';
    }

    return $output;
}
add_shortcode('product_img', 'custom_product_image_shortcode');