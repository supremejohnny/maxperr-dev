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

<style>
  body, html {
    overflow-x: hidden !important;
    max-width: 100vw !important;
    color: #000;
  }
  #solutions-zevip {
    overflow-x: hidden !important;
    max-width: 100vw !important;
    color: #000;
  }
  #solutions-zevip .Body-1 {
    color: #000;
  }
</style>

<section class="bg-white py-24" id="solutions-zevip" style="overflow-x: hidden; width: 100%; max-width: 100vw;">
  <div class="mx-auto px-4 sm:px-6" style="max-width: clamp(320px, 90vw, 1572px); width: 100%; box-sizing: border-box;">
    <div style="display: flex; align-items: center; min-height: clamp(400px, 40vw, 629px); gap: clamp(20px, 5vw, 97px); width: 100%; box-sizing: border-box;">
      <div class="space-y-6" style="flex: 0 0 clamp(300px, 35%, 530px); min-width: 0; box-sizing: border-box;">
        <?php if (!empty($heading)) : ?>
          <h2 class="H2-Black">
            <?php echo esc_html($heading); ?>
          </h2>
        <?php endif; ?>

        <?php if (!empty($intro)) : ?>
          <p class="Body-1">
            <?php echo wp_kses_post($intro); ?>
          </p>
        <?php endif; ?>

        <?php if (!empty($button_text) && !empty($button_link)) : ?>
          <div class="pt-4">
            <a href="<?php echo esc_url($button_link); ?>" class="One-Column-Learn-More-Button">
              <?php echo esc_html($button_text); ?>
            </a>
          </div>
        <?php endif; ?>
      </div>

      <?php if (!empty($image)) : ?>
        <div class="overflow-hidden rounded-3xl" style="flex: 1; height: clamp(200px, 40vw, 629px); min-width: 0; box-sizing: border-box; display: flex; align-items: center; justify-content: center;">
          <img src="<?php echo esc_url($image); ?>" alt="" style="width: 100%; height: 100%; object-fit: contain; object-position: center; max-width: none; max-height: none;" loading="lazy" />
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
