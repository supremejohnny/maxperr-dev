<?php
/**
 * Power the Future Together — full-bleed + bottom feather + overlay benefits
 * 零依赖 Tailwind，样式 scoped。
 */

if (!isset($pf) || !is_array($pf)) { $pf = []; }

$pf['title']       = $pf['title']       ?? get_theme_mod('power_future_title', 'Power the Future Together');
$pf['description'] = $pf['description'] ?? get_theme_mod('power_future_desc', "We're reaching out to electricians, distributors, contractors, and industry professionals like you to join us in expanding our network. By partnering together, we can combine our expertise and resources to meet the soaring demand for EV charging solutions.");
$pf['cta_label']   = $pf['cta_label']   ?? get_theme_mod('power_future_cta_label', 'Apply Now');
$pf['cta_link']    = $pf['cta_link']    ?? get_theme_mod('power_future_cta_link', '#become-partner');

$hero_image = $pf['hero_image'] ?? get_theme_mod('power_future_hero_image', '');
if (is_numeric($hero_image)) { $hero_image = wp_get_attachment_image_url((int)$hero_image, 'full'); }
if (empty($hero_image)) { $hero_image = get_template_directory_uri().'/src/images/bg_house2.jpg'; }

$benefits = $pf['benefits'] ?? get_theme_mod('power_future_benefits', []);
if (empty($benefits) || !is_array($benefits)) {
  $benefits = [
    ['title'=>'Innovative Products','text'=>'Provide your clients with state-of-the-art EV charging solutions.'],
    ['title'=>'Competitive Pricing','text'=>'Enjoy partner discounts and favorable terms.'],
    ['title'=>'Grow Your Business','text'=>'Increase your service offerings and grow your customer base.'],
    ['title'=>'Training and Certification','text'=>'Receive comprehensive training on installation and device maintenance.'],
    ['title'=>'Dedicated Support','text'=>'Get priority technical support and dedicated account management.'],
  ];
}

$section_id = 'power-future';
?>
<section id="<?php echo esc_attr($section_id); ?>" class="pf-wrap">
  <style>
    #<?php echo esc_js($section_id); ?>.pf-wrap { padding: 36px 0 0; background:#fff; }
    #<?php echo esc_js($section_id); ?> .pf-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }

    /* 头部：居中 */
    #<?php echo esc_js($section_id); ?> .pf-head { text-align:center; margin-bottom: 18px; }
    #<?php echo esc_js($section_id); ?> .pf-title { margin:0 0 10px; font-size:40px; line-height:1.15; font-weight:800; color:#0f172a; letter-spacing:-.02em; }
    #<?php echo esc_js($section_id); ?> .pf-desc  { margin:0 auto; max-width:840px; color:#374151; font-size:16px; line-height:1.7; }
    #<?php echo esc_js($section_id); ?> .pf-cta   {
      margin-top:12px; display:inline-flex; align-items:center; justify-content:center;
      padding:10px 18px; border-radius:9999px; background:#1d4ed8; color:#fff; font-weight:700; text-decoration:none;
      box-shadow:0 10px 20px rgba(29,78,216,.25);
    }

    /* 英雄图 full-bleed（100vw） */
    #<?php echo esc_js($section_id); ?> .pf-bleed {
      position: relative;
      width: 100vw; max-width: 100vw;
      margin-left: calc(50% - 50vw);  /* 从容器“溢出”到两边 */
      margin-right: calc(50% - 50vw);
      overflow: visible;
    }
    #<?php echo esc_js($section_id); ?> .pf-hero-img {
      width: 100%; height: var(--pf-hero-h, 560px); object-fit: cover; display:block;
      /* 羽化到透明：支持性优先 -webkit */
      -webkit-mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 65%, rgba(0,0,0,0) 100%);
              mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 65%, rgba(0,0,0,0) 100%);
    }
    /* 兜底：在不支持 mask 的浏览器，叠加白色渐变 */
    #<?php echo esc_js($section_id); ?> .pf-bleed::after{
      content:""; position:absolute; left:0; right:0; bottom:0; height:35%;
      background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 95%);
      pointer-events:none; z-index:1;
    }
    @media (max-width: 1024px){ #<?php echo esc_js($section_id); ?> .pf-hero-img{ --pf-hero-h: 500px; } }
    @media (max-width: 640px) { #<?php echo esc_js($section_id); ?> .pf-hero-img{ --pf-hero-h: 420px; } }

    /* 覆盖在羽化区域的 benefits */
    #<?php echo esc_js($section_id); ?> .pf-overlay{
      position: absolute; z-index: 2;
      left: 50%; transform: translateX(-50%);
      bottom: clamp(10px, 3vw, 26px);
      width: min(1200px, calc(100% - 28px));
      padding: 0 4px;
    }
    #<?php echo esc_js($section_id); ?> .pf-grid{
      display:grid; gap: 16px; grid-template-columns: 1fr;
      text-align:center;
    }
    @media (min-width: 640px){ #<?php echo esc_js($section_id); ?> .pf-grid{ grid-template-columns: repeat(2,1fr); } }
    @media (min-width: 1024px){ #<?php echo esc_js($section_id); ?> .pf-grid{ grid-template-columns: repeat(5,1fr); gap: 10px; } }

    #<?php echo esc_js($section_id); ?> .pf-item h3{
      margin:0 0 6px; font-weight:800; font-size:15px; line-height:1.3; color:#1e40af;
    }
    #<?php echo esc_js($section_id); ?> .pf-div{ width: 60%; height: 2px; margin: 6px auto 8px; background:#0f172a; }
    #<?php echo esc_js($section_id); ?> .pf-item p{
      margin:0; color:#111827; font-size:13px; line-height:1.55;
    }
  </style>

  <div class="pf-container">
    <div class="pf-head">
      <h2 class="pf-title"><?php echo esc_html($pf['title']); ?></h2>
      <?php if (!empty($pf['description'])): ?><p class="pf-desc"><?php echo esc_html($pf['description']); ?></p><?php endif; ?>
      <?php if (!empty($pf['cta_label']) && !empty($pf['cta_link'])): ?>
        <a class="pf-cta" href="<?php echo esc_url($pf['cta_link']); ?>"><?php echo esc_html($pf['cta_label']); ?></a>
      <?php endif; ?>
    </div>
  </div>

  <!-- Full-bleed hero outside container -->
  <figure class="pf-bleed">
    <img class="pf-hero-img" src="<?php echo esc_url($hero_image); ?>" alt="EV partnership hero">

    <?php if (!empty($benefits)): ?>
      <div class="pf-overlay" aria-label="Partnership benefits">
        <div class="pf-grid">
          <?php foreach ($benefits as $b):
            $bt = trim($b['title'] ?? ''); $bd = trim($b['text'] ?? '');
          ?>
            <div class="pf-item">
              <?php if ($bt): ?><h3><?php echo esc_html($bt); ?></h3><?php endif; ?>
              <div class="pf-div" aria-hidden="true"></div>
              <?php if ($bd): ?><p><?php echo esc_html($bd); ?></p><?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>
  </figure>
