<?php
/**
 * CTA buttons strip — used on homepage and other pages.
 */
?>
<section class="cta-strip" aria-labelledby="cta-heading">
  <div class="container">
    <h2 id="cta-heading"><?php esc_html_e( 'Lähde mukaan', 'uudenmaan-vihreat' ); ?></h2>
    <p><?php esc_html_e( 'Jokainen vihreä teko merkitsee — löydä oma tapasi vaikuttaa.', 'uudenmaan-vihreat' ); ?></p>
    <div class="cta-buttons">
      <a class="btn btn--white" href="https://www.vihreat.fi/liity/" target="_blank" rel="noopener noreferrer">
        <?php esc_html_e( 'Liity jäseneksi', 'uudenmaan-vihreat' ); ?>
      </a>
      <a class="btn btn--ghost-white" href="https://www.vihreat.fi/lahjoita/" target="_blank" rel="noopener noreferrer">
        <?php esc_html_e( 'Lahjoita', 'uudenmaan-vihreat' ); ?>
      </a>
      <a class="btn btn--ghost-white" href="<?php echo esc_url( uuvi_translated_url( 17 ) ); ?>">
        <?php esc_html_e( 'Lähde ehdolle', 'uudenmaan-vihreat' ); ?>
      </a>
    </div>
  </div>
</section>
