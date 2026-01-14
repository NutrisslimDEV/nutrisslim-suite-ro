<?php
function cartUpsell() {

    $items = get_field('cart_offer', 'option');

    echo '<div id="cartOffer" class="cartOffer">';

    echo '</div>'; // cartOffer
    
}
add_shortcode('cart_upsell', 'cartUpsell');