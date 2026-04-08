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
        // FI page IDs → card descriptions
        $alueet = [
            [ 'fi_id' => 18, 'desc' => __( 'Vihreät Länsi-Uudenmaan hyvinvointialueella.', 'uudenmaan-vihreat' ) ],
            [ 'fi_id' => 19, 'desc' => __( 'Vihreät Keski-Uudenmaan hyvinvointialueella.', 'uudenmaan-vihreat' ) ],
            [ 'fi_id' => 20, 'desc' => __( 'Vihreät Itä-Uudenmaan hyvinvointialueella.', 'uudenmaan-vihreat' ) ],
            [ 'fi_id' => 21, 'desc' => __( 'Vihreät Vantaa–Keravan hyvinvointialueella.', 'uudenmaan-vihreat' ) ],
            [ 'fi_id' => 22, 'desc' => __( 'Vihreät HUS-alueella ja maakunnallisissa luottamustoimissa.', 'uudenmaan-vihreat' ) ],
            [ 'fi_id' => 23, 'desc' => __( 'Paikallisyhdistykset ja kuntavaikuttaminen.', 'uudenmaan-vihreat' ) ],
        ];
        foreach ( $alueet as $alue ) :
            $url   = uuvi_translated_url( $alue['fi_id'] );
            $title = uuvi_translated_title( $alue['fi_id'] );
        ?>
          <a class="region-card" href="<?php echo esc_url( $url ); ?>">
            <h3><?php echo esc_html( $title ); ?></h3>
            <p><?php echo esc_html( $alue['desc'] ); ?></p>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>
