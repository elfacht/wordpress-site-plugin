<?php

/**
 * Enable shortcodes in widgets
 */
add_filter('widget_text', 'do_shortcode');



/* =Email encoding
 * Usage: [email]foo@bar.com[/email]
----------------------------------------------------- */
function wpcodex_hide_email_shortcode( $atts , $content = null ) {
  if ( ! is_email( $content ) ) {
    return;
  }

  return '<a href="mailto:' . antispambot( $content ) . '">' . antispambot( $content ) . '</a>';
}

add_shortcode( 'email', 'wpcodex_hide_email_shortcode' );


?>