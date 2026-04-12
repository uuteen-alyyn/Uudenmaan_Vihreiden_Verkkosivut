<?php
/**
 * Uudenmaan Vihreät — SEO helpers
 *
 * Outputs:
 *  - Preconnect hints for Google Fonts (always)
 *  - Self-referencing canonical URL   (fallback — skipped when SEO plugin active)
 *  - Open Graph + Twitter Card tags   (fallback — skipped when SEO plugin active)
 *  - Organization JSON-LD schema      (fallback — skipped when SEO plugin active)
 *  - NewsArticle JSON-LD schema       (fallback — skipped when SEO plugin active)
 *  - BreadcrumbList JSON-LD schema    (fallback — skipped when SEO plugin active)
 *  - Breadcrumb HTML nav              (always, for UX and Rank Math can replace via its own output)
 */

defined( 'ABSPATH' ) || exit;

// ─── Detect active SEO plugins ───────────────────────────────────────────────

function uuvi_seo_plugin_active(): bool {
    return defined( 'RANK_MATH_VERSION' )  // Rank Math
        || defined( 'WPSEO_VERSION' )       // Yoast SEO
        || defined( 'AIOSEO_VERSION' );     // All in One SEO
}

// ─── Preconnect hints for Google Fonts ───────────────────────────────────────
// Priority 1 so these appear before the stylesheet <link> tags.

add_action( 'wp_head', function (): void {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}, 1 );

// ─── Self-referencing canonical URL (fallback) ───────────────────────────────

add_action( 'wp_head', function (): void {
    if ( uuvi_seo_plugin_active() ) {
        return;
    }

    if ( is_singular() ) {
        $canonical = get_permalink();
    } elseif ( is_front_page() ) {
        $canonical = home_url( '/' );
    } elseif ( is_home() ) {
        $page_id   = (int) get_option( 'page_for_posts' );
        $canonical = $page_id ? get_permalink( $page_id ) : home_url( '/ajankohtaista/' );
    } elseif ( is_category() || is_tag() || is_tax() ) {
        $term      = get_queried_object();
        $canonical = get_term_link( $term );
    } else {
        return;
    }

    if ( ! empty( $canonical ) && ! is_wp_error( $canonical ) ) {
        echo '<link rel="canonical" href="' . esc_url( $canonical ) . '">' . "\n";
    }
}, 5 );

// ─── Open Graph + Twitter Card meta tags (fallback) ──────────────────────────

add_action( 'wp_head', function (): void {
    if ( uuvi_seo_plugin_active() ) {
        return;
    }

    $site_name   = get_bloginfo( 'name' );
    $default_img = get_template_directory_uri() . '/assets/images/placeholders/hero-luonto.jpg';

    $og_type      = 'website';
    $og_title     = '';
    $og_desc      = '';
    $og_url       = '';
    $og_image     = $default_img;
    $og_image_alt = '';

    if ( is_singular() ) {
        global $post;
        setup_postdata( $post );

        $og_type  = is_singular( 'post' ) ? 'article' : 'website';
        $og_title = get_the_title();
        $og_url   = get_permalink();

        // Description: excerpt → trimmed content → site description
        if ( has_excerpt() ) {
            $og_desc = wp_strip_all_tags( get_the_excerpt() );
        } else {
            $og_desc = wp_trim_words( wp_strip_all_tags( get_the_content() ), 30, '…' );
        }

        if ( has_post_thumbnail() ) {
            $thumb_id  = get_post_thumbnail_id();
            $img_data  = wp_get_attachment_image_src( $thumb_id, 'large' );
            $og_image  = $img_data ? $img_data[0] : $default_img;
            $og_image_alt = (string) get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
        }

        wp_reset_postdata();

    } elseif ( is_front_page() ) {
        $og_title = get_bloginfo( 'name' );
        $og_desc  = get_bloginfo( 'description' );
        $og_url   = home_url( '/' );

    } elseif ( is_home() ) {
        $og_title = __( 'Ajankohtaista', 'uudenmaan-vihreat' ) . ' — ' . $site_name;
        $og_desc  = __( 'Uutisia, kannanottoja ja tietoa Uudenmaan Vihreiden toiminnasta.', 'uudenmaan-vihreat' );
        $page_id  = (int) get_option( 'page_for_posts' );
        $og_url   = $page_id ? get_permalink( $page_id ) : home_url( '/ajankohtaista/' );

    } elseif ( is_category() || is_tag() ) {
        $og_title = get_the_archive_title() . ' — ' . $site_name;
        $og_desc  = wp_strip_all_tags( (string) get_the_archive_description() );
        $term     = get_queried_object();
        $og_url   = (string) get_term_link( $term );
    }

    if ( ! $og_title ) {
        return;
    }

    $og_title = esc_attr( $og_title );
    $og_desc  = esc_attr( $og_desc );
    ?>
    <!-- Open Graph -->
    <meta property="og:type"         content="<?php echo esc_attr( $og_type ); ?>">
    <meta property="og:site_name"    content="<?php echo esc_attr( $site_name ); ?>">
    <meta property="og:title"        content="<?php echo $og_title; ?>">
    <meta property="og:description"  content="<?php echo $og_desc; ?>">
    <meta property="og:url"          content="<?php echo esc_url( $og_url ); ?>">
    <meta property="og:image"        content="<?php echo esc_url( $og_image ); ?>">
    <meta property="og:image:width"  content="1200">
    <meta property="og:image:height" content="630">
    <?php if ( $og_image_alt ) : ?>
    <meta property="og:image:alt"    content="<?php echo esc_attr( $og_image_alt ); ?>">
    <?php endif; ?>
    <!-- Twitter Card -->
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="<?php echo $og_title; ?>">
    <meta name="twitter:description" content="<?php echo $og_desc; ?>">
    <meta name="twitter:image"       content="<?php echo esc_url( $og_image ); ?>">
    <?php
}, 10 );

