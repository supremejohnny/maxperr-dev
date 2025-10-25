<?php
/**
 * Template Name: Product Detail
 *
 * Detailed product page for the Eco 12kW AC charger.
 *
 * @package figma-rebuild
 */

get_header();
?>

<main class="product-detail-page">
  <?php get_template_part('parts/product-detail/hero'); ?>
  <?php get_template_part('parts/product-detail/cost-efficient-home-charger'); ?>
  <?php get_template_part('parts/product-detail/product-specs'); ?>
  <?php get_template_part('parts/product-detail/compare-models'); ?>
</main>

<?php get_footer(); ?>
