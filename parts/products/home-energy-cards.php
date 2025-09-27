<?php
  // 从customizer获取home energy products数据
  $home_energy_products_json = get_theme_mod('home_energy_products', '');
  $home_energy_products = [];
  
  if (!empty($home_energy_products_json)) {
    $home_energy_products = json_decode($home_energy_products_json, true);
    if (!is_array($home_energy_products)) {
      $home_energy_products = [];
    }
  }
  
  // 如果没有数据，使用默认值
  if (empty($home_energy_products)) {
    $template_uri = get_template_directory_uri();
    $home_energy_products = [
      [
        'name'  => 'Split Phase Hybrid Inverter 10kW',
        'price' => '$3999',
        'image' => $template_uri . '/src/images/products/Split Phase Hybrid Inverter 10kW.png',
      ],
      [
        'name'  => 'Battery Storage System',
        'price' => '$2599 - $7299',
        'image' => $template_uri . '/src/images/products/Battery Storage System.png',
      ],
      [
        'name'  => '',
        'price' => '',
        'image' => '',
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
    #<?php echo esc_js($section_id); ?>.hec-wrap { 
      padding: 50px 0 75px; 
      background:#fff; 
      width: 100%; 
      overflow-x: hidden;
    }
    #<?php echo esc_js($section_id); ?> .hec-container { 
      max-width: none; 
      margin: 0; 
      padding: 0; 
      box-sizing: border-box; 
      width: 100%; 
    }

    #<?php echo esc_js($section_id); ?> .hec-grid {
      display: flex;
      gap: 48px;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
    }
    
    @media (max-width: 1200px) {
      #<?php echo esc_js($section_id); ?> .hec-grid {
        gap: 24px;
      }
    }
    
    @media (max-width: 768px) {
      #<?php echo esc_js($section_id); ?> .hec-grid {
        flex-direction: column;
        align-items: center;
        gap: 32px;
      }
    }

    #<?php echo esc_js($section_id); ?> .hec-card { 
      display: flex;
      flex-direction: column;
      width: 511px;
      height: 577px;
      flex-shrink: 0;
    }
    #<?php echo esc_js($section_id); ?> .hec-media {
      position: relative;
      width: 100%;
      height: 520px;
      background: #cfcfcf;
      display: flex; 
      align-items: center; 
      justify-content: center;
      flex-shrink: 0;
    }
    
    @media (max-width: 1200px) {
      #<?php echo esc_js($section_id); ?> .hec-card {
        width: 400px;
        height: 450px;
      }
      #<?php echo esc_js($section_id); ?> .hec-media { 
        height: 380px; 
      }
    }
    
    @media (max-width: 768px) {
      #<?php echo esc_js($section_id); ?> .hec-card {
        width: 100%;
        max-width: 400px;
        height: auto;
      }
      #<?php echo esc_js($section_id); ?> .hec-media { 
        height: 300px; 
      }
    }
    #<?php echo esc_js($section_id); ?> .hec-media img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    #<?php echo esc_js($section_id); ?> .hec-content {
      padding: 18px 0 0;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
    }

    #<?php echo esc_js($section_id); ?> .hec-name {
      margin: 0 0 6px;
      font-size: 28px; line-height: 1.2;
      color: #111; font-weight: 700; letter-spacing: -0.01em;
    }
    #<?php echo esc_js($section_id); ?> .hec-price {
      font-size: 26px; font-weight: 800; color: #111;
    }


  </style>

  <div class="hec-container">
    <div class="hec-grid">
      <?php foreach ($home_energy_products as $product): 
        $name  = isset($product['name'])  ? $product['name']  : '';
        $price = isset($product['price']) ? $product['price'] : '';
        $img   = isset($product['image']) ? $product['image'] : '';
        $is_empty = empty($name) && empty($price) && empty($img);
      ?>
        <div class="hec-card">
          <?php if (!$is_empty): ?>
            <?php 
              $img = $img ? esc_url($img) : 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="900"><rect width="100%" height="100%" fill="%23cfcfcf"/></svg>';
            ?>
            <div class="hec-media">
              <img src="<?php echo $img; ?>" alt="<?php echo esc_attr($name); ?>">
            </div>
            <div class="hec-content">
              <?php if ($name !== ''): ?>
                <h3 class="hec-name"><?php echo esc_html($name); ?></h3>
              <?php endif; ?>
              <?php if ($price !== ''): ?>
                <div class="hec-price"><?php echo esc_html($price); ?></div>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
