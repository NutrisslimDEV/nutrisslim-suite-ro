<?php

function reviewTable($order) {


?>
<section id="odetails" class="order-details" data-oid="<?php echo $order->get_id(); ?>">
    <div class="container">
        <div class="grid">
            <div id="orderInfo" class="col-8_sm-12">
                <h4><?php echo __('Review your orders', 'nutrisslim-suiteV2'); ?></h4>

                <div class="grid articles">
                    <div class="col-6 label"><?php echo __('Product name', 'nutrisslim-suiteV2'); ?></div>
                    <div class="col-2 text-right label"><?php echo __('Pricing', 'nutrisslim-suiteV2'); ?></div>
                    <div class="col-2 text-right label"><?php echo __('Quantity', 'nutrisslim-suiteV2'); ?></div>
                    <div class="col-2 text-right label"><?php echo __('Total', 'nutrisslim-suiteV2'); ?></div>
                    <?php 
                        $totalproducts = 0;
                        foreach ($order->get_items() as $item_id => $item) :
                            // Skip items with 'nutrisslim_parent_id' meta key
                            if (isset($item['nutrisslim_parent_id'])) {
                                continue;
                            }
                            $lid = '';
                            if ($item->get_meta('lid', true)) {
                                $lid = $item->get_meta('lid', true);
                            }

                            $product = $item->get_product();
                            $item_name = $item->get_name();
                            $item_quantity = $item->get_quantity();

                            // Check if the product type is 'nutrisslim'
                            if ($product->get_type() == 'nutrisslim') {
                                if (isset($item['subscription']) && $item['subscription']) {
                                    $item_price = get_custom_product_price($product->get_id(), $item_quantity, $lid, '', true, true);
                                } else if (isset($item['regulargift'])) {
                                    $item_price = 0;
                                } else {
                                    $item_price = get_custom_product_price($product->get_id(), $item_quantity, $lid, '', true);
                                }
                                $item_total = $item_price;
                                $item_price = $item_total / $item_quantity;
                            } else {
                                $item_total = $item->get_subtotal();
                                $item_price = $item_total / $item_quantity;                                        
                                // $item_total = $item->get_total();
                            }
                            // Calculate price excluding tax
                            $totalproducts = $totalproducts + $item_total;
                            if (!wc_prices_include_tax() && $product instanceof WC_Product) {
                                $item_price = wc_get_price_including_tax($product, array('price' => floatval($item_price)));
                                $item_total = wc_get_price_including_tax($product, array('price' => floatval($item_total)));
                            }
                            
                            // Format the prices
                            $item_price_formatted = wc_price($item_price);
                            $item_total_formatted = wc_price($item_total);

                            // error_log('Total products price: ' . $totalproducts);

                            ?>
                    <div class="col-6"><?php echo esc_html($item_name); ?></div>
                    <div class="col-2 text-right"><?php echo wp_kses_post($item_price_formatted); ?></div>
                    <div class="col-2 text-right"><?php echo esc_html($item_quantity); ?></div>
                    <div class="col-2 text-right"><?php echo wp_kses_post($item_total_formatted); ?></div>
                    <?php endforeach; ?>
                </div>
                <div class="grid summary">
                    <?php
                        // Fetch order totals
                        $order_subtotal = wc_price($totalproducts);
                        $order_shipping = wc_price($order->get_shipping_total());
                        // Loop through each fee in the order

                        $order_payment_fee = wc_price($order->get_total() - $order->get_subtotal() - $order->get_shipping_total());
                        $order_total = wc_price($order->get_total());
                        $order_tax = wc_price($order->get_total_tax());
                        ?>

                    <div class="col-8 text-right label"><?php echo __('Subtotal', 'nutrisslim-suiteV2'); ?></div>
                    <div class="col-4 text-right"><?php echo wp_kses_post($order_subtotal); ?></div>
                    <div class="col-8 text-right label">
                        <?php echo __('Shipping', 'nutrisslim-suiteV2') . '<span class="wo-tax"> (fără TVA)</span>'; ?>
                    </div>
                    <div class="col-4 text-right"><?php echo wp_kses_post($order_shipping); ?>
                    </div>

                    <?php
                            foreach ( $order->get_fees() as $fee ) {
                                // Get the fee name
                                $fee_name = $fee->get_name();

                                // Get the fee total and total tax
                                $fee_total = $fee->get_total();
                                $fee_total_tax = $fee->get_total_tax();

                                // Calculate the total including tax
                                $fee_total_incl_tax = wc_price( $fee_total );

                                // Output the fee name and total including tax
                                echo '<div class="col-8 text-right label">' . __(esc_html( $fee_name ), 'nutrisslim-suiteV2') . '<span class="wo-tax"> (fără TVA)</span>' .'</div>';
                                echo '<div class="col-4 text-right">' . $fee_total_incl_tax . '</div>';
                            }
                        ?>

                    <div class="col-8 text-right label znesek"><?php echo __('Total', 'nutrisslim-suiteV2'); ?></div>
                    <div class="col-4 text-right"><?php echo wp_kses_post($order_total); ?></div>
                    <div class="col-8 text-right"><?php echo __('(with VAT)', 'nutrisslim-suiteV2'); ?>
                    </div>
                    <div class="col-4 text-right"><?php echo wp_kses_post($order_tax); ?></div>
                </div>
            </div>
            <div id="customerInfo" class="col-4_sm-12">
                <div class="grid shipping">
                    <?php
                        $billing_address = $order->get_formatted_billing_address();
                        $shipping_address = $order->get_formatted_shipping_address();
                        ?>
                    <?php if ($billing_address === $shipping_address) : ?>
                    <div style="padding-bottom:0" class="col-12">
                        <h4><?php echo __('Shipping and Billing Address', 'nutrisslim-suiteV2'); ?></h4>
                    </div>
                    <div class="col-12"><?php echo wp_kses_post($billing_address); ?></div>
                    <?php else : ?>
                    <div style="padding-bottom:0" class="col-12">
                        <h4><?php echo __('Shipping Address', 'nutrisslim-suiteV2'); ?></h4>
                    </div>
                    <div class="col-12"><?php echo wp_kses_post($shipping_address); ?></div>
                    <div style="padding-bottom:0" class="col-12">
                        <h4><?php echo __('Billing Address', 'nutrisslim-suiteV2'); ?></h4>
                    </div>
                    <div class="col-12"><?php echo wp_kses_post($billing_address); ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-12 conclusion">
                <p class="text-center">
                    <?php echo __('Thank you for your purchase. We wish you a lovely rest of the day!', 'nutrisslim-suiteV2'); ?>
                </p>
                <p class="text-center"><?php echo __('Your Nature\'s Finest', 'nutrisslim-suiteV2'); ?></p>
            </div>
        </div>
    </div>
</section>
<?php
}

