<?php
/*
Plugin Name: Site Plugin for yoursite.com
Description: Site specific functions for yoursite.com



Contents:

	SECURITY + ADMIN FUNCTIONS
	* Removes WP version in <header>
	* Removes WP version on scripts in <header>
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
	* Define header images size
	* Custom image formats
	* Allow shortcodes in widgets
	* Enable excerpts on pages
	* Prints HTML with date information for current post
	* Global custom fields

	CUSTOM POST TYPE FUNCTIONS
	* Adds custom post types to author's page
	* Adds sticky post option for custom post types
	* Adds custom post types to RSS

	FOUNDATION SETTINGS
	* Foundation top bar
	* Foundation pagination

*/
/* Start Adding Functions Below this Line */



/* SECURITY + ADMIN FUNCTIONS
========================================================== */

/* =Removes WP version in <header>
------------------------------------------------------*/
remove_action('wp_head', 'wp_generator');


/* =Removes WP version on scripts in <header>
------------------------------------------------------*/
add_filter('script_loader_src', 'remove_src_version');
add_filter('style_loader_src', 'remove_src_version');

function remove_src_version($src) {
  global $wp_version;
  $version_str = '?ver='.$wp_version;
  $version_str_offset = strlen($src) - strlen($version_str);

  if (substr($src, $version_str_offset) == $version_str)
    return substr($src, 0, $version_str_offset);
  else
    return $src;
}


/* =Removes IP address in comments
------------------------------------------------------*/
add_filter('pre_comment_user_ip', 'no_ips');
function no_ips($comment_author_ip){
  return '';
}


/* =Custom login logo
------------------------------------------------------*/
function e8_custom_login_logo() {
	echo '<style type="text/css">
		h1 a { background-image:url('.get_bloginfo('template_directory').'/images/custom-login-logo.gif) !important; }
	</style>';
}

add_action('login_head', 'e8_custom_login_logo');


