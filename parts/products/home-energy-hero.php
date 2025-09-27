<?php
  $hero_title = get_theme_mod('home_energy_hero_title', __('Home Energy', 'figma-rebuild'));
  $hero_subtitle = get_theme_mod('home_energy_hero_subtitle', __('10 years warranty. Designed to save utility cost in the long run.', 'figma-rebuild'));
  $hero_button_text = get_theme_mod('home_energy_hero_button_text', __('Learn More', 'figma-rebuild'));
  $hero_button_link = get_theme_mod('home_energy_hero_button_link', '#home-energy-cards');

  $template_uri = get_template_directory_uri();
  $hero_background = get_theme_mod(
    'home_energy_hero_bg_image',
    $template_uri . '/src/images/product-Home-Energy-Hero.png'
  );
?>

<section class="hero-section subpage-hero relative overflow-hidden w-full" id="home-energy-hero">
  <style>
    /* Home Energy Hero Responsive Styles */
    #home-energy-hero .home-energy-hero-title {
      color: #FFF;
      margin-top: 79px;
    }
    
    #home-energy-hero .home-energy-hero-subtitle {
      color: #FFF;
      margin-top: 10px;
    }
    
    #home-energy-hero .home-energy-hero-button {
      margin-top: 20px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 1200px) {
      #home-energy-hero .home-energy-hero-title {
        margin-top: 30px;
      }
      
      #home-energy-hero .home-energy-hero-subtitle {
        margin-top: 6px;
      }
      
      #home-energy-hero .home-energy-hero-button {
        margin-top: 10px;
      }
    }
    
    @media (max-width: 768px) {
      #home-energy-hero .home-energy-hero-title {
        margin-top: 40px;
      }
      
      #home-energy-hero .home-energy-hero-subtitle {
        margin-top: 6px;
      }
      
      #home-energy-hero .home-energy-hero-button {
        margin-top: 12px;
      }
    }
    
    @media (max-width: 480px) {
      #home-energy-hero .home-energy-hero-title {
        margin-top: 30px;
      }
      
      #home-energy-hero .home-energy-hero-subtitle {
        margin-top: 4px;
      }
      
      #home-energy-hero .home-energy-hero-button {
        margin-top: 10px;
      }
    }
  </style>
  
  <div class="hero-bg-layer is-active"<?php echo $hero_background ? ' style="background-image:url(' . esc_url($hero_background) . ');"' : ''; ?>></div>
  <div class="hero-overlay subpage-hero__overlay"></div>

  <div class="subpage-hero__inner">
    <?php if (!empty($hero_title)) : ?>
      <h1 class="H2-Black home-energy-hero-title">
        <?php echo esc_html($hero_title); ?>
      </h1>
    <?php endif; ?>

    <?php if (!empty($hero_subtitle)) : ?>
      <p class="Body-1 home-energy-hero-subtitle">
        <?php echo wp_kses_post($hero_subtitle); ?>
      </p>
    <?php endif; ?>

    <?php if (!empty($hero_button_text)) : ?>
      <a class="One-Column-Learn-More-Button subpage-hero__cta home-energy-hero-button" href="<?php echo esc_url($hero_button_link); ?>">
        <?php echo esc_html($hero_button_text); ?>
      </a>
    <?php endif; ?>
  </div>
</section>
