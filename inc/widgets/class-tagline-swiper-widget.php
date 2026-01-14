<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Icons_Manager;

class Tagline_Slider_Widget extends Widget_Base {

    public function get_name() {
        return 'tagline_slider';
    }

    public function get_title() {
        return __( 'Tagline Slider', 'elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return [ 'nutrisslim' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'elementor-widgets' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => __( 'Slide Text', 'elementor-widgets' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Slide Text', 'elementor-widgets' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => __( 'Icon', 'elementor-widgets' ),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => __( 'Slides', 'elementor-widgets' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [ 'text' => __( 'Slide 1', 'elementor-widgets' ) ],
                    [ 'text' => __( 'Slide 2', 'elementor-widgets' ) ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
    $settings = $this->get_settings_for_display();
    $slides = $settings['slides'];
    $widget_id = $this->get_id();

    if ( ! empty( $slides ) ) {
        echo '<div class="custom-tagline-slider marquee-slider marquee-' . esc_attr( $widget_id ) . '">';
        echo '<div class="marquee-track">';

        // Output slides twice for seamless loop
        foreach ( array_merge( $slides, $slides ) as $slide ) {
            echo '<div class="marquee-slide">';

            // Render icon (font, SVG, or uploaded SVG)
            if ( ! empty( $slide['icon']['value'] ) ) {
                if ( $slide['icon']['library'] === 'svg' ) {
                    if ( is_array( $slide['icon']['value'] ) && ! empty( $slide['icon']['value']['url'] ) ) {
                        // Custom uploaded SVG
                        echo '<img class="slide-icon" src="' . esc_url( $slide['icon']['value']['url'] ) . '" alt="" aria-hidden="true" />';
                    } elseif ( class_exists( '\Elementor\Icons_Manager' ) ) {
                        // Elementor SVG icon library
                        \Elementor\Icons_Manager::render_icon( $slide['icon'], [ 'aria-hidden' => 'true', 'class' => 'slide-icon' ] );
                    }
                } else {
                    // Font icon (e.g., Font Awesome)
                    echo '<i class="' . esc_attr( $slide['icon']['value'] ) . ' slide-icon" aria-hidden="true"></i>';
                }
            }

            echo '<span class="slide-text">' . esc_html( $slide['text'] ) . '</span>';
            echo '</div>';
        }

        echo '</div>'; // .marquee-track
        echo '</div>'; // .custom-tagline-slider
    }
    ?>
    <style>
    .marquee-<?php echo esc_attr( $widget_id ); ?> {
        overflow: hidden;
        white-space: nowrap;
    }

    .marquee-<?php echo esc_attr( $widget_id ); ?> .marquee-track {
        display: inline-flex;
        animation: marquee-<?php echo esc_attr( $widget_id ); ?> 120s linear infinite;
    }

    .marquee-<?php echo esc_attr( $widget_id ); ?> .marquee-slide {
        flex: 0 0 auto;
        margin-right: 120px;
        font-size: 14px;
        font-weight: 300;
        white-space: nowrap;
        display: flex;
        align-items: center;
    }

    .marquee-<?php echo esc_attr( $widget_id ); ?> .marquee-slide .slide-icon {
        margin-right: 8px;
        font-size: 16px;
        display: inline-block;
        height: 14px;
        width: 14px;
        vertical-align: middle;
    }

    @keyframes marquee-<?php echo esc_attr( $widget_id ); ?> {
        0% {
            transform: translateX(0%);
        }
        100% {
            transform: translateX(-50%);
        }
    }
    </style>
    <?php
}

}
