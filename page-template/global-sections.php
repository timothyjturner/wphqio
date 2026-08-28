<?php 
//Template Name: Global Sections
get_header(); ?>

<?php 
    $hide_banner = get_field('hide_banner'); 
    $banner = get_field('banner');

    /*
     * Banner background image.
     * Supports either:
     * 1) a top-level ACF field named banner_background_image, or
     * 2) a sub-field with that same name inside the existing banner group.
     *
     * This makes the enhancement work regardless of where the field was added
     * in ACF, while preserving the existing background-color fallback.
     */
    $banner_background_image = get_field('banner_background_image');

    if (empty($banner_background_image) && is_array($banner) && !empty($banner['banner_background_image'])) {
        $banner_background_image = $banner['banner_background_image'];
    }

    // Support ACF Image return formats: array, attachment ID, or URL.
    $banner_background_image_url = '';
    if (is_array($banner_background_image) && !empty($banner_background_image['url'])) {
        $banner_background_image_url = $banner_background_image['url'];
    } elseif (is_numeric($banner_background_image)) {
        $banner_background_image_url = wp_get_attachment_image_url((int) $banner_background_image, 'full');
    } elseif (is_string($banner_background_image)) {
        $banner_background_image_url = $banner_background_image;
    }

    $banner_styles = array();

    if ($banner_background_image_url) {
        $banner_styles[] = "background-image: linear-gradient(
        90deg,
        rgba(10, 27, 36, 0.82) 0%,
        rgba(10, 27, 36, 0.68) 45%,
        rgba(10, 27, 36, 0.42) 100%
    ),url('" . esc_url($banner_background_image_url) . "')";
        $banner_styles[] = 'background-size: cover';
        $banner_styles[] = 'background-position: center center';
        $banner_styles[] = 'background-repeat: no-repeat';
    } elseif (!empty($banner['background_color'])) {
        $banner_styles[] = 'background-color: ' . sanitize_hex_color($banner['background_color']);
    }

    $banner_style_attr = $banner_styles ? implode('; ', array_filter($banner_styles)) . ';' : '';
?>

