<?php

/**
 * Adds gallery shortcode defaults of size="medium" and columns="2"
 */
function amethyst_gallery_atts( $out, $pairs, $atts ) {

    $atts = shortcode_atts( array(
        'columns' => '2',
        'size' => 'large',
         ), $atts );

    $out['columns'] = $atts['columns'];
    $out['size'] = $atts['size'];

    return $out;

}
add_filter( 'shortcode_atts_gallery', 'amethyst_gallery_atts', 10, 3 );

?>