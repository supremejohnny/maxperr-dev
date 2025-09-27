<?php
  $hero_title = get_theme_mod('products_hero_title', __('EV Chargers', 'figma-rebuild'));
  $hero_subtitle = get_theme_mod('products_hero_subtitle', __('We offer the equipment, installation service and 24/7 technical support.', 'figma-rebuild'));
  $hero_button_text = get_theme_mod('products_hero_button_text', __('Learn More', 'figma-rebuild'));
  $hero_button_link = get_theme_mod('products_hero_button_link', '#charger-cards');

  $template_uri = get_template_directory_uri();
  $hero_background = get_theme_mod(
    'products_hero_bg_image',
    $template_uri . '/src/images/product-Hero-Image.png'
  );
?>

<section class="hero-section subpage-hero relative overflow-hidden w-full" id="products-hero">
  <style>
    /* Products Hero Responsive Styles */
    #products-hero .subpage-hero__inner {
      padding-top: 59px;
    }
    
    #products-hero .products-hero-title {
      color: #000;
      margin-bottom: 10px;
    }
    
    #products-hero .products-hero-subtitle {
      color: #000;
      margin-bottom: 20px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 1200px) {
      #products-hero .subpage-hero__inner {
        padding-top: 20px;
      }
      
      #products-hero .products-hero-title {
        margin-bottom: 6px;
      }
      
      #products-hero .products-hero-subtitle {
        margin-bottom: 12px;
      }
    }
    
    @media (max-width: 768px) {
      #products-hero .subpage-hero__inner {
        padding-top: 30px;
      }
      
      #products-hero .products-hero-title {
        margin-bottom: 6px;
      }
      
      #products-hero .products-hero-subtitle {
        margin-bottom: 12px;
      }
    }
    
    @media (max-width: 480px) {
      #products-hero .subpage-hero__inner {
        padding-top: 20px;
      }
      
      #products-hero .products-hero-title {
        margin-bottom: 4px;
      }
      
      #products-hero .products-hero-subtitle {
        margin-bottom: 10px;
      }
    }
  </style>
  
  <div class="hero-bg-layer is-active"<?php echo $hero_background ? ' style="background-image:url(' . esc_url($hero_background) . ');"' : ''; ?>></div>
  <div class="hero-overlay subpage-hero__overlay"></div>

  <div class="subpage-hero__inner">
    <?php if (!empty($hero_title)) : ?>
      <h1 class="H2-Black products-hero-title">
        <?php echo esc_html($hero_title); ?>
      </h1>
    <?php endif; ?>

    <?php if (!empty($hero_subtitle)) : ?>
      <p class="Body-1 products-hero-subtitle">
        <?php echo wp_kses_post($hero_subtitle); ?>
      </p>
    <?php endif; ?>

    <?php if (!empty($hero_button_text)) : ?>
      <a class="One-Column-Learn-More-Button subpage-hero__cta" href="<?php echo esc_url($hero_button_link); ?>">
        <?php echo esc_html($hero_button_text); ?>
      </a>
    <?php endif; ?>
  </div>
</section>
