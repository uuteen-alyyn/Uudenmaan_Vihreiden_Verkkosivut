<?php
/**
 * Uudenmaan Vihreät — WordPress Customizer -asetukset
 *
 * Kaikki piirin yhteystiedot hallitaan täältä.
 * wp-admin → Ulkoasu → Mukauta → Piirin yhteystiedot
 */

defined( 'ABSPATH' ) || exit;

add_action( 'customize_register', function ( WP_Customize_Manager $wp_customize ) {

    // ── Osio: Piirin yhteystiedot ─────────────────────────────────────────────

    $wp_customize->add_panel( 'uuvi_panel', [
        'title'    => 'Piirin tiedot',
        'priority' => 30,
    ] );

    // ── Yleinen yhteystieto ───────────────────────────────────────────────────

    $wp_customize->add_section( 'uuvi_general', [
        'title'    => 'Yleinen yhteystieto',
        'panel'    => 'uuvi_panel',
        'priority' => 10,
    ] );

    $general_fields = [
        'uuvi_email'       => [ 'label' => 'Yleinen sähköposti',   'default' => 'info@uudenmaanvihreat.fi' ],
        'uuvi_osoite'      => [ 'label' => 'Katuosoite',           'default' => 'Mannerheimintie 15b, A-porras, 4.krs' ],
        'uuvi_postiosoite' => [ 'label' => 'Postinumero ja -paikka', 'default' => '00260 Helsinki' ],
        'uuvi_ytunnus'     => [ 'label' => 'Y-tunnus',             'default' => '1087570-8' ],
    ];

    foreach ( $general_fields as $id => $args ) {
        $wp_customize->add_setting( $id, [ 'default' => $args['default'], 'sanitize_callback' => 'sanitize_text_field' ] );
        $wp_customize->add_control( $id, [ 'label' => $args['label'], 'section' => 'uuvi_general', 'type' => 'text' ] );
    }

    // ── Laskutustiedot ────────────────────────────────────────────────────────

    $wp_customize->add_section( 'uuvi_laskutus', [
        'title'    => 'Laskutustiedot',
        'panel'    => 'uuvi_panel',
        'priority' => 20,
    ] );

    $laskutus_fields = [
        'uuvi_verkkolasku_osoite'   => [ 'label' => 'Verkkolaskuosoite',  'default' => '003710875708' ],
        'uuvi_verkkolasku_valittaja'=> [ 'label' => 'Välittäjä',          'default' => '003708599126 (OpenText)' ],
        'uuvi_lasku_email'          => [ 'label' => 'Laskutussähköposti', 'default' => 'fennoa.507906@erin.posti.com' ],
        'uuvi_lasku_posti_nimi'     => [ 'label' => 'Postilaskutus — nimi',     'default' => 'Uudenmaan Vihreät ry, Nylands Gröna rf' ],
        'uuvi_lasku_posti_pl'       => [ 'label' => 'Postilaskutus — PL',       'default' => 'PL 66712' ],
        'uuvi_lasku_posti_numero'   => [ 'label' => 'Postilaskutus — postinro', 'default' => '01051 LASKUT' ],
    ];

    foreach ( $laskutus_fields as $id => $args ) {
        $wp_customize->add_setting( $id, [ 'default' => $args['default'], 'sanitize_callback' => 'sanitize_text_field' ] );
        $wp_customize->add_control( $id, [ 'label' => $args['label'], 'section' => 'uuvi_laskutus', 'type' => 'text' ] );
    }

    // ── Puheenjohtaja ─────────────────────────────────────────────────────────

    $wp_customize->add_section( 'uuvi_pj', [
        'title'    => 'Puheenjohtaja',
        'panel'    => 'uuvi_panel',
        'priority' => 30,
    ] );

    $pj_fields = [
        'uuvi_pj_nimi'   => [ 'label' => 'Nimi',        'default' => 'Santeri Leinonen' ],
        'uuvi_pj_email'  => [ 'label' => 'Sähköposti',  'default' => 'santeri.leinonen@vihreat.fi' ],
        'uuvi_pj_puhelin'=> [ 'label' => 'Puhelinnumero', 'default' => '+358 44 980 7438' ],
    ];

    foreach ( $pj_fields as $id => $args ) {
        $wp_customize->add_setting( $id, [ 'default' => $args['default'], 'sanitize_callback' => 'sanitize_text_field' ] );
        $wp_customize->add_control( $id, [ 'label' => $args['label'], 'section' => 'uuvi_pj', 'type' => 'text' ] );
    }

    // ── Some-profiilit ────────────────────────────────────────────────────────

    $wp_customize->add_section( 'uuvi_some', [
        'title'    => 'Some-profiilit',
        'panel'    => 'uuvi_panel',
        'priority' => 35,
    ] );

    $some_fields = [
        'uuvi_social_facebook'  => [ 'label' => 'Facebook URL',  'default' => '' ],
        'uuvi_social_instagram' => [ 'label' => 'Instagram URL', 'default' => '' ],
        'uuvi_social_twitter'   => [ 'label' => 'X (Twitter) URL', 'default' => '' ],
    ];

    foreach ( $some_fields as $id => $args ) {
        $wp_customize->add_setting( $id, [ 'default' => $args['default'], 'sanitize_callback' => 'esc_url_raw' ] );
        $wp_customize->add_control( $id, [ 'label' => $args['label'], 'section' => 'uuvi_some', 'type' => 'url' ] );
    }

    // ── Toiminnanjohtaja ──────────────────────────────────────────────────────

    $wp_customize->add_section( 'uuvi_tj', [
        'title'    => 'Toiminnanjohtaja',
        'panel'    => 'uuvi_panel',
        'priority' => 40,
    ] );

    $tj_fields = [
        'uuvi_tj_nimi'    => [ 'label' => 'Nimi',         'default' => 'Oskari Sundström' ],
        'uuvi_tj_email'   => [ 'label' => 'Sähköposti',   'default' => 'oskari.sundstrom@vihreat.fi' ],
        'uuvi_tj_puhelin' => [ 'label' => 'Puhelinnumero', 'default' => '+358 45 124 2818' ],
    ];

    foreach ( $tj_fields as $id => $args ) {
        $wp_customize->add_setting( $id, [ 'default' => $args['default'], 'sanitize_callback' => 'sanitize_text_field' ] );
        $wp_customize->add_control( $id, [ 'label' => $args['label'], 'section' => 'uuvi_tj', 'type' => 'text' ] );
    }
} );

