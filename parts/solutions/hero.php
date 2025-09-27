<?php
  $defaults      = function_exists('figma_rebuild_get_solutions_defaults') ? figma_rebuild_get_solutions_defaults() : [];
  $hero_defaults = isset($defaults['hero']) ? $defaults['hero'] : [];

  $headline    = get_theme_mod('solutions_hero_headline', isset($hero_defaults['headline']) ? $hero_defaults['headline'] : '');
  $description = get_theme_mod('solutions_hero_description', isset($hero_defaults['description']) ? $hero_defaults['description'] : '');
  $button_text = get_theme_mod('solutions_hero_button_text', __('Learn More', 'figma-rebuild'));
  $button_link = get_theme_mod('solutions_hero_button_link', '#solutions-services');

  $template_uri = get_template_directory_uri();
  $hero_background = get_theme_mod(
    'solutions_hero_background',
    isset($hero_defaults['background']) ? $hero_defaults['background'] : $template_uri . '/src/images/solution-house-bg.png'
  );
?>

<section class="hero-section subpage-hero relative overflow-hidden w-full" id="solutions-hero">
  <div class="hero-bg-layer is-active"<?php echo $hero_background ? ' style="background-image:url(' . esc_url($hero_background) . ');"' : ''; ?>></div>
  <div class="hero-overlay subpage-hero__overlay"></div>

  <div class="subpage-hero__inner">
    <?php if (!empty($headline)) : ?>
      <h1 class="Hero-H1 subpage-hero__headline">
        <?php echo esc_html($headline); ?>
      </h1>
    <?php endif; ?>

    <?php if (!empty($description)) : ?>
      <p class="Hero-Body subpage-hero__description">
        <?php echo wp_kses_post($description); ?>
      </p>
    <?php endif; ?>

    <?php if (!empty($button_text)) : ?>
      <a class="One-Column-Learn-More-Button subpage-hero__cta" href="<?php echo esc_url($button_link); ?>">
        <?php echo esc_html($button_text); ?>
      </a>
    <?php endif; ?>
  </div>
</section>
