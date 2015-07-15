<?php

/* Taken from the twentytwelve theme and doesn't need
	to be changed, unless you want so */


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
		$title = "$title $sep " . sprintf(__('Page %s', 'e8'), max($paged, $page));

	return $title;
}

add_filter('wp_title', 'e8_wp_title', 10, 2);

?>