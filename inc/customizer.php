<?php
// Register Customizer settings for all theme sections

add_action('customize_register', function ($wp_customize) {
  $template_uri = get_template_directory_uri();

  /* ------------------------------------------------------------------------ */
  /* Hero Section                                                             */
  /* ------------------------------------------------------------------------ */
  $wp_customize->add_section('hero_section', [
    'title'       => __('Hero Section', 'figma-rebuild'),
    'priority'    => 30,
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
  /* Why Us Section                                                           */
  /* ------------------------------------------------------------------------ */
  $wp_customize->add_section('whyus_section', [
    'title'    => __('Why Us Section', 'figma-rebuild'),
    'priority' => 35,
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
  /* Services Section                                                         */
  /* ------------------------------------------------------------------------ */
  $wp_customize->add_section('services_section', [
    'title'    => __('Services Section', 'figma-rebuild'),
    'priority' => 40,
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

  /* ------------------------------------------------------------------------ */
  /* Monitor Section                                                          */
  /* ------------------------------------------------------------------------ */
  $wp_customize->add_section('monitor_section', [
    'title'    => __('Monitor Section', 'figma-rebuild'),
    'priority' => 45,
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
  /* Trust Section                                                            */
  /* ------------------------------------------------------------------------ */
  $wp_customize->add_section('trust_section', [
    'title'    => __('Trust Section', 'figma-rebuild'),
    'priority' => 50,
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

  $wp_customize->add_setting('trust_back_title', [
    'default'           => __('-50% Charging Cost!', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('trust_back_title', [
    'label'   => __('背景卡片标题', 'figma-rebuild'),
    'section' => 'trust_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('trust_back_paragraph', [
    'default'           => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'figma-rebuild'),
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('trust_back_paragraph', [
    'label'   => __('背景卡片段落', 'figma-rebuild'),
    'section' => 'trust_section',
    'type'    => 'textarea',
  ]);

  $wp_customize->add_setting('trust_back_author', [
    'default'           => __('Josh Q. / JQ Builder', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('trust_back_author', [
    'label'   => __('背景卡片作者', 'figma-rebuild'),
    'section' => 'trust_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('trust_front_title', [
    'default'           => __('Amazing ROI!', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('trust_front_title', [
    'label'   => __('前景卡片标题', 'figma-rebuild'),
    'section' => 'trust_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('trust_front_paragraph', [
    'default'           => __('Installation was seamless and support is outstanding. We track usage remotely and save every month.', 'figma-rebuild'),
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('trust_front_paragraph', [
    'label'   => __('前景卡片段落', 'figma-rebuild'),
    'section' => 'trust_section',
    'type'    => 'textarea',
  ]);

  $wp_customize->add_setting('trust_front_author', [
    'default'           => __('Mia L. / Studio Élan', 'figma-rebuild'),
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('trust_front_author', [
    'label'   => __('前景卡片作者', 'figma-rebuild'),
    'section' => 'trust_section',
    'type'    => 'text',
  ]);

  /* ------------------------------------------------------------------------ */
  /* News Section                                                             */
  /* ------------------------------------------------------------------------ */
  $wp_customize->add_section('news_section', [
    'title'    => __('News Section', 'figma-rebuild'),
    'priority' => 55,
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


