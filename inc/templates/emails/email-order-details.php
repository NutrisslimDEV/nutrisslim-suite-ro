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

global $emailMSG;
$imgdir = get_nutrislim_assets_url() . 'email/';
$theme_color = '#1fb25a';
$fees = $order->get_fees();
// error_log(print_r($fees, true));

foreach($fees as $fee_id => $fee) {
    error_log(print_r($fee['name'], true));
    if($fee['name'] == __('Cash on delivery','nutrisslim-suiteV2')) {
        // $cod_extra_fee = $fee->get_total() + $fee->get_total_tax();
        $cod_extra_fee = $fee->get_total();
    }
}

// error_log(print_r($cod_extra_fee, true));

?>


<div style="background-color:transparent;">
    <div class="block-grid "
        style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
            <!--[if (mso)|(IE)]>
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;">
                <tr>
                    <td align="center">
                        <table cellpadding="0" cellspacing="0" border="0" style="width:620px">
                            <tr class="layout-full-width" style="background-color:transparent">
            <![endif]-->
            <!--[if (mso)|(IE)]>
            <td align="center" width="620" style="background-color:transparent;width:620px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td style="padding-right: 0px; padding-left: 0px; padding-top:10px; padding-bottom:0px;">
            <![endif]-->
            <div class="col num12"
                style="min-width: 320px; max-width: 620px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                        <!--<![endif]-->
                        <div align="center" class="img-container center autowidth fullwidth"
                            style="padding-right: 0px;padding-left: 0px;">
                            <!--[if mso]>
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr style="line-height:0px">
                                <td style="padding-right: 0px;padding-left: 0px;" align="center">
                        <![endif]-->
                            <!--[if mso]></td></tr></table><![endif]-->
                        </div>
                        <!--[if (!mso)&(!IE)]><!-->
                    </div>
                    <!--<![endif]-->
                </div>
            </div>
            <!--[if (mso)|(IE)]>
                        </td>
                    </tr>
                </table>
            </td>
            </tr>
            </table>
            </td>
            </tr>
            </table>
            <![endif]-->
        </div>
    </div>
</div>

<div style="background-color:transparent;">
    <div class="block-grid "
        style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
            <!--[if (mso)|(IE)]>
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;">
                <tr>
                    <td align="center">
                        <table cellpadding="0" cellspacing="0" border="0" style="width:620px">
                            <tr class="layout-full-width" style="background-color:#fff">
            <![endif]-->
            <!--[if (mso)|(IE)]>
            <td align="center" width="620" style="background-color:#fff;width:620px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:10px;">
            <![endif]-->
            <div class="col num12"
                style="min-width: 320px; max-width: 620px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                        <!--<![endif]-->
                        <div class="img-container left autowidth " style="padding-right: 22px;padding-left: 22px;">
                            <!--[if mso]>
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr style="line-height:0px">
                                <td style="padding-right: 22px;padding-left: 22px;" align="left">
                        <![endif]-->
                            <a href="#" target="_blank"
                                style="display:block; width:200px!important; width:200px!important; height:50px!important; text-align:center;">
                                <img style="margin-top:20px;" alt="Image" border="0" class="center autowidth "
                                    src="<?php echo $imgdir; ?>nf/logo.jpg" title="Image" width="180" height="45">
                            </a>
                            <div style="font-size:1px;line-height:22px"> </div>
                            <!--[if mso]></td></tr></table><![endif]-->
                        </div>
                        <!--[if (!mso)&(!IE)]><!-->
                    </div>
                    <!--<![endif]-->
                </div>
            </div>
            <!--[if (mso)|(IE)]>
                        </td>
                    </tr>
                </table>
            </td>
            </tr>
            </table>
            </td>
            </tr>
            </table>
            <![endif]-->
        </div>
    </div>
</div>

