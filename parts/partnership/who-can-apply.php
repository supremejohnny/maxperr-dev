<?php
/**
 * Who Can Apply Section
 */

// Get professionals from customizer repeater field
$professionals_raw = get_theme_mod('who_can_apply_professionals', '');
$professionals = [];
if (!empty($professionals_raw)) {
  $professionals = json_decode($professionals_raw, true);
  if (!is_array($professionals)) {
    $professionals = [];
  }
}

// Fallback to default professionals if none are set
if (empty($professionals)) {
  $professionals = [
    [
      'title' => 'Electricians and Technicians',
      'description' => 'Licensed professionals experienced in electrical installations.',
      'image' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&w=400&q=80'
    ],
    [
      'title' => 'Distributors and Resellers',
      'description' => 'Businesses looking to expand their product portfolio with EV solutions.',
      'image' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=400&q=80'
    ],
    [
      'title' => 'Contractors and Installers',
      'description' => 'Companies specializing in installing electrical or EV charging equipment.',
      'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=400&q=80'
    ],
    [
      'title' => 'Energy Consultants',
      'description' => 'Professionals advising clients on energy efficiency and sustainable solutions.',
      'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80'
    ],
    [
      'title' => 'Property Developers and Managers',
      'description' => 'Those interested in integrating EV charging into their projects.',
      'image' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?auto=format&fit=crop&w=400&q=80'
    ],
    [
      'title' => 'Architects and Engineers',
      'description' => 'Professionals specialize in the design and construction of infrastructures.',
      'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80'
    ]
  ];
}

// Get section settings from customizer
$section_title = get_theme_mod('who_can_apply_title', 'Who Can Apply?');
$section_description = get_theme_mod('who_can_apply_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.');
$button_text = get_theme_mod('who_can_apply_button_text', 'Apply Now');
$button_link = get_theme_mod('who_can_apply_button_link', '#become-partner');
?>

<section id="who-can-apply" class="who-can-apply-section">
  <div class="who-can-apply__container">
    <div class="who-can-apply__header">
      <h2 class="H2-Black"><?php echo esc_html($section_title); ?></h2>
      <p class="Body-1" style="color: #000; margin:20px"><?php echo wp_kses_post($section_description); ?></p>
      <div class="who-can-apply__cta">
        <a href="<?php echo esc_url($button_link); ?>" class="One-Column-Learn-More-Button"><?php echo esc_html($button_text); ?></a>
      </div>
    </div>
    
    <div class="who-can-apply__grid who-can-apply__grid--fixed">
      <?php foreach ($professionals as $index => $professional): ?>
        <article class="who-can-apply__card who-can-apply__card--overlay">
          <img
            src="<?php echo esc_url($professional['image']); ?>"
            alt="<?php echo esc_attr($professional['title']); ?>"
            class="who-can-apply__img"
          >
          <div class="who-can-apply__card-content">
            <h3 class="H3" style="max-width:230px;margin-bottom:10px;">
              <?php echo esc_html($professional['title']); ?>
            </h3>
            <p class="Body-1" style="max-width:340px; color: #000;">
              <?php echo esc_html($professional['description']); ?>
            </p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
</section>

<style>
.who-can-apply-section {
  padding: 80px 0;
  background: #ffffff;
}

.who-can-apply__container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 24px;
}

.who-can-apply__header {
  text-align: center;
  margin-bottom: 60px;
}

.who-can-apply__title {
  font-size: 48px;
  font-weight: 800;
  color: #0f172a;
  margin: 0 0 16px;
  line-height: 1.1;
  letter-spacing: -0.02em;
}

.who-can-apply__description {
  font-size: 18px;
  line-height: 1.6;
  color: #475569;
  margin: 0 0 32px;
  max-width: 600px;
  margin-left: auto;
  margin-right: auto;
}

.who-can-apply__cta {
  display: flex;
  justify-content: center;
}

.who-can-apply__button {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 16px 32px;
  background: #2563eb;
  color: #ffffff;
  text-decoration: none;
  border-radius: 12px;
  font-weight: 600;
  font-size: 16px;
  transition: background-color 0.2s ease;
}

.who-can-apply__button:hover {
  background: #1d4ed8;
}

.who-can-apply__grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 24px;
}

@media (min-width: 768px) {
  .who-can-apply__grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (min-width: 1024px) {
  .who-can-apply__grid {
    grid-template-columns: repeat(3, 1fr);
  }

}

.who-can-apply__card {
  background: #ffffff;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.who-can-apply__card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
}

.who-can-apply__card-image {
  width: 100%;
  height: 200px;
  overflow: hidden;
}

.who-can-apply__img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.2s ease;
}

.who-can-apply__card:hover .who-can-apply__img {
  transform: scale(1.05);
}

.who-can-apply__card-content {
  padding: 24px;
}

.who-can-apply__card-title {
  font-size: 20px;
  font-weight: 700;
  color: #0f172a;
  margin: 0 0 12px;
  line-height: 1.3;
}

.who-can-apply__card-description {
  font-size: 16px;
  line-height: 1.6;
  color: #475569;
  margin: 0;
}

/* 固定 450×450，并让网格两侧各有 160px 边距 */
.who-can-apply__grid--fixed{
  padding-left:160px;
  padding-right:160px;
  display:grid;
  grid-template-columns:repeat(3, 450px);
  gap:24px;
  justify-content:center;
}

/* 卡片覆盖式：图片满铺，文字叠在上方，顶部羽化提亮文字 */
.who-can-apply__card--overlay{
  position:relative;
  width:450px;
  height:450px;
  overflow:hidden;
}
.who-can-apply__card--overlay .who-can-apply__img{
  position:absolute; inset:0;
  width:100%; height:100%;
  object-fit:cover;
  z-index:1;
  transition:transform .25s ease;
}
.who-can-apply__card--overlay::before{
  content:"";
  position:absolute; inset:0; z-index:2; pointer-events:none;
  /* 顶部羽化：白到透明，保证字清晰 */
  background:linear-gradient(
    to bottom,
    rgba(255,255,255,.94) 0%,
    rgba(255,255,255,.82) 14%,
    rgba(255,255,255,.48) 34%,
    rgba(255,255,255,.20) 52%,
    rgba(255,255,255,0) 68%
  );
}
.who-can-apply__card--overlay .who-can-apply__card-content{
  position:absolute; z-index:3;
  top:20px; left:40px; right:20px;
  padding:0; /* 覆盖原 padding */
  color:#111827;
}
.who-can-apply__card--overlay:hover .who-can-apply__img{ transform:scale(1.03); }

/* 自适应降列：视口不足时从 3 列降为 2/1 列 */
@media (max-width: calc(3 * 450px + 2 * 24px + 2 * 160px)){
  .who-can-apply__grid--fixed{ grid-template-columns:repeat(2, 450px); }
}
@media (max-width: calc(2 * 450px + 1 * 24px + 2 * 160px)){
  .who-can-apply__grid--fixed{ grid-template-columns:repeat(1, 450px); }
}


@media (max-width: 768px) {
  .who-can-apply-section {
    padding: 60px 0;
  }
  
  .who-can-apply__container {
    padding: 0 16px;
  }
  
  .who-can-apply__header {
    margin-bottom: 40px;
  }
  
  .who-can-apply__title {
    font-size: 36px;
  }
  
  .who-can-apply__description {
    font-size: 16px;
  }
  
  .who-can-apply__card-content {
    padding: 20px;
  }
  
  .who-can-apply__card-title {
    font-size: 18px;
  }
  
  .who-can-apply__card-description {
    font-size: 14px;
  }
}
</style>
