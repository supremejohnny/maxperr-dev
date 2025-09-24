<?php
  $defaults      = function_exists('figma_rebuild_get_solutions_defaults') ? figma_rebuild_get_solutions_defaults() : [];
  $hero_defaults = isset($defaults['hero']) ? $defaults['hero'] : [];

  $label       = get_theme_mod('solutions_hero_title', isset($hero_defaults['title']) ? $hero_defaults['title'] : '');
  $headline    = get_theme_mod('solutions_hero_headline', isset($hero_defaults['headline']) ? $hero_defaults['headline'] : '');
  $description = get_theme_mod('solutions_hero_description', isset($hero_defaults['description']) ? $hero_defaults['description'] : '');
  $button_text = get_theme_mod('solutions_hero_button_text', __('Learn More', 'figma-rebuild'));
  $button_link = get_theme_mod('solutions_hero_button_link', '#solutions-services');

  $template_uri = get_template_directory_uri();
  $hero_backgrounds = array_values(array_filter([
    get_theme_mod(
      'solutions_hero_bg_image_1',
      isset($hero_defaults['background']) ? $hero_defaults['background'] : $template_uri . '/src/images/bg_house.jpg'
    ),
    get_theme_mod('solutions_hero_bg_image_2', $template_uri . '/src/images/bg_house2.jpg'),
    get_theme_mod('solutions_hero_bg_image_3', $template_uri . '/src/images/bg_forest.jpg'),
  ]));

  $hero_bg_primary = !empty($hero_backgrounds) ? $hero_backgrounds[0] : '';
?>

<section class="hero-section relative flex items-center overflow-hidden w-full" id="solutions-hero"
  data-hero-images='<?php echo esc_attr(wp_json_encode(array_map('esc_url', $hero_backgrounds))); ?>'>
  <div class="hero-bg-layer" data-layer="a"<?php echo $hero_bg_primary ? ' style="background-image:url(' . esc_url($hero_bg_primary) . ');"' : ''; ?>></div>
  <div class="hero-bg-layer" data-layer="b"></div>
  <div class="hero-overlay"></div>

  <div class="w-full px-4 md:px-6 relative z-40 max-w-7xl mx-auto">
    <div class="max-w-full md:max-w-[775px] text-left">
      <?php if (!empty($label)) : ?>
        <span class="inline-flex w-fit items-center rounded-full bg-white/10 px-4 py-1 text-sm font-semibold uppercase tracking-[0.2em] text-primary-light backdrop-blur">
          <?php echo esc_html($label); ?>
        </span>
      <?php endif; ?>

      <?php if (!empty($headline)) : ?>
        <h1 class="text-white Hero-H1 mb-3 leading-tight">
          <?php echo esc_html($headline); ?>
        </h1>
      <?php endif; ?>

      <?php if (!empty($description)) : ?>
        <p class="Hero-Body text-gray-200 text-lg mb-6 leading-relaxed">
          <?php echo wp_kses_post($description); ?>
        </p>
      <?php endif; ?>

      <?php if (!empty($button_text)) : ?>
        <a class="One-Column-Learn-More-Button" href="<?php echo esc_url($button_link); ?>">
          <?php echo esc_html($button_text); ?>
        </a>
      <?php endif; ?>
    </div>
  </div>

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
