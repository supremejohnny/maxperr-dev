<?php
  // 从自定义器获取标题和图片
  $news_title = get_theme_mod('news_page_hero_title', __('News', 'figma-rebuild'));
  $news_img = get_theme_mod('news_page_hero_bg_image', '');
  $fallback = get_template_directory_uri() . '/src/images/Maxperr-news.png';
  $hero_src = $news_img ?: $fallback;
?>

<section class="news-hero">
  <div class="container mx-auto px-6">
    <h1 class="H2-Black" style="margin-left: 160px; margin-bottom: -30px;"><?php echo esc_html($news_title); ?></h1>
  </div>
</section>

<section class="news-hero-image">
  <figure class="news-hero__figure">
    <img
      src="<?php echo esc_url($hero_src); ?>"
      alt="<?php esc_attr_e('Maxperr Energy hero', 'figma-rebuild'); ?>"
      class="news-hero__image"
      loading="eager"
      decoding="async"
    />
  </figure>
</section>
