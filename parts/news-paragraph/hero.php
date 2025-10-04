<?php
/**
 * Template Part: Article Hero (stacked, light)
 * Layout: Tag + H1 on top, full-width hero image centered (≈50vh),
 *         author & date at bottom-left under the image.
 */

$hero_defaults = [
  'tag'       => __('Knowledge', 'figma-rebuild'),
  'title'     => __('Latest News', 'figma-rebuild'),
  'date'      => '',
  'image'     => get_template_directory_uri() . '/src/images/news/newspara-Installation.png',
  'image_alt' => '',
];

$hero_tag   = get_theme_mod('news_paragraph_hero_tag', $hero_defaults['tag']);
$hero_title = get_theme_mod('news_paragraph_hero_title', '');
if ('' === trim((string) $hero_title)) {
  $hero_title = get_query_var('news_paragraph_page_title', $hero_defaults['title']);
}

$hero_image     = get_theme_mod('news_paragraph_hero_image', $hero_defaults['image']);
$hero_image_alt = get_theme_mod('news_paragraph_hero_image_alt', $hero_defaults['image_alt']);

$date_value = get_theme_mod('news_paragraph_hero_date', $hero_defaults['date']);
if ($date_value === '' && get_post()) {
  $date_value = get_the_date('Y-m-d');
}
$timestamp      = $date_value ? strtotime($date_value) : false;
$hero_date_attr = $timestamp ? gmdate('Y-m-d', $timestamp) : $date_value;
$hero_date_text = $timestamp ? date_i18n(get_option('date_format'), $timestamp) : $date_value;

/** Author override -> post author fallback */
$author_custom = get_theme_mod('news_paragraph_hero_author', '');
if ($author_custom !== '') {
  $author_name = $author_custom;
} else {
  $post_id     = get_the_ID();
  $author_id   = $post_id ? (int) get_post_field('post_author', $post_id) : 0;
  $author_name = $author_id ? get_the_author_meta('display_name', $author_id) : '';
}
?>
<section class="news-article-hero" data-variant="light" data-layout="stack">
  
  <div class="news-article-hero__container">
    <?php 
    // Get the news page URL
    $news_page_url = home_url('/news/');
    ?>
    <div class="news-article-hero__actions">
      <a href="<?php echo esc_url($news_page_url); ?>" class="news-article-hero__back-link">
        < <?php echo esc_html__('Read More', 'figma-rebuild'); ?>
      </a>
    </div>
    <header class="news-article-hero__header">
      <?php if ($hero_tag) : ?>
        <span class="knowledge-tag"><?php echo esc_html($hero_tag); ?></span>
      <?php endif; ?>
      <?php if ($hero_title) : ?>
        <h1 class="H2-Black"><?php echo esc_html($hero_title); ?></h1>
      <?php endif; ?>
    </header>

    <figure class="news-article-hero__media">
      <div class="news-article-hero__image-wrap">
        <?php if ($hero_image) : ?>
          <img
            class="news-article-hero__image"
            src="<?php echo esc_url($hero_image); ?>"
            alt="<?php echo esc_attr($hero_image_alt); ?>"
            loading="eager" decoding="async" width="1920" height="1080"
          />
        <?php else : ?>
          <div class="news-article-hero__placeholder" aria-hidden="true"></div>
        <?php endif; ?>
      </div>
    </figure>

    <?php if ($author_name || $hero_date_text) : ?>
      <p class="news-article-hero__meta">
        <?php if ($author_name) : ?>
          <span class="Body-1_Bold"><?php echo esc_html($author_name); ?></span>
        <?php endif; ?>
        <?php if ($author_name && $hero_date_text) : ?>
          <span class="Body-1_Bold"> / </span>
        <?php endif; ?>
        <?php if ($hero_date_text) : ?>
          <time class="Body-1_Bold" style="margin-left: 20px;" datetime="<?php echo esc_attr($hero_date_attr); ?>"><?php echo esc_html($hero_date_text); ?></time>
        <?php endif; ?>
      </p>
    <?php endif; ?>

    
  </div>
</section>
