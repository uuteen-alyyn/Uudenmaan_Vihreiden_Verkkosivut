<?php
/**
 * CTA buttons strip — used on homepage and other pages.
 */
?>
<section class="cta-strip" aria-labelledby="cta-heading">
  <div class="container">
    <h2 id="cta-heading">Lähde mukaan</h2>
    <p>Jokainen vihreä teko merkitsee — löydä oma tapasi vaikuttaa.</p>
    <div class="cta-buttons">
      <a class="btn btn--white" href="https://www.vihreat.fi/liity/" target="_blank" rel="noopener noreferrer">
        Liity jäseneksi
      </a>
      <a class="btn btn--ghost-white" href="https://www.vihreat.fi/lahjoita/" target="_blank" rel="noopener noreferrer">
        Lahjoita
      </a>
      <a class="btn btn--ghost-white" href="<?php echo esc_url( home_url( '/vaalit/ehdolle-vaaleihin/' ) ); ?>">
        Lähde ehdolle
      </a>
    </div>
  </div>
</section>
