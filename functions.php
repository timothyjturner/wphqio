<?php
add_action( 'wp_enqueue_scripts', 'wphqio_theme_setup' );
function wphqio_theme_setup() {
  wp_enqueue_style( 'wphqio-style', get_template_directory_uri() . '/dist/css/style.css', array(), rand(100, 1000));

  wp_enqueue_script( 'wphqio-js', get_template_directory_uri() . '/assets/js/global.js', array(), rand(100, 1000), true );
}

add_action( 'after_setup_theme', 'wphq_add_woocommerce_support' );
function wphq_add_woocommerce_support() {
    add_theme_support( 'title-tag' );
  	add_theme_support( 'post-thumbnails' );
  	add_theme_support( 'woocommerce' );
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

add_action('woocommerce_after_checkout_billing_form', 'add_terms_and_subscription_checkbox');
function add_terms_and_subscription_checkbox() {
    echo '<p class="form-row terms-and-subscription">
        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
            <input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox" name="terms_and_subscription" id="terms_and_subscription" /> 
            <span>By completing this purchase, you agree to our 
                <a href="/terms-of-services/" target="_blank">Terms of Service</a>
                and acknowledge that your subscription will renew automatically until you cancel.
            </span>
        </label>
    </p>';
}

add_action('woocommerce_checkout_process', 'validate_terms_and_subscription_checkbox');
function validate_terms_and_subscription_checkbox() {
    if (!isset($_POST['terms_and_subscription'])) {
        wc_add_notice(__('Please agree to the Terms of Service and acknowledge the subscription renewal to proceed.'), 'error');
    }
}

add_action('woocommerce_checkout_update_order_meta', 'save_terms_and_subscription_checkbox');
function save_terms_and_subscription_checkbox($order_id) {
    if (isset($_POST['terms_and_subscription'])) {
        update_post_meta($order_id, '_terms_and_subscription', 'yes');
    }
}
