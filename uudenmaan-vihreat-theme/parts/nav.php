<nav class="site-nav" aria-label="<?php esc_attr_e( 'Päänavigaatio', 'uudenmaan-vihreat' ); ?>">
  <?php
  wp_nav_menu( [
      'theme_location' => 'primary',
      'menu_id'        => 'primary-menu',
      'container'      => false,
      'menu_class'     => 'nav-menu',
      'fallback_cb'    => 'uuvi_fallback_nav',
  ] );
  ?>
  <?php if ( function_exists( 'pll_the_languages' ) ) : ?>
  <div class="lang-switcher lang-switcher--mobile" aria-label="<?php esc_attr_e( 'Kielivalinta', 'uudenmaan-vihreat' ); ?>">
    <?php pll_the_languages( [
        'show_flags'       => 0,
        'show_names'       => 1,
        'display_names_as' => 'slug',
        'hide_if_empty'    => 0,
        'raw'              => 0,
    ] ); ?>
  </div>
  <?php endif; ?>
</nav>

<?php
/**
 * Fallback nav — shown when no menu is assigned in wp-admin.
 * Uses Finnish page slugs as the canonical reference; uuvi_translated_url()
 * and uuvi_translated_title() return the correct language version via Polylang.
 */
function uuvi_fallback_nav(): void {
    $menu = [
        [
            'slug'     => 'ajankohtaista',
            'children' => [
                [ 'slug' => 'tiedotteet' ],
                [ 'slug' => 'tapahtumakalenteri' ],
                [ 'slug' => 'yleiskokous' ],
            ],
        ],
        [ 'slug' => 'tule-mukaan' ],
        [
            'slug'     => 'vaalit',
            'children' => [
                [ 'slug' => 'ehdokkaamme' ],
                [ 'slug' => 'vaalitavoitteemme' ],
                [ 'slug' => 'ehdolle-vaaleihin' ],
                [ 'slug' => 'aiemmat-vaalit' ],
            ],
        ],
        [
            'slug'     => 'hyvinvointialueet',
            'children' => [
                [ 'slug' => 'lansi-uusimaa' ],
                [ 'slug' => 'keski-uusimaa' ],
                [ 'slug' => 'ita-uusimaa' ],
                [ 'slug' => 'vantaa-kerava' ],
                [ 'slug' => 'hus-ja-maakunnalliset' ],
                [ 'slug' => 'kunnat' ],
            ],
        ],
        [
            'slug'     => 'yhteystiedot',
            'children' => [
                [ 'slug' => 'meista' ],
                [ 'slug' => 'medialle' ],
                [ 'slug' => 'kansanedustajat' ],
                [ 'slug' => 'piirihallitus' ],
                [ 'slug' => 'piiritoimisto' ],
            ],
        ],
    ];

    echo '<ul id="primary-menu" class="nav-menu">';
    foreach ( $menu as $item ) {
        $has_children = ! empty( $item['children'] );
        echo '<li class="' . ( $has_children ? 'has-children' : '' ) . '">';
        echo '<a href="' . esc_url( uuvi_translated_url( $item['slug'] ) ) . '">'
             . esc_html( uuvi_translated_title( $item['slug'] ) )
             . '</a>';
        if ( $has_children ) {
            echo '<ul class="sub-menu">';
            foreach ( $item['children'] as $child ) {
                echo '<li><a href="' . esc_url( uuvi_translated_url( $child['slug'] ) ) . '">'
                     . esc_html( uuvi_translated_title( $child['slug'] ) )
                     . '</a></li>';
            }
            echo '</ul>';
        }
        echo '</li>';
    }
    echo '</ul>';
}
