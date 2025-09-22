<?php
  $whyus_bg_image = get_theme_mod('whyus_bg_image', get_template_directory_uri() . '/src/images/bg_forest.jpg');
  $whyus_title = get_theme_mod('whyus_title', __('Why Us?', 'figma-rebuild'));
  $whyus_subtitle = get_theme_mod('whyus_subtitle', __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', 'figma-rebuild'));
  $whyus_kpi = get_theme_mod('whyus_kpi', '20%');
  $whyus_paragraph = get_theme_mod('whyus_paragraph', __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.', 'figma-rebuild'));
?>

<section class="whyus">
  <!-- Hero：森林大图 + 叠层渐变 -->
  <div class="whyus-hero">
    <div class="whyus-hero__bg"
         style="background-image:url('<?php echo esc_url($whyus_bg_image); ?>');">
    </div>
    <div class="whyus-hero__overlay"></div>

    <!-- 居中内容 -->
    <div class="whyus-hero__content">
      <?php if ($whyus_title) : ?>
        <h2 class="Hero-H2"><?php echo esc_html($whyus_title); ?></h2>
      <?php endif; ?>
      <?php if ($whyus_subtitle) : ?>
        <p class="whyus-Hero-Body">
          <?php echo wp_kses_post($whyus_subtitle); ?>
        </p>
      <?php endif; ?>
      <button class="One-Column-Book-Consultation-Button" style="margin-top:18px;">Book Consultation</button>
    </div>

    <!-- 条状分页（3条） -->
    <div class="whyus-hero__bars" aria-label="Hero pagination">
      <span class="whyus-bar is-active" role="button" aria-label="slide 1"></span>
      <span class="whyus-bar" role="button" aria-label="slide 2"></span>
      <span class="whyus-bar" role="button" aria-label="slide 3"></span>
    </div>
  </div>

  <!-- 下方内容：20% + 文案 -->
  <div class="whyus-content">
    <div class="whyus-grid">
      <div>
        <div class="whyus-accent"></div>
        <?php if ($whyus_kpi) : ?>
          <div class="whyus-kpi"><?php echo esc_html($whyus_kpi); ?></div>
        <?php endif; ?>
      </div>
      <div>
        <?php if ($whyus_paragraph) : ?>
          <p class="whyus-copy">
            <?php echo wp_kses_post($whyus_paragraph); ?>
          </p>
        <?php endif; ?>
      </div>
    </div>
  </div>

</section>
