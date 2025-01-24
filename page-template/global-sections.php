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
                <div class="<?php if($banner['image']){ echo 'col-md-6'; }else { echo 'col-md-12 text-center'; } ?> content">
                    <?php if($banner['title']): ?>
                        <h1><?=$banner['title']?></h1>
                    <?php endif; ?>

                    <?=$banner['content']?>

                    <div class="row <?php if(!$banner['image']){ echo 'justify-center'; }?>">
                        <?php if($banner['buttons']): ?>
                            <?php foreach($banner['buttons'] as $key => $buttons): ?>
                                <?php if ($buttons['button']['title'] == 'Get Started'){
                                    ?>
                                        <div class="btn-dropdown-wrapper">
                                            <a class="primary-btn" href="#"><?=$buttons['button']['title']?></a>

                                            <div class="dropdown">
                                                <ul class="links">
                                                    <li><a href="#">Hosting</a></li>
                                                    <li><a href="#">Maintenance</a></li>
                                                    <li><a href="#">SEO</a></li>
                                                    <li><a href="#">Custom Quote</a></li>
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
                    <div class="col-md-6 img">
                        <img class="w-100" src="<?=$banner['image']['url']?>">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="solutions-sect">
    <div class="container">
        <h2 class="text-center">Solutions</h2>

        <div class="row">
            <div class="col-md-4 card">
                <div class="inner">
                    <img src="/wp-content/uploads/2024/11/server.png">

                    <h3>Reliable Hosting & Hassle-Free Maintenance</h3>

                    <p>Keep your WordPress site secure, fast, and up-to-date with our managed hosting and maintenance plans.</p>

                    <a class="link underline" href="#">Learn More</a>
                </div>
            </div>
            <div class="col-md-4 card">
                <div class="inner">
                    <img src="/wp-content/uploads/2024/11/performance.png">

                    <h3>SEO Services That Deliver Results</h3>

                    <p>Take the guesswork out of search engine optimization. Our tailored strategies improve rankings, boost traffic, and drive leads.</p>

                    <a class="link underline" href="#">Learn More</a>
                </div>
            </div>
            <div class="col-md-4 card">
                <div class="inner">
                    <img src="/wp-content/uploads/2024/11/coding.png">

                    <h3>Bring Your Vision to Life</h3>

                    <p>Need something unique? Our custom development services are designed to create powerful WordPress websites tailored to your exact needs.</p>

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
            </div>

            <div class="col-md-4">
                <img class="w-100" src="/wp-content/uploads/2024/11/transform-your-website-min_11zon-1-scaled.webp">
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>