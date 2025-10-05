<?php
  $hero_title = get_theme_mod('hero_title', __('EV Fast Charging', 'figma-rebuild'));
  $hero_subtitle = get_theme_mod('hero_subtitle', '');
  $hero_paragraph = get_theme_mod('hero_paragraph', __('Experience the future of electric vehicle charging with our advanced solar-powered solutions. Clean energy, fast charging, sustainable future.', 'figma-rebuild'));

  // Video settings
  $hero_video_type = get_theme_mod('hero_video_type', 'none');
  $hero_video_file_id = get_theme_mod('hero_video_file', '');
  $hero_video_file = $hero_video_file_id ? wp_get_attachment_url($hero_video_file_id) : '';
  $hero_video_youtube_url = get_theme_mod('hero_video_youtube_url', '');
  $hero_video_autoplay = get_theme_mod('hero_video_autoplay', true);
  $hero_video_loop = get_theme_mod('hero_video_loop', true);
  $hero_video_muted = get_theme_mod('hero_video_muted', true);

  // Background images (fallback when no video)
  $hero_backgrounds = array_values(array_filter([
    get_theme_mod('hero_bg_image_1', get_template_directory_uri() . '/src/images/bg_house.jpg'),
    get_theme_mod('hero_bg_image_2', get_template_directory_uri() . '/src/images/bg_house2.jpg'),
    get_theme_mod('hero_bg_image_3', get_template_directory_uri() . '/src/images/bg_forest.jpg'),
  ]));

  $hero_bg_primary = !empty($hero_backgrounds) ? $hero_backgrounds[0] : '';

  // Determine if we should show video or images
  $has_video = false;
  $video_url = '';
  $is_youtube = false;

  // Debug information (remove in production)
  if (current_user_can('administrator')) {
    echo '<!-- Video Debug Info:';
    echo 'Video Type: ' . $hero_video_type;
    echo 'Video File ID: ' . $hero_video_file_id;
    echo 'Video File URL: ' . $hero_video_file;
    echo 'YouTube URL: ' . $hero_video_youtube_url;
    echo 'Has Video: ' . ($has_video ? 'true' : 'false');
    echo 'Video URL: ' . $video_url;
    echo 'Is YouTube: ' . ($is_youtube ? 'true' : 'false');
    echo '-->';
  }

  if ($hero_video_type === 'upload' && !empty($hero_video_file)) {
    $has_video = true;
    $video_url = $hero_video_file;
  } elseif ($hero_video_type === 'youtube' && !empty($hero_video_youtube_url)) {
    $has_video = true;
    $video_url = $hero_video_youtube_url;
    $is_youtube = true;
  }
?>

<section class="hero-section relative flex items-center overflow-hidden w-full"
  data-hero-images='<?php echo esc_attr(wp_json_encode(array_map('esc_url', $hero_backgrounds))); ?>'
  data-has-video="<?php echo $has_video ? 'true' : 'false'; ?>">
  
  <?php if ($has_video) : ?>
    <!-- Video Background -->
    <div class="hero-video-container">
      <?php if ($is_youtube) : ?>
        <!-- YouTube Video -->
        <div class="hero-youtube-video" data-youtube-url="<?php echo esc_attr($video_url); ?>"></div>
      <?php else : ?>
        <!-- Uploaded Video -->
        <video 
          class="hero-video" 
          <?php echo $hero_video_autoplay ? 'autoplay' : ''; ?>
          <?php echo $hero_video_loop ? 'loop' : ''; ?>
          <?php echo $hero_video_muted ? 'muted' : ''; ?>
          playsinline
          preload="metadata"
          data-video-url="<?php echo esc_attr($video_url); ?>"
          data-autoplay="<?php echo $hero_video_autoplay ? 'true' : 'false'; ?>"
          data-muted="<?php echo $hero_video_muted ? 'true' : 'false'; ?>"
          data-loop="<?php echo $hero_video_loop ? 'true' : 'false'; ?>">
          <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
          <source src="<?php echo esc_url($video_url); ?>" type="video/webm">
          <source src="<?php echo esc_url($video_url); ?>" type="video/ogg">
          <!-- Fallback for browsers that don't support video -->
          <div class="hero-video-fallback" style="background-image:url('<?php echo esc_url($hero_bg_primary); ?>');"></div>
        </video>
      <?php endif; ?>
      
      <!-- Video Control Button -->
      <div class="hero-video-controls">
        <button class="hero-video-toggle" aria-label="暂停/播放视频" title="暂停/播放视频">
          <svg class="hero-video-play-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="5,3 19,12 5,21"></polygon>
          </svg>
          <svg class="hero-video-pause-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
            <rect x="6" y="4" width="4" height="16"></rect>
            <rect x="14" y="4" width="4" height="16"></rect>
          </svg>
        </button>
      </div>
    </div>
  <?php else : ?>
    <!-- Background layers for crossfade (images only) -->
    <div class="hero-bg-layer" data-layer="a"<?php echo $hero_bg_primary ? ' style="background-image:url(' . esc_url($hero_bg_primary) . ');"' : ''; ?>></div>
    <div class="hero-bg-layer" data-layer="b"></div>
  <?php endif; ?>
  
  <!-- Gradient overlay above video/images -->
  <div class="hero-overlay"></div>
    <div class="w-full px-4 md:px-6 relative z-40 max-w-7xl mx-auto">
      <div class="max-w-full md:max-w-[775px] text-left">
        <?php if ($hero_title) : ?>
          <h1 class="text-white Hero-H1 mb-3 leading-tight">
            <?php echo esc_html($hero_title); ?>
          </h1>
        <?php endif; ?>
        <?php if (!empty($hero_subtitle)) : ?>
          <p class="text-white/90 text-xl mb-3 leading-snug">
            <?php echo esc_html($hero_subtitle); ?>
          </p>
        <?php endif; ?>
        <?php if ($hero_paragraph) : ?>
          <p class="Hero-Body text-gray-200 text-lg mb-3 leading-relaxed">
            <?php echo wp_kses_post($hero_paragraph); ?>
          </p>
        <?php endif; ?>
        <button class="One-Column-Learn-More-Button">
          Learn More
        </button>
      </div>
    </div>
    <!-- Slider controls (only show for image slideshow) -->
    <?php if (!$has_video) : ?>
    <div class="hero-controls">
      <button class="hero-nav hero-nav--prev" aria-label="Previous slide">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
      </button>
      <div class="hero-pagination" aria-label="Hero pagination"></div>
      <button class="hero-nav hero-nav--next" aria-label="Next slide">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6-6 6"/></svg>
      </button>
    </div>
    <?php endif; ?>
  </section>
