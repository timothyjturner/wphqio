<?php
get_header(); // Load the header.php file

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
?>

    <!-- Start of the Post -->
       
<section id="simple-content" class="simple-content">
                <div class="container">
                    <div class="text-center">




            <!-- <h1 class="entry-title"><?php the_title(); ?></h1> -->
            

        <!-- Post Content -->
        <div class="entry-content">
            <?php the_content(); ?>
        </div><!-- .entry-content -->

      
    </section>
    <!-- End of the Post -->

<?php
    endwhile;
else :
    echo '<p>No content found.</p>';
endif;

get_footer(); // Load the footer.php file
