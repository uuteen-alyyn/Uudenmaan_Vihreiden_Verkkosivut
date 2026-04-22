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

      <div class="footer-col">
        <h3><?php esc_html_e( 'Sivusto', 'uudenmaan-vihreat' ); ?></h3>
        <ul>
          <li><a href="<?php echo esc_url( function_exists( 'pll_home_url' ) ? pll_home_url() : home_url( '/' ) ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></li>
          <li><a href="<?php echo esc_url( uuvi_translated_url( 'ajankohtaista' ) ); ?>"><?php echo esc_html( uuvi_translated_title( 'ajankohtaista' ) ); ?></a></li>
          <li><a href="<?php echo esc_url( uuvi_translated_url( 'tule-mukaan' ) ); ?>"><?php echo esc_html( uuvi_translated_title( 'tule-mukaan' ) ); ?></a></li>
          <li><a href="<?php echo esc_url( uuvi_translated_url( 'vaalit' ) ); ?>"><?php echo esc_html( uuvi_translated_title( 'vaalit' ) ); ?></a></li>
          <li><a href="<?php echo esc_url( uuvi_translated_url( 'hyvinvointialueet' ) ); ?>"><?php echo esc_html( uuvi_translated_title( 'hyvinvointialueet' ) ); ?></a></li>
          <li><a href="<?php echo esc_url( uuvi_translated_url( 'medialle' ) ); ?>"><?php echo esc_html( uuvi_translated_title( 'medialle' ) ); ?></a></li>
          <li><a href="<?php echo esc_url( uuvi_translated_url( 'yhteystiedot' ) ); ?>"><?php echo esc_html( uuvi_translated_title( 'yhteystiedot' ) ); ?></a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="footer-col">
        <h3><?php esc_html_e( 'Yhteystiedot', 'uudenmaan-vihreat' ); ?></h3>
        <ul>
          <li><a href="mailto:info@uudenmaanvihreat.fi">info@uudenmaanvihreat.fi</a></li>
        </ul>
        <?php
        $facebook  = get_theme_mod( 'uuvi_social_facebook',  'https://www.facebook.com/uudenmaanvihreat' );
        $instagram = get_theme_mod( 'uuvi_social_instagram', 'https://www.instagram.com/uudenmaanvihreat/' );
        if ( $facebook || $instagram ) :
        ?>
        <h3 style="margin-top:1.25rem;"><?php esc_html_e( 'Seuraa meitä', 'uudenmaan-vihreat' ); ?></h3>
        <ul>
          <?php if ( $facebook ) : ?>
          <li><a href="<?php echo esc_url( $facebook ); ?>" rel="noopener noreferrer" target="_blank">Facebook</a></li>
          <?php endif; ?>
          <?php if ( $instagram ) : ?>
          <li><a href="<?php echo esc_url( $instagram ); ?>" rel="noopener noreferrer" target="_blank">Instagram</a></li>
          <?php endif; ?>
        </ul>
        <?php endif; ?>
      </div>

    </div><!-- .footer-grid -->

    <div class="footer-bottom">
      <span>© <span class="js-current-year"><?php echo esc_html( date( 'Y' ) ); ?></span> Uudenmaan Vihreät ry</span>
      <span style="color:rgba(255,255,255,.45);font-size:.8rem;">Kuvat: Reima Kuukka; Kansanedustajien kuvat Eduskunta</span>
      <span>
        <a href="<?php echo esc_url( uuvi_translated_url( 'tietosuoja' ) ); ?>"><?php esc_html_e( 'Tietosuojaseloste →', 'uudenmaan-vihreat' ); ?></a>
        &nbsp;·&nbsp;
        <a href="<?php echo esc_url( home_url( '/saavutettavuus/' ) ); ?>">Saavutettavuusseloste</a>
      </span>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
