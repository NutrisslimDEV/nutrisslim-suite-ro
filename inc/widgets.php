<?php
/**
 * Register Nutrisslim Widget Category.
 */
function nutrisslim_register_widget_category( $elements_manager ) {
    $elements_manager->add_category(
        'nutrisslim',
        [
            'title' => __( 'Nutrisslim', 'nutrisslim-elementor-widgets' ),
            'icon' => 'fa fa-plug',
        ]
    );
    $elements_manager->add_category(
        'nutrisslim-landing',
        [
            'title' => __( 'Nutrisslim Landing', 'nutrisslim-landing-elementor-widgets' ),
            'icon' => 'fa fa-plug',
        ]
    );    
}
add_action( 'elementor/elements/categories_registered', 'nutrisslim_register_widget_category' );

/**
 * Include widget files.
 */
function nutrisslim_include_widgets_files() {
    require_once( __DIR__ . '/widgets/class-nutrisslim-add-to-cart-widget.php' );
    require_once( __DIR__ . '/widgets/class-nutrisslim-ingredients-swiper-widget.php' );
    require_once( __DIR__ . '/widgets/class-nutrisslim-landing-ingredients-swiper-widget.php' );
    require_once( __DIR__ . '/widgets/class-nutrisslim-faq-widget.php' );
    require_once( __DIR__ . '/widgets/class-nutrisslim-featured-image-widget.php' );
    require_once( __DIR__ . '/widgets/class-photo-features-widget.php' );
    require_once( __DIR__ . '/widgets/class-badges-widget.php' );
    require_once( __DIR__ . '/widgets/class-nutrisslim-product-tabs-widget.php' );
    require_once( __DIR__ . '/widgets/class-acf-faq-accordion-widget.php' );
    require_once( __DIR__ . '/widgets/class-landing-faq-accordion-widget.php' );
    require_once( __DIR__ . '/widgets/class-nutrisslim-bottom-features-widget.php' );
    require_once( __DIR__ . '/widgets/class-nutrisslim-media-content-widget.php' );
    require_once __DIR__ . '/widgets/class-product-video-description-widget.php';
    require_once __DIR__ . '/widgets/class-top-list-section-widget.php';
    require_once __DIR__ . '/widgets/class-bottom-list-section-widget.php';
    require_once __DIR__ . '/widgets/class-ic-widget.php';
    require_once __DIR__ . '/widgets/class-short-description-widget.php';
    require_once __DIR__ . '/widgets/class-foot-widget.php';
    require_once __DIR__ . '/widgets/class-tag-list-section-widget.php';
    require_once __DIR__ . '/widgets/class-gift-widget.php';
    require_once __DIR__ . '/widgets/class-nutrisslim-reviews-widget.php';
    require_once __DIR__ . '/widgets/class-nutrisslim-landing-reviews-widget.php';
    require_once __DIR__ . '/widgets/class-nutrisslim-main-review-widget.php';
    require_once __DIR__ . '/widgets/class-product-swiper-widget.php';
    require_once __DIR__ . '/widgets/class-popular-posts-widget.php';
    require_once __DIR__ . '/widgets/class-tagline-swiper-widget.php';
    require_once( __DIR__ . '/widgets/class-nutrisslim-landing-content-widget.php' );
    require_once( __DIR__ . '/widgets/class-nutrisslim-landing-sticky-add-to-cart-widget-widget.php' );
	require_once( __DIR__ . '/widgets/class-nutrisslim-landing-quantity-selector.php' );
    require_once( __DIR__ . '/widgets/class-nutrisslim-landing-order-button.php' );
    require_once( __DIR__ . '/widgets/class-trusted-reviews-widget.php' );
    require_once( __DIR__ . '/widgets/class-nutrisslim-custom-banner-widget.php' );
    // Landing page widgets
}

add_action( 'elementor/widgets/widgets_registered', 'nutrisslim_include_widgets_files' );

/**
 * Register new Elementor widgets.
 */
function nutrisslim_register_widgets( $widgets_manager ) {
    $widgets_manager->register( new \Nutrisslim_Add_To_Cart_Widget() );
    $widgets_manager->register( new \Nutrisslim_Ingredients_Swiper_Widget() ); // Add this line
    $widgets_manager->register( new \Nutrisslim_Landing_Ingredients_Swiper_Widget() ); // Add this line
    $widgets_manager->register( new \Nutrisslim_FAQ_Widget() );
    $widgets_manager->register( new \Nutrisslim_Features_Image_Widget() );
    $widgets_manager->register( new \Photo_Features_Widget() );
    $widgets_manager->register( new \Badge_Widget() );
    $widgets_manager->register( new \Nutrisslim_Product_Tabs_Widget() );
    $widgets_manager->register( new \ACF_FAQ_Accordion_Widget() );
    $widgets_manager->register( new \ACF_Landing_FAQ_Accordion_Widget() );
    $widgets_manager->register( new \Nutrisslim_Bottom_Features_Widget() );
    $widgets_manager->register( new \Nutrisslim_ACF_Media_Content_Widget() );
    $widgets_manager->register( new \Product_Video_Description_Widget() );
    $widgets_manager->register( new \Top_List_Section_Widget() );
    $widgets_manager->register( new \Bottom_List_Section_Widget() );
    $widgets_manager->register( new \IC_Widget() );
    $widgets_manager->register( new \Nutrisslim_Short_Description_Widget() );
    $widgets_manager->register( new \Foot_Widget() );
    $widgets_manager->register( new \Tag_List_Section_Widget() );
    $widgets_manager->register( new \Gift_Widget() );
    $widgets_manager->register( new \Nutrisslim_Reviews_Widget() );
    $widgets_manager->register( new \Nutrisslim_Main_Review_Widget() );
    $widgets_manager->register( new \Product_Swiper_Widget() );
    $widgets_manager->register( new \Popular_Posts_Widget() );
    $widgets_manager->register( new \Tagline_Slider_Widget() );
    $widgets_manager->register( new \Nutrisslim_Landing_Reviews_Widget() );
    $widgets_manager->register( new \Nutrisslim_Landing_Content_Widget() );
    $widgets_manager->register( new \Sticky_Add_To_Cart_Widget() );
	$widgets_manager->register( new \Nutrisslim_Landing_Quantity_Selector() );
    $widgets_manager->register( new \Simple_Order_Button_Widget() );
    $widgets_manager->register( new \Elementor_Trusted_Reviews_Widget() );
    $widgets_manager->register( new \Nutrisslim_Custom_Banner_Widget() );

    // Landing page widgets
}

add_action( 'elementor/widgets/register', 'nutrisslim_register_widgets' );

function add_elementor_support_for_landing_pages($post_types) {
    if (!array_key_exists('landing_page', $post_types)) {
        $post_types['landing_page'] = 'Landing Pages'; // Ensure 'landing_page' is correctly keyed and labeled
    }
    return $post_types;
}

add_filter('elementor/widgets/wordpress/widget_areas/default_args', 'add_elementor_support_for_landing_pages');