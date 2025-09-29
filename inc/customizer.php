<?php

if (!class_exists('WP_Customize_Control') && defined('ABSPATH')) {
  require_once ABSPATH . WPINC . '/class-wp-customize-control.php';
}

if (class_exists('WP_Customize_Control') && !class_exists('Figma_Rebuild_Repeater_Control')) {
  /**
   * Simple repeater control for the Customizer.
   */
  class Figma_Rebuild_Repeater_Control extends WP_Customize_Control {
    public $type = 'figma_repeater';
    /** @var array[] */
    public $fields = [];
    /** @var string */
    public $add_button_label = '';
    /** @var string */
    public $item_label = '';

    public function render_content() {
      if (empty($this->fields)) return;

      $value = $this->value();
      $items = json_decode($value, true);
      if (!is_array($items)) $items = [];

      $fields_json = wp_json_encode($this->fields);
      $add_label   = $this->add_button_label ?: __('Add Item', 'figma-rebuild');
      $item_label  = $this->item_label ?: __('Item', 'figma-rebuild');

      echo '<div class="figma-repeater" data-fields="' . esc_attr($fields_json) . '">';

      if (!empty($this->label)) {
        echo '<span class="customize-control-title">' . esc_html($this->label) . '</span>';
      }

      if (!empty($this->description)) {
        echo '<span class="description customize-control-description">' . wp_kses_post($this->description) . '</span>';
      }

      echo '<div class="figma-repeater__items">';
      if (!empty($items)) {
        foreach ($items as $item) {
          echo $this->get_item_markup($item, $item_label); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
      }
      echo '</div>';

      echo '<button type="button" class="button figma-repeater__add">' . esc_html($add_label) . '</button>';
      echo '<input type="hidden" class="figma-repeater__store" ' . $this->get_link() . ' value="' . esc_attr(wp_json_encode($items)) . '" />';

      echo '<template class="figma-repeater__template">' . $this->get_item_markup([], $item_label) . '</template>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
      echo '</div>';
    }

    protected function get_item_markup($item = [], $item_label = '') {
      if (!is_array($item)) $item = [];
      $label = $item_label ?: __('Item', 'figma-rebuild');

      ob_start();
      echo '<div class="figma-repeater__item">';
      echo '<div class="figma-repeater__item-header">';
      echo '<span class="figma-repeater__item-title" data-label-base="' . esc_attr($label) . '">' . esc_html($label) . '</span>';
      echo '<button type="button" class="button-link figma-repeater__remove" aria-label="' . esc_attr__('Remove', 'figma-rebuild') . '">&times;</button>';
      echo '</div>';

      foreach ($this->fields as $field) {
        $field_id = isset($field['id']) ? $field['id'] : '';
        if (!$field_id) continue;

        $label_text = isset($field['label']) ? $field['label'] : $field_id;
        $type       = isset($field['type']) ? $field['type'] : 'text';
        $value      = isset($item[$field_id]) ? $item[$field_id] : '';

        echo '<label class="figma-repeater__field">';
        echo '<span class="figma-repeater__field-label">' . esc_html($label_text) . '</span>';

        if ('textarea' === $type) {
          echo '<textarea class="figma-repeater__input" data-field="' . esc_attr($field_id) . '" rows="4">' . esc_textarea($value) . '</textarea>';
        } elseif ('image' === $type) {
          echo '<div class="figma-repeater__image-field">';
          echo '<input type="hidden" class="figma-repeater__input" data-field="' . esc_attr($field_id) . '" value="' . esc_attr($value) . '" />';
          echo '<div class="figma-repeater__image-preview">';
          if ($value) {
            echo '<img src="' . esc_url($value) . '" alt="Preview" style="max-width: 150px; height: auto;" />';
          }
          echo '</div>';
          echo '<button type="button" class="button figma-repeater__image-upload">' . __('Select Image', 'figma-rebuild') . '</button>';
          echo '<button type="button" class="button figma-repeater__image-remove" style="display: ' . ($value ? 'inline-block' : 'none') . ';">' . __('Remove', 'figma-rebuild') . '</button>';
          echo '</div>';
        } else {
          $input_type = in_array($type, ['url', 'date'], true) ? $type : 'text';
          echo '<input type="' . esc_attr($input_type) . '" class="figma-repeater__input" data-field="' . esc_attr($field_id) . '" value="' . esc_attr($value) . '" />';
        }

        echo '</label>';
      }

      echo '</div>';
      return trim(ob_get_clean());
    }
  }
}

if (!function_exists('figma_rebuild_sanitize_repeater')) {
  function figma_rebuild_sanitize_repeater($input, $fields) {
    if (is_string($input)) {
      $decoded = json_decode($input, true);
    } elseif (is_array($input)) {
      $decoded = $input;
    } else {
      $decoded = [];
    }
    if (!is_array($decoded)) $decoded = [];

    $sanitized = [];
    foreach ($decoded as $item) {
      if (!is_array($item)) continue;

      $clean = [];
      foreach ($fields as $field) {
        if (empty($field['id'])) continue;

        $id   = $field['id'];
        $type = isset($field['type']) ? $field['type'] : 'text';
        $raw  = isset($item[$id]) ? $item[$id] : '';

        switch ($type) {
          case 'textarea':
            $clean[$id] = wp_kses_post($raw);
            break;
          case 'url':
            $clean[$id] = esc_url_raw($raw);
            break;
          case 'image':
            $clean[$id] = esc_url_raw($raw);
            break;
          case 'date':
            $timestamp  = strtotime((string) $raw);
            $clean[$id] = $timestamp ? gmdate('Y-m-d', $timestamp) : '';
            break;
          default:
            $clean[$id] = sanitize_text_field($raw);
            break;
        }
      }

      if (empty(array_filter($clean, function ($v) { return '' !== trim((string)$v); }))) continue;
      $sanitized[] = $clean;
    }
    return wp_json_encode(array_values($sanitized));
  }
}

if (!function_exists('figma_rebuild_get_default_testimonials')) {
  function figma_rebuild_get_default_testimonials() {
    return [
      [
        'title'  => __('Amazing ROI!', 'figma-rebuild'),
        'body'   => __('Installation was seamless and support is outstanding. We track usage remotely and save every month.', 'figma-rebuild'),
        'author' => __('Mia L. / Studio Élan', 'figma-rebuild'),
      ],
      [
        'title'  => __('-50% Charging Cost!', 'figma-rebuild'),
        'body'   => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'figma-rebuild'),
        'author' => __('Josh Q. / JQ Builder', 'figma-rebuild'),
      ],
    ];
  }
}

if (!function_exists('figma_rebuild_get_default_partners')) {
  function figma_rebuild_get_default_partners() {
    return [
      ['label' => __('Partner 1', 'figma-rebuild'), 'logo' => ''],
      ['label' => __('Partner 2', 'figma-rebuild'), 'logo' => ''],
      ['label' => __('Partner 3', 'figma-rebuild'), 'logo' => ''],
      ['label' => __('Partner 4', 'figma-rebuild'), 'logo' => ''],
      ['label' => __('Partner 5', 'figma-rebuild'), 'logo' => ''],
      ['label' => __('Partner 6', 'figma-rebuild'), 'logo' => ''],
    ];
  }
}

if (!function_exists('figma_rebuild_get_default_news_items')) {
  function figma_rebuild_get_default_news_items() {
    return [
      [
        'title' => __('[2025 Edition] Home EV Charger Installation Tips', 'figma-rebuild'),
        'tag'   => __('Knowledge', 'figma-rebuild'),
        'date'  => '2025-07-11',
        'image' => get_template_directory_uri() . '/src/images/news/news-installation.png',
        'link'  => home_url('/news-paragraph/'),
      ],
      [
        'title' => __('10+ Public Charging Stations Launched downtown Toronto', 'figma-rebuild'),
        'tag'   => __('Knowledge', 'figma-rebuild'),
        'date'  => '2025-06-25',
        'image' => get_template_directory_uri() . '/src/images/news/news-New-stations.png',
        'link'  => '',
      ],
      [
        'title' => __('Maxperr Energy Unveils Powerful EV Charging Solutions at Canadas Largest Expo', 'figma-rebuild'),
        'tag'   => __('News', 'figma-rebuild'),
        'date'  => '2025-06-10',
        'image' => get_template_directory_uri() . '/src/images/news/news-unveil-maxperr.png',
        'link'  => '',
      ],
      [
        'title' => __('Grid-Friendly Charging Strategies for Commercial Sites', 'figma-rebuild'),
        'tag'   => __('News', 'figma-rebuild'),
        'date'  => '2025-05-30',
        'image' => get_template_directory_uri() . '/src/images/news/news-charger-installation.png',
        'link'  => '',
      ],
      [
        'title' => __('Smart O&M: Lowering TCO of EV Charging Assets', 'figma-rebuild'),
        'tag'   => __('Knowledge', 'figma-rebuild'),
        'date'  => '2025-05-12',
        'image' => get_template_directory_uri() . '/src/images/news/news-ACvsDC.png',
        'link'  => '',
      ],
      [
        'title' => __('Government Incentives for EV Charging Infrastructure', 'figma-rebuild'),
        'tag'   => __('News', 'figma-rebuild'),
        'date'  => '2025-04-15',
        'image' => get_template_directory_uri() . '/src/images/news/news-Incentives.png',
        'link'  => '',
      ],
    ];
  }
}

if (!function_exists('figma_rebuild_get_default_news_paragraph_hero')) {
  function figma_rebuild_get_default_news_paragraph_hero() {
    return [
      'tag'       => __('Knowledge', 'figma-rebuild'),
      'title'     => __('11 EV Charger Installation Tips', 'figma-rebuild'),
      'date'      => '2025-03-12',
      'image'     => get_template_directory_uri() . '/src/images/Maxperr-news.png',
      'image_alt' => __('EV charger installation article hero image', 'figma-rebuild'),
    ];
  }
}

if (!function_exists('figma_rebuild_get_default_news_paragraph_help')) {
  function figma_rebuild_get_default_news_paragraph_help() {
    return [
      'eyebrow'         => __('Need help?', 'figma-rebuild'),
      'title'           => __('Need Help with EV Charger Installation?', 'figma-rebuild'),
      'description'     => __('Talk with our specialists to scope, deploy, and maintain your charging network.', 'figma-rebuild'),
      'primary_label'   => __('Book Consultation', 'figma-rebuild'),
      'primary_url'     => '#',
      'secondary_label' => __('Technical Support', 'figma-rebuild'),
      'secondary_url'   => '#',
    ];
  }
}

