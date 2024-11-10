<?php
function wphqio_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );

    // Enqueue the compiled CSS
    wp_enqueue_style( 'wphqio-style', get_template_directory_uri() . '/dist/css/style.css' );
}

add_action( 'wp_enqueue_scripts', 'wphqio_theme_setup' );

function wpb_custom_new_menu() {
    register_nav_menus(
      array(
        'main-menu' => __( 'Main Menu' ),
        'footer-menu' => __( 'Footer Menu' )
      )
    );
  }
  add_action( 'init', 'wpb_custom_new_menu' );