<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Foot_Widget extends Widget_Base {

    public function get_name() {
        return 'foot_widget';
    }

    public function get_title() {
        return __( 'Foot Widget', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-posts-ticker';
    }

    public function get_categories() {
        return [ 'nutrisslim' ];
    }

    protected function _register_controls() {
        // Register widget controls here if necessary.
    }

    protected function render() {


        echo '<div class="foot-widget-container">';
        
        echo '<h2 style="text-align:center;">' . __('Why choose Nature’s Finest?', 'nutrisslim-suiteV2') . '</h2>';
?>
        <div class="facts">
            <div class="inner">
                <div class="item">
                    <?php printf(__('<span>%s</span> years of tradition', 'nutrisslim-suiteV2'), '14'); ?>
                </div>
                <div class="item">
                    <?php printf(__('<span>%s+</span> unique products', 'nutrisslim-suiteV2'), '400'); ?>
                </div>
                <div class="item">
                    <?php printf(__('<span>%s+</span> patented active ingredients', 'nutrisslim-suiteV2'), '50'); ?>
                </div>
                <div class="item">
                    <?php printf(__('<span>%smil+</span> satisfied customers', 'nutrisslim-suiteV2'), '3'); ?>
                </div>
            </div>
        </div>

        <div class="mysec who">
            <div class="inner">
                <div class="item imghold"><img src="/wp-content/uploads/2024/03/naturesfinest.png" alt="who we are" /></div>
                <div class="item conthold">
                    <div class="greenline active">
                        <p class="label"><strong><?php echo __('Natural:', 'nutrisslim-suiteV2'); ?></strong></p>
                        <p><?php echo __('We believe in the perfection of nature. Our commitment extends to responsible sourcing of raw materials, including sustainability, ethics, and fair business principles. We prioritize eco-friendly packaging to reduce our carbon footprint.', 'nutrisslim-suiteV2'); ?></p>
                    </div>
                    <div class="greenline">
                        <p class="label"><strong><?php echo __('Proven:', 'nutrisslim-suiteV2'); ?></strong></p>
                        <p><?php echo __('The effectiveness of our products is confirmed by studies and research that are verifiable and repeatable. All our products are tested in independent laboratories, as our goal is to provide our customers with only the highest quality and effective products for their money.', 'nutrisslim-suiteV2'); ?></p>
                    </div>
                    <div class="greenline">
                        <p class="label"><strong><?php echo __('Effective:', 'nutrisslim-suiteV2'); ?></strong></p>
                        <p><?php echo __('Nature offers effective solutions for many challenges we face. Our experienced development team uses and combines these exceptional substances in our products so that the body can best utilize them. Active ingredients in our products are present in proven effective amounts, not just in small and negligible percentages.', 'nutrisslim-suiteV2'); ?></p>
                    </div>
                    <div class="greenline">
                        <p class="label"><strong><?php echo __('Tested:', 'nutrisslim-suiteV2'); ?></strong></p>
                        <p><?php echo __('Our products are tested through various user studies and trials that ensure their safety and effectiveness. We always listen carefully to the feedback from our customers and consider their opinions, criticisms, and suggestions to ensure that our products are truly tailored to their needs.', 'nutrisslim-suiteV2'); ?></p>
                    </div>
                </div>
            </div>
        </div>       

        <div class="mysec short strok">
            <h2><?php echo __('Meet Our Development Experts', 'nutrisslim-suiteV2'); ?></h2>
            <div class="holder">
                <p><?php echo __('We are proud to have only the best experts in the field of nutrition and dietary supplements on our team, who ensure the development and exceptional quality of our products. With outstanding dedication, they lead studies and research and collaborate with external laboratories, inspection bodies, and other experts to ensure the highest quality and safety of our products.', 'nutrisslim-suiteV2'); ?></p>
                <p><?php echo __('With rich experience and professional knowledge of the industry, our experts strive to provide Nutrisslim customers with the most innovative products, thus maintaining its status as one of the leading companies in the field of nutrition and dietary supplements.', 'nutrisslim-suiteV2'); ?></p>
            </div>
            <div class="inner meetstrok">
                <div class="item">
                    <img src="/wp-content/uploads/2024/03/meta.png" alt="<?php echo __('Meta Bizjak', 'nutrisslim-suiteV2'); ?>">
                    <strong><?php echo __('Meta Bizjak', 'nutrisslim-suiteV2'); ?></strong> <span><?php echo __('M.Sc. Nutrition Engineering', 'nutrisslim-suiteV2'); ?></span>
                </div>
                <div class="item">
                    <img src="/wp-content/uploads/2024/03/pia-1.png" alt="<?php echo __('Pia Fistrovič', 'nutrisslim-suiteV2'); ?>">
                    <strong><?php echo __('Pia Fistrovič', 'nutrisslim-suiteV2'); ?></strong> <span><?php echo __('Food and Nutrition Engineer', 'nutrisslim-suiteV2'); ?></span>
                </div>                
            </div>
        </div>

        <div class="myset wenature">
            <h2 class="biggreen"><?php echo __('#WeAreNature', 'nutrisslim-suiteV2'); ?></h2>
            <h2><?php echo __('»Committed to delivering the most natural products to your home«', 'nutrisslim-suiteV2'); ?></h2>
            <p><?php echo __('For over 13 years, Nature’s Finest has been dedicated to offering natural solutions for those who want to overcome challenges and discomforts with a healthy lifestyle. We use only 100% natural ingredients, traditionally grown without additives or unnecessary processing. Whenever possible, we use ingredients from organic farming, supported by the SI-EKO certificate. This ensures that no genetically modified organisms (GMOs) or pesticides are used.', 'nutrisslim-suiteV2'); ?></p>
        </div>
      
<?php

        echo '</div>';

    }
}
