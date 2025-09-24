<?php
/**
 * Solutions page helper defaults and utilities.
 */

if (!function_exists('figma_rebuild_get_solutions_defaults')) {
  /**
   * Provide default content for the Solutions page sections.
   *
   * @return array
   */
  function figma_rebuild_get_solutions_defaults() {
    $template_uri = get_template_directory_uri();

    return [
      'hero'      => [
        'title'       => '',
        'headline'    => __('Solutions', 'figma-rebuild'),
        'description' => __('We offer the equipment, installation service and 24/7 technical support.', 'figma-rebuild'),
        'background'  => $template_uri . '/src/images/bg_house.jpg',
      ],
      'services'  => [
        'title'       => __('What service do I need?', 'figma-rebuild'),
        'description' => __('Select the path that matches your project and see how Maxperr delivers safe, reliable charging across residential, commercial, and funded deployments.', 'figma-rebuild'),
        'items'       => [
          [
            'label'       => __('Home Charging', 'figma-rebuild'),
            'title'       => __('Residential solutions', 'figma-rebuild'),
            'description' => __('Level 2 chargers, permitting, and white-glove installation services made for Canadian homes.', 'figma-rebuild'),
            'image'       => 'https://images.unsplash.com/photo-1617813489478-62d083d70a75?auto=format&fit=crop&w=800&q=80',
            'link_label'  => __('Explore home', 'figma-rebuild'),
            'link_url'    => '#solutions-home',
          ],
          [
            'label'       => __('Commercial', 'figma-rebuild'),
            'title'       => __('Workplace & retail', 'figma-rebuild'),
            'description' => __('Turn-key charging programs for offices, mixed-use buildings, and public destinations.', 'figma-rebuild'),
            'image'       => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=800&q=80',
            'link_label'  => __('Explore commercial', 'figma-rebuild'),
            'link_url'    => '#solutions-commercial',
          ],
          [
            'label'       => __('Fleet', 'figma-rebuild'),
            'title'       => __('Fleet electrification', 'figma-rebuild'),
            'description' => __('Scalable AC/DC infrastructure, depot design, and energy management for fleet operators.', 'figma-rebuild'),
            'image'       => 'https://images.unsplash.com/photo-1625480864588-23a57dc3884b?auto=format&fit=crop&w=800&q=80',
            'link_label'  => __('Explore fleet', 'figma-rebuild'),
            'link_url'    => '#solutions-fleet',
          ],
          [
            'label'       => __('ZEVIP Funding', 'figma-rebuild'),
            'title'       => __('Funding guidance', 'figma-rebuild'),
            'description' => __('Strategic support to navigate Natural Resources Canada\'s incentive program and secure rebates.', 'figma-rebuild'),
            'image'       => 'https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=800&q=80',
            'link_label'  => __('Explore ZEVIP', 'figma-rebuild'),
            'link_url'    => '#solutions-zevip',
          ],
        ],
      ],
      'home'      => [
        'heading'     => __('Home', 'figma-rebuild'),
        'intro'       => __('Perfect for homeowners seeking reliable, code-compliant Level 2 charging with professional installation and monitoring.', 'figma-rebuild'),
        'badge'       => __('Home', 'figma-rebuild'),
        'card_title'  => __('Eco Home EV Charger', 'figma-rebuild'),
        'card_body'   => __('Maxperr bundles hardware, permitting, and support so you never have to worry about charging at home.', 'figma-rebuild'),
        'features'    => [
          ['text' => __('Home Power Bundle', 'figma-rebuild')],
          ['text' => __('Smart monitoring app', 'figma-rebuild')],
          ['text' => __('CSA & ESA certified installers', 'figma-rebuild')],
        ],
        'note'        => __('Best for detached and semi-detached homes across Canada.', 'figma-rebuild'),
        'button_text' => __('Book a home visit', 'figma-rebuild'),
        'button_link' => '#contact',
        'image'       => 'https://images.unsplash.com/photo-1617813489264-6a508a403ef2?auto=format&fit=crop&w=900&q=80',
      ],
      'commercial' => [
        'heading'     => __('Commercial', 'figma-rebuild'),
        'intro'       => __('Support tenant retention, attract EV drivers, and monetize charging across mixed-use properties.', 'figma-rebuild'),
        'badge'       => __('Commercial', 'figma-rebuild'),
        'card_title'  => __('Smart 30kW DC Charger', 'figma-rebuild'),
        'card_body'   => __('Designed for multi-unit residential buildings, workplaces, and retail locations needing fast turnaround.', 'figma-rebuild'),
        'features'    => [
          ['text' => __('Load balancing & demand response', 'figma-rebuild')],
          ['text' => __('Revenue-grade energy metering', 'figma-rebuild')],
          ['text' => __('24/7 remote operations center', 'figma-rebuild')],
        ],
        'note'        => __('Ideal for property managers and developers planning mixed-access charging.', 'figma-rebuild'),
        'button_text' => __('Plan your site', 'figma-rebuild'),
        'button_link' => '#contact',
        'image'       => 'https://images.unsplash.com/photo-1529429617124-aee711f6a1c9?auto=format&fit=crop&w=900&q=80',
      ],
      'fleet'     => [
        'heading'     => __('Fleet', 'figma-rebuild'),
        'intro'       => __('Engineer dependable depot charging with smart scheduling, peak shaving, and lifecycle support.', 'figma-rebuild'),
        'badge'       => __('Fleet', 'figma-rebuild'),
        'card_title'  => __('Pro 180kW DC Charger', 'figma-rebuild'),
        'card_body'   => __('Transition light-, medium-, and heavy-duty vehicles with modular DC fast charging and software integrations.', 'figma-rebuild'),
        'features'    => [
          ['text' => __('Depot energy modelling', 'figma-rebuild')],
          ['text' => __('Charging management platform', 'figma-rebuild')],
          ['text' => __('Preventive maintenance programs', 'figma-rebuild')],
        ],
        'note'        => __('Supports fleet yards, logistics hubs, and municipal operations.', 'figma-rebuild'),
        'button_text' => __('Talk to fleet experts', 'figma-rebuild'),
        'button_link' => '#contact',
        'image'       => 'https://images.unsplash.com/photo-1617813489622-95823483363d?auto=format&fit=crop&w=900&q=80',
      ],
      'zevip'     => [
        'heading'     => __('Zero Emission Vehicle Infrastructure Program (ZEVIP)', 'figma-rebuild'),
        'intro'       => __('Maxperr helps Canadian businesses maximize Natural Resources Canada rebates with turnkey project development and grant writing support.', 'figma-rebuild'),
        'features'    => [
          ['text' => __('Grant intake strategy & application support', 'figma-rebuild')],
          ['text' => __('Engineering drawings & budgetary planning', 'figma-rebuild')],
          ['text' => __('Measurement & verification reporting', 'figma-rebuild')],
        ],
        'button_text' => __('Download the ZEVIP guide', 'figma-rebuild'),
        'button_link' => '#',
        'image'       => 'https://images.unsplash.com/photo-1470246973918-29a93221c455?auto=format&fit=crop&w=1000&q=80',
      ],
      'book'      => [
        'title'       => __('Want more details?', 'figma-rebuild'),
        'description' => __('Connect with our specialists to scope your project, secure incentives, and schedule installation timelines.', 'figma-rebuild'),
        'background'  => $template_uri . '/src/images/bg_forest.jpg',
        'cards'       => [
          [
            'title'       => __('Sales Inquiries', 'figma-rebuild'),
            'description' => __('Work with our consultants to scope equipment, installation, and funding options tailored to your site.', 'figma-rebuild'),
            'cta_label'   => __('sales@maxperr.com', 'figma-rebuild'),
            'cta_url'     => 'mailto:sales@maxperr.com',
          ],
          [
            'title'       => __('Technical Support', 'figma-rebuild'),
            'description' => __('Get help with commissioning, software onboarding, and preventative maintenance scheduling.', 'figma-rebuild'),
            'cta_label'   => __('1-800-000-0000', 'figma-rebuild'),
            'cta_url'     => 'tel:18000000000',
          ],
        ],
      ],
    ];
  }
}

