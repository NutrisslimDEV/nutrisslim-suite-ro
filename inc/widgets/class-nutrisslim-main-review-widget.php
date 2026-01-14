<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Nutrisslim_Main_Review_Widget extends Widget_Base {

    public function get_name() {
        return 'nutrisslim_main_review_widget';
    }

    public function get_title() {
        return __( 'Nutrisslim Main Review Widget', 'text-domain' );
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
        $main_review = get_field('main_review'); // Assuming 'main_review' is a repeater field
        // Ensure $main_review is always an array to prevent errors
        if (empty($main_review['review'])) {
            return;
        }
        $image_url = wp_get_attachment_image_url($main_review['image'], 'medium');
?>
    <div class="mainReview primary-transparent-bg-color">
        <div class="inner">
            <?php echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($review['name']) . '">'; ?>
            <div class="revContent">
                <div class="name"><?php echo $main_review['name']?></div>
                <div class="rateMeta">
                    <img class="star" src="/wp-content/uploads/2024/03/5-stars-01-1.svg" /><img class="star" src="/wp-content/uploads/2024/03/5-stars-01-1.svg" /><img class="star" src="/wp-content/uploads/2024/03/5-stars-01-1.svg" /><img class="star" src="/wp-content/uploads/2024/03/5-stars-01-1.svg" /><img class="star" src="/wp-content/uploads/2024/03/5-stars-01-1.svg" />
                    <div class="rate">5 / 5</div>
                </div>
                <div class="revComment">
                    <p><?php echo $main_review['review']?></p>
                </div>
            </div>
        </div>
    </div>
<?php        
    }
}        
