<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Nutrisslim_Landing_Reviews_Widget extends Widget_Base {

    public function get_name() {
        return 'nutrisslim_landing_reviews_widget';
    }

    public function get_title() {
        return __( 'Nutrisslim Landing Reviews Widget', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-comments';
    }

    public function get_categories() {
        return [ 'nutrisslim-landing' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'text-domain' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
    
        $this->add_control(
            'selected_product',
            [
                'label' => __( 'Select Product', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_products(),
                'multiple' => false,
            ]
        );

        $this->add_control(
            'width_option',
            [
                'label' => __( 'Width', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'custom',
                'options' => [
                    'default' => __( 'Default', 'text-domain' ),
                    'full-width' => __( 'Full Width', 'text-domain' ),
                    'custom' => __( 'Custom', 'text-domain' ),
                ],
            ]
        );
    
        $this->add_control(
            'custom_width',
            [
                'label' => __( 'Custom Width', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 320,
                        'max' => 1920,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'condition' => [
                    'width_option' => 'custom',
                ],
            ]
        );        
    
        $this->end_controls_section();
    }

    protected function get_products() {
        $args = [
            'post_type' => 'product',
            'posts_per_page' => -1
        ];
    
        $products = get_posts( $args );
    
        $options = [];
        foreach ( $products as $product ) {
            $options[ $product->ID ] = $product->post_title;
        }        
    
        return $options;
    } 

    protected function render() {

        $settings = $this->get_settings_for_display();
        $product = get_field('selected_product');
        $product = $product[0];
        $product_id = $settings['selected_product']; 
                
        if ($product_id) {
            $product = $product_id;
        }

        $reviews = get_field('reviews', $product); // Assuming 'reviews' is a repeater field
        // Ensure $reviews is always an array to prevent errors
        if (!is_array($reviews)) {
            $reviews = [];
        }
        $n = count($reviews);

        if ($n > 1) {
            echo '<div class="rateHolder">';
            echo '<div class="inner">';
            echo '<h2>Izkušnje naših uporabnikov</h2>';
            echo do_shortcode('[product_rating id="' . $product . '"]');
            echo '</div>';
            echo '</div>';
        }

        if ($n < 4) {
            $sliderName = 'contentRevSlider3';
            $m = 3;
        } else {
            $sliderName = 'contentRevSlider4';
            $m = 4;
        }
        if (empty($reviews)) {           
            return;
        }

        ?>
        <div class="swiperHolder">
            <div class="swiper-container contentRevSlid <?php echo $sliderName; ?>">
                <div class="swiper-wrapper">
                    <?php foreach ($reviews as $review): ?>
                        <div class="swiper-slide bg-light-grey">
                            <div class="revSlid">
                                <div class="square"><img src="<?php echo esc_url(wp_get_attachment_image_url($review['image'], 'large')); ?>" alt="<?php echo esc_attr($review['name']); ?>"></div>
                                <div class="revContent">
                                    <div class="rateMeta">
                                        <?php for ($i = 0; $i < 5; $i++): ?>
                                            <img class="star" src="/wp-content/uploads/2024/03/star.png" alt="star">
                                        <?php endfor; ?>
                                    </div>
                                    <div class="revComment">
                                        <?php if (isset($review['highlight'])): ?>
                                            <p class="highlight"><?php echo esc_html($review['highlight']); ?></p>
                                        <?php endif; ?>
                                        <p><?php echo esc_html($review['review']); ?></p>
                                    </div>
                                    <div class="udata">
                                        <div class="name"><span><?php echo esc_html($review['name']); ?></span></div>
                                        <div class="checker"><span class="check"><img src="/wp-content/uploads/2024/03/whiteCheck.png" alt="check"></span> <?php echo __('Zweryfikowany użytkownik', 'nutrisslim-suiteV2'); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                new Swiper('.contentRevSlid', {
                    loop: true,
                    slidesPerView: 1.2,
                    spaceBetween: 10,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    spaceBetween: 10,                  
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    breakpoints: {
                        // when window width is >= 480px
                        540: {
                            slidesPerView: 2.2,
                            spaceBetween: 20
                        },
                        780: {
                            slidesPerView: 3,
                            spaceBetween: 20
                        },
                        1024: {
                            slidesPerView: <?php echo $m; ?>,
                            spaceBetween: 20
                        }                        
                    }                    
                });
            });
        </script>
        <?php
    }
}