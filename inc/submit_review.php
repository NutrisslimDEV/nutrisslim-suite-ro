<?php
// ==============================
// Submit Review page bootstrap
// ==============================
if ( ! defined('ABSPATH') ) exit;

if ( ! function_exists('create_or_update_submit_review_page') ) {
    function create_or_update_submit_review_page(): void {
        $page_slug  = 'submit-review';
        $page_title = __('Pošlji recenzijo', 'nutrisslim-suite');

        $page = get_page_by_path($page_slug);
        if ( $page === null ) {
            wp_insert_post([
                'post_title'   => $page_title,
                'post_name'    => $page_slug,
                'post_content' => '',
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_author'  => get_current_user_id() ?: 1,
            ]);
            return;
        }

        // Keep title synced with current language
        if ( $page->post_title !== $page_title ) {
            wp_update_post([
                'ID'         => (int) $page->ID,
                'post_title' => $page_title,
            ]);
        }
    }
    // Light-weight enough to run in admin
    add_action('admin_init', 'create_or_update_submit_review_page');
}

if ( ! function_exists('get_order_details') ) {
    /**
     * Returns basic info needed to render the form:
     *  - products purchased (display only; excludes zero-total line items)
     *  - customer email + name
     */
    function get_order_details( $order_id ): ?array {
        $order_id = (int) $order_id;
        if ( ! $order_id ) return null;

        $order = wc_get_order($order_id);
        if ( ! $order )   return null;

        $items    = $order->get_items();
        $products = [];      // for display (paid items only)
        $all_ids  = [];      // for submission (ALL items)

        foreach ( $items as $item ) {
            $product    = $item->get_product();
            if ( ! $product ) continue;

            $all_ids[]  = (int) $product->get_id();                 // include every item
            $item_total = (float) $item->get_total();

            // keep UI as-is: show only paid items
            if ( $item_total > 0 ) {
                $products[] = [
                    'name'      => $product->get_name(),
                    'thumbnail' => $product->get_image(),
                    'id'        => $product->get_id(),
                ];
            }
        }

        // de-dupe ids
        $all_ids = array_values(array_unique(array_filter(array_map('intval', $all_ids))));

        return [
            'products'        => $products,
            'all_product_ids' => $all_ids,
            'customer_email'  => $order->get_billing_email(),
            'customer_name'   => trim($order->get_billing_first_name() . ' ' . $order->get_billing_last_name()),
        ];
    }
}

// ==============================
// Page content (form UI)
// ==============================
if ( ! function_exists('filter_submit_review_page_content') ) {
    function filter_submit_review_page_content( string $content ): string {
        if ( ! is_page('submit-review') ) return $content;

        $order_id      = isset($_GET['order_id']) ? (int) $_GET['order_id'] : 0;
        $order_details = get_order_details($order_id);

        $products       = $order_details['products']        ?? [];
        $all_ids        = $order_details['all_product_ids'] ?? array_column($products, 'id'); // fallback
        $customer_email = $order_details['customer_email']  ?? '';
        $customer_name  = $order_details['customer_name']   ?? '';

        $formatted_product_ids = implode(',', array_map('intval', $all_ids));


        // Nonce for AJAX security
        $nonce = wp_create_nonce('ns_submit_reviews');

        ob_start(); ?>
        <div class="mass-reviews container container-px">
            <div class="review-intro">
                <h1 class="bold"><?php echo esc_html__('Părerea ta este importantă pentru noi', 'nutrisslim-suite'); ?></h1>
                <p><?php echo esc_html__('La Nature\'s Finest ne străduim întotdeauna să oferim cele mai bune produse și servicii clienților noștri apreciați. Ai vrea să evaluezi ultima ta achiziție?', 'nutrisslim-suite'); ?></p>
                <p><?php echo esc_html__('Ca mulțumire pentru timpul tău, îți vom trimite un cadou special împreună cu comanda ta!', 'nutrisslim-suite'); ?></p>

                <h4><?php echo esc_html__('Comanda ta', 'woocommerce'); ?></h4>
                <div class="products_holder grid-3_sm-2_xs-2">
                    <?php foreach ( $products as $product ): ?>
                        <div class="product_item col grid-middle-noGutter">
                            <div class="col-5_xs-4"><?php echo $product['thumbnail']; ?></div>
                            <div class="col-7_xs-8"><p><strong><?php echo esc_html($product['name']); ?></strong></p></div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <h4><?php echo esc_html__('Evaluează și scrie o recenzie pentru achiziția ta', 'nutrisslim-suite'); ?></h4>
            </div>

            <div class="form">
                <div class="nf-review_form">
                    <div class="review_fields">
                        <input type="hidden" id="review_product_ids"    name="review_product_ids"    value="<?php echo esc_attr($formatted_product_ids); ?>">
                        <input type="hidden" id="review_customer_email" name="review_customer_email" value="<?php echo esc_attr($customer_email); ?>">
                        <input type="hidden" id="review_customer_name"  name="review_customer_name"  value="<?php echo esc_attr($customer_name); ?>">
                        <input type="hidden" id="review_nonce"          name="review_nonce"          value="<?php echo esc_attr($nonce); ?>">

                        <div class="stars">
                            <div class="star">1</div>
                            <div class="star">2</div>
                            <div class="star">3</div>
                            <div class="star">4</div>
                            <div class="star active">5</div>
                        </div>

                        <select name="review_rating" id="review_rating" style="display:none;">
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>

                        <textarea name="review_review" id="review_text" cols="30" rows="5" placeholder="<?php echo esc_attr__('Spune-ne ce părere ai','nutrisslim-suite'); ?>"></textarea>
                        <button id="send_reviews"><?php echo esc_html__('Trimite','woocommerce'); ?></button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $content .= ob_get_clean();
        return $content;
    }
    add_filter('the_content', 'filter_submit_review_page_content');
}

