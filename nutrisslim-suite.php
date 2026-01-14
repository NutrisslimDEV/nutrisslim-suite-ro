<?php
/**
 * Plugin Name: Nutrisslim SuiteV2
 * Description: Basic adjustments for Nutrisslim sites
 * Version: 1.0.5
 * Author: Nenad Radoja
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

require plugin_dir_path( __FILE__ ) . 'inc/widgets.php';
require plugin_dir_path( __FILE__ ) . 'inc/shortcodes.php';

require plugin_dir_path( __FILE__ ) . 'inc/misc.php';

require plugin_dir_path( __FILE__ ) . 'inc/prices.php';
require plugin_dir_path( __FILE__ ) . 'inc/product.php';

require plugin_dir_path( __FILE__ ) . 'inc/checkout.php';
require plugin_dir_path( __FILE__ ) . 'inc/bundle.php';
require plugin_dir_path( __FILE__ ) . 'inc/landing.php';

require plugin_dir_path( __FILE__ ) . 'inc/after_purchase.php';
require plugin_dir_path( __FILE__ ) . 'inc/removal.php';
require plugin_dir_path( __FILE__ ) . 'inc/submit_review.php';

require plugin_dir_path( __FILE__ ) . 'inc/gift-product-coupon.php';

// Conditionally include dashboard.php only in the admin dashboard
if ( is_admin() ) {
    require plugin_dir_path( __FILE__ ) . 'inc/backend.php';
}

function enqueue_custom_admin_js_for_plugin() {
    // wp_enqueue_script('disable-previews', plugins_url('/js/disable-previews.js', __FILE__), array('jquery'), '1.0.1', true);
    if (function_exists('get_current_screen')) {
        $screen = get_current_screen();
        if ($screen->id === 'product') { // Check if we're on the product edit page
            wp_enqueue_script('custom-acf-admin-js', plugins_url('/js/product_edit.js', __FILE__), array('jquery'), '1.0.58', true);
        }

        // Check if we're on the product edit or add new product page
        if ( $screen->id === 'product' || $screen->post_type === 'product' ) {
            // Enqueue your CSS file
            wp_enqueue_style( 'my-custom-product-css', plugins_url( '/assets/css/custom-product-style.css', __FILE__ ), array(), '1.0.5', 'all' );
        }        

    }
}
add_action('admin_enqueue_scripts', 'enqueue_custom_admin_js_for_plugin');

function enqueue_landing_page_scripts() {
    // Check if the current post is of the 'landing-page' type
    wp_enqueue_script('swiper-js-product-page', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array('jquery'), null, true);
    if (is_singular('product')) {
        // Enqueue the script only if it's a landing page
        wp_enqueue_script('productjs', plugins_url('/js/product.js', __FILE__), array('jquery'), '1.0.51', true);
    }    
    if (is_singular('landing-page')) {
        // Enqueue the script only if it's a landing page
        // wp_enqueue_script('woo-product', '/wp-content/plugins/woocommerce/assets/js/frontend/single-product.js', array('jquery'), '1.0.0', 'all');
        wp_enqueue_script('checkoutjs', plugins_url('/js/checkout.js', __FILE__), array('jquery'), '1.1.59', true);
        wp_enqueue_script('landingjs', plugins_url('/js/landing.js', __FILE__), array('jquery'), '1.0.78', true);

        // Localize the script with new data
        $ajax_params = array(
            'ajax_url' => admin_url('admin-ajax.php') // URL for admin-ajax.php
        );
        wp_localize_script('landingjs', 'ajax_params', $ajax_params);
        wp_localize_script('checkoutjs', 'ajax_params', $ajax_params);
    }
    if (is_checkout()) {
        // wp_enqueue_script('swiper-js-product-page', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array('jquery'), null, true);
        wp_enqueue_script('checkoutjs', plugins_url('/js/checkout.js', __FILE__), array('jquery'), '1.2.9', true);
        // Localize the script with new data
        $ajax_params = array(
            'ajax_url' => admin_url('admin-ajax.php') // URL for admin-ajax.php
        );
        wp_localize_script('checkoutjs', 'ajax_params', $ajax_params);
    }
    // Enqueue the script only if it's a landing page
    wp_enqueue_script('mainjs', plugins_url('/js/main.js', __FILE__), array('jquery'), '2.1.41', true);
    wp_localize_script('mainjs', 'wc_cart_params', array('ajax_url' => admin_url('admin-ajax.php')));
 
}
// Hook into the wp_enqueue_scripts action to ensure scripts and styles are enqueued at the correct time
add_action('wp_enqueue_scripts', 'enqueue_landing_page_scripts');

// Remove Swiper script
function remove_swiper_script() {
    if (is_product()) {
        wp_dequeue_script('swiper-js');
    }
}
add_action('wp_print_scripts', 'remove_swiper_script', 100);
/*
function custom_enqueue_landing_page_styles() {
    wp_enqueue_style('global-style', plugins_url( '/assets/css/global.css', __FILE__ ), array(), '1.0.12', 'all');
    // Check if we're on a single post of the 'landing-page' post type
    if ((is_single() && get_post_type() == 'landing-page') || (is_single() && get_post_type() == 'post')) {
        // Enqueue your stylesheet - ensure the path is correct
        wp_enqueue_style('landing-page-style', plugins_url( '/assets/css/landing-style.css', __FILE__ ), array(), '1.0.24', 'all');
        wp_enqueue_style('woo-style', '/wp-content/plugins/woocommerce/assets/css/woocommerce.css', array(), '1.0.0', 'all');
    }
    if (is_single() && get_post_type() == 'product') {
        // Enqueue your stylesheet - ensure the path is correct
        wp_enqueue_style('product-style', plugins_url( '/assets/css/product-1.css', __FILE__ ), array(), '1.1.91', 'all');
    }
    wp_enqueue_style('plugin-style', plugins_url('style.css', __FILE__), array(), filemtime(plugin_dir_path(__FILE__) . 'style.css'), 'all');
}
add_action('wp_enqueue_scripts', 'custom_enqueue_landing_page_styles', 99);
*/

