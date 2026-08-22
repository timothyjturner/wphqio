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


/**
 * =========================================================
 * WPHQ RATE SETTINGS + MODAL SHORTCODE
 * =========================================================
 */


/**
 * Add WPHQ Rates settings page.
 */
function wphq_add_rate_settings_page() {
    add_options_page(
        'WPHQ Rate Settings',
        'WPHQ Rates',
        'manage_options',
        'wphq-rate-settings',
        'wphq_render_rate_settings_page'
    );
}
add_action( 'admin_menu', 'wphq_add_rate_settings_page' );


/**
 * Register settings.
 */
function wphq_register_rate_settings() {

    register_setting(
        'wphq_rate_settings_group',
        'wphq_base_hourly_rate',
        array(
            'type'              => 'number',
            'sanitize_callback' => 'wphq_sanitize_hourly_rate',
            'default'           => 90,
        )
    );

}
add_action( 'admin_init', 'wphq_register_rate_settings' );


/**
 * Sanitize rate.
 */
function wphq_sanitize_hourly_rate( $value ) {

    $value = floatval( $value );

    if ( $value < 0 ) {
        $value = 0;
    }

    return $value;
}


/**
 * Render admin settings page.
 */
function wphq_render_rate_settings_page() {

    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $rate = get_option( 'wphq_base_hourly_rate', 90 );
    ?>

    <div class="wrap">

        <h1>WPHQ Rate Settings</h1>

        <p>
            Update the standard WPHQ hourly development and support rate here.
            All rate links and discounted-rate calculations will update automatically.
        </p>

        <form method="post" action="options.php">

            <?php settings_fields( 'wphq_rate_settings_group' ); ?>

            <table class="form-table">

                <tr>
                    <th scope="row">
                        <label for="wphq_base_hourly_rate">
                            Standard Hourly Rate
                        </label>
                    </th>

                    <td>

                        <span>$</span>

                        <input
                            type="number"
                            id="wphq_base_hourly_rate"
                            name="wphq_base_hourly_rate"
                            value="<?php echo esc_attr( $rate ); ?>"
                            step="0.01"
                            min="0"
                            style="width:120px;"
                        >

                        <span>/ hour</span>

                        <p class="description">
                            Example: enter 90 for a standard rate of $90/hour.
                        </p>

                    </td>
                </tr>

            </table>

            <?php submit_button(); ?>

        </form>

    </div>

    <?php
}


/**
 * Helper: get current base rate.
 */
function wphq_get_base_hourly_rate() {

    return floatval(
        get_option( 'wphq_base_hourly_rate', 90 )
    );
}


/**
 * Helper: format rate.
 *
 * 90   -> $90/hr
 * 85.5 -> $85.50/hr
 */
function wphq_format_hourly_rate( $rate ) {

    if ( floor( $rate ) == $rate ) {
        $formatted = number_format( $rate, 0 );
    } else {
        $formatted = number_format( $rate, 2 );
    }

    return '$' . $formatted . '/hr';
}


/**
 * =========================================================
 * BASE RATE LINK SHORTCODE
 *
 * [wphq_base_rate]
 *
 * Default output:
 * standard development rate
 *
 * Optional:
 * [wphq_base_rate text="our standard rate"]
 * =========================================================
 */
function wphq_base_rate_shortcode( $atts ) {

    $atts = shortcode_atts(
        array(
            'text' => 'standard development rate',
        ),
        $atts,
        'wphq_base_rate'
    );

    return sprintf(
        '<a href="#" class="wphq-rate-modal-trigger">%s</a>',
        esc_html( $atts['text'] )
    );
}
add_shortcode(
    'wphq_base_rate',
    'wphq_base_rate_shortcode'
);


/**
 * =========================================================
 * DISCOUNTED RATE SHORTCODE
 *
 * [wphq_discounted_rate discount="20"]
 *
 * Outputs actual discounted rate.
 * =========================================================
 */
function wphq_discounted_rate_shortcode( $atts ) {

    $atts = shortcode_atts(
        array(
            'discount' => 0,
        ),
        $atts,
        'wphq_discounted_rate'
    );

    $discount = floatval( $atts['discount'] );

    if ( $discount < 0 ) {
        $discount = 0;
    }

    if ( $discount > 100 ) {
        $discount = 100;
    }

    $base_rate = wphq_get_base_hourly_rate();

    $discounted_rate = $base_rate * (
        1 - ( $discount / 100 )
    );

    return esc_html(
        wphq_format_hourly_rate( $discounted_rate )
    );
}
add_shortcode(
    'wphq_discounted_rate',
    'wphq_discounted_rate_shortcode'
);


/**
 * =========================================================
 * OUTPUT RATE MODAL ON FRONT END
 * =========================================================
 */
