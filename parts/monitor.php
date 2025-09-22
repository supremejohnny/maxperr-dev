<?php
  $monitor_title = get_theme_mod('monitor_title', __('Monitor from Afar', 'figma-rebuild'));
  $monitor_paragraph = get_theme_mod('monitor_paragraph', __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'figma-rebuild'));
  $monitor_row1_title = get_theme_mod('monitor_row1_title', __('Charger Management', 'figma-rebuild'));
  $monitor_row1_paragraph = get_theme_mod('monitor_row1_paragraph', __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', 'figma-rebuild'));
  $monitor_row1_image = get_theme_mod('monitor_row1_image', get_template_directory_uri() . '/src/images/ev_app_control.jpg');
  $monitor_row2_title = get_theme_mod('monitor_row2_title', __('Driver App', 'figma-rebuild'));
  $monitor_row2_paragraph = get_theme_mod('monitor_row2_paragraph', __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'figma-rebuild'));
  $monitor_row2_image = get_theme_mod('monitor_row2_image', get_template_directory_uri() . '/src/images/ev_nav_map.jpg');
?>

<section class="monitor" id="monitor">
  <div class="monitor__container">

    <!-- 顶部：左文案 + 右上按钮 -->
    <div class="monitor__head">
      <div class="monitor__copy">
        <?php if ($monitor_title) : ?>
          <h2 class="monitor__title"><?php echo esc_html($monitor_title); ?></h2>
        <?php endif; ?>
        <?php if ($monitor_paragraph) : ?>
          <p class="monitor__desc">
            <?php echo wp_kses_post($monitor_paragraph); ?>
          </p>
        <?php endif; ?>
      </div>
      <a href="/shop" class="One-Column-Shop-All-Button">Shop All</a>
    </div>

    <!-- 行 1：左文案 / 右图片 -->
    <div class="monitor-row">
      <div class="monitor-copy">
        <?php if ($monitor_row1_title) : ?>
          <h3><?php echo esc_html($monitor_row1_title); ?></h3>
        <?php endif; ?>
        <?php if ($monitor_row1_paragraph) : ?>
          <p>
            <?php echo wp_kses_post($monitor_row1_paragraph); ?>
          </p>
        <?php endif; ?>
        <a class="btn-outline" href="/solutions/charger-management">Learn More</a>
      </div>
      <figure class="monitor-media">
        <img src="<?php echo esc_url($monitor_row1_image); ?>"
             alt="Charger management app">
      </figure>
    </div>

    <!-- 行 2：左图片 / 右文案 -->
    <div class="monitor-row">
      <figure class="monitor-media">
        <img src="<?php echo esc_url($monitor_row2_image); ?>"
             alt="Driver app in car">
      </figure>
      <div class="monitor-copy">
        <?php if ($monitor_row2_title) : ?>
          <h3><?php echo esc_html($monitor_row2_title); ?></h3>
        <?php endif; ?>
        <?php if ($monitor_row2_paragraph) : ?>
          <p>
            <?php echo wp_kses_post($monitor_row2_paragraph); ?>
          </p>
        <?php endif; ?>
        <a class="btn-outline" href="/solutions/driver-app">Learn More</a>
      </div>
    </div>

  </div>
</section>
