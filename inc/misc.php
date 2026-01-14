<?php


function remove_autop_for_acf_wysiwyg($content) {
    // Get the global post object to check the post type
    global $post;

    // Check if the current post is NOT of the type 'product'
    if ($post && $post->post_type !== 'product') {
        // Remove the 'wpautop' filter to prevent adding unwanted <p> and <br> tags
        remove_filter('acf_the_content', 'wpautop');
    }

    return $content;
}
add_filter('acf_the_content', 'remove_autop_for_acf_wysiwyg', 10, 1);

function custom_section_html_shortcode($atts) {
    // Set default attributes and extract them
    $atts = shortcode_atts(array(
        'number' => '0', // default number is 0
    ), $atts, 'section_html_content');

    $number = intval($atts['number']); // Convert the number attribute to integer

    // Get the section_html repeatable field (assume it's a top-level field)
    $sections = get_field('section_html');

    // Initialize an empty string to hold the content
    $content = '';

    // Check if sections exist and the desired index is within the array bounds
    if (is_array($sections) && count($sections) > $number) {
        // Retrieve the content subfield of the specified section
        $content = isset($sections[$number]['content']) ? $sections[$number]['content'] : '';
    }

    // Check if content contains a div with the class 'content-block'
    if (strpos($content, 'class="content-block') !== false) {
        // If it does, apply the standard the_content filter
        // return apply_filters('the_content', $content);
        return apply_filters('acf_the_content', $content);
    } else {
        // Otherwise, apply a custom ACF content filter
        return apply_filters('acf_the_content', $content);
    }

    // Return the content, make sure to apply the_content filter for proper formatting
    // return apply_filters('the_content', $content);
    // return apply_filters('acf_the_content', $content);
}
// Register the shortcode with WordPress
add_shortcode('section_html_content', 'custom_section_html_shortcode');

// Disable wpautop for post content
// remove_filter('the_content', 'wpautop');

// Optional: Disable wpautop for excerpts as well
// remove_filter('the_excerpt', 'wpautop');

function getCountry() {
    $specific_countries = get_option('woocommerce_specific_allowed_countries');

    // Check if there are any specific countries set
    if (is_array($specific_countries) && !empty($specific_countries)) {
        // Get the first country in the list
        $default_country = reset($specific_countries);
    } else {
        // Get the default country from WooCommerce settings
        $default_country = WC()->countries->get_base_country();
    } 
    return $default_country;   
}

function custom_body_classes($classes) {
    // Ensure we're on a single post of the 'landing-page' post type
    if (is_single() && get_post_type() == 'landing-page') {
        // Get the ACF field value for the current post
        $color_theme = get_field('color_theme');

        if ($color_theme == 'default') {
            $product = get_field('selected_product');           
            $productID = $product[0];           
            $color_theme = get_field('color_theme', $productID);
        }
        
        // If there's a value for the color theme field, add it as a class
        if (!empty($color_theme)) {
            $classes[] = esc_attr($color_theme);
        }
    }

    if (is_single() && 'post' == get_post_type()) {
        $classes[] = 'color-theme-default';  // Add class
    }    

    if (is_product()) { // Check if it's a product page
        global $post;
        $color_theme = get_field('color_theme', $post->ID); // Get the ACF field value

        if (!empty($color_theme)) {
            $classes[] = esc_attr($color_theme); // Sanitize and add the field value as a class
        }

        $reviews = get_field('reviews');
        if (empty($reviews)) {
            $classes[] = 'emptyRev';
        }

        $consumption_period = get_field('consumption_period');   
        if (empty($consumption_period)) {
            $classes[] = 'no_consuption';
        }     
    }

    $default_coutntry = getCountry();

    if ($default_coutntry) {
        $classes[] = 'country_' . $default_coutntry;
    }

    return $classes;
}
add_filter('body_class', 'custom_body_classes');

function enable_reviews_on_new_products() {
    if (is_admin()) {
        // Get the WooCommerce option for enabling reviews
        $enable_reviews = get_option('woocommerce_enable_reviews');

        // Check if reviews are disabled and enable them
        if ('no' === $enable_reviews) {
            update_option('woocommerce_enable_reviews', 'yes');
        }
    }
}
add_action('admin_init', 'enable_reviews_on_new_products');

// Function to conditionally disable comments and pings on blog posts
function remove_comments_form($open, $post_id) {
    // Retrieve the post using the post ID to get its details
    $post = get_post($post_id);

    // Check if the post is of type 'post' (standard blog post)
    if ($post->post_type == 'post') {  
        // Return false to close comments and pings for blog posts
        return false;
    }
    
    // For all other types of posts, return the original status
    return $open;
}

// Attach the function to the 'comments_open' filter hook
add_filter('comments_open', 'remove_comments_form', 20, 2);
// Attach the function to the 'pings_open' filter hook
add_filter('pings_open', 'remove_comments_form', 20, 2);

function remove_item_from_cart() {
    $cart_key = isset($_POST['cart_key']) ? sanitize_text_field($_POST['cart_key']) : '';

    $cart_item = WC()->cart->get_cart_item($cart_key);
    $product_id = $cart_item['product_id'];
    $product = wc_get_product($product_id);
    $product_type = $product ? $product->get_type() : '';

    // Existing logic for removing the requested item
    if ($product_type === 'nutrisslim') {
        foreach (WC()->cart->get_cart() as $key => $item) {
            if (isset($item['nutrisslim_parent_key']) && $item['nutrisslim_parent_key'] === $cart_item['key']) {
                WC()->cart->remove_cart_item($key);
            }
        }
    }

    if ($cart_key && isset(WC()->cart->cart_contents[$cart_key])) {
        WC()->cart->remove_cart_item($cart_key);
    }    

    // Step 1: Check for regular items in the cart
    $has_regular_items = false;
    foreach (WC()->cart->get_cart() as $key => $item) {
        if (!isset($item['landinggift']) && !isset($item['regulargift']) && !isset($item['offer'])) {
            $has_regular_items = true;
            break;
        }
    }

    // error_log(print_r('has_regular_items ====================>', true));
    // error_log(print_r($has_regular_items, true));

    // Step 2: If no regular items, remove items with specific meta
    if (!$has_regular_items) {
        foreach (WC()->cart->get_cart() as $key => $item) {
            if (isset($item['landinggift']) || isset($item['regulargift']) || isset($item['offer'])) {
                WC()->cart->remove_cart_item($key);
            }
        }
    }

    // Check if cart is empty after removal actions
    if (WC()->cart->is_empty()) {
        wp_send_json_success([ 
            'free_shipping_message' => cwc_free_shipping_message(),
            'empty_cart' => true
        ]);
    } else {
        wp_send_json_success([ 
            'free_shipping_message' => cwc_free_shipping_message()
        ]);
    }

    wp_send_json_error();
}

add_action('wp_ajax_remove_item_from_cart', 'remove_item_from_cart');
add_action('wp_ajax_nopriv_remove_item_from_cart', 'remove_item_from_cart');

/*
function replace_my_shortcode($content) {
    // Check if there is a specific shortcode in the content
    if (strpos($content, '[my_shortcode') !== false) {
        $content = str_replace('[custom_checkout_form]', '[custom_checkout show_slider="no"]', $content);
    }
    return $content;
}
add_filter('the_content', 'replace_my_shortcode');

$field_content = get_field('section_html');
echo apply_filters('the_content', $field_content);
*/

add_action('template_redirect', 'store_landing_page_id');
function store_landing_page_id() {
    session_start();
    error_log(print_r(get_the_ID(), true));
    /*
    if (is_singular('landing-page')) {
        $_SESSION['landing_page_id'] = get_the_ID();
    } else {
        unset($_SESSION['landing_page_id']);
        error_log(print_r('================> Did I unset it?', true));
    }
    */

    if ( is_singular('landing-page') ) {      
        $_SESSION['landing_page_id'] = get_the_ID();
    } else if ( is_home() || is_front_page() ) {
        // Code for single blog post
        unset($_SESSION['landing_page_id']);
    } else {
        // unset($_SESSION['landing_page_id']);
        // error_log(print_r('ID -------------------------------------------------------> ' . get_the_ID(), true));
        // error_log(print_r('======================================================> Did I unset it?', true));
    }


    // error_log(print_r('================> landing_page_id:', true));
    // error_log(print_r($_SESSION, true));    


}

/**
 * Get comments and the comment form for a specific post ID as a string.
 *
 * @param int $post_id The post ID for which to retrieve comments and the comment form.
 * @return string The HTML output containing comments and the comment form.
 */
function get_comments_html_for_post($post_id) {
    global $post;
    $post = get_post($post_id);  // Fetch the post by ID

    if ($post) {
        // Set up postdata for compatibility with comment template functions
        setup_postdata($post);

        // Start output buffering
        ob_start();

        // Load the comments template, which will display comments and the comment form
        comments_template();

        // Get the contents of the buffer and end buffering
        $comments_html = ob_get_clean();

        // Reset postdata after we're done
        wp_reset_postdata();

        return $comments_html;
    } else {
        return 'Invalid post ID.';
    }
}
// need this to display faq on landing pages
function init_order_faq() {
    // Global variable to store the data
    global $faqOrder;
    $faqOrder = 0;
}
add_action('wp', 'init_order_faq');  // 'wp' hook occurs before the template is loaded


add_action('wp_footer', 'add_product_id_to_body_and_script');
function add_product_id_to_body_and_script() {
    if (is_single() && 'post' == get_post_type()) {       
        $product_id = get_field('product')[0];
        if ($product_id) {
            ?>
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    document.body.setAttribute("data-product", "<?php echo esc_attr($product_id); ?>");
});
</script>
<?php
        }
    }
}
// add_action('wp_footer', 'add_to_cart_link');
function add_to_cart_link() {
    echo '<div id="foocart"><a class="uwcc-open-cart-546612" href="#">Dodaj u košaricu</a></div>';
}
function add_mobile_body_class($classes) {
    if (wp_is_mobile()) {
        $classes[] = 'is_mobile';
    } else {
        $classes[] = 'is_not_mobile';
    }
    return $classes;
}
add_filter('body_class', 'add_mobile_body_class');
/*
function mobileMenu () {
    if (!is_singular('landing-page') && !is_checkout()) {
        echo '<div class="mobileMenu">';
        echo '<div class="mobileMenuInner grid">';
        echo '<div class="col">';
        echo '<a id="mmHome" class="mmitem" href="/"><svg xmlns="http://www.w3.org/2000/svg" id="a" width="60" height="20" viewBox="0 0 60 60"><path d="M45.41,59.06H14.85c-4.7,0-8.51-3.81-8.51-8.51v-19.34c0-.44.35-.79.79-.79s.79.35.79.79v18.55c0,4.26,3.46,7.72,7.72,7.72h28.98c4.26,0,7.72-3.46,7.72-7.72v-18.55c0-.44.35-.79.79-.79s.79.35.79.79v19.34c0,4.7-3.81,8.51-8.51,8.51Z" fill="#111"></path><path d="M58.5,32.25c-.18,0-.36-.08-.5-.23L32.65,4.05c-1.44-1.59-3.85-1.59-5.3,0L2,32.02c-.29.32-.75.31-1.02-.03-.28-.33-.27-.86.02-1.18L26.85,2.29c1.73-1.91,4.57-1.91,6.3,0l25.86,28.52c.29.32.3.85.02,1.18-.14.17-.33.26-.52.26Z" fill="#111"></path></svg></a>';
        echo '</div>'; // col
        echo '<div class="col">';
        echo '<a id="mmMenu" class="mmitem" href="#"><svg xmlns="http://www.w3.org/2000/svg" id="a" width="60" height="20" viewBox="0 0 60 60"><path d="M4.11,7c-.55,0-1,.45-1,1s.45,1,1,1h52.03c.55,0,1-.45,1-1s-.45-1-1-1H4.11" fill="#111"></path><line x1="3.98" y1="30" x2="56.02" y2="30" fill="#111" stroke="#111" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line><path d="M4.11,51c-.55,0-1,.45-1,1s.45,1,1,1h52.03c.55,0,1-.45,1-1s-.45-1-1-1H4.11" fill="#111"></path></svg></a>';
        echo '</div>'; // col
        echo '<div class="col">';
        echo '<a id="mmCart" class="mmitem" href="#"><svg xmlns="http://www.w3.org/2000/svg" id="a" width="60" height="20" viewBox="0 0 60 60"><path d="M58.71,50.23l-3.57-32.11c-.34-3.02-2.88-5.3-5.92-5.3h-3.07c-.29,0-.52.24-.52.53v.96c.01.28.25.51.53.51h3.04c2.03,0,3.73,1.52,3.96,3.54l3.56,32.02c.07.66.08,1.34-.05,1.99-.66,3.23-3.41,5.26-6.37,5.26H9.78c-.67,0-1.34-.07-1.97-.28-3.13-1.02-4.85-3.97-4.52-6.91l3.57-32.09c.22-2.02,1.92-3.54,3.96-3.54h30.88c.29,0,.52-.23.52-.52v-.96c0-.29-.23-.52-.52-.52H10.8c-3.05,0-5.6,2.29-5.94,5.32L1.3,50.2c-.09.8-.1,1.61.05,2.4.81,4.31,4.45,7.03,8.36,7.03h40.56c.8,0,1.61-.08,2.38-.32,4.19-1.29,6.49-5.2,6.06-9.09Z" fill="#111"></path><path d="M41.88,14.82h-23.76c-.18,0-.33-.15-.33-.33v-1.78c0-5.59,3.7-10.63,9.13-11.97,8.05-1.98,15.28,4.1,15.28,11.83v1.92c0,.18-.15.33-.33.33ZM19.8,12.82h20.08c.18,0,.33-.15.33-.33h0c0-4.06-2.37-7.86-6.16-9.34-7.3-2.85-14.25,2.49-14.25,9.42v.24Z" fill="#111"></path></svg></a>';
        echo '</div>'; // col
        echo '<div class="col">';
        echo '<a id="mmUser" class="mmitem" href="/contul-meu/"><svg xmlns="http://www.w3.org/2000/svg" id="account_svg" width="60" height="20" viewBox="0 0 60 60"><path d="M30,32.48c-8.85,0-16.06-7.2-16.06-16.06S21.15.37,30,.37s16.06,7.2,16.06,16.06-7.2,16.06-16.06,16.06ZM30,1.62c-8.17,0-14.81,6.64-14.81,14.81s6.64,14.81,14.81,14.81,14.81-6.64,14.81-14.81S38.17,1.62,30,1.62Z" fill="#000000"></path><path d="M58.96,59.63c-.37,0-.67-.34-.67-.77v-9.47c0-7.41-5.27-13.44-11.74-13.44H13.45c-6.47,0-11.74,6.03-11.74,13.44v9.47c0,.42-.3.77-.67.77s-.67-.34-.67-.77v-9.47c0-8.26,5.87-14.97,13.08-14.97h33.1c7.21,0,13.08,6.72,13.08,14.97v9.47c0,.42-.3.77-.67.77Z" fill="#000000"></path></svg></a>';
        echo '</div>'; // col
        echo '</div>'; // mobileMenuInner
        echo '</div>'; // mobileMenu
    }
}
add_action('wp_footer', 'mobileMenu');
*/
// function display_product_subcategories($category_id) {
//     $category = get_term($category_id, 'product_cat');

