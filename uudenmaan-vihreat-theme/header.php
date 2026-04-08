<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main-content"><?php esc_html_e( 'Siirry pääsisältöön', 'uudenmaan-vihreat' ); ?></a>

<header class="site-header" role="banner">
  <div class="container site-header__inner">

    <!-- Logo -->
    <a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php bloginfo( 'name' ); ?> — etusivu">
      <?php
      if ( has_custom_logo() ) {
          the_custom_logo();
      } else {
          $logo = get_template_directory_uri() . '/assets/images/logo/Vihreat_Logo_HOR_NEG_FIN_SWE.png';
          echo '<img src="' . esc_url( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" width="200" height="48">';
      }
      ?>
    </a>

    <!-- Nav toggle (mobile) -->
    <button class="nav-toggle" aria-expanded="false" aria-controls="primary-menu" aria-label="<?php esc_attr_e( 'Avaa valikko', 'uudenmaan-vihreat' ); ?>">
      <span class="hamburger" aria-hidden="true"></span>
    </button>

    <!-- Primary navigation -->
    <?php get_template_part( 'parts/nav' ); ?>

    <!-- Language switcher -->
    <?php if ( function_exists( 'pll_the_languages' ) ) : ?>
    <div class="lang-switcher" aria-label="<?php esc_attr_e( 'Kielivalinta', 'uudenmaan-vihreat' ); ?>">
      <?php pll_the_languages( [
          'show_flags'       => 0,
          'show_names'       => 1,
          'display_names_as' => 'slug',
          'hide_if_empty'    => 0,
          'raw'              => 0,
      ] ); ?>
    </div>
    <?php endif; ?>

  </div>
</header>
