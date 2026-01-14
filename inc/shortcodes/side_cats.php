<?php
function side_cats_shortcode($atts) {
    // Parse the attributes to check if a 'cat_id' is provided
    $atts = shortcode_atts(array(
        'cat_id' => null,
    ), $atts);

    // Check if 'cat_id' is provided
    if ( !empty($atts['cat_id']) ) {
        // Use the provided 'cat_id'
        $current_category_id = intval($atts['cat_id']);
        
        // Get the nested category structure with the provided cat_id
        return get_category_with_children($current_category_id, true);
    } else {
        // No 'cat_id' provided, check if it's a product category page
        if ( !is_product_category() ) {
            return ''; // Ensure this is only run on product category pages
        }

        // Get the current category object
        $current_category = get_queried_object();

        // Find the top parent category
        $top_parent_category = $current_category;
        while ($top_parent_category->parent != 0) {
            $top_parent_category = get_term($top_parent_category->parent, 'product_cat');
        }

        // Get the nested category structure for the top parent category
        return get_nested_categories($top_parent_category->term_id, true);
    }
}
add_shortcode('side_cats', 'side_cats_shortcode');

function get_category_with_children($category_id, $is_top_level = false) {
    // Get the current category
    $category = get_term($category_id, 'product_cat');

    // Get child categories of the current category
    $child_categories = get_terms(array(
        'taxonomy' => 'product_cat',
        'parent' => $category_id,
        'hide_empty' => false,
    ));

    // Add class 'sideCat' to the top-level <ul>
    $ul_class = $is_top_level ? ' class="sideCat"' : '';

    // Start the output with the top-level category
    $output = '<ul' . $ul_class . '>';
    $category_link = get_term_link($category);
    $output .= '<li><a href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a>';

    // If there are child categories, generate the nested list
    if (!empty($child_categories)) {
        $output .= '<ul>'; // Start child list
        foreach ($child_categories as $child_category) {
            $output .= '<li><a href="' . get_term_link($child_category) . '">' . esc_html($child_category->name) . '</a>';
            // Recursively add child categories only if they exist
            $child_child_categories = get_terms(array(
                'taxonomy' => 'product_cat',
                'parent' => $child_category->term_id,
                'hide_empty' => false,
            ));
            if (!empty($child_child_categories)) {
                $output .= get_category_with_children($child_category->term_id);
            }
            $output .= '</li>';
        }
        $output .= '</ul>'; // End child list
    }

    $output .= '</li>';
    $output .= '</ul>'; // End the current level

    return $output;
}

function get_nested_categories($parent_id, $is_top_level = false) {
    // Get child categories of the current parent
    $categories = get_terms(array(
        'taxonomy' => 'product_cat',
        'parent' => $parent_id,
        'hide_empty' => false,
    ));

    if (empty($categories)) {
        return ''; // No categories found
    }

    // Add class 'sideCat' to the top-level <ul>
    $ul_class = $is_top_level ? ' class="sideCat"' : '';

    $output = '<ul' . $ul_class . '>';

    foreach ($categories as $category) {
        $category_link = get_term_link($category);
        $output .= '<li><a href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a>';
        
        // Recursively get the children of this category
        $output .= get_nested_categories($category->term_id);

        $output .= '</li>';
    }

    $output .= '</ul>';

    return $output;
}
