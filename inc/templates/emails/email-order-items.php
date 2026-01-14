<?php
/**
 * Email Order Items
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-items.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

/** Hide AP/cross meta only for this email render */
$ns_hide_meta_keys = [
    'afterpurchase',
    'offer_type',
    'afterpurchase_initial',
    'afterpurchase_last',
    'cross',
    'cross_cart',
    'cross_checkout',
    'ap_item',
];

$ns_filter_hide_ap_meta = function ($formatted_meta, $item) use ($ns_hide_meta_keys) {
    foreach ($formatted_meta as $id => $meta) {
        // $meta is WC_Meta_Data with ->key and ->value
        if (in_array($meta->key, $ns_hide_meta_keys, true)) {
            unset($formatted_meta[$id]);
        }
    }
    return $formatted_meta;
};
add_filter('woocommerce_order_item_get_formatted_meta_data', $ns_filter_hide_ap_meta, 999, 2);

$text_align  = is_rtl() ? 'right' : 'left';
$margin_side = is_rtl() ? 'left' : 'right';
?>
<div style="background-color:transparent;">
    <div class="block-grid three-up no-stack"
        style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #F0F0F0;">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;">
                <tr>
                    <td align="center">
                        <table cellpadding="0" cellspacing="0" border="0" style="width:620px">
                            <?php
                            foreach ( $items as $item_id => $item ) :
                                $product       = $item->get_product();
                                $sku           = '';
                                $purchase_note = '';
                                $image         = '';

                                if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
                                    continue;
                                }

                                if ( is_object( $product ) ) {
                                    $sku           = $product->get_sku();
                                    $purchase_note = $product->get_purchase_note();
                                    $image         = $product->get_image( $image_size );
                                }

                                ?>
                            <tr class="layout-full-width" style="background-color:#FFFFFF">
                                <td align="center" width="206"
                                    style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent;"
                                    valign="top">
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td
                                                style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;">
                                                <div class="col num6"
                                                    style="max-width: 480px; min-width: 309px; display: table-cell; vertical-align: middle;">
                                                    <div style="width:100% !important;">
                                                        <div
                                                            style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                                                            <table width="100%" cellpadding="0" cellspacing="0"
                                                                border="0">
                                                                <tr>
                                                                    <td
                                                                        style="padding-right: 10px; padding-left: 22px; padding-top: 22px; padding-bottom: 0px; font-family: 'Trebuchet MS', Tahoma, sans-serif">
                                                                        <div
                                                                            style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%; padding-right:0px;padding-bottom: 0px;padding-left:0px;">
                                                                            <div
                                                                                style="padding-top: 0px; padding-bottom: 0; font-size: 12px; line-height: 15px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                                                                                <p
                                                                                    style="font-size: 15px; line-height: 19px; margin: 0px auto; padding-bottom: 10px;">
                                                                                    <strong><?php echo wp_kses_post( apply_filters( 'woocommerce_order_item_name', $item->get_name(), $item, false ) ); ?></strong>
                                                                                    <?php
                                                                                        // Allow other plugins to add additional product information here.
                                                                                        do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, $plain_text );

                                                                                        wc_display_item_meta(
                                                                                            $item,
                                                                                            array(
                                                                                                'label_before' => '<strong class="wc-item-meta-label" style="float: ' . esc_attr( $text_align ) . '; margin-' . esc_attr( $margin_side ) . ': .25em; clear: both">',
                                                                                            )
                                                                                        );

                                                                                        // Get the product ID
                                                                                        $product_id = $item->get_product_id();
                                                                                        $product = wc_get_product( $product_id );
                                                                                        $book_file_displayed = false; // Flag to avoid duplicate book file displays

                                                                                        // Check if it's a "nutrisslim" type product
                                                                                        if ( $product->get_type() === 'nutrisslim' ) {
                                                                                            // Iterate through all items in the order to check for child products of the 'nutrisslim' parent
                                                                                            foreach ( $order->get_items() as $child_item_id => $child_item ) {
                                                                                                $child_product = $child_item->get_product();

                                                                                                // Check if this item is a child of the current 'nutrisslim' product
                                                                                                if ( isset( $child_item['nutrisslim_parent_id'] ) && $child_item['nutrisslim_parent_id'] == $product_id ) {
                                                                                                    // Get the ACF 'book_file' field for the child product
                                                                                                    $book_file = get_field( 'book_file', $child_product->get_id() );
                                                                                                    if ( $book_file && !$book_file_displayed ) {
                                                                                                        // Output the download link for the first found book file
                                                                                                        echo '<p><a href="' . esc_url( $book_file['url'] ) . '" target="_blank">' . esc_html__('Download book', 'nutrisslim-suiteV2') . '</a></p>';
                                                                                                        $book_file_displayed = true; // Set flag to true to prevent further output
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        } else {
                                                                                            // For normal products, check for the 'book_file' field
                                                                                            $book_file = get_field('book_file', $product_id);
                                                                                            if ( $book_file ) {
                                                                                                // Output the download link for the product
                                                                                                echo '<p><a href="' . esc_url( $book_file['url'] ) . '" target="_blank">' . esc_html__('Download book', 'nutrisslim-suiteV2') . '</a></p>';
                                                                                            }
                                                                                        }

                                                                                        // Allow other plugins to add additional product information here.
                                                                                        do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, $plain_text );
                                                                                    ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>

                                <?php
                                $qty          = $item->get_quantity();
                                $refunded_qty = $order->get_qty_refunded_for_item( $item_id );

                                if ( $refunded_qty ) {
                                    $qty_display = '<del>' . esc_html( $qty ) . '</del> <ins>' . esc_html( $qty - ( $refunded_qty * -1 ) ) . '</ins>';
                                } else {
                                    $qty_display = esc_html( $qty );
                                }
                                ?>

                                <td align="center" width="206"
                                    style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent;"
                                    valign="top">
                                    <table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td
                                                style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;">
                                                <div class="col num2"
                                                    style="max-width: 160px; min-width: 103px; display: table-cell; vertical-align: middle;">
                                                    <div style="width:100% !important;">
                                                        <div
                                                            style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                                                            <table width="100%" cellpadding="0" cellspacing="0"
                                                                border="0">
                                                                <tr>
                                                                    <td
                                                                        style="padding-top: 7px; padding-right: 25px; padding-left: 25px; font-family: 'Trebuchet MS', Tahoma, sans-serif">
                                                                        <div
                                                                            style="padding-bottom: 0; color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;">
                                                                            <p
                                                                                style="font-size: 14px; line-height: 19px; text-align: center; padding-right: 10px;">
                                                                                <strong><?php echo wp_kses_post( apply_filters( 'woocommerce_email_order_item_quantity', $qty_display, $item ) ); ?></strong>
                                                                            </p>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>


                                <td align="center" width="206"
                                    style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;"
                                    valign="top">
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td
                                                style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;">
                                                <div class="col num4"
                                                    style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: middle;">
                                                    <div style="width:100% !important;">
                                                        <div
                                                            style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 10px;">
                                                            <table width="100%" cellpadding="0" cellspacing="0"
                                                                border="0">
                                                                <tr>
                                                                    <td
                                                                        style="padding-right: 25px; padding-left: 25px; padding-top: 22px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif">
                                                                        <div
                                                                            style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top: 0px;padding-right:25px;padding-bottom: 0px;padding-left:25px;">
                                                                            <div
                                                                                style="font-size: 12px; line-height: 14px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; text-align: center;">
                                                                                <p
                                                                                    style="font-size: 14px; line-height: 19px; margin-top: 0;">
                                                                                    <?php
                                                                                        $product = wc_get_product( $item->get_product_id() );
                                                                                        $product_type = $product->get_type();
                                                                                        
                                                                                        if ( $product_type === 'nutrisslim' ) {
                                                                                            $product_id = $item->get_product_id();
                                                                                            $quantity = $item->get_quantity();
                                                                                            $lid = '';
                                                                                            if ($item->get_meta('lid', true)) {
                                                                                                $lid = $item->get_meta('lid', true);
                                                                                            }                                                                                            
                                                                                            $parent = ''; // Always ''
                                                                                            $realbundle = true;
                                                                                            $is_subscr_disc = $item->get_meta('subscription') > 0;
                                                                                        
                                                                                            // Get the custom product price
                                                                                            $custom_price = get_custom_product_price($product_id, $quantity, $lid, $parent, $realbundle, $is_subscr_disc);
                                                            
                                                                                            if (isset($item['regulargift'])) {
                                                                                                $custom_price = 0;
                                                                                            }                                                                                            
                                                                                            
                                                                                           // Add tax to custom price
                                                                                            if ($product instanceof WC_Product) {
                                                                                                $custom_price_with_tax = wc_get_price_including_tax($product, ['price' => $custom_price]);
                                                                                            } else {
                                                                                                $custom_price_with_tax = $custom_price; // Fallback to original price if product is invalid
                                                                                            }

                                                                                            // Format the custom price with tax
                                                                                            $formatted_custom_price = wc_price( $custom_price_with_tax );
                                                                                        
                                                                                            echo '<strong>' . wp_kses_post( $formatted_custom_price ) . '</strong>';
                                                                                        } else {
                                                                                            echo '<strong>' . wp_kses_post( $order->get_formatted_line_subtotal( $item ) ) . '</strong>';
                                                                                        }                                                
                                                                                    ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <?php endforeach; ?>
                            <?php
                            remove_filter('woocommerce_order_item_get_formatted_meta_data', $ns_filter_hide_ap_meta, 999);
                            ?>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>