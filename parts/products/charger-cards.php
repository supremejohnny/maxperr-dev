<?php
  // 从customizer获取charger products数据
  $charger_products_json = get_theme_mod('charger_products', '');
  $charger_products = [];
  
  if (!empty($charger_products_json)) {
    $charger_products = json_decode($charger_products_json, true);
    if (!is_array($charger_products)) {
      $charger_products = [];
    }
  }
  
  // 如果没有数据，使用默认值
  if (empty($charger_products)) {
    $template_uri = get_template_directory_uri();
    $charger_products = [
      [
        'name'  => 'Eco 12kW AC',
        'price' => '$799',
        'image' => $template_uri . '/src/images/products/Eco 12kW AC.png',
      ],
      [
        'name'  => 'Smart 30kW DC',
        'price' => '$0000',
        'image' => $template_uri . '/src/images/products/Smart 30kW DC.png',
      ],
      [
        'name'  => 'Pro Series DC',
        'price' => '$0000',
        'image' => $template_uri . '/src/images/products/Pro Series DC.png',
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
     #<?php echo esc_js($section_id); ?>.cc-wrap { 
      padding: 50px 0 75px; 
      background:#fff; 
      width: 100%; 
      overflow-x: hidden;
    }
    #<?php echo esc_js($section_id); ?> .cc-container { 
      max-width: none; 
      margin: 0; 
      padding: 0; 
      box-sizing: border-box; 
      width: 100%; 
    }

    #<?php echo esc_js($section_id); ?> .cc-grid {
      display: flex;
      gap: 48px;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
    }
    
    @media (max-width: 1200px) {
      #<?php echo esc_js($section_id); ?> .cc-grid {
        gap: 24px;
      }
    }
    
    @media (max-width: 768px) {
      #<?php echo esc_js($section_id); ?> .cc-grid {
        flex-direction: column;
        align-items: center;
        gap: 32px;
      }
    }

    #<?php echo esc_js($section_id); ?> .cc-card { 
      display: flex;
      flex-direction: column;
      width: 511px;
      height: 577px;
      flex-shrink: 0;
      cursor: pointer;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      text-decoration: none;
      color: inherit;
    }
    
    #<?php echo esc_js($section_id); ?> .cc-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
      text-decoration: none;
      color: inherit;
    }
    
    #<?php echo esc_js($section_id); ?> .cc-card:visited {
      color: inherit;
      text-decoration: none;
    }
    #<?php echo esc_js($section_id); ?> .cc-media {
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
      #<?php echo esc_js($section_id); ?> .cc-card {
        width: 400px;
        height: 450px;
      }
      #<?php echo esc_js($section_id); ?> .cc-media { 
        height: 380px; 
      }
    }
    
    @media (max-width: 768px) {
      #<?php echo esc_js($section_id); ?> .cc-card {
        width: 100%;
        max-width: 400px;
        height: auto;
      }
      #<?php echo esc_js($section_id); ?> .cc-media { 
        height: 300px; 
      }
    }
    #<?php echo esc_js($section_id); ?> .cc-media img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    #<?php echo esc_js($section_id); ?> .cc-content {
      padding: 18px 0 0;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
    }

    #<?php echo esc_js($section_id); ?> .cc-name {
      margin: 0 0 6px;
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
        
        // 检查是否是 12kW Eco 产品，如果是则添加链接
        $is_eco_12kw = (stripos($name, 'Eco 12kW') !== false || stripos($name, '12kW') !== false);
        $product_link = $is_eco_12kw ? home_url('/product-detail/') : '#';
      ?>
        <?php if ($is_eco_12kw): ?>
          <a href="<?php echo esc_url($product_link); ?>" class="cc-card">
        <?php else: ?>
          <div class="cc-card">
        <?php endif; ?>
          <div class="cc-media">
            <img src="<?php echo $img; ?>" alt="<?php echo esc_attr($name); ?>">
          </div>
          <div class="cc-content">
            <?php if ($name !== ''): ?>
              <h3 class="cc-name"><?php echo esc_html($name); ?></h3>
            <?php endif; ?>
            <?php if ($price !== ''): ?>
              <div class="cc-price"><?php echo esc_html($price); ?></div>
            <?php endif; ?>
          </div>
        <?php if ($is_eco_12kw): ?>
          </a>
        <?php else: ?>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>
