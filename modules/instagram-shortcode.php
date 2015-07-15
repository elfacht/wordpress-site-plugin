<?php

/* =Include Instagram posts
------------------------------------------------------*/
add_shortcode('instagram', 'e8_instagram');

function e8_instagram($atts) {

  $a = shortcode_atts( array(
    'user' => 'derguteleben',
    'tag' => 'derguteleben',
    'limit' => null,
    'size' => 'medium',
    'title' => 'Instagram',
    'widget' => false
  ), $atts );

  $html = '';

  $html .= '<div class="instagram-wrapper">';

  if ($a['title']) :
    $html .= '<h3 class="dgl-section__title">';
      $html .= '<span class="uppercase">'. $a['title'] .'</span>';
    $html .= '</h3>';
  endif;

  if ($a['limit']) :
    $html .= do_shortcode('[si_feed tag="'. $a['tag'] .'" user="'. $a['user'] .'" limit="'. $a['limit'] .'" size="'. $a['size'] .'"]');
  else :
    $html .= do_shortcode('[si_feed tag="'. $a['tag'] .'" user="'. $a['user'] .'" size="'. $a['size'] .'"]');
  endif;


  // if (!$a['widget']) :
  //   $html .= '<p class="instagram-footer text-center base-font uppercase"><a href="http://instagram.com/derguteleben" target="_blank">instagram.com/derguteleben</a></p>';
  // endif;
  $html .= '</div>';

  return $html;


}

?>