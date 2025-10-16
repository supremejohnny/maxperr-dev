<?php
/**
 * Partnership Hero Section using shared subpage template.
 */

$template_uri = get_template_directory_uri();

$hero_title = get_theme_mod('partnership_hero_headline', 'Partner With Us');
$hero_description = get_theme_mod('partnership_hero_description', 'We are committed to accelerating the adoption of electric vehicles by making charging infrastructure more efficient and widespread.');
$hero_button_text = get_theme_mod('partnership_hero_button_text', __('Learn More', 'figma-rebuild'));
$hero_button_link = get_theme_mod('partnership_hero_button_link', '#partnership-content');
$hero_bg_image = get_theme_mod(
  'partnership_hero_bg_image',
  $template_uri . '/src/images/partner-Hero.png'
);

$hero_id = 'partnership-hero';

include get_template_directory() . '/parts/hero-template.php';

