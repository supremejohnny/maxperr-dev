<?php
  $trust_title = get_theme_mod('trust_title', __('Trusted by 3000+', 'figma-rebuild'));
  $trust_paragraph = get_theme_mod('trust_paragraph', __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.', 'figma-rebuild'));
  $trust_bg_image = get_theme_mod('trust_bg_image', 'https://images.unsplash.com/photo-1449824913935-59a10b8d2000?auto=format&fit=crop&w=2070&q=80');

  $testimonials_default = figma_rebuild_get_default_testimonials();
  $testimonials_raw = get_theme_mod('trust_testimonials', wp_json_encode($testimonials_default));
  $trust_testimonials = json_decode($testimonials_raw, true);
  if (!is_array($trust_testimonials) || empty($trust_testimonials)) {
    $trust_testimonials = $testimonials_default;
  }

  $partners_default = figma_rebuild_get_default_partners();
  $partners_raw = get_theme_mod('trust_partners', wp_json_encode($partners_default));
  $trust_partners = json_decode($partners_raw, true);
  if (!is_array($trust_partners)) {
    $trust_partners = $partners_default;
  }

  $trust_partners = array_values(array_filter($trust_partners, function ($partner) {
    if (!is_array($partner)) {
      return false;
    }

    $label = isset($partner['label']) ? trim((string) $partner['label']) : '';
    $logo = isset($partner['logo']) ? trim((string) $partner['logo']) : '';

    return $label !== '' || $logo !== '';
  }));

  $front_testimonial = isset($trust_testimonials[0]) && is_array($trust_testimonials[0]) ? $trust_testimonials[0] : [];
  $back_testimonial = isset($trust_testimonials[1]) && is_array($trust_testimonials[1]) ? $trust_testimonials[1] : $front_testimonial;

  $format_author = function ($author_string) {
    if (empty($author_string)) {
      return '';
    }

    $parts = array_map('trim', explode('/', $author_string, 2));
    $output = esc_html($parts[0]);

    if (!empty($parts[1])) {
      $output .= ' <span style="color:#94A3B8;font-weight:700;">' . esc_html($parts[1]) . '</span>';
    }

    return $output;
  };
?>

<section class="testimony" id="testimony">
  <!-- Head -->
  <div class="testimony__container testimony__head">
    <?php if ($trust_title) : ?>
      <h2 class="testimony__title"><?php echo esc_html($trust_title); ?></h2>
    <?php endif; ?>
    <?php if ($trust_paragraph) : ?>
      <p class="testimony__lead">
        <?php echo wp_kses_post($trust_paragraph); ?>
      </p>
    <?php endif; ?>
  </div>

  <!-- 背景图 + 卡片堆叠 -->
  <div class="testimony-hero">
    <div class="testimony-hero__bg">
      <?php if ($trust_bg_image) : ?>
        <img src="<?php echo esc_url($trust_bg_image); ?>" alt="EV charging at home">
      <?php endif; ?>
      <div class="testimony-hero__overlay"></div>
    </div>

    <div class="testimony__container testimony-hero__inner">
      <div class="testimony-stack" data-testimony>
        <!-- Back (上一张的预览) -->
        <article class="testimony-card is-back" data-role="back">
          <div class="testimony-quote">“</div>
          <div class="testimony-heading">
            <?php echo isset($back_testimonial['title']) ? esc_html($back_testimonial['title']) : ''; ?>
          </div>
          <p class="testimony-body">
            <?php echo isset($back_testimonial['body']) ? wp_kses_post($back_testimonial['body']) : ''; ?>
          </p>
          <div class="testimony-author" style="text-align: right;">
            <?php
              $author_value = isset($back_testimonial['author']) ? $back_testimonial['author'] : '';
              echo $author_value ? $format_author($author_value) : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            ?>
          </div>
        </article>

        <!-- Front (当前显示) -->
        <article class="testimony-card is-front" data-role="front">
          <button class="testimony-next" type="button" aria-label="Next testimony" data-next>
            <!-- 右箭头 -->
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6-6 6"/></svg>
          </button>
          <div class="testimony-quote">”</div>
          <div class="testimony-heading">
            <?php echo isset($front_testimonial['title']) ? esc_html($front_testimonial['title']) : ''; ?>
          </div>
          <p class="testimony-body">
            <?php echo isset($front_testimonial['body']) ? wp_kses_post($front_testimonial['body']) : ''; ?>
          </p>
          <div class="testimony-author" style="text-align: right;">
            <?php
              $author_value = isset($front_testimonial['author']) ? $front_testimonial['author'] : '';
              echo $author_value ? $format_author($author_value) : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            ?>
          </div>
        </article>
        <script type="application/json" data-testimony-source>
          <?php echo wp_json_encode($trust_testimonials); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        </script>
      </div>
    </div>
  </div>

  <!-- Partners slider -->
  <div class="testimony__container testimony-partners">
    <h3 class="testimony-partners__title">Proud Partners</h3>

    <div class="testimony-marquee">
      <!-- 轨道内重复两遍以实现无缝滚动 -->
      <div class="testimony-track">
        <?php if (!empty($trust_partners)) : ?>
          <?php for ($i = 0; $i < 2; $i++) : ?>
            <?php foreach ($trust_partners as $partner) :
              $partner_label = isset($partner['label']) ? trim((string) $partner['label']) : '';
              $partner_logo = isset($partner['logo']) ? trim((string) $partner['logo']) : '';

              if ($partner_logo === '' && $partner_label === '') {
                continue;
              }
            ?>
              <div class="testimony-logo">
                <?php if ($partner_logo) : ?>
                  <img src="<?php echo esc_url($partner_logo); ?>"
                       alt="<?php echo esc_attr($partner_label ?: __('Partner logo', 'figma-rebuild')); ?>">
                <?php elseif ($partner_label) : ?>
                  <?php echo esc_html($partner_label); ?>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          <?php endfor; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

