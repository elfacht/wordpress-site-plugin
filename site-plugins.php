<?php
/*
Plugin Name: Site Plugin for your-site.com
Description: Site specific functions for yur-site.com
*/
/* Start Adding Functions Below this Line */


/**
 * Define plugin folder path
 */
define('PLUGIN_MODULES', WP_PLUGIN_DIR . '/site-plugins/modules/');


/**
 * Include your JS via wp_enqueue_script()
 */
function my_scripts_method() {
  wp_enqueue_script( 'scripts.js', get_bloginfo('template_directory') . "/assets/js/app/scripts.js", array( 'jquery' ), 0 , true);
}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' ); // wp_enqueue_scripts action hook to link only on the front-end





/**
 * Secury + admin functions
 */


// Redirects 'page' to custom slug.
// default: 'seite'
//include(PLUGIN_MODULES . 'redirect-pagination.php');

// Theme options page for ADVANCED CUSTOM FIELDS (ACF)
//include(PLUGIN_MODULES . 'options-page.php');

// Sitemap
include(PLUGIN_MODULES . 'sitemap.php');

// Fragment cache
include(PLUGIN_MODULES . 'fragment-cache.php');

// Custom post type
//include(PLUGIN_MODULES . 'custom-post-types.php');

/**
 * Basic setup
 */

// Define widgets
include(PLUGIN_MODULES . 'define-widgets.php');

// Prints HTML with date information for current post
include(PLUGIN_MODULES . 'html-date-snippet.php');

// Adds RSS link in <head>
include(PLUGIN_MODULES . 'add-rss-link.php');

// HTML5 comment and search form
include(PLUGIN_MODULES . 'html5-form.php');

// Attached images
include(PLUGIN_MODULES . 'html5-form.php');

// Define Post formats
//include(PLUGIN_MODULES . 'define-post-formats.php');

// Blog title formatting
include(PLUGIN_MODULES . 'blogtitle-formatting.php');

// Returns URL from post
include(PLUGIN_MODULES . 'return-post-url.php');

// Content navigation
#include(PLUGIN_MODULES . 'content-nav.php');


/**
 * Theme functions
 */

// Removes crap from <head>
include(PLUGIN_MODULES . 'remove-crap.php');

// Removes WP version in <head>
include(PLUGIN_MODULES . 'remove-version.php');

// Foundation top bar
//include(PLUGIN_MODULES . 'foundation-topbar.php');

// Foundation pagination
//include(PLUGIN_MODULES . 'foundation-pagination.php');

// Image path fix for SSL
//include(PLUGIN_MODULES . 'image-path.php');

// Replace non-ssl paths
include(PLUGIN_MODULES . 'replace-non-ssl.php');

// Allow HTML in category description
include(PLUGIN_MODULES . 'html-category-description.php');

// Meta-tags for social networks (like NGFB plugin)
//include(PLUGIN_MODULES . 'meta-social.php');

// Enable post views
//include(PLUGIN_MODULES . 'post-views.php');

// Removes IP address in comments
//include(PLUGIN_MODULES . 'remove-ip-comments.php');

// Custom menu functions:
// - adding home-icon to menu
// - adding custom menu locations
//include(PLUGIN_MODULES . 'custom-menu-functions.php');

// Custom excerpt
include(PLUGIN_MODULES . 'custom-excerpt.php');

// Twitter OpenGraph
//include(PLUGIN_MODULES . 'twitter-opengraph.php');

// Thumbnail support
include(PLUGIN_MODULES . 'thumbnail-support.php');

// Custom image formats
//include(PLUGIN_MODULES . 'custom-image-formats.php');

// Custom wp-gallery
//include(PLUGIN_MODULES . 'custom-gallery.php');

// Responsive images
#include(PLUGIN_MODULES . 'responsive-images.php');

// Paginated pages
include(PLUGIN_MODULES . 'paginated-pages.php');


/**
 * Shortcodes
 */
include(PLUGIN_MODULES . 'shortcodes.php');




/* Stop Adding Functions Below this Line */
?>
