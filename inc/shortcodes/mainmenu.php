<?php
// function head_menu_shortcode() {
//     // Display the menu with the name "HeadMenu"

//     $menu = '<div class="inMenuLogo">';
//     $menu .= '<img width="350" height="100" src="/wp-content/uploads/2024/03/Naturesfinest-logo-01.svg" class="attachment-full size-full wp-image-564339" alt="">';
//     $menu .= '</div>';
//     $menu .= '<div class="megamenuWrapper" style="display:none;">';
//     $menu .= '<div class="container">';
//     $menu .= do_shortcode('[elementor-template id="632430"]');
//     $menu .= '</div>'; // container
//     $menu .= '</div>'; // megamenuWrapper
//     return $menu;
// } 

// add_shortcode('head_menu', 'head_menu_shortcode');


// function head_menu_shortcode() {
//     // Start building the menu output
//     $menu = '<div class="inMenuLogo">';
//     $menu .= '<img width="350" height="100" src="/wp-content/uploads/2024/03/Naturesfinest-logo-01.svg" class="attachment-full size-full wp-image-564339" alt="">';
//     $menu .= '</div>';
//     // Add the rest of the menu
//     $menu .= '<div class="megamenuWrapper" style="display:none;">';
//     $menu .= '<div class="container">';
//     $menu .= wp_nav_menu(array(
//         'menu'           => 'HeadMenu', // Menu name
//         'container'      => 'div',
//         'container_class'=> 'headmenu-container',
//         'echo'           => false,       // Return the menu as a string
//         'walker'         => new My_Custom_Walker_Nav_menu()
//     ));
//     $menu .= '</div>'; // container
//     $menu .= '</div>'; // megamenuWrapper

//     return $menu;
// }

// add_shortcode('head_menu', 'head_menu_shortcode');