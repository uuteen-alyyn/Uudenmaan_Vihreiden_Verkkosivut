<?php
/**
 * Archive / blog index template.
 */
get_header();
?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1><?php
        if ( is_category() ) {
            single_cat_title();
        } elseif ( is_tag() ) {
            echo 'Tagi: '; single_tag_title();
        } else {
            esc_html_e( 'Ajankohtaista', 'uudenmaan-vihreat' );
        }
      ?></h1>
      <p class="ingress" style="color:rgba(255,255,255,.8);">
        <?php esc_html_e( 'Uutisia, kannanottoja ja tietoa Uudenmaan Vihreiden toiminnasta.', 'uudenmaan-vihreat' ); ?>
      </p>
    </div>
  </div>

  <section class="section">
    <div class="container">
      <?php if ( have_posts() ) : ?>
        <div class="grid-3">
          <?php while ( have_posts() ) : the_post(); ?>
            <article class="card">
              <div class="card__image">
                <?php if ( has_post_thumbnail() ) : ?>
                  <?php the_post_thumbnail( 'card-thumb', [ 'alt' => get_the_title(), 'loading' => 'lazy' ] ); ?>
                <?php else : ?>
                  <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/placeholders/card-placeholder.jpg' ); ?>" alt="" loading="lazy">
                <?php endif; ?>
              </div>
              <div class="card__body">
                <p class="card__meta">
                  <time datetime="<?php the_date( 'Y-m-d' ); ?>"><?php the_date( 'j.n.Y' ); ?></time>
                  <?php $cats = get_the_category(); if ( $cats ) echo ' · ' . esc_html( $cats[0]->name ); ?>
                </p>
                <h2 class="card__title" style="font-size:1.1rem;">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <p class="card__excerpt"><?php the_excerpt(); ?></p>
                <a class="card__link" href="<?php the_permalink(); ?>">Lue lisää →</a>
              </div>
            </article>
          <?php endwhile; ?>
        </div>

        <div style="margin-top:3rem;display:flex;justify-content:center;gap:1rem;">
          <?php
          $prev = get_previous_posts_link( '← Uudemmat' );
          $next = get_next_posts_link( 'Vanhemmat →' );
          if ( $prev ) echo '<span class="btn btn--outline">' . $prev . '</span>';
          if ( $next ) echo '<span class="btn btn--outline">' . $next . '</span>';
          ?>
        </div>

      <?php else : ?>
        <p>Ei artikkeleita.</p>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php get_footer(); ?>