// ==============================
// Bundle children helper (compat) + dispatcher
// ==============================
if ( ! function_exists('ns_ptr_get_nutrisslim_child_ids_compat') ) {
    /**
     * Compat shim used only if the canonical helper from the other plugin
     * (ptr_get_nutrisslim_child_ids) is not available.
     * Finds children by meta: nutrisslim_parent_id = {parent_id}
     */
    function ns_ptr_get_nutrisslim_child_ids_compat( $parent_product_id ): array {
        $parent_product_id = (int) $parent_product_id;
        if ( $parent_product_id <= 0 ) return [];

        $cache_key = 'ptr_nutrisslim_children_' . $parent_product_id;
        $cached    = wp_cache_get( $cache_key, 'ptr_reviews' );
        if ( false !== $cached ) return $cached;

        $children = wc_get_products([
            'limit'      => -1,
            'return'     => 'ids',
            'status'     => 'publish',
            'meta_query' => [[
                'key'     => 'nutrisslim_parent_id',
                'value'   => (string) $parent_product_id,
                'compare' => '=',
            ]],
        ]);

        if ( empty($children) ) {
            $from_parent_meta = get_post_meta($parent_product_id, '_nutrisslim_child_ids', true);
            if ( is_array($from_parent_meta) ) {
                $children = array_map('intval', $from_parent_meta);
            }
        }

        $children = array_values(array_unique(array_filter(array_map('intval', (array) $children))));
        wp_cache_set($cache_key, $children, 'ptr_reviews', 600);
        return $children;
    }
}

if ( ! function_exists('ns_get_children_for_bundle') ) {
    /**
     * Dispatcher: use canonical ptr_get_nutrisslim_child_ids() from the other plugin if present,
     * otherwise fall back to the compat shim above.
     */
    function ns_get_children_for_bundle( int $parent_id ): array {
        if ( function_exists('ptr_get_nutrisslim_child_ids') ) {
            return (array) ptr_get_nutrisslim_child_ids( $parent_id );
        }
        return ns_ptr_get_nutrisslim_child_ids_compat( $parent_id );
    }
}

