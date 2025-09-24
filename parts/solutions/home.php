<?php
  if (!function_exists('figma_rebuild_get_solutions_section_data')) {
    return;
  }

  $section = figma_rebuild_get_solutions_section_data('home');
  if (empty($section)) return;

  $section_id = !empty($section['section_id']) ? $section['section_id'] : 'solutions-home';
  $image      = isset($section['image']) ? $section['image'] : '';

  // 收集 features（纯文本数组）
  $features = [];
  if (!empty($section['features']) && is_array($section['features'])) {
    foreach ($section['features'] as $feature) {
      $t = isset($feature['text']) ? trim(wp_strip_all_tags($feature['text'])) : '';
      if ($t !== '') $features[] = $t;
    }
  }

  // 手风琴三项：Overview / Key features / Best for
  $accordion_items = [];
  if (!empty($section['card_body'])) {
    $accordion_items[] = ['title' => __('Overview','figma-rebuild'), 'type' => 'content', 'content' => $section['card_body']];
  }
  if (!empty($features)) {
    $accordion_items[] = ['title' => __('Home Power Bundle','figma-rebuild'), 'type' => 'features', 'content' => $features];
  }
  if (!empty($section['note'])) {
    $accordion_items[] = ['title' => __('Benefits','figma-rebuild'), 'type' => 'note', 'content' => $section['note']];
  }

  $accordion_group_id = function_exists('wp_unique_id')
    ? wp_unique_id($section_id . '-acc-')
    : $section_id . '-acc';

  // 图片兜底
  $image_url = $image
    ? esc_url($image)
    : 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1600" height="1000"><rect width="100%" height="100%" rx="24" ry="24" fill="%23eef3f8"/></svg>';

  $learn_label = 'Learn More';
  $learn_link  = !empty($section['button_link']) ? esc_url($section['button_link']) : '';