<div style="background-color:transparent;">
    <div class="block-grid three-up"
        style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
            <!--[if (mso)|(IE)]>
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;">
                <tr>
                    <td align="center">
                        <table cellpadding="0" cellspacing="0" border="0" style="width:620px">
                            <tr class="layout-full-width" style="background-color:#fff">
            <![endif]-->
            <!--[if (mso)|(IE)]>
            <td align="center" width="206" style="background-color:#fff;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 1px solid #DFDFDF;" valign="top">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td style="padding-right: 0px; padding-left: 0px; padding-top:20px; padding-bottom:10px;">
            <![endif]-->
            <div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:1px solid #DFDFDF; padding-top:10px; padding-bottom:10px; padding-right: 0px; padding-left: 0px;">
                        <!--<![endif]-->
                        <div align="center" class="img-container center autowidth "
                            style="padding-right: 0px;padding-left: 0px; height:26px;">
                            <!--[if mso]>
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr style="line-height:0px">
                                <td style="padding-right: 0px;padding-left: 0px;" align="center">
                        <![endif]-->
                            <img align="center" alt="Image" border="0" class="center autowidth "
                                src="<?php echo $imgdir; ?>barcode.png"
                                style="outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; clear: both; border: 0; height: 21px!important; float: none; width: 27px !important; max-width: 27px!important; display: block;"
                                title="Image" width="27" height="21">
                            <!--[if mso]></td></tr></table><![endif]-->
                        </div>
                        <!--[if mso]>
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif">
                    <![endif]-->
                        <div
                            style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:0px;padding-left:10px;">
                            <div
                                style="font-size: 12px; line-height: 14px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                                <p style="font-size: 14px; line-height: 19px; text-align: center; margin: 0;">
                                    <span
                                        style="color: #999999; font-size: 14px; line-height: 19px;"><?php echo __('Order number:', 'nutrisslim-suiteV2');?></span>
                                    <strong>#<?php echo $order->get_id(); ?></strong>
                                </p>
                            </div>
                        </div>
                        <!--[if mso]></td></tr></table><![endif]-->
                        <!--[if (!mso)&(!IE)]><!-->
                    </div>
                    <!--<![endif]-->
                </div>
            </div>
            <!--[if (mso)|(IE)]></td>
            <td align="center" width="206" style="background-color:#fff;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 1px solid #DFDFDF;" valign="top">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td style="padding-right: 0px; padding-left: 0px; padding-top:15px; padding-bottom:10px;">
            <![endif]-->
            <div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:1px solid #DFDFDF; padding-top:10px; padding-bottom:10px; padding-right: 0px; padding-left: 0px;">
                        <!--<![endif]-->
                        <div align="center" class="img-container center autowidth "
                            style="padding-right: 0px;padding-left: 0px;">
                            <!--[if mso]>
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr style="line-height:0px">
                                <td style="padding-right: 0px;padding-left: 0px;" align="center">
                        <![endif]-->
                            <img align="center" alt="Image" border="0" class="center autowidth"
                                src="<?php echo $imgdir; ?>calendar.png"
                                style="outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; clear: both; border: 0; height: 26px !important; float: none; width: 27px !important; max-width: 27px!important; display: block;"
                                title="Image" width="27" height="26">
                            <!--[if mso]></td></tr></table><![endif]-->
                        </div>
                        <!--[if mso]>
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif">
                    <![endif]-->
                        <?php
                        $order_date = $order->get_date_created();
                        $formatted_order_date = $order_date->date('d/m/Y');
                    ?>
                        <div
                            style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:0px;padding-left:10px;">
                            <div
                                style="font-size: 12px; line-height: 14px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                                <p style="font-size: 14px; line-height: 19px; text-align: center; margin: 0;">
                                    <span
                                        style="color: #999999; font-size: 14px; line-height: 19px;"><?php echo __('Date:', 'nutrisslim-suiteV2');?></span>
                                    <strong><?php echo $formatted_order_date; ?></strong>
                                </p>
                            </div>
                        </div>
                        <!--[if mso]></td></tr></table><![endif]-->
                        <!--[if (!mso)&(!IE)]><!-->
                    </div>
                    <!--<![endif]-->
                </div>
            </div>
            <!--[if (mso)|(IE)]></td>
            <td align="center" width="206" style="background-color:#fff;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td style="padding-right: 0px; padding-left: 0px; padding-top:15px; padding-bottom:5px;">
            <![endif]-->
            <div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                        <!--<![endif]-->
                        <div align="center" class="img-container center autowidth "
                            style="padding-right: 0px;padding-left: 0px;">
                            <!--[if mso]>
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr style="line-height:0px">
                                <td style="padding-right: 0px;padding-left: 0px;" align="center">
                        <![endif]-->
                            <img align="center" alt="Image" border="0" class="center autowidth "
                                src="<?php echo $imgdir; ?>euro.png"
                                style="outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; clear: both; border: 0; height: 26px !important; float: none; width: 24px !important; max-width: 24px !important; display: block;"
                                title="Image" width="24" height="26">
                            <!--[if mso]></td></tr></table><![endif]-->
                        </div>
                        <!--[if mso]>
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif">
                    <![endif]-->
                        <div
                            style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:0px;padding-left:10px;">
                            <div
                                style="font-size: 12px; line-height: 14px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                                <p style="font-size: 14px; line-height: 19px; text-align: center; margin: 0;">
                                    <span
                                        style="color: #999999; font-size: 14px; line-height: 19px;"><?php echo __('Total', 'nutrisslim-suiteV2');?>:</span>
                                    <strong> <?php echo wc_price($order->get_total()); ?> </strong>
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
    <div class="block-grid"
        style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
        <div style="border-collapse: collapse; display: table; width: 100%; background-color:#FFFFFF;">
            <!--[if (mso)|(IE)]>
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;">
                <tr>
                    <td align="center">
                        <table cellpadding="0" cellspacing="0" border="0" style="width:620px">
                            <tr class="layout-full-width" style="background-color:#FFFFFF">
            <![endif]-->
            <!--[if (mso)|(IE)]>
            <td align="center" width="620" style="background-color:#FFFFFF;width:620px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td style="padding-right: 0px; padding-left: 0px; padding-top:15px; padding-bottom:10px;">
            <![endif]-->
            <div class="col num12"
                style="min-width: 320px; max-width: 620px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                        <!--<![endif]-->
                        <!--[if mso]>
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td style="padding-right: 40px; padding-left: 40px; padding-top: 15px; padding-bottom: 15px; font-family: sans-serif">
                    <![endif]-->
                        <div
                            style="color:#000000;font-family:'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;line-height:150%;padding-top:15px;padding-right:40px;padding-bottom:15px;padding-left:40px;">
                            <div
                                style="line-height: 18px; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size: 12px; color: <?php echo $theme_color; ?>;">
                                <p style="line-height: 36px; text-align: center; font-size: 12px; margin: 0;">
                                    <span style="font-size: 24px;">
                                        <strong><?php echo __('Order', 'nutrisslim-suiteV2');?></strong>
                                    </span>
                                </p>
                                <p
                                    style="font-size: 14px!important; line-height: 21px!important; margin: 0; color:#555555!important; font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif!important;">
                                    <?php echo $emailMSG; ?>
                                </p>
                            </div>
                        </div>
                        <!--[if mso]>
                            </td>
                        </tr>
                    </table>
                    <![endif]-->
                        <!--[if (!mso)&(!IE)]><!-->
                    </div>
                    <!--<![endif]-->
                </div>
            </div>
            <!--[if (mso)|(IE)]>
                        </td>
                    </tr>
                </table>
            </td>
            </tr>
            </table>
            </td>
            </tr>
            </table>
            <![endif]-->
        </div>
    </div>
