<?php
  $defaults = function_exists('figma_rebuild_get_solutions_defaults') ? figma_rebuild_get_solutions_defaults() : [];
  $services_defaults = isset($defaults['services']) ? $defaults['services'] : [];

  $title = get_theme_mod('solutions_services_title', isset($services_defaults['title']) ? $services_defaults['title'] : '');
  $description = get_theme_mod('solutions_services_description', isset($services_defaults['description']) ? $services_defaults['description'] : '');
  $items = function_exists('figma_rebuild_get_repeater_mod')
    ? figma_rebuild_get_repeater_mod('solutions_services_items', isset($services_defaults['items']) ? $services_defaults['items'] : [])
    : [];
?>

<section class="bg-gray-50 py-20" id="solutions-services">
  <div class="mx-auto max-w-6xl px-4 sm:px-6">
    <div class="mx-auto max-w-3xl text-center">
      <?php if (!empty($title)) : ?>
        <h2 class="text-3xl font-semibold text-slate-900 md:text-4xl">
          <?php echo esc_html($title); ?>
        </h2>
      <?php endif; ?>

      <?php if (!empty($description)) : ?>
        <p class="mt-4 text-lg leading-relaxed text-gray-600">
          <?php echo wp_kses_post($description); ?>
        </p>
      <?php endif; ?>
    </div>

    <?php if (!empty($items)) : ?>
      <div class="mt-12 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        <?php foreach ($items as $card) :
          $card_label = isset($card['label']) ? $card['label'] : '';
          $card_title = isset($card['title']) ? $card['title'] : '';
          $card_description = isset($card['description']) ? $card['description'] : '';
          $card_image = isset($card['image']) ? $card['image'] : '';
          $card_link_label = isset($card['link_label']) ? $card['link_label'] : '';
          $card_link_url = isset($card['link_url']) ? $card['link_url'] : '';
        ?>
          <article class="group flex h-full flex-col overflow-hidden rounded-3xl border border-white/40 bg-white shadow-[0_20px_60px_-30px_rgba(15,23,42,0.3)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_30px_70px_-30px_rgba(15,23,42,0.35)]">
            <?php if (!empty($card_image)) : ?>
              <div class="relative aspect-[4/3] overflow-hidden">
                <img src="<?php echo esc_url($card_image); ?>" alt="" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy" />
              </div>
            <?php endif; ?>
            <div class="flex flex-1 flex-col gap-4 px-6 pb-6 pt-6">
              <?php if (!empty($card_label)) : ?>
                <span class="inline-flex w-fit items-center rounded-full bg-primary-light/60 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-primary">
                  <?php echo esc_html($card_label); ?>
                </span>
              <?php endif; ?>

              <?php if (!empty($card_title)) : ?>
                <h3 class="text-xl font-semibold text-slate-900">
                  <?php echo esc_html($card_title); ?>
                </h3>
              <?php endif; ?>

              <?php if (!empty($card_description)) : ?>
                <p class="text-sm leading-relaxed text-gray-600">
                  <?php echo wp_kses_post($card_description); ?>
                </p>
              <?php endif; ?>

              <?php if (!empty($card_link_label) && !empty($card_link_url)) : ?>
                <div class="mt-auto pt-2">
                  <a class="inline-flex items-center gap-2 text-sm font-semibold text-primary transition hover:text-primary-dark" href="<?php echo esc_url($card_link_url); ?>">
                    <?php echo esc_html($card_link_label); ?>
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                      <path d="M5 10h8m0 0-3-3m3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
