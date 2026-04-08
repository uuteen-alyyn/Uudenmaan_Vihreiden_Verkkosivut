<?php
/**
 * Uudenmaan Vihreät — Automaattinen sivujen luonti
 *
 * Luo kaikki tarvittavat sivut oikeilla slugeilla ja sisällöillä.
 * Ajetaan kerran teeman aktivoinnin yhteydessä (after_switch_theme).
 * Jos sivu on jo olemassa (slug täsmää), sitä ei ylikirjoiteta.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Pääfunktio — kutsutaan teeman aktivoinnista.
 */
function uuvi_create_all_pages(): void {
    $pages = uuvi_page_definitions();

    // Luo ensin ylätason sivut jotta voidaan viitata niiden ID:hen
    $created_ids = [];
    foreach ( $pages as $page ) {
        if ( empty( $page['parent'] ) ) {
            $id = uuvi_create_page( $page, $created_ids );
            if ( $id ) $created_ids[ $page['slug'] ] = $id;
        }
    }
    // Luo alasivut
    foreach ( $pages as $page ) {
        if ( ! empty( $page['parent'] ) ) {
            $id = uuvi_create_page( $page, $created_ids );
            if ( $id ) $created_ids[ $page['slug'] ] = $id;
        }
    }

    // Aseta permalink-rakenne (/%postname%/)
    update_option( 'permalink_structure', '/%postname%/' );
    flush_rewrite_rules( true );

    // Aseta etusivu
    $front_id = $created_ids['etusivu'] ?? null;
    if ( $front_id ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_id );
    }

    // Luo navigaatiovalikko
    uuvi_create_nav_menu( $created_ids );

    // Merkitse tehtyä
    update_option( 'uuvi_pages_created', '1' );
}

/**
 * Luo päänavigaatiovalikko oikealla hierarkialla.
 */
function uuvi_create_nav_menu( array $ids ): void {
    // Poista vanha jos on
    $existing = get_term_by( 'name', 'Päänavigaatio', 'nav_menu' );
    if ( $existing ) wp_delete_nav_menu( $existing->term_id );

    $menu_id = wp_create_nav_menu( 'Päänavigaatio' );
    if ( is_wp_error( $menu_id ) ) return;

    // Apufunktio lisäämiseen
    $add = function( string $slug, int $parent_item_id = 0 ) use ( $menu_id, $ids ): int {
        $page_id = $ids[ $slug ] ?? 0;
        if ( ! $page_id ) return 0;
        return wp_update_nav_menu_item( $menu_id, 0, [
            'menu-item-title'     => get_the_title( $page_id ),
            'menu-item-object'    => 'page',
            'menu-item-object-id' => $page_id,
            'menu-item-type'      => 'post_type',
            'menu-item-status'    => 'publish',
            'menu-item-parent-id' => $parent_item_id,
        ] );
    };

    // Ajankohtaista
    $aj = $add( 'ajankohtaista' );
    $add( 'tiedotteet',        $aj );
    $add( 'tapahtumakalenteri', $aj );
    $add( 'yleiskokous',       $aj );

    // Tule mukaan
    $add( 'tule-mukaan' );

    // Vaalit
    $vaalit = $add( 'vaalit' );
    $add( 'vaalitavoitteemme',  $vaalit );
    $add( 'ehdolle-vaaleihin',  $vaalit );
    $add( 'aiemmat-vaalit',     $vaalit );

    // Hyvinvointialueet ja kunnat
    $hyv = $add( 'hyvinvointialueet' );
    $add( 'lansi-uusimaa',          $hyv );
    $add( 'keski-uusimaa',          $hyv );
    $add( 'ita-uusimaa',            $hyv );
    $add( 'vantaa-kerava',          $hyv );
    $add( 'hus-ja-maakunnalliset',  $hyv );
    $add( 'kunnat',                 $hyv );

    // Yhteystiedot
    $yht = $add( 'yhteystiedot' );
    $add( 'meista',           $yht );
    $add( 'medialle',         $yht );
    $add( 'kansanedustajat',  $yht );
    $add( 'piirihallitus',    $yht );
    $add( 'piiritoimisto',    $yht );

    // Aseta valikon sijainti
    $locations = get_theme_mod( 'nav_menu_locations', [] );
    $locations['primary'] = $menu_id;
    set_theme_mod( 'nav_menu_locations', $locations );
}

/**
 * Luo yksittäinen sivu jos sitä ei vielä ole.
 */
