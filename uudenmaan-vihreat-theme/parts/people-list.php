<?php
/**
 * People list partial.
 *
 * Pass $people via set_query_var('people', [...]) before get_template_part().
 * Each person: [
 *   'name'    => 'Etunimi Sukunimi',
 *   'role'    => 'Nimike',
 *   'region'  => 'Alue (optional)',
 *   'email'   => 'email@example.com (optional)',
 *   'phone'   => '+358 xx xxx xxxx (optional)',
 *   'photo'   => 'absolute URL or path (optional)',
 * ]
 */
$people = get_query_var( 'people', [] );
if ( empty( $people ) ) return;
$img_dir = get_template_directory_uri() . '/assets/images/';
?>
<div class="people-grid">
  <?php foreach ( $people as $person ) : ?>
    <div class="person-card">
      <?php if ( ! empty( $person['photo'] ) ) : ?>
        <img
          class="person-card__photo"
          src="<?php echo esc_url( $person['photo'] ); ?>"
          alt="<?php echo esc_attr( $person['name'] ); ?>"
          loading="lazy"
        >
      <?php else : ?>
        <div class="person-card__photo person-card__photo--placeholder" aria-hidden="true">👤</div>
      <?php endif; ?>

      <p class="person-card__name"><?php echo esc_html( $person['name'] ); ?></p>
      <?php if ( ! empty( $person['role'] ) ) : ?>
        <p class="person-card__role"><?php echo esc_html( $person['role'] ); ?></p>
      <?php endif; ?>
      <?php if ( ! empty( $person['region'] ) ) : ?>
        <p class="person-card__region"><?php echo esc_html( $person['region'] ); ?></p>
      <?php endif; ?>

      <div class="person-card__contact">
        <?php if ( ! empty( $person['email'] ) ) : ?>
          <a href="mailto:<?php echo esc_attr( $person['email'] ); ?>">
            <?php echo esc_html( $person['email'] ); ?>
          </a><br>
        <?php endif; ?>
        <?php if ( ! empty( $person['phone'] ) ) : ?>
          <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $person['phone'] ) ); ?>">
            <?php echo esc_html( $person['phone'] ); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach; ?>
</div>
