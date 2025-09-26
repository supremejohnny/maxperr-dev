<?php
/**
 * Product Detail — Simple Hero (inline CSS, facts overlay on image)
 */
$template_uri = get_template_directory_uri();
?>

<section class="pd-hero" id="product-detail-hero">
  <style>
    /* ===== Simple Product Detail Hero (INLINE) ===== */
    .pd-hero{background:#fff;padding:clamp(2rem,4vw,3rem) 1.5rem 0;color:#0f172a;font-family:'Inter',system-ui,-apple-system,'Helvetica Neue',Arial,sans-serif}
    .pd-hero__inner{max-width:1180px;margin:0 auto}
    .pd-hero__header{display:flex;align-items:flex-start;justify-content:space-between;gap:1rem}
    .pd-hero__title{margin:0 0 .5rem 0;font-weight:700;font-size:clamp(2.4rem,1.9rem + 1.9vw,3.6rem);line-height:1.05}
    .pd-hero__subtitle{margin:0;font-size:clamp(.9rem,.85rem + .25vw,1rem);color:#475569}
    .pd-hero__cta{align-self:flex-start;display:inline-flex;padding:.7rem 1.4rem;border-radius:999px;background:#2563eb;color:#fff;font-weight:600;text-decoration:none;box-shadow:0 10px 24px rgba(37,99,235,.22);transition:transform .15s ease,box-shadow .15s ease}
    .pd-hero__cta:hover{transform:translateY(-1px);box-shadow:0 14px 28px rgba(37,99,235,.28)}

    /* Full-bleed hero image */
    .pd-hero__bleed{width:100vw;margin:clamp(1rem,2.5vw,2rem) 0 0 0;position:relative;left:50%;right:50%;transform:translateX(-50%)}
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
      align-items:end;text-align:center;
    }
    .pd-hero__fact{display:grid;justify-items:center;row-gap:.5rem}
    .pd-hero__fact-title{font-weight:800;font-size:clamp(2.2rem,1.6rem + 2.2vw,2.9rem);line-height:1.05;color:#0f172a;font-variant-numeric:tabular-nums}
    .pd-hero__fact-rule{display:inline-block;width:150px;height:3px;background:#0f172a;border-radius:2px;opacity:.9;margin:.1rem 0 .2rem 0}
    .pd-hero__fact-caption{font-size:clamp(.9rem,.85rem + .25vw,1.05rem);line-height:1.3;color:#111827;opacity:.9}

    @media (max-width:768px){
      .pd-hero__header{flex-direction:column;gap:.75rem}
      .pd-hero__cta{order:3}
      .pd-hero__facts{grid-template-columns:1fr;row-gap:.8rem;bottom:clamp(15px,4vw,28px)}
    }
  </style>

  <div class="pd-hero__inner">
    <div class="pd-hero__header">
      <div class="pd-hero__text">
        <h1 class="pd-hero__title"><?php esc_html_e('Eco 12kW AC', 'figma-rebuild'); ?></h1>
        <p class="pd-hero__subtitle">
          <?php esc_html_e('Stylish and user-friendly home charging solution', 'figma-rebuild'); ?>
        </p>
      </div>
      <a class="pd-hero__cta" href="#order"><?php esc_html_e('Order Now', 'figma-rebuild'); ?></a>
    </div>
  </div>

  <!-- Full-bleed hero image + overlay facts -->
  <figure class="pd-hero__bleed">
    <img
      class="pd-hero__image"
      src="<?php echo esc_url($template_uri . '/src/images/ev_charging_pic.jpg'); ?>"
      alt="<?php esc_attr_e('Eco 12kW AC — hero image', 'figma-rebuild'); ?>"
      loading="eager"
      decoding="async"
    />

    <ul class="pd-hero__facts" aria-label="<?php esc_attr_e('Key highlights', 'figma-rebuild'); ?>">
      <li class="pd-hero__fact">
        <div class="pd-hero__fact-title">20%</div>
        <i class="pd-hero__fact-rule" aria-hidden="true"></i>
        <div class="pd-hero__fact-caption"><?php esc_html_e('faster than chargers on the market', 'figma-rebuild'); ?></div>
      </li>
      <li class="pd-hero__fact">
        <div class="pd-hero__fact-title">30</div>
        <i class="pd-hero__fact-rule" aria-hidden="true"></i>
        <div class="pd-hero__fact-caption"><?php esc_html_e('minutes to recharge up to 80%', 'figma-rebuild'); ?></div>
      </li>
      <li class="pd-hero__fact">
        <div class="pd-hero__fact-title">3</div>
        <i class="pd-hero__fact-rule" aria-hidden="true"></i>
        <div class="pd-hero__fact-caption"><?php esc_html_e('years warranty', 'figma-rebuild'); ?></div>
      </li>
    </ul>
  </figure>
</section>
