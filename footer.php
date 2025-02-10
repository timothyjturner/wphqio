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
$(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();

    $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top
    }, 500);
});
</script>

</body>
</html>