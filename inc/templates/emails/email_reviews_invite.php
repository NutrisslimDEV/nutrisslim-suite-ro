<?php // this partial is for review invitations sent in a confirmation email
// global $trusted_review_link;
// global $review_invite;
$theme_color = '#1fb25a';
$utm_tag = '&utm_source=internal-review&utm_medium=mail-conf&utm_campaign=nf';
// $reviews_link_url = get_the_permalink($reviews_link_id);
$reviews_link_page = get_page_by_path('submit-review');
$reviews_link_url = get_permalink($reviews_link_page->ID);
$reviews_link = $reviews_link_url . '?order_id=' . $custom_order_id . '&order_key=' . $order_key . $utm_tag;
/*
            $reviews_link_url = get_the_permalink($reviews_link_id);
            $reviews_link_url = preg_replace('#/$#', '', $reviews_link_url);
            $reviews_link = $reviews_link_url . '?order_id=' . $custom_order_id . '&order_key=' . $order_key . $utm_tag;
    
            $avg_rating = get_field('avg_rating',$reviews_link_id);
            $n_of_reviews = get_field('n_of_reviews',$reviews_link_id);
            if($n_of_reviews == 1 || $n_of_reviews == 101){
                $reviews_text =  __('ocena','nutrisslim-suiteV2');
            } else if($n_of_reviews == 2 || $n_of_reviews == 102){
                $reviews_text =  __('oceni','nutrisslim-suiteV2');
            } else if($n_of_reviews == 3 || $n_of_reviews == 4 || $n_of_reviews == 103 || $n_of_reviews == 104){
                $reviews_text =  __('ocene','nutrisslim-suiteV2');
            } else{
                $reviews_text =  __('ocen','nutrisslim-suiteV2');
            }
*/            
/*
if($trusted_review_link == false){
    $utm_tag = '&utm_source=internal-review&utm_medium=mail-conf&utm_campaign=nf';
    if(get_field('show_reviews_invite_link_in_emails','option') == true){
        $reviews_link_id = get_field('reviews_page','option');
        global $custom_order_id;
        $order_key = false;
        if($custom_order_id){
            $order_data = wc_get_order( $custom_order_id );
            $order_key = $order_data->get_order_key();
        } 
    
        if($reviews_link_id && $custom_order_id && $order_key){

            ?>
<div class="block-grid "
    style="line-height: inherit; margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;"
    bgcolor="#FFFFFF">
    <div style="color: <?php echo $theme_color; ?>; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; line-height: 150%; padding-top: 15px; padding-right: 40px; padding-bottom: 15px; padding-left: 40px; background-color: #fff;"
        width="100%" bgcolor="#fff">
        <div
            style="line-height: 18px; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size: 12px; color: <?php echo $theme_color; ?>;">
            <p style="line-height: 19px; font-size: 12px; text-align: center; margin: 0; margin-bottom:10px;"
                align="left"><span style="line-height: inherit; font-size: 14px;"><strong
                        style="line-height: inherit;"><?php echo __('Rate Nature’s Finest and get a reward!', 'nutrisslim-suiteV2'); ?></strong></span>
            </p>
            <p
                style="margin: 0; margin-bottom:10px; font-size: 14px; line-height: 21px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                <?php echo __('We are always trying to improve our products and services and we would really appreciate your feedback.', 'nutrisslim-suiteV2'); ?>
            </p>
            <p
                style="margin: 0; margin-bottom:10px; font-size: 14px; line-height: 21px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                <?php echo __('<b>Rate your experience with us</b> - and as a thank you, we will send a <b>special gift</b> with your order!', 'nutrisslim-suiteV2'); ?>
            </p>
            <a href="<?php echo $reviews_link; ?>" target="_blank" style="text-decoration:none!important;"><img
                    align="center" alt="Image" border="0" class="center autowidth "
                    src="<?php echo get_template_directory_uri(); ?>/img/email/tr-stars-big.png"
                    style="outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; clear: both; border: 0; height: 38px; float: none; width: 250px !important; max-width: 250px !important; display: block; margin-bottom:15px;"
                    title="Image" width="250" height="38"></a>
            <p
                style="margin: 0; font-size: 14px; line-height: 21px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                <a href="<?php echo $reviews_link; ?>" target="_blank"
                    style="margin-bottom:10px; color:#ffffff; background-color:<?php echo $theme_color; ?>; text-decoration:none!important; width:150px; height:50px; line-height:50px; text-transform:uppercase; text-align:center; display:inline-block; padding:0 10px;"
                    bgcolor="<?php echo $theme_color; ?>">
                    <?php echo __('RATE SHOP NOW', 'nutrisslim-suiteV2'); ?>
                </a>
            </p>
            <p
                style="margin: 0; font-size: 12px; line-height: 21px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                <img align="center" alt="Image" border="0" class="center autowidth "
                    src="<?php echo get_template_directory_uri(); ?>/img/email/tr-stars-small.png"
                    style="outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; clear: both; border: 0; height: 14px; float: none; width: 82px !important; max-width: 82px !important; display: inline-block;"
                    title="Image" width="82" height="14">
                <?php echo __('Povprečna ocena','nutrisslim-suiteV2') . ' ' . $avg_rating . ' (' . $n_of_reviews . ' ' . $reviews_text . ')'; ?>
            </p>
        </div>
    </div>
</div>
<?php
        }
    }
}
*/
?>

