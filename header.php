<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <?php wp_head(); ?>
</head>
<body <?php body_class('antialiased text-gray-900 bg-white'); ?>>
<header class="site-header">
  <div class="header-container">
    <!-- Logo -->
    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-container">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/src/images/logo_maxperr.png" 
           alt="<?php esc_attr_e('Maxperr Energy', 'figma-rebuild'); ?>" 
           class="w-full h-full object-contain">
    </a>
    
    <!-- Navigation - Centered -->
    <nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e('Primary Menu', 'figma-rebuild'); ?>">
      <a href="#solutions" class="nav-link"><?php esc_html_e('Solutions', 'figma-rebuild'); ?></a>
      <a href="#products" class="nav-link"><?php esc_html_e('Products', 'figma-rebuild'); ?></a>
      <a href="#partnership" class="nav-link"><?php esc_html_e('Partnership', 'figma-rebuild'); ?></a>
      <a href="#about" class="nav-link"><?php esc_html_e('About', 'figma-rebuild'); ?></a>
      <a href="#contact" class="nav-link"><?php esc_html_e('Contact', 'figma-rebuild'); ?></a>
    </nav>
    
    <!-- Right side spacer or CTA button -->
    <div class="header-spacer">
      <!-- Mobile menu button -->
      <button id="mobile-menu-button" aria-expanded="false" aria-controls="mobile-menu">
        <span class="sr-only"><?php esc_html_e('Toggle navigation', 'figma-rebuild'); ?></span>
        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>
  </div>
  
  <!-- Mobile menu -->
  <div class="mobile-menu" id="mobile-menu">
    <div class="px-6 py-4 space-y-4 max-w-7xl mx-auto">
      <a href="#solutions" class="nav-link">Solutions</a>
      <a href="#products" class="nav-link">Products</a>
      <a href="#partnership" class="nav-link">Partnership</a>
      <a href="#about" class="nav-link">About</a>
      <a href="#contact" class="nav-link">Contact</a>
    </div>
  </div>
</header>
