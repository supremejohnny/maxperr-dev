<?php
  // 从自定义器获取标题和图片
  $hero_title = get_theme_mod('news_page_hero_title', __('News', 'figma-rebuild'));
  $news_img = get_theme_mod('news_page_hero_bg_image', '');
  $fallback = get_template_directory_uri() . '/src/images/Maxperr-news.png';
  $hero_bg_image = $news_img ?: $fallback;
  
  // 清空 description 和 button，只显示标题
  $hero_description = '';
  $hero_button_text = '';
  $hero_button_link = '';
  $hero_id = 'news-hero';
  
  // 包含hero template
  include get_template_directory() . '/parts/hero-template.php';
?>

<style>
  /* News page hero 特别定制 */
  #news-hero.subpage-hero {
    height: clamp(80px, 12vh, 100px);
    min-height: auto;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  #news-hero .hero-bg-layer {
    background-size: cover; /* 图片覆盖整个区域 */
    background-position: center;
    width: 100%;
  }
  
  #news-hero .subpage-hero__inner {
    margin-top: 0;
    margin-left: clamp(160px, 4vw, 160px);
    width: 100%;
    max-width: 100%;
    text-align: left;
  }
  
  #news-hero .subpage-hero__headline {
    text-align: left;
    margin: 0;
    color: #000000;
  }
  
  /* 平板设备 */
  @media (max-width: 1024px) {
    #news-hero.subpage-hero {
      height: clamp(70px, 10vh, 90px);
    }
  }
  
  /* 移动设备 */
  @media (max-width: 768px) {
    #news-hero.subpage-hero {
      height: clamp(60px, 8vh, 80px);
    }
  }
  
  @media (max-width: 480px) {
    #news-hero.subpage-hero {
      height: clamp(50px, 7vh, 70px);
    }
  }
</style>
