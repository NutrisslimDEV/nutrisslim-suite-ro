<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Add defer attribute to Swiper JS
function trusted_add_defer_attribute($tag, $handle) {
    if ('trusted-swiper-js' === $handle && strpos($tag, ' defer') === false) {
        $tag = str_replace(' src', ' defer="defer" src', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'trusted_add_defer_attribute', 10, 2);

// Function to determine the product context
function trusted_get_product_id() {
    global $product;

    if ($product && method_exists($product, 'get_id')) {
        return $product->get_id(); // Product page
    }

    // Try to get the product ID from a custom ACF field on landing pages
    $product_id = get_field('selected_product'); // Replace 'selected_product' with your actual ACF field name

    if (is_array($product_id)) {
        return $product_id[0]; // If it's an array, get the first product
    }

    return $product_id;
}

// Add custom checkbox for manual display in the review edit screen
function add_manual_review_display_checkbox($comment) {
    $manual_display = get_comment_meta($comment->comment_ID, 'manual_display', true);
    wp_nonce_field('save_manual_review_display', 'manual_review_nonce');
    ?>
<p>
    <label
        for="manual_display"><?php esc_html_e('Display in Trusted Review Widget (manual selection)', 'nutrisslim-suiteV2'); ?></label>
    <input type="checkbox" id="manual_display" name="manual_display" value="1" <?php checked($manual_display, 1); ?> />
</p>
<?php
}
add_action('add_meta_boxes_comment', 'add_manual_review_display_checkbox');

// Save the custom checkbox value
function save_manual_review_display_checkbox($comment_id) {
    if (!isset($_POST['manual_review_nonce']) || !wp_verify_nonce($_POST['manual_review_nonce'], 'save_manual_review_display')) {
        return;
    }

    $manual_display = isset($_POST['manual_display']) ? 1 : 0;
    update_comment_meta($comment_id, 'manual_display', $manual_display);
}
add_action('edit_comment', 'save_manual_review_display_checkbox');


function trusted_get_reviews_block_a() {
    $product_id = trusted_get_product_id(); // Get the product ID

    if (!$product_id) {
        return '<p>Product not found or invalid product.</p>';
    }

    // Fetch approved WooCommerce reviews
    $comments = get_comments([
        'post_id' => $product_id,
        'status' => 'approve',
        'type' => 'review',
        'number' => 20,
    ]);

    // Fetch manually selected reviews
    $manual_comments = get_comments([
        'meta_key' => 'manual_display',
        'meta_value' => 1,
        'status' => 'approve',
        'type' => 'review',
        'number' => 100, // Fetch up to 100 manual comments
    ]);

    // If there are fewer than 20 regular comments, fill the remaining with manual comments
    if (count($comments) < 20) {
        shuffle($manual_comments);

        // Get the number of manual comments needed to make a total of 20
        $needed_comments = 20 - count($comments);

        // Merge the manually selected comments with the regular comments
        $manual_comments_to_add = array_slice($manual_comments, 0, $needed_comments);
        $comments = array_merge($comments, $manual_comments_to_add);
    }

    // If still no comments, return a message
    if (empty($comments)) {
        return '<p>No reviews yet. Be the first to review this product!</p>';
    }

    ob_start(); // Start output buffering
    echo '<h2 class="trusted-review-title">Recenzii ale clienților</h2>';
    echo '<div class="trusted-review-container">';

    // Calculate average rating
    $total_rating = 0;
    $review_count = 0;
    foreach ($comments as $comment) {
        $rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));
        if ($rating) {
            $total_rating += $rating;
            $review_count++;
        }
    }
    $average_rating = $review_count > 0 ? round($total_rating / $review_count, 1) : 0;

    // Summary box
    echo '<div class="trusted-review-summary">';
    echo '<div class="trusted-review-summary-inner">';
    echo '<div class="trusted-review-stars">';
    $star_image_url = plugin_dir_url(__FILE__) . 'assets/star.webp';
    for ($i = 0; $i < 5; $i++) {
        echo '<img class="trusted-star" src="' . esc_url($star_image_url) . '" alt="star">';
    }
    echo '</div>';
    echo '<div class="trusted-review-rating">' . esc_html($average_rating) . '</div>';
    echo '<div class="trusted-review-text">Uimitor</div>';
    $nutri_leaf_url = plugin_dir_url(__FILE__) . 'assets/nutri-leaf.svg';
    echo '<div class="trusted-review-logo"><img src="' . esc_url($nutri_leaf_url) . '" alt="logo" /></div>';
    echo '</div>';
    echo '</div>';

    // Swiper slider
    echo '<div class="trusted-swiper-container-wrapper">';
    $unique_id = uniqid('trusted-reviewswiper_');
    echo '<div class="swiper-container trusted-reviewswiper ' . esc_attr($unique_id) . '">';
    echo '<div class="swiper-wrapper">';

    // Loop through the comments (both regular and manual)
    foreach ($comments as $comment) {
        $rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));
        $comment_content = !empty(trim($comment->comment_content)) ? esc_html($comment->comment_content) : esc_html__('The customer only left a rating.', 'nutrisslim-suiteV2');

        echo '<div class="swiper-slide trusted-bg-light-grey">';
        echo '<div class="trusted-revSlid">';
        echo '<div class="trusted-top-row">';
        echo '<div class="trusted-rateMeta">';
        for ($i = 0; $i < $rating; $i++) {
            echo '<img class="trusted-star" src="' . esc_url($star_image_url) . '" alt="star">';
        }
        echo '</div>';
        echo '</div>';
        echo '<div class="trusted-review-date">' . esc_html(get_comment_date('F j, Y', $comment)) . '</div>';
        echo '<div class="trusted-revComment">';
        echo '<p>' . $comment_content . '</p>';
        echo '</div>';
        echo '</div>'; // Close trusted-revSlid
        echo '</div>'; // Close swiper-slide
    }

    echo '</div>'; // Close swiper-wrapper
    echo '<div class="swiper-scrollbar trusted-swiper-scrollbar"></div></div>';
    echo '</div>'; // Close trusted-swiper-container-wrapper
    echo '</div>'; // Close trusted-review-container

    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        function getSlidesPerView() {
            if (window.innerWidth >= 1078) {
                return 4.3;
            } else if (window.innerWidth >= 767) {
                return 2.4;
            } else {
                return 1.5;
            }
        }

        var swiper = new Swiper('.{$unique_id}', {
            simulateTouch: true,
            touchRatio: 1,
            grabCursor: true,
            slidesPerView: getSlidesPerView(),
            spaceBetween: 10,
            freeMode: true,
            preloadImages: false,
            lazy: true,
            scrollbar: {
                el: '.trusted-swiper-scrollbar',
                draggable: true,
            },
            mousewheel: {
                forceToAxis: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1.2,
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 2.4,
                    spaceBetween: 10,
                },
                1078: {
                    slidesPerView: 4.3,
                    spaceBetween: 10,
                }
            }
        });

        window.addEventListener('resize', function() {
            swiper.params.slidesPerView = getSlidesPerView();
            swiper.update();
        });
    });
    </script>";

    return ob_get_clean(); // Return the buffered output
}

