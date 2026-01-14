<?php
/**
 * Include shortcode files.
 */

function nutrisslim_include_shortcodes_files() {
    	require_once __DIR__ . '/shortcodes/landing_product_display.php';
    	require_once __DIR__ . '/shortcodes/landing_faq.php';
    	require_once __DIR__ . '/shortcodes/landing_product_tabs.php';
   	require_once __DIR__ . '/shortcodes/select_quantity.php';
    	require_once __DIR__ . '/shortcodes/custom_product_image.php';
    	require_once __DIR__ . '/shortcodes/blogproduct.php';
    	require_once __DIR__ . '/shortcodes/product_rating.php';
    	require_once __DIR__ . '/shortcodes/mainmenu.php';
   	require_once __DIR__ . '/shortcodes/checkout_upsell.php';
    	require_once __DIR__ . '/shortcodes/cart_upsell.php';
    	require_once __DIR__ . '/shortcodes/info_shortcodes.php';
    	require_once __DIR__ . '/shortcodes/side_cats.php';
   // Landing page widgets
}

// Hook into 'init'
add_action('init', 'nutrisslim_include_shortcodes_files');
