<?php

function mm_scripts() { 
  
  wp_enqueue_script( 'mm_main_js', get_template_directory_uri() . '/assets/main.js', array(), '1.0.0', true ); 
  wp_enqueue_style('mm_main_css',  get_template_directory_uri() .'/assets/main.css'); 

}
add_action( 'admin_init', 'redirect_non_admin_users');
  /**
  * Redirect non-admin users to home page
  *
  * This function is attached to the ‘admin_init’ action hook.
  */
  function redirect_non_admin_users() {
  if ( !current_user_can( 'manage_options' ) && ('/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF']) ) {
      wp_redirect( home_url() );
      show_admin_bar(false);
       exit;
  }
}

add_action('after_setup_theme', 'remove_admin_bar');
 
function remove_admin_bar() {
  if (!current_user_can('manage_options') && !is_admin()) {
    show_admin_bar(false);
  }
}
require_once(dirname(__FILE__) . '/assets/php/custom_post_type.php');
require_once(dirname(__FILE__) . '/assets/php/login_user.php');
require_once(dirname(__FILE__) . '/assets/php/ad_crud.php');


add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' ); 

add_action('wp_enqueue_scripts', 'mm_scripts');

function mm_image_size() {

  add_image_size('mm_full', 1200, 900, true);
  add_image_size('mm_prod_med', 500, 500, true);
  add_image_size('mm_prod_sm', 250, 250, true);
  /*add_image_size('mm_blog_medium', 275, 150, true);
 
  add_image_size('mm_xsm', 78, 70, true);
  add_image_size('mm_single_pr', 406, 550, true);*/
}

add_action('after_setup_theme', 'mm_image_size');



