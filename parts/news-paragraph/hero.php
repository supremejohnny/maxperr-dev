<?php
$hero_defaults = function_exists('figma_rebuild_get_default_news_paragraph_hero')
  ? figma_rebuild_get_default_news_paragraph_hero()
  : [
    'tag'   => __('Insights', 'figma-rebuild'),
    'title' => __('Latest News', 'figma-rebuild'),
    'date'  => '',
    'image' => '',
  ];

$hero_tag   = get_theme_mod('news_paragraph_hero_tag', $hero_defaults['tag']);
$hero_title = get_theme_mod('news_paragraph_hero_title', '');

if ('' === trim((string) $hero_title)) {
  $hero_title = get_query_var('news_paragraph_page_title', $hero_defaults['title']);
}

$hero_image = get_theme_mod('news_paragraph_hero_image', $hero_defaults['image']);
$date_value = get_theme_mod('news_paragraph_hero_date', $hero_defaults['date']);

if ('' === trim((string) $date_value) && get_post()) {
  $date_value = get_the_date('Y-m-d');
}

$timestamp      = $date_value ? strtotime($date_value) : false;
$hero_date_attr = $timestamp ? gmdate('Y-m-d', $timestamp) : $date_value;
$hero_date_text = $timestamp ? date_i18n(get_option('date_format'), $timestamp) : $date_value;

$hero_image_alt = get_theme_mod('news_paragraph_hero_image_alt', $hero_defaults['image_alt']);

if ('' === trim((string) $hero_image_alt)) {
  $hero_image_alt = $hero_defaults['image_alt'];
}
?>

<section class="news-paragraph-hero">
  <div class="container mx-auto px-6">
    <div class="news-paragraph-hero__grid">
      <div class="news-paragraph-hero__content">
        <?php if (!empty($hero_tag)) : ?>
          <span class="news-paragraph-hero__tag"><?php echo esc_html($hero_tag); ?></span>
        <?php endif; ?>

        <?php if (!empty($hero_title)) : ?>
          <h1 class="news-paragraph-hero__title"><?php echo esc_html($hero_title); ?></h1>
        <?php endif; ?>
      </div>

      <figure class="news-paragraph-hero__media">
        <div class="news-paragraph-hero__image-wrapper">
          <?php if (!empty($hero_image)) : ?>
            <img
              class="news-paragraph-hero__image"
              src="<?php echo esc_url($hero_image); ?>"
              alt="<?php echo esc_attr($hero_image_alt); ?>"
              loading="eager"
              decoding="async"
            />
          <?php else : ?>
            <div class="news-paragraph-hero__image-placeholder" aria-hidden="true"></div>
          <?php endif; ?>

          <?php if (!empty($hero_date_text)) : ?>
            <figcaption class="news-paragraph-hero__date" aria-label="<?php esc_attr_e('Published on', 'figma-rebuild'); ?>">
              <time datetime="<?php echo esc_attr($hero_date_attr); ?>"><?php echo esc_html($hero_date_text); ?></time>
            </figcaption>
          <?php endif; ?>
        </div>
      </figure>
    </div>
  </div>
</section>
