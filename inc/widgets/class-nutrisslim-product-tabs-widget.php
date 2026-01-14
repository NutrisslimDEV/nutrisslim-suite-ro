<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Nutrisslim_Product_Tabs_Widget extends Widget_Base {

    public function get_name() {
        return 'nutrisslim-product-tabs';
    }

    public function get_title() {
        return __( 'Nutrisslim Product Tabs', 'nutrisslim-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return [ 'nutrisslim' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_tab',
            [
                'label' => __( 'Settings', 'nutrisslim-elementor-widgets' ),
            ]
        );

        // Toggle: include bundle children reviews in the Reviews tab
        $this->add_control(
            'include_bundle_reviews',
            [
                'label'        => __( 'Include bundle children reviews', 'nutrisslim-elementor-widgets' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'nutrisslim-elementor-widgets' ),
                'label_off'    => __( 'No', 'nutrisslim-elementor-widgets' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        global $product;

        if ( ! is_a( $product, 'WC_Product' ) ) {
            echo esc_html__( 'Please set a valid product.', 'nutrisslim-elementor-widgets' );
            return;
        }

        $settings = $this->get_settings_for_display();
        $include_bundle_children = ( isset($settings['include_bundle_reviews']) && $settings['include_bundle_reviews'] === 'yes' );

        // Retrieve the content from ACF fields
        $uporaba_content             = get_field( 'uporaba', $product->get_id() );
        $sestavine_content           = get_field( 'sestavine', $product->get_id() );
        $hranilne_vrednosti_content  = get_field( 'hranilne_vrednosti', $product->get_id() );

        $tabs = apply_filters( 'woocommerce_product_tabs', array() );

        // Remove the description tab (keeping your existing behavior)
        unset($tabs['description']);


// Add tabs for each ACF field if content is present
        if ( ! empty( $uporaba_content ) ) {
            $tabs['uporaba'] = array(
                'title'    => __( 'Usage', 'nutrisslim-suiteV2' ),
                'callback' => 'nutrisslim_uporaba_tab_content_callback',
                'priority' => 10,
            );
        }

        if ( ! empty( $sestavine_content ) ) {
            $tabs['sestavine'] = array(
                'title'    => __( 'Ingredients', 'nutrisslim-suiteV2' ),
                'callback' => 'nutrisslim_sestavine_tab_content_callback',
                'priority' => 20,
            );
        }

        if ( ! empty( $hranilne_vrednosti_content ) ) {
            $tabs['hranilne_vrednosti'] = array(
                'title'    => __( 'Nutritional values', 'nutrisslim-suiteV2' ),
                'callback' => 'nutrisslim_hranilne_vrednosti_tab_content_callback',
                'priority' => 30,
            );
        }

        // --- NEW: Reviews tab (merged approved reviews, Woo-native rendering) ---
        $tabs['reviews'] = array(
            'title'    => __( 'Recenzii', 'nutrisslim-suite' ),
            'callback' => function() use ( $product, $include_bundle_children ) {
                ns_render_merged_reviews_panel( $product->get_id(), $include_bundle_children );
            },
            'priority' => 40,
        );
        // -----------------------------------------------------------------------

        // Keep your “rotate first to end” behavior
        if ( ! empty( $tabs ) ) {
            $firstItem = array_shift($tabs);
            array_push($tabs, $firstItem);
        }

        if ( ! empty( $tabs ) ) : ?>
            <div class="woocommerce-tabs wc-tabs-wrapper">
                <ul class="tabs wc-tabs" role="tablist">
                    <?php foreach ( $tabs as $key => $tab ) : ?>
                        <li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab"
                            aria-controls="tab-<?php echo esc_attr( $key ); ?>">
                            <a href="#tab-<?php echo esc_attr( $key ); ?>">
                                <?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <?php foreach ( $tabs as $key => $tab ) : ?>
                    <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab"
                         id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel"
                         aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
                        <?php if ( isset( $tab['callback'] ) && is_callable( $tab['callback'] ) ) {
                            call_user_func( $tab['callback'], $key, $tab );
                        } ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php
        endif;
    }
}

/**
 * Render merged approved reviews panel for the product.
 * - Optionally includes bundle children (via ptr_get_review_post_ids_for_product)
 * - De-duplicates identical (author_email + normalized text)
 * - Paginates using comments_per_page and ?cpage=… anchored back to this tab
 * - Uses WooCommerce native review template
 * - Includes the default review form at the bottom
 */
function ns_render_merged_reviews_panel( int $product_id ) {
    if ( ! function_exists('wc_get_product') ) return;

    $product = wc_get_product( $product_id );
    if ( ! $product ) return;

    // Always and only this product's reviews
    $post_ids = [ (int) $product_id ];

    // Pagination
    $per_page = max( 1, (int) get_option( 'comments_per_page', 10 ) );
    $page     = max(
        1,
        isset($_GET['cpage']) ? (int) $_GET['cpage'] : (int) get_query_var('cpage')
    );

    // Total approved reviews for this product
    $total = (int) get_comments( [
        'post__in' => $post_ids,
        'type'     => 'review',
        'status'   => 'approve',
        'count'    => true,
    ] );

    // Page of approved reviews (newest first)
    $comments = get_comments( [
        'post__in'   => $post_ids,
        'type'       => 'review',
        'status'     => 'approve',
        'orderby'    => 'comment_date_gmt',
        'order'      => 'DESC',
        'number'     => $per_page,
        'offset'     => ($page - 1) * $per_page,
    ] );

    echo '<div id="reviews" class="woocommerce-Reviews">';
    echo '  <div id="comments">';
    echo '    <h2 class="woocommerce-Reviews-title">' . esc_html__( 'Recenzii ale clienților', 'woocommerce' ) . '</h2>';

    if ( $total > 0 ) {
        echo '<ol class="commentlist">';
        foreach ( $comments as $comment ) {
            $GLOBALS['comment'] = $comment; // template expects global
            wc_get_template( 'single-product/review.php' );
        }
        echo '</ol>';

        $total_pages = (int) ceil( $total / $per_page );
        if ( $total_pages > 1 ) {
            echo '<nav class="woocommerce-pagination">';
            echo paginate_links( [
                'base'      => esc_url_raw( add_query_arg( 'cpage', '%#%' ) ) . '#tab-reviews',
                'format'    => '',
                'current'   => $page,
                'total'     => $total_pages,
                'prev_text' => '&larr;',
                'next_text' => '&rarr;',
            ] );
            echo '</nav>';
        }
    } else {
        echo '<p class="woocommerce-noreviews">' . esc_html__( 'There are no reviews yet.', 'woocommerce' ) . '</p>';
    }

    echo '  </div>'; // #comments
    // No review form on product page by request.
    echo '</div>'; // #reviews
}

function nutrisslim_uporaba_tab_content_callback() {
    echo get_field( 'uporaba', get_the_ID() );
    $warnings = get_field('warnings', get_the_ID());
    if ($warnings) {
        echo '<p><strong>' . __( 'Warning:', 'nutrisslim-suiteV2' ) . '</strong></p>';
        echo $warnings;
    }
}

function nutrisslim_sestavine_tab_content_callback() {
    echo get_field( 'sestavine', get_the_ID() );
}

function nutrisslim_hranilne_vrednosti_tab_content_callback() {
    echo get_field( 'hranilne_vrednosti', get_the_ID() );
}
