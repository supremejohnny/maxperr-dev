<?php
// Theme setup: menus, thumbnails, HTML5, etc.
add_action('after_setup_theme', function () {
  // Load text domain for translations
  load_theme_textdomain('figma-rebuild', get_template_directory() . '/languages');
  
  // Core theme supports
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', [
    'search-form', 
    'comment-form', 
    'comment-list', 
    'gallery', 
    'caption',
    'style',
    'script',
    'navigation-widgets'
  ]);
  
  // Gutenberg/Block Editor support
  add_theme_support('wp-block-styles');
  add_theme_support('responsive-embeds');
  add_theme_support('editor-styles');
  add_theme_support('align-wide');
  
  // Custom logo support
  add_theme_support('custom-logo', [
    'height'      => 44,
    'width'       => 255,
    'flex-width'  => true,
    'flex-height' => true,
  ]);
  
  // RSS feed links
  add_theme_support('automatic-feed-links');
  
  // Navigation menus
  register_nav_menus([
    'primary' => __('Primary Menu', 'figma-rebuild'),
    'footer'  => __('Footer Menu', 'figma-rebuild'),
  ]);
  
  // Set content width
  if (!isset($content_width)) {
    $content_width = 778; // matches max-w-2xl
  }
});
