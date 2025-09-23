<?php
  $defaults = function_exists('figma_rebuild_get_solutions_defaults') ? figma_rebuild_get_solutions_defaults() : [];
  $book_defaults = isset($defaults['book']) ? $defaults['book'] : [];

  $title = get_theme_mod('solutions_book_title', isset($book_defaults['title']) ? $book_defaults['title'] : '');
  $description = get_theme_mod('solutions_book_description', isset($book_defaults['description']) ? $book_defaults['description'] : '');
  $background = get_theme_mod('solutions_book_background', isset($book_defaults['background']) ? $book_defaults['background'] : '');
  $cards = function_exists('figma_rebuild_get_repeater_mod')
    ? figma_rebuild_get_repeater_mod('solutions_book_cards', isset($book_defaults['cards']) ? $book_defaults['cards'] : [])
    : [];
?>

<section class="relative isolate overflow-hidden bg-slate-900 py-24" id="solutions-contact">
  <?php if (!empty($background)) : ?>
    <div class="absolute inset-0">
      <img src="<?php echo esc_url($background); ?>" alt="" class="h-full w-full object-cover" loading="lazy" />
      <div class="absolute inset-0 bg-slate-900/80"></div>
    </div>
  <?php endif; ?>

  <div class="relative mx-auto max-w-6xl px-4 sm:px-6">
    <div class="grid gap-10 lg:grid-cols-[1.1fr_1fr] lg:items-start">
      <div class="space-y-6">
        <?php if (!empty($title)) : ?>
          <h2 class="text-3xl font-semibold text-white md:text-4xl">
            <?php echo esc_html($title); ?>
          </h2>
        <?php endif; ?>

        <?php if (!empty($description)) : ?>
          <p class="text-lg leading-relaxed text-gray-200">
            <?php echo wp_kses_post($description); ?>
          </p>
        <?php endif; ?>

        <div class="mt-6 inline-flex flex-wrap gap-3 text-sm text-gray-300">
          <span class="rounded-full border border-white/15 px-4 py-2">
            <?php esc_html_e('Consulting', 'figma-rebuild'); ?>
          </span>
          <span class="rounded-full border border-white/15 px-4 py-2">
            <?php esc_html_e('Deployment', 'figma-rebuild'); ?>
          </span>
          <span class="rounded-full border border-white/15 px-4 py-2">
            <?php esc_html_e('Support', 'figma-rebuild'); ?>
          </span>
        </div>
      </div>

      <?php if (!empty($cards)) : ?>
        <div class="grid gap-6 sm:grid-cols-2">
          <?php foreach ($cards as $card) :
            $card_title = isset($card['title']) ? $card['title'] : '';
            $card_description = isset($card['description']) ? $card['description'] : '';
            $card_cta_label = isset($card['cta_label']) ? $card['cta_label'] : '';
            $card_cta_url = isset($card['cta_url']) ? $card['cta_url'] : '';
          ?>
            <div class="flex h-full flex-col gap-4 rounded-3xl bg-white/95 p-6 shadow-[0_35px_80px_-40px_rgba(15,23,42,0.45)] backdrop-blur">
              <?php if (!empty($card_title)) : ?>
                <h3 class="text-lg font-semibold text-slate-900">
                  <?php echo esc_html($card_title); ?>
                </h3>
              <?php endif; ?>

              <?php if (!empty($card_description)) : ?>
                <p class="text-sm leading-relaxed text-gray-600">
                  <?php echo wp_kses_post($card_description); ?>
                </p>
              <?php endif; ?>

              <?php if (!empty($card_cta_label)) : ?>
                <div class="mt-auto pt-2">
                  <?php if (!empty($card_cta_url)) : ?>
                    <a href="<?php echo esc_url($card_cta_url); ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-primary transition hover:text-primary-dark">
                      <?php echo esc_html($card_cta_label); ?>
                      <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M5 10h8m0 0-3-3m3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                    </a>
                  <?php else : ?>
                    <span class="text-sm font-semibold text-slate-900">
                      <?php echo esc_html($card_cta_label); ?>
                    </span>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
