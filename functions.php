<?php

function mm_scripts() { 
  
  wp_enqueue_script( 'mm_main_js', get_template_directory_uri() . '/assets/main.js', array(), '1.0.0', true ); 
  wp_enqueue_style('mm_main_css',  get_template_directory_uri() .'/assets/main.css'); 

}

add_action( 'admin_init', 'redirect_non_admin_users');

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
require_once(dirname(__FILE__) . '/assets/php/add_ad.php');
require_once(dirname(__FILE__) . '/assets/php/delete_ad.php');
require_once(dirname(__FILE__) . '/assets/php/edit_ad.php');
require_once(dirname(__FILE__) . '/assets/php/filters.php');
require_once(dirname(__FILE__) . '/assets/php/search.php');


add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' ); 

add_action('wp_enqueue_scripts', 'mm_scripts');

function mm_image_size() {

  add_image_size('mm_full', 1200, 900, true);
  add_image_size('mm_prod_med', 500, 500, true);
  add_image_size('mm_prod_sm', 300, 300, true);

}

add_action('after_setup_theme', 'mm_image_size');

