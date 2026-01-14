<?php
/**
 * Order details table shown in emails.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

__( 'Številka naročila', 'naturesfinest' );
__( 'Znesek', 'naturesfinest');
__( 'Naročilo', 'naturesfinest' );
__('Pozdravljeni, pred dnevi ste oddali naročilo, pri katerem še niste zaključili plačila. Klik na spodnji gumb vas bo odpeljal na povezavo, kjer lahko zaključite plačilo. Sicer se bo naročilo čez','naturesfinest');
__('Pozdravljeni, pred dnevi ste oddali naročilo, pri katerem še niste zaključili plačila. Klik na spodnji gumb vas bo odpeljal na povezavo, kjer lahko zaključite plačilo. Sicer se bo naročilo po','naturesfinest');
__('dan samodejno preklicalo.','naturesfinest');
__('dneh samodejno preklicalo.','naturesfinest');
__( 'Plačilo naročila','nutrisslim-suiteV2');
__( 'Izdelek', 'naturesfinest' );
__( 'Količina', 'naturesfinest' );
__( 'Cena', 'naturesfinest' );
__( 'Izdelki', 'naturesfinest' );
__( 'z DDV', 'naturesfinest' );
__( 'Dostava', 'naturesfinest' );
__( 'Plačilo po povzetju', 'naturesfinest' );
__( 'Prihranek', 'naturesfinest' );
__( 'Način plačila', 'naturesfinest' );
__( 'Referenca', 'naturesfinest' );
__( 'Podatki za plačilo:', 'naturesfinest' );
__('Ime banke','naturesfinest');
__('Številka računa','naturesfinest');
__('IBAN','naturesfinest');
__('BIC /Swift','naturesfinest');
__('Estimated Delivery time:', 'naturesfinest');
__('7-9 working days, GLS courier service', 'naturesfinest');
__('Date','nutrisslim-suiteV2');
__( 'kliknite tukaj', 'nutrisslim-suiteV2' );

global $custom_order_id; global $shop_country_code; global $order_language;

$custom_order_id = $order->get_id();
$shop_country_code = get_field('shop_country', $custom_order_id);
switch ($shop_country_code) {

	case SHOP_CODE . '1100':
	$order_language = 'cs';
	$order_language2 = 'CZ';
	$currency_symbol = 'Kč';
	$currency_code = 'CZK';
	$currency_image = 'money.png';
	break;
	case SHOP_CODE . '2000':
	$order_language = 'en';
	$order_language2 = 'GB';
	$currency_symbol = '£';
	$currency_code = 'GBP';
	$currency_image = 'money.png';
	break;
	case SHOP_CODE . '1500':
	$order_language = 'fr';
	$order_language2 = 'FR';
	$currency_symbol = '€';
	$currency_code = 'EUR';
	$currency_image = 'euro.png';
	break;
	case SHOP_CODE . '3000':
	$order_language = 'hr';
	$order_language2 = 'HR';
	$currency_symbol = '€';
	$currency_code = 'EUR';
	$currency_image = 'money.png';
	break;
	case SHOP_CODE . '8000':
	$order_language = 'hu';
	$order_language2 = 'HU';
	$currency_symbol = 'Ft';
	$currency_code = 'HUF';
	$currency_image = 'money.png';
	break;
	case SHOP_CODE . '60':
	$order_language = 'it';
	$order_language2 = 'IT';
	$currency_symbol = '€';
	$currency_code = 'EUR';
	$currency_image = 'euro.png';
	break;
	case SHOP_CODE . '7000':
	$order_language = 'pl';
	$order_language2 = 'PL';
	$currency_symbol = 'zł';
	$currency_code = 'PLN';
	$currency_image = 'money.png';
	break;
	case SHOP_CODE . '1600':
	$order_language = 'pt-pt';
	$order_language2 = 'PT';
	$currency_symbol = '€';
	$currency_code = 'EUR';
	$currency_image = 'euro.png';
	break; 

	case SHOP_CODE . '1900':
	$order_language = 'nl';
	$order_language2 = 'NL';
	$currency_symbol = '€';
	$currency_code = 'EUR';
	$currency_image = 'euro.png';
	break; 

	case SHOP_CODE . '2200':
	$order_language = 'at';
	$order_language2 = 'AT';
	$currency_symbol = '€';
	$currency_code = 'EUR';
	$currency_image = 'euro.png';
	break; 

	case SHOP_CODE . '2300':
	$order_language = 'ie';
	$order_language2 = 'IE';
	$currency_symbol = '€';
	$currency_code = 'EUR';
	$currency_image = 'euro.png';
	break; 

	/* case SHOP_CODE . '4000':
	$order_language = 'eeu';
	$order_language2 = 'EU';
	$currency_symbol = '€';
	$currency_code = 'EUR';
	$currency_image = 'euro.png';
	break;  */

	case SHOP_CODE . '1000':
	$order_language = 'sl';
	$order_language2 = 'SI';
	$currency_symbol = '€';
	$currency_code = 'EUR';
	$currency_image = 'euro.png';
	break;
	
	case SHOP_CODE . '1400':
	$order_language = 'de';
	$order_language2 = 'DE';
	$currency_symbol = '€';
	$currency_code = 'EUR';
	$currency_image = 'euro.png';
	break;
	case SHOP_CODE . '9000':
	$order_language = 'sk';
	$order_language2 = 'SK';
	$currency_symbol = '€';
	$currency_code = 'EUR';
	$currency_image = 'money.png';
	break;
	case SHOP_CODE . '1300':
	$order_language = 'es';
	$order_language2 = 'ES';
	$currency_symbol = '€';
	$currency_code = 'EUR';
	$currency_image = 'euro.png';
	break;
	case SHOP_CODE . '1700':
	$order_language = 'ro';
	$order_language2 = 'RO';
	$currency_symbol = 'lei';
	$currency_code = 'RON';
	$currency_image = 'money.png';
	break;
	case SHOP_CODE . '2400': //GREECE
	$order_language = 'el';
	$order_language2 = 'GR';
	$currency_symbol = '€';
	$currency_code = 'EUR';
	$currency_image = 'euro.png';
	break;
	case SHOP_CODE . '2500': //DENMARK
	$order_language = 'da';
	$order_language2 = 'DK';
	$currency_symbol = 'kr';
	$currency_code = 'DKK';
	$currency_image = 'money.png';
	break;
	case SHOP_CODE . '2600': //SWEDEN
	$order_language = 'sv';
	$order_language2 = 'SE';
	$currency_symbol = 'kr';
	$currency_code = 'SEK';
	$currency_image = 'money.png';
	break;
	case SHOP_CODE . '2100':
	$order_language = $order->get_meta('_used_language');  // set this to fr for the time beeing but we need to figure it out how to set it based on the language that was used on checkout
	$order_language2 = 'CH';
	$currency_symbol = 'CHF';
	$currency_code = 'CHF';
	$currency_image = 'money.png';
	break;

	case SHOP_CODE . '1800':
	$is_multilang = $order->get_meta('_multilang');
	if($is_multilang == 'true'){
		$used_language = $order->get_meta('_used_language');
	} else{
		$used_language = 'nl';
	}
	$order_language = $used_language;  // set this to fr for the time beeing but we need to figure it out how to set it based on the language that was used on checkout
	$order_language2 = 'BE';
	$currency_symbol = '€';
	$currency_code = 'EUR';
	$currency_image = 'euro.png';
	break;

	default:
	$order_language = 'sl';
	$order_language2 = 'SI';
	$currency_symbol = '€';
	$currency_code = 'EUR';
	$currency_image = 'euro.png';
}
global $translation_language;
$translation_language = $order_language;
if($shop_country_code == SHOP_CODE . '2200' && $translation_language == 'at'){
	$translation_language = 'de';
}
if($shop_country_code == SHOP_CODE . '2300' && $translation_language == 'ie'){
	$translation_language = 'en';
}
$fee_amount = 0; $i = 0;
$priority_fee_amount = 0;
$priority_fee_amount_no_html = '';

