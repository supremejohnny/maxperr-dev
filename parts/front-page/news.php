<?php
  $news_title = get_theme_mod('news_title', __('What\'s New?', 'figma-rebuild'));
  $news_subtitle = get_theme_mod('news_subtitle', __('All about our company and the EV Charging Industry.', 'figma-rebuild'));
  $news_bg_image = get_theme_mod('news_bg_image', '');
  $news_section_style = '';
  $styles = array();

  if ($news_bg_image) {
    $styles[] = sprintf('background-image:url(%s);', esc_url($news_bg_image));
  }

  // Responsive left margin targeting approximately 110px on large screens
  $styles[] = 'margin-left:clamp(1rem, 5.73vw, 110px);';

  if (!empty($styles)) {
    $news_section_style = ' style="' . implode(' ', $styles) . '"';
  }

  $news_defaults = figma_rebuild_get_default_news_items();
  $news_items_raw = get_theme_mod('news_items', wp_json_encode($news_defaults));
  $news_items = json_decode($news_items_raw, true);
  if (!is_array($news_items) || empty($news_items)) {
    $news_items = $news_defaults;
  }

  $news_items = array_values(array_filter($news_items, function ($item) {
    if (!is_array($item)) {
      return false;
    }

    $title = isset($item['title']) ? trim((string) $item['title']) : '';
    $image = isset($item['image']) ? trim((string) $item['image']) : '';

    return $title !== '' || $image !== '';
  }));
?>

<!-- News Section -->
<section class="py-24" id="news" data-news-slider<?php echo $news_section_style; ?>>
  <div class="container mx-auto px-6 relative">
  <div class="news-head">
    <div class="news-heading">
      <?php if ($news_title) : ?>
        <h2 class="H2-Black text-section text-gray-900"><?php echo esc_html($news_title); ?></h2>
      <?php endif; ?>
      <?php if ($news_subtitle) : ?>
        <p class="Body-1" style="margin-top: 10px;"><?php echo wp_kses_post($news_subtitle); ?></p>
      <?php endif; ?>
    </div>
    <button class="One-Column-Learn-More-Button">Read More</button>
  </div>


    <div class="news-viewport">
      <div class="news-track">
        <?php foreach ($news_items as $item) :
          $title = isset($item['title']) ? trim((string) $item['title']) : '';
          $tag = isset($item['tag']) ? trim((string) $item['tag']) : '';
          $date = isset($item['date']) ? trim((string) $item['date']) : '';
          $image = isset($item['image']) ? trim((string) $item['image']) : '';
          $link = isset($item['link']) ? trim((string) $item['link']) : '';

          if ($title === '' && $image === '') {
            continue;
          }
        ?>
          <article class="news-card">
            <?php if ($link) : ?><a href="<?php echo esc_url($link); ?>" class="news-card__link" aria-label="<?php echo esc_attr($title ?: __('News article', 'figma-rebuild')); ?>"><?php endif; ?>
              <div class="news-card__image">
                <?php if ($image) : ?>
                  <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title ?: __('News article', 'figma-rebuild')); ?>" class="w-full h-full object-cover">
                <?php endif; ?>
                <?php if ($date) : ?>
                  <time class="news-date" datetime="<?php echo esc_attr($date); ?>"><?php echo esc_html($date); ?></time>
                <?php endif; ?>
              </div>
              <div class="p-6">
                <?php if ($title) : ?>
                  <h3 class="news-title"><?php echo esc_html($title); ?></h3>
                <?php endif; ?>
                <?php if ($tag) : ?>
                  <span class="news-card__tag"><?php echo esc_html($tag); ?></span>
                <?php endif; ?>
              </div>
            <?php if ($link) : ?></a><?php endif; ?>
          </article>
        <?php endforeach; ?>
      </div>
    </div>

    <button class="news-nav news-prev" type="button" aria-label="Previous">‹</button>
    <button class="news-nav news-next" type="button" aria-label="Next">›</button>
  </div>
</section>
