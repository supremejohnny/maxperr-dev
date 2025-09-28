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
if (empty($hero_image)) { $hero_image = get_template_directory_uri().'/src/images/partner-power-future.png'; }

// Get benefits from customizer repeater field
$benefits_raw = get_theme_mod('power_future_benefits', '');
$benefits = [];
if (!empty($benefits_raw)) {
  $benefits = json_decode($benefits_raw, true);
  if (!is_array($benefits)) {
    $benefits = [];
  }
}

// Fallback to default benefits if none are set
if (empty($benefits)) {
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
    #<?php echo esc_js($section_id); ?> .pf-container { max-width: 1200px; margin: 0 auto; padding: 0 clamp(16px, 3vw, 24px); }

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
    @media (max-width: 1024px){ 
      #<?php echo esc_js($section_id); ?> .pf-hero-img{ --pf-hero-h: 500px; } 
      #<?php echo esc_js($section_id); ?> .pf-overlay{ padding: 0 min(40px, 5vw) !important; height: min(140px, 9vw) !important; }
      #<?php echo esc_js($section_id); ?> .pf-grid{ gap: min(20px, 2.5vw) !important; grid-template-columns: repeat(3, 1fr) !important; }
      #<?php echo esc_js($section_id); ?> .pf-item h3{ margin: 0 auto 15px !important; font-size: clamp(14px, 2.2vw, 18px) !important; }
      #<?php echo esc_js($section_id); ?> .pf-div{ width: min(140px, 12vw) !important; height: 2px !important; margin: 3px auto 5px !important; }
      #<?php echo esc_js($section_id); ?> .pf-item p{ max-width: min(140px, 12vw) !important; font-size: clamp(10px, 1.8vw, 12px) !important; line-height: 1.4 !important; }
      /* 隐藏第4和第5个benefit在平板端 */
      #<?php echo esc_js($section_id); ?> .pf-item:nth-child(4),
      #<?php echo esc_js($section_id); ?> .pf-item:nth-child(5) { display: none !important; }
    }
    @media (max-width: 640px) { 
      #<?php echo esc_js($section_id); ?> .pf-hero-img{ --pf-hero-h: 420px; } 
      #<?php echo esc_js($section_id); ?> .pf-overlay{ padding: 0 min(20px, 5vw) !important; height: auto !important; min-height: min(100px, 7vw) !important; }
      #<?php echo esc_js($section_id); ?> .pf-grid{ gap: min(20px, 4vw) !important; }
      #<?php echo esc_js($section_id); ?> .pf-item h3{ margin: 0 auto 12px !important; font-size: clamp(14px, 3.5vw, 18px) !important; text-align: center !important; }
      #<?php echo esc_js($section_id); ?> .pf-div{ width: min(150px, 70vw) !important; height: 2px !important; margin: 3px auto 4px !important; }
      #<?php echo esc_js($section_id); ?> .pf-item p{ max-width: min(150px, 70vw) !important; font-size: clamp(10px, 2.8vw, 12px) !important; line-height: 1.3 !important; }
      /* 手机端只显示前3个benefits */
      #<?php echo esc_js($section_id); ?> .pf-item:nth-child(4),
      #<?php echo esc_js($section_id); ?> .pf-item:nth-child(5) { display: none !important; }
    }
    
    /* 超小屏幕优化 */
    @media (max-width: 480px) {
      #<?php echo esc_js($section_id); ?> .pf-overlay{ padding: 0 min(16px, 4vw) !important; height: min(80px, 6vw) !important; }
      #<?php echo esc_js($section_id); ?> .pf-grid{ gap: min(16px, 4vw) !important; grid-template-columns: repeat(2, 1fr) !important; }
      #<?php echo esc_js($section_id); ?> .pf-item h3{ margin: 0 auto 10px !important; font-size: clamp(12px, 4vw, 16px) !important; text-align: center !important; }
      #<?php echo esc_js($section_id); ?> .pf-div{ width: min(120px, 60vw) !important; height: 2px !important; margin: 2px auto 3px !important; }
      #<?php echo esc_js($section_id); ?> .pf-item p{ max-width: min(120px, 60vw) !important; font-size: clamp(9px, 3vw, 11px) !important; line-height: 1.2 !important; }
      /* 超小屏幕只显示前2个benefits */
      #<?php echo esc_js($section_id); ?> .pf-item:nth-child(3),
      #<?php echo esc_js($section_id); ?> .pf-item:nth-child(4),
      #<?php echo esc_js($section_id); ?> .pf-item:nth-child(5) { display: none !important; }
    }

    /* 覆盖在羽化区域的 benefits */
    #<?php echo esc_js($section_id); ?> .pf-overlay{
      position: absolute !important; z-index: 2 !important;
      left: 0 !important; right: 0 !important;
      bottom: clamp(10px, 3vw, 26px) !important;
      height: min(180px, 11vw) !important;
      padding: 0 min(120px, 7.5vw) !important;
      box-sizing: border-box !important;
    }
    #<?php echo esc_js($section_id); ?> .pf-grid{
      display:grid !important; gap: min(50px, 3vw) !important; grid-template-columns: 1fr !important;
      text-align:center !important;
    }
    @media (min-width: 640px){ #<?php echo esc_js($section_id); ?> .pf-grid{ grid-template-columns: repeat(2,1fr) !important; } }
    @media (min-width: 1024px){ #<?php echo esc_js($section_id); ?> .pf-grid{ grid-template-columns: repeat(5,1fr) !important; gap: min(50px, 3vw) !important; } }

    #<?php echo esc_js($section_id); ?> .pf-item h3{
      margin:0 auto 30px !important; font-family: 'Manrope', sans-serif !important; font-weight: 600 !important; font-size: clamp(20px, 2.5vw, 25px) !important; line-height: 120% !important; letter-spacing: -0.02em !important; color: #2970A7 !important; text-align: center !important;
    }
    #<?php echo esc_js($section_id); ?> .pf-div{ width: min(220px, 14vw) !important; height: 3px !important; margin: 6px auto 8px !important; background:#0f172a !important; }
    #<?php echo esc_js($section_id); ?> .pf-item p{
      margin:0 auto !important; color:#111827 !important; font-size:clamp(12px, 1.5vw, 14px) !important; line-height:1.55 !important; max-width: min(220px, 14vw) !important;
    }
  </style>

  <div class="pf-container">
    <div class="pf-head">
      <h2 class="H2-Black "><?php echo esc_html($pf['title']); ?></h2>
      <?php if (!empty($pf['description'])): ?><p class="Body-1" style="color: #000; margin:20px auto; max-width: 890px;"><?php echo esc_html($pf['description']); ?></p><?php endif; ?>
      <?php if (!empty($pf['cta_label']) && !empty($pf['cta_link'])): ?>
        <a class="One-Column-Learn-More-Button" href="<?php echo esc_url($pf['cta_link']); ?>" style="margin-bottom: 60px;"><?php echo esc_html($pf['cta_label']); ?></a>
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
  @media (max-width: 1024px){ 
    #power-future .pf-hero-img { --pf-hero-h: 560px; } /* 笔电/Pad */
    #power-future .pf-overlay{ padding: 0 min(40px, 5vw) !important; height: min(140px, 9vw) !important; }
    #power-future .pf-grid{ gap: min(20px, 2.5vw) !important; grid-template-columns: repeat(3, 1fr) !important; }
    #power-future .pf-item h3{ margin: 0 auto 15px !important; font-size: clamp(14px, 2.2vw, 18px) !important; }
    #power-future .pf-div{ width: min(140px, 12vw) !important; height: 2px !important; margin: 3px auto 5px !important; }
    #power-future .pf-item p{ max-width: min(140px, 12vw) !important; font-size: clamp(10px, 1.8vw, 12px) !important; line-height: 1.4 !important; }
    /* 隐藏第4和第5个benefit在平板端 */
    #power-future .pf-item:nth-child(4),
    #power-future .pf-item:nth-child(5) { display: none !important; }
  }
  @media (max-width: 640px) { 
    #power-future .pf-hero-img { --pf-hero-h: 480px; } /* 手机 */
    #power-future .pf-overlay{ padding: 0 min(20px, 5vw) !important; height: auto !important; min-height: min(100px, 7vw) !important; }
    #power-future .pf-grid{ gap: min(20px, 4vw) !important; }
    #power-future .pf-item h3{ margin: 0 auto 12px !important; font-size: clamp(14px, 3.5vw, 18px) !important; text-align: center !important; }
    #power-future .pf-div{ width: min(150px, 70vw) !important; height: 2px !important; margin: 3px auto 4px !important; }
    #power-future .pf-item p{ max-width: min(150px, 70vw) !important; font-size: clamp(10px, 2.8vw, 12px) !important; line-height: 1.3 !important; }
    /* 手机端只显示前3个benefits */
    #power-future .pf-item:nth-child(4),
    #power-future .pf-item:nth-child(5) { display: none !important; }
  }
  
  /* 超小屏幕优化 */
  @media (max-width: 480px) {
    #power-future .pf-overlay{ padding: 0 min(16px, 4vw) !important; height: min(80px, 6vw) !important; }
    #power-future .pf-grid{ gap: min(16px, 4vw) !important; grid-template-columns: repeat(2, 1fr) !important; }
    #power-future .pf-item h3{ margin: 0 auto 10px !important; font-size: clamp(12px, 4vw, 16px) !important; text-align: center !important; }
    #power-future .pf-div{ width: min(120px, 60vw) !important; height: 2px !important; margin: 2px auto 3px !important; }
    #power-future .pf-item p{ max-width: min(120px, 60vw) !important; font-size: clamp(9px, 3vw, 11px) !important; line-height: 1.2 !important; }
    /* 超小屏幕只显示前2个benefits */
    #power-future .pf-item:nth-child(3),
    #power-future .pf-item:nth-child(4),
    #power-future .pf-item:nth-child(5) { display: none !important; }
  }

  /* 让覆盖层位置也按比例下移一点，保持呼吸感 */
  #power-future .pf-overlay { 
    bottom: clamp(16px, 4vw, 40px);
    left: 0; right: 0;   /* 使用全宽，通过padding控制间距 */
    height: min(180px, 11vw);
    padding: 0 min(120px, 7.5vw);
    box-sizing: border-box;
  }

  /* 描述区字号稍微放大一点点，以匹配更高的视觉 */
  #power-future .pf-item h3 { 
    font-family: 'Manrope', sans-serif; 
    font-weight: 600; 
    font-size: clamp(20px, 2.5vw, 25px); 
    line-height: 120%; 
    letter-spacing: -0.02em; 
    color: #2970A7; 
    margin: 0 0 30px;
  }
  #power-future .pf-item p  { 
    font-size: 14.5px; 
    max-width: min(220px, 14vw); 
    margin: 0 auto;
  }
  #power-future .pf-div     { width: min(220px, 14vw); height: 3px; }  /* 分割线与描述对齐 */
