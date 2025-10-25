<?php
/**
 * Template Name: Products
 */

get_header();
?>

<main id="main" class="products-page">
  <?php get_template_part('parts/products/navigation'); ?>
  <?php get_template_part('parts/products/hero'); ?>
  <?php get_template_part('parts/products/charger-cards'); ?>
  <?php get_template_part('parts/products/home-energy-hero'); ?>
  <?php get_template_part('parts/products/home-energy-cards'); ?>
</main>

<?php get_footer(); ?>
