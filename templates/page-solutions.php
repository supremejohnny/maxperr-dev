<?php
/**
 * Template Name: Solutions
 */

get_header();
?>

<main id="main" class="solutions-page">
  <?php get_template_part('parts/solutions/hero'); ?>
  <?php get_template_part('parts/solutions/services'); ?>
  <?php get_template_part('parts/solutions/section', null, ['section' => 'home', 'layout' => 'image-left']); ?>
  <?php get_template_part('parts/solutions/section', null, ['section' => 'commercial', 'layout' => 'image-right']); ?>
  <?php get_template_part('parts/solutions/section', null, ['section' => 'fleet', 'layout' => 'image-left']); ?>
  <?php get_template_part('parts/solutions/zevip'); ?>
  <?php get_template_part('parts/solutions/book'); ?>
</main>

<?php get_footer(); ?>