function custom_enqueue_landing_page_styles() {
    wp_enqueue_style('global-style', plugins_url('/assets/css/global.css', __FILE__), array(), '1.0.14', 'all');

    if (is_single()) {
        global $post;
        $comparison_date = '2024-06-01';
        $publish_date = get_the_date('Y-m-d', $post->ID);

if (get_post_type() == 'landing-page' || get_post_type() == 'post') {

    // Check if the domain is nutrisslim.uk
    if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] == 'nutrisslim.uk') {

        // Check if the publish date is less than or equal to the comparison date
        if ($publish_date <= $comparison_date) {
            wp_enqueue_style('landing-page-style', plugins_url('/assets/css/landing-style.css', __FILE__), array(), '1.0.28', 'all');
        }

    }

    // This WooCommerce stylesheet will still be enqueued for both domains
    wp_enqueue_style('woo-style', '/wp-content/plugins/woocommerce/assets/css/woocommerce.css', array(), '1.0.0', 'all');
}
		
		if (is_singular('landing-page')) {
			wp_enqueue_style('landing-quantity-selector', plugins_url('landing-quantity-selector.css', __FILE__), array(), filemtime(plugin_dir_path(__FILE__) . 'landing-quantity-selector.css'), 'all');
		}

        if (get_post_type() == 'product') {
            wp_enqueue_style('product-style', plugins_url('/assets/css/product-1.css', __FILE__), array(), '1.2.05', 'all');
        }
    }

    wp_enqueue_style('gridlex', plugins_url('/assets/css/gridlex.min.css', __FILE__), array(), '1.0.110', 'all');
    wp_enqueue_style('plugin-style', plugins_url('style.css', __FILE__), array(), filemtime(plugin_dir_path(__FILE__) . 'style.css'), 'all');
}
add_action('wp_enqueue_scripts', 'custom_enqueue_landing_page_styles', 99);


function disable_swiper_on_landing_pages() {
    if (is_singular('landing-page')) {  // Adjust this line based on how your landing pages are identified
        wp_dequeue_style('swiper-css');
    }
}

function get_nutrislim_assets_url() {
    return plugin_dir_url(__FILE__) . 'assets/';
}
function get_nutrislim_url() {
    return plugin_dir_url(__FILE__);
}

// Step 2: Append '- GIFT' to product name in WooCommerce order if it has 'landinggift'
add_action('woocommerce_checkout_create_order_line_item', function ($item, $cart_item_key, $values) {

    // Check if the cart item has 'landinggift' meta
    if (isset($values['landinggift']) && $values['landinggift']) {
        // Append '- GIFT' to the product name
        $original_name = $item->get_name();
        $new_name = $original_name . ' - GIFT';

        // Set the new name
        $item->set_name($new_name);
    }
}, 10, 3);

// add_action('wp_enqueue_scripts', 'disable_swiper_on_landing_pages', 100);

function nutrisslim_suite_load_textdomain() {
    load_plugin_textdomain( 'nutrisslim-suite', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'nutrisslim_suite_load_textdomain' );

// Load the text domain for Elementor Pro
function load_elementor_pro_textdomain() {
    load_plugin_textdomain( 'elementor-pro', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'load_elementor_pro_textdomain' );

function custom_pre_post_link($permalink, $post, $leavename) {
    if ($post->post_type == 'post') {
        // Use a relative path to avoid duplication of the site URL
        $permalink = '/blog/' . $post->post_name . '/';
    }
    return $permalink;
}
add_filter('pre_post_link', 'custom_pre_post_link', 10, 3);

function custom_add_rewrite_rules() {
    add_rewrite_rule(
        '^blog/([^/]+)/?$',
        'index.php?name=$matches[1]',
        'top'
    );
}
add_action('init', 'custom_add_rewrite_rules');

function custom_flush_rewrite_rules() {
    custom_add_rewrite_rules();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'custom_flush_rewrite_rules');
register_deactivation_hook(__FILE__, 'flush_rewrite_rules');