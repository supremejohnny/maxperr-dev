<?php
// 优先使用自定义字段，如果没有则使用页面内容作为后备
$custom_content = get_theme_mod('news_paragraph_content', '');
$page_content = get_query_var('news_paragraph_page_content', '');
$content = !empty($custom_content) ? $custom_content : $page_content;

// 处理基本格式化
if (!empty($content)) {
  // 将换行符转换为HTML换行
  $content = nl2br($content);
  
  // 将双换行符转换为段落分隔
  $content = preg_replace('/<br\s*\/?>\s*<br\s*\/?>/i', '</p><p>', $content);
  
  // 确保内容被段落标签包围
  if (!preg_match('/^<p>/i', trim($content))) {
    $content = '<p>' . $content;
  }
  if (!preg_match('/<\/p>$/i', trim($content))) {
    $content = $content . '</p>';
  }
}
?>

<section class="news-paragraph-body">
  <div class="container mx-auto px-6">
    <article class="news-paragraph-body__article">
      <?php if (!empty($content)) : ?>
        <?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
      <?php else : ?>
        <p class="news-paragraph-body__placeholder">
          <?php esc_html_e('Add your news content in the customizer or page editor to display it here.', 'figma-rebuild'); ?>
        </p>
      <?php endif; ?>
    </article>
  </div>
</section>
