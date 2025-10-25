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
      gap: 20px;
      justify-content: center;
      align-items: center;
      flex-wrap: nowrap;
      padding: 0 20px;
      max-width: 1400px;
      margin: 0 auto;
    }
    
    @media (max-width: 1400px) {
      #<?php echo esc_js($section_id); ?> .hec-grid {
        gap: 16px;
        padding: 0 15px;
      }
    }
    
    @media (max-width: 1200px) {
      #<?php echo esc_js($section_id); ?> .hec-grid {
        gap: 12px;
        padding: 0 10px;
      }
    }
    
    @media (max-width: 1000px) {
      #<?php echo esc_js($section_id); ?> .hec-grid {
        gap: 8px;
        padding: 0 5px;
      }
    }
    
    @media (max-width: 768px) {
      #<?php echo esc_js($section_id); ?> .hec-grid {
        gap: 6px;
        padding: 0 5px;
      }
    }
    
    @media (max-width: 600px) {
      #<?php echo esc_js($section_id); ?> .hec-grid {
        gap: 4px;
        padding: 0 2px;
      }
    }
    
    @media (max-width: 480px) {
      #<?php echo esc_js($section_id); ?> .hec-grid {
        gap: 2px;
        padding: 0 1px;
      }
    }

    #<?php echo esc_js($section_id); ?> .hec-card { 
      display: flex;
      flex-direction: column;
      width: 100%;
      max-width: 400px;
      height: 420px;
      flex: 1;
      min-width: 0;
      cursor: pointer;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      text-decoration: none;
      color: inherit;
    }
    
    #<?php echo esc_js($section_id); ?> .hec-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
      text-decoration: none;
      color: inherit;
    }
    
    /* 禁用第三个产品的hover效果和交互 */
    #<?php echo esc_js($section_id); ?> .hec-card:nth-child(3) {
      cursor: default !important;
      pointer-events: none;
    }
    
    #<?php echo esc_js($section_id); ?> .hec-card:nth-child(3):hover {
      transform: none;
      box-shadow: none;
    }
    
    #<?php echo esc_js($section_id); ?> .hec-card:visited {
      color: inherit;
      text-decoration: none;
    }
    #<?php echo esc_js($section_id); ?> .hec-media {
      position: relative;
      width: 100%;
      height: 360px;
      background: #cfcfcf;
      display: flex; 
      align-items: center; 
      justify-content: center;
      flex-shrink: 0;
    }
    
    @media (max-width: 1400px) {
      #<?php echo esc_js($section_id); ?> .hec-card {
        height: 380px;
      }
      #<?php echo esc_js($section_id); ?> .hec-media { 
        height: 320px; 
      }
    }
    
    @media (max-width: 1200px) {
      #<?php echo esc_js($section_id); ?> .hec-card {
        height: 360px;
      }
      #<?php echo esc_js($section_id); ?> .hec-media { 
        height: 300px; 
      }
    }
    
    @media (max-width: 1000px) {
      #<?php echo esc_js($section_id); ?> .hec-card {
        height: 340px;
      }
      #<?php echo esc_js($section_id); ?> .hec-media { 
        height: 280px; 
      }
    }
    
    @media (max-width: 768px) {
      #<?php echo esc_js($section_id); ?> .hec-card {
        height: 280px;
      }
      #<?php echo esc_js($section_id); ?> .hec-media { 
        height: 220px; 
      }
    }
    
    @media (max-width: 600px) {
      #<?php echo esc_js($section_id); ?> .hec-card {
        height: 260px;
      }
      #<?php echo esc_js($section_id); ?> .hec-media { 
        height: 200px; 
      }
    }
    
    @media (max-width: 480px) {
      #<?php echo esc_js($section_id); ?> .hec-card {
        height: 240px;
      }
      #<?php echo esc_js($section_id); ?> .hec-media { 
        height: 180px; 
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
      font-size: 22px; line-height: 1.2;
      color: #111; font-weight: 700; letter-spacing: -0.01em;
    }
    #<?php echo esc_js($section_id); ?> .hec-price {
      font-size: 20px; font-weight: 800; color: #111;
    }
    
    @media (max-width: 1400px) {
      #<?php echo esc_js($section_id); ?> .hec-name {
        font-size: 20px;
      }
      #<?php echo esc_js($section_id); ?> .hec-price {
        font-size: 18px;
      }
    }
    
    @media (max-width: 1200px) {
      #<?php echo esc_js($section_id); ?> .hec-name {
        font-size: 18px;
      }
      #<?php echo esc_js($section_id); ?> .hec-price {
        font-size: 16px;
      }
    }
    
    @media (max-width: 1000px) {
      #<?php echo esc_js($section_id); ?> .hec-name {
        font-size: 16px;
      }
      #<?php echo esc_js($section_id); ?> .hec-price {
        font-size: 14px;
      }
    }
    
    @media (max-width: 768px) {
      #<?php echo esc_js($section_id); ?> .hec-name {
        font-size: 14px;
      }
      #<?php echo esc_js($section_id); ?> .hec-price {
        font-size: 12px;
      }
    }
    
    @media (max-width: 600px) {
      #<?php echo esc_js($section_id); ?> .hec-name {
        font-size: 12px;
      }
      #<?php echo esc_js($section_id); ?> .hec-price {
        font-size: 10px;
      }
    }
    
    @media (max-width: 480px) {
      #<?php echo esc_js($section_id); ?> .hec-name {
        font-size: 10px;
      }
      #<?php echo esc_js($section_id); ?> .hec-price {
        font-size: 9px;
      }
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
