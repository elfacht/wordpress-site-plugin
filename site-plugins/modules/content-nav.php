<?php

if ( ! function_exists( 'e8_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function e8_content_nav( $nav_id ) {
  global $wp_query;

  if ( $wp_query->max_num_pages > 1 ) : ?>
    <nav id="<?php echo $nav_id; ?>" class="nav-below row">
      <div class="nav-previous small-6 columns text-right"><?php next_posts_link( __( '<i class="icn-arrow-left" title="Ältere"></i>', 'twentyeleven' ) ); ?></div>
      <div class="nav-next small-6 columns"><?php previous_posts_link( __( '<i class="icn-arrow-right" title="Neuere"></i>', 'twentyeleven' ) ); ?></div>
    </nav><!-- #nav-above -->
  <?php endif;
}
endif; // e8_content_nav

?>