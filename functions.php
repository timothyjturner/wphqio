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
 * =========================================================
 * WPHQ CUSTOM PURCHASE BENEFIT + ONBOARDING EMAIL SYSTEM
 * =========================================================
 *
 * Replaces the old product-level "includes_free_website" email trigger.
 * The benefit is now selected at the PAGE / PRICING-ROW level and travels
 * with the specific WooCommerce purchase as signed cart-item data.
 *
 * This lets the same annual WooCommerce product provide ONE contextual
 * acquisition benefit (free website, recovery, speed work, migration, etc.)
 * depending on the page from which the customer purchases it.
 */

/**
 * Register the admin-only Custom Product Emails post type.
 */
function wphq_register_custom_product_email_cpt() {
    $labels = array(
        'name'               => 'Custom Product Emails',
        'singular_name'      => 'Custom Product Email',
        'menu_name'          => 'Custom Product Emails',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add Custom Product Email',
        'edit_item'          => 'Edit Custom Product Email',
        'new_item'           => 'New Custom Product Email',
        'view_item'          => 'View Custom Product Email',
        'search_items'       => 'Search Custom Product Emails',
        'not_found'          => 'No custom product emails found.',
        'not_found_in_trash' => 'No custom product emails found in Trash.',
    );

    register_post_type(
        'wphq_product_email',
        array(
            'labels'              => $labels,
            'public'              => false,
            'publicly_queryable'  => false,
            'exclude_from_search' => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => false,
            'show_in_admin_bar'   => false,
            'menu_icon'           => 'dashicons-email-alt2',
            'supports'            => array( 'title', 'editor' ),
            'has_archive'         => false,
            'rewrite'             => false,
            'query_var'           => false,
            'show_in_rest'        => false,
        )
    );
}
add_action( 'init', 'wphq_register_custom_product_email_cpt' );

/**
 * Add email configuration fields to each Custom Product Email.
 * The main WordPress editor is used for the email body.
 */
