<?php
/**
 * Generic page template — fallback for all pages without a custom template.
 */
get_header();
?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
      <?php endwhile; ?>
    </div>
  </div>
  <div class="page-content">
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</main>
<?php get_footer(); ?>
