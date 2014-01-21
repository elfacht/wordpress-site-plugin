<?php

/* Taken from the twentytwelve theme and doesn't need
	to be changed, unless you want so */


/* =Prints HTML with date information for current post.
------------------------------------------------------*/
if (!function_exists('e8_entry_date')) :

function e8_entry_date($echo = true) {
	if (has_post_format(array('chat', 'status')))
		$format_prefix = _x('%1$s on %2$s', '1: post format name. 2: date', 'twentythirteen');
	else
		$format_prefix = '%2$s';

	$date = sprintf('<span class="date"><time class="entry-date" datetime="%3$s">%4$s</time></span>',
		esc_url(get_permalink()),
		esc_attr(sprintf(__('Permalink to %s', 'twentythirteen'), the_title_attribute('echo=0'))),
		esc_attr(get_the_date( 'c' ) ),
		esc_html(sprintf($format_prefix, get_post_format_string(get_post_format()), get_the_date()))
	);

	if ($echo)
		echo $date;

	return $date;
}

endif;

?>