<?php

/**
 * Redirects 'page' to 'seite'.
 * Check Rewrite in .htaccess!!!
 */

if ( ! function_exists( 'e8_page_to_seite' ) )
{
    register_activation_hook(   __FILE__ , 'e8_flush_rewrite_on_init' );
    register_deactivation_hook( __FILE__ , 'e8_flush_rewrite_on_init' );
    add_action( 'init', 'e8_page_to_seite' );

    function e8_page_to_seite()
    {
        $GLOBALS['wp_rewrite']->pagination_base = 'seite';
    }

    function e8_flush_rewrite_on_init()
    {
        add_action( 'init', 'flush_rewrite_rules', 11 );
    }
}

?>