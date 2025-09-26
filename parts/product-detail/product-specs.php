<?php
/**
 * Product Detail Specifications Section
 *
 * @package figma-rebuild
 */
?>

<section class="product-detail-specs" id="product-specs">
  <div class="product-detail-specs__inner">
    <h2 class="product-detail-section-title"><?php esc_html_e('Product Specs', 'figma-rebuild'); ?></h2>
    <div class="product-detail-specs__grid">
      <div class="product-detail-specs__group">
        <h3 class="product-detail-specs__heading"><?php esc_html_e('Design', 'figma-rebuild'); ?></h3>
        <dl class="product-detail-specs__list">
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Height', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('320 mm', 'figma-rebuild'); ?></dd>
          </div>
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Width', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('220 mm', 'figma-rebuild'); ?></dd>
          </div>
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Depth', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('120 mm', 'figma-rebuild'); ?></dd>
          </div>
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Weight', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('7.5 kg', 'figma-rebuild'); ?></dd>
          </div>
        </dl>
      </div>

      <div class="product-detail-specs__group">
        <h3 class="product-detail-specs__heading"><?php esc_html_e('Input', 'figma-rebuild'); ?></h3>
        <dl class="product-detail-specs__list">
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Grid Connection', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('Single-phase AC', 'figma-rebuild'); ?></dd>
          </div>
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Voltage Range', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('180–264 V', 'figma-rebuild'); ?></dd>
          </div>
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Maximum Current', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('32 A', 'figma-rebuild'); ?></dd>
          </div>
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Frequency', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('50 / 60 Hz', 'figma-rebuild'); ?></dd>
          </div>
        </dl>
      </div>

      <div class="product-detail-specs__group">
        <h3 class="product-detail-specs__heading"><?php esc_html_e('Output', 'figma-rebuild'); ?></h3>
        <dl class="product-detail-specs__list">
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Power Rating', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('12 kW', 'figma-rebuild'); ?></dd>
          </div>
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Charging Connector', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('Type 2 (IEC 62196-2)', 'figma-rebuild'); ?></dd>
          </div>
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Adjustable Current', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('6–32 A', 'figma-rebuild'); ?></dd>
          </div>
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Efficiency', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('≥ 96%', 'figma-rebuild'); ?></dd>
          </div>
        </dl>
      </div>

      <div class="product-detail-specs__group">
        <h3 class="product-detail-specs__heading"><?php esc_html_e('System', 'figma-rebuild'); ?></h3>
        <dl class="product-detail-specs__list">
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Communication', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('Wi-Fi / Ethernet / OCPP 1.6J', 'figma-rebuild'); ?></dd>
          </div>
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('User Interface', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('LED status ring + mobile app', 'figma-rebuild'); ?></dd>
          </div>
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Smart Features', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('Dynamic load balancing, scheduled charging', 'figma-rebuild'); ?></dd>
          </div>
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Firmware Updates', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('OTA supported', 'figma-rebuild'); ?></dd>
          </div>
        </dl>
      </div>

      <div class="product-detail-specs__group">
        <h3 class="product-detail-specs__heading"><?php esc_html_e('Safety', 'figma-rebuild'); ?></h3>
        <dl class="product-detail-specs__list">
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Certifications', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('CE, IEC 61851-1, EMC Class B', 'figma-rebuild'); ?></dd>
          </div>
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Protection', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('Overcurrent, overvoltage, leakage, surge (6 kA)', 'figma-rebuild'); ?></dd>
          </div>
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Enclosure Rating', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('IP65 / IK10', 'figma-rebuild'); ?></dd>
          </div>
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Operating Temperature', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('-30°C to 55°C', 'figma-rebuild'); ?></dd>
          </div>
        </dl>
      </div>

      <div class="product-detail-specs__group">
        <h3 class="product-detail-specs__heading"><?php esc_html_e('Environment', 'figma-rebuild'); ?></h3>
        <dl class="product-detail-specs__list">
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Operating Humidity', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('5%–95% RH non-condensing', 'figma-rebuild'); ?></dd>
          </div>
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Storage Temperature', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('-40°C to 70°C', 'figma-rebuild'); ?></dd>
          </div>
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Noise Level', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('< 45 dB', 'figma-rebuild'); ?></dd>
          </div>
          <div class="product-detail-specs__item">
            <dt><?php esc_html_e('Compliance', 'figma-rebuild'); ?></dt>
            <dd><?php esc_html_e('RoHS, REACH', 'figma-rebuild'); ?></dd>
          </div>
        </dl>
      </div>
    </div>
  </div>
</section>
