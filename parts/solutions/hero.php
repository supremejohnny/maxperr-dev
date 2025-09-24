<?php
  $defaults      = function_exists('figma_rebuild_get_solutions_defaults') ? figma_rebuild_get_solutions_defaults() : [];
  $hero_defaults = isset($defaults['hero']) ? $defaults['hero'] : [];

  $label       = get_theme_mod('solutions_hero_title', isset($hero_defaults['title']) ? $hero_defaults['title'] : '');
  $headline    = get_theme_mod('solutions_hero_headline', isset($hero_defaults['headline']) ? $hero_defaults['headline'] : '');
  $description = get_theme_mod('solutions_hero_description', isset($hero_defaults['description']) ? $hero_defaults['description'] : '');
  $button_text = get_theme_mod('solutions_hero_button_text', __('Learn More', 'figma-rebuild'));
  $button_link = get_theme_mod('solutions_hero_button_link', '#solutions-services');

  $template_uri = get_template_directory_uri();
  $hero_background = get_theme_mod(
    'solutions_hero_bg_image_1',
    isset($hero_defaults['background']) ? $hero_defaults['background'] : $template_uri . '/src/images/bg_house.jpg'
  );
?>

<section class="hero-section solutions-hero relative overflow-hidden w-full" id="solutions-hero">
  <div class="hero-bg-layer is-active"<?php echo $hero_background ? ' style="background-image:url(' . esc_url($hero_background) . ');"' : ''; ?>></div>
  <div class="hero-overlay solutions-hero__overlay"></div>

  <div class="solutions-hero__inner">
    <?php if (!empty($label)) : ?>
      <span class="solutions-hero__eyebrow">
        <?php echo esc_html($label); ?>
      </span>
    <?php endif; ?>

    <?php if (!empty($headline)) : ?>
      <h1 class="Hero-H1 solutions-hero__headline">
        <?php echo esc_html($headline); ?>
      </h1>
    <?php endif; ?>

    <?php if (!empty($description)) : ?>
      <p class="Hero-Body solutions-hero__description">
        <?php echo wp_kses_post($description); ?>
      </p>
    <?php endif; ?>

    <?php if (!empty($button_text)) : ?>
      <a class="One-Column-Learn-More-Button solutions-hero__cta" href="<?php echo esc_url($button_link); ?>">
        <?php echo esc_html($button_text); ?>
      </a>
    <?php endif; ?>
  </div>
</section>
