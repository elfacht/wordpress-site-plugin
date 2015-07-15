<?php

/**
 * Allow HTML in category descriptions
 */
foreach ( array( 'pre_term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_filter_kses' );
}

foreach ( array( 'term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_kses_data' );
}

/**
 * Remove paragraphs
 */
remove_filter('pre_term_description', 'wpautop');
remove_filter('term_description', 'wpautop');

?>