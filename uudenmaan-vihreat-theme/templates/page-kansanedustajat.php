<?php get_header(); if ( have_posts() ) the_post(); ?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1><?php echo esc_html( get_the_title() ); ?></h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">
        <?php esc_html_e( 'Uudeltamaalta valitut Vihreiden kansanedustajat työskentelevät eduskunnassa Uudenmaan ja koko Suomen parhaaksi.', 'uudenmaan-vihreat' ); ?>
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

      <?php
      $edustajat = uuvi_get_henkilot( 'Kansanedustajat' );
      if ( $edustajat ) :
          set_query_var( 'people', $edustajat );
          get_template_part( 'parts/people-list' );
      else : ?>
        <p style="color:#666;">Lisää kansanedustajat wp-admin → Henkilöstö → Lisää uusi (ryhmä: Kansanedustajat).</p>
      <?php endif; ?>
      <p style="margin-top:2rem;font-size:.9rem;color:#666;">
        <?php esc_html_e( 'Yhteystiedot löytyvät myös', 'uudenmaan-vihreat' ); ?> <a href="https://www.eduskunta.fi/FI/kansanedustajat/Sivut/default.aspx" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'eduskunnan sivuilta', 'uudenmaan-vihreat' ); ?></a>.
      </p>
    </div>
  </section>
</main>
<?php get_footer(); ?>