// Function to display Review Block B (modified to adjust display order)
function trusted_get_reviews_block_b() {
	// echo "<script>console.log('ajde de');</script>";
	
    $product_id = trusted_get_product_id();

    if (!$product_id) {
        return '<p>Product not found or invalid product.</p>';
    }

    $comments = [];
    $total_needed = 20;

    // Define the desired number of comments per rating
    $ratings_needed = [
        5 => 15,
        4 => 2,
        3 => 2,
        2 => 1
    ];

    foreach ($ratings_needed as $rating_value => $count_desired) {
        if ($total_needed <= 0) {
            break;
        }

        // Fetch comments with the specific rating
        $comments_of_rating = get_comments([
            'post_id' => $product_id,
            'status'  => 'approve',
            'type'    => 'review',
            'meta_query' => [
                [
                    'key'     => 'rating',
                    'value'   => $rating_value,
                    'compare' => '=',
                    'type'    => 'NUMERIC'
                ]
            ],
            'number'  => 0 // Fetch all comments with this rating
        ]);

        // If no comments of this rating, continue to next rating
        if (empty($comments_of_rating)) {
            continue;
        }

        // Shuffle to randomize the comments
        shuffle($comments_of_rating);

        // Determine how many comments we can add
        $count_available = count($comments_of_rating);
        $count_needed = min($count_desired, $count_available, $total_needed);

        // Take up to $count_needed comments
        $comments_to_add = array_slice($comments_of_rating, 0, $count_needed);

        // Merge into $comments array
        $comments = array_merge($comments, $comments_to_add);

        // Update $total_needed
        $total_needed -= count($comments_to_add);
    }

    // If there are still slots to fill, fetch manual comments regardless of rating
    if ($total_needed > 0) {
        // Fetch manually selected reviews
        $manual_comments = get_comments([
            'meta_key'   => 'manual_display',
            'meta_value' => 1,
            'status'     => 'approve',
            'type'       => 'review',
            'number'     => 100, // Fetch up to 100 manual comments
        ]);

        if (!empty($manual_comments)) {
            // Shuffle manual comments
            shuffle($manual_comments);

            // Take up to $total_needed manual comments
            $manual_comments_to_add = array_slice($manual_comments, 0, $total_needed);

            // Add to $comments
            $comments = array_merge($comments, $manual_comments_to_add);

            // Update $total_needed
            $total_needed -= count($manual_comments_to_add);
        }
    }

    // If still no comments, return a message
    if (empty($comments)) {
        return '<p>No reviews yet. Be the first to review this product!</p>';
    }

    // Now adjust the display order as per your request
    $first_comment = null;
    $second_comment = null;

    // Select one 5-star comment to be the first comment
    $five_star_comments = array_filter($comments, function($comment) {
        $rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));
        return $rating == 5;
    });

    if (!empty($five_star_comments)) {
        $five_star_comments = array_values($five_star_comments); // Reindex the array
        shuffle($five_star_comments); // Shuffle to pick a random one
        $first_comment = array_shift($five_star_comments);
        // Remove this comment from $comments
        $comments = array_filter($comments, function($comment) use ($first_comment) {
            return $comment->comment_ID != $first_comment->comment_ID;
        });
    }

    // Select one 3-star comment to be the second comment
    $three_star_comments = array_filter($comments, function($comment) {
        $rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));
        return $rating == 3;
    });

    if (!empty($three_star_comments)) {
        $three_star_comments = array_values($three_star_comments); // Reindex the array
        shuffle($three_star_comments); // Shuffle to pick a random one
        $second_comment = array_shift($three_star_comments);
        // Remove this comment from $comments
        $comments = array_filter($comments, function($comment) use ($second_comment) {
            return $comment->comment_ID != $second_comment->comment_ID;
        });
    }

    // Randomize the rest of the comments
    $comments = array_values($comments); // Reindex the array
    shuffle($comments);

    // Rebuild the $comments array in the desired order
    $new_comments = [];
    if ($first_comment) {
        $new_comments[] = $first_comment;
    }
    if ($second_comment) {
        $new_comments[] = $second_comment;
    }
    $comments = array_merge($new_comments, $comments);

    // Proceed with displaying the comments
    ob_start(); // Start output buffering
    echo '<h2 class="trusted-review-title">Recenzii ale clienților</h2>';

    echo '<div class="trusted-review-container">';

    // Calculate average rating
    // Fetch all approved WooCommerce reviews (including all ratings)
    $all_comments = get_comments([
        'post_id' => $product_id,
        'status'  => 'approve',
        'type'    => 'review',
        'number'  => 0 // Fetch all approved reviews
    ]);

    // Calculate total rating and review count from all approved reviews
    $total_rating = 0;
    $review_count = 0;

    foreach ($all_comments as $comment) {
        $rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));
        if ($rating) {
            $total_rating += $rating;
            $review_count++;
        }
    }

    // Calculate the average rating, rounded to 2 decimal places

    // $average_rating = $review_count > 0 ? round($total_rating / $review_count, 2) : 0;

    $sku = get_post_meta( $product_id, '_sku', true );  
    $review_data = get_review_data_with_cache( $sku ); 
    $average_rating = $review_data['average_rate'];

    if($average_rating <= 0 ){
		$average_rating = 5;
	}

    // Summary box

    echo '<div class="trusted-review-summary">';
    echo '<div class="trusted-review-summary-inner">';
    
    echo '<div class="trusted-rateMeta">';
    echo '<div class="stars"></div>';
    echo '<div class="scala" style="width:' . $average_rating * 20 . '%"></div>';
    echo '</div>';
    /*    
    echo '<div class="trusted-review-stars">';

    $star_image_url = plugin_dir_url(__FILE__) . 'assets/star.webp';
    for ($i = 0; $i < 5; $i++) {
        echo '<img class="trusted-star" src="' . esc_url($star_image_url) . '" alt="star">';
    }
    echo '</div>';
    */

    echo '<div class="trusted-review-rating">' . esc_html($average_rating) . '</div>';
    echo '<div class="trusted-review-text">Uimitor</div>';
    $nutri_leaf_url = get_nutrislim_assets_url() . 'nutri-leaf.svg';
    echo '<div class="trusted-review-logo"><img src="' . esc_url($nutri_leaf_url) . '" alt="logo" /></div>';
    echo '</div>';
    echo '</div>';

    // Swiper slider
    echo '<div class="trusted-swiper-container-wrapper">';
    $unique_id = uniqid('trusted-reviewswiper_');
    echo '<div class="swiper-container trusted-reviewswiper ' . esc_attr($unique_id) . '">';
    echo '<div class="swiper-wrapper">';

    // Loop through the comments in the desired order
    foreach ($comments as $comment) {
        $rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));
        //$comment_content = esc_html($comment->comment_content);
		$comment_content = !empty(trim($comment->comment_content)) ? esc_html($comment->comment_content) : esc_html__('The customer only left a rating.', 'nutrisslim-suiteV2');

        echo '<div class="swiper-slide trusted-bg-light-grey">';
        echo '<div class="trusted-revSlid" data-comment="' . $comment->comment_content . '">';
        echo '<div class="trusted-top-row">';
        echo '<div class="trusted-rateMeta">';
        echo '<div class="stars"></div>';
        echo '<div class="scala" style="width:' . $rating * 2 . '0%"></div>';
        echo '</div>';
        echo '<div class="checker"><span class="check"><img src="/wp-content/uploads/2024/03/whiteCheck.png"></span></div>';
        echo '</div>';
        $comment_date = get_comment_date('U', $comment); // Get the comment date as a Unix timestamp
        $current_time = current_time('timestamp'); // Get the current time as a Unix timestamp
        $time_diff = human_time_diff($comment_date, $current_time); // Calculate the time difference in a human-readable format        
        echo '<div class="trusted-review-date">' . sprintf( 
            esc_html__( '%s ago by %s', 'nutrisslim-suiteV2' ), 
            esc_html( $time_diff ), 
            htmlspecialchars( $comment->comment_author, ENT_QUOTES, 'UTF-8' ) 
        ) . '</div>';
        echo '<div class="trusted-revComment">';
        echo '<p class="threerows">' . $comment_content . '</p><p class="rmlink"><a href="#">' . esc_html__( 'Read more', 'nutrisslim-suiteV2' ) . '</a></p>';
        echo '</div>';
        echo '</div>'; // Close trusted-revSlid
        echo '</div>'; // Close swiper-slide
    }

    echo '</div>'; // Close swiper-wrapper

    // Add navigation buttons (Next and Previous)
    echo '<div class="swiper-button-next trusted-sw-button-next"></div>';
    echo '<div class="swiper-button-prev trusted-sw-button-prev"></div>';    

    echo '</div>';
    echo '</div>'; // Close trusted-swiper-container-wrapper
    echo '</div>'; // Close trusted-review-container

    // JavaScript for Swiper slider
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        function getSlidesPerView() {
            if (window.innerWidth >= 1078) {
                return 4.3;
            } else if (window.innerWidth >= 767) {
                return 2.4;
            } else {
                return 1.5;
            }
        }

        var swiper = new Swiper('.{$unique_id}', {
            simulateTouch: true,
            touchRatio: 1,
            grabCursor: true,
            slidesPerView: getSlidesPerView(),
            spaceBetween: 10,
            freeMode: true,
            preloadImages: false,
            lazy: true,
            mousewheel: {
                forceToAxis: true,
            },
            navigation: {
                nextEl: '.trusted-sw-button-next',
                prevEl: '.trusted-sw-button-prev',
            },            
            breakpoints: {
                0: {
                    slidesPerView: 0.8,
                    spaceBetween: 10,
                },
                560: {
                    slidesPerView: 1.2,
                    spaceBetween: 10,
                },                
                768: {
                    slidesPerView: 2.4,
                    spaceBetween: 10,
                },
                1078: {
                    slidesPerView: 4.3,
                    spaceBetween: 10,
                }
            }
        });

        window.addEventListener('resize', function() {
            /*
            swiper.params.slidesPerView = getSlidesPerView();
            swiper.update();
            */
        });

        document.querySelectorAll('p.threerows').forEach(function (el) {
            // Get the computed line height of the element
            let lineHeight = parseFloat(getComputedStyle(el).lineHeight);
        
            // Calculate the height of 3 lines
            let maxHeight = lineHeight * 3;
        
            // Check if the element's scroll height is greater than 3 lines
            if (el.scrollHeight > maxHeight) {
                el.classList.add('text-overflowed');
            }
        });

        jQuery(document).ready(function($) {
            // Handle click event on 'p.rmlink a'
            $('p.rmlink a').on('click', function(event) {
                event.preventDefault(); // Prevent default behavior of the link
        
                // Find closest div.trusted-revSlid
                var closestRevSlid = $(this).closest('div.trusted-revSlid');
        
                // Get the content of div.trusted-review-date and div.trusted-top-row
                var reviewDate = closestRevSlid.find('div.trusted-review-date').html();
                var topRow = closestRevSlid.find('div.trusted-top-row').html();
        
                // Get the data-comment attribute from closest div.trusted-revSlid
                var commentData = closestRevSlid.data('comment');

                console.log(reviewDate);
                console.log(topRow);
                console.log(commentData);

                // Prepare the content for the modal
                var modalContent = `
                    <div class=\"revData\">
                        <div class=\"trusted-review-date\">` + reviewDate + `</div>
                        <div class=\"trusted-top-row\">` + topRow + `</div>
                        <p>Comment:</p> <p>` + commentData + `</p>
                    </div>
                `;
        
                // Append the modal HTML with content to the body
                $('body').append(`
                    <div style=\"left:0\" class=\"modalHolder revModalHolder\">
                        <div class=\"modalwin\">
                            <a href=\"#\" class=\"closeRevMod closeModAll\">Close</a>
                            <h3>Recenzii ale clienților</h3>
                            ` + modalContent + `
                        </div>
                    </div>
                `);
        
            });

            $('body').on('click', '.closeRevMod', function(event) {
                event.preventDefault();
                $(this).closest('.modalHolder').remove(); // Remove the modal from the DOM
            });

        });
        

    });
    </script>";

    // Find the best review for Block B (preferably a 5-star review with the longest content)
    $best_review = null;

    // Combine all comments for selection
    $all_possible_reviews = $comments;

    // If we still need more comments, include manual comments
    if ($total_needed > 0) {
        // Fetch manual comments if not already fetched
        if (!isset($manual_comments)) {
            $manual_comments = get_comments([
                'meta_key'   => 'manual_display',
                'meta_value' => 1,
                'status'     => 'approve',
                'type'       => 'review',
                'number'     => 100,
            ]);
        }
        $all_possible_reviews = array_merge($all_possible_reviews, $manual_comments);
    }

    // Filter reviews suitable for the best review
    $potential_best_reviews = array_filter($all_possible_reviews, function($comment) {
        $rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));
        $comment_length = strlen(trim($comment->comment_content));
        return ($rating == 5) && $comment_length > 50;
    });

    // If no 5-star reviews with sufficient content, relax criteria
    if (empty($potential_best_reviews)) {
        $potential_best_reviews = array_filter($all_possible_reviews, function($comment) {
            $rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));
            $comment_length = strlen(trim($comment->comment_content));
            return ($rating >= 4) && $comment_length > 50;
        });
    }

    // Find the longest comment among the filtered ones
    usort($potential_best_reviews, function($a, $b) {
        return strlen($b->comment_content) - strlen($a->comment_content);
    });

    if (!empty($potential_best_reviews)) {
        $best_review = $potential_best_reviews[0];
    }

    if ($best_review) {
        $rating = intval(get_comment_meta($best_review->comment_ID, 'rating', true));
        echo '<div class="highlighted-review">';
        $nutri_quote_url = get_nutrislim_assets_url() . 'air-quote.svg';
        echo '<div class="trusted-review-quote"><img src="' . esc_url($nutri_quote_url) . '" alt="quote" /></div>';
        echo '<div class="trusted-rateMeta">';
        echo '<div class="stars"></div>';
        echo '<div class="scala" style="width:' . $rating * 2 . '0%"></div>';
        echo '</div>';
        echo '<div class="highlighted-review-comment">';
        echo '<p>' . esc_html($best_review->comment_content) . '</p>';
        echo '</div>'; // Close highlighted-review-comment

        echo '<div class="trusted-divider"></div>'; // Divider

        echo '<div class="highlighted-review-author">';
        echo '<p>' . esc_html__('Od', 'nutrisslim-suiteV2') . ' ' . esc_html($best_review->comment_author) . '</p>';
        echo '<div class="extra-review-logo"><img src="' . esc_url($nutri_leaf_url) . '" alt="logo" /></div>';
        echo '</div>'; // Close highlighted-review-author
        echo '</div>'; // Close highlighted-review
    }

    return ob_get_clean(); // Return the buffered output
}



