<?php

/* =Define widgets
------------------------------------------------------*/
function e8_widgets_init() {
	register_sidebar(array(
		'name'					=> 'Footer Widgets',
		'id'						=> 'sidebar-1',
		'description'		=> 'Widgets for the footer',
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	));
}

add_action('widgets_init', 'e8_widgets_init');

?>