<?php get_header(); if ( have_posts() ) the_post(); ?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1>Ehdolle vaaleihin</h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">Vihreät tarvitsee rohkeita ehdokkaita joka kunnasta. Sinulla on annettavaa — autamme sinut matkaan.</p>
    </div>
  </div>
  <section class="section">
    <div class="container">
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
      <div style="margin-top:2.5rem;border-radius:8px;overflow:hidden;aspect-ratio:16/9;">
        <img
          src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/placeholders/kampanjointia-teltalla.jpg' ); ?>"
          alt="Kampanjointia teltalla"
          loading="lazy"
          style="width:100%;height:100%;object-fit:cover;"
        >
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>