//     if (!$category) {
//         return '<p>Category not found.</p>';
//     }

//     // Initialize the variable
//     $current_category = null;  
//     // $current_category = '';
//     if (is_product_category()) {
//         $current_category = get_queried_object_id();
//     }

//     // error_log(print_r($current_category, true));

//     $output = '<ul>';

//     // Print the current category
//     $category_link = get_term_link($category_id, 'product_cat');
//     $thumbnail_id = get_term_meta($category_id, 'thumbnail_id', true);
//     $image_url = wp_get_attachment_url($thumbnail_id);
  
//     // Check if the category matches the current category
//     $class = '';
//     if ($current_category == $category_id) {
//         $class = ' current_cat';
//     }

//     $output .= '<li class="catid-' . $category_id . $class . '">';
//     $output .= '<a href="' . esc_url($category_link) . '">';

//     if ($image_url) {
//         $output .= '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($category->name) . '">';
//     }

//     // Get the subcategories of the given category ID
//     $subcategories = get_terms(array(
//         'taxonomy'   => 'product_cat',
//         'parent'     => $category_id,
//         'hide_empty' => false
//     ));    

//     $output .= esc_html($category->name);
//     if (!empty($subcategories)) {
//         $output .= '<span class="carot"><img src="' . plugin_dir_url(__FILE__) . '..//assets/arrownat.svg" /></span>';
//     }
//     $output .= '</a>';

//     // Check if there are subcategories before printing the <ul> and carot
//     if (!empty($subcategories)) {
//         $output .= '<ul>';

//         foreach ($subcategories as $subcategory) {
//             $output .= display_product_subcategories_item($subcategory, $current_category);
//         }

//         $output .= '</ul>';
//     }

//     $output .= '</li>';
//     $output .= '</ul>';

//     return $output;
// }


// function display_product_subcategories_item($subcategory, $current_category) {
//     $subcategory_link = get_term_link($subcategory->term_id, 'product_cat');
//     $thumbnail_id = get_term_meta($subcategory->term_id, 'thumbnail_id', true);
//     $image_url = wp_get_attachment_url($thumbnail_id);

//     // Check if the subcategory matches the current category
//     $class = '';
//     if ($current_category == $subcategory->term_id) {
//         $class = ' current_cat';
//     }    

//     $output = '<li class="catid-' . $subcategory->term_id . $class . '">';
//     $output .= '<a href="' . esc_url($subcategory_link) . '">';

//     // Get the subcategories of the current subcategory
//     $sub_subcategories = get_terms(array(
//         'taxonomy'   => 'product_cat',
//         'parent'     => $subcategory->term_id,
//         'hide_empty' => false
//     ));

//     $output .= esc_html($subcategory->name);
//     if (!empty($sub_subcategories)) {
//         $output .= '<span class="carot"><img src="' . plugin_dir_url(__FILE__) . '..//assets/arrownat.svg" /></span>';
//     }
//     $output .= '</a>';

//     // Check if there are sub-subcategories before printing the <ul> and carot
//     if (!empty($sub_subcategories)) {
//         $output .= '<span class="carot"><img src="' . plugin_dir_url(__FILE__) . '..//assets/arrownat.svg" /></span>';
//         $output .= '<ul>';

//         foreach ($sub_subcategories as $sub_subcategory) {
//             $output .= display_product_subcategories_item($sub_subcategory, $current_category); // Pass both arguments
//         }

//         $output .= '</ul>';
//     }

//     $output .= '</li>';

//     return $output;
// }

// // Function to get category thumbnail
// function get_category_thumbnail($category_id) {
//     // Get the category thumbnail URL from the custom field
//     $thumbnail_id = get_term_meta($category_id, 'thumbnail_id', true);

//     $thumbnail_url = wp_get_attachment_url($thumbnail_id);

//     // If the URL is not empty, return the image tag
//     if (!empty($thumbnail_url)) {
//         return '<img src="' . esc_url($thumbnail_url) . '" alt="Category Thumbnail">';
//     }

//     // Return a placeholder or null if no thumbnail is set
//     return '<img src="/wp-content/uploads/2024/03/Vitamini-po-tezavah_koza.svg" alt="Placeholder Thumbnail">';
// }

// class My_Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
//     // Start the element output
//     function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
//         $indent = ($depth) ? str_repeat("\t", $depth) : '';

//         $classes = empty($item->classes) ? array() : (array) $item->classes;
//         $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
//         $class_names = ' class="' . esc_attr($class_names) . '"';

//         $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $class_names .'>';

//         $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
//         $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
//         $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
//         $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

//         // Define icons based on item ID
//         $icon = '';
//         switch ($item->ID) {
//             case 564471: // Example item ID
//                 $icon = get_category_thumbnail(18);
//                 break;
//             case 564473: // Another item ID
//                 $icon = get_category_thumbnail(34);
//                 break;
//             case 564472: // Another item ID
//                 $icon = get_category_thumbnail(23);
//                 break;
//             case 564474: // Another item ID
//                 $icon = get_category_thumbnail(89);
//                 break; 
//             case 564475: // Another item ID
//                 $icon = get_category_thumbnail(21);
//                 break; 
//             case 601159: // Another item ID
//                 $icon = get_category_thumbnail(21);
//                 break;                 
//             case 564476: // Another item ID
//                 $icon = '<img src="/wp-content/uploads/2024/03/blog-icon.svg" alt="Category Thumbnail">';
//                 break;                                                                     
//             // Add more cases as needed
//             default:
//                 break;
//         }

//         $item_output = $args->before;
//         $item_output .= '<a'. $attributes .'>';
//         $item_output .= '<span class="icon">' . $icon . '</span>'; // Append the icon here        
//         $item_output .= '<span class="catname">' . $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after . '</span>';
//         $item_output .= '<span class="carot"><img src="' . plugin_dir_url(__FILE__) . '..//assets/arrownat.svg" /></span></a>';
//         $item_output .= $args->after;

//         $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
//     }

//     // End the element output
//     function end_el(&$output, $item, $depth = 0, $args = array()) {
//         // Check if the current menu item ID matches the specific ID you want to target
    
//         if ($item->ID == 623602) {
//             // Add the <div> with content before the closing </li> tag
//             $output .= '<div class="submegamenu vitamini">';
//             $output .= '<div class="container">';
//             $output .= '<div class="grid">';
//             $output .= '<div class="col-5_sm-12 subHolder">';
//             // $output .= '<div class="grid">';
//             $output .= '<div class="grid-3_sm-1">';
            
//             $output .= '<div class="col menucolumn">';
//             $output .= display_product_subcategories(1864);
//             $output .= '</div>'; // col
//             $output .= '<div class="col menucolumn">';
//             $output .= display_product_subcategories(1866);
//             $output .= display_product_subcategories(1911);
//             $output .= '</div>'; // col 
//             $output .= '<div class="col menucolumn">';
//             $output .= display_product_subcategories(1918);
//             $output .= display_product_subcategories(1979);
//             $output .= display_product_subcategories(1882);
														  
														  
//             $output .= '</div>'; // col 

//             $output .= '</div>'; // grid
//             // $output .= '</div>'; // grid
            
//             $output .= '</div>'; // container

//             $output .= '<div id="vitamins_subslide" class="col-7_sm-12 subSlide">';
//             // $output .= do_shortcode('[elementor-template id="564623"]');
//             $output .= '</div>'; // container    

//             $output .= '</div>'; // grid            
//             $output .= '</div>'; // container
//             $output .= '</div>';
//         }
//         if ($item->ID == 623603) {
//             // Add the <div> with content before the closing </li> tag
//             $output .= '<div class="submegamenu sport">';
//             $output .= '<div class="container">';
//             $output .= '<div class="grid">';
//             $output .= '<div class="col-6_sm-12 subHolder">';
            
//             // $output .= '<div class="grid">';
//             $output .= '<div class="grid-4_sm-1">';
            
//             $output .= '<div class="col menucolumn">';
//             $output .= display_product_subcategories(1889);
//             $output .= '</div>'; // col
//             $output .= '<div class="col menucolumn">';
//             $output .= display_product_subcategories(1860);
//             $output .= '</div>'; // col 
//             $output .= '<div class="col menucolumn">';
//             $output .= display_product_subcategories(1924);
//             $output .= '</div>'; // col 
//             $output .= '<div class="col menucolumn">';
//             $output .= display_product_subcategories(1967);
//             $output .= display_product_subcategories(1907);
//             $output .= display_product_subcategories(1975);
//             $output .= display_product_subcategories(1909);
//             $output .= display_product_subcategories(1901);
//             $output .= display_product_subcategories(1988);
//             $output .= display_product_subcategories(1989);  
//             $output .= display_product_subcategories(1860);													 
//             $output .= '</div>'; // col

//             $output .= '</div>'; // col
//             // $output .= '</div>'; // grid

//             $output .= '</div>'; // container 

//             $output .= '<div id="sport_subslide" class="col-6_sm-12 subSlide">';
//             // $output .= do_shortcode('[elementor-template id="564644"]');
//             $output .= '</div>'; // container                     

//             $output .= '</div>'; // grid            
//             $output .= '</div>'; // container
//             $output .= '</div>';
//         }  
//         if ($item->ID == 623604) {
//             // Add the <div> with content before the closing </li> tag
//             $output .= '<div class="submegamenu sport">';
//             $output .= '<div class="container">';
//             $output .= '<div class="grid">';
//             $output .= '<div class="col-3_sm-12 subHolder">';
            
//             // $output .= '<div class="grid">';
//             $output .= '<div class="grid-2_sm-1">';
            
//             $output .= '<div class="col menucolumn">';
//             $output .= display_product_subcategories(1949);
//             $output .= '</div>'; // col             
//             $output .= '<div class="col menucolumn">';
//             $output .= display_product_subcategories(1880);
//             $output .= display_product_subcategories(1958);
//             $output .= display_product_subcategories(1980);
//             $output .= display_product_subcategories(1970);
//             $output .= display_product_subcategories(1963);            
//             $output .= '</div>'; // col

//             $output .= '</div>'; // col
//             // $output .= '</div>'; // grid

//             $output .= '</div>'; // container 

//             $output .= '<div id="hujsanje_subslide" class="col-9_sm-12 subSlide">';
//             // $output .= do_shortcode('[elementor-template id="565731"]');
//             $output .= '</div>'; // container                     

//             $output .= '</div>'; // grid            
//             $output .= '</div>'; // container
//             $output .= '</div>';
//         }
//         if ($item->ID == 623605) {
//             // Add the <div> with content before the closing </li> tag
//             $output .= '<div class="submegamenu sport">';
//             $output .= '<div class="container">';
//             $output .= '<div class="grid">';
//             $output .= '<div class="col-3_sm-12 subHolder">';
            
//             // $output .= '<div class="grid">';
//             $output .= '<div class="grid-2_sm-1">';
            
//             $output .= '<div class="col menucolumn">';
//             $output .= display_product_subcategories(1933);
//             $output .= display_product_subcategories(1913);
//             $output .= '</div>'; // col
//             $output .= '<div class="col menucolumn">';
//             $output .= display_product_subcategories(1940);
//             $output .= display_product_subcategories(1905);
//             $output .= display_product_subcategories(1962);
//             $output .= display_product_subcategories(1972);
//             $output .= display_product_subcategories(1944);
//             $output .= display_product_subcategories(1935);
//             $output .= display_product_subcategories(1906);
//             $output .= display_product_subcategories(1983);
//             $output .= '</div>'; // col

//             $output .= '</div>'; // col
//             // $output .= '</div>'; // grid

//             $output .= '</div>'; // container 

//             $output .= '<div id="lepota_subslide" class="col-9_sm-12 subSlide">';
//             // $output .= do_shortcode('[elementor-template id="565741"]');
//             $output .= '</div>'; // container                     

//             $output .= '</div>'; // grid            
//             $output .= '</div>'; // container
//             $output .= '</div>';
//         }
//         $ids_to_check = [623606, 629801, 628513];
//         if (in_array($item->ID, $ids_to_check)) {
//             // Add the <div> with content before the closing </li> tag
//             $output .= '<div class="submegamenu sport">';
//             $output .= '<div class="container">';
//             $output .= '<div class="grid">';
//             $output .= '<div class="col-2_sm-12 subHolder">';
            
//             // $output .= '<div class="grid">';
//             $output .= '<div class="grid-1_sm-1 subSlide">';
            
