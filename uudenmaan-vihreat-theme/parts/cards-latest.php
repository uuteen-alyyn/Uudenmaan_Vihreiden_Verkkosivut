<?php
/**
 * Latest posts cards partial.
 * Displays the 3 most recent posts in a 3-column card grid.
 */
$args  = [
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
];
$posts = new WP_Query( $args );

if ( ! $posts->have_posts() ) {
    // Placeholder-kortit kun artikkeleita ei ole vielä julkaistu
    $placeholder_imgs = [
        get_template_directory_uri() . '/assets/images/placeholders/card-placeholder.jpg',
        get_template_directory_uri() . '/assets/images/placeholders/card-2.jpg',
        get_template_directory_uri() . '/assets/images/placeholders/card-3.jpg',
    ];
    echo '<div class="grid-3">';
    for ( $i = 0; $i < 3; $i++ ) {
        echo '<article class="card">';
        echo '<div class="card__image"><img src="' . esc_url( $placeholder_imgs[ $i ] ) . '" alt="" loading="lazy"></div>';
        echo '<div class="card__body">';
        echo '<p class="card__meta">Tulossa pian</p>';
        echo '<h3 class="card__title">Uusi artikkeli tulossa</h3>';
        echo '<p class="card__excerpt">Lisää artikkeleita julkaistaan pian. Lisää ensimmäinen artikkeli WordPress-hallinnassa.</p>';
        echo '</div></article>';
    }
    echo '</div>';
    return;
}
?>
<div class="grid-3">
  <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
    <article class="card">
      <div class="card__image">
        <?php if ( has_post_thumbnail() ) : ?>
          <?php the_post_thumbnail( 'card-thumb', [ 'alt' => get_the_title(), 'loading' => 'lazy' ] ); ?>
        <?php else : ?>
          <img
            src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/placeholders/card-placeholder.jpg' ); ?>"
            alt=""
            loading="lazy"
          >
        <?php endif; ?>
      </div>
      <div class="card__body">
        <p class="card__meta">
          <time datetime="<?php the_date( 'Y-m-d' ); ?>"><?php the_date( 'j.n.Y' ); ?></time>
          <?php
          $cats = get_the_category();
          if ( $cats ) {
              echo ' · <span>' . esc_html( $cats[0]->name ) . '</span>';
          }
          ?>
        </p>
        <h3 class="card__title">
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <p class="card__excerpt"><?php the_excerpt(); ?></p>
        <a class="card__link" href="<?php the_permalink(); ?>">Lue lisää →</a>
      </div>
    </article>
  <?php endwhile; wp_reset_postdata(); ?>
</div>
