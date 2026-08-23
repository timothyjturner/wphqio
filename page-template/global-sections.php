<?php 
//Template Name: Global Sections
get_header(); ?>

<?php 
    $hide_banner = get_field('hide_banner'); 
    $banner = get_field('banner');
?>

<?php if(!$hide_banner): ?>
    <section class="banner" style="background-color: <?=$banner['background_color']?>;">
        <div class="container">
            <div class="row align-center">
                <div class="<?php if($banner['image']){ echo 'col-md-6'; }else { echo 'col-md-12 text-center'; } ?> content" data-aos="fade-up"                     data-aos-delay="200" data-aos-duration="800">
                    <?php if($banner['title']): ?>
                        <h1><?=$banner['title']?></h1>
                    <?php endif; ?>

                    <?=$banner['content']?>

                    <div class="row <?php if(!$banner['image']){ echo 'justify-center'; }?>">
                        <?php if($banner['buttons']): ?>
                            <?php foreach($banner['buttons'] as $key => $buttons): ?>
                                <?php if ($buttons['button']['title'] == 'Get Started'){
                                    $global_button_links = get_field('global_button_links', 'option');
                                    ?>
                        
                        
                        
                        
                        
                        

                        
        <?php
        if( is_page( 'seo-performance-subscriptions' ) || is_page( 'wordpress-hosting-maintenance' ) || is_page( 'shopify' ) || is_page( 'wordpress-website-recovery' ) || is_page( 'wordpress-speed-optimization' ) || is_page( 'wordpress-site-migration' ) || is_page( 'wordpress-technical-seo' ) || is_page( 'wordpress-troubleshooting' ) || is_page( 'wordpress-updates-compatibility' ) ) {?>
                        
     <div class="btn-dropdown-wrapper">
     <a class="primary-btn2 <?php $title ?>" href="#simple-content"><?=$buttons['button']['title']?></a>
     </div>      
                        
  <?php
   }else {
          ?>
                        <div class="btn-dropdown-wrapper">
 <a class="primary-btn <?php $title ?>" href="#"><?=$buttons['button']['title']?></a>

                                            <div class="dropdown">
                                                <ul class="links">
                                                    <?php foreach($global_button_links as $global_links): ?>
                                                        <li><a href="<?=$global_links['link']['url']?>"><?=$global_links['link']['title']?></a></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                    <?php
     } ?>               
                        
                        
                        
                        
                        
                                        
                        
                        
                                    <?php
                                }else {
                                    ?>
                                        <a class="white-btn aaa" href="<?=$buttons['button']['url']?>"><?=$buttons['button']['title']?></a>
                                    <?php
                                } ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                
                <?php if($banner['image']): ?>
                    <div class="col-md-6 img" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                        <img class="w-100" src="<?=$banner['image']['url']?>">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php

