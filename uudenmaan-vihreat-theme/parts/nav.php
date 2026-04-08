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
</nav>

<?php
/**
 * Fallback nav — shown when no menu is assigned in wp-admin.
 * Uses Finnish page IDs as the canonical reference; uuvi_translated_url()
 * and uuvi_translated_title() return the correct language version via Polylang.
 *
 * FI page IDs:
 *   7=Ajankohtaista, 15=Tiedotteet, 14=Tapahtumakalenteri, 13=Yleiskokous,
 *   8=Tule mukaan, 9=Vaalit, 16=Vaalitavoitteemme, 17=Ehdolle vaaleihin, 229=Aiemmat vaalit,
 *   10=Hyvinvointialueet, 18=Länsi, 19=Keski, 20=Itä, 21=Vantaa-Kerava, 22=HUS, 23=Kunnat,
 *   11=Yhteystiedot, 130=Meistä, 12=Medialle, 27=Kansanedustajat, 26=Piirihallitus, 25=Toimisto
 */
function uuvi_fallback_nav(): void {
    $menu = [
        [
            'id'       => 7,
            'children' => [
                [ 'id' => 15 ],
                [ 'id' => 14 ],
                [ 'id' => 13 ],
            ],
        ],
        [ 'id' => 8 ],
        [
            'id'       => 9,
            'children' => [
                [ 'id' => 16 ],
                [ 'id' => 17 ],
                [ 'id' => 229 ],
            ],
        ],
        [
            'id'       => 10,
            'children' => [
                [ 'id' => 18 ],
                [ 'id' => 19 ],
                [ 'id' => 20 ],
                [ 'id' => 21 ],
                [ 'id' => 22 ],
                [ 'id' => 23 ],
            ],
        ],
        [
            'id'       => 11,
            'children' => [
                [ 'id' => 130 ],
                [ 'id' => 12  ],
                [ 'id' => 27  ],
                [ 'id' => 26  ],
                [ 'id' => 25  ],
            ],
        ],
    ];

    echo '<ul id="primary-menu" class="nav-menu">';
    foreach ( $menu as $item ) {
        $has_children = ! empty( $item['children'] );
        echo '<li class="' . ( $has_children ? 'has-children' : '' ) . '">';
        echo '<a href="' . esc_url( uuvi_translated_url( $item['id'] ) ) . '">'
             . esc_html( uuvi_translated_title( $item['id'] ) )
             . '</a>';
        if ( $has_children ) {
            echo '<ul class="sub-menu">';
            foreach ( $item['children'] as $child ) {
                echo '<li><a href="' . esc_url( uuvi_translated_url( $child['id'] ) ) . '">'
                     . esc_html( uuvi_translated_title( $child['id'] ) )
                     . '</a></li>';
            }
            echo '</ul>';
        }
        echo '</li>';
    }
    echo '</ul>';
}
