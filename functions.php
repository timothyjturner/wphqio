<?php
add_action( 'wp_enqueue_scripts', 'wphqio_theme_setup' );
function wphqio_theme_setup() {
  add_theme_support( 'title-tag' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'woocommerce' );

  wp_enqueue_style( 'wphqio-style', get_template_directory_uri() . '/dist/css/style.css', array(), rand(100, 1000));

  wp_enqueue_script( 'wphqio-js', get_template_directory_uri() . '/assets/js/global.js', array(), rand(100, 1000), true );
}

add_action( 'init', 'wpb_custom_new_menu' );
function wpb_custom_new_menu() {
  register_nav_menus(
    array(
      'main-menu' => __( 'Main Menu' ),
      'footer-menu' => __( 'Footer Menu' )
    )
  );
}

if( function_exists('acf_add_options_page') ) {

  acf_add_options_page(array(
    'page_title'    => 'Theme Settings',
    'menu_title'    => 'Theme Settings',
    'menu_slug'     => 'theme-settings',
    'capability'    => 'edit_posts',
    'redirect'      => false
  ));

}

function current_year_func() {
  $current_year = date('Y');

  return $current_year;
}
add_shortcode( 'year', 'current_year_func' );