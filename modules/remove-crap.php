<?php


/**
 * Remove emoji styles from head
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Remove Jetpack CSS from head
 */

// First, make sure Jetpack doesn't concatenate all its CSS
add_filter( 'jetpack_implode_frontend_css', '__return_false' );

// Then, remove each CSS file, one at a time
function jeherve_remove_all_jp_css() {
  wp_deregister_style( 'AtD_style' ); // After the Deadline
  wp_deregister_style( 'jetpack_likes' ); // Likes
  wp_deregister_style( 'jetpack_related-posts' ); //Related Posts
  wp_deregister_style( 'jetpack-carousel' ); // Carousel
  wp_deregister_style( 'grunion.css' ); // Grunion contact form
  wp_deregister_style( 'the-neverending-homepage' ); // Infinite Scroll
  wp_deregister_style( 'infinity-twentyten' ); // Infinite Scroll - Twentyten Theme
  wp_deregister_style( 'infinity-twentyeleven' ); // Infinite Scroll - Twentyeleven Theme
  wp_deregister_style( 'infinity-twentytwelve' ); // Infinite Scroll - Twentytwelve Theme
  wp_deregister_style( 'noticons' ); // Notes
  wp_deregister_style( 'post-by-email' ); // Post by Email
  wp_deregister_style( 'publicize' ); // Publicize
  wp_deregister_style( 'sharedaddy' ); // Sharedaddy
  wp_deregister_style( 'sharing' ); // Sharedaddy Sharing
  wp_deregister_style( 'stats_reports_css' ); // Stats
  wp_deregister_style( 'jetpack-widgets' ); // Widgets
  wp_deregister_style( 'jetpack-slideshow' ); // Slideshows
  wp_deregister_style( 'presentations' ); // Presentation shortcode
  //wp_deregister_style( 'jetpack-subscriptions' ); // Subscriptions
  wp_deregister_style( 'tiled-gallery' ); // Tiled Galleries
  wp_deregister_style( 'widget-conditions' ); // Widget Visibility
  wp_deregister_style( 'jetpack_display_posts_widget' ); // Display Posts Widget
  wp_deregister_style( 'gravatar-profile-widget' ); // Gravatar Widget
  wp_deregister_style( 'widget-grid-and-list' ); // Top Posts widget
  wp_deregister_style( 'jetpack-widgets' ); // Widgets
}
add_action('wp_print_styles', 'jeherve_remove_all_jp_css' );

/**
 * Remove <br> from gallery
 */
add_filter( 'the_content', 'remove_br_gallery', 11, 2);
function remove_br_gallery($output) {
    return preg_replace('/<br style=(.*)>/mi','',$output);
}



?>
