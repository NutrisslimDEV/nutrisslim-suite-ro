<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Nutrisslim_Reviews_Widget extends Widget_Base {

    public function get_name() {
        return 'nutrisslim_reviews_widget';
    }

    public function get_title() {
        return __( 'Nutrisslim Reviews Widget', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-comments';
    }

    public function get_categories() {
        return [ 'nutrisslim' ];
    }

    protected function _register_controls() {
        // Register widget controls here if necessary.
    }

    protected function render() {
        $reviews = get_field('reviews'); // Assuming 'reviews' is a repeater field
        // Ensure $reviews is always an array to prevent errors
        if (!is_array($reviews)) {
            $reviews = [];
        }
        $n = count($reviews);

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
                                    <div class="checker"><span class="check"><img src="/wp-content/uploads/2024/03/whiteCheck.png" alt="check"></span> <?php echo __('Client verificat', 'nutrisslim-suiteV2'); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
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

add_action('elementor/widgets/widgets_registered', function($widgets_manager){
    $widgets_manager->register_widget_type(new Nutrisslim_Reviews_Widget());
});
