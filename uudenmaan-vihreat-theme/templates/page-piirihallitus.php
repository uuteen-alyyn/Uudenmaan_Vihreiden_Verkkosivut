<?php get_header(); if ( have_posts() ) the_post(); ?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1><?php echo esc_html( get_the_title() ); ?></h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">
        <?php esc_html_e( 'Piirihallitus vastaa Uudenmaan Vihreiden toiminnan johtamisesta yleiskokouksien välillä.', 'uudenmaan-vihreat' ); ?>
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


      <div class="grid-2" style="gap:3rem;align-items:start;">

        <!-- Hallitus -->
        <div>
          <h2><?php esc_html_e( 'Hallitus 2026', 'uudenmaan-vihreat' ); ?></h2>
          <ul class="member-list" style="columns:1;margin-top:1rem;">
            <li>Santeri Leinonen, Hyvinkää <span class="member-badge">PJ</span></li>
            <li>Teemu Ojanne, Myrskylä <span class="member-badge">VPJ</span></li>
            <li>Säde Heikinheimo, Vantaa</li>
            <li>Maija Linkola, Vantaa</li>
            <li>Marjo Hinkkala, Espoo</li>
            <li>Heidi Anttila, Vantaa</li>
            <li>Aarni Hyvönen, Kirkkonummi</li>
            <li>Rhea Lind, Espoo</li>
            <li>Daniela Metsäranta, Espoo</li>
            <li>Ismo Salonen, Vihti</li>
          </ul>

          <h2 style="margin-top:2rem;"><?php esc_html_e( 'Varajäsenet 2026', 'uudenmaan-vihreat' ); ?></h2>
          <p style="font-size:.85rem;color:#666;margin-bottom:.5rem;"><?php esc_html_e( 'Sisääntulojärjestyksessä', 'uudenmaan-vihreat' ); ?></p>
          <ul class="member-list" style="columns:1;">
            <li>Kari Laalo, Vantaa</li>
            <li>Riku Cajander, Kirkkonummi</li>
            <li>Erja Väyrynen, Vihti</li>
            <li>Börje Uimonen, Loviisa</li>
            <li>Hanna Valtanen, Vantaa</li>
            <li>Sanna Tuhkunen, Tuusula <span class="member-badge">VPJ</span></li>
          </ul>
        </div>

        <!-- Puoluetason edustajat -->
        <div>
          <h2><?php esc_html_e( 'Puoluehallituksen jäsenet', 'uudenmaan-vihreat' ); ?></h2>
          <p style="font-size:.85rem;color:#666;margin-bottom:.5rem;">2025–2027</p>
          <ul class="member-list" style="columns:1;margin-top:.5rem;">
            <li>Jarno Lappalainen</li>
            <li>Peppi Seppälä</li>
          </ul>

          <h2 style="margin-top:2rem;"><?php esc_html_e( 'Puoluevaltuusto', 'uudenmaan-vihreat' ); ?></h2>
          <p style="font-size:.85rem;color:#666;margin-bottom:.5rem;">2025–2027</p>
          <ul class="member-list" style="columns:1;margin-top:.5rem;">
            <li>Anu Kantola <span style="font-size:.8rem;color:#888;">(varalla: Cosmo Jenytin)</span></li>
            <li>Sanna Tilli <span style="font-size:.8rem;color:#888;">(varalla: Timo Huhta)</span></li>
            <li>Lennart Nybergh <span style="font-size:.8rem;color:#888;">(varalla: Satu Mali)</span></li>
            <li>Niko Kostia <span style="font-size:.8rem;color:#888;">(varalla: Jaana Carlenius)</span></li>
            <li>Mari Lotila <span style="font-size:.8rem;color:#888;">(Vihreät Naiset)</span></li>
          </ul>

          <h2 style="margin-top:2rem;"><?php esc_html_e( 'Piirin työalat', 'uudenmaan-vihreat' ); ?></h2>
          <div class="grid-2" style="gap:1rem;margin-top:1rem;">
            <div class="highlight-box" style="padding:1rem;">
              <h3 style="font-size:1rem;margin-bottom:0.4rem;"><?php esc_html_e( 'Koulutus', 'uudenmaan-vihreat' ); ?></h3>
              <p style="font-size:0.85rem;margin:0;">Daniela Metsäranta, Säde Heikinheimo, Teemu Ojanne</p>
            </div>
            <div class="highlight-box" style="padding:1rem;">
              <h3 style="font-size:1rem;margin-bottom:0.4rem;"><?php esc_html_e( 'Vaalit', 'uudenmaan-vihreat' ); ?></h3>
              <p style="font-size:0.85rem;margin:0;"><?php esc_html_e( 'Eduskuntavaaleihin asti vaalityöstä vastaa piirin vaalityöryhmä, puheenjohtaja Börje Uimonen.', 'uudenmaan-vihreat' ); ?></p>
            </div>
            <div class="highlight-box" style="padding:1rem;">
              <h3 style="font-size:1rem;margin-bottom:0.4rem;"><?php esc_html_e( 'Vapaaehtoiset', 'uudenmaan-vihreat' ); ?></h3>
              <p style="font-size:0.85rem;margin:0;">Marjo Hinkkala, Kari Laalo</p>
            </div>
            <div class="highlight-box" style="padding:1rem;">
              <h3 style="font-size:1rem;margin-bottom:0.4rem;"><?php esc_html_e( 'Politiikka', 'uudenmaan-vihreat' ); ?></h3>
              <p style="font-size:0.85rem;margin:0;">Sanna Tuhkunen, Heidi Anttila</p>
            </div>
          </div>

          <h2 style="margin-top:2rem;"><?php esc_html_e( 'Piirin vaalityöryhmä', 'uudenmaan-vihreat' ); ?></h2>
          <p style="font-size:0.9rem;margin-top:0.5rem;">Börje Uimonen (pj), Timo Lahti, Ismo Salonen, Martta Korpela, Pauliina Toveri, Sanna Tuhkunen, Säde Heikinheimo, Tapio Pesola, Teemu Ojanne</p>
        </div>

      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>
