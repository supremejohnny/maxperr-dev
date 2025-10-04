<?php
/**
 * Custom rewrite rules for template routing
 * 
 * This file handles direct URL routing to template files without requiring WordPress pages.
 */

// Add custom rewrite rules
add_action('init', function() {
  // Solutions page
  add_rewrite_rule(
    '^solutions/?$',
    'index.php?custom_template=solutions',
    'top'
  );
  
  // Products page
  add_rewrite_rule(
    '^products/?$',
    'index.php?custom_template=products',
    'top'
  );
  
  // Product detail page
  add_rewrite_rule(
    '^product-detail/?$',
    'index.php?custom_template=product-detail',
    'top'
  );
  
  // Partnership page
  add_rewrite_rule(
    '^partnership/?$',
    'index.php?custom_template=partnership',
    'top'
  );
  
  // About page
  add_rewrite_rule(
    '^about/?$',
    'index.php?custom_template=about',
    'top'
  );
  
  // News page
  add_rewrite_rule(
    '^news/?$',
    'index.php?custom_template=news',
    'top'
  );
  
  // News paragraph/article page (with slug)
  add_rewrite_rule(
    '^news/([^/]+)/?$',
    'index.php?custom_template=news-paragraph&news_slug=$matches[1]',
    'top'
  );
});

// Add custom query vars
add_filter('query_vars', function($vars) {
  $vars[] = 'custom_template';
  $vars[] = 'news_slug';
  return $vars;
});

// Handle template loading
add_filter('template_include', function($template) {
  $custom_template = get_query_var('custom_template');
  
  if ($custom_template) {
    $template_file = '';
    
    switch ($custom_template) {
      case 'solutions':
        $template_file = 'templates/page-solutions.php';
        break;
      case 'products':
        $template_file = 'templates/page-products.php';
        break;
      case 'product-detail':
        $template_file = 'templates/page-product-detail.php';
        break;
      case 'partnership':
        $template_file = 'templates/page-partnership.php';
        break;
      case 'about':
        $template_file = 'templates/page-about.php';
        break;
      case 'news':
        $template_file = 'templates/page-news.php';
        break;
      case 'news-paragraph':
        $template_file = 'templates/page-news-paragraph.php';
        break;
    }
    
    if ($template_file) {
      $new_template = locate_template($template_file);
      if ($new_template) {
        return $new_template;
      }
    }
  }
  
  return $template;
});

// Helper function to flush rewrite rules on theme activation
add_action('after_switch_theme', function() {
  flush_rewrite_rules();
});

/**
 * Helper functions to get direct URLs
 */
if (!function_exists('figma_rebuild_get_template_url')) {
  function figma_rebuild_get_template_url($template_name) {
    $urls = [
      'solutions' => home_url('/solutions/'),
      'products' => home_url('/products/'),
      'product-detail' => home_url('/product-detail/'),
      'partnership' => home_url('/partnership/'),
      'about' => home_url('/about/'),
      'news' => home_url('/news/'),
    ];
    
    return isset($urls[$template_name]) ? $urls[$template_name] : home_url('/');
  }
}