$ensurance_fee_amount = 0;
$ensurance_fee_amount_no_html = '';
$neto_cod_fee = 0;
foreach($order->get_fees() as $fee_id => $fee){
	
	if($fee['name'] == __('Cash on delivery','nutrisslim-suiteV2')){
/* 		$fee_amount = $fee_amount + $fee->get_data()['amount'];
		$fee_title = $fee_amount + $fee->get_data()['amount'];
		$fee_amount_2 = wc_price($fee->get_data()['amount'] + $fee->get_data()['total_tax']);
		$fee_amount_no_html = $fee->get_data()['amount'] + $fee->get_data()['total_tax']; */

		$neto_cod_fee = roundToTwoDecimals($fee->get_data()['amount']);
		$cod_fee_tax = roundToTwoDecimals($fee->get_data()['total_tax']);
		$bruto_cod_fee = roundToTwoDecimals($neto_cod_fee + $cod_fee_tax);
		

	}
	if ($fee['name'] == 'Prioritetno naročilo') {

		$priority_fee_amount = $priority_fee_amount + $fee->get_data()['amount'];
		$priority_fee_title = $fee_amount + $fee->get_data()['amount'];
		$priority_fee_amount_2 = wc_price($fee->get_data()['amount'] + $fee->get_data()['total_tax']);
		$priority_fee_amount_no_html = $fee->get_data()['amount'] + $fee->get_data()['total_tax'];
	}
	if ($fee['name'] == 'Zavarovanje naročila') {

		$ensurance_fee_amount = $ensurance_fee_amount + $fee->get_data()['amount'];
		$ensurance_fee_title = $fee_amount + $fee->get_data()['amount'];
		$ensurance_fee_amount_2 = wc_price($fee->get_data()['amount'] + $fee->get_data()['total_tax']);
		$ensurance_fee_amount_no_html = $fee->get_data()['amount'] + $fee->get_data()['total_tax'];
	}

	$i++;
}
if($fee_amount == 0){
	$fee_amount_no_html = 0;
}

if(defined('INSTANCENAME')){
	if(INSTANCENAME == 'NF1' || INSTANCENAME == 'NF2' || INSTANCENAME == 'NF3'){
		$theme_color = '#1fb25a';
		$theme_logo = 'nf/logo.jpg';
		if($order_language == 'en'){
			$theme_logo = 'nf/logo-en.jpg';
		}
		$logo_width = '180';
		$logo_height = '45';
	} else if(INSTANCENAME == 'BABE1'){
		$theme_color = '#EC535A';
		$theme_logo = 'babes/logo.jpg';
		$logo_width = '180';
		$logo_height = '80';
	}
}

