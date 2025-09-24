<?php
  if (!function_exists('figma_rebuild_get_solutions_section_data')) return;

  $section = figma_rebuild_get_solutions_section_data('commercial');
  if (empty($section)) return;

  $section_id = !empty($section['section_id']) ? $section['section_id'] : 'solutions-commercial';
  $image      = isset($section['image']) ? $section['image'] : '';

  // 收集 features
  $features = [];
  if (!empty($section['features']) && is_array($section['features'])) {
    foreach ($section['features'] as $feature) {
      $t = isset($feature['text']) ? trim(wp_strip_all_tags($feature['text'])) : '';
      if ($t !== '') $features[] = $t;
    }
  }

  // 手风琴三项（改标题）
  $accordion_items = [];
  if (!empty($section['card_body'])) {
    $accordion_items[] = ['title' => __('Smart 30kW DC EV Charger','figma-rebuild'), 'type' => 'content', 'content' => $section['card_body']];
  }
  if (!empty($features)) {
    $accordion_items[] = ['title' => __('Partnership Program','figma-rebuild'), 'type' => 'features', 'content' => $features];
  }
  if (!empty($section['note'])) {
    $accordion_items[] = ['title' => __('Why Partner with Us?','figma-rebuild'), 'type' => 'note', 'content' => $section['note']];
  }

  $accordion_group_id = function_exists('wp_unique_id') ? wp_unique_id($section_id . '-acc-') : $section_id . '-acc';
  $image_url = $image ? esc_url($image) : 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1600" height="1000"><rect width="100%" height="100%" rx="24" ry="24" fill="%23eef3f8"/></svg>';

  $learn_label = $section['button_text'] ?? 'Learn More';
  $learn_link  = !empty($section['button_link']) ? esc_url($section['button_link']) : '';
