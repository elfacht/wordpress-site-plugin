<?php
/*
Plugin Name: Site Plugin for yoursite.com
Description: Site specific functions for yoursite.com
*/
/* Start Adding Functions Below this Line */



/* SECURITY FUNCTIONS
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







/* TEMPLATE FUNCTIONS
========================================================== */

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


/* =Post views
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
    	$option_values = "footer-credits";
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