$text_align = is_rtl() ? 'right' : 'left';
 ?>

 <div style="background-color:transparent;">
<div class="block-grid " style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="620" style="background-color:transparent;width:620px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:10px; padding-bottom:0px;"><![endif]-->
<div class="col num12" style="min-width: 320px; max-width: 620px; display: table-cell; vertical-align: top;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<div align="center" class="img-container center autowidth fullwidth" style="padding-right: 0px;padding-left: 0px;">
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 0px;" align="center"><![endif]-->
<!--[if mso]></td></tr></table><![endif]-->
</div>
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid " style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:#fff"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="620" style="background-color:#fff;width:620px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:10px;"><![endif]-->
<div class="col num12" style="min-width: 320px; max-width: 620px; display: table-cell; vertical-align: top;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<div class="img-container left autowidth " style="padding-right: 30px;padding-left: 30px;">
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 30px;padding-left: 30px;" align="left"><![endif]-->
</div><a href="<?= get_home_url(); ?>" target="_blank" style="display:block; width:<?= $logo_width; ?>px!important; width:<?= $logo_width; ?>px!important; height:<?= $logo_height; ?>px!important; text-align:center;"> <img style="margin-top:20px;" alt="Image" border="0" class="center autowidth " src="<?= get_template_directory_uri(); ?>/img/email/<?= $theme_logo; ?>" title="Image" width="<?= $logo_width; ?>" height="<?= $logo_height; ?>"></a>
<div style="font-size:1px;line-height:30px"> </div>
<!--[if mso]></td></tr></table><![endif]-->
</div>
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid three-up" style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:#fff"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="206" style="background-color:#fff;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 1px solid #DFDFDF;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:20px; padding-bottom:10px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:1px solid #DFDFDF; padding-top:10px; padding-bottom:10px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<div align="center" class="img-container center autowidth " style="padding-right: 0px;padding-left: 0px; height:26px;">
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 0px;" align="center"><![endif]--><img align="center" alt="Image" border="0" class="center autowidth " src="<?= get_template_directory_uri(); ?>/img/email/barcode.png" style="outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; clear: both; border: 0; height: 21px!important; float: none; width: 27px !important; max-width: 27px!important; display: block;" title="Image" width="27" height="21">
<!--[if mso]></td></tr></table><![endif]-->
</div>
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:0px;padding-left:10px;">
<div style="font-size: 12px; line-height: 14px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
<p style="font-size: 14px; line-height: 19px; text-align: center; margin: 0;"><span style="color: #999999; font-size: 14px; line-height: 19px;"><?= apply_filters( 'wpml_translate_single_string', 'Številka naročila', 'naturesfinest', 'Številka naročila', $translation_language ); ?>:</span> <strong>#<?= $order->get_order_number(); ?></strong></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:#fff;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 1px solid #DFDFDF;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:15px; padding-bottom:10px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:1px solid #DFDFDF; padding-top:10px; padding-bottom:10px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<div align="center" class="img-container center autowidth " style="padding-right: 0px;padding-left: 0px;">
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 0px;" align="center"><![endif]--><img align="center" alt="Image" border="0" class="center autowidth " src="<?= get_template_directory_uri(); ?>/img/email/calendar.png" style="outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; clear: both; border: 0; height: 26px !important; float: none; width: 27px !important; max-width: 27px!important; display: block;" title="Image" width="27" heigh="26">
<!--[if mso]></td></tr></table><![endif]-->
</div>
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:0px;padding-left:10px;">
<div style="font-size: 12px; line-height: 14px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
<p style="font-size: 14px; line-height: 19px; text-align: center; margin: 0;"><span style="color: #999999; font-size: 14px; line-height: 19px;"><?= apply_filters( 'wpml_translate_single_string', 'Date', 'nutrisslim-suiteV2', 'Date', $translation_language ); ?>:</span> <strong><?= wc_format_datetime($order->get_date_created()); ?></strong></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:#fff;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:15px; padding-bottom:5px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<div align="center" class="img-container center autowidth " style="padding-right: 0px;padding-left: 0px;">
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 0px;" align="center"><![endif]--><img align="center" alt="Image" border="0" class="center autowidth " src="<?= get_template_directory_uri(); ?>/img/email/<?= $currency_image; ?>" style="outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; clear: both; border: 0; height: 26px !important; float: none; width: 24px !important; max-width: 24px !important; display: block;" title="Image" width="24" height="26">
<!--[if mso]></td></tr></table><![endif]-->
</div>
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:0px;padding-left:10px;">
<div style="font-size: 12px; line-height: 14px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
<?php
$order_has_yith_offer_discount = false;
if(get_post_meta($order->get_id(), '_yithDiscountRate')){
    $order_has_yith_offer_discount = true;
    $yithDiscountRate = get_post_meta($order->get_id(), '_yithDiscountRate')[0];
}
?>
<p style="font-size: 14px; line-height: 19px; text-align: center; margin: 0;"><span style="color: #999999; font-size: 14px; line-height: 19px;"><?= apply_filters( 'wpml_translate_single_string', 'Znesek', 'naturesfinest', 'Znesek', $translation_language ); ?>:</span><strong> 
<?php 
if(($translation_language == 'en' && INSTANCENAME == 'NF1') || ($translation_language == 'en' && INSTANCENAME == 'BABE1')){
	echo $currency_symbol . '' . $order->get_total();
} else{
	echo str_replace(".",",",$order->get_total()) . ' ' .  $currency_symbol;
}
?>
</strong></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid " style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:#FFFFFF"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="620" style="background-color:#FFFFFF;width:620px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:15px; padding-bottom:10px;"><![endif]-->
<div class="col num12" style="min-width: 320px; max-width: 620px; display: table-cell; vertical-align: top;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 40px; padding-left: 40px; padding-top: 15px; padding-bottom: 15px; font-family: sans-serif"><![endif]-->
<div style="color:<?= $theme_color; ?>;font-family:'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;line-height:150%;padding-top:15px;padding-right:40px;padding-bottom:15px;padding-left:40px;">
<div style="line-height: 18px; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size: 12px; color: <?= $theme_color; ?>;">
<p style="line-height: 36px; text-align: center; font-size: 12px; margin: 0;"><span style="font-size: 24px;"><strong><?= apply_filters( 'wpml_translate_single_string', 'Naročilo', 'naturesfinest', 'Naročilo', $translation_language ); ?></strong></span></p>
<p style="font-size: 14px!important; line-height: 21px!important; margin: 0; color:#555555!important; font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif!important;">
<?php global $emailMSG; global $reminder_text; global $days_till_cancel;
if($reminder_text == true){
	if($days_till_cancel == 1){
		$emailMSG = apply_filters( 'wpml_translate_single_string', 'Pozdravljeni, pred dnevi ste oddali naročilo, pri katerem še niste zaključili plačila. Klik na spodnji gumb vas bo odpeljal na povezavo, kjer lahko zaključite plačilo. Sicer se bo naročilo čez', 'naturesfinest', 'Pozdravljeni, pred dnevi ste oddali naročilo, pri katerem še niste zaključili plačila. Klik na spodnji gumb vas bo odpeljal na povezavo, kjer lahko zaključite plačilo. Sicer se bo naročilo čez', $translation_language ) . ' ' . $days_till_cancel . ' ' . apply_filters( 'wpml_translate_single_string', 'dan samodejno preklicalo.', 'naturesfinest', 'dan samodejno preklicalo.', $translation_language ) . '<br><br><a href="' . esc_url( $order->get_checkout_payment_url() ) . '" style="color:#ffffff; background-color:' . $theme_color . '; height:40px; line-height:40px; padding-left:10px; padding-right:10px; text-decoration:none; font-weight:bold; padding-top:10px; padding-bottom:10px; border-radius:4px;">' . apply_filters( 'wpml_translate_single_string', 'Plačilo naročila', 'nutrisslim-suiteV2', 'Plačilo naročila', $translation_language ) . '</a><br>';
	} else{
		$emailMSG = apply_filters( 'wpml_translate_single_string', 'Pozdravljeni, pred dnevi ste oddali naročilo, pri katerem še niste zaključili plačila. Klik na spodnji gumb vas bo odpeljal na povezavo, kjer lahko zaključite plačilo. Sicer se bo naročilo po', 'naturesfinest', 'Pozdravljeni, pred dnevi ste oddali naročilo, pri katerem še niste zaključili plačila. Klik na spodnji gumb vas bo odpeljal na povezavo, kjer lahko zaključite plačilo. Sicer se bo naročilo po', $translation_language ) . ' ' . $days_till_cancel . ' ' . apply_filters( 'wpml_translate_single_string', 'dneh samodejno preklicalo.', 'naturesfinest', 'dneh samodejno preklicalo.', $translation_language ) . '<br><br><a href="' . esc_url( $order->get_checkout_payment_url() ) . '" style="color:#ffffff; background-color:' . $theme_color . '; height:40px; line-height:40px; padding-left:10px; padding-right:10px; text-decoration:none; font-weight:bold; padding-top:10px; padding-bottom:10px; border-radius:4px;">' . apply_filters( 'wpml_translate_single_string', 'Plačilo naročila', 'nutrisslim-suiteV2', 'Plačilo naročila', $translation_language ) . '</a><br>';
	}
}
echo $emailMSG;
global $emailNote; global $currentLanguage;
/* if ($currentLanguage != 'en') {
echo $emailNote;
} */
?>

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
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>