// Block C
function trusted_get_reviews_block_c() {
    // Fetch manually selected reviews
    $manual_comments = get_comments([
        'meta_key' => 'manual_display',
        'meta_value' => 1,
        'status' => 'approve',
        'type' => 'review',
        'number' => 100, // Fetch up to 100 manual comments
    ]);

    // Shuffle the manual comments for random display
    shuffle($manual_comments);

    // If still no manual comments, return a message
    if (empty($manual_comments)) {
        return '<p>No reviews yet. Be the first to review this product!</p>';
    }

    ob_start(); // Start output buffering
    echo '<h2 class="trusted-review-title">Recenzii ale clienților</h2>';
    echo '<div class="trusted-review-container">';

    // Calculate average rating from manual comments
    $total_rating = 0;
    $review_count = 0;
    foreach ($manual_comments as $comment) {
        $rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));
        if ($rating) {
            $total_rating += $rating;
            $review_count++;
        }
    }
    $average_rating = $review_count > 0 ? round($total_rating / $review_count, 1) : 0;

    // Summary box
    echo '<div class="trusted-review-summary">';
    echo '<div class="trusted-review-summary-inner">';
    echo '<div class="trusted-review-stars">';
    $star_image_url = plugin_dir_url(__FILE__) . 'assets/star.webp';
    for ($i = 0; $i < 5; $i++) {
        echo '<img class="trusted-star" src="' . esc_url($star_image_url) . '" alt="star">';
    }
    $review_data = get_review_data_with_cache( $sku ); 
    echo '</div>';
    echo '<div class="trusted-review-rating">' . esc_html($review_data['average_rate']) . '</div>';
    echo '<div class="trusted-review-text">Uimitor</div>';
    $nutri_leaf_url = plugin_dir_url(__FILE__) . 'assets/nutri-leaf.svg';
    echo '<div class="trusted-review-logo"><img src="' . esc_url($nutri_leaf_url) . '" alt="logo" /></div>';
    echo '</div>';
    echo '</div>';

    // Swiper slider
    echo '<div class="trusted-swiper-container-wrapper">';
    $unique_id = uniqid('trusted-reviewswiper_');
    echo '<div class="swiper-container trusted-reviewswiper ' . esc_attr($unique_id) . '">';
    echo '<div class="swiper-wrapper">';

    // Loop through the manually selected reviews
    foreach ($manual_comments as $comment) {
        $rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));
        $comment_content = !empty(trim($comment->comment_content)) ? esc_html($comment->comment_content) : esc_html__('The customer only left a rating.', 'nutrisslim-suiteV2');

        echo '<div class="swiper-slide trusted-bg-light-grey">';
        echo '<div class="trusted-revSlid">';
        echo '<div class="trusted-top-row">';
        echo '<div class="trusted-rateMeta">';
        for ($i = 0; $i < $rating; $i++) {
            echo '<img class="trusted-star" src="' . esc_url($star_image_url) . '" alt="star">';
        }
        echo '</div>';
        echo '</div>';
        echo '<div class="trusted-review-date">' . esc_html(get_comment_date('F j, Y', $comment)) . '</div>';
        echo '<div class="trusted-revComment">';
        echo '<p>' . $comment_content . '</p>';
        echo '</div>';
        echo '</div>'; // Close trusted-revSlid
        echo '</div>'; // Close swiper-slide
    }

    echo '</div>'; // Close swiper-wrapper
    echo '<div class="swiper-scrollbar trusted-swiper-scrollbar"></div></div>';
    echo '</div>'; // Close trusted-swiper-container-wrapper
    echo '</div>'; // Close trusted-review-container

    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        function getSlidesPerView() {
            if (window.innerWidth >= 1078) {
                return 4.3;
            } else if (window.innerWidth >= 767) {
                return 2.4;
            } else {
                return 1.5;
            }
        }

        var swiper = new Swiper('.{$unique_id}', {
            simulateTouch: true,
            touchRatio: 1,
            grabCursor: true,
            slidesPerView: getSlidesPerView(),
            spaceBetween: 10,
            freeMode: true,
            preloadImages: false,
            lazy: true,
            scrollbar: {
                el: '.trusted-swiper-scrollbar',
                draggable: true,
            },
            mousewheel: {
                forceToAxis: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1.2,
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 2.4,
                    spaceBetween: 10,
                },
                1078: {
                    slidesPerView: 4.3,
                    spaceBetween: 10,
                }
            }
        });

        window.addEventListener('resize', function() {
            swiper.params.slidesPerView = getSlidesPerView();
            swiper.update();
        });
    });
    </script>";
	
	// Find the best 5-star review with a long comment for Block C
	$best_review = null;

	// Try to find the best review from the manually selected reviews first
	$manual_comments = get_comments([
		'meta_key' => 'manual_display',
		'meta_value' => 1,
		'status' => 'approve',
		'type' => 'review',
		'number' => 100, // Adjust to get the number of manual comments
	]);

	if (!empty($manual_comments)) {
		// Shuffle to get randomness
		shuffle($manual_comments);
		// Limit to the first 20 if needed
		$manual_comments = array_slice($manual_comments, 0, 20);
	}

	// Try to find the best review from the manual comments
	foreach ($manual_comments as $manual_comment) {
		$rating = intval(get_comment_meta($manual_comment->comment_ID, 'rating', true));
		$comment_length = strlen(trim($manual_comment->comment_content));

		// Find the best review (5 stars and long comment)
		if ($rating == 5 && $comment_length > 50 && ($best_review == null || $comment_length > strlen($best_review->comment_content))) {
			$best_review = $manual_comment;
		}
	}

	// If no suitable manual review was found, check regular reviews
	if ($best_review === null) {
		$comments = get_comments([
			'post_id' => $product_id,
			'status' => 'approve',
			'type' => 'review',
			'number' => 20, // Adjust to the number you need
		]);

		foreach ($comments as $comment) {
			$rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));
			$comment_length = strlen(trim($comment->comment_content));

			// Find the best review (5 stars and long comment)
			if ($rating == 5 && $comment_length > 50 && ($best_review == null || $comment_length > strlen($best_review->comment_content))) {
				$best_review = $comment;
			}
		}
	}

	// Display the best review
	if ($best_review) {
		echo '<div class="highlighted-review">';
		$nutri_quote_url = plugin_dir_url(__FILE__) . 'assets/air-quote.svg';
		echo '<div class="trusted-review-quote"><img src="' . esc_url($nutri_quote_url) . '" alt="quote" /></div>';
		echo '<div class="trusted-rateMeta">';
		
		// Display rating stars
		for ($i = 0; $i < $rating; $i++) {
			echo '<img class="trusted-star" src="' . esc_url($star_image_url) . '" alt="star">';
		}
		
		echo '</div>';
		echo '<div class="highlighted-review-comment">';
		echo '<p>' . esc_html($best_review->comment_content) . '</p>';
		echo '</div>'; // Close highlighted-review-comment

		echo '<div class="trusted-divider"></div>'; // Divider

		echo '<div class="highlighted-review-author">';
		echo '<p><strong>' . esc_html__('Reviewed by', 'nutrisslim-suiteV2') . ' ' . esc_html($best_review->comment_author) . '</strong></p>';
		$nutri_leaf_url = plugin_dir_url(__FILE__) . 'assets/nutri-leaf.svg';
		echo '<div class="extra-review-logo"><img src="' . esc_url($nutri_leaf_url) . '" alt="logo" /></div>';
		echo '</div>'; // Close highlighted-review-author
		echo '</div>'; // Close highlighted-review
	}

    return ob_get_clean(); // Return the buffered output
}

