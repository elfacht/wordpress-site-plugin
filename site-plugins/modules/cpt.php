<?php

/* =Custom post types and taxonomies
------------------------------------------------------*/
add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'portfolio',
		array(
			'menu_position' => 5,
			'exclude_from_search' => false,
			'labels' => array(
				'name' => __( 'Portfolio' ),
				'singular_name' => __( 'Portfolio' ),
				'add_new' => 'Neues Projekt'
			),
			'public' => true,
			'has_archive' => true,
			'show_in_nav_menus' => true,
			'rewrite' => array('slug' => 'portfolio/projekt'),
			'supports' => array('title','page-atributes', 'thumbnail'),
			//'taxonomies' => array('category'),
		)
	);
	flush_rewrite_rules( false );
}

add_action('init', 'create_portfolio_taxonomies');

function create_portfolio_taxonomies() {
	register_taxonomy('portfolio_year', 'portfolio',
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => 'Jahr',
				'add_new_item' => 'Neues Jahr anlegen'
			),
			'show_ui' => true,
			'public' => true,
			'query_var' => 'portfolio_year'
		)
	);

}


?>