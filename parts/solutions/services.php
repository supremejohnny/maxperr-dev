<?php
  // 读取默认与自定义
  $defaults = function_exists('figma_rebuild_get_solutions_defaults') ? figma_rebuild_get_solutions_defaults() : [];
  $services_defaults = isset($defaults['services']) ? $defaults['services'] : [];

  $title     = get_theme_mod('solutions_services_title',       $services_defaults['title']        ?? 'What service do I need?');
  $subtitle  = get_theme_mod('solutions_services_description', $services_defaults['description']  ?? "Not sure where to start? We’ve got you.");
  $cta_label = get_theme_mod('solutions_services_cta_label',   'Book Consultation');
  $cta_link  = get_theme_mod('solutions_services_cta_link',    home_url('/contact'));

  $items = function_exists('figma_rebuild_get_repeater_mod')
    ? figma_rebuild_get_repeater_mod('solutions_services_items', $services_defaults['items'] ?? [])
    : [];

  $tiles = array_slice($items, 0, 3);

  // 图片
  if (!function_exists('maxperr_get_item_image_url')) {
    function maxperr_get_item_image_url($item) {
      if (!empty($item['image']['id']))  return wp_get_attachment_image_url($item['image']['id'], 'full');
      if (!empty($item['image_id']))     return wp_get_attachment_image_url($item['image_id'], 'full');
      if (!empty($item['image']['url'])) return esc_url($item['image']['url']);
      if (!empty($item['image_url']))    return esc_url($item['image_url']);
      return 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1600" height="900"><rect width="100%" height="100%" fill="%23ddd"/></svg>';
    }
  }

  if (!function_exists('maxperr_focus_word')) {
    function maxperr_focus_word($item) {
      $tag = strtolower(trim($item['tag_label'] ?? $item['tag'] ?? ''));
      if (strpos($tag, 'home') !== false)       return 'Home';
      if (strpos($tag, 'commercial') !== false) return 'Commercial';
      if (strpos($tag, 'fleet') !== false)      return 'Fleet';
      $t = trim($item['title'] ?? '');
      if ($t) { $first = preg_split('/\s+/', $t)[0] ?? ''; return $first ? ucfirst(strtolower($first)) : 'Service'; }
      return 'Service';
    }
  }
?>
<section id="solutions-services" class="svc-wrap">
  <style>
    /* --- scoped styles: 不依赖 Tailwind --- */
    #solutions-services { padding: 56px 0; }
    #solutions-services .svc-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
    #solutions-services .svc-head{ display:flex; gap:16px; justify-content:space-between; align-items:flex-start; margin-bottom:28px;}
    #solutions-services .svc-title{ font-size:36px; line-height:1.15; font-weight:700; color:#0f172a; letter-spacing:-0.01em; margin:0;}
    #solutions-services .svc-sub{ margin:10px 0 0; font-size:18px; color:#475569; max-width:720px;}
    #solutions-services .svc-cta{ display:inline-flex; align-items:center; justify-content:center; padding:12px 20px; border-radius:9999px; background:#2563eb; color:#fff; text-decoration:none; font-weight:600; white-space:nowrap; }
    #solutions-services .svc-grid{ display:grid; grid-template-columns:1fr; gap:24px; }
    @media (min-width: 768px){ #solutions-services .svc-grid{ grid-template-columns:repeat(3,1fr); gap:32px; } }
    #solutions-services .svc-card{ position:relative; overflow:hidden; border-radius:24px; box-shadow:0 12px 40px rgba(2,6,23,.08); }
    #solutions-services .svc-card img{ display:block; width:100%; height:380px; object-fit:cover; transform:scale(1); transition:transform .5s ease;}
    @media (min-width: 768px){ #solutions-services .svc-card img{ height:420px; } }
    #solutions-services .svc-card:hover img{ transform:scale(1.05); }
    #solutions-services .svc-grad{ position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,.6), rgba(0,0,0,.2), rgba(0,0,0,0)); }
    #solutions-services .svc-txt{ position:absolute; left:24px; top:24px; color:#fff; }
    @media (min-width: 768px){ #solutions-services .svc-txt{ left:32px; top:32px; } }
    #solutions-services .svc-txt .need{ margin:0; font-size:20px; font-weight:600; opacity:.95;}
    #solutions-services .svc-txt .line{ margin:4px 0 0; font-size:30px; font-weight:700; line-height:1.1;}
    @media (min-width: 768px){ #solutions-services .svc-txt .line{ font-size:36px; } }
    #solutions-services .svc-txt .focus{ font-weight:900; margin-right:6px; }
    #solutions-services .svc-link{ position:absolute; inset:0; }
  </style>

  <div class="svc-container">
    <div class="svc-head">
      <div>
        <h2 class="svc-title"><?php echo esc_html($title); ?></h2>
        <?php if (!empty($subtitle)) : ?>
          <p class="svc-sub"><?php echo esc_html($subtitle); ?></p>
        <?php endif; ?>
      </div>
      <?php if (!empty($cta_label) && !empty($cta_link)) : ?>
        <a class="One-Column-Learn-More-Button" href="<?php echo esc_url($cta_link); ?>"><?php echo esc_html($cta_label); ?></a>
      <?php endif; ?>
    </div>

    <?php if (!empty($tiles)) : ?>
      <div class="svc-grid">
        <?php foreach ($tiles as $it): 
          $href  = esc_url($it['link'] ?? $it['url'] ?? '#');
          $img   = maxperr_get_item_image_url($it);
          $focus = maxperr_focus_word($it);
        ?>
          <a href="<?php echo $href; ?>" class="svc-card">
            <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($it['title'] ?? ($focus.' solutions')); ?>">
            <div class="svc-grad" aria-hidden="true"></div>
            <div class="svc-txt">
              <p class="need">I need</p>
              <p class="line"><span class="focus"><?php echo esc_html($focus); ?></span><span>solutions.</span></p>
            </div>
            <span class="svc-link" aria-hidden="true"></span>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
