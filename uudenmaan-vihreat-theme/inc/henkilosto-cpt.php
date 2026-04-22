<?php
/**
 * Uudenmaan Vihreät — Henkilöstö-sisältötyyppi
 *
 * Hallitse henkilöstöä wp-admin → Henkilöstö → Lisää uusi
 */

defined( 'ABSPATH' ) || exit;

// ── Rekisteröi sisältötyyppi ──────────────────────────────────────────────────

add_action( 'init', function () {
    register_post_type( 'uuvi_henkilo', [
        'labels' => [
            'name'               => 'Henkilöstö',
            'singular_name'      => 'Henkilö',
            'add_new'            => 'Lisää uusi',
            'add_new_item'       => 'Lisää uusi henkilö',
            'edit_item'          => 'Muokkaa henkilöä',
            'new_item'           => 'Uusi henkilö',
            'view_item'          => 'Näytä henkilö',
            'search_items'       => 'Etsi henkilöä',
            'not_found'          => 'Ei henkilöitä',
            'not_found_in_trash' => 'Ei poistettuja henkilöitä',
            'menu_name'          => 'Henkilöstö',
        ],
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-groups',
        'menu_position' => 25,
        'supports'      => [ 'title', 'thumbnail' ],
        'show_in_rest'  => true,
    ] );
} );

// ── Mukautetut kentät (meta box) ──────────────────────────────────────────────

add_action( 'add_meta_boxes', function () {
    add_meta_box(
        'uuvi_henkilo_tiedot',
        'Henkilön tiedot',
        'uuvi_henkilo_meta_box',
        'uuvi_henkilo',
        'normal',
        'high'
    );
} );

function uuvi_henkilo_meta_box( WP_Post $post ): void {
    wp_nonce_field( 'uuvi_henkilo_save', 'uuvi_henkilo_nonce' );

    $fields = [
        'uuvi_nimike'  => [ 'label' => 'Nimike / rooli',   'placeholder' => 'esim. Puheenjohtaja' ],
        'uuvi_ryhma'   => [ 'label' => 'Ryhmä',            'placeholder' => 'esim. Johto, Poliittiset sihteerit, Kansanedustajat' ],
        'uuvi_email'   => [ 'label' => 'Sähköposti',       'placeholder' => 'etunimi.sukunimi@vihreat.fi' ],
        'uuvi_puhelin' => [ 'label' => 'Puhelinnumero',    'placeholder' => '+358 XX XXX XXXX' ],
        'uuvi_jarjestys' => [ 'label' => 'Järjestysnumero (pienin ensin)', 'placeholder' => '10' ],
    ];

    echo '<table class="form-table" style="width:100%;">';
    foreach ( $fields as $key => $args ) {
        $value = esc_attr( get_post_meta( $post->ID, $key, true ) );
        printf(
            '<tr><th style="width:200px;padding:10px 10px 10px 0;"><label for="%1$s">%2$s</label></th>
            <td><input type="text" id="%1$s" name="%1$s" value="%3$s" placeholder="%4$s" class="regular-text"></td></tr>',
            esc_attr( $key ),
            esc_html( $args['label'] ),
            $value,
            esc_attr( $args['placeholder'] )
        );
    }
    echo '</table>';
    echo '<p style="color:#666;margin-top:1rem;">💡 <strong>Kuva:</strong> Aseta henkilön kuva oikealla olevasta "Esittelykuva"-osiosta.</p>';
}

add_action( 'save_post_uuvi_henkilo', function ( int $post_id ): void {
    if (
        ! isset( $_POST['uuvi_henkilo_nonce'] ) ||
        ! wp_verify_nonce( $_POST['uuvi_henkilo_nonce'], 'uuvi_henkilo_save' ) ||
        defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ||
        ! current_user_can( 'edit_post', $post_id )
    ) return;

    foreach ( [ 'uuvi_nimike', 'uuvi_ryhma', 'uuvi_email', 'uuvi_puhelin', 'uuvi_jarjestys' ] as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, sanitize_text_field( $_POST[ $key ] ) );
        }
    }
} );

// ── Apufunktio: hae henkilöt ryhmittäin ──────────────────────────────────────

/**
 * Palauttaa henkilöt järjestettynä ryhmän ja järjestysnumeron mukaan.
 * @param string|string[] $ryhma  Ryhmä tai ryhmien lista. Tyhjä = kaikki.
 */
function uuvi_get_henkilot( $ryhma = '' ): array {
    $lang   = function_exists( 'pll_current_language' ) ? pll_current_language() : 'fi';
    $suffix = in_array( $lang, [ 'sv', 'en' ], true ) ? "_{$lang}" : '';

    $args = [
        'post_type'        => 'uuvi_henkilo',
        'post_status'      => 'publish',
        'posts_per_page'   => -1,
        'meta_key'         => 'uuvi_jarjestys',
        'orderby'          => 'meta_value_num',
        'order'            => 'ASC',
        'suppress_filters' => true,
    ];

    if ( $ryhma ) {
        $ryhmät = (array) $ryhma;
        $args['meta_query'] = [ [
            'key'     => 'uuvi_ryhma',
            'value'   => $ryhmät,
            'compare' => 'IN',
        ] ];
    }

    $posts = get_posts( $args );

    return array_map( function ( WP_Post $p ) use ( $suffix ): array {
        return [
            'name'  => $p->post_title,
            'role'  => get_post_meta( $p->ID, "uuvi_nimike{$suffix}", true )
                    ?: get_post_meta( $p->ID, 'uuvi_nimike', true ),
            'group' => get_post_meta( $p->ID, "uuvi_ryhma{$suffix}", true )
                    ?: get_post_meta( $p->ID, 'uuvi_ryhma', true ),
            'email' => get_post_meta( $p->ID, 'uuvi_email',   true ),
            'phone' => get_post_meta( $p->ID, 'uuvi_puhelin', true ),
            'photo' => get_the_post_thumbnail_url( $p->ID, 'large' ) ?: get_the_post_thumbnail_url( $p->ID, 'full' ) ?: '',
        ];
    }, $posts );
}
