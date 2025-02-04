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
                <div class="<?php if($banner['image']){ echo 'col-md-6'; }else { echo 'col-md-12 text-center'; } ?> content" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
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
                                        <div class="btn-dropdown-wrapper">
                                            <a class="primary-btn" href="#"><?=$buttons['button']['title']?></a>

                                            <div class="dropdown">
                                                <ul class="links">
                                                    <?php foreach($global_button_links as $global_links): ?>
                                                        <?php if($banner['get_started_button_go_down_to_pricing_page'] && $global_links['link']['title'] == 'Hosting' || $global_links['link']['title'] == 'Maintenance' || $global_links['link']['title'] == 'SEO'){ 
                                                            ?>
                                                                <li><a href="#pricing-table"><?=$global_links['link']['title']?></a></li>
                                                            <?php
                                                        }else { ?>
                                                            <li><a href="<?=$global_links['link']['url']?>"><?=$global_links['link']['title']?></a></li>
                                                        <?php } ?>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php
                                }else {
                                    ?>
                                        <a class="white-btn" href="<?=$buttons['button']['url']?>"><?=$buttons['button']['title']?></a>
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

            <section id="simple-content" class="simple-content">
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
                    <a class="link underline" href="#">Learn More</a>
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
            </section>

        <?php elseif( get_row_layout() == 'pricing_table' ):
            $products = get_sub_field('products'); ?>

            <section id="pricing-table" class="pricing-table">
                <div class="container">
                    <div class="row table-main">
                        <?php foreach($products as $product): 
                            $permalink = get_permalink( $product->ID );
                            $title = get_the_title( $product->ID );
                            $plan_icon = get_field( 'plan_icon', $product->ID );
                            $plan_name = get_field( 'plan_name', $product->ID );
                            $points = get_field( 'points', $product->ID );
                            $_product = wc_get_product( $product->ID ); ?>

                            <div class="col-md-4" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="800">
                                <div class="pricing-header">
                                    <div class="icon">
                                        <img src="<?=$plan_icon['url']?>">

                                        <h4><?=$plan_name?></h4>
                                    </div>

                                    <h3><?=$title?></h3>

                                    <div class="pricing-wrap">
                                        <div class="price">
                                            $<?=$_product->get_price()?>
                                        </div>

                                        <div class="per-month">
                                            <p>per
                                            month</p>
                                        </div>
                                    </div>

                                    <a href="/?wc-ajax=add_to_cart?add-to-cart=<?=$product->ID?>" data-quantity="1" class="white-btn product_type_variable add_to_cart_button ajax_add_to_cart ad_quick_add_to_cart_listing" data-product_id="<?=$product->ID?>" rel="nofollow">Select Plan</a>
                                    
                                </div>
                                <div class="content">
                                    <?php if($points): ?>
                                        <ul>
                                            <?php foreach($points as $point): ?>
                                                <li><?=$point['point']?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif;
    endwhile;
endif; ?>

<?php get_footer(); ?>