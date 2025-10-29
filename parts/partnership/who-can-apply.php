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
            <h3 class="H3">
              <?php echo esc_html($professional['title']); ?>
            </h3>
            <p class="Body-1 who-can-apply__description-text">
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

/* 网格布局 - 桌面端显示3列 */
.who-can-apply__grid--fixed {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: clamp(16px, 2vw, 24px);
  justify-content: center;
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 clamp(16px, 4vw, 48px);
}

/* 卡片样式 - 图片占据整个卡片，文字覆盖在上方 */
.who-can-apply__card--overlay {
  position: relative;
  width: 100%;
  background: #ffffff;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  transition: box-shadow 0.3s ease;
  aspect-ratio: 1 / 1;
}

/* Desktop: 固定 450x450px，响应式 */
@media (min-width: 1024px) {
  .who-can-apply__card--overlay {
    width: clamp(300px, 28vw, 450px);
    height: clamp(300px, 28vw, 450px);
    max-width: 450px;
    max-height: 450px;
    margin: 0 auto;
  }
}

.who-can-apply__card--overlay:hover {
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

/* 图片占据整个卡片 */
.who-can-apply__img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
  z-index: 1;
}

.who-can-apply__card--overlay:hover .who-can-apply__img {
  transform: scale(1.05);
}

/* 图片上半部分羽化效果 - 白色到透明的渐变，增强白色区域 */
.who-can-apply__card--overlay::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 60%;
  z-index: 2;
  pointer-events: none;
  background: linear-gradient(
    to bottom,
    rgba(255, 255, 255, 1) 0%,
    rgba(255, 255, 255, 1) 25%,
    rgba(255, 255, 255, 0.95) 35%,
    rgba(255, 255, 255, 0.8) 45%,
    rgba(255, 255, 255, 0.5) 55%,
    rgba(255, 255, 255, 0.2) 65%,
    rgba(255, 255, 255, 0) 100%
  );
}

/* 文字内容区域 - 覆盖在图片上方，左上对齐，左右和上边距为40px */
.who-can-apply__card--overlay .who-can-apply__card-content {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 3;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: clamp(20px, 3vw, 40px) clamp(20px, 3vw, 40px) clamp(16px, 2vw, 24px) clamp(20px, 3vw, 40px);
  pointer-events: none;
}

.who-can-apply__card--overlay .who-can-apply__card-content .H3 {
  margin: 0 0 clamp(8px, 1vw, 12px) 0;
  color: #000;
  text-align: left;
  max-width: 85%;
}

.who-can-apply__card--overlay .who-can-apply__card-content .Body-1 {
  margin: 0;
  color: #000;
  text-align: left;
  max-width: 85%;
}

/* 小于768px时隐藏描述 */
@media (max-width: 767px) {
  .who-can-apply__description-text {
    display: none !important;
  }
}

/* 平板尺寸 */
@media (max-width: 1023px) {
  .who-can-apply__grid--fixed {
    grid-template-columns: repeat(3, 1fr);
    gap: clamp(12px, 1.5vw, 20px);
    padding: 0 clamp(12px, 3vw, 32px);
  }
  
  .who-can-apply__card--overlay {
    aspect-ratio: 1 / 1;
  }
}

/* 移动设备 - 两列布局 */
@media (max-width: 640px) {
  .who-can-apply__grid--fixed {
    grid-template-columns: repeat(2, 1fr);
    gap: clamp(8px, 2vw, 16px);
    padding: 0 clamp(8px, 2vw, 16px);
  }
  
  .who-can-apply__card--overlay {
    aspect-ratio: 1 / 1;
  }
  
  .who-can-apply__card--overlay .who-can-apply__card-content {
    padding: clamp(16px, 2.5vw, 30px) clamp(16px, 2.5vw, 30px) clamp(12px, 1.5vw, 16px) clamp(16px, 2.5vw, 30px);
  }
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
}
</style>
