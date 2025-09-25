<?php
if (!isset($about_sections) || !is_array($about_sections) || empty($about_sections)) {
  return;
}

$about_section_id = isset($about_section_id) ? sanitize_title($about_section_id) : 'about-highlights';
?>
<section id="<?php echo esc_attr($about_section_id); ?>" class="about-highlights">
  <div class="about-highlights__container">
    <?php foreach ($about_sections as $index => $section) :
      $title    = isset($section['title']) ? trim((string) $section['title']) : '';
      $subtitle = isset($section['subtitle']) ? trim((string) $section['subtitle']) : '';
      $image    = isset($section['image']) ? trim((string) $section['image']) : '';
      $gradient = isset($section['gradient']) ? trim((string) $section['gradient']) : '';
      $align    = isset($section['align']) ? trim((string) $section['align']) : 'left';

      if ('' === $title && '' === $subtitle) {
        continue;
      }

      $background_layers = [];
      if ($gradient) {
        $background_layers[] = $gradient;
      }
      if ($image) {
        $background_layers[] = 'url(' . esc_url($image) . ')';
      }
      $background_style = '';
      if (!empty($background_layers)) {
        $background_style = ' style="background-image: ' . esc_attr(implode(', ', $background_layers)) . ';"';
      }

      $align_class = 'about-highlight--align-left';
      if ('right' === strtolower($align)) {
        $align_class = 'about-highlight--align-right';
      }
    ?>
      <article class="about-highlight <?php echo esc_attr($align_class); ?>"<?php echo $background_style; ?> aria-label="<?php echo esc_attr($title ?: __('About highlight', 'figma-rebuild')); ?>">
        <div class="about-highlight__content">
          <?php if ($title) : ?>
            <h2 class="about-highlight__title"><?php echo esc_html($title); ?></h2>
          <?php endif; ?>

          <?php if ($subtitle) : ?>
            <p class="about-highlight__subtitle"><?php echo esc_html($subtitle); ?></p>
          <?php endif; ?>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>
