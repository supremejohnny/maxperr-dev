<?php
/**
 * Products Hero Section using shared subpage template.
 */

$template_uri = get_template_directory_uri();

$hero_title = get_theme_mod('products_hero_title', __('EV Chargers', 'figma-rebuild'));
$hero_description = get_theme_mod('products_hero_subtitle', __('We offer the equipment, installation service and 24/7 technical support.', 'figma-rebuild'));
$hero_button_text = get_theme_mod('products_hero_button_text', __('Learn More', 'figma-rebuild'));
$hero_button_link = get_theme_mod('products_hero_button_link', '#charger-cards');
$hero_bg_image = get_theme_mod(
  'products_hero_bg_image',
  $template_uri . '/src/images/product-Hero-Image.png'
);

$hero_id = 'products-hero';

include get_template_directory() . '/parts/hero-template.php';