</div>

<!-- Header -->
<div style="background-color:transparent;">
    <div class="block-grid three-up no-stack"
        style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: <?php echo $theme_color; ?>;">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:<?php echo $theme_color; ?>;">
            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:<?php echo $theme_color; ?>;"><![endif]-->
            <!--[if (mso)|(IE)]><td align="center" width="206" style="background-color:<?php echo $theme_color; ?>;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 1px solid <?php echo $theme_color; ?>;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
            <div class="col num6" style="max-width: 480px; min-width: 309px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:1px solid <?php echo $theme_color; ?>; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                        <!--<![endif]-->
                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
                        <div
                            style="color:#FFFFFF;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
                            <div
                                style="font-size: 12px; line-height: 14px; color: #FFFFFF; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                                <p style="font-size: 14px; line-height: 15px; text-align: center; margin: 0;"><span
                                        style="font-size: 14px; line-height: 19px; mso-ansi-font-size: 14px;"><strong><?php echo __('Product', 'nutrisslim-suiteV2'); ?>:</strong></span>
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
            <!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:#000000;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 1px solid #000000;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
            <div class="col num2" style="max-width: 160px; min-width: 103px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:1px solid <?php echo $theme_color; ?>; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                        <!--<![endif]-->
                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
                        <div
                            style="color:#FFFFFF;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
                            <div
                                style="line-height: 14px; font-size: 12px; color: #FFFFFF; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                                <p style="line-height: 15px; text-align: center; font-size: 12px; margin: 0;"><span
                                        style="font-size: 14px; line-height: 19px; mso-ansi-font-size: 14px;"><strong><?php echo __('Quantity', 'nutrisslim-suiteV2'); ?>:</strong></span>
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
            <!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:#000000;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
            <div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                        <!--<![endif]-->
                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
                        <div
                            style="color:#FFFFFF;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
                            <div
                                style="font-size: 12px; line-height: 14px; color: #FFFFFF; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                                <p style="font-size: 14px; line-height: 19px; text-align: center; margin: 0;"><span
                                        style="font-size: 14px; line-height: 19px; mso-ansi-font-size: 14px;"><strong><?php echo __('Price', 'nutrisslim-suiteV2');?>:</strong></span>
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
    <div class="block-grid "
        style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:#fff"><![endif]-->
            <!--[if (mso)|(IE)]><td align="center" width="620" style="background-color:#fff;width:620px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
            <div class="col num12"
                style="min-width: 320px; max-width: 620px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                        <!--<![endif]-->
                        <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation"
                            style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
                            valign="top" width="100%">
                            <tbody>
                                <tr style="vertical-align: top;" valign="top">
                                    <td class="divider_inner"
                                        style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-collapse: collapse;"
                                        valign="top">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                                            class="divider_content" height="0" role="presentation"
                                            style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 1px solid #BBBBBB; height: 0px;"
                                            valign="top" width="100%">
                                            <tbody>
                                                <tr style="vertical-align: top;" valign="top">
                                                    <td height="0"
                                                        style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;"
                                                        valign="top"><span></span></td>
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

