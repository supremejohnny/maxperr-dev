<?php
/**
 * Solutions Hero Section using shared subpage template.
 */

$defaults      = function_exists('figma_rebuild_get_solutions_defaults') ? figma_rebuild_get_solutions_defaults() : [];
$hero_defaults = isset($defaults['hero']) ? $defaults['hero'] : [];

$template_uri = get_template_directory_uri();

$hero_title = get_theme_mod('solutions_hero_headline', isset($hero_defaults['headline']) ? $hero_defaults['headline'] : '');
$hero_description = get_theme_mod('solutions_hero_description', isset($hero_defaults['description']) ? $hero_defaults['description'] : '');
$hero_button_text = get_theme_mod('solutions_hero_button_text', __('Learn More', 'figma-rebuild'));
$hero_button_link = get_theme_mod('solutions_hero_button_link', '#solutions-services');
$hero_bg_image = get_theme_mod(
  'solutions_hero_background',
  isset($hero_defaults['background']) ? $hero_defaults['background'] : $template_uri . '/src/images/solution-house-bg.png'
);

$hero_id = 'solutions-hero';

include get_template_directory() . '/parts/hero-template.php';
