<?php get_header(); if ( have_posts() ) the_post(); ?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1>Vaalit</h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">Vaalit ovat demokratian sydän — ja me olemme mukana joka kerta.</p>
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
