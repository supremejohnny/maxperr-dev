<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <?php wp_head(); ?>
</head>
<body <?php body_class('antialiased text-gray-900 bg-white'); ?>>
<?php
  $solutions_page     = get_page_by_path('solutions');
  $solutions_page_url = $solutions_page ? get_permalink($solutions_page) : '#solutions';
  $products_page      = get_page_by_path('products');
  $products_page_url = $products_page ? get_permalink($products_page) : '#products';
  $products_details_page = get_page_by_path('product-details');
  $products_details_page_url = $products_details_page ? get_permalink($products_details_page) : '#product-details';
  $partnership_page  = get_page_by_path('partnership');
  $partnership_page_url = $partnership_page ? get_permalink($partnership_page) : '#partnership';
  $about_page         = get_page_by_path('about');
  $about_page_url     = $about_page ? get_permalink($about_page) : '#about';
  $news_page          = get_page_by_path('news');
  $news_page_url      = $news_page ? get_permalink($news_page) : '#news';
  $news_paragraph_page = get_page_by_path('news-paragraph');
  $news_paragraph_page_url = $news_paragraph_page ? get_permalink($news_paragraph_page) : '#news-paragraph';
  $nav_items          = [
    [
      'label' => __('Solutions', 'figma-rebuild'),
      'url'   => $solutions_page_url,
    ],
    [
      'label' => __('Products', 'figma-rebuild'),
      'url'   => $products_page_url,
    ],
    [
      'label' => __('Partnership', 'figma-rebuild'),
      'url'   => $partnership_page_url,
    ],
    [
      'label' => __('About', 'figma-rebuild'),
      'url'   => $about_page_url,
    ],
    [
      'label' => __('News', 'figma-rebuild'),
      'url'   => $news_page_url,
    ],
    [
      'label' => __('Contact', 'figma-rebuild'),
      'url'   => '#contact',
    ],
    [
      'label' => __('News Paragraph', 'figma-rebuild'),
      'url'   => $news_paragraph_page_url,
    ],
  ];

  $is_solutions_page = is_page('solutions');
  $is_products_page = is_page('products');
  $is_partnership_page = is_page('partnership');
  $is_about_page = is_page('about');
  $is_news_page = is_page_template('templates/page-news.php');
  $is_news_paragraph_page = is_page('news-paragraph');
  $is_product_details_page = is_page_template('templates/page-product-detail.php');
?>

