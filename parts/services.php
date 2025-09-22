<?php
  $services_title = get_theme_mod('services_title', __('Tailored to Your Needs', 'figma-rebuild'));
  $services_paragraph = get_theme_mod('services_paragraph', __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.', 'figma-rebuild'));
  $services_bg_image = get_theme_mod('services_bg_image', '');
  $services_section_style = '';

  if ($services_bg_image) {
    $services_section_style = sprintf(' style="background-image:url(%s);"', esc_url($services_bg_image));
  }

  $services_defaults = [
    'ev'   => [
      'title' => __('EV Charger', 'figma-rebuild'),
      'image' => get_template_directory_uri() . '/src/images/maxperr_smart_30kW.png',
      'link'  => '/products/ev-charger',
    ],
    'home' => [
      'title' => __('Home Energy', 'figma-rebuild'),
      'image' => get_template_directory_uri() . '/src/images/maxperr_home_10kW.png',
      'link'  => '/products/home-energy',
    ],
  ];

  $services_ev_title = get_theme_mod('services_ev_title', $services_defaults['ev']['title']);
  $services_ev_image = get_theme_mod('services_ev_image', $services_defaults['ev']['image']);
  $services_home_title = get_theme_mod('services_home_title', $services_defaults['home']['title']);
  $services_home_image = get_theme_mod('services_home_image', $services_defaults['home']['image']);

  $services_ev_image = $services_ev_image ?: $services_defaults['ev']['image'];
  $services_home_image = $services_home_image ?: $services_defaults['home']['image'];
?>

<section class="catalog" id="service"<?php echo $services_section_style; ?>>
  <div class="catalog__container">

    <!-- 顶部：左文案 + 右上按钮 -->
    <div class="catalog__head">
      <div class="catalog__copy">
        <?php if ($services_title) : ?>
          <h2 class="catalog__title"><?php echo esc_html($services_title); ?></h2>
        <?php endif; ?>
        <?php if ($services_paragraph) : ?>
          <p class="catalog__desc">
            <?php echo wp_kses_post($services_paragraph); ?>
          </p>
        <?php endif; ?>
      </div>
      <a href="/shop" class="One-Column-Shop-All-Button">Shop All</a>
    </div>

    <!-- 两列卡片 -->
    <div class="catalog__grid">
      <!-- EV Charger -->
      <article class="catalog-card">
        <?php if ($services_ev_image) : ?>
          <img class="catalog-card__img"
               src="<?php echo esc_url($services_ev_image); ?>"
               alt="<?php echo esc_attr($services_ev_title ?: $services_defaults['ev']['title']); ?>">
        <?php endif; ?>
        <?php if ($services_ev_title) : ?>
          <h3 class="catalog-card__title"><?php echo esc_html($services_ev_title); ?></h3>
        <?php endif; ?>
        <a href="<?php echo esc_url($services_defaults['ev']['link']); ?>" class="catalog-card__btn">Learn More</a>
      </article>

      <!-- Home Energy -->
      <article class="catalog-card">
        <?php if ($services_home_image) : ?>
          <img class="catalog-card__img"
               src="<?php echo esc_url($services_home_image); ?>"
               alt="<?php echo esc_attr($services_home_title ?: $services_defaults['home']['title']); ?>">
        <?php endif; ?>
        <?php if ($services_home_title) : ?>
          <h3 class="catalog-card__title"><?php echo esc_html($services_home_title); ?></h3>
        <?php endif; ?>
        <a href="<?php echo esc_url($services_defaults['home']['link']); ?>" class="catalog-card__btn">Learn More</a>
      </article>
    </div>

  </div>
</section>
