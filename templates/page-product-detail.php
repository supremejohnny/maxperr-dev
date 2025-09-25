<?php
/**
 * Template Name: Product Detail
 *
 * Detailed product page for the Eco 12kW AC charger.
 *
 * @package figma-rebuild
 */

get_header();

$template_uri = get_template_directory_uri();
?>

<main class="product-detail-page">
  <section class="product-detail-hero" id="product-detail-hero">
    <div class="product-detail-hero__inner">
      <div class="product-detail-hero__header">
        <div class="product-detail-hero__title-group">
          <span class="product-detail-hero__eyebrow"><?php esc_html_e('Eco 12kW AC', 'figma-rebuild'); ?></span>
          <h1 class="product-detail-hero__title"><?php esc_html_e('Home-friendly efficiency for daily charging.', 'figma-rebuild'); ?></h1>
          <p class="product-detail-hero__subtitle">
            <?php esc_html_e('A compact AC wallbox engineered for quiet, cost-efficient energy delivery. Schedule, monitor and optimise every session from the palm of your hand.', 'figma-rebuild'); ?>
          </p>
        </div>
        <a class="product-detail-hero__cta" href="#compare-models"><?php esc_html_e('Order Now', 'figma-rebuild'); ?></a>
      </div>

      <div class="product-detail-hero__gallery">
        <article class="product-detail-hero__media">
          <div class="product-detail-hero__image-frame">
            <img
              class="product-detail-hero__image"
              src="<?php echo esc_url($template_uri . '/src/images/maxperr_home_10kW.png'); ?>"
              alt="<?php esc_attr_e('Eco 12kW AC charger three-quarter view', 'figma-rebuild'); ?>"
            />
          </div>
          <div class="product-detail-hero__metric">
            <span class="product-detail-hero__metric-value">20%</span>
            <span class="product-detail-hero__metric-label"><?php esc_html_e('Higher conversion efficiency vs. standard wallboxes', 'figma-rebuild'); ?></span>
          </div>
        </article>

        <article class="product-detail-hero__media">
          <div class="product-detail-hero__image-frame">
            <img
              class="product-detail-hero__image"
              src="<?php echo esc_url($template_uri . '/src/images/ev_charging_pic.jpg'); ?>"
              alt="<?php esc_attr_e('Charging cable and connector close-up', 'figma-rebuild'); ?>"
            />
          </div>
          <div class="product-detail-hero__metric">
            <span class="product-detail-hero__metric-value">30 min</span>
            <span class="product-detail-hero__metric-label"><?php esc_html_e('Smart boost mode for daily top-ups', 'figma-rebuild'); ?></span>
          </div>
        </article>

        <article class="product-detail-hero__media">
          <div class="product-detail-hero__image-frame">
            <img
              class="product-detail-hero__image"
              src="<?php echo esc_url($template_uri . '/src/images/maxperr_smart_30kW.png'); ?>"
              alt="<?php esc_attr_e('Status indicator and LED feedback detail', 'figma-rebuild'); ?>"
            />
          </div>
          <div class="product-detail-hero__metric">
            <span class="product-detail-hero__metric-value">3 yrs</span>
            <span class="product-detail-hero__metric-label"><?php esc_html_e('Comprehensive warranty & 24/7 support', 'figma-rebuild'); ?></span>
          </div>
        </article>
      </div>
    </div>
  </section>

  <section class="product-detail-cost" id="cost-efficient">
    <div class="product-detail-cost__inner">
      <h2 class="product-detail-section-title"><?php esc_html_e('Cost Efficient Home Charger', 'figma-rebuild'); ?></h2>
      <div class="product-detail-cost__grid">
        <article class="product-detail-cost__card product-detail-cost__card--tall">
          <img
            class="product-detail-cost__image"
            src="<?php echo esc_url($template_uri . '/src/images/install_wallbox.png'); ?>"
            alt="<?php esc_attr_e('Technician installing a wall-mounted charger', 'figma-rebuild'); ?>"
          />
          <div class="product-detail-cost__content">
            <span class="product-detail-cost__eyebrow"><?php esc_html_e('Intelligent & Efficient', 'figma-rebuild'); ?></span>
            <p class="product-detail-cost__description">
              <?php esc_html_e('Dynamic load balancing protects your home supply while prioritising the lowest tariff windows for every session.', 'figma-rebuild'); ?>
            </p>
          </div>
        </article>

        <article class="product-detail-cost__card product-detail-cost__card--medium">
          <img
            class="product-detail-cost__image"
            src="<?php echo esc_url($template_uri . '/src/images/maxperr_smart_30kW.png'); ?>"
            alt="<?php esc_attr_e('Protective cover with safety sensors', 'figma-rebuild'); ?>"
          />
          <div class="product-detail-cost__content">
            <span class="product-detail-cost__eyebrow"><?php esc_html_e('Secure & Reliable', 'figma-rebuild'); ?></span>
            <p class="product-detail-cost__description">
              <?php esc_html_e('Built-in surge defence, ground-fault monitoring and auto-diagnostics keep every charge session protected.', 'figma-rebuild'); ?>
            </p>
          </div>
        </article>

        <article class="product-detail-cost__card product-detail-cost__card--wide">
          <img
            class="product-detail-cost__image"
            src="<?php echo esc_url($template_uri . '/src/images/ev_app_control.jpg'); ?>"
            alt="<?php esc_attr_e('Driver managing charging from a mobile app', 'figma-rebuild'); ?>"
          />
          <div class="product-detail-cost__content">
            <span class="product-detail-cost__eyebrow"><?php esc_html_e('Flexible & Convenient', 'figma-rebuild'); ?></span>
            <p class="product-detail-cost__description">
              <?php esc_html_e('Control sessions remotely, share access securely with family members and review energy history in real time.', 'figma-rebuild'); ?>
            </p>
          </div>
        </article>
      </div>
    </div>
  </section>

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
</main>

<?php get_footer(); ?>
