<?php
/**
 * Product Detail — Simple Hero (inline CSS, facts overlay on image)
 */
$template_uri = get_template_directory_uri();
?>

<section class="pd-hero" id="product-detail-hero">
  <style>
    /* ===== Simple Product Detail Hero (INLINE) ===== */
    .pd-hero{background:#fff;padding:clamp(2rem,4vw,3rem) 1.5rem 0;color:#0f172a;font-family:'Inter',system-ui,-apple-system,'Helvetica Neue',Arial,sans-serif;position: relative;}
    .pd-hero__inner{max-width:1180px;margin:0 auto;margin-left:clamp(100px,8.5vw,163px)}
    .pd-hero__header{display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;position:static}
    .pd-hero__title{margin:0 0 .5rem 0;font-weight:700;font-size:clamp(2.4rem,1.9rem + 1.9vw,3.6rem);line-height:1.05}
    .pd-hero__subtitle{margin:0;font-size:clamp(.9rem,.85rem + .25vw,1rem);color:#475569}
    .One-Column-Shop-All-Button{position:absolute;right: calc(163px - 1.5rem);top: 62px;z-index: 5;}
    .pd-hero__cta:hover{transform:translateY(-1px);box-shadow:0 14px 28px rgba(37,99,235,.28)}

    /* Full-bleed hero image */
    .pd-hero__bleed{width:100vw;max-width:100vw;margin:clamp(1rem,2.5vw,2rem) 0 0 0;position:relative;left:50%;right:50%;transform:translateX(-50%);overflow:hidden;box-sizing:border-box}
    .pd-hero__image{display:block;width:100%;height:clamp(380px,52vw,830px);object-fit:cover;background:#eef2f7}

    /* 可选：轻微底部提亮，提升可读性（需要更贴“纯图”就删掉这段） */
    .pd-hero__bleed::after{
      content:"";position:absolute;left:0;right:0;bottom:0;height:clamp(70px,12vw,130px);
      background:linear-gradient(180deg,rgba(255,255,255,0) 0%,rgba(255,255,255,.92) 100%);
      pointer-events:none;
    }

    /* 3 facts: 叠加在图片里（底部居中） */
    .pd-hero__facts{
      position:absolute;z-index:1;left:50%;transform:translateX(-50%);
      bottom:clamp(18px,3.5vw,92px);
      width:min(1100px,92vw);
      display:grid;grid-template-columns:repeat(3,minmax(0,1fr));
      gap:clamp(1rem,4vw,2rem);
      align-items:start;text-align:center;
    }
    .pd-hero__fact{display:grid;justify-items:center;grid-template-rows:auto auto minmax(60px,auto);row-gap:.5rem;cursor:pointer;padding:1rem;transition:all 0.3s ease}
    .pd-hero__fact-title{font-weight:800;font-size:clamp(2.6rem,2rem + 2.8vw,3.5rem);line-height:1.05;color:#0f172a;font-variant-numeric:tabular-nums;text-shadow:0 2px 4px rgba(0,0,0,0.1),0 4px 8px rgba(0,0,0,0.05);transition:all 0.3s ease;position:relative;z-index:2}
    .pd-hero__fact-title .percent{font-size:0.7em;vertical-align:top;margin-left:2px}
    .pd-hero__fact-rule{display:inline-block;width:clamp(120px,15vw,180px);height:clamp(3px,0.3vw,5px);background:#0f172a;border-radius:2px;opacity:.9;margin:.1rem 0 .2rem 0;transition:all 0.3s ease;position:relative;z-index:2}
    .pd-hero__fact-caption{font-size:clamp(.9rem,.85rem + .25vw,1.05rem);line-height:1.3;color:#111827;opacity:.9;max-width:clamp(140px,18vw,180px);margin:0 auto;text-align:center;transition:all 0.3s ease;position:relative;z-index:2}

    /* Fact交互效果 */
    .pd-hero__fact:hover{transform:translateY(-2px)}
    
    /* 选中状态 - 仅文字变白色 */
    .pd-hero__fact.active .pd-hero__fact-title{color:#ffffff;text-shadow:0 2px 8px rgba(0,0,0,0.5)}
    .pd-hero__fact.active .pd-hero__fact-rule{background:#ffffff;opacity:1}
    .pd-hero__fact.active .pd-hero__fact-caption{color:#ffffff;opacity:1}

    /* Tablet响应式 (768px - 1024px) */
    @media (max-width:1024px) and (min-width:769px){
      .pd-hero__inner{margin-left:clamp(60px,6vw,120px)}
      .One-Column-Shop-All-Button{ right: calc(163px - 1.5rem); }
      .pd-hero__facts{grid-template-columns:repeat(3,1fr);gap:clamp(0.75rem,2vw,1.5rem);bottom:clamp(20px,3vw,60px);width:min(85vw,800px);padding:0 1rem}
      .pd-hero__fact{padding:clamp(0.5rem,1vw,0.75rem)}
      .pd-hero__fact-title{font-size:clamp(1.8rem,1.5rem + 1.5vw,2.4rem)}
      .pd-hero__fact-rule{width:clamp(80px,10vw,120px);height:clamp(2px,0.3vw,3px)}
      .pd-hero__fact-caption{font-size:clamp(.75rem,.7rem + .15vw,.9rem);max-width:clamp(100px,12vw,140px);line-height:1.2}
    }

    /* Phone响应式 (最大768px) */
    @media (max-width:768px){
      .pd-hero{padding:clamp(1.5rem,3vw,2.5rem) 1rem 0;overflow-x:hidden}
      .pd-hero__inner{margin-left:clamp(20px,4vw,60px);margin-right:clamp(20px,4vw,60px);max-width:100%;overflow-x:hidden}
      .pd-hero__header{flex-direction:column;gap:1rem;align-items:flex-start}
      .pd-hero__title{font-size:clamp(1.8rem,1.5rem + 1.5vw,2.4rem);margin-bottom:.75rem;word-wrap:break-word}
      .pd-hero__subtitle{font-size:clamp(.85rem,.8rem + .2vw,.95rem);word-wrap:break-word}
      .One-Column-Shop-All-Button{position:static;margin-top:1rem;align-self:flex-start}
      .pd-hero__bleed{width:100vw;max-width:100vw;overflow:hidden}
      .pd-hero__facts{grid-template-columns:1fr;row-gap:clamp(0.5rem,1.5vw,1rem);bottom:clamp(15px,4vw,28px);width:min(80vw,350px);left:50%;transform:translateX(-50%);padding:0 0.5rem}
      .pd-hero__fact{padding:clamp(0.4rem,1vw,0.6rem);grid-template-rows:auto auto minmax(35px,auto)}
      .pd-hero__fact-title{font-size:clamp(1.4rem,1.2rem + 1vw,1.8rem);margin-bottom:0.2rem}
      .pd-hero__fact-rule{width:clamp(60px,15vw,100px);height:clamp(2px,0.25vw,2.5px);margin:0.1rem 0 0.2rem 0}
      .pd-hero__fact-caption{font-size:clamp(.7rem,.65rem + .1vw,.8rem);max-width:clamp(80px,20vw,120px);line-height:1.1}
    }
  </style>

  <div class="pd-hero__inner">
    <div class="pd-hero__header">
      <div class="pd-hero__text">
        <h1 class="H2-Black"><?php echo esc_html(get_theme_mod('product_detail_hero_eyebrow', __('Eco 12kW AC', 'figma-rebuild'))); ?></h1>
        <p class="Body-1" style="color: #000;">
          <?php echo wp_kses_post(get_theme_mod('product_detail_hero_subtitle', __('Stylish and user-friendly home charging solution', 'figma-rebuild'))); ?>
        </p>
      </div>
      <a class="One-Column-Shop-All-Button" href="<?php echo esc_url(get_theme_mod('product_detail_hero_button_link', '#order')); ?>"><?php echo esc_html(get_theme_mod('product_detail_hero_button_text', __('Order Now', 'figma-rebuild'))); ?></a>
    </div>
  </div>

  <!-- Full-bleed hero image + overlay facts -->
  <figure class="pd-hero__bleed">
    <img
      class="pd-hero__image"
      src="<?php echo esc_url(get_theme_mod('product_detail_hero_bg_image', $template_uri . '/src/images/ev_charging_pic.jpg')); ?>"
      alt="<?php esc_attr_e('Eco 12kW AC — hero image', 'figma-rebuild'); ?>"
      loading="eager"
      decoding="async"
    />

    <ul class="pd-hero__facts" aria-label="<?php esc_attr_e('Key highlights', 'figma-rebuild'); ?>">
      <li class="pd-hero__fact active" data-fact="speed" data-image="speed.jpg">
        <div class="pd-hero__fact-title">20<span class="percent">%</span></div>
        <i class="pd-hero__fact-rule" aria-hidden="true"></i>
        <div class="pd-hero__fact-caption"><?php esc_html_e('faster than chargers on the market', 'figma-rebuild'); ?></div>
      </li>
      <li class="pd-hero__fact" data-fact="time" data-image="time.jpg">
        <div class="pd-hero__fact-title">30</div>
        <i class="pd-hero__fact-rule" aria-hidden="true"></i>
        <div class="pd-hero__fact-caption"><?php esc_html_e('minutes to recharge up to 80%', 'figma-rebuild'); ?></div>
      </li>
      <li class="pd-hero__fact" data-fact="warranty" data-image="warranty.jpg">
        <div class="pd-hero__fact-title">3</div>
        <i class="pd-hero__fact-rule" aria-hidden="true"></i>
        <div class="pd-hero__fact-caption"><?php esc_html_e('years warranty', 'figma-rebuild'); ?></div>
      </li>
    </ul>
  </figure>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const facts = document.querySelectorAll('.pd-hero__fact');
  const heroImage = document.querySelector('.pd-hero__image');
  
  facts.forEach(fact => {
    fact.addEventListener('click', function() {
      // 移除所有active状态
      facts.forEach(f => f.classList.remove('active'));
      
      // 添加active状态到当前点击的fact
      this.classList.add('active');
      
      // 获取对应的图片信息（为将来的图片切换准备）
      const factType = this.dataset.fact;
      const imageSrc = this.dataset.image;
      
      // 这里可以添加图片切换逻辑
      // heroImage.src = '<?php echo esc_url($template_uri . '/src/images/'); ?>' + imageSrc;
      
      // 触发自定义事件，方便将来扩展
      const customEvent = new CustomEvent('factChanged', {
        detail: { factType, imageSrc, element: this }
      });
      document.dispatchEvent(customEvent);
    });
  });
});
</script>