// ==============================
// Target expansion (bundle <-> child)
// ==============================
if ( ! function_exists('ns_get_review_targets_for_product') ) {
    /**
     * All products that should receive the same review as $product_id:
     * - itself
     * - if bundle parent: add children
     * - if child: add parent
     */
    function ns_get_review_targets_for_product( int $product_id ): array {
        $targets    = [];
        $product_id = (int) $product_id;
        if ( $product_id <= 0 ) return $targets;

        $targets[] = $product_id;

        $product = wc_get_product($product_id);
        if ( $product ) {
            // Official Woo Bundles
            if ( method_exists($product, 'get_bundled_items') ) {
                $bundled_items = $product->get_bundled_items();
                if ( is_array($bundled_items) ) {
                    foreach ( $bundled_items as $item ) {
                        if ( is_object($item) && method_exists($item, 'get_product_id') ) {
                            $targets[] = (int) $item->get_product_id();
                        }
                    }
                }
            }

            // Custom "nutrisslim" bundle parent
            if ( method_exists($product, 'get_type') && $product->get_type() === 'nutrisslim' ) {
                $targets = array_merge($targets, ns_get_children_for_bundle($product_id));
            }

            // Heuristic: parent SKU starts with PanStoreGrouped-
            $sku = method_exists($product, 'get_sku') ? (string) $product->get_sku() : '';
            if ( $sku && strpos($sku, 'PanStoreGrouped-') === 0 ) {
                $targets = array_merge($targets, ns_get_children_for_bundle($product_id));
            }
        }

        // If this is a child, add its custom parent
        $parent_id = (int) get_post_meta($product_id, 'nutrisslim_parent_id', true);
        if ( $parent_id > 0 ) {
            $targets[] = $parent_id;
        }

        // Optional: parent meta with child IDs
        $also_children = get_post_meta($product_id, '_nutrisslim_child_ids', true);
        if ( is_array($also_children) ) {
            $targets = array_merge($targets, array_map('intval', $also_children));
        }

        return array_values(array_unique(array_filter(array_map('intval', $targets))));
    }
}

if ( ! function_exists('ns_expand_review_targets_from_request') ) {
    /**
     * Parse CSV/array of product IDs and expand each to its related targets.
     */
    /**
     * Parse CSV/array of product IDs from the form (i.e., all line items in the order)
     * and expand conservatively:
     *  - always include the product itself
     *  - if it's a child, also include its parent
     *  - if it's a parent, include ONLY the children that are ALSO in the submitted list
     *    (prevents spamming siblings that weren't purchased)
     */
    function ns_expand_review_targets_from_request( $raw_ids ): array {
        // Normalize to an int array (the submitted list is our allow-list)
        if ( is_string( $raw_ids ) ) {
            $base_ids = array_filter( array_map( 'intval', array_map( 'trim', explode( ',', $raw_ids ) ) ) );
        } elseif ( is_array( $raw_ids ) ) {
            $base_ids = array_filter( array_map( 'intval', $raw_ids ) );
        } else {
            $base_ids = [];
        }

        if ( empty( $base_ids ) ) {
            return [];
        }

        $allow = array_flip( $base_ids ); // quick membership test
        $targets = [];

        foreach ( $base_ids as $pid ) {
            $pid = (int) $pid;
            if ( $pid <= 0 ) continue;

            // always the product itself
            $targets[] = $pid;

            // if child -> include its parent
            $parent_id = (int) get_post_meta( $pid, 'nutrisslim_parent_id', true );
            if ( $parent_id > 0 ) {
                $targets[] = $parent_id;
            }

            // if parent -> include ONLY children that were also in the order (allow-list)
            $children = [];

            // official Woo Bundles children (if present)
            $product = wc_get_product( $pid );
            if ( $product && method_exists( $product, 'get_bundled_items' ) ) {
                $bundled_items = $product->get_bundled_items();
                if ( is_array( $bundled_items ) ) {
                    foreach ( $bundled_items as $item ) {
                        if ( is_object( $item ) && method_exists( $item, 'get_product_id' ) ) {
                            $children[] = (int) $item->get_product_id();
                        }
                    }
                }
            }

            // custom nutrisslim relation (compat/helper)
            $children = array_merge( $children, ns_get_children_for_bundle( $pid ) );

            if ( ! empty( $children ) ) {
                foreach ( $children as $cid ) {
                    $cid = (int) $cid;
                    // only add if that child is ALSO in the submitted list (was part of the order)
                    if ( $cid > 0 && isset( $allow[ $cid ] ) ) {
                        $targets[] = $cid;
                    }
                }
            }
        }

        // unique + clean
        $targets = array_values( array_unique( array_filter( array_map( 'intval', $targets ) ) ) );
        return $targets;
    }
}

