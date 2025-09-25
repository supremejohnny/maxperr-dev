<?php
/**
 * Template Name: About
 */

get_header();

$hero_title = get_theme_mod('about_hero_title', __('About Us', 'figma-rebuild'));
$hero_description = get_theme_mod(
  'about_hero_description',
  __('Reliable Energy. Renewable Future.', 'figma-rebuild')
);
$hero_bg_image = get_theme_mod(
  'about_hero_bg_image',
  get_template_directory_uri() . '/src/images/maxperr_expo.jpg'
);
$hero_button_text = '';
$hero_button_link = '';
$hero_id = 'about-hero';

include get_template_directory() . '/parts/hero-template.php';

$default_about_sections = [
  [
    'title'    => __('Our Value', 'figma-rebuild'),
    'subtitle' => __('Maxperr Energy is committed to empowering communities by making dependable EV charging accessible for every household, workplace, and fleet.', 'figma-rebuild'),
    'image'    => get_template_directory_uri() . '/src/images/maxperr_expo.jpg',
    'gradient' => 'linear-gradient(135deg, rgba(15,23,42,0.78), rgba(59,130,246,0.55))',
    'align'    => 'left',
  ],
  [
    'title'    => __('Our Promise', 'figma-rebuild'),
    'subtitle' => __('We build hardware and software that are intuitive to install, effortless to manage, and supported by a responsive technical team you can count on.', 'figma-rebuild'),
    'image'    => get_template_directory_uri() . '/src/images/bg_house.jpg',
    'gradient' => 'linear-gradient(135deg, rgba(15,23,42,0.82), rgba(2,132,199,0.55))',
    'align'    => 'right',
  ],
  [
    'title'    => __('Solutions Tailored to Your Needs', 'figma-rebuild'),
    'subtitle' => __('From residential driveways to complex commercial depots, our specialists design charging ecosystems that scale with your goals and budget.', 'figma-rebuild'),
    'image'    => get_template_directory_uri() . '/src/images/ev_charging_pic.jpg',
    'gradient' => 'linear-gradient(135deg, rgba(15,23,42,0.78), rgba(34,197,94,0.45))',
    'align'    => 'left',
  ],
  [
    'title'    => __('Our Team', 'figma-rebuild'),
    'subtitle' => __('Engineers, consultants, and advocates working together to accelerate electrification across North America with safe, future-ready infrastructure.', 'figma-rebuild'),
    'image'    => get_template_directory_uri() . '/src/images/install_wallbox.png',
    'gradient' => 'linear-gradient(135deg, rgba(15,23,42,0.82), rgba(56,189,248,0.45))',
    'align'    => 'right',
  ],
];

$about_sections = apply_filters('maxperr_about_sections', $default_about_sections);
if (!is_array($about_sections)) {
  $about_sections = $default_about_sections;
}

include get_template_directory() . '/parts/about/highlights.php';

$pf = [];
get_template_part('parts/partnership/power-future');

get_footer();
