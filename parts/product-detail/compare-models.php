<?php
$template_uri = get_template_directory_uri();
?>
<section class="product-detail-compare" id="compare-models">
  <style>
    /* ===== Minimal look ===== */
    .product-detail-compare{--ink:#0f172a;--muted:#475569;--blue:#2970A7;--divider:#E5E7EB}
    .product-detail-compare__inner{max-width:1400px;margin:0 auto;padding:8px 16px 32px}
    .product-detail-section-title{margin:0 8px 4px 0;font:700 22px/1.2 system-ui,-apple-system,Segoe UI,Roboto;color:var(--ink)}
    .product-detail-compare__description{margin:0;color:var(--muted)}
    .product-detail-compare__header{display:flex;justify-content:space-between;align-items:flex-end;gap:16px;margin-bottom:16px}
    .product-detail-compare__actions{display:flex;gap:8px}
    .product-detail-compare__action{display:inline-block;padding:8px 12px;border-radius:8px;border:1px solid var(--divider);text-decoration:none;color:var(--blue);font-weight:600;background:none}
    .product-detail-compare__action--secondary{color:var(--ink)}
    /* ===== Models row ===== */
    .product-detail-compare__models{display:grid;grid-template-columns:240px 400px 400px 240px;gap:32px;align-items:end;margin:16px 0 24px;justify-items:start;padding-left:40px}
    .product-detail-compare__model{display:flex;flex-direction:column;align-items:flex-start;justify-content:center;gap:16px}
    .product-detail-compare__model-image{width:400px;height:600px;object-fit:contain}
    /* 原生下拉，极简 */
    .compare-select{width:380px;max-width:100%;padding:8px 10px;border:1px solid var(--divider);border-radius:8px;background:none;color:var(--ink)}
    /* 小号“Add Model”按钮 */
    .product-detail-compare__add{justify-self:start;align-self:end;display:inline-flex;align-items:center;gap:6px;
      padding:6px 10px;border:1px solid var(--divider);border-radius:8px;background:none;color:var(--blue);font-weight:600;margin-bottom:10px}
    .product-detail-compare__add-icon{font-weight:700}
    /* ===== Matrix (spec table) ===== */
    .product-detail-compare__matrix{margin-top:8px}
    .product-detail-compare__matrix-group{padding:12px 0}
    .product-detail-compare__matrix-heading{display:grid;grid-template-columns:240px 400px 400px;gap:32px;align-items:start;padding:8px 0;padding-left:40px}
    .product-detail-compare__matrix-header{font-weight:700;text-align:left}
    .product-detail-compare__matrix-section{display:grid;grid-template-columns:240px 400px 400px;gap:32px;align-items:center;padding:8px 0;padding-left:42px}
    .product-detail-compare__matrix-section-title{color:var(--blue);font-weight:700}
    .product-detail-compare__matrix-divider{height:1px;background:transparent}
    .product-detail-compare__matrix-row{display:grid;grid-template-columns:240px 400px 400px;gap:82px;align-items:start;padding:8px 0;padding-left:42px}
    .product-detail-compare__matrix-label{font-weight:700;color:var(--ink)}
    .product-detail-compare__matrix-value{color:var(--muted);text-align:left}
    @media (max-width: 900px){
      .product-detail-compare__models{grid-template-columns:1fr 1fr 1fr;gap:8px}
      .product-detail-compare__models > div:first-child{display:none}
      .product-detail-compare__add{grid-column:1/-1;justify-self:center;margin-top:16px}
      .product-detail-compare__matrix-heading,
      .product-detail-compare__matrix-section,
      .product-detail-compare__matrix-row{grid-template-columns:1fr;gap:8px}
    }
  </style>

  <div class="product-detail-compare__inner" style="margin-top:24px; margin-bottom:84px;">
    <div class="product-detail-compare__header">
      <div class="product-detail-compare__header-text">
        <h2 class="H2-Black"><?php esc_html_e('Compare Models', 'figma-rebuild'); ?></h2>
        <p class="Body-1">
          <?php esc_html_e('Need help finding your right fit? Book a Free Consultation with us now.', 'figma-rebuild'); ?>
        </p>
      </div>
      <div class="product-detail-compare__actions">
        <a class="One-Column-Book-Consultation-Button" href="#contact">
          <?php esc_html_e('Book Consultation', 'figma-rebuild'); ?>
        </a>
        <a class="Two-Column-Learn-More-Button" href="#order">
          <?php esc_html_e('Order Now', 'figma-rebuild'); ?>
        </a>
      </div>
    </div>

    <!-- Models: image + native select; no card backgrounds -->
    <div class="product-detail-compare__models">
      <div></div> <!-- Empty space to align with label column -->
      <div class="product-detail-compare__model">
        <img class="product-detail-compare__model-image"
             src="<?php echo esc_url($template_uri . '/src/images/maxperr_home_10kW.png'); ?>"
             alt="<?php esc_attr_e('Eco 12kW AC charger', 'figma-rebuild'); ?>" />
        <select class="compare-select" aria-label="<?php esc_attr_e('Select Eco 12kW AC finish', 'figma-rebuild'); ?>">
          <option><?php esc_html_e('Eco 12kW AC', 'figma-rebuild'); ?></option>
        </select>
      </div>

      <div class="product-detail-compare__model">
        <img class="product-detail-compare__model-image"
             src="<?php echo esc_url($template_uri . '/src/images/maxperr_smart_30kW.png'); ?>"
             alt="<?php esc_attr_e('Smart 30kW DC charger', 'figma-rebuild'); ?>" />
        <select class="compare-select" aria-label="<?php esc_attr_e('Select Smart 30kW DC finish', 'figma-rebuild'); ?>">
          <option><?php esc_html_e('Smart 30kW DC', 'figma-rebuild'); ?></option>
        </select>
      </div>

      <button type="button" class="product-detail-compare__add">
        <span class="product-detail-compare__add-icon">+</span>
        <?php esc_html_e('Add Model', 'figma-rebuild'); ?>
      </button>
    </div>

    <!-- Matrix -->
    <div class="product-detail-compare__matrix" role="table" aria-label="<?php esc_attr_e('Model comparison table', 'figma-rebuild'); ?>">
      

      <?php
      $comparison_sections = [
        'Design' => [
          __('Dimensions (H × W × D)', 'figma-rebuild') => [__('320 × 220 × 120 mm', 'figma-rebuild'), __('450 × 240 × 210 mm', 'figma-rebuild')],
          __('Weight', 'figma-rebuild') => [__('7.5 kg', 'figma-rebuild'), __('18 kg', 'figma-rebuild')],
          __('Mounting', 'figma-rebuild') => [__('Wall / pedestal', 'figma-rebuild'), __('Pedestal / floor', 'figma-rebuild')],
        ],
        'Input' => [
          __('Grid Connection', 'figma-rebuild') => [__('1-phase AC', 'figma-rebuild'), __('3-phase AC to DC', 'figma-rebuild')],
          __('Voltage Range', 'figma-rebuild') => [__('180–264 V', 'figma-rebuild'), __('380–480 V', 'figma-rebuild')],
          __('Max Current', 'figma-rebuild') => [__('32 A', 'figma-rebuild'), __('45 A per phase', 'figma-rebuild')],
        ],
        'Output' => [
          __('Power Rating', 'figma-rebuild') => [__('12 kW AC', 'figma-rebuild'), __('30 kW DC', 'figma-rebuild')],
          __('Connector', 'figma-rebuild') => [__('Type 2', 'figma-rebuild'), __('CCS2 / CHAdeMO', 'figma-rebuild')],
          __('Charging Speed', 'figma-rebuild') => [__('Up to 60 km / h', 'figma-rebuild'), __('Up to 150 km / 10 min', 'figma-rebuild')],
        ],
        'System' => [
          __('Connectivity', 'figma-rebuild') => [__('Wi-Fi, Ethernet, Bluetooth', 'figma-rebuild'), __('4G LTE, Ethernet, Wi-Fi', 'figma-rebuild')],
          __('User Access', 'figma-rebuild') => [__('RFID, app, PIN', 'figma-rebuild'), __('RFID, app, fleet backend', 'figma-rebuild')],
          __('Smart Features', 'figma-rebuild') => [__('Load balancing, solar matching', 'figma-rebuild'), __('Demand response, payment-ready', 'figma-rebuild')],
        ],
        'Environment' => [
          __('Operating Temp.', 'figma-rebuild') => [__('-30°C to 55°C', 'figma-rebuild'), __('-35°C to 60°C', 'figma-rebuild')],
          __('Protection', 'figma-rebuild') => [__('IP65 / IK10', 'figma-rebuild'), __('IP54 / IK10', 'figma-rebuild')],
          __('Certifications', 'figma-rebuild') => [__('CE, IEC 61851-1', 'figma-rebuild'), __('CE, IEC 61851-23/-24', 'figma-rebuild')],
        ],
      ];

      foreach ($comparison_sections as $section_title => $rows) : ?>
        <div class="product-detail-compare__matrix-group" role="rowgroup">
          <div class="product-detail-compare__matrix-section" role="row">
            <div class="product-detail-compare__matrix-section-title" role="columnheader"><?php echo esc_html($section_title); ?></div>
            <div class="product-detail-compare__matrix-divider" aria-hidden="true"></div>
            <div class="product-detail-compare__matrix-divider" aria-hidden="true"></div>
          </div>
          <?php foreach ($rows as $label => $values) : ?>
            <div class="product-detail-compare__matrix-row" role="row">
              <div class="product-detail-compare__matrix-label" role="rowheader"><?php echo esc_html($label); ?></div>
              <div class="product-detail-compare__matrix-value" role="cell"><?php echo esc_html($values[0]); ?></div>
              <div class="product-detail-compare__matrix-value" role="cell"><?php echo esc_html($values[1]); ?></div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
