<?php
// Enqueue built CSS/JS from /dist
add_action('wp_enqueue_scripts', function () {
  $theme_version = wp_get_theme()->get('Version');

  // Tailwind CSS (built)
  wp_enqueue_style(
    'figma-rebuild-tailwind',
    get_template_directory_uri() . '/dist/app.css',
    [],
    filemtime(get_template_directory() . '/dist/app.css')
  );

  // Custom theme styles (after Tailwind)
  wp_enqueue_style(
    'figma-rebuild-style',
    get_stylesheet_uri(),
    ['figma-rebuild-tailwind'],
    filemtime(get_template_directory() . '/style.css')
  );

  // Custom kit styles (after Tailwind + style.css)
  wp_enqueue_style(
    'figma-rebuild-kit',
    get_template_directory_uri() . '/src/css/maxperr_kit.css',
    ['figma-rebuild-tailwind', 'figma-rebuild-style'], // 依赖在后面加载
    filemtime(get_template_directory() . '/src/css/maxperr_kit.css')
  );

  // JavaScript
  wp_enqueue_script(
    'figma-rebuild-app',
    get_template_directory_uri() . '/dist/app.js',
    [],
    filemtime(get_template_directory() . '/dist/app.js'),
    true
  );
});
