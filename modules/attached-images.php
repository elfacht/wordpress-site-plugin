<?php

/**
 * Default image attachment page function
 */
if ( ! function_exists( 'twentythirteen_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_the_attached_image() {
  /**
   * Filter the image attachment size to use.
   *
   * @since Twenty thirteen 1.0
   *
   * @param array $size {
   *     @type int The attachment height in pixels.
   *     @type int The attachment width in pixels.
   * }
   */
  $attachment_size     = apply_filters( 'twentythirteen_attachment_size', array( 724, 724 ) );
  $next_attachment_url = wp_get_attachment_url();
  $post                = get_post();

  /*
   * Grab the IDs of all the image attachments in a gallery so we can get the URL
   * of the next adjacent image in a gallery, or the first image (if we're
   * looking at the last image in a gallery), or, in a gallery of one, just the
   * link to that image file.
   */
  $attachment_ids = get_posts( array(
    'post_parent'    => $post->post_parent,
    'fields'         => 'ids',
    'numberposts'    => -1,
    'post_status'    => 'inherit',
    'post_type'      => 'attachment',
    'post_mime_type' => 'image',
    'order'          => 'ASC',
    'orderby'        => 'menu_order ID',
  ) );

  // If there is more than 1 attachment in a gallery...
  if ( count( $attachment_ids ) > 1 ) {
    foreach ( $attachment_ids as $attachment_id ) {
      if ( $attachment_id == $post->ID ) {
        $next_id = current( $attachment_ids );
        break;
      }
    }

    // get the URL of the next image attachment...
    if ( $next_id )
      $next_attachment_url = get_attachment_link( $next_id );

    // or get the URL of the first image attachment.
    else
      $next_attachment_url = get_attachment_link( reset( $attachment_ids ) );
  }

  printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
    esc_url( $next_attachment_url ),
    the_title_attribute( array( 'echo' => false ) ),
    wp_get_attachment_image( $post->ID, $attachment_size )
  );
}
endif;

?>