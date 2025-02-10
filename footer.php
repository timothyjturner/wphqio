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

<script>
    var $root = $('html, body');

$('a[href^="#"]').click(function () {
    $root.animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top
    }, 500);

    return false;
});
</script>

</body>
</html>