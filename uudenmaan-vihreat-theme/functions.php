<?php
/**
 * Uudenmaan Vihreät — functions.php
 */

defined( 'ABSPATH' ) || exit;

// ─── Page setup ───────────────────────────────────────────────────────────────
require_once get_template_directory() . '/inc/setup-pages.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/henkilosto-cpt.php';
require_once get_template_directory() . '/inc/tapahtumat-parser.php';
require_once get_template_directory() . '/inc/seo.php';

// Luo sivut teeman aktivoinnin yhteydessä
add_action( 'after_switch_theme', 'uuvi_create_all_pages' );

// Luo sivut myös jos niitä ei vielä ole (esim. teema on jo aktiiivinen)
add_action( 'init', function () {
    if ( ! get_option( 'uuvi_pages_created' ) ) {
        uuvi_create_all_pages();
    }
} );

// ─── Theme supports ──────────────────────────────────────────────────────────

add_action( 'after_setup_theme', function () {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'custom-logo', [
        'height'      => 80,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ] );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'assets/css/editor.css' );

    load_theme_textdomain( 'uudenmaan-vihreat', get_template_directory() . '/languages' );

    // Image sizes
    add_image_size( 'card-thumb', 600, 400, true );   // 3:2 cards
    add_image_size( 'hero-full',  1920, 1080, true );  // 16:9 hero
    add_image_size( 'portrait',   400, 400, true );    // 1:1 portraits
} );

// ─── Polylang: reload textdomain after language is determined from URL ────────
// load_theme_textdomain() in after_setup_theme fires before Polylang has parsed
// the URL (/sv/, /en/) and applied its locale filter. We reload on 'init'
// (priority 20) by which time Polylang has already set the correct locale.
add_action( 'init', function () {
    // Explicitly use Polylang's current language locale to avoid determine_locale() issues.
    if ( function_exists( 'pll_current_language' ) ) {
        $locale = pll_current_language( 'locale' );
    }
    if ( empty( $locale ) ) {
        $locale = determine_locale();
    }
    if ( $locale && $locale !== 'fi' ) {
        $mofile = get_template_directory() . '/languages/uudenmaan-vihreat-' . $locale . '.mo';
        if ( file_exists( $mofile ) ) {
            unload_textdomain( 'uudenmaan-vihreat' );
            load_textdomain( 'uudenmaan-vihreat', $mofile );
        }
    }
}, 20 );

// ─── Navigation menus ────────────────────────────────────────────────────────

add_action( 'after_setup_theme', function () {
    register_nav_menus( [
        'primary' => __( 'Päänavigaatio', 'uudenmaan-vihreat' ),
        'footer'  => __( 'Alatunniste', 'uudenmaan-vihreat' ),
    ] );
} );

// ─── Polylang translation helpers ────────────────────────────────────────────
// Returns the permalink for a page in the current language, given the FI page ID.
function uuvi_translated_url( int $fi_id ): string {
    if ( function_exists( 'pll_get_post' ) ) {
        $id = pll_get_post( $fi_id ) ?: $fi_id;
    } else {
        $id = $fi_id;
    }
    return get_permalink( $id ) ?: '#';
}

// Returns the title for a page in the current language, given the FI page ID.
function uuvi_translated_title( int $fi_id ): string {
    if ( function_exists( 'pll_get_post' ) ) {
        $id = pll_get_post( $fi_id ) ?: $fi_id;
    } else {
        $id = $fi_id;
    }
    return get_the_title( $id );
}

// ─── Enqueue scripts & styles ────────────────────────────────────────────────

