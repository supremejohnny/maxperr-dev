<?php
/**
 * About page CTA - Power the Future Together Section
 */

$power_future_title = get_theme_mod('about_power_future_title', __('Let\'s Power the Future Together.', 'figma-rebuild'));
$primary_button_text = get_theme_mod('about_power_future_primary_button_text', __('Contact Us', 'figma-rebuild'));
$primary_button_link = get_theme_mod('about_power_future_primary_button_link', '#contact');
$secondary_button_text = get_theme_mod('about_power_future_secondary_button_text', __('Careers', 'figma-rebuild'));
$secondary_button_link = get_theme_mod('about_power_future_secondary_button_link', '#careers');
?>

<section id="power-future" class="power-future-section">
  <div class="power-future__container">
    <h2 class="power-future__title"><?php echo esc_html($power_future_title); ?></h2>
    
    <div class="power-future__buttons">
      <a href="<?php echo esc_url($primary_button_link); ?>" class="One-Column-Learn-More-Button power-future__button--primary"><?php echo esc_html($primary_button_text); ?></a>
      <a href="<?php echo esc_url($secondary_button_link); ?>" class="Two-Column-Learn-More-Button power-future__button--secondary"><?php echo esc_html($secondary_button_text); ?></a>
    </div>
  </div>
</section>

<style>
.power-future-section {
  padding: 80px 0;
  background: #ffffff;
  border: 1px solid #e0f2fe;
}

.power-future__container {
  max-width: 840px;
  margin: 0 auto;
  padding: 0 24px;
  text-align: center;
}

.power-future__title {
  margin: 0 0 32px;
  font-size: 48px;
  font-weight: 700;
  color: #0f172a;
  letter-spacing: -0.02em;
}

.power-future__buttons {
  display: flex;
  gap: 16px;
  justify-content: center;
  flex-wrap: wrap;
}

.power-future__button {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 16px 32px;
  border-radius: 12px;
  font-weight: 600;
  font-size: 16px;
  text-decoration: none;
  border: none;
  cursor: pointer;
  transition: all 0.2s ease;
  min-width: 140px;
}

.power-future__button--primary {
  background: #2563eb;
  color: #ffffff;
}

.power-future__button--primary:hover {
  background: #1d4ed8;
}

.power-future__button--secondary {
  background: #ffffff;
  color: #0f172a;
  border: 2px solid #0f172a;
}

.power-future__button--secondary:hover {
  background: #0f172a;
  color: #ffffff;
}

@media (max-width: 768px) {
  .power-future-section {
    padding: 60px 0;
  }
  
  .power-future__container {
    padding: 0 16px;
  }
  
  .power-future__title {
    font-size: 36px;
  }
  
  .power-future__buttons {
    flex-direction: column;
    align-items: center;
  }
  
  .power-future__button {
    width: 100%;
    max-width: 280px;
    padding: 14px 28px;
    font-size: 15px;
  }
}

@media (max-width: 480px) {
  .power-future__title {
    font-size: 32px;
  }
  
  .power-future__button {
    padding: 12px 24px;
    font-size: 14px;
  }
}
</style>
