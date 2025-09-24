<?php
/**
 * Partnership Hero Section
 */

$headline = get_theme_mod('partnership_hero_headline', 'Partner With Us');
$description = get_theme_mod('partnership_hero_description', 'We are committed to accelerating the adoption of electric vehicles by making charging infrastructure more efficient and widespread.');
$button_text = get_theme_mod('partnership_hero_button_text', __('Learn More', 'figma-rebuild'));
$button_link = get_theme_mod('partnership_hero_button_link', '#partnership-content');

$template_uri = get_template_directory_uri();
$hero_background = get_theme_mod(
  'partnership_hero_bg_image',
  $template_uri . '/src/images/bg_house2.jpg'
);
?>

<section class="hero-section subpage-hero relative overflow-hidden w-full" id="partnership-hero">
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

  </div>
</section>

