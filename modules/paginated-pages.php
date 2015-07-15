<?php

function wp_link_pages_titled($args = '') {
  $defaults = array(
    'before' => '<footer class="post-pages"><h4 class="dgl-section__title text-left"><span>' . __('Weiterlesen') . '</span></h4><ul class="meta-list unstyled">',
    'after' => '</ul></footer>',
    'link_before' => '<li>',
    'link_after' => '<li />',
    'echo' => 1
  );

  $r = wp_parse_args( $args, $defaults );
  extract( $r, EXTR_SKIP );

  global $page, $numpages, $multipage, $more, $pagenow, $pages;

  $output = '';
  if ( $multipage ) {
    $output .= $before;
    for ( $i = 1; $i < ($numpages+1); $i = $i + 1 ) {
      $part_content = $pages[$i-1];
      $has_part_title = strpos( $part_content, '<!--pagetitle:' );
      if( 0 === $has_part_title ) {
        $end = strpos( $part_content, '-->' );
        $title = trim( str_replace( '<!--pagetitle:', '', substr( $part_content, 0, $end ) ) );
      }
      $output .= ' ';
      if ( ($i != $page) || ((!$more) && ($page==1)) ) {
        $output .= _wp_link_page($i);
      }
      $title = isset( $title ) && ( strlen( $title ) > 0 ) ? $title : 'First';
      $output .= $link_before . $title . $link_after;
      if ( ($i != $page) || ((!$more) && ($page==1)) )
        $output .= '</a>';
    }
    $output .= $after;
  }

  if ( $echo )
    echo $output;
  return $output;
}

?>