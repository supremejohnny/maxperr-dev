<?php
$content = get_query_var('news_paragraph_page_content', '');
?>

<section class="news-paragraph-body">
  <div class="container mx-auto px-6">
    <article class="news-paragraph-body__article">
      <?php if (!empty($content)) : ?>
        <?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
      <?php else : ?>
        <p class="news-paragraph-body__placeholder">
          <?php esc_html_e('Add your news content in the page editor to display it here.', 'figma-rebuild'); ?>
        </p>
      <?php endif; ?>
    </article>
  </div>
</section>
