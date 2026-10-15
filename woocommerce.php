<?php
/** WPHQ catalog and product layout. Keep WooCommerce's native purchase forms. */
defined( 'ABSPATH' ) || exit;

$wphq_css_path = get_theme_file_path( '/assets/css/wphq-shop.css' );
wp_enqueue_style( 'wphq-shop', get_theme_file_uri( '/assets/css/wphq-shop.css' ), array( 'wphqio-style' ), file_exists( $wphq_css_path ) ? filemtime( $wphq_css_path ) : '1.0' );

$wphq_points = static function ( $product_id, $limit = 0 ) {
    if ( ! function_exists( 'get_field' ) ) { return; }
    $rows = get_field( 'points', $product_id );
    if ( ! is_array( $rows ) ) { return; }
    $items = array();
    foreach ( $rows as $row ) {
        if ( ! is_array( $row ) || empty( $row['point'] ) || ! is_string( $row['point'] ) ) { continue; }
        $text = wp_kses_post( do_shortcode( $row['point'] ) );
        if ( trim( wp_strip_all_tags( $text ) ) !== '' ) { $items[] = $text; }
    }
    if ( ! $items ) { return; }
    if ( $limit ) { $items = array_slice( $items, 0, $limit ); }
    echo '<div class="wphq-benefits">';
    if ( ! $limit ) { echo '<h2>What’s included</h2>'; }
    echo '<ul class="wphq-benefits__list">';
    foreach ( $items as $item ) { echo '<li>' . $item . '</li>'; }
    echo '</ul></div>';
};

add_action( 'woocommerce_single_product_summary', static function () use ( $wphq_points ) {
    global $product;
    if ( $product instanceof WC_Product ) { $wphq_points( $product->get_id() ); }
}, 25 );
add_action( 'woocommerce_after_shop_loop_item', static function () use ( $wphq_points ) {
    global $product;
    if ( $product instanceof WC_Product ) { $wphq_points( $product->get_id(), 4 ); }
}, 7 );

// Product details remain available in the description/attributes/reviews tabs.
// Suppress random cross-service recommendations on these secondary pages.
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

get_header();
?>
<main id="primary" class="wphq-store woocommerce">
 <div class="wphq-store__inner">
  <?php woocommerce_breadcrumb(); ?>
  <?php if ( ! is_product() ) : ?>
   <header class="wphq-store__intro">
    <p class="wphq-store__eyebrow">WPHQ SERVICES</p>
    <h1><?php woocommerce_page_title(); ?></h1>
    <p>Practical help for your WordPress website. Explore services, compare options, and find the support your business needs.</p>
    <a href="<?php echo esc_url( home_url( '/free-consultation/' ) ); ?>">Not sure where to start? Let’s talk <span aria-hidden="true">→</span></a>
   </header>
  <?php endif; ?>
  <?php woocommerce_content(); ?>
  <aside class="wphq-store__help" aria-label="Help choosing a service">
   <div><h2>Need a hand choosing?</h2><p>Tell us what you’re working on. We’ll help you find the right next step.</p></div>
   <a class="button" href="<?php echo esc_url( home_url( '/free-consultation/' ) ); ?>">Get a Free Consultation</a>
  </aside>
 </div>
</main>
<?php get_footer(); ?>
