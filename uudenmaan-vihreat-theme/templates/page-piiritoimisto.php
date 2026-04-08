<?php
get_header();
if ( have_posts() ) the_post();
$img = get_template_directory_uri() . '/assets/images/';
?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1><?php echo esc_html( get_the_title() ); ?></h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">
        <?php esc_html_e( 'Piiritoimisto palvelee jäseniä, yhdistyksiä ja mediaa. Ota rohkeasti yhteyttä.', 'uudenmaan-vihreat' ); ?>
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
      $staff = uuvi_get_henkilot( [ 'Johto', 'Poliittiset sihteerit', 'Paikallisyhdistykset', 'Vaalityöntekijät' ] );
      if ( $staff ) : ?>
      <div class="staff-grid">
        <?php foreach ( $staff as $person ) :
            $has_photo = ! empty( $person['photo'] );
        ?>
          <div class="staff-card">
            <?php if ( $has_photo ) : ?>
              <img class="staff-card__photo" src="<?php echo esc_url( $person['photo'] ); ?>" alt="<?php echo esc_attr( $person['name'] ); ?>" loading="lazy">
            <?php else : ?>
              <div class="staff-card__photo staff-card__photo--placeholder" aria-hidden="true">👤</div>
            <?php endif; ?>
            <div class="staff-card__body">
              <span class="staff-card__group"><?php echo esc_html( $person['group'] ); ?></span>
              <p class="staff-card__name"><?php echo esc_html( $person['name'] ); ?></p>
              <p class="staff-card__role"><?php echo esc_html( $person['role'] ); ?></p>
              <div class="staff-card__contact">
                <?php if ( ! empty( $person['email'] ) ) : ?>
                  <a href="mailto:<?php echo esc_attr( $person['email'] ); ?>"><?php echo esc_html( $person['email'] ); ?></a>
                <?php endif; ?>
                <?php if ( ! empty( $person['phone'] ) ) : ?>
                  <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $person['phone'] ) ); ?>"><?php echo esc_html( $person['phone'] ); ?></a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <?php else : ?>
        <p style="color:#666;">Lisää henkilöstö wp-admin → Henkilöstö → Lisää uusi.</p>
      <?php endif; ?>


      <!-- Yleinen yhteystieto -->
      <div style="margin-top:3rem;padding:2rem;background:var(--color-grey);border-radius:8px;">
        <h2 style="font-size:1.25rem;margin-bottom:1rem;"><?php esc_html_e( 'Yleinen yhteystieto', 'uudenmaan-vihreat' ); ?></h2>
        <p><?php esc_html_e( 'Sähköposti', 'uudenmaan-vihreat' ); ?>: <a href="mailto:<?php echo esc_attr( get_theme_mod( 'uuvi_email', 'info@uudenmaanvihreat.fi' ) ); ?>"><?php echo esc_html( uuvi_mod( 'uuvi_email' ) ?: 'info@uudenmaanvihreat.fi' ); ?></a></p>
        <p style="margin-top:0.5rem;">
          <strong>Uudenmaan Vihreät ry</strong><br>
          <?php echo esc_html( uuvi_mod( 'uuvi_osoite' ) ?: 'Mannerheimintie 15b, A-porras, 4.krs' ); ?><br>
          <?php echo esc_html( uuvi_mod( 'uuvi_postiosoite' ) ?: '00260 Helsinki' ); ?>
        </p>
        <p style="margin-top:0.5rem;">Y-tunnus: <?php echo esc_html( uuvi_mod( 'uuvi_ytunnus' ) ?: '1087570-8' ); ?></p>
      </div>

      <!-- Laskutustiedot -->
      <div style="margin-top:2rem;padding:2rem;background:var(--color-grey);border-radius:8px;">
        <h2 style="font-size:1.25rem;margin-bottom:1rem;"><?php esc_html_e( 'Laskutustiedot', 'uudenmaan-vihreat' ); ?></h2>
        <p><strong>Uudenmaan Vihreät ry</strong><br><?php esc_html_e( 'Ostolaskujen vastaanotto', 'uudenmaan-vihreat' ); ?></p>
        <p style="margin-top:0.75rem;"><strong><?php esc_html_e( 'Verkkolasku', 'uudenmaan-vihreat' ); ?></strong><br>
          <?php esc_html_e( 'Verkkolaskuosoite', 'uudenmaan-vihreat' ); ?>: <?php echo esc_html( uuvi_mod( 'uuvi_verkkolasku_osoite' ) ?: '003710875708' ); ?><br>
          <?php esc_html_e( 'Välittäjä', 'uudenmaan-vihreat' ); ?>: <?php echo esc_html( uuvi_mod( 'uuvi_verkkolasku_valittaja' ) ?: '003708599126 (OpenText)' ); ?>
        </p>
        <p style="margin-top:0.75rem;"><strong><?php esc_html_e( 'Sähköposti', 'uudenmaan-vihreat' ); ?></strong><br>
          <a href="mailto:<?php echo esc_attr( get_theme_mod( 'uuvi_lasku_email', 'fennoa.507906@erin.posti.com' ) ); ?>"><?php echo esc_html( uuvi_mod( 'uuvi_lasku_email' ) ?: 'fennoa.507906@erin.posti.com' ); ?></a>
        </p>
        <p style="margin-top:0.75rem;"><strong><?php esc_html_e( 'Posti', 'uudenmaan-vihreat' ); ?></strong><br>
          <?php echo esc_html( uuvi_mod( 'uuvi_lasku_posti_nimi' ) ?: 'Uudenmaan Vihreät ry, Nylands Gröna rf' ); ?><br>
          <?php echo esc_html( uuvi_mod( 'uuvi_lasku_posti_pl' ) ?: 'PL 66712' ); ?><br>
          <?php echo esc_html( uuvi_mod( 'uuvi_lasku_posti_numero' ) ?: '01051 LASKUT' ); ?>
        </p>
      </div>

    </div>
  </section>
</main>
<?php get_footer(); ?>
