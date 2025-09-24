<?php
/**
 * 可复用的子页面Hero模板
 * 
 * 使用方法：
 * 1. 在您的页面模板中包含此文件
 * 2. 设置相应的主题定制器选项
 * 3. 使用 subpage-hero 类名
 * 
 * 示例：
 * <?php
 * $hero_title = get_theme_mod('your_page_hero_title', '默认标题');
 * $hero_description = get_theme_mod('your_page_hero_description', '默认描述');
 * $hero_bg_image = get_theme_mod('your_page_hero_bg_image', get_template_directory_uri() . '/src/images/default-bg.jpg');
 * include get_template_directory() . '/parts/hero-template.php';
 * ?>
 */

// 如果没有设置变量，使用默认值
$hero_title = $hero_title ?? get_theme_mod('default_hero_title', __('Welcome', 'figma-rebuild'));
$hero_description = $hero_description ?? get_theme_mod('default_hero_description', __('Your description here', 'figma-rebuild'));
$hero_button_text = $hero_button_text ?? get_theme_mod('default_hero_button_text', __('Learn More', 'figma-rebuild'));
$hero_button_link = $hero_button_link ?? get_theme_mod('default_hero_button_link', '#');
$hero_bg_image = $hero_bg_image ?? get_theme_mod('default_hero_bg_image', get_template_directory_uri() . '/src/images/bg_house.jpg');
$hero_id = $hero_id ?? 'subpage-hero';
?>

<section class="hero-section subpage-hero relative overflow-hidden w-full" id="<?php echo esc_attr($hero_id); ?>">
  <div class="hero-bg-layer is-active"<?php echo $hero_bg_image ? ' style="background-image:url(' . esc_url($hero_bg_image) . ');"' : ''; ?>></div>
  <div class="hero-overlay subpage-hero__overlay"></div>

  <div class="subpage-hero__inner">
    <?php if (!empty($hero_title)) : ?>
      <h1 class="Hero-H1 subpage-hero__headline">
        <?php echo esc_html($hero_title); ?>
      </h1>
    <?php endif; ?>

    <?php if (!empty($hero_description)) : ?>
      <p class="Hero-Body subpage-hero__description">
        <?php echo wp_kses_post($hero_description); ?>
      </p>
    <?php endif; ?>

    <?php if (!empty($hero_button_text)) : ?>
      <a class="One-Column-Learn-More-Button subpage-hero__cta" href="<?php echo esc_url($hero_button_link); ?>">
        <?php echo esc_html($hero_button_text); ?>
      </a>
    <?php endif; ?>
  </div>
</section>