if (!function_exists('figma_rebuild_get_solutions_section_data')) {
  /**
   * Collect the display data for a Solutions content section.
   *
   * @param string $section_key Section slug (home, commercial, fleet).
   *
   * @return array
   */
  function figma_rebuild_get_solutions_section_data($section_key) {
    if (empty($section_key)) {
      return [];
    }

    $defaults = function_exists('figma_rebuild_get_solutions_defaults') ? figma_rebuild_get_solutions_defaults() : [];
    $section_defaults = isset($defaults[$section_key]) ? $defaults[$section_key] : [];

    $data = [
      'key'         => $section_key,
      'heading'     => get_theme_mod('solutions_' . $section_key . '_heading', isset($section_defaults['heading']) ? $section_defaults['heading'] : ''),
      'intro'       => get_theme_mod('solutions_' . $section_key . '_intro', isset($section_defaults['intro']) ? $section_defaults['intro'] : ''),
      'badge'       => get_theme_mod('solutions_' . $section_key . '_badge', isset($section_defaults['badge']) ? $section_defaults['badge'] : ''),
      'card_title'  => get_theme_mod('solutions_' . $section_key . '_card_title', isset($section_defaults['card_title']) ? $section_defaults['card_title'] : ''),
      'card_body'   => get_theme_mod('solutions_' . $section_key . '_card_body', isset($section_defaults['card_body']) ? $section_defaults['card_body'] : ''),
      'note'        => get_theme_mod('solutions_' . $section_key . '_note', isset($section_defaults['note']) ? $section_defaults['note'] : ''),
      'button_text' => get_theme_mod('solutions_' . $section_key . '_button_text', isset($section_defaults['button_text']) ? $section_defaults['button_text'] : ''),
      'button_link' => get_theme_mod('solutions_' . $section_key . '_button_link', isset($section_defaults['button_link']) ? $section_defaults['button_link'] : ''),
      'image'       => get_theme_mod('solutions_' . $section_key . '_image', isset($section_defaults['image']) ? $section_defaults['image'] : ''),
      'features'    => function_exists('figma_rebuild_get_repeater_mod')
        ? figma_rebuild_get_repeater_mod('solutions_' . $section_key . '_features', isset($section_defaults['features']) ? $section_defaults['features'] : [])
        : [],
    ];

    $data['section_id'] = 'solutions-' . sanitize_title(isset($data['heading']) && $data['heading'] ? $data['heading'] : $section_key);

    return $data;
  }
}

