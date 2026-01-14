<?php // this partial is for review invitations sent 2 weeks from purchase
if(defined('INSTANCENAME')){
    if(INSTANCENAME == 'NF1' || INSTANCENAME == 'NF2' || INSTANCENAME == 'NF3'){
        $theme_color = '#1fb25a';
        $theme_logo = 'nf/logo.jpg';
        if(INSTANCENAME == 'NF1' && ICL_LANGUAGE_CODE == 'en'){
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
    $country_code = ICL_LANGUAGE_CODE;
    if(($country_code == 'en') || ($country_code == 'de')){
        $country_code = check_for_country_duplicates($country_code);
    }

    $shop_country_code = get_country_code($country_code);
    if(($shop_country_code == SHOP_CODE . '1000') || ($shop_country_code == SHOP_CODE . '2300')){
        $acf_option_name = 'options';
    } else{
        $acf_option_name = 'options_' . ICL_LANGUAGE_CODE;
    }
            
    switch ($shop_country_code) {
        case SHOP_CODE . '1100': // Czech
            if(INSTANCENAME == 'BABE1'){
                $company_url = 'https://www.babesvitamins.cz';
                $compay_support_email = 'info@babesvitamins.cz';
            } else{
                $company_url = 'https://www.naturesfinest.cz';
                $compay_support_email = 'info@naturesfinest.cz';
            }
            break;
        case SHOP_CODE . '2000': // United Kingdom
            if(INSTANCENAME == 'BABE1'){
                $company_url = 'https://www.babesvitamins.co.uk';
                $compay_support_email = 'info@babesvitamins.co.uk';
            } else{
                $company_url = 'https://www.nutrisslim.uk';
                $compay_support_email = 'info@nutrisslim.uk';
            }
            break;
        case SHOP_CODE . '1500': // France
            if(INSTANCENAME == 'BABE1'){
                $company_url = 'https://www.babesvitamins.fr';
                $compay_support_email = 'info@babesvitamins.fr';
            } else{
                $company_url = 'https://www.naturesfinest.fr';
                $compay_support_email = 'info@naturesfinest.fr';
            }
            break;
        case SHOP_CODE . '3000': // Croatia
            if(INSTANCENAME == 'BABE1'){
                $company_url = 'https://www.babesvitamins.hr';
                $compay_support_email = 'info@babesvitamins.hr';
            } else{
                $company_url = 'https://www.naturesfinest.hr';
                $compay_support_email = 'info@naturesfinest.hr';
            }
            break;
        case SHOP_CODE . '8000': // Hungary
            if(INSTANCENAME == 'BABE1'){
                $company_url = 'https://www.babesvitamins.hu';
                $compay_support_email = 'info@babesvitamins.hu';
            } else{
                $company_url = 'https://www.naturesfinest.hu';
                $compay_support_email = 'info@naturesfinest.hu';
            }
            break;
        case SHOP_CODE . '60': // Italy
            if(INSTANCENAME == 'BABE1'){
                $company_url = 'https://www.babesvitamins.it';
                $compay_support_email = 'info@babesvitamins.it';
            } else{
                $company_url = 'https://www.naturesfinest.it';
                $compay_support_email = 'info@naturesfinest.it';   
            }
            break;
        case SHOP_CODE . '7000': // Poland
            if(INSTANCENAME == 'BABE1'){
                $company_url = 'https://www.babesvitamins.pl';
                $compay_support_email = 'info@babesvitamins.pl';
            } else{
                $company_url = 'https://www.naturesfinest.pl';
                $compay_support_email = 'info@naturesfinest.pl';    
            }
            break;
        case SHOP_CODE . '1600': // Portugal
            if(INSTANCENAME == 'BABE1'){
                $company_url = 'https://www.babesvitamins.pt';
                $compay_support_email = 'info@babesvitamins.pt';
            } else{
                $company_url = 'https://www.naturesfinest.pt';
                $compay_support_email = 'info@naturesfinest.pt';
            }
            break; 
        case SHOP_CODE . '1900': // Netherland
            $company_url = 'https://www.naturesfinestfoods.nl';
            $compay_support_email = 'info@naturesfinestfoods.nl';
            break; 
        case SHOP_CODE . '2200': // Austria
            $company_url = 'https://www.natures-finest.at';
            $compay_support_email = 'info@natures-finest.at';
            break; 
        case SHOP_CODE . '2300': // Ireland
            $company_url = 'https://www.naturesfinest.ie';
            $compay_support_email = 'info@naturesfinest.ie';
            break; 
        case SHOP_CODE . '1000': // Slovenia
            if(INSTANCENAME == 'BABE1'){
                $company_url = 'https://www.naturesfinest.si';
                $compay_support_email = 'info@naturesfinest.si';
            } else{
                $company_url = 'https://www.naturesfinest.si';
                $compay_support_email = 'info@naturesfinest.si';
            }
            break;
        case SHOP_CODE . '1400': // Germany
            if(INSTANCENAME == 'BABE1'){
                $company_url = 'https://www.babesvitamins.de';
                $compay_support_email = 'info@babesvitamins.de';
            } else{
                $company_url = 'https://www.naturesfinestfoods.de';
                $compay_support_email = 'info@naturesfinestfoods.de';
            }
            break;
        case SHOP_CODE . '9000': // Slovakia
            if(INSTANCENAME == 'BABE1'){
                $company_url = 'https://www.babesvitamins.sk';
                $compay_support_email = 'info@babesvitamins.sk';
            } else{
                $company_url = 'https://www.naturesfinest.sk';
                $compay_support_email = 'info@naturesfinest.sk';
            }
            break;
        case SHOP_CODE . '1300': // Spain
            if(INSTANCENAME == 'BABE1'){
                $company_url = 'https://www.babesvitamins.es';
                $compay_support_email = 'info@babesvitamins.es';
            } else{
                $company_url = 'https://www.naturesfinest.es';
                $compay_support_email = 'info@naturesfinest.es';
            }
            
            break;
        case SHOP_CODE . '1700': // Romania
            $company_url = 'https://www.naturesfinest.ro';
            $compay_support_email = 'info@naturesfinest.ro';
            break;
        case SHOP_CODE . '2400': // Geece
            $company_url = 'https://www.naturesfinest.gr';
            $compay_support_email = 'info@naturesfinest.gr';
            break;
        case SHOP_CODE . '2500': // Denmark
            $company_url = 'https://www.naturesfinestfoods.dk';
            $compay_support_email = 'info@naturesfinestfoods.dk';
            break;
        case SHOP_CODE . '2600': // Sweden
            $company_url = 'https://www.natures-finest.se';
            $compay_support_email = 'info@natures-finest.se';
            break;
        case SHOP_CODE . '2100': // Švica
            $company_url = 'https://www.naturesfinest.ch';
            $compay_support_email = 'info@naturesfinest.ch';
            break;
        case SHOP_CODE . '1800':
            if(INSTANCENAME == 'fr'){ // Belgium French Lang
                $company_url = 'https://www.natures-finest.be'; 
                $compay_support_email = 'info@natures-finest.be'; 
            } else{ // Belgium Dutch Lang
                $company_url = 'https://www.naturesfinestfoods.be'; 
                $compay_support_email = 'info@naturesfinestfoods.be'; 
            }
            break;
        default:
            if(INSTANCENAME == 'BABE1'){
                $company_url = 'https://www.babesvitamins.si';
                $compay_support_email = 'info@babesvitamins.si';  
            } else{
                $company_url = 'https://www.naturesfinest.si';
                $compay_support_email = 'info@naturesfinest.si';
            }
            
    }

    $company_name = get_field('company_name', $acf_option_name);
    $company_address = get_field('address', $acf_option_name);
    $company_postal_city = get_field('postal_city', $acf_option_name);
    $company_country = get_field('country', $acf_option_name);
    
    $utm_tag = '&utm_source=internal-review&utm_medium=mail-internal&utm_campaign=nf';
    if(get_field('show_reviews_invite_link_in_emails','option') == true){
        $reviews_link_id = get_field('reviews_page','option');
        global $order_id;
        global $order_data;
        $order_key = false;
        if($order_id){
            $order_data = wc_get_order( $order_id );
            $order_key = $order_data->get_order_key();
        } 
        
        if($reviews_link_id && $order_id && $order_key){
            $reviews_link_url = get_the_permalink($reviews_link_id);
            $reviews_link_url = preg_replace('#/$#', '', $reviews_link_url);
            $reviews_link = $reviews_link_url . '?order_id=' . $order_id . '&order_key=' . $order_key . $utm_tag;
    
            $message_part_1 = __("We love reading all your positive reviews, thank you!","naturesfinest");
            $message_part_2 = __("It brings us so much joy to read all your positive comments - finally getting in shape after years of trying, cleansing your body, boosting your energy, looking and feeling your best!","naturesfinest");
            $message_part_3 = __("Your success stories is what keeps us motivated to continue moving forward :)","naturesfinest");
            $message_part_4 = __("Our mission is to provide the best natural products, as we believe taking control of your health is the key to a better and happier life. And the only way we can achieve that, is by listening to our valued customers, and helping the best we can.","naturesfinest");
            $message_part_5 = __("Click here to rate your recent purchase","naturesfinest");
            $message_part_6 = __("And tell us what you like about the products","naturesfinest");
            $message_part_7 = __("Thank you for choosing Nature's Finest","naturesfinest");
            ?>
            <style type="text/css">

            body {
            margin: 0;
            padding: 0;
            background-color: #DFDFDF !important;
            }
            </style>
            <div style="background-color:transparent; margin-top:20px;">
                <div class="block-grid " style="Margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
                    <div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
                        <div class="col num12" style="min-width: 320px; max-width: 620px; display: table-cell; vertical-align: top;">
                            <div style="width:100% !important;">
                                <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px; text-align:center;">
                                    <a href="<?= get_home_url(); ?>" target="_blank" style="display:inline-block; margin-top:60px; margin-bottom:60px; width:<?= $logo_width; ?>px!important; width:<?= $logo_width; ?>px!important; height:<?= $logo_height; ?>px!important; text-align:center;">
                                        <img alt="Image" border="0" class="center autowidth " src="<?= get_template_directory_uri(); ?>/img/email/<?= $theme_logo; ?>" title="Image" width="<?= $logo_width; ?>" height="<?= $logo_height; ?>">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="block-grid" style="line-height: inherit; margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF !important; padding-bottom:30px;" bgcolor="#FFFFFF">
                <div style="color: <?= $theme_color; ?>; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; line-height: 150%; padding-top: 15px; padding-right: 40px; padding-bottom: 15px; padding-left: 40px; background-color: #fff;"  width="100%" bgcolor="#fff">
                    <div style="line-height: 18px; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size: 14px; color: <?= $theme_color; ?>;">
                        <p style="line-height: 19px; font-size: 14px; text-align: center; margin: 0; margin-bottom:10px;" align="left"><span style="line-height: inherit; font-size: 16px;"><strong style="line-height: inherit;"><?= $message_part_1 ?></strong></span></p>
                        <p style="margin: 0; margin-bottom:10px; font-size: 16px; line-height: 21px; color: #555555; text-align: center; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                            <?= $message_part_2; ?> 
                        </p>
                        <p style="margin: 0; margin-bottom:10px; font-size: 16px; line-height: 21px; color: #555555; text-align: center; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                            <?= $message_part_3; ?> 
                        </p>
                        <p style="margin: 0; margin-bottom:10px; font-size: 16px; line-height: 21px; color: #555555; text-align: center; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                            <?= $message_part_4; ?> 
                        </p>
                        
                        <p style="margin: 0; margin-bottom:10px; font-size: 16px; line-height: 21px; color: #555555; text-align: center; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                        <?= $message_part_5; ?>
                        </p>
                        <p style="margin: 0; margin-bottom:10px; font-size: 16px; line-height: 21px; color: #555555; text-align: center; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                            <a href="<?= $reviews_link; ?>" target="_blank" style="text-decoration:none!important; display:inline;">
                                <img align="center" alt="Image" border="0" class="center autowidth " src="<?= get_template_directory_uri(); ?>/img/email/tr-stars-big.png" style="outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; clear: both; border: 0; height: 38px; float: none; width: 250px !important; max-width: 250px !important; display: inline-block; margin-bottom:15px;" title="Image" width="250" height="38">
                            </a><br>
                            <a href="<?= $reviews_link; ?>" target="_blank" style="margin-bottom:10px; color:#ffffff; background-color:<?= $theme_color; ?>; text-decoration:none!important; width:150px; height:50px; line-height:50px; text-transform:uppercase; text-align:center; display:inline-block; padding:0 10px;" bgcolor="<?= $theme_color; ?>">
                                <?= __('RATE YOUR PURCHASE', 'naturesfinest'); ?>
                            </a>
                        </p>
                        <p style="margin: 0; margin-bottom:10px; font-size: 16px; line-height: 21px; color: #555555; text-align: center; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;"> 
                            <?= $message_part_6; ?><br>
                        </p>
                        <p style="margin: 0; margin-bottom:10px; font-size: 16px; line-height: 21px; color: #555555; text-align: center; font-family: 'Oxygen', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;">
                            <?= $message_part_7; ?> 
                        </p>
                    </div>
                </div>
            </div>
            <div class="block-grid" style="line-height: inherit; margin: 0 auto; min-width: 320px; max-width: 620px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #282828 !important;" bgcolor="#282828">
                <div style="color: <?= $theme_color; ?>; font-family: 'Oswald', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif; line-height: 150%; padding-top: 15px; padding-right: 40px; padding-bottom: 15px; padding-left: 40px; background-color: #282828;"  width="100%" bgcolor="#282828">
                    <p style="font-size: 16px; line-height: 19px; margin: 0; color:#b8b8b8">
                        <strong><?= $company_name; ?></strong><br>
                        <?= $company_address; ?><br>
                        <?= $company_postal_city; ?><br>
                        <?= $company_country; ?></p>
                    <p style="font-size: 16px; line-height: 19px; margin: 0; color:#b8b8b8">
                        <a href="<?= $company_url; ?>" style="color:#b8b8b8; text-decoration:none;">
                            <?= $company_url; ?>
                        </a><br>
                        <a href="mailto:<?= $compay_support_email; ?>" style="color:#b8b8b8; text-decoration:none;">
                            <?= $compay_support_email; ?>
                        </a>
                    </p>
                </div>
            </div>
            <p style="font-size: 14px; color: #555555; margin-top:20px; margin-bottom:20px; line-height: 14px; text-align: center;"><strong>Copyright © <?= $company_name; ?> <?php echo date("Y"); ?></strong></p>
            <?php
        }
    }
}
?>