?>
<section id="<?php echo esc_attr($section_id); ?>" class="sh-wrap">
  <style>
    /* ===== Scoped、零依赖样式 ===== */
    #<?php echo esc_js($section_id); ?>.sh-wrap{ padding:56px 0; background:#fff; }
    #<?php echo esc_js($section_id); ?> .sh-container{ max-width:1200px; margin:0 auto; padding:0 24px; }

    /* 标题：居中 */
    #<?php echo esc_js($section_id); ?> .sh-head{ text-align:center; margin-bottom:22px; }
    #<?php echo esc_js($section_id); ?> .sh-head h2{
      margin:0 0 10px; font-size:40px; line-height:1.15; font-weight:800; color:#0f172a; letter-spacing:-.02em;
    }
    #<?php echo esc_js($section_id); ?> .sh-head p{
      margin:0 auto; max-width:860px; color:#475569; font-size:18px; line-height:1.65;
    }

    /* 大卡片：图片在右、手风琴在左（与图2一致） */
    #<?php echo esc_js($section_id); ?> .sh-card{
      background:#f8f8f8; /* card 灰底 */
      border:none; border-radius:28px; overflow:hidden;
    }
    #<?php echo esc_js($section_id); ?> .sh-grid{
      display:grid; grid-template-columns:1fr; gap:0;
    }
    @media (min-width: 980px){
      #<?php echo esc_js($section_id); ?> .sh-grid{ grid-template-columns:1.05fr 1fr; }
    }

    /* 左侧：极简信息区 + 手风琴 */
    #<?php echo esc_js($section_id); ?> .sh-left{ padding:28px; }
    @media (min-width: 980px){ #<?php echo esc_js($section_id); ?> .sh-left{ padding:38px; } }

    #<?php echo esc_js($section_id); ?> .sh-badge{
      display:inline-block; padding:6px 10px; border-radius:9999px; background:#eaf2ff;
      color:#2563eb; font-weight:700; font-size:12px; letter-spacing:.18em; text-transform:uppercase;
    }
    #<?php echo esc_js($section_id); ?> .sh-title{
      margin:14px 0 6px; font-size:28px; font-weight:800; color:#0f172a; letter-spacing:-.01em;
    }

    /* 手风琴：行内只有标题 + 右侧箭头；点击箭头才展开；一次只开一个 */
    #<?php echo esc_js($section_id); ?> .sh-acc{ margin-top:16px; }
    #<?php echo esc_js($section_id); ?> .sh-row{ border-top:1px solid #e8edf3; padding:14px 0; }
    #<?php echo esc_js($section_id); ?> .sh-row-inner{ display:flex; align-items:center; justify-content:space-between; gap:12px; }
    #<?php echo esc_js($section_id); ?> .sh-row-title{ font-size:22px; font-weight:700; color:#0f172a; }
    #<?php echo esc_js($section_id); ?> .sh-toggle{
      display:inline-flex; align-items:center; justify-content:center;
      width:36px; height:36px; cursor:pointer;
    }
    #<?php echo esc_js($section_id); ?> .sh-toggle svg{ width:18px; height:18px; transition: transform .18s ease; color:#1e3a8a; }
    #<?php echo esc_js($section_id); ?> .sh-toggle[aria-expanded="true"] svg{ transform: rotate(180deg); }

    #<?php echo esc_js($section_id); ?> .sh-panel{ padding:10px 0 18px; display:none; }
    #<?php echo esc_js($section_id); ?> .sh-panel.open{ display:block; }
    #<?php echo esc_js($section_id); ?> .sh-panel p{ color:#334155; line-height:1.7; margin:0 0 14px; }

    #<?php echo esc_js($section_id); ?> .sh-learn{
      display:inline-flex; align-items:center; justify-content:center; padding:2px 30px; border-radius:12px;
      border:2px solid #0f172a; color:#0f172a; text-decoration:none; font-weight:700; background:#fff;
    }

    /* 右侧：嵌入式图片（同一张卡片内） */
    #<?php echo esc_js($section_id); ?> .sh-right{ background:#f8f8f8; }
    #<?php echo esc_js($section_id); ?> .sh-figure{ width:100%; height:380px; }
    @media (min-width:980px){ #<?php echo esc_js($section_id); ?> .sh-figure{ height:100%; min-height:520px; } }
    #<?php echo esc_js($section_id); ?> .sh-figure img{ width:100%; height:100%; object-fit:cover; display:block; }
  </style>

  <div class="sh-container">
    <div class="sh-head">
      <?php if (!empty($section['heading'])): ?>
        <h2><?php echo esc_html($section['heading']); ?></h2>
      <?php endif; ?>
      <?php if (!empty($section['intro'])): ?>
        <p><?php echo wp_kses_post($section['intro']); ?></p>
      <?php endif; ?>
    </div>

    <div class="sh-card">
      <div class="sh-grid">
        <!-- 左侧：标题 + 极简手风琴 -->
        <div class="sh-left">

          <?php if (!empty($accordion_items)): ?>
            <div class="sh-acc" id="<?php echo esc_attr($accordion_group_id); ?>">
              <?php foreach ($accordion_items as $idx => $item):
                $is_open   = ($idx === 0); // 只默认展开第一项
                $panel_id  = $accordion_group_id . '-panel-' . $idx;
                $button_id = $accordion_group_id . '-btn-'   . $idx;
              ?>
                <div class="sh-row" data-acc-item>
                  <div class="sh-row-inner">
                    <div class="sh-row-title"><?php echo esc_html($item['title']); ?></div>
                    <button
                      type="button"
                      class="sh-toggle"
                      id="<?php echo esc_attr($button_id); ?>"
                      aria-controls="<?php echo esc_attr($panel_id); ?>"
                      aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>"
                      data-acc-trigger
                      aria-label="Toggle <?php echo esc_attr($item['title']); ?>"
                    >
                      <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M5 7.5 10 12.5 15 7.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                    </button>
                  </div>

                  <div
                    id="<?php echo esc_attr($panel_id); ?>"
                    class="sh-panel<?php echo $is_open ? ' open' : ''; ?>"
                    data-acc-panel
                    aria-labelledby="<?php echo esc_attr($button_id); ?>"
                    <?php echo $is_open ? '' : 'hidden'; ?>
                  >
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
                      <a class="sh-learn" href="<?php echo $learn_link; ?>"><?php echo esc_html($learn_label); ?></a>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>

        <!-- 右侧：图片（嵌在同一张卡片里） -->
        <div class="sh-right">
          <div class="sh-figure">
            <img src="<?php echo esc_url($image_url); ?>" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 单开手风琴：只允许一个 panel 打开；点击“箭头”触发 -->
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

        // 初始同步
        if (btn.getAttribute('aria-expanded') === 'true') {
          panel.classList.add('open'); panel.removeAttribute('hidden');
        }

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