//             $output .= '<div class="col menucolumn">';
//             $output .= display_product_subcategories(1936);
//             $output .= display_product_subcategories(1884);
//             $output .= display_product_subcategories(1951);
//             $output .= display_product_subcategories(1885);
//             $output .= display_product_subcategories(1968);
//             $output .= display_product_subcategories(1978);
//             $output .= display_product_subcategories(1969);
//             $output .= display_product_subcategories(1879);
//             $output .= '</div>'; // col

//             $output .= '</div>'; // col
//             // $output .= '</div>'; // grid

//             $output .= '</div>'; // container 

//             $output .= '<div id="razstrupljanje_subslide" class="col-10_sm-12">';
//             // $output .= do_shortcode('[elementor-template id="565749"]');
//             $output .= '</div>'; // container                     

//             $output .= '</div>'; // grid            
//             $output .= '</div>'; // container
//             $output .= '</div>';
//         }                                
//         $output .= "</li>\n";
//     }
// }

// Adding custom responsive controll for elementor to print or not element depending on device
add_action('elementor/element/after_section_end', function($element, $section_id, $args) {
    // Check if we are in the advanced > responsive section

    if ('_section_responsive' !== $section_id) {
        return;
    }

    // Check if the element is a widget
    if ('widget' !== $element->get_type()) {
        return;
    }    

    $element->start_controls_section(
        'custom_responsive_controls',
        [
            'label' => __('Custom Responsive Controls', 'plugin-name'),
            'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
        ]
    );

    $element->add_control(
        'render_on_mobile',
        [
            'label' => __('Render on mobile only', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'plugin-name'),
            'label_off' => __('No', 'plugin-name'),
            'return_value' => 'yes',
            'default' => 'no',
        ]
    );

    $element->add_control(
        'render_on_desktop',
        [
            'label' => __('Render on desktop only', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'plugin-name'),
            'label_off' => __('No', 'plugin-name'),
            'return_value' => 'yes',
            'default' => 'no',
        ]
    );

    $element->end_controls_section();
}, 10, 3);

// this remove widget on frontend depend on custom responsive settings.
add_filter('elementor/widget/render_content', function($content, $widget) {
    // Check if we are in the Elementor editor

    if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
        return $content;
    }

    $settings = $widget->get_settings_for_display();

    $render_on_mobile = isset($settings['render_on_mobile']) ? $settings['render_on_mobile'] : 'no';
    $render_on_desktop = isset($settings['render_on_desktop']) ? $settings['render_on_desktop'] : 'no';

    if (wp_is_mobile() && $render_on_desktop === 'yes') {
        return ''; // Don't render on mobile if "Render on desktop only" is enabled
    }

    if (!wp_is_mobile() && $render_on_mobile === 'yes') {
        return ''; // Don't render on desktop if "Render on mobile only" is enabled
    }

    return $content;
}, 10, 2);

function register_hidden_template_status() {
    register_post_status('hidden_template', array(
        'label'                     => _x('Hidden Template', 'post'),
        'public'                    => false,
        'exclude_from_search'       => true,
        'show_in_admin_all_list'    => false,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop('Hidden Template <span class="count">(%s)</span>', 'Hidden Templates <span class="count">(%s)</span>'),
    ));
}
add_action('init', 'register_hidden_template_status');

function exclude_hidden_templates($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('elementor_library')) {
        $meta_query = $query->get('meta_query');
        if (empty($meta_query)) {
            $meta_query = array();
        }
        $meta_query[] = array(
            'key' => '_wp_trash_meta_status',
            'compare' => 'NOT EXISTS',
        );
        $query->set('meta_query', $meta_query);
    }
}
add_action('pre_get_posts', 'exclude_hidden_templates');


add_filter( 'woocommerce_checkout_fields' , 'edit_checkout_fields' );
function edit_checkout_fields( $fields ) {
    unset($fields['billing']['billing_state']);
}

/* star sekret
function add_custom_css_to_header() {  
    if (is_product()) {
        $custom_colors = get_field('custom_colors');
        $primary = $custom_colors['primary_color'];
        $secondary = $custom_colors['secondary_color'];

        if ($primary['alpha'] == 1) {
            $primary['alpha'] = 0.1019607843;
        }
        if ($secondary['alpha'] == 1) {
            $secondary['alpha'] = 0.1019607843;
        }        

        if (!empty($custom_colors)) {
            echo '<style>
            body.custom-colors {
                --theme-primary: rgb(' . $primary['red'] . ', ' . $primary['green'] . ', ' . $primary['blue'] . ');
                --theme-primary-transparent: rgba(' . $primary['red'] . ', ' . $primary['green'] . ', ' . $primary['blue'] . ', ' . $primary['alpha'] . ');
                --theme-secondary: rgb(' . $secondary['red'] . ', ' . $secondary['green'] . ', ' . $secondary['blue'] . ');
                --theme-secondary-transparent: rgba(' . $primary['red'] . ', ' . $primary['green'] . ', ' . $primary['blue'] . ', ' . $primary['alpha'] . ');
            }            
            </style>';
        }
    }
    if (get_post_type($post) == 'landing-page') {                      
        $theme = get_field('color_theme');
        if ($theme == 'default') {
            $refproduct = get_field('selected_product');
            $custom_colors = get_field('custom_colors', $refproduct[0]);
            $primary = $custom_colors['primary_color'];
            $secondary = $custom_colors['secondary_color'];
    
            if ($primary['alpha'] == 1) {
                $primary['alpha'] = 0.1019607843;
            }
            if ($secondary['alpha'] == 1) {
                $secondary['alpha'] = 0.1019607843;
            }        
    
            if (!empty($custom_colors)) {
                echo '<style>
                body.custom-colors {
                    --theme-primary: rgb(' . $primary['red'] . ', ' . $primary['green'] . ', ' . $primary['blue'] . ');
                    --theme-primary-transparent: rgba(' . $primary['red'] . ', ' . $primary['green'] . ', ' . $primary['blue'] . ', ' . $primary['alpha'] . ');
                    --theme-secondary: rgb(' . $secondary['red'] . ', ' . $secondary['green'] . ', ' . $secondary['blue'] . ');
                    --theme-secondary-transparent: rgba(' . $primary['red'] . ', ' . $primary['green'] . ', ' . $primary['blue'] . ', ' . $primary['alpha'] . ');
                }            
                </style>';
            }
        } else if ($theme == 'custom-colors') {
            $custom_colors = get_field('custom_colors');
            $primary = $custom_colors['primary_color'];
            $secondary = $custom_colors['secondary_color'];
    
            if ($primary['alpha'] == 1) {
                $primary['alpha'] = 0.1019607843;
            }
            if ($secondary['alpha'] == 1) {
                $secondary['alpha'] = 0.1019607843;
            }        
    
            if (!empty($custom_colors)) {
                echo '<style>
                body.custom-colors {
                    --theme-primary: rgb(' . $primary['red'] . ', ' . $primary['green'] . ', ' . $primary['blue'] . ');
                    --theme-primary-transparent: rgba(' . $primary['red'] . ', ' . $primary['green'] . ', ' . $primary['blue'] . ', ' . $primary['alpha'] . ');
                    --theme-secondary: rgb(' . $secondary['red'] . ', ' . $secondary['green'] . ', ' . $secondary['blue'] . ');
                    --theme-secondary-transparent: rgba(' . $primary['red'] . ', ' . $primary['green'] . ', ' . $primary['blue'] . ', ' . $primary['alpha'] . ');
                }            
                </style>';
            }
        }
    }    
}
add_action('wp_head', 'add_custom_css_to_header'); 
*/

function add_custom_css_to_header() {
    global $post;

    // Helper function to generate the CSS
    function generate_custom_css($primary, $secondary) {
        if ($primary['alpha'] == 1) {
            $primary['alpha'] = 0.1019607843;
        }
        if ($secondary['alpha'] == 1) {
            $secondary['alpha'] = 0.1019607843;
        }

        return '<style>
            body.custom-colors {
                --theme-primary: rgb(' . $primary['red'] . ', ' . $primary['green'] . ', ' . $primary['blue'] . ');
                --theme-primary-transparent: rgba(' . $primary['red'] . ', ' . $primary['green'] . ', ' . $primary['blue'] . ', ' . $primary['alpha'] . ');
                --theme-secondary: rgb(' . $secondary['red'] . ', ' . $secondary['green'] . ', ' . $secondary['blue'] . ');
                --theme-secondary-transparent: rgba(' . $secondary['red'] . ', ' . $secondary['green'] . ', ' . $secondary['blue'] . ', ' . $secondary['alpha'] . ');
            }
        </style>';
    }

    if (is_product()) {
        $custom_colors = get_field('custom_colors');
        if (!empty($custom_colors)) {
            echo generate_custom_css($custom_colors['primary_color'], $custom_colors['secondary_color']);
        }
    }

    if (get_post_type($post) == 'landing-page') {
        $theme = get_field('color_theme');

        if ($theme == 'default') {
            $refproduct = get_field('selected_product');
            $custom_colors = get_field('custom_colors', $refproduct[0]);
        } elseif ($theme == 'custom-colors') {
            $custom_colors = get_field('custom_colors');
        }

        if (!empty($custom_colors)) {
            echo generate_custom_css($custom_colors['primary_color'], $custom_colors['secondary_color']);
        }
    }
}
add_action('wp_head', 'add_custom_css_to_header');



function getDiscountedPrice($price, $discount_percent) {
    // Ensure price and discount_percent are valid numbers
    /*
    if (!is_numeric($price) || !is_numeric($discount_percent)) {
        throw new InvalidArgumentException("Both price and discount_percent must be numbers.");
    }
    */

    // Convert to float to handle decimal values correctly
    $price = floatval($price);
    $discount_percent = floatval($discount_percent);

    // Calculate the discounted price
    $discounted_price = $price - ($price * $discount_percent / 100);

    // Round to the nearest lower tenth decimal
    $integer_part = floor($discounted_price);
    $fractional_part = $discounted_price - $integer_part;

    // Find the closest lower decimal value like .09, .19, .29, etc.
    $closest_lower = floor($fractional_part * 10) / 10;
    $rounded_price = $integer_part + $closest_lower + 0.09;

    return number_format($rounded_price, 2, '.', '');
}

add_action('woocommerce_admin_order_item_headers', 'add_custom_meta_column_header');

function add_custom_meta_column_header() {
    echo '<th class="custom-meta-column">' . __('Custom Meta', 'text-domain') . '</th>';
}
// Add SKU after product title in ACF relationship field
function my_acf_relationship_result( $title, $post, $field, $post_id ) {
    // Get the SKU
    $sku = get_post_meta($post->ID, '_sku', true);

    // Append SKU to title
    if ($sku) {
        $title .= ' (' . $sku . ')';
    }

    return $title;
}
add_filter('acf/fields/relationship/result', 'my_acf_relationship_result', 10, 4);

// Override WooCommerce product image template
function override_woocommerce_templates($template, $template_name, $template_path) {
    if ($template_name === 'single-product/product-image.php') {
        $plugin_path = plugin_dir_path(__FILE__) . 'templates/product-image.php';
        return $plugin_path;
    }
    if ($template_name === 'order/order-details-item.php') {
        $plugin_path = plugin_dir_path(__FILE__) . 'templates/order-details-item.php';
        return $plugin_path;
    }  
    /*
    if ($template_name === 'loop/add-to-cart.php') {
        $plugin_path = plugin_dir_path(__FILE__) . 'templates/add-to-cart.php';
        return $plugin_path;
    } 
    */      
    return $template;
}
add_filter('woocommerce_locate_template', 'override_woocommerce_templates', 10, 3);

// Override WooCommerce email templates
function override_woocommerce_email_templates($template, $template_name, $template_path) {
    // Define the custom template path
    $plugin_path = plugin_dir_path(__FILE__) . 'templates/';

    // List of templates you want to override
    $custom_templates = [
        'emails/customer-on-hold-order.php',
        'emails/customer-processing-order.php',
        'emails/email-header.php',
        'emails/email-order-details.php',
        'emails/email-order-items.php',
        'emails/email-customer-details.php',
        'emails/email-addresses.php',
        // 'emails/trusted_reviews_invite.php',
        // 'emails/email_reviews_invite.php',
        'emails/email_product_reviews_invite.php',
        'emails/email-footer.php',
    ];

    // Check for the specific template and override it if it exists in the plugin
    if (in_array($template_name, $custom_templates)) {
        $custom_template = $plugin_path . $template_name;
        error_log("Checking custom template: " . $custom_template);
        if (file_exists($custom_template)) {
            error_log("Using custom template: " . $custom_template);
            return $custom_template;
        }
    }
    
    return $template;
}
add_filter('woocommerce_locate_template', 'override_woocommerce_email_templates', 10, 3);

// Pass $order to custom template:
add_action('woocommerce_email_order_details', 'add_order_to_template', 10, 4);

function add_order_to_template($order, $sent_to_admin, $plain_text, $email) {
    wc_get_template(
        'emails/trusted_reviews_invite.php',
        array(
            'order' => $order,
        )
    );
}


// Add this code to your theme's functions.php file or your custom plugin

add_filter('woocommerce_account_menu_items', 'remove_my_account_downloads_link');

function remove_my_account_downloads_link($menu_links) {
    unset($menu_links['downloads']); // Remove the downloads link
    return $menu_links;
}

// Add new tab to WooCommerce settings
add_filter('woocommerce_settings_tabs_array', 'custom_additional_fees_settings_tab', 50);

function custom_additional_fees_settings_tab($settings_tabs) {
    $settings_tabs['additional_fees'] = __('Additional Fees', 'nutrisslim-suiteV2');
    return $settings_tabs;
}

// Add settings for the new tab
add_action('woocommerce_settings_additional_fees', 'custom_additional_fees_settings');

function custom_additional_fees_settings() {
    woocommerce_admin_fields(custom_get_additional_fees_settings());
}

