<?php
/**
 * Email Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-addresses.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 5.6.0
 */
/*
__("Davčna številka", "naturesfinest");
__( "Podatki za dostavo", "naturesfinest" ); Shipping address
__( "Podatki kupca", "naturesfinest" ); Billing address
*/
__("Tax number", "nutrisslim-suiteV2");
$theme_color = '#1fb25a';

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div style="background-color:transparent;">
    <div class="block-grid two-up"
        style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff; padding-bottom:26px;">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:#fff"><![endif]-->
            <!--[if (mso)|(IE)]><td align="center" width="310" style="background-color:#fff;width:310px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 30px; padding-top:40px; padding-bottom:20px;"><![endif]-->
            <div class="col num6" style="max-width: 320px; min-width: 310px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:20px; padding-bottom:0px; padding-right: 10px; padding-left: 30px; text-align: left;">
                        <!--<![endif]-->
                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top: 0px; padding-bottom: 0px; font-family: sans-serif"><![endif]-->
                        <div
                            style="color:<?= $theme_color; ?>;font-family:'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;line-height:150%;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;">
                            <div
                                style="line-height: 18px; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size: 12px; color: <?= $theme_color; ?>;">
                                <p style="line-height: 24px; font-size: 12px; text-align: left; margin: 0;"><span
                                        style="font-size: 14px;"><strong><?php echo __('Customer details', 'nutrisslim-suiteV2')?>:</strong></span>
                                </p>
                            </div>
                        </div>
                        <!--[if mso]></td></tr></table><![endif]-->
                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top: 0px; padding-bottom: 0px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
                        <div
                            style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:150%;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;">
                            <div
                                style="font-size: 12px; line-height: 18px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                                <p style="font-size: 14px; line-height: 19px; margin: 0;">

                                    <?php 
global $translation_language;
$billingAddress = $order->get_address(); 

$billingVatID = get_post_meta( $order->get_id(), '_billing_vat_id', true );

$billing_state_name = '';
$billing_country = $order->get_billing_country();
$billing_state = $order->get_billing_state();
if($billing_country && $billing_state){
	if(WC()->countries->get_states($billing_country)){
		$billing_state_name = WC()->countries->get_states($billing_country)[$billing_state];
	} else{
		$billing_state_name = $billing_state;
	}
}

$billing_house_number = get_post_meta( $order->get_id(), '_billing_house_number', true );

$shipping_state_name = '';
$shipping_country = $order->get_shipping_country();
$shipping_state = $order->get_shipping_state();
if($shipping_country && $shipping_state){
	if(WC()->countries->get_states($shipping_country)){
		$shipping_state_name = WC()->countries->get_states($shipping_country)[$shipping_state];
	} else{
		$shipping_state_name = $shipping_state;
	}
} 
$shipping_house_number = get_post_meta( $order->get_id(), '_shipping_house_number', true );
if(!$shipping_house_number){
	$shipping_house_number = $billing_house_number;
}


?>
                                    <?php if($billingAddress['company']){
	?>
                                    <strong><span
                                            style="font-size: 14px; line-height: 19px;"><?= $billingAddress['company']; ?></span></strong><br>
                                    <?php
} else{
	?>
                                    <strong><span
                                            style="font-size: 14px; line-height: 19px;"><?= $billingAddress['first_name']; ?>
                                            <?= $billingAddress['last_name']; ?></span></strong><br>
                                    <?php
}
if($billingVatID){
	?>
                                    <span
                                        style="font-size: 14px; line-height: 19px;"><?= apply_filters( 'wpml_translate_single_string', 'Davčna številka', 'naturesfinest', 'Davčna številka', $translation_language ) . ': ' . $billingVatID; ?></span><br>
                                    <?php
}
if($billingAddress['company']){
	?>
                                    <span
                                        style="font-size: 14px; line-height: 19px;"><?= $billingAddress['first_name']; ?>
                                        <?= $billingAddress['last_name']; ?></span><br>
                                    <?php
}
if($order_language == 'en'){
	?><span style="font-size: 14px; line-height: 19px;"><?= $billing_house_number; ?> <?= $billingAddress['address_1']; ?>
                                        <?= $billingAddress['address_2']; ?></span><br><?php
} else{
	?><span style="font-size: 14px; line-height: 19px;"><?= $billingAddress['address_1']; ?> <?= $billing_house_number; ?>
                                        <?= $billingAddress['address_2']; ?></span><br><?php
}
?>
                                    <span
                                        style="font-size: 14px; line-height: 19px;"><?= $billingAddress['postcode']; ?>
                                        <?= $billingAddress['city']; ?></span><br>
                                    <?php if ($billing_state_name) {
?>
                                    <span
                                        style="font-size: 14px; line-height: 19px;"><?= $billing_state_name; ?></span><br>
                                    <?php
} ?>
                                    <span
                                        style="font-size: 14px; line-height: 19px;"><?= $billingAddress['country']; ?></span><br>
                                    <span
                                        style="font-size: 14px; line-height: 19px;"><?= $billingAddress['phone']; ?></span>
                                </p>
                                <p style="font-size: 14px; line-height: 19px; margin: 0;"><span
                                        style="font-size: 14px;"><a href="mailto:<?= $billingAddress['email']; ?>"
                                            style="color:#555555; text-decoration:none;"><?= $billingAddress['email']; ?></a></span>
                                </p>
                            </div>
                        </div>
                        <!--[if mso]></td></tr></table><![endif]-->
                        <!--[if (!mso)&(!IE)]><!-->
                    </div>
                    <!--<![endif]-->
                </div>
            </div>
            <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
            <!--[if (mso)|(IE)]></td><td align="center" width="310" style="background-color:#fff;width:310px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 30px; padding-top:40px; padding-bottom:20px;"><![endif]-->
            <div class="col num6" style="max-width: 320px; min-width: 310px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <?php
