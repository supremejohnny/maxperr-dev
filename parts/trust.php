<?php
  $trust_title = get_theme_mod('trust_title', __('Trusted by 3000+', 'figma-rebuild'));
  $trust_paragraph = get_theme_mod('trust_paragraph', __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.', 'figma-rebuild'));
  $trust_bg_image = get_theme_mod('trust_bg_image', 'https://images.unsplash.com/photo-1449824913935-59a10b8d2000?auto=format&fit=crop&w=2070&q=80');
  $trust_back_title = get_theme_mod('trust_back_title', __('-50% Charging Cost!', 'figma-rebuild'));
  $trust_back_paragraph = get_theme_mod('trust_back_paragraph', __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'figma-rebuild'));
  $trust_back_author = get_theme_mod('trust_back_author', __('Josh Q. / JQ Builder', 'figma-rebuild'));
  $trust_front_title = get_theme_mod('trust_front_title', __('Amazing ROI!', 'figma-rebuild'));
  $trust_front_paragraph = get_theme_mod('trust_front_paragraph', __('Installation was seamless and support is outstanding. We track usage remotely and save every month.', 'figma-rebuild'));
  $trust_front_author = get_theme_mod('trust_front_author', __('Mia L. / Studio Élan', 'figma-rebuild'));

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
          <?php if ($trust_back_title) : ?>
            <div class="testimony-heading"><?php echo esc_html($trust_back_title); ?></div>
          <?php endif; ?>
          <?php if ($trust_back_paragraph) : ?>
            <p class="testimony-body"><?php echo wp_kses_post($trust_back_paragraph); ?></p>
          <?php endif; ?>
          <?php if ($trust_back_author) : ?>
            <div class="testimony-author" style="text-align: right;">
              <?php echo $format_author($trust_back_author); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </div>
          <?php endif; ?>
        </article>

        <!-- Front (当前显示) -->
        <article class="testimony-card is-front" data-role="front">
          <button class="testimony-next" type="button" aria-label="Next testimony" data-next>
            <!-- 右箭头 -->
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6-6 6"/></svg>
          </button>
          <div class="testimony-quote">”</div>
          <?php if ($trust_front_title) : ?>
            <div class="testimony-heading"><?php echo esc_html($trust_front_title); ?></div>
          <?php endif; ?>
          <?php if ($trust_front_paragraph) : ?>
            <p class="testimony-body"><?php echo wp_kses_post($trust_front_paragraph); ?></p>
          <?php endif; ?>
          <?php if ($trust_front_author) : ?>
            <div class="testimony-author" style="text-align: right;">
              <?php echo $format_author($trust_front_author); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </div>
          <?php endif; ?>
        </article>
      </div>
    </div>
  </div>

  <!-- Partners slider -->
  <div class="testimony__container testimony-partners">
    <h3 class="testimony-partners__title">Proud Partners</h3>

    <div class="testimony-marquee">
      <!-- 轨道内重复两遍以实现无缝滚动 -->
      <div class="testimony-track">
        <div class="testimony-logo">Partner 1</div>
        <div class="testimony-logo">Partner 2</div>
        <div class="testimony-logo">Partner 3</div>
        <div class="testimony-logo">Partner 4</div>
        <div class="testimony-logo">Partner 5</div>
        <div class="testimony-logo">Partner 6</div>

        <div class="testimony-logo">Partner 1</div>
        <div class="testimony-logo">Partner 2</div>
        <div class="testimony-logo">Partner 3</div>
        <div class="testimony-logo">Partner 4</div>
        <div class="testimony-logo">Partner 5</div>
        <div class="testimony-logo">Partner 6</div>
      </div>
    </div>
  </div>
</section>

