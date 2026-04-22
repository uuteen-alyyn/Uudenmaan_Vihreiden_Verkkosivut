<?php get_header(); if ( have_posts() ) the_post(); ?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1><?php echo esc_html( get_the_title() ); ?></h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">
        <?php esc_html_e( 'Löydä oikea henkilö tai ota yhteyttä piiriin — olemme täällä sinua varten.', 'uudenmaan-vihreat' ); ?>
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
        $cards = [
            [ 'slug' => 'meista',          'desc' => __( 'Piirin missio, hallinto ja dokumentit.', 'uudenmaan-vihreat' ) ],
            [ 'slug' => 'piiritoimisto',   'desc' => __( 'Henkilökunta, puheenjohtaja ja yleinen osoite.', 'uudenmaan-vihreat' ) ],
            [ 'slug' => 'piirihallitus',   'desc' => __( 'Hallituksen jäsenet, varajäsenet ja työalat.', 'uudenmaan-vihreat' ) ],
            [ 'slug' => 'medialle',        'desc' => __( 'Mediayhteyshenkilö, logot ja tiedotteet.', 'uudenmaan-vihreat' ) ],
            [ 'slug' => 'kansanedustajat', 'desc' => __( 'Uudeltamaalta valitut Vihreiden kansanedustajat.', 'uudenmaan-vihreat' ) ],
        ];
        foreach ( $cards as $card ) :
            $url   = uuvi_translated_url( $card['slug'] );
            $title = uuvi_translated_title( $card['slug'] );
        ?>
          <a class="card" href="<?php echo esc_url( $url ); ?>" style="text-decoration:none;">
            <div class="card__body">
              <h2 class="card__title" style="font-size:1.3rem;"><?php echo esc_html( $title ); ?></h2>
              <p class="card__excerpt"><?php echo esc_html( $card['desc'] ); ?></p>
              <span class="card__link"><?php esc_html_e( 'Lue lisää →', 'uudenmaan-vihreat' ); ?></span>
            </div>
          </a>
        <?php endforeach; ?>
      </div>

      <div style="margin-top:3rem;padding:2rem;background:var(--color-grey);border-radius:8px;">
        <h2><?php esc_html_e( 'Yleinen yhteydenotto', 'uudenmaan-vihreat' ); ?></h2>
        <p><?php esc_html_e( 'Sähköposti', 'uudenmaan-vihreat' ); ?>: <a href="mailto:<?php echo esc_attr( get_theme_mod('uuvi_email','info@uudenmaanvihreat.fi') ); ?>"><?php echo esc_html( uuvi_mod('uuvi_email') ?: 'info@uudenmaanvihreat.fi' ); ?></a></p>
        <p><?php esc_html_e( 'Postiosoite', 'uudenmaan-vihreat' ); ?>: Uudenmaan Vihreät ry, <?php echo esc_html( uuvi_mod('uuvi_osoite') ?: 'Mannerheimintie 15b, A-porras, 4.krs' ); ?>, <?php echo esc_html( uuvi_mod('uuvi_postiosoite') ?: '00260 Helsinki' ); ?></p>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>
