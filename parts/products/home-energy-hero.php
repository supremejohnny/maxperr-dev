<?php
  $hero_title = get_theme_mod('home_energy_hero_title', __('Home Energy', 'figma-rebuild'));
  $hero_subtitle = get_theme_mod('home_energy_hero_subtitle', __('10 years warranty. Designed to save utility cost in the long run.', 'figma-rebuild'));
  $hero_button_text = get_theme_mod('home_energy_hero_button_text', __('Learn More', 'figma-rebuild'));
  $hero_button_link = get_theme_mod('home_energy_hero_button_link', '#home-energy-cards');

  $template_uri = get_template_directory_uri();
  $hero_background = get_theme_mod(
    'home_energy_hero_bg_image',
    $template_uri . '/src/images/bg_house2.jpg'
  );
?>

<section class="hero-section subpage-hero relative overflow-hidden w-full" id="home-energy-hero">
  <div class="hero-bg-layer is-active"<?php echo $hero_background ? ' style="background-image:url(' . esc_url($hero_background) . ');"' : ''; ?>></div>
  <div class="hero-overlay subpage-hero__overlay"></div>

  <div class="subpage-hero__inner">
    <?php if (!empty($hero_title)) : ?>
      <h1 class="Hero-H1 subpage-hero__headline">
        <?php echo esc_html($hero_title); ?>
      </h1>
    <?php endif; ?>

    <?php if (!empty($hero_subtitle)) : ?>
      <p class="Hero-Body subpage-hero__description">
        <?php echo wp_kses_post($hero_subtitle); ?>
      </p>
    <?php endif; ?>

    <?php if (!empty($hero_button_text)) : ?>
      <a class="One-Column-Learn-More-Button subpage-hero__cta" href="<?php echo esc_url($hero_button_link); ?>">
        <?php echo esc_html($hero_button_text); ?>
      </a>
    <?php endif; ?>
  </div>
</section>