<div class="block-grid "
    style="line-height: inherit; margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;"
    bgcolor="#FFFFFF">
    <div style="color: <?php echo $theme_color; ?>; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; line-height: 150%; padding-top: 15px; padding-right: 40px; padding-bottom: 15px; padding-left: 40px; background-color: #fff;"
        width="100%" bgcolor="#fff">
        <div
            style="line-height: 18px; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size: 12px; color: <?php echo $theme_color; ?>;">
            <p style="line-height: 19px; font-size: 12px; text-align: center; margin: 0; margin-bottom:10px;"
                align="left"><span style="line-height: inherit; font-size: 14px;"><strong
                        style="line-height: inherit;"><?php echo __('Rate Nature’s Finest and get a reward!', 'nutrisslim-suiteV2'); ?></strong></span>
            </p>
            <p
                style="margin: 0; margin-bottom:10px; font-size: 14px; line-height: 21px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                <?php echo __('We are always trying to improve our products and services and we would really appreciate your feedback.', 'nutrisslim-suiteV2'); ?>
            </p>
            <p
                style="margin: 0; margin-bottom:10px; font-size: 14px; line-height: 21px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                <?php echo __('<b>Rate your experience with us</b> - and as a thank you, we will send a <b>special gift</b> with your order!', 'nutrisslim-suiteV2'); ?>
            </p>
            <a href="<?php echo $reviews_link; ?>" target="_blank" style="text-decoration:none!important;"><img
                    align="center" alt="Image" border="0" class="center autowidth "
                    src="<?php echo get_nutrislim_assets_url(); ?>/email/tr-stars-big.png"
                    style="outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; clear: both; border: 0; height: 38px; float: none; width: 250px !important; max-width: 250px !important; display: block; margin-bottom:15px;"
                    title="Image" width="250" height="38"></a>
            <p
                style="margin: 0; font-size: 14px; line-height: 21px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                <a href="<?php echo $reviews_link; ?>" target="_blank"
                    style="margin-bottom:10px; color:#ffffff; background-color:<?php echo $theme_color; ?>; text-decoration:none!important; width:150px; height:50px; line-height:50px; text-transform:uppercase; text-align:center; display:inline-block; padding:0 10px;"
                    bgcolor="<?php echo $theme_color; ?>">
                    <?php echo __('RATE SHOP NOW', 'nutrisslim-suiteV2'); ?>
                </a>
            </p>
            <p
                style="margin: 0; font-size: 12px; line-height: 21px; color: #555555; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                <img align="center" alt="Image" border="0" class="center autowidth "
                    src="<?php echo get_nutrislim_assets_url(); ?>/email/tr-stars-small.png"
                    style="outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; clear: both; border: 0; height: 14px; float: none; width: 82px !important; max-width: 82px !important; display: inline-block;"
                    title="Image" width="82" height="14">
                <?php echo __('Povprečna ocena','nutrisslim-suiteV2') . ' ' . $avg_rating . ' (' . $n_of_reviews . ' ' . $reviews_text . ')'; ?>
            </p>
        </div>
    </div>
</div>