add_action('woocommerce_thankyou', 'custom_change_order_status_on_cod', 10, 1);
function custom_change_order_status_on_cod($order_id) {
    if (!$order_id) {
        return;
    }

    // Get the order object
    $order = wc_get_order($order_id);

    // Get order creation time
    $order_date = $order->get_date_created(); // Returns a DateTime object
    $current_time = new DateTime(); // Get the current time
    $interval = $current_time->getTimestamp() - $order_date->getTimestamp(); // Time difference in seconds

    // Check if the payment method is COD, the order status is not completed, and the order is not older than 20 minutes
    if ($order->get_payment_method() == 'cod' && $order->get_status() !== 'completed' && $interval <= 1200) {
        // Change the order status to "on-hold"
        $order->update_status('on-hold', __('Order status changed to On hold due to COD payment method', 'woocommerce'));
    }

    // Check if the payment method is Stripe, the order status is not completed, and the order is not older than 20 minutes
    if ($order->get_payment_method() == 'stripe' && $order->get_status() !== 'completed' && $interval <= 1200) {
        // Change the order status to "on-hold"
        // $order->update_status('on-hold', __('Order status changed to On hold due to Stripe payment method', 'woocommerce'));
    }
}

//function custom_change_order_status_on_cod($order_id) {
//    if (!$order_id) {
//        return;
//    }
//
//    // Get the order object
//    $order = wc_get_order($order_id);
//
//    // Check if the payment method is COD
//    if ($order->get_payment_method() == 'cod') {
//        // Change the order status to "pending"
//        $order->update_status('wc-on-hold', __('Order status changed to On hold due to COD payment method', 'woocommerce'));
//    }
//    if ($order->get_payment_method() == 'stripe') {
//        // Change the order status to "pending"
//        // $order->update_status('wc-on-hold', __('Order status changed to On hold due to Stripe payment method', 'woocommerce'));
//    }
//}

// // Schedule the event to run every 15 minutes
// if ( ! wp_next_scheduled( 'update_order_every_fifteen_minutes' ) ) {
//     wp_schedule_event( time(), 'fifteen_minutes', 'update_order_every_fifteen_minutes' );
// }

// // Add a custom interval to the schedule
// add_filter( 'cron_schedules', 'add_fifteen_minutes_schedule' );
// function add_fifteen_minutes_schedule( $schedules ) {
//     $schedules['fifteen_minutes'] = array(
//         'interval' => 15 * 60,
//         'display'  => __( 'Every Fifteen Minutes' ),
//     );
//     return $schedules;
// }

// // Hook into that action that'll fire every three minutes
// add_action( 'update_order_every_fifteen_minutes', 'moveOrderToProccessing' );

// function moveOrderToProccessing() {

//     global $wpdb;

//     // Calculate the time three hours ago
//     $three_hours_ago = gmdate( 'Y-m-d H:i:s', time() - ( 3 * HOUR_IN_SECONDS ) );

//     // Query to fetch orders directly from the database
//     $results = $wpdb->get_results( "
//         SELECT orders.id
//         FROM {$wpdb->prefix}wc_orders AS orders
//         WHERE orders.type = 'shop_order'
//         AND orders.status = 'wc-on-hold'
//         AND orders.payment_method IN ('cod', 'stripe')
//         AND orders.date_created_gmt < '{$three_hours_ago}'
//     " );

//     // Debugging: Log the query results
//     if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
//         // error_log( 'Direct query results: ' . print_r( $results, true ) );
//     }

//     foreach ($results as $result) {
//         # code...
//         $order = new WC_Order($result->id);

//         // Disable the customer-processing-order email
//         add_filter('woocommerce_email_enabled_customer_processing_order', '__return_false');
//         $order->update_status('wc-processing', 'Automatically moved to processing.');
//         // Re-enable the customer-processing-order email
//         remove_filter('woocommerce_email_enabled_customer_processing_order', '__return_false');

//     }
// }

// // This add order to pending if after purchase is enabled
// add_filter( 'woocommerce_cod_process_payment_order_status','change_cod_payment_order_status', 10, 2 );
// function change_cod_payment_order_status( $order_status, $order ) {
// 	$enabled = get_field('after_purchase_enabled', 'options');
// 	if ($enabled) {
// 		return 'pending';
// 	} else {
// 		return 'processing';
// 	}
// }

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Offers settings',
        'menu_title'    => 'Offers',
        'menu_slug'     => 'after-purchase-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false,
        'parent_slug'   => 'woocommerce'
    ));
}

