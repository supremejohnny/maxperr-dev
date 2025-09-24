<?php
  // 允许外部预先定义 $charger_products；没有就用默认
  if (!isset($charger_products) || !is_array($charger_products)) {
    $template_uri = get_template_directory_uri();
    $charger_products = [
      [
        'name'  => 'Eco 12kW AC',
        'price' => '$799',
        'image' => $template_uri . '/src/images/ev_charging_pic.jpg',
      ],
      [
        'name'  => 'Smart 30kW DC',
        'price' => '$0000',
        'image' => $template_uri . '/src/images/ev_app_control.jpg',
      ],
      [
        'name'  => 'Pro Series DC',
        'price' => '$0000',
        'image' => $template_uri . '/src/images/ev_fast_charger.jpg',
      ],
    ];
  }

  $section_id = 'charger-cards';
?>
<section id="<?php echo esc_attr($section_id); ?>" class="cc-wrap">
  <style>
    /* ===== Scoped styles (no Tailwind) ===== */
    body { overflow-x: hidden; }
    * { box-sizing: border-box; }
     #<?php echo esc_js($section_id); ?>.cc-wrap { padding: 50px 0 75px; background:#fff; width: 100%; }
    #<?php echo esc_js($section_id); ?> .cc-container { max-width: 1280px; margin: 0 auto; padding: 0 6px; box-sizing: border-box; width: 100%; }

    #<?php echo esc_js($section_id); ?> .cc-grid {
      display: grid; gap: 40px;
      grid-template-columns: 1fr;
    }
    @media (min-width: 900px) {
      #<?php echo esc_js($section_id); ?> .cc-grid { grid-template-columns: repeat(3, 1fr); gap: 24px; }
    }

    #<?php echo esc_js($section_id); ?> .cc-card { display: flex; flex-direction: column; }
    #<?php echo esc_js($section_id); ?> .cc-media {
      background: #cfcfcf;            /* 灰底画布 */
      border-radius: 6px;
      height: 520px;                   /* 与设计接近的高度 */
      display: flex; align-items: center; justify-content: center;
      overflow: hidden;
    }
    @media (max-width: 1024px) {
      #<?php echo esc_js($section_id); ?> .cc-media { height: 420px; }
    }
    @media (max-width: 640px) {
      #<?php echo esc_js($section_id); ?> .cc-media { height: 340px; }
    }
    #<?php echo esc_js($section_id); ?> .cc-media img {
      max-width: 90%;
      max-height: 90%;
      width: auto; height: auto;
      object-fit: contain; display: block;
      filter: drop-shadow(0 18px 24px rgba(0,0,0,.18));
      transform: translateZ(0);        /* 抗锯齿 */
    }

    #<?php echo esc_js($section_id); ?> .cc-name {
      margin: 18px 0 6px;
      font-size: 28px; line-height: 1.2;
      color: #111; font-weight: 700; letter-spacing: -0.01em;
    }
    #<?php echo esc_js($section_id); ?> .cc-price {
      font-size: 26px; font-weight: 800; color: #111;
    }
  </style>

  <div class="cc-container">
    <div class="cc-grid">
      <?php foreach ($charger_products as $product): 
        $name  = isset($product['name'])  ? $product['name']  : '';
        $price = isset($product['price']) ? $product['price'] : '';
        $img   = isset($product['image']) ? $product['image'] : '';
        $img   = $img ? esc_url($img) : 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="900"><rect width="100%" height="100%" fill="%23cfcfcf"/></svg>';
      ?>
        <div class="cc-card">
          <div class="cc-media">
            <img src="<?php echo $img; ?>" alt="<?php echo esc_attr($name); ?>">
          </div>
          <?php if ($name !== ''): ?>
            <h3 class="cc-name"><?php echo esc_html($name); ?></h3>
          <?php endif; ?>
          <?php if ($price !== ''): ?>
            <div class="cc-price"><?php echo esc_html($price); ?></div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
