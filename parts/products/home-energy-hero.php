<?php
/**
 * Home Energy Hero Section using shared subpage template.
 */

$template_uri = get_template_directory_uri();

$hero_title = get_theme_mod('home_energy_hero_title', __('Home Energy', 'figma-rebuild'));
$hero_description = get_theme_mod('home_energy_hero_subtitle', __('10 years warranty. Designed to save utility cost in the long run.', 'figma-rebuild'));
$hero_button_text = get_theme_mod('home_energy_hero_button_text', __('Learn More', 'figma-rebuild'));
$hero_button_link = get_theme_mod('home_energy_hero_button_link', '#home-energy-cards');
$hero_bg_image = get_theme_mod(
  'home_energy_hero_bg_image',
  $template_uri . '/src/images/product-Home-Energy-Hero.png'
);

$hero_id = 'home-energy-hero';

include get_template_directory() . '/parts/hero-template.php';
