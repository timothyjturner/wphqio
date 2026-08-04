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
        if( is_page( 'seo-performance-subscriptions' ) ) {?>
                        
     <div class="btn-dropdown-wrapper">
     <a class="primary-btn2 <?php $title ?>" href="#simple-content"><?=$buttons['button']['title']?></a>
     </div>
                        
  <?php
  }elseif ( is_page( 'wordpress-hosting-maintenance' )) { ?>                
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
                                <div class="col-md-4 card" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="800">
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
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif( get_row_layout() == 'pricing_table' ):
            $products = get_sub_field('products');

            /**
             * Normalize an ACF Post Object / Relationship / ID value to a product ID.
             */
            if (!function_exists('wphq_pricing_product_id')) {
                function wphq_pricing_product_id($value): int
                {
                    if ($value instanceof WP_Post) {
                        return (int) $value->ID;
                    }

                    if (is_object($value) && isset($value->ID)) {
                        return (int) $value->ID;
                    }

                    if (is_array($value)) {
                        if (isset($value['ID'])) {
                            return (int) $value['ID'];
                        }
                        if (isset($value['id'])) {
                            return (int) $value['id'];
                        }
                    }

                    return absint($value);
                }
            }

            /**
             * Read the first populated ACF field from a list of possible field names.
             * The aliases make the template tolerant of small naming differences in ACF.
             */
            if (!function_exists('wphq_pricing_acf_value')) {
                function wphq_pricing_acf_value(array $field_names, int $post_id)
                {
                    foreach ($field_names as $field_name) {
                        $value = get_field($field_name, $post_id);
                        if ($value !== null && $value !== false && $value !== '') {
                            return $value;
                        }
                    }

                    return null;
                }
            }

            $has_subscriptions = false;
            if ($products) {
                foreach ($products as $selected_product) {
                    $selected_id = wphq_pricing_product_id($selected_product);
                    $type = (string) wphq_pricing_acf_value(
                        ['plan_type', 'pricing_plan_type', 'product_plan_type'],
                        $selected_id
                    );
                    if ($type === 'subscription' || $type === 'subscriptions') {
                        $has_subscriptions = true;
                        break;
                    }
                }
            }
            ?>

            <section id="pricing-table" class="pricing-table wphq-pricing-table" data-default-billing="annual">
                <div class="container">
                    <?php if ($has_subscriptions): ?>
                        <div class="wphq-billing-toggle-wrap" aria-label="Subscription billing period">
                            <span class="wphq-billing-label" data-billing-label="monthly">Monthly</span>
                            <label class="wphq-billing-switch">
                                <input type="checkbox" class="wphq-billing-toggle" checked aria-label="Use annual billing">
                                <span class="wphq-billing-slider" aria-hidden="true"></span>
                            </label>
                            <span class="wphq-billing-label is-active" data-billing-label="annual">Annual</span>
                            <span class="wphq-billing-savings">Save 10% yearly</span>
                        </div>
                    <?php endif; ?>

                    <div class="row table-main">
                        <?php if ($products): ?>
                            <?php foreach ($products as $product):
                                $display_product_id = wphq_pricing_product_id($product);
                                if (!$display_product_id) {
                                    continue;
                                }

                                $title     = get_the_title($display_product_id);
                                $plan_icon = get_field('plan_icon', $display_product_id);
                                $plan_name = get_field('plan_name', $display_product_id);
                                $points    = get_field('points', $display_product_id);

                                $plan_type = (string) wphq_pricing_acf_value(
                                    ['plan_type', 'pricing_plan_type', 'product_plan_type'],
                                    $display_product_id
                                );
                                $plan_type = in_array($plan_type, ['one_time', 'one-time', 'one_time_product', 'standalone'], true)
                                    ? 'one_time'
                                    : 'subscription';

                                $monthly_product = null;
                                $annual_product  = null;
                                $one_time_product = null;

                                if ($plan_type === 'subscription') {
                                    $monthly_id = wphq_pricing_product_id(wphq_pricing_acf_value(
                                        ['monthly_product', 'monthly_plan', 'monthly_subscription_product'],
                                        $display_product_id
                                    ));
                                    $annual_id = wphq_pricing_product_id(wphq_pricing_acf_value(
                                        ['annual_product', 'yearly_product', 'annual_plan', 'annual_subscription_product'],
                                        $display_product_id
                                    ));

                                    $monthly_product = $monthly_id ? wc_get_product($monthly_id) : null;
                                    $annual_product  = $annual_id ? wc_get_product($annual_id) : null;

                                    // Graceful fallback while products are being configured.
                                    if (!$monthly_product) {
                                        $monthly_product = wc_get_product($display_product_id);
                                    }
                                    if (!$annual_product) {
                                        $annual_product = $monthly_product;
                                    }

                                    if (!$monthly_product || !$annual_product) {
                                        continue;
                                    }

                                    $active_product = $annual_product;
                                } else {
                                    $one_time_id = wphq_pricing_product_id(wphq_pricing_acf_value(
                                        ['one_time_product', 'one-time_product', 'standalone_product', 'single_product'],
                                        $display_product_id
                                    ));
                                    $one_time_product = $one_time_id ? wc_get_product($one_time_id) : wc_get_product($display_product_id);

                                    if (!$one_time_product) {
                                        continue;
                                    }

                                    $active_product = $one_time_product;
                                }

                                $free_website_setting = wphq_pricing_acf_value(
                                    ['include_free_website', 'free_website', 'annual_free_website'],
                                    $display_product_id
                                );
                                // Annual subscriptions include the website by default. If you later add
                                // an eligibility field, explicitly switching it off will hide the benefit.
                                $include_free_website = $free_website_setting === null
                                    ? true
                                    : (bool) $free_website_setting;

                                $monthly_price = $monthly_product ? (float) $monthly_product->get_price() : 0;
                                $annual_price  = $annual_product ? (float) $annual_product->get_price() : 0;
                                $one_time_price = $one_time_product ? (float) $one_time_product->get_price() : 0;

                                $monthly_url = $monthly_product ? $monthly_product->add_to_cart_url() : '';
                                $annual_url  = $annual_product ? $annual_product->add_to_cart_url() : '';
                                $one_time_url = $one_time_product ? $one_time_product->add_to_cart_url() : '';
                                ?>

                                <div class="col-md-4 wphq-pricing-card-col" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="800">
                                    <article
                                        class="wphq-pricing-card <?php echo $plan_type === 'subscription' ? 'wphq-pricing-card--subscription' : 'wphq-pricing-card--one-time'; ?>"
                                        data-plan-type="<?php echo esc_attr($plan_type); ?>"
                                        <?php if ($plan_type === 'subscription'): ?>
                                            data-monthly-id="<?php echo esc_attr($monthly_product->get_id()); ?>"
                                            data-monthly-price="<?php echo esc_attr(wc_format_decimal($monthly_price, wc_get_price_decimals())); ?>"
                                            data-monthly-price-html="<?php echo esc_attr(wp_strip_all_tags(wc_price($monthly_price))); ?>"
                                            data-monthly-url="<?php echo esc_url($monthly_url); ?>"
                                            data-annual-id="<?php echo esc_attr($annual_product->get_id()); ?>"
                                            data-annual-price="<?php echo esc_attr(wc_format_decimal($annual_price, wc_get_price_decimals())); ?>"
                                            data-annual-price-html="<?php echo esc_attr(wp_strip_all_tags(wc_price($annual_price))); ?>"
                                            data-annual-url="<?php echo esc_url($annual_url); ?>"
                                        <?php else: ?>
                                            data-one-time-id="<?php echo esc_attr($one_time_product->get_id()); ?>"
                                            data-one-time-price="<?php echo esc_attr(wc_format_decimal($one_time_price, wc_get_price_decimals())); ?>"
                                            data-one-time-url="<?php echo esc_url($one_time_url); ?>"
                                        <?php endif; ?>
                                    >
                                        <div class="pricing-header">
                                            <div class="icon">
                                                <?php if (!empty($plan_icon['url'])): ?>
                                                    <img src="<?php echo esc_url($plan_icon['url']); ?>" alt="">
                                                <?php endif; ?>

                                                <?php if ($plan_name): ?>
                                                    <h4><?php echo esc_html($plan_name); ?></h4>
                                                <?php endif; ?>
                                            </div>

                                            <h3><?php echo esc_html($title); ?></h3>

                                            <div class="pricing-wrap">
                                                <div class="price wphq-plan-price">
                                                    <?php echo wp_kses_post($active_product->get_price_html()); ?>
                                                </div>

                                                <div class="per-month wphq-plan-period">
                                                    <p><?php echo $plan_type === 'subscription' ? 'per year' : 'one time'; ?></p>
                                                </div>
                                            </div>

                                            <?php if ($plan_type === 'subscription'): ?>
                                                <p class="wphq-annual-equivalent">
                                                    <?php
                                                    $equivalent = $annual_price > 0 ? $annual_price / 12 : 0;
                                                    echo esc_html(sprintf('%s/month, billed annually', wp_strip_all_tags(wc_price($equivalent))));
                                                    ?>
                                                </p>

                                                <div class="wphq-free-website" <?php echo $include_free_website ? '' : 'hidden'; ?>>
                                                    <strong>Free new website included</strong>
                                                    <span>
                                                        Annual billing includes one website built by WPHQ using one of our customizable starter themes.
                                                        <a href="<?php echo esc_url(home_url('/free-website-details/')); ?>">View details</a>
                                                    </span>
                                                </div>
                                            <?php endif; ?>

                                            <a
                                                href="<?php echo esc_url($active_product->add_to_cart_url()); ?>"
                                                data-quantity="1"
                                                class="white-btn product_type_simple add_to_cart_button ajax_add_to_cart ad_quick_add_to_cart_listing wphq-select-plan"
                                                data-product_id="<?php echo esc_attr($active_product->get_id()); ?>"
                                                data-product_sku="<?php echo esc_attr($active_product->get_sku()); ?>"
                                                rel="nofollow"
                                            ><?php echo $plan_type === 'subscription' ? 'Select Plan' : 'Buy Now'; ?></a>
                                        </div>

                                        <div class="content">
                                            <?php if ($points): ?>
                                                <ul>
                                                    <?php foreach ($points as $point): ?>
                                                        <li><?php echo wp_kses_post($point['point']); ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </article>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

            <style>
                .wphq-billing-toggle-wrap {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-wrap: wrap;
                    gap: 12px;
                    margin: 0 auto 34px;
                    font-weight: 700;
                }
                .wphq-billing-label { opacity: .55; transition: opacity .2s ease; }
                .wphq-billing-label.is-active { opacity: 1; }
                .wphq-billing-savings {
                    color: #e96f1f;
                    font-size: .95rem;
                    white-space: nowrap;
                }
                .wphq-billing-switch { position: relative; display: inline-flex; width: 58px; height: 32px; }
                .wphq-billing-switch input { position: absolute; opacity: 0; pointer-events: none; }
                .wphq-billing-slider {
                    position: absolute;
                    inset: 0;
                    border-radius: 999px;
                    background: #cfd6da;
                    cursor: pointer;
                    transition: background .2s ease;
                }
                .wphq-billing-slider::before {
                    content: '';
                    position: absolute;
                    width: 24px;
                    height: 24px;
                    left: 4px;
                    top: 4px;
                    border-radius: 50%;
                    background: #fff;
                    box-shadow: 0 2px 8px rgba(0,0,0,.2);
                    transition: transform .2s ease;
                }
                .wphq-billing-switch input:checked + .wphq-billing-slider { background: #e96f1f; }
                .wphq-billing-switch input:checked + .wphq-billing-slider::before { transform: translateX(26px); }
                .wphq-billing-switch input:focus-visible + .wphq-billing-slider { outline: 3px solid rgba(233,111,31,.3); outline-offset: 3px; }
                .wphq-pricing-card { height: 100%; display: flex; flex-direction: column; }
                .wphq-pricing-card .content { flex: 1; }
                .wphq-annual-equivalent { margin: 6px 0 14px; font-size: .82rem; opacity: .8; }
                .wphq-free-website {
                    margin: 0 auto 18px;
                    padding: 13px 14px;
                    max-width: 290px;
                    border: 1px solid rgba(233,111,31,.35);
                    border-radius: 10px;
                    background: rgba(255,255,255,.1);
                    text-align: left;
                    line-height: 1.4;
                }
                .wphq-free-website strong,
                .wphq-free-website span { display: block; }
                .wphq-free-website span { margin-top: 4px; font-size: .78rem; }
                .wphq-free-website a { color: inherit; text-decoration: underline; }
                [hidden] { display: none !important; }
                @media (max-width: 575px) {
                    .wphq-billing-toggle-wrap { gap: 9px; }
                    .wphq-billing-savings { flex-basis: 100%; text-align: center; }
                }
            </style>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const pricingTable = document.querySelector('.wphq-pricing-table');
                    if (!pricingTable) return;

                    const toggle = pricingTable.querySelector('.wphq-billing-toggle');
                    if (!toggle) return;

                    const currency = <?php echo wp_json_encode(get_woocommerce_currency_symbol()); ?>;
                    const decimals = <?php echo (int) wc_get_price_decimals(); ?>;

                    function formatPrice(rawPrice) {
                        const value = Number.parseFloat(rawPrice || '0');
                        return currency + value.toLocaleString(undefined, {
                            minimumFractionDigits: Number.isInteger(value) ? 0 : decimals,
                            maximumFractionDigits: decimals
                        });
                    }

                    function setBillingPeriod(period) {
                        const annual = period === 'annual';

                        pricingTable.querySelectorAll('[data-billing-label]').forEach(function (label) {
                            label.classList.toggle('is-active', label.dataset.billingLabel === period);
                        });

                        pricingTable.querySelectorAll('.wphq-pricing-card--subscription').forEach(function (card) {
                            const productId = annual ? card.dataset.annualId : card.dataset.monthlyId;
                            const productUrl = annual ? card.dataset.annualUrl : card.dataset.monthlyUrl;
                            const price = annual ? card.dataset.annualPrice : card.dataset.monthlyPrice;
                            const button = card.querySelector('.wphq-select-plan');
                            const priceElement = card.querySelector('.wphq-plan-price');
                            const periodElement = card.querySelector('.wphq-plan-period p');
                            const annualEquivalent = card.querySelector('.wphq-annual-equivalent');
                            const websiteBenefit = card.querySelector('.wphq-free-website');

                            if (priceElement) priceElement.textContent = formatPrice(price);
                            if (periodElement) periodElement.textContent = annual ? 'per year' : 'per month';
                            if (annualEquivalent) annualEquivalent.hidden = !annual;
                            if (websiteBenefit) websiteBenefit.hidden = !annual;

                            if (button) {
                                button.href = productUrl;
                                button.dataset.product_id = productId;
                                button.setAttribute('data-product_id', productId);
                            }
                        });
                    }

                    toggle.addEventListener('change', function () {
                        setBillingPeriod(toggle.checked ? 'annual' : 'monthly');
                    });

                    // Annual billing is intentionally the default.
                    toggle.checked = true;
                    setBillingPeriod('annual');
                });
            </script>
        <?php endif;
    endwhile;
endif; ?>

<?php get_footer(); ?>