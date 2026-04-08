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
  set_query_var( 'hero_h1',      'Rakennetaan parempaa Uuttamaata yhdessä' );
  set_query_var( 'hero_ingress', 'Uudenmaan Vihreät tekee vihreää politiikkaa kaikkialla Uudellamaalla — kunnissa, hyvinvointialueilla ja eduskunnassa.' );
  set_query_var( 'hero_image',   $pics . 'placeholders/hero-luonto.jpg' );
  set_query_var( 'hero_ctas', [
      [ 'label' => 'Tule mukaan', 'url' => home_url( '/tule-mukaan/' ), 'style' => 'btn--primary' ],
      [ 'label' => 'Liity jäseneksi', 'url' => 'https://www.vihreat.fi/liity/', 'style' => 'btn--ghost-white', 'external' => true ],
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
        <h2 id="pikalinkit-heading">Miten voimme auttaa?</h2>
      </div>
      <div class="grid-3">

        <a class="quick-card" href="<?php echo esc_url( home_url( '/tule-mukaan/' ) ); ?>">
          <img class="quick-card__image" src="<?php echo esc_url( $pics . 'placeholders/card-2.jpg' ); ?>" alt="" loading="lazy">
          <div class="quick-card__overlay" aria-hidden="true"></div>
          <div class="quick-card__body">
            <h3>Tule mukaan toimintaan</h3>
            <p>Löydä oma tapasi vaikuttaa — kampanjoinnista kokouksiin.</p>
            <span class="btn btn--ghost-white">Lue lisää →</span>
          </div>
        </a>

        <a class="quick-card" href="<?php echo esc_url( home_url( '/medialle/' ) ); ?>">
          <img class="quick-card__image" src="<?php echo esc_url( $pics . 'placeholders/card-4.jpg' ); ?>" alt="" loading="lazy">
          <div class="quick-card__overlay" aria-hidden="true"></div>
          <div class="quick-card__body">
            <h3>Medialle</h3>
            <p>Yhteystiedot, tiedotteet ja ladattava kuva-aineisto.</p>
            <span class="btn btn--ghost-white">Mediasivu →</span>
          </div>
        </a>

        <a class="quick-card" href="<?php echo esc_url( home_url( '/yhteystiedot/' ) ); ?>">
          <img class="quick-card__image" src="<?php echo esc_url( $pics . 'placeholders/card-3.jpg' ); ?>" alt="" loading="lazy">
          <div class="quick-card__overlay" aria-hidden="true"></div>
          <div class="quick-card__body">
            <h3>Ota yhteyttä</h3>
            <p>Löydä oikea henkilö tai ota yhteys piiritoimistoon.</p>
            <span class="btn btn--ghost-white">Yhteystiedot →</span>
          </div>
        </a>

      </div>
    </div>
  </section>

  <!-- 3. Ajankohtaista ───────────────────────────────────── -->
  <section class="section section--grey" aria-labelledby="ajankohtaista-heading">
    <div class="container">
      <div class="section-header">
        <h2 id="ajankohtaista-heading">Ajankohtaista</h2>
        <p>Uutisia, kannanottoja ja tietoa Uudenmaan Vihreiden toiminnasta.</p>
      </div>
      <?php get_template_part( 'parts/cards-latest' ); ?>
      <p class="mt-2 text-center">
        <a class="btn btn--outline" href="<?php echo esc_url( home_url( '/ajankohtaista/' ) ); ?>">
          Kaikki uutiset →
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
              alt="Tapahtumakuva"
              loading="lazy"
              style="width:100%;height:100%;object-fit:cover;"
            >
          </div>
        </div>
        <div style="flex:1;min-width:280px;">
          <h2 id="tapahtumat-heading">Tapahtumat</h2>
          <p class="ingress" style="margin-bottom:1.5rem;">
            Tule mukaan Uudenmaan Vihreiden tapahtumiin — kalenterista löydät menotiedot koko Uudellamaalla!
          </p>
          <a class="btn btn--primary" href="<?php echo esc_url( home_url( '/tapahtumakalenteri/' ) ); ?>">
            Katso tapahtumakalenteri →
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
      <h2 id="uutiskirje-heading">Tilaa vihreiden uutiskirje</h2>
      <p style="margin:1rem 0 1.75rem;">
        Haluatko pysyä ajan tasalla Vihreiden toiminnasta?
        Tilaa uutiskirjeemme ja saa tuoreimmat uutiset, menotiedot ja kannanotot
        suoraan sähköpostiisi.
      </p>
      <a class="btn btn--primary" href="https://actionnetwork.org/forms/uutiskirje" target="_blank" rel="noopener noreferrer">
        Tilaa uutiskirje →
      </a>
    </div>
  </section>

  <!-- 6b. STT-tiedotteet ──────────────────────────────────── -->
  <section class="section section--grey" aria-labelledby="stt-heading">
    <div class="container">
      <div class="section-header">
        <h2 id="stt-heading">Viimeisimmät puolueen tiedotteet</h2>
        <p>Vihreiden valtakunnalliset tiedotteet STT:n uutishuoneesta.</p>
      </div>
      <?php
      $stt_items = uuvi_get_stt_feed( 3 );
      set_query_var( 'feed_items',     $stt_items );
      set_query_var( 'feed_more_url',  'https://www.sttinfo.fi/uutishuone/69818932/vihreat---de-grona' );
      set_query_var( 'feed_more_label', 'Kaikki tiedotteet uutishuoneessa →' );
      get_template_part( 'parts/feed-list' );
      ?>
    </div>
  </section>

  <!-- 7. Verde-lehti ─────────────────────────────────────── -->
  <section class="section" aria-labelledby="verde-heading">
    <div class="container">
      <div class="section-header">
        <h2 id="verde-heading">Verde-lehti</h2>
        <p>Vihreät ajatukset, tarinat ja puheenvuorot koottuna Verde-lehdessä.</p>
      </div>
      <?php
      $verde_items = uuvi_get_verde_feed( 3 );
      if ( $verde_items ) :
          set_query_var( 'feed_items',      $verde_items );
          set_query_var( 'feed_more_url',   'https://www.verdelehti.fi/' );
          set_query_var( 'feed_more_label', 'Lue Verde-lehteä →' );
          get_template_part( 'parts/feed-list' );
      else : ?>
        <div class="highlight-box">
          <h3>Verde-lehti</h3>
          <p>Vihreät ajatukset ja tarinat — <a href="https://www.verdelehti.fi/" target="_blank" rel="noopener noreferrer">lue Verde-lehteä verdelehti.fi:ssä</a>.</p>
        </div>
      <?php endif; ?>
    </div>
  </section>

</main>

<?php get_footer(); ?>