<?php
    echo wc_get_email_order_items( $order, array( // WPCS: XSS ok.
        'show_sku'      => $sent_to_admin,
        'show_image'    => false,
        'image_size'    => array( 32, 32 ),
        'plain_text'    => $plain_text,
        'sent_to_admin' => $sent_to_admin,
    ) );
?>

<div style="background-color:transparent;">
    <div class="block-grid three-up no-stack"
        style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:#FFFFFF"><![endif]-->
            <!--[if (mso)|(IE)]><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:20px; padding-bottom:0px;"><![endif]-->
            <div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:15px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                        <!--<![endif]-->
                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left:22px; padding-top: 0px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
                        <div
                            style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:22px; text-align: left;">
                            <div
                                style="font-size: 12px; line-height: 14px; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; color: #555555;">
                                <p style="font-size: 14px; line-height: 19px; margin: 0;"><span
                                        style="font-size: 14px;"><?php echo __('Produkty', 'nutrisslim-suiteV2'); ?><br><span
                                            style="font-size: 12px; line-height: 14px; white-space: nowrap;"><?php echo __('(incl. tax)', 'nutrisslim-suiteV2'); ?></span></span>
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
            <!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:10px; padding-bottom:10px;"><![endif]-->
            <div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:10px; padding-right: 0px; padding-left: 0px;">
                        <!--<![endif]-->
                        <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation"
                            style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
                            valign="top" width="100%">
                            <tbody>
                                <tr style="vertical-align: top;" valign="top">
                                    <td class="divider_inner"
                                        style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-collapse: collapse;"
                                        valign="top">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                                            class="divider_content" height="0" role="presentation"
                                            style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 0px;"
                                            valign="top" width="100%">
                                            <tbody>
                                                <tr style="vertical-align: top;" valign="top">
                                                    <td height="0"
                                                        style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;"
                                                        valign="top"><span></span></td>
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
            <!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:22px; padding-bottom:0px;"><![endif]-->
            <div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:15px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                        <!--<![endif]-->
                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 20px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
                        <div
                            style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:10px;padding-bottom:20px;padding-left:10px;">
                            <div
                                style="font-size: 12px; line-height: 14px; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; color: #555555;">
                                <p style="font-size: 12px; line-height: 19px; text-align: center; margin: 0;"><span
                                        style="font-size: 14px;"><strong><?php echo $order->get_subtotal_to_display(); ?></strong></span>
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
    <div class="block-grid three-up no-stack"
        style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
        <div style="border-collapse: collapse; display: table; width: 100%; background-color:#FFFFFF;">
            <!--[if (mso)|(IE)]>
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;">
            <tr>
                <td align="center">
                    <table cellpadding="0" cellspacing="0" border="0" style="width:620px">
                        <tr class="layout-full-width" style="background-color:#FFFFFF">
        <![endif]-->
            <!--[if (mso)|(IE)]>
            <td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td style="padding-right: 0px; padding-left: 0px; padding-top:10px; padding-bottom:5px;">
        <![endif]-->
            <div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                        <!--<![endif]-->
                        <!--[if mso]>
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td style="padding-right: 0px; padding-left: 22px; padding-top: 0px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif">
                    <![endif]-->
                        <div
                            style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:22px; text-align: left;">
                            <div
                                style="font-size: 12px; line-height: 14px; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; color: #555555;">
                                <p style="font-size: 14px; line-height: 19px; margin: 0;">
                                    <span
                                        style="font-size: 14px;"><?php echo __('Shipping amount', 'nutrisslim-suiteV2'); ?><br></span>
                                </p>
                            </div>
                        </div>
                        <!--[if mso]>
                            </td>
                        </tr>
                    </table>
                    <![endif]-->
                        <!--[if (!mso)&(!IE)]><!-->
                    </div>
                    <!--<![endif]-->
                </div>
            </div>
            <!--[if (mso)|(IE)]>
                        </td>
                    </tr>
                </table>
            </td>
        <![endif]-->
            <!--[if (mso)|(IE)]>
            <td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;">
        <![endif]-->
            <div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                        <!--<![endif]-->
                        <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation"
                            style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
                            valign="top" width="100%">
                            <tbody>
                                <tr style="vertical-align: top;" valign="top">
                                    <td class="divider_inner"
                                        style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-collapse: collapse;"
                                        valign="top">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                                            class="divider_content" height="0" role="presentation"
                                            style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 0px;"
                                            valign="top" width="100%">
                                            <tbody>
                                                <tr style="vertical-align: top;" valign="top">
                                                    <td height="0"
                                                        style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;"
                                                        valign="top">
                                                        <span></span>
                                                    </td>
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
            <!--[if (mso)|(IE)]>
                        </td>
                    </tr>
                </table>
            </td>
        <![endif]-->
            <!--[if (mso)|(IE)]>
            <td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td style="padding-right: 0px; padding-left: 0px; padding-top:20px; padding-bottom:0px;">
        <![endif]-->
            <div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                        <!--<![endif]-->
                        <!--[if mso]>
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 20px; font-family: 'Trebuchet MS', Tahoma, sans-serif">
                    <![endif]-->
                        <div
                            style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:10px;padding-bottom:20px;padding-left:10px;">
                            <div
                                style="font-size: 12px; line-height: 14px; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; color: #555555;">
                                <p style="font-size: 12px; line-height: 19px; text-align: center; margin: 0;">
                                    <span
                                        style="font-size: 14px;"><strong><?php echo wc_price($order->get_shipping_total() + $order->get_shipping_tax()); ?></strong></span>
                                </p>
                            </div>
                        </div>
                        <!--[if mso]>
                            </td>
                        </tr>
                    </table>
                    <![endif]-->
                        <!--[if (!mso)&(!IE)]><!-->
                    </div>
                    <!--<![endif]-->
                </div>
            </div>
            <!--[if (mso)|(IE)]>
                        </td>
                    </tr>
                </table>
            </td>
        <![endif]-->
            <!--[if (mso)|(IE)]>
                    </tr>
                </table>
            </td>
        </tr>
        </table>
        <![endif]-->
        </div>
    </div>
