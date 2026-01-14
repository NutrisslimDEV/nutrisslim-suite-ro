<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class Product_Swiper_Widget extends Widget_Base {

    public function get_name() {
        return 'product_swiper';
    }

    public function get_title() {
        return __( 'Product Swiper', 'elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    /**
     * Fetch all products (ID => Title)
     */
    private function get_products_list() {
        $args = [
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ];

        $products = get_posts( $args );
        $options  = [];

        if ( ! empty( $products ) ) {
            foreach ( $products as $product ) {
                $options[ $product->ID ] = $product->post_title;
            }
        }

        return $options;
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'elementor-widgets' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Repeater to pick products
        $repeater = new Repeater();

        $repeater->add_control(
            'product_id',
            [
                'label'       => __( 'Select Product', 'elementor-widgets' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => $this->get_products_list(),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'custom_image',
            [
                'label'   => __( 'Custom Image', 'elementor-widgets' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'product_list',
            [
                'label'       => __( 'Products to Display', 'elementor-widgets' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [],
                'title_field' => '{{{ product_id }}}',
            ]
        );

        // These controls become less relevant if we’re forcing 'auto' width,
        // but we’ll keep them for future expansion if needed.
        $this->add_control(
            'items_desktop',
            [
                'label'   => __( 'Number of Items on Desktop', 'elementor-widgets' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3,
            ]
        );

        $this->add_control(
            'items_tablet',
            [
                'label'   => __( 'Number of Items on Tablet', 'elementor-widgets' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 2,
            ]
        );

        $this->add_control(
            'items_mobile',
            [
                'label'   => __( 'Number of Items on Mobile', 'elementor-widgets' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 1,
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings       = $this->get_settings_for_display();
        $product_list   = $settings['product_list'];
        $widget_id      = $this->get_id();

        if ( empty( $product_list ) ) {
            // No products selected
            return;
        }

        // Begin outer container
        echo '<div class="custom-product-swiper product-swiper swiper-' . esc_attr( $widget_id ) . '" data-widget-id="' . esc_attr( $widget_id ) . '">';

        // Swiper container
        echo '  <div class="swiper-container">';

        // Wrapper for slides
        echo '      <div class="swiper-wrapper swipermenuizdelki">';

        // Loop through each product
        foreach ( $product_list as $item ) {
            $product_id = ! empty( $item['product_id'] ) ? $item['product_id'] : false;
            if ( ! $product_id ) continue;

            $product = wc_get_product( $product_id );
            if ( ! $product ) continue;

            $pid   = $product->get_id();
            // ACF or fallback to short/long description
            $short = get_field('short_info', $pid);
            if ( empty( $short ) ) {
                $short = $product->get_short_description() ?: $product->get_description();
            }
            // Trim text
            $short = wp_trim_words( $short, 350, '...' );

            // On sale logic
            $onsale = '';
            if ( $product->is_on_sale() ) {
                $regular_price = $product->get_regular_price();
                $sale_price    = $product->get_sale_price();
                if ( $regular_price > 0 ) {
                    $discount_percentage = ( ( $regular_price - $sale_price ) / $regular_price ) * 100;
                    $onsale = '<span class="onsale saleikonamenu">-' . round( $discount_percentage ) . '%</span>';
                }
            }

            // Custom image fallback
            $custom_image = ! empty( $item['custom_image']['url'] ) ? $item['custom_image']['url'] : '';

            echo '<div class="swiper-slide">';
                echo '<a href="' . get_the_permalink( $pid ) . '">';
                    echo '<div class="img-wrapper slikaizdelkamenu">';
                        echo '<div class="img-holder">';
                            echo $onsale;
                            if ( $custom_image ) {
                                echo '<img src="' . esc_url( $custom_image ) . '" alt="' . esc_attr( get_the_title( $pid ) ) . '" />';
                            } else {
                                echo get_the_post_thumbnail( $pid, 'medium' );
                            }
                        echo '</div>'; // .img-holder
                    echo '</div>'; // .img-wrapper
                echo '</a>';
                
                echo '<div class="content-wrapper">';
                    echo '<h3>' . get_the_title( $pid ) . '</h3>';
                    echo '<div class="butHolder">';
                        echo '<p class="tworows">' . $short . '</p>';
                        echo '<div class="price">' . $product->get_price_html() . '</div>';
                        echo '<div class="butke"><a data-product-id="' . $pid . '" class="org-btn add-to-cart-icon" href="#">' . __( ' Add to cart', 'nutrisslim-suiteV2' ) . '</a></div>';
                    echo '</div>'; // .butHolder
                echo '</div>'; // .content-wrapper
            echo '</div>'; // .swiper-slide
        }

        echo '      </div>'; // .swiper-wrapper

        // Scrollbar INSIDE the swiper-container
        echo '      <div class="swiper-scrollbar swiper-scrollbar-' . esc_attr( $widget_id ) . '"></div>';

        echo '  </div>'; // .swiper-container

        echo '</div>'; // .product-swiper
        ?>

<!-- Swiper Initialization Script -->
<script>
(function($) {
    $(document).ready(function() {
        const swiper<?php echo esc_attr( $widget_id ); ?> = new Swiper(
            '.swiper-<?php echo esc_attr( $widget_id ); ?> .swiper-container', {
                slidesPerView: 'auto', // automatically size slides (fixed width from CSS)
                spaceBetween: 20, // gap between slides
                freeMode: true, // free scrolling
                // No arrows - only scrollbar
                scrollbar: {
                    el: '.swiper-scrollbar-<?php echo esc_attr( $widget_id ); ?>',
                    draggable: true,
                },
                mousewheel: {
                    forceToAxis: true,
                    invert: false,
                }
            });
    });
})(jQuery);
</script>
<?php
    }

    protected function _content_template() {
        // Left empty
    }
}