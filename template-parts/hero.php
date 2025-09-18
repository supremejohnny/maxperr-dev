<section class="hero-section relative flex items-center overflow-hidden w-full"
  data-hero-images='[
    "<?php echo esc_url( get_template_directory_uri() ); ?>/src/images/bg_house.jpg",
    "<?php echo esc_url( get_template_directory_uri() ); ?>/src/images/bg_house2.jpg",
    "<?php echo esc_url( get_template_directory_uri() ); ?>/src/images/bg_forest.jpg"
  ]'>
    <!-- Background layers for crossfade -->
    <div class="hero-bg-layer" data-layer="a"></div>
    <div class="hero-bg-layer" data-layer="b"></div>
    <!-- Gradient overlay above images -->
    <div class="hero-overlay"></div>
    <div class="w-full px-4 md:px-6 relative z-40 max-w-7xl mx-auto">
      <div class="max-w-full md:max-w-[775px] text-left">
        <?php 
          $hero_title = get_theme_mod('hero_title', __('EV Fast Charging', 'figma-rebuild'));
          $hero_subtitle = get_theme_mod('hero_subtitle', '');
          $hero_paragraph = get_theme_mod('hero_paragraph', __('Experience the future of electric vehicle charging with our advanced solar-powered solutions. Clean energy, fast charging, sustainable future.', 'figma-rebuild'));
        ?>
        <?php if ($hero_title) : ?>
          <h1 class="text-white Hero-H1 mb-3 leading-tight">
            <?php echo esc_html($hero_title); ?>
          </h1>
        <?php endif; ?>
        <?php if (!empty($hero_subtitle)) : ?>
          <p class="text-white/90 text-xl mb-3 leading-snug">
            <?php echo esc_html($hero_subtitle); ?>
          </p>
        <?php endif; ?>
        <?php if ($hero_paragraph) : ?>
          <p class="Hero-Body text-gray-200 text-lg mb-3 leading-relaxed">
            <?php echo wp_kses_post($hero_paragraph); ?>
          </p>
        <?php endif; ?>
        <button class="One-Column-Learn-More-Button">
          Learn More
        </button>
      </div>
    </div>
    <!-- Slider controls -->
    <div class="hero-controls">
      <button class="hero-nav hero-nav--prev" aria-label="Previous slide">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
      </button>
      <div class="hero-pagination" aria-label="Hero pagination"></div>
      <button class="hero-nav hero-nav--next" aria-label="Next slide">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6-6 6"/></svg>
      </button>
    </div>
  </section>