</div>


<?php
// $cod_extra_fee = get_post_meta($order_id, 'cod_extra_fee', true);


foreach ( $order->get_fees() as $fee ) {
    // Get the fee name
    $fee_name = $fee->get_name();

    // Get the fee total and total tax
    $fee_total = $fee->get_total();
    $fee_total_tax = $fee->get_total_tax();

    $fee_total_incl_tax = $fee_total + $fee_total_tax;


    // Calculate the total including tax
    $fee_total_incl_tax = wc_price( $fee_total_incl_tax );

    ?>
<!-- FEE FOR CASH ON DELIVERY -->
<div style="background-color:transparent;">
    <div class="block-grid three-up no-stack"
        style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:620px"><tr class="layout-full-width" style="background-color:#FFFFFF"><![endif]-->
            <!--[if (mso)|(IE)]><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:10px; padding-bottom:5px;"><![endif]-->
            <div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                        <!--<![endif]-->
                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 22px; padding-top: 0px; padding-bottom: 10px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
                        <div
                            style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:22px; text-align: left;">
                            <div
                                style="font-size: 12px; line-height: 14px; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; color: #555555;">
                                <p style="font-size: 14px; line-height: 19px; margin: 0;"><span
                                        style="font-size: 14px;"><?php echo __(esc_html( $fee_name ), 'nutrisslim-suiteV2'); ?><br></span></span>
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
            <!--[if (mso)|(IE)]></td><td align="center" width="206" style="background-color:#FFFFFF;width:206px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
            <div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                        <!--<![endif]-->
                        <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation"
                            style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
                            valign="top" width="100%">
                            <tbody>
                                <tr style="vertical-align: top;" valign="top">
                                    <td class="divider_inner"
                                        style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-collapse: collapse;"
                                        valign="top">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                                            class="divider_content" height="0" role="presentation"
                                            style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 0px;"
                                            valign="top" width="100%">
                                            <tbody>
                                                <tr style="vertical-align: top;" valign="top">
                                                    <td height="0"
                                                        style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;"
                                                        valign="top"><span></span></td>
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
            <div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <!--[if (!mso)&(!IE)]><!-->
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                        <!--<![endif]-->
                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 20px; font-family: 'Trebuchet MS', Tahoma, sans-serif"><![endif]-->
                        <div
                            style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:10px;padding-bottom:20px;padding-left:10px;">
                            <div
                                style="font-size: 12px; line-height: 14px; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; color: #555555;">
                                <p style="font-size: 12px; line-height: 19px; text-align: center; margin: 0;"><span
                                        style="font-size: 14px;"><strong><?php echo $fee_total_incl_tax; ?></strong></span>
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


    // Output the fee name and total including tax
    // echo '<div class="col-8 text-right label">' . __(esc_html( $fee_name ), 'nutrisslim-suiteV2') . '</div>';
    // echo '<div class="col-4 text-right">' . $fee_total_incl_tax . '</div>';
}