</section>

<style id="pf-bigger">
  /* 放大整块（图片高度 + 覆盖区域 + 文案字号） */
  #power-future .pf-hero-img { --pf-hero-h: 680px; }                 /* 默认更高 */
  @media (min-width: 1280px){ #power-future .pf-hero-img { --pf-hero-h: 760px; } } /* 超大屏更高 */
  @media (max-width: 1024px){ #power-future .pf-hero-img { --pf-hero-h: 560px; } } /* 笔电/Pad */
  @media (max-width: 640px) { #power-future .pf-hero-img { --pf-hero-h: 480px; } } /* 手机 */

  /* 让覆盖层位置也按比例下移一点，保持呼吸感 */
  #power-future .pf-overlay { 
    bottom: clamp(16px, 4vw, 40px);
    width: min(1300px, calc(100% - 28px));   /* 覆盖层稍微更宽，适配大屏 */
  }

  /* 描述区字号稍微放大一点点，以匹配更高的视觉 */
  #power-future .pf-item h3 { font-size: 17px; }
  #power-future .pf-item p  { font-size: 14.5px; }
  #power-future .pf-div     { width: 70%; }  /* 分隔线略长，比例更协调 */
</style>

<style id="pf-benefits-compact">
  /* 整体区域也稍微收窄一点，更聚拢 */
  #power-future .pf-overlay{
    width: min(1050px, calc(100% - 28px));
  }

  /* >=1024px 时：5 列定宽，更紧凑、居中排列 */
  @media (min-width:1024px){
    #power-future .pf-grid{
      /* 每列 160–200px，按需自动取值；整组居中 */
      grid-template-columns: repeat(5, minmax(160px, 200px));
      justify-content: center;
      column-gap: clamp(12px, 1.6vw, 28px);
      row-gap: 10px;
    }
    #power-future .pf-item{ padding: 0 4px; }
    #power-future .pf-item h3{ font-size: 16px; margin-bottom: 10px; }
    #power-future .pf-item p{
      max-width: 180px;           /* 文案列宽受控，视觉更紧凑 */
      margin: 0 auto;
      font-size: 14px;
      line-height: 1.55;
    }
    #power-future .pf-div{ width: 68%; }  /* 分隔线也缩短一点 */
  }

  /* 640–1024 保持 2 列，但也略微收紧 */
  @media (min-width:640px) and (max-width:1023.98px){
    #power-future .pf-grid{
      grid-template-columns: repeat(2, minmax(160px, 220px));
      column-gap: 18px;
    }
    #power-future .pf-item p{ max-width: 420px; margin: 0 auto; }
  }
</style>

<style id="pf-benefits-title-compact">
  /* 调这个变量一把梭：168–184px 一般能让所有标题断成两行 */
  #power-future { --pf-title-w: 145px; }

  @media (min-width:1024px){
    /* 标题收窄 + 居中 + 更均匀的两行 */
    #power-future .pf-item h3{
      max-width: var(--pf-title-w);
      margin-left:auto; margin-right:auto;
      line-height: 1.25;
      white-space: normal;         /* 按单词换行 */
      word-break: normal;          /* 避免硬断词 */
      text-wrap: balance;          /* 支持的浏览器会更均匀分两行 */
    }

    /* 分隔线也稍微跟着缩一点，更协调 */
    #power-future .pf-div{ width: 68%; }

    /* 段落保持之前列宽；如果你想跟标题同宽也可以解开下面一行 */
    /* #power-future .pf-item p{ max-width: var(--pf-title-w); } */
  }

  /* Pad 段也略紧凑些（可选） */
  @media (min-width:640px) and (max-width:1023.98px){
    #power-future .pf-item h3{ max-width: 200px; text-wrap: balance; }
  }
</style>
