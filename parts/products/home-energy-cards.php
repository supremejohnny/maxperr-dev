<?php
  // 允许外部预先定义 $home_energy_products；没有就用默认
  if (!isset($home_energy_products) || !is_array($home_energy_products)) {
    $template_uri = get_template_directory_uri();
    $home_energy_products = [
      [
        'name'  => 'Split Phase Hybrid Inverter 10kW',
        'price' => '$3999',
        'image' => $template_uri . '/src/images/maxperr_home_10kW.png',
      ],
      [
        'name'  => 'Battery Storage System',
        'price' => '$2599 - $7299',
        'image' => $template_uri . '/src/images/maxperr_smart_30kW.png',
      ],
    ];
  }

  $section_id = 'home-energy-cards';
?>
<section id="<?php echo esc_attr($section_id); ?>" class="hec-wrap">
  <style>
    /* ===== Scoped styles (no Tailwind) ===== */
    body { overflow-x: hidden; }
    * { box-sizing: border-box; }
    #<?php echo esc_js($section_id); ?>.hec-wrap { padding: 50px 0 75px; background:#fff; width: 100%; }
    #<?php echo esc_js($section_id); ?> .hec-container { max-width: 1280px; margin: 0 auto; padding: 0 6px; box-sizing: border-box; width: 100%; }

    #<?php echo esc_js($section_id); ?> .hec-grid {
      display: grid; gap: 40px;
      grid-template-columns: 1fr;
    }
    @media (min-width: 900px) {
      #<?php echo esc_js($section_id); ?> .hec-grid { 
        grid-template-columns: repeat(3, 1fr); 
        gap: 24px; 
      }
    }

    #<?php echo esc_js($section_id); ?> .hec-card { display: flex; flex-direction: column; }
    #<?php echo esc_js($section_id); ?> .hec-media {
      background: #cfcfcf;            /* 灰底画布 */
      border-radius: 6px;
      height: 520px;                   /* 与设计接近的高度 */
      display: flex; align-items: center; justify-content: center;
      overflow: hidden;
    }
    @media (max-width: 1024px) {
      #<?php echo esc_js($section_id); ?> .hec-media { height: 420px; }
    }
    @media (max-width: 640px) {
      #<?php echo esc_js($section_id); ?> .hec-media { height: 340px; }
    }
    #<?php echo esc_js($section_id); ?> .hec-media img {
      max-width: 90%;
      max-height: 90%;
      width: auto; height: auto;
      object-fit: contain; display: block;
      filter: drop-shadow(0 18px 24px rgba(0,0,0,.18));
      transform: translateZ(0);        /* 抗锯齿 */
    }

    #<?php echo esc_js($section_id); ?> .hec-name {
      margin: 18px 0 6px;
      font-size: 28px; line-height: 1.2;
      color: #111; font-weight: 700; letter-spacing: -0.01em;
    }
    #<?php echo esc_js($section_id); ?> .hec-price {
      font-size: 26px; font-weight: 800; color: #111;
    }

    /* 让2个产品在3列布局中居中显示 */
    @media (min-width: 900px) {
      #<?php echo esc_js($section_id); ?> .hec-grid {
        grid-template-columns: 1fr 1fr 1fr;
        justify-items: center;
      }
      #<?php echo esc_js($section_id); ?> .hec-card:first-child {
        grid-column: 1;
      }
      #<?php echo esc_js($section_id); ?> .hec-card:last-child {
        grid-column: 2;
      }
    }
  </style>

  <div class="hec-container">
    <div class="hec-grid">
      <?php foreach ($home_energy_products as $product): 
        $name  = isset($product['name'])  ? $product['name']  : '';
        $price = isset($product['price']) ? $product['price'] : '';
        $img   = isset($product['image']) ? $product['image'] : '';
        $img   = $img ? esc_url($img) : 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="900"><rect width="100%" height="100%" fill="%23cfcfcf"/></svg>';
      ?>
        <div class="hec-card">
          <div class="hec-media">
            <img src="<?php echo $img; ?>" alt="<?php echo esc_attr($name); ?>">
          </div>
          <?php if ($name !== ''): ?>
            <h3 class="hec-name"><?php echo esc_html($name); ?></h3>
          <?php endif; ?>
          <?php if ($price !== ''): ?>
            <div class="hec-price"><?php echo esc_html($price); ?></div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
