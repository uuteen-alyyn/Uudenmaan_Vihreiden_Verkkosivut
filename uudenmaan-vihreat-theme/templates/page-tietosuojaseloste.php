<?php get_header(); if ( have_posts() ) the_post(); ?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1>Tietosuoja</h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">
        EU:n yleisen tietosuoja-asetuksen mukaiset rekisteri- ja tietosuojaselosteet.
      </p>
    </div>
  </div>
  <section class="section">
    <div class="container">
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>