add_action('wp_body_open', 'thankyouContent');
function thankyouContent() {

    $enabled = get_field('after_purchase_enabled', 'options');

    if ( is_checkout() && is_wc_endpoint_url('order-received') ) {

        global $wp;
        $order_id = absint($wp->query_vars['order-received']); // The order ID
        $order = wc_get_order( $order_id ); // The WC_Order object
        $method = $order->get_payment_method();
        $status = $order->get_status();
        $first_name = $order->get_billing_first_name();
        $order_email = $order->get_billing_email();

        $items = get_field('initial_offer', 'option');
        $prices = array();

        $delivery_days_text = get_delivery_days_text_from_order($order);

        // If order is afterpurchase

        // Retrieve meta with WooCommerce's function
        $is_afterpurchase = $order->get_meta('afterpurchase');

        // set here if there is no more upsells.

        if (isset($_GET['product_id']) && ($status == 'pending' || $status == 'on-hold') && ($is_afterpurchase === 'yes')) {
            // If it have product_id arg, if is cache on delivery and if is 'pending' or 'on-hold' status
            $items = get_field('initial_offer', 'option');
            $prices = array();

            foreach ($items as $item) {
                if ($item['price']) {
                    $item_product = wc_get_product($item['product']);
                    $children_ids = $item_product->get_children();
                    $prices[$item['jp_product'][0]] = $item['jp_price'];
                    foreach ($children_ids as $children_id) {
                        $prices[$children_id] = $item['jp_price'];
                    }
                }
            }

            $extrItems = $_GET['product_id'];
            $extrItems = explode (",", $extrItems);

            foreach ($extrItems as $extrItem) {
                $extrItemPrice = get_field('default_price', 'option');
                if ($prices[$extrItem]) {
                    $extrItemPrice = $prices[$extrItem];
                }
                if ($extrItem != 'none') {
                    $order->update_meta_data( '_jackpot_completed', true );
                    $order->add_product( get_product( $extrItem ), 1, [
                        'subtotal' => $extrItemPrice, // e.g. 32.95
                        'total' => $extrItemPrice, // e.g. 32.95
                    ]);
                }
            }
            $order->calculate_totals();
            $order->save();
            $order->update_status('wc-processing', 'Upsell completed successfully.');

        }

        $bank_details = get_option('woocommerce_bacs_accounts');

        // eh_paypal_express
        if ( (in_array($method, ['cod', 'stripe'])) && $enabled && ($is_afterpurchase !== 'yes') ) {

            echo '<section class="note" data-order-id="' . $order_id . '"">';
            echo '<div class="container">';
            echo '<h3>' . $first_name . ', ' . __('Su pedido se ha completado', 'nutrisslim-suiteV2') . '</h3>';
            echo '<p>' . __('Thank you for choosing our products.', 'nutrisslim-suiteV2') . '</p>';
            echo '<p>' . __('Order number', 'nutrisslim-suiteV2') . ': <strong>' . $order_id . '</strong></p>';
            echo '<p>' . sprintf(__('Una confirmación de su pedido será enviada a su dirección de correo electrónico en %1$s.', 'text-domain'), '<strong>' . esc_html($order_email) . '</strong>') . '</p>';
            echo '<p><a id="pregled-narucila" data-oid="' . $order_id . '" class="btn wired-btn elementor-button" href="#">' . __('Review of your order', 'nutrisslim-suiteV2') . ':</a></p>';
            echo '<div class="timer-after-purchase">';
            echo '<h3>' . __('Special offer', 'nutrisslim-suiteV2') . '</h3>';
            echo '<p>' . __('We\'ve further discounted selected products for a limited time!', 'nutrisslim-suiteV2') . '</p>';
            echo '<div class="timer">';
            echo '<div class="minutes timer-circle">10</div>';
            echo '<div class="separator">:</div>';
            echo '<div class="seconds timer-circle">00</div>';
            echo '</div>';
            echo '</div>';

            echo '</section>';


            $has_book_file = false;

            // Loop through products to check if any have the 'book_file' field
            foreach ($order->get_items() as $item_id => $item) {
                $product = $item->get_product();

                // Check if the product has the ACF 'book_file' field
                $book_file = get_field('book_file', $product->get_id());

                if ($book_file) {
                    $has_book_file = true; // Mark that at least one product has the 'book_file' field
                    break; // Exit the loop once we find one product with the field
                }
            }

            // If any product has the 'book_file' field, output the section with the details
            if ($has_book_file) {
                echo '<section class="book-files-section">';
                echo '<div class="container">';

                foreach ($order->get_items() as $item_id => $item) {
                    $product = $item->get_product();

                    // Check if the product has the ACF 'book_file' field
                    $book_file = get_field('book_file', $product->get_id());
                    $book_cover = get_field('cover_image', $product->get_id());

                    if ($book_file) {
                        // Print Title, Description, and File URL
                        echo '<div class="bfileHolder grid-middle">';
                        echo '<div class="col-4_sm-12 imgHold">';
                        if ($book_cover) {
                            echo wp_get_attachment_image($book_cover, 'medium');
                        }
                        echo '</div>'; // col
                        echo '<div class="col-8_sm-12 contHold">';
                        echo '<h3>' . esc_html($book_file['title']) . '</h3>';
                        echo '<p>' . esc_html($book_file['description']) . '</p>';
                        echo '<p class="text-center"><a href="' . esc_url($book_file['url']) . '" target="_blank">' . __('Download book', 'nutrisslim-suiteV2') . '</a></p>';
                        echo '</div>'; // col
                        echo '</div>';
                    }
                }

                echo '</div>';
                echo '</section>'; // Closing section tag
            }

            echo '<section class="note finalNote">';
            echo '<div class="container">';
            echo '<h3>' . sprintf(esc_html__('%1$s, Comanda dvs. a fost finalizată', 'text-domain'), esc_html($first_name)) . '</h3>';
            echo '<p><strong>' . __('Thank you for choosing our products.', 'nutrisslim-suiteV2') . '</strong></p>';

            echo '<p>' . __('At Nature\'s Finest, we\'ve been committed to offering the best natural solutions for a healthy life for 10 years – and thanks to you, we can continue this vision!', 'nutrisslim-suiteV2') . '</p>';

            echo '<p>' . __('We will notify you immediately once your package is ready.', 'nutrisslim-suiteV2') . '<br /><br /></p>';

            echo '<p>' . __('Order number', 'nutrisslim-suiteV2') . ': <strong>' . $order_id . '</strong></p>';

            echo '<p>' . sprintf(__('A confirmation of your order will be sent to your email address at <strong>%1$s</strong>.', 'nutrisslim-suiteV2'), esc_html($order_email)) . '</p>';
            if ($order && $order->get_status() === 'pending') {
                echo '<p><a id="show-offer" data-oid="' . $order_id . '" class="btn wired-btn elementor-button" href="#">' . __('Show additional offer:', 'nutrisslim-suiteV2') . '</a></p>';
            }

            echo '</section>';

            reviewTable($order);

            ?>

            <?php

            echo '<section style="" class="initial-offer">';

            $ato = sprintf( __( 'Add to order', 'nutrisslim-suiteV2') );
            $rfo = sprintf( __( 'Remove from order', 'nutrisslim-suiteV2') );

            echo '<div class="container">';
            echo '<div id="labelHolder" class="grid-4_md-3_sm-2 offerProducts woocommerce babesupsell" data-ato="' . $ato . '" data-rfo="' . $rfo . '">';

            $items = get_field('initial_offer', 'option');

            foreach ($items as $item) {
                $price = $item['price'];
                $pid = $item['product'];
                $_product = wc_get_product( $pid );
                echo '<div class="product col">';
                echo '<div class="inner">';

                $offer_price = $item['price'];
                $regular_price = $_product->get_regular_price();
                if (!wc_prices_include_tax()) {
                    $offer_price_with_tax = wc_get_price_including_tax( $_product, array( 'price' => $offer_price ) );
                    $regular_price_with_tax = wc_get_price_including_tax( $_product, array( 'price' => $regular_price ) );
                }
                $discount_percentage = (($regular_price - $offer_price) / $regular_price) * 100;
                $discount_percentage = round($discount_percentage);
                echo '<div class="image-holder"><span class="onsale">-' . $discount_percentage . '%</span><img src="' . wp_get_attachment_image_src(get_post_thumbnail_id($pid), 'medium')[0] . '" class="img-responsive"></div>';
                echo '<h3 style="font-size:19px;line-height:21px;margin-top:10px;">' . get_the_title($pid) . '</h3>';
                $short_description = $_product->get_short_description();

                if (empty($short_description)) {
                    $description = $_product->get_description();
                    $short_description = wp_trim_words($description, 10, '...');
                } else {
                    $short_description = wp_trim_words($short_description, 10, '...');
                }

                echo do_shortcode('[product_rating id="' . $pid . '"]');
                echo '<div class="desc"><p>' . $short_description . '</p></div>';
                $disabled = '';
                echo '<div class="rateWidget noVariation">';

                echo '<div class="col price">';
                echo '<del>' . wc_price($regular_price_with_tax) . '</del>';
                echo '<span>' . wc_price($offer_price_with_tax) . '</span>';
                echo '</div>';// end pricecol
                echo '</div>';// end grid
                echo '<div class="buycatalog"><button class="org-btn selectpro"
                data-pid="' . $pid . '"
                data-price="' . $offer_price . '"
                data-offer-type="initial">' . $ato . '</button></div>';
                echo '</div>';
                echo '</div>';
            }

            echo '</div>'; // offerProducts
            echo '</div>'; // container

            echo '<div class="container getDone">';
            if (in_array($method, ['cod'])) {
                echo '<a id="to-cart" dataAdd="" class="to-cart org-btn" data-method="' . $method . '" data-goto="final" data-oid="' . $order_id . '" href="#" class="">';
                _e('Complete order', 'nutrisslim-suiteV2');
                echo '</a>';
            } else {
                echo '<a id="add-extra-order" dataAdd="" class="to-extra-cart org-btn" data-method="' . $method . '" data-goto="final" data-oid="' . $order_id . '" href="#" class="">';
                _e('Complete order', 'nutrisslim-suiteV2');
                echo '</a>';
            }
            echo '<p class="text-center"><a id="straighttofinal" data-oid="' . $order_id . '" href="#">' . __( 'I don’t want this offer', 'nutrisslim-suiteV2') . '</a></p>';
            echo '</div>';

            echo '</section>';


            echo '<section style="" class="last-offer">';
            echo '<div class="container">';
            echo '<a class="close gotopregled init" data-oid="' . $order_id . '" href="#"><i class="eicon-editor-close"></i></a>';
            echo '<div class="wrapper">';
            echo '<div class="grid-1 offerProducts woocommerce">';


            $items = get_field('last_offer', 'option');

            // Check if $items is a valid array
            if (is_array($items) && !empty($items)) {
                $random_item = $items[array_rand($items)];
                $_product = wc_get_product($random_item['product']);

                $offer_price = $random_item['price'];
                $regular_price = $_product ? $_product->get_regular_price() : 0;

                // Ensure the product object is valid
                if ($_product instanceof WC_Product) {
                    // Add tax to the offer price
                    $offer_price_with_tax = wc_get_price_including_tax($_product, ['price' => floatval($offer_price)]);
                } else {
                    echo 'Invalid product specified.';
                }
            } else {
                echo '<p>No offers are available at this time.</p>';
            }

            // Ensure the product object is valid
            if ($_product instanceof WC_Product) {
                // Add tax to the offer price
                $offer_price_with_tax = wc_get_price_including_tax($_product, ['price' => floatval($offer_price)]);

                // Add tax to the regular price
                $regular_price_with_tax = wc_get_price_including_tax($_product, ['price' => floatval($regular_price)]);
            } else {
                // Fallback if product object is invalid
                $offer_price_with_tax = $offer_price;
                $regular_price_with_tax = $regular_price;
            }

            // Format the prices with tax
            $formatted_offer_price = wc_price($offer_price_with_tax);
            $formatted_regular_price = wc_price($regular_price_with_tax);


            if ($regular_price > 0) {
                $discount_percentage = round(((floatval($regular_price) - floatval($offer_price)) / floatval($regular_price)) * 100);
            } else {
                $discount_percentage = 0;
            }


            echo '<div class="col timer-after-purchase">';
            echo '<h3>' . sprintf(__('<span>Last chance</span><br /> Get %1$s%% off!', 'nutrisslim-suiteV2'), esc_html($discount_percentage)) . '</h3>';
            echo '<div class="timer lastoffer-timer">';
            echo '<div class="minutes timer-circle">05</div>';
            echo '<div class="separator">:</div>';
            echo '<div class="seconds timer-circle">00</div>';
            echo '</div>';
            echo '</div>';

            $price = $random_item['price'];
            $pid = $random_item['product'];
            $img = $random_item['image'];
            $_product = wc_get_product( $pid );
            echo '<div class="product col">';
            echo '<div class="inner grid">';

            $offer_price = floatval($offer_price);
            $regular_price = floatval($regular_price);


            if ($offer_price < $regular_price) {
                $discount_percentage = (($regular_price - $offer_price) / $regular_price) * 100;
            } else {
                $offer_price = $regular_price;
                $discount_percentage = 0;
            }

            $discount_percentage = round($discount_percentage);
            if ($img) {
                $imgsrc = wp_get_attachment_image_url($img, 'medium');
            } else {
                $imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id($pid), 'medium')[0];
            }
            echo '<div class="image-holder col-12"><span class="onsale">-' . $discount_percentage . '%</span><img src="' . $imgsrc . '" class="img-responsive"></div>';
            echo '<div class="holder col-12">';
            echo '<h3 style="font-size:19px;line-height:21px;margin-top:10px;">' . get_the_title($pid) . '</h3>';
            /*if ($_product instanceof WC_Product) {
                // Safely get the short description
                $short_description = $_product->get_short_description();
                echo '<p>' . esc_html($short_description) . '</p>';
            } else {
                // Handle invalid product
                $short_description = 'Product description not available.';
                echo '<p>' . esc_html($short_description) . '</p>';
            }*/

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

            if (count($comments) > 0) {
                $output .= do_shortcode('[product_rating id="' . $pid . '"]');
            }

            echo '<div class="desc"><p>' . $short_description . '</p></div>';
            $disabled = '';
            echo '<div class="rateWidget noVariation">';

            echo '<div class="price">';
            echo '<del>' . $regular_price_with_tax .get_woocommerce_currency_symbol() . '</del>';
            echo '<span>' . $offer_price_with_tax . get_woocommerce_currency_symbol() . '</span>';
            echo '</div>';// end pricecol
            // $ato = sprintf( __( '<strong>Add to order</strong><br />and complete the purchase', 'nutrisslim-suiteV2') );
            echo '</div>';// end grid
            echo '</div>';// holder
            echo '<div class="buycatalog col-12">';


            if (in_array($method, ['cod'])) {
                echo '<button id="to-cart" class="org-btn to-cart"
                data-oid="' . $order_id . '"
                data-method="' . $method . '"
                data-goto="complete"
                data-add=\'' . wp_json_encode([[
                                    'id' => (int) $pid,
                                    'price' => (float) $offer_price_with_tax,
                                    'offer_type' => 'last',
                                ]]) . '\'">' . $ato . '</button>';
                        } else {
                            echo '<button id="add-extra-order" class="org-btn to-extra-cart"
                data-oid="' . $order_id . '"
                data-method="' . $method . '"
                data-goto="complete"
                data-add=\'' . wp_json_encode([[
                                    'id' => (int) $pid,
                                    'price' => (float) $offer_price_with_tax,
                                    'offer_type' => 'last',
                                ]]) . '\'">' . $ato . '</button>';
            }


            echo '<p class="text-center"><a class="gotopregled final" data-oid="' . $order_id . '" href="#">' . __( 'I don’t want this offer', 'nutrisslim-suiteV2') . '</a></p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '</div>'; // offerProducts
            echo '</div>'; // wrapper
            echo '</div>'; // container

            echo '</section>';

        } else {

            echo '<section class="note finalNote">';
            echo '<div class="container">';
            echo '<h3>' . sprintf(esc_html__('%1$s, Comanda dvs. a fost finalizată', 'text-domain'), esc_html($first_name)) . '</h3>';
            echo '<p><strong>' . __('Thank you for choosing our products.', 'nutrisslim-suiteV2') . '</strong></p>';
            echo '<p>' . __('At Nature\'s Finest, we\'ve been committed to offering the best natural solutions for a healthy life for 10 years – and thanks to you, we can continue this vision!', 'nutrisslim-suiteV2') . '</p>';

            echo '<p>' . __('We will notify you immediately once your package is ready.', 'nutrisslim-suiteV2') . '<br /><br /></p>';

            echo '<p>' . __('Order number', 'nutrisslim-suiteV2') . ': <strong>' . $order_id . '</strong></p>';

            echo '<p>' . sprintf(__('A confirmation of your order will be sent to your email address at <strong>%1$s</strong>.', 'nutrisslim-suiteV2'), esc_html($order_email)) . '</p>';            if ($order && $order->get_status() === 'pending') {
                echo '<p><a id="show-offer" data-oid="' . $order_id . '" class="btn wired-btn elementor-button" href="#">' . __('Show additional offer:', 'nutrisslim-suiteV2') . '</a></p>';
            }

            echo '</section>';

            $has_book_file = false;
            $displayed_files = array(); // To track displayed file IDs

            // Loop through products to check if any have the 'book_file' field
            foreach ($order->get_items() as $item_id => $item) {
                $product = $item->get_product();

                // Check if the product has the ACF 'book_file' field
                $book_file = get_field('book_file', $product->get_id());

                if ($book_file) {
                    $has_book_file = true; // Mark that at least one product has the 'book_file' field
                    break; // Exit the loop once we find one product with the field
                }
            }

            // If any product has the 'book_file' field, output the section with the details
            if ($has_book_file) {
                echo '<section class="book-files-section">';
                echo '<div class="container">';

                foreach ($order->get_items() as $item_id => $item) {
                    $product = $item->get_product();

                    // Check if the product has the ACF 'book_file' field
                    $book_file = get_field('book_file', $product->get_id());
                    $book_cover = get_field('cover_image', $product->get_id());

                    // Ensure the file hasn't been displayed yet
                    if ($book_file && !in_array($book_file['ID'], $displayed_files)) {
                        // Add the file ID to the array to prevent future duplicates
                        $displayed_files[] = $book_file['ID'];

                        // Print Title, Description, and File URL
                        echo '<div class="bfileHolder grid-middle">';
                        echo '<div class="col-4_sm-12 imgHold">';
                        if ($book_cover) {
                            echo wp_get_attachment_image($book_cover, 'medium');
                        }
                        echo '</div>'; // col
                        echo '<div class="col-8_sm-12 contHold">';
                        echo '<h3>' . esc_html($book_file['title']) . '</h3>';
                        echo '<p>' . esc_html($book_file['description']) . '</p>';
                        echo '<p class="text-center"><a href="' . esc_url($book_file['url']) . '" target="_blank">' . __('Download book', 'nutrisslim-suiteV2') . '</a></p>';
                        echo '</div>'; // col
                        echo '</div>';
                    }
                }

                echo '</div>';
                echo '</section>'; // Closing section tag
            }

            reviewTable($order);
            ?>
            <?php
        }

    }
}
add_action( 'wp_ajax_update_order_state', 'update_order_state' );
add_action( 'wp_ajax_nopriv_update_order_state', 'update_order_state' );

