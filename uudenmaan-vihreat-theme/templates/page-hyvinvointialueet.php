<?php get_header(); if ( have_posts() ) the_post(); ?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1><?php echo esc_html( get_the_title() ); ?></h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">
        <?php esc_html_e( 'Uusimaa jakautuu neljään hyvinvointialueeseen. Vihreät vaikuttavat jokaisella alueella. Lisäksi toimimme kunnissa, HUS:ssa ja erilaisissa alueellisissa luottamustehtävissä.', 'uudenmaan-vihreat' ); ?>
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

      <div class="grid-3">
        <?php
        $alueet = [
            [ 'nimi' => 'Länsi-Uusimaa',                   'slug' => 'lansi-uusimaa',          'kuvaus' => 'Vihreät Länsi-Uudenmaan hyvinvointialueella.' ],
            [ 'nimi' => 'Keski-Uusimaa',                   'slug' => 'keski-uusimaa',           'kuvaus' => 'Vihreät Keski-Uudenmaan hyvinvointialueella.' ],
            [ 'nimi' => 'Itä-Uusimaa',                     'slug' => 'ita-uusimaa',             'kuvaus' => 'Vihreät Itä-Uudenmaan hyvinvointialueella.' ],
            [ 'nimi' => 'Vantaa–Kerava',                   'slug' => 'vantaa-kerava',           'kuvaus' => 'Vihreät Vantaa–Keravan hyvinvointialueella.' ],
            [ 'nimi' => 'HUS ja maakunnalliset luottamustoimet', 'slug' => 'hus-ja-maakunnalliset', 'kuvaus' => 'Vihreät HUS-alueella ja maakunnallisissa luottamustoimissa.' ],
            [ 'nimi' => 'Kuntapolitiikka',                 'slug' => 'kunnat',                  'kuvaus' => 'Paikallisyhdistykset ja kuntavaikuttaminen.' ],
        ];
        foreach ( $alueet as $alue ) :
            $url = home_url( '/hyvinvointialueet/' . $alue['slug'] . '/' );
        ?>
          <a class="region-card" href="<?php echo esc_url( $url ); ?>">
            <h3><?php echo esc_html( $alue['nimi'] ); ?></h3>
            <p><?php echo esc_html( $alue['kuvaus'] ); ?></p>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>
