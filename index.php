<?php get_header(); ?>
<main id="main" class="min-h-screen">
  <section class="container mx-auto px-4 py-16">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <article <?php post_class('prose max-w-none'); ?>>
        <h1 class="text-3xl font-bold mb-6"><?php the_title(); ?></h1>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
      </article>
    <?php endwhile; else: ?>
      <p>No content found.</p>
    <?php endif; ?>
  </section>
</main>
<?php get_footer(); ?>
