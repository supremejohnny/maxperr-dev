<?php
/**
 * Product Detail Compare Models Section
 *
 * @package figma-rebuild
 */

$template_uri = get_template_directory_uri();
?>

<section class="product-detail-compare" id="compare-models">
  <div class="product-detail-compare__inner">
    <div class="product-detail-compare__header">
      <div class="product-detail-compare__header-text">
        <h2 class="product-detail-section-title"><?php esc_html_e('Compare Models', 'figma-rebuild'); ?></h2>
        <p class="product-detail-compare__description">
          <?php esc_html_e('Find the right Maxperr charger for your garage, fleet or workplace by comparing capabilities side by side.', 'figma-rebuild'); ?>
        </p>
      </div>
      <div class="product-detail-compare__actions">
        <a class="product-detail-compare__action product-detail-compare__action--secondary" href="#contact">
          <?php esc_html_e('Book Consultation', 'figma-rebuild'); ?>
        </a>
        <a class="product-detail-compare__action" href="#order">
          <?php esc_html_e('Order Now', 'figma-rebuild'); ?>
        </a>
      </div>
    </div>

    <div class="product-detail-compare__models">
      <div class="product-detail-compare__model">
        <img
          class="product-detail-compare__model-image"
          src="<?php echo esc_url($template_uri . '/src/images/maxperr_home_10kW.png'); ?>"
          alt="<?php esc_attr_e('Eco 12kW AC charger', 'figma-rebuild'); ?>"
        />
        <div class="product-detail-compare__model-title"><?php esc_html_e('Eco 12kW AC', 'figma-rebuild'); ?></div>
        <div class="product-detail-compare__select" aria-label="<?php esc_attr_e('Select Eco 12kW AC finish', 'figma-rebuild'); ?>">
          <span><?php esc_html_e('Matte Graphite', 'figma-rebuild'); ?></span>
          <span aria-hidden="true" class="product-detail-compare__select-icon">▾</span>
        </div>
      </div>

      <div class="product-detail-compare__model">
        <img
          class="product-detail-compare__model-image"
          src="<?php echo esc_url($template_uri . '/src/images/maxperr_smart_30kW.png'); ?>"
          alt="<?php esc_attr_e('Smart 30kW DC charger', 'figma-rebuild'); ?>"
        />
        <div class="product-detail-compare__model-title"><?php esc_html_e('Smart 30kW DC', 'figma-rebuild'); ?></div>
        <div class="product-detail-compare__select" aria-label="<?php esc_attr_e('Select Smart 30kW DC finish', 'figma-rebuild'); ?>">
          <span><?php esc_html_e('Industrial Silver', 'figma-rebuild'); ?></span>
          <span aria-hidden="true" class="product-detail-compare__select-icon">▾</span>
        </div>
      </div>

      <button type="button" class="product-detail-compare__add">
        <span class="product-detail-compare__add-icon">+</span>
        <?php esc_html_e('Add Model', 'figma-rebuild'); ?>
      </button>
    </div>

    <div class="product-detail-compare__matrix" role="table" aria-label="<?php esc_attr_e('Model comparison table', 'figma-rebuild'); ?>">
      <div class="product-detail-compare__matrix-group" role="rowgroup">
        <div class="product-detail-compare__matrix-heading" role="row">
          <div class="product-detail-compare__matrix-label" role="columnheader"></div>
          <div class="product-detail-compare__matrix-header" role="columnheader"><?php esc_html_e('Eco 12kW AC', 'figma-rebuild'); ?></div>
          <div class="product-detail-compare__matrix-header" role="columnheader"><?php esc_html_e('Smart 30kW DC', 'figma-rebuild'); ?></div>
        </div>
      </div>

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

      foreach ($comparison_sections as $section_title => $rows) :
        ?>
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
