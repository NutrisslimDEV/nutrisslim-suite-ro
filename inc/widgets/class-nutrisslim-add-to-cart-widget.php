<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Nutrisslim_Add_To_Cart_Widget extends Widget_Base {

    public function get_name() {
        return 'nutrisslim_add_to_cart';
    }

    public function get_title() {
        return __( 'Nutrisslim Add To Cart', 'nutrisslim-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-cart';
    }

    public function get_categories() {
        return [ 'nutrisslim' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'nutrisslim-elementor-widgets' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Add your controls here...

        $this->end_controls_section();
    }

    protected function render() {

        global $product;

        // Ensure $product is a valid product object
        if ( ! is_a($product, 'WC_Product') ) {
            $product = wc_get_product(get_the_ID());
            if ( ! $product ) {
                echo 'Product not found!';
                return;
            }
        }

        // You can use Elementor's settings to dynamically populate data or use static HTML for simplicity
        // Enqueue widget style
       // wp_enqueue_style('nutrisslim-add-to-cart-style', plugins_url( '../assets/css/nutrisslim-add-to-cart.css', __FILE__ ), [], '1.0.0');  
       // wp_enqueue_style('nutrisslim-add-to-cart-style', plugin_dir_url(dirname(__DIR__)) . 'assets/css/nutrisslim-add-to-cart.css', [], '1.0.0');

		
        ?>

<?php

    global $product;
    // Get regular and sale prices
    $regular_price = $product->get_regular_price();
    $sale_price = $product->get_sale_price();
    if (!wc_prices_include_tax()) {
        $regular_price = round((float)wc_get_price_including_tax($product, ['price' => $regular_price]), 2);
        $sale_price = round((float)wc_get_price_including_tax($product, ['price' => $sale_price]), 2);
    }
    $is_sale_price = true;
    if (! $sale_price) {
        $sale_price = $regular_price;
        $is_sale_price = false;
    }    

    // Get custom prices from product meta
    $price_for_two = get_post_meta( $product->get_id(), '_price_for_two', true );
    if (!wc_prices_include_tax() && !(empty($price_for_two))) {
        $price_for_two = round((float)wc_get_price_including_tax($product, ['price' => $price_for_two]), 2);
    }
    
    if ($price_for_two) {
        $price_for_two = $price_for_two / 2;
    }
    $price_for_three = get_post_meta( $product->get_id(), '_price_for_three', true );

    if (!wc_prices_include_tax() && !(empty($price_for_three))) {
        $price_for_three = round((float)wc_get_price_including_tax($product, ['price' => $price_for_three]), 2);
    }



    if ($price_for_three) {
        $price_for_three = $price_for_three / 3;
    }

    $consumption_period = get_field('consumption_period', $product->get_id());

    $product_type = $product->get_type();

    $locale = get_locale();
    $is_not_slovenian = $locale !== 'sl_SI';

    if ($product_type == 'nutrisslim') {
        // $singleLabel = ' paket';
        $singleLabel = __('pack', 'nutrisslim-suiteV2');
        $dvaLabel = 'paketa';
        // $triLabel = ' paketi';
        $triLabel = __('packs', 'nutrisslim-suiteV2');
    } else {
        // $singleLabel = ' kom';
        $singleLabel = __('piece', 'nutrisslim-suiteV2');
        $dvaLabel = 'kom'; 
        $triLabel = 'kom';                    
        // $triLabel = ' kom';                    
        $triLabel = __('pieces', 'nutrisslim-suiteV2');
    }

    if ($is_not_slovenian) {
        $dvaLabel = $triLabel;
    }

    if ($sale_price) {
        $discount_one = round((($regular_price - $sale_price) / $regular_price) * 100);
        // $discount_one_subscription = $discount_one + 5;
    }
    if ($price_for_two) {
        // Check if this calculation below works for bundle products:
        // $discount_two = round((($regular_price * 2 - $price_for_two) / ($regular_price * 2)) * 100);
        $discount_two = round((($regular_price - $price_for_two) / ($regular_price)) * 100);
        // $discount_two_subscription = $discount_two + 5;        
    }
    if ($price_for_three) {
        // Check if this calculation below works for bundle products:
        // $discount_three = round((($regular_price * 3 - $price_for_three) / ($regular_price * 3)) * 100);
        $discount_three = round((($regular_price - $price_for_three) / ($regular_price)) * 100);
        // $discount_three_subscription = $discount_three + 5;   
    } 
    
    /*
    $subscribe_sale_price = getDiscountedPrice($regular_price, $discount_one_subscription);
    $subscribe_price_for_two = getDiscountedPrice($regular_price, $discount_two_subscription);
    $subscribe_price_for_three = getDiscountedPrice($regular_price, $discount_three_subscription);
    */
        if ($sale_price) {
            $sale_price_without_tax = $product->get_sale_price();
            if (empty($sale_price_without_tax)) {
                $sale_price_without_tax = $product->get_regular_price();
            }
            $subscribe_sale_price = getDiscountedPrice($sale_price_without_tax, 5);
            $subscribe_sale_price = round((float)wc_get_price_including_tax($product, ['price' => $subscribe_sale_price]), 2);

            $discount_one_subscription = round((($regular_price - $subscribe_sale_price) / $regular_price) * 100);
        }
        if ($price_for_two) {
            $price_for_two_without_tax = get_post_meta( $product->get_id(), '_price_for_two', true );
            $price_for_two_without_tax = $price_for_two_without_tax / 2;
            $subscribe_price_for_two = getDiscountedPrice($price_for_two_without_tax, 5);
            $subscribe_price_for_two = round((float)wc_get_price_including_tax($product, ['price' => $subscribe_price_for_two]), 2);
            $discount_two_subscription = round((($regular_price - $subscribe_price_for_two) / ($regular_price)) * 100);
        }
        if ($price_for_three) {
            $price_for_three_without_tax = get_post_meta( $product->get_id(), '_price_for_three', true );
            $price_for_three_without_tax = $price_for_three_without_tax / 3;
            $subscribe_price_for_three = getDiscountedPrice($price_for_three_without_tax, 5);
            $subscribe_price_for_three = round((float)wc_get_price_including_tax($product, ['price' => $subscribe_price_for_three]), 2);

            $discount_three_subscription = round((($regular_price - $subscribe_price_for_three) / ($regular_price)) * 100);
        }
    
    $subscription_options = get_field('subscription_options', $product->get_id());
    $subscription_periods = array();
    if (!empty($subscription_options) && $subscription_options != 0) {
        $subscription_periods = explode(';', '30;50;70');
    } else if ($consumption_period) {
        $subscription_periods[0] = $consumption_period;
        $subscription_periods[1] = 2 * $consumption_period;
        $subscription_periods[2] = 3 * $consumption_period;
    } else {
        $subscription_periods[0] = 30;
        $subscription_periods[1] = 60;
        $subscription_periods[2] = 90;
    } 
    if ($discount_one > 0) {
        $vis = '';
        $has_visability_toggle = false;
    } else {
        $vis = 'style="display:none;" ';
        $has_visability_toggle = true;
    }       
?>

<div class="customAddToCart">
    <div class="topInfo">
        <span data-sale='<?php echo wc_price($sale_price); ?>'
            data-subscribe-sale='<?php echo wc_price($subscribe_sale_price); ?>'
            class="<?php echo $is_sale_price ? '' : 'nosale '; ?>mainsale"><?php echo wc_price($sale_price); ?></span>
        <span data-one-sale='<?php echo wc_price($sale_price); ?>'
            data-two-sale='<?php echo wc_price(2 * $sale_price); ?>'
            data-three-sale='<?php echo wc_price(3 * $sale_price); ?>'
            data-one-regular='<?php echo wc_price($regular_price); ?>'
            data-two-regular='<?php echo wc_price(2 * $regular_price); ?>'
            data-three-regular='<?php echo wc_price(3 * $regular_price); ?>'
            data-toggle-visability="<?php echo $has_visability_toggle; ?>"
            <?php echo $vis; ?>class="regularcrossed crosslined">
            <?php echo wc_price($regular_price); ?>
        </span>
        <span class="subscriptiolLabel" style="display:none;">
            <?php printf(__('for <span class="numdays">%s</span> days', 'nutrisslim-suiteV2'), $subscription_periods[0]); ?></span>
    </div>
    <p><?php echo __('Select the desired quantity:', 'nutrisslim-suiteV2'); ?></p>
    <div class="addToCartForm">

        <form>
            <div class="qSelect grid-3">

                <label class="col">
                    <input data-subscribe-save='<?php echo wc_price($regular_price - $subscribe_sale_price); ?>'
                        data-onetime-save='<?php echo wc_price($regular_price - $sale_price); ?>'
                        data-diff='<?php echo wc_price($sale_price - $subscribe_sale_price); ?>'
                        data-price='<?php echo wc_price($sale_price); ?>'
                        data-subscribe-price='<?php echo wc_price($subscribe_sale_price); ?>' type="radio" class="radio"
                        name="quantity" value="1" checked="checked">
                    <div class="paket">
                        <span <?php echo $vis; ?>data-onetime="<?php echo $discount_one; ?>"
                            data-subscription="<?php echo $discount_one_subscription; ?>"
                            class="label">-<?php echo $discount_one; ?>%</span>
                        <div class="packageInfo">
                            <strong>1x</strong>
                        </div>
                        <div class="packagePrice">
                            <div data-price='<?php echo wc_price($sale_price); ?>/<?php echo $singleLabel; ?>'
                                data-subscribe-price='<?php echo wc_price($subscribe_sale_price); ?>/<?php echo $singleLabel; ?>'
                                class="price"><?php echo wc_price($sale_price) . '/' . $singleLabel; ?></div>
                        </div>
                    </div>
                </label>


                <?php
                    if (!empty($price_for_two)) {
                ?>
                <label class="col top">
                    <input
                        data-subscribe-save='<?php echo wc_price(2 * $regular_price - 2 * $subscribe_price_for_two); ?>'
                        data-onetime-save='<?php echo wc_price(2 * $regular_price - 2 * $price_for_two); ?>'
                        data-diff='<?php echo wc_price(2 * $price_for_two - 2 * $subscribe_price_for_two); ?>'
                        data-price='<?php echo wc_price(2 * $price_for_two); ?>'
                        data-subscribe-price='<?php echo wc_price(2 * $subscribe_price_for_two); ?>' type="radio"
                        class="radio" name="quantity" value="2">
                    <div class="paket">
                        <span data-onetime="<?php echo $discount_two; ?>"
                            data-subscription="<?php echo $discount_two_subscription; ?>"
                            class="label">-<?php echo $discount_two; ?>%</span>
                        <div class="packageInfo">
                            <strong>2x</strong>
                        </div>
                        <div class="packagePrice">
                            <div data-price='<?php echo wc_price($price_for_two); ?>/<?php echo $singleLabel; ?>'
                                data-subscribe-price='<?php echo wc_price($subscribe_price_for_two); ?>/<?php echo $singleLabel; ?>'
                                class="price"><?php echo wc_price($price_for_two); ?>/<?php echo $singleLabel; ?></div>
                        </div>
                        <div class="choice">
                            <?php echo __('Top choice', 'nutrisslim-suiteV2'); ?>
                        </div>
                    </div>
                </label>
                <?php        
                    }
                ?>
                <?php
                    if (!empty($price_for_three)) {
                ?>
                <label class="col">
                    <input
                        data-subscribe-save='<?php echo wc_price(3 * $regular_price - 3 * $subscribe_price_for_three); ?>'
                        data-onetime-save='<?php echo wc_price(3 * $regular_price - 3 * $price_for_three); ?>'
                        data-diff='<?php echo wc_price(3 * $price_for_three - 3 * $subscribe_price_for_three); ?>'
                        data-price='<?php echo wc_price(3 * $price_for_three); ?>'
                        data-subscribe-price='<?php echo wc_price(3 * $subscribe_price_for_three); ?>' type="radio"
                        class="radio" name="quantity" value="3" />

                    <div class="paket">
                        <span data-onetime="<?php echo $discount_three; ?>"
                            data-subscription="<?php echo $discount_three_subscription; ?>"
                            class="label">-<?php echo $discount_three; ?>%</span>
                        <div class="packageInfo">
                            <strong>3x</strong>
                        </div>
                        <div class="packagePrice">
                            <div data-price='<?php echo wc_price($price_for_three); ?>/<?php echo $singleLabel; ?>'
                                data-subscribe-price='<?php echo wc_price($subscribe_price_for_three); ?>/<?php echo $singleLabel; ?>'
                                class="price"><?php echo wc_price($price_for_three); ?>/<?php echo $singleLabel; ?>
                            </div>
                        </div>
                    </div>
                </label>
                <?php        
                    }
                ?>
            </div>
            <div class="tabsHolder">
                <div class="tabsItems grid-2">
                    <div class="col tab subscr">
                        <?php echo __('Subscribe & Save', 'nutrisslim-suiteV2'); ?><br />
                        <span class="warning">-<?php echo $discount_one_subscription; ?>%
                            <?php echo __('Discount', 'nutrisslim-suiteV2'); ?><br /></span>
                    </div>
                    <div class="col tab active onetime"><?php echo __('One-time purchase', 'nutrisslim-suiteV2'); ?>
                    </div>
                </div>
                <div class="contWrap">
                    <div class="onetimeContent">
                        <p>
                            <strong>
                                <?php 
                                    printf( 
                                        __( 'Switch to a subscription and save %s', 'nutrisslim-suiteV2' ), 
                                        '<span class="safe">' . wc_price( $sale_price - $subscribe_sale_price ) . '</span>' 
                                    ); 
                                    ?>
                            </strong><br />
                            <?php 
                                printf( 
                                    __( 'You can have the same for only %s. Convenient way to get best prices. You can change or cancel your subscription any time!', 'nutrisslim-suiteV2' ), 
                                    '<span class="payonly">' . wc_price( $subscribe_sale_price ) . '</span>' 
                                ); 
                                ?>
                        </p>
                    </div>
                    <div style="display:none;" class="subscrContent">
                        <p><?php echo __('Please select your subscription period:', 'nutrisslim-suiteV2'); ?></p>
                        <select name="subscription" class="subscription">
                            <?php
                                    foreach ($subscription_periods as $subscription_period) {
                                        echo '<option value="' . $subscription_period . '">' . __('Send every', 'nutrisslim-suiteV2') . ' ' . $subscription_period . ' ' . __('days', 'nutrisslim-suiteV2') . '</option>';
                                    }
                                ?>
                        </select>
                        <div class="grid info">
                            <div class="col-6 cancel">
                                <?php echo __('You can cancel the subscription at any time.', 'nutrisslim-suiteV2'); ?>
                            </div>
                            <div class="col-6 lowest">
                                <?php echo __('Verified lowest price', 'nutrisslim-suiteV2'); ?>
                            </div>
                            <div class="col-12 learn"><a class="moreabout"
                                    href="#"><?php echo __('Learn more about the subscription', 'nutrisslim-suiteV2') ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    if ( !$product->is_in_stock() ) {
                        // If the product is out of stock, display "Out of Stock" text
                        echo '<p style="text-align:center"><span class="out-of-stock">' . __( 'Out of stock', 'nutrisslim-suiteV2' ) . '</span></p>';
                    } else {
                ?>
            <button class="elementor-button add-to-cart-icon" data-product-id="<?php echo $product->get_id(); ?>"
                data-quantity="1" type="submit"><?php echo __('Add to cart', 'nutrisslim-suiteV2'); ?> | <span
                    class="buttonPrice"><?php echo wc_price($sale_price); ?></span> <span class="buttonTime"
                    style="display:none;"><?php printf(__('each <span class="numdays">%s</span> days', 'nutrisslim-suiteV2'), $subscription_periods[0]) ?></span></button>
            <?php
                        // Custom button HTML with link for in-stock products
                        // $html = '<a href="?add-to-cart=' . esc_attr( $product_id ) . '" aria-describedby="woocommerce_loop_add_to_cart_link_describedby_' . esc_attr( $product_id ) . '" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="' . esc_attr( $product_id ) . '" data-product_sku="' . esc_attr( $product->get_sku() ) . '" aria-label="' . sprintf( __( 'Dodaj v košarico: “%s”', 'your-textdomain' ), esc_attr( $product_name ) ) . '" rel="nofollow">' . esc_html( $custom_text ) . '</a>';
                    }                 
                ?>
            <!-- <button class="elementor-button add-to-cart-icon" data-subscription="30" data-product-id="<?php echo $product->get_id(); ?>" data-quantity="1" type="submit">Dodaj v košarico | <span class="buttonPrice"><?php echo wc_price($subscribe_sale_price); ?></span> <span class="buttonTime"><?php printf(__('each <span class="numdays">%s</span> days', 'nutrisslim-suiteV2'), $subscription_periods[0]) ?></span></button> -->
            <p <?php echo $vis; ?>class="prihranek">
                <?php printf(__('Save <span class="prihrana">%s</span>', 'nutrisslim-suiteV2'), wc_price($regular_price - $sale_price)); ?>
            </p>


            <?php
                    if ( $product->is_in_stock() ) {
                        // If the product is out of stock, display "Out of Stock" text
                        echo '<p class="onstock">' . __( 'In stock, ready for delivery', 'nutrisslim-suiteV2' ) . '</p>';
                    }                
                ?>

        </form>
    </div>

    <div class="featureWrapper">
        <div class="feature return"><img src="/wp-content/plugins/nutrisslim-suiteV2/assets/cart_vracilo_ico.svg" />
            <?php printf(__('%s-day money-back guarantee', 'nutrisslim-suiteV2'), 60); ?></div>
        <div class="feature free"><img src="/wp-content/plugins/nutrisslim-suiteV2/assets/cart_free_delivery_ico.svg" />
            <span><?php printf(__('Free shipping on orders over %s', 'nutrisslim-suiteV2'), wc_price(get_free_shipping_threshold())); ?></span>
        </div>
        <div class="feature delivery"><img src="/wp-content/plugins/nutrisslim-suiteV2/assets/cart_dostava_ico.svg" />
            <?php printf(__('Delivery in 2 business days', 'nutrisslim-suiteV2'), '1-2'); ?></div>
    </div>

    <div class="payment-logos col-12 row mx-0">
        <div class="payment-method pl-0">
            <img class="visa" src="/wp-content/plugins/nutrisslim-suiteV2/assets/visa-color.png" alt="visa">
        </div>
        <div class="payment-method pl-0">
            <img class="mastercard" src="/wp-content/plugins/nutrisslim-suiteV2/assets/mastercard-color.png"
                alt="mastercard">
        </div>
        <div class="payment-method pl-0">
            <img class="american_express" src="/wp-content/plugins/nutrisslim-suiteV2/assets/american_express-color.png"
                alt="american_express">
        </div>
        <div class="payment-method pl-0">
            <img class="paypal" src="/wp-content/plugins/nutrisslim-suiteV2/assets/paypal-color.png" alt="paypal">
        </div>
    </div>
    <p class="phone">
        <?php printf(__('For orders and inquiries, call <strong>%s</strong>', 'nutrisslim-suiteV2'), get_option('woocommerce_support_phone')); ?>
    </p>
</div>
<?php
    }

    protected function _content_template() {
        // Optionally include a JavaScript content template for frontend rendering (optional)
    }
}

// Ensure the class gets loaded.
nutrisslim_include_widgets_files();