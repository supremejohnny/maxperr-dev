<?php
/**
 * About page story sections – full-bleed image card with half-blur text overlay.
 */

$default_sections = [
  [
    'kicker' => __('Our Value', 'figma-rebuild'),
    'title' => __('Reliable Energy, Tailored to Everyday Life', 'figma-rebuild'),
    'description' => __('From intelligent charging to smart energy management, we design systems that ensure dependable performance for homes, businesses, and fleets.', 'figma-rebuild'),
    'image' => get_template_directory_uri() . '/src/images/ev_charging_pic.jpg',
    'image_alt' => __('Technician installing a charger on brick wall', 'figma-rebuild'),
  ],
  [
    'kicker' => __('Our Promise', 'figma-rebuild'),
    'title' => __('Partners in Every Step of Electrification', 'figma-rebuild'),
    'description' => __('We stay beside our customers with dedicated service teams, robust warranties, and insight that simplifies each installation.', 'figma-rebuild'),
    'image' => get_template_directory_uri() . '/src/images/ev_app_control.jpg',
    'image_alt' => __('Driver monitoring EV charging from mobile app', 'figma-rebuild'),
  ],
  [
    'kicker' => __('Tailored Solutions', 'figma-rebuild'),
    'title' => __('Built for Communities, Campuses, and Corridors', 'figma-rebuild'),
    'description' => __('Whether deploying a single charger or building a regional network, our engineering team adapts hardware and software to match your roadmap.', 'figma-rebuild'),
    'image' => get_template_directory_uri() . '/src/images/maxperr_expo.jpg',
    'image_alt' => __('Team demonstrating charging solutions at an expo', 'figma-rebuild'),
  ],
  [
    'kicker' => __('Our Team', 'figma-rebuild'),
    'title' => __('A Collective of Builders, Engineers, and Advocates', 'figma-rebuild'),
    'description' => __('We bring together energy experts, product designers, and field technicians who are united by a mission to make electrification effortless.', 'figma-rebuild'),
    'image' => get_template_directory_uri() . '/src/images/maxperr_home_10kW.png',
    'image_alt' => __('Maxperr team collaborating beside charging units', 'figma-rebuild'),
  ],
];

$about_sections_raw = get_theme_mod('about_story_sections', wp_json_encode($default_sections));
$about_sections = json_decode($about_sections_raw, true);
if (!is_array($about_sections) || empty($about_sections)) {
  $about_sections = $default_sections;
}
?>

<section id="about-story" class="about-story">
  <div class="about-story__container">
    <?php foreach ($about_sections as $index => $section) :
      $kicker = trim($section['kicker'] ?? '');
      $title = trim($section['title'] ?? '');
      $description = trim($section['description'] ?? '');
      $image = $section['image'] ?? '';
      $image_alt = $section['image_alt'] ?? '';
      if (is_numeric($image)) {
        $image = wp_get_attachment_image_url((int)$image, 'full');
      }
      if (!$image) continue;
    ?>
      <article class="blend-card" data-card="<?php echo (int)$index; ?>">
        <!-- 基底原图（不模糊） -->
        <img class="blend-card__img" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($image_alt); ?>" loading="lazy" />

        <!-- 左侧淡入的白色/雾化遮罩，增强对比度 -->
        <span class="blend-card__shade" aria-hidden="true"></span>

        <!-- 文字层：放在左半区 -->
        <div class="blend-card__content">
          <?php if ($kicker) : ?>
            <p class="blend-card__kicker"><?php echo esc_html($kicker); ?></p>
          <?php endif; ?>

          <?php if ($title) : ?>
            <h2 class="blend-card__title"><?php echo esc_html($title); ?></h2>
          <?php endif; ?>

          <?php if ($description) : ?>
            <p class="blend-card__desc"><?php echo esc_html($description); ?></p>
          <?php endif; ?>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>