$orderID = $order->get_order_number();



	?>
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:20px; padding-bottom:0px; padding-right: 10px; padding-left: 30px; text-align: left;">
                        <!--<![endif]-->
                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top: 0px; padding-bottom: 0px; font-family: sans-serif"><![endif]-->
                        <div
                            style="color:<?= $theme_color; ?>;font-family:'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;line-height:150%;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;">
                            <div
                                style="line-height: 18px; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size: 12px; color: <?= $theme_color; ?>;">
                                <p style="line-height: 19px; font-size: 12px; text-align: left; margin: 0;"><span
                                        style="font-size: 14px;"><strong><?php echo __('Shipping details', 'nutrisslim-suiteV2')?>:</strong></span>
                                </p>
                            </div>
                        </div>
                        <!--[if mso]></td></tr></table><![endif]-->
                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top: 0px; padding-bottom: 0px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
                        <div
                            style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:150%;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;">
                            <div
                                style="font-size: 12px; line-height: 18px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">

                                <p style="font-size: 14px; line-height: 19px; margin: 0;">

                                    <?php $shippingAddress = $order->get_address('shipping');
	if($shippingAddress['company']){
	?>
                                    <strong><span
                                            style="font-size: 14px; line-height: 19px;"><?= $shippingAddress['company']; ?></span></strong><br>
                                    <span
                                        style="font-size: 14px; line-height: 19px;"><?= $shippingAddress['first_name']; ?>
                                        <?= $shippingAddress['last_name']; ?></span><br>
                                    <?php
	} else{
		?>
                                    <strong><span
                                            style="font-size: 14px; line-height: 19px;"><?= $shippingAddress['first_name']; ?>
                                            <?= $shippingAddress['last_name']; ?></span></strong><br>
                                    <?php
	}
	if($order_language == 'en'){
		?><span style="font-size: 14px; line-height: 19px;"><?= $shipping_house_number; ?>
                                        <?= $shippingAddress['address_1']; ?>
                                        <?= $shippingAddress['address_2']; ?></span><br><?php
	} else{
		?><span style="font-size: 14px; line-height: 19px;"><?= $shippingAddress['address_1']; ?>
                                        <?= $shipping_house_number; ?> <?= $shippingAddress['address_2']; ?></span><br><?php
	}	
	?>
                                    <span
                                        style="font-size: 14px; line-height: 19px;"><?= $shippingAddress['postcode']; ?>
                                        <?= $shippingAddress['city']; ?></span><br>
                                    <?php if ($shipping_state_name) {
	?>
                                    <span
                                        style="font-size: 14px; line-height: 19px;"><?= $shipping_state_name; ?></span><br>
                                    <?php
	} ?>
                                    <span
                                        style="font-size: 14px; line-height: 19px;"><?= $shippingAddress['country']; ?></span><br>
                                </p>

                            </div>
                            <?php 
	if($order_language == 'en'){ ?>
                            <div
                                style="padding-top: 10px; font-size: 12px; line-height: 18px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                                <strong><span style="font-size: 12px; line-height: 19px;">Is the delivery address
                                        correct?</span></strong><br>
                                <span style="font-size: 12px; line-height: 19px;">If not, send us the correct one to:
                                    support@nutrisslim.uk</span>
                                <?php } ?>
                            </div>
                        </div>
                        <!--[if mso]></td></tr></table><![endif]-->
                        <!--[if (!mso)&(!IE)]><!-->
                    </div>
                    <?php

?>
                    <!--<![endif]-->
                </div>
            </div>
            <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
            <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
    </div>
</div>