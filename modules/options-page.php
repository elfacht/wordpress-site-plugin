<?php


/**
 * Creates a theme options page for ADVANCED CUSTOM FIELDS (ACF)
 */
if( function_exists('acf_add_options_page') ) {

  /**
   * General settings
   */
  acf_add_options_page(array(
      'page_title'    => 'Theme-Einstellungen',
      'menu_title'    => 'Theme-Einstellungen',
      'menu_slug'     => 'theme-general-settings',
      'capability'    => 'edit_posts',
      'redirect'      => false
  ));


  /**
   * Header settings
   */
  acf_add_options_sub_page(array(
      'page_title'    => 'Header',
      'menu_title'    => 'Header',
      'parent_slug'   => 'theme-general-settings',
  ));

}

?>