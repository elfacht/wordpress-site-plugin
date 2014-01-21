<?php

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

?>