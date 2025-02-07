<?php
get_header(); // Load the header.php file

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
?>

    <!-- Start of the Post -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
        <!-- Post Title -->
        <header class="entry-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <div class="entry-meta">
                <span class="posted-on"><?php echo get_the_date(); ?></span>
                <span class="author"> by <?php the_author(); ?></span>
            </div>
        </header><!-- .entry-header -->

        <!-- Post Content -->
        <div class="entry-content">
            <?php the_content(); ?>
        </div><!-- .entry-content -->

        <!-- Post Footer -->
        <footer class="entry-footer">
            <div class="post-categories">
                <?php the_category( ', ' ); ?>
            </div>
            <div class="post-tags">
                <?php the_tags( 'Tags: ', ', ' ); ?>
            </div>
        </footer><!-- .entry-footer -->
    </article>
    <!-- End of the Post -->

<?php
    endwhile;
else :
    echo '<p>No content found.</p>';
endif;

get_footer(); // Load the footer.php file
