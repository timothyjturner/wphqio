<?php $footer = get_field('footer', 'option'); ?>

<footer class="global-footer" style="background-color: <?=$footer['background_color']?>;">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="footer-logo" src="<?=$footer['logo']['url']?>">
            </div>

            <div class="col-md-4">
                <h3>Quick Links</h3>

                <?php 	
                    wp_nav_menu( array( 'theme_location'=>'footer-menu', 'container_class'=>'footer-menu' ) ); 
                ?>
            </div>

            <div class="col-md-4">
                <?php if($footer['email']['title']): ?>
                    <h3><?=$footer['email']['title']?></h3>
                <?php endif; ?>

                <a href="mailto:<?=$footer['email']['email']?>">Contact Us: <?=$footer['email']['email']?></a>
            </div>
        </div>
    </div>

    <?php if($footer['copyright_text']): ?>
        <div class="copyright text-center">
            <?php echo do_shortcode($footer['copyright_text']); ?>
        </div>
    <?php endif; ?>
</footer>

<?php wp_footer(); ?>

</body>
</html>