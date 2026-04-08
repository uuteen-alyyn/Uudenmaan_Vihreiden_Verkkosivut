<?php get_header(); if ( have_posts() ) the_post(); ?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1>Medialle</h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">
        Tervetuloa — löydät täältä yhteystiedot, taustatietoa piiristä sekä ladattavan kuva- ja logomateriaalin.
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


      <!-- Mediayhteyshenkilöt -->
      <h2>Mediayhteyshenkilöt</h2>
      <div class="grid-2" style="margin-top:1rem;">
        <div class="highlight-box">
          <p style="font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;color:var(--color-bright);margin-bottom:0.5rem;">Puheenjohtaja</p>
          <p><strong><?php echo uuvi_mod( 'uuvi_pj_nimi' ) ?: 'Santeri Leinonen'; ?></strong></p>
          <p>Puh: <a href="tel:<?php echo esc_attr( preg_replace('/\s+/', '', get_theme_mod('uuvi_pj_puhelin', '+358449807438')) ); ?>"><?php echo uuvi_mod( 'uuvi_pj_puhelin' ) ?: '+358 44 980 7438'; ?></a></p>
          <p>Sähköposti: <a href="mailto:<?php echo esc_attr( get_theme_mod('uuvi_pj_email','santeri.leinonen@vihreat.fi') ); ?>"><?php echo uuvi_mod( 'uuvi_pj_email' ) ?: 'santeri.leinonen@vihreat.fi'; ?></a></p>
        </div>
        <div class="highlight-box">
          <p style="font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;color:var(--color-bright);margin-bottom:0.5rem;">Toiminnanjohtaja</p>
          <p><strong><?php echo uuvi_mod( 'uuvi_tj_nimi' ) ?: 'Oskari Sundström'; ?></strong></p>
          <p>Puh: <a href="tel:<?php echo esc_attr( preg_replace('/\s+/', '', get_theme_mod('uuvi_tj_puhelin', '+358451242818')) ); ?>"><?php echo uuvi_mod( 'uuvi_tj_puhelin' ) ?: '+358 45 124 2818'; ?></a></p>
          <p>Sähköposti: <a href="mailto:<?php echo esc_attr( get_theme_mod('uuvi_tj_email','oskari.sundstrom@vihreat.fi') ); ?>"><?php echo uuvi_mod( 'uuvi_tj_email' ) ?: 'oskari.sundstrom@vihreat.fi'; ?></a></p>
        </div>
      </div>

      <!-- Faktaa piiristä -->
      <h2 style="margin-top:2.5rem;">Faktaa piiristä</h2>
      <div class="fact-box" style="margin-top:1rem;">
        <div class="fact-item">
          <div class="fact-item__value">[lkm]</div>
          <div class="fact-item__label">Jäsentä</div>
        </div>
        <div class="fact-item">
          <div class="fact-item__value">[lkm]</div>
          <div class="fact-item__label">Paikallisyhdistystä</div>
        </div>
        <div class="fact-item">
          <div class="fact-item__value">[lkm]</div>
          <div class="fact-item__label">Kansanedustajaa</div>
        </div>
        <div class="fact-item">
          <div class="fact-item__value">[lkm]</div>
          <div class="fact-item__label">Kunnanvaltuutettua</div>
        </div>
      </div>

      <!-- Viimeisimmät tiedotteet -->
      <h2 style="margin-top:2.5rem;">Viimeisimmät puolueen tiedotteet</h2>
      <?php
      $stt_items = uuvi_get_stt_feed( 5 );
      set_query_var( 'feed_items',      $stt_items );
      set_query_var( 'feed_more_url',   'https://www.sttinfo.fi/uutishuone/69818932/vihreat---de-grona' );
      set_query_var( 'feed_more_label', 'Kaikki tiedotteet →' );
      get_template_part( 'parts/feed-list' );
      ?>

      <!-- Logot & kuvat -->
      <h2 style="margin-top:2.5rem;">Logot &amp; kuvamateriaali</h2>
      <div class="grid-2" style="margin-top:1rem;">
        <div class="card">
          <div class="card__body">
            <h3 class="card__title">Vihreiden logo (vaalea tausta)</h3>
            <p class="card__excerpt">PNG-muodossa, käytä valkoisella tai vaalealla taustalla.</p>
            <a class="btn btn--outline" href="[Latauslinkki tähän]" download>Lataa PNG →</a>
          </div>
        </div>
        <div class="card">
          <div class="card__body">
            <h3 class="card__title">Vihreiden logo (tumma tausta)</h3>
            <p class="card__excerpt">PNG-muodossa, käytä tummalla taustalla (negatiivi).</p>
            <a class="btn btn--outline" href="[Latauslinkki tähän]" download>Lataa PNG →</a>
          </div>
        </div>
      </div>

      <!-- Kuvapankki -->
      <h2 style="margin-top:2.5rem;">Kuvapankki</h2>
      <p>Kampanjointikuvat ja henkilökuvat ovat saatavilla Google Drivessä.</p>
      <p style="margin-top:1rem;">
        <a class="btn btn--outline" href="[Google Drive -URL tähän]" target="_blank" rel="noopener noreferrer">
          Avaa kuvapankki →
        </a>
      </p>

    </div>
  </section>
</main>
<?php get_footer(); ?>
