<?php get_header(); ?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1>Vaalitavoitteemme</h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">
        Uudenmaan Vihreiden tavoitteet tulevissa vaaleissa.
      </p>
    </div>
  </div>
  <section class="section">
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php if ( get_the_content() ) : ?>
          <div class="entry-content"><?php the_content(); ?></div>
        <?php else : ?>
          <div class="entry-content">
            <h2>Tavoitteemme</h2>
            <p>[Vaalitavoitteet tähän]</p>
          </div>
        <?php endif; ?>
      <?php endwhile; ?>
    </div>
  </section>
</main>
<?php get_footer(); ?>
