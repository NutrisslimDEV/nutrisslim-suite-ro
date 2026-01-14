<?php
/*
function checkoutUpsell() {
    if (is_admin()) {
        return;
    }
    echo '<div id="checkoutOfferHolder">';    

    echo '</div>'; // checkoutOfferHolder
    
    return $ret;
}
add_shortcode('checkout_upsell', 'checkoutUpsell');
*/

function checkoutUpsell() {
    if (is_admin()) {
        return '';
    }

    $ret = '<div id="checkoutOfferHolder"></div>'; // Properly initialize $ret with the HTML content

    return $ret;
}
add_shortcode('checkout_upsell', 'checkoutUpsell');

