<?php
/**
 * Template Name: Landing Page Demo
 * 
 * This page demonstrates the responsive landing page template
 */

get_header(); ?>

<main class="landing-page">
  
  <!-- Our Value Section -->
  <section class="landing-section landing-section--our-value">
    <div class="landing-container">
      <div class="landing-content-wrapper">
        <div class="landing-image-container">
          <div class="landing-image-wrapper">
            <img src="<?php echo get_template_directory_uri(); ?>/src/images/bg_house.jpg" 
                 alt="<?php esc_attr_e('Sustainable energy solutions for modern homes', 'figma-rebuild'); ?>"
                 class="landing-image">
          </div>
        </div>
        
        <div class="landing-text-content">
          <h2 class="landing-section-title"><?php esc_html_e('Our Value', 'figma-rebuild'); ?></h2>
          <h3 class="landing-main-heading"><?php esc_html_e('Maxperr Energy offers cutting-edge EV charging solutions for a sustainable future', 'figma-rebuild'); ?></h3>
          <p class="landing-description">
            <?php esc_html_e('From intelligent charging to smart energy management, we design systems that ensure dependable performance for homes, businesses, and fleets. Our innovative technology creates a seamless transition to sustainable transportation.', 'figma-rebuild'); ?>
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Promise Section -->
  <section class="landing-section landing-section--our-promise">
    <div class="landing-container">
      <div class="landing-content-wrapper landing-content-wrapper--reverse">
        <div class="landing-image-container">
          <div class="landing-image-wrapper">
            <img src="<?php echo get_template_directory_uri(); ?>/src/images/ev_app_control.jpg" 
                 alt="<?php esc_attr_e('Smart EV charging app interface', 'figma-rebuild'); ?>"
                 class="landing-image">
          </div>
        </div>
        
        <div class="landing-text-content">
          <h2 class="landing-section-title"><?php esc_html_e('Our Promise', 'figma-rebuild'); ?></h2>
          <h3 class="landing-main-heading"><?php esc_html_e('Our fast EV chargers deliver up to 80% in just 30 minutes. Intelligent and efficient charging.', 'figma-rebuild'); ?></h3>
          <p class="landing-description">
            <?php esc_html_e('Experience the future of electric vehicle charging with our advanced technology. Smart charging protocols and user-friendly interfaces make the transition to electric mobility seamless and convenient for every driver.', 'figma-rebuild'); ?>
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Solutions Tailored Section -->
  <section class="landing-section landing-section--solutions">
    <div class="landing-container">
      <div class="landing-content-wrapper">
        <div class="landing-image-container">
          <div class="landing-image-wrapper">
            <img src="<?php echo get_template_directory_uri(); ?>/src/images/maxperr_expo.jpg" 
                 alt="<?php esc_attr_e('Maxperr team presenting solutions at technology expo', 'figma-rebuild'); ?>"
                 class="landing-image">
          </div>
        </div>
        
        <div class="landing-text-content">
          <h2 class="landing-section-title"><?php esc_html_e('Solutions Tailored to Your Needs', 'figma-rebuild'); ?></h2>
          <h3 class="landing-main-heading"><?php esc_html_e('Fast EV Chargers, Smart Charging Solutions, Eco-Friendly EV Chargers, Installation Services, Maintenance and Support, Innovative Charging', 'figma-rebuild'); ?></h3>
          <p class="landing-description">
            <?php esc_html_e('From single residential units to large commercial installations, our comprehensive suite of charging solutions is designed to meet diverse energy needs with precision and reliability. Every solution is customized for optimal performance.', 'figma-rebuild'); ?>
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Team Section -->
  <section class="landing-section landing-section--our-team">
    <div class="landing-container">
      <div class="landing-content-wrapper landing-content-wrapper--team">
        
        <!-- Team Grid -->
        <div class="landing-team-grid">
          <div class="landing-team-member">
            <img src="<?php echo get_template_directory_uri(); ?>/src/images/maxperr_home_10kW.png" 
                 alt="<?php esc_attr_e('Maxperr Home 10kW Charging Station', 'figma-rebuild'); ?>"
                 class="landing-team-image">
          </div>
          <div class="landing-team-member">
            <img src="<?php echo get_template_directory_uri(); ?>/src/images/maxperr_smart_30kW.png" 
                 alt="<?php esc_attr_e('Maxperr Smart 30kW Commercial Charger', 'figma-rebuild'); ?>"
                 class="landing-team-image">
          </div>
          <div class="landing-team-member">
            <img src="<?php echo get_template_directory_uri(); ?>/src/images/install_wallbox.png" 
                 alt="<?php esc_attr_e('Professional wallbox installation service', 'figma-rebuild'); ?>"
                 class="landing-team-image">
          </div>
          <div class="landing-team-member">
            <img src="<?php echo get_template_directory_uri(); ?>/src/images/ev_nav_map.jpg" 
                 alt="<?php esc_attr_e('EV charging station navigation and mapping', 'figma-rebuild'); ?>"
                 class="landing-team-image">
          </div>
          <div class="landing-team-member">
            <img src="<?php echo get_template_directory_uri(); ?>/src/images/bg_house2.jpg" 
                 alt="<?php esc_attr_e('Modern home with integrated EV charging', 'figma-rebuild'); ?>"
                 class="landing-team-image">
          </div>
          <div class="landing-team-member">
            <img src="<?php echo get_template_directory_uri(); ?>/src/images/bg_forest.jpg" 
                 alt="<?php esc_attr_e('Sustainable energy in natural environments', 'figma-rebuild'); ?>"
                 class="landing-team-image">
          </div>
        </div>
        
        <!-- Team Text Content -->
        <div class="landing-text-content">
          <h2 class="landing-section-title"><?php esc_html_e('Our Team', 'figma-rebuild'); ?></h2>
          <h3 class="landing-main-heading"><?php esc_html_e('Let us know as soon as convenient, advancing sustainable energy innovation throughout development', 'figma-rebuild'); ?></h3>
          <p class="landing-description">
            <?php esc_html_e('Our diverse team of engineers, designers, and energy specialists work collaboratively to deliver cutting-edge solutions that drive the future of sustainable transportation and energy infrastructure. Together, we are building tomorrow\'s energy ecosystem today.', 'figma-rebuild'); ?>
          </p>
        </div>
      </div>
    </div>
  </section>

</main>

<style>
/* Additional inline styles for demo purposes */
.landing-page {
  margin-top: -80px; /* Adjust for header if needed */
  padding-top: 80px;
}

/* Ensure smooth scrolling */
html {
  scroll-behavior: smooth;
}

/* Add some extra visual polish */
.landing-section {
  position: relative;
  overflow: hidden;
}

.landing-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.3), transparent);
  opacity: 0.5;
}
</style>

<?php get_footer(); ?>