function update_order_state() {
    if ( isset( $_POST['order_id'] ) && isset( $_POST['order_state'] ) ) {
        $order_id = intval( $_POST['order_id'] );
        $order_state = sanitize_text_field( $_POST['order_state'] );

        if ( $order_id && $order_state ) {
            update_post_meta( $order_id, 'order-state', $order_state );
            wp_send_json_success();
        } else {
            wp_send_json_error();
        }
    } else {
        wp_send_json_error();
    }

    wp_die();
}

add_filter( 'body_class', 'add_order_state_to_body_class' );

add_filter('body_class', 'add_order_state_to_body_class');

function add_order_state_to_body_class($classes) {
    if (is_checkout() && is_wc_endpoint_url('order-received')) {
        global $wp;
        $order_id = absint($wp->query_vars['order-received']);
        $order = wc_get_order($order_id);

        if ($order) {
            // Check for the 'order-state' meta and add it as a class
            $order_state = get_post_meta($order_id, 'order-state', true);
            if ($order_state) {
                $classes[] = 'order-state-' . sanitize_html_class($order_state);
            }

            // Check if payment method is 'COD' and add 'is_cod' class
            $payment_method = $order->get_payment_method();
            if (!in_array($payment_method, ['cod', 'stripe'])) {
                $classes[] = 'is_not_cod';
            }
        }
    }

    return $classes;
}