function wphq_add_custom_product_email_meta_box() {
    add_meta_box(
        'wphq-product-email-settings',
        'Purchase Email Settings',
        'wphq_render_custom_product_email_meta_box',
        'wphq_product_email',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'wphq_add_custom_product_email_meta_box' );

function wphq_render_custom_product_email_meta_box( $post ) {
    wp_nonce_field( 'wphq_save_product_email_settings', 'wphq_product_email_nonce' );

    $subject  = get_post_meta( $post->ID, '_wphq_email_subject', true );
    $heading  = get_post_meta( $post->ID, '_wphq_email_heading', true );
    $cta_text = get_post_meta( $post->ID, '_wphq_email_cta_text', true );
    $cta_url  = get_post_meta( $post->ID, '_wphq_email_cta_url', true );
    ?>

    <p>
        <label for="wphq_email_subject"><strong>Email Subject</strong></label><br>
        <input type="text" id="wphq_email_subject" name="wphq_email_subject"
               value="<?php echo esc_attr( $subject ); ?>" class="widefat"
               placeholder="Your WPHQ Service – Let's Get Started">
    </p>

    <p>
        <label for="wphq_email_heading"><strong>WooCommerce Email Heading</strong></label><br>
        <input type="text" id="wphq_email_heading" name="wphq_email_heading"
               value="<?php echo esc_attr( $heading ); ?>" class="widefat"
               placeholder="Your Included Service Is Ready">
    </p>

    <p>
        <label for="wphq_email_cta_text"><strong>CTA Button Text</strong></label><br>
        <input type="text" id="wphq_email_cta_text" name="wphq_email_cta_text"
               value="<?php echo esc_attr( $cta_text ); ?>" class="widefat"
               placeholder="Start Your Service Request">
    </p>

    <p>
        <label for="wphq_email_cta_url"><strong>CTA Button URL</strong></label><br>
        <input type="url" id="wphq_email_cta_url" name="wphq_email_cta_url"
               value="<?php echo esc_attr( $cta_url ); ?>" class="widefat"
               placeholder="https://wphq.io/service-request/">
    </p>

    <p class="description">
        Use the main editor above for the email body. Supported placeholders in the subject,
        heading, body, and CTA URL: <code>{first_name}</code>, <code>{order_number}</code>,
        <code>{benefit_key}</code>.
    </p>

    <?php
}

function wphq_save_custom_product_email_meta( $post_id ) {
    if ( get_post_type( $post_id ) !== 'wphq_product_email' ) {
        return;
    }

    if (
        empty( $_POST['wphq_product_email_nonce'] ) ||
        ! wp_verify_nonce(
            sanitize_text_field( wp_unslash( $_POST['wphq_product_email_nonce'] ) ),
            'wphq_save_product_email_settings'
        )
    ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $text_fields = array(
        '_wphq_email_subject'  => 'wphq_email_subject',
        '_wphq_email_heading'  => 'wphq_email_heading',
        '_wphq_email_cta_text' => 'wphq_email_cta_text',
    );

    foreach ( $text_fields as $meta_key => $post_key ) {
        $value = isset( $_POST[ $post_key ] )
            ? sanitize_text_field( wp_unslash( $_POST[ $post_key ] ) )
            : '';

        update_post_meta( $post_id, $meta_key, $value );
    }

    $cta_url = isset( $_POST['wphq_email_cta_url'] )
        ? esc_url_raw( wp_unslash( $_POST['wphq_email_cta_url'] ) )
        : '';

    update_post_meta( $post_id, '_wphq_email_cta_url', $cta_url );
}
add_action( 'save_post_wphq_product_email', 'wphq_save_custom_product_email_meta' );

/**
 * Create a signed benefit context so a visitor cannot swap arbitrary email IDs
 * or benefit keys into an add-to-cart URL.
 */
function wphq_build_benefit_signature( $product_id, $email_id, $benefit_key ) {
    $payload = absint( $product_id ) . '|' . absint( $email_id ) . '|' . sanitize_key( $benefit_key );

    return hash_hmac( 'sha256', $payload, wp_salt( 'auth' ) );
}

function wphq_is_valid_custom_purchase_email( $email_id ) {
    $email_id = absint( $email_id );

    return (
        $email_id > 0 &&
        get_post_type( $email_id ) === 'wphq_product_email' &&
        get_post_status( $email_id ) === 'publish'
    );
}

/**
 * Capture the signed page-level benefit context when WooCommerce adds the
 * selected annual plan to the cart.
 */
function wphq_capture_purchase_benefit_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
    $email_id    = isset( $_REQUEST['wphq_purchase_email'] )
        ? absint( wp_unslash( $_REQUEST['wphq_purchase_email'] ) )
        : 0;
    $benefit_key = isset( $_REQUEST['wphq_benefit_key'] )
        ? sanitize_key( wp_unslash( $_REQUEST['wphq_benefit_key'] ) )
        : '';
    $signature   = isset( $_REQUEST['wphq_benefit_sig'] )
        ? sanitize_text_field( wp_unslash( $_REQUEST['wphq_benefit_sig'] ) )
        : '';

    if ( ! $email_id || ! $benefit_key || ! $signature ) {
        return $cart_item_data;
    }

    $actual_product_id = $variation_id ? absint( $variation_id ) : absint( $product_id );
    $expected          = wphq_build_benefit_signature( $actual_product_id, $email_id, $benefit_key );

    if ( ! hash_equals( $expected, $signature ) ) {
        return $cart_item_data;
    }

    if ( ! wphq_is_valid_custom_purchase_email( $email_id ) ) {
        return $cart_item_data;
    }

    $cart_item_data['wphq_purchase_email_id'] = $email_id;
    $cart_item_data['wphq_benefit_key']       = $benefit_key;

    /*
     * Keep identical WooCommerce products with different acquisition benefits
     * as separate cart lines when necessary.
     */
    $cart_item_data['wphq_benefit_context'] = md5(
        $actual_product_id . '|' . $email_id . '|' . $benefit_key
    );

    return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'wphq_capture_purchase_benefit_cart_item_data', 20, 3 );

/**
 * Persist the benefit context on the ORDER ITEM, not on the product itself.
 */
function wphq_store_purchase_benefit_on_order_item( $item, $cart_item_key, $values, $order ) {
    if ( empty( $values['wphq_purchase_email_id'] ) ) {
        return;
    }

    $email_id    = absint( $values['wphq_purchase_email_id'] );
    $benefit_key = ! empty( $values['wphq_benefit_key'] )
        ? sanitize_key( $values['wphq_benefit_key'] )
        : '';

    if ( ! wphq_is_valid_custom_purchase_email( $email_id ) ) {
        return;
    }

    $item->add_meta_data( '_wphq_purchase_email_id', $email_id, true );
    $item->add_meta_data( '_wphq_benefit_key', $benefit_key, true );
}
add_action( 'woocommerce_checkout_create_order_line_item', 'wphq_store_purchase_benefit_on_order_item', 20, 4 );

/**
 * Replace simple placeholders in custom email content.
 */
function wphq_replace_purchase_email_placeholders( $value, $order, $benefit_key ) {
    $first_name = $order->get_billing_first_name();

    return strtr(
        (string) $value,
        array(
            '{first_name}'    => $first_name ? $first_name : 'there',
            '{order_number}'  => $order->get_order_number(),
            '{benefit_key}'   => $benefit_key,
        )
    );
}

/**
 * Send each configured contextual purchase email once after the INITIAL order.
 */
add_action( 'woocommerce_payment_complete', 'wphq_maybe_send_custom_purchase_emails', 20 );
add_action( 'woocommerce_order_status_processing', 'wphq_maybe_send_custom_purchase_emails', 20 );

function wphq_maybe_send_custom_purchase_emails( $order_id ) {
    $order = wc_get_order( $order_id );

    if ( ! $order ) {
        return;
    }

    /* Never send acquisition/onboarding benefit emails for renewals. */
    if (
        function_exists( 'wcs_order_contains_renewal' ) &&
        wcs_order_contains_renewal( $order )
    ) {
        return;
    }

    $to = $order->get_billing_email();

    if ( ! is_email( $to ) ) {
        return;
    }

    /* One email template may appear on more than one line item; send it once. */
    $emails_to_send = array();

    foreach ( $order->get_items() as $item ) {
        $email_id = absint( $item->get_meta( '_wphq_purchase_email_id', true ) );

        if ( ! $email_id || ! wphq_is_valid_custom_purchase_email( $email_id ) ) {
            continue;
        }

        $benefit_key = sanitize_key( $item->get_meta( '_wphq_benefit_key', true ) );

        if ( ! isset( $emails_to_send[ $email_id ] ) ) {
            $emails_to_send[ $email_id ] = $benefit_key;
        }
    }

    if ( empty( $emails_to_send ) ) {
        return;
    }

    $mailer = WC()->mailer();

    foreach ( $emails_to_send as $email_id => $benefit_key ) {
        $sent_meta_key = '_wphq_custom_purchase_email_' . absint( $email_id ) . '_sent';

        if ( $order->get_meta( $sent_meta_key ) ) {
            continue;
        }

        $email_post = get_post( $email_id );

        if ( ! $email_post || $email_post->post_type !== 'wphq_product_email' ) {
            continue;
        }

        $subject = get_post_meta( $email_id, '_wphq_email_subject', true );
        $heading = get_post_meta( $email_id, '_wphq_email_heading', true );
        $cta_text = get_post_meta( $email_id, '_wphq_email_cta_text', true );
        $cta_url  = get_post_meta( $email_id, '_wphq_email_cta_url', true );

        $subject = $subject ? $subject : $email_post->post_title;
        $heading = $heading ? $heading : $email_post->post_title;

        $subject  = wphq_replace_purchase_email_placeholders( $subject, $order, $benefit_key );
        $heading  = wphq_replace_purchase_email_placeholders( $heading, $order, $benefit_key );
        $cta_text = wphq_replace_purchase_email_placeholders( $cta_text, $order, $benefit_key );
        $cta_url  = wphq_replace_purchase_email_placeholders( $cta_url, $order, $benefit_key );
        $body     = wphq_replace_purchase_email_placeholders( $email_post->post_content, $order, $benefit_key );

        ob_start();
        ?>

        <p>
            <?php
            $first_name = $order->get_billing_first_name();
            echo $first_name
                ? 'Hi ' . esc_html( $first_name ) . ','
                : 'Hello,';
            ?>
        </p>

        <?php echo wp_kses_post( do_shortcode( wpautop( $body ) ) ); ?>

        <?php if ( $cta_text && $cta_url ): ?>
            <p style="margin:24px 0;">
                <a href="<?php echo esc_url( $cta_url ); ?>"
                   style="display:inline-block;background:#e86f1c;color:#ffffff;text-decoration:none;padding:13px 22px;border-radius:6px;font-weight:bold;">
                    <?php echo esc_html( $cta_text ); ?>
                </a>
            </p>
        <?php endif; ?>

        <hr style="margin:30px 0;border:0;border-top:1px solid #dddddd;">

        <p>
            Questions? Simply reply to this email or call WPHQ at
            <a href="tel:+16149166243">614-916-6243</a>.
        </p>

        <p>— The WPHQ Team</p>

        <?php
        $message = ob_get_clean();

        $message = $mailer->wrap_message( $heading, $message );

        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
        );

        $sent = $mailer->send(
            $to,
            $subject,
            $message,
            $headers
        );

        if ( $sent ) {
            $order->update_meta_data( $sent_meta_key, current_time( 'mysql' ) );
            $order->save();

            $note = 'WPHQ custom purchase email sent: ' . get_the_title( $email_id );

            if ( $benefit_key ) {
                $note .= ' (Benefit: ' . $benefit_key . ')';
            }

            $order->add_order_note( $note . '.' );
        }
    }
}

/**
 * Backward-compatible function name in case any outside code still calls the
 * old WPHQ onboarding helper directly. The old product-level ACF flag is no
 * longer consulted.
 */
function wphq_maybe_send_free_website_email( $order_id ) {
    wphq_maybe_send_custom_purchase_emails( $order_id );
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