// ==============================
// Body class (minor UX hook)
// ==============================
if ( ! function_exists('add_custom_body_class') ) {
    function add_custom_body_class( array $classes ): array {
        if ( is_page('submit-review') ) {
            $classes[] = 'submit-review';
        }
        return $classes;
    }
    add_filter('body_class', 'add_custom_body_class');
}

// ==============================
// AJAX: submit reviews
// ==============================
if ( ! function_exists('handle_submit_reviews') ) {
    function handle_submit_reviews(): void {
        // Basic required fields
        if ( ! isset(
            $_POST['review_product_ids'],
            $_POST['review_rating'],
            $_POST['review_review'],
            $_POST['review_customer_email'],
            $_POST['review_customer_name'],
            $_POST['review_nonce']
        ) ) {
            wp_send_json_error('Missing required parameters.');
        }

        // CSRF check
        if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['review_nonce'] ) ), 'ns_submit_reviews' ) ) {
            wp_send_json_error('Invalid nonce.');
        }

        // Parse/sanitize fields
        $raw_product_ids       = $_POST['review_product_ids']; // CSV or array
        $review_product_ids    = ns_expand_review_targets_from_request( $raw_product_ids );
        $review_rating         = max( 1, min( 5, (int) $_POST['review_rating'] ) );
        $review_review         = sanitize_textarea_field( wp_unslash( $_POST['review_review'] ) );
        $review_customer_email = sanitize_email( $_POST['review_customer_email'] );
        $review_customer_name  = sanitize_text_field( wp_unslash( $_POST['review_customer_name'] ) );

        if ( empty($review_product_ids) ) {
            wp_send_json_error('No valid product IDs.');
        }
        if ( empty($review_customer_email) || ! is_email($review_customer_email) ) {
            wp_send_json_error('Invalid email address.');
        }
        if ( $review_review === '' ) {
            wp_send_json_error('Review text is required.');
        }

        $review_hash = md5( strtolower($review_customer_email) . '|' . $review_rating . '|' . $review_review );

        $inserted = 0;
        foreach ( $review_product_ids as $product_id ) {
            // Basic dupe guard: same author_email + similar content on this product
            $dupe = get_comments([
                'post_id'      => $product_id,
                'author_email' => $review_customer_email,
                'type'         => 'review',
                'status'       => 'all',
                'search'       => $review_review,
                'number'       => 1,
            ]);
            if ( $dupe ) {
                continue;
            }

            $commentdata = [
                'comment_post_ID'      => $product_id,
                'comment_author'       => $review_customer_name,
                'comment_author_email' => $review_customer_email,
                'comment_content'      => $review_review,
                'comment_type'         => 'review',
                'comment_approved'     => 0, // keep for moderation
                'comment_agent'        => 'NF Mass Review',
            ];

            $comment_id = wp_insert_comment( wp_slash( $commentdata ) );

            if ( $comment_id ) {
                update_comment_meta( $comment_id, 'rating', (int) $review_rating );
                update_comment_meta( $comment_id, '_ns_review_hash', $review_hash );
                update_comment_meta( $comment_id, 'verified', 1 ); // simple theme flag

                // If you auto-approve, you can nudge Woo to refresh ratings:
                // if ( function_exists('wc_update_product_rating_counts') ) wc_update_product_rating_counts($product_id);
                // wc_delete_product_transients($product_id);

                $inserted++;
            } else {
                error_log( 'Failed to insert review for product ID: ' . $product_id );
            }
        }

        if ( $inserted > 0 ) {
            wp_send_json_success( 'Recenzije so bile uspešno poslane.' );
        }
        wp_send_json_error( 'Ni bilo mogoče dodati recenzij (morda podvojene ali napaka pri vnosu).' );
    }

    add_action('wp_ajax_submit_reviews',        'handle_submit_reviews');
    add_action('wp_ajax_nopriv_submit_reviews', 'handle_submit_reviews');
}
