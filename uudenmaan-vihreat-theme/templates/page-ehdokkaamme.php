<?php
/**
 * Template Name: Ehdokkaamme
 */
get_header(); if ( have_posts() ) the_post();
?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1><?php echo esc_html( get_the_title() ); ?></h1>
    </div>
  </div>
  <section class="section">
    <div class="container prose">
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>
