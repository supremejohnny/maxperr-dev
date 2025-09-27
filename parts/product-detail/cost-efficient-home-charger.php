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
    <h2 class="H2-Black" style="margin-bottom: 40px;"><?php echo esc_html(get_theme_mod('product_detail_cost_title', __('Cost Efficient Home Charger', 'figma-rebuild'))); ?></h2>
    <div class="product-detail-cost__grid">
      <?php
      $cost_cards = json_decode(get_theme_mod('product_detail_cost_cards', '[]'), true);
      $card_classes = ['product-detail-cost__card--tall', 'product-detail-cost__card--medium', 'product-detail-cost__card--wide'];
      $text_colors = ['#000', '#000', '#FFF'];
      $max_widths = ['510px', '480px', '680px'];
      
      if (!empty($cost_cards)) {
        foreach ($cost_cards as $index => $card) {
          $card_class = isset($card_classes[$index]) ? $card_classes[$index] : 'product-detail-cost__card--tall';
          $text_color = isset($text_colors[$index]) ? $text_colors[$index] : '#000';
          $max_width = isset($max_widths[$index]) ? $max_widths[$index] : '510px';
          ?>
          <article class="product-detail-cost__card <?php echo esc_attr($card_class); ?>">
            <img
              class="product-detail-cost__image"
              src="<?php echo esc_url($card['image'] ?? $template_uri . '/src/images/detail-Image-Top-Left.png'); ?>"
              alt="<?php echo esc_attr($card['title'] ?? 'Product feature'); ?>"
            />
            <div class="product-detail-cost__content">
              <h3 class="H3" style="color: <?php echo esc_attr($text_color); ?>"><?php echo esc_html($card['title'] ?? ''); ?></h3>
              <p class="Body-1" style="color: <?php echo esc_attr($text_color); ?>; max-width: <?php echo esc_attr($max_width); ?>;">
                <?php echo wp_kses_post($card['description'] ?? ''); ?>
              </p>
            </div>
          </article>
          <?php
        }
      } else {
        // Fallback to default cards
        ?>
        <article class="product-detail-cost__card product-detail-cost__card--tall">
          <img
            class="product-detail-cost__image"
            src="<?php echo esc_url($template_uri . '/src/images/detail-Image-Top-Left.png'); ?>"
            alt="<?php esc_attr_e('Intelligent & Efficient home charging solution', 'figma-rebuild'); ?>"
          />
          <div class="product-detail-cost__content">
            <h3 class="H3"><?php esc_html_e('Intelligent & Efficient', 'figma-rebuild'); ?></h3>
            <p class="Body-1" style="color: #000; max-width: 510px;">
              <?php esc_html_e('Dynamic load balancing protects your home supply while prioritising the lowest tariff windows for every session.', 'figma-rebuild'); ?>
            </p>
          </div>
        </article>

        <article class="product-detail-cost__card product-detail-cost__card--medium">
          <img
            class="product-detail-cost__image"
            src="<?php echo esc_url($template_uri . '/src/images/detail-Image-Top-Right.png'); ?>"
            alt="<?php esc_attr_e('Secure & Reliable charging technology', 'figma-rebuild'); ?>"
          />
          <div class="product-detail-cost__content">
            <h3 class="H3"><?php esc_html_e('Secure & Reliable', 'figma-rebuild'); ?></h3>
            <p class="Body-1" style="color: #000; max-width: 480px;">
              <?php esc_html_e('Built-in surge defence, ground-fault monitoring and auto-diagnostics keep every charge session protected.', 'figma-rebuild'); ?>
            </p>
          </div>
        </article>

        <article class="product-detail-cost__card product-detail-cost__card--wide">
          <img
            class="product-detail-cost__image"
            src="<?php echo esc_url($template_uri . '/src/images/detail-Image-Bottom.png'); ?>"
            alt="<?php esc_attr_e('Flexible & Convenient charging management', 'figma-rebuild'); ?>"
          />
          <div class="product-detail-cost__content">
            <h3 class="H3" style="color:#FFF"><?php esc_html_e('Flexible & Convenient', 'figma-rebuild'); ?></h3>
            <p class="Body-1" style="color: #FFF; max-width: 680px;">
              <?php esc_html_e('Control sessions remotely, share access securely with family members and review energy history in real time.', 'figma-rebuild'); ?>
            </p>
          </div>
        </article>
        <?php
      }
      ?>
    </div>
  </div>
</section>
