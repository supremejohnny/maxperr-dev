<?php
$template_uri = get_template_directory_uri();
?>

<section class="product-detail-compare" id="compare-models">
  <style>
    /* ===== Apple-style Compare Models ===== */
    .product-detail-compare{--ink:#0f172a;--muted:#475569;--blue:#2970A7;--divider:#E5E7EB;--light-bg:#f5f5f7}
    .product-detail-compare__inner{max-width:1200px;margin-left:auto !important;margin-right:auto !important;padding:clamp(2rem,4vw,4rem) clamp(1rem,4vw,2rem) clamp(3rem,5vw,5rem);overflow-x:hidden;box-sizing:border-box;width:100%}
    
    /* Header */
    .product-detail-compare__header{display:flex;justify-content:space-between;align-items:flex-end;gap:clamp(1rem,3vw,2rem);margin-bottom:clamp(2rem,4vw,3rem);flex-wrap:wrap}
    .product-detail-compare__header-text h2{margin:0 0 0.5rem 0;font-size:clamp(1.75rem,3vw,2.5rem);font-weight:700;color:var(--ink)}
    .product-detail-compare__header-text p{margin:0;font-size:clamp(0.95rem,1.5vw,1.05rem);color:var(--muted)}
    .product-detail-compare__actions{display:flex;gap:clamp(0.5rem,1.5vw,1rem);flex-wrap:wrap}
    
    /* Models Grid - Apple style: select on top, image below */
    /* 使用4列布局：左侧占位列 + 3个产品列，与规格表对齐 */
    .product-detail-compare__models{display:grid;grid-template-columns:minmax(0,200px) repeat(3, 1fr);gap:clamp(1rem,3vw,2rem);margin-bottom:clamp(2.5rem,5vw,4rem);max-width:100%}
    .product-detail-compare__model{display:flex;flex-direction:column;align-items:center;gap:clamp(0.75rem,2vw,1rem)}
    .product-detail-compare__spacer{grid-column:1;visibility:hidden}
    
    /* Select dropdown */
    .compare-select{width:100%;max-width:100%;padding:clamp(0.5rem,1.5vw,0.75rem) clamp(0.625rem,1.5vw,0.875rem);
      border:1px solid var(--divider);border-radius:clamp(0.5rem,1.5vw,0.75rem);
      background:#fff;color:var(--ink);font-size:clamp(0.875rem,1.5vw,1rem);
      font-weight:600;cursor:pointer;transition:border-color 0.2s;appearance:none;
      background-image:url("data:image/svg+xml,%3Csvg width='10' height='6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%230f172a' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E");
      background-repeat:no-repeat;background-position:right clamp(0.625rem,1.5vw,0.875rem) center;
      padding-right:clamp(1.75rem,3vw,2.25rem)}
    .compare-select:hover{border-color:var(--blue)}
    .compare-select:focus{outline:2px solid var(--blue);outline-offset:2px}
    
    /* Product image - more compact */
    .product-detail-compare__model-image{width:100%;height:auto;max-height:clamp(250px,30vw,350px);object-fit:contain;margin:clamp(0.5rem,1.5vw,1rem) 0}
    
    /* Matrix (spec table) - aligned with product columns */
    .product-detail-compare__matrix{margin-top:clamp(2rem,4vw,3rem);border-top:1px solid var(--divider);padding-top:clamp(1rem,2vw,1.5rem)}
    .product-detail-compare__matrix-group{padding:clamp(1rem,2vw,1.5rem) 0;border-bottom:1px solid var(--divider)}
    .product-detail-compare__matrix-group:last-child{border-bottom:none}
    
    /* Section title row */
    .product-detail-compare__matrix-section{display:grid;grid-template-columns:minmax(0,200px) repeat(3, 1fr);gap:clamp(1rem,3vw,2rem);align-items:center;padding:clamp(0.5rem,1.5vw,0.75rem) 0;margin-bottom:clamp(0.5rem,1.5vw,1rem)}
    .product-detail-compare__matrix-section-title{color:var(--blue);font-weight:700;font-size:clamp(1rem,1.8vw,1.125rem)}
    .product-detail-compare__matrix-divider{height:1px;background:transparent}
    
    /* Spec rows */
    .product-detail-compare__matrix-row{display:grid;grid-template-columns:minmax(0,200px) repeat(3, 1fr);gap:clamp(1rem,3vw,2rem);align-items:start;padding:clamp(0.75rem,1.8vw,1rem) 0}
    .product-detail-compare__matrix-row:not(:last-child){border-bottom:1px solid rgba(229,231,235,0.5)}
    .product-detail-compare__matrix-label{font-weight:600;color:var(--ink);font-size:clamp(0.875rem,1.5vw,0.95rem);text-align:left}
    .product-detail-compare__matrix-value{color:var(--muted);font-size:clamp(0.875rem,1.5vw,0.95rem);text-align:center}
    
    /* Third column empty placeholder */
    .product-detail-compare__matrix-value--empty{opacity:0.3;font-style:italic}
    
    @media (max-width: 1024px){
      .product-detail-compare__inner{padding:clamp(1.5rem,3vw,2rem) clamp(1rem,3vw,1.5rem)}
      /* 平板：左侧占位列 + 2个产品列 */
      .product-detail-compare__models{grid-template-columns:minmax(0,150px) repeat(2, 1fr);gap:clamp(1rem,2.5vw,1.5rem)}
      .product-detail-compare__models > div:nth-child(4){display:none} /* 隐藏第3个产品 */
      .product-detail-compare__matrix-section,
      .product-detail-compare__matrix-row{grid-template-columns:minmax(0,150px) repeat(2, 1fr);gap:clamp(0.75rem,2vw,1rem)}
      .product-detail-compare__matrix-section > div:nth-child(4),
      .product-detail-compare__matrix-row > div:nth-child(4){display:none} /* 隐藏第3列规格 */
    }
    
    @media (max-width: 768px){
      .product-detail-compare__inner{padding:clamp(1.5rem,4vw,2rem) clamp(1rem,4vw,1rem)}
      .product-detail-compare__header{flex-direction:column;align-items:flex-start;gap:1rem}
      /* 手机：隐藏占位列，垂直堆叠产品 */
      .product-detail-compare__spacer{display:none}
      .product-detail-compare__models{grid-template-columns:1fr;gap:clamp(1.5rem,4vw,2rem)}
      .product-detail-compare__model-image{max-height:clamp(200px,40vw,280px)}
      
      .product-detail-compare__matrix-section,
      .product-detail-compare__matrix-row{grid-template-columns:1fr;gap:0.5rem;text-align:left}
      .product-detail-compare__matrix-value{text-align:left;padding-left:1rem;border-left:3px solid var(--divider)}
      .product-detail-compare__matrix-label{margin-bottom:0.25rem}
    }
  </style>

  <div class="product-detail-compare__inner">
    <div class="product-detail-compare__header">
      <div class="product-detail-compare__header-text">
        <h2><?php echo esc_html(get_theme_mod('product_detail_compare_title', __('Compare Models', 'figma-rebuild'))); ?></h2>
        <p>
          <?php echo wp_kses_post(get_theme_mod('product_detail_compare_description', __('Need help finding your right fit? Book a Free Consultation with us now.', 'figma-rebuild'))); ?>
        </p>
      </div>
      <div class="product-detail-compare__actions">
        <a class="One-Column-Book-Consultation-Button" href="<?php echo esc_url(get_theme_mod('product_detail_compare_button_link', '#contact')); ?>">
          <?php echo esc_html(get_theme_mod('product_detail_compare_button_text', __('Book Consultation', 'figma-rebuild'))); ?>
        </a>
        <a class="Two-Column-Learn-More-Button" href="#order">
          <?php esc_html_e('Order Now', 'figma-rebuild'); ?>
        </a>
      </div>
    </div>

    <!-- Apple-style Models: select dropdown on top, image below, 4-column grid (1 spacer + 3 products) -->
    <div class="product-detail-compare__models">
      <!-- 左侧占位列，与规格表标签列对齐 -->
      <div class="product-detail-compare__spacer" aria-hidden="true"></div>
      
      <div class="product-detail-compare__model">
        <select class="compare-select" aria-label="<?php esc_attr_e('Select first model', 'figma-rebuild'); ?>">
          <option><?php esc_html_e('Eco 12kW AC', 'figma-rebuild'); ?></option>
          <option><?php esc_html_e('Smart 30kW DC', 'figma-rebuild'); ?></option>
          <option><?php esc_html_e('Pro 50kW DC', 'figma-rebuild'); ?></option>
        </select>
        <img class="product-detail-compare__model-image"
             src="<?php echo esc_url($template_uri . '/src/images/maxperr_home_10kW.png'); ?>"
             alt="<?php esc_attr_e('Eco 12kW AC charger', 'figma-rebuild'); ?>" />
      </div>

      <div class="product-detail-compare__model">
        <select class="compare-select" aria-label="<?php esc_attr_e('Select second model', 'figma-rebuild'); ?>">
          <option><?php esc_html_e('Smart 30kW DC', 'figma-rebuild'); ?></option>
          <option><?php esc_html_e('Eco 12kW AC', 'figma-rebuild'); ?></option>
          <option><?php esc_html_e('Pro 50kW DC', 'figma-rebuild'); ?></option>
        </select>
        <img class="product-detail-compare__model-image"
             src="<?php echo esc_url($template_uri . '/src/images/maxperr_smart_30kW.png'); ?>"
             alt="<?php esc_attr_e('Smart 30kW DC charger', 'figma-rebuild'); ?>" />
      </div>

      <div class="product-detail-compare__model">
        <select class="compare-select" aria-label="<?php esc_attr_e('Select third model', 'figma-rebuild'); ?>">
          <option value=""><?php esc_html_e('— Select Model —', 'figma-rebuild'); ?></option>
          <option><?php esc_html_e('Eco 12kW AC', 'figma-rebuild'); ?></option>
          <option><?php esc_html_e('Smart 30kW DC', 'figma-rebuild'); ?></option>
          <option><?php esc_html_e('Pro 50kW DC', 'figma-rebuild'); ?></option>
        </select>
        <img class="product-detail-compare__model-image"
             src="<?php echo esc_url($template_uri . '/src/images/maxperr_home_10kW.png'); ?>"
             alt="<?php esc_attr_e('Product placeholder', 'figma-rebuild'); ?>"
             style="opacity: 0.3;" />
      </div>
    </div>

    <!-- Matrix - specs aligned with product columns above -->
    <div class="product-detail-compare__matrix" role="table" aria-label="<?php esc_attr_e('Model comparison table', 'figma-rebuild'); ?>">
      <?php
      $comparison_sections = [
        'Design' => [
          __('Dimensions (H × W × D)', 'figma-rebuild') => [__('320 × 220 × 120 mm', 'figma-rebuild'), __('450 × 240 × 210 mm', 'figma-rebuild'), __('—', 'figma-rebuild')],
          __('Weight', 'figma-rebuild') => [__('7.5 kg', 'figma-rebuild'), __('18 kg', 'figma-rebuild'), __('—', 'figma-rebuild')],
          __('Mounting', 'figma-rebuild') => [__('Wall / pedestal', 'figma-rebuild'), __('Pedestal / floor', 'figma-rebuild'), __('—', 'figma-rebuild')],
        ],
        'Input' => [
          __('Grid Connection', 'figma-rebuild') => [__('1-phase AC', 'figma-rebuild'), __('3-phase AC to DC', 'figma-rebuild'), __('—', 'figma-rebuild')],
          __('Voltage Range', 'figma-rebuild') => [__('180–264 V', 'figma-rebuild'), __('380–480 V', 'figma-rebuild'), __('—', 'figma-rebuild')],
          __('Max Current', 'figma-rebuild') => [__('32 A', 'figma-rebuild'), __('45 A per phase', 'figma-rebuild'), __('—', 'figma-rebuild')],
        ],
        'Output' => [
          __('Power Rating', 'figma-rebuild') => [__('12 kW AC', 'figma-rebuild'), __('30 kW DC', 'figma-rebuild'), __('—', 'figma-rebuild')],
          __('Connector', 'figma-rebuild') => [__('Type 2', 'figma-rebuild'), __('CCS2 / CHAdeMO', 'figma-rebuild'), __('—', 'figma-rebuild')],
          __('Charging Speed', 'figma-rebuild') => [__('Up to 60 km / h', 'figma-rebuild'), __('Up to 150 km / 10 min', 'figma-rebuild'), __('—', 'figma-rebuild')],
        ],
        'System' => [
          __('Connectivity', 'figma-rebuild') => [__('Wi-Fi, Ethernet, Bluetooth', 'figma-rebuild'), __('4G LTE, Ethernet, Wi-Fi', 'figma-rebuild'), __('—', 'figma-rebuild')],
          __('User Access', 'figma-rebuild') => [__('RFID, app, PIN', 'figma-rebuild'), __('RFID, app, fleet backend', 'figma-rebuild'), __('—', 'figma-rebuild')],
          __('Smart Features', 'figma-rebuild') => [__('Load balancing, solar matching', 'figma-rebuild'), __('Demand response, payment-ready', 'figma-rebuild'), __('—', 'figma-rebuild')],
        ],
        'Environment' => [
          __('Operating Temp.', 'figma-rebuild') => [__('-30°C to 55°C', 'figma-rebuild'), __('-35°C to 60°C', 'figma-rebuild'), __('—', 'figma-rebuild')],
          __('Protection', 'figma-rebuild') => [__('IP65 / IK10', 'figma-rebuild'), __('IP54 / IK10', 'figma-rebuild'), __('—', 'figma-rebuild')],
          __('Certifications', 'figma-rebuild') => [__('CE, IEC 61851-1', 'figma-rebuild'), __('CE, IEC 61851-23/-24', 'figma-rebuild'), __('—', 'figma-rebuild')],
        ],
      ];

      foreach ($comparison_sections as $section_title => $rows) : ?>
        <div class="product-detail-compare__matrix-group" role="rowgroup">
          <div class="product-detail-compare__matrix-section" role="row">
            <div class="product-detail-compare__matrix-section-title" role="columnheader"><?php echo esc_html($section_title); ?></div>
            <div class="product-detail-compare__matrix-divider" aria-hidden="true"></div>
            <div class="product-detail-compare__matrix-divider" aria-hidden="true"></div>
            <div class="product-detail-compare__matrix-divider" aria-hidden="true"></div>
          </div>
          <?php foreach ($rows as $label => $values) : ?>
            <div class="product-detail-compare__matrix-row" role="row">
              <div class="product-detail-compare__matrix-label" role="rowheader"><?php echo esc_html($label); ?></div>
              <div class="product-detail-compare__matrix-value" role="cell"><?php echo esc_html($values[0]); ?></div>
              <div class="product-detail-compare__matrix-value" role="cell"><?php echo esc_html($values[1]); ?></div>
              <div class="product-detail-compare__matrix-value product-detail-compare__matrix-value--empty" role="cell"><?php echo esc_html($values[2]); ?></div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
