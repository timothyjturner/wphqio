<footer class="global-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="/wp-content/uploads/2024/11/wphq-logo.png">
            </div>

            <div class="col-md-4">
                <?php 	
                    wp_nav_menu( array( 'theme_location'=>'footer-menu', 'container_class'=>'footer-menu' ) ); 
                ?>
            </div>

            <div class="col-md-4">
                <h3>Questions?</h3>
                <a href="mailto:admin@wphq.io">Contact Us: admin@wphq.io</a>
            </div>
        </div>
        <div class="copyright">
            Copyright © 2024 WPHQ.
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>