// ─── Organization JSON-LD schema ─────────────────────────────────────────────

add_action( 'wp_footer', function (): void {
    if ( uuvi_seo_plugin_active() ) {
        return;
    }

    $schema = [
        '@context' => 'https://schema.org',
        '@type'    => 'Organization',
        'name'     => 'Uudenmaan Vihreät ry',
        'url'      => home_url( '/' ),
        'logo'     => [
            '@type' => 'ImageObject',
            'url'   => get_template_directory_uri() . '/assets/images/logo/Vihreat_Logo_HOR_RGB_FIN_SWE.png',
        ],
        'contactPoint' => [
            '@type'       => 'ContactPoint',
            'email'       => 'info@uudenmaanvihreat.fi',
            'contactType' => 'customer service',
        ],
        'address' => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => 'Mannerheimintie 15b, A-porras, 4. krs',
            'postalCode'      => '00260',
            'addressLocality' => 'Helsinki',
            'addressCountry'  => 'FI',
        ],
    ];

    echo '<script type="application/ld+json">'
        . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
        . '</script>' . "\n";
}, 20 );

// ─── NewsArticle JSON-LD schema for single posts ─────────────────────────────

add_action( 'wp_footer', function (): void {
    if ( ! is_singular( 'post' ) ) {
        return;
    }
    if ( uuvi_seo_plugin_active() ) {
        return;
    }

    global $post;
    setup_postdata( $post );

    $schema = [
        '@context'      => 'https://schema.org',
        '@type'         => 'NewsArticle',
        'headline'      => get_the_title(),
        'datePublished' => get_the_date( 'c' ),
        'dateModified'  => get_the_modified_date( 'c' ),
        'url'           => get_permalink(),
        'inLanguage'    => get_bloginfo( 'language' ),
        'publisher'     => [
            '@type' => 'Organization',
            'name'  => 'Uudenmaan Vihreät ry',
            'logo'  => [
                '@type' => 'ImageObject',
                'url'   => get_template_directory_uri() . '/assets/images/logo/Vihreat_Logo_HOR_RGB_FIN_SWE.png',
            ],
        ],
    ];

    if ( has_post_thumbnail() ) {
        $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
        if ( $img ) {
            $schema['image'] = [
                '@type'  => 'ImageObject',
                'url'    => $img[0],
                'width'  => $img[1],
                'height' => $img[2],
            ];
        }
    }

    if ( has_excerpt() ) {
        $schema['description'] = wp_strip_all_tags( get_the_excerpt() );
    }

    wp_reset_postdata();

    echo '<script type="application/ld+json">'
        . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
        . '</script>' . "\n";
}, 20 );

