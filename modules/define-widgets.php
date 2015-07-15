<?php

/* =Define widgets
------------------------------------------------------*/
function e8_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar Right', 'e8' ),
		'id'            => 'sidebar-right',
		'description'   => __( 'The right sidebar', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Main Center', 'e8' ),
		'id'            => 'sidebar-main-1',
		'description'   => __( 'The main sidebar', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Main Left', 'e8' ),
		'id'            => 'sidebar-main-2',
		'description'   => __( 'The main sidebar', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Main Right', 'e8' ),
		'id'            => 'sidebar-main-3',
		'description'   => __( 'The main sidebar', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'e8_widgets_init' );


?>