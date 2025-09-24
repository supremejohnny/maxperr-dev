<?php
/**
 * Collaboration Models Section
 */

$collaboration_models = [
  [
    'title' => 'Authorized Installer',
    'description' => 'The Authorized Installer Program is tailored for licensed electricians and installation companies eager to tap into the growing EV charging market. By becoming an authorized installer, you position yourself as a trusted expert for Maxperr Energy\'s cutting-edge products.',
    'features' => [
      'Access to exclusive training programs',
      'Technical support and certification',
      'Competitive pricing and terms',
      'Marketing support and materials'
    ],
    'note' => 'Ideal for licensed electricians and installation companies looking to expand their service offerings.'
  ],
  [
    'title' => 'Distributor Partnership',
    'description' => 'Join our network of authorized distributors to bring Maxperr Energy\'s innovative EV charging solutions to your market. Benefit from our comprehensive support system and proven business model.',
    'features' => [
      'Exclusive territory rights',
      'Comprehensive product training',
      'Marketing and sales support',
      'Inventory management assistance'
    ],
    'note' => 'Perfect for established electrical distributors seeking to add EV charging to their portfolio.'
  ],
  [
    'title' => 'Referral Program',
    'description' => 'Earn rewards by referring qualified leads to Maxperr Energy. Our referral program offers competitive commissions for successful partnerships and installations.',
    'features' => [
      'Competitive commission structure',
      'Easy lead submission process',
      'Regular performance tracking',
      'Flexible payment terms'
    ],
    'note' => 'Great for industry professionals who want to monetize their network without full commitment.'
  ],
  [
    'title' => 'Custom Solutions',
    'description' => 'Work with our team to develop tailored partnership solutions that meet your specific business needs and market requirements.',
    'features' => [
      'Customized partnership terms',
      'Dedicated account management',
      'Flexible program structure',
      'Ongoing strategic support'
    ],
    'note' => 'Designed for large organizations or unique market situations requiring specialized approaches.'
  ]
];

$section_id = 'collaboration-models';
$accordion_group_id = wp_unique_id($section_id . '-acc-');
?>

