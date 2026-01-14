<?php

/*  COMMENT BUTKE

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class ACF_FAQ_Accordion_Widget extends Widget_Base {

    public function get_name() {
        return 'acf-faq-accordion';
    }

    public function get_title() {
        return __( 'ACF FAQ Accordion', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_categories() {
        return [ 'nutrisslim' ];
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
            'faq_field',
            [
                'label' => __( 'FAQ ACF Field Name', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'faq',
                'description' => __( 'Enter the ACF field name used for the FAQ repeater.', 'text-domain' ),
            ]
        );       

        $this->end_controls_section();
    }

    protected function render() {
        ?>
<style>
.elementor-accordion-item {
    border-bottom: 1px solid #ececec;
}

.elementor-accordion-title {
    font-weight: 800;
    font-size: 22px;
    padding-top: 15px;
    padding-bottom: 15px;
    cursor: pointer;
}

.elementor-accordion-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
}

.elementor-accordion-title .elementor-accordion-icon {
    position: absolute;
    right: 40px;
}

.elementor-accordion-title.active .elementor-accordion-icon:before {
    // transform: rotate(90deg); 
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
        global $product;
		
		if (!$product) {
			$product = wc_get_product(get_the_ID());
		}

        $settings = $this->get_settings_for_display();
        $faq_field_name = $settings['faq_field'];
        $faqs = get_field($faq_field_name);
        
        $selected = get_field('products', $product->get_id());
        $num_of_items = count($selected);

        if ($product && $product->get_type() === 'nutrisslim' && $num_of_items === 1) {

            if (have_rows('field_663a89fffa70d')) {
                // Get the first row
                the_row(); // This will only get the first row
                
                // Get the post object field from the first row
                $_product_id = get_sub_field('field_663a8a56fa70e');

                // Check if a product is selected
                if ($_product_id) {
                    // Load the product object using the ID
                    $_product = wc_get_product($_product_id);

                    if ($_product) {
                        // Now you have the product object and can work with it
                        // echo $_product->get_id(); // Example: Output the product name
                        $faqs = get_field($faq_field_name, $_product->get_id());
                    }
                }
            }            
            
        }

        
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

END COMMENT BUTKE
*/
/*FIXED SHIT*/

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class ACF_FAQ_Accordion_Widget extends Widget_Base {

    public function get_name() {
        return 'acf-faq-accordion';
    }

    public function get_title() {
        return __( 'ACF FAQ Accordion', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_categories() {
        return [ 'nutrisslim' ];
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
            'faq_field',
            [
                'label' => __( 'FAQ ACF Field Name', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'faq',
                'description' => __( 'Enter the ACF field name used for the FAQ repeater.', 'text-domain' ),
            ]
        );       

        $this->end_controls_section();
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

.elementor-accordion-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
}

.elementor-accordion-title .elementor-accordion-icon {
    position: absolute;
    right: 40px;
}

.elementor-accordion-title.active .elementor-accordion-icon:before {}

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
        global $product;

        if (!$product) {
            $product = wc_get_product(get_the_ID());
        }

        if ($product && is_a($product, 'WC_Product')) {
            $settings = $this->get_settings_for_display();
            $faq_field_name = $settings['faq_field'];
            $faqs = get_field($faq_field_name);

            $selected = get_field('products', $product->get_id());
            $num_of_items = count($selected);

            if ($product->get_type() === 'nutrisslim' && $num_of_items === 1) {

                if (have_rows('field_663a89fffa70d')) {
                    the_row(); 
                    $_product_id = get_sub_field('field_663a8a56fa70e');

                    if ($_product_id) {
                        $_product = wc_get_product($_product_id);
                        if ($_product) {
                            $faqs = get_field($faq_field_name, $_product->get_id());
                        }
                    }
                }            
                
            }

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

    function closeAllOthers(current) {
        accTitles.forEach(function(title) {
            if (title !== current) {
                title.classList.remove('active');
                title.nextElementSibling.style.maxHeight = null;
            }
        });
    }

    accTitles.forEach(function(title, index) {
        if (index === 0) {
            title.classList.add('active');
            title.nextElementSibling.style.maxHeight = title.nextElementSibling.scrollHeight + "px";
        }

        title.addEventListener('click', function() {
            var content = this.nextElementSibling;

            if (content.style.maxHeight) {
                return;
            }

            closeAllOthers(this);

            this.classList.add('active');
            content.style.maxHeight = content.scrollHeight + "px";
        });
    });
});
</script>

<?php endif;
        }
    }
}