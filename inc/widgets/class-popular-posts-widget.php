<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Popular_Posts_Widget extends Widget_Base {

    public function get_name() {
        return 'popular_posts';
    }

    public function get_title() {
        return __( 'Popular Posts', 'elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-post-list';
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

        $this->add_control(
            'category',
            [
                'label' => __( 'Category', 'elementor-widgets' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_categories_options(),
                'default' => '',
            ]
        );

        $this->add_control(
            'tags',
            [
                'label' => __( 'Tags', 'elementor-widgets' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_tags_options(),
                'default' => '',
            ]
        );

        $this->add_control(
            'number_of_items',
            [
                'label' => __( 'Number of Items', 'elementor-widgets' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 5,
            ]
        );

        $this->add_control(
            'has_lead',
            [
                'label' => __( 'Has Lead', 'elementor-widgets' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'On', 'elementor-widgets' ),
                'label_off' => __( 'Off', 'elementor-widgets' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->end_controls_section();
    }

    private function get_categories_options() {
        $categories = get_terms( 'category', [ 'hide_empty' => false ] );
        $options = [];
        if ( ! empty( $categories ) ) {
            foreach ( $categories as $category ) {
                $options[ $category->term_id ] = $category->name;
            }
        }
        return $options;
    }

    private function get_tags_options() {
        $tags = get_terms( 'post_tag', [ 'hide_empty' => false ] );
        $options = [];
        if ( ! empty( $tags ) ) {
            foreach ( $tags as $tag ) {
                $options[ $tag->term_id ] = $tag->name;
            }
        }
        return $options;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $category_ids = $settings['category'];
        $tag_ids = $settings['tags'];
        $number_of_items = $settings['number_of_items'];
        $has_lead = $settings['has_lead'] === 'yes';

        $args = [
            'post_type' => 'post',
            'posts_per_page' => $number_of_items,
            'orderby' => 'rand',
            'tax_query' => [
                'relation' => 'OR',
            ],
        ];

        if ( ! empty( $category_ids ) ) {
            $args['tax_query'][] = [
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $category_ids,
                'operator' => 'IN',
            ];
        }

        if ( ! empty( $tag_ids ) ) {
            $args['tax_query'][] = [
                'taxonomy' => 'post_tag',
                'field' => 'term_id',
                'terms' => $tag_ids,
                'operator' => 'IN',
            ];
        }

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) {
            echo '<div class="popular-posts-widget">';
            $first = true;
            while ( $query->have_posts() ) {
                $query->the_post();

                if ( $has_lead && $first ) {
                    echo '<div class="lead-post">';
                    echo '<a href="' . get_the_permalink() . '">';
                    echo '<div class="img-wrap">' . get_the_post_thumbnail( get_the_ID(), 'medium' ) . '</div>';
                    echo '<h3>' . get_the_title() . '</h3>';
                    echo '<p>' . wp_trim_words( get_the_excerpt(), 20, '...' ) . '</p>';
                    echo '</a>';
                    echo '</div>';
                    $first = false;
                } else {
                    echo '<div class="post-item">';
                    echo '<a href="' . get_the_permalink() . '">';
                    echo get_the_post_thumbnail( get_the_ID(), 'thumbnail' );
                    echo '<h3>' . get_the_title() . '</h3>';
                    echo '</a>';
                    echo '</div>';
                }
            }
            echo '</div>';
            wp_reset_postdata();
        }
    }

    protected function _content_template() {

    }
}