// ─── BreadcrumbList JSON-LD schema ───────────────────────────────────────────

add_action( 'wp_footer', function (): void {
    if ( is_front_page() ) {
        return;
    }
    if ( uuvi_seo_plugin_active() ) {
        return;
    }

    $crumbs = uuvi_get_breadcrumbs();
    if ( count( $crumbs ) < 2 ) {
        return;
    }

    $items = [];
    foreach ( $crumbs as $i => $crumb ) {
        $items[] = [
            '@type'    => 'ListItem',
            'position' => $i + 1,
            'name'     => $crumb['name'],
            'item'     => $crumb['url'],
        ];
    }

    $schema = [
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $items,
    ];

    echo '<script type="application/ld+json">'
        . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
        . '</script>' . "\n";
}, 20 );

// ─── Breadcrumb data builder ──────────────────────────────────────────────────

/**
 * Returns an ordered array of breadcrumb items for the current page.
 * Each item: [ 'name' => string, 'url' => string ]
 */
function uuvi_get_breadcrumbs(): array {
    $crumbs = [
        [
            'name' => __( 'Etusivu', 'uudenmaan-vihreat' ),
            'url'  => function_exists( 'pll_home_url' ) ? pll_home_url() : home_url( '/' ),
        ],
    ];

    if ( is_singular( 'post' ) ) {
        $cats = get_the_category();
        if ( $cats ) {
            $crumbs[] = [
                'name' => esc_html( $cats[0]->name ),
                'url'  => get_category_link( $cats[0]->term_id ),
            ];
        }
        $crumbs[] = [
            'name' => get_the_title(),
            'url'  => get_permalink(),
        ];

    } elseif ( is_page() ) {
        $ancestors = array_reverse( get_post_ancestors( get_queried_object_id() ) );
        foreach ( $ancestors as $ancestor_id ) {
            $crumbs[] = [
                'name' => get_the_title( $ancestor_id ),
                'url'  => get_permalink( $ancestor_id ),
            ];
        }
        $crumbs[] = [
            'name' => get_the_title(),
            'url'  => get_permalink(),
        ];

    } elseif ( is_category() ) {
        $crumbs[] = [
            'name' => single_cat_title( '', false ),
            'url'  => (string) get_term_link( get_queried_object() ),
        ];

    } elseif ( is_tag() ) {
        $crumbs[] = [
            'name' => single_tag_title( '', false ),
            'url'  => (string) get_term_link( get_queried_object() ),
        ];
    }

    return $crumbs;
}

// ─── Breadcrumb HTML output ───────────────────────────────────────────────────

/**
 * Renders the visible breadcrumb nav.
 * Call this from templates where breadcrumbs are appropriate (pages, single posts).
 * Does nothing on the front page.
 */
function uuvi_breadcrumb_html(): void {
    if ( is_front_page() ) {
        return;
    }

    // When Rank Math is active, it can output its own breadcrumb HTML via
    // rank_math_the_breadcrumbs(). Prefer that if available.
    if ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
        echo '<nav class="breadcrumb container" aria-label="' . esc_attr__( 'Navigointipolku', 'uudenmaan-vihreat' ) . '">';
        rank_math_the_breadcrumbs();
        echo '</nav>';
        return;
    }

    $crumbs = uuvi_get_breadcrumbs();
    if ( count( $crumbs ) < 2 ) {
        return;
    }

    echo '<nav class="breadcrumb container" aria-label="' . esc_attr__( 'Navigointipolku', 'uudenmaan-vihreat' ) . '">';
    foreach ( $crumbs as $i => $crumb ) {
        $is_last = ( $i === count( $crumbs ) - 1 );
        if ( $is_last ) {
            echo '<span aria-current="page">' . esc_html( $crumb['name'] ) . '</span>';
        } else {
            echo '<span><a href="' . esc_url( $crumb['url'] ) . '">' . esc_html( $crumb['name'] ) . '</a></span>';
        }
    }
    echo '</nav>';
}
