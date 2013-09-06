<?php

/* Taken from the twentytwelve theme and doesn't need
	to be changed, unless you want so */

/* =Returns URL from post
------------------------------------------------------*/
function e8_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ($has_url) ? $has_url : apply_filters('the_permalink', get_permalink());
}

?>