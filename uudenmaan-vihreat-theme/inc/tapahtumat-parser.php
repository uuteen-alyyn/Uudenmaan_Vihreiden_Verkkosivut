<?php
/**
 * Uudenmaan Vihreät — Tapahtumakalenteri
 *
 * Hakee ICS-syötteen tapahtumat.vihreaturku.fi:stä, parsii tapahtumat
 * ja tarjoaa ne [uuvi_tapahtumat]-shortcodena filttereineen.
 */

defined( 'ABSPATH' ) || exit;

define( 'UUVI_TAPAHTUMAT_TRANSIENT', 'uuvi_tapahtumat_v1' );
define( 'UUVI_TAPAHTUMAT_URL',       'https://tapahtumat.vihreaturku.fi/events.ics?region=01' );
define( 'UUVI_TAPAHTUMAT_TTL',       HOUR_IN_SECONDS );

// ── Haku ─────────────────────────────────────────────────────────────────────

function uuvi_ics_fetch(): string {
    $r = wp_remote_get( UUVI_TAPAHTUMAT_URL, [
        'timeout'    => 15,
        'user-agent' => 'UudenmaanVihreat/1.0 (WordPress)',
    ] );
    return is_wp_error( $r ) ? '' : wp_remote_retrieve_body( $r );
}

// ── Parseri ───────────────────────────────────────────────────────────────────

function uuvi_ics_unescape( string $v ): string {
    return str_replace(
        [ '\\n', '\\N', '\\,', '\\;', '\\\\' ],
        [ "\n",  "\n",  ',',   ';',   '\\' ],
        $v
    );
}

function uuvi_ics_timestamp( string $raw ): int {
    $raw = trim( $raw );
    if ( ! $raw ) return 0;
    // YYYYMMDDTHHMMSSZ (UTC)
    if ( preg_match( '/^(\d{4})(\d{2})(\d{2})T(\d{2})(\d{2})(\d{2})Z$/', $raw, $m ) ) {
        return gmmktime( (int) $m[4], (int) $m[5], (int) $m[6], (int) $m[2], (int) $m[3], (int) $m[1] );
    }
    // YYYYMMDDTHHMMSS (paikallinen)
    if ( preg_match( '/^(\d{4})(\d{2})(\d{2})T(\d{2})(\d{2})(\d{2})$/', $raw, $m ) ) {
        return mktime( (int) $m[4], (int) $m[5], (int) $m[6], (int) $m[2], (int) $m[3], (int) $m[1] );
    }
    // YYYYMMDD (koko päivä)
    if ( preg_match( '/^(\d{4})(\d{2})(\d{2})$/', $raw, $m ) ) {
        return mktime( 0, 0, 0, (int) $m[2], (int) $m[3], (int) $m[1] );
    }
    return 0;
}

function uuvi_ics_city( string $location ): string {
    if ( ! $location ) return '';
    $parts = array_map( 'trim', explode( ',', $location ) );
    return end( $parts ) ?: '';
}

function uuvi_ics_parse( string $raw ): array {
    // RFC 5545: pura rivijatko (CRLF + välilyönti/tabulaattori = jatkorivi)
    $raw = preg_replace( "/\r\n[ \t]/", '', $raw );
    $raw = str_replace( "\r\n", "\n", $raw );

    if ( ! preg_match_all( '/BEGIN:VEVENT\n(.*?)\nEND:VEVENT/s', $raw, $matches ) ) {
        return [];
    }

    $events = [];
    $now    = time();

    foreach ( $matches[1] as $block ) {
        $props = [];
        foreach ( explode( "\n", $block ) as $line ) {
            $line = rtrim( $line );
            if ( ! str_contains( $line, ':' ) ) continue;
            [ $key_part, $value ] = explode( ':', $line, 2 );
            $key          = explode( ';', $key_part )[0];
            $props[ $key ] = $value;
        }

        if ( empty( $props['SUMMARY'] ) ) continue;

        $start_ts = uuvi_ics_timestamp( $props['DTSTART'] ?? '' );
        $end_ts   = uuvi_ics_timestamp( $props['DTEND']   ?? '' );

        // Ohita menneet tapahtumat
        $check = $end_ts ?: $start_ts;
        if ( $check && $check < $now ) continue;

        $location  = uuvi_ics_unescape( $props['LOCATION'] ?? '' );
        $all_day   = strlen( trim( $props['DTSTART'] ?? '' ) ) === 8;

        // Muodosta päivämäärä + aikaväli: "11.4.2026 10:00–12:00"
        // wp_date() muuntaa UTC-timestampin WordPress-aikavyöhykkeeseen (esim. Helsinki)
        $date_str  = $start_ts ? wp_date( 'j.n.Y', $start_ts ) : '';
        $time_str  = '';
        if ( ! $all_day && $start_ts ) {
            $time_str = wp_date( 'H:i', $start_ts );
            if ( $end_ts && wp_date( 'j.n.Y', $end_ts ) === $date_str ) {
                $time_str .= '–' . wp_date( 'H:i', $end_ts );
            }
        }

        $events[] = [
            'title'    => uuvi_ics_unescape( $props['SUMMARY']    ?? '' ),
            'start_ts' => $start_ts,
            'end_ts'   => $end_ts,
            'date_str' => $date_str,
            'time_str' => $time_str,
            'location' => $location,
            'city'     => uuvi_ics_city( $location ),
            'category' => uuvi_ics_unescape( $props['CATEGORIES'] ?? '' ),
            'url'      => $props['URL'] ?? '',
        ];
    }

    usort( $events, fn( $a, $b ) => $a['start_ts'] <=> $b['start_ts'] );
    return $events;
}

