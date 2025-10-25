<?php
/**
 * Template Name: Solutions
 */

get_header();
?>

<main id="main" class="solutions-page">
  <?php get_template_part('parts/solutions/hero'); ?>
  <?php get_template_part('parts/solutions/services'); ?>
  <?php get_template_part('parts/solutions/home'); ?>
  <?php get_template_part('parts/solutions/commercial'); ?>
  <?php get_template_part('parts/solutions/fleet'); ?>
  <?php get_template_part('parts/solutions/zevip'); ?>
  <?php get_template_part('parts/solutions/book'); ?>
</main>

<?php get_footer(); ?>
