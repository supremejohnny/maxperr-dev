<?php
$initial_visible = isset($news_archive_initial) ? (int) $news_archive_initial : 6;
if ($initial_visible < 1) {
  $initial_visible = 6;
}

$news_query = new WP_Query([
  'post_type'      => 'post',
  'post_status'    => 'publish',
  'posts_per_page' => -1,
  'orderby'        => 'date',
  'order'          => 'DESC',
]);
?>
<section class="news-archive" data-news-archive>
  <div class="news-archive__container">
    <?php if ($news_query->have_posts()) : ?>
      <div class="news-archive__grid">
        <?php
        $index = 0;
        while ($news_query->have_posts()) :
          $news_query->the_post();
          $index++;
          $is_hidden = $index > $initial_visible;
          $card_classes = 'news-archive__card';
          if ($is_hidden) {
            $card_classes .= ' is-collapsed';
          }

          $permalink = get_permalink();
          $title     = get_the_title();
          $date_iso  = get_the_date(DATE_ATOM);
          $date_text = get_the_date('Y-m-d');
          $image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
          if (!$image_url) {
            $image_url = get_template_directory_uri() . '/src/images/bg_forest.jpg';
          }

          $categories = get_the_category();
          $primary_category = '';
          if (!empty($categories)) {
            $primary_category = $categories[0]->name;
          }
        ?>
          <article class="<?php echo esc_attr($card_classes); ?>">
            <a class="news-archive__link" href="<?php echo esc_url($permalink); ?>">
              <figure class="news-archive__media">
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>">
              </figure>
              <div class="news-archive__meta">
                <?php if ($primary_category) : ?>
                  <span class="news-archive__tag"><?php echo esc_html($primary_category); ?></span>
                <?php endif; ?>
                <time class="news-archive__date" datetime="<?php echo esc_attr($date_iso); ?>"><?php echo esc_html($date_text); ?></time>
              </div>
              <h3 class="news-archive__title"><?php echo esc_html($title); ?></h3>
            </a>
          </article>
        <?php endwhile; ?>
      </div>

      <?php if ($news_query->found_posts > $initial_visible) : ?>
        <button class="news-archive__more" type="button" data-action="expand-news"><?php esc_html_e('Read More', 'figma-rebuild'); ?></button>
      <?php endif; ?>
    <?php else : ?>
      <p class="news-archive__empty"><?php esc_html_e('No news available yet. Please check back soon.', 'figma-rebuild'); ?></p>
    <?php endif; ?>
  </div>
</section>
<?php
wp_reset_postdata();

if ($news_query->found_posts > $initial_visible) {
  $script = <<<'JS'
  document.addEventListener('DOMContentLoaded', function () {
    var archive = document.querySelector('[data-news-archive]');
    if (!archive) {
      return;
    }
    var button = archive.querySelector('[data-action="expand-news"]');
    if (!button) {
      return;
    }
    button.addEventListener('click', function () {
      archive.querySelectorAll('.news-archive__card.is-collapsed').forEach(function (card) {
        card.classList.remove('is-collapsed');
      });
      button.setAttribute('hidden', 'hidden');
    });
  });
JS;
  if (!wp_script_is('figma-rebuild-app', 'enqueued')) {
    wp_enqueue_script('figma-rebuild-app');
  }
  wp_add_inline_script('figma-rebuild-app', $script);
}