/*
$coupons = $order->get_items('coupon');

foreach ($coupons as $item_id => $item) {
    $coupon_code = $item->get_code();
    $discount_amount = $item->get_discount();
?>

<!-- Discount Section -->
<div style="background-color:transparent;">
    <div class="block-grid three-up no-stack"
        style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
            <div class="col num4"
                style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: middle;">
                <div style="width:100% !important;">
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                        <div
                            style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:0px;padding-bottom:10px;padding-left:22px;">
                            <div
                                style="font-size: 12px; line-height: 14px; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; color: #555555;">
                                <p style="font-size: 14px; line-height: 19px; margin: 0;text-align:left;"><span
                                        style="font-size: 14px;"><?php echo __('Coupon:', 'nutrisslim-suiteV2') . ' ' . $coupon_code; ?>
                                        <br></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                        <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation"
                            style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
                            valign="top" width="100%">
                            <tbody>
                                <tr style="vertical-align: top;" valign="top">
                                    <td class="divider_inner"
                                        style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-collapse: collapse;"
                                        valign="top">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                                            class="divider_content" height="0" role="presentation"
                                            style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 0px;"
                                            valign="top" width="100%">
                                            <tbody>
                                                <tr style="vertical-align: top;" valign="top">
                                                    <td height="0"
                                                        style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;"
                                                        valign="top"><span></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:20px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                        <div
                            style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:10px;padding-bottom:20px;padding-left:10px;">
                            <div
                                style="font-size: 12px; line-height: 14px; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; color: #555555;">
                                <p style="font-size: 12px; line-height: 19px; text-align: center; margin: 0;"><span
                                        style="font-size: 14px;"><strong>- <?php echo wc_price($discount_amount); ?>
                                        </strong></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}*/
