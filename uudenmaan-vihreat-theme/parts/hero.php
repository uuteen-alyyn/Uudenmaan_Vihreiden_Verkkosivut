<?php
/**
 * Hero partial.
 *
 * Pass args via set_query_var() before get_template_part():
 *   h1        string  Heading text
 *   ingress   string  Subheading / ingress text
 *   image_url string  Absolute URL to hero image (optional)
 *   cta       array   [ ['label'=>'', 'url'=>'', 'style'=>'btn--white'] ]
 */
$h1        = get_query_var( 'hero_h1',        '' );
$ingress   = get_query_var( 'hero_ingress',   '' );
$image_url = get_query_var( 'hero_image',     '' );
$ctas      = get_query_var( 'hero_ctas',      [] );
?>
<section class="hero" aria-label="Hero">
  <?php if ( $image_url ) : ?>
    <img class="hero__image" src="<?php echo esc_url( $image_url ); ?>" alt="" aria-hidden="true" loading="eager" fetchpriority="high">
  <?php endif; ?>
  <div class="hero__overlay" aria-hidden="true"></div>
  <div class="container">
    <div class="hero__content">
      <?php if ( $h1 ) : ?>
        <h1><?php echo esc_html( $h1 ); ?></h1>
      <?php endif; ?>
      <?php if ( $ingress ) : ?>
        <p class="ingress"><?php echo esc_html( $ingress ); ?></p>
      <?php endif; ?>
      <?php if ( $ctas ) : ?>
        <div class="hero__actions">
          <?php foreach ( $ctas as $cta ) : ?>
            <a href="<?php echo esc_url( $cta['url'] ); ?>" class="btn <?php echo esc_attr( $cta['style'] ?? 'btn--white' ); ?>"<?php if ( ! empty( $cta['external'] ) ) echo ' target="_blank" rel="noopener noreferrer"'; ?>>
              <?php echo esc_html( $cta['label'] ); ?>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
