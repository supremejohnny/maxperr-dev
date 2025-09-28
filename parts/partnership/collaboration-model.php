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

$learn_label = 'Learn More';
$learn_link  = '#become-partner';
?>

<section id="<?php echo esc_attr($section_id); ?>" class="cm-wrap">
  <style>
    /* ===== Scoped、零依赖样式 ===== */
    #<?php echo esc_js($section_id); ?>.cm-wrap{ padding:3.5rem 0; background:#fff; }
    #<?php echo esc_js($section_id); ?> .cm-container{ max-width:87.1875rem; margin:0 auto; padding:0 1.5rem; }

    /* 标题：居中 */
    #<?php echo esc_js($section_id); ?> .cm-head{ text-align:center; margin-bottom:1.375rem; }
    #<?php echo esc_js($section_id); ?> .cm-head h2{
      margin:0 0 0.625rem; font-size:2.5rem; line-height:1.15; font-weight:800; color:#0f172a; letter-spacing:-.02em;
    }
    #<?php echo esc_js($section_id); ?> .cm-head p{
      margin:0 auto; max-width:53.75rem; color:#475569; font-size:1.125rem; line-height:1.65;
    }

    /* 大卡片：图片在右、手风琴在左（与solution一致） */
    #<?php echo esc_js($section_id); ?> .cm-card{
      background:#f8f8f8; /* card 灰底 */
      border:none; border-radius:1.75rem; overflow:hidden;
      max-width:87.1875rem; margin:0 auto;
    }
    #<?php echo esc_js($section_id); ?> .cm-grid{
      display:grid; grid-template-columns:1fr; gap:0;
    }
    @media (min-width: 61.25rem){
      #<?php echo esc_js($section_id); ?> .cm-grid{ grid-template-columns:1fr 1fr; }
    }

    /* 左侧：极简信息区 + 手风琴 */
    #<?php echo esc_js($section_id); ?> .cm-left{ padding:1.75rem; }
    @media (min-width: 61.25rem){ #<?php echo esc_js($section_id); ?> .cm-left{ padding:2.375rem; } }

    #<?php echo esc_js($section_id); ?> .cm-badge{
      display:inline-block; padding:0.375rem 0.625rem; border-radius:9999px; background:#eaf2ff;
      color:#2563eb; font-weight:700; font-size:0.75rem; letter-spacing:.18em; text-transform:uppercase;
    }
    #<?php echo esc_js($section_id); ?> .cm-title{
      margin:0.875rem 0 0.375rem; font-size:1.75rem; font-weight:800; color:#0f172a; letter-spacing:-.01em;
    }

    /* 手风琴：行内只有标题 + 右侧箭头；点击箭头才展开；一次只开一个 */
    #<?php echo esc_js($section_id); ?> .cm-acc{ margin-top:1rem; }
    #<?php echo esc_js($section_id); ?> .cm-row{ padding:0.875rem 0; }
    #<?php echo esc_js($section_id); ?> .cm-row:not(:first-child){ border-top:1px solid #ADADAD; }
    #<?php echo esc_js($section_id); ?> .cm-row-inner{ display:flex; align-items:center; justify-content:space-between; gap:0.75rem; }
    #<?php echo esc_js($section_id); ?> .cm-row-title{ font-size:1.375rem; font-weight:700; color:#0f172a; }
    #<?php echo esc_js($section_id); ?> .cm-toggle{
      display:inline-flex; align-items:center; justify-content:center;
      width:2.25rem; height:2.25rem; cursor:pointer;
    }
    #<?php echo esc_js($section_id); ?> .cm-toggle svg{ width:1.875rem; height:1.875rem; transition: transform .18s ease; color:#727272; }
    #<?php echo esc_js($section_id); ?> .cm-toggle[aria-expanded="true"] svg{ transform: rotate(180deg); }

    #<?php echo esc_js($section_id); ?> .cm-panel{ padding:0.625rem 0 1.125rem; display:none; }
    #<?php echo esc_js($section_id); ?> .cm-panel.open{ display:block; }
    #<?php echo esc_js($section_id); ?> .cm-panel p{ color:#334155; line-height:1.7; margin:0 0 0.875rem; }

    #<?php echo esc_js($section_id); ?> .cm-learn{
      display:inline-flex; align-items:center; justify-content:center; padding:0.125rem 1.875rem; border-radius:0.75rem;
      border:2px solid #0f172a; color:#0f172a; text-decoration:none; font-weight:700; background:#fff;
    }

    /* 右侧：嵌入式图片（同一张卡片内） */
    #<?php echo esc_js($section_id); ?> .cm-right{ background:#f8f8f8; }
    #<?php echo esc_js($section_id); ?> .cm-figure{ width:100%; height:23.75rem; }
    @media (min-width:61.25rem){ #<?php echo esc_js($section_id); ?> .cm-figure{ height:100%; min-height:32.5rem; } }
    @media (max-width: 48rem){ #<?php echo esc_js($section_id); ?> .cm-figure{ height:18.75rem; } }
    @media (max-width: 30rem){ #<?php echo esc_js($section_id); ?> .cm-figure{ height:15.625rem; } }
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
                  <div class="H3" style="margin:0.75rem;"><?php echo esc_html($model['title']); ?></div>
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
                  <?php if (!empty($model['features'])): ?>
                    <ul style="list-style:disc; padding-left:1.25rem; margin:0 0 0.875rem; color:#334155;">
                      <?php foreach ($model['features'] as $feature): ?>
                        <li><?php echo esc_html($feature); ?></li>
                      <?php endforeach; ?>
                    </ul>
                  <?php else: ?>
                    <p class="Body-1"><?php echo wp_kses_post($model['description']); ?></p>
                  <?php endif; ?>

                  <?php if (!empty($learn_link)): ?>
                    <a class="Two-Column-Learn-More-Button" href="<?php echo $learn_link; ?>"><?php echo esc_html($learn_label); ?></a>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- 右侧：图片（嵌在同一张卡片里） -->
        <div class="cm-right">
          <div class="cm-figure">
            <img src="<?php echo get_template_directory_uri(); ?>/src/images/partner-collaboration.png" alt="Partnership collaboration">
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
