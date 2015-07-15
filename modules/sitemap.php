<?php

add_action('template_redirect','show_sitemap');

function show_sitemap() {
  if (isset($_GET['show_sitemap'])) {
    $the_query = new WP_Query(array('post_type' => 'any', 'posts_per_page' => '-1', 'post_status' => 'publish'));
    $urls = array();
    while ($the_query->have_posts()) {
      $the_query->the_post();
      $urls[] = get_permalink();
    }
    die(json_encode($urls));
  }
}

?>