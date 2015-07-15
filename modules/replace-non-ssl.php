<?php

function filter_content_match_protocols( $content ) {
    $search = $replace = get_bloginfo( 'home' );

    if ( ! preg_match( '|/$|', $search ) )
        $search = $replace = "$search/";

    if ( is_ssl() ) {
        $search = str_replace( 'https://', 'http://', $search );
        $replace = str_replace( 'http://', 'https://', $replace );
    }
    else {
        $search = str_replace( 'http://', 'https://', $search );
        $replace = str_replace( 'https://', 'http://', $replace );
    }

    $content = str_replace( $search, $replace, $content );

    return $content;
}
ob_start( 'filter_content_match_protocols' );

function filter_content_match_protocols_end() {
    ob_end_flush();
}
add_action( 'shutdown', 'filter_content_match_protocols_end', -10 );

?>