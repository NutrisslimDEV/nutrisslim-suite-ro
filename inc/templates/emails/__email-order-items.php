<?php
/**
 * Email Order Items
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-items.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
global $language_code;
$language_code = $order->get_currency();
global $currentLanguage; global $currentLanguage2; global $wcml; global $woocommerce_wpml; global $translation_language;
  /* $wcml = new woocommerce_wpml(); */ $wcml = $woocommerce_wpml;
__('Prenesi e-knjigo','naturesfinest');

if(defined('INSTANCENAME')){
	if(INSTANCENAME == 'NF1' || INSTANCENAME == 'NF2' || INSTANCENAME == 'NF3'){
		$theme_color = '#1fb25a';
	} else if(INSTANCENAME == 'BABE1'){
		$theme_color = '#EC535A';
	}
}
switch ($language_code) {
    /* case 'eeu':
        $currentLanguage = 'eu';
        $currentLanguage2 = 'EU';
        break; */
    case 'eel': //GREECE
        $currentLanguage = 'el';
        $currentLanguage2 = 'GR';
        break;
    case 'ede':
        $currentLanguage = 'de';
        $currentLanguage2 = 'DE';
        break;
    case 'ees':
        $currentLanguage = 'es';
        $currentLanguage2 = 'ES';
        break;
    case 'eat':
        $currentLanguage = 'at';
        $currentLanguage2 = 'AT';
        break;
    case 'efr':
        $currentLanguage = 'fr';
        $currentLanguage2 = 'FR';
        break;
    case 'eie':
        $currentLanguage = 'ie';
        $currentLanguage2 = 'IE';
        break;
    case 'eit':
        $currentLanguage = 'it';
        $currentLanguage2 = 'IT';
        break;
    case 'enl':
        $currentLanguage = 'nl';
        $currentLanguage2 = 'NL';
        break;
    case 'ept':
        $currentLanguage = 'pt-pt';
        $currentLanguage2 = 'PT';
        break;
    case 'esk':
        $currentLanguage = 'sk';
        $currentLanguage2 = 'SK';
        break;
    case 'ebe':
        $is_multilang = $order->get_meta('_multilang');
        if($is_multilang == 'true'){
            $used_language = $order->get_meta('_used_language');
        } else{
            $used_language = 'nl';
        }
        $currentLanguage = $used_language; // set this to fr for the time beeing but we need to figure it out how to set it based on the language that was used on checkout
        $currentLanguage2 = 'BE';
        break;
    case 'EUR':
        $currentLanguage = 'sl';
        $currentLanguage2 = 'SI';
        break;
    case 'CZK':
        $currentLanguage = 'cs';
        $currentLanguage2 = 'CZ';
        break;
    case 'HUF':
        $currentLanguage = 'hu';
        $currentLanguage2 = 'HU';
        break;
    case 'ehr':
        $currentLanguage = 'hr';
        $currentLanguage2 = 'HR';
        break;
    case 'GBP':
        $currentLanguage = 'en';
        $currentLanguage2 = 'GB';
        break;
    case 'PLN':
        $currentLanguage = 'pl';
        $currentLanguage2 = 'PL';
        break;
    case 'RON':
        $currentLanguage = 'ro';
        $currentLanguage2 = 'RO';
        break;
    case 'DKK':
        $currentLanguage = 'da';
        $currentLanguage2 = 'DK';
        break;
    case 'SEK':
        $currentLanguage = 'sv';
        $currentLanguage2 = 'SE';
        break;
    // SWITZERALND
    case 'CHF':
        $currentLanguage = $order->get_meta('_used_language'); // set this to fr for the time beeing but we need to figure it out how to set it based on the language that was used on checkout
        $currentLanguage2 = 'CH';
        break;
    default:
      $currentLanguage = 'sl';
      $currentLanguage2 = 'SI';
      break;
      
  }
  $currency_symbol = get_currency_code($currentLanguage);
  $currency = array(
    'currency'           => $currency_symbol,
    );
