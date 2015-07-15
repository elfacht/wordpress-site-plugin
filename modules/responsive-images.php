<?php

/* =Responsive images with picturefill
------------------------------------------------------*/
function add_picturefill(){
  wp_enqueue_script(
    'picturefill',
    get_bloginfo('template_url').'/assets/js/picturefill.js' );
}

add_action('wp_enqueue_scripts', 'add_picturefill');

function get_attachment_id_from_src($url) {
  global $wpdb;
  $prefix = $wpdb->prefix;
  $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " WHERE guid='%s';", $url ));
    return $attachment[0];
}


function responsive_image($atts){
  extract( shortcode_atts( array(
    'src' => '',
    'caption' => '',
    'size' => ''
  ), $atts ) );

  if($src != '')
  {
    $img_ID = get_attachment_id_from_src($src);
    $max = wp_get_attachment_image_src( $img_ID, 'resp-max' );
    $full = wp_get_attachment_image_src( $img_ID, 'resp-full' );
    $large = wp_get_attachment_image_src( $img_ID, 'resp-large' );
    $medium = wp_get_attachment_image_src( $img_ID, 'resp-medium' );
    $small = wp_get_attachment_image_src( $img_ID, 'resp-small' );

		$output = '';

		//if ($size == "full") {
			//$output .= '</div></div></div>';
		//}

    $output.= '<span class="responsive-image entry-image">';
    $output.= '  <span class="image" data-alt="' . $caption . '">';
    $output.= '    <span data-src="' . $small[0] . '"></span>';
    $output.= '    <span data-src="' . $large[0] . '" data-media="(min-width: 480px)"></span>';
    $output.= '    <span data-src="' . $full[0] . '" data-media="(min-width: 786px)"></span>';
    $output.= '    <noscript>';
    $output.= '      <img src="' . $small[0] . '" alt="' . $caption . '">';
    $output.= '    </noscript>';
    $output.= '  </span>';
    if($caption != '') $output.= '  <p class="caption">' . $caption . '</p>';
    $output.= '</span>';

   // if ($size == "full") {
   //  	$output .= '<div class="row">';
			// $output .= '<div class="large-8 large-centered columns">';
			// $output .= '<div class="entry-content">';
   // }
  }

  return $output;

}

add_shortcode('rimg', 'responsive_image');


?>