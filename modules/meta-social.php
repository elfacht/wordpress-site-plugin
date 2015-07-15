<?php

/* Taken from the twentytwelve theme and doesn't need
	to be changed, unless you want so */

/* =HTML5 comment and search form
------------------------------------------------------*/
add_action('wp_head', 'add_meta_social');
function add_meta_social() {
 global $post;
 if (!empty($post)) :
    $the_post = get_post($post->ID);

    $site_description = get_bloginfo('description');

    $site_name = get_bloginfo('title');
    $site_title = get_bloginfo('title') . ' &ndash; ' . $site_description;

    $title = $the_post->post_title;
    $description = $the_post->post_content;
    $content = wp_trim_words($description, 30, ' ...');


    $post_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'original' );
    $current_url = get_bloginfo('url') . $_SERVER["REQUEST_URI"];

    $site_name = htmlentities($site_name);
    $site_title = htmlentities($site_title);
    $title = htmlentities($title);
    $description = htmlentities($description);
    $content = htmlentities($content);

    if (is_singular()) :
      $post_img_url = $post_img['0'];
      $site_title = $title;
      $site_description = $content;
    else :
      $post_img_url = get_site_url() . '/avatar.png';
      $content = $site_description;
    endif;

    function list_meta_tags() {
      $tags = get_the_tags();
      if ($tags) {
          $tag_array = array();
          $i = 0;
          foreach($tags as $tag) :
            $tag_id = $tag->term_id;
            $tag_name = $tag->name;
            $tag_name = strtolower($tag_name);
            $i++;
            if ($i <= 3) :
          ?>
<!-- article:tag:<?php echo $i; ?> --><meta property="article:tag" content="<?php echo $tag_name; ?>" />
          <?php
            endif;
          endforeach;
        } else {
          return false;
        }
    }

    function list_meta_images($post) {
      $attachments = get_posts(array(
        'post_parent' => $post->ID,
        'post_status' => 'inherit',
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'order' => 'ASC'
      ));

      if ( $attachments ) {
        $i = 0;
        foreach ( $attachments as $attachment ) {
          $i++;

          if ($i <= 5) :
            $class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
            $thumbimg = wp_get_attachment_image_src( $attachment->ID, 'post-header' ); ?>

<!-- og:image:<?php echo $i; ?> --><meta property="og:image" content="<?php echo $thumbimg[0]; ?>" />
<!-- og:image:<?php echo $i; ?> --><meta property="og:image:height" content="1200" />
<!-- og:image:<?php echo $i; ?> --><meta property="og:image:width" content="700" />
          <?php endif;
        }

      }
    }

    if (!empty($title)) :?>

<meta name="twitter:card" content="summary">
<meta name="twitter:creator" content="@derguteleben">
<meta name="twitter:site" content="@derguteleben">
<meta name="twitter:title" content="<?php echo $title; ?>">
<meta name="twitter:description" content="<?php echo $content; ?>">
<meta name="twitter:image:src" content="<?php echo $post_img_url; ?>">

<meta itemprop="description" content="<?php echo $content; ?>" />
<meta itemprop="url" content="<?php echo $current_url; ?>" />

<meta property="og:locale" content="de_DE" />
<meta property="og:site_name" content="<?php echo $site_name; ?>" />
<meta property="og:url" content="<?php echo $current_url; ?>" />
<meta property="og:title" content="<?php echo $site_title; ?>" />
<meta property="og:description" content="<?php echo $site_description; ?>" />
<meta property="og:type" content="website" />

<?php if (is_singular()) : list_meta_tags(); endif; ?>

<?php if (is_singular()) : list_meta_images($the_post); endif; ?>

       <?php
    endif;
  endif;
}

?>