function custom_get_additional_fees_settings() {
    // Additional Fees Section
    $additional_fees_settings = array(
        'section_title' => array(
            'name'     => __('Additional Fees Settings', 'nutrisslim-suiteV2'),
            'type'     => 'title',
            'desc'     => '',
            'id'       => 'custom_additional_fees_section_title'
        ),

        // Priority delivery fee
        'priority_delivery' => array(
            'name' => __('Livrare prioritarăy', 'nutrisslim-suiteV2'),
            'type' => 'number',
            'desc' => __('Price for priority delivery.', 'nutrisslim-suiteV2'),
            'id'   => 'priority_delivery_fee',
            'css'  => 'width:150px;',
            'custom_attributes' => array(
                'step' => '0.01',
                'min' => '0',
            ),
        ),
        'priority_delivery_sifrant' => array(
            'name' => '', // no title to avoid unnecessary label
            'type' => 'text',
            'desc' => __('šifrant for priority delivery.', 'nutrisslim-suiteV2'),
            'id'   => 'priority_delivery_fee_sifrant',
            'css'  => 'width:150px; display: inline-block;',
        ),        
        
        // Eco-friendly packaging fee
        'eco_friendly_packaging' => array(
            'name' => __('Eco-friendly packaging', 'nutrisslim-suiteV2'),
            'type' => 'number',
            'desc' => __('Price for eco-friendly packaging.', 'nutrisslim-suiteV2'),
            'id'   => 'custom_eco_friendly_packaging',
            'css'  => 'width:150px;',
            'custom_attributes' => array(
                'step' => '0.01',
                'min' => '0',
            ),
        ),
        'eco_friendly_packaging_sifrant' => array(
            'name' => '', // no title to avoid unnecessary label
            'type' => 'text',
            'desc' => __('šifrant for eco-friendly packaging.', 'nutrisslim-suiteV2'),
            'id'   => 'custom_eco_friendly_packaging_sifrant',
            'css'  => 'width:150px; display: inline-block;',
        ),
        
        // Package insurance fee
        'package_insurance' => array(
            'name' => __('Asigurare colet', 'nutrisslim-suiteV2'),
            'type' => 'number',
            'desc' => __('Price for package insurance.', 'nutrisslim-suiteV2'),
            'id'   => 'custom_package_insurance',
            'css'  => 'width:150px;',
            'custom_attributes' => array(
                'step' => '0.01',
                'min' => '0',
            ),
        ),
        'package_insurance_sifrant' => array(
            'name' => '', // no title to avoid unnecessary label
            'type' => 'text',
            'desc' => __('šifrant for package insurance.', 'nutrisslim-suiteV2'),
            'id'   => 'custom_package_insurance_sifrant',
            'css'  => 'width:150px; display: inline-block;',
        ),

        // Surprise Box fee
        'surprise_box' => array(
            'name' => __('Surprise Box', 'nutrisslim-suiteV2'),
            'type' => 'number',
            'desc' => __('Price for surprise box.', 'nutrisslim-suiteV2'),
            'id'   => 'custom_surprise_box',
            'css'  => 'width:150px;',
            'custom_attributes' => array(
                'step' => '0.01',
                'min' => '0',
            ),
        ),
        'surprise_box_sifrant' => array(
            'name' => '', // no title to avoid unnecessary label
            'type' => 'text',
            'desc' => __('šifrant for surprise box.', 'nutrisslim-suiteV2'),
            'id'   => 'custom_surprise_box_sifrant',
            'css'  => 'width:150px; display: inline-block;',
        ),
        
        // Surprise Box value min and max
        'surprise_box_value_min' => array(
            'name' => __('Surprise Box Value (Min)', 'nutrisslim-suiteV2'),
            'type' => 'number',
            'desc' => __('Minimum value for surprise box.', 'nutrisslim-suiteV2'),
            'id'   => 'custom_surprise_box_value_min',
            'css'  => 'width:70px; display: inline-block; margin-right: 10px;',
            'custom_attributes' => array(
                'step' => '0.01',
                'min' => '0',
            ),
        ),
        'surprise_box_value_max' => array(
            'name' => __('Surprise Box Value (Max)', 'nutrisslim-suiteV2'),
            'type' => 'number',
            'desc' => __('Maximum value for surprise box.', 'nutrisslim-suiteV2'),
            'id'   => 'custom_surprise_box_value_max',
            'css'  => 'width:70px; display: inline-block;',
            'custom_attributes' => array(
                'step' => '0.01',
                'min' => '0',
            ),
        ),
        
        'section_end' => array(
            'type' => 'sectionend',
            'id' => 'custom_additional_fees_section_end'
        ),
    );
    
    // Shipping Methods Section
    $shipping_methods_settings = array(
        'shipping_methods_title' => array(
            'name'     => __('Shipping Methods from Zones', 'nutrisslim-suiteV2'),
            'type'     => 'title',
            'desc'     => '',
            'id'       => 'custom_shipping_methods_section_title'
        ),
    );

    // Get all shipping zones
    $shipping_zones = WC_Shipping_Zones::get_zones();
    
    foreach ($shipping_zones as $zone) {
    // Add the zone name as a title
    $shipping_methods_settings['shipping_zone_' . $zone['zone_id']] = array(
        'name' => esc_html($zone['zone_name']),
        'type' => 'title',
        'id'   => 'shipping_zone_' . $zone['zone_id'],
    );

    // Get shipping methods for this zone
    $shipping_methods = $zone['shipping_methods'];

    // Loop through each shipping method and display only enabled ones
    foreach ($shipping_methods as $method) {
        if ($method->enabled == 'yes') {
            // Use the instance ID to get the correct method settings for this instance
            $method_instance_id = $method->instance_id;

            // Retrieve the shipping method instance settings using the instance_id
            $method_settings = get_option('woocommerce_' . $method->id . '_' . $method_instance_id . '_settings', []);

            // Get the delivery type if it exists for this shipping method in the zone
            $delivery_type = isset($method_settings['delivery_type']) ? $method_settings['delivery_type'] : '';

            // Generate a unique ID for the sifrant input field for each shipping method
            $sifrant_field_id = 'custom_shipping_method_sifrant_' . $method_instance_id;

            // Retrieve the stored "šifrant" value (if already saved)
            $sifrant_value = get_option($sifrant_field_id, '');

            // Add shipping method title and delivery type
           /* $shipping_methods_settings['shipping_method_' . $method_instance_id] = array(
                'name' => esc_html($method->get_title()) . (!empty($delivery_type) ? ' - ' . __('Delivery Type: ', 'nutrisslim-suiteV2') . esc_html($delivery_type) : ''),
                'type' => 'title',
                'id'   => 'shipping_method_' . $method_instance_id,
            );*/
			
			$imebemtisunac = $delivery_type;
			if(empty($imebemtisunac)){
				$imebemtisunac = $method->get_title();
			}
            // Add the "šifrant" input field
            $shipping_methods_settings['sifrant_' . $method_instance_id] = array(
                'name' => __($imebemtisunac, 'nutrisslim-suiteV2'),
                'type' => 'text',
                'id'   => $sifrant_field_id,
                'css'  => 'width:150px; display: inline-block; margin-left: 10px;',
                'default' => $sifrant_value,
            );
        }
    }

    // Close the section with 'sectionend' to prevent form structure breaking
    $shipping_methods_settings['shipping_zone_end_' . $zone['zone_id']] = array(
        'type' => 'sectionend',
        'id'   => 'shipping_zone_end_' . $zone['zone_id'],
    );
}

    $shipping_methods_settings['section_end'] = array(
        'type' => 'sectionend',
        'id' => 'custom_shipping_methods_section_end'
    );

    // Merge both sections
    $settings = array_merge($additional_fees_settings, $shipping_methods_settings);
    
    return apply_filters('woocommerce_get_settings_additional_fees', $settings);
}


// Save settings for the new tab
add_action('woocommerce_update_options_additional_fees', 'custom_update_additional_fees_settings');

function custom_update_additional_fees_settings() {
    woocommerce_update_options(custom_get_additional_fees_settings());
}

add_action('wp_ajax_toggle_custom_fees', 'toggle_custom_fees');
add_action('wp_ajax_nopriv_toggle_custom_fees', 'toggle_custom_fees');

function toggle_custom_fees() {
    if (isset($_POST['checkbox_states'])) {
        WC()->session->set('checkbox_states', $_POST['checkbox_states']);
    }
    wp_die();
}

add_action('woocommerce_cart_calculate_fees', 'add_custom_fees_to_cart');

function add_custom_fees_to_cart() {
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }
    // Custom Fees
    $eco_friendly_packaging = get_option('custom_eco_friendly_packaging');
    $package_insurance = get_option('custom_package_insurance');
    $surprise_box = get_option('custom_surprise_box');
    $priority_delivery = get_option('priority_delivery_fee');

    
    $checkbox_states = WC()->session->get('checkbox_states');

    $custom_fees = [
        'rf_ekoloska_embalaza' => [
            'label' => __('Eco-friendly Packaging', 'nutrisslim-suiteV2'),
            'amount' => $eco_friendly_packaging
        ],
        'rf_zavarovanje_narocila' => [
            'label' => __('Asigurare colet', 'nutrisslim-suiteV2'),
            'amount' => $package_insurance
        ],
        'rf_izdelek_presenecenja' => [
            'label' => __('Surprise Box', 'nutrisslim-suiteV2'),
            'amount' => $surprise_box
        ],
        'rf_priority_delivery' => [
            'label' => __('Livrare prioritară', 'nutrisslim-suiteV2'),
            'amount' => $priority_delivery
        ]        
        ];  

    foreach ($custom_fees as $key => $fee_data) {
        if (isset($checkbox_states[$key]) && $checkbox_states[$key] === 'on') {
            $fee_inclusive = $fee_data['amount'];
            if ($fee_inclusive && is_numeric($fee_inclusive)) {
                $tax_class = '';
                $tax_rates = WC_Tax::get_rates($tax_class);
                $taxes = WC_Tax::calc_tax($fee_inclusive, $tax_rates, true);
                $tax_amount = array_sum($taxes);
                $fee_exclusive = $fee_inclusive - $tax_amount;

                WC()->cart->add_fee($fee_data['label'], (float) $fee_exclusive, true, $tax_class);
            }
        }
    }    
    /*
    $eco_friendly_packaging = get_option('custom_eco_friendly_packaging');
    $package_insurance = get_option('custom_package_insurance');
    $surprise_box = get_option('custom_surprise_box');    

    $checkbox_states = WC()->session->get('checkbox_states');

    if (isset($checkbox_states['rf_ekoloska_embalaza']) && $checkbox_states['rf_ekoloska_embalaza'] === 'on') {
        $fee = $eco_friendly_packaging; // Set your fee amount here
        WC()->cart->add_fee(__('Eco-friendly Packaging', 'nutrisslim-suiteV2'), $fee);
    }

    if (isset($checkbox_states['rf_zavarovanje_narocila']) && $checkbox_states['rf_zavarovanje_narocila'] === 'on') {
        $fee = $package_insurance; // Set your fee amount here
        WC()->cart->add_fee(__('Package Insurance', 'nutrisslim-suiteV2'), $fee);
    }

    if (isset($checkbox_states['rf_izdelek_presenecenja']) && $checkbox_states['rf_izdelek_presenecenja'] === 'on') {
        $fee = $surprise_box; // Set your fee amount here
        WC()->cart->add_fee(__('Surprise Box', 'nutrisslim-suiteV2'), $fee);
    }
    */
}

