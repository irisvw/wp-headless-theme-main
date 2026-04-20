<?php
/**
 * This file is the main entry point for WordPress functions.
 */
/**
 * Load all modules.
 */
require_once get_template_directory() . '/functions/wp-functions.php';

//===================
// Add theme support
//===================
function theme_name_setup() {
  add_theme_support( 'align-wide' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'title-tag' );
  add_post_type_support( 'page', 'excerpt' );
}
add_action( 'after_setup_theme', 'theme_name_setup' );
 
//===================
// Function to remove admin menu
//===================
function remove_posts_from_admin() {
  // remove_menu_page( 'edit.php' ); //Remove posts
  remove_menu_page( 'edit-comments.php' ); //Remove comments
}
add_action( 'admin_menu', 'remove_posts_from_admin', 999 );

add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
function my_acf_json_save_point($path)
{
  // update path
  $path = get_stylesheet_directory() . '/field-groups';
 
  // return
  return $path;
}
 
add_filter('acf/settings/load_json', 'my_acf_json_load_point');
 
function my_acf_json_load_point($paths)
{
  // remove original path (optional)
  unset($paths[0]);
 
  $paths[] = get_stylesheet_directory() . '/field-groups';
 
  // return
  return $paths;
}