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

            // ACF Post Object fields may return a WP_Post object or a numeric ID.
            $wphq_get_product_id = static function ($value) {
                if ($value instanceof WP_Post) {
                    return (int) $value->ID;
                }

                if (is_object($value) && isset($value->ID)) {
                    return (int) $value->ID;
                }

                return absint($value);
            };

            // Support the final field names plus a few harmless aliases.
            $wphq_get_first_field = static function (array $field_names, $post_id) {
                foreach ($field_names as $field_name) {
                    $value = get_field($field_name, $post_id);
                    if ($value !== null && $value !== false && $value !== '') {
                        return $value;
                    }
                }

                return null;
            };
        ?>

            <section id="pricing-table" class="pricing-table wphq-pricing-table">
                <div class="container">
                    <?php if (!empty($products) && is_array($products)) : ?>
                        <div class="wphq-billing-toggle" aria-label="Choose subscription billing period">
                            <span class="wphq-billing-label wphq-billing-label--monthly">Monthly</span>
                            <button
                                type="button"
                                class="wphq-billing-switch is-annual"
                                role="switch"
                                aria-checked="true"
                                aria-label="Toggle annual billing"
                            >
                                <span class="wphq-billing-switch__handle"></span>
                            </button>
                            <span class="wphq-billing-label wphq-billing-label--annual is-active">Annual</span>
                            <span class="wphq-billing-savings">Save 10% yearly</span>
                        </div>

                        <div class="row table-main">
                            <?php foreach ($products as $display_product_post) :
                                $display_product_id = $wphq_get_product_id($display_product_post);

                                if (!$display_product_id) {
                                    continue;
                                }

                                $title     = get_the_title($display_product_id);
                                $plan_icon = get_field('plan_icon', $display_product_id);
                                $plan_name = get_field('plan_name', $display_product_id);
                                $points    = get_field('points', $display_product_id);

                                $raw_plan_type = (string) $wphq_get_first_field(
                                    array('plan_type', 'pricing_plan_type'),
                                    $display_product_id
                                );
                                $normalized_plan_type = strtolower(trim(str_replace(array('-', ' '), '_', $raw_plan_type)));
                                $is_one_time = in_array(
                                    $normalized_plan_type,
                                    array('one_time', 'one_time_product', 'onetime', 'standalone', 'single'),
                                    true
                                );

                                $monthly_field = $wphq_get_first_field(
                                    array('monthly_product', 'monthly_plan', 'monthly_subscription_product'),
                                    $display_product_id
                                );
                                $annual_field = $wphq_get_first_field(
                                    array('annual_product', 'yearly_product', 'annual_plan', 'annual_subscription_product'),
                                    $display_product_id
                                );
                                $one_time_field = $wphq_get_first_field(
                                    array('one_time_product', 'one_time_plan', 'standalone_product', 'single_product'),
                                    $display_product_id
                                );

                                $monthly_id  = $wphq_get_product_id($monthly_field);
                                $annual_id   = $wphq_get_product_id($annual_field);
                                $one_time_id = $wphq_get_product_id($one_time_field);

                                // Graceful fallbacks preserve the existing live cards while products are configured.
                                if ($is_one_time) {
                                    $one_time_id = $one_time_id ?: $display_product_id;
                                } else {
                                    $monthly_id = $monthly_id ?: $display_product_id;
                                    $annual_id  = $annual_id ?: $monthly_id;
                                }

                                $monthly_product  = $monthly_id ? wc_get_product($monthly_id) : false;
                                $annual_product   = $annual_id ? wc_get_product($annual_id) : false;
                                $one_time_product = $one_time_id ? wc_get_product($one_time_id) : false;

                                if ($is_one_time && !$one_time_product) {
                                    continue;
                                }

                                if (!$is_one_time && !$monthly_product && !$annual_product) {
                                    continue;
                                }

                                $default_product = $is_one_time
                                    ? $one_time_product
                                    : ($annual_product ?: $monthly_product);

                                $default_product_id = $default_product ? $default_product->get_id() : 0;
                                $default_price_html = $default_product ? $default_product->get_price_html() : '';
                                $default_add_url = $default_product
                                    ? add_query_arg('add-to-cart', $default_product_id, wc_get_cart_url())
                                    : '#';

                                $monthly_price_html = $monthly_product ? $monthly_product->get_price_html() : '';
                                $annual_price_html  = $annual_product ? $annual_product->get_price_html() : '';
                                $one_time_price_html = $one_time_product ? $one_time_product->get_price_html() : '';

                                $monthly_add_url = $monthly_product
                                    ? add_query_arg('add-to-cart', $monthly_product->get_id(), wc_get_cart_url())
                                    : '#';
                                $annual_add_url = $annual_product
                                    ? add_query_arg('add-to-cart', $annual_product->get_id(), wc_get_cart_url())
                                    : '#';
                                $one_time_add_url = $one_time_product
                                    ? add_query_arg('add-to-cart', $one_time_product->get_id(), wc_get_cart_url())
                                    : '#';
                            ?>
                                <div
                                    class="col-md-4 wphq-pricing-plan <?php echo $is_one_time ? 'wphq-pricing-plan--one-time' : 'wphq-pricing-plan--subscription'; ?>"
                                    data-aos="flip-left"
                                    data-aos-easing="ease-out-cubic"
                                    data-aos-duration="800"
                                    <?php if (!$is_one_time) : ?>
                                        data-monthly-id="<?php echo esc_attr($monthly_product ? $monthly_product->get_id() : ''); ?>"
                                        data-monthly-price="<?php echo esc_attr(wp_strip_all_tags($monthly_price_html)); ?>"
                                        data-monthly-price-html="<?php echo esc_attr($monthly_price_html); ?>"
                                        data-monthly-url="<?php echo esc_url($monthly_add_url); ?>"
                                        data-annual-id="<?php echo esc_attr($annual_product ? $annual_product->get_id() : ''); ?>"
                                        data-annual-price="<?php echo esc_attr(wp_strip_all_tags($annual_price_html)); ?>"
                                        data-annual-price-html="<?php echo esc_attr($annual_price_html); ?>"
                                        data-annual-url="<?php echo esc_url($annual_add_url); ?>"
                                    <?php else : ?>
                                        data-one-time-id="<?php echo esc_attr($one_time_product->get_id()); ?>"
                                        data-one-time-price-html="<?php echo esc_attr($one_time_price_html); ?>"
                                        data-one-time-url="<?php echo esc_url($one_time_add_url); ?>"
                                    <?php endif; ?>
                                >
                                    <div class="pricing-header">
                                        <div class="icon">
                                            <?php if (!empty($plan_icon['url'])) : ?>
                                                <img src="<?php echo esc_url($plan_icon['url']); ?>" alt="">
                                            <?php endif; ?>

                                            <?php if ($plan_name) : ?>
                                                <h4><?php echo esc_html($plan_name); ?></h4>
                                            <?php endif; ?>
                                        </div>

                                        <h3><?php echo esc_html($title); ?></h3>

                                        <div class="pricing-wrap">
                                            <div class="price wphq-plan-price">
                                                <?php echo wp_kses_post($default_price_html); ?>
                                            </div>

                                            <div class="per-month wphq-plan-period">
                                                <p><?php echo $is_one_time ? 'one time' : 'per year'; ?></p>
                                            </div>
                                        </div>

                                        <?php if (!$is_one_time) : ?>
                                            <div class="wphq-annual-website-benefit">
                                                <strong>Free New Website Included</strong>
                                                <span>
                                                    Annual billing includes one website built by WPHQ using one of our customizable starter themes.
                                                    <a href="<?php echo esc_url(home_url('/free-website-details/')); ?>">Details</a>
                                                </span>
                                            </div>
                                        <?php endif; ?>

                                        <a
                                            href="<?php echo esc_url($default_add_url); ?>"
                                            data-quantity="1"
                                            class="white-btn add_to_cart_button ajax_add_to_cart ad_quick_add_to_cart_listing"
                                            data-product_id="<?php echo esc_attr($default_product_id); ?>"
                                            rel="nofollow"
                                        >Select Plan</a>
                                    </div>

                                    <div class="content">
                                        <?php if (!empty($points) && is_array($points)) : ?>
                                            <ul>
                                                <?php foreach ($points as $point) : ?>
                                                    <?php if (!empty($point['point'])) : ?>
                                                        <li><?php echo wp_kses_post($point['point']); ?></li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </section>

            <style>
                .wphq-billing-toggle {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-wrap: wrap;
                    gap: 10px;
                    margin: 0 0 34px;
                    font-weight: 700;
                }

                .wphq-billing-switch {
                    position: relative;
                    width: 54px;
                    height: 30px;
                    padding: 0;
                    border: 0;
                    border-radius: 999px;
                    background: #c8c8c8;
                    cursor: pointer;
                    transition: background-color .2s ease;
                }

                .wphq-billing-switch.is-annual {
                    background: #e96f20;
                }

                .wphq-billing-switch__handle {
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

                .wphq-billing-switch.is-annual .wphq-billing-switch__handle {
                    transform: translateX(24px);
                }

                .wphq-billing-label {
                    opacity: .55;
                    transition: opacity .2s ease;
                }

                .wphq-billing-label.is-active {
                    opacity: 1;
                }

                .wphq-billing-savings {
                    color: #e96f20;
                    margin-left: 4px;
                }

                .wphq-annual-website-benefit {
                    margin: 16px 0 18px;
                    padding: 12px 14px;
                    border: 1px solid rgba(255, 255, 255, .55);
                    border-radius: 8px;
                    text-align: left;
                    line-height: 1.35;
                }

                .wphq-annual-website-benefit strong,
                .wphq-annual-website-benefit span {
                    display: block;
                }

                .wphq-annual-website-benefit span {
                    margin-top: 5px;
                    font-size: 13px;
                }

                .wphq-annual-website-benefit a {
                    color: inherit;
                    text-decoration: underline;
                }

                .wphq-pricing-plan.is-monthly .wphq-annual-website-benefit {
                    display: none;
                }

                @media (max-width: 767px) {
                    .wphq-billing-savings {
                        flex-basis: 100%;
                        text-align: center;
                    }
                }
            </style>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var toggle = document.querySelector('.wphq-billing-switch');

                    if (!toggle) {
                        return;
                    }

                    var monthlyLabel = document.querySelector('.wphq-billing-label--monthly');
                    var annualLabel = document.querySelector('.wphq-billing-label--annual');
                    var subscriptionPlans = document.querySelectorAll('.wphq-pricing-plan--subscription');

                    function applyBillingPeriod(useAnnual) {
                        toggle.classList.toggle('is-annual', useAnnual);
                        toggle.setAttribute('aria-checked', useAnnual ? 'true' : 'false');

                        if (monthlyLabel) {
                            monthlyLabel.classList.toggle('is-active', !useAnnual);
                        }

                        if (annualLabel) {
                            annualLabel.classList.toggle('is-active', useAnnual);
                        }

                        subscriptionPlans.forEach(function (plan) {
                            var price = plan.querySelector('.wphq-plan-price');
                            var period = plan.querySelector('.wphq-plan-period p');
                            var button = plan.querySelector('.add_to_cart_button');
                            var prefix = useAnnual ? 'annual' : 'monthly';
                            var productId = plan.getAttribute('data-' + prefix + '-id');
                            var priceHtml = plan.getAttribute('data-' + prefix + '-price-html');
                            var url = plan.getAttribute('data-' + prefix + '-url');

                            plan.classList.toggle('is-monthly', !useAnnual);

                            if (price && priceHtml) {
                                price.innerHTML = priceHtml;
                            }

                            if (period) {
                                period.textContent = useAnnual ? 'per year' : 'per month';
                            }

                            if (button && productId) {
                                button.setAttribute('data-product_id', productId);
                                button.setAttribute('href', url || '#');
                            }
                        });
                    }

                    toggle.addEventListener('click', function () {
                        applyBillingPeriod(toggle.getAttribute('aria-checked') !== 'true');
                    });

                    // Annual billing is intentionally the default.
                    applyBillingPeriod(true);
                });
            </script>
        <?php endif;
    endwhile;
endif; ?>

<?php get_footer(); ?>