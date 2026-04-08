<footer class="site-footer" role="contentinfo">
  <div class="container">
    <div class="footer-grid">

      <!-- Branding -->
      <div class="footer-col">
        <img
          class="footer-logo"
          src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo/Vihreat_Logo_HOR_NEG_FIN_SWE.png' ); ?>"
          alt="<?php bloginfo( 'name' ); ?>"
          width="200"
          height="48"
          loading="lazy"
        >
        <p style="color:rgba(255,255,255,.7);font-size:.9rem;line-height:1.5;">
          Uudenmaan Vihreät ry<br>
          Mannerheimintie 15b, A-porras, 4.krs<br>
          00260 Helsinki
        </p>
        <p style="color:rgba(255,255,255,.5);font-size:.8rem;margin-top:.75rem;">
          Y-tunnus: 1087570-8
        </p>
      </div>

      <!-- Quick links -->
      <div class="footer-col">
        <h3><?php esc_html_e( 'Sivusto', 'uudenmaan-vihreat' ); ?></h3>
        <ul>
          <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Etusivu</a></li>
          <li><a href="<?php echo esc_url( home_url( '/ajankohtaista/' ) ); ?>">Ajankohtaista</a></li>
          <li><a href="<?php echo esc_url( home_url( '/tule-mukaan/' ) ); ?>">Tule mukaan</a></li>
          <li><a href="<?php echo esc_url( home_url( '/vaalit/' ) ); ?>">Vaalit</a></li>
          <li><a href="<?php echo esc_url( home_url( '/hyvinvointialueet/' ) ); ?>">Hyvinvointialueet</a></li>
          <li><a href="<?php echo esc_url( home_url( '/medialle/' ) ); ?>">Medialle</a></li>
          <li><a href="<?php echo esc_url( home_url( '/yhteystiedot/' ) ); ?>">Yhteystiedot</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="footer-col">
        <h3><?php esc_html_e( 'Yhteystiedot', 'uudenmaan-vihreat' ); ?></h3>
        <ul>
          <li><a href="mailto:info@uudenmaanvihreat.fi">info@uudenmaanvihreat.fi</a></li>
        </ul>
        <h3 style="margin-top:1.25rem;"><?php esc_html_e( 'Seuraa meitä', 'uudenmaan-vihreat' ); ?></h3>
        <ul>
          <li><a href="[Facebook-URL tähän]" rel="noopener noreferrer" target="_blank">Facebook</a></li>
          <li><a href="[Instagram-URL tähän]" rel="noopener noreferrer" target="_blank">Instagram</a></li>
          <li><a href="[X-URL tähän]" rel="noopener noreferrer" target="_blank">X (Twitter)</a></li>
        </ul>
      </div>

    </div><!-- .footer-grid -->

    <div class="footer-bottom">
      <span>© <span class="js-current-year"><?php echo esc_html( date( 'Y' ) ); ?></span> Uudenmaan Vihreät ry</span>
      <span style="color:rgba(255,255,255,.45);font-size:.8rem;">Kuvat: Reima Kuukka; Kansanedustajien kuvat Eduskunta</span>
      <span>
        <a href="[Tietosuoja-linkki tähän]">Tietosuojaseloste</a>
        &nbsp;·&nbsp;
        <a href="<?php echo esc_url( home_url( '/saavutettavuus/' ) ); ?>">Saavutettavuusseloste</a>
      </span>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
