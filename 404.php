<?php
/**
 * WPHQ — page not found.
 * Install as 404.php in the active classic theme (preferably a child theme).
 */
defined( 'ABSPATH' ) || exit;

// Send the correct response before the theme outputs any markup.
status_header( 404 );
nocache_headers();
get_header();
?>

<style>
 .wphq-404 { --wphq-accent: #d86e26; padding: clamp(64px, 9vw, 120px) 24px; background: #faf8f5; color: #252525; text-align: center; }
 .wphq-404 *, .wphq-404 *::before, .wphq-404 *::after { box-sizing: border-box; }
 .wphq-404__inner { max-width: 800px; margin: 0 auto; }
 .wphq-404 .wphq-404__code { margin: 0 0 16px; color: #a34b13; font-size: clamp(72px, 14vw, 140px); font-weight: 800; line-height: 1; letter-spacing: -.06em; }
 .wphq-404 h1 { margin: 0 0 20px; font-size: clamp(30px, 5vw, 48px); line-height: 1.2; }
 .wphq-404 .wphq-404__message { max-width: 570px; margin: 0 auto 30px; font-size: 18px; line-height: 1.7; }
 .wphq-404__actions { display: flex; flex-wrap: wrap; justify-content: center; gap: 14px; margin-bottom: 32px; }
 .wphq-404 a.wphq-404__button { display: inline-flex; align-items: center; justify-content: center; min-height: 48px; padding: 13px 24px; border: 2px solid #252525; border-radius: 6px; background: #252525; color: #fff; font-size: 16px; font-weight: 700; line-height: 1.4; text-decoration: none; }
 .wphq-404 a.wphq-404__button--secondary { background: transparent; color: #252525; }
 .wphq-404 a.wphq-404__button:hover { background: #a34b13; border-color: #a34b13; color: #fff; }
 .wphq-404 a:focus-visible { outline: 3px solid #a34b13; outline-offset: 5px; }
 .wphq-404 .wphq-404__help { margin: 0; font-size: 16px; line-height: 1.7; }
 .wphq-404 .wphq-404__help a { color: #98430d; text-decoration: underline; text-underline-offset: 3px; font-weight: 700; }
 @media (max-width: 480px) { .wphq-404__actions { flex-direction: column; } }
</style>

<main id="primary" class="wphq-404" aria-labelledby="wphq-404-title">
 <div class="wphq-404__inner">
  <p class="wphq-404__code" aria-hidden="true">404</p>
  <h1 id="wphq-404-title">This page is off the grid.</h1>
  <p class="wphq-404__message">We couldn’t find the page you’re looking for. It may have moved, or the link may be out of date. Let’s get you back on track.</p>
  <nav class="wphq-404__actions" aria-label="Helpful pages">
   <a class="wphq-404__button" href="<?php echo esc_url( home_url( '/' ) ); ?>">Back to Home</a>
   <a class="wphq-404__button wphq-404__button--secondary" href="<?php echo esc_url( home_url( '/packs/' ) ); ?>">Explore Performance Packs</a>
  </nav>
  <p class="wphq-404__help">Need help with your website? <a href="<?php echo esc_url( home_url( '/free-consultation/' ) ); ?>">Get a free consultation</a>.</p>
 </div>
</main>

<?php get_footer(); ?>