<header class="site-header<?php echo ($is_solutions_page || $is_products_page || $is_partnership_page || $is_about_page || $is_news_page || $is_news_paragraph_page || $is_product_details_page) ? ' site-header--subpage' : ''; ?>">
  <?php if ($is_solutions_page || $is_products_page || $is_partnership_page || $is_about_page || $is_news_page || $is_news_paragraph_page || $is_product_details_page) : ?>
    <div class="subpage-header">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="subpage-header__logo" aria-label="<?php esc_attr_e('Go to homepage', 'figma-rebuild'); ?>">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/src/images/logo_maxperr.png"
             alt="<?php esc_attr_e('Maxperr Energy', 'figma-rebuild'); ?>"
             class="w-full h-full object-contain">
      </a>

      <nav class="subpage-header__nav" role="navigation" aria-label="<?php esc_attr_e('Primary Menu', 'figma-rebuild'); ?>">
        <?php foreach ($nav_items as $index => $item) : ?>
          <?php if ($item['label'] === 'Solutions') : ?>
            <div class="nav-dropdown">
              <a href="<?php echo esc_url($item['url']); ?>" class="subpage-header__link nav-link--dropdown" data-dropdown="solutions">
                <?php echo esc_html($item['label']); ?>
              </a>
              <div class="dropdown-menu dropdown-menu--solutions" id="dropdown-solutions">
                <div class="dropdown-content">
                  <div class="dropdown-section">
                    <h3 class="dropdown-title">What's Right for Me?</h3>
                    <ul class="dropdown-list">
                      <li><a href="#residential" class="dropdown-link">Residential</a></li>
                      <li><a href="#fleet" class="dropdown-link">Fleet</a></li>
                      <li><a href="#commercial" class="dropdown-link">Commercial</a></li>
                    </ul>
                  </div>
                  <div class="dropdown-images">
                    <div class="dropdown-image-placeholder">
                      <span class="placeholder-text">Image Placeholder</span>
                    </div>
                    <div class="dropdown-image-placeholder">
                      <span class="placeholder-text">Image Placeholder</span>
                    </div>
                    <div class="dropdown-image-placeholder">
                      <span class="placeholder-text">Image Placeholder</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php elseif ($item['label'] === 'About') : ?>
            <div class="nav-dropdown">
              <a href="<?php echo esc_url($item['url']); ?>" class="subpage-header__link nav-link--dropdown" data-dropdown="about">
                <?php echo esc_html($item['label']); ?>
              </a>
              <div class="dropdown-menu dropdown-menu--about" id="dropdown-about">
                <div class="dropdown-content dropdown-content--columns">
                  <div class="dropdown-column">
                    <h3 class="dropdown-title">Company</h3>
                    <ul class="dropdown-list">
                      <li><a href="#our-story" class="dropdown-link">Our Story</a></li>
                      <li><a href="#mission" class="dropdown-link">Mission</a></li>
                      <li><a href="#people" class="dropdown-link">People</a></li>
                    </ul>
                  </div>
                  <div class="dropdown-column">
                    <h3 class="dropdown-title">Impact</h3>
                    <ul class="dropdown-list">
                      <li><a href="#news" class="dropdown-link">News</a></li>
                      <li><a href="#case-studies" class="dropdown-link">Case Studies</a></li>
                      <li><a href="#events" class="dropdown-link">Events</a></li>
                      <li><a href="#industry-updates" class="dropdown-link">Industry Updates</a></li>
                    </ul>
                  </div>
                  <div class="dropdown-column">
                    <h3 class="dropdown-title">Solutions</h3>
                    <ul class="dropdown-list">
                      <li><a href="#residential" class="dropdown-link">Residential</a></li>
                      <li><a href="#fleet" class="dropdown-link">Fleet</a></li>
                      <li><a href="#commercial" class="dropdown-link">Commercial</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          <?php else : ?>
              <a href="<?php echo esc_url($item['url']); ?>" class="subpage-header__link<?php echo (($is_solutions_page && $item['label'] === 'Solutions') || ($is_products_page && $item['label'] === 'Products') || ($is_partnership_page && $item['label'] === 'Partnership') || ($is_about_page && $item['label'] === 'About') || ($is_news_page && $item['label'] === 'News') || ($is_news_paragraph_page && $item['label'] === 'News Paragraph') || ($is_product_details_page && $item['label'] === 'Products')) ? ' subpage-header__link--active' : ''; ?>">
              <?php echo esc_html($item['label']); ?>
            </a>
          <?php endif; ?>
        <?php endforeach; ?>
      </nav>

      <div class="subpage-header__actions">
        <button type="button" class="subpage-header__icon" aria-label="<?php esc_attr_e('Profile placeholder', 'figma-rebuild'); ?>">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4z" />
            <path d="M4 20a8 8 0 0 1 16 0" />
          </svg>
        </button>
        <button type="button" class="subpage-header__icon" aria-label="<?php esc_attr_e('Shopping cart placeholder', 'figma-rebuild'); ?>">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="9" cy="20" r="1" />
            <circle cx="17" cy="20" r="1" />
            <path d="M3 4h2l2 12h10l2-8H6" />
          </svg>
        </button>
        <button id="mobile-menu-button" class="subpage-header__menu-toggle" aria-expanded="false" aria-controls="mobile-menu">
          <span class="sr-only"><?php esc_html_e('Toggle navigation', 'figma-rebuild'); ?></span>
          <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>

    <div class="mobile-menu" id="mobile-menu">
      <div class="px-6 py-4 space-y-4 max-w-7xl mx-auto">
        <?php foreach ($nav_items as $item) : ?>
          <a href="<?php echo esc_url($item['url']); ?>" class="nav-link<?php echo (($is_solutions_page && $item['label'] === 'Solutions') || ($is_products_page && $item['label'] === 'Products') || ($is_partnership_page && $item['label'] === 'Partnership') || ($is_about_page && $item['label'] === 'About') || ($is_news_page && $item['label'] === 'News') || ($is_news_paragraph_page && $item['label'] === 'News Paragraph') || ($is_product_details_page && $item['label'] === 'Products')) ? ' nav-link--active' : ''; ?>">
            <?php echo esc_html($item['label']); ?>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  <?php else : ?>
    <div class="header-container">
      <!-- Logo -->
      <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-container">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/src/images/logo_maxperr.png"
             alt="<?php esc_attr_e('Maxperr Energy', 'figma-rebuild'); ?>"
             class="w-full h-full object-contain">
      </a>

      <!-- Navigation - Centered -->
      <nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e('Primary Menu', 'figma-rebuild'); ?>">
        <?php foreach ($nav_items as $index => $item) : ?>
          <?php if ($item['label'] === 'Solutions') : ?>
            <div class="nav-dropdown">
              <a href="<?php echo esc_url($item['url']); ?>" class="nav-link nav-link--dropdown" data-dropdown="solutions">
                <?php echo esc_html($item['label']); ?>
              </a>
              <div class="dropdown-menu dropdown-menu--solutions" id="dropdown-solutions">
                <div class="dropdown-content">
                  <div class="dropdown-section">
                    <h3 class="dropdown-title">What's Right for Me?</h3>
                    <ul class="dropdown-list">
                      <li><a href="#residential" class="dropdown-link">Residential</a></li>
                      <li><a href="#fleet" class="dropdown-link">Fleet</a></li>
                      <li><a href="#commercial" class="dropdown-link">Commercial</a></li>
                    </ul>
                  </div>
                  <div class="dropdown-images">
                    <div class="dropdown-image-placeholder">
                      <span class="placeholder-text">Image Placeholder</span>
                    </div>
                    <div class="dropdown-image-placeholder">
                      <span class="placeholder-text">Image Placeholder</span>
                    </div>
                    <div class="dropdown-image-placeholder">
                      <span class="placeholder-text">Image Placeholder</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php elseif ($item['label'] === 'About') : ?>
            <div class="nav-dropdown">
              <a href="<?php echo esc_url($item['url']); ?>" class="nav-link nav-link--dropdown" data-dropdown="about">
                <?php echo esc_html($item['label']); ?>
              </a>
              <div class="dropdown-menu dropdown-menu--about" id="dropdown-about">
                <div class="dropdown-content dropdown-content--columns">
                  <div class="dropdown-column">
                    <h3 class="dropdown-title">Company</h3>
                    <ul class="dropdown-list">
                      <li><a href="#our-story" class="dropdown-link">Our Story</a></li>
                      <li><a href="#mission" class="dropdown-link">Mission</a></li>
                      <li><a href="#people" class="dropdown-link">People</a></li>
                    </ul>
                  </div>
                  <div class="dropdown-column">
                    <h3 class="dropdown-title">Impact</h3>
                    <ul class="dropdown-list">
                      <li><a href="#news" class="dropdown-link">News</a></li>
                      <li><a href="#case-studies" class="dropdown-link">Case Studies</a></li>
                      <li><a href="#events" class="dropdown-link">Events</a></li>
                      <li><a href="#industry-updates" class="dropdown-link">Industry Updates</a></li>
                    </ul>
                  </div>
                  <div class="dropdown-column">
                    <h3 class="dropdown-title">Solutions</h3>
                    <ul class="dropdown-list">
                      <li><a href="#residential" class="dropdown-link">Residential</a></li>
                      <li><a href="#fleet" class="dropdown-link">Fleet</a></li>
                      <li><a href="#commercial" class="dropdown-link">Commercial</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          <?php else : ?>
            <a href="<?php echo esc_url($item['url']); ?>" class="nav-link">
              <?php echo esc_html($item['label']); ?>
            </a>
          <?php endif; ?>
        <?php endforeach; ?>
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
        <?php foreach ($nav_items as $item) : ?>
          <a href="<?php echo esc_url($item['url']); ?>" class="nav-link">
            <?php echo esc_html($item['label']); ?>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>
</header>