function wphq_output_rate_modal() {

    if ( is_admin() ) {
        return;
    }

    $rate = wphq_get_base_hourly_rate();
    $formatted_rate = wphq_format_hourly_rate( $rate );
    ?>

    <div
        id="wphq-rate-modal"
        class="wphq-rate-modal"
        aria-hidden="true"
    >

        <div class="wphq-rate-modal-overlay"></div>

        <div
            class="wphq-rate-modal-dialog"
            role="dialog"
            aria-modal="true"
            aria-labelledby="wphq-rate-modal-title"
        >

            <button
                type="button"
                class="wphq-rate-modal-close"
                aria-label="Close rate information"
            >
                &times;
            </button>

            <div class="wphq-rate-modal-eyebrow">
                WPHQ Member Pricing
            </div>

            <h2 id="wphq-rate-modal-title">
                Standard Development Rate
            </h2>

            <div class="wphq-rate-modal-rate">
                <?php echo esc_html( $formatted_rate ); ?>
            </div>

            <p>
                Our current standard rate for web development,
                technical support, troubleshooting, and other
                hourly services is
                <strong><?php echo esc_html( $formatted_rate ); ?></strong>.
            </p>

            <p>
                Active WPHQ subscribers receive discounted
                development rates based on their membership plan,
                with savings of up to <strong>20%</strong>.
            </p>

            <div class="wphq-rate-modal-note">
                Any included monthly development hours are used
                before additional hourly charges apply.
            </div>

        </div>

    </div>

    <?php
}
add_action(
    'wp_footer',
    'wphq_output_rate_modal'
);


/**
 * =========================================================
 * MODAL CSS
 * =========================================================
 */
function wphq_rate_modal_styles() {

    if ( is_admin() ) {
        return;
    }
    ?>

    <style>

        .wphq-rate-modal-trigger {
            color: inherit;
            text-decoration: underline;
            text-underline-offset: 2px;
            cursor: pointer;
        }

        .wphq-rate-modal-trigger:hover {
            color: #ef7622;
        }

        .wphq-rate-modal {
            position: fixed;
            inset: 0;
            z-index: 999999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .wphq-rate-modal.is-open {
            display: flex;
        }

        .wphq-rate-modal-overlay {
            position: absolute;
            inset: 0;
            background: rgba(4, 15, 24, 0.78);
            backdrop-filter: blur(4px);
        }

        .wphq-rate-modal-dialog {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 520px;
            padding: 34px;
            border-radius: 16px;
            background: #ffffff;
            color: #17212a;
            box-shadow: 0 24px 70px rgba(0,0,0,.32);
        }

        .wphq-rate-modal-close {
            position: absolute;
            top: 12px;
            right: 15px;
            width: 38px;
            height: 38px;
            border: 0;
            background: transparent;
            color: #223847;
            font-size: 30px;
            line-height: 1;
            cursor: pointer;
        }

        .wphq-rate-modal-eyebrow {
            margin-bottom: 8px;
            color: #3393a2;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .wphq-rate-modal-dialog h2 {
            margin: 0 0 14px;
            color: #223847;
            font-size: 30px;
            line-height: 1.15;
        }

        .wphq-rate-modal-rate {
            margin-bottom: 20px;
            color: #ef7622;
            font-size: 38px;
            line-height: 1;
            font-weight: 800;
        }

        .wphq-rate-modal-dialog p {
            margin: 0 0 16px;
            color: #52616a;
            font-size: 15px;
            line-height: 1.65;
        }

        .wphq-rate-modal-note {
            margin-top: 20px;
            padding: 16px 18px;
            border-left: 4px solid #3393a2;
            border-radius: 6px;
            background: #f3f8f9;
            color: #33474f;
            font-size: 14px;
            line-height: 1.55;
        }

        body.wphq-rate-modal-open {
            overflow: hidden;
        }

        @media (max-width: 600px) {

            .wphq-rate-modal-dialog {
                padding: 28px 22px;
            }

            .wphq-rate-modal-dialog h2 {
                font-size: 25px;
            }

            .wphq-rate-modal-rate {
                font-size: 32px;
            }

        }

    </style>

    <?php
}
add_action(
    'wp_head',
    'wphq_rate_modal_styles'
);


/**
 * =========================================================
 * MODAL JAVASCRIPT
 * =========================================================
 */
function wphq_rate_modal_script() {

    if ( is_admin() ) {
        return;
    }
    ?>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        const modal = document.getElementById('wphq-rate-modal');

        if (!modal) {
            return;
        }

        const triggers = document.querySelectorAll(
            '.wphq-rate-modal-trigger'
        );

        const closeButton = modal.querySelector(
            '.wphq-rate-modal-close'
        );

        const overlay = modal.querySelector(
            '.wphq-rate-modal-overlay'
        );


        function openModal() {

            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');

            document.body.classList.add(
                'wphq-rate-modal-open'
            );
        }


        function closeModal() {

            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');

            document.body.classList.remove(
                'wphq-rate-modal-open'
            );
        }


        triggers.forEach(function (trigger) {

            trigger.addEventListener(
                'click',
                function (event) {

                    event.preventDefault();
                    openModal();
                }
            );

        });


        if (closeButton) {
            closeButton.addEventListener(
                'click',
                closeModal
            );
        }


        if (overlay) {
            overlay.addEventListener(
                'click',
                closeModal
            );
        }


        document.addEventListener(
            'keydown',
            function (event) {

                if (
                    event.key === 'Escape' &&
                    modal.classList.contains('is-open')
                ) {
                    closeModal();
                }

            }
        );

    });
    </script>

    <?php
}
add_action(
    'wp_footer',
    'wphq_rate_modal_script',
    20
);