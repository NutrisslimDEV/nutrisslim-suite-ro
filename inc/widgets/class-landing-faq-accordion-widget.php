<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class ACF_Landing_FAQ_Accordion_Widget extends Widget_Base {

    public function get_name() {
        return 'acf-landing-faq-accordion';
    }

    public function get_title() {
        return __( 'ACF Landing FAQ Accordion', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-accordion';
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
                    'unit' => 'px',
                    'size' => 1715,
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
        ?>
<style>
.elementor-accordion-item {
    border-bottom: 1px solid #ececec;
}

.elementor-accordion-title {
    font-weight: 600;
    font-size: 18px;
    padding-top: 15px;
    padding-bottom: 15px;
    cursor: pointer;
}

/* Initial style for accordion content panels */
.elementor-accordion-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
}

.elementor-accordion-title .elementor-accordion-icon {
    position: absolute;
    right: 40px;
}

/* Style for accordion title when active/open */
.elementor-accordion-title.active .elementor-accordion-icon:before {
    /* transform: rotate(90deg); */
    /* Example to rotate icon, adjust as needed */
}

.elementor-accordion-title .elementor-accordion-icon i {
    position: absolute;
}

.elementor-accordion-title .elementor-accordion-icon i {
    transform: rotate(180deg);
    transition: all 0.3s ease-in-out;
}

.elementor-accordion-title .elementor-accordion-icon i.icofont-plus {
    opacity: 1;
}

.elementor-accordion-title.active .elementor-accordion-icon i {
    transition: all 0.3s ease-in-out;
    transform: rotate(0deg);
}

.elementor-accordion-title.active .elementor-accordion-icon i.icofont-plus {
    opacity: 0;
}
</style>
<?php
        $settings = $this->get_settings_for_display();
        // $faq_field_name = $settings['faq_field'];
        // $faqs = get_field($faq_field_name);

        $product = get_field('selected_product');
        $product = $product[0];

        $product_id = $settings['selected_product']; 

        $faqs = get_field('faq', $product_id);

        // Remove the first 4 items
        if (is_array($faqs)) {
            $faqs = array_slice($faqs, 4);
        }        

        if ( !empty($faqs) ) : ?>
<h2 style="text-align:center;">
    <?php echo esc_html__( 'Frequently Asked Questions of Our Users', 'nutrisslim-suiteV2' ); ?></h2>
<div class="elementor-accordion">
    <?php foreach ( $faqs as $index => $faq ) : ?>
    <div class="elementor-accordion-item">
        <div class="elementor-accordion-title" role="tab" id="elementor-tab-title-<?php echo $index; ?>"
            tabindex="<?php echo $index; ?>">
            <?php echo esc_html( $faq['question'] ); ?>
            <span class="elementor-accordion-icon elementor-accordion-icon-right" aria-hidden="true">
                <i class="icofont-plus" aria-hidden="true"></i>
                <i class="icofont-minus" aria-hidden="true"></i>
            </span>
        </div>
        <div class="elementor-accordion-content" role="tabpanel" id="elementor-tab-content-<?php echo $index; ?>"
            aria-labelledby="elementor-tab-title-<?php echo $index; ?>">
            <?php echo $faq['answer']; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var accTitles = document.querySelectorAll('.elementor-accordion-title');

    // Function to close all accordion items except the one passed as an argument
    function closeAllOthers(current) {
        accTitles.forEach(function(title) {
            if (title !== current) {
                title.classList.remove('active');
                title.nextElementSibling.style.maxHeight = null;
            }
        });
    }

    accTitles.forEach(function(title, index) {
        // Open the first accordion item by default
        if (index === 0) {
            title.classList.add('active');
            title.nextElementSibling.style.maxHeight = title.nextElementSibling.scrollHeight + "px";
        }

        title.addEventListener('click', function() {
            var content = this.nextElementSibling;

            // If this accordion item is already open, do nothing
            if (content.style.maxHeight) {
                return;
            }

            // Close all other accordion items
            closeAllOthers(this);

            // Open the clicked accordion item
            this.classList.add('active');
            content.style.maxHeight = content.scrollHeight + "px";
        });
    });
});
</script>


<?php endif;
    }
}