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
            $plans = get_sub_field('plans');
            ?>

            <section id="pricing-table" class="pricing-table">
                <div class="container">
                    <div style="background:#fff8e5;border:2px solid #e86f1c;padding:20px;margin:20px 0;font-family:monospace;font-size:14px;line-height:1.5;overflow:auto;">
                        <h3 style="margin-top:0;">WPHQ Pricing Debug</h3>
                        <p><strong>Pricing layout reached:</strong> YES</p>
                        <p><strong>Plans value type:</strong> <?php echo esc_html(gettype($plans)); ?></p>
                        <p><strong>Plan row count:</strong> <?php echo is_array($plans) ? esc_html((string) count($plans)) : '0'; ?></p>

                        <?php if (empty($plans) || !is_array($plans)): ?>
                            <p style="color:#b00020;"><strong>No plan rows were returned by get_sub_field('plans').</strong></p>
                            <p>Confirm the Pricing Table row on this page contains saved rows in the Plans repeater.</p>
                        <?php else: ?>
                            <?php foreach ($plans as $index => $plan): ?>
                                <?php
                                $plan_type_raw = $plan['plan_type'] ?? null;
                                $monthly_raw   = $plan['monthly_product'] ?? null;
                                $annual_raw    = $plan['annual_product'] ?? null;
                                $one_time_raw  = $plan['one_time_product'] ?? null;

                                $debug_product_id = static function ($value) {
                                    if ($value instanceof WP_Post) return (int) $value->ID;
                                    if (is_object($value) && isset($value->ID)) return (int) $value->ID;
                                    if (is_array($value)) {
                                        if (isset($value['ID'])) return (int) $value['ID'];
                                        if (isset($value['id'])) return (int) $value['id'];
                                    }
                                    return is_numeric($value) ? (int) $value : 0;
                                };

                                $monthly_id  = $debug_product_id($monthly_raw);
                                $annual_id   = $debug_product_id($annual_raw);
                                $one_time_id = $debug_product_id($one_time_raw);

                                $monthly_wc  = (function_exists('wc_get_product') && $monthly_id) ? wc_get_product($monthly_id) : false;
                                $annual_wc   = (function_exists('wc_get_product') && $annual_id) ? wc_get_product($annual_id) : false;
                                $one_time_wc = (function_exists('wc_get_product') && $one_time_id) ? wc_get_product($one_time_id) : false;
                                ?>

                                <div style="border-top:1px solid #d9b56d;margin-top:16px;padding-top:16px;">
                                    <h4 style="margin:0 0 10px;">Plan Row <?php echo esc_html((string) ($index + 1)); ?></h4>
                                    <p><strong>plan_type raw value:</strong> <code><?php echo esc_html(var_export($plan_type_raw, true)); ?></code></p>
                                    <p><strong>Available row keys:</strong> <code><?php echo esc_html(implode(', ', array_keys($plan))); ?></code></p>

                                    <p><strong>monthly_product:</strong>
                                        raw type=<code><?php echo esc_html(gettype($monthly_raw)); ?></code>,
                                        ID=<code><?php echo esc_html((string) $monthly_id); ?></code>,
                                        WooCommerce=<?php echo $monthly_wc ? '<span style="color:green;">FOUND</span>' : '<span style="color:#b00020;">NOT FOUND</span>'; ?>
                                        <?php if ($monthly_wc): ?>,
                                            name=<code><?php echo esc_html($monthly_wc->get_name()); ?></code>,
                                            type=<code><?php echo esc_html($monthly_wc->get_type()); ?></code>,
                                            price=<code><?php echo esc_html((string) $monthly_wc->get_price()); ?></code>
                                        <?php endif; ?>
                                    </p>

                                    <p><strong>annual_product:</strong>
                                        raw type=<code><?php echo esc_html(gettype($annual_raw)); ?></code>,
                                        ID=<code><?php echo esc_html((string) $annual_id); ?></code>,
                                        WooCommerce=<?php echo $annual_wc ? '<span style="color:green;">FOUND</span>' : '<span style="color:#b00020;">NOT FOUND</span>'; ?>
                                        <?php if ($annual_wc): ?>,
                                            name=<code><?php echo esc_html($annual_wc->get_name()); ?></code>,
                                            type=<code><?php echo esc_html($annual_wc->get_type()); ?></code>,
                                            price=<code><?php echo esc_html((string) $annual_wc->get_price()); ?></code>
                                        <?php endif; ?>
                                    </p>

                                    <p><strong>one_time_product:</strong>
                                        raw type=<code><?php echo esc_html(gettype($one_time_raw)); ?></code>,
                                        ID=<code><?php echo esc_html((string) $one_time_id); ?></code>,
                                        WooCommerce=<?php echo $one_time_wc ? '<span style="color:green;">FOUND</span>' : '<span style="color:#b00020;">NOT FOUND</span>'; ?>
                                        <?php if ($one_time_wc): ?>,
                                            name=<code><?php echo esc_html($one_time_wc->get_name()); ?></code>,
                                            type=<code><?php echo esc_html($one_time_wc->get_type()); ?></code>,
                                            price=<code><?php echo esc_html((string) $one_time_wc->get_price()); ?></code>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif;
    endwhile;
endif; ?>

<?php get_footer(); ?>