/**
 * Apufunktio — hakee yhteystiedon Customizerista, fallback oletusarvoon.
 */
function uuvi_mod( string $key ): string {
    return esc_html( get_theme_mod( $key ) ?: '' );
}

/**
 * Shortcode [uuvi_yhteystiedot] — tulostaa piirin yhteystiedot + laskutustiedot.
 * Käytä meistä-sivun Gutenberg-editorissa Shortcode-lohkona.
 */
add_shortcode( 'uuvi_yhteystiedot', function (): string {
    $email    = get_theme_mod( 'uuvi_email',    'info@uudenmaanvihreat.fi' );
    $osoite   = get_theme_mod( 'uuvi_osoite',   'Mannerheimintie 15b, A-porras, 4.krs' );
    $posti    = get_theme_mod( 'uuvi_postiosoite', '00260 Helsinki' );
    $ytunnus  = get_theme_mod( 'uuvi_ytunnus',  '1087570-8' );
    $vl_os    = get_theme_mod( 'uuvi_verkkolasku_osoite',    '003710875708' );
    $vl_val   = get_theme_mod( 'uuvi_verkkolasku_valittaja', '003708599126 (OpenText)' );
    $l_email  = get_theme_mod( 'uuvi_lasku_email',           'fennoa.507906@erin.posti.com' );
    $l_nimi   = get_theme_mod( 'uuvi_lasku_posti_nimi',      'Uudenmaan Vihreät ry, Nylands Gröna rf' );
    $l_pl     = get_theme_mod( 'uuvi_lasku_posti_pl',        'PL 66712' );
    $l_numero = get_theme_mod( 'uuvi_lasku_posti_numero',    '01051 LASKUT' );

    ob_start(); ?>
    <h2>Yhteystiedot</h2>
    <p><strong>Uudenmaan Vihreät ry</strong><br>
    <?php echo esc_html( $osoite ); ?><br>
    <?php echo esc_html( $posti ); ?></p>
    <p>Sähköposti: <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
    <p>Y-tunnus: <?php echo esc_html( $ytunnus ); ?></p>

    <h2>Laskutustiedot</h2>
    <p><strong>Uudenmaan Vihreät ry</strong><br>Ostolaskujen vastaanotto</p>
    <p><strong>Verkkolasku</strong><br>
    Verkkolaskuosoite: <?php echo esc_html( $vl_os ); ?><br>
    Välittäjä: <?php echo esc_html( $vl_val ); ?></p>
    <p><strong>Sähköposti</strong><br>
    <a href="mailto:<?php echo esc_attr( $l_email ); ?>"><?php echo esc_html( $l_email ); ?></a></p>
    <p><strong>Posti</strong><br>
    <?php echo esc_html( $l_nimi ); ?><br>
    <?php echo esc_html( $l_pl ); ?><br>
    <?php echo esc_html( $l_numero ); ?></p>
    <?php
    return ob_get_clean();
} );
