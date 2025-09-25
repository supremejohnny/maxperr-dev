<?php
/**
 * Template Name: News Paragraph
 */

get_header();

if (have_posts()) {
  the_post();

  set_query_var('news_paragraph_page_title', get_the_title());
  set_query_var('news_paragraph_page_content', apply_filters('the_content', get_the_content()));
}
?>

<main id="main" class="news-paragraph-page">
  <?php get_template_part('parts/news-paragraph/hero'); ?>
  <?php get_template_part('parts/news-paragraph/body'); ?>
  <?php get_template_part('parts/news-paragraph/need-help'); ?>
</main>

<?php
wp_reset_postdata();
get_footer();
?>
