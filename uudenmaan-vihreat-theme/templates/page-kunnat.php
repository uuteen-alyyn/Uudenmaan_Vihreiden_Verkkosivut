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
        $is_sv = function_exists( 'pll_current_language' ) && pll_current_language() === 'sv';

        // kunta_sv = viralllinen ruotsinkielinen nimi; jos tyhjä, käytetään suomenkielistä
        // Yhdistysnimet: virallinen rekisterinimi yleiskokoustaulukon mukaan
        $kunnat = [
          [ 'kunta' => 'Askola',      'kunta_sv' => '',           'yhdistys' => 'Vihreä Verkko ry',                                     'yh_url' => 'http://vihreaverkko.fi/',                            'yh_pj' => 'Jaakko Kyrö',             'yh_email' => 'jaakko.kyro@gmail.com',               'vr_pj' => 'Reija-Riikka Stenbäck',  'vr_email' => 'reija-riikka.stenback@askola.fi' ],
          [ 'kunta' => 'Espoo',       'kunta_sv' => 'Esbo',       'yhdistys' => 'Espoon Vihreät ry, De Gröna i Esbo rf',               'yh_url' => 'http://www.espoonvihreat.fi',                        'yh_pj' => 'Sofia Suomalainen',       'yh_email' => 'sofia.a.suomalainen@gmail.com',        'vr_pj' => 'Inka Hopsu',             'vr_email' => 'inka.hopsu@gmail.com' ],
          [ 'kunta' => 'Hanko',       'kunta_sv' => 'Hangö',      'yhdistys' => 'Hangon Vihreät – Hangö Gröna ry',                     'yh_url' => 'https://yhdistykset.vihreat.fi/hangon.vihreat/',     'yh_pj' => 'Iina Ekroos',             'yh_email' => 'iina.ekroos@gmail.com',               'vr_pj' => 'Teemu Köppä',            'vr_email' => 'teemu.koppa@gmail.com' ],
          [ 'kunta' => 'Hyvinkää',    'kunta_sv' => 'Hyvinge',    'yhdistys' => 'Hyvinkään Vihreät',                                   'yh_url' => 'https://hyvinkaanvihreat.fi/',                       'yh_pj' => 'Niko Kostia',             'yh_email' => 'puheenjohtaja@hyvinkaanvihreat.fi',    'vr_pj' => 'Terhi Korpela',          'vr_email' => 'terhi.korpela@hyvinkaanvihreat.fi' ],
          [ 'kunta' => 'Inkoo',       'kunta_sv' => 'Ingå',       'yhdistys' => 'Inkoon Vihreät ry, De Gröna i Ingå rf',              'yh_url' => 'https://www.inkoonvihreat.fi/',                      'yh_pj' => 'Maria Isoaho',            'yh_email' => '',                                    'vr_pj' => 'Elina Ahde',             'vr_email' => '' ],
          [ 'kunta' => 'Järvenpää',   'kunta_sv' => 'Träskända',  'yhdistys' => 'Järvenpään Vihreät ry',                               'yh_url' => 'https://www.jarvenpaanvihreat.fi/',                  'yh_pj' => 'Ville Mustonen',          'yh_email' => 'villeseppoolavi@gmail.com',            'vr_pj' => 'Tiia Lintula',           'vr_email' => 'tiia.lintula@jarvenpaa.fi' ],
          [ 'kunta' => 'Karkkila',    'kunta_sv' => 'Högfors',    'yhdistys' => 'Karkkilan Vihreät ry',                                'yh_url' => 'https://www.karkkilanvihreat.fi/',                   'yh_pj' => 'Tiina Hentunen-Vanninen', 'yh_email' => '',                                    'vr_pj' => 'Heikki Savola',          'vr_email' => '' ],
          [ 'kunta' => 'Kauniainen',  'kunta_sv' => 'Grankulla',  'yhdistys' => 'Kauniaisten Vihreät – De Gröna i Grankulla ry',      'yh_url' => 'https://www.kauniaistenvihreat.fi/',                 'yh_pj' => 'Johanna Niemi',           'yh_email' => '',                                    'vr_pj' => 'Juha Pesonen',           'vr_email' => 'juha.pesonen@kauniainen.fi' ],
          [ 'kunta' => 'Kerava',      'kunta_sv' => 'Kervo',      'yhdistys' => 'Keravan Vihreät ry',                                  'yh_url' => 'https://www.keravanvihreat.fi/',                     'yh_pj' => 'Jaana Carlenius',         'yh_email' => 'jaana.carlenius@gmail.com',            'vr_pj' => 'Karoliina Kaarivirta',   'vr_email' => '' ],
          [ 'kunta' => 'Kirkkonummi', 'kunta_sv' => 'Kyrkslätt',  'yhdistys' => 'Kirkkonummen Vihreät ry, De Gröna i Kyrkslätt rf',   'yh_url' => 'https://www.kirkkonummenvihreat.fi/',                'yh_pj' => 'Lauri Lavanti',           'yh_email' => 'lauri.lavanti@kirkkonummi.fi',         'vr_pj' => 'Lauri Lavanti',          'vr_email' => 'lauri.lavanti@kirkkonummi.fi' ],
          [ 'kunta' => 'Lapinjärvi',  'kunta_sv' => 'Lappträsk',  'yhdistys' => 'Loviisan seudun vihreät ry, De gröna i Lovisanejden rf', 'yh_url' => 'https://www.loviisanvihreat.fi/',                'yh_pj' => 'Börje Uimonen',           'yh_email' => '',                                    'vr_pj' => 'Essi Rantapää',          'vr_email' => '' ],
          [ 'kunta' => 'Lohja',       'kunta_sv' => 'Lojo',       'yhdistys' => 'Lohjan Vihreät ry',                                   'yh_url' => 'https://www.lohjanvihreat.fi/',                      'yh_pj' => 'Anne-Mari Vainio',        'yh_email' => 'lohjan.vihreat@gmail.com',             'vr_pj' => 'Laura Skaffari',         'vr_email' => '' ],
          [ 'kunta' => 'Loviisa',     'kunta_sv' => 'Lovisa',     'yhdistys' => 'Loviisan seudun vihreät ry, De gröna i Lovisanejden rf', 'yh_url' => 'https://www.loviisanvihreat.fi/',                'yh_pj' => 'Börje Uimonen',           'yh_email' => '',                                    'vr_pj' => 'Timo Raivio',            'vr_email' => '' ],
          [ 'kunta' => 'Myrskylä',    'kunta_sv' => 'Mörskom',    'yhdistys' => 'Vihreä Verkko ry',                                     'yh_url' => 'http://vihreaverkko.fi/',                            'yh_pj' => 'Jaakko Kyrö',             'yh_email' => 'jaakko.kyro@gmail.com',               'vr_pj' => 'Eeva Hava',              'vr_email' => 'eeva_hava@hotmail.com' ],
          [ 'kunta' => 'Mäntsälä',    'kunta_sv' => '',           'yhdistys' => 'Vihreä Verkko ry',                                     'yh_url' => 'http://vihreaverkko.fi/',                            'yh_pj' => 'Jaakko Kyrö',             'yh_email' => 'jaakko.kyro@gmail.com',               'vr_pj' => 'Tuuli Särkijärvi',       'vr_email' => 'tuuli.sarkijarvi@gmail.com' ],
          [ 'kunta' => 'Nurmijärvi',  'kunta_sv' => '',           'yhdistys' => 'Nurmijärven vihreät ry',                              'yh_url' => 'http://www.nurmijarvenvihreat.fi/',                  'yh_pj' => 'Leni Niinimäki',          'yh_email' => '',                                    'vr_pj' => 'Ville Virolainen',       'vr_email' => '' ],
          [ 'kunta' => 'Pornainen',   'kunta_sv' => 'Borgnäs',    'yhdistys' => 'Vihreä Verkko ry',                                     'yh_url' => 'http://vihreaverkko.fi/',                            'yh_pj' => 'Jaakko Kyrö',             'yh_email' => 'jaakko.kyro@gmail.com',               'vr_pj' => 'Mari Huusko',            'vr_email' => '' ],
          [ 'kunta' => 'Porvoo',      'kunta_sv' => 'Borgå',      'yhdistys' => 'Porvoon Vihreät – De Gröna i Borgå',                  'yh_url' => 'https://www.porvoonvihreat.fi/',                     'yh_pj' => 'Saara Kekki',             'yh_email' => '',                                    'vr_pj' => 'Tuuli Hirvilammi',       'vr_email' => '' ],
          [ 'kunta' => 'Pukkila',     'kunta_sv' => '',           'yhdistys' => 'Vihreä Verkko ry',                                     'yh_url' => 'http://vihreaverkko.fi/',                            'yh_pj' => 'Jaakko Kyrö',             'yh_email' => 'jaakko.kyro@gmail.com',               'vr_pj' => '',                       'vr_email' => '' ],
          [ 'kunta' => 'Raasepori',   'kunta_sv' => 'Raseborg',   'yhdistys' => 'Raaseporin Vihreät ry, Raseborgs Gröna rf',           'yh_url' => 'https://yhdistykset.vihreat.fi/raaseporin.vihreat/', 'yh_pj' => 'Tanja Konttinen',         'yh_email' => '',                                    'vr_pj' => 'Kati Sointukangas',      'vr_email' => '' ],
          [ 'kunta' => 'Sipoo',       'kunta_sv' => 'Sibbo',      'yhdistys' => 'Sipoon Vihreät – De Gröna i Sibbo ry',                'yh_url' => 'https://www.sipoonvihreat.fi/',                      'yh_pj' => 'Harri Lehtonen',          'yh_email' => 'harri.lehtonen@sipoo.fi',              'vr_pj' => 'Jenni Sademies',         'vr_email' => '' ],
          [ 'kunta' => 'Siuntio',     'kunta_sv' => 'Sjundeå',    'yhdistys' => 'Siuntion Vihreät ry, De Gröna i Sjundeå rf',         'yh_url' => 'https://www.siuntionvihreat.fi/',                    'yh_pj' => 'Mark Davidson',           'yh_email' => '',                                    'vr_pj' => 'Kristian von Essen',     'vr_email' => '' ],
          [ 'kunta' => 'Tuusula',     'kunta_sv' => 'Tusby',      'yhdistys' => 'Tuusulan vihreät ry',                                 'yh_url' => 'http://www.tuusulanvihreat.fi/',                     'yh_pj' => 'Sini Riihimäki',          'yh_email' => 'sini.riihimaki@outlook.com',           'vr_pj' => 'Jenna Jourio',           'vr_email' => '' ],
          [ 'kunta' => 'Vantaa',      'kunta_sv' => 'Vanda',      'yhdistys' => 'Vantaan Vihreät ry',                                  'yh_url' => 'https://www.vavi.fi/',                               'yh_pj' => 'Minna Kuusela',           'yh_email' => 'minna.kuusela@vantaanvihreat.fi',      'vr_pj' => 'Tia Tipu Seppänen',      'vr_email' => '' ],
          [ 'kunta' => 'Vihti',       'kunta_sv' => 'Vichtis',    'yhdistys' => 'Vihdin Vihreät ry',                                   'yh_url' => 'https://yhdistykset.vihreat.fi/vihdin.vihreat/',     'yh_pj' => 'Erja Väyrynen',           'yh_email' => '',                                    'vr_pj' => 'Ida Välimaa',            'vr_email' => '' ],
        ];
        foreach ( $kunnat as $k ) : ?>
        <div class="kunta-card">
          <h3 class="kunta-card__name"><?php echo esc_html( ( $is_sv && $k['kunta_sv'] ) ? $k['kunta_sv'] : $k['kunta'] ); ?></h3>
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