add_action('wp_ajax_update_order_with_products', 'update_order_with_products');
add_action('wp_ajax_nopriv_update_order_with_products', 'update_order_with_products');

function update_order_with_products()
{
    if (empty($_POST['order_id']) || empty($_POST['products'])) {
        wp_send_json_error('Invalid order or products data.');
        return;
    }

    $order_id = (int) $_POST['order_id'];
    $products = $_POST['products'];
    $goto     = sanitize_text_field($_POST['goto'] ?? '');
    $method   = sanitize_text_field($_POST['method'] ?? '');

    $order = wc_get_order($order_id);
    if (! $order || $order->get_status() !== 'on-hold') {
        wp_send_json_error('Order not found or not in hold status.');
        return;
    }

    $additional_amount = 0;

    foreach ($products as $p) {
        $product_id    = (int) ($p['id'] ?? 0);
        $product_price = (float)($p['price'] ?? 0);
        $offer_type    = sanitize_text_field($p['offer_type'] ?? 'initial');

        $additional_amount += $product_price;

        $item_id = $order->add_product(
            wc_get_product($product_id),
            1,
            array(
                'subtotal' => $product_price,
                'total'    => $product_price,
                'ap_item'  => true,
            )
        );

        if ($item_id) {
            $item = $order->get_item($item_id);
            if ($item instanceof WC_Order_Item_Product) {
                $item->add_meta_data('afterpurchase', 'yes', true);
                $item->add_meta_data('offer_type', $offer_type, true);
                if ($offer_type === 'initial') {
                    $item->add_meta_data('afterpurchase_initial', 'yes', true);
                } elseif ($offer_type === 'last') {
                    $item->add_meta_data('afterpurchase_last', 'yes', true);
                }
                $item->save();
            }
        }
    }

    if ($method === 'stripe') {
        if (! charge_customer_for_additional_item($order_id, $additional_amount)) {
            wp_send_json_error('Stripe charge failed.');
            return;
        }
    }

    $order->calculate_totals();
    $order->save();

    update_post_meta($order_id, 'order-state', $goto);
    if ($goto === 'complete') {
        $order->update_status('processing');
    }

    wp_send_json_success('Order updated successfully.');
}

add_action('wp_ajax_create_extra_order', 'create_extra_order');
add_action('wp_ajax_nopriv_create_extra_order', 'create_extra_order');