</style>

<style id="pf-benefits-compact">
  /* 整体区域也稍微收窄一点，更聚拢 */
  #power-future .pf-overlay{
    left: 0; right: 0;   /* 使用全宽，通过padding控制间距 */
    height: min(180px, 11vw);
    padding: 0 min(120px, 7.5vw);
    box-sizing: border-box;
  }

  /* >=1024px 时：5 列定宽，更紧凑、居中排列 */
  @media (min-width:1024px){
    #power-future .pf-grid{
      /* 每列 200–280px，按需自动取值；整组居中 */
      grid-template-columns: repeat(5, minmax(200px, 280px));
      justify-content: center;
      column-gap: min(50px, 3vw);
      row-gap: 10px;
    }
    #power-future .pf-item{ padding: 0 4px; }
    #power-future .pf-item h3{ 
      font-family: 'Manrope', sans-serif; 
      font-weight: 600; 
      font-size: clamp(20px, 2.5vw, 25px); 
      line-height: 120%; 
      letter-spacing: -0.02em; 
      color: #2970A7; 
      margin: 0 0 30px; 
    }
    #power-future .pf-item p{
      max-width: min(220px, 14vw);           /* 文案列宽受控，视觉更紧凑 */
      margin: 0 auto;
      font-size: 14px;
      line-height: 1.55;
    }
    #power-future .pf-div{ width: min(220px, 14vw); height: 3px; }  /* 分割线与描述对齐 */
  }

  /* 640–1024 保持 2 列，但也略微收紧 */
  @media (min-width:640px) and (max-width:1023.98px){
    #power-future .pf-grid{
      grid-template-columns: repeat(2, minmax(200px, 280px));
      column-gap: min(50px, 3vw);
    }
    #power-future .pf-item p{ max-width: min(220px, 14vw); margin: 0 auto; }
  }
