<?php
/*
Plugin Name: Site Plugin for elfacht.com
Description: Site specific functions for elfacht.com



Contents:

	SECURITY + ADMIN FUNCTIONS
	* Admin header
	* Removes WP version in <header>
	* Removes IP address in comments
	* Custom login logo
	* Define widgets
	* Disable plugin deactivation / removes the deactivation link
	* Adds RSS link in <head>
	* HTML5 comment and search form
	* Define Post formats
	* Blog title formatting
	* Returns URL from post
	* Enable post views

	TEMPLATE FUNCTIONS
	* Thumbnail support
	* Set image quality
	* Enable header image and define sizes
	* Custom image sizes
	* Content navigation
	* Comments
	* Enable shortcodes in widgets
	* Enable excerpts on pages
	* Prints HTML with date information for current post
	* Global custom fields

	CUSTOM POST TYPE FUNCTIONS
	* Adds custom post types to author's page
	* Enable sticky post option for custom post types
	* Adds custom post types to RSS

	FOUNDATION SETTINGS
	* Foundation top bar
	* Foundation pagination

*/
/* Start Adding Functions Below this Line */


/* =Define plugin folder path
------------------------------------------------------*/
define('PLUGIN_MODULES', WP_PLUGIN_DIR . '/site-plugins/modules/');



/* SECURITY + ADMIN FUNCTIONS
========================================================== */

/* =Admin header
------------------------------------------------------*/
include(PLUGIN_MODULES . 'admin-header.php');


/* =Removes WP version in <header>
------------------------------------------------------*/
include(PLUGIN_MODULES . 'remove-version.php');

/* =Removes IP address in comments
------------------------------------------------------*/
include(PLUGIN_MODULES . 'remove-ip-comments.php');

/* =Custom login logo
------------------------------------------------------*/
include(PLUGIN_MODULES . 'custom-login-logo.php');


/* =Define widgets
------------------------------------------------------*/
include(PLUGIN_MODULES . 'define-widgets.php');


/* =Disable plugin deactivation / removes the deactivation link
------------------------------------------------------*/
include(PLUGIN_MODULES . 'disable-plugin-deactivation.php');


/* =Adds RSS link in <head>
------------------------------------------------------*/
include(PLUGIN_MODULES . 'add-rss-link.php');


/* =HTML5 comment and search form
------------------------------------------------------*/
include(PLUGIN_MODULES . 'html5-form.php');


/* =Define Post formats
------------------------------------------------------*/
include(PLUGIN_MODULES . 'define-post-formats.php');


/* =Blog title formatting
------------------------------------------------------*/
include(PLUGIN_MODULES . 'blogtitle-formatting.php');


/* =Returns URL from post
------------------------------------------------------*/
include(PLUGIN_MODULES . 'return-post-url.php');


/* =Enable post views
------------------------------------------------------*/
//include(PLUGIN_MODULES . 'post-views.php');









/* TEMPLATE FUNCTIONS
========================================================== */

/* =Thumbnail support
------------------------------------------------------*/
include(PLUGIN_MODULES . 'thumbnail-support.php');


/* =Set image quality
------------------------------------------------------*/
include(PLUGIN_MODULES . 'image-quality.php');


/* =Enable header image and define sizes
------------------------------------------------------*/
include(PLUGIN_MODULES . 'header-image.php');

/* =Custom image sizes
------------------------------------------------------*/
include(PLUGIN_MODULES . 'custom-image-sizes.php');

/* =Content navigation
------------------------------------------------------*/
include(PLUGIN_MODULES . 'content-nav.php');

/* =Comments
------------------------------------------------------*/
include(PLUGIN_MODULES . 'comments.php');

/* =Allow shortcodes in widgets
------------------------------------------------------*/
include(PLUGIN_MODULES . 'enable-widget-shortcodes.php');

/* =Enable excerpts on pages
------------------------------------------------------*/
include(PLUGIN_MODULES . 'enable-page-excerpts.php');


/* =Prints HTML with date information for current post.
------------------------------------------------------*/
include(PLUGIN_MODULES . 'html-date-snippet.php');


/* =Global custom fields
------------------------------------------------------*/
include(PLUGIN_MODULES . 'global-custom-fields.php');






/* CUSTOM POST TYPE FUNCTIONS
========================================================== */

/* =Custom post types and taxonomies
------------------------------------------------------*/
include(PLUGIN_MODULES . 'cpt.php');


/* =Adds custom post types to author's page
------------------------------------------------------*/
//include(PLUGIN_MODULES . 'cpt-authors-page.php');


/* =Enable sticky post option for custom post types
------------------------------------------------------*/
//include(PLUGIN_MODULES . 'enable-sticky-cpt.php');


/* =Adds custom post types to RSS
------------------------------------------------------*/
include(PLUGIN_MODULES . 'cpt-to-rss.php');









/* FOUNDATION SETTINGS
========================================================== */

/* =Foundation top bar
https://gist.github.com/awshout/3943026
------------------------------------------------------*/
include(PLUGIN_MODULES . 'foundation-topbar.php');


/* =Foundation pagination
https://gist.github.com/davidpaulsson/3910181
------------------------------------------------------*/
include(PLUGIN_MODULES . 'foundation-pagination.php');












/* Stop Adding Functions Below this Line */
?>