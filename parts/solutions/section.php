<?php
  $section_key = isset($args['section']) ? $args['section'] : 'home';
  $layout = isset($args['layout']) ? $args['layout'] : 'image-left';
  $is_image_right = ('image-right' === $layout);

  $defaults = function_exists('figma_rebuild_get_solutions_defaults') ? figma_rebuild_get_solutions_defaults() : [];
  $section_defaults = isset($defaults[$section_key]) ? $defaults[$section_key] : [];

  $heading = get_theme_mod('solutions_' . $section_key . '_heading', isset($section_defaults['heading']) ? $section_defaults['heading'] : '');
  $intro = get_theme_mod('solutions_' . $section_key . '_intro', isset($section_defaults['intro']) ? $section_defaults['intro'] : '');
  $badge = get_theme_mod('solutions_' . $section_key . '_badge', isset($section_defaults['badge']) ? $section_defaults['badge'] : '');
  $card_title = get_theme_mod('solutions_' . $section_key . '_card_title', isset($section_defaults['card_title']) ? $section_defaults['card_title'] : '');
  $card_body = get_theme_mod('solutions_' . $section_key . '_card_body', isset($section_defaults['card_body']) ? $section_defaults['card_body'] : '');
  $note = get_theme_mod('solutions_' . $section_key . '_note', isset($section_defaults['note']) ? $section_defaults['note'] : '');
  $button_text = get_theme_mod('solutions_' . $section_key . '_button_text', isset($section_defaults['button_text']) ? $section_defaults['button_text'] : '');
  $button_link = get_theme_mod('solutions_' . $section_key . '_button_link', isset($section_defaults['button_link']) ? $section_defaults['button_link'] : '');
  $image = get_theme_mod('solutions_' . $section_key . '_image', isset($section_defaults['image']) ? $section_defaults['image'] : '');

  $features = function_exists('figma_rebuild_get_repeater_mod')
    ? figma_rebuild_get_repeater_mod('solutions_' . $section_key . '_features', isset($section_defaults['features']) ? $section_defaults['features'] : [])
    : [];

  $section_id = 'solutions-' . sanitize_title($section_key);
?>

<section class="bg-white py-20" id="<?php echo esc_attr($section_id); ?>">
  <div class="mx-auto max-w-6xl px-4 sm:px-6">
    <div class="flex flex-col gap-12 lg:gap-16 lg:items-center <?php echo $is_image_right ? 'lg:flex-row-reverse' : 'lg:flex-row'; ?>">
      <div class="w-full flex-1 space-y-8">
        <?php if (!empty($heading)) : ?>
          <div class="space-y-3">
            <h2 class="text-3xl font-semibold text-slate-900 md:text-4xl">
              <?php echo esc_html($heading); ?>
            </h2>
            <?php if (!empty($intro)) : ?>
              <p class="max-w-2xl text-lg leading-relaxed text-gray-600">
                <?php echo wp_kses_post($intro); ?>
              </p>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <div class="overflow-hidden rounded-3xl border border-gray-100 bg-white/90 p-8 shadow-[0_30px_60px_-35px_rgba(15,23,42,0.35)] backdrop-blur">
          <div class="flex flex-wrap items-center justify-between gap-4">
            <?php if (!empty($badge)) : ?>
              <span class="inline-flex items-center rounded-full bg-primary-light px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-primary">
                <?php echo esc_html($badge); ?>
              </span>
            <?php endif; ?>
          </div>

          <?php if (!empty($card_title)) : ?>
            <h3 class="mt-6 text-2xl font-semibold text-slate-900">
              <?php echo esc_html($card_title); ?>
            </h3>
          <?php endif; ?>

          <?php if (!empty($card_body)) : ?>
            <p class="mt-3 text-base leading-relaxed text-gray-600">
              <?php echo wp_kses_post($card_body); ?>
            </p>
          <?php endif; ?>

          <?php if (!empty($features)) : ?>
            <ul class="mt-6 space-y-3">
              <?php foreach ($features as $feature) :
                $feature_text = isset($feature['text']) ? $feature['text'] : '';
                if (empty($feature_text)) {
                  continue;
                }
              ?>
                <li class="flex items-start gap-3 text-sm font-medium text-slate-900">
                  <span class="mt-1 inline-flex h-5 w-5 flex-none items-center justify-center rounded-full bg-primary/10 text-primary">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                      <path d="M4 8.5 6.667 11 12 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </span>
                  <span class="leading-relaxed text-gray-700">
                    <?php echo esc_html($feature_text); ?>
                  </span>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>

          <?php if (!empty($note)) : ?>
            <p class="mt-6 text-sm text-gray-500">
              <?php echo wp_kses_post($note); ?>
            </p>
          <?php endif; ?>

          <?php if (!empty($button_text) && !empty($button_link)) : ?>
            <div class="mt-8">
              <a href="<?php echo esc_url($button_link); ?>" class="inline-flex items-center justify-center rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-primary/30 transition hover:bg-primary-dark">
                <?php echo esc_html($button_text); ?>
              </a>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <?php if (!empty($image)) : ?>
        <div class="w-full flex-1 overflow-hidden rounded-3xl shadow-[0_40px_90px_-40px_rgba(15,23,42,0.45)]">
          <img src="<?php echo esc_url($image); ?>" alt="" class="h-full w-full object-cover" loading="lazy" />
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