class Elementor_Trusted_Reviews_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'trusted_reviews_widget';
    }

    public function get_title() {
        return esc_html__('Trusted Reviews Widget', 'text-domain');
    }

    public function get_icon() {
        return 'eicon-review';
    }

    public function get_categories() {
        return ['nutrisslim'];
    }

    // Register the version control
    protected function _register_controls() {
        $this->start_controls_section('content_section', [
            'label' => esc_html__('Content', 'nutrisslim-suiteV2'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        // Add a dropdown control to choose between block A and B
        $this->add_control(
            'review_block_version',
            [
                'label' => esc_html__('Choose Review Block', 'nutrisslim-suiteV2'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'A' => esc_html__('Style 1', 'nutrisslim-suiteV2'),
                    'B' => esc_html__('Style 2', 'nutrisslim-suiteV2'),
                    'C' => esc_html__('Manual Only', 'nutrisslim-suiteV2'),
                ],
                'default' => 'A',
            ]
        );

        // Add input field for keyword or URL segment
        $this->add_control(
            'url_segments',
            [
                'label' => esc_html__('URL Segments (comma separated)', 'nutrisslim-suiteV2'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'description' => esc_html__('Enter comma-separated URL segments where the widget should be displayed.', 'nutrisslim-suiteV2'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $version = $settings['review_block_version'];
        $url_segments = $settings['url_segments'];

        if (empty($url_segments)) {
            return; // Exit early if no URL segments are specified
        }

        // Check if the current URL matches any of the segments
        $segments = array_map('trim', explode(',', $url_segments));
        $current_url = $_SERVER['REQUEST_URI'];
        $should_render = false;

        foreach ($segments as $segment) {
            if (strpos($current_url, $segment) !== false) {
                $should_render = true;
                break;
            }
        }

        // Only render the widget if the URL contains one of the specified segments
        if ($should_render) {
            if ($version === 'A') {
                echo '<div id="trusted-reviews-block-a" class="style-a">';
                echo trusted_get_reviews_block_a(); // Render Block A
                echo '</div>';
            }

            if ($version === 'B') {
                echo '<div id="trusted-reviews-block-b" class="style-b">';
                echo trusted_get_reviews_block_b(); // Render Block B
                echo '</div>';
            }

            if ($version === 'C') {
                echo '<div id="trusted-reviews-block-c" class="style-c">';
                echo trusted_get_reviews_block_c(); // Render Block C
                echo '</div>';
            }
        }
    }
}