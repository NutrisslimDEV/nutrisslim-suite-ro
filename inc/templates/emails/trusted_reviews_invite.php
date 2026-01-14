<?php 

if ( isset( $order ) && is_a( $order, 'WC_Order' ) ) {
    $order_id = $order->get_id();
    $order_key = $order->get_order_key();

    $utm_tag = '&utm_source=internal-review&utm_medium=mail-conf&utm_campaign=nf';
    $reviews_link_page = get_page_by_path('submit-review');

    if ( $reviews_link_page ) {
        $reviews_link_url = get_permalink($reviews_link_page->ID);
        $trusted_review_link = $reviews_link_url . '?order_id=' . $order_id . '&order_key=' . $order_key . $utm_tag;
    }
}
?>
<div class="block-grid "
    style="line-height: inherit; margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;"
    bgcolor="#FFFFFF">
    <div style="color: #1fb25a; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; line-height: 150%; padding-top: 15px; padding-right: 40px; padding-bottom: 15px; padding-left: 40px; background-color: #fff;"
        width="100%" bgcolor="#fff">
        <div
            style="line-height: 18px; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size: 12px; color: #1fb25a;">
            <p style="line-height: 19px; font-size: 12px; text-align: center; margin: 0; margin-bottom:10px;"
                align="left"><span style="line-height: inherit; font-size: 14px;"><strong
                        style="line-height: inherit;"><?php echo __('Rate Nature’s Finest and get a reward!', 'nutrisslim-suiteV2'); ?></strong></span>
            </p>
            <p
                style="margin: 0; margin-bottom:10px; font-size: 14px; line-height: 21px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                <?php echo __('We always strive to improve our products and services, and we greatly value your feedback.', 'nutrisslim-suiteV2'); ?>
            </p>
            <p
                style="margin: 0; margin-bottom:10px; font-size: 14px; line-height: 21px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                <?php echo __('<b>Rate your experience with us</b> – as a thank you, we’ll send a <b>special gift</b> with your order!', 'nutrisslim-suiteV2'); ?>
            </p>
            <a href="<?php echo $trusted_review_link; ?>" target="_blank" style="text-decoration:none!important;"><img
                    align="center" alt="Image" border="0" class="center autowidth "
                    src="<?php echo get_nutrislim_assets_url(); ?>/email/tr-stars-big.png"
                    style="outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; clear: both; border: 0; height: 38px; float: none; width: 250px !important; max-width: 250px !important; display: block; margin-bottom:15px;"
                    title="Image" width="250" height="38"></a>
            <p
                style="margin: 0; font-size: 14px; line-height: 21px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                <a href="<?php echo $trusted_review_link; ?>" target="_blank"
                    style="margin-bottom:10px; color:#ffffff; background-color:#1fb25a; text-decoration:none!important; width:150px; height:50px; line-height:50px; text-transform:uppercase; text-align:center; display:inline-block; padding:0 10px;"
                    bgcolor="#1fb25a">
                    <?php echo __('RATE THE STORE NOW', 'nutrisslim-suiteV2'); ?>
                </a>
            </p>
            <p
                style="margin: 0; font-size: 12px; line-height: 21px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                <a href="<?php echo $trusted_review_link; ?>" target="_blank"
                    style="text-decoration:none!important; color: #555555!important;"><?php echo __('Check out the rest ', 'nutrisslim-suiteV2'); ?>
                    <img align="center" alt="Image" border="0" class="center autowidth "
                        src="<?php echo get_nutrislim_assets_url(); ?>/email/tr-stars-small.png"
                        style="outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; clear: both; border: 0; height: 14px; float: none; width: 82px !important; max-width: 82px !important; display: inline-block;"
                        title="Image" width="82" height="14"> <?php echo __('reviews!', 'nutrisslim-suiteV2'); ?></a>
            </p>
        </div>
    </div>
</div>