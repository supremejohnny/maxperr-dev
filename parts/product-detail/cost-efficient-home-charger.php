<?php
/**
 * Product Detail Cost Efficient Home Charger Section
 *
 * @package figma-rebuild
 */

$template_uri = get_template_directory_uri();
?>

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
