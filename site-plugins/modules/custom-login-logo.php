<?php

/* =Custom login logo
------------------------------------------------------*/
function e8_custom_login_logo() {
	echo '<style type="text/css">
		h1 a { background-image:url('.get_bloginfo('template_directory').'/images/custom-login-logo.gif) !important; }
	</style>';
}

add_action('login_head', 'e8_custom_login_logo');

?>