// Register Customizer settings for all theme sections
add_action('customize_register', function ($wp_customize) {
  $template_uri       = get_template_directory_uri();
  $solutions_defaults = function_exists('figma_rebuild_get_solutions_defaults') ? figma_rebuild_get_solutions_defaults() : [];

  /**
   * NEW: Front Page master panel
   */
  $wp_customize->add_panel('front_page_panel', [
    'title'       => __('Front Page', 'figma-rebuild'),
    'priority'    => 25,
    'description' => __('Configure all sections of the site homepage in one place.', 'figma-rebuild'),
  ]);

  /* ------------------------------------------------------------------------ */
  /* Hero Section  (moved under front_page_panel)                             */
  /* ------------------------------------------------------------------------ */
  $wp_customize->add_section('hero_section', [
    'title'       => __('Hero', 'figma-rebuild'),
    'priority'    => 30,
    'panel'       => 'front_page_panel',
    'description' => __('设置首页 Hero 区域的标题、副标题和段落。', 'figma-rebuild'),
  ]);

  $wp_customize->add_setting('hero_title', [
    'default'           => __('EV Fast Charging', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage',
  ]);
  $wp_customize->add_control('hero_title', [
    'label'   => __('Hero 标题', 'figma-rebuild'),
    'section' => 'hero_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('hero_subtitle', [
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage',
  ]);
  $wp_customize->add_control('hero_subtitle', [
    'label'   => __('Hero 副标题', 'figma-rebuild'),
    'section' => 'hero_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('hero_paragraph', [
    'default'           => __('Experience the future of electric vehicle charging with our advanced solar-powered solutions. Clean energy, fast charging, sustainable future.', 'figma-rebuild'),
    'sanitize_callback' => 'wp_kses_post',
    'transport'         => 'postMessage',
  ]);
  $wp_customize->add_control('hero_paragraph', [
    'label'   => __('Hero 段落', 'figma-rebuild'),
    'section' => 'hero_section',
    'type'    => 'textarea',
  ]);

  $hero_background_defaults = [
    'hero_bg_image_1' => $template_uri . '/src/images/bg_house.jpg',
    'hero_bg_image_2' => $template_uri . '/src/images/bg_house2.jpg',
    'hero_bg_image_3' => $template_uri . '/src/images/bg_forest.jpg',
  ];
  foreach ($hero_background_defaults as $setting_id => $default) {
    $wp_customize->add_setting($setting_id, [
      'default'           => $default,
      'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control(
      $wp_customize,
      $setting_id,
      [
        'label'   => sprintf(__('Hero Background Image %s', 'figma-rebuild'), substr($setting_id, -1)),
        'section' => 'hero_section',
      ]
    ));
  }

  /* ------------------------------------------------------------------------ */
  /* Why Us Section  (moved under front_page_panel)                           */
  /* ------------------------------------------------------------------------ */
  $wp_customize->add_section('whyus_section', [
    'title'    => __('Why Us', 'figma-rebuild'),
    'priority' => 35,
    'panel'    => 'front_page_panel',
  ]);

  $wp_customize->add_setting('whyus_title', [
    'default'           => __('Why Us?', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('whyus_title', [
    'label'   => __('标题', 'figma-rebuild'),
    'section' => 'whyus_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('whyus_subtitle', [
    'default'           => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', 'figma-rebuild'),
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('whyus_subtitle', [
    'label'   => __('副标题', 'figma-rebuild'),
    'section' => 'whyus_section',
    'type'    => 'textarea',
  ]);

  $wp_customize->add_setting('whyus_kpi', [
    'default'           => '20%',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('whyus_kpi', [
    'label'   => __('KPI 数值', 'figma-rebuild'),
    'section' => 'whyus_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('whyus_paragraph', [
    'default'           => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.', 'figma-rebuild'),
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('whyus_paragraph', [
    'label'   => __('段落', 'figma-rebuild'),
    'section' => 'whyus_section',
    'type'    => 'textarea',
  ]);

  $wp_customize->add_setting('whyus_bg_image', [
    'default'           => $template_uri . '/src/images/bg_forest.jpg',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'whyus_bg_image',
    [
      'label'   => __('背景图片', 'figma-rebuild'),
      'section' => 'whyus_section',
    ]
  ));

  /* ------------------------------------------------------------------------ */
  /* Services Section  (moved under front_page_panel)                         */
  /* ------------------------------------------------------------------------ */
  $wp_customize->add_section('services_section', [
    'title'    => __('Services', 'figma-rebuild'),
    'priority' => 40,
    'panel'    => 'front_page_panel',
  ]);

  $wp_customize->add_setting('services_title', [
    'default'           => __('Tailored to Your Needs', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('services_title', [
    'label'   => __('标题', 'figma-rebuild'),
    'section' => 'services_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('services_paragraph', [
    'default'           => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.', 'figma-rebuild'),
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('services_paragraph', [
    'label'   => __('段落', 'figma-rebuild'),
    'section' => 'services_section',
    'type'    => 'textarea',
  ]);

  $wp_customize->add_setting('services_bg_image', [
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'services_bg_image',
    [
      'label'       => __('背景图片（可选）', 'figma-rebuild'),
      'section'     => 'services_section',
      'description' => __('未选择图片时将保持默认背景颜色。', 'figma-rebuild'),
    ]
  ));

  $services_cards = [
    'services_ev' => [
      'title_default' => __('EV Charger', 'figma-rebuild'),
      'image_default' => $template_uri . '/src/images/maxperr_smart_30kW.png',
      'title_label'   => __('EV Charger 标题', 'figma-rebuild'),
      'image_label'   => __('EV Charger 图片', 'figma-rebuild'),
    ],
    'services_home' => [
      'title_default' => __('Home Energy', 'figma-rebuild'),
      'image_default' => $template_uri . '/src/images/maxperr_home_10kW.png',
      'title_label'   => __('Home Energy 标题', 'figma-rebuild'),
      'image_label'   => __('Home Energy 图片', 'figma-rebuild'),
    ],
  ];
  foreach ($services_cards as $prefix => $card) {
    $title_setting = $prefix . '_title';
    $image_setting = $prefix . '_image';

    $wp_customize->add_setting($title_setting, [
      'default'           => $card['title_default'],
      'sanitize_callback' => 'sanitize_text_field',
      'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control($title_setting, [
      'label'   => $card['title_label'],
      'section' => 'services_section',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting($image_setting, [
      'default'           => $card['image_default'],
      'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control(
      $wp_customize,
      $image_setting,
      [
        'label'   => $card['image_label'],
        'section' => 'services_section',
      ]
    ));
  }

  /* ------------------------------------------------------------------------ */
  /* Monitor Section  (moved under front_page_panel)                          */
  /* ------------------------------------------------------------------------ */
  $wp_customize->add_section('monitor_section', [
    'title'    => __('Monitor', 'figma-rebuild'),
    'priority' => 45,
    'panel'    => 'front_page_panel',
  ]);

  $wp_customize->add_setting('monitor_title', [
    'default'           => __('Monitor from Afar', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('monitor_title', [
    'label'   => __('标题', 'figma-rebuild'),
    'section' => 'monitor_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('monitor_paragraph', [
    'default'           => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'figma-rebuild'),
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('monitor_paragraph', [
    'label'   => __('段落', 'figma-rebuild'),
    'section' => 'monitor_section',
    'type'    => 'textarea',
  ]);

  $wp_customize->add_setting('monitor_row1_title', [
    'default'           => __('Charger Management', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('monitor_row1_title', [
    'label'   => __('行一标题', 'figma-rebuild'),
    'section' => 'monitor_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('monitor_row1_paragraph', [
    'default'           => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', 'figma-rebuild'),
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('monitor_row1_paragraph', [
    'label'   => __('行一段落', 'figma-rebuild'),
    'section' => 'monitor_section',
    'type'    => 'textarea',
  ]);

  $wp_customize->add_setting('monitor_row1_image', [
    'default'           => $template_uri . '/src/images/ev_app_control.jpg',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'monitor_row1_image',
    [
      'label'   => __('行一图片', 'figma-rebuild'),
      'section' => 'monitor_section',
    ]
  ));

  $wp_customize->add_setting('monitor_row2_title', [
    'default'           => __('Driver App', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('monitor_row2_title', [
    'label'   => __('行二标题', 'figma-rebuild'),
    'section' => 'monitor_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('monitor_row2_paragraph', [
    'default'           => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'figma-rebuild'),
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('monitor_row2_paragraph', [
    'label'   => __('行二段落', 'figma-rebuild'),
    'section' => 'monitor_section',
    'type'    => 'textarea',
  ]);

  $wp_customize->add_setting('monitor_row2_image', [
    'default'           => $template_uri . '/src/images/ev_nav_map.jpg',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'monitor_row2_image',
    [
      'label'   => __('行二图片', 'figma-rebuild'),
      'section' => 'monitor_section',
    ]
  ));

  /* ------------------------------------------------------------------------ */
  /* Trust Section  (moved under front_page_panel)                            */
  /* ------------------------------------------------------------------------ */
  $wp_customize->add_section('trust_section', [
    'title'    => __('Trust', 'figma-rebuild'),
    'priority' => 50,
    'panel'    => 'front_page_panel',
  ]);

  $wp_customize->add_setting('trust_title', [
    'default'           => __('Trusted by 3000+', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('trust_title', [
    'label'   => __('标题', 'figma-rebuild'),
    'section' => 'trust_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('trust_paragraph', [
    'default'           => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.', 'figma-rebuild'),
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('trust_paragraph', [
    'label'   => __('段落', 'figma-rebuild'),
    'section' => 'trust_section',
    'type'    => 'textarea',
  ]);

  $wp_customize->add_setting('trust_bg_image', [
    'default'           => 'https://images.unsplash.com/photo-1449824913935-59a10b8d2000?auto=format&fit=crop&w=2070&q=80',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'trust_bg_image',
    [
      'label'   => __('背景图片', 'figma-rebuild'),
      'section' => 'trust_section',
    ]
  ));

  $testimonial_fields = [
    ['id' => 'title',  'label' => __('标题', 'figma-rebuild'), 'type' => 'text'],
    ['id' => 'body',   'label' => __('内容', 'figma-rebuild'), 'type' => 'textarea'],
    ['id' => 'author', 'label' => __('署名', 'figma-rebuild'), 'type' => 'text'],
  ];
  $wp_customize->add_setting('trust_testimonials', [
    'default'           => wp_json_encode(figma_rebuild_get_default_testimonials()),
    'sanitize_callback' => function ($input) use ($testimonial_fields) {
      return figma_rebuild_sanitize_repeater($input, $testimonial_fields);
    },
  ]);
  $wp_customize->add_control(new Figma_Rebuild_Repeater_Control(
    $wp_customize,
    'trust_testimonials',
    [
      'label'            => __('Testimonials', 'figma-rebuild'),
      'section'          => 'trust_section',
      'fields'           => $testimonial_fields,
      'add_button_label' => __('添加评价', 'figma-rebuild'),
      'item_label'       => __('评价', 'figma-rebuild'),
    ]
  ));

  $partner_fields = [
    ['id' => 'label', 'label' => __('合作伙伴名称', 'figma-rebuild'), 'type' => 'text'],
    ['id' => 'logo',  'label' => __('Logo 图片地址（可选）', 'figma-rebuild'), 'type' => 'url'],
  ];
  $wp_customize->add_setting('trust_partners', [
    'default'           => wp_json_encode(figma_rebuild_get_default_partners()),
    'sanitize_callback' => function ($input) use ($partner_fields) {
      return figma_rebuild_sanitize_repeater($input, $partner_fields);
    },
  ]);
  $wp_customize->add_control(new Figma_Rebuild_Repeater_Control(
    $wp_customize,
    'trust_partners',
    [
      'label'            => __('合作伙伴列表', 'figma-rebuild'),
      'section'          => 'trust_section',
      'fields'           => $partner_fields,
      'add_button_label' => __('添加合作伙伴', 'figma-rebuild'),
      'item_label'       => __('合作伙伴', 'figma-rebuild'),
    ]
  ));

  /* ------------------------------------------------------------------------ */
  /* News Section  (moved under front_page_panel)                             */
  /* ------------------------------------------------------------------------ */
  $wp_customize->add_section('news_section', [
    'title'    => __('News', 'figma-rebuild'),
    'priority' => 55,
    'panel'    => 'front_page_panel',
  ]);

  $wp_customize->add_setting('news_title', [
    'default'           => __('What\'s New?', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('news_title', [
    'label'   => __('标题', 'figma-rebuild'),
    'section' => 'news_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('news_subtitle', [
    'default'           => __('All about our company and the EV Charging Industry.', 'figma-rebuild'),
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('news_subtitle', [
    'label'   => __('副标题', 'figma-rebuild'),
    'section' => 'news_section',
    'type'    => 'textarea',
  ]);

  $wp_customize->add_setting('news_bg_image', [
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'news_bg_image',
    [
      'label'       => __('背景图片（可选）', 'figma-rebuild'),
      'section'     => 'news_section',
      'description' => __('未选择图片时将保持默认背景颜色。', 'figma-rebuild'),
    ]
  ));

  $news_fields = [
    ['id' => 'title', 'label' => __('文章标题', 'figma-rebuild'), 'type' => 'text'],
    ['id' => 'tag',   'label' => __('标签', 'figma-rebuild'),     'type' => 'text'],
    ['id' => 'date',  'label' => __('日期 (YYYY-MM-DD)', 'figma-rebuild'), 'type' => 'date'],
    ['id' => 'image', 'label' => __('封面图片地址', 'figma-rebuild'), 'type' => 'url'],
    ['id' => 'link',  'label' => __('链接（可选）', 'figma-rebuild'), 'type' => 'url'],
  ];
  $wp_customize->add_setting('news_items', [
    'default'           => wp_json_encode(figma_rebuild_get_default_news_items()),
    'sanitize_callback' => function ($input) use ($news_fields) {
      return figma_rebuild_sanitize_repeater($input, $news_fields);
    },
  ]);
  $wp_customize->add_control(new Figma_Rebuild_Repeater_Control(
    $wp_customize,
    'news_items',
    [
      'label'            => __('新闻卡片', 'figma-rebuild'),
      'section'          => 'news_section',
      'fields'           => $news_fields,
      'add_button_label' => __('添加新闻', 'figma-rebuild'),
      'item_label'       => __('新闻', 'figma-rebuild'),
    ]
  ));

  /* ------------------------------------------------------------------------ */
  /* News Page Panel                                                          */
  /* ------------------------------------------------------------------------ */
  $wp_customize->add_panel('news_page_panel', [
    'title'       => __('News Page', 'figma-rebuild'),
    'priority'    => 79,
    'description' => __('Configure the News page sections.', 'figma-rebuild'),
  ]);

  // News Page Hero Section
  $wp_customize->add_section('news_page_hero_section', [
    'title' => __('Hero', 'figma-rebuild'),
    'panel' => 'news_page_panel',
  ]);
  
  $wp_customize->add_setting('news_page_hero_title', [
    'default'           => __('News', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('news_page_hero_title', [
    'label'   => __('Page Title', 'figma-rebuild'),
    'section' => 'news_page_hero_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('news_page_hero_bg_image', [
    'default'           => $template_uri . '/src/images/Maxperr-news.png',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'news_page_hero_bg_image',
    [
      'label'       => __('Hero Background Image', 'figma-rebuild'),
      'section'     => 'news_page_hero_section',
      'description' => __('Upload an image for the hero section background.', 'figma-rebuild'),
    ]
  ));

  // News Page Grid Section
  $wp_customize->add_section('news_page_grid_section', [
    'title' => __('News Grid', 'figma-rebuild'),
    'panel' => 'news_page_panel',
  ]);

  $news_page_fields = [
    ['id' => 'title', 'label' => __('Article Title', 'figma-rebuild'), 'type' => 'text'],
    ['id' => 'tag',   'label' => __('Tag', 'figma-rebuild'),     'type' => 'text'],
    ['id' => 'date',  'label' => __('Date (YYYY-MM-DD)', 'figma-rebuild'), 'type' => 'date'],
    ['id' => 'image', 'label' => __('Cover Image', 'figma-rebuild'), 'type' => 'image'],
    ['id' => 'link',  'label' => __('Link (Optional)', 'figma-rebuild'), 'type' => 'url'],
  ];
  $wp_customize->add_setting('news_page_items', [
    'default'           => wp_json_encode(figma_rebuild_get_default_news_items()),
    'sanitize_callback' => function ($input) use ($news_page_fields) {
      return figma_rebuild_sanitize_repeater($input, $news_page_fields);
    },
  ]);
  $wp_customize->add_control(new Figma_Rebuild_Repeater_Control(
    $wp_customize,
    'news_page_items',
    [
      'label'            => __('News Articles', 'figma-rebuild'),
      'section'          => 'news_page_grid_section',
      'fields'           => $news_page_fields,
      'add_button_label' => __('Add News Article', 'figma-rebuild'),
      'item_label'       => __('News Article', 'figma-rebuild'),
    ]
  ));

  /* ------------------------------------------------------------------------ */
  /* News Paragraph Page                                                     */
  /* ------------------------------------------------------------------------ */
  $news_paragraph_hero_defaults = figma_rebuild_get_default_news_paragraph_hero();
  $news_paragraph_help_defaults = figma_rebuild_get_default_news_paragraph_help();

  $wp_customize->add_panel('news_paragraph_panel', [
    'title'       => __('News Paragraph Page', 'figma-rebuild'),
    'priority'    => 80,
    'description' => __('Configure the hero and support CTA for the news paragraph template.', 'figma-rebuild'),
  ]);

  $wp_customize->add_section('news_paragraph_hero_section', [
    'title' => __('Hero', 'figma-rebuild'),
    'panel' => 'news_paragraph_panel',
  ]);

  $wp_customize->add_setting('news_paragraph_hero_tag', [
    'default'           => $news_paragraph_hero_defaults['tag'],
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('news_paragraph_hero_tag', [
    'label'   => __('Tag', 'figma-rebuild'),
    'section' => 'news_paragraph_hero_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('news_paragraph_hero_title', [
    'default'           => $news_paragraph_hero_defaults['title'],
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('news_paragraph_hero_title', [
    'label'   => __('Title', 'figma-rebuild'),
    'section' => 'news_paragraph_hero_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('news_paragraph_hero_date', [
    'default'           => $news_paragraph_hero_defaults['date'],
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('news_paragraph_hero_date', [
    'label'       => __('Published date (YYYY-MM-DD)', 'figma-rebuild'),
    'description' => __('Leave empty to use the page publish date.', 'figma-rebuild'),
    'section'     => 'news_paragraph_hero_section',
    'type'        => 'date',
  ]);

  $wp_customize->add_setting('news_paragraph_hero_image', [
    'default'           => $news_paragraph_hero_defaults['image'],
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'news_paragraph_hero_image',
    [
      'label'   => __('Hero image', 'figma-rebuild'),
      'section' => 'news_paragraph_hero_section',
    ]
  ));

  $wp_customize->add_setting('news_paragraph_hero_image_alt', [
    'default'           => $news_paragraph_hero_defaults['image_alt'],
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('news_paragraph_hero_image_alt', [
    'label'       => __('Hero image alt text', 'figma-rebuild'),
    'description' => __('Describe the hero image for accessibility.', 'figma-rebuild'),
    'section'     => 'news_paragraph_hero_section',
    'type'        => 'text',
  ]);

  $wp_customize->add_section('news_paragraph_help_section', [
    'title' => __('Need Help CTA', 'figma-rebuild'),
    'panel' => 'news_paragraph_panel',
  ]);

  $wp_customize->add_setting('news_paragraph_help_eyebrow', [
    'default'           => $news_paragraph_help_defaults['eyebrow'],
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('news_paragraph_help_eyebrow', [
    'label'   => __('Eyebrow label', 'figma-rebuild'),
    'section' => 'news_paragraph_help_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('news_paragraph_help_title', [
    'default'           => $news_paragraph_help_defaults['title'],
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('news_paragraph_help_title', [
    'label'   => __('Title', 'figma-rebuild'),
    'section' => 'news_paragraph_help_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('news_paragraph_help_description', [
    'default'           => $news_paragraph_help_defaults['description'],
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('news_paragraph_help_description', [
    'label'   => __('Description', 'figma-rebuild'),
    'section' => 'news_paragraph_help_section',
    'type'    => 'textarea',
  ]);

  $wp_customize->add_setting('news_paragraph_help_primary_label', [
    'default'           => $news_paragraph_help_defaults['primary_label'],
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('news_paragraph_help_primary_label', [
    'label'   => __('Primary action label', 'figma-rebuild'),
    'section' => 'news_paragraph_help_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('news_paragraph_help_primary_url', [
    'default'           => $news_paragraph_help_defaults['primary_url'],
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('news_paragraph_help_primary_url', [
    'label'   => __('Primary action URL', 'figma-rebuild'),
    'section' => 'news_paragraph_help_section',
    'type'    => 'url',
  ]);

  $wp_customize->add_setting('news_paragraph_help_secondary_label', [
    'default'           => $news_paragraph_help_defaults['secondary_label'],
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('news_paragraph_help_secondary_label', [
    'label'   => __('Secondary action label', 'figma-rebuild'),
    'section' => 'news_paragraph_help_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('news_paragraph_help_secondary_url', [
    'default'           => $news_paragraph_help_defaults['secondary_url'],
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('news_paragraph_help_secondary_url', [
    'label'   => __('Secondary action URL', 'figma-rebuild'),
    'section' => 'news_paragraph_help_section',
    'type'    => 'url',
  ]);

  /* ------------------------------------------------------------------------ */
  /* Solutions Page (existing, unchanged, stays under its own panel)          */
  /* ------------------------------------------------------------------------ */
  if (!empty($solutions_defaults)) {
    $wp_customize->add_panel('solutions_panel', [
      'title'       => __('Solutions Page', 'figma-rebuild'),
      'priority'    => 75,
      'description' => __('Configure the dedicated Solutions landing page sections.', 'figma-rebuild'),
    ]);

    // Solutions Hero
    $hero_defaults = isset($solutions_defaults['hero']) ? $solutions_defaults['hero'] : [];
    $wp_customize->add_section('solutions_hero_section', [
      'title' => __('Hero', 'figma-rebuild'),
      'panel' => 'solutions_panel',
    ]);
    $wp_customize->add_setting('solutions_hero_title', [
      'default'           => isset($hero_defaults['title']) ? $hero_defaults['title'] : '',
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('solutions_hero_title', [
      'label'   => __('Section label', 'figma-rebuild'),
      'section' => 'solutions_hero_section',
      'type'    => 'text',
    ]);
    $wp_customize->add_setting('solutions_hero_headline', [
      'default'           => isset($hero_defaults['headline']) ? $hero_defaults['headline'] : '',
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('solutions_hero_headline', [
      'label'   => __('Headline', 'figma-rebuild'),
      'section' => 'solutions_hero_section',
      'type'    => 'text',
    ]);
    $wp_customize->add_setting('solutions_hero_description', [
      'default'           => isset($hero_defaults['description']) ? $hero_defaults['description'] : '',
      'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('solutions_hero_description', [
      'label'   => __('Description', 'figma-rebuild'),
      'section' => 'solutions_hero_section',
      'type'    => 'textarea',
    ]);
    $wp_customize->add_setting('solutions_hero_background', [
      'default'           => isset($hero_defaults['background']) ? $hero_defaults['background'] : '',
      'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control(
      $wp_customize,
      'solutions_hero_background',
      [
        'label'   => __('Background image', 'figma-rebuild'),
        'section' => 'solutions_hero_section',
      ]
    ));

    // Service Navigator
    $services_defaults = isset($solutions_defaults['services']) ? $solutions_defaults['services'] : [];
    $wp_customize->add_section('solutions_services_section', [
      'title' => __('Service Navigator', 'figma-rebuild'),
      'panel' => 'solutions_panel',
    ]);
    $wp_customize->add_setting('solutions_services_title', [
      'default'           => isset($services_defaults['title']) ? $services_defaults['title'] : '',
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('solutions_services_title', [
      'label'   => __('Section title', 'figma-rebuild'),
      'section' => 'solutions_services_section',
      'type'    => 'text',
    ]);
    $wp_customize->add_setting('solutions_services_description', [
      'default'           => isset($services_defaults['description']) ? $services_defaults['description'] : '',
      'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('solutions_services_description', [
      'label'   => __('Section description', 'figma-rebuild'),
      'section' => 'solutions_services_section',
      'type'    => 'textarea',
    ]);

    $service_fields = [
      ['id' => 'label',       'label' => __('Badge label', 'figma-rebuild'), 'type' => 'text'],
      ['id' => 'title',       'label' => __('Card title', 'figma-rebuild'),  'type' => 'text'],
      ['id' => 'description', 'label' => __('Description', 'figma-rebuild'), 'type' => 'textarea'],
      ['id' => 'image',       'label' => __('Image URL', 'figma-rebuild'),   'type' => 'url'],
      ['id' => 'link_label',  'label' => __('Link label', 'figma-rebuild'),  'type' => 'text'],
      ['id' => 'link_url',    'label' => __('Link URL', 'figma-rebuild'),    'type' => 'url'],
    ];
    $wp_customize->add_setting('solutions_services_items', [
      'default'           => isset($services_defaults['items']) ? wp_json_encode($services_defaults['items']) : wp_json_encode([]),
      'sanitize_callback' => function ($input) use ($service_fields) {
        return figma_rebuild_sanitize_repeater($input, $service_fields);
      },
    ]);
    $wp_customize->add_control(new Figma_Rebuild_Repeater_Control(
      $wp_customize,
      'solutions_services_items',
      [
        'label'            => __('Service cards', 'figma-rebuild'),
        'section'          => 'solutions_services_section',
        'fields'           => $service_fields,
        'add_button_label' => __('Add service', 'figma-rebuild'),
        'item_label'       => __('Service', 'figma-rebuild'),
      ]
    ));

    // Detail Sections (Home, Commercial, Fleet)
    $solutions_detail_sections = [
      'home'       => __('Home Section', 'figma-rebuild'),
      'commercial' => __('Commercial Section', 'figma-rebuild'),
      'fleet'      => __('Fleet Section', 'figma-rebuild'),
    ];
    $feature_fields = [
      ['id' => 'text', 'label' => __('Feature text', 'figma-rebuild'), 'type' => 'text'],
    ];
    foreach ($solutions_detail_sections as $key => $label) {
      $defaults   = isset($solutions_defaults[$key]) ? $solutions_defaults[$key] : [];
      $section_id = 'solutions_' . $key . '_section';

      $wp_customize->add_section($section_id, [
        'title' => $label,
        'panel' => 'solutions_panel',
      ]);

      $wp_customize->add_setting('solutions_' . $key . '_heading', [
        'default'           => isset($defaults['heading']) ? $defaults['heading'] : '',
        'sanitize_callback' => 'sanitize_text_field',
      ]);
      $wp_customize->add_control('solutions_' . $key . '_heading', [
        'label'   => __('Section heading', 'figma-rebuild'),
        'section' => $section_id,
        'type'    => 'text',
      ]);

      $wp_customize->add_setting('solutions_' . $key . '_intro', [
        'default'           => isset($defaults['intro']) ? $defaults['intro'] : '',
        'sanitize_callback' => 'wp_kses_post',
      ]);
      $wp_customize->add_control('solutions_' . $key . '_intro', [
        'label'   => __('Intro paragraph', 'figma-rebuild'),
        'section' => $section_id,
        'type'    => 'textarea',
      ]);

      $wp_customize->add_setting('solutions_' . $key . '_badge', [
        'default'           => isset($defaults['badge']) ? $defaults['badge'] : '',
        'sanitize_callback' => 'sanitize_text_field',
      ]);
      $wp_customize->add_control('solutions_' . $key . '_badge', [
        'label'   => __('Card badge', 'figma-rebuild'),
        'section' => $section_id,
        'type'    => 'text',
      ]);

      $wp_customize->add_setting('solutions_' . $key . '_card_title', [
        'default'           => isset($defaults['card_title']) ? $defaults['card_title'] : '',
        'sanitize_callback' => 'sanitize_text_field',
      ]);
      $wp_customize->add_control('solutions_' . $key . '_card_title', [
        'label'   => __('Card title', 'figma-rebuild'),
        'section' => $section_id,
        'type'    => 'text',
      ]);

      $wp_customize->add_setting('solutions_' . $key . '_card_body', [
        'default'           => isset($defaults['card_body']) ? $defaults['card_body'] : '',
        'sanitize_callback' => 'wp_kses_post',
      ]);
      $wp_customize->add_control('solutions_' . $key . '_card_body', [
        'label'   => __('Card description', 'figma-rebuild'),
        'section' => $section_id,
        'type'    => 'textarea',
      ]);

      $wp_customize->add_setting('solutions_' . $key . '_features', [
        'default'           => isset($defaults['features']) ? wp_json_encode($defaults['features']) : wp_json_encode([]),
        'sanitize_callback' => function ($input) use ($feature_fields) {
          return figma_rebuild_sanitize_repeater($input, $feature_fields);
        },
      ]);
      $wp_customize->add_control(new Figma_Rebuild_Repeater_Control(
        $wp_customize,
        'solutions_' . $key . '_features',
        [
          'label'            => __('Key highlights', 'figma-rebuild'),
          'section'          => $section_id,
          'fields'           => $feature_fields,
          'add_button_label' => __('Add highlight', 'figma-rebuild'),
          'item_label'       => __('Highlight', 'figma-rebuild'),
        ]
      ));

      $wp_customize->add_setting('solutions_' . $key . '_note', [
        'default'           => isset($defaults['note']) ? $defaults['note'] : '',
        'sanitize_callback' => 'wp_kses_post',
      ]);
      $wp_customize->add_control('solutions_' . $key . '_note', [
        'label'   => __('Supporting note', 'figma-rebuild'),
        'section' => $section_id,
        'type'    => 'textarea',
      ]);

      $wp_customize->add_setting('solutions_' . $key . '_button_text', [
        'default'           => isset($defaults['button_text']) ? $defaults['button_text'] : '',
        'sanitize_callback' => 'sanitize_text_field',
      ]);
      $wp_customize->add_control('solutions_' . $key . '_button_text', [
        'label'   => __('Button label', 'figma-rebuild'),
        'section' => $section_id,
        'type'    => 'text',
      ]);

      $wp_customize->add_setting('solutions_' . $key . '_button_link', [
        'default'           => isset($defaults['button_link']) ? $defaults['button_link'] : '',
        'sanitize_callback' => 'esc_url_raw',
      ]);
      $wp_customize->add_control('solutions_' . $key . '_button_link', [
        'label'   => __('Button link', 'figma-rebuild'),
        'section' => $section_id,
        'type'    => 'url',
      ]);

      $wp_customize->add_setting('solutions_' . $key . '_image', [
        'default'           => isset($defaults['image']) ? $defaults['image'] : '',
        'sanitize_callback' => 'esc_url_raw',
      ]);
      $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'solutions_' . $key . '_image',
        [
          'label'   => __('Feature image', 'figma-rebuild'),
          'section' => $section_id,
        ]
      ));
    }

    // ZEVIP Program
    $zevip_defaults = isset($solutions_defaults['zevip']) ? $solutions_defaults['zevip'] : [];
    $wp_customize->add_section('solutions_zevip_section', [
      'title' => __('ZEVIP Program', 'figma-rebuild'),
      'panel' => 'solutions_panel',
    ]);
    $wp_customize->add_setting('solutions_zevip_heading', [
      'default'           => isset($zevip_defaults['heading']) ? $zevip_defaults['heading'] : '',
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('solutions_zevip_heading', [
      'label'   => __('Section heading', 'figma-rebuild'),
      'section' => 'solutions_zevip_section',
      'type'    => 'text',
    ]);
    $wp_customize->add_setting('solutions_zevip_intro', [
      'default'           => isset($zevip_defaults['intro']) ? $zevip_defaults['intro'] : '',
      'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('solutions_zevip_intro', [
      'label'   => __('Intro paragraph', 'figma-rebuild'),
      'section' => 'solutions_zevip_section',
      'type'    => 'textarea',
    ]);
    $wp_customize->add_setting('solutions_zevip_features', [
      'default'           => isset($zevip_defaults['features']) ? wp_json_encode($zevip_defaults['features']) : wp_json_encode([]),
      'sanitize_callback' => function ($input) use ($feature_fields) {
        return figma_rebuild_sanitize_repeater($input, $feature_fields);
      },
    ]);
    $wp_customize->add_control(new Figma_Rebuild_Repeater_Control(
      $wp_customize,
      'solutions_zevip_features',
      [
        'label'            => __('Program services', 'figma-rebuild'),
        'section'          => 'solutions_zevip_section',
        'fields'           => $feature_fields,
        'add_button_label' => __('Add service', 'figma-rebuild'),
        'item_label'       => __('Service', 'figma-rebuild'),
      ]
    ));
    $wp_customize->add_setting('solutions_zevip_button_text', [
      'default'           => isset($zevip_defaults['button_text']) ? $zevip_defaults['button_text'] : '',
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('solutions_zevip_button_text', [
      'label'   => __('Button label', 'figma-rebuild'),
      'section' => 'solutions_zevip_section',
      'type'    => 'text',
    ]);
    $wp_customize->add_setting('solutions_zevip_button_link', [
      'default'           => isset($zevip_defaults['button_link']) ? $zevip_defaults['button_link'] : '',
      'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('solutions_zevip_button_link', [
      'label'   => __('Button link', 'figma-rebuild'),
      'section' => 'solutions_zevip_section',
      'type'    => 'url',
    ]);
    $wp_customize->add_setting('solutions_zevip_image', [
      'default'           => isset($zevip_defaults['image']) ? $zevip_defaults['image'] : '',
      'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control(
      $wp_customize,
      'solutions_zevip_image',
      [
        'label'   => __('Feature image', 'figma-rebuild'),
        'section' => 'solutions_zevip_section',
      ]
    ));

    // Book / Contact
    $book_defaults = isset($solutions_defaults['book']) ? $solutions_defaults['book'] : [];
    $wp_customize->add_section('solutions_book_section', [
      'title' => __('Book a Consultation', 'figma-rebuild'),
      'panel' => 'solutions_panel',
    ]);
    $wp_customize->add_setting('solutions_book_title', [
      'default'           => isset($book_defaults['title']) ? $book_defaults['title'] : '',
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('solutions_book_title', [
      'label'   => __('Section heading', 'figma-rebuild'),
      'section' => 'solutions_book_section',
      'type'    => 'text',
    ]);
    $wp_customize->add_setting('solutions_book_description', [
      'default'           => isset($book_defaults['description']) ? $book_defaults['description'] : '',
      'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('solutions_book_description', [
      'label'   => __('Section description', 'figma-rebuild'),
      'section' => 'solutions_book_section',
      'type'    => 'textarea',
    ]);
    $wp_customize->add_setting('solutions_book_background', [
      'default'           => isset($book_defaults['background']) ? $book_defaults['background'] : '',
      'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control(
      $wp_customize,
      'solutions_book_background',
      [
        'label'   => __('Background image', 'figma-rebuild'),
        'section' => 'solutions_book_section',
      ]
    ));
    $book_fields = [
      ['id' => 'title',       'label' => __('Card title', 'figma-rebuild'),       'type' => 'text'],
      ['id' => 'description', 'label' => __('Card description', 'figma-rebuild'), 'type' => 'textarea'],
      ['id' => 'cta_label',   'label' => __('CTA label', 'figma-rebuild'),        'type' => 'text'],
      ['id' => 'cta_url',     'label' => __('CTA URL', 'figma-rebuild'),          'type' => 'url'],
    ];
    $wp_customize->add_setting('solutions_book_cards', [
      'default'           => isset($book_defaults['cards']) ? wp_json_encode($book_defaults['cards']) : wp_json_encode([]),
      'sanitize_callback' => function ($input) use ($book_fields) {
        return figma_rebuild_sanitize_repeater($input, $book_fields);
      },
    ]);
    $wp_customize->add_control(new Figma_Rebuild_Repeater_Control(
      $wp_customize,
      'solutions_book_cards',
      [
        'label'            => __('Contact cards', 'figma-rebuild'),
        'section'          => 'solutions_book_section',
        'fields'           => $book_fields,
        'add_button_label' => __('Add card', 'figma-rebuild'),
        'item_label'       => __('Card', 'figma-rebuild'),
      ]
    ));
  }

  /* ------------------------------------------------------------------------ */
  /* Product Page                                                             */
  /* ------------------------------------------------------------------------ */
  $wp_customize->add_panel('product_page_panel', [
    'title'       => __('Product Page', 'figma-rebuild'),
    'priority'    => 78,
    'description' => __('Configure the Product page sections.', 'figma-rebuild'),
  ]);

  // Product Hero Section
  $wp_customize->add_section('product_hero_section', [
    'title' => __('Hero', 'figma-rebuild'),
    'panel' => 'product_page_panel',
  ]);
  
  $wp_customize->add_setting('products_hero_title', [
    'default'           => __('EV Chargers', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('products_hero_title', [
    'label'   => __('Hero Title', 'figma-rebuild'),
    'section' => 'product_hero_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('products_hero_subtitle', [
    'default'           => __('We offer the equipment, installation service and 24/7 technical support.', 'figma-rebuild'),
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('products_hero_subtitle', [
    'label'   => __('Hero Subtitle', 'figma-rebuild'),
    'section' => 'product_hero_section',
    'type'    => 'textarea',
  ]);
  
  $wp_customize->add_setting('products_hero_button_text', [
    'default'           => __('Learn More', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('products_hero_button_text', [
    'label'   => __('Button Text', 'figma-rebuild'),
    'section' => 'product_hero_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('products_hero_button_link', [
    'default'           => '#charger-cards',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('products_hero_button_link', [
    'label'   => __('Button Link', 'figma-rebuild'),
    'section' => 'product_hero_section',
    'type'    => 'url',
  ]);
  
  $wp_customize->add_setting('products_hero_bg_image', [
    'default'           => $template_uri . '/src/images/product-Hero-Image.png',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'products_hero_bg_image',
    [
      'label'   => __('Background Image', 'figma-rebuild'),
      'section' => 'product_hero_section',
    ]
  ));

  // Charger Cards Section
  $wp_customize->add_section('product_charger_cards_section', [
    'title' => __('Charger Cards', 'figma-rebuild'),
    'panel' => 'product_page_panel',
  ]);
  
  $charger_product_fields = [
    ['id' => 'name',  'label' => __('Product Name', 'figma-rebuild'), 'type' => 'text'],
    ['id' => 'price', 'label' => __('Price', 'figma-rebuild'), 'type' => 'text'],
    ['id' => 'image', 'label' => __('Product Image URL', 'figma-rebuild'), 'type' => 'url'],
  ];
  
  $wp_customize->add_setting('charger_products', [
    'default'           => wp_json_encode([
      [
        'name'  => 'Eco 12kW AC',
        'price' => '$799',
        'image' => $template_uri . '/src/images/products/Eco 12kW AC.png',
      ],
      [
        'name'  => 'Smart 30kW DC',
        'price' => '$0000',
        'image' => $template_uri . '/src/images/products/Smart 30kW DC.png',
      ],
      [
        'name'  => 'Pro Series DC',
        'price' => '$0000',
        'image' => $template_uri . '/src/images/products/Pro Series DC.png',
      ],
    ]),
    'sanitize_callback' => function ($input) use ($charger_product_fields) {
      return figma_rebuild_sanitize_repeater($input, $charger_product_fields);
    },
  ]);
  $wp_customize->add_control(new Figma_Rebuild_Repeater_Control(
    $wp_customize,
    'charger_products',
    [
      'label'            => __('Charger Products', 'figma-rebuild'),
      'section'          => 'product_charger_cards_section',
      'fields'           => $charger_product_fields,
      'add_button_label' => __('Add Product', 'figma-rebuild'),
      'item_label'       => __('Product', 'figma-rebuild'),
    ]
  ));

  // Home Energy Hero Section
  $wp_customize->add_section('product_home_energy_hero_section', [
    'title' => __('Home Energy Hero', 'figma-rebuild'),
    'panel' => 'product_page_panel',
  ]);
  
  $wp_customize->add_setting('home_energy_hero_title', [
    'default'           => __('Home Energy', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('home_energy_hero_title', [
    'label'   => __('Hero Title', 'figma-rebuild'),
    'section' => 'product_home_energy_hero_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('home_energy_hero_subtitle', [
    'default'           => __('10 years warranty. Designed to save utility cost in the long run.', 'figma-rebuild'),
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('home_energy_hero_subtitle', [
    'label'   => __('Hero Subtitle', 'figma-rebuild'),
    'section' => 'product_home_energy_hero_section',
    'type'    => 'textarea',
  ]);
  
  $wp_customize->add_setting('home_energy_hero_button_text', [
    'default'           => __('Learn More', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('home_energy_hero_button_text', [
    'label'   => __('Button Text', 'figma-rebuild'),
    'section' => 'product_home_energy_hero_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('home_energy_hero_button_link', [
    'default'           => '#home-energy-cards',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('home_energy_hero_button_link', [
    'label'   => __('Button Link', 'figma-rebuild'),
    'section' => 'product_home_energy_hero_section',
    'type'    => 'url',
  ]);
  
  $wp_customize->add_setting('home_energy_hero_bg_image', [
    'default'           => $template_uri . '/src/images/product-Home-Energy-Hero.png',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'home_energy_hero_bg_image',
    [
      'label'   => __('Background Image', 'figma-rebuild'),
      'section' => 'product_home_energy_hero_section',
    ]
  ));

  // Home Energy Cards Section
  $wp_customize->add_section('product_home_energy_cards_section', [
    'title' => __('Home Energy Cards', 'figma-rebuild'),
    'panel' => 'product_page_panel',
  ]);
  
  $home_energy_product_fields = [
    ['id' => 'name',  'label' => __('Product Name', 'figma-rebuild'), 'type' => 'text'],
    ['id' => 'price', 'label' => __('Price', 'figma-rebuild'), 'type' => 'text'],
    ['id' => 'image', 'label' => __('Product Image URL', 'figma-rebuild'), 'type' => 'url'],
  ];
  
  $wp_customize->add_setting('home_energy_products', [
    'default'           => wp_json_encode([
      [
        'name'  => 'Split Phase Hybrid Inverter 10kW',
        'price' => '$3999',
        'image' => $template_uri . '/src/images/products/Split Phase Hybrid Inverter 10kW.png',
      ],
      [
        'name'  => 'Battery Storage System',
        'price' => '$2599 - $7299',
        'image' => $template_uri . '/src/images/products/Battery Storage System.png',
      ],
      [
        'name'  => '',
        'price' => '',
        'image' => '',
      ],
    ]),
    'sanitize_callback' => function ($input) use ($home_energy_product_fields) {
      return figma_rebuild_sanitize_repeater($input, $home_energy_product_fields);
    },
  ]);
  $wp_customize->add_control(new Figma_Rebuild_Repeater_Control(
    $wp_customize,
    'home_energy_products',
    [
      'label'            => __('Home Energy Products', 'figma-rebuild'),
      'section'          => 'product_home_energy_cards_section',
      'fields'           => $home_energy_product_fields,
      'add_button_label' => __('Add Product', 'figma-rebuild'),
      'item_label'       => __('Product', 'figma-rebuild'),
    ]
  ));

  /* ------------------------------------------------------------------------ */
  /* Product Detail Page                                                      */
  /* ------------------------------------------------------------------------ */
  $wp_customize->add_panel('product_detail_panel', [
    'title'       => __('Product Detail Page', 'figma-rebuild'),
    'priority'    => 79,
    'description' => __('Configure the Product Detail page sections.', 'figma-rebuild'),
  ]);

  // Product Detail Hero Section
  $wp_customize->add_section('product_detail_hero_section', [
    'title' => __('Hero', 'figma-rebuild'),
    'panel' => 'product_detail_panel',
  ]);
  
  $wp_customize->add_setting('product_detail_hero_eyebrow', [
    'default'           => __('Eco 12kW AC', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('product_detail_hero_eyebrow', [
    'label'   => __('Eyebrow Text', 'figma-rebuild'),
    'section' => 'product_detail_hero_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('product_detail_hero_title', [
    'default'           => __('Cost Efficient Home Charger', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('product_detail_hero_title', [
    'label'   => __('Hero Title', 'figma-rebuild'),
    'section' => 'product_detail_hero_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('product_detail_hero_subtitle', [
    'default'           => __('Smart charging for your home. Save money, reduce emissions, and enjoy the convenience of charging at home.', 'figma-rebuild'),
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('product_detail_hero_subtitle', [
    'label'   => __('Hero Subtitle', 'figma-rebuild'),
    'section' => 'product_detail_hero_section',
    'type'    => 'textarea',
  ]);
  
  $wp_customize->add_setting('product_detail_hero_button_text', [
    'default'           => __('Order Now', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('product_detail_hero_button_text', [
    'label'   => __('Button Text', 'figma-rebuild'),
    'section' => 'product_detail_hero_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('product_detail_hero_button_link', [
    'default'           => '#contact',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('product_detail_hero_button_link', [
    'label'   => __('Button Link', 'figma-rebuild'),
    'section' => 'product_detail_hero_section',
    'type'    => 'url',
  ]);
  
  $wp_customize->add_setting('product_detail_hero_bg_image', [
    'default'           => $template_uri . '/src/images/product-Hero-Image.png',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'product_detail_hero_bg_image',
    [
      'label'   => __('Background Image', 'figma-rebuild'),
      'section' => 'product_detail_hero_section',
    ]
  ));

  // Cost Efficient Section
  $wp_customize->add_section('product_detail_cost_section', [
    'title' => __('Cost Efficient Section', 'figma-rebuild'),
    'panel' => 'product_detail_panel',
  ]);
  
  $wp_customize->add_setting('product_detail_cost_title', [
    'default'           => __('Cost Efficient Home Charger', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('product_detail_cost_title', [
    'label'   => __('Section Title', 'figma-rebuild'),
    'section' => 'product_detail_cost_section',
    'type'    => 'text',
  ]);
  
  $cost_card_fields = [
    ['id' => 'title', 'label' => __('Card Title', 'figma-rebuild'), 'type' => 'text'],
    ['id' => 'description', 'label' => __('Description', 'figma-rebuild'), 'type' => 'textarea'],
    ['id' => 'image', 'label' => __('Image URL', 'figma-rebuild'), 'type' => 'url'],
  ];
  
  $wp_customize->add_setting('product_detail_cost_cards', [
    'default'           => wp_json_encode([
      [
        'title' => 'Intelligent & Efficient',
        'description' => 'Dynamic load balancing protects your home supply while prioritising the lowest tariff windows for every session.',
        'image' => $template_uri . '/src/images/detail-Image-Top-Left.png',
      ],
      [
        'title' => 'Secure & Reliable',
        'description' => 'Built-in surge defence, ground-fault monitoring and auto-diagnostics keep every charge session protected.',
        'image' => $template_uri . '/src/images/detail-Image-Top-Right.png',
      ],
      [
        'title' => 'Flexible & Convenient',
        'description' => 'Control sessions remotely, share access securely with family members and review energy history in real time.',
        'image' => $template_uri . '/src/images/detail-Image-Bottom.png',
      ],
    ]),
    'sanitize_callback' => function ($input) use ($cost_card_fields) {
      return figma_rebuild_sanitize_repeater($input, $cost_card_fields);
    },
  ]);
  $wp_customize->add_control(new Figma_Rebuild_Repeater_Control(
    $wp_customize,
    'product_detail_cost_cards',
    [
      'label'            => __('Cost Efficient Cards', 'figma-rebuild'),
      'section'          => 'product_detail_cost_section',
      'fields'           => $cost_card_fields,
      'add_button_label' => __('Add Card', 'figma-rebuild'),
      'item_label'       => __('Card', 'figma-rebuild'),
    ]
  ));

  // Product Specs Section
  $wp_customize->add_section('product_detail_specs_section', [
    'title' => __('Product Specs Section', 'figma-rebuild'),
    'panel' => 'product_detail_panel',
  ]);
  
  $wp_customize->add_setting('product_detail_specs_title', [
    'default'           => __('Product Specifications', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('product_detail_specs_title', [
    'label'   => __('Section Title', 'figma-rebuild'),
    'section' => 'product_detail_specs_section',
    'type'    => 'text',
  ]);
  
  $spec_fields = [
    ['id' => 'category', 'label' => __('Category', 'figma-rebuild'), 'type' => 'text'],
    ['id' => 'specs', 'label' => __('Specifications (one per line)', 'figma-rebuild'), 'type' => 'textarea'],
  ];
  
  $wp_customize->add_setting('product_detail_specs', [
    'default'           => wp_json_encode([
      [
        'category' => 'Design',
        'specs' => "Dimensions (H × W × D): 320 × 220 × 120 mm\nWeight: 7.5 kg\nMounting: Wall / pedestal",
      ],
      [
        'category' => 'Input',
        'specs' => "Grid Connection: 1-phase AC\nVoltage Range: 180–264 V\nMax Current: 32 A",
      ],
      [
        'category' => 'Output',
        'specs' => "Power Rating: 12 kW AC\nConnector: Type 2\nCharging Speed: Up to 60 km / h",
      ],
    ]),
    'sanitize_callback' => function ($input) use ($spec_fields) {
      return figma_rebuild_sanitize_repeater($input, $spec_fields);
    },
  ]);
  $wp_customize->add_control(new Figma_Rebuild_Repeater_Control(
    $wp_customize,
    'product_detail_specs',
    [
      'label'            => __('Product Specifications', 'figma-rebuild'),
      'section'          => 'product_detail_specs_section',
      'fields'           => $spec_fields,
      'add_button_label' => __('Add Category', 'figma-rebuild'),
      'item_label'       => __('Category', 'figma-rebuild'),
    ]
  ));

  // Compare Models Section
  $wp_customize->add_section('product_detail_compare_section', [
    'title' => __('Compare Models Section', 'figma-rebuild'),
    'panel' => 'product_detail_panel',
  ]);
  
  $wp_customize->add_setting('product_detail_compare_title', [
    'default'           => __('Compare Models', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('product_detail_compare_title', [
    'label'   => __('Section Title', 'figma-rebuild'),
    'section' => 'product_detail_compare_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('product_detail_compare_description', [
    'default'           => __('Need help finding your right fit? Book a Free Consultation with us now.', 'figma-rebuild'),
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('product_detail_compare_description', [
    'label'   => __('Description', 'figma-rebuild'),
    'section' => 'product_detail_compare_section',
    'type'    => 'textarea',
  ]);
  
  $wp_customize->add_setting('product_detail_compare_button_text', [
    'default'           => __('Book Consultation', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('product_detail_compare_button_text', [
    'label'   => __('Button Text', 'figma-rebuild'),
    'section' => 'product_detail_compare_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('product_detail_compare_button_link', [
    'default'           => '#contact',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('product_detail_compare_button_link', [
    'label'   => __('Button Link', 'figma-rebuild'),
    'section' => 'product_detail_compare_section',
    'type'    => 'url',
  ]);

  /* ------------------------------------------------------------------------ */
  /* About Page                                                               */
  /* ------------------------------------------------------------------------ */
  $wp_customize->add_panel('about_panel', [
    'title'       => __('About Page', 'figma-rebuild'),
    'priority'    => 77,
    'description' => __('Configure the About page sections.', 'figma-rebuild'),
  ]);

  // About Hero Section
  $wp_customize->add_section('about_hero_section', [
    'title' => __('Hero', 'figma-rebuild'),
    'panel' => 'about_panel',
  ]);
  
  $wp_customize->add_setting('about_hero_title', [
    'default'           => __('About Us', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('about_hero_title', [
    'label'   => __('Hero Title', 'figma-rebuild'),
    'section' => 'about_hero_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('about_hero_description', [
    'default'           => __('We build reliable energy ecosystems that accelerate electrification and empower communities to thrive.', 'figma-rebuild'),
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('about_hero_description', [
    'label'   => __('Hero Description', 'figma-rebuild'),
    'section' => 'about_hero_section',
    'type'    => 'textarea',
  ]);
  
  $wp_customize->add_setting('about_hero_bg_image', [
    'default'           => $template_uri . '/src/images/about-Hero.png',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'about_hero_bg_image',
    [
      'label'   => __('Background Image', 'figma-rebuild'),
      'section' => 'about_hero_section',
    ]
  ));

  // About Story Section
  $wp_customize->add_section('about_story_section', [
    'title' => __('Story Sections', 'figma-rebuild'),
    'panel' => 'about_panel',
  ]);

  // Default story sections
  $default_story_sections = [
    [
      'kicker' => __('Our Value', 'figma-rebuild'),
      'title' => __('Reliable Energy, Tailored to Everyday Life', 'figma-rebuild'),
      'description' => __('From intelligent charging to smart energy management, we design systems that ensure dependable performance for homes, businesses, and fleets.', 'figma-rebuild'),
      'image' => $template_uri . '/src/images/ev_charging_pic.jpg',
      'image_alt' => __('Technician installing a charger on brick wall', 'figma-rebuild'),
    ],
    [
      'kicker' => __('Our Promise', 'figma-rebuild'),
      'title' => __('Partners in Every Step of Electrification', 'figma-rebuild'),
      'description' => __('We stay beside our customers with dedicated service teams, robust warranties, and insight that simplifies each installation.', 'figma-rebuild'),
      'image' => $template_uri . '/src/images/ev_app_control.jpg',
      'image_alt' => __('Driver monitoring EV charging from mobile app', 'figma-rebuild'),
    ],
    [
      'kicker' => __('Tailored Solutions', 'figma-rebuild'),
      'title' => __('Built for Communities, Campuses, and Corridors', 'figma-rebuild'),
      'description' => __('Whether deploying a single charger or building a regional network, our engineering team adapts hardware and software to match your roadmap.', 'figma-rebuild'),
      'image' => $template_uri . '/src/images/maxperr_expo.jpg',
      'image_alt' => __('Team demonstrating charging solutions at an expo', 'figma-rebuild'),
    ],
    [
      'kicker' => __('Our Team', 'figma-rebuild'),
      'title' => __('A Collective of Builders, Engineers, and Advocates', 'figma-rebuild'),
      'description' => __('We bring together energy experts, product designers, and field technicians who are united by a mission to make electrification effortless.', 'figma-rebuild'),
      'image' => $template_uri . '/src/images/maxperr_home_10kW.png',
      'image_alt' => __('Maxperr team collaborating beside charging units', 'figma-rebuild'),
    ],
  ];

  $story_fields = [
    ['id' => 'kicker', 'label' => __('Kicker Text', 'figma-rebuild'), 'type' => 'text'],
    ['id' => 'title', 'label' => __('Title', 'figma-rebuild'), 'type' => 'text'],
    ['id' => 'description', 'label' => __('Description', 'figma-rebuild'), 'type' => 'textarea'],
    ['id' => 'image', 'label' => __('Image', 'figma-rebuild'), 'type' => 'image'],
    ['id' => 'image_alt', 'label' => __('Image Alt Text', 'figma-rebuild'), 'type' => 'text'],
  ];
  
  $wp_customize->add_setting('about_story_sections', [
    'default'           => wp_json_encode($default_story_sections),
    'sanitize_callback' => function ($input) use ($story_fields) {
      return figma_rebuild_sanitize_repeater($input, $story_fields);
    },
  ]);
  $wp_customize->add_control(new Figma_Rebuild_Repeater_Control(
    $wp_customize,
    'about_story_sections',
    [
      'label'            => __('Story Sections', 'figma-rebuild'),
      'section'          => 'about_story_section',
      'fields'           => $story_fields,
      'add_button_label' => __('Add Story Section', 'figma-rebuild'),
      'item_label'       => __('Story Section', 'figma-rebuild'),
    ]
  ));

  // Power Future Section
  $wp_customize->add_section('about_power_future_section', [
    'title' => __('Power Future Section', 'figma-rebuild'),
    'panel' => 'about_panel',
  ]);
  
  $wp_customize->add_setting('about_power_future_title', [
    'default'           => __('Let\'s Power the Future Together.', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('about_power_future_title', [
    'label'   => __('Section Title', 'figma-rebuild'),
    'section' => 'about_power_future_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('about_power_future_primary_button_text', [
    'default'           => __('Contact Us', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('about_power_future_primary_button_text', [
    'label'   => __('Primary Button Text', 'figma-rebuild'),
    'section' => 'about_power_future_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('about_power_future_primary_button_link', [
    'default'           => '#contact',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('about_power_future_primary_button_link', [
    'label'   => __('Primary Button Link', 'figma-rebuild'),
    'section' => 'about_power_future_section',
    'type'    => 'url',
  ]);
  
  $wp_customize->add_setting('about_power_future_secondary_button_text', [
    'default'           => __('Careers', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('about_power_future_secondary_button_text', [
    'label'   => __('Secondary Button Text', 'figma-rebuild'),
    'section' => 'about_power_future_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('about_power_future_secondary_button_link', [
    'default'           => '#careers',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('about_power_future_secondary_button_link', [
    'label'   => __('Secondary Button Link', 'figma-rebuild'),
    'section' => 'about_power_future_section',
    'type'    => 'url',
  ]);

  /* ------------------------------------------------------------------------ */
  /* Partnership Page                                                         */
  /* ------------------------------------------------------------------------ */
  $wp_customize->add_panel('partnership_panel', [
    'title'       => __('Partnership Page', 'figma-rebuild'),
    'priority'    => 80,
    'description' => __('Configure the Partnership page sections.', 'figma-rebuild'),
  ]);

  // Partnership Hero
  $wp_customize->add_section('partnership_hero_section', [
    'title' => __('Hero', 'figma-rebuild'),
    'panel' => 'partnership_panel',
  ]);
  
  $wp_customize->add_setting('partnership_hero_headline', [
    'default'           => 'Partner With Us',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('partnership_hero_headline', [
    'label'   => __('Headline', 'figma-rebuild'),
    'section' => 'partnership_hero_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('partnership_hero_description', [
    'default'           => 'We are committed to accelerating the adoption of electric vehicles by making charging infrastructure more efficient and widespread.',
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('partnership_hero_description', [
    'label'   => __('Description', 'figma-rebuild'),
    'section' => 'partnership_hero_section',
    'type'    => 'textarea',
  ]);
  
  $wp_customize->add_setting('partnership_hero_button_text', [
    'default'           => __('Learn More', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('partnership_hero_button_text', [
    'label'   => __('Button Text', 'figma-rebuild'),
    'section' => 'partnership_hero_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('partnership_hero_button_link', [
    'default'           => '#partnership-content',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('partnership_hero_button_link', [
    'label'   => __('Button Link', 'figma-rebuild'),
    'section' => 'partnership_hero_section',
    'type'    => 'url',
  ]);
  
  $wp_customize->add_setting('partnership_hero_bg_image', [
    'default'           => $template_uri . '/src/images/bg_house2.jpg',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'partnership_hero_bg_image',
    [
      'label'   => __('Background Image', 'figma-rebuild'),
      'section' => 'partnership_hero_section',
    ]
  ));

  // Power Future Section
  $wp_customize->add_section('partnership_power_future_section', [
    'title' => __('Power Future Section', 'figma-rebuild'),
    'panel' => 'partnership_panel',
  ]);
  
  $wp_customize->add_setting('power_future_title', [
    'default'           => 'Power the Future Together',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('power_future_title', [
    'label'   => __('Section Title', 'figma-rebuild'),
    'section' => 'partnership_power_future_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('power_future_desc', [
    'default'           => "We're reaching out to electricians, distributors, contractors, and industry professionals like you to join us in expanding our network. By partnering together, we can combine our expertise and resources to meet the soaring demand for EV charging solutions.",
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('power_future_desc', [
    'label'   => __('Description', 'figma-rebuild'),
    'section' => 'partnership_power_future_section',
    'type'    => 'textarea',
  ]);
  
  $wp_customize->add_setting('power_future_cta_label', [
    'default'           => 'Apply Now',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('power_future_cta_label', [
    'label'   => __('CTA Button Text', 'figma-rebuild'),
    'section' => 'partnership_power_future_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('power_future_cta_link', [
    'default'           => '#become-partner',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('power_future_cta_link', [
    'label'   => __('CTA Button Link', 'figma-rebuild'),
    'section' => 'partnership_power_future_section',
    'type'    => 'url',
  ]);
  
  $wp_customize->add_setting('power_future_hero_image', [
    'default'           => $template_uri . '/src/images/partner-power-future.png',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'power_future_hero_image',
    [
      'label'   => __('Hero Background Image', 'figma-rebuild'),
      'section' => 'partnership_power_future_section',
    ]
  ));

  // Power Future Benefits (Repeater Field)
  $benefit_fields = [
    ['id' => 'title', 'label' => __('Benefit Title', 'figma-rebuild'), 'type' => 'text'],
    ['id' => 'text', 'label' => __('Benefit Description', 'figma-rebuild'), 'type' => 'textarea'],
  ];
  
  $wp_customize->add_setting('power_future_benefits', [
    'default'           => wp_json_encode([
      [
        'title' => 'Innovative Products',
        'text' => 'Provide your clients with state-of-the-art EV charging solutions.',
      ],
      [
        'title' => 'Competitive Pricing',
        'text' => 'Enjoy partner discounts and favorable terms.',
      ],
      [
        'title' => 'Grow Your Business',
        'text' => 'Increase your service offerings and grow your customer base.',
      ],
      [
        'title' => 'Training and Certification',
        'text' => 'Receive comprehensive training on installation and device maintenance.',
      ],
      [
        'title' => 'Dedicated Support',
        'text' => 'Get priority technical support and dedicated account management.',
      ],
    ]),
    'sanitize_callback' => function ($input) use ($benefit_fields) {
      return figma_rebuild_sanitize_repeater($input, $benefit_fields);
    },
  ]);
  $wp_customize->add_control(new Figma_Rebuild_Repeater_Control(
    $wp_customize,
    'power_future_benefits',
    [
      'label'            => __('Partnership Benefits', 'figma-rebuild'),
      'section'          => 'partnership_power_future_section',
      'fields'           => $benefit_fields,
      'add_button_label' => __('Add Benefit', 'figma-rebuild'),
      'item_label'       => __('Benefit', 'figma-rebuild'),
    ]
  ));

  // Who Can Apply Section
  $wp_customize->add_section('partnership_who_can_apply_section', [
    'title' => __('Who Can Apply Section', 'figma-rebuild'),
    'panel' => 'partnership_panel',
  ]);
  
  $wp_customize->add_setting('who_can_apply_title', [
    'default'           => 'Who Can Apply?',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('who_can_apply_title', [
    'label'   => __('Section Title', 'figma-rebuild'),
    'section' => 'partnership_who_can_apply_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('who_can_apply_description', [
    'default'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('who_can_apply_description', [
    'label'   => __('Section Description', 'figma-rebuild'),
    'section' => 'partnership_who_can_apply_section',
    'type'    => 'textarea',
  ]);
  
  $wp_customize->add_setting('who_can_apply_button_text', [
    'default'           => 'Apply Now',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('who_can_apply_button_text', [
    'label'   => __('Button Text', 'figma-rebuild'),
    'section' => 'partnership_who_can_apply_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('who_can_apply_button_link', [
    'default'           => '#become-partner',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('who_can_apply_button_link', [
    'label'   => __('Button Link', 'figma-rebuild'),
    'section' => 'partnership_who_can_apply_section',
    'type'    => 'url',
  ]);

  // Professional Types (Repeater Field)
  $professional_fields = [
    ['id' => 'title', 'label' => __('Professional Title', 'figma-rebuild'), 'type' => 'text'],
    ['id' => 'description', 'label' => __('Description', 'figma-rebuild'), 'type' => 'textarea'],
    ['id' => 'image', 'label' => __('Image URL', 'figma-rebuild'), 'type' => 'url'],
  ];
  
  $wp_customize->add_setting('who_can_apply_professionals', [
    'default'           => wp_json_encode([
      [
        'title' => 'Electricians and Technicians',
        'description' => 'Licensed professionals experienced in electrical installations.',
        'image' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&w=400&q=80',
      ],
      [
        'title' => 'Distributors and Resellers',
        'description' => 'Businesses looking to expand their product portfolio with EV solutions.',
        'image' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=400&q=80',
      ],
      [
        'title' => 'Contractors and Installers',
        'description' => 'Companies specializing in installing electrical or EV charging equipment.',
        'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=400&q=80',
      ],
      [
        'title' => 'Energy Consultants',
        'description' => 'Professionals advising clients on energy efficiency and sustainable solutions.',
        'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80',
      ],
      [
        'title' => 'Property Developers and Managers',
        'description' => 'Those interested in integrating EV charging into their projects.',
        'image' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?auto=format&fit=crop&w=400&q=80',
      ],
      [
        'title' => 'Architects and Engineers',
        'description' => 'Professionals specialize in the design and construction of infrastructures.',
        'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80',
      ],
    ]),
    'sanitize_callback' => function ($input) use ($professional_fields) {
      return figma_rebuild_sanitize_repeater($input, $professional_fields);
    },
  ]);
  $wp_customize->add_control(new Figma_Rebuild_Repeater_Control(
    $wp_customize,
    'who_can_apply_professionals',
    [
      'label'            => __('Professional Types', 'figma-rebuild'),
      'section'          => 'partnership_who_can_apply_section',
      'fields'           => $professional_fields,
      'add_button_label' => __('Add Professional Type', 'figma-rebuild'),
      'item_label'       => __('Professional Type', 'figma-rebuild'),
    ]
  ));

  // Collaboration Models Section
  $wp_customize->add_section('partnership_collaboration_models_section', [
    'title' => __('Collaboration Models Section', 'figma-rebuild'),
    'panel' => 'partnership_panel',
  ]);
  
  $wp_customize->add_setting('collaboration_models_title', [
    'default'           => 'Collaboration Models',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('collaboration_models_title', [
    'label'   => __('Section Title', 'figma-rebuild'),
    'section' => 'partnership_collaboration_models_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('collaboration_models_description', [
    'default'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('collaboration_models_description', [
    'label'   => __('Section Description', 'figma-rebuild'),
    'section' => 'partnership_collaboration_models_section',
    'type'    => 'textarea',
  ]);
  
  $wp_customize->add_setting('collaboration_models_image', [
    'default'           => $template_uri . '/src/images/partner-collaboration.png',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'collaboration_models_image',
    [
      'label'   => __('Section Image', 'figma-rebuild'),
      'section' => 'partnership_collaboration_models_section',
    ]
  ));

  // Collaboration Models (Repeater Field)
  $collaboration_fields = [
    ['id' => 'title', 'label' => __('Model Title', 'figma-rebuild'), 'type' => 'text'],
    ['id' => 'description', 'label' => __('Description', 'figma-rebuild'), 'type' => 'textarea'],
    ['id' => 'features', 'label' => __('Features (one per line)', 'figma-rebuild'), 'type' => 'textarea'],
    ['id' => 'note', 'label' => __('Note', 'figma-rebuild'), 'type' => 'textarea'],
  ];
  
  $wp_customize->add_setting('collaboration_models_items', [
    'default'           => wp_json_encode([
      [
        'title' => 'Authorized Installer',
        'description' => 'The Authorized Installer Program is tailored for licensed electricians and installation companies eager to tap into the growing EV charging market. By becoming an authorized installer, you position yourself as a trusted expert for Maxperr Energy\'s cutting-edge products.',
        'features' => "Access to exclusive training programs\nTechnical support and certification\nCompetitive pricing and terms\nMarketing support and materials",
        'note' => 'Ideal for licensed electricians and installation companies looking to expand their service offerings.',
      ],
      [
        'title' => 'Distributor Partnership',
        'description' => 'Join our network of authorized distributors to bring Maxperr Energy\'s innovative EV charging solutions to your market. Benefit from our comprehensive support system and proven business model.',
        'features' => "Exclusive territory rights\nComprehensive product training\nMarketing and sales support\nInventory management assistance",
        'note' => 'Perfect for established electrical distributors seeking to add EV charging to their portfolio.',
      ],
      [
        'title' => 'Referral Program',
        'description' => 'Earn rewards by referring qualified leads to Maxperr Energy. Our referral program offers competitive commissions for successful partnerships and installations.',
        'features' => "Competitive commission structure\nEasy lead submission process\nRegular performance tracking\nFlexible payment terms",
        'note' => 'Great for industry professionals who want to monetize their network without full commitment.',
      ],
      [
        'title' => 'Custom Solutions',
        'description' => 'Work with our team to develop tailored partnership solutions that meet your specific business needs and market requirements.',
        'features' => "Customized partnership terms\nDedicated account management\nFlexible program structure\nOngoing strategic support",
        'note' => 'Designed for large organizations or unique market situations requiring specialized approaches.',
      ],
    ]),
    'sanitize_callback' => function ($input) use ($collaboration_fields) {
      return figma_rebuild_sanitize_repeater($input, $collaboration_fields);
    },
  ]);
  $wp_customize->add_control(new Figma_Rebuild_Repeater_Control(
    $wp_customize,
    'collaboration_models_items',
    [
      'label'            => __('Collaboration Models', 'figma-rebuild'),
      'section'          => 'partnership_collaboration_models_section',
      'fields'           => $collaboration_fields,
      'add_button_label' => __('Add Model', 'figma-rebuild'),
      'item_label'       => __('Model', 'figma-rebuild'),
    ]
  ));

  // Become Partner Section
  $wp_customize->add_section('partnership_become_partner_section', [
    'title' => __('Become Partner Section', 'figma-rebuild'),
    'panel' => 'partnership_panel',
  ]);
  
  $wp_customize->add_setting('become_partner_title', [
    'default'           => 'Become a Partner Today',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('become_partner_title', [
    'label'   => __('Section Title', 'figma-rebuild'),
    'section' => 'partnership_become_partner_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('become_partner_primary_button_text', [
    'default'           => 'Apply Now',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('become_partner_primary_button_text', [
    'label'   => __('Primary Button Text', 'figma-rebuild'),
    'section' => 'partnership_become_partner_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('become_partner_primary_button_link', [
    'default'           => '#contact',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('become_partner_primary_button_link', [
    'label'   => __('Primary Button Link', 'figma-rebuild'),
    'section' => 'partnership_become_partner_section',
    'type'    => 'url',
  ]);
  
  $wp_customize->add_setting('become_partner_secondary_button_text', [
    'default'           => 'Learn More',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('become_partner_secondary_button_text', [
    'label'   => __('Secondary Button Text', 'figma-rebuild'),
    'section' => 'partnership_become_partner_section',
    'type'    => 'text',
  ]);
  
  $wp_customize->add_setting('become_partner_secondary_button_link', [
    'default'           => '#learn-more',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('become_partner_secondary_button_link', [
    'label'   => __('Secondary Button Link', 'figma-rebuild'),
    'section' => 'partnership_become_partner_section',
    'type'    => 'url',
  ]);
});

// Live preview partial refresh if needed (fallback to full refresh)
add_action('customize_preview_init', function () {
  wp_enqueue_script(
    'figma-rebuild-customizer-preview',
    get_template_directory_uri() . '/assets/js/customizer-preview.js',
    ['customize-preview'],
    null,
    true
  );
});

add_action('customize_controls_enqueue_scripts', function () {
  wp_enqueue_script(
    'figma-rebuild-customizer-controls',
    get_template_directory_uri() . '/assets/js/customizer-controls.js',
    ['customize-controls'],
    file_exists(get_template_directory() . '/assets/js/customizer-controls.js') ? filemtime(get_template_directory() . '/assets/js/customizer-controls.js') : null,
    true
  );

  wp_enqueue_style(
    'figma-rebuild-customizer-controls',
    get_template_directory_uri() . '/assets/css/customizer-controls.css',
    [],
    file_exists(get_template_directory() . '/assets/css/customizer-controls.css') ? filemtime(get_template_directory() . '/assets/css/customizer-controls.css') : null
  );
});
