<?php
/*
// Add screen options for the product reviews admin page
add_action('load-product_page_product-reviews', 'add_reviews_screen_option');

function add_reviews_screen_option() {
    // Add the screen option for the number of reviews per page
    add_screen_option('per_page', array(
        'label'   => 'Reviews per page',
        'default' => 20, // Default number of items per page
        'option'  => 'reviews_per_page',
    ));

    // Hook into set-screen-option filter to handle saving
    add_filter('set-screen-option', 'save_reviews_per_page_screen_option', 10, 3);
}

// Save the screen option for the number of reviews per page
function save_reviews_per_page_screen_option($status, $option, $value) {
    if ($option === 'reviews_per_page') {
        return (int) $value;  // Save the value entered by the user
    }
    return $status;
}
*/
/**
 * Hook into the query for product reviews to adjust the number of reviews displayed per page.
 */
add_action('pre_get_comments', 'adjust_reviews_per_page');

function adjust_reviews_per_page($query) {
    // Check if we are in the admin area and on the product reviews page
    if (is_admin() && isset($query->query_vars['post_type']) && $query->query_vars['post_type'] === 'product') {

        // Get the current user's saved screen option for number of reviews per page
        $per_page = get_user_meta(get_current_user_id(), 'reviews_per_page', true);

        // $per_page = 100;

        // If no value is saved, fall back to a default
        if (empty($per_page)) {
            $per_page = 20; // Default number of reviews per page
        }

        // Adjust the number of comments (product reviews) per page
        $query->query_vars['number'] = (int) $per_page;
    }
}