<!-- Header -->

<div style="background-color:transparent;">
<div class="block-grid three-up no-stack" style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: <?= $theme_color; ?>;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:<?= $theme_color; ?>;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:<?= $theme_color; ?>"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="206" style="background-color:<?= $theme_color; ?>;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 1px solid <?= $theme_color; ?>;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:1px solid <?= $theme_color; ?>; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#FFFFFF;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div style="font-size: 12px; line-height: 14px; color: #FFFFFF; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
<p style="font-size: 14px; line-height: 15px; text-align: center; margin: 0;"><span style="font-size: 14px; line-height: 19px; mso-ansi-font-size: 14px;"><strong><?= apply_filters( 'wpml_translate_single_string', 'Izdelek', 'naturesfinest', 'Izdelek', $translation_language ); ?>:</strong></span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:<?= $theme_color; ?>;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 1px solid <?= $theme_color; ?>;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:1px solid <?= $theme_color; ?>; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#FFFFFF;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div style="line-height: 14px; font-size: 12px; color: #FFFFFF; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
<p style="line-height: 15px; text-align: center; font-size: 12px; margin: 0;"><span style="font-size: 14px; line-height: 19px; mso-ansi-font-size: 14px;"><strong><?= apply_filters( 'wpml_translate_single_string', 'Količina', 'naturesfinest', 'Količina', $translation_language ); ?>:</strong></span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:<?= $theme_color; ?>;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#FFFFFF;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div style="font-size: 12px; line-height: 14px; color: #FFFFFF; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
<p style="font-size: 14px; line-height: 19px; text-align: center; margin: 0;"><span style="font-size: 14px; line-height: 19px; mso-ansi-font-size: 14px;"><strong><?= apply_filters( 'wpml_translate_single_string', 'Cena', 'naturesfinest', 'Cena', $translation_language ); ?>:</strong></span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>
<?php
echo wc_get_email_order_items( $order, array( // WPCS: XSS ok.
	'show_sku'      => $sent_to_admin,
	'show_image'    => false,
	'image_size'    => array( 32, 32 ),
	'plain_text'    => $plain_text,
	'sent_to_admin' => $sent_to_admin,
) );
?>
<?php
$totals = $order->get_order_item_totals();
?>

