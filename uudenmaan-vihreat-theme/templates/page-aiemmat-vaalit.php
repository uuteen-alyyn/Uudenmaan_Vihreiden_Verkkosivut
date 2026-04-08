<?php get_header(); if ( have_posts() ) the_post(); ?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1>Aiemmat vaalit</h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">
        Vihreiden vaalimenestys Uudellamaalla — tulokset, valitut edustajat ja äänimäärät vaaleittain.
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
