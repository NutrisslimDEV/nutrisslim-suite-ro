<?php
function remove_scripts_for_specific_pages() {
    if (!is_user_logged_in()) {
        if (is_front_page()) {
            wp_dequeue_script('my-custom');
            wp_dequeue_script('ultimate-woocommerce-cart-frontend');  
            wp_dequeue_script('jquery-ui-draggable');   
        }
        if (is_singular('product')) {
            // wp_dequeue_script('my-custom-js-js');
        }
        if (is_singular('landing-page')) {
            // wp_dequeue_script('my-custom-js-js');
        }
    }
}
add_action('wp_enqueue_scripts', 'remove_scripts_for_specific_pages', 999);


function register_translatable_strings() {
    // Register your translatable strings
    __('Premium natural ingredients with proven effects', 'nutrisslim-suiteV2');
}

add_action('init', 'register_translatable_strings');