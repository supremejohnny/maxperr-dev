<?php
  $news_defaults = figma_rebuild_get_default_news_items();
  $news_items_raw = get_theme_mod('news_page_items', wp_json_encode($news_defaults));
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

  $visible_count = 6;
  $total_items = count($news_items);
?>

<section class="news-page-body">
  <div class="container mx-auto px-6">
    <div class="news-grid-wrapper" data-news-grid data-visible-count="<?php echo esc_attr($visible_count); ?>">
      <div class="news-grid">
        <?php foreach ($news_items as $index => $item) :
          $title = isset($item['title']) ? trim((string) $item['title']) : '';
          $tag = isset($item['tag']) ? trim((string) $item['tag']) : '';
          $date = isset($item['date']) ? trim((string) $item['date']) : '';
          $image = isset($item['image']) ? trim((string) $item['image']) : '';
          $link = isset($item['link']) ? trim((string) $item['link']) : '';

          if ($title === '' && $image === '') {
            continue;
          }

          $is_hidden = $index >= $visible_count;
          $card_tag = $link ? 'a' : 'article';
          $card_attrs = [
            'class' => 'news-grid__card' . ($link ? ' news-grid__card--link' : ''),
            'data-news-card' => 'true',
          ];

          if ($link) {
            $card_attrs['href'] = esc_url($link);
            $card_attrs['aria-label'] = esc_attr($title ?: __('News article', 'figma-rebuild'));
          }

          if ($is_hidden) {
            $card_attrs['hidden'] = 'hidden';
            $card_attrs['data-news-hidden'] = 'true';
          }

          $attr_pairs = [];
          foreach ($card_attrs as $attr_key => $attr_value) {
            if ($attr_key === 'class') {
              $attr_pairs[] = sprintf('class="%s"', esc_attr($attr_value));
            } elseif ($attr_key === 'href' || $attr_key === 'aria-label') {
              $attr_pairs[] = sprintf('%s="%s"', $attr_key, esc_attr($attr_value));
            } else {
              $attr_pairs[] = sprintf('%s="%s"', esc_attr($attr_key), esc_attr($attr_value));
            }
          }

          $attr_string = implode(' ', $attr_pairs);
        ?>
          <<?php echo $card_tag . ' ' . $attr_string; ?>>
            <div class="news-grid__image">
              <?php if ($image) : ?>
                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title ?: __('News article', 'figma-rebuild')); ?>">
              <?php else : ?>
                <div class="news-grid__image--placeholder" aria-hidden="true"></div>
              <?php endif; ?>
            </div>
            <div class="news-grid__body">
              <div class="news-grid__meta">
                <?php if ($tag) : ?>
                  <span class="knowledge-tag"><?php echo esc_html($tag); ?></span>
                <?php endif; ?>
                <?php if ($date) :
                  $timestamp = strtotime($date);
                  $formatted_date = $timestamp ? date_i18n(get_option('date_format'), $timestamp) : $date;
                ?>
                  <time class="Body-1" style="color: #000;" datetime="<?php echo esc_attr($date); ?>"><?php echo esc_html($formatted_date); ?></time>
                <?php endif; ?>
              </div>
              <?php if ($title) : ?>
                <h3 class="H3"><?php echo esc_html($title); ?></h3>
              <?php endif; ?>
            </div>
          </<?php echo $card_tag; ?>>
        <?php endforeach; ?>
      </div>

      <?php if ($total_items > $visible_count) : ?>
        <div class="news-grid__actions">
          <button type="button" class="One-Column-Shop-All-Button" data-news-load-more>
            <?php echo esc_html__('Read more', 'figma-rebuild'); ?>
          </button>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
