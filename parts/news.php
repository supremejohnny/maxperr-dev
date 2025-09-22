<?php
  $news_title = get_theme_mod('news_title', __('What\'s New?', 'figma-rebuild'));
  $news_subtitle = get_theme_mod('news_subtitle', __('All about our company and the EV Charging Industry.', 'figma-rebuild'));
  $news_bg_image = get_theme_mod('news_bg_image', '');
  $news_section_style = '';

  if ($news_bg_image) {
    $news_section_style = sprintf(' style="background-image:url(%s);"', esc_url($news_bg_image));
  }
?>

<!-- News Section -->
<section class="py-24" id="news" data-news-slider<?php echo $news_section_style; ?>>
  <div class="container mx-auto px-6 relative">
  <div class="news-head">
    <div class="news-heading">
      <?php if ($news_title) : ?>
        <h2 class="text-section text-gray-900"><?php echo esc_html($news_title); ?></h2>
      <?php endif; ?>
      <?php if ($news_subtitle) : ?>
        <p class="news-sub"><?php echo wp_kses_post($news_subtitle); ?></p>
      <?php endif; ?>
    </div>
    <button class="CTA-medium">View All</button>
  </div>


    <div class="news-viewport">
      <div class="news-track">
        <!-- 复制 article 以增加卡片数量 -->
        <article class="news-card">
          <div class="news-card__image">
            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=2069&q=80" alt="News article" class="w-full h-full object-cover">
            <time class="news-date" datetime="2025-07-11">2025-07-11</time>
          </div>
          <div class="p-6">
            <h3 class="news-title">[2025 Edition] Home EV Charger Installation Tips</h3>
            <span class="news-card__tag">Knowledge</span>
          </div>
        </article>

        <article class="news-card">
          <div class="news-card__image">
            <img src="https://images.unsplash.com/photo-1593941707882-a5bac6861d75?auto=format&fit=crop&w=2072&q=80" alt="News article" class="w-full h-full object-cover">
            <time class="news-date" datetime="2025-06-25">2025-06-25</time>
          </div>
          <div class="p-6">
            <h3 class="news-title">10+ Public Charging Stations Launched downtown Toronto</h3>
            <span class="news-card__tag">Knowledge</span>
          </div>
        </article>

        <article class="news-card">
          <div class="news-card__image">
            <img src="<?php echo get_template_directory_uri(); ?>/src/images/bg_house.jpg" alt="News article" class="w-full h-full object-cover">
            <time class="news-date" datetime="2025-06-10">2025-06-10</time>
          </div>
          <div class="p-6">
            <h3 class="news-title">Maxperr Energy Unveils Powerful EV Charging Solutions at Canada's Largest Expo</h3>
            <span class="news-card__tag">News</span>
          </div>
        </article>

        <article class="news-card">
          <div class="news-card__image">
            <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=2070&auto=format&fit=crop" alt="News article" class="w-full h-full object-cover">
            <time class="news-date" datetime="2025-05-30">2025-05-30</time>
          </div>
          <div class="p-6">
            <h3 class="news-title">Grid-Friendly Charging Strategies for Commercial Sites</h3>
            <span class="news-card__tag">News</span>
          </div>
        </article>

        <article class="news-card">
          <div class="news-card__image">
            <img src="https://images.unsplash.com/photo-1611880984806-a0a7d48b8c67?q=80&w=2070&auto=format&fit=crop" alt="News article" class="w-full h-full object-cover">
            <time class="news-date" datetime="2025-05-12">2025-05-12</time>
          </div>
          <div class="p-6">
            <h3 class="news-title">Smart O&amp;M: Lowering TCO of EV Charging Assets</h3>
            <span class="news-card__tag">Knowledge</span>
          </div>
        </article>
      </div>
    </div>

    <button class="news-nav news-prev" type="button" aria-label="Previous">‹</button>
    <button class="news-nav news-next" type="button" aria-label="Next">›</button>
  </div>
</section>