// Display Additional Checkout Options
function custom_checkout_additional_options($checkout) {
    // Retrieve saved checkbox states from the session
    $saved_states = WC()->session->get('checkbox_states', []);


    // Example of modifying a checkbox to reflect its session state
    $is_checked_ekoloska = isset($saved_states['rf_ekoloska_embalaza']) && $saved_states['rf_ekoloska_embalaza'] === 'on' ? 'checked' : '';
    $is_checked_ekoloska_bg = isset($saved_states['rf_ekoloska_embalaza']) && $saved_states['rf_ekoloska_embalaza'] === 'on' ? 'background-color: rgb(176, 228, 197)' : '';
    $is_checked_zavarovanje = isset($saved_states['rf_zavarovanje_narocila']) && $saved_states['rf_zavarovanje_narocila'] === 'on' ? 'checked' : '';
    $is_checked_zavarovanje_bg = isset($saved_states['rf_zavarovanje_narocila']) && $saved_states['rf_zavarovanje_narocila'] === 'on' ? 'background-color: rgb(176, 228, 197)' : '';
    $is_checked_presenecenja = isset($saved_states['rf_izdelek_presenecenja']) && $saved_states['rf_izdelek_presenecenja'] === 'on' ? 'checked' : '';
    $is_checked_presenecenja_bg = isset($saved_states['rf_izdelek_presenecenja']) && $saved_states['rf_izdelek_presenecenja'] === 'on' ? 'background-color: rgb(176, 228, 197)' : '';
    $is_priority_delivery = isset($saved_states['rf_priority_delivery']) && $saved_states['rf_priority_delivery'] === 'on' ? 'checked' : '';
    $is_priority_delivery_bg = isset($saved_states['rf_priority_delivery']) && $saved_states['rf_priority_delivery'] === 'on' ? 'background-color: rgb(176, 228, 197)' : '';


    $eco_friendly_packaging = get_option('custom_eco_friendly_packaging');
    $package_insurance = get_option('custom_package_insurance');
    $surprise_box = get_option('custom_surprise_box');
    $priority_delivery = get_option('priority_delivery_fee');



    $surprise_max = get_option('custom_surprise_box_value_max');
    $surprise_min = get_option('custom_surprise_box_value_min');
    $surprise_box_value = sprintf( __('Valued between %s and %s %s.', 'nutrisslim-suiteV2'), $surprise_min, $surprise_max, get_woocommerce_currency_symbol() );

    if (
        ($eco_friendly_packaging || $package_insurance || $surprise_box || $priority_delivery) &&
        !is_page('iframe-checkout')
    ) {   
    ?>

<div id="delivery-option" class="rf-custom-option">
    <h3><?php echo __('Upgradează livrarea ta', 'nutrisslim-suiteV2'); ?></h3>
    <?php if ($eco_friendly_packaging) { ?>
    <div class="delivery-option rf-option-container" style="<?php echo $is_checked_ekoloska_bg; ?>">
        <div class="rf-option-left">
            <div class="rf-radio-container">
                <input type="checkbox" class="rf-custom-checkbox packing" name="rf_ekoloska_embalaza"
                    id="rf_ekoloska_embalaza" <?php echo $is_checked_ekoloska; ?>>
            </div>
            <label for="rf_ekoloska_embalaza">
                <div class="rf-option-title"><?php echo __('Eco-friendly packaging', 'nutrisslim-suiteV2'); ?>
                    (+<?php echo wc_price($eco_friendly_packaging); ?>)</div>
                <div class="rf-option-description">
                    <?php echo __('Receive products in biodegradable, eco-friendly packaging, and join us in protecting nature.', 'nutrisslim-suiteV2'); ?>
                </div>
            </label>
        </div>
        <img src="<?php echo get_nutrislim_assets_url(); ?>Group-604.svg" alt="Option 1" class="rf-option-image">
    </div>
    <?php } if ($priority_delivery) { ?>
    <div class="delivery-option rf-option-container" style="<?php echo $is_priority_delivery_bg; ?>">
        <div class="rf-option-left">
            <input type="checkbox" class="rf-custom-checkbox packing" name="rf_priority_delivery"
                id="rf_priority_delivery" <?php echo $is_priority_delivery; ?>>
            <label for="rf_priority_delivery">
                <div class="rf-option-title"><?php echo __('Sari peste coadă', 'nutrisslim-suiteV2'); ?>
                    (+<?php echo wc_price($priority_delivery); ?>)</div>
                <div class="rf-option-description">
                    <?php echo __('Alege ambalarea cu prioritate pentru expedierea cea mai rapidă. Selectând această opțiune, comanda ta va fi procesată înaintea celorlalte.', 'nutrisslim-suiteV2'); ?>
                </div>
            </label>
        </div>
        <img src="<?php echo get_nutrislim_assets_url(); ?>priority.svg" alt="Option 3" class="rf-option-image">
    </div>
    <?php } if ($package_insurance) { ?>
    <div class="delivery-option rf-option-container" style="<?php echo $is_checked_zavarovanje_bg; ?>">
        <div class="rf-option-left">
            <input type="checkbox" class="rf-custom-checkbox packing" name="rf_zavarovanje_narocila"
                id="rf_zavarovanje_narocila" <?php echo $is_checked_zavarovanje; ?>>
            <label for="rf_zavarovanje_narocila">
                <div class="rf-option-title"><?php echo __('Asigurare colet', 'nutrisslim-suiteV2'); ?>
                    (+<?php echo wc_price($package_insurance); ?>)</div>
                <div class="rf-option-description">
                    <?php echo __('Asigură livrarea coletului și beneficiază de o soluție garantată și gratuită în caz de produse deteriorate sau lipsă. Vom expedia coletul din nou, fără costuri suplimentare pentru tine.', 'nutrisslim-suiteV2'); ?>
                </div>
            </label>
        </div>
        <img src="<?php echo get_nutrislim_assets_url(); ?>Group-606.svg" alt="Option 2" class="rf-option-image">
    </div>
    <?php } if ($surprise_box) { ?>
    <div class="delivery-option rf-option-container" style="<?php echo $is_checked_presenecenja_bg; ?>">
        <div class="rf-option-left">
            <input type="checkbox" class="rf-custom-checkbox packing" name="rf_izdelek_presenecenja"
                id="rf_izdelek_presenecenja" <?php echo $is_checked_presenecenja; ?>>
            <label for="rf_izdelek_presenecenja">
                <div class="rf-option-title"><?php echo __('Surprise box', 'nutrisslim-suiteV2'); ?>
                    (+<?php echo wc_price($surprise_box); ?>)</div>
                <div class="rf-option-description"><?php echo $surprise_box_value; ?></div>
            </label>
        </div>
        <img src="<?php echo get_nutrislim_assets_url(); ?>Group-591.svg" alt="Option 3" class="rf-option-image">
    </div>
    <?php } ?>
</div>

<?php } ?>

<div class="rf-custom-option select-shipping">
    <h3><?php echo __('Livrare', 'woocommmerce'); ?></h3>
    <div id="methodsPicker"><?php // display_custom_shipping_methods(); ?></div>
</div>

<?php
}
// add_action('woocommerce_after_order_notes', 'custom_checkout_additional_options');

add_action('wp_ajax_update_checkout_total', 'custom_checkout_additional_options');
add_action('wp_ajax_nopriv_update_checkout_total', 'custom_checkout_additional_options');

function get_product_image($pid) {

    global $product; 
    if (!empty($pid)) {
        $product = wc_get_product($pid);
    }

    // Check if we are on a landing page and if a selected product is set
    if (is_singular('landing-page')) {
        $selected_product = get_field('selected_product');
        if (!empty($selected_product)) {
            $product = wc_get_product($selected_product[0]);
        }
    }
    
    $attachment_ids = $product->get_gallery_image_ids();
    $token = substr(bin2hex(random_bytes(8)), 0, 8);
    $is_best_seller = get_field('best_seller', $pid);
    if ($is_best_seller) {
        $best_seller_class = ' best_seller';
    } else {
        $best_seller_class = '';
    }

?>
<div class="swiper main-product-swiper-pp-<?php echo $token; ?><?php echo $best_seller_class; ?>">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <?php
                $post_thumbnail_id = $product->get_image_id();
                echo wp_get_attachment_image($post_thumbnail_id, 'full');
                ?>
        </div>
        <?php foreach ($attachment_ids as $attachment_id) { ?>
        <div class="swiper-slide">
            <?php echo wp_get_attachment_image($attachment_id, 'full'); ?>
        </div>
        <?php } ?>
    </div>
</div>
<?php
        if (!empty($attachment_ids)) {
    ?>
<div thumbsSlider="" class="swiper gallery-thumbs-pp-<?php echo $token; ?>">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <?php echo wp_get_attachment_image($post_thumbnail_id, 'thumbnail'); ?>
        </div>
        <?php foreach ($attachment_ids as $attachment_id) { ?>
        <div class="swiper-slide">
            <?php echo wp_get_attachment_image($attachment_id, 'thumbnail'); ?>
        </div>
        <?php } ?>
    </div>
    <div class="swiper-scrollbar"></div>
</div>
<?php
        }
    ?>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    <?php if (!empty($attachment_ids)) { ?>
    var galleryThumbs = new Swiper('.gallery-thumbs-pp-<?php echo $token; ?>', {
        spaceBetween: 4,
        slidesPerView: 6,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        scrollbar: {
            el: ".swiper-scrollbar",
        },
    });
    <?php } ?>

    var galleryTop = new Swiper('.main-product-swiper-pp-<?php echo $token; ?>', {
        spaceBetween: 0,
        slidesPerView: 1,
        <?php if (!empty($attachment_ids)) { ?>
        thumbs: {
            swiper: galleryThumbs
        }
        <?php } ?>
    });
});
</script>
<?php        
}
// This is for email.
function get_delivery_days_text_from_order($order) {
    // Retrieve the selected shipping method from the order
    $shipping_methods = $order->get_shipping_methods(); 

    if (empty($shipping_methods)) {
        return '';
    }

    // Assuming there's only one shipping method for simplicity
    $shipping_method = reset($shipping_methods);
    $method_id = $shipping_method->get_method_id();
    $instance_id = $shipping_method->get_instance_id();

    // Get the shipping method instance settings
    $instance_settings = get_option('woocommerce_' . $method_id . '_' . $instance_id . '_settings');

    // Default values if settings are not set
    $delivery_from = isset($instance_settings['delivery_from']) ? intval($instance_settings['delivery_from']) : 2;
    $delivery_to = isset($instance_settings['delivery_to']) ? intval($instance_settings['delivery_to']) : 3;

    // Calculate the delivery date range
    $delivery_days = calculate_delivery_date_range($delivery_from, $delivery_to);
    $delivery_days_text = $delivery_days['from'] . ' - ' . $delivery_days['to'];

    return $delivery_days_text;
}

// Step 1: Customize the button's HTML with the link
function custom_woocommerce_loop_add_to_cart_link($html, $product) {
    $product_id = $product->get_id(); // Get the product ID
    $product_name = $product->get_name(); // Get the product name
    $custom_text = __( 'Adaugă în coș', 'nutrisslim-suiteV2' );

    if ( !$product->is_in_stock() ) {
        // If the product is out of stock, display "Out of Stock" text and remove the "Read more" button
        $html = '<span class="out-of-stock">' . __( 'Out of stock', 'nutrisslim-suiteV2' ) . '</span>';
    } else {
        // Custom button HTML with link for in-stock products
        $html = '<a href="?add-to-cart=' . esc_attr( $product_id ) . '" aria-describedby="woocommerce_loop_add_to_cart_link_describedby_' . esc_attr( $product_id ) . '" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="' . esc_attr( $product_id ) . '" data-product_sku="' . esc_attr( $product->get_sku() ) . '" aria-label="' . sprintf( __( 'Adaugă în coș: “%s”', 'your-textdomain' ), esc_attr( $product_name ) ) . '" rel="nofollow">' . esc_html( $custom_text ) . '</a>';
    }    

    return $html;
}

add_filter('woocommerce_loop_add_to_cart_link', 'custom_woocommerce_loop_add_to_cart_link', 10, 2);


function add_custom_fields_to_top_of_store_address_section($settings) {
    // Define the new settings fields to be added at the top
    $new_settings = array(
        array(
            'title' => __('Company Information', 'nutrisslim-suiteV2'),
            'type'  => 'title',
            'desc'  => '',
            'id'    => 'company_information_options'
        ),
        array(
            'title' => __('Company Name', 'nutrisslim-suiteV2'),
            'type'  => 'text',
            'desc'  => __('Enter the company name', 'nutrisslim-suiteV2'),
            'id'    => 'woocommerce_company_name',
            'css'   => 'min-width:300px;',
            'default' => '',
            'desc_tip' => true,
        ),
        array(
            'title' => __('Support Email', 'nutrisslim-suiteV2'),
            'type'  => 'email',
            'desc'  => __('Enter the support email address', 'nutrisslim-suiteV2'),
            'id'    => 'woocommerce_support_email',
            'css'   => 'min-width:300px;',
            'default' => '',
            'desc_tip' => true,
        ),
        array(
            'title' => __('Support Phone', 'nutrisslim-suiteV2'),
            'type'  => 'text',
            'desc'  => __('Enter the support phone number', 'nutrisslim-suiteV2'),
            'id'    => 'woocommerce_support_phone',
            'css'   => 'min-width:300px;',
            'default' => '',
            'desc_tip' => true,
        ),
        array(
            'type' => 'sectionend',
            'id'   => 'company_information_options',
        ),
    );

    // Merge the new settings at the beginning of the existing settings
    return array_merge($new_settings, $settings);
}
add_filter('woocommerce_general_settings', 'add_custom_fields_to_top_of_store_address_section');

function get_woocommerce_store_address() {
    $store_address     = get_option( 'woocommerce_store_address' );
    $store_address_2   = get_option( 'woocommerce_store_address_2' );
    $store_city        = get_option( 'woocommerce_store_city' );
    $store_postcode    = get_option( 'woocommerce_store_postcode' );

    // Country and state separated
    $store_raw_country = get_option( 'woocommerce_default_country' );

    // Split the country/state
    $split_country = explode( ":", $store_raw_country );

    $store_country = $split_country[0];
    $store_state   = isset( $split_country[1] ) ? $split_country[1] : '';

    // Address format
    $address = array(
        'address_1' => $store_address,
        'address_2' => $store_address_2,
        'city'      => $store_city,
        'postcode'  => $store_postcode,
        'country'   => $store_country,
        'state'     => $store_state,
    );

    return $address;
}
/*
// Redirect to home if cart is empty and on the main checkout page
function redirect_empty_cart_to_home() {
    if (is_checkout() 
        && !is_wc_endpoint_url('order-received') 
        && !is_wc_endpoint_url('order-pay') // Exclude "Order Pay" page
        && WC()->cart->is_empty() 
        && !is_singular('landing-page')) {
        
        wp_safe_redirect(home_url());
        exit;
    }
}
add_action('template_redirect', 'redirect_empty_cart_to_home');

// Redirect cart to home if user is not admin.
function redirect_cart_to_home_for_non_admins() {
    if (is_cart() && !current_user_can('manage_options')) {
        wp_safe_redirect(home_url());
        exit;
    }
}
add_action('template_redirect', 'redirect_cart_to_home_for_non_admins');
*/
function get_free_shipping_threshold() {
    // Get all shipping zones
    $zones = WC_Shipping_Zones::get_zones();  

    $zones[] = array('zone_id' => 0); // Adding the default zone

    foreach ($zones as $zone) {
        // Get shipping methods for the zone
        $shipping_methods = WC_Shipping_Zones::get_zone($zone['zone_id'])->get_shipping_methods();

        foreach ($shipping_methods as $method) {
            // Check if it's the free shipping method
            if ($method->id === 'free_shipping') {
                // Return the minimum order amount for free shipping
                return $method->get_option('min_amount');
            }
        }
    }

    // Return a default value if no free shipping method is found
    return 0;
}

// Check if all products in bundle are in stock.

add_filter( 'woocommerce_product_is_in_stock', 'check_nutrisslim_product_stock', 10, 2 );