?>


<!-- Payment Method Section -->
<div style="background-color:transparent;">
    <div class="block-grid three-up no-stack"
        style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
            <div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:15px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                        <div
                            style="color:#555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:150%;padding-top:5px;padding-right:0px;padding-bottom:0px;padding-left:22px; text-align: left;">
                            <div
                                style="font-size: 12px; line-height: 18px; color: #555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                                <p style="font-size: 14px; line-height: 19px; margin: 0;">
                                    <?php echo __('Payment method:', 'nutrisslim-suiteV2'); ?></p>
                                <p style="font-size: 14px; line-height: 19px; margin: 0;"><span
                                        style="font-size: 14px;"><strong><span
                                                style="line-height: 19px; font-size: 14px;"><?php echo $order->get_payment_method(); ?></span></strong></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                        <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation"
                            style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
                            valign="top" width="100%">
                            <tbody>
                                <tr style="vertical-align: top;" valign="top">
                                    <td class="divider_inner"
                                        style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-collapse: collapse;"
                                        valign="top">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                                            class="divider_content" height="0" role="presentation"
                                            style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 0px;"
                                            valign="top" width="100%">
                                            <tbody>
                                                <tr style="vertical-align: top;" valign="top">
                                                    <td height="0"
                                                        style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;"
                                                        valign="top"><span></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col num4" style="max-width: 320px; min-width: 206px; display: table-cell; vertical-align: top;">
                <div style="background-color:#1fb25a;width:100% !important;">
                    <div
                        style="border-top:0px solid transparent; border-left:1px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                        <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation"
                            style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
                            valign="top" width="100%">
                            <tbody>
                                <tr style="vertical-align: top;" valign="top">
                                    <td class="divider_inner"
                                        style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 3px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-collapse: collapse;"
                                        valign="top">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                                            class="divider_content" height="0" role="presentation"
                                            style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 0px;"
                                            valign="top" width="100%">
                                            <tbody>
                                                <tr style="vertical-align: top;" valign="top">
                                                    <td height="0"
                                                        style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;"
                                                        valign="top"><span></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div
                            style="color:#FFFFFF;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:120%;padding-top:0px;padding-right:10px;padding-bottom:7px;padding-left:10px;">
                            <div
                                style="font-size: 12px; line-height: 14px; color: #FFFFFF; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                                <p style="font-size: 14px; line-height: 24px; text-align: center; margin: 0;"><span
                                        style="font-size: 14px;"><strong><?php echo wc_price($order->get_total()); ?></strong></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php /*
if ($order->get_payment_method() === 'bacs') {
?>

<!-- BACS Information Section -->
<div style="background-color:transparent;">
    <div class="block-grid "
        style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
            <div class="col num12"
                style="min-width: 320px; max-width: 620px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                        <div
                            style="color:#1fb25a;font-family:'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;line-height:150%;padding-top:15px;padding-right:22px;padding-bottom:15px;padding-left:22px;">
                            <div
                                style="line-height: 18px; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size: 12px; color: #1fb25a;">
                                <p
                                    style="font-size: 14px!important; text-align: left; line-height: 21px!important; margin: 0; color:#555555!important; font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif!important;">
                                    <b><?php echo __('Our bank details', 'nutrisslim-suiteV2'); ?>:</b>
                                </p>
                                <p style="font-size: 14px; line-height: 19px; margin: 0; text-align:left">
                                    <?php $bank_details = get_option('woocommerce_bacs_accounts'); ?>
                                    <strong><?php echo __('Bank name', 'nutrisslim-suiteV2'); ?>:
                                    </strong><?php echo $bank_details[0]['bank_name']; ?><br>
                                    <strong><?php echo __('Account number', 'nutrisslim-suiteV2'); ?>:
                                    </strong><?php echo $bank_details[0]['account_number']; ?><br>
                                    <strong><?php echo __('IBAN', 'nutrisslim-suiteV2'); ?>:
                                    </strong><?php echo $bank_details[0]['BAKOSI2X']; ?><br>
                                    <strong><?php echo __('BIC / Swift', 'nutrisslim-suiteV2'); ?>:
                                    </strong><?php echo $bank_details[0]['bic']; ?><br>
                                    <strong>Referenca: </strong><?php echo $order->get_shipping_country(); ?>
                                    <?php echo $order->get_id(); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}
*/ ?>

