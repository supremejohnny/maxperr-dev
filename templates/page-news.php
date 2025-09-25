<?php
/**
 * Template Name: News
 */

get_header();
?>

<main id="main" class="news-page">
  <?php get_template_part('parts/news-page/hero'); ?>
  <?php get_template_part('parts/news-page/grid'); ?>
</main>

<?php get_footer(); ?>