<div style="background-color:transparent;">
<div class="block-grid " style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:#fff"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="620" style="background-color:#fff;width:620px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
<div class="col num12" style="min-width: 320px; max-width: 620px; display: table-cell; vertical-align: top;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-collapse: collapse;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="0" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 1px solid #BBBBBB; height: 0px;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td height="0" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>


<div style="background-color:transparent;">
<div class="block-grid three-up no-stack" style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:#FFFFFF"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:20px; padding-bottom:0px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:15px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 30px; padding-top: 0px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:30px; text-align: left;">
<div style="font-size: 12px; line-height: 14px; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; color: #555555;">
<p style="font-size: 14px; line-height: 19px; margin: 0;"><span style="font-size: 14px;"><?= apply_filters( 'wpml_translate_single_string', 'Izdelki', 'naturesfinest', 'Izdelki', $translation_language ); ?><br><span style="font-size: 12px; line-height: 14px; white-space: nowrap;">(<?=  apply_filters( 'wpml_translate_single_string', 'z DDV', 'naturesfinest', 'z DDV', $translation_language ); ?>)</span></span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:10px; padding-bottom:10px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:10px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-collapse: collapse;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="0" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 0px;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td height="0" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:30px; padding-bottom:0px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:15px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 20px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:10px;padding-bottom:20px;padding-left:10px;">
<div style="font-size: 12px; line-height: 14px; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; color: #555555;">
<?php
if($order_has_yith_offer_discount == true){
	if(get_post_meta($order->get_id(), '_yith_offer_price')){
		$order_subtotal =  wc_price(get_post_meta($order->get_id(), '_yith_offer_price')[0]);
	} else{
		$order_subtotal = $order->get_subtotal_to_display();
	}
	
} else{
	$order_subtotal = $order->get_subtotal_to_display();
}
?>
<p style="font-size: 12px; line-height: 19px; text-align: center; margin: 0;"><span style="font-size: 14px;"><strong><?= $order_subtotal; ?> </strong></span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>


<div style="background-color:transparent;">
<div class="block-grid three-up no-stack" style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:#FFFFFF"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:10px; padding-bottom:5px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 30px; padding-top: 0px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:30px; text-align: left;">
<div style="font-size: 12px; line-height: 14px; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; color: #555555;">
<p style="font-size: 14px; line-height: 19px; margin: 0;"><span style="font-size: 14px;"><?=  apply_filters( 'wpml_translate_single_string', 'Dostava', 'naturesfinest', 'Dostava', $translation_language ); ?><br><span style="font-size: 12px; line-height: 14px; white-space: nowrap;">(<?= apply_filters( 'wpml_translate_single_string', 'z DDV', 'naturesfinest', 'z DDV', $translation_language ); ?>)</span></span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-collapse: collapse;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="0" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 0px;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td height="0" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:20px; padding-bottom:0px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 20px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:10px;padding-bottom:20px;padding-left:10px;">
<div style="font-size: 12px; line-height: 14px; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; color: #555555;">
<?php $shipping = $order->get_data()['shipping_total'] + $order->get_data()['shipping_tax'];?>
<p style="font-size: 12px; line-height: 19px; text-align: center; margin: 0;"><span style="font-size: 14px;"><strong><?= wc_price($shipping,array('currency' => $currency_code)); ?> </strong></span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>

<!-- FEE FOR CASH ON DELIVERY -->

