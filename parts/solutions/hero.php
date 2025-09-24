<?php
  $defaults = function_exists('figma_rebuild_get_solutions_defaults') ? figma_rebuild_get_solutions_defaults() : [];
  $hero_defaults = isset($defaults['hero']) ? $defaults['hero'] : [];

  $title = get_theme_mod('solutions_hero_title', isset($hero_defaults['title']) ? $hero_defaults['title'] : '');
  $headline = get_theme_mod('solutions_hero_headline', isset($hero_defaults['headline']) ? $hero_defaults['headline'] : '');
  $description = get_theme_mod('solutions_hero_description', isset($hero_defaults['description']) ? $hero_defaults['description'] : '');
  $background = get_theme_mod('solutions_hero_background', isset($hero_defaults['background']) ? $hero_defaults['background'] : '');
?>

<section class="relative isolate overflow-hidden bg-slate-900" id="solutions-hero">
  <?php if (!empty($background)) : ?>
    <div class="absolute inset-0">
      <img src="<?php echo esc_url($background); ?>" alt="" class="h-full w-full object-cover" loading="lazy" />
      <div class="absolute inset-0 bg-slate-900/70 mix-blend-multiply"></div>
      <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-slate-900"></div>
    </div>
  <?php endif; ?>

  <div class="relative mx-auto flex max-w-6xl flex-col gap-6 px-4 py-24 sm:px-6 md:py-28 lg:py-32">
    <?php if (!empty($title)) : ?>
      <span class="inline-flex w-fit items-center rounded-full bg-white/10 px-4 py-1 text-sm font-semibold uppercase tracking-[0.2em] text-primary-light backdrop-blur">
        <?php echo esc_html($title); ?>
      </span>
    <?php endif; ?>

    <?php if (!empty($headline)) : ?>
      <h1 class="text-4xl font-semibold leading-tight text-white md:text-5xl lg:text-[56px] lg:leading-[1.05]">
        <?php echo esc_html($headline); ?>
      </h1>
    <?php endif; ?>

    <?php if (!empty($description)) : ?>
      <p class="max-w-3xl text-lg leading-relaxed text-gray-200">
        <?php echo wp_kses_post($description); ?>
      </p>
    <?php endif; ?>
  </div>
</section>
