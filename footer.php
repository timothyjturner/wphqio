<?php $footer = get_field('footer', 'option'); ?>

<footer class="global-footer" style="background-color: <?=$footer['background_color']?>;">
    <?php if($footer['copyright_text']): ?>
        <div class="copyright text-center">
            <?php echo do_shortcode($footer['copyright_text']); ?>
        </div>
    <?php endif; ?>
</footer>

<?php wp_footer(); ?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

<script>
// smooth scroll to anchor, with option of hash appearing in url. Thanks:
// https://paulund.co.uk/smooth-scroll-to-internal-links-with-jquery
$(document).ready(function(){
    $('a[href^="#"]').on('click',function (e) {
        e.preventDefault();
        var target = this.hash;
        var $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 900, 'swing', function () {
            // window.location.hash = target;
        });
    });
});
</script>

</body>
</html>