<?php if($neto_cod_fee != 0){
?>
<div style="background-color:transparent;">
<div class="block-grid three-up no-stack" style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:#FFFFFF"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:10px; padding-bottom:5px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 30px; padding-top: 0px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:30px; text-align: left;">
<div style="font-size: 12px; line-height: 14px; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; color: #555555;">
<p style="font-size: 14px; line-height: 19px; margin: 0;"><span style="font-size: 14px;"><?=  apply_filters( 'wpml_translate_single_string', 'Plačilo po povzetju', 'naturesfinest', 'Plačilo po povzetju', $translation_language ); ?><br><span style="font-size: 12px; line-height: 14px; white-space: nowrap;">(<?= apply_filters( 'wpml_translate_single_string', 'z DDV', 'naturesfinest', 'z DDV', $translation_language ); ?>)</span></span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-collapse: collapse;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="0" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 0px;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td height="0" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:20px; padding-bottom:0px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 20px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:10px;padding-bottom:20px;padding-left:10px;">
<div style="font-size: 12px; line-height: 14px; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; color: #555555;">

<p style="font-size: 12px; line-height: 19px; text-align: center; margin: 0;"><span style="font-size: 14px;"><strong><?= wc_price($bruto_cod_fee); ?> </strong></span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>
<?php
} ?>

<!-- FEE FOR PRIORITY ORDER -->

<?php if($priority_fee_amount != 0){
?>
<div style="background-color:transparent;">
<div class="block-grid three-up no-stack" style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:#FFFFFF"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:10px; padding-bottom:5px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 30px; padding-top: 0px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:30px; text-align: left;">
<div style="font-size: 12px; line-height: 14px; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; color: #555555;">
<p style="font-size: 14px; line-height: 19px; margin: 0;"><span style="font-size: 14px;"><?=  apply_filters( 'wpml_translate_single_string', 'Prioritetno naročilo', 'naturesfinest', 'Prioritetno naročilo', $translation_language ); ?><br><span style="font-size: 12px; line-height: 14px; white-space: nowrap;">(<?= apply_filters( 'wpml_translate_single_string', 'z DDV', 'naturesfinest', 'z DDV', $translation_language ); ?>)</span></span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-collapse: collapse;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="0" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 0px;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td height="0" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:20px; padding-bottom:0px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 20px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:10px;padding-bottom:20px;padding-left:10px;">
<div style="font-size: 12px; line-height: 14px; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; color: #555555;">

<p style="font-size: 12px; line-height: 19px; text-align: center; margin: 0;"><span style="font-size: 14px;"><strong><?= $priority_fee_amount_2; ?> </strong></span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>
<?php
} ?>

<!-- FEE FOR ENSURANCE -->

<?php if($ensurance_fee_amount != 0){
?>
<div style="background-color:transparent;">
<div class="block-grid three-up no-stack" style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:#FFFFFF"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:10px; padding-bottom:5px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 30px; padding-top: 0px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:30px; text-align: left;">
<div style="font-size: 12px; line-height: 14px; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; color: #555555;">
<p style="font-size: 14px; line-height: 19px; margin: 0;"><span style="font-size: 14px;"><?=  apply_filters( 'wpml_translate_single_string', 'Zavarovanje naročila', 'naturesfinest', 'Zavarovanje naročila', $translation_language ); ?><br><span style="font-size: 12px; line-height: 14px; white-space: nowrap;">(<?= apply_filters( 'wpml_translate_single_string', 'z DDV', 'naturesfinest', 'z DDV', $translation_language ); ?>)</span></span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-collapse: collapse;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="0" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 0px;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td height="0" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:20px; padding-bottom:0px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 20px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:10px;padding-bottom:20px;padding-left:10px;">
<div style="font-size: 12px; line-height: 14px; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; color: #555555;">

<p style="font-size: 12px; line-height: 19px; text-align: center; margin: 0;"><span style="font-size: 14px;"><strong><?= $ensurance_fee_amount_2; ?> </strong></span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>
<?php
} ?>


<?php

if($order->get_discount_total()){
    ?>
<div style="background-color:transparent;">
<div class="block-grid three-up no-stack" style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:#FFFFFF"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:10px; padding-bottom:5px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 30px; padding-top: 0px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:0px;padding-bottom:10px;padding-left:30px;">
<div style="font-size: 12px; line-height: 14px; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; color: #555555;">
<p style="font-size: 14px; line-height: 19px; margin: 0;"><span style="font-size: 14px;"><?= apply_filters( 'wpml_translate_single_string', 'Prihranek', 'naturesfinest', 'Prihranek', $translation_language ); ?><br></span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-collapse: collapse;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="0" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 0px;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td height="0" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:20px; padding-bottom:0px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:20px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 20px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:10px;padding-bottom:20px;padding-left:10px;">
<div style="font-size: 12px; line-height: 14px; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; color: #555555;">
<?php 
// sometimes default discount amount totals are not correct leading to totals not adding up
// this probably happens because of some WC rounding
// we dont mess with totals, but we calculate total discount applied on each product, add it all  up and then display this as a total discount amount
$total_discount_bruto_amount = 0;
foreach( $order->get_items() as $item_id => $line_item ){
	$item_data = $line_item->get_data(); // Get the Tax data in an array
	if(wc_get_order_item_meta($item_data["id"],'_product_type') == 'yith_child'){
		$bruto_pp = wc_get_order_item_meta($item_data["id"],'_item_bruto_subtotal');
		$bruto_total_price = wc_get_order_item_meta($item_data["id"],'_item_bruto_total');
		$neto_total_price = wc_get_order_item_meta($item_data["id"],'_item_neto_total');
		$discount_bruto_amount = $bruto_pp - $bruto_total_price;
		$total_discount_bruto_amount = $total_discount_bruto_amount + $discount_bruto_amount;
	} else{
		$tax_class_rates = custom_get_rates_for_tax_class($item_data['tax_class']);
		foreach($tax_class_rates as $tax_class_rate){
		if($tax_class_rate->tax_rate_country == $order_language2){
			$item_tax_rate = $tax_class_rate->tax_rate;
			$bruto_pp =  strip_wc_price_tags(wc_price($item_data["subtotal"] + $item_data["subtotal_tax"]),$order_language);
			if (!((INSTANCENAME == 'BABE1' || INSTANCENAME == 'NF1') && ($currentLanguage == 'en'))) {
				$bruto_pp = str_replace('.', '',$bruto_pp);
				$bruto_pp = str_replace(',', '.',$bruto_pp);
			}
			$bruto_total_price = strip_wc_price_tags(wc_price($item_data["total"] + $item_data["total_tax"]),$order_language);
			if (!((INSTANCENAME == 'BABE1' || INSTANCENAME == 'NF1') && ($currentLanguage == 'en'))) {
				$bruto_total_price = str_replace('.', '',$bruto_total_price);
				$bruto_total_price = str_replace(',', '.',$bruto_total_price);
			}
			$discount_bruto_amount = $bruto_pp - $bruto_total_price;
			$total_discount_bruto_amount = $total_discount_bruto_amount + $discount_bruto_amount;
			}
		}
	}
}

?>
<p style="font-size: 12px; line-height: 19px; text-align: center; margin: 0;"><span style="font-size: 14px;"><strong>- <?= wc_price($total_discount_bruto_amount,array('currency' => $currency_code)); ?> </strong></span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>


	<?php
}

