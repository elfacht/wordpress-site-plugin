<?php

/* =Media send to editor
------------------------------------------------------*/
add_filter('media_send_to_editor', 'my_filter_iste', 20, 3);

function my_filter_iste($html, $id, $caption, $title, $align, $url, $size, $alt) {
    $attachment = get_post($id); //fetching attachment by $id passed through

    $mime_type = $attachment->post_mime_type; //getting the mime-type
    if (substr($mime_type, 0, 5) == 'image') { //checking mime-type
        $src = wp_get_attachment_url( $id );
        $size = wp_get_attachment_metadata( $id );
        $html = '[rimg src="'.$src.'" caption="'.$attachment->post_excerpt.'" size=""]';
    }

    return $html; // return new $html
}

?>