function uuvi_create_page( array $page, array $created_ids ): int {
    // Tarkista onko jo olemassa post_name-haulla (toimii myös alasivuilla)
    $existing = get_posts( [
        'name'        => $page['slug'],
        'post_type'   => 'page',
        'post_status' => 'publish',
        'numberposts' => 1,
    ] );
    if ( $existing ) return $existing[0]->ID;

    $parent_id = 0;
    if ( ! empty( $page['parent'] ) && isset( $created_ids[ $page['parent'] ] ) ) {
        $parent_id = $created_ids[ $page['parent'] ];
    }

    return wp_insert_post( [
        'post_title'   => $page['title'],
        'post_name'    => $page['slug'],
        'post_content' => $page['content'] ?? '',
        'post_status'  => 'publish',
        'post_type'    => 'page',
        'post_parent'  => $parent_id,
        'post_author'  => 1,
    ] );
}

/**
 * Sivumääritykset — kaikki sivut sisältöineen.
 */
function uuvi_page_definitions(): array {
    return [

        // ── Etusivu ──────────────────────────────────────────────────
        [
            'slug'    => 'etusivu',
            'title'   => 'Etusivu',
            'content' => '',
        ],

        // ── Ajankohtaista ─────────────────────────────────────────────
        [
            'slug'    => 'ajankohtaista',
            'title'   => 'Ajankohtaista',
            'content' => '',
        ],
        [
            'slug'    => 'yleiskokous',
            'title'   => 'Yleiskokous',
            'parent'  => 'ajankohtaista',
            'content' => uuvi_content_yleiskokous(),
        ],
        [
            'slug'    => 'tapahtumakalenteri',
            'title'   => 'Tapahtumakalenteri',
            'parent'  => 'ajankohtaista',
            'content' => '',
        ],
        [
            'slug'    => 'tiedotteet',
            'title'   => 'Tiedotteet',
            'parent'  => 'ajankohtaista',
            'content' => '',
        ],

        // ── Tule mukaan ───────────────────────────────────────────────
        [
            'slug'    => 'tule-mukaan',
            'title'   => 'Tule mukaan',
            'content' => '',
        ],

        // ── Vaalit ────────────────────────────────────────────────────
        [
            'slug'    => 'vaalit',
            'title'   => 'Vaalit',
            'content' => '',
        ],
        [
            'slug'    => 'vaalitavoitteemme',
            'title'   => 'Vaalitavoitteemme',
            'parent'  => 'vaalit',
            'content' => uuvi_content_vaalitavoitteet(),
        ],
        [
            'slug'    => 'ehdolle-vaaleihin',
            'title'   => 'Ehdolle vaaleihin',
            'parent'  => 'vaalit',
            'content' => '',
        ],

        // ── Hyvinvointialueet ja kunnat ───────────────────────────────
        [
            'slug'    => 'hyvinvointialueet',
            'title'   => 'Hyvinvointialueet ja kunnat',
            'content' => '',
        ],
        [
            'slug'    => 'lansi-uusimaa',
            'title'   => 'Länsi-Uusimaa',
            'parent'  => 'hyvinvointialueet',
            'content' => uuvi_content_alue( 'Länsi-Uusimaa', 'Länsi-Uudenmaan hyvinvointialue kattaa Espoon, Hangon, Inkoon, Karkkilan, Kirkkonummen, Lohjan, Raaseporin, Siuntion ja Vihdin.' ),
        ],
        [
            'slug'    => 'keski-uusimaa',
            'title'   => 'Keski-Uusimaa',
            'parent'  => 'hyvinvointialueet',
            'content' => uuvi_content_alue( 'Keski-Uusimaa', 'Keski-Uudenmaan hyvinvointialue kattaa Hyvinkään, Järvenpään, Mäntsälän, Nurmijärven, Pornaisten, Sipoon ja Tuusulan.' ),
        ],
        [
            'slug'    => 'ita-uusimaa',
            'title'   => 'Itä-Uusimaa',
            'parent'  => 'hyvinvointialueet',
            'content' => uuvi_content_alue( 'Itä-Uusimaa', 'Itä-Uudenmaan hyvinvointialue kattaa Askolan, Lapinjärven, Loviisan, Myrskylän, Porvoon, Pukkilan ja Sipoon.' ),
        ],
        [
            'slug'    => 'vantaa-kerava',
            'title'   => 'Vantaa–Kerava',
            'parent'  => 'hyvinvointialueet',
            'content' => uuvi_content_alue( 'Vantaa–Kerava', 'Vantaan ja Keravan hyvinvointialue vastaa Vantaan ja Keravan sosiaali- ja terveyspalveluista.' ),
        ],
        [
            'slug'    => 'hus-ja-maakunnalliset',
            'title'   => 'HUS ja maakunnalliset luottamustoimet',
            'parent'  => 'hyvinvointialueet',
            'content' => uuvi_content_alue( 'HUS ja maakunnalliset luottamustoimet', 'HUS-yhtymä tuottaa erikoissairaanhoidon palvelut Uudellamaalla. Vihreillä on edustajia myös muissa maakunnallisissa toimielimissä.' ),
        ],
        [
            'slug'    => 'kunnat',
            'title'   => 'Kunnat',
            'parent'  => 'hyvinvointialueet',
            'content' => '',
        ],

        // ── Yhteystiedot ──────────────────────────────────────────────
        [
            'slug'    => 'yhteystiedot',
            'title'   => 'Yhteystiedot',
            'content' => '',
        ],
        [
            'slug'    => 'meista',
            'title'   => 'Meistä',
            'content' => '',
        ],
        [
            'slug'    => 'piiritoimisto',
            'title'   => 'Toimisto',
            'parent'  => 'yhteystiedot',
            'content' => '',
        ],
        [
            'slug'    => 'piirihallitus',
            'title'   => 'Piirihallitus',
            'parent'  => 'yhteystiedot',
            'content' => '',
        ],
        [
            'slug'    => 'kansanedustajat',
            'title'   => 'Kansanedustajamme',
            'parent'  => 'yhteystiedot',
            'content' => '',
        ],

        // ── Medialle ─────────────────────────────────────────────────
        [
            'slug'    => 'medialle',
            'title'   => 'Medialle',
            'content' => '',
        ],
    ];
}