// Persist afterpurchase flags from the cart/session onto each created order line item
add_action('woocommerce_checkout_create_order_line_item', 'ns_afterpurchase_flag_line_items', 10, 4);

/**
 * Add 'afterpurchase: yes' to order items created during the iframe checkout
 * when the AP flow is active.
 *
 * @param WC_Order_Item_Product $item
 * @param string                $cart_item_key
 * @param array                 $values          Cart item data
 * @param WC_Order              $order
 */
function ns_afterpurchase_flag_line_items($item, $cart_item_key, $values, $order)
{
    // AP is initiated by create_extra_order(): it sets WC()->session->afterpurchase = true
    $ap_session = WC()->session ? WC()->session->get('afterpurchase') : false;

    // We tag when either the session says we're in AP flow OR the cart item was marked as AP
    if ($ap_session || (isset($values['ap_item']) && $values['ap_item'] === true)) {
        $item->add_meta_data('afterpurchase', 'yes', true);
        // keep your internal flag if useful
        //        if ( isset( $values['ap_item'] ) ) {
        //            $item->add_meta_data( 'ap_item', $values['ap_item'], true );
        //        }
    }
}

function create_extra_order()
{
    if (empty($_POST['order_id']) || empty($_POST['products'])) {
        wp_send_json_error('Invalid order or products data.');
        return;
    }

    $order_id = (int) $_POST['order_id'];
    $products = $_POST['products'];
    $method   = sanitize_text_field($_POST['method'] ?? '');

    $order = wc_get_order($order_id);
    if (! $order) {
        wp_send_json_error('Order not found.');
        return;
    }

    // Reset cart for the AP checkout
    WC()->cart->empty_cart();
    WC()->cart->fees_api()->remove_all_fees();

    foreach ($products as $p) {
        $product_id   = (int) ($p['id'] ?? 0);
        $product_price = (float)($p['price'] ?? 0);
        $offer_type   = sanitize_text_field($p['offer_type'] ?? 'initial');

        $cart_item_data = array(
            'custom_price'  => $product_price,
            'ap_item'       => true,
            'afterpurchase' => 'yes',
            'offer_type'    => $offer_type,   // <-- important
        );

        WC()->cart->add_to_cart($product_id, 1, 0, array(), $cart_item_data);
    }

    // This can remain for shipping logic, but it no longer controls tagging
    WC()->session->set('afterpurchase', true);

    $checkout_url = site_url('/iframe-checkout/?oid=' . $order_id . '&method=' . $method);
    wp_send_json_success(array('redirect_url' => $checkout_url));
}

add_action('template_redirect', 'remove_ap_items_from_cart_if_not_checkout');

function remove_ap_items_from_cart_if_not_checkout() {

    if (is_wc_endpoint_url('order-received')) {
        if (WC()->session->get('checkbox_states')) {
            WC()->session->__unset('checkbox_states');
        }        
    }
    // Check if we're on the checkout or order-received page
    if (is_checkout() || is_wc_endpoint_url('order-received')) {
        return; // Do nothing if on checkout or order-received page
    }

    // Unset the 'afterpurchase' session
    if (WC()->session->get('afterpurchase')) {
        WC()->session->__unset('afterpurchase');
    }

    // Loop through the cart items and remove those with 'ap_item' meta
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        if (isset($cart_item['ap_item']) && $cart_item['ap_item'] === true) {
            WC()->cart->remove_cart_item($cart_item_key);            
        }
    }
}

add_filter('woocommerce_package_rates', 'apply_free_shipping_cost', 10, 2);

function apply_free_shipping_cost($rates, $package) {
    // Check if 'afterpurchase' meta is set in the session
    if (WC()->session->get('afterpurchase')) {
        foreach ($rates as $key => $rate) {
            // Set shipping cost to 0 for all available methods
            $rates[$key]->cost = 0;

            // Explicitly set taxes to an array of zeros to prevent recalculation
            if (isset($rates[$key]->taxes)) {
                $rates[$key]->taxes = array_fill_keys(array_keys($rates[$key]->taxes), 0);
            }
        }
    }
    return $rates;
}


// Apply free shipping on the order itself
add_action('woocommerce_checkout_create_order_shipping_item', 'apply_free_shipping_to_order', 10, 2);

function apply_free_shipping_to_order($item, $package_key) {
    if (WC()->session->get('afterpurchase')) {
        // Set the shipping cost to 0
        $item->set_total(0);

        // Set shipping taxes to 0 explicitly
        $taxes = $item->get_taxes();
        if (isset($taxes['total'])) {
            $taxes['total'] = array_map(function() {
                return 0;
            }, $taxes['total']);
        }
        if (isset($taxes['subtotal'])) {
            $taxes['subtotal'] = array_map(function() {
                return 0;
            }, $taxes['subtotal']);
        }
        $item->set_taxes($taxes);
    }
}


// Ensure that shipping cost is excluded from the cart totals
add_action('woocommerce_cart_calculate_fees', 'adjust_shipping_cost_to_zero');

function adjust_shipping_cost_to_zero() {
    if (WC()->session->get('afterpurchase')) {
        // Reset shipping costs and taxes for each package
        foreach (WC()->cart->get_shipping_packages() as $package_key => $package) {
            $shipping_rates = WC()->session->get('shipping_for_package_' . $package_key)['rates'];
            foreach ($shipping_rates as $shipping_rate_id => $rate) {
                $shipping_rates[$shipping_rate_id]->cost = 0;
                if (isset($rate->taxes)) {
                    $shipping_rates[$shipping_rate_id]->taxes = array_fill_keys(array_keys($rate->taxes), 0);
                }
            }
            WC()->session->set('shipping_for_package_' . $package_key, [
                'rates' => $shipping_rates
            ]);
        }
    }
}




// Move the function outside create_extra_order
function set_shipping_to_zero($rates, $package) {
    foreach ($rates as $rate_key => $rate) {
        // Set shipping cost to 0 for all available methods
        $rates[$rate_key]->cost = 0;
        if (isset($rates[$rate_key]->taxes)) {
            foreach ($rates[$rate_key]->taxes as $tax_key => $tax) {
                $rates[$rate_key]->taxes[$tax_key] = 0; // Set any taxes for shipping to 0 as well
            }
        }
    }
    return $rates;
}

// Apply custom price to cart items only if "afterpurchase" is set on the cart (session level)
add_filter('woocommerce_before_calculate_totals', 'apply_custom_price_if_afterpurchase', 998, 1);

function apply_custom_price_if_afterpurchase($cart) {
    if (is_admin() && !defined('DOING_AJAX')) return;

    // Check if "afterpurchase" is set in the session
    $afterpurchase = WC()->session->get('afterpurchase');

    // Apply logic only if afterpurchase is set
    if ($afterpurchase) {
        foreach ($cart->get_cart() as $cart_item) {
            // Apply custom price if available
            if (isset($cart_item['custom_price'])) {
                $cart_item['data']->set_price($cart_item['custom_price']);
            }

            // Set the weight to 997 grams if afterpurchase is true
            $cart_item['data']->set_weight(997); // Weight in grams
        }
    }
}