add_action( 'wp_enqueue_scripts', function () {
    $ver = wp_get_theme()->get( 'Version' );

    // Google Fonts: IBM Plex Sans + IBM Plex Mono + Barlow Semi Condensed
    wp_enqueue_style(
        'uuvi-google-fonts',
        'https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@700;800&family=IBM+Plex+Mono&family=IBM+Plex+Sans:ital,wght@0,400;0,500;0,700;1,400&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'uuvi-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [ 'uuvi-google-fonts' ],
        $ver
    );

    wp_enqueue_script(
        'uuvi-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        $ver,
        true
    );

    // Tapahtumakalenteri-filtterit — ladataan vain ko. sivulla
    if ( is_page( 'tapahtumakalenteri' ) ) {
        wp_enqueue_script(
            'uuvi-tapahtumat',
            get_template_directory_uri() . '/assets/js/tapahtumat.js',
            [],
            $ver,
            true
        );
    }
} );

// ─── STT feed helper (server-side fetch with transient cache) ────────────────

function uuvi_get_stt_feed( int $count = 3 ): array {
    $cache_key = 'uuvi_stt_feed_v2';
    $cached    = get_transient( $cache_key );
    if ( $cached !== false ) {
        return $cached;
    }

    $rss_url  = 'https://www.sttinfo.fi/rss/releases/latest?publisherId=69818932';
    $response = wp_remote_get( $rss_url, [
        'timeout' => 15,
        'headers' => [ 'Accept' => 'application/rss+xml, application/xml, text/xml' ],
    ] );

    if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) !== 200 ) {
        return [];
    }

    $body = wp_remote_retrieve_body( $response );
    $xml  = @simplexml_load_string( $body );
    if ( ! $xml ) {
        return [];
    }

    $items = [];
    foreach ( $xml->channel->item as $item ) {
        $items[] = [
            'title' => (string) $item->title,
            'url'   => (string) $item->link,
            'date'  => date( 'Y-m-d', strtotime( (string) $item->pubDate ) ),
        ];
        if ( count( $items ) >= $count ) break;
    }

    set_transient( $cache_key, $items, HOUR_IN_SECONDS * 6 );
    return $items;
}

// ─── Verde RSS helper ─────────────────────────────────────────────────────────

function uuvi_get_verde_feed( int $count = 3 ): array {
    $cache_key = 'uuvi_verde_feed';
    $cached    = get_transient( $cache_key );
    if ( $cached !== false ) {
        return $cached;
    }

    $rss = fetch_feed( 'https://www.verdelehti.fi/rss/' );
    if ( is_wp_error( $rss ) ) {
        return [];
    }

    $items = [];
    foreach ( $rss->get_items( 0, $count ) as $item ) {
        $items[] = [
            'title' => esc_html( $item->get_title() ),
            'url'   => esc_url( $item->get_permalink() ),
            'date'  => $item->get_date( 'Y-m-d' ),
        ];
    }

    set_transient( $cache_key, $items, HOUR_IN_SECONDS * 6 );
    return $items;
}

// ─── WP Cron: refresh feeds every 6 hours ────────────────────────────────────

add_action( 'uuvi_refresh_feeds', function () {
    delete_transient( 'uuvi_stt_feed' );
    delete_transient( 'uuvi_verde_feed' );
    uuvi_get_stt_feed();
    uuvi_get_verde_feed();
} );

if ( ! wp_next_scheduled( 'uuvi_refresh_feeds' ) ) {
    wp_schedule_event( time(), 'sixhours', 'uuvi_refresh_feeds' );
}

add_filter( 'cron_schedules', function ( $schedules ) {
    $schedules['sixhours'] = [
        'interval' => 6 * HOUR_IN_SECONDS,
        'display'  => __( 'Kuuden tunnin välein', 'uudenmaan-vihreat' ),
    ];
    return $schedules;
} );

// ─── Front page template for translated pages ─────────────────────────────────
// Polylang redirects /sv/ → /sv/startsida/ (page's canonical URL).
// That page is then served as a regular page, not as the front page, so
// front-page.php is never chosen. This filter routes translated front pages
// (SV/EN equivalents of page_on_front) to front-page.php regardless of URL.

