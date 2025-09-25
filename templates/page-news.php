<?php
/**
 * Template Name: News
 */

get_header();

$hero_title = get_theme_mod('news_page_hero_title', __('News', 'figma-rebuild'));
$hero_description = '';
$hero_button_text = '';
$hero_button_link = '';
$hero_bg_image = get_theme_mod(
  'news_page_hero_bg_image',
  get_template_directory_uri() . '/src/images/bg_house2.jpg'
);
$hero_id = 'news-hero';

include get_template_directory() . '/parts/hero-template.php';

$news_archive_initial = (int) apply_filters('maxperr_news_archive_initial', 6);
if ($news_archive_initial < 1) {
  $news_archive_initial = 6;
}

include get_template_directory() . '/parts/news/archive-grid.php';

get_footer();
