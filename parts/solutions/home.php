<?php
  if (!function_exists('figma_rebuild_get_solutions_section_data')) {
    return;
  }

  $section = figma_rebuild_get_solutions_section_data('home');

  if (empty($section)) {
    return;
  }

  $section_id = !empty($section['section_id']) ? $section['section_id'] : 'solutions-home';
  $image = isset($section['image']) ? $section['image'] : '';

  $features = [];
  if (!empty($section['features']) && is_array($section['features'])) {
    foreach ($section['features'] as $feature) {
      $feature_text = isset($feature['text']) ? trim(wp_strip_all_tags($feature['text'])) : '';
      if ('' !== $feature_text) {
        $features[] = $feature_text;
      }
    }
  }

  $accordion_items = [];

  if (!empty($section['card_body'])) {
    $accordion_items[] = [
      'title'   => __('Overview', 'figma-rebuild'),
      'type'    => 'content',
      'content' => $section['card_body'],
    ];
  }

  if (!empty($features)) {
    $accordion_items[] = [
      'title'   => __('Key features', 'figma-rebuild'),
      'type'    => 'features',
      'content' => $features,
    ];
  }

  if (!empty($section['note'])) {
    $accordion_items[] = [
      'title'   => __('Best for', 'figma-rebuild'),
      'type'    => 'note',
      'content' => $section['note'],
    ];
  }

  $accordion_group_id = function_exists('wp_unique_id') ? wp_unique_id($section_id . '-accordion-') : $section_id . '-accordion';
?>

<section class="bg-white py-20" id="<?php echo esc_attr($section_id); ?>">
  <div class="mx-auto max-w-6xl px-4 sm:px-6">
    <div class="flex flex-col gap-12 lg:gap-16 lg:items-center lg:flex-row">
      <div class="w-full flex-1 space-y-8">
        <?php if (!empty($section['heading'])) : ?>
          <div class="space-y-3">
            <h2 class="text-3xl font-semibold text-slate-900 md:text-4xl">
              <?php echo esc_html($section['heading']); ?>
            </h2>
            <?php if (!empty($section['intro'])) : ?>
              <p class="max-w-2xl text-lg leading-relaxed text-gray-600">
                <?php echo wp_kses_post($section['intro']); ?>
              </p>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <div class="overflow-hidden rounded-3xl border border-gray-100 bg-white/90 p-8 shadow-[0_30px_60px_-35px_rgba(15,23,42,0.35)] backdrop-blur">
          <div class="flex flex-wrap items-center justify-between gap-4">
            <?php if (!empty($section['badge'])) : ?>
              <span class="inline-flex items-center rounded-full bg-primary-light px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-primary">
                <?php echo esc_html($section['badge']); ?>
              </span>
            <?php endif; ?>
          </div>

          <?php if (!empty($section['card_title'])) : ?>
            <h3 class="mt-6 text-2xl font-semibold text-slate-900">
              <?php echo esc_html($section['card_title']); ?>
            </h3>
          <?php endif; ?>

          <?php if (!empty($accordion_items)) : ?>
            <div class="mt-6 space-y-4" data-accordion-group>
              <?php foreach ($accordion_items as $index => $item) :
                $is_open = (0 === $index);
                $panel_id = $accordion_group_id . '-panel-' . $index;
                $button_id = $accordion_group_id . '-trigger-' . $index;
              ?>
                <div class="rounded-2xl border border-gray-200 bg-white/80" data-accordion-item>
                  <button
                    type="button"
                    class="flex w-full items-center justify-between gap-3 px-5 py-4 text-left text-base font-semibold text-slate-900"
                    data-accordion-trigger
                    id="<?php echo esc_attr($button_id); ?>"
                    aria-controls="<?php echo esc_attr($panel_id); ?>"
                    aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>"
                  >
                    <span><?php echo esc_html($item['title']); ?></span>
                    <svg class="h-5 w-5 text-primary transition-transform duration-300 <?php echo $is_open ? 'rotate-180' : ''; ?>" data-accordion-icon viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                      <path d="M5 7.5 10 12.5 15 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </button>
                  <div
                    id="<?php echo esc_attr($panel_id); ?>"
                    class="px-5 pb-5 text-sm leading-relaxed text-gray-600"
                    data-accordion-panel
                    aria-labelledby="<?php echo esc_attr($button_id); ?>"
                    <?php echo $is_open ? '' : 'hidden'; ?>
                  >
                    <?php if ('features' === $item['type']) : ?>
                      <ul class="space-y-2 text-gray-700">
                        <?php foreach ($item['content'] as $feature_text) : ?>
                          <li class="flex items-start gap-3">
                            <span class="mt-1 inline-flex h-5 w-5 flex-none items-center justify-center rounded-full bg-primary/10 text-primary">
                              <svg class="h-3.5 w-3.5" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M4 8.5 6.667 11 12 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                            </span>
                            <span><?php echo esc_html($feature_text); ?></span>
                          </li>
                        <?php endforeach; ?>
                      </ul>
                    <?php elseif ('note' === $item['type']) : ?>
                      <p class="text-gray-500">
                        <?php echo wp_kses_post($item['content']); ?>
                      </p>
                    <?php else : ?>
                      <p>
                        <?php echo wp_kses_post($item['content']); ?>
                      </p>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <?php if (!empty($section['button_text']) && !empty($section['button_link'])) : ?>
            <div class="mt-8">
              <a href="<?php echo esc_url($section['button_link']); ?>" class="inline-flex items-center justify-center rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-primary/30 transition hover:bg-primary-dark">
                <?php echo esc_html($section['button_text']); ?>
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