// Clear the "afterpurchase" session meta after checkout is complete
add_action('woocommerce_thankyou', 'clear_afterpurchase_session');

function clear_afterpurchase_session($order_id) {
    WC()->session->__unset('afterpurchase');
}

// THis code fill billing data from master order to next checkout

add_filter('woocommerce_checkout_get_value', 'prepopulate_checkout_fields', 10, 2);

function prepopulate_checkout_fields($input_value, $input_name) {
    // Assuming you're getting customer data from an existing order
    if (isset($_GET['oid'])) {
        $order_id = intval($_GET['oid']);
        $order = wc_get_order($order_id); // Get the order object

        if ($order) {
            $billing_data = array(
                'billing_first_name' => $order->get_billing_first_name(),
                'billing_last_name' => $order->get_billing_last_name(),
                'billing_address_1' => $order->get_billing_address_1(),
                'billing_house_number' => $order->get_billing_address_2(),
                'billing_city' => $order->get_billing_city(),
                'billing_postcode' => $order->get_billing_postcode(),
                'billing_country' => $order->get_billing_country(),
                'billing_state' => $order->get_billing_state(),
                'billing_phone' => $order->get_billing_phone(),
                'billing_email' => $order->get_billing_email(),
            );

            // Match the input_name to the correct billing field
            if (isset($billing_data[$input_name])) {
                return $billing_data[$input_name]; // Return pre-filled value
            }
        }
    }

    return $input_value; // Default value for fields not affected
}

// THis needs for After purchase 
// add_filter('woocommerce_available_payment_gateways', 'set_default_payment_gateway', 10, 1);

function set_default_payment_gateway($available_gateways) {
    // Check if 'method' is set in the URL, if not, fall back to session-stored method
    if (isset($_GET['method'])) {
        $selected_method = sanitize_text_field($_GET['method']); // Get the payment method from the URL
        WC()->session->set('selected_payment_method', $selected_method); // Store the method in session

        // Log the selected method from the URL
        error_log('Selected Gateway from URL (method): ' . $selected_method);
    } elseif (WC()->session->get('selected_payment_method')) {
        // Use the payment method stored in the session if available
        $selected_method = WC()->session->get('selected_payment_method');
        error_log('Selected Gateway from session (method): ' . $selected_method);
    } else {
        // No method found, log the error and return available gateways unchanged
        error_log('Error: No method parameter found in the URL or session.');
        return $available_gateways;
    }

    // Log the available gateways for debugging
    error_log('Gateways: ' . print_r($available_gateways, true));

    // Loop through all available gateways
    foreach ($available_gateways as $gateway_id => $gateway) {
        if ($gateway_id === $selected_method) {
            $gateway->set_current(); // Set the selected payment method as current
        } else {
            // Unset all other gateways
            unset($available_gateways[$gateway_id]);
        }
    }

    return $available_gateways;
}


add_action('wp_ajax_get_order_info', 'get_order_info');
add_action('wp_ajax_nopriv_get_order_info', 'get_order_info');

function get_order_info() {
    if (!isset($_POST['order_id'])) {
        wp_send_json_error('Invalid order ID');
        return;
    }

    $order_id = intval($_POST['order_id']);
    $order = wc_get_order($order_id);

    if (!$order) {
        wp_send_json_error('Order not found');
        return;
    }

    ob_start();
    ?>

<h4><?php echo __('Tekintse át a megrendeléseit', 'nutrisslim-suiteV2'); ?></h4>

<div class="grid articles">
    <div class="col-6 label"><?php echo __('Product name', 'nutrisslim-suiteV2'); ?></div>
    <div class="col-2 text-right label"><?php echo __('Pricing', 'nutrisslim-suiteV2'); ?></div>
    <div class="col-2 text-right label"><?php echo __('Quantity', 'nutrisslim-suiteV2'); ?></div>
    <div class="col-2 text-right label"><?php echo __('Total', 'nutrisslim-suiteV2'); ?></div>
    <?php 
                        $totalproducts = 0;
                        foreach ($order->get_items() as $item_id => $item) :
                            // Skip items with 'nutrisslim_parent_id' meta key
                            if (isset($item['nutrisslim_parent_id'])) {
                                continue;
                            }
                            $lid = '';
                            if ($item->get_meta('lid', true)) {
                                $lid = $item->get_meta('lid', true);
                            }

                            $product = $item->get_product();
                            $item_name = $item->get_name();
                            $item_quantity = $item->get_quantity();

                            // Check if the product type is 'nutrisslim'
                            if ($product->get_type() == 'nutrisslim') {
                                if (isset($item['subscription']) && $item['subscription']) {
                                    $item_price = get_custom_product_price($product->get_id(), $item_quantity, $lid, '', true, true);
                                } else if (isset($item['regulargift'])) {
                                    $item_price = 0;
                                } else {
                                    $item_price = get_custom_product_price($product->get_id(), $item_quantity, $lid, '', true);
                                }
                                $item_total = $item_price;
                                $item_price = $item_total / $item_quantity;
                            } else {
                                $item_total = $item->get_subtotal();
                                $item_price = $item_total / $item_quantity;                                        
                                // $item_total = $item->get_total();
                            }
                            // Calculate price excluding tax
                            $totalproducts = $totalproducts + $item_total;
                            if (!wc_prices_include_tax() && $product instanceof WC_Product) {
                                $item_price = wc_get_price_including_tax($product, array('price' => floatval($item_price)));
                                $item_total = wc_get_price_including_tax($product, array('price' => floatval($item_total)));
                            }
                            
                            // Format the prices
                            $item_price_formatted = wc_price($item_price);
                            $item_total_formatted = wc_price($item_total);

                            // error_log('Total products price: ' . $totalproducts);

                            ?>
    <div class="col-6"><?php echo esc_html($item_name); ?></div>
    <div class="col-2 text-right"><?php echo wp_kses_post($item_price_formatted); ?></div>
    <div class="col-2 text-right"><?php echo esc_html($item_quantity); ?></div>
    <div class="col-2 text-right"><?php echo wp_kses_post($item_total_formatted); ?></div>
    <?php endforeach;?>
</div>
<div class="grid summary">
    <?php
                        // Fetch order totals
                        $order_subtotal = wc_price($totalproducts);
                        $order_shipping = wc_price($order->get_shipping_total());
                        // Loop through each fee in the order

                        $order_payment_fee = wc_price($order->get_total() - $order->get_subtotal() - $order->get_shipping_total());
                        $order_total = wc_price($order->get_total());
                        $order_tax = wc_price($order->get_total_tax());
                        ?>

    <div class="col-8 text-right label"><?php echo __('Subtotal', 'nutrisslim-suiteV2'); ?></div>
    <div class="col-4 text-right"><?php echo wp_kses_post($order_subtotal); ?></div>
    <div class="col-8 text-right label">
        <?php echo __('Shipping', 'nutrisslim-suiteV2') . '<span class="wo-tax"> (fără TVA)</span>'; ?></div>
    <div class="col-4 text-right"><?php echo wp_kses_post($order_shipping); ?>
    </div>

    <?php
                            foreach ( $order->get_fees() as $fee ) {
                                // Get the fee name
                                $fee_name = $fee->get_name();

                                // Get the fee total and total tax
                                $fee_total = $fee->get_total();
                                $fee_total_tax = $fee->get_total_tax();

                                // Calculate the total including tax
                                $fee_total_incl_tax = wc_price( $fee_total );

                                // Output the fee name and total including tax
                                echo '<div class="col-8 text-right label">' . __(esc_html( $fee_name ), 'nutrisslim-suiteV2') . '<span class="wo-tax"> (fără TVA)</span>' .'</div>';
                                echo '<div class="col-4 text-right">' . $fee_total_incl_tax . '</div>';
                            }
                        ?>

    <div class="col-8 text-right label znesek"><?php echo __('Total', 'nutrisslim-suiteV2'); ?></div>
    <div class="col-4 text-right"><?php echo wp_kses_post($order_total); ?></div>
    <div class="col-8 text-right"><?php echo __('(inc. TAX)', 'nutrisslim-suiteV2'); ?>
    </div>
    <div class="col-4 text-right"><?php echo wp_kses_post($order_tax); ?></div>
</div>


<?php
    $html = ob_get_clean();

    wp_send_json_success(array('html' => $html));
}


