<?php
$help_defaults = function_exists('figma_rebuild_get_default_news_paragraph_help')
  ? figma_rebuild_get_default_news_paragraph_help()
  : [
    'eyebrow'         => __('Need help?', 'figma-rebuild'),
    'title'           => __('Need Help with EV Charger Installation?', 'figma-rebuild'),
    'description'     => __('Our specialists can help you scope, plan, and maintain reliable charging infrastructure.', 'figma-rebuild'),
    'primary_label'   => __('Book Consultation', 'figma-rebuild'),
    'primary_url'     => '#',
    'secondary_label' => __('Technical Support', 'figma-rebuild'),
    'secondary_url'   => '#',
  ];

$help_eyebrow     = get_theme_mod('news_paragraph_help_eyebrow', $help_defaults['eyebrow']);
$help_title       = get_theme_mod('news_paragraph_help_title', $help_defaults['title']);
$help_description = get_theme_mod('news_paragraph_help_description', $help_defaults['description']);
$primary_label    = get_theme_mod('news_paragraph_help_primary_label', $help_defaults['primary_label']);
$primary_url      = get_theme_mod('news_paragraph_help_primary_url', $help_defaults['primary_url']);
$secondary_label  = get_theme_mod('news_paragraph_help_secondary_label', $help_defaults['secondary_label']);
$secondary_url    = get_theme_mod('news_paragraph_help_secondary_url', $help_defaults['secondary_url']);
?>

<section class="news-paragraph-help" aria-labelledby="news-paragraph-help-title">
  <div class="container mx-auto px-6">
    <div class="news-paragraph-help__wrapper">
      <div class="news-paragraph-help__copy">
        <?php if (!empty($help_eyebrow)) : ?>
          <span class="news-paragraph-help__eyebrow"><?php echo esc_html($help_eyebrow); ?></span>
        <?php endif; ?>

        <?php if (!empty($help_title)) : ?>
          <h2 id="news-paragraph-help-title" class="news-paragraph-help__title"><?php echo esc_html($help_title); ?></h2>
        <?php endif; ?>

        <?php if (!empty($help_description)) : ?>
          <p class="news-paragraph-help__description"><?php echo esc_html($help_description); ?></p>
        <?php endif; ?>

        <div class="news-paragraph-help__actions">
          <?php if (!empty($primary_label)) : ?>
            <a class="news-paragraph-help__button news-paragraph-help__button--primary" href="<?php echo esc_url($primary_url); ?>">
              <?php echo esc_html($primary_label); ?>
            </a>
          <?php endif; ?>

          <?php if (!empty($secondary_label)) : ?>
            <a class="news-paragraph-help__button news-paragraph-help__button--secondary" href="<?php echo esc_url($secondary_url); ?>">
              <?php echo esc_html($secondary_label); ?>
            </a>
          <?php endif; ?>
        </div>
      </div>

      <div class="news-paragraph-help__cards" role="list">
        <article class="news-paragraph-help__card" role="listitem">
          <h3 class="news-paragraph-help__card-title"><?php echo esc_html($primary_label ?: $help_defaults['primary_label']); ?></h3>
          <p class="news-paragraph-help__card-text"><?php esc_html_e('Schedule time with an EV charging expert and map your deployment plan.', 'figma-rebuild'); ?></p>
          <a class="news-paragraph-help__card-link" href="<?php echo esc_url($primary_url); ?>">
            <?php esc_html_e('Schedule a call', 'figma-rebuild'); ?>
          </a>
        </article>

        <article class="news-paragraph-help__card news-paragraph-help__card--secondary" role="listitem">
          <h3 class="news-paragraph-help__card-title"><?php echo esc_html($secondary_label ?: $help_defaults['secondary_label']); ?></h3>
          <p class="news-paragraph-help__card-text"><?php esc_html_e('Get 24/7 access to troubleshooting, maintenance, and performance monitoring.', 'figma-rebuild'); ?></p>
          <a class="news-paragraph-help__card-link" href="<?php echo esc_url($secondary_url); ?>">
            <?php esc_html_e('Contact support', 'figma-rebuild'); ?>
          </a>
        </article>
      </div>
    </div>
  </div>
</section>
