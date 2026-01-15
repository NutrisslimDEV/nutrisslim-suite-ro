<?php
/**
 * Facebook Attribution Tracking
 * Adds STRFB metadata to first-time orders from Facebook traffic
 */

if (!defined('ABSPATH')) {
    exit;
}

// Capture UTM source in cookie via inline script
add_action('wp_head', 'enqueue_utm_capture_script');
function enqueue_utm_capture_script() {
    ?>
    <script>
        (function() {
            var urlParams = new URLSearchParams(window.location.search);
            var utmSource = urlParams.get('utm_source');
            if (utmSource) {
                document.cookie = 'nutris_utm_source=' + utmSource + '; path=/; max-age=2592000'; // 30 days
            }
        })();
    </script>
    <?php
}

// Add STRFB to first-time orders from Facebook
add_action('woocommerce_checkout_order_processed', 'add_facebook_attribution_to_order', 10, 3);

function add_facebook_attribution_to_order($order_id, $posted_data, $order) {
    // Get UTM source - try WC attribution first, then cookie
    $utm_source = '';

    // Try WooCommerce attribution (works for logged-in users)
    $wc_utm = $order->get_meta('_wc_order_attribution_utm_source', true);
    if (!empty($wc_utm)) {
        $utm_source = $wc_utm;
    }

    // Fallback to cookie (for guests)
    if (empty($utm_source) && isset($_COOKIE['nutris_utm_source'])) {
        $utm_source = sanitize_text_field($_COOKIE['nutris_utm_source']);
    }

    // Check if Facebook
    if (empty($utm_source) || strtolower($utm_source) !== 'facebook') {
        return;
    }

    // Check if first order
    $customer_id = $order->get_customer_id();
    $billing_email = $order->get_billing_email();
    $is_first_order = false;

    if ($customer_id > 0) {
        // Registered customer
        $orders = wc_get_orders(array(
            'customer_id' => $customer_id,
            'limit' => -1,
            'return' => 'ids'
        ));
        $is_first_order = (count($orders) === 1);
    } elseif (!empty($billing_email)) {
        // Guest - check by email
        $orders = wc_get_orders(array(
            'billing_email' => $billing_email,
            'limit' => -1,
            'return' => 'ids'
        ));
        $is_first_order = (count($orders) === 1);
    }

    // Add STRFB if first order
    if ($is_first_order) {
        $order->update_meta_data('STRFB', 'yes');
        $order->save();
    }
}
