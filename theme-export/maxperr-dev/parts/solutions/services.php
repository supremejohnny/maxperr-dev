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
    #solutions-services { padding: 3.5rem 0; margin: 0 7rem; }
    #solutions-services .svc-container { max-width: 100%; margin: 0 auto; padding: 0; }
    #solutions-services .svc-head{ display:flex; gap:16px; justify-content:space-between; align-items:flex-start; margin-bottom:28px;}
    #solutions-services .svc-title{ margin:0;}
    #solutions-services .svc-sub{ margin:10px 0 0; max-width:720px;}
    #solutions-services .svc-cta{ display:inline-flex; align-items:center; justify-content:center; padding:12px 20px; border-radius:9999px; background:#2563eb; color:#fff; text-decoration:none; font-weight:600; white-space:nowrap; }
    #solutions-services .svc-grid{ display:grid; grid-template-columns:1fr; gap:28px; justify-content:center; }
    @media (min-width: 768px){ 
      #solutions-services .svc-grid{ 
        grid-template-columns: repeat(3, 1fr); 
        gap: 28px; 
        justify-content: center; 
        justify-items: center;
        max-width: 1500px;
        margin: 0 auto;
      } 
    }
    
    @media (min-width: 1200px) {
      #solutions-services .svc-card {
        max-width: 483px;
      }
    }
    #solutions-services .svc-card{ position:relative; overflow:hidden; border-radius:24px; box-shadow:0 12px 40px rgba(2,6,23,.08); width: 100%; max-width: 483px; height: auto; aspect-ratio: 483/509; }
    #solutions-services .svc-card img{ display:block; width:100%; height:100%; object-fit:cover; object-position: top center; transform:scale(1); transition:transform .5s ease;}
    #solutions-services .svc-card:hover img{ transform:scale(1.05); }
    #solutions-services .svc-link{ position:absolute; inset:0; z-index:2; }
    #solutions-services .svc-overlay{ position:absolute; top:0; left:0; right:0; padding:2rem 1.5rem; background:linear-gradient(180deg, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.4) 40%, transparent 100%); opacity:0; transition:opacity 0.3s ease; pointer-events:none; z-index:1; }
    #solutions-services .svc-overlay-title{ color:#fff; font-size:1.5rem; font-weight:700; margin:0; text-shadow:0 2px 12px rgba(0,0,0,0.5); line-height:1.3; }
    
    /* 响应式设计 */
    @media (max-width: 1200px) {
      #solutions-services { margin: 0 5rem; }
    }
    
    @media (max-width: 1024px) {
      #solutions-services { margin: 0 3rem; }
    }
    
    @media (max-width: 768px) {
      #solutions-services { margin: 0 1.5rem; padding: 2rem 0; }
      #solutions-services .svc-head { flex-direction: column; gap: 1rem; align-items: flex-start; }
      #solutions-services .svc-sub { max-width: 100%; }
      #solutions-services .svc-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 0.75rem;
      }
      #solutions-services .svc-card {
        max-width: 100%;
        aspect-ratio: 1/1;
      }
      #solutions-services .svc-overlay {
        opacity: 1;
        padding: 1rem 0.75rem;
      }
      #solutions-services .svc-overlay-title {
        font-size: 0.75rem;
        line-height: 1.2;
      }
    }
    
    @media (max-width: 480px) {
      #solutions-services { margin: 0 1rem; }
      #solutions-services .svc-grid {
        gap: 0.5rem;
      }
      #solutions-services .svc-card {
        aspect-ratio: 1/0.95;
      }
      #solutions-services .svc-overlay {
        padding: 0.75rem 0.5rem;
      }
      #solutions-services .svc-overlay-title {
        font-size: 0.625rem;
      }
    }
  </style>

  <div class="svc-container">
    <div class="svc-head">
      <div>
        <h2 class="svc-title H2-Black"><?php echo esc_html($title); ?></h2>
        <?php if (!empty($subtitle)) : ?>
          <p class="svc-sub Body-1"><?php echo esc_html($subtitle); ?></p>
        <?php endif; ?>
      </div>
      <?php if (!empty($cta_label) && !empty($cta_link)) : ?>
        <a class="One-Column-Learn-More-Button" href="<?php echo esc_url($cta_link); ?>"><?php echo esc_html($cta_label); ?></a>
      <?php endif; ?>
    </div>

    <div class="svc-grid">
      <!-- Left Card -->
      <a href="<?php echo home_url('/solutions/home'); ?>" class="svc-card">
        <img src="<?php echo get_template_directory_uri(); ?>/src/images/solution-Left-Card.png" alt="Home solutions">
        <div class="svc-overlay">
          <h3 class="svc-overlay-title">I need<br>Home solutions.</h3>
        </div>
        <span class="svc-link" aria-hidden="true"></span>
      </a>

      <!-- Centre Card -->
      <a href="<?php echo home_url('/solutions/commercial'); ?>" class="svc-card">
        <img src="<?php echo get_template_directory_uri(); ?>/src/images/solution-Centre-Card.png" alt="Commercial solutions">
        <div class="svc-overlay">
          <h3 class="svc-overlay-title">I need<br>Commercial solutions.</h3>
        </div>
        <span class="svc-link" aria-hidden="true"></span>
      </a>

      <!-- Right Card -->
      <a href="<?php echo home_url('/solutions/fleet'); ?>" class="svc-card">
        <img src="<?php echo get_template_directory_uri(); ?>/src/images/solution-Right-Card-Image.png" alt="Fleet solutions">
        <div class="svc-overlay">
          <h3 class="svc-overlay-title">I need<br>Fleet solutions.</h3>
        </div>
        <span class="svc-link" aria-hidden="true"></span>
      </a>
    </div>
  </div>
</section>
