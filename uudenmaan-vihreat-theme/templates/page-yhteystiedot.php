<?php get_header(); if ( have_posts() ) the_post(); ?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1>Yhteystiedot</h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">
        Löydä oikea henkilö tai ota yhteyttä piiriin — olemme täällä sinua varten.
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

      <div class="grid-2">
        <?php
        $linkit = [
            [ 'otsikko' => 'Meistä',           'teksti' => 'Piirin missio, hallinto ja dokumentit.',        'url' => home_url( '/meista/' ) ],
            [ 'otsikko' => 'Piiritoimisto',    'teksti' => 'Henkilökunta, puheenjohtaja ja yleinen osoite.', 'url' => home_url( '/yhteystiedot/piiritoimisto/' ) ],
            [ 'otsikko' => 'Piirihallitus',    'teksti' => 'Hallituksen jäsenet, varajäsenet ja työalat.',  'url' => home_url( '/yhteystiedot/piirihallitus/' ) ],
            [ 'otsikko' => 'Medialle',         'teksti' => 'Mediayhteyshenkilö, logot ja tiedotteet.',     'url' => home_url( '/medialle/' ) ],
            [ 'otsikko' => 'Kansanedustajamme','teksti' => 'Uudeltamaalta valitut Vihreiden kansanedustajat.', 'url' => home_url( '/yhteystiedot/kansanedustajat/' ) ],
        ];
        foreach ( $linkit as $linkki ) : ?>
          <a class="card" href="<?php echo esc_url( $linkki['url'] ); ?>" style="text-decoration:none;">
            <div class="card__body">
              <h2 class="card__title" style="font-size:1.3rem;"><?php echo esc_html( $linkki['otsikko'] ); ?></h2>
              <p class="card__excerpt"><?php echo esc_html( $linkki['teksti'] ); ?></p>
              <span class="card__link">Lue lisää →</span>
            </div>
          </a>
        <?php endforeach; ?>
      </div>

      <div style="margin-top:3rem;padding:2rem;background:var(--color-grey);border-radius:8px;">
        <h2>Yleinen yhteydenotto</h2>
        <p>Sähköposti: <a href="mailto:<?php echo esc_attr( get_theme_mod('uuvi_email','info@uudenmaanvihreat.fi') ); ?>"><?php echo uuvi_mod('uuvi_email') ?: 'info@uudenmaanvihreat.fi'; ?></a></p>
        <p>Postiosoite: Uudenmaan Vihreät ry, <?php echo uuvi_mod('uuvi_osoite') ?: 'Mannerheimintie 15b, A-porras, 4.krs'; ?>, <?php echo uuvi_mod('uuvi_postiosoite') ?: '00260 Helsinki'; ?></p>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>
