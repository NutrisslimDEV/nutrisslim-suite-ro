<?php
/*
Template Name: Iframe Checkout Template
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

wp_head(); // Optionally include the header if needed for styles/scripts

?>

<style>
/*! elementor-pro - v3.23.0 - 05-08-2024 */
body.woocommerce #content div.product .elementor-widget-woocommerce-product-images div.images,
body.woocommerce-page #content div.product .elementor-widget-woocommerce-product-images div.images,
body.woocommerce-page div.product .elementor-widget-woocommerce-product-images div.images,
body.woocommerce div.product .elementor-widget-woocommerce-product-images div.images {
    float: none;
    width: 100%;
    padding: 0
}

body.rtl.woocommerce #content div.product .elementor-widget-woocommerce-product-images div.images,
body.rtl.woocommerce-page #content div.product .elementor-widget-woocommerce-product-images div.images,
body.rtl.woocommerce-page div.product .elementor-widget-woocommerce-product-images div.images,
body.rtl.woocommerce div.product .elementor-widget-woocommerce-product-images div.images {
    float: none;
    padding: 0
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart) form.cart {
    margin: 0
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart) form.cart.variations_form .woocommerce-variation-add-to-cart,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart) form.cart:not(.grouped_form):not(.variations_form) {
    display: flex;
    flex-wrap: nowrap
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart) form.cart .button:where(:not(:first-child)),
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart) form.cart button:where(:not(:first-child)) {
    margin-top: 0;
    margin-left: var(--button-spacing, 10px)
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart) .e-loop-add-to-cart-form-container {
    display: flex;
    flex-wrap: wrap;
    gap: var(--view-cart-spacing, 10px)
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart) .e-loop-add-to-cart-form-container>* {
    display: flex;
    flex-basis: auto;
    margin: 0
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart) .quantity {
    vertical-align: middle
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart) .quantity .qty {
    vertical-align: top;
    margin-right: 0
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart) .quantity input {
    height: 100%
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--layout-auto form.cart.variations_form .woocommerce-variation-add-to-cart,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--layout-auto form.cart:not(.grouped_form):not(.variations_form),
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--layout-stacked form.cart.variations_form .woocommerce-variation-add-to-cart,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--layout-stacked form.cart:not(.grouped_form):not(.variations_form) {
    display: block
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--layout-auto .e-atc-qty-button-holder,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--layout-stacked .e-atc-qty-button-holder {
    display: flex
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--layout-stacked .e-loop-add-to-cart-form-container {
    flex-wrap: wrap
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--layout-stacked .e-loop-add-to-cart-form-container>* {
    flex-basis: 100%
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--layout-stacked .e-atc-qty-button-holder {
    flex-wrap: wrap
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--layout-stacked .e-atc-qty-button-holder>* {
    flex-basis: 100%
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--layout-stacked .e-atc-qty-button-holder .button,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--layout-stacked .e-atc-qty-button-holder button {
    flex-basis: auto
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--layout-stacked .e-atc-qty-button-holder .button:where(:not(:first-child)),
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--layout-stacked .e-atc-qty-button-holder button:where(:not(:first-child)) {
    margin-left: 0;
    margin-top: var(--button-spacing, 10px)
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--layout-auto .e-atc-qty-button-holder {
    flex-wrap: nowrap
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--layout-auto .e-atc-qty-button-holder .quantity {
    margin-right: 0
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--layout-auto .e-atc-qty-button-holder .button,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--layout-auto .e-atc-qty-button-holder button {
    vertical-align: middle
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-left:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) {
    text-align: left
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-left .e-loop-add-to-cart-form-container,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-left:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart.variations_form .woocommerce-variation-add-to-cart,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-left:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart:not(.grouped_form):not(.variations_form),
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-left[class*="--layout-auto"] .e-atc-qty-button-holder,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-left[class*="--layout-stacked"] .e-atc-qty-button-holder {
    justify-content: flex-start;
    text-align: left
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-right:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) {
    text-align: right
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-right .e-loop-add-to-cart-form-container,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-right:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart.variations_form .woocommerce-variation-add-to-cart,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-right:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart:not(.grouped_form):not(.variations_form),
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-right[class*="--layout-auto"] .e-atc-qty-button-holder,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-right[class*="--layout-stacked"] .e-atc-qty-button-holder {
    justify-content: flex-end;
    text-align: right
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-center:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) {
    text-align: center
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-center .e-loop-add-to-cart-form-container,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-center:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart.variations_form .woocommerce-variation-add-to-cart,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-center:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart:not(.grouped_form):not(.variations_form),
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-center[class*="--layout-auto"] .e-atc-qty-button-holder,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-center[class*="--layout-stacked"] .e-atc-qty-button-holder {
    justify-content: center;
    text-align: center
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-center form.cart div.quantity,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-left form.cart div.quantity,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-right form.cart div.quantity {
    margin-right: 0
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-center form.cart .button,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-center form.cart button,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-left form.cart .button,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-left form.cart button,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-right form.cart .button,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-right form.cart button {
    flex-basis: auto
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-justify:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) .elementor-button {
    width: 100%
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-justify .e-loop-add-to-cart-form-container>* {
    flex-basis: 100%;
    justify-content: center
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-justify .e-loop-add-to-cart-form-container a.added_to_cart {
    flex-basis: auto
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-justify form.cart div.quantity {
    margin-right: auto
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-justify form.cart .button,
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart--align-justify form.cart button {
    flex-basis: 100%
}

@media (min-width: -1) {
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-left:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) {
        text-align: left
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-left .e-loop-add-to-cart-form-container,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-left:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart.variations_form .woocommerce-variation-add-to-cart,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-left:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart:not(.grouped_form):not(.variations_form),
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-left[class*="--layout-auto"] .e-atc-qty-button-holder,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-left[class*="--layout-stacked"] .e-atc-qty-button-holder {
        justify-content: flex-start;
        text-align: left
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-right:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) {
        text-align: right
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-right .e-loop-add-to-cart-form-container,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-right:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart.variations_form .woocommerce-variation-add-to-cart,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-right:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart:not(.grouped_form):not(.variations_form),
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-right[class*="--layout-auto"] .e-atc-qty-button-holder,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-right[class*="--layout-stacked"] .e-atc-qty-button-holder {
        justify-content: flex-end;
        text-align: right
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-center:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) {
        text-align: center
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-center .e-loop-add-to-cart-form-container,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-center:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart.variations_form .woocommerce-variation-add-to-cart,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-center:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart:not(.grouped_form):not(.variations_form),
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-center[class*="--layout-auto"] .e-atc-qty-button-holder,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-center[class*="--layout-stacked"] .e-atc-qty-button-holder {
        justify-content: center;
        text-align: center
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-center form.cart div.quantity,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-left form.cart div.quantity,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-right form.cart div.quantity {
        margin-right: 0
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-center form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-center form.cart button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-left form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-left form.cart button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-right form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-right form.cart button {
        flex-basis: auto
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-justify:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) .elementor-button {
        width: 100%
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-justify .e-loop-add-to-cart-form-container>* {
        flex-basis: 100%;
        justify-content: center
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-justify .e-loop-add-to-cart-form-container a.added_to_cart {
        flex-basis: auto
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-justify form.cart div.quantity {
        margin-right: auto
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-justify form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-widescreen--align-justify form.cart button {
        flex-basis: 100%
    }
}

@media (max-width: -1) {
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-left:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) {
        text-align: left
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-left .e-loop-add-to-cart-form-container,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-left:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart.variations_form .woocommerce-variation-add-to-cart,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-left:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart:not(.grouped_form):not(.variations_form),
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-left[class*="--layout-auto"] .e-atc-qty-button-holder,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-left[class*="--layout-stacked"] .e-atc-qty-button-holder {
        justify-content: flex-start;
        text-align: left
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-right:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) {
        text-align: right
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-right .e-loop-add-to-cart-form-container,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-right:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart.variations_form .woocommerce-variation-add-to-cart,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-right:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart:not(.grouped_form):not(.variations_form),
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-right[class*="--layout-auto"] .e-atc-qty-button-holder,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-right[class*="--layout-stacked"] .e-atc-qty-button-holder {
        justify-content: flex-end;
        text-align: right
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-center:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) {
        text-align: center
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-center .e-loop-add-to-cart-form-container,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-center:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart.variations_form .woocommerce-variation-add-to-cart,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-center:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart:not(.grouped_form):not(.variations_form),
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-center[class*="--layout-auto"] .e-atc-qty-button-holder,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-center[class*="--layout-stacked"] .e-atc-qty-button-holder {
        justify-content: center;
        text-align: center
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-center form.cart div.quantity,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-left form.cart div.quantity,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-right form.cart div.quantity {
        margin-right: 0
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-center form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-center form.cart button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-left form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-left form.cart button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-right form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-right form.cart button {
        flex-basis: auto
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-justify:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) .elementor-button {
        width: 100%
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-justify .e-loop-add-to-cart-form-container>* {
        flex-basis: 100%;
        justify-content: center
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-justify .e-loop-add-to-cart-form-container a.added_to_cart {
        flex-basis: auto
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-justify form.cart div.quantity {
        margin-right: auto
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-justify form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-laptop--align-justify form.cart button {
        flex-basis: 100%
    }
}

@media (max-width: -1) {
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-left:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) {
        text-align: left
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-left .e-loop-add-to-cart-form-container,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-left:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart.variations_form .woocommerce-variation-add-to-cart,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-left:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart:not(.grouped_form):not(.variations_form),
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-left[class*="--layout-auto"] .e-atc-qty-button-holder,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-left[class*="--layout-stacked"] .e-atc-qty-button-holder {
        justify-content: flex-start;
        text-align: left
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-right:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) {
        text-align: right
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-right .e-loop-add-to-cart-form-container,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-right:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart.variations_form .woocommerce-variation-add-to-cart,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-right:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart:not(.grouped_form):not(.variations_form),
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-right[class*="--layout-auto"] .e-atc-qty-button-holder,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-right[class*="--layout-stacked"] .e-atc-qty-button-holder {
        justify-content: flex-end;
        text-align: right
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-center:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) {
        text-align: center
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-center .e-loop-add-to-cart-form-container,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-center:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart.variations_form .woocommerce-variation-add-to-cart,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-center:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart:not(.grouped_form):not(.variations_form),
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-center[class*="--layout-auto"] .e-atc-qty-button-holder,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-center[class*="--layout-stacked"] .e-atc-qty-button-holder {
        justify-content: center;
        text-align: center
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-center form.cart div.quantity,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-left form.cart div.quantity,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-right form.cart div.quantity {
        margin-right: 0
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-center form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-center form.cart button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-left form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-left form.cart button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-right form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-right form.cart button {
        flex-basis: auto
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-justify:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) .elementor-button {
        width: 100%
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-justify .e-loop-add-to-cart-form-container>* {
        flex-basis: 100%;
        justify-content: center
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-justify .e-loop-add-to-cart-form-container a.added_to_cart {
        flex-basis: auto
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-justify form.cart div.quantity {
        margin-right: auto
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-justify form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet_extra--align-justify form.cart button {
        flex-basis: 100%
    }
}

@media (max-width: 1024px) {
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-left:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) {
        text-align: left
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-left .e-loop-add-to-cart-form-container,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-left:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart.variations_form .woocommerce-variation-add-to-cart,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-left:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart:not(.grouped_form):not(.variations_form),
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-left[class*="--layout-auto"] .e-atc-qty-button-holder,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-left[class*="--layout-stacked"] .e-atc-qty-button-holder {
        justify-content: flex-start;
        text-align: left
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-right:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) {
        text-align: right
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-right .e-loop-add-to-cart-form-container,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-right:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart.variations_form .woocommerce-variation-add-to-cart,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-right:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart:not(.grouped_form):not(.variations_form),
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-right[class*="--layout-auto"] .e-atc-qty-button-holder,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-right[class*="--layout-stacked"] .e-atc-qty-button-holder {
        justify-content: flex-end;
        text-align: right
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-center:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) {
        text-align: center
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-center .e-loop-add-to-cart-form-container,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-center:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart.variations_form .woocommerce-variation-add-to-cart,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-center:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart:not(.grouped_form):not(.variations_form),
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-center[class*="--layout-auto"] .e-atc-qty-button-holder,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-center[class*="--layout-stacked"] .e-atc-qty-button-holder {
        justify-content: center;
        text-align: center
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-center form.cart div.quantity,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-left form.cart div.quantity,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-right form.cart div.quantity {
        margin-right: 0
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-center form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-center form.cart button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-left form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-left form.cart button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-right form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-right form.cart button {
        flex-basis: auto
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-justify:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) .elementor-button {
        width: 100%
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-justify .e-loop-add-to-cart-form-container>* {
        flex-basis: 100%;
        justify-content: center
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-justify .e-loop-add-to-cart-form-container a.added_to_cart {
        flex-basis: auto
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-justify form.cart div.quantity {
        margin-right: auto
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-justify form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-tablet--align-justify form.cart button {
        flex-basis: 100%
    }
}

@media (max-width: -1) {
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-left:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) {
        text-align: left
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-left .e-loop-add-to-cart-form-container,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-left:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart.variations_form .woocommerce-variation-add-to-cart,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-left:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart:not(.grouped_form):not(.variations_form),
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-left[class*="--layout-auto"] .e-atc-qty-button-holder,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-left[class*="--layout-stacked"] .e-atc-qty-button-holder {
        justify-content: flex-start;
        text-align: left
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-right:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) {
        text-align: right
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-right .e-loop-add-to-cart-form-container,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-right:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart.variations_form .woocommerce-variation-add-to-cart,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-right:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart:not(.grouped_form):not(.variations_form),
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-right[class*="--layout-auto"] .e-atc-qty-button-holder,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-right[class*="--layout-stacked"] .e-atc-qty-button-holder {
        justify-content: flex-end;
        text-align: right
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-center:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) {
        text-align: center
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-center .e-loop-add-to-cart-form-container,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-center:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart.variations_form .woocommerce-variation-add-to-cart,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-center:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart:not(.grouped_form):not(.variations_form),
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-center[class*="--layout-auto"] .e-atc-qty-button-holder,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-center[class*="--layout-stacked"] .e-atc-qty-button-holder {
        justify-content: center;
        text-align: center
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-center form.cart div.quantity,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-left form.cart div.quantity,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-right form.cart div.quantity {
        margin-right: 0
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-center form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-center form.cart button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-left form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-left form.cart button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-right form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-right form.cart button {
        flex-basis: auto
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-justify:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) .elementor-button {
        width: 100%
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-justify .e-loop-add-to-cart-form-container>* {
        flex-basis: 100%;
        justify-content: center
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-justify .e-loop-add-to-cart-form-container a.added_to_cart {
        flex-basis: auto
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-justify form.cart div.quantity {
        margin-right: auto
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-justify form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile_extra--align-justify form.cart button {
        flex-basis: 100%
    }
}

@media (max-width: 767px) {
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-left:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) {
        text-align: left
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-left .e-loop-add-to-cart-form-container,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-left:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart.variations_form .woocommerce-variation-add-to-cart,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-left:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart:not(.grouped_form):not(.variations_form),
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-left[class*="--layout-auto"] .e-atc-qty-button-holder,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-left[class*="--layout-stacked"] .e-atc-qty-button-holder {
        justify-content: flex-start;
        text-align: left
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-right:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) {
        text-align: right
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-right .e-loop-add-to-cart-form-container,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-right:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart.variations_form .woocommerce-variation-add-to-cart,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-right:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart:not(.grouped_form):not(.variations_form),
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-right[class*="--layout-auto"] .e-atc-qty-button-holder,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-right[class*="--layout-stacked"] .e-atc-qty-button-holder {
        justify-content: flex-end;
        text-align: right
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-center:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) {
        text-align: center
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-center .e-loop-add-to-cart-form-container,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-center:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart.variations_form .woocommerce-variation-add-to-cart,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-center:not([class*="--layout-stacked"]):not([class*="--layout-auto"]) form.cart:not(.grouped_form):not(.variations_form),
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-center[class*="--layout-auto"] .e-atc-qty-button-holder,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-center[class*="--layout-stacked"] .e-atc-qty-button-holder {
        justify-content: center;
        text-align: center
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-center form.cart div.quantity,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-left form.cart div.quantity,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-right form.cart div.quantity {
        margin-right: 0
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-center form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-center form.cart button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-left form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-left form.cart button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-right form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-right form.cart button {
        flex-basis: auto
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-justify:not([class*="--layout-stacked"]):not([class*="--layout-auto"]):not([class*=-product-add-to-cart]) .elementor-button {
        width: 100%
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-justify .e-loop-add-to-cart-form-container>* {
        flex-basis: 100%;
        justify-content: center
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-justify .e-loop-add-to-cart-form-container a.added_to_cart {
        flex-basis: auto
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-justify form.cart div.quantity {
        margin-right: auto
    }

    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-justify form.cart .button,
    :is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart, .elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-add-to-cart-mobile--align-justify form.cart button {
        flex-basis: 100%
    }
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart):not(.e-add-to-cart--show-quantity-yes) form.cart .quantity {
    display: none !important
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart):not(.e-add-to-cart--show-quantity-yes) form.cart .button:where(:not(:first-child)),
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart):not(.e-add-to-cart--show-quantity-yes) form.cart button:where(:not(:first-child)) {
    margin-left: 0
}

:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart):not(.e-add-to-cart--show-quantity-yes)[class*="--layout-stacked"] form.cart .button:where(:not(:first-child)),
:is(.elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .elementor-widget-woocommerce-product-add-to-cart):not(.e-add-to-cart--show-quantity-yes)[class*="--layout-stacked"] form.cart button:where(:not(:first-child)) {
    margin-top: 0
}

:is(.e-loop-item .elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .e-loop-item .elementor-widget-woocommerce-product-add-to-cart) form.cart input.qty.disabled {
    pointer-events: none
}

:is(.e-loop-item .elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .e-loop-item .elementor-widget-woocommerce-product-add-to-cart) form.cart .button {
    text-align: center
}

:is(.e-loop-item .elementor-widget-woocommerce-product-add-to-cart, .woocommerce div.product .e-loop-item .elementor-widget-woocommerce-product-add-to-cart) .added_to_cart {
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center
}

:is(.elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart) .quantity {
    vertical-align: middle
}

:is(.elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart) .quantity .qty {
    vertical-align: top;
    margin-right: 0;
    width: 3.631em;
    text-align: center
}

:is(.elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-button-info button.button.alt.elementor-button {
    background-color: #5bc0de
}

:is(.elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-button-success button.button.alt.elementor-button {
    background-color: #5cb85c
}

:is(.elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-button-warning button.button.alt.elementor-button {
    background-color: #f0ad4e
}

:is(.elementor-widget-wc-add-to-cart, .woocommerce div.product .elementor-widget-wc-add-to-cart).elementor-button-danger button.button.alt.elementor-button {
    background-color: #d9534f
}

body.e-checkout-layout-one-column .e-checkout__container {
    grid-template-columns: auto
}

body ::-moz-placeholder {
    color: var(--forms-fields-normal-color, inherit);
    font-family: inherit;
    opacity: .6
}

body ::placeholder {
    color: var(--forms-fields-normal-color, inherit);
    font-family: inherit;
    opacity: .6
}

body table tbody tr:hover>td,
body table tbody tr:hover>th {
    background-color: transparent
}

body .select2-container--default .select2-selection--single {
    color: var(--forms-fields-normal-color, #69727d);
    background-color: #f9fafa;
    border-radius: var(--forms-fields-border-radius, 0);
    border: none;
    height: 45px
}

body .select2-container--default .select2-selection--single:focus {
    color: var(--forms-fields-focus-color, #69727d);
    background-color: #f9fafa;
    border-color: initial;
    transition-duration: var(--forms-fields-focus-transition-duration, .3s)
}

body .select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: var(--forms-fields-normal-color, #69727d)
}

body .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: var(--forms-fields-normal-color, #69727d);
    line-height: 45px;
    padding-left: 1rem;
    padding-right: 1rem
}

body .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 45px
}

body .select2-container--open .select2-dropdown--below {
    background-color: #f9fafa
}

body .e-description {
    color: var(--sections-descriptions-color, #69727d);
    padding-bottom: var(--sections-descriptions-spacing, 0);
    font-size: 14px;
    font-weight: 400
}

body .e-woocommerce-login-section {
    margin-bottom: 24px
}

body .e-woocommerce-login-section .e-checkout-secondary-title {
    text-align: var(--login-title-alignment, left)
}

body .e-woocommerce-login-nudge {
    margin-top: var(--sections-secondary-title-spacing, 24px);
    margin-bottom: 15px
}

body .e-coupon-anchor {
    margin-top: var(--sections-secondary-title-spacing, 24px)
}

body .e-coupon-box {
    margin-top: 24px
}

body .e-coupon-anchor-description {
    color: var(--forms-labels-color, #69727d);
    margin-bottom: var(--forms-label-spacing, 3px)
}

body .e-login-wrap {
    display: flex;
    align-items: center
}

body .e-login-wrap-start {
    flex: 75%
}

body .e-login-wrap-end {
    flex: 20%;
    text-align: right
}

@media (max-width: 1024px) {
    body .e-login-wrap {
        display: block
    }

    body .e-login-wrap-end {
        text-align: var(--login-button-alignment, left);
        margin-top: 15px
    }

    body .e-login-wrap-end label.e-login-label {
        display: none
    }
}

body .e-login-actions-wrap {
    display: flex;
    justify-content: space-between;
    margin-top: 6px
}

body .e-login-actions-wrap-end .lost_password {
    margin-bottom: 0;
    font-size: 12px
}

@media (max-width: 1024px) {
    body .e-login-actions-wrap-end .lost_password {
        font-size: 11px
    }
}

body .e-apply-coupon {
    width: 90%
}

@media (max-width: 1024px) {
    body .e-apply-coupon {
        width: var(--coupon-button-width, auto)
    }
}

body .e-checkout__container {
    display: grid;
    flex-wrap: wrap;
    grid-template-columns: 56% auto;
    align-items: stretch;
    grid-column-gap: var(--sections-margin, 24px);
    grid-row-gap: var(--sections-margin, 24px)
}

@media (max-width: 1024px) {
    body .e-checkout__container {
        grid-template-columns: repeat(1, 1fr)
    }
}

body .e-checkout-secondary-title {
    color: var(--sections-secondary-title-color, #69727d);
    margin-bottom: 0
}

body .e-woocommerce-coupon-nudge {
    text-align: var(--coupon-title-alignment, left)
}

body #ship-to-different-address {
    margin-top: 13px;
    padding-left: var(--shipping-heading-padding-start, 30px)
}

body #ship-to-different-address span {
    font-weight: 400
}

body a {
    color: var(--links-normal-color, #5bc0de)
}

body a:hover {
    color: var(--links-hover-color, #5bc0de)
}

body .woocommerce #customer_details .form-row,
body .woocommerce .e-coupon-box .form-row,
body .woocommerce .e-woocommerce-login-anchor .form-row {
    padding-left: var(--forms-columns-gap-padding, 0);
    padding-right: var(--forms-columns-gap-padding, 0);
    margin-left: var(--forms-columns-gap-margin, 0);
    margin-right: var(--forms-columns-gap-margin, 0)
}

body .woocommerce #customer_details .form-row label,
body .woocommerce .e-coupon-box .form-row label,
body .woocommerce .e-woocommerce-login-anchor .form-row label {
    color: var(--forms-labels-color, #69727d);
    margin-bottom: var(--forms-label-spacing, 3px)
}

body .woocommerce #customer_details .form-row .input-text,
body .woocommerce #customer_details .form-row select,
body .woocommerce #customer_details .form-row textarea,
body .woocommerce .e-coupon-box .form-row .input-text,
body .woocommerce .e-coupon-box .form-row select,
body .woocommerce .e-coupon-box .form-row textarea,
body .woocommerce .e-woocommerce-login-anchor .form-row .input-text,
body .woocommerce .e-woocommerce-login-anchor .form-row select,
body .woocommerce .e-woocommerce-login-anchor .form-row textarea {
    color: var(--forms-fields-normal-color, #69727d);
    background-color: #f9fafa;
    border-radius: var(--forms-fields-border-radius, 0);
    padding: var(--forms-fields-padding, 16px);
    font-size: 14px;
    border: none;
    font-weight: 400
}

body .woocommerce #customer_details .form-row .input-text:focus,
body .woocommerce #customer_details .form-row select:focus,
body .woocommerce #customer_details .form-row textarea:focus,
body .woocommerce .e-coupon-box .form-row .input-text:focus,
body .woocommerce .e-coupon-box .form-row select:focus,
body .woocommerce .e-coupon-box .form-row textarea:focus,
body .woocommerce .e-woocommerce-login-anchor .form-row .input-text:focus,
body .woocommerce .e-woocommerce-login-anchor .form-row select:focus,
body .woocommerce .e-woocommerce-login-anchor .form-row textarea:focus {
    color: var(--forms-fields-focus-color, #69727d);
    background-color: #f9fafa;
    border-color: #69727d;
    transition-duration: var(--forms-fields-focus-transition-duration, .3s)
}

body .woocommerce #customer_details #billing_address_1_field,
body .woocommerce .e-coupon-box #billing_address_1_field,
body .woocommerce .e-woocommerce-login-anchor #billing_address_1_field {
    margin-bottom: 5px
}

body .woocommerce .create-account,
body .woocommerce .e-coupon-box .form-row {
    margin-bottom: 0 !important
}

body .woocommerce #shipping_method li input,
body .woocommerce .input-radio {
    vertical-align: middle
}

body .woocommerce-form__input-checkbox {
    vertical-align: middle;
    margin: 0 5px 0 0
}

body .woocommerce-form__label-for-checkbox span {
    position: relative;
    top: 2px;
    color: var(--sections-checkboxes-color, #69727d)
}

body .woocommerce #shipping_method li label,
body .woocommerce .wc_payment_method label {
    color: var(--sections-radio-buttons-color, #69727d)
}

body .woocommerce .wc_payment_method label {
    display: inline
}

body .woocommerce button.woocommerce-button {
    background-color: var(--e-a-bg-default);
    color: var(--forms-buttons-normal-text-color, #6f6f6f);
    border-radius: var(--forms-buttons-border-radius, 3px);
    padding: 1rem;
    border: 2px var(--forms-buttons-border-type, solid) var(--forms-buttons-border-color, #5bc0de)
}

body .woocommerce button.woocommerce-button:hover {
    color: var(--forms-buttons-hover-text-color, #6f6f6f);
    transition-duration: var(--forms-buttons-hover-transition-duration, .3s)
}

body .woocommerce #coupon_code {
    margin-right: 1%
}

@media (max-width: 1024px) {
    body .woocommerce #coupon_code {
        width: 100%;
        margin-right: 0;
        margin-bottom: 15px
    }
}

body .woocommerce-info {
    border-top-color: transparent;
    background-color: transparent;
    padding: 0
}

body .woocommerce-privacy-policy-text p {
    font-weight: 400;
    font-size: 12px
}

body .woocommerce-form-login-toggle .woocommerce-info {
    font-weight: 400;
    margin-bottom: 0
}

body .woocommerce #customer_details .col-1,
body .woocommerce .e-checkout__order_review,
body .woocommerce .e-coupon-box,
body .woocommerce .e-woocommerce-login-section,
body .woocommerce .shipping_address,
body .woocommerce .woocommerce-additional-fields,
body .woocommerce .woocommerce-checkout #payment {
    background: var(--sections-background-color, #fff);
    border-radius: var(--sections-border-radius, 3px);
    padding: var(--sections-padding, 16px 30px);
    margin: var(--sections-margin, 0 0 24px 0);
    border: 1px var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    display: block
}

body .woocommerce .woocommerce-additional-fields {
    display: var(--additional-information-display, none)
}

@media (min-width: 1024px) {
    body .woocommerce .woocommerce-additional-fields {
        margin: var(--sections-margin, 0)
    }
}

body .woocommerce .e-checkout-message,
body .woocommerce .woocommerce-checkout #payment .payment_box,
body .woocommerce .woocommerce-privacy-policy-text {
    color: var(--sections-messages-color, #69727d);
    font-weight: 400
}

body .woocommerce .woocommerce-privacy-policy-text p {
    margin-top: 25px
}

body .woocommerce #customer_details .col2-set .col-1 {
    margin-bottom: 0
}

body .woocommerce #customer_details .col2-set .col-2 {
    padding-top: 15px
}

body .woocommerce #order_review_heading {
    text-align: var(--order-review-title-alignment, left)
}

body .woocommerce .shop_table {
    margin-bottom: 0;
    border: 0;
    font-size: 14px
}

body .woocommerce .shop_table thead {
    background-color: transparent
}

body .woocommerce .shop_table thead tr th {
    padding-top: 0
}

body .woocommerce .shop_table tbody td {
    color: #000
}

body .woocommerce .shop_table tbody td .product-quantity {
    font-weight: 400
}

body .woocommerce .shop_table tfoot td,
body .woocommerce .shop_table tfoot th {
    color: #69727d
}

body .woocommerce .shop_table td,
body .woocommerce .shop_table th,
body .woocommerce .shop_table tr {
    border: 0;
    padding-left: 0;
    padding-bottom: 15px;
    padding-top: 15px
}

body .woocommerce .shop_table .order-total td,
body .woocommerce .shop_table .order-total th,
body .woocommerce .shop_table .order-total tr {
    padding-bottom: 0
}

body .woocommerce .shop_table tr:nth-child(odd)>td,
body .woocommerce .shop_table tr:nth-child(odd)>th {
    background-color: transparent
}

body .woocommerce .woocommerce-checkout-review-order-table .cart_item td {
    font-weight: 400;
    color: var(--order-summary-items-color, #000);
    border-bottom: var(--order-summary-items-divider-weight, 0) solid var(--order-summary-items-divider-color, #69727d)
}

body .woocommerce .woocommerce-checkout-review-order-table .cart_item td.product-name {
    padding-right: 40px;
    max-width: 150px
}

body .woocommerce .woocommerce-checkout-review-order-table .cart_item td.product-total {
    vertical-align: top
}

body .woocommerce .woocommerce-checkout-review-order-table td,
body .woocommerce .woocommerce-checkout-review-order-table th {
    padding-top: var(--order-summary-rows-gap-top, 15px);
    padding-bottom: var(--order-summary-rows-gap-bottom, 15px)
}

body .woocommerce .woocommerce-checkout-review-order-table tfoot td,
body .woocommerce .woocommerce-checkout-review-order-table tfoot th,
body .woocommerce .woocommerce-checkout-review-order-table thead th {
    color: var(--order-summary-totals-color, #69727d);
    vertical-align: top
}

body .woocommerce .woocommerce-checkout-review-order-table .order-total td,
body .woocommerce .woocommerce-checkout-review-order-table .order-total th {
    border-top: var(--order-summary-totals-divider-weight, 0) solid var(--order-summary-totals-divider-color, #69727d)
}

body .woocommerce-shipping-totals td {
    max-width: 70px
}

body .woocommerce h3 {
    font-size: 14px;
    font-weight: 700;
    margin-top: 0;
    margin-bottom: var(--sections-title-spacing, 30px);
}

body .woocommerce-checkout .form-row>span {
    font-weight: 400;
    font-size: 14px;
    margin-bottom: 3px;
    color: #69727d
}

body .woocommerce-checkout .form-row-first,
body .woocommerce-checkout .form-row-last {
    width: 48%
}

body .woocommerce-checkout .form-row .input-checkbox {
    vertical-align: middle;
    margin: 0 5px 0 0
}

body .woocommerce-checkout .woocommerce-billing-fields h3 {
    text-align: var(--billing-details-title-alignment, left)
}

body .woocommerce-checkout .woocommerce-account-fields .form-row,
body .woocommerce-checkout .woocommerce-billing-fields .form-row,
body .woocommerce-checkout .woocommerce-shipping-fields .form-row {
    margin-bottom: var(--forms-rows-gap, 5px)
}

body .woocommerce-checkout .woocommerce-account-fields .form-row:last-child,
body .woocommerce-checkout .woocommerce-billing-fields .form-row:last-child,
body .woocommerce-checkout .woocommerce-shipping-fields .form-row:last-child {
    margin-bottom: 15px
}

body .woocommerce-checkout.login {
    margin-top: -8px;
    z-index: 999;
    background: #fff;
    border-top-width: 0;
    position: relative;
    margin-bottom: 0;
    color: #69727d
}

@media (max-width: 1024px) {

    body .woocommerce-checkout .form-row-first,
    body .woocommerce-checkout .form-row-last {
        width: 100%
    }
}

body .woocommerce-form-coupon-toggle {
    display: none
}

body .woocommerce-form-login__submit {
    width: 85%
}

@media (max-width: 1024px) {
    body .woocommerce-form-login__submit {
        width: var(--login-button-width, 35%)
    }
}

body .woocommerce-additional-fields h3 {
    text-align: var(--additional-fields-title-alignment, left)
}

body .woocommerce-shipping-fields .shipping_address {
    margin-bottom: var(--sections-margin, 20px)
}

body .woocommerce-checkout #payment {
    margin-top: 24px;
    padding: 15px 25px 25px
}

body .woocommerce-checkout #payment .payment_methods {
    border-bottom: none;
    padding: 0
}

body .woocommerce-checkout #payment .payment_methods .payment_box {
    background-color: #f9fafa
}

body .woocommerce-checkout #payment .payment_methods .payment_box:before {
    display: none
}

body .woocommerce-checkout #payment .payment_methods li {
    line-height: 21px
}

body .woocommerce-checkout #payment .payment_methods li label a {
    padding-left: 15px;
    font-size: 12px
}

@media (max-width: 1024px) {
    body .woocommerce-checkout #payment .payment_methods li label a {
        float: none;
        font-size: 11px;
        padding-left: 10px
    }
}

@media (max-width: 1024px) {
    body .woocommerce-checkout #payment .payment_methods li label img {
        width: 55px
    }
}

body .woocommerce-checkout #payment .place-order {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    padding: 0;
    margin-bottom: 0;
    align-items: var(--place-order-title-alignment, stretch)
}

body .woocommerce-checkout #payment #place_order {
    background-color: #5bc0de;
    width: var(--purchase-button-width, auto);
    float: none;
    color: var(--purchase-button-normal-text-color, #fff);
    min-height: auto;
    padding: var(--purchase-button-padding, 1em 1em);
    border-radius: var(--purchase-button-border-radius, 3px)
}

body .woocommerce-checkout #payment #place_order:hover {
    background-color: #5bc0de;
    color: var(--purchase-button-hover-text-color, #fff);
    border-color: var(--purchase-button-hover-border-color, #5bc0de);
    transition-duration: var(--purchase-button-hover-transition-duration, .3s)
}

body .woocommerce-checkout #payment .woocommerce-info:before {
    display: none
}

body .woocommerce-checkout .col2-set .col-1,
body .woocommerce-checkout .col2-set .col-2 {
    width: auto;
    float: none
}

body .woocommerce .coupon-container-grid {
    display: grid;
    grid-template-columns: auto auto;
    align-items: center
}

body .woocommerce .coupon-container-grid .coupon-col-2 {
    text-align: right
}

@media (max-width: 1024px) {
    body .woocommerce .coupon-container-grid {
        display: block
    }

    body .woocommerce .coupon-container-grid .coupon-col-2 {
        text-align: var(--coupon-button-alignment, left)
    }
}

body .woocommerce #account_password_field {
    margin-bottom: 10px
}

body .woocommerce .product-name .variation {
    color: var(--order-summary-variations-color, #000);
    font-size: 14px;
    font-style: normal;
    text-transform: none;
    letter-spacing: normal;
    text-decoration: none;
    line-height: 21px
}

.woocommerce div.product.elementor ul.tabs:before {
    position: static;
    content: none;
    width: auto;
    bottom: auto;
    left: auto;
    border-bottom: 0;
    z-index: auto
}

.woocommerce div.product.elementor ul.tabs {
    margin: 0
}

.woocommerce div.product.elementor ul.tabs li {
    padding: 0
}

.woocommerce div.product.elementor ul.tabs li a {
    padding: .8em 1.2em;
    line-height: 1
}

.woocommerce div.product.elementor ul.tabs li:after,
.woocommerce div.product.elementor ul.tabs li:before {
    border: 0;
    position: static;
    bottom: auto;
    width: auto;
    height: auto;
    content: none;
    box-sizing: border-box
}

.woocommerce div.product.elementor .woocommerce-tabs .panel {
    padding: 20px;
    border-radius: 0;
    border-width: 0;
    border-top: 1px solid #d3ced2;
    box-shadow: none;
    margin: -1px 0 0
}

.woocommerce .elementor-product-price-block-yes.elementor-widget-woocommerce-product-price .price del,
.woocommerce .elementor-product-price-block-yes.elementor-widget-woocommerce-product-price .price ins {
    display: block
}

.elementor-widget-woocommerce-product-meta .detail-container {
    position: relative
}

.elementor-widget-woocommerce-product-meta .detail-container:after {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%
}

.elementor-widget-woocommerce-product-meta .detail-label {
    font-weight: 700
}

.elementor-woo-meta--view-inline .product_meta {
    display: flex;
    flex-wrap: wrap
}

.elementor-woo-meta--view-inline .product_meta .detail-container:after {
    width: auto;
    left: auto;
    right: auto;
    position: absolute;
    height: 100%;
    top: 50%;
    transform: translateY(-50%);
    border-top: 0;
    border-bottom: 0;
    border-right: 0;
    border-left-width: 1px;
    border-style: solid;
    right: -8px
}

.elementor-woo-meta--view-table .product_meta {
    display: flex;
    flex-direction: column
}

.elementor-woo-meta--view-table .product_meta .detail-container {
    display: flex
}

.elementor-woo-meta--view-table .product_meta .detail-label {
    min-width: 108px
}

.elementor-woo-meta--view-stacked .product_meta .detail-container {
    display: block
}

.woocommerce .elementor-widget-woocommerce-product-rating .elementor-widget-container .woocommerce-product-rating {
    margin-bottom: 0;
    display: flex;
    align-items: center
}

.woocommerce .elementor-widget-woocommerce-product-rating .elementor-widget-container .star-rating {
    margin-top: 0
}

.elementor-product-rating--align-left .woocommerce-product-rating {
    justify-content: flex-start
}

.elementor-product-rating--align-right .woocommerce-product-rating {
    justify-content: flex-end
}

.elementor-product-rating--align-center .woocommerce-product-rating {
    justify-content: center
}

.elementor-product-rating--align-justify .woocommerce-product-rating .woocommerce-review-link {
    margin-left: auto
}

.elementor-products-grid ul.products.elementor-grid {
    display: grid;
    margin: 0;
    grid-column-gap: 20px;
    grid-row-gap: 40px
}

.elementor-products-grid ul.products.elementor-grid:after,
.elementor-products-grid ul.products.elementor-grid:before {
    content: none;
    display: none
}

.elementor-products-grid ul.products.elementor-grid li.product {
    width: auto;
    padding: 0;
    margin: 0;
    float: none;
    display: var(--button-align-display);
    flex-direction: var(--button-align-direction);
    justify-content: var(--button-align-justify)
}

.elementor-products-grid ul.products.elementor-grid li.product .onsale {
    padding: 0;
    display: none
}

.elementor-products-grid ul.products.elementor-grid li.product a.woocommerce-loop-product__link {
    display: block;
    position: relative
}

.elementor-products-grid:not(.show-heading-yes) .products>h2 {
    display: none
}

.elementor-products-grid nav.woocommerce-pagination {
    margin-top: 40px
}

.elementor-products-grid:not(.elementor-show-pagination-border-yes) nav.woocommerce-pagination ul {
    border: 0
}

.elementor-products-grid:not(.elementor-show-pagination-border-yes) nav.woocommerce-pagination ul li {
    border-right: 0;
    border-left: 0
}

.elementor-widget-woocommerce-products:not(.products-heading-show) .cross-sells>h2,
.elementor-widget-woocommerce-products:not(.products-heading-show) .related>h2,
.elementor-widget-woocommerce-products:not(.products-heading-show) .upsells>h2 {
    display: none
}

.elementor-widget-woocommerce-products.products-heading-show .cross-sells>h2,
.elementor-widget-woocommerce-products.products-heading-show .related>h2,
.elementor-widget-woocommerce-products.products-heading-show .upsells>h2 {
    display: block;
    text-align: var(--products-title-alignment, left);
    color: var(--products-title-color);
    margin-bottom: var(--products-title-spacing, 1rem)
}

.elementor-product-loop-item--align-left ul.products li.product .star-rating {
    margin-right: auto
}

.elementor-product-loop-item--align-right ul.products li.product .star-rating {
    margin-left: auto
}

.elementor-product-loop-item--align-center ul.products li.product .star-rating {
    margin-right: auto;
    margin-left: auto
}

.woocommerce .elementor-element.elementor-products-grid ul.products li.product,
.woocommerce div.product .elementor-element.elementor-products-grid .related.products ul.products li.product,
.woocommerce div.product .elementor-element.elementor-products-grid .upsells.products ul.products li.product {
    width: auto
}

@media (min-width: 1025px) {
    .elementor-widget-wc-archive-products .woocommerce.columns-2 ul.products {
        grid-template-columns: repeat(2, 1fr)
    }

    .elementor-widget-wc-archive-products .woocommerce.columns-3 ul.products {
        grid-template-columns: repeat(3, 1fr)
    }

    .elementor-widget-wc-archive-products .woocommerce.columns-4 ul.products {
        grid-template-columns: repeat(4, 1fr)
    }

    .elementor-widget-wc-archive-products .woocommerce.columns-5 ul.products {
        grid-template-columns: repeat(5, 1fr)
    }

    .elementor-widget-wc-archive-products .woocommerce.columns-6 ul.products {
        grid-template-columns: repeat(6, 1fr)
    }

    .elementor-widget-wc-archive-products .woocommerce.columns-7 ul.products {
        grid-template-columns: repeat(7, 1fr)
    }

    .elementor-widget-wc-archive-products .woocommerce.columns-8 ul.products {
        grid-template-columns: repeat(8, 1fr)
    }

    .elementor-widget-wc-archive-products .woocommerce.columns-9 ul.products {
        grid-template-columns: repeat(9, 1fr)
    }

    .elementor-widget-wc-archive-products .woocommerce.columns-10 ul.products {
        grid-template-columns: repeat(10, 1fr)
    }

    .elementor-widget-wc-archive-products .woocommerce.columns-11 ul.products {
        grid-template-columns: repeat(11, 1fr)
    }

    .elementor-widget-wc-archive-products .woocommerce.columns-12 ul.products {
        grid-template-columns: repeat(12, 1fr)
    }
}

@media (max-width: 1024px) {
    .elementor-widget-wc-archive-products .products {
        grid-template-columns: repeat(3, 1fr)
    }
}

@media (max-width: 767px) {
    .elementor-widget-wc-archive-products .products {
        grid-template-columns: repeat(2, 1fr)
    }
}

.elementor.product .woocommerce-product-gallery__trigger+.woocommerce-product-gallery__wrapper {
    overflow: hidden
}

.woocommerce .elementor-widget-woocommerce-product-images span.onsale {
    padding: 0
}

.elementor-menu-cart__wrapper {
    text-align: var(--main-alignment, left)
}

.elementor-menu-cart__toggle_wrapper {
    display: inline-block;
    position: relative
}

.elementor-menu-cart__toggle {
    display: inline-block
}

.elementor-menu-cart__toggle .elementor-button {
    background-color: var(--toggle-button-background-color, transparent);
    color: var(--toggle-button-text-color, #69727d);
    border: var(--toggle-button-border-width, 1px) var(--toggle-button-border-type, solid) var(--toggle-button-border-color, #69727d);
    border-radius: var(--toggle-button-border-radius, 0);
    display: inline-flex;
    flex-direction: row;
    align-items: center;
    gap: .3em;
    padding: var(--toggle-icon-padding, 12px 24px)
}

.elementor-menu-cart__toggle .elementor-button:hover {
    color: var(--toggle-button-hover-text-color, #69727d);
    background-color: var(--toggle-button-hover-background-color, transparent);
    border-color: var(--toggle-button-hover-border-color, #69727d)
}

.elementor-menu-cart__toggle .elementor-button:hover .elementor-button-icon {
    color: var(--toggle-button-icon-hover-color, #69727d)
}

.elementor-menu-cart__toggle .elementor-button:hover svg {
    fill: var(--toggle-button-icon-hover-color, #69727d)
}

.elementor-menu-cart__toggle .elementor-button svg {
    fill: var(--toggle-button-icon-color, #69727d)
}

.elementor-menu-cart__toggle .elementor-button-icon {
    position: relative;
    transition: color .1s
}

.elementor-menu-cart__toggle .e-toggle-cart-custom-icon,
.elementor-menu-cart__toggle .elementor-button-icon {
    color: var(--toggle-button-icon-color, #69727d);
    font-size: var(--toggle-icon-size, inherit)
}

.elementor-menu-cart__toggle .e-toggle-cart-custom-icon:hover {
    color: var(--toggle-button-icon-hover-color, #69727d)
}

.elementor-menu-cart__toggle .elementor-button-icon,
.elementor-menu-cart__toggle .elementor-button-text {
    flex-grow: unset;
    order: unset
}

.elementor-menu-cart--items-indicator-bubble .elementor-menu-cart__toggle .elementor-button-icon .elementor-button-icon-qty[data-counter] {
    display: block;
    position: absolute;
    min-width: 1.6em;
    height: 1.6em;
    line-height: 1.5em;
    top: -.7em;
    inset-inline-end: -.7em;
    border-radius: 100%;
    color: var(--items-indicator-text-color, #fff);
    background-color: var(--items-indicator-background-color, #d9534f);
    text-align: center;
    font-size: 10px
}

.elementor-menu-cart--items-indicator-plain .elementor-menu-cart__toggle .elementor-button-icon .elementor-button-icon-qty[data-counter] {
    display: inline-block;
    font-weight: 400
}

.elementor-menu-cart--items-indicator-none .elementor-menu-cart__toggle .elementor-button-icon .elementor-button-icon-qty[data-counter] {
    display: none
}

.elementor-menu-cart__container {
    transform: scale(1);
    overflow: hidden;
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100%;
    background-color: rgba(0, 0, 0, .25);
    transition: background-color .4s, transform 0s;
    text-align: left
}

.elementor-menu-cart__main {
    position: fixed;
    left: var(--side-cart-alignment-left, auto);
    right: var(--side-cart-alignment-right, 0);
    transform: translateX(0);
    top: 0;
    bottom: 0;
    display: flex;
    flex-direction: column;
    align-items: stretch;
    font-size: 14px;
    min-height: 200px;
    width: 350px;
    max-width: 100%;
    transition: .3s;
    padding: var(--cart-padding, 20px 30px);
    background-color: var(--cart-background-color, #fff);
    box-shadow: 0 0 20px rgba(0, 0, 0, .2);
    border-style: var(--cart-border-style, none);
    border-color: var(--cart-border-color, initial);
    border-radius: var(--cart-border-radius, 0);
    margin-top: var(--mini-cart-spacing, 0)
}

.elementor-menu-cart__main .widget_shopping_cart_content {
    height: 100%;
    display: flex;
    flex-direction: column
}

.elementor-menu-cart__main .widget_shopping_cart_content .woocommerce-mini-cart__empty-message {
    color: var(--empty-message-color, inherit);
    text-align: var(--empty-message-alignment, left)
}

body.elementor-default .elementor-widget-woocommerce-menu-cart:not(.elementor-menu-cart--shown) .elementor-menu-cart__container {
    background-color: transparent;
    transform: scale(0);
    transition: background-color .4s, transform 0s .4s
}

body.elementor-default .elementor-widget-woocommerce-menu-cart:not(.elementor-menu-cart--shown) .elementor-menu-cart__container .dialog-lightbox-close-button {
    display: none
}

body.elementor-default .elementor-widget-woocommerce-menu-cart:not(.elementor-menu-cart--shown) .elementor-menu-cart__main {
    overflow: hidden;
    opacity: 0;
    transform: var(--side-cart-alignment-transform, translateX(100%))
}

.elementor-menu-cart__close-button {
    width: var(--cart-close-icon-size, 25px);
    height: var(--cart-close-icon-size, 25px);
    position: relative;
    margin: 0 0 20px;
    align-self: flex-end;
    cursor: pointer;
    display: inline-block;
    font-family: eicons;
    font-size: 20px;
    line-height: 1;
    transition: .3s
}

.elementor-menu-cart__close-button:after,
.elementor-menu-cart__close-button:before {
    content: "";
    position: absolute;
    height: 3px;
    width: 100%;
    top: 50%;
    left: 0;
    margin-top: -1px;
    background: var(--cart-close-button-color, #69727d);
    border-radius: 1px;
    transition: .3s
}

.elementor-menu-cart__close-button:hover:after,
.elementor-menu-cart__close-button:hover:before {
    background: var(--cart-close-button-hover-color, #69727d)
}

.elementor-menu-cart__close-button:before {
    transform: rotate(45deg)
}

.elementor-menu-cart__close-button:after {
    transform: rotate(-45deg)
}

.elementor-menu-cart__close-button-custom {
    position: relative;
    margin: 0 0 20px;
    align-self: flex-end;
    cursor: pointer;
    display: inline-block;
    font-family: eicons;
    font-size: 20px;
    line-height: 1;
    transition: .3s
}

.elementor-menu-cart__close-button-custom:hover:after,
.elementor-menu-cart__close-button-custom:hover:before {
    background: var(--cart-close-button-hover-color, #69727d)
}

.elementor-menu-cart__close-button-custom .e-close-cart-custom-icon {
    font-size: var(--cart-close-icon-size, 25px);
    color: var(--cart-close-button-color, #69727d)
}

.elementor-menu-cart__close-button-custom .e-close-cart-custom-icon:hover {
    color: var(--cart-close-button-hover-color, #69727d)
}

.elementor-menu-cart__close-button-custom svg {
    fill: var(--cart-close-button-color, #69727d);
    width: var(--cart-close-icon-size, 25px);
    height: var(--cart-close-icon-size, 25px)
}

.elementor-menu-cart__close-button-custom svg:hover {
    fill: var(--cart-close-button-hover-color, #69727d)
}

.elementor-menu-cart__products {
    max-height: calc(100vh - 250px);
    overflow: hidden;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch
}

.elementor-menu-cart__product {
    display: grid;
    grid-template-columns: 28% auto;
    grid-template-rows: var(--price-quantity-position--grid-template-rows, auto auto);
    position: relative;
    border-width: 0;
    border-bottom: var(--divider-width, 1px) var(--divider-style, solid) var(--divider-color, #d5d8dc)
}

.elementor-menu-cart__product .variation {
    display: grid;
    grid-template-columns: max-content auto;
    margin: 10px 0;
    color: var(--product-variations-color, #1f2124)
}

.elementor-menu-cart__product .variation dt {
    grid-column-start: 1
}

.elementor-menu-cart__product .variation dd {
    grid-column-start: 2;
    margin-inline-start: 5px
}

.elementor-menu-cart__product .variation dd p {
    margin-bottom: 0
}

.elementor-menu-cart__product-image {
    grid-row-start: 1;
    grid-row-end: 3;
    width: 100%
}

.elementor-menu-cart__product-image a,
.elementor-menu-cart__product-image img {
    display: block
}

.elementor-menu-cart__product-name {
    grid-column-start: 2;
    grid-column-end: 3;
    margin: 0
}

.elementor-menu-cart__product-name a {
    transition: .3s
}

.elementor-menu-cart__product-price {
    grid-column-start: 2;
    grid-column-end: 3;
    align-self: var(--price-quantity-position--align-self, end);
    font-weight: 300;
    color: var(--product-price-color, #d5d8dc)
}

.elementor-menu-cart__product-name,
.elementor-menu-cart__product-price {
    font-size: 14px;
    padding-left: 20px
}

.elementor-menu-cart__product-remove {
    color: #69727d;
    width: var(--remove-item-button-size, 22px);
    height: var(--remove-item-button-size, 22px);
    border-radius: var(--remove-item-button-size, 22px);
    border: 1px solid var(--remove-item-button-color, #d5d8dc);
    text-align: center;
    overflow: hidden;
    position: absolute;
    right: 0;
    bottom: 20px;
    transition: .3s
}

.elementor-menu-cart__product-remove:hover {
    border: 1px solid var(--remove-item-button-hover-color, #d5d8dc)
}

.elementor-menu-cart__product-remove:hover:after,
.elementor-menu-cart__product-remove:hover:before {
    background: var(--remove-item-button-hover-color, #d5d8dc)
}

.elementor-menu-cart__product-remove:after,
.elementor-menu-cart__product-remove:before {
    content: "";
    position: absolute;
    height: 1px;
    width: 50%;
    top: 50%;
    left: 25%;
    margin-top: -1px;
    background: var(--remove-item-button-color, #d5d8dc);
    z-index: 1;
    transition: .3s
}

.elementor-menu-cart__product-remove:before {
    transform: rotate(45deg)
}

.elementor-menu-cart__product-remove:after {
    transform: rotate(-45deg)
}

.elementor-menu-cart__product-remove>a {
    display: block;
    z-index: 2;
    width: 100%;
    height: 100%;
    overflow: hidden;
    opacity: 0;
    position: absolute
}

.elementor-menu-cart__product-remove>a.remove_from_cart_button {
    display: var(--remove-from-cart-button, block)
}

.elementor-menu-cart__product-remove>a.elementor_remove_from_cart_button {
    display: var(--elementor-remove-from-cart-button, none)
}

.elementor-menu-cart__product:last-child {
    border: none
}

.elementor-menu-cart__footer-buttons,
.elementor-menu-cart__product:not(:first-of-type),
.elementor-menu-cart__subtotal {
    padding-top: var(--product-divider-gap, 20px)
}

.elementor-menu-cart__product {
    padding-right: 30px
}

.elementor-menu-cart__product,
.elementor-menu-cart__subtotal {
    padding-bottom: var(--product-divider-gap, 20px)
}

.elementor-menu-cart__subtotal {
    font-size: 20px;
    text-align: var(--menu-cart-subtotal-text-align, center);
    font-weight: 600;
    color: var(--menu-cart-subtotal-color, inherit);
    border-left: var(--subtotal-divider-left-width, 1px) var(--subtotal-divider-style, solid) var(--subtotal-divider-color, #d5d8dc);
    border-bottom: var(--subtotal-divider-bottom-width, 1px) var(--subtotal-divider-style, solid) var(--subtotal-divider-color, #d5d8dc);
    border-right: var(--subtotal-divider-right-width, 1px) var(--subtotal-divider-style, solid) var(--subtotal-divider-color, #d5d8dc);
    border-top: var(--subtotal-divider-top-width, 1px) var(--subtotal-divider-style, solid) var(--subtotal-divider-color, #d5d8dc)
}

.elementor-menu-cart__footer-buttons {
    font-size: 20px;
    text-align: var(--cart-footer-buttons-alignment-text-align, center);
    display: var(--cart-footer-buttons-alignment-display, grid);
    grid-template-columns: var(--cart-footer-layout, 1fr 1fr);
    margin-top: var(--cart-buttons-position-margin, 0);
    grid-column-gap: var(--space-between-buttons, 10px);
    grid-row-gap: var(--space-between-buttons, 10px)
}

.elementor-menu-cart__footer-buttons .elementor-button {
    display: inline-block;
    border-radius: var(--cart-footer-buttons-border-radius, 0);
    height: -moz-fit-content;
    height: fit-content
}

.elementor-menu-cart__footer-buttons .elementor-button--view-cart {
    display: var(--view-cart-button-display, inline-block);
    color: var(--view-cart-button-text-color, #fff);
    padding: var(--view-cart-button-padding, 15px);
    background-color: var(--view-cart-button-background-color, #69727d)
}

.elementor-menu-cart__footer-buttons .elementor-button--view-cart:hover {
    color: var(--view-cart-button-hover-text-color, #fff);
    background-color: var(--view-cart-button-hover-background-color, #69727d)
}

.elementor-menu-cart__footer-buttons .elementor-button--checkout {
    display: var(--checkout-button-display, inline-block);
    color: var(--checkout-button-text-color, #fff);
    padding: var(--checkout-button-padding, 15px);
    background-color: var(--checkout-button-background-color, #69727d)
}

.elementor-menu-cart__footer-buttons .elementor-button--checkout:hover {
    color: var(--checkout-button-hover-text-color, #fff);
    background-color: var(--checkout-button-hover-background-color, #69727d)
}

@media (max-width: 767px) {
    .elementor-menu-cart__footer-buttons .elementor-button {
        padding-left: 10px;
        padding-right: 10px
    }
}

.elementor-widget-woocommerce-menu-cart.elementor-menu-cart--empty-indicator-hide .elementor-menu-cart__toggle .elementor-button-icon .elementor-button-icon-qty[data-counter="0"],
.elementor-widget-woocommerce-menu-cart:not(.elementor-menu-cart--show-subtotal-yes) .elementor-menu-cart__toggle .elementor-button-text {
    display: none
}

.elementor-widget-woocommerce-menu-cart:not(.elementor-menu-cart--show-remove-button-yes) .elementor-menu-cart__product {
    padding-left: 0;
    padding-right: 0;
    grid-template-columns: 25% auto
}

.elementor-widget-woocommerce-menu-cart:not(.elementor-menu-cart--show-remove-button-yes) .elementor-menu-cart__product-remove {
    display: none
}

.elementor-widget-woocommerce-menu-cart.remove-item-position--top .elementor-menu-cart__product-remove {
    top: 0;
    bottom: auto
}

.elementor-widget-woocommerce-menu-cart.remove-item-position--top .elementor-menu-cart__products .cart_item:not(:first-of-type) .elementor-menu-cart__product-remove {
    top: 20px;
    bottom: auto
}

.elementor-widget-woocommerce-menu-cart.remove-item-position--middle .elementor-menu-cart__product-remove {
    transform: translateY(50%);
    bottom: 50%
}

.elementor-widget-woocommerce-menu-cart.remove-item-position--bottom .elementor-menu-cart__product-remove {
    top: auto;
    bottom: 20px
}

.elementor-widget-woocommerce-menu-cart.elementor-menu-cart--cart-type-mini-cart .elementor-menu-cart__container {
    position: absolute;
    width: auto;
    height: auto;
    overflow: visible;
    top: 100%;
    bottom: auto;
    background: none;
    min-width: 330px;
    left: 0;
    right: auto;
    transform: scale(1);
    transition: background-color .4s, transform 0s
}

.elementor-widget-woocommerce-menu-cart.elementor-menu-cart--cart-type-mini-cart .elementor-menu-cart__main {
    width: auto;
    height: auto;
    position: relative;
    top: auto;
    bottom: auto;
    right: auto;
    left: auto;
    overflow: visible;
    transform: translateY(0);
    transition: .3s
}

@media (max-width: 767px) {
    .elementor-widget-woocommerce-menu-cart.elementor-menu-cart--cart-type-mini-cart .elementor-menu-cart__container {
        min-width: 300px
    }
}

body.elementor-default .elementor-widget-woocommerce-menu-cart.elementor-menu-cart--cart-type-mini-cart:not(.elementor-menu-cart--shown) .elementor-menu-cart__container {
    transform: scale(0);
    transition: background-color .4s, transform 0s .4s
}

body.elementor-default .elementor-widget-woocommerce-menu-cart.elementor-menu-cart--cart-type-mini-cart:not(.elementor-menu-cart--shown) .elementor-menu-cart__main {
    opacity: 0;
    transform: translateY(-10px)
}

.elementor-edit-area-active .elementor-widget-woocommerce-menu-cart.elementor-widget.elementor-loading.elementor-menu-cart--shown {
    opacity: 1
}

.elementor-edit-area-active .elementor-widget-woocommerce-menu-cart.elementor-widget.elementor-loading.elementor-menu-cart--shown .elementor-menu-cart__container {
    z-index: 9999
}

.elementor-widget-woocommerce-menu-cart.elementor-menu-cart--cart-type-dropdown .elementor-menu-cart__container {
    display: none
}

.elementor-widget-woocommerce-purchase-summary {
    font-size: 14px;
    font-family: Roboto, sans-serif;
    color: #69727d
}

.elementor-widget-woocommerce-purchase-summary table tbody tr:hover>td,
.elementor-widget-woocommerce-purchase-summary table tbody tr:hover>th {
    background-color: initial
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .woocommerce-thankyou-order-details {
    padding-inline-start: 0;
    margin: 0 0 2em;
    display: flex;
    flex-wrap: wrap
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .woocommerce-thankyou-order-details li {
    border-right: var(--payment-details-border-width, 1px) var(--payment-details-border-type, solid) var(--payment-details-border-color, #d5d8dc);
    color: var(--payment-details-titles-color, #000);
    font-weight: 700;
    font-size: 14px;
    text-transform: capitalize;
    margin-right: var(--payment-details-space-between, 4em);
    padding-right: var(--payment-details-space-between, 4em);
    float: unset;
    margin-bottom: 30px
}

@media (max-width: 1024px) {
    .elementor-widget-woocommerce-purchase-summary .woocommerce .woocommerce-thankyou-order-details li {
        border-right: none;
        border-bottom: var(--payment-details-border-width, 1px) var(--payment-details-border-type, solid) var(--payment-details-border-color, #d5d8dc);
        margin-right: 0;
        padding-right: 0;
        width: 100%;
        padding-top: calc(var(--payment-details-space-between, 20px) / 2);
        padding-bottom: calc(var(--payment-details-space-between, 20px) / 2);
        justify-content: space-between;
        display: flex;
        margin-bottom: 0
    }
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .woocommerce-thankyou-order-details li strong {
    color: var(--payment-details-items-color, #69727d);
    font-weight: 400;
    font-size: 14px;
    margin-top: var(--payment-details-titles-spacing, 10px);
    text-transform: none;
    line-height: normal;
    text-shadow: none;
    font-style: normal;
    letter-spacing: 0
}

@media (max-width: 1024px) {
    .elementor-widget-woocommerce-purchase-summary .woocommerce .woocommerce-thankyou-order-details li strong {
        margin-top: 0
    }
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .woocommerce-bacs-bank-details .wc-bacs-bank-details {
    padding-inline-start: 0;
    display: flex;
    flex-wrap: wrap
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .woocommerce-bacs-bank-details .wc-bacs-bank-details li {
    border-right: var(--bank-details-border-width, 1px) var(--bank-details-border-type, solid) var(--bank-details-border-color, #d5d8dc);
    color: var(--bank-details-titles-color, #000);
    font-weight: 700;
    font-size: 14px;
    text-transform: capitalize;
    margin-right: var(--bank-details-space-between, 4em);
    padding-right: var(--bank-details-space-between, 4em);
    float: unset;
    margin-bottom: 30px
}

@media (max-width: 1024px) {
    .elementor-widget-woocommerce-purchase-summary .woocommerce .woocommerce-bacs-bank-details .wc-bacs-bank-details li {
        border-right: none;
        border-bottom: var(--bank-details-border-width, 1px) var(--bank-details-border-type, solid) var(--bank-details-border-color, #d5d8dc);
        margin-right: 0;
        padding-right: 0;
        width: 100%;
        padding-top: calc(var(--bank-details-space-between, 20px) / 2);
        padding-bottom: calc(var(--bank-details-space-between, 20px) / 2);
        justify-content: space-between;
        display: flex;
        margin-bottom: 0
    }
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .woocommerce-bacs-bank-details .wc-bacs-bank-details li strong {
    color: var(--bank-details-items-color, #69727d);
    font-weight: 400;
    font-size: 14px;
    margin-top: var(--bank-details-titles-spacing, 10px);
    text-transform: none;
    line-height: normal;
    text-shadow: none;
    font-style: normal;
    letter-spacing: 0
}

@media (max-width: 1024px) {
    .elementor-widget-woocommerce-purchase-summary .woocommerce .woocommerce-bacs-bank-details .wc-bacs-bank-details li strong {
        margin-top: 0
    }
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .woocommerce-bacs-bank-details .wc-bacs-bank-details li:last-of-type {
    border-right: none
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .wc-item-meta .wc-item-meta-label,
.elementor-widget-woocommerce-purchase-summary .woocommerce .wc-item-meta li p {
    color: var(--order-details-variations-color, #69727d)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .shop_table {
    font-size: 14px;
    margin-bottom: 0;
    padding: var(--sections-padding, 15px 30px);
    background-color: var(--sections-background-color, #fff);
    border-radius: var(--sections-border-radius, 3px);
    border: 1px var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .shop_table .button.alt {
    background-color: transparent;
    border-radius: var(--button-border-radius, 3px);
    border: 2px var(--buttons-border-type, solid) var(--buttons-border-color, #5bc0de);
    vertical-align: middle;
    color: var(--button-normal-text-color, #69727d);
    padding: var(--button-padding, 5px 10px)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .shop_table .button.alt:hover {
    color: var(--button-hover-text-color, #69727d);
    transition-duration: var(--button-hover-transition-duration, .3s)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .shop_table td,
.elementor-widget-woocommerce-purchase-summary .woocommerce .shop_table th {
    border: 0;
    border-top: var(--tables-divider-border-width, 1px) var(--tables-divider-border-type, solid) var(--tables-divider-border-color, #d5d8dc);
    padding-top: calc(var(--order-details-rows-gap, 18px) / 2);
    padding-bottom: calc(var(--order-details-rows-gap, 18px) / 2);
    padding-left: 0;
    padding-right: 0
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .shop_table thead tr th {
    color: var(--order-details-titles-totals-color, #000);
    border-top: none;
    padding-top: 0
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .shop_table thead tr th span {
    color: var(--order-details-titles-totals-color, #000)
}

@media (min-width: 1025px) {
    .elementor-widget-woocommerce-purchase-summary .woocommerce .shop_table tbody td {
        vertical-align: top;
        line-height: unset
    }
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .shop_table tbody td .woocommerce-Price-amount {
    color: var(--order-details-items-color, #69727d)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .shop_table tfoot td,
.elementor-widget-woocommerce-purchase-summary .woocommerce .shop_table tfoot th {
    color: var(--order-details-titles-totals-color, #000)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .shop_table tfoot tr:last-child td,
.elementor-widget-woocommerce-purchase-summary .woocommerce .shop_table tfoot tr:last-child th {
    padding-bottom: 0
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .shop_table .product-quantity,
.elementor-widget-woocommerce-purchase-summary .woocommerce .shop_table td.download-expires,
.elementor-widget-woocommerce-purchase-summary .woocommerce .shop_table td.download-remaining {
    font-weight: 400;
    color: var(--order-details-items-color, #69727d)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .shop_table .product-purchase-note td {
    border-top: none;
    padding-top: 0;
    color: var(--general-text-color, #69727d)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .woocommerce-table--order-downloads tr td:before {
    color: var(--order-details-titles-totals-color, #000)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .order-again .button {
    background: transparent;
    border: 2px solid #5bc0de;
    border: 2px var(--buttons-border-type, solid) var(--buttons-border-color, #5bc0de);
    border-radius: var(--button-border-radius, 3px);
    vertical-align: middle;
    color: var(--button-normal-text-color, #69727d);
    margin-top: 40px;
    margin-bottom: 0;
    padding: var(--button-padding, 12px 32px)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .order-again .button:hover {
    color: var(--button-hover-text-color, #69727d);
    transition-duration: var(--button-hover-transition-duration, .3s)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce h2 {
    color: var(--titles-color, #000);
    margin-bottom: var(--titles-spacing, 45px);
    font-weight: 400
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .woocommerce-order-details h2 {
    text-align: var(--order-summary-alignment, inherit)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .wc-bacs-bank-details-heading {
    text-align: var(--bank-details-alignment, inherit)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .woocommerce-order-downloads__title {
    text-align: var(--downloads-alignment, inherit)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .woocommerce-column--billing-address h2,
.elementor-widget-woocommerce-purchase-summary .woocommerce .woocommerce-customer-details>h2 {
    text-align: var(--billing-details-alignment, inherit)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .woocommerce-column--shipping-address h2 {
    text-align: var(--shipping-details-alignment, inherit)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce a {
    color: var(--order-details-product-links-normal-color, #5bc0de)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce a:hover {
    color: var(--order-details-product-links-hover-color, #5bc0de)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce p {
    margin-bottom: 20px
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .woocommerce-thankyou-order-received {
    margin-bottom: var(--sections-spacing, 40px);
    color: var(--confirmation-message-color, #69727d);
    text-align: var(--confirmation-message-alignment, inherit);
    display: var(--confirmation-message-display, none)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce strong {
    color: var(--general-text-color, #000)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce table tbody>tr:nth-child(odd)>td,
.elementor-widget-woocommerce-purchase-summary .woocommerce table tbody>tr:nth-child(odd)>th {
    background-color: transparent
}

.elementor-widget-woocommerce-purchase-summary .woocommerce address {
    padding: var(--sections-padding, 15px 30px);
    background-color: var(--sections-background-color, #fff);
    border-radius: var(--sections-border-radius, 3px);
    border: 1px var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    color: var(--general-text-color, #69727d)
}

@media (max-width: 767px) {
    .elementor-widget-woocommerce-purchase-summary .woocommerce-column--2 {
        margin-top: 2em
    }
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .woocommerce-thankyou-order-details+p {
    color: var(--general-text-color, #69727d)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .wc-bacs-bank-details-account-name {
    color: var(--account-title-color, #000);
    font-weight: 700;
    font-size: 14px;
    margin-bottom: var(--account-title-spacing, 1rem)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce section {
    margin-top: var(--sections-spacing, 4em)
}

.elementor-widget-woocommerce-purchase-summary .woocommerce .wc-bacs-bank-details:last-child {
    margin-bottom: 0
}

.elementor-widget-woocommerce-purchase-summary .woocommerce-table__line-item.order_item .woocommerce-table__product-name.product-purchase-note-is-below,
.elementor-widget-woocommerce-purchase-summary .woocommerce-table__line-item.order_item .woocommerce-table__product-total.product-total.product-purchase-note-is-below {
    padding-bottom: 0
}

.elementor-widget-woocommerce-purchase-summary .woocommerce-table--order-details {
    table-layout: fixed
}

.elementor-widget-woocommerce-purchase-summary .woocommerce-table--order-details td {
    word-wrap: break-word
}

body {
    background-color: transparent;
    font-family: Roboto, sans-serif;
    font-size: 14px;
    line-height: 21px;
    color: #69727d
}

body.e-checkout-layout-one-column .e-checkout__container {
    grid-template-columns: auto
}

body ::-moz-placeholder {
    color: var(--forms-fields-normal-color, inherit);
    font-family: inherit;
    opacity: .6
}

body ::placeholder {
    color: var(--forms-fields-normal-color, inherit);
    font-family: inherit;
    opacity: .6
}

body table tbody tr:hover>td,
body table tbody tr:hover>th {
    background-color: transparent
}

body .select2-container--default .select2-selection--single {
    color: var(--forms-fields-normal-color, #69727d);
    background-color: #f9fafa;
    border-radius: var(--forms-fields-border-radius, 0);
    border: none;
    height: 45px
}

body .select2-container--default .select2-selection--single:focus {
    color: var(--forms-fields-focus-color, #69727d);
    background-color: #f9fafa;
    border-color: initial;
    transition-duration: var(--forms-fields-focus-transition-duration, .3s)
}

body .select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: var(--forms-fields-normal-color, #69727d)
}

body .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: var(--forms-fields-normal-color, #69727d);
    line-height: 45px;
    padding-left: 1rem;
    padding-right: 1rem
}

body .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 45px
}

body .select2-container--open .select2-dropdown--below {
    background-color: #f9fafa
}

body .e-description {
    color: var(--sections-descriptions-color, #69727d);
    padding-bottom: var(--sections-descriptions-spacing, 0);
    font-size: 14px;
    font-weight: 400
}

body .e-woocommerce-login-section {
    margin-bottom: 24px
}

body .e-woocommerce-login-section .e-checkout-secondary-title {
    text-align: var(--login-title-alignment, left)
}

body .e-woocommerce-login-nudge {
    margin-top: var(--sections-secondary-title-spacing, 24px);
    margin-bottom: 15px
}

body .e-coupon-anchor {
    margin-top: var(--sections-secondary-title-spacing, 24px)
}

body .e-coupon-box {
    margin-top: 24px
}

body .e-coupon-anchor-description {
    color: var(--forms-labels-color, #69727d);
    margin-bottom: var(--forms-label-spacing, 3px)
}

body .e-login-wrap {
    display: flex;
    align-items: center
}

body .e-login-wrap-start {
    flex: 75%
}

body .e-login-wrap-end {
    flex: 20%;
    text-align: right
}

@media (max-width: 1024px) {
    body .e-login-wrap {
        display: block
    }

    body .e-login-wrap-end {
        text-align: var(--login-button-alignment, left);
        margin-top: 15px
    }

    body .e-login-wrap-end label.e-login-label {
        display: none
    }
}

body .e-login-actions-wrap {
    display: flex;
    justify-content: space-between;
    margin-top: 6px
}

body .e-login-actions-wrap-end .lost_password {
    margin-bottom: 0;
    font-size: 12px
}

@media (max-width: 1024px) {
    body .e-login-actions-wrap-end .lost_password {
        font-size: 11px
    }
}

body .e-apply-coupon {
    width: 90%
}

@media (max-width: 1024px) {
    body .e-apply-coupon {
        width: var(--coupon-button-width, auto)
    }
}

body .e-checkout__container {
    display: grid;
    flex-wrap: wrap;
    grid-template-columns: 56% auto;
    align-items: stretch;
    grid-column-gap: var(--sections-margin, 24px);
    grid-row-gap: var(--sections-margin, 24px)
}

@media (max-width: 1024px) {
    body .e-checkout__container {
        grid-template-columns: repeat(1, 1fr)
    }
}

body .e-checkout-secondary-title {
    color: var(--sections-secondary-title-color, #69727d);
    margin-bottom: 0
}

body .e-woocommerce-coupon-nudge {
    text-align: var(--coupon-title-alignment, left)
}

body #ship-to-different-address {
    margin-top: 13px;
    padding-left: var(--shipping-heading-padding-start, 30px)
}

body #ship-to-different-address span {
    font-weight: 400
}

body a {
    color: var(--links-normal-color, #5bc0de)
}

body a:hover {
    color: var(--links-hover-color, #5bc0de)
}

body .woocommerce #customer_details .form-row,
body .woocommerce .e-coupon-box .form-row,
body .woocommerce .e-woocommerce-login-anchor .form-row {
    padding-left: var(--forms-columns-gap-padding, 0);
    padding-right: var(--forms-columns-gap-padding, 0);
    margin-left: var(--forms-columns-gap-margin, 0);
    margin-right: var(--forms-columns-gap-margin, 0)
}

body .woocommerce #customer_details .form-row label,
body .woocommerce .e-coupon-box .form-row label,
body .woocommerce .e-woocommerce-login-anchor .form-row label {
    color: var(--forms-labels-color, #69727d);
    margin-bottom: var(--forms-label-spacing, 3px)
}

body .woocommerce #customer_details .form-row .input-text,
body .woocommerce #customer_details .form-row select,
body .woocommerce #customer_details .form-row textarea,
body .woocommerce .e-coupon-box .form-row .input-text,
body .woocommerce .e-coupon-box .form-row select,
body .woocommerce .e-coupon-box .form-row textarea,
body .woocommerce .e-woocommerce-login-anchor .form-row .input-text,
body .woocommerce .e-woocommerce-login-anchor .form-row select,
body .woocommerce .e-woocommerce-login-anchor .form-row textarea {
    color: var(--forms-fields-normal-color, #69727d);
    background-color: #f9fafa;
    border-radius: var(--forms-fields-border-radius, 0);
    padding: var(--forms-fields-padding, 16px);
    font-size: 14px;
    border: none;
    font-weight: 400
}

body .woocommerce #customer_details .form-row .input-text:focus,
body .woocommerce #customer_details .form-row select:focus,
body .woocommerce #customer_details .form-row textarea:focus,
body .woocommerce .e-coupon-box .form-row .input-text:focus,
body .woocommerce .e-coupon-box .form-row select:focus,
body .woocommerce .e-coupon-box .form-row textarea:focus,
body .woocommerce .e-woocommerce-login-anchor .form-row .input-text:focus,
body .woocommerce .e-woocommerce-login-anchor .form-row select:focus,
body .woocommerce .e-woocommerce-login-anchor .form-row textarea:focus {
    color: var(--forms-fields-focus-color, #69727d);
    background-color: #f9fafa;
    border-color: #69727d;
    transition-duration: var(--forms-fields-focus-transition-duration, .3s)
}

body .woocommerce #customer_details #billing_address_1_field,
body .woocommerce .e-coupon-box #billing_address_1_field,
body .woocommerce .e-woocommerce-login-anchor #billing_address_1_field {
    margin-bottom: 5px
}

body .woocommerce .create-account,
body .woocommerce .e-coupon-box .form-row {
    margin-bottom: 0 !important
}

body .woocommerce #shipping_method li input,
body .woocommerce .input-radio {
    vertical-align: middle
}

body .woocommerce-form__input-checkbox {
    vertical-align: middle;
    margin: 0 5px 0 0
}

body .woocommerce-form__label-for-checkbox span {
    position: relative;
    top: 2px;
    color: var(--sections-checkboxes-color, #69727d)
}

body .woocommerce #shipping_method li label,
body .woocommerce .wc_payment_method label {
    color: var(--sections-radio-buttons-color, #69727d)
}

body .woocommerce .wc_payment_method label {
    display: inline
}

body .woocommerce button.woocommerce-button {
    background-color: var(--e-a-bg-default);
    color: var(--forms-buttons-normal-text-color, #6f6f6f);
    border-radius: var(--forms-buttons-border-radius, 3px);
    padding: 1rem;
    border: 2px var(--forms-buttons-border-type, solid) var(--forms-buttons-border-color, #5bc0de)
}

body .woocommerce button.woocommerce-button:hover {
    color: var(--forms-buttons-hover-text-color, #6f6f6f);
    transition-duration: var(--forms-buttons-hover-transition-duration, .3s)
}

body .woocommerce #coupon_code {
    margin-right: 1%
}

@media (max-width: 1024px) {
    body .woocommerce #coupon_code {
        width: 100%;
        margin-right: 0;
        margin-bottom: 15px
    }
}

body .woocommerce-info {
    border-top-color: transparent;
    background-color: transparent;
    padding: 0
}

body .woocommerce-privacy-policy-text p {
    font-weight: 400;
    font-size: 12px
}

body .woocommerce-form-login-toggle .woocommerce-info {
    font-weight: 400;
    margin-bottom: 0
}

body .woocommerce #customer_details .col-1,
body .woocommerce .e-checkout__order_review,
body .woocommerce .e-coupon-box,
body .woocommerce .e-woocommerce-login-section,
body .woocommerce .shipping_address,
body .woocommerce .woocommerce-additional-fields,
body .woocommerce .woocommerce-checkout #payment {
    background: var(--sections-background-color, #fff);
    border-radius: var(--sections-border-radius, 3px);
    padding: var(--sections-padding, 16px 30px);
    margin: var(--sections-margin, 0 0 24px 0);
    border: 1px var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    display: block
}

body .woocommerce .woocommerce-additional-fields {
    display: var(--additional-information-display, none)
}

@media (min-width: 1024px) {
    body .woocommerce .woocommerce-additional-fields {
        margin: var(--sections-margin, 0)
    }
}

body .woocommerce .e-checkout-message,
body .woocommerce .woocommerce-checkout #payment .payment_box,
body .woocommerce .woocommerce-privacy-policy-text {
    color: var(--sections-messages-color, #69727d);
    font-weight: 400
}

body .woocommerce .woocommerce-privacy-policy-text p {
    margin-top: 25px
}

body .woocommerce #customer_details .col2-set .col-1 {
    margin-bottom: 0
}

body .woocommerce #customer_details .col2-set .col-2 {
    padding-top: 15px
}

body .woocommerce #order_review_heading {
    text-align: var(--order-review-title-alignment, left)
}

body .woocommerce .shop_table {
    margin-bottom: 0;
    border: 0;
    font-size: 14px
}

body .woocommerce .shop_table thead {
    background-color: transparent
}

body .woocommerce .shop_table thead tr th {
    padding-top: 0
}

body .woocommerce .shop_table tbody td {
    color: #000
}

body .woocommerce .shop_table tbody td .product-quantity {
    font-weight: 400
}

body .woocommerce .shop_table tfoot td,
body .woocommerce .shop_table tfoot th {
    color: #69727d
}

body .woocommerce .shop_table td,
body .woocommerce .shop_table th,
body .woocommerce .shop_table tr {
    border: 0;
    padding-left: 0;
    padding-bottom: 15px;
    padding-top: 15px
}

body .woocommerce .shop_table .order-total td,
body .woocommerce .shop_table .order-total th,
body .woocommerce .shop_table .order-total tr {
    padding-bottom: 0
}

body .woocommerce .shop_table tr:nth-child(odd)>td,
body .woocommerce .shop_table tr:nth-child(odd)>th {
    background-color: transparent
}

body .woocommerce .woocommerce-checkout-review-order-table .cart_item td {
    font-weight: 400;
    color: var(--order-summary-items-color, #000);
    border-bottom: var(--order-summary-items-divider-weight, 0) solid var(--order-summary-items-divider-color, #69727d)
}

body .woocommerce .woocommerce-checkout-review-order-table .cart_item td.product-name {
    padding-right: 40px;
    max-width: 150px
}

body .woocommerce .woocommerce-checkout-review-order-table .cart_item td.product-total {
    vertical-align: top
}

body .woocommerce .woocommerce-checkout-review-order-table td,
body .woocommerce .woocommerce-checkout-review-order-table th {
    padding-top: var(--order-summary-rows-gap-top, 15px);
    padding-bottom: var(--order-summary-rows-gap-bottom, 15px)
}

body .woocommerce .woocommerce-checkout-review-order-table tfoot td,
body .woocommerce .woocommerce-checkout-review-order-table tfoot th,
body .woocommerce .woocommerce-checkout-review-order-table thead th {
    color: var(--order-summary-totals-color, #69727d);
    vertical-align: top
}

body .woocommerce .woocommerce-checkout-review-order-table .order-total td,
body .woocommerce .woocommerce-checkout-review-order-table .order-total th {
    border-top: var(--order-summary-totals-divider-weight, 0) solid var(--order-summary-totals-divider-color, #69727d)
}

body .woocommerce-shipping-totals td {
    max-width: 70px
}

body .woocommerce h3 {
    font-size: 14px;
    font-weight: 700;
    margin-top: 0;
    margin-bottom: var(--sections-title-spacing, 30px);
    color: var(--sections-title-color, #fff)
}

body .woocommerce-checkout .form-row>span {
    font-weight: 400;
    font-size: 14px;
    margin-bottom: 3px;
    color: #69727d
}

body .woocommerce-checkout .form-row-first,
body .woocommerce-checkout .form-row-last {
    width: 48%
}

body .woocommerce-checkout .form-row .input-checkbox {
    vertical-align: middle;
    margin: 0 5px 0 0
}

body .woocommerce-checkout .woocommerce-billing-fields h3 {
    text-align: var(--billing-details-title-alignment, left)
}

body .woocommerce-checkout .woocommerce-account-fields .form-row,
body .woocommerce-checkout .woocommerce-billing-fields .form-row,
body .woocommerce-checkout .woocommerce-shipping-fields .form-row {
    margin-bottom: var(--forms-rows-gap, 5px)
}

body .woocommerce-checkout .woocommerce-account-fields .form-row:last-child,
body .woocommerce-checkout .woocommerce-billing-fields .form-row:last-child,
body .woocommerce-checkout .woocommerce-shipping-fields .form-row:last-child {
    margin-bottom: 15px
}

body .woocommerce-checkout.login {
    margin-top: -8px;
    z-index: 999;
    background: #fff;
    border-top-width: 0;
    position: relative;
    margin-bottom: 0;
    color: #69727d
}

@media (max-width: 1024px) {

    body .woocommerce-checkout .form-row-first,
    body .woocommerce-checkout .form-row-last {
        width: 100%
    }
}

body .woocommerce-form-coupon-toggle {
    display: none
}

body .woocommerce-form-login__submit {
    width: 85%
}

@media (max-width: 1024px) {
    body .woocommerce-form-login__submit {
        width: var(--login-button-width, 35%)
    }
}

body .woocommerce-additional-fields h3 {
    text-align: var(--additional-fields-title-alignment, left)
}

body .woocommerce-shipping-fields .shipping_address {
    margin-bottom: var(--sections-margin, 20px)
}

body .woocommerce-checkout #payment {
    margin-top: 24px;
    padding: 15px 25px 25px
}

body .woocommerce-checkout #payment .payment_methods {
    border-bottom: none;
    padding: 0
}

body .woocommerce-checkout #payment .payment_methods .payment_box {
    background-color: #f9fafa
}

body .woocommerce-checkout #payment .payment_methods .payment_box:before {
    display: none
}

body .woocommerce-checkout #payment .payment_methods li {
    line-height: 21px
}

body .woocommerce-checkout #payment .payment_methods li label a {
    padding-left: 15px;
    font-size: 12px
}

@media (max-width: 1024px) {
    body .woocommerce-checkout #payment .payment_methods li label a {
        float: none;
        font-size: 11px;
        padding-left: 10px
    }
}

@media (max-width: 1024px) {
    body .woocommerce-checkout #payment .payment_methods li label img {
        width: 55px
    }
}

body .woocommerce-checkout #payment .place-order {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    padding: 0;
    margin-bottom: 0;
    align-items: var(--place-order-title-alignment, stretch)
}

body .woocommerce-checkout #payment #place_order {
    background-color: #5bc0de;
    width: var(--purchase-button-width, auto);
    float: none;
    color: var(--purchase-button-normal-text-color, #fff);
    min-height: auto;
    padding: var(--purchase-button-padding, 1em 1em);
    border-radius: var(--purchase-button-border-radius, 3px)
}

body .woocommerce-checkout #payment #place_order:hover {
    background-color: #5bc0de;
    color: var(--purchase-button-hover-text-color, #fff);
    border-color: var(--purchase-button-hover-border-color, #5bc0de);
    transition-duration: var(--purchase-button-hover-transition-duration, .3s)
}

body .woocommerce-checkout #payment .woocommerce-info:before {
    display: none
}

body .woocommerce-checkout .col2-set .col-1,
body .woocommerce-checkout .col2-set .col-2 {
    width: auto;
    float: none
}

body .woocommerce .coupon-container-grid {
    display: grid;
    grid-template-columns: auto auto;
    align-items: center
}

body .woocommerce .coupon-container-grid .coupon-col-2 {
    text-align: right
}

@media (max-width: 1024px) {
    body .woocommerce .coupon-container-grid {
        display: block
    }

    body .woocommerce .coupon-container-grid .coupon-col-2 {
        text-align: var(--coupon-button-alignment, left)
    }
}

body .woocommerce #account_password_field {
    margin-bottom: 10px
}

body .woocommerce .product-name .variation {
    color: var(--order-summary-variations-color, #000);
    font-size: 14px;
    font-style: normal;
    text-transform: none;
    letter-spacing: normal;
    text-decoration: none;
    line-height: 21px
}

.e-woo-select2-wrapper .select2-results__option,
.e-woo-select2-wrapper .select2-results__option:focus {
    color: #69727d
}

.elementor-widget-woocommerce-cart .woocommerce table.shop_table {
    border: 0 solid
}

.elementor-widget-woocommerce-cart .woocommerce table.shop_table .button {
    float: left;
    font-size: 14px;
    font-weight: 700
}

.elementor-widget-woocommerce-cart .woocommerce table.shop_table.cart .actions {
    display: table-cell;
    text-align: var(--update-cart-button-alignment, left) !important
}

.elementor-widget-woocommerce-cart .woocommerce table.shop_table.cart .actions .button {
    display: inline-block !important;
    float: none;
    width: var(--update-cart-button-width, auto)
}

@media (max-width: 1024px) {
    .elementor-widget-woocommerce-cart .woocommerce table.shop_table.cart .actions .button {
        width: var(--update-cart-button-width, 100%) !important
    }
}

.elementor-widget-woocommerce-cart .woocommerce table.shop_table .shipping-calculator-form p:last-of-type {
    text-align: var(--update-shipping-button-alignment, start)
}

.elementor-widget-woocommerce-cart .woocommerce table.shop_table .shipping-calculator-form .button {
    float: none;
    width: var(--update-shipping-button-width, auto)
}

@media (max-width: 1024px) {
    .elementor-widget-woocommerce-cart .woocommerce table.shop_table .shipping-calculator-form .button {
        width: var(--update-shipping-button-width, 100%)
    }
}

.elementor-widget-woocommerce-cart .woocommerce table.shop_table td,
.elementor-widget-woocommerce-cart .woocommerce table.shop_table th,
.elementor-widget-woocommerce-cart .woocommerce table.shop_table tr {
    border: 0 solid
}

.elementor-widget-woocommerce-cart .woocommerce table.shop_table tr:nth-child(odd)>td,
.elementor-widget-woocommerce-cart .woocommerce table.shop_table tr:nth-child(odd)>th {
    background-color: transparent
}

.elementor-widget-woocommerce-cart .woocommerce table.shop_table .actions {
    padding: 16px 0 0
}

.elementor-widget-woocommerce-cart .woocommerce table.shop_table .product-remove a {
    display: inline-block
}

.elementor-widget-woocommerce-cart .woocommerce table.shop_table.cart tbody tr:last-child {
    display: var(--update-cart-automatically-display, table-row)
}

.elementor-widget-woocommerce-cart .woocommerce table.cart {
    margin-bottom: 0
}

.elementor-widget-woocommerce-cart .woocommerce table.cart img {
    width: 55px;
    height: auto;
    display: block
}

.elementor-widget-woocommerce-cart .woocommerce table.cart td {
    padding-top: var(--order-summary-rows-gap-top, 20px);
    padding-right: 20px;
    padding-bottom: var(--order-summary-rows-gap-bottom, 20px);
    padding-left: 0
}

.elementor-widget-woocommerce-cart .woocommerce table.cart td span {
    color: var(--order-summary-color, #000);
    font-size: 14px;
    font-weight: 400
}

.elementor-widget-woocommerce-cart .woocommerce table.cart td.actions,
.elementor-widget-woocommerce-cart .woocommerce table.cart td.product-name,
.elementor-widget-woocommerce-cart .woocommerce table.cart td.product-price,
.elementor-widget-woocommerce-cart .woocommerce table.cart td.product-quantity,
.elementor-widget-woocommerce-cart .woocommerce table.cart td.product-remove,
.elementor-widget-woocommerce-cart .woocommerce table.cart td.product-subtotal,
.elementor-widget-woocommerce-cart .woocommerce table.cart td.product-thumbnail {
    border-top: var(--order-summary-items-divider-weight, 1px) solid var(--order-summary-items-divider-color, #d5d8dc)
}

@media (max-width: 768px) {

    .elementor-widget-woocommerce-cart .woocommerce table.cart td.actions,
    .elementor-widget-woocommerce-cart .woocommerce table.cart td.product-name,
    .elementor-widget-woocommerce-cart .woocommerce table.cart td.product-price,
    .elementor-widget-woocommerce-cart .woocommerce table.cart td.product-quantity,
    .elementor-widget-woocommerce-cart .woocommerce table.cart td.product-remove,
    .elementor-widget-woocommerce-cart .woocommerce table.cart td.product-subtotal,
    .elementor-widget-woocommerce-cart .woocommerce table.cart td.product-thumbnail {
        border-top-width: 0
    }
}

.elementor-widget-woocommerce-cart .woocommerce table.cart td.product-remove {
    padding-left: 0;
    padding-right: 0
}

@media (min-width: 767px) {
    .elementor-widget-woocommerce-cart .woocommerce table.cart tbody tr:first-child td {
        border-top: none
    }
}

@media (max-width: 1024px) {
    .elementor-widget-woocommerce-cart .woocommerce table.cart.product-remove {
        position: relative
    }

    .elementor-widget-woocommerce-cart .woocommerce table.cart.product-name {
        padding-right: 0
    }

    .elementor-widget-woocommerce-cart .woocommerce table.cart tr {
        border-top-width: var(--order-summary-items-divider-weight, 1px);
        border-top-color: var(--order-summary-items-divider-color, #d5d8dc)
    }

    .elementor-widget-woocommerce-cart .woocommerce table.cart tr:first-child {
        border-top: none
    }
}

@media (max-width: 768px) {
    .elementor-widget-woocommerce-cart .woocommerce table.cart td {
        padding-left: 0;
        padding-right: 0
    }
}

@media (max-width: 767px) {
    .elementor-widget-woocommerce-cart .woocommerce table.cart {
        padding: 0
    }

    .elementor-widget-woocommerce-cart .woocommerce table.cart tr {
        padding: 16px 28px
    }

    .elementor-widget-woocommerce-cart .woocommerce table.cart tr:first-child {
        border-top: none
    }

    .elementor-widget-woocommerce-cart .woocommerce table.cart td {
        padding-left: 0;
        padding-right: 0
    }

    .elementor-widget-woocommerce-cart .woocommerce table.cart td.product-name,
    .elementor-widget-woocommerce-cart .woocommerce table.cart td:first-child {
        border-top: none
    }

    .elementor-widget-woocommerce-cart .woocommerce table.cart td.actions {
        padding: 0
    }
}

.elementor-widget-woocommerce-cart .woocommerce a:not(.add_to_cart_button):not(.restore-item):not(.wc-backward):not(.wc-forward) {
    color: var(--links-normal-color, #5bc0de)
}

.elementor-widget-woocommerce-cart .woocommerce a:not(.add_to_cart_button):not(.restore-item):not(.wc-backward):not(.wc-forward):hover {
    color: var(--links-hover-color, #5bc0de)
}

.elementor-widget-woocommerce-cart .woocommerce .cart_totals h2,
.elementor-widget-woocommerce-cart .woocommerce .cart th {
    font-size: 14px;
    font-weight: 700;
    margin-top: 0;
    padding: 0 20px 8px 0
}

.elementor-widget-woocommerce-cart .woocommerce .cart_totals h2 {
    margin-bottom: var(--sections-title-spacing, 1rem);
    color: var(--sections-title-color, #000)
}

.elementor-widget-woocommerce-cart .woocommerce .cart th {
    padding-bottom: var(--order-summary-title-spacing, 8px);
    color: var(--order-summary-title-color, #000)
}

.elementor-widget-woocommerce-cart .woocommerce .cart td:before {
    color: var(--order-summary-title-color, #000)
}

.elementor-widget-woocommerce-cart .woocommerce .shipping-calculator-button:after {
    display: none
}

.elementor-widget-woocommerce-cart .woocommerce .product-name .variation {
    color: var(--order-summary-variations-color, #000)
}

@media (max-width: 1024px) {

    .elementor-widget-woocommerce-cart .woocommerce-page table.shop_table_responsive tr:nth-child(2n) td,
    .elementor-widget-woocommerce-cart .woocommerce table.shop_table_responsive tr:nth-child(2n) td {
        background-color: transparent
    }

    .elementor-widget-woocommerce-cart .woocommerce .cart_totals .shop_table_responsive td {
        padding-left: 0
    }
}

.e-preview--show-hidden-elements .elementor-widget-woocommerce-cart .woocommerce #shipping_method input,
.e-preview--show-hidden-elements .elementor-widget-woocommerce-cart .woocommerce .shipping-calculator-form button[name=calc_shipping] {
    pointer-events: none
}

.e-woo-select2-wrapper .select2-results__option {
    font-family: Roboto, sans-serif;
    font-size: 14px;
    color: var(--forms-fields-normal-color, #69727d)
}

.e-woo-select2-wrapper .select2-results__option:focus {
    color: var(--forms-fields-focus-color, #69727d);
    border-color: #69727d;
    transition-duration: var(--forms-fields-focus-transition-duration, .3s)
}

.elementor-widget-woocommerce-my-account {
    font-family: Roboto, sans-serif;
    color: #69727d
}

.elementor-widget-woocommerce-my-account .e-my-account-tab .woocommerce-MyAccount-content {
    float: right;
    width: 75%;
    padding: 0;
    padding-left: var(--tab-content-spacing, 6%)
}

@media (max-width: 1024px) {
    .elementor-widget-woocommerce-my-account .e-my-account-tab .woocommerce-MyAccount-content {
        width: 100%;
        padding: var(--tab-content-spacing, 6%) 0 0 0
    }
}

.elementor-widget-woocommerce-my-account .e-my-account-tab__dashboard:not(.e-my-account-tab__dashboard--custom) .woocommerce-MyAccount-content-wrapper,
.elementor-widget-woocommerce-my-account .e-my-account-tab__downloads .woocommerce-MyAccount-content-wrapper,
.elementor-widget-woocommerce-my-account .e-my-account-tab__edit-account .woocommerce-MyAccount-content-wrapper,
.elementor-widget-woocommerce-my-account .e-my-account-tab__edit-address .woocommerce-MyAccount-content-wrapper,
.elementor-widget-woocommerce-my-account .e-my-account-tab__orders .woocommerce-MyAccount-content-wrapper,
.elementor-widget-woocommerce-my-account .e-my-account-tab__payment-methods .woocommerce-MyAccount-content-wrapper {
    border-left: var(--sections-border-left-width, 1px) var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    border-bottom: var(--sections-border-bottom-width, 1px) var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    border-right: var(--sections-border-right-width, 1px) var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    border-top: var(--sections-border-top-width, 1px) var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    border-radius: var(--sections-border-radius, 3px)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab__dashboard:not(.e-my-account-tab__dashboard--custom) .shop_table,
.elementor-widget-woocommerce-my-account .e-my-account-tab__downloads .shop_table,
.elementor-widget-woocommerce-my-account .e-my-account-tab__edit-account .shop_table,
.elementor-widget-woocommerce-my-account .e-my-account-tab__edit-address .shop_table,
.elementor-widget-woocommerce-my-account .e-my-account-tab__orders .shop_table,
.elementor-widget-woocommerce-my-account .e-my-account-tab__payment-methods .shop_table {
    border: none;
    margin-bottom: 0
}

.elementor-widget-woocommerce-my-account .e-my-account-tab__dashboard:not(.e-my-account-tab__dashboard--custom) .woocommerce-MyAccount-content-wrapper,
.elementor-widget-woocommerce-my-account .e-my-account-tab__downloads .woocommerce-MyAccount-content-wrapper,
.elementor-widget-woocommerce-my-account .e-my-account-tab__edit-account .woocommerce-MyAccount-content-wrapper,
.elementor-widget-woocommerce-my-account .e-my-account-tab__orders .woocommerce-MyAccount-content-wrapper,
.elementor-widget-woocommerce-my-account .e-my-account-tab__payment-methods .woocommerce-MyAccount-content-wrapper {
    background-color: var(--sections-background-color, #fff)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab__dashboard:not(.e-my-account-tab__dashboard--custom) .woocommerce-MyAccount-content-wrapper,
.elementor-widget-woocommerce-my-account .e-my-account-tab__edit-account .woocommerce-MyAccount-content-wrapper,
.elementor-widget-woocommerce-my-account .e-my-account-tab__payment-methods .woocommerce-MyAccount-content-wrapper {
    padding: var(--sections-padding, 16px 30px)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab__downloads .woocommerce-MyAccount-content-wrapper,
.elementor-widget-woocommerce-my-account .e-my-account-tab__orders .woocommerce-MyAccount-content-wrapper {
    padding: var(--sections-padding, 16px 30px 3px 30px)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-address-fields,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) address {
    background-color: var(--sections-background-color, #fff);
    padding: var(--sections-padding, 16px 30px);
    border-left: var(--sections-border-left-width, 1px) var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    border-bottom: var(--sections-border-bottom-width, 1px) var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    border-right: var(--sections-border-right-width, 1px) var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    border-top: var(--sections-border-top-width, 1px) var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    border-radius: var(--sections-border-radius, 3px)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab__edit-address .woocommerce-MyAccount-content,
.elementor-widget-woocommerce-my-account .e-my-account-tab__view-order .woocommerce-MyAccount-content {
    border: 0
}

.elementor-widget-woocommerce-my-account .e-my-account-tab__edit-address .woocommerce-MyAccount-content-wrapper,
.elementor-widget-woocommerce-my-account .e-my-account-tab__view-order .woocommerce-MyAccount-content-wrapper {
    padding: 0;
    border: 0
}

.elementor-widget-woocommerce-my-account .e-my-account-tab__view-order .order_details {
    margin-bottom: 40px
}

.elementor-widget-woocommerce-my-account .e-my-account-tab__view-order .order_details,
.elementor-widget-woocommerce-my-account .e-my-account-tab__view-order .woocommerce-table--order-downloads {
    background-color: var(--sections-background-color, #fff);
    padding: var(--sections-padding, 16px 30px 3px 30px);
    border-left: var(--sections-border-left-width, 1px) var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    border-bottom: var(--sections-border-bottom-width, 1px) var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    border-right: var(--sections-border-right-width, 1px) var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    border-top: var(--sections-border-top-width, 1px) var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    border-radius: var(--sections-border-radius, 3px)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab__payment-methods .woocommerce .woocommerce-MyAccount-content-wrapper .button {
    background: transparent;
    border-radius: var(--tables-button-border-radius, 3px);
    border: 2px var(--tables-buttons-border-type, solid) var(--tables-buttons-border-color, #5bc0de);
    vertical-align: middle;
    color: var(--tables-button-normal-text-color, #69727d);
    padding: var(--tables-button-padding, 5px 10px)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab__payment-methods .woocommerce .woocommerce-MyAccount-content-wrapper .button:hover {
    color: var(--tables-button-hover-text-color, #69727d);
    transition-duration: var(--tables-button-hover-transition-duration, .3s)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab__payment-methods .woocommerce input[type=text] {
    color: var(--forms-fields-normal-color, #69727d);
    border-radius: var(--forms-fields-border-radius, 0);
    padding: var(--forms-fields-padding, 16px);
    background: #f9fafa;
    border: none;
    font-size: 14px
}

.elementor-widget-woocommerce-my-account .e-my-account-tab__payment-methods .woocommerce input[type=text]:focus {
    color: var(--forms-fields-focus-color, #69727d);
    border-color: #69727d;
    transition-duration: var(--forms-fields-focus-transition-duration, .3s)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab__add-payment-method #add_payment_method #payment {
    background-color: var(--sections-background-color, #fff);
    padding: var(--sections-padding, 16px 30px);
    border-left: var(--sections-border-left-width, 1px) var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    border-bottom: var(--sections-border-bottom-width, 1px) var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    border-right: var(--sections-border-right-width, 1px) var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    border-top: var(--sections-border-top-width, 1px) var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    border-radius: var(--sections-border-radius, 3px)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab__add-payment-method #add_payment_method #payment .payment_methods {
    padding: 0;
    border-bottom: var(--tables-divider-border-width, 1px) var(--tables-divider-border-type, solid) var(--tables-divider-border-color, #d4d4d4)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab__add-payment-method #add_payment_method #payment #place_order {
    background: #5bc0de;
    border: none;
    color: var(--forms-buttons-normal-text-color, #fff);
    border-radius: var(--forms-buttons-border-radius, 3px);
    padding: var(--forms-buttons-padding, 12px 32px)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab__add-payment-method #add_payment_method #payment #place_order:hover {
    color: var(--forms-buttons-hover-text-color, #fff);
    transition-duration: var(--forms-buttons-hover-transition-duration, .3s)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-MyAccount-content>div>p {
    color: var(--general-text-color, #69727d)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .select2-container--default {
    border-radius: var(--forms-fields-border-radius, 0);
    background-color: var(--forms-fields-normal-background-color, #f9fafa)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .select2-container--default .select2-selection--single {
    color: var(--forms-fields-normal-color, #69727d);
    background-color: var(--forms-fields-normal-background-color, #f9fafa);
    border-radius: var(--forms-fields-border-radius, 0);
    border: none;
    height: 45px;
    margin: 0
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .select2-container--default .select2-selection--single:focus {
    color: var(--forms-fields-focus-color, #69727d);
    background-color: var(--forms-fields-focus-background-color, #f9fafa);
    border-color: initial;
    transition-duration: var(--forms-fields-focus-transition-duration, .3s)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: var(--forms-fields-normal-color, #69727d)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: var(--forms-fields-normal-color, #69727d);
    line-height: 45px;
    padding-left: 1rem;
    padding-right: 1rem
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 45px
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .select2-container--open .select2-dropdown--below {
    background-color: var(--forms-fields-normal-background-color, #f9fafa)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce ::-moz-placeholder {
    color: var(--forms-fields-normal-color, inherit);
    font-family: inherit;
    opacity: .6
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce ::placeholder {
    color: var(--forms-fields-normal-color, inherit);
    font-family: inherit;
    opacity: .6
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-message {
    font-size: 14px
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce address {
    color: var(--general-text-color, #69727d)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce a {
    color: var(--links-normal-color, #5bc0de)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce a:hover {
    color: var(--links-hover-color, #5bc0de)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce a.button.alt:hover,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce a.button:hover {
    background-color: initial
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce em {
    font-size: 12px;
    color: var(--login-messages-color, #69727d)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .form-row {
    padding-left: var(--forms-columns-gap-padding-left, 0);
    padding-right: var(--forms-columns-gap-padding-right, 0);
    margin-left: var(--forms-columns-gap-margin-left, 0);
    margin-right: var(--forms-columns-gap-margin-right, 0);
    margin-bottom: var(--forms-rows-gap, 6px)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .form-row label {
    color: var(--forms-labels-color, #69727d);
    margin-bottom: var(--forms-label-spacing, 0)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .form-row .input-text,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .form-row select {
    color: var(--forms-fields-normal-color, #69727d);
    border-radius: var(--forms-fields-border-radius, 0);
    padding: var(--forms-fields-padding, 16px);
    background: #f9fafa;
    border: none;
    font-size: 14px
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .form-row .input-text:focus,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .form-row select:focus {
    color: var(--forms-fields-focus-color, #69727d);
    border-color: #69727d;
    transition-duration: var(--forms-fields-focus-transition-duration, .3s)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce #billing_address_1_field {
    margin-bottom: 5px
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .login .woocommerce-privacy-policy-text,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .register .woocommerce-privacy-policy-text {
    margin-bottom: 15px;
    color: var(--login-messages-color, #69727d);
    font-size: 12px
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .login p:not([class]),
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .register p:not([class]) {
    color: var(--login-messages-color, #69727d);
    font-size: 12px;
    margin-top: 10px
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .login .woocommerce-LostPassword,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .register .woocommerce-LostPassword {
    font-size: 12px;
    margin-bottom: 0
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .woocommerce-ResetPassword {
    width: 50%
}

@media (max-width: 1024px) {
    .elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .woocommerce-ResetPassword {
        width: 100%
    }
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .woocommerce-ResetPassword p {
    color: var(--general-text-color, #69727d)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .woocommerce-ResetPassword .form-row-first {
    width: 100%
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .login,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .register,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .woocommerce-ResetPassword {
    background-color: var(--sections-background-color, #fff);
    padding: var(--sections-padding, 16px 30px);
    border-left: var(--sections-border-left-width, 1px) var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    border-bottom: var(--sections-border-bottom-width, 1px) var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    border-right: var(--sections-border-right-width, 1px) var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    border-top: var(--sections-border-top-width, 1px) var(--sections-border-type, solid) var(--sections-border-color, #d5d8dc);
    border-radius: var(--sections-border-radius, 3px);
    font-size: 14px
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .login .button,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .register .button,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .woocommerce-ResetPassword .button {
    background: #5bc0de;
    border: none;
    color: var(--forms-buttons-normal-text-color, #fff);
    border-radius: var(--forms-buttons-border-radius, 3px);
    padding: var(--forms-buttons-padding, 12px 32px)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .login .button:hover,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .register .button:hover,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .woocommerce-ResetPassword .button:hover {
    color: var(--forms-buttons-hover-text-color, #fff);
    transition-duration: var(--forms-buttons-hover-transition-duration, .3s)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .login p:nth-child(3) {
    margin-top: 20px
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .woocommerce-form__input-checkbox {
    vertical-align: middle
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce p:last-of-type {
    margin-bottom: 0
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .woocommerce-form__label-for-checkbox span {
    color: var(--checkboxes-color, #69727d)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce td,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce th,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce tr {
    border: none
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce h2,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce h3 {
    color: var(--typography-section-titles-color, #000);
    margin-top: 0;
    margin-bottom: var(--section-title-spacing, 45px);
    font-weight: 400
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce strong {
    color: var(--general-text-color, #000)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .wc-item-meta,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce strong.wc-item-meta-label {
    color: var(--variations-color, #69727d)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .product-quantity {
    font-weight: 400;
    color: var(--tables-items-color, #69727d)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .woocommerce-order-downloads {
    margin-bottom: 0
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-MyAccount-content-wrapper {
    font-size: 14px
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-MyAccount-content p:last-of-type {
    margin-bottom: 0
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-MyAccount-content h2:first-of-type {
    margin-top: 30px
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-MyAccount-content mark {
    background-color: transparent;
    font-weight: 700;
    color: var(--general-text-color, #000)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce caption+thead tr:first-child td,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce caption+thead tr:first-child th,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce colgroup+thead tr:first-child td,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce colgroup+thead tr:first-child th {
    border-top: 0
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce thead:first-child tr:first-child td,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce thead:first-child tr:first-child th {
    border-top: 0;
    padding-left: 0;
    padding-top: 0;
    padding-bottom: var(--tables-titles-spacing, 9px)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce tbody>tr:nth-child(2n)>td,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce tbody>tr:nth-child(2n)>th,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce tbody>tr:nth-child(odd)>td,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce tbody>tr:nth-child(odd)>th {
    background-color: transparent;
    padding-left: 0;
    padding-top: var(--order-summary-rows-gap-top, 9px);
    padding-bottom: var(--order-summary-rows-gap-bottom, 9px);
    color: var(--tables-items-color, #69727d)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce tbody .woocommerce-orders-table__cell.woocommerce-orders-table__cell-order-number>a {
    color: var(--tables-links-normal-color, #5bc0de)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce tbody .woocommerce-orders-table__cell.woocommerce-orders-table__cell-order-number>a:hover {
    color: var(--tables-links-hover-color, #5bc0de)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .shop_table {
    font-size: 14px
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .shop_table .button {
    background: transparent;
    border-radius: var(--tables-button-border-radius, 3px);
    border: 2px var(--tables-buttons-border-type, solid) var(--tables-buttons-border-color, #5bc0de);
    vertical-align: middle;
    color: var(--tables-button-normal-text-color, #69727d);
    padding: var(--tables-button-padding, 5px 10px)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .shop_table .button:hover {
    transition-duration: var(--tables-button-hover-transition-duration, .3s)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .shop_table td,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .shop_table th {
    border-top: var(--tables-divider-border-width, 1px) var(--tables-divider-border-type, solid) var(--tables-divider-border-color, #d5d8dc)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .shop_table thead tr th,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .shop_table thead tr th span {
    color: var(--tables-title-color, #000)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .order_details tfoot td,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .order_details tfoot th {
    padding-left: 0;
    color: var(--tables-title-color, #000)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .order_details .download-product a,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .order_details .product-name a {
    color: var(--tables-links-normal-color, #5bc0de)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .order_details .download-product a:hover,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .order_details .product-name a:hover {
    color: var(--tables-links-hover-color, #5bc0de)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .order_details .product-purchase-note td {
    border-top: none;
    padding-top: 0
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .order-again .button {
    background: transparent;
    border: 2px solid #5bc0de;
    border: 2px var(--tables-buttons-border-type, solid) var(--tables-buttons-border-color, #5bc0de);
    border-radius: var(--tables-button-border-radius, 3px);
    vertical-align: middle;
    color: var(--tables-button-normal-text-color, #69727d);
    margin-top: 0;
    margin-bottom: 0;
    padding: var(--tables-button-padding, 12px 32px)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .order-again .button:hover {
    transition-duration: var(--tables-button-hover-transition-duration, .3s)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-Address .title h3,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-Addresses .title h3 {
    float: none
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-Address address,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-Addresses address {
    padding: var(--sections-padding, 45px 30px 16px 30px)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-Address .edit,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-Addresses .edit {
    float: left;
    position: absolute;
    margin-left: var(--edit-link-margin-start, 30px);
    margin-top: var(--edit-link-margin-top, 10px)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce .u-columns {
    margin-top: 20px
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-address-fields fieldset,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-EditAccountForm fieldset {
    border: none;
    padding: 0;
    margin-inline-start: 0
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-address-fields fieldset legend,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-EditAccountForm fieldset legend {
    font-weight: 700;
    padding: 20px 0;
    color: var(--general-text-color, #000)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-address-fields .button,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-EditAccountForm .button {
    background: #5bc0de;
    border: none;
    color: var(--forms-buttons-normal-text-color, #fff);
    border-radius: var(--forms-buttons-border-radius, 3px);
    padding: var(--forms-buttons-padding, 12px 32px);
    margin-top: 20px
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-address-fields .button:hover,
.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-EditAccountForm .button:hover {
    color: var(--forms-buttons-hover-text-color, #fff);
    transition-duration: var(--forms-buttons-hover-transition-duration, .3s)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-pagination {
    padding: 16px 0
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-pagination .button {
    background: transparent;
    border-radius: var(--tables-button-border-radius, 3px);
    border: 2px var(--tables-buttons-border-type, solid) var(--tables-buttons-border-color, #5bc0de);
    vertical-align: middle;
    color: var(--tables-button-normal-text-color, #69727d);
    padding: var(--tables-button-padding, 5px 10px)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-pagination .button:hover {
    transition-duration: var(--tables-button-hover-transition-duration, .3s)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab:not(.e-my-account-tab__dashboard--custom) .woocommerce-OrderUpdates {
    color: var(--general-text-color, #69727d)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab .woocommerce .woocommerce-MyAccount-navigation {
    float: left;
    width: 25%
}

@media (max-width: 1024px) {
    .elementor-widget-woocommerce-my-account .e-my-account-tab .woocommerce .woocommerce-MyAccount-navigation {
        width: 100%
    }
}

.elementor-widget-woocommerce-my-account .e-my-account-tab .woocommerce .woocommerce-MyAccount-navigation ul {
    padding-inline-start: 0
}

.elementor-widget-woocommerce-my-account .e-my-account-tab .woocommerce .woocommerce-MyAccount-navigation ul li {
    list-style-type: none;
    display: inline-block;
    width: var(--tab-width, 100%)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab .woocommerce .woocommerce-MyAccount-navigation ul li:after {
    content: "";
    display: block;
    width: 100%;
    background-color: var(--tabs-divider-color, #69727d);
    height: var(--tabs-divider-weight, 0);
    position: relative;
    top: calc(var(--tabs-spacing, 2px) / 2)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab .woocommerce .woocommerce-MyAccount-navigation ul li.is-active a {
    color: var(--tabs-active-color, #5bc0de);
    background: #f1f2f3;
    border-color: var(--tabs-active-border-color, transparent)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab .woocommerce .woocommerce-MyAccount-navigation ul li a {
    font-style: normal;
    font-weight: 700;
    font-size: 14px;
    color: var(--tabs-normal-color, #69727d);
    display: block;
    padding: var(--tabs-padding, 12px 20px);
    text-align: var(--tabs-alignment, start);
    background: #f9fafa;
    border-radius: var(--tabs-border-radius, 0);
    border: 0 var(--tabs-border-type, solid) var(--tabs-border-color, transparent)
}

.elementor-widget-woocommerce-my-account .e-my-account-tab .woocommerce .woocommerce-MyAccount-navigation ul li a:hover {
    color: var(--tabs-hover-color, #5bc0de);
    border-color: var(--tabs-hover-border-color, transparent)
}

@media (max-width: 1024px) {
    .elementor-widget-woocommerce-my-account .e-my-account-tab .woocommerce .woocommerce-MyAccount-navigation ul li a {
        padding: var(--tabs-padding, 10px)
    }
}

.elementor-widget-woocommerce-my-account .e-my-account-tab .woocommerce .woocommerce-MyAccount-navigation ul li.woocommerce-MyAccount-navigation-link--customer-logout {
    margin-bottom: 0
}

.elementor-widget-woocommerce-my-account .e-my-account-tab .woocommerce .woocommerce-MyAccount-navigation ul li.woocommerce-MyAccount-navigation-link--customer-logout:after {
    display: none
}

.elementor-widget-woocommerce-my-account .woocommerce-table__line-item.order_item .woocommerce-table__product-name.product-purchase-note-is-below,
.elementor-widget-woocommerce-my-account .woocommerce-table__line-item.order_item .woocommerce-table__product-total.product-total.product-purchase-note-is-below {
    padding-bottom: 0
}

.elementor-widget-woocommerce-my-account .e-my-account-tab__view-order .shop_table td {
    vertical-align: top;
    line-height: unset
}

.elementor-widget-woocommerce-my-account .woocommerce-MyAccount-paymentMethods .woocommerce-PaymentMethod--actions {
    text-align: right
}

.elementor-widget-woocommerce-my-account .woocommerce-PaymentMethod .input-radio {
    vertical-align: middle
}

.elementor-widget-woocommerce-my-account .woocommerce-PaymentMethod .input-radio+label {
    color: var(--payment-methods-radio-buttons-color, #69727d)
}

.e-wc-account-tabs-nav .woocommerce-MyAccount-navigation ul li {
    display: inline-block
}

.e-my-account-tabs-vertical .woocommerce-MyAccount-navigation {
    display: block
}

.e-my-account-tabs-vertical .woocommerce-MyAccount-navigation li {
    margin: calc(var(--tabs-spacing, 2px) / 2) 0 calc(var(--tabs-spacing, 2px) / 2) 0
}

.e-my-account-tabs-vertical .woocommerce-MyAccount-navigation li.woocommerce-MyAccount-navigation-link--dashboard {
    margin-top: 0
}

.e-my-account-tabs-vertical .e-wc-account-tabs-nav .woocommerce-MyAccount-navigation {
    display: none
}

.e-my-account-tabs-horizontal .e-my-account-tab .woocommerce .woocommerce-MyAccount-navigation {
    float: none;
    width: 100%
}

.e-my-account-tabs-horizontal .e-my-account-tab .woocommerce .woocommerce-MyAccount-navigation ul li:after {
    display: none
}

.e-my-account-tabs-horizontal .e-my-account-tab .woocommerce .woocommerce-MyAccount-content {
    float: none;
    width: 100%;
    padding: var(--tab-content-spacing, 50px) 0 0 0
}

@media (max-width: 1024px) {
    .e-my-account-tabs-horizontal .e-my-account-tab .woocommerce .woocommerce-MyAccount-content {
        width: 100%;
        padding: var(--tab-content-spacing, 6%) 0 0 0
    }
}

.e-my-account-tabs-horizontal .woocommerce-MyAccount-navigation {
    display: none
}

.e-my-account-tabs-horizontal .e-wc-account-tabs-nav .woocommerce-MyAccount-navigation {
    display: block
}

.e-my-account-tabs-horizontal .e-wc-account-tabs-nav .woocommerce-MyAccount-navigation ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: var(--tabs-container-justify-content, space-between)
}

@media (max-width: 767px) {
    .e-my-account-tabs-horizontal .e-wc-account-tabs-nav .woocommerce-MyAccount-navigation ul {
        display: block
    }
}

.e-my-account-tabs-horizontal .e-wc-account-tabs-nav .woocommerce-MyAccount-navigation ul li {
    display: inline-block;
    width: var(--tab-width, 100%);
    padding: 0 calc(var(--tabs-spacing, 2px) / 2) 0 calc(var(--tabs-spacing, 2px) / 2);
    margin: 0;
    border-right: var(--tabs-divider-weight, 0) solid var(--tabs-divider-color, #69727d)
}

.e-my-account-tabs-horizontal .e-wc-account-tabs-nav .woocommerce-MyAccount-navigation ul li:first-of-type {
    padding-left: 0
}

.e-my-account-tabs-horizontal .e-wc-account-tabs-nav .woocommerce-MyAccount-navigation ul li:last-of-type {
    padding-right: 0;
    border-right-width: 0
}

@media (max-width: 767px) {
    .e-my-account-tabs-horizontal .e-wc-account-tabs-nav .woocommerce-MyAccount-navigation ul li {
        margin: calc(var(--tabs-spacing, 2px) / 2) 0 calc(var(--tabs-spacing, 2px) / 2) 0;
        display: inline-block;
        width: 100%
    }
}

.elementor-editor-active tr:not(:first-child) .woocommerce-orders-table__cell-order-number a,
.elementor-editor-preview tr:not(:first-child) .woocommerce-orders-table__cell-order-number a {
    pointer-events: none
}

.elementor-editor-active tr:not(:first-child) .woocommerce-orders-table__cell-order-actions .button,
.elementor-editor-preview tr:not(:first-child) .woocommerce-orders-table__cell-order-actions .button {
    pointer-events: none;
    opacity: .3
}

.elementor-editor-active .elementor-widget-woocommerce-my-account .woocommerce-MyAccount-content:not(:first-of-type) {
    display: none
}

.product .count {
    background-color: inherit
}

.elementor-widget-woocommerce-notices .e-woocommerce-notices-wrapper.e-woocommerce-notices-wrapper-loading *,
.elementor-widget-woocommerce-product-additional-information:not(.elementor-show-heading-yes) h2 {
    display: none
}

.elementor-widget-woocommerce-notices .woocommerce-error,
.elementor-widget-woocommerce-notices .woocommerce-info,
.elementor-widget-woocommerce-notices .woocommerce-message,
.elementor-widget-woocommerce-notices .woocommerce-notices-wrapper,
.elementor-widget-woocommerce-notices .woocommerce .is-error,
.elementor-widget-woocommerce-notices .woocommerce .is-info,
.elementor-widget-woocommerce-notices .woocommerce .is-success {
    display: block
}

.e-preview--show-hidden-elements:not(.elementor-editor-active) .elementor-widget-woocommerce-notices .e-notices-demo-notice {
    display: none
}

.woocommerce div.product.elementor form.cart div.product-addon {
    flex-basis: 100%;
    flex-shrink: 0
}

.e-sticky-right-column--active {
    position: sticky;
    top: 0
}

body {
    font-family: 'Fira Sans';
}

.white-link a {
    color: #fff;
}

.woocommerce h3 {
    font-size: 18px;
    font-weight: 700;
    margin-top: 0;
    margin-bottom: 20px;
    color: #fff;
    background-color: #282828;
    padding: 20px;
    line-height: 18px;
    font-family: 'Fira Sans';
}

.woocommerce-billing-fields__field-wrapper {
    padding: 0 20px;
}

h3#ship-to-different-address {
    background-color: #fff;
    color: #282828;
    font-size: 14px;
    line-height: 25px;
    font-weight: 300;
    text-transform: normal;
}

.e-checkout__column.e-checkout__column-start #customer_details.col2-set .col-1 {
    padding: 0;
}

.e-checkout__order_review {
    padding: 0 !important;
}

.checkout-upsell-product {
    border: 1px solid #EEEEEE;
    background-color: #FBFBFB;
}

.checkout-upsell-content {
    padding: 0 20px;
}

.checkout-upsell-product h3 {
    border: 1px solid #ccc;
    margin-bottom: 20px;
}

#order_review.woocommerce-checkout-review-order {
    padding: 0 20px 20px;
}

input[type="checkbox"]:checked {
    accent-color: #1FB25A;
}

.rf-custom-upsell {
    display: block;
    align-items: center;
    justify-content: start;
    margin-bottom: 20px;
    background-color: #FBFBFB;
    height: fit-content;
    padding: 20px 5px;
    background: #B1E4C5;
}

.rf-custom-upsell .rf-upsell-image {
    flex-basis: 40%;
    text-align: center;
}

.rf-custom-upsell .rf-upsell-info {
    flex-basis: 60%;
    padding-left: 20px;
    text-align: left;
}

.rf-custom-upsell .rf-upsell-content {
    display: flex;
    align-items: center;
    justify-content: start;
}

.rf-upsell-product-title {
    font-family: "Fira Sans", Sans-serif;
    font-size: 18px;
    font-weight: 700;
    line-height: 28px;
    color: #282828;
    margin-bottom: 0;
}

.rf-upsell-product-short-desc {
    font-family: "Fira Sans", Sans-serif;
    color: #282828;
    font-weight: 300;
}

.rf-upsell-product-price {
    font-family: "Fira Sans", Sans-serif;
    color: #282828;
    font-weight: 700;
    font-size: 17px;
}

.rf-checkout-upsell-btn {
    font-family: "Fira Sans", Sans-serif;
    font-size: 16px;
    font-weight: 700;
    text-transform: uppercase;
    line-height: 25px;
    background-color: #1FB15A;
    color: #fff !important;
    border-radius: 90px 90px 90px 90px;
    padding: 10px 20px 10px 20px;
}

.woocommerce-shipping-fields__field-wrapper label {
    display: none !important;
}

#shipping_country_field {
    display: none;
}

.woocommerce-additional-fields__field-wrapper label {
    display: none !important;
}

.e-coupon-anchor label {
    display: none !important;
}

/* CHECKOUT - COUPON CODE SECTION */

.e-coupon-box {
    margin-top: 20px !important;
}

.e-coupon-anchor {
    display: block !important;
}

.col.coupon-col-2 {
    border: 1px solid #EEEEEE;
    background-color: #fff;
}

.woocommerce-button.button.e-apply-coupon {
    color: #1FB25A !important;
    font-size: 16px;
    line-height: 19px;
    font-weight: 700;
    text-transform: uppercase;
    border: none !important;
}

.rf-woocommerce-additional-fields__field-wrapper {
    background: #f9f9f9;
    padding: 20px;
    margin-top: 20px;
    border: 1px solid #eee;
}

.e-checkout__column.e-checkout__column-end {
    width: 46vh;
}

/* MOBILE */

@media (max-width: 768px) {
    .rf-custom-upsell {
        flex-direction: column;
    }

    .rf-custom-upsell .rf-upsell-image,
    .rf-custom-upsell .rf-upsell-info {
        flex-basis: 100%;
        text-align: center;
    }

    .rf-custom-upsell .rf-upsell-info {
        padding-left: 0;
        padding-top: 20px;
    }

    .rf-custom-upsell .rf-upsell-content {
        flex-wrap: wrap;
    }

    .rf-upsell-image img {
        max-width: 70%;
    }
}

h2,
.elementor-widget-heading .elementor-heading-title {
    color: #282828;
    font-weight: bold;
    font-size: 40px;
    margin-block-end: 0.5rem;
}

.greenCheckList ul {
    padding-left: 10px;
}

.greenCheckList ul li {
    list-style-type: none;
    margin-bottom: 5px;
    margin-top: 5px;
    display: block;
    font-weight: bold;
    color: black;
}

.greenCheckList ul li:before {
    content: "";
    width: 19px;
    height: 19px;
    display: inline-block;
    background-image: url('/wp-content/uploads/2024/03/checkGreen-1.svg');
    top: 4px;
    left: -8px;
    position: relative;
}

.greenCheckList.checkPlus ul li {
    font-weight: 300;
}

.greenCheckList.checkPlus ul li:before {
    background-image: url('/wp-content/uploads/2024/03/checkPlus.svg');
}

.greenCheckList.checkMinus ul li {
    font-weight: 300;
}

.greenCheckList.checkMinus ul li:before {
    background-image: url('/wp-content/uploads/2024/03/checkMinus.svg');
}

.minitp p {
    color: #272727
}

.minitp p strong {
    color: #282828;
    font-size: 21px;
}

.factSlider h3 {
    font-size: 21px !important;
}

.factSlider img {
    height: 85px;
    width: 170px;
    object-fit: cover;
}

.factSlider p {
    font-weight: 300;
    color: #707070;
}

.woocommerce div.product div.images .flex-control-thumbs li {
    width: 16.666666%;
    float: left;
}

.woocommerce div.product .woocommerce-product-gallery--columns-6 .flex-control-thumbs li:nth-child(6n+1) {
    float: none;
}

.woocommerce div.product .woocommerce-product-gallery--columns-6 .flex-control-thumbs li:first-child {
    float: left;
}

.flex-control-nav.flex-control-thumbs {
    margin-top: 20px;
}

.txtimgBlock {
    margin-left: 0;
}

html {
    overflow-x: hidden;
}

div.product.elementor>div.elementor-element .e-con-inner {
    width: 100% !important;
    max-width: 1685px;
}

.product-template-default .elementor-element>.e-con-inner {
    padding-block-start: 40px;
    padding-block-end: 20px;
}

.translate {
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
    max-width: 1685px;
}

@media (max-width: 768px) {
    .woocommerce span.onsale {
        margin-top: 110px !important;
        width: 45px;
        height: 45px;
        font-size: 18px;
    }
}

div#customer_details+div {
    display: none;
}

div#checkoutOfferHolder {
    display: none;
}

div.select-shipping {
    display: none;
}

div#delivery-option {
    display: none;
}

tr.woocommerce-shipping-totals.shipping {
    display: none;
}

.woocommerce table.shop_table tbody th,
.woocommerce table.shop_table tfoot td,
.woocommerce table.shop_table tfoot th {
    border-top-width: 0;
    border-color: transparent;
}

div#customer_details {
    display: none;
}

body .woocommerce-checkout #payment #place_order {
    background-color: #1FB25A;
    font-family: "Fira Sans", Sans-serif;
    font-size: 18px;
    line-height: 22px;
    border-radius: var(--purchase-button-border-radius, 100px);
    color: var(--purchase-button-normal-text-color, #fff);
    float: none;
    width: auto;
    display: inline-block;
    margin: 0 auto;
    padding: 15px 60px;
}
</style>

<script>
jQuery(document).ready(function($) {
    // This function triggers when WooCommerce updates the checkout/order review section
    $(document.body).on('updated_checkout', function() {
        // Add the class 'expanded' to the div with ID 'order_review_heading_inner'
        // $('#order_review_heading_inner').addClass('expanded');
    });
});
</script>

<div id="checkout-container" style="padding: 20px;">
    <?php


    // Check if the 'oid' and 'method' parameters are set in the URL
    if (isset($_GET['oid']) && isset($_GET['method'])) {
        $oid = intval($_GET['oid']);   // Sanitize and get 'oid'
        $method = sanitize_text_field($_GET['method']); // Sanitize and get 'method'
        
        // Use the parameters
        // echo 'Order ID: ' . $oid     . '<br>';
        // echo 'Payment Method: ' . $method;
    } 

    // Main content of the page
    while (have_posts()) : the_post();
        the_content();
    endwhile;
    ?>
</div>

<?php
// Optionally include footer scripts but remove the actual footer display
?>
<script>
// Add any specific JS if needed
</script>

<?php
// Do NOT load the footer template
wp_footer(); // Commenting out this line removes the footer