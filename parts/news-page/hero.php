<?php
  $news_bg_image = get_theme_mod('news_bg_image', '');
  $news_subtitle = get_theme_mod('news_subtitle', __('All about our company and the EV Charging Industry.', 'figma-rebuild'));
  $fallback_image = get_template_directory_uri() . '/src/images/maxperr_expo.jpg';
  $background_image = $news_bg_image ?: $fallback_image;
?>

<section class="news-page-hero" style="background-image: url('<?php echo esc_url($background_image); ?>');">
  <div class="news-page-hero__overlay" aria-hidden="true"></div>
  <div class="news-page-hero__inner">
    <div class="container mx-auto px-6">
      <div class="news-page-hero__content">
        <h1 class="news-page-hero__title"><?php echo esc_html__('News', 'figma-rebuild'); ?></h1>
        <?php if ($news_subtitle) : ?>
          <p class="news-page-hero__subtitle"><?php echo wp_kses_post($news_subtitle); ?></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
