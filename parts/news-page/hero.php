<?php
  // 可选：从自定义器取图；没配就用主题内置占位图
  $news_img = get_theme_mod('news_bg_image', '');
  $fallback = get_template_directory_uri() . '/src/images/Maxperr-news.png';
  $hero_src = $news_img ?: $fallback;
?>

<section class="news-hero">
  <div class="container mx-auto px-6">
    <h1 class="news-hero__title"><?php esc_html_e('News', 'figma-rebuild'); ?></h1>
  </div>

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
