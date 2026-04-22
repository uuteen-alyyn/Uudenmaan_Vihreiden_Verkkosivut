<?php
get_header();
$pics = get_template_directory_uri() . '/assets/images/placeholders/';
?>
<main id="main-content">

  <div class="page-hero">
    <div class="container">
      <h1><?php echo esc_html( get_the_title() ); ?></h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">
        <?php esc_html_e( 'Vihreä politiikka syntyy ihmisten yhteisestä tekemisestä. Löydä oma tapasi vaikuttaa.', 'uudenmaan-vihreat' ); ?>
      </p>
    </div>
  </div>

  <!-- Näin pääset mukaan -->
  <section class="section section--grey" aria-labelledby="naain-heading">
    <div class="container">
      <h2 id="naain-heading"><?php esc_html_e( 'Näin pääset mukaan', 'uudenmaan-vihreat' ); ?></h2>
      <div class="steps gap-top">
        <div class="step">
          <span class="step__number" aria-hidden="true">1</span>
          <div class="step__body">
            <h3><?php esc_html_e( 'Osallistu tapahtumiin', 'uudenmaan-vihreat' ); ?></h3>
            <p><?php esc_html_e( 'Kokous, koulutus tai kahvitilaisuus — tervetuloa sellaisena kuin olet.', 'uudenmaan-vihreat' ); ?></p>
          </div>
        </div>
        <div class="step">
          <span class="step__number" aria-hidden="true">2</span>
          <div class="step__body">
            <h3><?php esc_html_e( 'Ilmoittaudu vapaaehtoiseksi', 'uudenmaan-vihreat' ); ?></h3>
            <p><?php esc_html_e( 'Tule mukaan kampanjointiin, tapahtumiin tai kertomaan mielipiteesi politiikasta.', 'uudenmaan-vihreat' ); ?></p>
          </div>
        </div>
        <div class="step">
          <span class="step__number" aria-hidden="true">3</span>
          <div class="step__body">
            <h3><?php esc_html_e( 'Liity jäseneksi', 'uudenmaan-vihreat' ); ?></h3>
            <p><?php esc_html_e( 'Jäsenyys on helppo tapa tukea vihreää politiikkaa ja saada äänesi kuuluviin.', 'uudenmaan-vihreat' ); ?></p>
          </div>
        </div>
      </div>
      <p style="margin-top:2rem;">
        <a class="btn btn--primary" href="https://www.vihreat.fi/liity/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Liity jäseneksi →', 'uudenmaan-vihreat' ); ?></a>
      </p>
    </div>
  </section>

  <!-- Mitä voin tehdä? -->
  <section class="section" aria-labelledby="mita-heading">
    <div class="container">
      <div class="section-header section-header--center">
        <h2 id="mita-heading"><?php esc_html_e( 'Mitä voin tehdä?', 'uudenmaan-vihreat' ); ?></h2>
        <p><?php esc_html_e( 'Jokainen panos on arvokas — valitse sinulle sopiva tapa.', 'uudenmaan-vihreat' ); ?></p>
      </div>
      <div class="grid-3">
        <div class="time-card">
          <span class="time-card__label"><?php esc_html_e( '30 minuuttia', 'uudenmaan-vihreat' ); ?></span>
          <h3><?php esc_html_e( 'Pienet teot', 'uudenmaan-vihreat' ); ?></h3>
          <p><?php esc_html_e( 'Jaa julkaisu somessa, allekirjoita vetoomus tai ota yhteyttä kansanedustajaan. Pienetkin teot merkitsevät.', 'uudenmaan-vihreat' ); ?></p>
        </div>
        <div class="time-card">
          <span class="time-card__label"><?php esc_html_e( '2 tuntia', 'uudenmaan-vihreat' ); ?></span>
          <h3><?php esc_html_e( 'Tule tapahtumaan', 'uudenmaan-vihreat' ); ?></h3>
          <p><?php esc_html_e( 'Tule mukaan tapahtumaan tai kokoukseen, puhu vihreästä politiikasta tai jaa ehdokkaasi esitteitä naapuruston postilaatikkoon. Yhdessä olemme enemmän.', 'uudenmaan-vihreat' ); ?></p>
        </div>
        <div class="time-card">
          <span class="time-card__label"><?php esc_html_e( '2 päivää', 'uudenmaan-vihreat' ); ?></span>
          <h3><?php esc_html_e( 'Talkoot', 'uudenmaan-vihreat' ); ?></h3>
          <p><?php esc_html_e( 'Osallistu kampanjointiin vaalien alla tai lähde mukaan talkooviikonloppuun. Tehdään yhdessä näkyviä tuloksia.', 'uudenmaan-vihreat' ); ?></p>
        </div>
      </div>
    </div>
  </section>

  <!-- Koulutus & materiaalit -->
  <section class="section section--grey" aria-labelledby="koulutus-heading">
    <div class="container">
      <h2 id="koulutus-heading"><?php esc_html_e( 'Koulutus & materiaalit', 'uudenmaan-vihreat' ); ?></h2>
      <p><?php esc_html_e( 'Tarjoamme jäsenille ja aktiiveille koulutuksia politiikasta, viestinnästä ja vaikuttamisesta.', 'uudenmaan-vihreat' ); ?></p>
      <div class="grid-3" style="margin-top:1.5rem;">
        <a class="card" href="https://opintokeskusvisio.fi/" target="_blank" rel="noopener noreferrer" style="text-decoration:none;">
          <div class="card__body">
            <h3 class="card__title" style="font-size:1.1rem;"><?php esc_html_e( 'Vihreä opintokeskus Visio', 'uudenmaan-vihreat' ); ?></h3>
            <p class="card__excerpt"><?php esc_html_e( 'Koulutuksia ja sivistystoimintaa Vihreiden arvojen pohjalta.', 'uudenmaan-vihreat' ); ?></p>
            <span class="card__link"><?php esc_html_e( 'Siirry sivustolle →', 'uudenmaan-vihreat' ); ?></span>
          </div>
        </a>
        <a class="card" href="https://app.skhole.fi/fi-FI/vihko?showDialog=register&token=8b09811a91585ab5" target="_blank" rel="noopener noreferrer" style="text-decoration:none;">
          <div class="card__body">
            <h3 class="card__title" style="font-size:1.1rem;"><?php esc_html_e( 'Uudenmaan koulutusalusta Vihko', 'uudenmaan-vihreat' ); ?></h3>
            <p class="card__excerpt"><?php esc_html_e( 'Uudenmaan Vihreiden oma koulutusalusta — rekisteröidy ja aloita.', 'uudenmaan-vihreat' ); ?></p>
            <span class="card__link"><?php esc_html_e( 'Avaa Vihko →', 'uudenmaan-vihreat' ); ?></span>
          </div>
        </a>
        <a class="card" href="<?php echo esc_url( uuvi_translated_url( 'tapahtumakalenteri' ) ); ?>" style="text-decoration:none;">
          <div class="card__body">
            <h3 class="card__title" style="font-size:1.1rem;"><?php echo esc_html( uuvi_translated_title( 'tapahtumakalenteri' ) ); ?></h3>
            <p class="card__excerpt"><?php esc_html_e( 'Tulevat tapahtumat, kokoukset ja koulutukset Uudellamaalla.', 'uudenmaan-vihreat' ); ?></p>
            <span class="card__link"><?php esc_html_e( 'Katso kalenteri →', 'uudenmaan-vihreat' ); ?></span>
          </div>
        </a>
      </div>
    </div>
  </section>

  <!-- Kiinnostaako ehdokkuus? -->
  <section class="section" aria-labelledby="ehdokkuus-heading">
    <div class="container">
      <div class="flex-row" style="gap:3rem;">
        <div style="flex:1;min-width:280px;">
          <img
            src="<?php echo esc_url( $pics . 'card-placeholder.jpg' ); ?>"
            alt=""
            loading="lazy"
            style="border-radius:8px;width:100%;aspect-ratio:3/2;object-fit:cover;"
          >
        </div>
        <div style="flex:1;min-width:280px;">
          <h2 id="ehdokkuus-heading"><?php esc_html_e( 'Kiinnostaako ehdokkuus?', 'uudenmaan-vihreat' ); ?></h2>
          <p class="ingress" style="margin-bottom:1.5rem;">
            <?php esc_html_e( 'Vihreät tarvitsee rohkeita ehdokkaita joka kunnasta. Sinulla on annettavaa — autamme sinut matkaan.', 'uudenmaan-vihreat' ); ?>
          </p>
          <a class="btn btn--primary" href="<?php echo esc_url( uuvi_translated_url( 'ehdolle-vaaleihin' ) ); ?>"><?php esc_html_e( 'Lähde ehdolle →', 'uudenmaan-vihreat' ); ?></a>
        </div>
      </div>
    </div>
  </section>

  <?php get_template_part( 'parts/cta-buttons' ); ?>

</main>
<?php get_footer(); ?>
