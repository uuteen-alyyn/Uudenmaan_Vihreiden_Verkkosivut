<?php get_header(); if ( have_posts() ) the_post(); ?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1>Kansanedustajamme</h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">
        Uudeltamaalta valitut Vihreiden kansanedustajat työskentelevät eduskunnassa Uudenmaan ja koko Suomen parhaaksi.
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
        Yhteystiedot löytyvät myös <a href="https://www.eduskunta.fi/FI/kansanedustajat/Sivut/default.aspx" target="_blank" rel="noopener noreferrer">eduskunnan sivuilta</a>.
      </p>
    </div>
  </section>
</main>
<?php get_footer(); ?>
