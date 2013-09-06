<?php

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


/* =Foundation top bar
https://gist.github.com/awshout/3943026
------------------------------------------------------*/
add_theme_support('menus');

register_nav_menus(array(
	'top-bar-l' => 'Left Top Bar', // registers the menu in the WordPress admin menu editor
	'top-bar-r' => 'Right Top Bar'
));

// the left top bar
function foundation_top_bar_l() {
	wp_nav_menu(array(
		'container' => false,														// remove nav container
		'container_class' => 'menu',										// class of container
		'menu' => '',																		// menu name
		'menu_class' => 'top-bar-menu left',						// adding custom nav class
		'theme_location' => 'top-bar-l',								// where it's located in the theme
		'before' => '',																	// before each link <a>
		'after' => '',																	// after each link </a>
		'link_before' => '',														// before each link text
		'link_after' => '',															// after each link text
		'depth' => 5,																		// limit the depth of the nav
		'fallback_cb' => false,													// fallback function (see below)
		'walker' => new top_bar_walker()
	));
} // end left top bar

// the right top bar
function foundation_top_bar_r() {
	wp_nav_menu(array(
		'container' => false,														// remove nav container
		'container_class' => '',												// class of container
		'menu' => 'main',																// menu name
		'menu_class' => 'top-bar-menu right',						// adding custom nav class
		'theme_location' => 'top-bar-r',								// where it's located in the theme
		'before' => '',																	// before each link <a>
		'after' => '',																	// after each link </a>
		'depth' => 0,																		// limit the depth of the nav
		'fallback_cb' => false,													// fallback function (see below)
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


?>