// ── Välimuisti ────────────────────────────────────────────────────────────────

function uuvi_get_tapahtumat(): array {
    $cached = get_transient( UUVI_TAPAHTUMAT_TRANSIENT );
    if ( $cached !== false ) return $cached;

    $raw = uuvi_ics_fetch();
    if ( ! $raw ) return [];

    $events = uuvi_ics_parse( $raw );
    set_transient( UUVI_TAPAHTUMAT_TRANSIENT, $events, UUVI_TAPAHTUMAT_TTL );
    return $events;
}

// Manuaalinen välimuistin tyhjennys (wp-admin)
add_action( 'wp_ajax_uuvi_clear_tapahtumat', function () {
    if ( ! current_user_can( 'manage_options' ) ) wp_die();
    delete_transient( UUVI_TAPAHTUMAT_TRANSIENT );
    $page     = get_posts( [ 'name' => 'tapahtumakalenteri', 'post_type' => 'page', 'posts_per_page' => 1 ] );
    $redirect = $page ? get_permalink( $page[0]->ID ) : home_url( '/' );
    wp_safe_redirect( $redirect );
    exit;
} );

// ── Shortcode [uuvi_tapahtumat] ───────────────────────────────────────────────

add_shortcode( 'uuvi_tapahtumat', function (): string {
    $events = uuvi_get_tapahtumat();

    if ( empty( $events ) ) {
        return '<p class="uuvi-tapahtumat__empty">Tulevia tapahtumia ei löydy juuri nyt. Tarkista myöhemmin uudelleen.</p>';
    }

    $categories = array_values( array_unique( array_filter( array_column( $events, 'category' ) ) ) );
    $cities     = array_values( array_unique( array_filter( array_column( $events, 'city' ) ) ) );
    sort( $categories );
    sort( $cities );

    ob_start();
    ?>
    <div class="uuvi-tapahtumat" id="uuvi-tapahtumat">

      <?php if ( $categories || count( $cities ) > 1 ) : ?>
      <div class="uuvi-tapahtumat__filters">

        <?php if ( $categories ) : ?>
        <div class="uuvi-tapahtumat__filter-group">
          <span class="uuvi-tapahtumat__filter-label">Tyyppi</span>
          <div class="uuvi-tapahtumat__filter-buttons" data-filter="category">
            <button class="uuvi-filter-btn is-active" data-value="">Kaikki</button>
            <?php foreach ( $categories as $cat ) : ?>
            <button class="uuvi-filter-btn" data-value="<?php echo esc_attr( $cat ); ?>"><?php echo esc_html( $cat ); ?></button>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

        <?php if ( count( $cities ) > 1 ) : ?>
        <div class="uuvi-tapahtumat__filter-group">
          <span class="uuvi-tapahtumat__filter-label">Paikkakunta</span>
          <div class="uuvi-tapahtumat__filter-buttons" data-filter="city">
            <button class="uuvi-filter-btn is-active" data-value="">Kaikki</button>
            <?php foreach ( $cities as $city ) : ?>
            <button class="uuvi-filter-btn" data-value="<?php echo esc_attr( $city ); ?>"><?php echo esc_html( $city ); ?></button>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

      </div>
      <?php endif; ?>

      <div class="uuvi-tapahtumat__list" id="uuvi-tapahtumat-list">
        <?php foreach ( $events as $event ) : ?>
        <article class="uuvi-event"
          data-category="<?php echo esc_attr( $event['category'] ); ?>"
          data-city="<?php echo esc_attr( $event['city'] ); ?>">
          <div class="uuvi-event__date">
            <span class="uuvi-event__day"><?php echo wp_date( 'j', $event['start_ts'] ); ?></span>
            <span class="uuvi-event__month"><?php echo wp_date( 'M', $event['start_ts'] ); ?></span>
          </div>
          <div class="uuvi-event__body">
            <h3 class="uuvi-event__title">
              <?php if ( $event['url'] ) : ?>
                <a href="<?php echo esc_url( $event['url'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $event['title'] ); ?></a>
              <?php else : ?>
                <?php echo esc_html( $event['title'] ); ?>
              <?php endif; ?>
            </h3>
            <div class="uuvi-event__meta">
              <?php if ( $event['date_str'] ) : ?>
                <span class="uuvi-event__datetime"><?php
                  echo esc_html( $event['date_str'] );
                  if ( $event['time_str'] ) echo ' ' . esc_html( $event['time_str'] );
                ?></span>
              <?php endif; ?>
              <?php if ( $event['location'] ) : ?>
                <span class="uuvi-event__location"><?php echo esc_html( $event['location'] ); ?></span>
              <?php endif; ?>
              <?php if ( $event['category'] ) : ?>
                <span class="uuvi-event__category"><?php echo esc_html( $event['category'] ); ?></span>
              <?php endif; ?>
            </div>
          </div>
        </article>
        <?php endforeach; ?>
      </div>

      <p class="uuvi-tapahtumat__none" style="display:none;">Ei tapahtumia valituilla suodattimilla.</p>

      <?php if ( current_user_can( 'manage_options' ) ) : ?>
      <p class="uuvi-tapahtumat__admin-refresh">
        <a href="<?php echo esc_url( admin_url( 'admin-ajax.php?action=uuvi_clear_tapahtumat' ) ); ?>">↺ Päivitä kalenteri</a>
        <small>(näkyy vain ylläpidolle)</small>
      </p>
      <?php endif; ?>

    </div>
    <?php
    return ob_get_clean();
} );
