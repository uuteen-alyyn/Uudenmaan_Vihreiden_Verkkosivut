<?php get_header(); if ( have_posts() ) the_post(); ?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1>Yleiskokous</h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">Yleiskokous on Uudenmaan Vihreiden ylin päättävä elin, joka kokoontuu kerran vuodessa.</p>
    </div>
  </div>
  <section class="section">
    <div class="container">
      <div style="margin-bottom:2rem;border-radius:8px;overflow:hidden;aspect-ratio:16/9;">
        <img
          src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/placeholders/yleiskokouskuva.jpg' ); ?>"
          alt="Uudenmaan Vihreiden yleiskokous"
          loading="lazy"
          style="width:100%;height:100%;object-fit:cover;"
        >
      </div>
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>
