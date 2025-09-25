<?php
/**
 * Template Name: Responsive Landing Page
 * 
 * A responsive landing page with four main sections:
 * - Our Value (image left, text right)
 * - Our Promise (image right, text left)  
 * - Solutions Tailored (image left, text right)
 * - Our Team (team grid with text right)
 */

get_header(); ?>

<main class="landing-page">
  
  <!-- Our Value Section -->
  <section class="landing-section landing-section--our-value">
    <div class="landing-container">
      <div class="landing-content-wrapper">
        <div class="landing-image-container">
          <div class="landing-image-wrapper">
            <img src="<?php echo get_template_directory_uri(); ?>/src/images/ev_charging_pic.jpg" 
                 alt="<?php esc_attr_e('Maxperr Energy charging solutions for sustainable future', 'figma-rebuild'); ?>"
                 class="landing-image">
          </div>
        </div>
        
        <div class="landing-text-content">
          <h2 class="landing-section-title"><?php esc_html_e('Our Value', 'figma-rebuild'); ?></h2>
          <h3 class="landing-main-heading"><?php esc_html_e('Maxperr Energy offers cutting-edge EV charging solutions for a sustainable future', 'figma-rebuild'); ?></h3>
          <p class="landing-description">
            <?php esc_html_e('We provide intelligent charging infrastructure that adapts to your needs, whether for residential, commercial, or fleet applications. Our innovative technology ensures reliable, efficient, and environmentally conscious energy solutions.', 'figma-rebuild'); ?>
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
                 alt="<?php esc_attr_e('Our fast EV chargers deliver up to 80% in just 30 minutes', 'figma-rebuild'); ?>"
                 class="landing-image">
          </div>
        </div>
        
        <div class="landing-text-content">
          <h2 class="landing-section-title"><?php esc_html_e('Our Promise', 'figma-rebuild'); ?></h2>
          <h3 class="landing-main-heading"><?php esc_html_e('Our fast EV chargers deliver up to 80% in just 30 minutes. Intelligent and efficient charging.', 'figma-rebuild'); ?></h3>
          <p class="landing-description">
            <?php esc_html_e('Experience the future of electric vehicle charging with our advanced technology. Smart charging protocols and user-friendly interfaces make the transition to electric mobility seamless and convenient for everyone.', 'figma-rebuild'); ?>
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
                 alt="<?php esc_attr_e('Solutions Tailored to Your Needs', 'figma-rebuild'); ?>"
                 class="landing-image">
          </div>
        </div>
        
        <div class="landing-text-content">
          <h2 class="landing-section-title"><?php esc_html_e('Solutions Tailored to Your Needs', 'figma-rebuild'); ?></h2>
          <h3 class="landing-main-heading"><?php esc_html_e('Fast EV Chargers, Smart Charging Solutions, Eco-Friendly EV Chargers, Installation Services, Maintenance and Support, Innovative Charging', 'figma-rebuild'); ?></h3>
          <p class="landing-description">
            <?php esc_html_e('From single residential units to large commercial installations, our comprehensive suite of charging solutions is designed to meet diverse energy needs with precision and reliability.', 'figma-rebuild'); ?>
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
                 alt="<?php esc_attr_e('Team Member 1', 'figma-rebuild'); ?>"
                 class="landing-team-image">
          </div>
          <div class="landing-team-member">
            <img src="<?php echo get_template_directory_uri(); ?>/src/images/maxperr_smart_30kW.png" 
                 alt="<?php esc_attr_e('Team Member 2', 'figma-rebuild'); ?>"
                 class="landing-team-image">
          </div>
          <div class="landing-team-member">
            <img src="<?php echo get_template_directory_uri(); ?>/src/images/install_wallbox.png" 
                 alt="<?php esc_attr_e('Team Member 3', 'figma-rebuild'); ?>"
                 class="landing-team-image">
          </div>
          <div class="landing-team-member">
            <img src="<?php echo get_template_directory_uri(); ?>/src/images/ev_nav_map.jpg" 
                 alt="<?php esc_attr_e('Team Member 4', 'figma-rebuild'); ?>"
                 class="landing-team-image">
          </div>
          <div class="landing-team-member">
            <img src="<?php echo get_template_directory_uri(); ?>/src/images/bg_house.jpg" 
                 alt="<?php esc_attr_e('Team Member 5', 'figma-rebuild'); ?>"
                 class="landing-team-image">
          </div>
          <div class="landing-team-member">
            <img src="<?php echo get_template_directory_uri(); ?>/src/images/bg_house2.jpg" 
                 alt="<?php esc_attr_e('Team Member 6', 'figma-rebuild'); ?>"
                 class="landing-team-image">
          </div>
        </div>
        
        <!-- Team Text Content -->
        <div class="landing-text-content">
          <h2 class="landing-section-title"><?php esc_html_e('Our Team', 'figma-rebuild'); ?></h2>
          <h3 class="landing-main-heading"><?php esc_html_e('Let us know as soon as convenient, advancing sustainable energy innovation throughout development', 'figma-rebuild'); ?></h3>
          <p class="landing-description">
            <?php esc_html_e('Our diverse team of engineers, designers, and energy specialists work collaboratively to deliver cutting-edge solutions that drive the future of sustainable transportation and energy infrastructure.', 'figma-rebuild'); ?>
          </p>
        </div>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>