?>







<div style="background-color:transparent;">
<div class="block-grid three-up no-stack" style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:#FFFFFF"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:15px; padding-bottom:0px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:15px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 30px; padding-top: 5px; padding-bottom: 0px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:150%;padding-top:5px;padding-right:0px;padding-bottom:0px;padding-left:30px; text-align: left;">
<div style="font-size: 12px; line-height: 18px; color: #555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
<p style="font-size: 14px; line-height: 19px; margin: 0;"><?=  apply_filters( 'wpml_translate_single_string', 'Način plačila', 'naturesfinest', 'Način plačila', $translation_language ); ?>:</p>
<p style="font-size: 14px; line-height: 19px; margin: 0;"><span style="font-size: 14px;"><strong><span style="line-height: 19px; font-size: 14px;"><?= $order->get_order_item_totals()['payment_method']['value']; ?></span></strong></span></p>
</div>


</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:5px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-collapse: collapse;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="0" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 0px;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td height="0" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 1px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:10px; padding-bottom:5px;background-color:<?= $theme_color; ?>;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
<div style="background-color:<?= $theme_color; ?>;width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:1px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 3px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-collapse: collapse;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="0" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 0px;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td height="0" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 25px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#FFFFFF;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:10px;padding-bottom:7px;padding-left:10px;">
<div style="font-size: 12px; line-height: 14px; color: #FFFFFF; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
<p style="font-size: 14px; line-height: 24px; text-align: center; margin: 0;"><span style="font-size: 14px;"><strong>
<?php
if(($translation_language == 'en' && INSTANCENAME == 'NF1') || ($translation_language == 'en' && INSTANCENAME == 'BABE1')){
	echo $currency_symbol . '' . $order->get_total();
} else{
	echo str_replace(".",",",$order->get_total()) . ' ' .  $currency_symbol;
}
?>	
</strong></span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>



<div style="background-color:transparent;">
<div class="block-grid " style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:#FFFFFF"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="620" style="background-color:#FFFFFF;width:620px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:15px; padding-bottom:10px;"><![endif]-->
<div class="col num12" style="min-width: 320px; max-width: 620px; display: table-cell; vertical-align: top;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 40px; padding-left: 40px; padding-top: 15px; padding-bottom: 15px; font-family: sans-serif"><![endif]-->

