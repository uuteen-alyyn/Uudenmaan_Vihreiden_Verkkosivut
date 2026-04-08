<?php get_header(); if ( have_posts() ) the_post(); ?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1>Tapahtumakalenteri</h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">
        Uudenmaan tulevat vihreät tapahtumat.
      </p>
    </div>
  </div>
  <section class="section">
    <div class="container">
      <?php if ( get_the_content() ) : ?>
      <div class="entry-content" style="margin-bottom:2rem;">
        <?php the_content(); ?>
      </div>
      <?php endif; ?>


      <?php echo do_shortcode( '[uuvi_tapahtumat]' ); ?>

    </div>
  </section>
</main>
<?php get_footer(); ?>