$text_align = is_rtl() ? 'right' : 'left';
$color1 = '#ffffff';
$color2 = '#f5f5f5';
$color = $color1;
$c = 1;
$divider = false;
$order_has_yith_offer_discount = false;
if(get_post_meta($order->get_id(), '_yithDiscountRate')){
    $order_has_yith_offer_discount = true;
    $yithDiscountRate = get_post_meta($order->get_id(), '_yithDiscountRate')[0];
}
foreach($order->get_items() as $order_itemX) {
    $order_item_type = wc_get_order_item_meta( $order_itemX->get_id(),'_product_type');
    if($order_item_type != 'bundle_child'){
    $itemX_ID = $order_itemX["_item_id"];
    $itemX_varID = $order_itemX["variation_id"];
    $itemX_quantity = $order_itemX["quantity"];
    $itemX = wc_get_product($itemX_varID);
    $itemXparent = wc_get_product($itemX_ID);
    $itemXname = $order_itemX['_item_name'];
    $instructions_manual = get_field('instructions_manual',$itemX_ID);
    $itemXprice = $order_itemX['subtotal'] + $order_itemX['tax'];

    global $product_id; global $product_custom; global $p_price; global $p_sale_price;
    global $p_regular_price; global $p_discount; global $p_tax_rate; global $p_price_without_eur;

    $product_id = $order_itemX->get_meta('_item_id');
    $product_custom = wc_get_product($product_id);
    if($product_custom != false){
        get_template_part('partials/product-single/product_data-simple');
    }
    if($order_has_yith_offer_discount == true){
        if($order_itemX->get_meta('_product_type') == 'yith_bundle'){
            if(get_post_meta($order->get_id(), '_yith_offer_price')){
                $itemXprice = get_post_meta($order->get_id(), '_yith_offer_price')[0] / $itemX_quantity;
            } else{
                $itemXprice = ($order_itemX->get_subtotal() + $order_itemX->get_subtotal_tax()) / $itemX_quantity;
            }
        }
    } else{
        $itemXprice = ($order_itemX->get_subtotal() + $order_itemX->get_subtotal_tax()) / $itemX_quantity;
    }
    if($order_itemX['bundled_items']){
        $is_bundle_parent = true;
    } else{
        $is_bundle_parent = false;
    }

    $itemXsubtotal = wc_price($itemXprice * $itemX_quantity, $currency);
    if($order_itemX['bundled_by']){
        if($divider == false){
            ?><?php
            $divider = true;
        }
        $is_bundle_child = true;
    } else{
        if($divider == true){
            ?><div class="bundled-items" style="padding-bottom:0px; background-color:<?= $color; ?>; background-color:transparent;">
            <div class="block-grid three-up no-stack" style="Margin: 0 auto; min-width: 320px; min-height:20px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: <?= $color; ?>;">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color:<?= $color; ?>;"></div></div></div><?php
            $divider = false;
        }
        $is_bundle_child = false;
    }
    if(($c == 1) && ($is_bundle_child == false)){
        $color = $color1;
        $c = 0;
    } else{
        if($is_bundle_child != true){
            $color = $color2;
            $c = 1;
        }
    }
  ?>

  <div style="background-color:transparent;">
    <div class="block-grid three-up no-stack" style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: <?= $color; ?>;">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:<?= $color; ?>;">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;">
            <tr>
                <td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px">
            <tr class="layout-full-width" style="background-color:<?= $color; ?>">
                <td align="center" width="206" style="background-color:<?= $color; ?>;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent;" valign="top">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;">
                <?php if($is_bundle_child == false){ ?>
                <div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: middle;">
                <?php } else { ?>
                <div class="col num4" style="max-width: 410px; min-width: 410px; display: table-cell; vertical-align: middle;">
            <?php } ?>
                <div style="width:100% !important;">
                <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
            <?php if($is_bundle_child == false){ 
        if($is_bundle_parent == true){ ?>
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td style="padding-right: 10px; padding-left: 22px; padding-top: 22px; padding-bottom: 0px; font-family: 'Trebuchet MS', Tahoma, sans-serif">
                <div style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%; padding-right:0px;padding-bottom: 0px;padding-left:0px;">
        <?php }else{ ?>
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td style="padding-right: 10px; padding-left: 22px; padding-top: 22px; padding-bottom: 0px; font-family: 'Trebuchet MS', Tahoma, sans-serif">
                <div style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%; padding-right:0px;padding-bottom: 0px;padding-left:0px;">
        <?php } ?>
    <?php } else { ?>
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td style="padding-right: 10px; padding-left: 22px; padding-top: 22px; padding-bottom: 0px; font-family: 'Trebuchet MS', Tahoma, sans-serif">
                <div style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%; padding-right:0px;padding-bottom:0px;padding-left: 0px;">
            <?php } ?>
                <div style=" padding-top: 0px; padding-bottom: 0; font-size: 12px; line-height: 15px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
    <?php if($is_bundle_child == false){ ?>
        <p style="font-size: 15px; line-height: 19px; margin: 0px auto; padding-bottom: 10px;"><strong><?= $itemXname; ?></strong>

        <?php
        if ($instructions_manual) {
            ?>
            <div class="py-4">
                <a style="font-size: 15px; line-height: 19px; margin: 0px auto; padding-bottom: 10px; color: <?= $theme_color; ?>;" href="<?= $instructions_manual;?>" target="_blank"><?= apply_filters( 'wpml_translate_single_string', 'Prenesi e-knjigo', 'naturesfinest', 'Prenesi e-knjigo', $translation_language );?></a><br>
            </div>
            <?php } ?>
            </p>
        <?php if(get_field('is_bundle',$itemX_ID) == 'yes'){
                $bundle_children = get_field('bundled_products',$itemX_ID);
                
                if($bundle_children){
                    $first_child = true;
                    foreach($bundle_children as $bundle_child){
                        if($first_child == true){
                            $margin_top = 'margin-top:10px;';
                            $first_child = false;
                        } else{
                            $margin_top = '';
                        }
                 
                        ?><p style="font-size: 14px; line-height: 19px; margin: 0px auto; padding-bottom: 10px;"><?= get_the_title($bundle_child['product']); ?></p><?php
                    }
                }
              
  
            } ?>
    <?php } else { ?>
        <p style="font-size: 14px; line-height: 19px; margin: 0px auto; padding-bottom: 10px;"><?= $itemXname; ?></p>
    <?php } ?>

    </div>

    </div>

    </td>

</tr></table>
    </div>
</td></tr></table>
    <?php if($is_bundle_child == false){ ?>
<td align="center" width="206" style="background-color:<?= $color; ?>;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent;" valign="top">
<table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
<tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;">
    <div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: middle;">
    <?php } else {
        ?>
        <td align="center" width="206" style="background-color:<?= $color; ?>;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent;" valign="top">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;">
                <div class="col num4" style="max-width: 206px; min-width: 206px; display: table-cell; vertical-align: middle;">
        <?php } ?>
    <div style="width:100% !important;">
    <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
    <?php if($is_bundle_child == false){ 
        if($is_bundle_parent == true){ ?>
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td style="padding-top: 7px; padding-right: 25px; padding-left: 25px; font-family: 'Trebuchet MS', Tahoma, sans-serif">
                <div style="padding-bottom: 0; color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-right:">
        <?php } else { ?>
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td style="padding-right: 25px; padding-top: 22px; padding-left: 25px; font-family: 'Trebuchet MS', Tahoma, sans-serif">
                <div style="padding-bottom: 0; color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;">
        <?php } ?>  
    <?php } else { ?>
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <td style="padding-top: 7px; padding-right: 25px; padding-left: 25px; font-family: 'Trebuchet MS', Tahoma, sans-serif">
                <div style="padding-bottom: 0; color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;">
                
    <?php } ?>
                <td style="padding-top: 7px; padding-right: 25px; padding-left: 25px; font-family: 'Trebuchet MS', Tahoma, sans-serif">
                <div style="padding-bottom: 0; color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%; padding-right: 60px;">
                <p style="font-size: 14px; line-height: 19px; text-align: center; padding-right: 10px;"><strong><?= $itemX_quantity; ?>x</strong></p>
                <?php 
    if(get_field('is_bundle',$itemX_ID) == 'yes' && $order_itemX['_product_type'] != 'yith_child'){
            $bundle_children = get_field('bundled_products',$itemX_ID);
            if($bundle_children){
                $first_child = true;
                foreach($bundle_children as $bundle_child){
                    if($first_child == true){
                        $margin_top = 'padding-top:6px;';
                        $first_child = false;
                    } else{
                        $margin_top = 'margin-top:-4px;';

                    }
                    if (strlen($itemXname) > 27) {
                        $padding_top = 'padding-top: 25px';
                    } else {
                        $padding_top = 'padding-top:6px';
                    }
                    ?><p style="font-size: 14px; line-height: 19px; text-align: center; padding-right: 10px; <?= $padding_top; ?>"><?= $itemX_quantity * $bundle_child['quantity']; ?>x</p><?php
                }
            }
        }
        ?>
    </div>
    
    </div>
                </td></td></table>
    </div>
    </td></tr></table>
    <?php if($is_bundle_child == false){ ?>
        <td align="center" width="206" style="background-color:<?= $color; ?>;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;">
                    <div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: middle;">
                    <div style="width:100% !important;">    
                    <div style=" border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 10px;">
        <?php if($is_bundle_parent == true){ ?>
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td style="padding-right: 25px; padding-left: 25px; padding-top: 22px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif">
                    <div style=" color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top: 0px;padding-right:25px;padding-bottom: 0px;padding-left:25px; ">
        <?php }else{ ?>
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td style="padding-right: 25px; padding-left: 25px; padding-top: 22px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif">
                    <div style=" color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%; padding-top: 0px;padding-right:25px;padding-bottom: 0px;padding-left:25px;">
        <?php } ?>
        <div style=" font-size: 12px; line-height: 14px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; text-align: center;">
        <p style="font-size: 14px; line-height: 19px; margin-top: 0;"><strong><?= $itemXsubtotal; ?></strong></p>

        </div>
        </div>
        </td></tr></table>
        </div>
    </td></tr></table>
    </div>
    <?php } ?>
        </div>
    </div>
</tr></table>
    </div>
                </td></tr></table>
        </div></div>
                </div>
  <?php

    }
}
?>