add_filter( 'template_include', function ( $template ) {
    if ( ! is_page() ) {
        return $template;
    }
    $fi_front = (int) get_option( 'page_on_front' );
    if ( ! $fi_front ) {
        return $template;
    }
    $post_id = get_queried_object_id();
    if ( $post_id === $fi_front ) {
        return $template; // FI front page uses front-page.php naturally
    }
    if ( function_exists( 'pll_get_post' ) ) {
        $fi_id = pll_get_post( $post_id, 'fi' );
        if ( (int) $fi_id === $fi_front ) {
            $front_tpl = get_template_directory() . '/front-page.php';
            if ( file_exists( $front_tpl ) ) {
                return $front_tpl;
            }
        }
    }
    return $template;
} );

// ─── Page template loader ─────────────────────────────────────────────────────

add_filter( 'page_template', function ( $template ) {
    if ( is_page() ) {
        $post_id = get_queried_object_id();
        $slug    = get_post_field( 'post_name', $post_id );
        $custom  = get_template_directory() . "/templates/page-{$slug}.php";
        if ( file_exists( $custom ) ) {
            return $custom;
        }

        // For multilingual (Polylang): fall back to the Finnish (default) translation's slug
        if ( function_exists( 'pll_get_post' ) ) {
            $fi_id = pll_get_post( $post_id, 'fi' );
            if ( $fi_id && $fi_id !== $post_id ) {
                $fi_slug = get_post_field( 'post_name', $fi_id );
                $custom  = get_template_directory() . "/templates/page-{$fi_slug}.php";
                if ( file_exists( $custom ) ) {
                    return $custom;
                }
                // Check if Finnish page is a hyvinvointialue sub-page
                $fi_parent_id = wp_get_post_parent_id( $fi_id );
                if ( $fi_parent_id ) {
                    $fi_parent_slug = get_post_field( 'post_name', $fi_parent_id );
                    if ( $fi_parent_slug === 'hyvinvointialueet' ) {
                        $alue = get_template_directory() . '/templates/page-alue.php';
                        if ( file_exists( $alue ) ) {
                            return $alue;
                        }
                    }
                }
            }
        }

        // Check parent slug for sub-pages
        $parent_id = wp_get_post_parent_id( $post_id );
        if ( $parent_id ) {
            $parent_slug = get_post_field( 'post_name', $parent_id );
            // Hyvinvointialueet sub-pages share one template
            if ( $parent_slug === 'hyvinvointialueet' ) {
                $alue = get_template_directory() . '/templates/page-alue.php';
                if ( file_exists( $alue ) ) {
                    return $alue;
                }
            }
        }
    }
    return $template;
} );

// ─── Excerpt length ───────────────────────────────────────────────────────────

add_filter( 'excerpt_length', fn() => 20 );
add_filter( 'excerpt_more',   fn() => '…' );

// ─── Admin notices: varoita puuttuvista laajennoksista ────────────────────────

add_action( 'admin_notices', function (): void {
    $missing = [];

    if ( ! defined( 'POLYLANG_VERSION' ) ) {
        $missing[] = sprintf(
            '<strong>Polylang</strong> — monikielisyys (FI / SV / EN). ' .
            '<a href="%s">Asenna laajennus</a>.',
            esc_url( admin_url( 'plugin-install.php?s=polylang&tab=search&type=term' ) )
        );
    }

    if ( ! function_exists( 'ics_calendar' ) && ! class_exists( 'ICS_Calendar' ) ) {
        $missing[] = sprintf(
            '<strong>ICS Calendar</strong> — tapahtumakalenteri. ' .
            '<a href="%s">Asenna laajennus</a>.',
            esc_url( admin_url( 'plugin-install.php?s=ics+calendar&tab=search&type=term' ) )
        );
    }

    if ( empty( $missing ) ) {
        return;
    }

    echo '<div class="notice notice-warning"><p>';
    echo '<strong>Uudenmaan Vihreät -teema:</strong> seuraavat laajennokset puuttuvat:</p><ul style="margin:.5rem 0 .5rem 1.5rem;list-style:disc;">';
    foreach ( $missing as $item ) {
        echo '<li>' . $item . '</li>';
    }
    echo '</ul></div>';
} );
