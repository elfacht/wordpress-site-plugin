<?php

/**
 * Add post type 'guides'
 */
add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'guides',
    array(
      'menu_position' => 5,
      'exclude_from_search' => false,
      'labels' => array(
        'name' => __( 'Guides' ),
        'singular_name' => __( 'Guide' ),
        'add_new' => 'Neuer Guide'
      ),
      'public' => true,
      'has_archive' => true,
      'show_in_nav_menus' => true,
      'rewrite' => array('slug' => 'guides'),
      'supports' => array('title', 'editor', 'excerpt', 'page-atributes', 'thumbnail')
    )
  );
  flush_rewrite_rules( false );
}

/**
 * Add current menu CSS class for custom post type
 */
add_filter('nav_menu_css_class', 'current_type_nav_class', 10, 2);
function current_type_nav_class($classes, $item) {
    // Get post_type for this post
    $post_type = get_query_var('post_type');

    // Go to Menus and add a menu class named: {custom-post-type}-menu-item
    // This adds a 'current_page_parent' class to the parent menu item
    if( in_array( $post_type.'-menu-item', $classes ) )
        array_push($classes, 'current-menu-item');

    return $classes;
}


/**
 * Add meta box (archive page) for custom post type to menu
 */
add_action('admin_head-nav-menus.php', 'wpclean_add_metabox_menu_posttype_archive');

function wpclean_add_metabox_menu_posttype_archive() {
add_meta_box('wpclean-metabox-nav-menu-posttype', 'Custom Post Type Archives', 'wpclean_metabox_menu_posttype_archive', 'nav-menus', 'side', 'default');
}

function wpclean_metabox_menu_posttype_archive() {
  $post_types = get_post_types(array('show_in_nav_menus' => true, 'has_archive' => true), 'object');

  if ($post_types) :
      $items = array();
      $loop_index = 999999;

      foreach ($post_types as $post_type) {
          $item = new stdClass();
          $loop_index++;

          $item->object_id = $loop_index;
          $item->db_id = 0;
          $item->object = 'post_type_' . $post_type->query_var;
          $item->menu_item_parent = 0;
          $item->type = 'custom';
          $item->title = $post_type->labels->name;
          $item->url = get_post_type_archive_link($post_type->query_var);
          $item->target = '';
          $item->attr_title = '';
          $item->classes = array();
          $item->xfn = '';

          $items[] = $item;
      }

      $walker = new Walker_Nav_Menu_Checklist(array());

      echo '<div id="posttype-archive" class="posttypediv">';
      echo '<div id="tabs-panel-posttype-archive" class="tabs-panel tabs-panel-active">';
      echo '<ul id="posttype-archive-checklist" class="categorychecklist form-no-clear">';
      echo walk_nav_menu_tree(array_map('wp_setup_nav_menu_item', $items), 0, (object) array('walker' => $walker));
      echo '</ul>';
      echo '</div>';
      echo '</div>';

      echo '<p class="button-controls">';
      echo '<span class="add-to-menu">';
      echo '<input type="submit"' . disabled(1, 0) . ' class="button-secondary submit-add-to-menu right" value="' . __('Add to Menu', 'andromedamedia') . '" name="add-posttype-archive-menu-item" id="submit-posttype-archive" />';
      echo '<span class="spinner"></span>';
      echo '</span>';
      echo '</p>';

  endif;
}

?>