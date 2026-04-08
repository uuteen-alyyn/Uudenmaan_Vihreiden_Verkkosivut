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
 * Update the WP menu in Ulkoasu → Valikot to override this.
 */
function uuvi_fallback_nav(): void {
    $menu = [
        [ 'label' => 'Ajankohtaista', 'url' => home_url( '/ajankohtaista/' ), 'children' => [
            [ 'label' => 'Tiedotteet',         'url' => home_url( '/tiedotteet/' ) ],
            [ 'label' => 'Tapahtumakalenteri', 'url' => home_url( '/tapahtumakalenteri/' ) ],
            [ 'label' => 'Yleiskokous',        'url' => home_url( '/yleiskokous/' ) ],
        ]],
        [ 'label' => 'Tule mukaan', 'url' => home_url( '/tule-mukaan/' ) ],
        [ 'label' => 'Vaalit',      'url' => home_url( '/vaalit/' ), 'children' => [
            [ 'label' => 'Vaalitavoitteemme', 'url' => home_url( '/vaalit/vaalitavoitteemme/' ) ],
            [ 'label' => 'Ehdolle vaaleihin', 'url' => home_url( '/vaalit/ehdolle-vaaleihin/' ) ],
        ]],
        [ 'label' => 'Hyvinvointialueet ja kunnat', 'url' => home_url( '/hyvinvointialueet/' ), 'children' => [
            [ 'label' => 'Länsi-Uusimaa',             'url' => home_url( '/hyvinvointialueet/lansi-uusimaa/' ) ],
            [ 'label' => 'Keski-Uusimaa',             'url' => home_url( '/hyvinvointialueet/keski-uusimaa/' ) ],
            [ 'label' => 'Itä-Uusimaa',               'url' => home_url( '/hyvinvointialueet/ita-uusimaa/' ) ],
            [ 'label' => 'Vantaa–Kerava',             'url' => home_url( '/hyvinvointialueet/vantaa-kerava/' ) ],
            [ 'label' => 'HUS ja maakunnalliset',     'url' => home_url( '/hyvinvointialueet/hus-ja-maakunnalliset/' ) ],
            [ 'label' => 'Kunnat',                    'url' => home_url( '/hyvinvointialueet/kunnat/' ) ],
        ]],
        [ 'label' => 'Yhteystiedot', 'url' => home_url( '/yhteystiedot/' ), 'children' => [
            [ 'label' => 'Meistä',             'url' => home_url( '/meista/' ) ],
            [ 'label' => 'Medialle',           'url' => home_url( '/medialle/' ) ],
            [ 'label' => 'Kansanedustajamme',  'url' => home_url( '/yhteystiedot/kansanedustajat/' ) ],
            [ 'label' => 'Piirihallitus',      'url' => home_url( '/yhteystiedot/piirihallitus/' ) ],
            [ 'label' => 'Toimisto',           'url' => home_url( '/yhteystiedot/piiritoimisto/' ) ],
        ]],
    ];

    echo '<ul id="primary-menu" class="nav-menu">';
    foreach ( $menu as $item ) {
        $has_children = ! empty( $item['children'] );
        echo '<li class="' . ( $has_children ? 'has-children' : '' ) . '">';
        echo '<a href="' . esc_url( $item['url'] ) . '">' . esc_html( $item['label'] ) . '</a>';
        if ( $has_children ) {
            echo '<ul class="sub-menu">';
            foreach ( $item['children'] as $child ) {
                echo '<li><a href="' . esc_url( $child['url'] ) . '">' . esc_html( $child['label'] ) . '</a></li>';
            }
            echo '</ul>';
        }
        echo '</li>';
    }
    echo '</ul>';
}