/* =Define widgets
------------------------------------------------------*/
function e8_widgets_init() {
	register_sidebar( array(
		'name'          => 'Main Widget',
		'id'            => 'sidebar-1',
		'description'   => 'Widget description goes hier',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action('widgets_init', 'e8_widgets_init');


/* =Disable plugin deactivation / removes the deactivation link
------------------------------------------------------*/
add_filter('plugin_action_links', 'e8_lock_plugins', 10, 4);
function e8_lock_plugins($actions, $plugin_file, $plugin_data, $context) {
  // Remove edit link for all
  if (array_key_exists('edit', $actions))
      unset($actions['edit']);
  // Remove deactivate link for crucial plugins
  if (array_key_exists('deactivate', $actions) && in_array($plugin_file, array(
      'plugin-name/plugin-name.php'
  )))
      unset($actions['deactivate']);
  return $actions;
}


/* =Adds RSS link in <head>
------------------------------------------------------*/
add_theme_support('automatic-feed-links');


/* =HTML5 comment and search form
------------------------------------------------------*/
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list'));


/* =Define Post formats
------------------------------------------------------*/
add_theme_support('post-formats', array(
	'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
));


/* =Blog title formatting
------------------------------------------------------*/
function e8_wp_title($title, $sep) {
	global $paged, $page;

	if (is_feed())
		return $title;

	// Add the site name.
	$title .= get_bloginfo('name');

	// Add the site description for the home/front page.
	$site_description = get_bloginfo('description', 'display');
	if ($site_description && (is_home() || is_front_page()))
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ($paged >= 2 || $page >= 2)
		$title = "$title $sep " . sprintf( __( 'Page %s', 'e8' ), max($paged, $page));

	return $title;
}
add_filter('wp_title', 'e8_wp_title', 10, 2);


/* =Returns URL from post
------------------------------------------------------*/
function e8_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ($has_url) ? $has_url : apply_filters('the_permalink', get_permalink());
}


/* =Enable post views
------------------------------------------------------*/
function wpb_set_post_views($postID) {
  $count_key = 'wpb_post_views_count';
  $count = get_post_meta($postID, $count_key, true);
  if ($count=='') {
    $count = 0;
    delete_post_meta($postID, $count_key);
    add_post_meta($postID, $count_key, '0');
  } else {
    $count++;
    update_post_meta($postID, $count_key, $count);
  }
}

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/*
	To count the views of your posts put this code in your content-single.php:
	<?php wpb_set_post_views(get_the_ID()); ?>
*/







/* TEMPLATE FUNCTIONS
========================================================== */

/* =Thumbnail support
------------------------------------------------------*/
add_theme_support('post-thumbnails');
set_post_thumbnail_size(604, 270, true);

/* =Set image quality
------------------------------------------------------*/
add_filter('jpeg_quality', function($arg) { return 60; });


/* =Define header images size
------------------------------------------------------*/
define('HEADER_IMAGE_WIDTH', apply_filters( 'twentyeleven_header_image_width', 1280));
define('HEADER_IMAGE_HEIGHT', apply_filters( 'twentyeleven_header_image_height', 600));


/* =Custom image formats
------------------------------------------------------*/
add_image_size('post-excerpt', 215, 215, TRUE);
add_image_size('post-single', 350, 350);


/* =Allow shortcodes in widgets
------------------------------------------------------*/
add_filter('widget_text', 'do_shortcode');


/* =Enable excerpts on pages
------------------------------------------------------*/
add_action( 'init', 'e8_page_excerpts' );

function e8_page_excerpts() {
	add_post_type_support( 'page', 'excerpt' );
}


/* =Prints HTML with date information for current post.
------------------------------------------------------*/
if (!function_exists('e8_entry_date')) :

function e8_entry_date($echo = true) {
	if (has_post_format(array('chat', 'status')))
		$format_prefix = _x('%1$s on %2$s', '1: post format name. 2: date', 'twentythirteen');
	else
		$format_prefix = '%2$s';

	$date = sprintf('<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url(get_permalink()),
		esc_attr(sprintf(__('Permalink to %s', 'twentythirteen'), the_title_attribute('echo=0'))),
		esc_attr(get_the_date( 'c' ) ),
		esc_html(sprintf($format_prefix, get_post_format_string(get_post_format()), get_the_date()))
	);

	if ($echo)
		echo $date;

	return $date;
}

endif;


/* =Global custom fields
------------------------------------------------------*/
add_action('admin_menu', 'add_gcf_interface');

function add_gcf_interface() {
  add_menu_page('Global Custom Fields', 'Global Custom Fields', '6', 'functions', 'editglobalcustomfields');
}

function editglobalcustomfields() {
    ?>
    <div class='wrap'>
    <h2>Global Custom Fields</h2>
    <form method="post" action="options.php">
    <?php wp_nonce_field('update-options') ?>

		<p><strong>Footer Credits</strong><br />
    <input type="text" name="footer-credits" size="45" value="<?php echo get_option('footer-credits'); ?>" /></p>

		<p><strong>Welcome Message</strong><br />
    <textarea name="welcome-message" rows="5" cols="45"><?php echo get_option('welcome-message'); ?></textarea></p>

	  <p><input type="submit" name="Submit" value="Update Options" /></p>

    <input type="hidden" name="action" value="update" />

    <?php
    	// Add all new input fields to this variable
    	$option_values = "";
    	$option_values .= "footer-credits";
    	$option_values .= ",welcome-message";
    ?>
    <input type="hidden" name="page_options" value="<?php echo $option_values; ?>" />

    </form>
    </div>
    <?php
}








/* CUSTOM POST TYPE FUNCTIONS
========================================================== */

/* =Adds custom post types to author's page
------------------------------------------------------*/
add_action('pre_get_posts', 'e8_add_custom_type_to_query');

function e8_add_custom_type_to_query($notused) {
	if (!is_admin()){
	  global $wp_query;
	  if (is_author() || is_home()){
	  	// Set your post types into the array
	  	$wp_query->set('post_type', array('post', 'custom_post_type'));
	  }
	}
}


/* =Adds sticky post option for custom post types
------------------------------------------------------*/
// add sticky option field to custom post types
function e8_sticky_meta() { ?>
    <input id="ppt-sticky" name="sticky" type="checkbox" value="sticky" <?php checked(is_sticky()); ?> />
    <label for="make-sticky" class="selectit"><?php _e('feature this post on front page') ?></label><?php
}

// select all post types to show sticky post option
function e8_add_sticky_box() {
    $args = array(
			'_builtin' => false
    );
    $post_types = get_post_types($args);
    foreach($post_types as $post_type)
    add_meta_box('e8_add_sticky_box', __('Featured'), 'e8_sticky_meta', $post_type, 'side', 'high');
}
add_action('admin_init', 'e8_add_sticky_box');


/* =Adds custom post types to RSS
------------------------------------------------------*/
function cpt_rss_feed($qv) {
	if (isset($qv['feed']) && !isset($qv['post_type']))
		// Set your post types into the array
		$qv['post_type'] = array('post', 'custom_post_types');
	return $qv;
}
add_filter('request', 'cpt_rss_feed');



















/* FOUNDATION SETTINGS
========================================================== */

/* =Foundation top bar
https://gist.github.com/awshout/3943026
------------------------------------------------------*/

/*
	To use the foundation top bar in the template, use following code in the header.php:

	<nav role="navigation" id="" class="top-bar">
		<ul class="title-area">
	  	<li class="name">
	  		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			</li>
	  	<li class="toggle-topbar menu-icon"><a href="#"><?php echo get_option('label-menu'); ?></a></li>
	  </ul>
	  <section class="top-bar-section">
	  	<?php foundation_top_bar_l(); ?>
      <?php foundation_top_bar_r(); ?>
    </section>
	</nav>

*/

add_theme_support('menus');

register_nav_menus(array(
    'top-bar-l' => 'Left Top Bar', // registers the menu in the WordPress admin menu editor
    'top-bar-r' => 'Right Top Bar'
));

// the left top bar
function foundation_top_bar_l() {
  wp_nav_menu(array(
    'container' => false,                           // remove nav container
    'container_class' => 'menu',           					// class of container
    'menu' => '',                      	        		// menu name
    'menu_class' => 'top-bar-menu left',         		// adding custom nav class
    'theme_location' => 'top-bar-l',                // where it's located in the theme
    'before' => '',                                 // before each link <a>
    'after' => '',                                  // after each link </a>
    'link_before' => '',                            // before each link text
    'link_after' => '',                             // after each link text
    'depth' => 5,                                   // limit the depth of the nav
    'fallback_cb' => false,                         // fallback function (see below)
    'walker' => new top_bar_walker()
	));
} // end left top bar

// the right top bar
function foundation_top_bar_r() {
	wp_nav_menu(array(
    'container' => false,                           // remove nav container
    'container_class' => '',           							// class of container
    'menu' => 'main',                      	        // menu name
    'menu_class' => 'top-bar-menu right',         	// adding custom nav class
    'theme_location' => 'top-bar-r',                // where it's located in the theme
    'before' => '',                                 // before each link <a>
    'after' => '',                                  // after each link </a>
    'depth' => 0,                                   // limit the depth of the nav
    'fallback_cb' => false,                         // fallback function (see below)
    'walker' => new top_bar_walker()
	));
} // end right top bar


/*
Customize the output of menus for Foundation top bar classes
*/

class top_bar_walker extends Walker_Nav_Menu {

  function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
    $element->has_children = !empty($children_elements[$element->ID]);
    $element->classes[] = ($element->current || $element->current_item_ancestor) ? 'active' : '';
    $element->classes[] = ($element->has_children) ? 'has-dropdown' : '';

    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
  }

  function start_el(&$output, $item, $depth, $args) {
    $item_html = '';
    parent::start_el($item_html, $item, $depth, $args);

    #$output .= ($depth == 0) ? '<li class="divider"></li>' : '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    if(in_array('section', $classes)) {
        #$output .= '<li class="divider"></li>';
        $item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '<label>$1</label>', $item_html);
    }

    $output .= $item_html;
  }

  function start_lvl(&$output, $depth = 0, $args = array()) {
    $output .= "\n<ul class=\"sub-menu dropdown\">\n";
  }

} // end top bar walker



/* =Foundation pagination
https://gist.github.com/davidpaulsson/3910181
------------------------------------------------------*/
function foundation_pagination( $p = 2 ) {
	if ( is_singular() ) return;
	global $wp_query, $paged;
	$max_page = $wp_query->max_num_pages;
	if ( $max_page == 1 ) return;
	if ( empty( $paged ) ) $paged = 1;
	if ( $paged > $p + 1 ) p_link( 1, 'First' );
	if ( $paged > $p + 2 ) echo '<li class="unavailable"><a href="#">&hellip;</a></li>';
	for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { // Middle pages
		if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<li class='current'><a href='#'>{$i}</a></li> " : p_link( $i );
	}
	if ( $paged < $max_page - $p - 1 ) echo '<li class="unavailable"><a href="#">&hellip;</a></li>';
	if ( $paged < $max_page - $p ) p_link( $max_page, 'Last' );
}
function p_link( $i, $title = '' ) {
	if ( $title == '' ) $title = "Page {$i}";
	echo "<li><a href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$i}</a></li> ";
}








/* Stop Adding Functions Below this Line */
?>