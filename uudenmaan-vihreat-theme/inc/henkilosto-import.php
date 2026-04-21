<?php
/**
 * Uudenmaan Vihreät — Henkilöstön automaattituonti teeman aktivoinnissa
 *
 * Kopioi henkilöstön kuvat assets/images/staff/ → WP mediakirjasto ja
 * luo uuvi_henkilo-sisältötyypin merkinnät. Ei ylikirjoita olemassa
 * olevia merkintöjä (tarkistus nimen perusteella).
 */

defined( 'ABSPATH' ) || exit;

/**
 * Luo kaikki henkilömerkinnät. Kutsutaan teeman aktivoinnista.
 */
function uuvi_create_henkilosto(): void {
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    $people = uuvi_henkilosto_data();

    foreach ( $people as $person ) {
        // Älä luo duplikaatteja
        $existing = get_posts( [
            'post_type'              => 'uuvi_henkilo',
            'post_status'            => 'publish',
            'title'                  => $person['name'],
            'posts_per_page'         => 1,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
        ] );
        if ( $existing ) continue;

        $post_id = wp_insert_post( [
            'post_type'   => 'uuvi_henkilo',
            'post_title'  => $person['name'],
            'post_status' => 'publish',
        ] );
        if ( is_wp_error( $post_id ) ) continue;

        update_post_meta( $post_id, 'uuvi_nimike',    $person['role'] );
        update_post_meta( $post_id, 'uuvi_ryhma',     $person['group'] );
        update_post_meta( $post_id, 'uuvi_email',     $person['email'] );
        update_post_meta( $post_id, 'uuvi_puhelin',   $person['phone'] );
        update_post_meta( $post_id, 'uuvi_jarjestys', $person['order'] );

        if ( ! empty( $person['photo'] ) ) {
            $attachment_id = uuvi_import_staff_image( $person['photo'], $person['name'] );
            if ( $attachment_id ) {
                set_post_thumbnail( $post_id, $attachment_id );
            }
        }
    }
}

/**
 * Tuo kuvatiedosto assets/images/staff/ → WP mediakirjasto.
 * Palauttaa attachment ID:n tai 0 virheessä.
 */
function uuvi_import_staff_image( string $filename, string $title ): int {
    $source = get_template_directory() . '/assets/images/staff/' . $filename;
    if ( ! file_exists( $source ) ) return 0;

    $upload_dir = wp_upload_dir();
    $dest_dir   = $upload_dir['path'];
    $dest_file  = $dest_dir . '/' . $filename;

    // Älä kopioi jos jo olemassa mediakirjastossa
    $existing_id = uuvi_find_attachment_by_filename( $filename );
    if ( $existing_id ) return $existing_id;

    if ( ! wp_mkdir_p( $dest_dir ) ) return 0;
    if ( ! copy( $source, $dest_file ) ) return 0;

    $mime = wp_check_filetype( $filename );
    $attachment_id = wp_insert_attachment( [
        'post_title'     => $title,
        'post_content'   => '',
        'post_status'    => 'inherit',
        'post_mime_type' => $mime['type'],
        'guid'           => $upload_dir['url'] . '/' . $filename,
    ], $dest_file );

    if ( is_wp_error( $attachment_id ) ) {
        @unlink( $dest_file );
        return 0;
    }

    $metadata = wp_generate_attachment_metadata( $attachment_id, $dest_file );
    wp_update_attachment_metadata( $attachment_id, $metadata );

    return $attachment_id;
}

/**
 * Etsii olemassa olevan liitetiedoston tiedostonimen perusteella.
 */
function uuvi_find_attachment_by_filename( string $filename ): int {
    global $wpdb;
    $like = '%/' . $wpdb->esc_like( $filename );
    $id   = $wpdb->get_var( $wpdb->prepare(
        "SELECT ID FROM {$wpdb->posts}
         WHERE post_type = 'attachment' AND guid LIKE %s
         LIMIT 1",
        $like
    ) );
    return (int) $id;
}

/**
 * Palauttaa henkilöstön tiedot.
 * Muokkaa tätä listaa kun henkilöstö vaihtuu.
 */
function uuvi_henkilosto_data(): array {
    return [
        // ── Kansanedustajat ───────────────────────────────────
        [
            'name'  => 'Inka Hopsu',
            'role'  => 'Kansanedustaja',
            'group' => 'Kansanedustajat',
            'email' => '',
            'phone' => '',
            'order' => 10,
            'photo' => 'InkaHopsu.png',
        ],
        [
            'name'  => 'Saara Hyrkkö',
            'role'  => 'Kansanedustaja',
            'group' => 'Kansanedustajat',
            'email' => '',
            'phone' => '',
            'order' => 20,
            'photo' => 'SaaraHyrkko.png',
        ],
        [
            'name'  => 'Tiina Elo',
            'role'  => 'Kansanedustaja',
            'group' => 'Kansanedustajat',
            'email' => '',
            'phone' => '',
            'order' => 30,
            'photo' => 'TiinaElo.png',
        ],

        // ── Piiritoimisto ─────────────────────────────────────
        [
            'name'  => 'Reima Kuukka',
            'role'  => 'Toiminnanjohtaja',
            'group' => 'Piiritoimisto',
            'email' => '',
            'phone' => '',
            'order' => 10,
            'photo' => 'KuukkaReimaVirallinen.jpg',
        ],
        [
            'name'  => 'Hanna Hiltunen',
            'role'  => '[Nimike tähän]',
            'group' => 'Piiritoimisto',
            'email' => '',
            'phone' => '',
            'order' => 20,
            'photo' => 'Hiltunen_Hanna.jpg',
        ],
        [
            'name'  => 'Minttu Massinen',
            'role'  => '[Nimike tähän]',
            'group' => 'Piiritoimisto',
            'email' => '',
            'phone' => '',
            'order' => 30,
            'photo' => 'Minttu-Massinen.jpg',
        ],
        [
            'name'  => 'Mikko Koivisto',
            'role'  => '[Nimike tähän]',
            'group' => 'Piiritoimisto',
            'email' => '',
            'phone' => '',
            'order' => 40,
            'photo' => 'MikkoKoivisto.jpg',
        ],
        [
            'name'  => 'Oskari Sundström',
            'role'  => '[Nimike tähän]',
            'group' => 'Piiritoimisto',
            'email' => '',
            'phone' => '',
            'order' => 50,
            'photo' => 'OskariSundstrom.jpeg',
        ],
        [
            'name'  => 'Santeri Leinonen',
            'role'  => '[Nimike tähän]',
            'group' => 'Piiritoimisto',
            'email' => '',
            'phone' => '',
            'order' => 60,
            'photo' => 'SanteriLeinonen.jpg',
        ],
    ];
}
