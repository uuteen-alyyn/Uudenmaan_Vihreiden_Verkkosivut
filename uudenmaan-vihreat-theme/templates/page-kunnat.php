<?php get_header(); if ( have_posts() ) the_post(); ?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1><?php esc_html_e( 'Kuntapolitiikka', 'uudenmaan-vihreat' ); ?></h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">
        <?php esc_html_e( 'Vihreät vaikuttavat ympäri Uudenmaan — valtuustoissa, lautakunnissa ja arjen päätöksissä.', 'uudenmaan-vihreat' ); ?>
      </p>
    </div>
  </div>
  <section class="section">
    <div class="container">

      <h2><?php esc_html_e( 'Kotikuntasi vihreät', 'uudenmaan-vihreat' ); ?></h2>

      <div class="kunnat-grid">
        <?php
        $kunnat = [
          [ 'kunta' => 'Askola',      'yhdistys' => 'Vihreä verkko',           'yh_url' => 'http://vihreaverkko.fi/',                          'yh_pj' => 'Jaakko Kyrö',             'yh_email' => 'jaakko.kyro@gmail.com',               'vr_pj' => 'Reija-Riikka Stenbäck',  'vr_email' => 'reija-riikka.stenback@askola.fi' ],
          [ 'kunta' => 'Espoo',       'yhdistys' => 'Espoon Vihreät',          'yh_url' => 'http://www.espoonvihreat.fi',                      'yh_pj' => 'Sofia Suomalainen',       'yh_email' => 'sofia.a.suomalainen@gmail.com',        'vr_pj' => 'Inka Hopsu',             'vr_email' => 'inka.hopsu@gmail.com' ],
          [ 'kunta' => 'Hanko',       'yhdistys' => 'Hangon Vihreät',          'yh_url' => 'https://yhdistykset.vihreat.fi/hangon.vihreat/',   'yh_pj' => 'Iina Ekroos',             'yh_email' => 'iina.ekroos@gmail.com',               'vr_pj' => 'Teemu Köppä',            'vr_email' => 'teemu.koppa@gmail.com' ],
          [ 'kunta' => 'Hyvinkää',    'yhdistys' => 'Hyvinkään Vihreät',       'yh_url' => 'https://hyvinkaanvihreat.fi/',                     'yh_pj' => 'Niko Kostia',             'yh_email' => 'puheenjohtaja@hyvinkaanvihreat.fi',    'vr_pj' => 'Terhi Korpela',          'vr_email' => 'terhi.korpela@hyvinkaanvihreat.fi' ],
          [ 'kunta' => 'Inkoo',       'yhdistys' => 'Inkoon Vihreät',          'yh_url' => 'https://www.inkoonvihreat.fi/',                    'yh_pj' => 'Maria Isoaho',            'yh_email' => '',                                    'vr_pj' => 'Elina Ahde',             'vr_email' => '' ],
          [ 'kunta' => 'Järvenpää',   'yhdistys' => 'Järvenpään Vihreät',      'yh_url' => 'https://www.jarvenpaanvihreat.fi/',                'yh_pj' => 'Ville Mustonen',          'yh_email' => 'villeseppoolavi@gmail.com',            'vr_pj' => 'Tiia Lintula',           'vr_email' => 'tiia.lintula@jarvenpaa.fi' ],
          [ 'kunta' => 'Karkkila',    'yhdistys' => 'Karkkilan Vihreät',       'yh_url' => 'https://www.karkkilanvihreat.fi/',                 'yh_pj' => 'Tiina Hentunen-Vanninen', 'yh_email' => '',                                    'vr_pj' => 'Heikki Savola',          'vr_email' => '' ],
          [ 'kunta' => 'Kauniainen',  'yhdistys' => 'Kauniaisten Vihreät',     'yh_url' => 'https://www.kauniaistenvihreat.fi/',               'yh_pj' => 'Johanna Niemi',           'yh_email' => '',                                    'vr_pj' => 'Juha Pesonen',           'vr_email' => 'juha.pesonen@kauniainen.fi' ],
          [ 'kunta' => 'Kerava',      'yhdistys' => 'Keravan Vihreät',         'yh_url' => 'https://www.keravanvihreat.fi/',                   'yh_pj' => 'Jaana Carlenius',         'yh_email' => 'jaana.carlenius@gmail.com',            'vr_pj' => 'Karoliina Kaarivirta',   'vr_email' => '' ],
          [ 'kunta' => 'Kirkkonummi', 'yhdistys' => 'Kirkkonummen Vihreät',    'yh_url' => 'https://www.kirkkonummenvihreat.fi/',              'yh_pj' => 'Lauri Lavanti',           'yh_email' => 'lauri.lavanti@kirkkonummi.fi',         'vr_pj' => 'Lauri Lavanti',          'vr_email' => 'lauri.lavanti@kirkkonummi.fi' ],
          [ 'kunta' => 'Lapinjärvi',  'yhdistys' => 'Loviisan seudun Vihreät', 'yh_url' => 'https://www.loviisanvihreat.fi/',                  'yh_pj' => 'Börje Uimonen',           'yh_email' => '',                                    'vr_pj' => 'Essi Rantapää',          'vr_email' => '' ],
          [ 'kunta' => 'Lohja',       'yhdistys' => 'Lohjan Vihreät',          'yh_url' => 'https://www.lohjanvihreat.fi/',                    'yh_pj' => 'Anne-Mari Vainio',        'yh_email' => 'lohjan.vihreat@gmail.com',             'vr_pj' => 'Laura Skaffari',         'vr_email' => '' ],
          [ 'kunta' => 'Loviisa',     'yhdistys' => 'Loviisan seudun Vihreät', 'yh_url' => 'https://www.loviisanvihreat.fi/',                  'yh_pj' => 'Börje Uimonen',           'yh_email' => '',                                    'vr_pj' => 'Timo Raivio',            'vr_email' => '' ],
          [ 'kunta' => 'Myrskylä',    'yhdistys' => 'Vihreä verkko',           'yh_url' => 'http://vihreaverkko.fi/',                          'yh_pj' => 'Jaakko Kyrö',             'yh_email' => 'jaakko.kyro@gmail.com',               'vr_pj' => 'Eeva Hava',              'vr_email' => 'eeva_hava@hotmail.com' ],
          [ 'kunta' => 'Mäntsälä',    'yhdistys' => 'Vihreä verkko',           'yh_url' => 'http://vihreaverkko.fi/',                          'yh_pj' => 'Jaakko Kyrö',             'yh_email' => 'jaakko.kyro@gmail.com',               'vr_pj' => 'Tuuli Särkijärvi',       'vr_email' => 'tuuli.sarkijarvi@gmail.com' ],
          [ 'kunta' => 'Nurmijärvi',  'yhdistys' => 'Nurmijärven Vihreät',     'yh_url' => 'http://www.nurmijarvenvihreat.fi/',                'yh_pj' => 'Leni Niinimäki',          'yh_email' => '',                                    'vr_pj' => 'Ville Virolainen',       'vr_email' => '' ],
          [ 'kunta' => 'Pornainen',   'yhdistys' => 'Vihreä verkko',           'yh_url' => 'http://vihreaverkko.fi/',                          'yh_pj' => 'Jaakko Kyrö',             'yh_email' => 'jaakko.kyro@gmail.com',               'vr_pj' => 'Mari Huusko',            'vr_email' => '' ],
          [ 'kunta' => 'Porvoo',      'yhdistys' => 'Porvoon Vihreät',         'yh_url' => 'https://www.porvoonvihreat.fi/',                   'yh_pj' => 'Saara Kekki',             'yh_email' => '',                                    'vr_pj' => 'Tuuli Hirvilammi',       'vr_email' => '' ],
          [ 'kunta' => 'Pukkila',     'yhdistys' => 'Vihreä verkko',           'yh_url' => 'http://vihreaverkko.fi/',                          'yh_pj' => 'Jaakko Kyrö',             'yh_email' => 'jaakko.kyro@gmail.com',               'vr_pj' => '',                       'vr_email' => '' ],
          [ 'kunta' => 'Raasepori',   'yhdistys' => 'Raaseporin Vihreät',      'yh_url' => 'https://yhdistykset.vihreat.fi/raaseporin.vihreat/', 'yh_pj' => 'Tanja Konttinen',       'yh_email' => '',                                    'vr_pj' => 'Kati Sointukangas',      'vr_email' => '' ],
          [ 'kunta' => 'Sipoo',       'yhdistys' => 'Sipoon Vihreät',          'yh_url' => 'https://www.sipoonvihreat.fi/',                    'yh_pj' => 'Harri Lehtonen',          'yh_email' => 'harri.lehtonen@sipoo.fi',              'vr_pj' => 'Jenni Sademies',         'vr_email' => '' ],
          [ 'kunta' => 'Siuntio',     'yhdistys' => 'Siuntion Vihreät',        'yh_url' => 'https://www.siuntionvihreat.fi/',                  'yh_pj' => 'Mark Davidson',           'yh_email' => '',                                    'vr_pj' => 'Kristian von Essen',     'vr_email' => '' ],
          [ 'kunta' => 'Tuusula',     'yhdistys' => 'Tuusulan Vihreät',        'yh_url' => 'http://www.tuusulanvihreat.fi/',                   'yh_pj' => 'Sini Riihimäki',          'yh_email' => 'sini.riihimaki@outlook.com',           'vr_pj' => 'Jenna Jourio',           'vr_email' => '' ],
          [ 'kunta' => 'Vantaa',      'yhdistys' => 'Vantaan Vihreät',         'yh_url' => 'https://www.vavi.fi/',                             'yh_pj' => 'Minna Kuusela',           'yh_email' => 'minna.kuusela@vantaanvihreat.fi',      'vr_pj' => 'Tia Tipu Seppänen',      'vr_email' => '' ],
          [ 'kunta' => 'Vihti',       'yhdistys' => 'Vihdin Vihreät',          'yh_url' => 'https://yhdistykset.vihreat.fi/vihdin.vihreat/',   'yh_pj' => 'Erja Väyrynen',           'yh_email' => '',                                    'vr_pj' => 'Ida Välimaa',            'vr_email' => '' ],
        ];
        foreach ( $kunnat as $k ) : ?>
        <div class="kunta-card">
          <h3 class="kunta-card__name"><?php echo esc_html( $k['kunta'] ); ?></h3>
          <p class="kunta-card__yhdistys"><?php echo esc_html( $k['yhdistys'] ); ?></p>
          <dl class="kunta-card__contacts">
            <dt><?php esc_html_e( 'Yhdistyksen pj', 'uudenmaan-vihreat' ); ?></dt>
            <dd><?php echo esc_html( $k['yh_pj'] ); ?>
              <?php if ( $k['yh_email'] ) : ?><br><a href="mailto:<?php echo esc_attr( $k['yh_email'] ); ?>"><?php echo esc_html( $k['yh_email'] ); ?></a><?php endif; ?>
            </dd>
            <?php if ( $k['vr_pj'] ) : ?>
            <dt><?php esc_html_e( 'Valtuustoryhmän pj', 'uudenmaan-vihreat' ); ?></dt>
            <dd><?php echo esc_html( $k['vr_pj'] ); ?>
              <?php if ( $k['vr_email'] ) : ?><br><a href="mailto:<?php echo esc_attr( $k['vr_email'] ); ?>"><?php echo esc_html( $k['vr_email'] ); ?></a><?php endif; ?>
            </dd>
            <?php endif; ?>
          </dl>
          <?php if ( $k['yh_url'] ) : ?>
          <p class="kunta-card__link">
            <a href="<?php echo esc_url( $k['yh_url'] ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Yhdistyksen sivut →', 'uudenmaan-vihreat' ); ?></a>
          </p>
          <?php endif; ?>
        </div>
        <?php endforeach; ?>
      </div>

    </div>
  </section>
</main>
<?php get_footer(); ?>