</style>

<style id="pf-benefits-title-compact">
  /* 调这个变量一把梭：168–184px 一般能让所有标题断成两行 */
  #power-future { --pf-title-w: 145px; }

  @media (min-width:1024px){
    /* 标题收窄 + 居中 + 更均匀的两行 */
    #power-future .pf-item h3{
      max-width: var(--pf-title-w);
      margin: 0 auto 30px;
      font-family: 'Manrope', sans-serif; 
      font-weight: 600; 
      font-size: clamp(20px, 2.5vw, 25px); 
      line-height: 120%; 
      letter-spacing: -0.02em; 
      color: #2970A7;
      white-space: normal;         /* 按单词换行 */
      word-break: normal;          /* 避免硬断词 */
      text-wrap: balance;          /* 支持的浏览器会更均匀分两行 */
    }

    /* 分隔线与描述对齐 */
    #power-future .pf-div{ width: min(220px, 14vw); }

    /* 段落保持之前列宽；如果你想跟标题同宽也可以解开下面一行 */
    /* #power-future .pf-item p{ max-width: var(--pf-title-w); } */
  }

  /* Pad 段也略紧凑些（可选） */
  @media (min-width:640px) and (max-width:1023.98px){
    #power-future .pf-item h3{ max-width: 200px; text-wrap: balance; }
  }
</style>

