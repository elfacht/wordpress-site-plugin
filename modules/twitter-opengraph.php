<?php



/* =Customize Twitter meta tag
----------------------------------------------------- */
function tweakjp_custom_twitter_site($og_tags) {
  $og_tags['twitter:site'] = '@derguteleben';
  return $og_tags;
}
add_filter('jetpack_open_graph_tags', 'tweakjp_custom_twitter_site', 11);


?>