<section id="<?php echo esc_attr($section_id); ?>" class="cm-wrap">
  <style>
    /* ===== Scoped、零依赖样式 ===== */
    #<?php echo esc_js($section_id); ?>.cm-wrap{ padding:56px 0; background:#fff; }
    #<?php echo esc_js($section_id); ?> .cm-container{ max-width:1200px; margin:0 auto; padding:0 24px; }

    /* 标题：居中 */
    #<?php echo esc_js($section_id); ?> .cm-head{ text-align:center; margin-bottom:22px; }
    #<?php echo esc_js($section_id); ?> .cm-head h2{
      margin:0 0 10px; font-size:40px; line-height:1.15; font-weight:800; color:#0f172a; letter-spacing:-.02em;
    }
    #<?php echo esc_js($section_id); ?> .cm-head p{
      margin:0 auto; max-width:860px; color:#475569; font-size:18px; line-height:1.65;
    }

    /* 大卡片：图片在右、手风琴在左 */
    #<?php echo esc_js($section_id); ?> .cm-card{
      background:#f8f8f8;
      border:none; border-radius:28px; overflow:hidden;
    }
    #<?php echo esc_js($section_id); ?> .cm-grid{
      display:grid; grid-template-columns:1fr; gap:0;
    }
    @media (min-width: 980px){
      #<?php echo esc_js($section_id); ?> .cm-grid{ grid-template-columns:1.05fr 1fr; }
    }

    /* 左侧：极简信息区 + 手风琴 */
    #<?php echo esc_js($section_id); ?> .cm-left{ padding:28px; }
    @media (min-width: 980px){ #<?php echo esc_js($section_id); ?> .cm-left{ padding:38px; } }

    #<?php echo esc_js($section_id); ?> .cm-badge{
      display:inline-block; padding:6px 10px; border-radius:9999px; background:#eaf2ff;
      color:#2563eb; font-weight:700; font-size:12px; letter-spacing:.18em; text-transform:uppercase;
    }
    #<?php echo esc_js($section_id); ?> .cm-title{
      margin:14px 0 6px; font-size:28px; font-weight:800; color:#0f172a; letter-spacing:-.01em;
    }

    /* 手风琴：行内只有标题 + 右侧箭头；点击箭头才展开；一次只开一个 */
    #<?php echo esc_js($section_id); ?> .cm-acc{ margin-top:16px; }
    #<?php echo esc_js($section_id); ?> .cm-row{ border-top:1px solid #e8edf3; padding:14px 0; }
    #<?php echo esc_js($section_id); ?> .cm-row-inner{ display:flex; align-items:center; justify-content:space-between; gap:12px; }
    #<?php echo esc_js($section_id); ?> .cm-row-title{ font-size:22px; font-weight:700; color:#0f172a; }
    #<?php echo esc_js($section_id); ?> .cm-toggle{
      display:inline-flex; align-items:center; justify-content:center;
      width:36px; height:36px; cursor:pointer;
    }
    #<?php echo esc_js($section_id); ?> .cm-toggle svg{ width:18px; height:18px; transition: transform .18s ease; color:#1e3a8a; }
    #<?php echo esc_js($section_id); ?> .cm-toggle[aria-expanded="true"] svg{ transform: rotate(180deg); }

    #<?php echo esc_js($section_id); ?> .cm-panel{ padding:10px 0 18px; display:none; }
    #<?php echo esc_js($section_id); ?> .cm-panel.open{ display:block; }
    #<?php echo esc_js($section_id); ?> .cm-panel p{ color:#334155; line-height:1.7; margin:0 0 14px; }

    #<?php echo esc_js($section_id); ?> .cm-learn{
      display:inline-flex; align-items:center; justify-content:center; padding:2px 30px; border-radius:12px;
      border:2px solid #0f172a; color:#0f172a; text-decoration:none; font-weight:700; background:#fff;
    }

    /* 右侧：嵌入式图片（同一张卡片内） */
    #<?php echo esc_js($section_id); ?> .cm-right{ background:#f8f8f8; }
    #<?php echo esc_js($section_id); ?> .cm-figure{ width:100%; height:380px; }
    @media (min-width:980px){ #<?php echo esc_js($section_id); ?> .cm-figure{ height:100%; min-height:520px; } }
    #<?php echo esc_js($section_id); ?> .cm-figure img{ width:100%; height:100%; object-fit:cover; display:block; }
  </style>

  <div class="cm-container">
    <div class="cm-head">
      <h2>Collaboration Models</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>

    <div class="cm-card">
      <div class="cm-grid">
        <!-- 左侧：标题 + 极简手风琴 -->
        <div class="cm-left">
          <div class="cm-acc" id="<?php echo esc_attr($accordion_group_id); ?>">
            <?php foreach ($collaboration_models as $idx => $model):
              $is_open   = ($idx === 0); // 只默认展开第一项
              $panel_id  = $accordion_group_id . '-panel-' . $idx;
              $button_id = $accordion_group_id . '-btn-'   . $idx;
            ?>
              <div class="cm-row" data-acc-item>
                <div class="cm-row-inner">
                  <div class="cm-row-title"><?php echo esc_html($model['title']); ?></div>
                  <button
                    type="button"
                    class="cm-toggle"
                    id="<?php echo esc_attr($button_id); ?>"
                    aria-controls="<?php echo esc_attr($panel_id); ?>"
                    aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>"
                    data-acc-trigger
                    aria-label="Toggle <?php echo esc_attr($model['title']); ?>"
                  >
                    <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                      <path d="M5 7.5 10 12.5 15 7.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </button>
                </div>

                <div
                  id="<?php echo esc_attr($panel_id); ?>"
                  class="cm-panel<?php echo $is_open ? ' open' : ''; ?>"
                  data-acc-panel
                  aria-labelledby="<?php echo esc_attr($button_id); ?>"
                  <?php echo $is_open ? '' : 'hidden'; ?>
                >
                  <p><?php echo wp_kses_post($model['description']); ?></p>
                  
                  <?php if (!empty($model['features'])): ?>
                    <ul style="list-style:disc; padding-left:20px; margin:0 0 14px; color:#334155;">
                      <?php foreach ($model['features'] as $feature): ?>
                        <li><?php echo esc_html($feature); ?></li>
                      <?php endforeach; ?>
                    </ul>
                  <?php endif; ?>
                  
                  <?php if (!empty($model['note'])): ?>
                    <p style="font-style: italic; color: #64748b;"><?php echo esc_html($model['note']); ?></p>
                  <?php endif; ?>

                  <a class="cm-learn" href="#become-partner">Learn More</a>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- 右侧：图片（嵌在同一张卡片里） -->
        <div class="cm-right">
          <div class="cm-figure">
            <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=900&q=80" alt="Professional working on electrical equipment">
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 单开手风琴：只允许一个 panel 打开；点击"箭头"触发 -->
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
