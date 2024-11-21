<?php
add_action( 'wp_enqueue_scripts', 'wphqio_theme_setup' );
function wphqio_theme_setup() {
  add_theme_support( 'title-tag' );
  add_theme_support( 'post-thumbnails' );

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