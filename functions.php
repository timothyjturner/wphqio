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


/**
 * WPHQ Free Website Onboarding Email
 *
 * Sends a separate email after the INITIAL purchase of a WooCommerce
 * product that has the ACF "includes_free_website" flag enabled.
 *
 * Subscription renewal orders are excluded.
 * Each order can trigger this email only once.
 */

add_action( 'woocommerce_payment_complete', 'wphq_maybe_send_free_website_email', 20 );
add_action( 'woocommerce_order_status_processing', 'wphq_maybe_send_free_website_email', 20 );

function wphq_maybe_send_free_website_email( $order_id ) {

    $order = wc_get_order( $order_id );

    if ( ! $order ) {
        return;
    }

    /*
     * Do not send twice.
     *
     * We hook both payment_complete and processing for reliability,
     * so this order-level flag prevents duplicate emails.
     */
    if ( $order->get_meta( '_wphq_free_website_email_sent' ) ) {
        return;
    }

    /*
     * Do not send this onboarding email for subscription renewals.
     */
    if (
        function_exists( 'wcs_order_contains_renewal' ) &&
        wcs_order_contains_renewal( $order )
    ) {
        return;
    }

    /*
     * Check purchased products for the ACF free-website flag.
     */
    $qualifies = false;

    foreach ( $order->get_items() as $item ) {

        $product = $item->get_product();

        if ( ! $product ) {
            continue;
        }

        $product_id = $product->get_id();
        $parent_id  = $product->get_parent_id();

        /*
         * Check purchased product first.
         */
        $includes_free_website = get_field(
            'includes_free_website',
            $product_id
        );

        /*
         * If this is a variation, fall back to the parent product.
         */
        if ( ! $includes_free_website && $parent_id ) {
            $includes_free_website = get_field(
                'includes_free_website',
                $parent_id
            );
        }

        if ( $includes_free_website ) {
            $qualifies = true;
            break;
        }
    }

    if ( ! $qualifies ) {
        return;
    }

    /*
     * Customer email address.
     */
    $to = $order->get_billing_email();

    if ( ! is_email( $to ) ) {
        return;
    }

    $first_name = $order->get_billing_first_name();

    $subject = 'Your Free WPHQ Website – Let’s Get Started';

    /*
     * Build HTML email content.
     */
    ob_start();
    ?>

    <p>
        <?php
        if ( $first_name ) {
            echo 'Hi ' . esc_html( $first_name ) . ',';
        } else {
            echo 'Hello,';
        }
        ?>
    </p>

    <p>
        Thanks for choosing WPHQ! Your new plan includes a
        <strong>professionally built WordPress starter website at no additional cost.</strong>
    </p>

    <p>
        Getting started is simple. We've put together a step-by-step guide
        that walks you through everything from choosing your design through launch.
    </p>

    <p style="margin:24px 0;">
        <a href="https://wphq.io/website-build-process/"
           style="
                display:inline-block;
                background:#e86f1c;
                color:#ffffff;
                text-decoration:none;
                padding:13px 22px;
                border-radius:6px;
                font-weight:bold;
           ">
            View Your Website Build Guide
        </a>
    </p>

    <h2 style="margin-top:30px;">
        Ready to Jump Right In?
    </h2>

    <p>
        You can also go directly to the WPHQ Website Builder and submit
        the information we'll use to create your website.
    </p>

    <p>
        <strong>Website Builder:</strong><br>
        <a href="https://build.launch.wphq.io/">
            https://build.launch.wphq.io/
        </a>
    </p>

    <p>
        <strong>Password:</strong>
        <span style="
            display:inline-block;
            margin-left:4px;
            padding:3px 8px;
            background:#f3f3f3;
            border:1px solid #dddddd;
            border-radius:4px;
            font-family:monospace;
        ">
            build
        </span>
    </p>

    <p>
        The builder will ask for details such as your business name,
        services or products, logo, branding, images, contact information,
        and preferred starter design.
    </p>

    <p>
        <strong>Don't have everything ready?</strong>
        That's okay. Provide what you have and we'll help you through anything
        you're unsure about.
    </p>

    <h2 style="margin-top:30px;">
        What Happens After You Submit?
    </h2>

    <p>
        WPHQ will prepare your website and contact you when your first version
        is ready to review.
    </p>

    <p>
        Your starter website includes up to
        <strong>one hour of complimentary edits</strong>
        so we can make reasonable adjustments before launch.
    </p>

    <p>
        We'll also help you get your domain connected when the website is ready
        to go live.
    </p>

    <hr style="margin:30px 0;border:0;border-top:1px solid #dddddd;">

    <h2>Need Help?</h2>

    <p>
        You don't need to be technical to use this service.
        If you have questions at any point, simply reply to this email
        and we'll help you through the next step.
    </p>

    <p>
        You can also call WPHQ at
        <a href="tel:+16149166243">614-916-6243</a>.
    </p>

    <p>
        We're looking forward to building your new website!
    </p>

    <p>
        — The WPHQ Team
    </p>

    <?php

    $message = ob_get_clean();

    /*
     * Run the content through the normal WooCommerce email wrapper
     * so it uses WooCommerce's email branding.
     */
    $mailer = WC()->mailer();

    $message = $mailer->wrap_message(
        'Your Free Website Is Included',
        $message
    );

    $headers = array(
        'Content-Type: text/html; charset=UTF-8'
    );

    /*
     * Send using the WooCommerce mailer.
     */
    $sent = $mailer->send(
        $to,
        $subject,
        $message,
        $headers
    );

    /*
     * Mark the order only after successful send.
     *
     * This prevents payment_complete + processing from generating
     * two emails for the same initial order.
     */
    if ( $sent ) {

        $order->update_meta_data(
            '_wphq_free_website_email_sent',
            current_time( 'mysql' )
        );

        $order->save();

        $order->add_order_note(
            'WPHQ free website onboarding email sent to customer.'
        );
    }
}