// This add afterpurchase to order on afterpurchase complete: 
add_action('woocommerce_checkout_create_order', 'add_afterpurchase_meta_to_order', 10, 2);

function add_afterpurchase_meta_to_order($order, $data) {
    // Check if 'afterpurchase' meta is set in the session
    if (WC()->session->get('afterpurchase')) {
        $order->update_meta_data('afterpurchase', 'yes'); // Add meta 'afterpurchase' with value 'yes'
        $order->save(); // Don't forget to save the order to ensure the meta data is stored
    }
}

// Code below is related to stripe upsell

function charge_customer_for_additional_item($order_id, $additional_amount) {
    global $wpdb;
    $order = wc_get_order($order_id);

    // Get the order's currency
    $currency = $order->get_currency();    

    // Get Stripe customer ID from the database
    $stripe_customer_id = $wpdb->get_var($wpdb->prepare(
        "SELECT meta_value FROM {$wpdb->prefix}wc_orders_meta WHERE order_id = %d AND meta_key = '_stripe_customer_id'",
        $order_id
    ));

    // Get the payment method ID saved during the initial purchase (this is critical for Payment Intents)
    $payment_method_id = $wpdb->get_var($wpdb->prepare(
        "SELECT meta_value FROM {$wpdb->prefix}wc_orders_meta WHERE order_id = %d AND meta_key = '_stripe_source_id'",
        $order_id
    ));   

    error_log('Payment method ID: ' . $payment_method_id);

    $options = get_option('subscription_plugin_options');
    $stripe_secret_key = $options['stripe_secret_key'];

    if ($stripe_customer_id && $payment_method_id) {
        \Stripe\Stripe::setApiKey($stripe_secret_key);

        try {
            // Create a Payment Intent for the additional amount
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $additional_amount * 100, // Amount in cents (e.g., 500 for 5 EUR)
                'currency' => $currency,
                'customer' => $stripe_customer_id,
                'payment_method' => $payment_method_id,
                'off_session' => true, // Indicates that this is a background charge without customer interaction
                'confirm' => true, // Immediately confirm the payment
            ]);

            // Log the Payment Intent success
            error_log('Payment Intent created: ' . print_r($paymentIntent, true)); 

            // Add note to the order about the additional charge
            $order->add_order_note(sprintf(
                'Stripe additional charge of %s %s complete. Payment Intent ID: %s', 
                $additional_amount, 
                $currency, 
                $paymentIntent->id
            ));

            // Save the order with the new note
            $order->save();

            return true; // Return true if the charge was successful

        } catch (\Stripe\Exception\CardException $e) {
            // Handle payment failure
            $order->add_order_note(sprintf('Stripe additional charge failed: %s', $e->getMessage()));
            error_log('Payment failed: ' . print_r($e, true)); 
            return false; // Return false if there was a card failure

        } catch (Exception $e) {
            // Handle any other errors
            $order->add_order_note(sprintf('Stripe error: %s', $e->getMessage()));
            error_log('Stripe error: ' . print_r($e, true)); 
            return false; // Return false for general errors
        }
    } else {
        // Log if customer ID or payment method is missing
        error_log('Missing customer ID or payment method ID for order ' . $order_id);
        $order->add_order_note('Stripe additional charge failed: Missing customer ID or payment method ID');
        $order->save();
        return false; // Return false if customer ID or payment method ID is missing
    }
}

// Create checkout page and set it template.

add_action('init', 'create_or_update_iframe_checkout_page');

function create_or_update_iframe_checkout_page() {
    $page_slug = 'iframe-checkout';
    $page_title = 'Iframe Checkout';
    $template_file = 'page-template-checkout.php'; // Your custom template filename

    // Check if the page already exists
    $existing_page = get_page_by_path($page_slug);

    if (!$existing_page) {
        // If the page doesn't exist, create it and assign the custom template
        $new_page_id = wp_insert_post(array(
            'post_title'    => $page_title,
            'post_name'     => $page_slug,
            'post_content'  => '[woocommerce_checkout]', // Insert WooCommerce checkout form
            'post_status'   => 'publish',
            'post_type'     => 'page',
        ));

        if (!is_wp_error($new_page_id)) {
            // Set the custom template for the newly created page
            update_post_meta($new_page_id, '_wp_page_template', $template_file);
        }
    } else {
        // If the page exists, check if it already has the correct template
        $current_template = get_post_meta($existing_page->ID, '_wp_page_template', true);

        // If the current template is not set or not equal to your custom template, update it
        if ($current_template !== $template_file) {
            update_post_meta($existing_page->ID, '_wp_page_template', $template_file);
        }
    }
}

// Register the custom template so it's available in the dropdown
add_filter('theme_page_templates', 'add_plugin_template_to_dropdown');

function add_plugin_template_to_dropdown($templates) {
    // Register your custom template
    $templates['page-template-checkout.php'] = 'Iframe Checkout Template';
    return $templates;
}

// Load the custom template when used
add_filter('template_include', 'load_plugin_template_if_selected');

function load_plugin_template_if_selected($template) {
    // Check if the page uses the custom template
    if (get_page_template_slug() === 'page-template-checkout.php') {
        $plugin_template = plugin_dir_path(__FILE__) . 'templates/page-template-checkout.php';

        // Remove the admin bar for this specific page template
        add_filter('show_admin_bar', '__return_false');        
        
        // Return the template if it exists in the plugin
        if (file_exists($plugin_template)) {
            return $plugin_template;
        }
    }
    
    return $template; // Fallback to default template
}