function check_nutrisslim_product_stock( $is_in_stock, $product ) {
    // Check if the product type is 'nutrisslim'
    if ( $product->get_type() === 'nutrisslim' ) {
        // Get the ACF repeater field 'products'
        $referenced_products = get_field('products', $product->get_id());

        if ( !empty($referenced_products) ) {
            foreach ( $referenced_products as $referenced_product ) {
                // Assuming 'products' is the subfield name and it returns a product ID
                $referenced_product_id = $referenced_product['products']; 

                // Load the referenced product object
                $referenced_product_obj = wc_get_product( $referenced_product_id );

                // Check if the referenced product is in stock
                if ( !$referenced_product_obj || !$referenced_product_obj->is_in_stock() ) {
                    // If any referenced product is out of stock, return false
                    return false;
                }
            }
        }
    }

    // If all referenced products are in stock, return the default in-stock status
    return $is_in_stock;
}

// Add Street and house number in same line:

add_filter( 'woocommerce_order_formatted_billing_address', 'custom_formatted_billing_address', 10, 2 );
add_filter( 'woocommerce_order_formatted_shipping_address', 'custom_formatted_shipping_address', 10, 2 );

function custom_formatted_billing_address( $address, $order ) {
    if ( isset( $address['address_1'] ) && isset( $address['address_2'] ) ) {
        // Concatenate address_1 and address_2
        $address['address_1'] = $address['address_1'] . ' ' . $address['address_2'];
        // Remove address_2 since it's already included in address_1
        unset( $address['address_2'] );
    }

    return $address;
}

// Add addres line 1 and address line 2 to same line
function custom_formatted_shipping_address( $address, $order ) {
    if ( isset( $address['address_1'] ) && isset( $address['address_2'] ) ) {
        // Concatenate address_1 and address_2
        $address['address_1'] = $address['address_1'] . ' ' . $address['address_2'];
        // Remove address_2 since it's already included in address_1
        unset( $address['address_2'] );
    }

    return $address;
}

// Remove meta in email template
function filter_woocommerce_order_item_get_formatted_meta_data( $formatted_meta, $order_item ) {
    foreach ( $formatted_meta as $key => $meta ) {
        // Exclude the "lid" meta from being displayed
        if ( 'lid' === $meta->key ) {
            unset( $formatted_meta[ $key ] );
        }
    }
    return $formatted_meta;
}
add_filter( 'woocommerce_order_item_get_formatted_meta_data', 'filter_woocommerce_order_item_get_formatted_meta_data', 10, 2 );

add_action( 'acf/include_fields', function() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( array(
        'key' => 'group_66bb54b5afe00',
        'title' => 'SEO',
        'fields' => array(
            array(
                'key' => 'field_seo_title',
                'label' => 'SEO Title',
                'name' => 'seo_title',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_66bb54b6702ac',
                'label' => 'Description',
                'name' => 'seo_description',
                'aria-label' => '',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'maxlength' => '',
                'rows' => '',
                'placeholder' => '',
                'new_lines' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ),
            ),
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
            ),
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'landing-page',
                ),
            ),
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'product',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
        'acf_ct_enable' => 0,
        'acf_ct_table_name' => '',
    ) );
});

add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_63375abb84d87',
	'title' => 'Google',
	'fields' => array(
        array(
            'key' => 'field_show_in_vivnetwork',
            'label' => 'Show in VivNetwork',
            'name' => 'show_in_vivnetwork',
            'aria-label' => '',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'message' => '',
            'default_value' => 0,
            'ui' => 1,
            'ui_on_text' => '',
            'ui_off_text' => '',
        ),        
        array(
            'key' => 'field_show_in_feed',
            'label' => 'Show in feed',
            'name' => 'show_in_feed',
            'aria-label' => '',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'message' => '',
            'default_value' => 0,
            'ui' => 1,
            'ui_on_text' => '',
            'ui_off_text' => '',
        ),        
		array(
			'key' => 'field_63375ac578d3a',
			'label' => 'Google Product Category',
			'name' => 'google_product_category',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_63375af178d3b',
			'label' => 'Multipack',
			'name' => 'multipack',
			'aria-label' => '',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 1,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '',
			'max' => '',
			'step' => '',
		),
		array(
			'key' => 'field_63406aa3e6bab',
			'label' => 'Unit pricing measure',
			'name' => 'unit_pricing_measure',
			'aria-label' => '',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '',
			'max' => '',
			'step' => '',
		),
		array(
			'key' => 'field_63375b8578d3c',
			'label' => 'GTIN',
			'name' => 'gtin',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_63375bce78d3d',
			'label' => 'MPN',
			'name' => 'mpn',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_63377b3b787d0',
			'label' => 'Has highlights',
			'name' => 'has_highlights',
			'aria-label' => '',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_63377a254ef5d',
			'label' => 'Highlights',
			'name' => 'highlights',
			'aria-label' => '',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_63377b3b787d0',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 2,
			'max' => 10,
			'layout' => 'row',
			'button_label' => 'Add Row',
			'sub_fields' => array(
				array(
					'key' => 'field_63377a4d4ef5e',
					'label' => 'Highlight',
					'name' => 'highlight',
					'aria-label' => '',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_63377af04ef5f',
								'operator' => '==',
								'value' => '1',
							),
						),
					),
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => 150,
					'parent_repeater' => 'field_63377a254ef5d',
				),
			),
			'rows_per_page' => 20,
		),
        array(
            'key' => 'field_custom_label_repeater',
            'label' => 'Custom Labels',
            'name' => 'custom_labels',
            'type' => 'repeater',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'collapsed' => '',
            'min' => 1,
            'max' => 5,
            'layout' => 'row',
            'button_label' => 'Add Custom Label',
            'sub_fields' => array(
                array(
                    'key' => 'field_custom_label_text',
                    'label' => 'Custom Label',
                    'name' => 'custom_label',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => 'Enter custom label',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
            ),
            'rows_per_page' => 20,
        ),        
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'product',
			),
		),
	),
	'menu_order' => 20,
	'position' => 'side',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
    ) );
} );

add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_66600852e40ac',
	'title' => 'After purchase',
	'fields' => array(
		array(
			'key' => 'field_66600853c3799',
			'label' => 'Enable After purchase',
			'name' => 'after_purchase_enabled',
			'aria-label' => '',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_666008c1c379a',
			'label' => 'Initial offer',
			'name' => 'initial_offer',
			'aria-label' => '',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'table',
			'pagination' => 0,
			'min' => 0,
			'max' => 0,
			'collapsed' => '',
			'button_label' => 'Add Row',
			'rows_per_page' => 20,
			'sub_fields' => array(
				array(
					'key' => 'field_666008e3c379b',
					'label' => 'Product',
					'name' => 'product',
					'aria-label' => '',
					'type' => 'post_object',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'post_type' => array(
						0 => 'product',
					),
					'post_status' => '',
					'taxonomy' => '',
					'return_format' => 'id',
					'multiple' => 0,
					'allow_null' => 0,
					'bidirectional' => 0,
					'ui' => 1,
					'bidirectional_target' => array(
					),
					'parent_repeater' => 'field_666008c1c379a',
				),
				array(
					'key' => 'field_666011abc379c',
					'label' => 'Price',
					'name' => 'price',
					'aria-label' => '',
					'type' => 'number',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'min' => '',
					'max' => '',
					'placeholder' => '',
					'step' => '',
					'prepend' => '',
					'append' => '',
					'parent_repeater' => 'field_666008c1c379a',
				),
			),
		),
		array(
			'key' => 'field_66601e9c36b22',
			'label' => 'Last offer',
			'name' => 'last_offer',
			'aria-label' => '',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'table',
			'pagination' => 0,
			'min' => 0,
			'max' => 0,
			'collapsed' => '',
			'button_label' => 'Add Row',
			'rows_per_page' => 20,
			'sub_fields' => array(
				array(
					'key' => 'field_66619299b046c',
					'label' => 'Image',
					'name' => 'image',
					'aria-label' => '',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'id',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
					'preview_size' => 'woocommerce_gallery_thumbnail',
					'parent_repeater' => 'field_66601e9c36b22',
				),
				array(
					'key' => 'field_66601e9c36b27',
					'label' => 'Product',
					'name' => 'product',
					'aria-label' => '',
					'type' => 'post_object',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'post_type' => array(
						0 => 'product',
					),
					'post_status' => '',
					'taxonomy' => '',
					'return_format' => 'id',
					'multiple' => 0,
					'allow_null' => 0,
					'bidirectional' => 0,
					'ui' => 1,
					'bidirectional_target' => array(
					),
					'parent_repeater' => 'field_66601e9c36b22',
				),
				array(
					'key' => 'field_66601e9c36b28',
					'label' => 'Price',
					'name' => 'price',
					'aria-label' => '',
					'type' => 'number',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'min' => '',
					'max' => '',
					'placeholder' => '',
					'step' => '',
					'prepend' => '',
					'append' => '',
					'parent_repeater' => 'field_66601e9c36b22',
				),
			),
		),
		array(
			'key' => 'field_667400af27faa',
			'label' => 'Checkout offer',
			'name' => 'checkout_offer',
			'aria-label' => '',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'table',
			'pagination' => 0,
			'min' => 0,
			'max' => 0,
			'collapsed' => '',
			'button_label' => 'Add Row',
			'rows_per_page' => 20,
			'sub_fields' => array(
				array(
					'key' => 'field_667400af27faf',
					'label' => 'Image',
					'name' => 'image',
					'aria-label' => '',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'id',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
					'preview_size' => 'woocommerce_gallery_thumbnail',
					'parent_repeater' => 'field_667400af27faa',
				),
				array(
					'key' => 'field_667400af27fb0',
					'label' => 'Product',
					'name' => 'product',
					'aria-label' => '',
					'type' => 'post_object',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'post_type' => array(
						0 => 'product',
					),
					'post_status' => '',
					'taxonomy' => '',
					'return_format' => 'id',
					'multiple' => 0,
					'allow_null' => 0,
					'bidirectional' => 0,
					'ui' => 1,
					'bidirectional_target' => array(
					),
					'parent_repeater' => 'field_667400af27faa',
				),
				array(
					'key' => 'field_667400af27fb1',
					'label' => 'Price',
					'name' => 'price',
					'aria-label' => '',
					'type' => 'number',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'min' => '',
					'max' => '',
					'placeholder' => '',
					'step' => '',
					'prepend' => '',
					'append' => '',
					'parent_repeater' => 'field_667400af27faa',
				),
			),
		),
        array(
            'key' => 'field_667baf384af31', // Unique key for the new field
            'label' => 'Add to empty cart',
            'name' => 'add_to_empty_cart',
            'aria-label' => '',
            'type' => 'true_false',
            'instructions' => 'If enabled, this item will automatically be added to the cart when it is empty.',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'message' => 'Set this option to on to enable add this cart upsell to empty cart.', // Optional text displayed with the switch
            'default_value' => 0, // Set off by default
            'ui' => 1, // This makes it appear as a switch instead of a checkbox
        ),        
		array(
			'key' => 'field_667baf384af2a',
			'label' => 'Cart offer',
			'name' => 'cart_offer',
			'aria-label' => '',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'table',
			'pagination' => 0,
			'min' => 0,
			'max' => 0,
			'collapsed' => '',
			'button_label' => 'Add Row',
			'rows_per_page' => 20,
			'sub_fields' => array(
				array(
					'key' => 'field_667baf384af30',
					'label' => 'Product',
					'name' => 'product',
					'aria-label' => '',
					'type' => 'post_object',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'post_type' => array(
						0 => 'product',
					),
					'post_status' => '',
					'taxonomy' => '',
					'return_format' => 'id',
					'multiple' => 0,
					'allow_null' => 0,
					'bidirectional' => 0,
					'ui' => 1,
					'bidirectional_target' => array(
					),
					'parent_repeater' => 'field_667baf384af2a',
				),
				array(
					'key' => 'field_66ced48df5ece',
					'label' => 'Price',
					'name' => 'price',
					'aria-label' => '',
					'type' => 'number',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'min' => '',
					'max' => '',
					'placeholder' => '',
					'step' => '',
					'prepend' => '',
					'append' => '',
					'parent_repeater' => 'field_667baf384af2a',
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'after-purchase-settings',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
	'acf_ct_enable' => 0,
	'acf_ct_table_name' => '',
    ) );
} );

add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( 
        array(
            'key' => 'group_660bbd6f1ab7c',
            'title' => 'Tabs',
            'fields' => array(
                array(
                    'key' => 'field_660bbd6f43852',
                    'label' => 'Uporaba',
                    'name' => 'uporaba',
                    'aria-label' => '',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                    'delay' => 0,
                ),
                array(
                    'key' => 'field_660bbdbb43853',
                    'label' => 'Sestavine',
                    'name' => 'sestavine',
                    'aria-label' => '',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                    'delay' => 0,
                ),
                array(
                    'key' => 'field_660bbddc43854',
                    'label' => 'Hranilne vrednosti',
                    'name' => 'hranilne_vrednosti',
                    'aria-label' => '',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'acf_ct_exclude_column' => 0,
                    'acf_ct_read_only_field' => 0,
                    'default_value' => '',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                    'delay' => 0,
                ),
                array(
                    'key' => 'field_66fb76ccb0f5d',
                    'label' => 'Warnings',
                    'name' => 'warnings',
                    'aria-label' => '',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'allow_in_bindings' => 0,
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                    'delay' => 0,
                ),
                array(
                    'key' => 'field_6628113336ea6',
                    'label' => 'Nutritional Value',
                    'name' => 'nutritional_value',
                    'aria-label' => '',
                    'type' => 'table',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'acf_ct_exclude_column' => 0,
                    'acf_ct_read_only_field' => 0,
                    'use_header' => 2,
                    'use_caption' => 2,
                ),
                array(
                    'key' => 'field_66fb76ccb0f1d',
                    'label' => 'Certifications',
                    'name' => 'certifications',
                    'aria-label' => '',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'allow_in_bindings' => 0,
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                    'delay' => 0,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'product',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
        ) 
    );
} );


// Remove the original meta description function
remove_action( 'wp_head', 'hello_elementor_add_description_meta_tag' );