// ── Sisältögeneraattorit ──────────────────────────────────────────────────────

function uuvi_content_yleiskokous(): string {
    return '';
}

function uuvi_content_vaalitavoitteet(): string {
    return '<p>Uudenmaan Vihreät tavoittelee vaaleissa reilua, vihreää ja sosiaalisesti oikeudenmukaista Uusimaata. Alla keskeisimmät vaalitavoitteemme.</p>
<h2>Ilmasto ja ympäristö</h2>
<p>Uusimaa voi näyttää tietä hiilineutraalina maakuntana. Tavoitteemme on nopeuttaa siirtymää puhtaaseen energiaan, suojella Itämerta ja metsiä sekä tehdä kestävästä arjesta helppoa jokaiselle uusimaalaiselle.</p>
<h2>Sosiaali- ja terveyspalvelut</h2>
<p>Haluamme hyvinvointialueet, jotka vastaavat ihmisten tarpeisiin nopeasti ja tasapuolisesti. Mielenterveyspalvelujen saatavuus, lasten ja nuorten hyvinvointi sekä ikäihmisten arvokas elämä ovat prioriteettejamme.</p>
<h2>Asuminen ja liikkuminen</h2>
<p>Kohtuuhintainen asuminen ja sujuva joukkoliikenne ovat perusoikeuksia. Tiivis kaupunkirakenne, raideinvestoinnit ja kävely- ja pyöräilyväylät tekevät Uusimaasta toimivamman kaikille.</p>
<h2>Koulutus ja kulttuuri</h2>
<p>Laadukas varhaiskasvatus ja perusopetus ovat yhteiskunnan perusta. Haluamme turvata koulutuksen tasa-arvon ja pitää kulttuuripalvelut kaikkien saatavilla.</p>';
}

function uuvi_content_alue( string $nimi, string $kuvaus ): string {
    return '<p>' . esc_html( $kuvaus ) . '</p>
<h2>Vihreät ' . esc_html( $nimi ) . 'lla</h2>
<p>Uudenmaan Vihreillä on aktiivisia luottamushenkilöitä ' . esc_html( $nimi ) . 'n hyvinvointialueella. Työskentelemme parempien palvelujen, ympäristön suojelun ja asukkaiden hyvinvoinnin puolesta.</p>
<h2>Luottamushenkilöt</h2>
<p>[Luottamushenkilöiden nimet ja yhteystiedot tähän]</p>
<h2>Ajankohtaista alueelta</h2>
<p>[Ajankohtainen sisältö tähän]</p>';
}
