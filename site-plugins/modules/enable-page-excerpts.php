<?php

/* =Enable excerpts on pages
------------------------------------------------------*/
add_action( 'init', 'e8_page_excerpts' );

function e8_page_excerpts() {
	add_post_type_support( 'page', 'excerpt' );
}

?>