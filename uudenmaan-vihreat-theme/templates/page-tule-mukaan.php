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
      <h2 id="naain-heading">Näin pääset mukaan</h2>
      <div class="steps gap-top">
        <div class="step">
          <span class="step__number" aria-hidden="true">1</span>
          <div class="step__body">
            <h3>Osallistu tapahtumiin</h3>
            <p>Kokous, koulutus tai kahvitilaisuus — tervetuloa sellaisena kuin olet.</p>
          </div>
        </div>
        <div class="step">
          <span class="step__number" aria-hidden="true">2</span>
          <div class="step__body">
            <h3>Ilmoittaudu vapaaehtoiseksi</h3>
            <p>Tule mukaan kampanjointiin, tapahtumiin tai kertomaan mielipiteesi politiikasta.</p>
          </div>
        </div>
        <div class="step">
          <span class="step__number" aria-hidden="true">3</span>
          <div class="step__body">
            <h3>Liity jäseneksi</h3>
            <p>Jäsenyys on helppo tapa tukea vihreää politiikkaa ja saada äänesi kuuluviin.</p>
          </div>
        </div>
      </div>
      <p style="margin-top:2rem;">
        <a class="btn btn--primary" href="https://www.vihreat.fi/liity/" target="_blank" rel="noopener noreferrer">Liity jäseneksi →</a>
      </p>
    </div>
  </section>

  <!-- Mitä voin tehdä? -->
  <section class="section" aria-labelledby="mita-heading">
    <div class="container">
      <div class="section-header section-header--center">
        <h2 id="mita-heading">Mitä voin tehdä?</h2>
        <p>Jokainen panos on arvokas — valitse sinulle sopiva tapa.</p>
      </div>
      <div class="grid-3">
        <div class="time-card">
          <span class="time-card__label">30 minuuttia</span>
          <h3>Pienet teot</h3>
          <p>Jaa julkaisu somessa, allekirjoita vetoomus tai ota yhteyttä kansanedustajaan. Pienetkin teot merkitsevät.</p>
        </div>
        <div class="time-card">
          <span class="time-card__label">2 tuntia</span>
          <h3>Tule tapahtumaan</h3>
          <p>Tule mukaan tapahtumaan tai kokoukseen, puhu vihreästä politiikasta tai jaa ehdokkaasi esitteitä naapuruston postilaatikkoon. Yhdessä olemme enemmän.</p>
        </div>
        <div class="time-card">
          <span class="time-card__label">2 päivää</span>
          <h3>Talkoot</h3>
          <p>Osallistu kampanjointiin vaalien alla tai lähde mukaan talkooviikonloppuun. Tehdään yhdessä näkyviä tuloksia.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Koulutus & materiaalit -->
  <section class="section section--grey" aria-labelledby="koulutus-heading">
    <div class="container">
      <h2 id="koulutus-heading">Koulutus &amp; materiaalit</h2>
      <p>Tarjoamme jäsenille ja aktiiveille koulutuksia politiikasta, viestinnästä ja vaikuttamisesta.</p>
      <div class="grid-3" style="margin-top:1.5rem;">
        <a class="card" href="https://opintokeskusvisio.fi/" target="_blank" rel="noopener noreferrer" style="text-decoration:none;">
          <div class="card__body">
            <h3 class="card__title" style="font-size:1.1rem;">Vihreä opintokeskus Visio</h3>
            <p class="card__excerpt">Koulutuksia ja sivistystoimintaa Vihreiden arvojen pohjalta.</p>
            <span class="card__link">Siirry sivustolle →</span>
          </div>
        </a>
        <a class="card" href="https://app.skhole.fi/fi-FI/vihko?showDialog=register&token=8b09811a91585ab5" target="_blank" rel="noopener noreferrer" style="text-decoration:none;">
          <div class="card__body">
            <h3 class="card__title" style="font-size:1.1rem;">Uudenmaan koulutusalusta Vihko</h3>
            <p class="card__excerpt">Uudenmaan Vihreiden oma koulutusalusta — rekisteröidy ja aloita.</p>
            <span class="card__link">Avaa Vihko →</span>
          </div>
        </a>
        <a class="card" href="<?php echo esc_url( home_url( '/tapahtumakalenteri/' ) ); ?>" style="text-decoration:none;">
          <div class="card__body">
            <h3 class="card__title" style="font-size:1.1rem;">Tapahtumakalenteri</h3>
            <p class="card__excerpt">Tulevat tapahtumat, kokoukset ja koulutukset Uudellamaalla.</p>
            <span class="card__link">Katso kalenteri →</span>
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
            alt="Ryhmä vihreistä aktiiveista"
            loading="lazy"
            style="border-radius:8px;width:100%;aspect-ratio:3/2;object-fit:cover;"
          >
        </div>
        <div style="flex:1;min-width:280px;">
          <h2 id="ehdokkuus-heading">Kiinnostaako ehdokkuus?</h2>
          <p class="ingress" style="margin-bottom:1.5rem;">
            Vihreät tarvitsee rohkeita ehdokkaita joka kunnasta. Sinulla on annettavaa — autamme sinut matkaan.
          </p>
          <a class="btn btn--primary" href="<?php echo esc_url( home_url( '/vaalit/ehdolle-vaaleihin/' ) ); ?>">Lähde ehdolle →</a>
        </div>
      </div>
    </div>
  </section>

  <?php get_template_part( 'parts/cta-buttons' ); ?>

</main>
<?php get_footer(); ?>