// Ensure the original meta description is removed
function remove_hello_elementor_description_meta_tag() {
    remove_action( 'wp_head', 'hello_elementor_add_description_meta_tag' );
}
add_action( 'init', 'remove_hello_elementor_description_meta_tag' );

// Add a new custom meta description function
add_action( 'wp_head', 'custom_add_description_meta_tag', 1 );

function custom_add_description_meta_tag() {
    if ( ! is_singular() ) {
        return;
    }

    $post_id = get_the_ID();
    
    // Try to get the custom 'seo_description' field
    $seo_description = get_field( 'seo_description', $post_id );

    // If no 'seo_description' found, fall back to the post excerpt
    if ( empty( $seo_description ) ) {
        $seo_description = get_the_excerpt( $post_id );
    }

    // If neither is available, return without adding the meta tag
    if ( empty( $seo_description ) ) {
        return;
    }

    // Output the meta description tag
    echo '<meta name="description" content="' . esc_attr( wp_strip_all_tags( $seo_description ) ) . '">' . "\n";
}

add_action('wp_ajax_nopriv_cart_upsell', 'cart_upsell');
add_action('wp_ajax_cart_upsell', 'cart_upsell');

function cart_upsell() {
    // Assuming you have a field that contains the items to upsell
    $items = get_field('cart_offer', 'option');

    error_log(print_r($items, true));

    if (!empty($items)) {
        $output = '';

        $output = '
        <style>
        .cartOffer {
            padding: 15px 1rem;
          }
          .cartOffer h3 {
            margin-bottom: 0;
          }
          .cartOffer > p {
            font-weight: 300;
          }
          .cartOffer div.inner {
            margin-bottom: 25px;
          }
          .cartOffer div.inner div.imgHold {
            -ms-flex-preferred-size: 150px;
            flex-basis: 150px;
            max-width: 150px;
          }
          .cartOffer div.inner div.imgHold span.onsale {
            margin-top: 0 !important;
            font-size: 13px;
            width: 40px;
            height: 40px;
            right: 6px;
            top: 0px;
          }
          .cartOffer div.inner div.imgHold div.image-holder {
            position: relative;
          }
          .cartOffer div.inner div.imgHold div.image-holder img {
            background-color: #ededeb;
          }
          @media (max-width: 576px) {
            .cartOffer div.inner div.imgHold {
              -ms-flex-preferred-size: 115px;
              flex-basis: 115px;
              max-width: 115px;
            }
          }
          .cartOffer div.inner div.descHolder {
            -ms-flex-preferred-size: calc(100% - 150px);
            flex-basis: calc(100% - 150px);
            max-width: calc(100% - 150px);
            padding-left: 10px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
          }
          .cartOffer div.inner div.descHolder h5 {
            font-size: 18px;
            margin-bottom: 0;
            margin-top:0;
          }
          .cartOffer div.inner div.descHolder p {
            font-size: 14px;
            font-weight: 300;
            margin-bottom: 5px;
          }
          .cartOffer div.inner div.descHolder button.add-to-cart-icon {
            font-weight: 300;
            line-height: normal;
            padding: 7px 27px 11px;
            -ms-flex-item-align: center;
            align-self: center;
            margin: 0 !important;
          }
          .cartOffer div.inner div.descHolder button.add-to-cart-icon img {
            position: relative;
            margin-right: 10px;
            top: 2px;
          }
          .cartOffer div.inner div.descHolder button.add-to-cart-icon[disabled] {
            opacity: 0.2;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=20)";
            filter: alpha(opacity=20);
          }
          .cartOffer div.inner div.descHolder div.price del {
            font-weight: 300;
            margin-right: 10px;
          }
          .cartOffer div.inner div.descHolder div.price span {
            color: #FF0018;
            font-weight: 800;
          }
          @media (max-width: 576px) {
            .cartOffer div.inner div.descHolder {
              -ms-flex-preferred-size: calc(100% - 115px);
              flex-basis: calc(100% - 115px);
              max-width: calc(100% - 115px);
            }
          }
          @media (max-width: 576px) {
            .cartOffer {
              padding: 15px 1rem;
            }
          }
          div.rateMeta {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-bottom: 1rem;
          }
          div.rateMeta img.star {
            position: relative;
            top: 4px;
            width: 15px;
            height: 15px;
            display:inline-block;
          }
          div.rateMeta div.rate {
            margin-left: 5px;
          }
          @media (max-width: 576px) {
            .cartOffer div.rateMeta div.checker {
              -ms-flex-preferred-size: 100%;
              flex-basis: 100%;
              margin-top: 5px;
            }
            .cartOffer div.rateMeta div.checker .check {
              margin-left: 0;
            }
          }
          button.cart-button_swiper {
            border: 0px solid;
            font-family: "Fira Sans Condensed", sans-serif;
            border-color: #1fb25a;
            border-radius: 100px;
            background: #1fb25a;
            color: white !important;
            font-weight: 300;
            line-height: 1;
            padding: 0.7em 2.5em;
            display: block;
            text-align: center;
            outline: none;
            text-transform: initial !important;
          }
          .checker {
            text-indent: 35px;
            position: relative;
          }
          .checker span.check {
            position: absolute;
            background-color: #1FB25A;
            display: -webkit-inline-box;
            display: -ms-inline-flexbox;
            display: inline-flex;
            border-radius: 100px;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            width: 19px;
            height: 19px;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            margin-left: 10px;
            white-space: nowrap;
            text-indent: 10px;
            left: 2px;
            top: 0px;
          }
          .ratebelowtitle .checker span.check {
            top: -3px;
          }                                     
        </style>
        ';

        $output .= '<h3>' . __('Nu rata cele mai bune oferte!', 'nutrisslim-suiteV2') . '</h3>';
        $output .= '<p>' . __('Doar aici, pentru o perioadă limitată.', 'nutrisslim-suiteV2') . '</p>';

        // Check if the cart is empty
        $is_cart_empty = WC()->cart->is_empty();

        // Get the IDs of products already in the cart
        $cart_product_ids = array();
        foreach (WC()->cart->get_cart() as $cart_item) {
            $cart_product_ids[] = $cart_item['product_id'];
        }

        foreach ($items as $item) {
            $pid = $item['product'];

            // Skip if the product is already in the cart
            if (in_array($pid, $cart_product_ids)) {
                continue;
            }

            $_product = wc_get_product($pid);

            $offer_price = $item['price'];
            $regular_price = $_product->get_regular_price();
            if (!wc_prices_include_tax()) {
                $offer_price_with_tax = wc_get_price_including_tax( $_product, array( 'price' => $offer_price ) );
                $regular_price_with_tax = wc_get_price_including_tax( $_product, array( 'price' => $regular_price ) );
            }

          
            $discount_percentage = (($regular_price - $offer_price) / $regular_price) * 100;
            $discount_percentage = round($discount_percentage);
            $short_description = $_product->get_short_description();

            $comments = get_comments(array(
                'type' => 'review',
                'post_id' => $pid
            ));

            if (empty($short_description)) {
                $description = $_product->get_description();
                $short_description = wp_trim_words($description, 18, '...');
            } else {
                $short_description = wp_trim_words($short_description, 18, '...');
            }

            $disco = $discount_percentage > 0 ? '<span class="onsale">-' . $discount_percentage . '%</span>' : '';

            $output .= '<div class="inner grid-noGutter">';

            $output .= '<div class="col-4 imgHold">';
            $output .= '<div class="image-holder">' . $disco . '<img src="' . wp_get_attachment_image_src(get_post_thumbnail_id($pid), 'medium')[0] . '" class="img-responsive"></div>';
            $output .= '</div>'; // col-4

            $output .= '<div class="col-8 descHolder">';
            $output .= '<h5>' . get_the_title($pid) . '</h5>';
            $output .= '<div class="desc">';
            if (count($comments) > 0) {
                $output .= do_shortcode('[product_rating id="' . $pid . '"]');
            }
            $output .= '<p>' . $short_description . '</p>';
            $output .= '</div>'; // desc

            $output .= '<div class="price">';
            if ($discount_percentage > 0) {
                $output .= '<del>' . wc_price($regular_price_with_tax) . '</del>'; // Use wc_price for regular price
            }
            $output .= '<span>' . wc_price($offer_price_with_tax) . '</span>'; // Use wc_price for offer price
            $output .= '</div>'; // end pricecol

            // Add 'disabled' attribute if cart is empty
            $disabled = $is_cart_empty ? 'disabled' : '';

            $add_to_empty = get_field('add_to_empty_cart', 'option');

            if ($add_to_empty == 1) {
                $disabled = '';
            }

            $output .= '<button class="cart-button_swiper add-to-cart-icon" data-offer="cart_upsell" data-product-id="' . $pid . '" data-quantity="1" data-price="' . $offer_price . '" ' . $disabled . '>' . __('Adaugă în coș', 'nutrisslim-suiteV2') . '</button>';
            $output .= '</div>'; // descHolder

            $output .= '</div>'; // inner
        }

        echo $output;
    }

    wp_die();
}
// REMOVE CHILD PRODUCTS FROM DATA LAYER

add_filter( 'gtm4wp_eec_cart_item', 'exclude_nutrisslim_parent_id_cart_items', 10, 2 );

function exclude_nutrisslim_parent_id_cart_items( $item_included, $cart_item ) {
    // Check if the cart item has the meta key 'nutrisslim_parent_id'
    if ( isset( $cart_item['nutrisslim_parent_id'] ) && ! empty( $cart_item['nutrisslim_parent_id'] ) ) {
        return false; // Return false to hide the item from GTM reporting
    }
    // If the meta key is not set, include the item in the data layer
    return $item_included;
}

// Handle the AJAX request
// add_action('wp_ajax_load_elementor_template', 'load_elementor_template');
// add_action('wp_ajax_nopriv_load_elementor_template', 'load_elementor_template');

function load_elementor_template() {

    $target = isset($_POST['target']) ? sanitize_text_field($_POST['target']) : '';

    // Correct the comparison operators to check the value of $target
    if ($target === 'vitamins_subslide') {
        $tid = 564623;
    } else if ($target === 'sport_subslide') {
        $tid = 564644;
    } else if ($target === 'hujsanje_subslide') {
        $tid = 565731;
    } else if ($target === 'lepota_subslide') {
        $tid = 565741;
    } else if ($target === 'razstrupljanje_subslide') {
        $tid = 565749;
    } else if ($target === 'mobileSwiper') {
        $ids = [565749, 565741, 565731, 564644, 564623];  // Your list of numbers
        $random_key = array_rand($ids);                   // Get a random key from the array
        $tid = $ids[$random_key];                         // Get the value using the random key        
    } else {
        echo 'Invalid target';
        wp_die();
    }

    // Define the cache key based on the template ID
    $cache_key = 'elementor_template_' . $tid;

    // Try to retrieve the cached content
    $cached_content = wp_cache_get($cache_key, 'elementor_templates');

    // If cached content exists, return it
    if ($cached_content !== false) {
        echo $cached_content;
        wp_die();
    }

    // Ensure it is an AJAX request
    if (defined('DOING_AJAX') && DOING_AJAX && $tid) {
        // Process the shortcode and return the content
        $template_content = do_shortcode('[elementor-template id="' . $tid . '"]');
        
        // Cache the generated content for 12 hours (43200 seconds)
        wp_cache_set($cache_key, $template_content, 'elementor_templates', 43200);
        
        echo $template_content;
    } else {
        echo 'No data available';
    }

    wp_die(); // This is required to end the AJAX request properly
}
/*
function add_hotjar_tracking_code() {
    if (get_the_id() == 580141) { 
        ?>
<!-- Hotjar Tracking Code for Nutrisslim Landing -->
<script>
console.log('Hotjar script added on page 580141');
(function(h, o, t, j, a, r) {
    h.hj = h.hj || function() {
        (h.hj.q = h.hj.q || []).push(arguments)
    };
    h._hjSettings = {
        hjid: 5139374,
        hjsv: 6
    };
    a = o.getElementsByTagName('head')[0];
    r = o.createElement('script');
    r.async = 1;
    r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
    a.appendChild(r);
})(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
</script>
<?php
    } else {
        // Optional debug message for other pages
        echo "<!-- Not page 580141 " . get_the_id() . "-->";
    }
}*/
// add_action('wp_head', 'add_hotjar_tracking_code');

/*
add_action('woocommerce_checkout_create_order_fee_item', 'add_meta_to_order_fees', 10, 4);
function add_meta_to_order_fees($item, $fee_key, $fee, $order) {

  
    error_log(print_r('<===========================', true));
    error_log(print_r($fee_key, true));    

    // Check if the fee description contains the word "insurance"
    if (strpos($fee_key, 'insurance') !== false || strpos($fee->id, 'insurance') !== false) {
        // If "insurance" is found, set extra_fee_meta to 'STRZ'
        $item->add_meta_data('extra_fee_meta', 'STRZ', true);
    } else {
        // Otherwise, set extra_fee_meta to 'STRR'
        $item->add_meta_data('extra_fee_meta', 'STRR', true);
    }
}

// Hook into the transition from "pending payment" to "processing"
add_action('woocommerce_order_status_pending_to_processing', 'set_fees_on_paypal', 10, 1);

function set_fees_on_paypal($order_id) {
    // Load the order object using the order ID
    $order = wc_get_order($order_id);

    if (!$order) {
        error_log('Error: Order not found.');
        return;
    }

    if ($order->get_payment_method() == 'eh_paypal_express') {
        // Loop through the fee items in the order
        foreach ($order->get_items('fee') as $fee_item_id => $fee_item) {

            // Check the fee name and add metadata
            if (strpos(strtolower($fee_item->get_name()), 'insurance') !== false) {
                $fee_item->add_meta_data('extra_fee_meta', 'STRZ', true);
            } else {
                $fee_item->add_meta_data('extra_fee_meta', 'STRR', true);
            }

            // Save the fee item
            $fee_item->save();
        }
    }
}
*/

