<?php get_header(); if ( have_posts() ) the_post(); ?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1><?php echo esc_html( get_the_title() ); ?></h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);"><?php esc_html_e( 'Uudenmaan Vihreät on Vihreiden piirijärjestö, joka toimii koko Uudenmaan vaalipiirin alueella.', 'uudenmaan-vihreat' ); ?></p>
    </div>
  </div>
  <section class="section">
    <div class="container">
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
      <p style="margin-top:2rem;">
        <a href="<?php echo esc_url( home_url( '/tietosuojaseloste/' ) ); ?>"><?php esc_html_e( 'Tietosuojaseloste →', 'uudenmaan-vihreat' ); ?></a>
      </p>
    </div>
  </section>
</main>
<?php get_footer(); ?>
