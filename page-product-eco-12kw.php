<?php
/**
 * Template Name: Product Detail - Eco 12kW AC
 */

get_header();

$template_uri = get_template_directory_uri();
?>

<main class="product-detail-page">
  <section class="product-detail-hero" id="product-hero">
    <div class="product-detail-hero__header">
      <div class="product-detail-hero__intro">
        <p class="product-detail-hero__model"><?php esc_html_e('Eco 12kW AC', 'figma-rebuild'); ?></p>
        <p class="product-detail-hero__subtitle"><?php esc_html_e('Residential-friendly, energy-efficient charging tailored for modern EV households.', 'figma-rebuild'); ?></p>
      </div>
      <a class="product-detail-hero__cta" href="#compare-models"><?php esc_html_e('Order Now', 'figma-rebuild'); ?></a>
    </div>

    <div class="product-detail-hero__media">
      <figure class="product-detail-hero__media-item">
        <div class="product-detail-hero__image-wrapper">
          <img src="<?php echo esc_url($template_uri . '/src/images/maxperr_home_10kW.png'); ?>"
               alt="<?php esc_attr_e('Eco 12kW AC home charger perspective view', 'figma-rebuild'); ?>">
        </div>
        <figcaption class="product-detail-hero__metric">
          <span class="product-detail-hero__metric-value">20%</span>
          <span class="product-detail-hero__metric-label"><?php esc_html_e('Higher charging efficiency vs. standard Level 2 units', 'figma-rebuild'); ?></span>
        </figcaption>
      </figure>

      <figure class="product-detail-hero__media-item">
        <div class="product-detail-hero__image-wrapper">
          <img src="<?php echo esc_url($template_uri . '/src/images/ev_charging_pic.jpg'); ?>"
               alt="<?php esc_attr_e('Charging cable and connector detail', 'figma-rebuild'); ?>">
        </div>
        <figcaption class="product-detail-hero__metric">
          <span class="product-detail-hero__metric-value">30</span>
          <span class="product-detail-hero__metric-label"><?php esc_html_e('Miles of range added per hour of charge', 'figma-rebuild'); ?></span>
        </figcaption>
      </figure>

      <figure class="product-detail-hero__media-item">
        <div class="product-detail-hero__image-wrapper">
          <img src="<?php echo esc_url($template_uri . '/src/images/install_wallbox.png'); ?>"
               alt="<?php esc_attr_e('Front panel close-up with indicator lights', 'figma-rebuild'); ?>">
        </div>
        <figcaption class="product-detail-hero__metric">
          <span class="product-detail-hero__metric-value">3</span>
          <span class="product-detail-hero__metric-label"><?php esc_html_e('Smart charging modes for peak, off-peak, and balanced use', 'figma-rebuild'); ?></span>
        </figcaption>
      </figure>
    </div>
  </section>

  <section class="cost-efficient" id="cost-efficient">
    <div class="cost-efficient__header">
      <h2 class="cost-efficient__title"><?php esc_html_e('Cost Efficient Home Charger', 'figma-rebuild'); ?></h2>
    </div>

    <div class="cost-efficient__grid">
      <article class="cost-card cost-card--tall">
        <div class="cost-card__image">
          <img src="<?php echo esc_url($template_uri . '/src/images/install_wallbox_news.png'); ?>"
               alt="<?php esc_attr_e('Homeowner interacting with wall-mounted charger', 'figma-rebuild'); ?>">
        </div>
        <div class="cost-card__content">
          <p class="cost-card__eyebrow"><?php esc_html_e('Intelligent & Efficient', 'figma-rebuild'); ?></p>
          <p class="cost-card__description"><?php esc_html_e('Automated load balancing and dynamic scheduling optimize every charging session while protecting household circuits.', 'figma-rebuild'); ?></p>
        </div>
      </article>

      <article class="cost-card cost-card--medium">
        <div class="cost-card__image">
          <img src="<?php echo esc_url($template_uri . '/src/images/maxperr_smart_30kW.png'); ?>"
               alt="<?php esc_attr_e('Internal electronics close-up', 'figma-rebuild'); ?>">
        </div>
        <div class="cost-card__content">
          <p class="cost-card__eyebrow"><?php esc_html_e('Secure & Reliable', 'figma-rebuild'); ?></p>
          <p class="cost-card__description"><?php esc_html_e('Built-in surge protection, ground fault monitoring, and OTA firmware keep the unit safe and up to date.', 'figma-rebuild'); ?></p>
        </div>
      </article>

      <article class="cost-card cost-card--wide">
        <div class="cost-card__image">
          <img src="<?php echo esc_url($template_uri . '/src/images/ev_app_control.jpg'); ?>"
               alt="<?php esc_attr_e('Mobile app displaying charging session overview', 'figma-rebuild'); ?>">
        </div>
        <div class="cost-card__content">
          <p class="cost-card__eyebrow"><?php esc_html_e('Flexible & Convenient', 'figma-rebuild'); ?></p>
          <p class="cost-card__description"><?php esc_html_e('Remote start, charging reminders, and utility rate integrations give you full control from anywhere.', 'figma-rebuild'); ?></p>
        </div>
      </article>
    </div>
  </section>

  <section class="product-specs" id="product-specs">
    <div class="product-specs__header">
      <h2 class="product-specs__title"><?php esc_html_e('Product Specs', 'figma-rebuild'); ?></h2>
    </div>

    <div class="product-specs__groups">
      <div class="product-specs__group">
        <h3 class="product-specs__group-title"><?php esc_html_e('Design', 'figma-rebuild'); ?></h3>
        <dl class="product-specs__list">
          <div class="product-specs__row">
            <dt><?php esc_html_e('Height', 'figma-rebuild'); ?></dt>
            <dd>420 mm</dd>
          </div>
          <div class="product-specs__row">
            <dt><?php esc_html_e('Width', 'figma-rebuild'); ?></dt>
            <dd>260 mm</dd>
          </div>
          <div class="product-specs__row">
            <dt><?php esc_html_e('Depth', 'figma-rebuild'); ?></dt>
            <dd>120 mm</dd>
          </div>
          <div class="product-specs__row">
            <dt><?php esc_html_e('Weight', 'figma-rebuild'); ?></dt>
            <dd>9.8 kg</dd>
          </div>
        </dl>
      </div>

      <div class="product-specs__group">
        <h3 class="product-specs__group-title"><?php esc_html_e('Input', 'figma-rebuild'); ?></h3>
        <dl class="product-specs__list">
          <div class="product-specs__row">
            <dt><?php esc_html_e('Grid Connection', 'figma-rebuild'); ?></dt>
            <dd>Single-phase</dd>
          </div>
          <div class="product-specs__row">
            <dt><?php esc_html_e('Voltage Range', 'figma-rebuild'); ?></dt>
            <dd>200 – 240 V AC</dd>
          </div>
          <div class="product-specs__row">
            <dt><?php esc_html_e('Maximum Current', 'figma-rebuild'); ?></dt>
            <dd>50 A</dd>
          </div>
          <div class="product-specs__row">
            <dt><?php esc_html_e('Frequency', 'figma-rebuild'); ?></dt>
            <dd>50 / 60 Hz</dd>
          </div>
        </dl>
      </div>

      <div class="product-specs__group">
        <h3 class="product-specs__group-title"><?php esc_html_e('Output', 'figma-rebuild'); ?></h3>
        <dl class="product-specs__list">
          <div class="product-specs__row">
            <dt><?php esc_html_e('Maximum Power', 'figma-rebuild'); ?></dt>
            <dd>12 kW</dd>
          </div>
          <div class="product-specs__row">
            <dt><?php esc_html_e('Charging Connector', 'figma-rebuild'); ?></dt>
            <dd>Type 1 (SAE J1772) / Type 2 option</dd>
          </div>
          <div class="product-specs__row">
            <dt><?php esc_html_e('Cable Length', 'figma-rebuild'); ?></dt>
            <dd>7.5 m</dd>
          </div>
          <div class="product-specs__row">
            <dt><?php esc_html_e('Efficiency', 'figma-rebuild'); ?></dt>
            <dd>≥ 95%</dd>
          </div>
        </dl>
      </div>

      <div class="product-specs__group">
        <h3 class="product-specs__group-title"><?php esc_html_e('System', 'figma-rebuild'); ?></h3>
        <dl class="product-specs__list">
          <div class="product-specs__row">
            <dt><?php esc_html_e('Connectivity', 'figma-rebuild'); ?></dt>
            <dd>Wi-Fi / Ethernet / Bluetooth LE</dd>
          </div>
          <div class="product-specs__row">
            <dt><?php esc_html_e('Smart Features', 'figma-rebuild'); ?></dt>
            <dd>App control, load management, OTA updates</dd>
          </div>
          <div class="product-specs__row">
            <dt><?php esc_html_e('User Interface', 'figma-rebuild'); ?></dt>
            <dd>LED status ring, capacitive touch panel</dd>
          </div>
          <div class="product-specs__row">
            <dt><?php esc_html_e('Communication', 'figma-rebuild'); ?></dt>
            <dd>OCPP 1.6 JSON, Modbus TCP</dd>
          </div>
        </dl>
      </div>

      <div class="product-specs__group">
        <h3 class="product-specs__group-title"><?php esc_html_e('Safety', 'figma-rebuild'); ?></h3>
        <dl class="product-specs__list">
          <div class="product-specs__row">
            <dt><?php esc_html_e('Protection', 'figma-rebuild'); ?></dt>
            <dd>IP55 enclosure, IK08 impact rating</dd>
          </div>
          <div class="product-specs__row">
            <dt><?php esc_html_e('Certifications', 'figma-rebuild'); ?></dt>
            <dd>UL 2231, UL 2594, IEC 61851-1, CE</dd>
          </div>
          <div class="product-specs__row">
            <dt><?php esc_html_e('Ground Fault', 'figma-rebuild'); ?></dt>
            <dd>20 mA CCID, self-test</dd>
          </div>
          <div class="product-specs__row">
            <dt><?php esc_html_e('Surge Protection', 'figma-rebuild'); ?></dt>
            <dd>Type 2 SPD, 8 kA</dd>
          </div>
        </dl>
      </div>

      <div class="product-specs__group">
        <h3 class="product-specs__group-title"><?php esc_html_e('Environment', 'figma-rebuild'); ?></h3>
        <dl class="product-specs__list">
          <div class="product-specs__row">
            <dt><?php esc_html_e('Operating Temperature', 'figma-rebuild'); ?></dt>
            <dd>-30°C to 50°C</dd>
          </div>
          <div class="product-specs__row">
            <dt><?php esc_html_e('Storage Temperature', 'figma-rebuild'); ?></dt>
            <dd>-40°C to 70°C</dd>
          </div>
          <div class="product-specs__row">
            <dt><?php esc_html_e('Humidity', 'figma-rebuild'); ?></dt>
            <dd>5% – 95% RH, non-condensing</dd>
          </div>
          <div class="product-specs__row">
            <dt><?php esc_html_e('Altitude', 'figma-rebuild'); ?></dt>
            <dd>≤ 2000 m</dd>
          </div>
        </dl>
      </div>
    </div>
  </section>

  <section class="compare-models" id="compare-models">
    <div class="compare-models__header">
      <div class="compare-models__intro">
        <h2 class="compare-models__title"><?php esc_html_e('Compare Models', 'figma-rebuild'); ?></h2>
        <p class="compare-models__subtitle"><?php esc_html_e('Review core specs side-by-side or schedule a call with our specialists for tailored guidance.', 'figma-rebuild'); ?></p>
      </div>
      <div class="compare-models__actions">
        <a class="compare-models__action compare-models__action--primary" href="#contact"><?php esc_html_e('Book Consultation', 'figma-rebuild'); ?></a>
        <a class="compare-models__action compare-models__action--ghost" href="#product-hero"><?php esc_html_e('Order Now', 'figma-rebuild'); ?></a>
      </div>
    </div>

    <div class="compare-models__columns">
      <div class="compare-models__column">
        <div class="compare-models__visual">
          <img src="<?php echo esc_url($template_uri . '/src/images/maxperr_home_10kW.png'); ?>"
               alt="<?php esc_attr_e('Eco 12kW AC charger', 'figma-rebuild'); ?>">
        </div>
        <h3 class="compare-models__model"><?php esc_html_e('Eco 12kW AC', 'figma-rebuild'); ?></h3>
        <div class="compare-models__select" role="presentation">
          <span><?php esc_html_e('Matte Graphite', 'figma-rebuild'); ?></span>
          <svg viewBox="0 0 12 8" aria-hidden="true"><path d="M1 1l5 6 5-6" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>

        <div class="compare-models__spec-group">
          <h4><?php esc_html_e('Design', 'figma-rebuild'); ?></h4>
          <div class="compare-models__spec-row"><span><?php esc_html_e('Dimensions', 'figma-rebuild'); ?></span><span>420 × 260 × 120 mm</span></div>
          <div class="compare-models__spec-row"><span><?php esc_html_e('Weight', 'figma-rebuild'); ?></span><span>9.8 kg</span></div>
        </div>
        <div class="compare-models__spec-group">
          <h4><?php esc_html_e('Input', 'figma-rebuild'); ?></h4>
          <div class="compare-models__spec-row"><span><?php esc_html_e('Voltage Range', 'figma-rebuild'); ?></span><span>200 – 240 V AC</span></div>
          <div class="compare-models__spec-row"><span><?php esc_html_e('Max Current', 'figma-rebuild'); ?></span><span>50 A</span></div>
        </div>
        <div class="compare-models__spec-group">
          <h4><?php esc_html_e('Output', 'figma-rebuild'); ?></h4>
          <div class="compare-models__spec-row"><span><?php esc_html_e('Max Power', 'figma-rebuild'); ?></span><span>12 kW</span></div>
          <div class="compare-models__spec-row"><span><?php esc_html_e('Connector', 'figma-rebuild'); ?></span><span>Type 1 / Type 2</span></div>
        </div>
        <div class="compare-models__spec-group">
          <h4><?php esc_html_e('System', 'figma-rebuild'); ?></h4>
          <div class="compare-models__spec-row"><span><?php esc_html_e('Connectivity', 'figma-rebuild'); ?></span><span>Wi-Fi / Ethernet</span></div>
          <div class="compare-models__spec-row"><span><?php esc_html_e('Smart Modes', 'figma-rebuild'); ?></span><span>App, OTA, load balance</span></div>
        </div>
        <div class="compare-models__spec-group">
          <h4><?php esc_html_e('Environment', 'figma-rebuild'); ?></h4>
          <div class="compare-models__spec-row"><span><?php esc_html_e('Operating Temp.', 'figma-rebuild'); ?></span><span>-30°C to 50°C</span></div>
          <div class="compare-models__spec-row"><span><?php esc_html_e('Ingress Rating', 'figma-rebuild'); ?></span><span>IP55</span></div>
        </div>
      </div>

      <div class="compare-models__column">
        <div class="compare-models__visual">
          <img src="<?php echo esc_url($template_uri . '/src/images/maxperr_smart_30kW.png'); ?>"
               alt="<?php esc_attr_e('Smart 30kW DC charger', 'figma-rebuild'); ?>">
        </div>
        <h3 class="compare-models__model"><?php esc_html_e('Smart 30kW DC', 'figma-rebuild'); ?></h3>
        <div class="compare-models__select" role="presentation">
          <span><?php esc_html_e('Brushed Silver', 'figma-rebuild'); ?></span>
          <svg viewBox="0 0 12 8" aria-hidden="true"><path d="M1 1l5 6 5-6" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>

        <div class="compare-models__spec-group">
          <h4><?php esc_html_e('Design', 'figma-rebuild'); ?></h4>
          <div class="compare-models__spec-row"><span><?php esc_html_e('Dimensions', 'figma-rebuild'); ?></span><span>520 × 310 × 180 mm</span></div>
          <div class="compare-models__spec-row"><span><?php esc_html_e('Weight', 'figma-rebuild'); ?></span><span>18.5 kg</span></div>
        </div>
        <div class="compare-models__spec-group">
          <h4><?php esc_html_e('Input', 'figma-rebuild'); ?></h4>
          <div class="compare-models__spec-row"><span><?php esc_html_e('Voltage Range', 'figma-rebuild'); ?></span><span>380 – 480 V AC</span></div>
          <div class="compare-models__spec-row"><span><?php esc_html_e('Max Current', 'figma-rebuild'); ?></span><span>48 A</span></div>
        </div>
        <div class="compare-models__spec-group">
          <h4><?php esc_html_e('Output', 'figma-rebuild'); ?></h4>
          <div class="compare-models__spec-row"><span><?php esc_html_e('Max Power', 'figma-rebuild'); ?></span><span>30 kW</span></div>
          <div class="compare-models__spec-row"><span><?php esc_html_e('Connector', 'figma-rebuild'); ?></span><span>CCS1 / CHAdeMO</span></div>
        </div>
        <div class="compare-models__spec-group">
          <h4><?php esc_html_e('System', 'figma-rebuild'); ?></h4>
          <div class="compare-models__spec-row"><span><?php esc_html_e('Connectivity', 'figma-rebuild'); ?></span><span>Wi-Fi / 4G / Ethernet</span></div>
          <div class="compare-models__spec-row"><span><?php esc_html_e('Smart Modes', 'figma-rebuild'); ?></span><span>Dynamic load share, demand response</span></div>
        </div>
        <div class="compare-models__spec-group">
          <h4><?php esc_html_e('Environment', 'figma-rebuild'); ?></h4>
          <div class="compare-models__spec-row"><span><?php esc_html_e('Operating Temp.', 'figma-rebuild'); ?></span><span>-35°C to 55°C</span></div>
          <div class="compare-models__spec-row"><span><?php esc_html_e('Ingress Rating', 'figma-rebuild'); ?></span><span>IP54</span></div>
        </div>
      </div>

      <button type="button" class="compare-models__add" aria-disabled="true">
        <span>+ <?php esc_html_e('Add Model', 'figma-rebuild'); ?></span>
      </button>
    </div>
  </section>
</main>

<?php get_footer(); ?>
