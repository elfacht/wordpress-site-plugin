<?php

/**
 * Adding home-icon to menu
 */
function wpse45802_add_nav_menu_home_link( $items, $args ) {
    $home_link = '';
    //if ( INSERT CONDITIONALS HERE ) {

        // Determine menu item class
        $home_link_class = ' class="menu-item home-link secondary"';
        // Build home link markup
        $home_link = '<li' . $home_link_class . '>';
        $home_link .= $args->before;
        $home_link .= '<a href="' . home_url() . '" class="relative" title="Startseite">';
        $home_link .= '<i class="icon icon-home show-for-large-up" data-grunticon-embed></i>';
        $home_link .= '<span class="show-for-medium-down">Startseite</span>';
        $home_link .= '</a>';
        $home_link .= $args->after;
        $home_link .= '</li>';
    //}
    // Merge home link menu item with nav menu items
    $modified_items = $home_link . $items;
    // Return the result
    return $modified_items;
}
add_filter( 'wp_nav_menu_items', 'wpse45802_add_nav_menu_home_link', 10, 2 );

/**
 * Register custom menu localtions
 */
function register_my_menu() {
  register_nav_menu('footer-menu',__( 'Footer Menu' ));
  register_nav_menu('footer-left',__( 'Footer (left)' ));
  register_nav_menu('footer-right',__( 'Footer (right)' ));
}
add_action( 'init', 'register_my_menu' );


?>