if (!function_exists('figma_rebuild_get_repeater_mod')) {
  /**
   * Retrieve and decode a JSON repeater theme mod.
   *
   * @param string $setting Setting key.
   * @param array  $default Default array of values.
   *
   * @return array
   */
  function figma_rebuild_get_repeater_mod($setting, $default = []) {
    $raw = get_theme_mod($setting, wp_json_encode($default));

    if (is_array($raw)) {
      $decoded = $raw;
    } elseif (is_string($raw)) {
      $decoded = json_decode($raw, true);
    } else {
      $decoded = [];
    }

    if (!is_array($decoded)) {
      return [];
    }

    return array_values(array_filter($decoded, function ($item) {
      if (!is_array($item)) {
        return false;
      }

      foreach ($item as $value) {
        if ('' !== trim((string) $value)) {
          return true;
        }
      }

      return false;
    }));
  }
}

if (!function_exists('figma_rebuild_get_solutions_page_url')) {
  /**
   * Locate the permalink for the published Solutions page.
   *
   * @return string
   */
  function figma_rebuild_get_solutions_page_url() {
    static $cached_url = null;

    if (null !== $cached_url) {
      return $cached_url;
    }

    $solutions_page = null;

    $template_pages = get_posts([
      'post_type'      => 'page',
      'post_status'    => 'publish',
      'posts_per_page' => 1,
      'meta_key'       => '_wp_page_template',
      'meta_value'     => 'templates/page-solutions.php',
      'orderby'        => 'menu_order',
      'order'          => 'ASC',
      'no_found_rows'  => true,
    ]);

    if (!empty($template_pages)) {
      $solutions_page = $template_pages[0];
    }

    if (!$solutions_page instanceof WP_Post) {
      $candidate_page = get_page_by_path('solutions');

      if ($candidate_page instanceof WP_Post && 'publish' === get_post_status($candidate_page->ID)) {
        $solutions_page = $candidate_page;
      }
    }

    if (!$solutions_page instanceof WP_Post) {
      $candidate_page = get_page_by_title('Solutions');

      if ($candidate_page instanceof WP_Post && 'publish' === get_post_status($candidate_page->ID)) {
        $solutions_page = $candidate_page;
      }
    }

    if ($solutions_page instanceof WP_Post) {
      $permalink = get_permalink($solutions_page);

      if ($permalink) {
        $cached_url = $permalink;

        return $cached_url;
      }
    }

    return home_url('/solutions/');
  }
}
