<?php
// $company_name = get_option('woocommerce_company_name');
// $support_email = get_option('woocommerce_support_email');
// $support_phone = get_option('woocommerce_support_phone');
function company_name_shortcode($atts) {
    return get_option('woocommerce_company_name');
}
add_shortcode('company_name', 'company_name_shortcode');

function support_email_shortcode($atts) {
    // echo get_option('woocommerce_support_email');
    return '<a href="mailto:' . get_option('woocommerce_support_email') . '">' . get_option('woocommerce_support_email') . '</a>';
}
add_shortcode('support_email', 'support_email_shortcode');

function support_phone_shortcode($atts) {
    return '<a style="white-space:nowrap" href="tel:' . get_option('woocommerce_support_phone') . '">' . get_option('woocommerce_support_phone') . '</a>';
}
add_shortcode('support_phone', 'support_phone_shortcode');

function plain_phone_shortcode($atts) {
    return get_option('woocommerce_support_phone');
}
add_shortcode('plain_phone', 'plain_phone_shortcode');