?>
<section id="<?php echo esc_attr($section_id); ?>" class="sc-wrap">
  <style>
    #<?php echo esc_js($section_id); ?>.sc-wrap{ padding:56px 0; background:#fff; }
    #<?php echo esc_js($section_id); ?> .sc-container{ max-width:1200px; margin:0 auto; padding:0 24px; }

    #<?php echo esc_js($section_id); ?> .sc-head{ text-align:center; margin-bottom:22px; }
    #<?php echo esc_js($section_id); ?> .sc-head h2{ margin:0 0 10px; font-size:40px; line-height:1.15; font-weight:800; color:#0f172a; letter-spacing:-.02em; }
    #<?php echo esc_js($section_id); ?> .sc-head p{ margin:0 auto; max-width:860px; color:#475569; font-size:18px; line-height:1.65; }

    #<?php echo esc_js($section_id); ?> .sc-card{ background:#f8f8f8; border:none; border-radius:28px; overflow:hidden; }
    #<?php echo esc_js($section_id); ?> .sc-grid{ display:grid; grid-template-columns:1fr; gap:0; }
    @media (min-width:980px){ #<?php echo esc_js($section_id); ?> .sc-grid{ grid-template-columns:1fr 1fr; } }

    #<?php echo esc_js($section_id); ?> .sc-left{ padding:28px; }
    @media (min-width:980px){ #<?php echo esc_js($section_id); ?> .sc-left{ padding:38px; } }

    #<?php echo esc_js($section_id); ?> .sc-row{ border-top:1px solid #e8edf3; padding:14px 0; }
    #<?php echo esc_js($section_id); ?> .sc-row-inner{ display:flex; align-items:center; justify-content:space-between; gap:12px; }
    #<?php echo esc_js($section_id); ?> .sc-row-title{ font-size:22px; font-weight:700; color:#0f172a; }
    #<?php echo esc_js($section_id); ?> .sc-toggle{ display:inline-flex; align-items:center; justify-content:center; width:36px; height:36px; cursor:pointer; }
    #<?php echo esc_js($section_id); ?> .sc-toggle svg{ width:18px; height:18px; transition: transform .18s ease; color:#1e3a8a; }
    #<?php echo esc_js($section_id); ?> .sc-toggle[aria-expanded="true"] svg{ transform: rotate(180deg); }

    #<?php echo esc_js($section_id); ?> .sc-panel{ padding:10px 0 18px; display:none; }
    #<?php echo esc_js($section_id); ?> .sc-panel.open{ display:block; }
    #<?php echo esc_js($section_id); ?> .sc-panel p{ color:#334155; line-height:1.7; margin:0 0 14px; }

    #<?php echo esc_js($section_id); ?> .sc-learn{ display:inline-flex; align-items:center; justify-content:center; padding:2px 30px; border-radius:12px; border:2px solid #0f172a; color:#0f172a; text-decoration:none; font-weight:700; background:#fff; }

    #<?php echo esc_js($section_id); ?> .sc-right{ background:#f8f8f8; }
    #<?php echo esc_js($section_id); ?> .sc-figure{ width:100%; height:380px; }
    @media (min-width:980px){ #<?php echo esc_js($section_id); ?> .sc-figure{ height:100%; min-height:520px; } }
    #<?php echo esc_js($section_id); ?> .sc-figure img{ width:100%; height:100%; object-fit:cover; display:block; }

    /* Host with Us 表单 */
    #<?php echo esc_js($section_id); ?> .sc-form-note{ font-size:12px; color:#6b7280; margin:0 0 10px; }
    #<?php echo esc_js($section_id); ?> .sc-sr{ position:absolute; left:-9999px; width:1px; height:1px; overflow:hidden; }
    #<?php echo esc_js($section_id); ?> .sc-form{ display:grid; gap:12px; }
    #<?php echo esc_js($section_id); ?> .sc-form-row2{ display:grid; grid-template-columns:1fr; gap:12px; }
    @media (min-width:640px){ #<?php echo esc_js($section_id); ?> .sc-form-row2{ grid-template-columns:1fr 1fr; } }
    #<?php echo esc_js($section_id); ?> .sc-input, 
    #<?php echo esc_js($section_id); ?> .sc-textarea{
      width:100%; padding:12px 14px; border:1px solid #dbe3ec; border-radius:10px; background:#fff; font-size:14px; color:#0f172a;
    }
    #<?php echo esc_js($section_id); ?> .sc-input:focus, 
    #<?php echo esc_js($section_id); ?> .sc-textarea:focus{ outline:none; border-color:#2563eb; box-shadow:0 0 0 3px rgba(37,99,235,.15); }
    #<?php echo esc_js($section_id); ?> .sc-textarea{ min-height:84px; resize:vertical; }
    #<?php echo esc_js($section_id); ?> .sc-submit{
      display:inline-flex; align-items:center; justify-content:center; padding:10px 18px; border-radius:12px; background:#2563eb; color:#fff; font-weight:700; border:none; cursor:pointer;
      box-shadow:0 12px 24px rgba(37,99,235,.25); width: 20%;
    }
  </style>

  <div class="sc-container">
    <div class="sc-head">
      <?php if (!empty($section['heading'])): ?>
        <h2><?php echo esc_html($section['heading']); ?></h2>
      <?php endif; ?>
      <?php if (!empty($section['intro'])): ?>
        <p><?php echo wp_kses_post($section['intro']); ?></p>
      <?php endif; ?>
    </div>

    <div class="sc-card">
      <div class="sc-grid">
        <div class="sc-left">
          <?php if (!empty($accordion_items)): ?>
            <div class="sc-acc" id="<?php echo esc_attr($accordion_group_id); ?>">
              <?php foreach ($accordion_items as $idx => $item):
                $is_open   = ($idx === 0);
                $panel_id  = $accordion_group_id . '-panel-' . $idx;
                $button_id = $accordion_group_id . '-btn-'   . $idx;
              ?>
                <div class="sc-row" data-acc-item>
                  <div class="sc-row-inner">
                    <div class="sc-row-title"><?php echo esc_html($item['title']); ?></div>
                    <button type="button" class="sc-toggle" id="<?php echo esc_attr($button_id); ?>" aria-controls="<?php echo esc_attr($panel_id); ?>" aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>" data-acc-trigger aria-label="Toggle <?php echo esc_attr($item['title']); ?>">
                      <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M5 7.5 10 12.5 15 7.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                    </button>
                  </div>

                  <div id="<?php echo esc_attr($panel_id); ?>" class="sc-panel<?php echo $is_open ? ' open' : ''; ?>" data-acc-panel aria-labelledby="<?php echo esc_attr($button_id); ?>" <?php echo $is_open ? '' : 'hidden'; ?>>
                    <?php if ('features' === $item['type']): ?>
                      <ul style="list-style:disc; padding-left:20px; margin:0 0 14px; color:#334155;">
                        <?php foreach ($item['content'] as $f): ?>
                          <li><?php echo esc_html($f); ?></li>
                        <?php endforeach; ?>
                      </ul>
                    <?php else: ?>
                      <p><?php echo wp_kses_post($item['content']); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($learn_link)): ?>
                      <a class="sc-learn" href="<?php echo $learn_link; ?>"><?php echo esc_html($learn_label); ?></a>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endforeach; ?>

              <!-- 新增：Host with Us 表单 -->
              <?php 
                $form_index  = count($accordion_items);
                $form_panel  = $accordion_group_id . '-panel-' . $form_index;
                $form_button = $accordion_group_id . '-btn-'   . $form_index;
              ?>
              <div class="sc-row" data-acc-item>
                <div class="sc-row-inner">
                  <div class="sc-row-title"><?php echo esc_html__('Host with Us', 'figma-rebuild'); ?></div>
                  <button type="button" class="sc-toggle" id="<?php echo esc_attr($form_button); ?>" aria-controls="<?php echo esc_attr($form_panel); ?>" aria-expanded="false" data-acc-trigger aria-label="Toggle Host with Us">
                    <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                      <path d="M5 7.5 10 12.5 15 7.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </button>
                </div>

                <div id="<?php echo esc_attr($form_panel); ?>" class="sc-panel" data-acc-panel aria-labelledby="<?php echo esc_attr($form_button); ?>" hidden>
                  <p class="sc-form-note"><?php echo esc_html__('Leave your info with us and our team will reach out with more cost estimation details.', 'figma-rebuild'); ?></p>

                  <form class="sc-form" action="" method="post" novalidate>
                    <?php if (function_exists('wp_nonce_field')) wp_nonce_field('sc_host_with_us', 'sc_host_nonce'); ?>

                    <div class="sc-form-row2">
                      <label class="sc-sr" for="<?php echo esc_attr($section_id); ?>-first">First Name</label>
                      <input class="sc-input" type="text" id="<?php echo esc_attr($section_id); ?>-first" name="first_name" placeholder="<?php echo esc_attr__('First Name','figma-rebuild'); ?>">

                      <label class="sc-sr" for="<?php echo esc_attr($section_id); ?>-last">Last Name</label>
                      <input class="sc-input" type="text" id="<?php echo esc_attr($section_id); ?>-last" name="last_name" placeholder="<?php echo esc_attr__('Last Name','figma-rebuild'); ?>">
                    </div>

                    <label class="sc-sr" for="<?php echo esc_attr($section_id); ?>-email">Email</label>
                    <input class="sc-input" type="email" id="<?php echo esc_attr($section_id); ?>-email" name="email" placeholder="<?php echo esc_attr__('Email','figma-rebuild'); ?>">

                    <div class="sc-form-row2">
                      <label class="sc-sr" for="<?php echo esc_attr($section_id); ?>-province">Province</label>
                      <input class="sc-input" type="text" id="<?php echo esc_attr($section_id); ?>-province" name="province" placeholder="<?php echo esc_attr__('Province','figma-rebuild'); ?>">

                      <label class="sc-sr" for="<?php echo esc_attr($section_id); ?>-postal">Postal Code</label>
                      <input class="sc-input" type="text" id="<?php echo esc_attr($section_id); ?>-postal" name="postal_code" placeholder="<?php echo esc_attr__('Postal Code','figma-rebuild'); ?>">
                    </div>

                    <label class="sc-sr" for="<?php echo esc_attr($section_id); ?>-msg">Message</label>
                    <textarea class="sc-textarea" id="<?php echo esc_attr($section_id); ?>-msg" name="message" placeholder="<?php echo esc_attr__('Tell us something about your business!','figma-rebuild'); ?>"></textarea>

                    <button class="sc-submit" type="submit"><?php echo esc_html__('Submit','figma-rebuild'); ?></button>
                  </form>
                </div>
              </div>
              <!-- /Host with Us -->
            </div>
          <?php endif; ?>
        </div>

        <div class="sc-right">
          <div class="sc-figure">
            <img src="<?php echo $image_url; ?>" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    (function(){
      var root = document.getElementById('<?php echo esc_js($accordion_group_id); ?>');
      if (!root) return;
      var items = Array.prototype.slice.call(root.querySelectorAll('[data-acc-item]'));
      function closeAll(exceptBtn){
        items.forEach(function(item){
          var btn = item.querySelector('[data-acc-trigger]');
          var panel = item.querySelector('[data-acc-panel]');
          if (!btn || !panel) return;
          if (btn === exceptBtn) return;
          btn.setAttribute('aria-expanded','false');
          panel.classList.remove('open');
          panel.setAttribute('hidden','');
        });
      }
      items.forEach(function(item){
        var btn   = item.querySelector('[data-acc-trigger]');
        var panel = item.querySelector('[data-acc-panel]');
        if (!btn || !panel) return;
        if (btn.getAttribute('aria-expanded') === 'true') { panel.classList.add('open'); panel.removeAttribute('hidden'); }
        btn.addEventListener('click', function(e){
          e.preventDefault();
          var isOpen = btn.getAttribute('aria-expanded') === 'true';
          if (!isOpen) closeAll(btn);
          btn.setAttribute('aria-expanded', String(!isOpen));
          if (isOpen) { panel.classList.remove('open'); panel.setAttribute('hidden',''); }
          else { panel.classList.add('open'); panel.removeAttribute('hidden'); }
        });
      });
    })();
  </script>
</section>
