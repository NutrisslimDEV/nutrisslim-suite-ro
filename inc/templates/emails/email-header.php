<?php
/**
 * Email Header
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-header.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates/Emails
 * @version 4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml" <?php language_attributes(); ?>>
	<head>
		<!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
		<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
		<meta content="width=device-width" name="viewport">
		<!--[if !mso]><!-->
		<meta content="IE=edge" http-equiv="X-UA-Compatible">
		<!--<![endif]-->
		<title></title>
		<!--[if !mso]><!-->
		<link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet" type="text/css">
		<!--<![endif]-->
		<title><?php echo get_bloginfo( 'name', 'display' ); ?></title>
	<style type="text/css">

body {
margin: 0;
padding: 0;
}

table,
td,
tr {
vertical-align: top;
border-collapse: collapse;
}

* {
line-height: inherit;
}

ul {
    padding-left:0;
    margin-top:0;
}

a[x-apple-data-detectors=true] {
color: inherit !important;
text-decoration: none !important;
}

.ie-browser table {
table-layout: fixed;
}

[owa] .img-container div,
[owa] .img-container button {
display: block !important;
}

[owa] .fullwidth button {
width: 100% !important;
}

[owa] .block-grid .col {
display: table-cell;
float: none !important;
vertical-align: top;
}

.ie-browser .block-grid,
.ie-browser .num12,
[owa] .num12,
[owa] .block-grid {
width: 620px !important;
}

.ie-browser .mixed-two-up .num4,
[owa] .mixed-two-up .num4 {
width: 204px !important;
}

.ie-browser .mixed-two-up .num8,
[owa] .mixed-two-up .num8 {
width: 408px !important;
}

.ie-browser .block-grid.two-up .col,
[owa] .block-grid.two-up .col {
width: 306px !important;
}

.ie-browser .block-grid.three-up .col, [owa] .block-grid.three-up .col {
width: 306px !important;
}

.ie-browser .block-grid.four-up .col, [owa] .block-grid.four-up .col {
width: 153px !important;
}

.ie-browser .block-grid.five-up .col, [owa] .block-grid.five-up .col {
width: 124px !important;
}

.ie-browser .block-grid.six-up .col,
[owa] .block-grid.six-up .col {
width: 103px !important;
}

.ie-browser .block-grid.seven-up .col,
[owa] .block-grid.seven-up .col {
width: 88px !important;
}

.ie-browser .block-grid.eight-up .col,
[owa] .block-grid.eight-up .col {
width: 77px !important;
}

.ie-browser .block-grid.nine-up .col,
[owa] .block-grid.nine-up .col {
width: 68px !important;
}

.ie-browser .block-grid.ten-up .col,
[owa] .block-grid.ten-up .col {
width: 60px !important;
}

.ie-browser .block-grid.eleven-up .col,
[owa] .block-grid.eleven-up .col {
width: 54px !important;
}

.ie-browser .block-grid.twelve-up .col,
[owa] .block-grid.twelve-up .col {
width: 50px !important;
}
</style> 
<style id="media-query" type="text/css">
@media only screen and (min-width: 640px) {
.block-grid {
width: 620px !important;
}

.block-grid .col {
vertical-align: top;
}

.block-grid .col.num12 {
width: 620px !important;
}

.block-grid.mixed-two-up .col.num3 {
width: 153px !important;
}

.block-grid.mixed-two-up .col.num4 {
width: 204px !important;
}

.block-grid.mixed-two-up .col.num8 {
width: 408px !important;
}

.block-grid.mixed-two-up .col.num9 {
width: 459px !important;
}

.block-grid.two-up .col {
width: 310px !important;
}

.block-grid.three-up .col {
width: 206px !important;
}

.block-grid.four-up .col {
width: 155px !important;
}

.block-grid.five-up .col {
width: 124px !important;
}

.block-grid.six-up .col {
width: 103px !important;
}

.block-grid.seven-up .col {
width: 88px !important;
}

.block-grid.eight-up .col {
width: 77px !important;
}

.block-grid.nine-up .col {
width: 68px !important;
}

.block-grid.ten-up .col {
width: 62px !important;
}

.block-grid.eleven-up .col {
width: 56px !important;
}

.block-grid.twelve-up .col {
width: 51px !important;
}
}

@media (max-width: 640px) {

.block-grid,
.col {
min-width: 320px !important;
max-width: 100% !important;
display: block !important;
}

.block-grid {
width: 100% !important;
}

.col {
width: 100% !important;
}

.col>div {
margin: 0 auto;
}

img.fullwidth,
img.fullwidthOnMobile {
max-width: 100% !important;
}

.no-stack .col {
min-width: 0 !important;
display: table-cell !important;
}

.no-stack.two-up .col {
width: 50% !important;
}

.no-stack .col.num4 {
width: 33% !important;
}

.no-stack .col.num8 {
width: 66% !important;
}

.no-stack .col.num4 {
width: 33% !important;
}

.no-stack .col.num3 {
width: 25% !important;
}

.no-stack .col.num6 {
width: 50% !important;
}

.no-stack .col.num9 {
width: 75% !important;
}

.video-block {
max-width: none !important;
}

.mobile_hide {
min-height: 0px;
max-height: 0px;
max-width: 0px;
display: none;
overflow: hidden;
font-size: 0px;
}

.desktop_hide {
display: block !important;
max-height: none !important;
}
}
</style> 
	</head>
	<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #DFDFDF;">
	<style id="media-query-bodytag" type="text/css">
@media (max-width: 640px) {
  .block-grid {
    min-width: 320px!important;
    max-width: 100%!important;
    width: 100%!important;
    display: block!important;
  }
  .col {
    min-width: 320px!important;
    max-width: 100%!important;
    width: 100%!important;
    display: block!important;
  }
  .col > div {
    margin: 0 auto;
  }
  img.fullwidth {
    max-width: 100%!important;
    height: auto!important;
  }
  img.fullwidthOnMobile {
    max-width: 100%!important;
    height: auto!important;
  }
  .no-stack .col {
    min-width: 0!important;
    display: table-cell!important;
  }
  .no-stack.two-up .col {
    width: 50%!important;
  }
  .no-stack.mixed-two-up .col.num4 {
    width: 33%!important;
  }
  .no-stack.mixed-two-up .col.num8 {
    width: 66%!important;
  }
  .no-stack.three-up .col.num4 {
    width: 33%!important
  }
  .no-stack.four-up .col.num3 {
    width: 25%!important
  }
}
</style>

<table bgcolor="#DFDFDF" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #DFDFDF; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; border-collapse: collapse;" valign="top">
<table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:#DFDFDF">
