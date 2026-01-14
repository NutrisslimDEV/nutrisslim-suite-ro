<?php

function landing_faq_content() {

    global $faqOrder;
    $faqs = get_field('faq_set', $productID);

    /*
    echo '===> ' . $faqOrder;
    echo '<pre>';
    print_r($faqs[$faqOrder]['faq']);
    echo '</pre>';
    */

    $faq = $faqs[$faqOrder]['faq'];

    if (!isset($faq) || !is_array($faq)) {
        $faq = [];
    }    

    $content = '<div class="landing-faq">
                    <ul class="accordion">';
                        foreach ($faq as $item) {
                            $content .= '<li>';
                            $content .= '<span class="toggle">';
                            $content .= '<h3>' . $item['question'] . '</h3>';
                            $content .= '<div class="svg-container">
                                        <svg class="plus-icon" viewBox="0 0 100 100">
                                            <line x1="32.5" y1="50" x2="67.5" y2="50" stroke-width="5"></line>
                                            <line class="vertical-line" x1="50" y1="32.5" x2="50" y2="67.5" stroke-width="5"></line>
                                        </svg>
                                    </div>';
                            $content .= '</span>'; // toggle
                            $content .= '<div class="inner icon-primary-color icon-dot">' . $item['answer'] . '</div>';
                            $content .= '</li>';
                        }
                        $content .= '</ul>'; 
                        $content .= '</div>';


    $faqOrder = $faqOrder + 1;                    
    // Return the content
    return $content;    

    // echo '=======> ' . $faqOrder;
}
/*
function landing_faq_content() {
    // Define the content you want to return
    $productref = get_field('selected_product');
    $productID = $productref[0];
    $faq = get_field('faq', $productID);

    $content = '<div class="landing-faq">
                    <ul class="accordion">';
                        foreach ($faq as $item) {
                            $content .= '<li>';
                            $content .= '<span class="toggle">';
                            $content .= '<h3>' . $item['question'] . '</h3>';
                            $content .= '<div class="svg-container">
                                        <svg class="plus-icon" viewBox="0 0 100 100">
                                            <line x1="32.5" y1="50" x2="67.5" y2="50" stroke-width="5"></line>
                                            <line class="vertical-line" x1="50" y1="32.5" x2="50" y2="67.5" stroke-width="5"></line>
                                        </svg>
                                    </div>';
                            $content .= '</span>'; // toggle
                            $content .= '<div class="inner icon-primary-color icon-dot">' . $item['answer'] . '</div>';
                            $content .= '</li>';
                        }
                        $content .= '</ul>'; 
                        $content .= '</div>';

    // Return the content
    return $content;
}
*/

// Register shortcode with WordPress
add_shortcode('landing_faq', 'landing_faq_content');