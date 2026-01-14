<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Photo_Features_Widget extends Widget_Base {

    public function get_name() {
        return 'photo_features';
    }

    public function get_title() {
        return __( 'Photo Features', 'nutrisslim-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'nutrisslim' ]; // Ensure 'nutrisslim' is the slug of your registered category
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Configuration', 'nutrisslim-elementor-widgets' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'photo_features_subtitle',
            [
                'label' => __( 'Subtitle', 'nutrisslim-elementor-widgets' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => __( 'Enter your subtitle here', 'nutrisslim-elementor-widgets' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'feature',
            [
                'label' => __( 'Feature', 'nutrisslim-elementor-widgets' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Feature' , 'nutrisslim-elementor-widgets' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'photo_features_features',
            [
                'label' => __( 'Features', 'nutrisslim-elementor-widgets' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ feature }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $subtitle = $settings['photo_features_subtitle'];
        $features = $settings['photo_features_features'];

        if (!empty($subtitle)) {
            echo '<h3>' . esc_html($subtitle) . '</h3>';
        }

        if (!empty($features)) {
            echo '<ul>';
            foreach ($features as $item) {
                echo '<li>' . esc_html($item['feature']) . '</li>';
            }
            echo '</ul>';
        }
    }

    protected function _content_template() {
        // JavaScript content template for frontend rendering (optional)
    }
}
