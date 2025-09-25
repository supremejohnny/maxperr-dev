<?php
get_header();
?>
<main id="main" class="single-news">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post();
      $categories = get_the_category();
      $primary_category = '';
      if (!empty($categories)) {
        $primary_category = $categories[0]->name;
      }

      $hero_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
      if (!$hero_image) {
        $hero_image = get_template_directory_uri() . '/src/images/ev_charging_pic.jpg';
      }

      $date_iso  = get_the_date(DATE_ATOM);
      $date_text = get_the_date('Y.m.d');
    ?>
      <section class="single-news__hero">
        <?php if ($primary_category) : ?>
          <span class="single-news__tag"><?php echo esc_html($primary_category); ?></span>
        <?php endif; ?>

        <h1 class="single-news__title"><?php the_title(); ?></h1>

        <figure class="single-news__media">
          <img src="<?php echo esc_url($hero_image); ?>" alt="<?php the_title_attribute(); ?>">
          <time class="single-news__date" datetime="<?php echo esc_attr($date_iso); ?>"><?php echo esc_html($date_text); ?></time>
        </figure>
      </section>

      <article class="single-news__body">
        <?php the_content(); ?>
      </article>
    <?php endwhile; ?>
  <?php else : ?>
    <section class="single-news__hero">
      <h1 class="single-news__title"><?php esc_html_e('News Update', 'figma-rebuild'); ?></h1>
    </section>
    <article class="single-news__body">
      <p><?php esc_html_e('We could not find the news article you were looking for.', 'figma-rebuild'); ?></p>
    </article>
  <?php endif; ?>

  <?php
  $pf = [
    'title'       => __('Need Help with EV Charger Installation?', 'figma-rebuild'),
    'description' => __('Connect with our specialists for planning, installation, and ongoing support tailored to your property.', 'figma-rebuild'),
    'cta_label'   => __('Book Consultation', 'figma-rebuild'),
    'cta_link'    => '#book-consultation',
    'hero_image'  => get_template_directory_uri() . '/src/images/install_wallbox.png',
    'benefits'    => [
      [
        'title' => __('Site Assessment', 'figma-rebuild'),
        'text'  => __('Get expert advice on power capacity, permitting, and layout before you break ground.', 'figma-rebuild'),
      ],
      [
        'title' => __('Certified Installers', 'figma-rebuild'),
        'text'  => __('Partner with licensed professionals trained on every Maxperr system.', 'figma-rebuild'),
      ],
      [
        'title' => __('Smart Monitoring', 'figma-rebuild'),
        'text'  => __('Track energy usage, billing, and uptime with our connected platform.', 'figma-rebuild'),
      ],
      [
        'title' => __('Flexible Support', 'figma-rebuild'),
        'text'  => __('Rely on priority maintenance plans to keep chargers running smoothly.', 'figma-rebuild'),
      ],
      [
        'title' => __('Scalable Hardware', 'figma-rebuild'),
        'text'  => __('Add more ports and features as driver demand grows at your site.', 'figma-rebuild'),
      ],
    ],
  ];

  get_template_part('parts/partnership/power-future');
  ?>
</main>
<?php
get_footer();
