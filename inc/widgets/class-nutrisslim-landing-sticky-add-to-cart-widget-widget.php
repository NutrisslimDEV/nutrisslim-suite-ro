<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Sticky_Add_To_Cart_Widget extends Widget_Base {

    public function get_name() {
        return 'sticky_add_to_cart_widget';
    }

    public function get_title() {
        return __( 'Sticky Add To Cart', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-cart';
    }

    public function get_categories() {
        return [ 'nutrisslim-landing' ];
    }

    protected function render() {

        $product = get_field('selected_product');
        $product = $product[0];
        if (! $product) {
            return;
        }
        $productObj = wc_get_product($product);
        $type = $productObj->get_type();
        if ($type == 'nutrisslim') {
            $real = true;
        } else {
            $real = '';
        }

        // $regular_price = $productObj->get_regular_price();   
        $regular_price = wc_get_price_including_tax($productObj, ['price' => $productObj->get_regular_price()]);

        // $price_for_one = get_custom_product_price($product, 1, get_the_ID(), '', $real);     

        // Calculate the custom price for one unit
        $price_for_one = get_custom_product_price($product, 1, get_the_ID(), '', $real);

        // Add tax to the custom price for one unit
        $price_for_one_with_tax = wc_get_price_including_tax($productObj, ['price' => $price_for_one]);
        
     

        ?>
<div class="sticky-add-to-cart">
    <span class="regular-price"><?php echo wc_price($regular_price); ?></span>
    <span class="sale-price"><?php echo wc_price($price_for_one_with_tax); ?></span>

    <a href="#order-form-anchor" class="org-btn"><?php _e('ORDER NOW', 'nutrisslim-suiteV2'); ?></a>
</div>
<script>
$ = jQuery.noConflict();
$(function() {
    var $this = $('div.sticky-add-to-cart');
    var $stickyContainer = $this.closest('.e-con').addClass('sticky-container');

    $(window).on('scroll', function() {
        var orderFormAnchor = $('#order-form-anchor');
        if (orderFormAnchor.length) {
            var orderFormOffset = orderFormAnchor.offset().top;
            var scrollTop = $(window).scrollTop();
            var windowHeight = $(window).height();

            if (scrollTop + windowHeight >= orderFormOffset) {
                $stickyContainer.addClass('slide-down');
            } else {
                $stickyContainer.removeClass('slide-down');
            }
        }
    });

});
</script>
<?php
    }
}