if( have_rows('sections') ):
    while ( have_rows('sections') ) : the_row();
        if( get_row_layout() == 'solutions' ):
            $title = get_sub_field('title');
            $tiles = get_sub_field('tiles'); ?>

            <section id="solutions" class="solutions-sect">
                <div class="container">
                    <?php if($title): ?>
                        <h2 class="text-center"><?=$title?></h2>
                    <?php endif; ?>
                    
                    <?php if($tiles): ?>
                        <div class="row">
                            <?php foreach($tiles as $tile): ?>
                                <div class="col-md-3 card" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="800">
                                    <div class="inner">
                                        <img src="<?=$tile['icon']['url']?>">

                                        <h3><?=$tile['title']?></h3>

                                        <?=$tile['content']?>
                                        
                                        <?php if($tile['cta']): ?>
                                            <a class="link underline" href="<?=$tile['cta']['url']?>"><?=$tile['cta']['title']?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </section>

        <?php elseif( get_row_layout() == 'global_cta' ): 
            $global_cta = get_field('global_cta', 'option'); ?>

            <section id="global-cta" class="cta" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-delay="200" data-aos-duration="800">
                <div class="container">
                    <div class="row align-center" style="background-color: <?=$global_cta['background_color']?>">
                        <div class="col-md-8">
                            <h2><?=$global_cta['title']?></h2>

                            <?=$global_cta['description']?>

                            <div class="row">
                                <?php if($global_cta['buttons']): ?>
                                    <?php foreach($global_cta['buttons'] as $key => $button): ?>
                                        <?php if ($button['button']['title'] == 'Get Started'){
                                            $global_button_links = get_field('global_button_links', 'option');
                                            ?>
                                                <div class="btn-dropdown-wrapper">
                                                    <a class="primary-btn" href="#"><?=$buttons['button']['title']?></a>
        
                                                    <div class="dropdown">
                                                        <ul class="links">
                                                            <?php foreach($global_button_links as $global_links): ?>
                                                                <li><a href="<?=$global_links['link']['url']?>"><?=$global_links['link']['title']?></a></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            <?php
                                        }else {
                                            ?>
                                                <a class="white-btn" href="<?=$button['button']['url']?>"><?=$button['button']['title']?></a>
                                            <?php
                                        } ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <h4 style="padding-top: 15px;padding-left: 5px;color:white;">Have a quick question? Call <a href="tel:614-916-6243" style="text-decoration: underline;color: white;">614-916-6243</a>. We are happy to help!</h4>

                        </div>

                        <div class="col-md-4">
                            <img class="w-100" src="<?=$global_cta['image']['url']?>">
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif( get_row_layout() == 'standard_content' ): 
            $text_alignment = get_sub_field('text_alignment');
            $title = get_sub_field('title');
            $content = get_sub_field('content'); ?>

            <section id="simple-content" class="simple-content aa">
                <div class="container">
                    <div class="<?php if($text_alignment == 'center'){ echo 'text-center'; } ?>">
                        <?php if($title): ?>
                            <h2><?=$title?></h2>
                        <?php endif; ?>

                        <?=$content?>
                    </div>
                </div>
            </section>

        <?php elseif( get_row_layout() == 'form' ):
            $title = get_sub_field('title');
            $content = get_sub_field('content'); ?>

            <section id="form" class="form-sect">
                <div class="container">
                    <div class="row align-center">
                        <div class="col-md-6 content" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-delay="200" data-aos-duration="800">
                            <?php if($title): ?>
                                <h2><?=$title?></h2>
                            <?php endif; ?>

                            <?=$content?>
                        </div>

                        <div class="col-md-6">
                            <div class="form" style="background-color: <?=$form['background_color']?>">
                                <?php if($form['form_title']): ?>
                                    <h3><?=$form['form_title']?></h3>
                                <?php endif; ?>

                                <div class="form-wrapper">
                                    <div class="calendly-inline-widget" data-url="https://calendly.com/timothyjturner/15min" style="min-width:320px;height:630px;"></div>

                                    <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js"></script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="cta">
                <div class="container">
                    <div class="row align-center">
                        <div class="col-md-8">
                            <h2>Ready to Transform Your Website?</h2>

                            <p>We are ready to help!</p>

                            <div class="row">
                                <a class="white-btn" href="#">Free Consultation</a>
                                <div class="btn-dropdown-wrapper">
                                    <a class="primary-btn" href="#">Get Started</a>

                                    <div class="dropdown">
                                        <ul class="links">
                                            <li><a href="#">Hosting</a></li>
                                            <li><a href="#">Maintenance</a></li>
                                            <li><a href="#">SEO</a></li>
                                            <li><a href="#">Custom Quote</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <h4 style="padding-top: 15px;padding-left: 5px;color:white;">Have a quick question? Call <a href="tel:614-916-6243" style="text-decoration: underline;color: white;">614-916-6243</a>. We are happy to help!</h4>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif( get_row_layout() == 'pricing_table' ):
            /*
             * ACF structure:
             * Sections (Flexible Content) > Pricing Table > Plans (Repeater)
             * Each plan row contains:
             * - plan_type
             * - monthly_product
             * - annual_product
             * - one_time_product
             */
            $plans = get_sub_field('plans');

            if (!empty($plans) && is_array($plans)):
                $has_subscription_plans = false;

                foreach ($plans as $plan_check) {
                    $check_type = isset($plan_check['plan_type'])
                        ? sanitize_key((string) $plan_check['plan_type'])
                        : '';

                    if (in_array($check_type, array('subscription', 'subscriptions', 'monthly_annual'), true)) {
                        $has_subscription_plans = true;
                        break;
                    }
                }
            ?>

            <section id="pricing-table" class="pricing-table" data-default-billing="annual">
                <div class="container">
                    <?php if ($has_subscription_plans): ?>
                        <div class="pricing-billing-selector" aria-label="Subscription billing period">
                            <span class="pricing-billing-label pricing-billing-label--monthly">Monthly</span>

                            <label class="pricing-billing-toggle">
                                <input
                                    type="checkbox"
                                    class="pricing-billing-toggle__input"
                                    checked
                                    aria-label="Toggle annual billing"
                                >
                                <span class="pricing-billing-toggle__track" aria-hidden="true">
                                    <span class="pricing-billing-toggle__thumb"></span>
                                </span>
                            </label>

                            <span class="pricing-billing-label pricing-billing-label--annual is-active">Annual</span>
                            <span class="pricing-billing-savings">Save 10% & gain other benefits with annual billing</span>
                        </div>
                    <?php endif; ?>

                    <div class="row table-main">
                        <?php foreach ($plans as $plan):
                            $plan_type = isset($plan['plan_type'])
                                ? sanitize_key((string) $plan['plan_type'])
                                : 'subscription';

                            $get_product_id = static function ($value) {
                                if ($value instanceof WP_Post) {
                                    return (int) $value->ID;
                                }

                                if (is_object($value) && isset($value->ID)) {
                                    return (int) $value->ID;
                                }

                                if (is_array($value) && isset($value['ID'])) {
                                    return (int) $value['ID'];
                                }

                                return absint($value);
                            };

                            /*
                             * Page-level annual acquisition benefit.
                             * These values belong to this pricing-row context, NOT the WC product.
                             */
                            $annual_benefit_message = isset($plan['annual_benefit_message'])
                                ? (string) $plan['annual_benefit_message']
                                : '';
                            $custom_purchase_email_id = $get_product_id($plan['custom_purchase_email'] ?? 0);
                            $benefit_key = !empty($plan['benefit_key'])
                                ? sanitize_key((string) $plan['benefit_key'])
                                : '';

                            if (!$benefit_key && $custom_purchase_email_id) {
                                $email_post = get_post($custom_purchase_email_id);
                                if ($email_post && $email_post->post_type === 'wphq_product_email') {
                                    $benefit_key = sanitize_key($email_post->post_name);
                                }
                            }

                            $is_one_time = in_array(
                                $plan_type,
                                array('one_time', 'one-time', 'onetime', 'one_time_product', 'standalone'),
                                true
                            );

                            $monthly_id  = $get_product_id($plan['monthly_product'] ?? 0);
                            $annual_id   = $get_product_id($plan['annual_product'] ?? 0);
                            $one_time_id = $get_product_id($plan['one_time_product'] ?? 0);

                            $monthly_product  = $monthly_id ? wc_get_product($monthly_id) : false;
                            $annual_product   = $annual_id ? wc_get_product($annual_id) : false;
                            $one_time_product = $one_time_id ? wc_get_product($one_time_id) : false;

                            if ($is_one_time) {
                                if (!$one_time_product) {
                                    continue;
                                }

                                $display_product = $one_time_product;
                            } else {
                                /* A subscription row needs at least one valid linked product. */
                                if (!$monthly_product && !$annual_product) {
                                    continue;
                                }

                                $monthly_product = $monthly_product ?: $annual_product;
                                $annual_product  = $annual_product ?: $monthly_product;
                                $display_product = $annual_product;
                            }

                            $display_product_id = $display_product->get_id();
                            $title              = $display_product->get_name();
                            $plan_icon          = get_field('plan_icon', $display_product_id);
                            $plan_name          = get_field('plan_name', $display_product_id);

                            /*
                             * IMPORTANT:
                             * Monthly and annual subscription products may have different feature lists.
                             * For example, annual-only member discounts should NOT appear for monthly buyers.
                             */
                            if ($is_one_time) {
                                $points         = get_field('points', $display_product_id);
                                $monthly_points = array();
                                $annual_points  = array();
                            } else {
                                $monthly_display_id = $monthly_product->get_id();
                                $annual_display_id  = $annual_product->get_id();

                                $monthly_points = get_field('points', $monthly_display_id);
                                $annual_points  = get_field('points', $annual_display_id);
                                $points         = array();

                                /* Presentation fields can still fall back to the monthly/base product. */
                                if (empty($plan_icon)) {
                                    $plan_icon = get_field('plan_icon', $monthly_display_id);
                                }

                                if (empty($plan_name)) {
                                    $plan_name = get_field('plan_name', $monthly_display_id);
                                }

                                /* Prefer the monthly/base title when annual product names contain “Annual”. */
                                $title = $monthly_product->get_name();
                            }

                            $icon_url = '';
                            if (is_array($plan_icon) && !empty($plan_icon['url'])) {
                                $icon_url = $plan_icon['url'];
                            } elseif (is_numeric($plan_icon)) {
                                $icon_url = wp_get_attachment_image_url((int) $plan_icon, 'full');
                            }

                            if ($is_one_time) {
                                $initial_product_id = $one_time_product->get_id();
                                $initial_price_html = $one_time_product->get_price_html();
                                $initial_period     = 'one time';
                                $initial_url        = $one_time_product->add_to_cart_url();

                                $monthly_price_html = '';
                                $annual_price_html  = '';
                                $monthly_url        = '';
                                $annual_url         = '';
                            } else {
                                $initial_product_id = $annual_product->get_id();
                                $initial_price_html = $annual_product->get_price_html();
                                $initial_period     = 'per year';
                                $initial_url        = $annual_product->add_to_cart_url();

                                $monthly_price_html = $monthly_product->get_price_html();
                                $annual_price_html  = $annual_product->get_price_html();
                                $monthly_url        = $monthly_product->add_to_cart_url();
                                $annual_url         = $annual_product->add_to_cart_url();

                                /*
                                 * Only the annual purchase receives the landing-page benefit.
                                 * The signed context travels with this specific add-to-cart request.
                                 */
                                if (
                                    $custom_purchase_email_id &&
                                    $benefit_key &&
                                    function_exists('wphq_is_valid_custom_purchase_email') &&
                                    wphq_is_valid_custom_purchase_email($custom_purchase_email_id) &&
                                    function_exists('wphq_build_benefit_signature')
                                ) {
                                    $benefit_signature = wphq_build_benefit_signature(
                                        $annual_product->get_id(),
                                        $custom_purchase_email_id,
                                        $benefit_key
                                    );

                                    $annual_url = add_query_arg(
                                        array(
                                            'wphq_purchase_email' => $custom_purchase_email_id,
                                            'wphq_benefit_key'    => $benefit_key,
                                            'wphq_benefit_sig'    => $benefit_signature,
                                        ),
                                        $annual_url
                                    );
                                }
                            }
                        ?>

                            <div
                                class="col-md-4 pricing-plan-card <?php echo $is_one_time ? 'pricing-plan-card--one-time' : 'pricing-plan-card--subscription'; ?>"
                                data-aos="flip-left"
                                data-aos-easing="ease-out-cubic"
                                data-aos-duration="800"
                                <?php if (!$is_one_time): ?>
                                    data-monthly-id="<?php echo esc_attr($monthly_product->get_id()); ?>"
                                    data-annual-id="<?php echo esc_attr($annual_product->get_id()); ?>"
                                    data-monthly-price="<?php echo esc_attr(wp_json_encode($monthly_price_html)); ?>"
                                    data-annual-price="<?php echo esc_attr(wp_json_encode($annual_price_html)); ?>"
                                    data-monthly-url="<?php echo esc_url($monthly_url); ?>"
                                    data-annual-url="<?php echo esc_url($annual_url); ?>"
                                <?php endif; ?>
                            >
                                <div class="pricing-header">
                                    <div class="icon">
                                        <?php if ($icon_url): ?>
                                            <img src="<?php echo esc_url($icon_url); ?>" alt="">
                                        <?php endif; ?>

                                        <?php if ($plan_name): ?>
                                            <h4><?php echo esc_html($plan_name); ?></h4>
                                        <?php endif; ?>
                                    </div>

                                    <h3><?php echo esc_html($title); ?></h3>

                                    <div class="pricing-wrap">
                                        <div class="price"><?php echo wp_kses_post($initial_price_html); ?></div>

                                        <div class="per-month">
                                            <p><?php echo esc_html($initial_period); ?></p>
                                        </div>
                                    </div>

                                    <?php if (!$is_one_time && trim($annual_benefit_message) !== ''): ?>
                                        <div class="pricing-annual-benefit">
                                            <?php echo wp_kses_post( do_shortcode( $annual_benefit_message ) ); ?>
                                        </div>
                                    <?php endif; ?>

                                    <a
                                        href="<?php echo esc_url($initial_url); ?>"
                                        data-quantity="1"
                                        class="white-btn wphq-select-plan-button"
                                        data-product_id="<?php echo esc_attr($initial_product_id); ?>"
                                        rel="nofollow"
                                    >Select Plan</a>
                                </div>

                                <div class="content">
                                    <?php if ($is_one_time): ?>

                                        <?php if (!empty($points) && is_array($points)): ?>
                                            <ul class="pricing-points pricing-points--one-time">
                                                <?php foreach ($points as $point): ?>
                                                    <?php if (!empty($point['point'])): ?>
                                                        <li><?php echo wp_kses_post( do_shortcode( $point['point'] ) ); ?></li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>

                                    <?php else: ?>

                                        <ul class="pricing-points pricing-points--monthly" hidden>
                                            <?php if (!empty($monthly_points) && is_array($monthly_points)): ?>
                                                <?php foreach ($monthly_points as $point): ?>
                                                    <?php if (!empty($point['point'])): ?>
                                                        <li><?php echo wp_kses_post( do_shortcode( $point['point'] ) ); ?></li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>

                                        <ul class="pricing-points pricing-points--annual">
                                            <?php if (!empty($annual_points) && is_array($annual_points)): ?>
                                                <?php foreach ($annual_points as $point): ?>
                                                    <?php if (!empty($point['point'])): ?>
                                                        <li><?php echo wp_kses_post( do_shortcode( $point['point'] ) ); ?></li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>

                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <style>
                .pricing-billing-selector {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-wrap: wrap;
                    gap: 12px;
                    margin: 0 auto 32px;
                    font-weight: 700;
                }

                .pricing-billing-label {
                    opacity: .55;
                    transition: opacity .2s ease;
                }

                .pricing-billing-label.is-active {
                    opacity: 1;
                }

                .pricing-billing-savings {
                    color: #e86f1c;
                    font-size: 14px;
                }

                .pricing-billing-toggle {
                    display: inline-flex;
                    cursor: pointer;
                }

                .pricing-billing-toggle__input {
                    position: absolute;
                    opacity: 0;
                    pointer-events: none;
                }

                .pricing-billing-toggle__track {
                    position: relative;
                    display: block;
                    width: 54px;
                    height: 30px;
                    border-radius: 999px;
                    background: #8b949b;
                    transition: background .2s ease;
                }

                .pricing-billing-toggle__thumb {
                    position: absolute;
                    top: 4px;
                    left: 4px;
                    width: 22px;
                    height: 22px;
                    border-radius: 50%;
                    background: #fff;
                    box-shadow: 0 1px 4px rgba(0, 0, 0, .25);
                    transition: transform .2s ease;
                }

                .pricing-billing-toggle__input:checked + .pricing-billing-toggle__track {
                    background: #e86f1c;
                }

                .pricing-billing-toggle__input:checked + .pricing-billing-toggle__track .pricing-billing-toggle__thumb {
                    transform: translateX(24px);
                }

                .pricing-annual-benefit {
                    margin: 14px 0 36px;
                    padding: 12px;
                    border: 1px solid rgba(232, 111, 28, .45);
                    border-radius: 8px;
                    background: rgba(255, 255, 255, .08);
                    font-size: 13px;
                    line-height: 1.45;
                }

                .pricing-annual-benefit strong,
                .pricing-annual-benefit span {
                    display: block;
                }

                .pricing-annual-benefit a {
                    color: inherit;
                    text-decoration: underline;
                }
                .subscription-details {
                    display: none;
                }

                .pricing-points[hidden] {
                    display: none !important;
                }
                section.pricing-table .col-md-4 .pricing-header .pricing-wrap {
                    margin-bottom: 32px;
                }
            </style>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var pricingTable = document.getElementById('pricing-table');
                    if (!pricingTable) return;

                    var toggle = pricingTable.querySelector('.pricing-billing-toggle__input');
                    if (!toggle) return;

                    var monthlyLabel = pricingTable.querySelector('.pricing-billing-label--monthly');
                    var annualLabel = pricingTable.querySelector('.pricing-billing-label--annual');
                    var cards = pricingTable.querySelectorAll('.pricing-plan-card--subscription');

                    function decodeHtmlValue(value) {
                        if (!value) return '';

                        try {
                            return JSON.parse(value);
                        } catch (error) {
                            return value;
                        }
                    }

                    function updatePlans() {
                        var useAnnual = toggle.checked;

                        if (monthlyLabel) monthlyLabel.classList.toggle('is-active', !useAnnual);
                        if (annualLabel) annualLabel.classList.toggle('is-active', useAnnual);

                        cards.forEach(function (card) {
                            var price = card.querySelector('.price');
                            var period = card.querySelector('.per-month p');
                            var button = card.querySelector('.wphq-select-plan-button');
                            var benefit = card.querySelector('.pricing-annual-benefit');
                            var monthlyPoints = card.querySelector('.pricing-points--monthly');
                            var annualPoints = card.querySelector('.pricing-points--annual');

                            var productId = useAnnual ? card.dataset.annualId : card.dataset.monthlyId;
                            var productUrl = useAnnual ? card.dataset.annualUrl : card.dataset.monthlyUrl;
                            var priceHtml = decodeHtmlValue(
                                useAnnual ? card.dataset.annualPrice : card.dataset.monthlyPrice
                            );

                            if (price) price.innerHTML = priceHtml;
                            if (period) period.textContent = useAnnual ? 'per year' : 'per month';

                            if (button) {
                                button.dataset.productId = productId;
                                button.setAttribute('data-product-id', productId);
                                button.href = productUrl;
                            }

                            if (benefit) benefit.hidden = !useAnnual;
                            if (monthlyPoints) monthlyPoints.hidden = useAnnual;
                            if (annualPoints) annualPoints.hidden = !useAnnual;
                        });
                    }

                    toggle.addEventListener('change', updatePlans);

                    pricingTable.addEventListener('click', function (event) {
                        var button = event.target.closest('.wphq-select-plan-button');
                        if (!button) return;

                        // This is intentionally a normal WooCommerce add-to-cart request.
                        // Avoid the theme/side-cart AJAX handlers, which error after the
                        // product ID is changed dynamically by the billing toggle.
                        event.stopPropagation();
                    }, true);

                    updatePlans();
                });
            </script>

            <?php endif; ?>
        <?php endif;
    endwhile;
endif; ?>

<?php get_footer(); ?>