<?php
/**
 * Homepage template — front-page.php
 * Sections: Hero · Pikalinkit · Ajankohtaista · Tapahtumat · CTA · STT · Verde
 */
get_header();
if ( have_posts() ) the_post();
$theme_uri = get_template_directory_uri();
$pics      = get_template_directory_uri() . '/assets/images/';
?>
<main id="main-content">

  <!-- 1. Hero ─────────────────────────────────────────────── -->
  <?php
  set_query_var( 'hero_h1',      __( 'Rakennetaan parempaa Uuttamaata yhdessä', 'uudenmaan-vihreat' ) );
  set_query_var( 'hero_ingress', __( 'Uudenmaan Vihreät tekee vihreää politiikkaa kaikkialla Uudellamaalla — kunnissa, hyvinvointialueilla ja eduskunnassa.', 'uudenmaan-vihreat' ) );
  set_query_var( 'hero_image',   $pics . 'placeholders/hero-luonto.jpg' );
  $ehdolle_posts = get_posts( [ 'name' => 'ehdolle-vaaleihin', 'post_type' => 'page', 'numberposts' => 1 ] );
  $ehdolle_url   = $ehdolle_posts ? get_permalink( $ehdolle_posts[0]->ID ) : home_url( '/vaalit/ehdolle-vaaleihin/' );
  set_query_var( 'hero_ctas', [
      [ 'label' => __( 'Tule mukaan', 'uudenmaan-vihreat' ),    'url' => uuvi_translated_url( 'tule-mukaan' ), 'style' => 'btn--primary' ],
      [ 'label' => __( 'Ehdolle eduskuntavaaleihin?', 'uudenmaan-vihreat' ), 'url' => $ehdolle_url, 'style' => 'btn--ghost-white' ],
  ] );
  get_template_part( 'parts/hero' );
  ?>

  <?php if ( get_the_content() ) : ?>
  <section class="section">
    <div class="container">
      <div class="entry-content"><?php the_content(); ?></div>
    </div>
  </section>
  <?php endif; ?>

  <!-- 2. Pikalinkit ──────────────────────────────────────── -->
  <section class="section" aria-labelledby="pikalinkit-heading">
    <div class="container">
      <div class="section-header section-header--center">
        <h2 id="pikalinkit-heading"><?php esc_html_e( 'Miten voimme auttaa?', 'uudenmaan-vihreat' ); ?></h2>
      </div>
      <div class="grid-3">

        <a class="quick-card" href="<?php echo esc_url( uuvi_translated_url( 'tule-mukaan' ) ); ?>">
          <img class="quick-card__image" src="<?php echo esc_url( $pics . 'placeholders/card-2.jpg' ); ?>" alt="" loading="lazy">
          <div class="quick-card__overlay" aria-hidden="true"></div>
          <div class="quick-card__body">
            <h3><?php esc_html_e( 'Tule mukaan toimintaan', 'uudenmaan-vihreat' ); ?></h3>
            <p><?php esc_html_e( 'Löydä oma tapasi vaikuttaa — kampanjoinnista kokouksiin.', 'uudenmaan-vihreat' ); ?></p>
            <span class="btn btn--ghost-white"><?php esc_html_e( 'Lue lisää →', 'uudenmaan-vihreat' ); ?></span>
          </div>
        </a>

        <a class="quick-card" href="<?php echo esc_url( uuvi_translated_url( 'medialle' ) ); ?>">
          <img class="quick-card__image" src="<?php echo esc_url( $pics . 'placeholders/card-4.jpg' ); ?>" alt="" loading="lazy">
          <div class="quick-card__overlay" aria-hidden="true"></div>
          <div class="quick-card__body">
            <h3><?php echo esc_html( uuvi_translated_title( 'medialle' ) ); ?></h3>
            <p><?php esc_html_e( 'Yhteystiedot, tiedotteet ja ladattava kuva-aineisto.', 'uudenmaan-vihreat' ); ?></p>
            <span class="btn btn--ghost-white"><?php esc_html_e( 'Mediasivu →', 'uudenmaan-vihreat' ); ?></span>
          </div>
        </a>

        <a class="quick-card" href="<?php echo esc_url( uuvi_translated_url( 'yhteystiedot' ) ); ?>">
          <img class="quick-card__image" src="<?php echo esc_url( $pics . 'placeholders/card-3.jpg' ); ?>" alt="" loading="lazy">
          <div class="quick-card__overlay" aria-hidden="true"></div>
          <div class="quick-card__body">
            <h3><?php esc_html_e( 'Ota yhteyttä', 'uudenmaan-vihreat' ); ?></h3>
            <p><?php esc_html_e( 'Löydä oikea henkilö tai ota yhteys piiritoimistoon.', 'uudenmaan-vihreat' ); ?></p>
            <span class="btn btn--ghost-white"><?php echo esc_html( uuvi_translated_title( 'yhteystiedot' ) ); ?> →</span>
          </div>
        </a>

      </div>
    </div>
  </section>

  <!-- 3. Ajankohtaista ───────────────────────────────────── -->
  <section class="section section--grey" aria-labelledby="ajankohtaista-heading">
    <div class="container">
      <div class="section-header">
        <h2 id="ajankohtaista-heading"><?php echo esc_html( uuvi_translated_title( 'ajankohtaista' ) ); ?></h2>
        <p><?php esc_html_e( 'Uutisia, kannanottoja ja tietoa Uudenmaan Vihreiden toiminnasta.', 'uudenmaan-vihreat' ); ?></p>
      </div>
      <?php get_template_part( 'parts/cards-latest' ); ?>
      <p class="mt-2 text-center">
        <a class="btn btn--outline" href="<?php echo esc_url( uuvi_translated_url( 'ajankohtaista' ) ); ?>">
          <?php esc_html_e( 'Kaikki uutiset →', 'uudenmaan-vihreat' ); ?>
        </a>
      </p>
    </div>
  </section>

  <!-- 4. Tapahtumat ──────────────────────────────────────── -->
  <section class="section" aria-labelledby="tapahtumat-heading">
    <div class="container">
      <div class="flex-row" style="gap:3rem;">
        <div style="flex:1;min-width:280px;">
          <div style="border-radius:8px;overflow:hidden;aspect-ratio:3/2;">
            <img
              src="<?php echo esc_url( $pics . 'placeholders/events-tori.jpg' ); ?>"
              alt=""
              loading="lazy"
              style="width:100%;height:100%;object-fit:cover;"
            >
          </div>
        </div>
        <div style="flex:1;min-width:280px;">
          <h2 id="tapahtumat-heading"><?php esc_html_e( 'Tapahtumat', 'uudenmaan-vihreat' ); ?></h2>
          <p class="ingress" style="margin-bottom:1.5rem;">
            <?php esc_html_e( 'Tule mukaan Uudenmaan Vihreiden tapahtumiin — kalenterista löydät menotiedot koko Uudellamaalla!', 'uudenmaan-vihreat' ); ?>
          </p>
          <a class="btn btn--primary" href="<?php echo esc_url( uuvi_translated_url( 'tapahtumakalenteri' ) ); ?>">
            <?php esc_html_e( 'Katso tapahtumakalenteri →', 'uudenmaan-vihreat' ); ?>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. CTA-painikkeet ──────────────────────────────────── -->
  <?php get_template_part( 'parts/cta-buttons' ); ?>

  <!-- 5b. Uutiskirje ─────────────────────────────────────── -->
  <section class="section section--light-green" aria-labelledby="uutiskirje-heading">
    <div class="container" style="text-align:center;max-width:640px;">
      <h2 id="uutiskirje-heading"><?php esc_html_e( 'Tilaa vihreiden uutiskirje', 'uudenmaan-vihreat' ); ?></h2>
      <p style="margin:1rem 0 1.75rem;">
        <?php esc_html_e( 'Haluatko pysyä ajan tasalla Vihreiden toiminnasta? Tilaa uutiskirjeemme ja saa tuoreimmat uutiset, menotiedot ja kannanotot suoraan sähköpostiisi.', 'uudenmaan-vihreat' ); ?>
      </p>
      <a class="btn btn--primary" href="https://actionnetwork.org/forms/uutiskirje" target="_blank" rel="noopener noreferrer">
        <?php esc_html_e( 'Tilaa uutiskirje →', 'uudenmaan-vihreat' ); ?>
      </a>
    </div>
  </section>

  <!-- 6b. STT-tiedotteet ──────────────────────────────────── -->
  <section class="section section--grey" aria-labelledby="stt-heading">
    <div class="container">
      <div class="section-header">
        <h2 id="stt-heading"><?php esc_html_e( 'Viimeisimmät puolueen tiedotteet', 'uudenmaan-vihreat' ); ?></h2>
        <p><?php esc_html_e( 'Vihreiden valtakunnalliset tiedotteet STT:n uutishuoneesta.', 'uudenmaan-vihreat' ); ?></p>
      </div>
      <?php
      $stt_items = uuvi_get_stt_feed( 3 );
      set_query_var( 'feed_items',     $stt_items );
      set_query_var( 'feed_more_url',  'https://www.sttinfo.fi/uutishuone/69818932/vihreat---de-grona' );
      set_query_var( 'feed_more_label', __( 'Kaikki tiedotteet uutishuoneessa →', 'uudenmaan-vihreat' ) );
      get_template_part( 'parts/feed-list' );
      ?>
    </div>
  </section>

  <!-- 7. Verde-lehti ─────────────────────────────────────── -->
  <section class="section" aria-labelledby="verde-heading">
    <div class="container">
      <div class="section-header">
        <h2 id="verde-heading">Verde-lehti</h2>
        <p><?php esc_html_e( 'Vihreät ajatukset, tarinat ja puheenvuorot koottuna Verde-lehdessä.', 'uudenmaan-vihreat' ); ?></p>
      </div>
      <?php
      $verde_items = uuvi_get_verde_feed( 3 );
      if ( $verde_items ) :
          set_query_var( 'feed_items',      $verde_items );
          set_query_var( 'feed_more_url',   'https://www.verdelehti.fi/' );
          set_query_var( 'feed_more_label', __( 'Lue Verde-lehteä →', 'uudenmaan-vihreat' ) );
          get_template_part( 'parts/feed-list' );
      else : ?>
        <div class="highlight-box">
          <h3>Verde-lehti</h3>
          <p><?php esc_html_e( 'Vihreät ajatukset ja tarinat — ', 'uudenmaan-vihreat' ); ?><a href="https://www.verdelehti.fi/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'lue Verde-lehteä verdelehti.fi:ssä', 'uudenmaan-vihreat' ); ?></a>.</p>
        </div>
      <?php endif; ?>
    </div>
  </section>

</main>

<?php get_footer(); ?>
