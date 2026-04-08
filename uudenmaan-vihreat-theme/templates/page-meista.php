<?php get_header(); if ( have_posts() ) the_post(); ?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1>Meistä</h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">Uudenmaan Vihreät on Vihreiden piirijärjestö, joka toimii koko Uudenmaan vaalipiirin alueella.</p>
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
