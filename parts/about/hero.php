<?php
/**
 * About Hero Section using shared subpage template.
 */

$template_uri = get_template_directory_uri();

$hero_title = get_theme_mod('about_hero_title', __('About Us', 'figma-rebuild'));
$hero_description = get_theme_mod(
  'about_hero_description',
  __('We build reliable energy ecosystems that accelerate electrification and empower communities to thrive.', 'figma-rebuild')
);
$hero_button_text = get_theme_mod('about_hero_button_text', __('Discover Our Story', 'figma-rebuild'));
$hero_button_link = get_theme_mod('about_hero_button_link', '#about-story');

$hero_bg_image = get_theme_mod('about_hero_bg_image', $template_uri . '/src/images/maxperr_expo.jpg');

$hero_id = 'about-hero';

include get_template_directory() . '/parts/hero-template.php';