<?php if(!$hide_banner): ?>
    <section class="banner"<?php if ($banner_style_attr): ?> style="<?php echo esc_attr($banner_style_attr); ?>"<?php endif; ?>>
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


        <?php elseif( get_row_layout() == 'featured_pricing' ):

            /*
             * Featured Pricing
             * ----------------
             * Purpose-built pricing presentation for the main Hosting & Maintenance page.
             * The existing generic pricing_table layout remains untouched and fully reusable.
             *
             * ACF fields:
             * - primary_plan
             * - featured_plan
             * - alternate_plan
             * - premium_plan_1
             * - premium_plan_2
             * - show_website_included_banner
             * - featured_badge_text
             * - section_eyebrow
             * - section_title
             * - section_intro
             * - alternate_plan_intro
             * - premium_section_title
             * - premium_section_intro
             *
             * Product ACF:
             * - plan_icon
             * - plan_name
             * - points (repeater)
             *   - point
             *   - featured_highlight (true/false)
             *
             * Optional deterministic pairing fields on the WooCommerce product:
             * - monthly_product
             * - annual_product
             *
             * If those fields do not exist or are empty, the component safely
             * uses the selected product for both billing states without scanning
             * the WooCommerce catalog.
             */

            $fp_primary_ref   = get_sub_field('primary_plan');
            $fp_featured_ref  = get_sub_field('featured_plan');
            $fp_alternate_ref = get_sub_field('alternate_plan');
            $fp_premium_1_ref = get_sub_field('premium_plan_1');
            $fp_premium_2_ref = get_sub_field('premium_plan_2');

            // Contextual onboarding emails configured per Featured Pricing slot/billing period.
            $fp_purchase_email_refs = array(
                'primary' => array(
                    'monthly' => get_sub_field('primary_monthly_purchase_email'),
                    'annual'  => get_sub_field('primary_annual_purchase_email'),
                ),
                'featured' => array(
                    'monthly' => get_sub_field('featured_monthly_purchase_email'),
                    'annual'  => get_sub_field('featured_annual_purchase_email'),
                ),
                'alternate' => array(
                    'monthly' => get_sub_field('alternate_monthly_purchase_email'),
                    'annual'  => get_sub_field('alternate_annual_purchase_email'),
                ),
                'premium_1' => array(
                    'monthly' => get_sub_field('premium_1_monthly_purchase_email'),
                    'annual'  => get_sub_field('premium_1_annual_purchase_email'),
                ),
                'premium_2' => array(
                    'monthly' => get_sub_field('premium_2_monthly_purchase_email'),
                    'annual'  => get_sub_field('premium_2_annual_purchase_email'),
                ),
            );

            $fp_show_website_banner = (bool) get_sub_field('show_website_included_banner');
            $fp_badge_text         = trim((string) get_sub_field('featured_badge_text'));
            $fp_eyebrow            = trim((string) get_sub_field('section_eyebrow'));
            $fp_title              = trim((string) get_sub_field('section_title'));
            $fp_intro              = trim((string) get_sub_field('section_intro'));
            $fp_alternate_intro    = trim((string) get_sub_field('alternate_plan_intro'));
            $fp_premium_title      = trim((string) get_sub_field('premium_section_title'));
            $fp_premium_intro      = trim((string) get_sub_field('premium_section_intro'));

            /*
             * Optional display controls.
             * All default to false so existing Featured Pricing sections retain
             * their current appearance and behavior unless an option is enabled.
             */
            $fp_hide_primary_plan   = (bool) get_sub_field('hide_primary_plan');
            $fp_hide_featured_plan  = (bool) get_sub_field('hide_featured_plan');
            $fp_hide_alternate_plan = (bool) get_sub_field('hide_alternate_plan');
            $fp_hide_premium_1      = (bool) get_sub_field('hide_premium_plan_1');
            $fp_hide_premium_2      = (bool) get_sub_field('hide_premium_plan_2');
            $fp_hide_monthly_plans  = (bool) get_sub_field('hide_monthly_plans');
            $fp_compact_view        = (bool) get_sub_field('use_compact_view');

            $fp_badge_text      = $fp_badge_text ?: 'Most Popular';
            $fp_eyebrow         = $fp_eyebrow ?: 'Simple Plans. Clear Value.';
            $fp_title           = $fp_title ?: 'Choose How Much We Handle';
            $fp_intro           = $fp_intro ?: 'Choose the level of hosting, maintenance, and hands-on website support that fits your business.';
            $fp_alternate_intro = $fp_alternate_intro ?: 'Already have hosting you want to keep?';
            $fp_premium_title   = $fp_premium_title ?: 'Need More Hands-On Help?';
            $fp_premium_intro   = $fp_premium_intro ?: 'For businesses that need more development time and higher-touch support.';

            $fp_get_product_id = static function ($value) {
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

            $fp_get_product = static function ($value) use ($fp_get_product_id) {
                $id = $fp_get_product_id($value);
                return $id ? wc_get_product($id) : false;
            };

            /*
             * Normalize product titles so monthly/annual sibling products can be paired.
             * Example:
             * "Hosting Only Annual" and "Hosting Only" => "hosting only"
             */
            $fp_get_period = static function ($product) {
                if (!$product) {
                    return '';
                }

                if (class_exists('WC_Subscriptions_Product')) {
                    $period = WC_Subscriptions_Product::get_period($product);
                    if ($period === 'year') {
                        return 'annual';
                    }
                    if ($period === 'month') {
                        return 'monthly';
                    }
                }

                $title = $product->get_name();
                if (stripos($title, 'annual') !== false || stripos($title, 'yearly') !== false) {
                    return 'annual';
                }
                if (stripos($title, 'monthly') !== false) {
                    return 'monthly';
                }

                return '';
            };

            /*
             * Pair the selected product without scanning the WooCommerce catalog.
             *
             * Preferred setup:
             * Add product-level ACF Post Object fields named monthly_product and
             * annual_product. When populated, those exact products are used.
             *
             * Safe fallback:
             * If no explicit pairing fields are populated, use only the selected
             * product. This avoids wc_get_products(limit => -1), title matching,
             * and catalog-wide ACF reads on every page render.
             */
            $fp_pair_product = static function ($selected) use (
                $fp_get_period,
                $fp_get_product
            ) {
                if (!$selected) {
                    return array(
                        'monthly' => false,
                        'annual'  => false,
                        'display' => false,
                    );
                }

                $selected_id = $selected->get_id();

                $explicit_monthly = $fp_get_product(
                    get_field('monthly_product', $selected_id)
                );

                $explicit_annual = $fp_get_product(
                    get_field('annual_product', $selected_id)
                );

                if ($explicit_monthly || $explicit_annual) {
                    $monthly = $explicit_monthly ?: $selected;
                    $annual  = $explicit_annual ?: $selected;

                    return array(
                        'monthly' => $monthly,
                        'annual'  => $annual,
                        'display' => $monthly ?: $annual ?: $selected,
                    );
                }

                /*
                 * No explicit pair configured. Do not search the catalog.
                 * Keep the component functional with the selected product only.
                 */
                return array(
                    'monthly' => $selected,
                    'annual'  => $selected,
                    'display' => $selected,
                );
            };

            $fp_clean_tracking = static function ($url) {
                return remove_query_arg(array('wphq_event', 'wphq_source'), (string) $url);
            };

            $fp_tracking_url = static function ($url, $source) use ($fp_clean_tracking) {
                $url = $fp_clean_tracking($url);
                return add_query_arg(
                    array(
                        'wphq_event'  => 'select_plan',
                        'wphq_source' => sanitize_key($source),
                    ),
                    $url
                );
            };


            /*
             * Attach the page-level Custom Product Email selected for this exact
             * Featured Pricing slot + billing period. The existing functions.php
             * purchase-email system validates the signed context, stores it on the
             * cart/order item, and sends the selected onboarding email once.
             */
            $fp_apply_purchase_email = static function ($url, $product, $email_ref) use ($fp_get_product_id) {
                if (!$product || !$url || !$email_ref) {
                    return $url;
                }

                $product_id = $product->get_id();
                $email_id   = $fp_get_product_id($email_ref);

                if (
                    !$email_id ||
                    !function_exists('wphq_is_valid_custom_purchase_email') ||
                    !wphq_is_valid_custom_purchase_email($email_id) ||
                    !function_exists('wphq_build_benefit_signature')
                ) {
                    return $url;
                }

                $email_post = get_post($email_id);
                if (!$email_post || $email_post->post_type !== 'wphq_product_email') {
                    return $url;
                }

                // Reuse the existing contextual-email transport key. For generic
                // onboarding emails this is simply the selected email post slug.
                $benefit_key = sanitize_key($email_post->post_name);
                if (!$benefit_key) {
                    return $url;
                }

                $signature = wphq_build_benefit_signature(
                    $product_id,
                    $email_id,
                    $benefit_key
                );

                return add_query_arg(
                    array(
                        'wphq_purchase_email' => $email_id,
                        'wphq_benefit_key'    => $benefit_key,
                        'wphq_benefit_sig'    => $signature,
                    ),
                    $url
                );
            };

            $fp_prepare_slot = static function ($ref, $slot_key) use (
                $fp_get_product,
                $fp_pair_product,
                $fp_tracking_url,
                $fp_apply_purchase_email,
                $fp_purchase_email_refs,
                $fp_get_period
            ) {
                $selected = $fp_get_product($ref);
                if (!$selected) {
                    return false;
                }

                $pair    = $fp_pair_product($selected);
                $monthly = $pair['monthly'];
                $annual  = $pair['annual'];
                $display = $pair['display'];

                if (!$display) {
                    return false;
                }

                $display_id = $display->get_id();
                $plan_name  = trim((string) get_field('plan_name', $display_id));
                $plan_icon  = get_field('plan_icon', $display_id);

                if (!$plan_name && $monthly) {
                    $plan_name = trim((string) get_field('plan_name', $monthly->get_id()));
                }

                if (empty($plan_icon) && $monthly) {
                    $plan_icon = get_field('plan_icon', $monthly->get_id());
                }

                $icon_url = '';
                if (is_array($plan_icon) && !empty($plan_icon['url'])) {
                    $icon_url = $plan_icon['url'];
                } elseif (is_numeric($plan_icon)) {
                    $icon_url = wp_get_attachment_image_url((int) $plan_icon, 'full');
                }

                /*
                 * Use the monthly/base title for presentation so names such as
                 * "Hosting Only Annual" do not appear in the card heading.
                 */
                $title_source = $monthly ?: $display;
                $product_title = $title_source->get_name();
                $product_title = preg_replace('/\b(monthly|annual|yearly)\b/i', '', $product_title);
                $product_title = trim(preg_replace('/\s+/', ' ', $product_title));

                $monthly_id    = $monthly ? $monthly->get_id() : $display_id;
                $annual_id     = $annual ? $annual->get_id() : $display_id;

                $monthly_points = get_field('points', $monthly_id);
                $annual_points  = get_field('points', $annual_id);

                $monthly_points = is_array($monthly_points) ? $monthly_points : array();
                $annual_points  = is_array($annual_points) ? $annual_points : array();

                $split_points = static function ($points) {
                    $highlighted = array();
                    $other = array();

                    foreach ($points as $row) {
                        $text = isset($row['point']) ? trim((string) $row['point']) : '';
                        if ($text === '') {
                            continue;
                        }

                        if (!empty($row['featured_highlight'])) {
                            $highlighted[] = $text;
                        } else {
                            $other[] = $text;
                        }
                    }

                    /*
                     * Safe fallback for existing products whose benefits have not
                     * been tagged yet: show the first four instead of an empty card.
                     */
                    if (!$highlighted && $other) {
                        $highlighted = array_slice($other, 0, 4);
                        $other = array_slice($other, 4);
                    }

                    return array(
                        'highlighted' => $highlighted,
                        'other'       => $other,
                    );
                };

                $monthly_split = $split_points($monthly_points);
                $annual_split  = $split_points($annual_points);

                $slot_key_clean = sanitize_key($slot_key);
                $slot_emails    = isset($fp_purchase_email_refs[$slot_key_clean])
                    ? $fp_purchase_email_refs[$slot_key_clean]
                    : array();

                $monthly_base_url = $monthly ? $monthly->add_to_cart_url() : '';
                if ($monthly && $monthly_base_url) {
                    $monthly_base_url = $fp_apply_purchase_email(
                        $monthly_base_url,
                        $monthly,
                        $slot_emails['monthly'] ?? false
                    );
                }

                $monthly_url = $monthly ? $fp_tracking_url(
                    $monthly_base_url,
                    'featured_pricing_' . $slot_key_clean . '_monthly'
                ) : '';

                $annual_base_url = $annual ? $annual->add_to_cart_url() : '';
                if ($annual && $annual_base_url) {
                    $annual_base_url = $fp_apply_purchase_email(
                        $annual_base_url,
                        $annual,
                        $slot_emails['annual'] ?? false
                    );
                }

                $annual_url = $annual ? $fp_tracking_url(
                    $annual_base_url,
                    'featured_pricing_' . $slot_key_clean . '_annual'
                ) : '';

                $monthly_price = $monthly ? $monthly->get_price_html() : '';
                $annual_price  = $annual ? $annual->get_price_html() : '';

                $save_amount = 0;
                if ($monthly && $annual) {
                    $m = (float) $monthly->get_price();
                    $a = (float) $annual->get_price();
                    if ($m > 0 && $a > 0) {
                        $save_amount = max(0, ($m * 12) - $a);
                    }
                }

                return array(
                    'slot'                 => sanitize_key($slot_key),
                    'plan_name'            => $plan_name,
                    'title'                => $product_title,
                    'icon_url'             => $icon_url,
                    'monthly_id'           => $monthly_id,
                    'annual_id'            => $annual_id,
                    'monthly_price'        => $monthly_price,
                    'annual_price'         => $annual_price,
                    'monthly_url'          => $monthly_url,
                    'annual_url'           => $annual_url,
                    'monthly_highlighted'  => $monthly_split['highlighted'],
                    'monthly_other'        => $monthly_split['other'],
                    'annual_highlighted'   => $annual_split['highlighted'],
                    'annual_other'         => $annual_split['other'],
                    'save_amount'          => $save_amount,
                    'short_description'    => wp_strip_all_tags($display->get_short_description()),
                );
            };

            $fp_primary   = $fp_prepare_slot($fp_primary_ref, 'primary');
            $fp_featured  = $fp_prepare_slot($fp_featured_ref, 'featured');
            $fp_alternate = $fp_prepare_slot($fp_alternate_ref, 'alternate');
            $fp_premium_1 = $fp_prepare_slot($fp_premium_1_ref, 'premium_1');
            $fp_premium_2 = $fp_prepare_slot($fp_premium_2_ref, 'premium_2');

            /*
             * Visibility controls are applied only after the existing slot-preparation
             * logic has completed. This keeps product pairing, pricing, benefits,
             * tracking URLs, and purchase-email routing unchanged.
             */
            if ($fp_hide_primary_plan) {
                $fp_primary = false;
            }
            if ($fp_hide_featured_plan) {
                $fp_featured = false;
            }
            if ($fp_hide_alternate_plan) {
                $fp_alternate = false;
            }
            if ($fp_hide_premium_1) {
                $fp_premium_1 = false;
            }
            if ($fp_hide_premium_2) {
                $fp_premium_2 = false;
            }

            $fp_render_points = static function ($slot, $billing) {
                if (!$slot) {
                    return;
                }

                $highlighted = $slot[$billing . '_highlighted'] ?? array();
                $other       = $slot[$billing . '_other'] ?? array();
                $hidden_attr = $billing === 'monthly' ? ' hidden' : '';

                echo '<div class="fp-benefits fp-benefits--' . esc_attr($billing) . '"' . $hidden_attr . '>';
                echo '<ul class="fp-benefits__highlighted">';

                foreach ($highlighted as $point) {
                    echo '<li>' . wp_kses_post(do_shortcode($point)) . '</li>';
                }

                echo '</ul>';

                if ($other) {
                    echo '<div class="fp-benefits__more" hidden>';
                    echo '<ul>';
                    foreach ($other as $point) {
                        echo '<li>' . wp_kses_post(do_shortcode($point)) . '</li>';
                    }
                    echo '</ul>';
                    echo '</div>';

                    echo '<button type="button" class="fp-benefits-toggle" aria-expanded="false">';
                    echo '<span class="fp-benefits-toggle__closed">See all benefits (' . esc_html((string) count($other)) . ')</span>';
                    echo '<span class="fp-benefits-toggle__open" hidden>Show fewer benefits</span>';
                    echo '</button>';
                }

                echo '</div>';
            };

            $fp_render_card = static function ($slot, $featured = false, $premium = false) use ($fp_render_points) {
                if (!$slot) {
                    return;
                }

                $classes = array('fp-card');
                if ($featured) {
                    $classes[] = 'fp-card--featured';
                }
                if ($premium) {
                    $classes[] = 'fp-card--premium';
                }

                $guidance = '';
                if ($slot['slot'] === 'primary') {
                    $guidance = 'I manage my website.';
                } elseif ($slot['slot'] === 'featured') {
                    $guidance = 'I want WPHQ to handle my website for me.';
                } elseif ($slot['short_description']) {
                    $guidance = $slot['short_description'];
                }

                ?>
                <article
                    class="<?php echo esc_attr(implode(' ', $classes)); ?> fp-clickable-card"
                    role="link"
                    tabindex="0"
                    aria-label="Select <?php echo esc_attr($slot['title']); ?>"
                    data-monthly-id="<?php echo esc_attr($slot['monthly_id']); ?>"
                    data-annual-id="<?php echo esc_attr($slot['annual_id']); ?>"
                    data-monthly-price="<?php echo esc_attr(wp_json_encode($slot['monthly_price'])); ?>"
                    data-annual-price="<?php echo esc_attr(wp_json_encode($slot['annual_price'])); ?>"
                    data-monthly-url="<?php echo esc_url($slot['monthly_url']); ?>"
                    data-annual-url="<?php echo esc_url($slot['annual_url']); ?>"
                >
                    <?php if ($slot['icon_url']): ?>
                        <div class="fp-card__icon"><img src="<?php echo esc_url($slot['icon_url']); ?>" alt=""></div>
                    <?php endif; ?>

                    <?php if ($slot['plan_name']): ?>
                        <div class="fp-card__tier"><?php echo esc_html($slot['plan_name']); ?></div>
                    <?php endif; ?>

                    <h3><?php echo esc_html($slot['title']); ?></h3>

                    <?php if ($guidance): ?>
                        <p class="fp-card__guidance"><?php echo esc_html($guidance); ?></p>
                    <?php endif; ?>

                    <div class="fp-card__price"><?php echo wp_kses_post($slot['annual_price']); ?></div>
                    <div class="fp-card__period">per year</div>

                    <?php if ($slot['save_amount'] > 0): ?>
                        <div class="fp-card__savings">Save <?php echo wp_kses_post(wc_price($slot['save_amount'])); ?> with annual billing</div>
                    <?php endif; ?>

                    <div class="fp-card__divider"></div>

                    <?php $fp_render_points($slot, 'monthly'); ?>
                    <?php $fp_render_points($slot, 'annual'); ?>

                    <a
                        class="fp-select-plan wphq-select-plan-button"
                        href="<?php echo esc_url($slot['annual_url']); ?>"
                        data-product-id="<?php echo esc_attr($slot['annual_id']); ?>"
                        rel="nofollow"
                    >Select Plan</a>
                </article>
                <?php
            };

            if ($fp_primary || $fp_featured || $fp_alternate || $fp_premium_1 || $fp_premium_2):

                $fp_visible_slots = array_filter(
                    array(
                        'primary'   => $fp_primary,
                        'featured'  => $fp_featured,
                        'alternate' => $fp_alternate,
                        'premium_1' => $fp_premium_1,
                        'premium_2' => $fp_premium_2,
                    )
                );
                $fp_visible_count = count($fp_visible_slots);
            ?>
            <section
                id="featured-pricing"
                class="featured-pricing<?php echo $fp_compact_view ? ' featured-pricing--compact' : ''; ?>"
                data-default-billing="annual"
                data-annual-only="<?php echo $fp_hide_monthly_plans ? 'true' : 'false'; ?>"
            >
                <div class="container">

                    <?php if ($fp_compact_view): ?>

                        <header class="fp-heading fp-heading--compact">
                            <h2><?php echo esc_html($fp_title); ?></h2>

                            <?php if ($fp_intro): ?>
                                <p><?php echo esc_html($fp_intro); ?></p>
                            <?php endif; ?>

                            <?php if (!$fp_hide_monthly_plans): ?>
                                <div class="fp-billing-selector" aria-label="Subscription billing period">
                                    <span class="fp-billing-label fp-billing-label--monthly">Monthly</span>
                                    <label class="fp-billing-toggle">
                                        <input type="checkbox" class="fp-billing-toggle__input" checked aria-label="Toggle annual billing">
                                        <span class="fp-billing-toggle__track" aria-hidden="true">
                                            <span class="fp-billing-toggle__thumb"></span>
                                        </span>
                                    </label>
                                    <span class="fp-billing-label fp-billing-label--annual is-active">Annual</span>
                                    <span class="fp-billing-savings">Save more &amp; unlock annual benefits</span>
                                </div>
                            <?php endif; ?>
                        </header>

                        <div class="fp-compact-grid fp-compact-grid--count-<?php echo esc_attr($fp_visible_count); ?>">
                            <?php foreach ($fp_visible_slots as $fp_slot_key => $fp_slot): ?>
                                <div class="fp-compact-grid__item<?php echo $fp_slot_key === 'featured' ? ' fp-compact-grid__item--featured' : ''; ?>">
                                    <?php if ($fp_slot_key === 'featured'): ?>
                                        <div class="fp-featured-badge">★ <?php echo esc_html($fp_badge_text); ?></div>
                                    <?php endif; ?>

                                    <?php
                                    $fp_render_card(
                                        $fp_slot,
                                        $fp_slot_key === 'featured',
                                        in_array($fp_slot_key, array('premium_1', 'premium_2'), true)
                                    );
                                    ?>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    <?php else: ?>

                        <header class="fp-heading">
                            <?php if ($fp_eyebrow): ?>
                                <div class="fp-eyebrow"><?php echo esc_html($fp_eyebrow); ?></div>
                            <?php endif; ?>

                            <h2><?php echo esc_html($fp_title); ?></h2>

                            <?php if ($fp_intro): ?>
                                <p><?php echo esc_html($fp_intro); ?></p>
                            <?php endif; ?>

                            <?php if (!$fp_hide_monthly_plans): ?>
                                <div class="fp-billing-selector" aria-label="Subscription billing period">
                                    <span class="fp-billing-label fp-billing-label--monthly">Monthly</span>
                                    <label class="fp-billing-toggle">
                                        <input type="checkbox" class="fp-billing-toggle__input" checked aria-label="Toggle annual billing">
                                        <span class="fp-billing-toggle__track" aria-hidden="true">
                                            <span class="fp-billing-toggle__thumb"></span>
                                        </span>
                                    </label>
                                    <span class="fp-billing-label fp-billing-label--annual is-active">Annual</span>
                                    <span class="fp-billing-savings">Save more &amp; unlock annual benefits</span>
                                </div>
                            <?php endif; ?>
                        </header>

                        <?php if ($fp_show_website_banner): ?>
                            <div class="fp-website-banner" data-annual-only>
                                <div class="fp-website-banner__icon" aria-hidden="true">🎁</div>
                                <div>
                                    <strong>Your New Website Is Included With Annual Hosting Plans</strong>
                                    <p>Need a new website? Choose an eligible annual hosting plan and WPHQ will build your professional WordPress starter website at no additional cost.</p>
                                    <a href="/free-website-details/?wphq_event=view_free_website&amp;wphq_source=featured_pricing">See what's included →</a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($fp_primary || $fp_featured): ?>
                            <div class="fp-primary-grid">
                                <?php if ($fp_primary): ?>
                                    <div class="fp-primary-grid__item">
                                        <?php $fp_render_card($fp_primary, false, false); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($fp_featured): ?>
                                    <div class="fp-primary-grid__item fp-primary-grid__item--featured">
                                        <div class="fp-featured-badge">★ <?php echo esc_html($fp_badge_text); ?></div>
                                        <?php $fp_render_card($fp_featured, true, false); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($fp_alternate): ?>
                            <div
                                class="fp-alternate fp-clickable-card"
                                role="link"
                                tabindex="0"
                                aria-label="Select <?php echo esc_attr($fp_alternate['title']); ?>"
                                data-monthly-id="<?php echo esc_attr($fp_alternate['monthly_id']); ?>"
                                data-annual-id="<?php echo esc_attr($fp_alternate['annual_id']); ?>"
                                data-monthly-price="<?php echo esc_attr(wp_json_encode($fp_alternate['monthly_price'])); ?>"
                                data-annual-price="<?php echo esc_attr(wp_json_encode($fp_alternate['annual_price'])); ?>"
                                data-monthly-url="<?php echo esc_url($fp_alternate['monthly_url']); ?>"
                                data-annual-url="<?php echo esc_url($fp_alternate['annual_url']); ?>"
                            >
                                <div class="fp-alternate__top">
                                    <div class="fp-alternate__intro">
                                        <strong><?php echo esc_html($fp_alternate_intro); ?></strong>
                                        <span>WPHQ can maintain and support your WordPress site without requiring you to move your hosting.</span>
                                    </div>

                                    <div class="fp-alternate__plan">
                                        <?php if ($fp_alternate['icon_url']): ?>
                                            <div class="fp-card__icon fp-alternate__icon">
                                                <img src="<?php echo esc_url($fp_alternate['icon_url']); ?>" alt="">
                                            </div>
                                        <?php endif; ?>

                                        <div>
                                            <?php if ($fp_alternate['plan_name']): ?>
                                                <span class="fp-alternate__tier"><?php echo esc_html($fp_alternate['plan_name']); ?></span>
                                            <?php endif; ?>
                                            <strong><?php echo esc_html($fp_alternate['title']); ?></strong>
                                        </div>
                                    </div>

                                    <div class="fp-alternate__price">
                                        <span class="fp-card__price"><?php echo wp_kses_post($fp_alternate['annual_price']); ?></span>
                                        <small class="fp-card__period">per year</small>
                                    </div>

                                    <a
                                        class="fp-alternate__button wphq-select-plan-button"
                                        href="<?php echo esc_url($fp_alternate['annual_url']); ?>"
                                        data-product-id="<?php echo esc_attr($fp_alternate['annual_id']); ?>"
                                        rel="nofollow"
                                    >Select Plan</a>
                                </div>

                                <div class="fp-alternate__benefits">
                                    <?php $fp_render_points($fp_alternate, 'monthly'); ?>
                                    <?php $fp_render_points($fp_alternate, 'annual'); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($fp_premium_1 || $fp_premium_2): ?>
                            <div class="fp-premium-heading">
                                <h3><?php echo esc_html($fp_premium_title); ?></h3>
                                <?php if ($fp_premium_intro): ?>
                                    <p><?php echo esc_html($fp_premium_intro); ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="fp-premium-grid">
                                <?php if ($fp_premium_1): ?>
                                    <?php $fp_render_card($fp_premium_1, false, true); ?>
                                <?php endif; ?>

                                <?php if ($fp_premium_2): ?>
                                    <?php $fp_render_card($fp_premium_2, false, true); ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="fp-common-benefits">
                            <div class="fp-common-benefits__heading">All Plans Include</div>
                            <div class="fp-common-benefits__content">
                                <div><strong>🔒 Secure &amp; Reliable</strong><span>Professional WordPress infrastructure and SSL.</span></div>
                                <div><strong>🛟 Expert Support</strong><span>Real help when you need it.</span></div>
                                <div><strong>⚡ Performance Focused</strong><span>Built for speed and reliability.</span></div>
                                <div><strong>🏷 Developer Discounts</strong><span>Annual members save on additional development time.</span></div>
                            </div>
                        </div>

                        <p class="fp-terms-note">* Included monthly website edit/development time does not roll over and is subject to the terms of the applicable membership.</p>

                    <?php endif; ?>

                </div>
            </section>

            <style>
                .featured-pricing,
                .featured-pricing * { box-sizing: border-box; }

                .featured-pricing {
                    padding: 74px 0;
                    background: #fff;
                    color: #17313d;
                }

                .featured-pricing .container {
                    max-width: 1180px;
                    margin: 0 auto;
                }

                .fp-heading {
                    max-width: 850px;
                    margin: 0 auto 32px;
                    text-align: center;
                }

                .fp-eyebrow {
                    margin-bottom: 7px;
                    color: #df6f27;
                    font-size: 13px;
                    font-weight: 800;
                    letter-spacing: 1.2px;
                    text-transform: uppercase;
                }

                .fp-heading h2 {
                    margin: 0 0 12px;
                    color: #17313d;
                    font-size: clamp(32px, 4.5vw, 52px);
                    line-height: 1.08;
                }

                .fp-heading > p {
                    max-width: 720px;
                    margin: 0 auto;
                    color: #53636b;
                    font-size: 16px;
                    line-height: 1.65;
                }

                .fp-billing-selector {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-wrap: wrap;
                    gap: 11px;
                    margin-top: 25px;
                    font-weight: 700;
                }

                .fp-billing-label {
                    opacity: .5;
                    transition: opacity .2s ease;
                }

                .fp-billing-label.is-active {
                    opacity: 1;
                }

                .fp-billing-toggle {
                    display: inline-flex;
                    cursor: pointer;
                }

                .fp-billing-toggle__input {
                    position: absolute;
                    opacity: 0;
                    pointer-events: none;
                }

                .fp-billing-toggle__track {
                    position: relative;
                    display: block;
                    width: 54px;
                    height: 30px;
                    border-radius: 999px;
                    background: #8b949b;
                    transition: background .2s ease;
                }

                .fp-billing-toggle__thumb {
                    position: absolute;
                    top: 4px;
                    left: 4px;
                    width: 22px;
                    height: 22px;
                    border-radius: 50%;
                    background: #fff;
                    box-shadow: 0 1px 4px rgba(0,0,0,.22);
                    transition: transform .2s ease;
                }

                .fp-billing-toggle__input:checked + .fp-billing-toggle__track {
                    background: #df6f27;
                }

                .fp-billing-toggle__input:checked + .fp-billing-toggle__track .fp-billing-toggle__thumb {
                    transform: translateX(24px);
                }

                .fp-billing-savings {
                    color: #29945b;
                    font-size: 13px;
                }

                .fp-website-banner {
                    display: flex;
                    align-items: center;
                    gap: 20px;
                    max-width: 1040px;
                    margin: 0 auto 38px;
                    padding: 20px 24px;
                    border: 1px solid #bcdccc;
                    border-radius: 12px;
                    background: #f1faf5;
                }

                .fp-website-banner__icon {
                    display: flex;
                    width: 54px;
                    height: 54px;
                    flex: 0 0 54px;
                    align-items: center;
                    justify-content: center;
                    border: 2px solid #29945b;
                    border-radius: 50%;
                    font-size: 26px;
                }

                .fp-website-banner strong {
                    display: block;
                    margin-bottom: 4px;
                    color: #17313d;
                    font-size: 18px;
                }

                .fp-website-banner p {
                    margin: 0 0 6px;
                    color: #52636b;
                    line-height: 1.5;
                }

                .fp-website-banner a {
                    color: #df6f27;
                    font-weight: 700;
                }

                .fp-primary-grid {
                    display: grid;
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                    gap: 24px;
                    max-width: 920px;
                    margin: 0 auto;
                    align-items: stretch;
                }

                .fp-primary-grid__item {
                    position: relative;
                    min-width: 0;
                }

                .fp-featured-badge {
                    position: absolute;
                    z-index: 2;
                    top: -15px;
                    left: 50%;
                    transform: translateX(-50%);
                    padding: 7px 18px;
                    border-radius: 999px;
                    background: #df6f27;
                    color: #fff;
                    font-size: 12px;
                    font-weight: 800;
                    letter-spacing: .35px;
                    text-transform: uppercase;
                    white-space: nowrap;
                }

                .fp-clickable-card {
                    cursor: pointer;
                    transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
                }

                .fp-clickable-card:hover,
                .fp-clickable-card:focus-visible {
                    transform: translateY(-2px);
                    box-shadow: 0 14px 36px rgba(23,49,61,.12);
                    outline: none;
                }

                .fp-card {
                    display: flex;
                    min-height: 100%;
                    flex-direction: column;
                    padding: 32px;
                    border: 1px solid #cad5da;
                    border-radius: 15px;
                    background: #fff;
                    box-shadow: 0 8px 25px rgba(23,49,61,.06);
                }

                .fp-card--featured {
                    border: 2px solid #17313d;
                    background: linear-gradient(180deg,#f5f9ff 0,#fff 44%);
                    box-shadow: 0 12px 34px rgba(23,49,61,.11);
                }

                .fp-card--premium {
                    border: 1px solid #c8d3d8;
                    border-top: 9px solid #17313d;
                }

                .fp-card__icon {
                    width: 58px;
                    height: 58px;
                    margin: 0 auto 12px;
                    padding: 8px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    overflow: hidden;
                    border: 2px solid #17313d;
                    border-radius: 50%;
                    background: white;
                }

                .fp-card__icon img {
                    display: block;
                    width: 100%;
                    height: 100%;
                    object-fit: contain;
                }

                .fp-card__tier {
                    margin-bottom: 5px;
                    color: #56666e;
                    font-size: 12px;
                    font-weight: 800;
                    letter-spacing: .7px;
                    text-align: center;
                    text-transform: uppercase;
                }

                .fp-card h3 {
                    margin: 0;
                    color: #17313d;
                    font-size: 27px;
                    line-height: 1.15;
                    text-align: center;
                }

                .fp-card__guidance {
                    min-height: 46px;
                    margin: 10px auto 18px;
                    color: #53636b;
                    line-height: 1.5;
                    text-align: center;
                }

                .fp-card__price {
                    color: #17313d;
                    font-size: 38px;
                    font-weight: 800;
                    line-height: 1.05;
                    text-align: center;
                }

                .fp-card__price .woocommerce-Price-amount {
                    color: inherit;
                }

                .fp-card__period {
                    margin-top: 5px;
                    color: #66757c;
                    font-size: 14px;
                    text-align: center;
                }

                .fp-card__savings {
                    min-height: 22px;
                    margin-top: 7px;
                    color: #29945b;
                    font-size: 13px;
                    font-weight: 700;
                    text-align: center;
                }

                .fp-card__divider {
                    height: 1px;
                    margin: 24px 0 17px;
                    background: #dce3e6;
                }

                .fp-benefits {
                    margin-bottom: 20px;
                }

                .fp-benefits ul {
                    margin: 0;
                    padding: 0;
                    list-style: none;
                }

                .fp-benefits li {
                    position: relative;
                    margin: 0 0 11px;
                    padding-left: 24px;
                    color: #344950;
                    font-size: 14px;
                    line-height: 1.45;
                }

                .fp-benefits li::before {
                    position: absolute;
                    left: 0;
                    content: "✓";
                    color: #df6f27;
                    font-weight: 900;
                }

                .fp-benefits__more {
                    margin-top: 8px;
                }

                .fp-benefits-toggle {
                    width: 100%;
                    margin-top: 8px;
                    padding: 9px 12px;
                    border: 1px solid #cadce6;
                    border-radius: 7px;
                    background: #f7fafc;
                    color: #17313d;
                    cursor: pointer;
                    font-weight: 700;
                }

                .fp-select-plan {
                    display: block;
                    width: 100%;
                    margin-top: auto;
                    padding: 13px 18px;
                    border: 2px solid #df6f27;
                    border-radius: 8px;
                    background: #fff;
                    color: #df6f27 !important;
                    font-weight: 800;
                    text-align: center;
                    text-decoration: none;
                }

                .fp-card--featured .fp-select-plan {
                    background: #df6f27;
                    color: #fff !important;
                }

                .fp-alternate {
                    max-width: 1100px;
                    margin: 28px auto 42px;
                    overflow: hidden;
                    border: 1px solid #edc991;
                    border-radius: 12px;
                    background: #fff9f0;
                }

                .fp-alternate__top {
                    display: grid;
                    grid-template-columns: minmax(240px, 1.5fr) minmax(180px, .9fr) minmax(150px, .65fr) auto;
                    gap: 22px;
                    align-items: center;
                    padding: 20px 22px;
                }

                .fp-alternate__intro strong,
                .fp-alternate__plan strong {
                    display: block;
                    margin-bottom: 3px;
                    color: #17313d;
                }

                .fp-alternate__intro span {
                    color: #617078;
                    font-size: 14px;
                    line-height: 1.45;
                }

                .fp-alternate__plan {
                    display: flex;
                    gap: 12px;
                    align-items: center;
                }

                .fp-alternate__icon {
                    flex: 0 0 46px;
                    width: 46px;
                    height: 46px;
                    margin: 0;
                    padding: 7px;
                }

                .fp-alternate__tier {
                    display: block;
                    margin-bottom: 3px;
                    color: #df6f27;
                    font-size: 11px;
                    font-weight: 800;
                    text-transform: uppercase;
                }

                .fp-alternate__price .fp-card__price {
                    font-size: 28px;
                    text-align: left;
                }

                .fp-alternate__price .fp-card__period {
                    display: block;
                    text-align: left;
                }

                .fp-alternate__button {
                    display: inline-block;
                    padding: 10px 18px;
                    border: 2px solid #df6f27;
                    border-radius: 7px;
                    color: #df6f27 !important;
                    font-weight: 800;
                    text-decoration: none;
                    white-space: nowrap;
                }

                .fp-alternate__benefits {
                    padding: 0 22px 20px;
                }

                .fp-alternate__benefits .fp-benefits {
                    padding-top: 17px;
                    border-top: 1px solid #eddcc2;
                }

                .fp-alternate__benefits .fp-benefits__highlighted,
                .fp-alternate__benefits .fp-benefits__more ul {
                    display: grid;
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                    column-gap: 28px;
                    row-gap: 8px;
                }

                .fp-alternate__benefits .fp-benefits-toggle {
                    margin-top: 12px;
                }

                .fp-premium-heading {
                    margin: 0 auto 22px;
                    text-align: center;
                }

                .fp-premium-heading h3 {
                    margin: 0 0 6px;
                    color: #17313d;
                    font-size: 25px;
                    text-transform: uppercase;
                }

                .fp-premium-heading p {
                    margin: 0;
                    color: #607078;
                }

                .fp-premium-grid {
                    display: grid;
                    grid-template-columns: repeat(2, minmax(0,1fr));
                    gap: 24px;
                    max-width: 1040px;
                    margin: 0 auto;
                }

                .fp-common-benefits {
                    max-width: 1100px;
                    margin: 30px auto 0;
                    overflow: hidden;
                    border: 1px solid #ccdce4;
                    border-radius: 12px;
                    background: #f6fbfe;
                }

                .fp-common-benefits__heading {
                    padding: 11px 14px;
                    color: #17313d;
                    font-weight: 800;
                    text-align: center;
                    text-transform: uppercase;
                }

                .fp-common-benefits__content {
                    display: grid;
                    grid-template-columns: repeat(4,minmax(0,1fr));
                    border-top: 1px solid #dce7ec;
                }

                .fp-common-benefits__content > div {
                    min-height: 105px;
                    padding: 20px 16px;
                    justify-content: center;
                    align-items: center;
                    display: flex;
                    flex-direction: column;
                    text-align: center;
                }

                .fp-common-benefits__content > div + div {
                    border-left: 1px solid #dce7ec;
                }

                .fp-common-benefits__content strong {
                    display: block;
                    margin-bottom: 6px;
                    color: #17313d;
                }

                .fp-common-benefits__content span {
                    color: #63737a;
                    font-size: 13px;
                    line-height: 1.45;
                }

                .fp-terms-note {
                    max-width: 900px;
                    margin: 17px auto 0;
                    color: #6d797f;
                    font-size: 12px;
                    line-height: 1.5;
                    text-align: center;
                }

                /*
                 * Compact View
                 * ------------
                 * Applied only when "Use Compact View" is enabled. Standard Featured
                 * Pricing output retains all existing layout rules above.
                 */
                .featured-pricing--compact .container {
                    max-width: 1480px;
                }

                .featured-pricing--compact .fp-heading--compact {
                    max-width: 850px;
                    margin-bottom: 36px;
                }

                .fp-compact-grid {
                    display: grid;
                    gap: 22px;
                    align-items: stretch;
                    margin: 0 auto;
                }

                .fp-compact-grid--count-1 {
                    grid-template-columns: minmax(0, 440px);
                    max-width: 440px;
                    justify-content: center;
                }

                .fp-compact-grid--count-2 {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                    max-width: 900px;
                }

                .fp-compact-grid--count-3 {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                    max-width: 1120px;
                }

                .fp-compact-grid--count-4 {
                    grid-template-columns: repeat(4, minmax(0, 1fr));
                    max-width: 1320px;
                }

                .fp-compact-grid--count-5 {
                    grid-template-columns: repeat(5, minmax(0, 1fr));
                    max-width: 1480px;
                }

                .fp-compact-grid__item {
                    position: relative;
                    min-width: 0;
                }

                .fp-compact-grid__item .fp-card {
                    height: 100%;
                }

                .fp-compact-grid--count-4 .fp-card,
                .fp-compact-grid--count-5 .fp-card {
                    padding: 28px 22px;
                }

                .fp-compact-grid--count-4 .fp-card h3,
                .fp-compact-grid--count-5 .fp-card h3 {
                    font-size: 24px;
                }

                .fp-compact-grid--count-5 .fp-card__price {
                    font-size: 34px;
                }

                @media (max-width: 1100px) {
                    .fp-compact-grid--count-4,
                    .fp-compact-grid--count-5 {
                        grid-template-columns: repeat(2, minmax(0, 1fr));
                        max-width: 900px;
                    }
                }

                @media (max-width: 850px) {
                    .featured-pricing {
                        padding: 54px 0;
                    }

                    .fp-primary-grid,
                    .fp-premium-grid {
                        grid-template-columns: 1fr;
                    }

                    .fp-compact-grid--count-2,
                    .fp-compact-grid--count-3,
                    .fp-compact-grid--count-4,
                    .fp-compact-grid--count-5 {
                        grid-template-columns: repeat(2, minmax(0, 1fr));
                        max-width: 760px;
                    }

                    .fp-primary-grid {
                        max-width: 620px;
                    }

                    .fp-alternate {
                        grid-template-columns: 1fr 1fr;
                    }

                    .fp-common-benefits__content {
                        grid-template-columns: repeat(2,minmax(0,1fr));
                    }

                    .fp-common-benefits__content > div + div {
                        border-left: 0;
                    }
                }

                @media (max-width: 600px) {
                    .fp-heading h2 {
                        font-size: 34px;
                    }

                    .fp-website-banner {
                        align-items: flex-start;
                    }

                    .fp-card {
                        padding: 27px 22px;
                    }

                    .fp-compact-grid--count-2,
                    .fp-compact-grid--count-3,
                    .fp-compact-grid--count-4,
                    .fp-compact-grid--count-5 {
                        grid-template-columns: 1fr;
                        max-width: 520px;
                    }

                    .fp-alternate {
                        grid-template-columns: 1fr;
                        text-align: center;
                    }

                    .fp-alternate__price .fp-card__price,
                    .fp-alternate__price .fp-card__period {
                        text-align: center;
                    }

                    .fp-alternate__button {
                        display: block;
                    }

                    .fp-common-benefits__content {
                        grid-template-columns: 1fr;
                    }

                    .fp-common-benefits__content > div {
                        border-top: 1px solid #dce7ec;
                    }
                }

                @media (max-width: 900px) {
                    .fp-alternate__top {
                        grid-template-columns: 1fr 1fr;
                    }

                    .fp-alternate__button {
                        justify-self: start;
                    }
                }

                @media (max-width: 650px) {

                    .fp-alternate {
                        text-align: center;
                    }

                    .fp-alternate__top {
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        gap: 16px;
                        padding: 28px 22px 22px;
                    }

                    .fp-alternate__intro {
                        width: 100%;
                        max-width: 480px;
                        text-align: center;
                    }

                    .fp-alternate__intro strong {
                        margin-bottom: 8px;
                        font-size: 20px;
                        line-height: 1.25;
                    }

                    .fp-alternate__intro span {
                        display: block;
                        font-size: 15px;
                        line-height: 1.55;
                    }

                    .fp-alternate__plan {
                        width: 100%;
                        justify-content: center;
                        flex-direction: column;
                        text-align: center;
                    }

                    .fp-alternate__price {
                        width: 100%;
                        text-align: center;
                    }

                    .fp-alternate__price .fp-card__price,
                    .fp-alternate__price .fp-card__period {
                        text-align: center;
                    }

                    .fp-alternate__button {
                        display: block;
                        width: 100%;
                        max-width: 280px;
                        margin: 2px auto 0;
                        padding: 13px 18px;
                        text-align: center;
                    }

                    .fp-alternate__benefits {
                        padding: 0 22px 22px;
                        text-align: left;
                    }

                    .fp-alternate__benefits .fp-benefits__highlighted,
                    .fp-alternate__benefits .fp-benefits__more ul {
                        grid-template-columns: 1fr;
                    }
                }

            </style>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var root = document.getElementById('featured-pricing');
                    if (!root) return;

                    var toggle = root.querySelector('.fp-billing-toggle__input');
                    var monthlyLabel = root.querySelector('.fp-billing-label--monthly');
                    var annualLabel = root.querySelector('.fp-billing-label--annual');
                    var annualOnly = root.querySelectorAll('[data-annual-only]');

                    function decodeHtmlValue(value) {
                        if (!value) return '';
                        try {
                            return JSON.parse(value);
                        } catch (error) {
                            return value;
                        }
                    }

                    function updateBilling() {
                        var useAnnual = !toggle || toggle.checked;

                        if (monthlyLabel) monthlyLabel.classList.toggle('is-active', !useAnnual);
                        if (annualLabel) annualLabel.classList.toggle('is-active', useAnnual);

                        annualOnly.forEach(function (item) {
                            item.hidden = !useAnnual;
                        });

                        root.querySelectorAll('.fp-card, .fp-alternate').forEach(function (card) {
                            var price = card.querySelector('.fp-card__price');
                            var period = card.querySelector('.fp-card__period');
                            var button = card.querySelector('.wphq-select-plan-button');
                            var monthlyBenefits = card.querySelector('.fp-benefits--monthly');
                            var annualBenefits = card.querySelector('.fp-benefits--annual');

                            var priceHtml = decodeHtmlValue(useAnnual ? card.dataset.annualPrice : card.dataset.monthlyPrice);
                            var productId = useAnnual ? card.dataset.annualId : card.dataset.monthlyId;
                            var productUrl = useAnnual ? card.dataset.annualUrl : card.dataset.monthlyUrl;

                            if (price) price.innerHTML = priceHtml;
                            if (period) period.textContent = useAnnual ? 'per year' : 'per month';

                            if (button) {
                                button.href = productUrl || '#';
                                button.dataset.productId = productId || '';
                                button.setAttribute('data-product-id', productId || '');
                            }

                            if (monthlyBenefits) monthlyBenefits.hidden = useAnnual;
                            if (annualBenefits) annualBenefits.hidden = !useAnnual;
                        });
                    }

                    if (toggle) {
                        toggle.addEventListener('change', updateBilling);
                    }

                    root.addEventListener('click', function (event) {
                        var benefitToggle = event.target.closest('.fp-benefits-toggle');
                        if (benefitToggle) {
                            var benefits = benefitToggle.closest('.fp-benefits');
                            var more = benefits ? benefits.querySelector('.fp-benefits__more') : null;
                            var closedLabel = benefitToggle.querySelector('.fp-benefits-toggle__closed');
                            var openLabel = benefitToggle.querySelector('.fp-benefits-toggle__open');

                            if (more) {
                                var expanding = more.hidden;
                                more.hidden = !expanding;
                                benefitToggle.setAttribute('aria-expanded', expanding ? 'true' : 'false');
                                if (closedLabel) closedLabel.hidden = expanding;
                                if (openLabel) openLabel.hidden = !expanding;
                            }
                            return;
                        }

                        var selectPlanButton = event.target.closest('.wphq-select-plan-button');
                        if (selectPlanButton) {
                            /*
                             * Keep these as normal WooCommerce navigation requests.
                             * This mirrors the existing pricing_table behavior and avoids
                             * theme/side-cart AJAX conflicts when billing changes dynamically.
                             */
                            event.stopPropagation();
                            return;
                        }

                        /*
                         * Whole-card selection:
                         * Clicking plain card content follows the active Select Plan URL.
                         * Inner links, expanders, buttons, and form controls retain their
                         * own behavior and are never hijacked.
                         */
                        var card = event.target.closest('.fp-clickable-card');

                        if (card) {
                            var interactive = event.target.closest(
                                'a, button, input, select, textarea, label, summary, details'
                            );

                            if (interactive) {
                                return;
                            }

                            var cardButton = card.querySelector('.wphq-select-plan-button');

                            if (cardButton && cardButton.href) {
                                window.location.href = cardButton.href;
                            }
                        }
                    }, true);

                    root.addEventListener('keydown', function (event) {
                        var card = event.target.closest('.fp-clickable-card');

                        if (!card || (event.key !== 'Enter' && event.key !== ' ')) {
                            return;
                        }

                        var interactive = event.target.closest(
                            'a, button, input, select, textarea, label, summary, details'
                        );

                        if (interactive && interactive !== card) {
                            return;
                        }

                        event.preventDefault();

                        var cardButton = card.querySelector('.wphq-select-plan-button');

                        if (cardButton && cardButton.href) {
                            window.location.href = cardButton.href;
                        }
                    });

                    updateBilling();
                });
            </script>

            <?php endif; ?>


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

                            /*
                             * Analytics tracking for plan selection.
                             *
                             * Incoming navigation URLs may contain wphq_event / wphq_source
                             * (for example, view_plans from the landscaping page or site menu).
                             * WooCommerce add_to_cart_url() can inherit those query parameters
                             * from the current request, so strip ONLY our disposable analytics
                             * parameters before building the Select Plan URLs.
                             *
                             * Then add a fresh select_plan event that identifies the plan and
                             * billing period. Purchase-benefit parameters are preserved.
                             */
                            $plan_tracking_key = sanitize_title((string) ($plan_name ?: $title));
                            $plan_tracking_key = str_replace('-', '_', $plan_tracking_key);

                            if ($is_one_time) {
                                $initial_product_id = $one_time_product->get_id();
                                $initial_price_html = $one_time_product->get_price_html();
                                $initial_period     = 'one time';

                                $initial_url = remove_query_arg(
                                    array('wphq_event', 'wphq_source'),
                                    $one_time_product->add_to_cart_url()
                                );

                                $initial_url = add_query_arg(
                                    array(
                                        'wphq_event'  => 'select_plan',
                                        'wphq_source' => 'pricing_table_' . $plan_tracking_key . '_one_time',
                                    ),
                                    $initial_url
                                );

                                $monthly_price_html = '';
                                $annual_price_html  = '';
                                $monthly_url        = '';
                                $annual_url         = '';
                            } else {
                                $initial_product_id = $annual_product->get_id();
                                $initial_price_html = $annual_product->get_price_html();
                                $initial_period     = 'per year';

                                $monthly_price_html = $monthly_product->get_price_html();
                                $annual_price_html  = $annual_product->get_price_html();

                                $monthly_url = remove_query_arg(
                                    array('wphq_event', 'wphq_source'),
                                    $monthly_product->add_to_cart_url()
                                );

                                $annual_url = remove_query_arg(
                                    array('wphq_event', 'wphq_source'),
                                    $annual_product->add_to_cart_url()
                                );

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

                                /*
                                 * Add the plan-selection tracking only after the purchase-benefit
                                 * URL is complete so the signed benefit parameters remain intact.
                                 */
                                $monthly_url = add_query_arg(
                                    array(
                                        'wphq_event'  => 'select_plan',
                                        'wphq_source' => 'pricing_table_' . $plan_tracking_key . '_monthly',
                                    ),
                                    $monthly_url
                                );

                                $annual_url = add_query_arg(
                                    array(
                                        'wphq_event'  => 'select_plan',
                                        'wphq_source' => 'pricing_table_' . $plan_tracking_key . '_annual',
                                    ),
                                    $annual_url
                                );

                                // Annual is the default selection shown when the pricing table loads.
                                $initial_url = $annual_url;
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