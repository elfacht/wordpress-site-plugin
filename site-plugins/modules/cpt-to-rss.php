<?php

/* =Adds custom post types to RSS
------------------------------------------------------*/
function cpt_rss_feed($qv) {
	if (isset($qv['feed']) && !isset($qv['post_type']))
		// Set your post types into the array
		$qv['post_type'] = array('post', 'custom_post_types');
	return $qv;
}
add_filter('request', 'cpt_rss_feed');

?>