<!-- Display bacs iformatin -->
<?php 
      if( $order->get_payment_method() === 'bacs') {
    
        $gateway    = new WC_Gateway_BACS();
        $country    = WC()->countries->get_base_country();
        $locale     = $gateway->get_country_locale();
        $bacs_info  = get_option( 'woocommerce_bacs_accounts');
		if($order_language == 'sl') {
			$bacs_reference_name =  apply_filters( 'wpml_translate_single_string', 'Referenca', 'naturesfinest', 'Referenca', $translation_language );
			if(get_post_meta( $order->get_id(), '_basc_reference', true )){ // meta name is _basc_reference instead of _bacs_reference so that Panlab & Metakocka don't need to change their logic/code
				$bacs_reference = get_post_meta( $order->get_id(), '_basc_reference', true );
			} else{
				$shop_country_code = get_country_code(ICL_LANGUAGE_CODE);
				$country_code = substr($shop_country_code,1);
				$shop_code = $shop_country_code[0];
				if($shop_code == 'W'){
					$shop_code = '1';
				}else if($shop_code == 'B'){
					$shop_code = '2';
				}
				$bacs_reference = 'SI 00 ' . $shop_code . $country_code . $order->get_id();
			}
        
        if ( $bacs_info ) {
    
          $order_date_created = $order->get_date_created();
          $time = strtotime($order_date_created);
          $date_end = date("d.m.Y", strtotime("+1 month", $time));
    
          foreach ( $bacs_info as $account ) {
                  
            $account_name   = $account['account_name'];
            $bank_name      = $account['bank_name'];
            $account_number = $account['account_number'];
            $sort_code      = $account['sort_code'];
            $iban_code      = $account['iban'];
            $bic_code       = $account['bic'];
           }
    ?>
    
	<div style="background-color:transparent;">
        <div class="block-grid " style=" Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
            <div style="margin-top:20px; padding:20px; border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
				<div style="padding-right:10px; padding-bottom: 20px; padding-left:30px; padding-right:30px;">
				<div style="line-height: 18px; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size: 12px; color: #1fb25a;">
					<p style="line-height: 24px; font-size: 12px; text-align: left; margin: 0;"><span style="font-size: 14px;"><strong><?= apply_filters( 'wpml_translate_single_string', 'Podatki za plačilo:', 'naturesfinest', 'Podatki za plačilo:', $translation_language ); ?></strong></span></p>
				</div>
				<p style="font-size: 14px; line-height: 19px; margin: 0; text-align:left">
					<strong><?= apply_filters( 'wpml_translate_single_string', 'Ime banke', 'naturesfinest', 'Ime banke', $translation_language );?>: </strong><?= $account['bank_name'];?><br>
					<strong><?= apply_filters( 'wpml_translate_single_string', 'Številka računa', 'naturesfinest', 'Številka računa', $translation_language );?>: </strong><?= $account['account_number'];?><br>
					<strong><?= apply_filters( 'wpml_translate_single_string', 'IBAN', 'naturesfinest', 'IBAN', $translation_language );?>: </strong><?=  $account['iban'];?><br>
					<strong><?=  apply_filters( 'wpml_translate_single_string', 'BIC /Swift', 'naturesfinest', 'BIC /Swift', $translation_language );?>: </strong><?= $account['iban'];?><br>
					<?php if($order_language == 'sl'){?><strong><?= $bacs_reference_name;?>: </strong><?= $bacs_reference;?><?php } ?></p> 
				</div>
			</div>
        </div>
    </div>
    <?php
	} 
	} else{
		echo "<br>";
	}
	echo '<p style="font-size: 14px; line-height: 19px; margin: 0;">' . __( 'Če želite plačati z drugo plačilno metodo, ', 'understrap' ) . '<a href="' . esc_url( $order->get_checkout_payment_url() ) . '" style="color:#1fb25a">' . apply_filters( 'wpml_translate_single_string', 'kliknite tukaj', 'nutrisslim-suiteV2', 'kliknite tukaj', $translation_language ) . '</a>.</p>';
    }?>
    
      <!--------------------------->

<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>




<?php
// order shipping estimate for ireland
if($order_language == 'ie'){
	?>
<div style="background-color:transparent;">
<div class="block-grid " style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:#FFFFFF"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="620" style="background-color:#FFFFFF;width:620px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:15px; padding-bottom:10px;"><![endif]-->
<div class="col num12" style="min-width: 320px; max-width: 620px; display: table-cell; vertical-align: top;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 40px; padding-left: 40px; padding-top: 15px; padding-bottom: 15px; font-family: sans-serif"><![endif]-->
<div style="color:<?= $theme_color; ?>;font-family:'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;line-height:150%;padding-top:15px;padding-right:30px;padding-bottom:15px;padding-left:30px;">
<div style="line-height: 18px; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size: 12px; color: <?= $theme_color; ?>;">
<p style="font-size: 14px!important; text-align: left; line-height: 21px!important; margin: 0; color:#555555!important; font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif!important;">
<b><?= apply_filters( 'wpml_translate_single_string', 'Estimated Delivery time:', 'naturesfinest', 'Estimated Delivery time:', $translation_language ); ?></b> <?= apply_filters( 'wpml_translate_single_string', '7-9 working days, GLS courier service', 'naturesfinest', '7-9 working days, GLS courier service', $translation_language ); ?>
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
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>
<?php
}

if ( $order->get_customer_note() ) {
				?>
				<div style="background-color:transparent;">
<div class="block-grid two-up" style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:#fff"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="310" style="background-color:#fff;width:310px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 30px; padding-top:40px; padding-bottom:20px;"><![endif]-->
<div class="col num6" style="max-width: 320px; min-width: 310px; display: table-cell; vertical-align: top;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:40px; padding-bottom:20px; padding-right: 10px; padding-left: 30px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top: 0px; padding-bottom: 0px; font-family: sans-serif"><![endif]-->
<div style="color:<?= $theme_color; ?>;font-family:'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;line-height:150%;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;">
<div style="line-height: 18px; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size: 12px; color: <?= $theme_color; ?>;">
<p style="line-height: 24px; font-size: 12px; text-align: left; margin: 0;"><span style="font-size: 14px;"><strong><?= apply_filters( 'wpml_translate_single_string', 'Sporočilo kupca', 'naturesfinest', 'Sporočilo kupca', $translation_language ); ?>:</strong></span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top: 0px; padding-bottom: 0px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:150%;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;">
<div style="font-size: 12px; line-height: 18px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
<p style="font-size: 14px; line-height: 19px; margin: 0; <?php echo esc_attr( $text_align ); ?>;"><?php echo wp_kses_post( wptexturize( $order->get_customer_note() ) ); ?>
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
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>
				
<?php }
?>