<?php
$delivery_days_text = get_delivery_days_text_from_order($order);
if ($delivery_days_text) {
    $shipping_method_label = reset($order->get_shipping_methods())->get_method_title();
?>

<!-- Estimated Delivery Time for Ireland Section -->
<div style="background-color:transparent;">
    <div class="block-grid "
        style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
            <div class="col num12"
                style="min-width: 320px; max-width: 620px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                        <div
                            style="color:#1fb25a;font-family:'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;line-height:150%;padding-top:15px;padding-right:22px;padding-bottom:15px;padding-left:22px;">
                            <div
                                style="line-height: 18px; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size: 12px; color: #1fb25a;">
                                <p
                                    style="font-size: 14px!important; text-align: left; line-height: 21px!important; margin: 0; color:#555555!important; font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif!important;">
                                    <?php 
									// DANIEL EDITED 15.11
									/*echo sprintf(
                                            __('<b>Estimated Delivery date:</b> %1$s, %2$s delivery service.', 'nutrisslim-suiteV2'),
                                            $delivery_days_text,
                                            $shipping_method_label
                                        ); */
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<?php
$customer_note = $order->get_customer_note();
if ($customer_note) {
?>

<!-- Customer Note Section -->
<div style="background-color:transparent;">
    <div class="block-grid two-up"
        style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
            <div class="col num12"
                style="max-width: 620px; min-width: 320px; display: table-cell; vertical-align: top;">
                <div style="width:100% !important;">
                    <div
                        style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:20px; padding-bottom:20px; padding-right: 10px; padding-left: 22px;">
                        <div
                            style="color:#1fb25a;font-family:'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;line-height:150%;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;">
                            <div
                                style="line-height: 18px; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size: 12px; color: #1fb25a;">
                                <p style="line-height: 24px; font-size: 12px; text-align: left; margin: 0;"><span
                                        style="font-size: 14px;"><strong><?php echo __('Customer note', 'nutrisslim-suiteV2'); ?>:</strong></span>
                                </p>
                            </div>
                        </div>
                        <div
                            style="color:#555555;font-family:'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;line-height:150%;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;">
                            <div
                                style="font-size: 12px; line-height: 18px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                                <p style="font-size: 14px; line-height: 19px; margin: 0; text-align:left;">
                                    <?php echo $customer_note; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>