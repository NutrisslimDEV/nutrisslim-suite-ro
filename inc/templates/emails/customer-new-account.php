<?php
/**
 * Customer new account email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-new-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 6.0.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_email_header', $email_heading, $email ); 
global $shop_country_code; global $order_language;
$order_language = ICL_LANGUAGE_CODE;
if(($order_language == 'en') || ($order_language == 'de')){
	$order_language = check_for_country_duplicates($order_language);
}
$shop_country_code = get_country_code($order_language); //get special country code

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
global $shop_country_code; global $order_language;
$order_language = ICL_LANGUAGE_CODE;
if(($order_language == 'en') || ($order_language == 'de')){
	$order_language = check_for_country_duplicates($order_language);
}
if(defined('INSTANCENAME')){
	if(INSTANCENAME == 'NF1' || INSTANCENAME == 'NF2' || INSTANCENAME == 'NF3'){
		$theme_color = '#1fb25a';
		$theme_logo = 'nf/logo.jpg';
		if($order_language == 'en'){
			$theme_logo = 'nf/logo-en.jpg';
		}
	} else if(INSTANCENAME == 'BABE1'){
		$theme_color = '#EC535A';
		$theme_logo = 'babes/logo.jpg';
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
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:10px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<div class="img-container left autowidth " style="padding-right: 30px;padding-left: 30px;">
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 30px;padding-left: 30px;" align="left"><![endif]-->
</div>
</div><a href="<?= get_home_url(); ?>" target="_blank" style="display:block; width:100%; text-align:center;"> <img alt="Image" border="0" class="left autowidth " src="<?= get_template_directory_uri(); ?>/img/email/<?= $theme_logo; ?>" style="outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; clear: both; height: auto; float: none; border: none; width: 100%; max-width: 180px; display: inline-block; margin-top:30px" title="Image" width="180"></a>
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
<div class="block-grid " style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
<div style="line-height: 18px; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size: 12px; color: <?= $theme_color; ?>;">
<p style="line-height: 36px; text-align: center; font-size: 12px; margin: 0;"><span style="font-size: 24px;"><strong><?= __( "Registracija", "naturesfinest" ); ?></strong></span></p>
</div>
<div style="font-family:'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;line-height:150%;padding-top:15px;padding-right:30px;padding-bottom:15px;padding-left:30px;">
	<p><?php printf( __( 'Hvala za registracijo račun na %1$s. Vaše uporabniško ime je %2$s', 'naturesfinest' ), esc_html( $blogname ), '<strong>' . esc_html( $user_login ) . '</strong>' ); ?></p>

<?php if ( 'yes' === get_option( 'woocommerce_registration_generate_password' ) && $password_generated ) : ?>

	<p><?php printf( __( 'Vaše geslo je bilo samodejno ustvarjeno: %s', 'naturesfinest' ), '<strong>' . esc_html( $user_pass ) . '</strong>' ); ?></p>

<?php endif; ?>

	<p><?php printf( __( 'Do vaših uporabniških strani, kjer si lahko zamenjate geslo za prijavo, lahko dostopate na sledeči povezavi: %s.', 'naturesfinest' ), make_clickable( esc_url( wc_get_page_permalink( 'myaccount' ) ) ) ); ?></p>
	</div>
</div>
</div>
</div>
<?php do_action( 'woocommerce_email_footer', $email ); ?>