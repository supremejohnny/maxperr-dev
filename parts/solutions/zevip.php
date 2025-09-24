<?php
  $defaults = function_exists('figma_rebuild_get_solutions_defaults') ? figma_rebuild_get_solutions_defaults() : [];
  $zevip_defaults = isset($defaults['zevip']) ? $defaults['zevip'] : [];

  $heading = get_theme_mod('solutions_zevip_heading', isset($zevip_defaults['heading']) ? $zevip_defaults['heading'] : '');
  $intro = get_theme_mod('solutions_zevip_intro', isset($zevip_defaults['intro']) ? $zevip_defaults['intro'] : '');
  $features = function_exists('figma_rebuild_get_repeater_mod')
    ? figma_rebuild_get_repeater_mod('solutions_zevip_features', isset($zevip_defaults['features']) ? $zevip_defaults['features'] : [])
    : [];
  $button_text = get_theme_mod('solutions_zevip_button_text', isset($zevip_defaults['button_text']) ? $zevip_defaults['button_text'] : '');
  $button_link = get_theme_mod('solutions_zevip_button_link', isset($zevip_defaults['button_link']) ? $zevip_defaults['button_link'] : '');
  $image = get_theme_mod('solutions_zevip_image', isset($zevip_defaults['image']) ? $zevip_defaults['image'] : '');
?>

<section class="bg-white py-20" id="solutions-zevip">
  <div class="mx-auto max-w-6xl px-4 sm:px-6">
    <div class="grid gap-12 lg:grid-cols-2 lg:items-center">
      <div class="space-y-6">
        <?php if (!empty($heading)) : ?>
          <h2 class="text-3xl font-semibold text-slate-900 md:text-4xl">
            <?php echo esc_html($heading); ?>
          </h2>
        <?php endif; ?>

        <?php if (!empty($intro)) : ?>
          <p class="text-lg leading-relaxed text-gray-600">
            <?php echo wp_kses_post($intro); ?>
          </p>
        <?php endif; ?>

        <?php if (!empty($features)) : ?>
          <ul class="space-y-4">
            <?php foreach ($features as $feature) :
              $feature_text = isset($feature['text']) ? $feature['text'] : '';
              if (empty($feature_text)) {
                continue;
              }
            ?>
              <li class="flex items-start gap-3 text-base text-gray-700">
                <span class="mt-1 inline-flex h-6 w-6 flex-none items-center justify-center rounded-full bg-primary/15 text-primary">
                  <svg class="h-3.5 w-3.5" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M4 8.5 6.667 11 12 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </span>
                <span class="leading-relaxed">
                  <?php echo esc_html($feature_text); ?>
                </span>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <?php if (!empty($button_text) && !empty($button_link)) : ?>
          <div class="pt-4">
            <a href="<?php echo esc_url($button_link); ?>" class="inline-flex items-center justify-center rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-primary/30 transition hover:bg-primary-dark">
              <?php echo esc_html($button_text); ?>
            </a>
          </div>
        <?php endif; ?>
      </div>

      <?php if (!empty($image)) : ?>
        <div class="overflow-hidden rounded-3xl shadow-[0_40px_90px_-40px_rgba(15,23,42,0.45)]">
          <img src="<?php echo esc_url($image); ?>" alt="" class="h-full w-full object-cover" loading="lazy" />
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
