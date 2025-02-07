<?php
get_header(); // Load the header.php file

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
?>

    <!-- Start of the Post -->
       
<section id="simple-content" class="simple-content">
                <div class="container">
                    <div class="text-center__">


<?php the_post_thumbnail( 'full', array( 'class' => 'custom-class', 'alt' => get_the_title() ) ); ?>

 <!-- Display the Featured Image -->
        <?php
        if ( has_post_thumbnail() ) :
            ?>
            <div class="post-featured-image">
                <?php the_post_thumbnail( 'full' ); ?>
            </div>
        <?php endif; ?>


        
            <!-- <h1 class="entry-title"><?php the_title(); ?></h1> -->
            

        <!-- Post Content -->
        <div class="entry-content">
            <?php the_content(); ?>
        </div><!-- .entry-content -->

      
    </section>
    <!-- End of the Post -->




    <!-- <section id="global-cta" class="cta" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-delay="200" data-aos-duration="800">
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
            </section> -->

<?php
    endwhile;
else :
    echo '<p>No content found.</p>';
endif;

get_footer(); // Load the footer.php file