add_action('woocommerce_checkout_create_order_fee_item', 'add_meta_to_order_fees', 10, 4);
function add_meta_to_order_fees($item, $fee_key, $fee, $order) {
    // Mapping of fee keys to their corresponding sifrant values
    /*$fee_sifrant_map = array(
        'surprise-box' => get_option('custom_surprise_box_sifrant'),
        'priorytetowa-dostawa' => get_option('priority_delivery_fee_sifrant'),
        'eco-friendly-packaging' => get_option('custom_eco_friendly_packaging_sifrant'),
        'ubezpieczenie-przesylki' => get_option('custom_package_insurance_sifrant'),
        'dodatkowa-oplata-za-platnosc-za-pobraniem' => 'STRL',
    );*/
	
	$fee_sifrant_map = array(
        'surprise-box' => get_option('custom_surprise_box_sifrant'),
        'livrare-prioritara' => get_option('priority_delivery_fee_sifrant'),
        'eco-friendly-packaging' => get_option('custom_eco_friendly_packaging_sifrant'),
        'asigurare-colet' => get_option('custom_package_insurance_sifrant'),
        'taxa-suplimentara-pentru-plata-la-livrare' => 'STRL',
    );

    // Normalize the fee key to match the map (convert to lowercase and replace spaces with dashes)
    $normalized_fee_key = strtolower(str_replace(' ', '-', $fee_key));

    // Check if the normalized fee key exists in the map and add corresponding sifrant as meta
    if (array_key_exists($normalized_fee_key, $fee_sifrant_map) && !empty($fee_sifrant_map[$normalized_fee_key])) {
        $sifrant_value = $fee_sifrant_map[$normalized_fee_key];
        $item->add_meta_data('extra_fee_meta', $sifrant_value, true);
    }
}

// Hook into the transition from "pending payment" to "processing"
add_action('woocommerce_order_status_pending_to_processing', 'set_fees_on_paypal', 10, 1);

function set_fees_on_paypal($order_id) {
    // Load the order object using the order ID
    $order = wc_get_order($order_id);

    if (!$order) {
        error_log('Error: Order not found.');
        return;
    }

    if ($order->get_payment_method() == 'eh_paypal_express') {
        // Mapping of fee keys to their corresponding sifrant values
        $fee_sifrant_map = array(
            'surprise-box' => get_option('custom_surprise_box_sifrant'),
            'priority-delivery' => get_option('priority_delivery_fee_sifrant'),
            'eco-friendly-packaging' => get_option('custom_eco_friendly_packaging_sifrant'),
            'package-insurance' => get_option('custom_package_insurance_sifrant'),
        );

        // Loop through the fee items in the order
        foreach ($order->get_items('fee') as $fee_item_id => $fee_item) {
            // Get the fee name, normalize it to match the map
            $fee_name = strtolower(str_replace(' ', '-', $fee_item->get_name()));

            // Check if the normalized fee name exists in the map and add the sifrant as meta
            if (array_key_exists($fee_name, $fee_sifrant_map) && !empty($fee_sifrant_map[$fee_name])) {
                $sifrant_value = $fee_sifrant_map[$fee_name];
                $fee_item->add_meta_data('extra_fee_meta', $sifrant_value, true);
                $fee_item->save(); // Save the fee item
            }
        }
    }
}

add_action('woocommerce_admin_order_data_after_order_details', 'print_fee_item_meta_data');

function print_fee_item_meta_data($order) {
    // Loop through the fee items in the order
    foreach ($order->get_items('fee') as $fee_item_id => $fee_item) {
        // Print the fee name
        echo '<h3>Fee: ' . esc_html($fee_item->get_name()) . '</h3>';

        // Get and print all meta data for the fee item
        $meta_data = $fee_item->get_meta_data();
        if (!empty($meta_data)) {
            echo '<ul>';
            foreach ($meta_data as $meta) {
                echo '<li><strong>' . esc_html($meta->key) . ':</strong> ' . esc_html($meta->value) . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No meta data found for this fee item.</p>';
        }
    }
}



// Hook into the transition from "pending payment" to "processing"
add_action('woocommerce_order_status_pending_to_processing', 'update_house_numbers_in_address_2_on_transition', 10, 1);

function update_house_numbers_in_address_2_on_transition($order_id) {
    // Get the order object using the order ID
    $order = wc_get_order($order_id);

    // Check if the payment method is PayPal Express (adjust the payment method slug if needed)
    if ($order->get_payment_method() == 'eh_paypal_express') {

        // Get the value of the _billing_house_number and _shipping_house_number meta keys
        $billing_house_number = $order->get_meta('_billing_house_number'); // Billing house number
        $shipping_house_number = $order->get_meta('_shipping_house_number'); // Shipping house number

        // If the billing house number exists, update _billing_address_2
        if (!empty($billing_house_number)) {
            // Update the billing address line 2
            $order->update_meta_data('_billing_address_2', sanitize_text_field($billing_house_number));
        } else {
            // error_log('No billing house number found!');
        }

        // If the shipping house number exists, update _shipping_address_2
        if (!empty($shipping_house_number)) {
            // Update the shipping address line 2
            $order->update_meta_data('_shipping_address_2', sanitize_text_field($shipping_house_number));
        } else {
            // error_log('No shipping house number found!');
        }

        // Save the updated order data
        $order->save();
    }

}

add_filter('wt_paypal_request_params', 'fix_paypal_express_request_params', 10, 1);

function fix_paypal_express_request_params($params) {

    // Remove the shipping discount if it's not needed
    if (isset($params['PAYMENTREQUEST_0_SHIPDISCAMT'])) {
        unset($params['PAYMENTREQUEST_0_SHIPDISCAMT']);
    }

    return $params;
}

// Function to fetch and cache the review data
//function get_review_data_with_cache( $sku ) {
//    // Check if the data is already cached
//    $transient_key = 'nutrisslim_review_data_' . $sku;
//    $review_data = get_transient( $transient_key );
//
//    if ( false === $review_data ) {
//        // If no cache, fetch the data from the REST API
//        $response = wp_remote_get( "https://disneyland.naturesfinest.si/wp-json/nutrisslim/v1/reviews/$sku" );
//
//        if ( is_wp_error( $response ) ) {
//            return false; // Handle the error if API call fails
//        }
//
//        $body = wp_remote_retrieve_body( $response );
//        $review_data = json_decode( $body, true );
//
//        if ( ! empty( $review_data ) ) {
//            // Cache the data for 6 hours (21600 seconds)
//            set_transient( $transient_key, $review_data, 9 * HOUR_IN_SECONDS );
//        }
//    }
//
//    return $review_data;
//}

/**
 * Get review data; optionally force an array return.
 *
 * @param string $sku
 * @param bool   $asArray If true: always return an array (empty if missing). If false: return array|null.
 * @return array|null
 */
function get_review_data_with_cache(string $sku, bool $asArray = false): ?array
{
    if ( ! function_exists('ns_get_cumulative_review_data_local') ) {
        return $asArray ? [] : null;
    }

    $data = ns_get_cumulative_review_data_local($sku);

    if ($asArray) {
        // Normalize to array
        if (is_array($data)) {
            return $data;
        }
        if ($data === null) {
            return [];
        }
        if (is_object($data)) {
            return (array) $data;
        }
        return [$data];
    }

    // Not forcing array: only return if it’s already an array; otherwise null.
    return is_array($data) ? $data : null;
}

add_filter( 'gtm4wp_eec_product_array', 'modify_product_price_without_tax', 10, 2 );

function modify_product_price_without_tax( $eec_product, $ecommerce_action ) {
    if ( isset( $eec_product['id'] ) ) {
        $product_id = $eec_product['id'];
        $product = wc_get_product( $product_id );

        if ( $product ) {
            // Get the price excluding tax
            $price_without_tax = wc_get_price_excluding_tax( $product );
            
            if ( $price_without_tax ) {
                $eec_product['price'] = $price_without_tax;
            }
        }
    }
    return $eec_product;
}
/*
add_action('template_redirect', 'redirect_cart_based_on_cart_contents');

function redirect_cart_based_on_cart_contents() {

    // Check if the current user is an admin
    if (current_user_can('administrator')) {
        return; // Do nothing for admin users
    }
        
    // Check if we are on the cart page
    if (is_cart()) {
        // Check if the cart is empty
        if (WC()->cart->is_empty()) {
            // Redirect to the homepage if the cart is empty
            wp_redirect(home_url());
            exit; // Ensure the redirect happens immediately
        } else {
            // Redirect to the checkout page if the cart is not empty
            wp_redirect(wc_get_checkout_url());
            exit; // Ensure the redirect happens immediately
        }
    }
}

add_action('template_redirect', 'redirect_cart_light_to_home');
function redirect_cart_light_to_home() {
    if (is_page('cart-light')) { // Check if the current page is 'cart-light'
        wp_redirect(home_url());
        exit;
    }
}
*/

// add_action('woocommerce_checkout_update_order_meta', 'log_and_recalc_nutrisslim_order', 10, 1);

function log_and_recalc_nutrisslim_order($order_id) {
    $order = wc_get_order($order_id);
    $logger = wc_get_logger();
    $log_source = 'nutrisslim_bundle_log';

    $log_message = "=== Order #{$order_id} - Original Prices Before Recalculation ===\n";

    foreach ($order->get_items() as $item_id => $item) {
        $product_id = $item->get_product_id();
        $product = wc_get_product($product_id);

        if (!$product) {
            continue;
        }

        $product_type = $product->get_type();
        $is_bundle_parent = get_post_meta($product_id, '_nutrisslim_bundle', true) || $product_type === 'nutrisslim';
        $sub_parent_id = $item->get_meta('nutrisslim_parent_id', true);

        // Log before recalculation
        $subtotal = $item->get_subtotal();
        $total = $item->get_total();
        $discount = $subtotal - $total;

        $log_message .= "🟢 Product: " . $product->get_name() . " (ID: $product_id)\n";
        $log_message .= "   - Quantity: " . $item->get_quantity() . "\n";
        $log_message .= "   - Subtotal: " . number_format($subtotal, 2) . "€\n";
        $log_message .= "   - Total: " . number_format($total, 2) . "€\n";
        $log_message .= "   - Discount: " . number_format($discount, 2) . "€\n";

        // Fix negative price with correct bundle-discounted price
        if ($total < 0) {
            $correct_price = $product->get_price() * $item->get_quantity(); // Get correct price
            error_log('Correct price: ' . $correct_price);

            // If this product is a bundle sub-product, fetch its correct price
            if ($sub_parent_id) {
                $bundle_prices = get_post_meta($sub_parent_id, '_subproducts_custom_prices', true);

                if ($bundle_prices && isset($bundle_prices[$product_id][$item->get_quantity()])) {
                    $correct_price = $bundle_prices[$product_id][$item->get_quantity()];
                }
            }

            $log_message .= "WARNING: Negative Price Detected! Fixing it to: " . number_format($correct_price, 2) . "€\n";
            $item->set_total($correct_price * $item->get_quantity()); // Set corrected price
        }
        $log_message .= "----------------------\n";
    }

    // Save original prices log
    $logger->info($log_message, ['source' => $log_source]);

    // Recalculate order totals
    $order->calculate_totals();

    // Log after recalculation
    $log_message = "=== Order #{$order_id} - Recalculated Prices ===\n";

    foreach ($order->get_items() as $item_id => $item) {
        $product_id = $item->get_product_id();
        $product = wc_get_product($product_id);

        if (!$product) {
            continue;
        }

        $subtotal = $item->get_subtotal();
        $total = $item->get_total();
        $discount = $subtotal - $total;

        $log_message .= "🟢 Product: " . $product->get_name() . " (ID: $product_id)\n";
        $log_message .= "   - Quantity: " . $item->get_quantity() . "\n";
        $log_message .= "   - Subtotal: " . number_format($subtotal, 2) . "€\n";
        $log_message .= "   - Total: " . number_format($total, 2) . "€\n";
        $log_message .= "   - Discount: " . number_format($discount, 2) . "€\n";
        $log_message .= "----------------------\n";
    }

    // Save recalculated prices log
    $logger->info($log_message, ['source' => $log_source]);

    // Save the order with fixed prices
    $order->save();
}

add_action('woocommerce_checkout_create_order_line_item', 'ap_copy_cart_meta_to_order_item', 20, 4);
function ap_copy_cart_meta_to_order_item($item, $cart_item_key, $values, $order)
{

    /** -------------------------
     * Cross-sell flags (always copy if present on the cart item)
     * --------------------------*/
    if (isset($values['offer'])) {
        if ($values['offer'] === 'cart_upsell') {
            $item->add_meta_data('cross_cart', 'yes', true);
        } elseif ($values['offer'] === 'checkout_upsell') {
            $item->add_meta_data('cross_checkout', 'yes', true);
        }
        // generic cross marker (matches what you had before)
        $item->add_meta_data('cross', 'yes', true);
    }

    /** -------------------------
     * Afterpurchase flags – only for items explicitly marked as AP in the cart
     * --------------------------*/
    $is_ap_item = (isset($values['ap_item']) && $values['ap_item'] === true)
        || (!empty($values['afterpurchase']) && $values['afterpurchase'] === 'yes');

    if (! $is_ap_item) {
        return; // don't tag non-AP items with AP metadata
    }

    // generic AP flag
    $item->add_meta_data('afterpurchase', 'yes', true);

    // offer type: initial / last
    $offer_type = '';
    if (! empty($values['offer_type'])) {
        $offer_type = sanitize_text_field($values['offer_type']);
    } elseif (! empty($values['ap_type'])) { // legacy key
        $offer_type = sanitize_text_field($values['ap_type']);
    }

    if ($offer_type !== '') {
        $item->add_meta_data('offer_type', $offer_type, true);

        // split flags for reporting
        if ($offer_type === 'initial') {
            $item->add_meta_data('afterpurchase_initial', 'yes', true);
        } elseif ($offer_type === 'last') {
            $item->add_meta_data('afterpurchase_last', 'yes', true);
        }
    }
}