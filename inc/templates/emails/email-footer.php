<?php
/**
 * Email Footer
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-footer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
														


<div style="background-color:transparent;">
<div class="block-grid " style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #282828;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#282828;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:#282828"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="620" style="background-color:#282828;width:620px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:5px;"><![endif]-->
<div class="col num12" style="min-width: 320px; max-width: 620px; display: table-cell; vertical-align: top;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<div align="center" class="img-container center autowidth fullwidth" style="padding-right: 0px;padding-left: 0px; padding-bottom:30px;">
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 0px;" align="center"><![endif]-->
<!--[if mso]></td></tr></table><![endif]-->
</div>
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 30px; padding-top: 0px; padding-bottom: 0px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#b8b8b8;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:150%;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:30px; text-align: left;">
<div style="font-size: 12px; line-height: 18px; color: #b8b8b8; padding-bottom:30px; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
<?php
// STARA JETRA:
/*
$company_url = get_site_url();
$compay_support_email = get_option('woocommerce_support_email');
$company_name = get_option('woocommerce_company_name');
$company_address = get_field('address', $acf_option_name);
$company_postal_city = get_field('postal_city', $acf_option_name);
$company_country = get_field('country', $acf_option_name);
// Example usage
$store_address = get_woocommerce_store_address();
$address = implode( '<br /> ', array_filter( $store_address ) );
?>
<p style="font-size: 14px; line-height: 19px; margin: 0;"><?php echo $address; ?></p>
<p style="font-size: 14px; line-height: 19px; margin: 0; color:#ffffff"><a href="<?php echo $company_url; ?>" style="color:#b8b8b8; text-decoration:none;"><?php echo $company_url; ?></a><br><?php echo $compay_support_email; ?></p>
*/
//NOVA JETRA
$company_url = get_site_url();
$company_support_email = get_option('woocommerce_support_email');

// Retrieve company details from your ACF fields or WooCommerce settings
$company_name = get_field('company_name', $acf_option_name) ?: get_option('woocommerce_company_name');
$company_address = get_field('address', $acf_option_name) ?: get_option('woocommerce_store_address');
$company_postal_city = get_field('postal_city', $acf_option_name) ?: get_option('woocommerce_store_postcode') . ' ' . get_option('woocommerce_store_city');
$company_country = strtoupper(get_field('country', $acf_option_name)) ?: strtoupper(get_option('woocommerce_default_country'));

// Build the address lines
$address_lines = array_filter([
    $company_name,
    $company_address,
    $company_postal_city . ', ' . $company_country,
]);

$address = implode('<br>', $address_lines);
?>
<p style="font-size: 14px; line-height: 19px; margin: 0;"><?php echo $address; ?></p>
<p style="font-size: 14px; line-height: 19px; margin: 0; color:#ffffff;">
    <a href="<?php echo $company_url; ?>" style="color:#b8b8b8; text-decoration:none;"><?php echo $company_url; ?></a><br>
    <?php echo $company_support_email; ?>
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
<div style="background-color:transparent;">
<div class="block-grid " style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="620" style="background-color:transparent;width:620px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
<div class="col num12" style="min-width: 320px; max-width: 620px; display: table-cell; vertical-align: top;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<div class="img-container center autowidth fullwidth" style="padding-right: 0px;padding-left: 0px; padding-top:30px;">
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
<div class="block-grid " style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="620" style="background-color:transparent;width:620px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:15px; padding-bottom:20px;"><![endif]-->
<div class="col num12" style="min-width: 320px; max-width: 620px; display: table-cell; vertical-align: top;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:15px; padding-bottom:20px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
<div style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div style="font-size: 12px; line-height: 14px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
<p style="font-size: 12px; line-height: 14px; text-align: center; margin: 0;"><strong>Copyright © <?php echo $company_name; ?> <?php echo date("Y"); ?></strong></p>
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
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
</td>
</tr>
</tbody>
</table>
	</body>
</html>
