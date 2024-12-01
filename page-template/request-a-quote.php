<?php 
//Template Name: Request a Quote
get_header();
?>

<section class="banner">
    <div class="container">
        <div class="row align-center">
            <div class="col-md-6 content">
                <h1>Request a Quote</h1>

                <!-- <p>
                    Focus on growing your business while we ensure your website stays fast, secure, and always online.
                </p> -->

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
            <div class="col-md-6 img">
                <img class="w-100" src="/wp-content/uploads/2024/11/wphq-hosting-and-maintenance-min-scaled.webp">
            </div>
        </div>
    </div>
</section>

<section class="form-sect">
    <div class="container">
        <div class="row">
            <div class="col-md-6 content">
                <h2>Let’s Build Something Great Together</h2>

                <p>Tell us about your project, and we’ll provide a tailored quote to bring your vision to life.</p>
            </div>

            <div class="col-md-6 form">
                <h3>Get Your Free Custom Quote</h3>

                <div class="form-wrapper">
                    <?php echo do_shortcode('[wpforms id="94" title="false"]'); ?>
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

                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</p>

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