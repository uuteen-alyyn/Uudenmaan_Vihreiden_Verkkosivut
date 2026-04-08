<?php get_header(); if ( have_posts() ) the_post(); ?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1>Ajankohtaista</h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">
        Uutisia, kannanottoja ja tietoa Uudenmaan Vihreiden toiminnasta.
      </p>
    </div>
  </div>
  <section class="section">
    <div class="container">
      <?php if ( get_the_content() ) : ?>
      <div class="entry-content" style="margin-bottom:2rem;">
        <?php the_content(); ?>
      </div>
      <?php endif; ?>

      <?php
      $paged = get_query_var( 'paged' ) ?: 1;
      $query = new WP_Query( [ 'post_type' => 'post', 'posts_per_page' => 9, 'paged' => $paged ] );
      if ( $query->have_posts() ) :
      ?>
        <div class="grid-3">
          <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <article class="card">
              <div class="card__image">
                <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'card-thumb', [ 'alt' => get_the_title(), 'loading' => 'lazy' ] );
                else : ?><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/placeholders/card-placeholder.jpg' ); ?>" alt="" loading="lazy"><?php endif; ?>
              </div>
              <div class="card__body">
                <p class="card__meta"><time datetime="<?php the_date( 'Y-m-d' ); ?>"><?php the_date( 'j.n.Y' ); ?></time><?php $cats = get_the_category(); if ( $cats ) echo ' · ' . esc_html( $cats[0]->name ); ?></p>
                <h2 class="card__title" style="font-size:1.1rem;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p class="card__excerpt"><?php the_excerpt(); ?></p>
                <a class="card__link" href="<?php the_permalink(); ?>">Lue lisää →</a>
              </div>
            </article>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div style="margin-top:3rem;display:flex;justify-content:center;gap:1rem;">
          <?php
          $prev = get_previous_posts_link( '← Uudemmat', $query->max_num_pages );
          $next = get_next_posts_link( 'Vanhemmat →', $query->max_num_pages );
          if ( $prev ) echo '<span class="btn btn--outline">' . $prev . '</span>';
          if ( $next ) echo '<span class="btn btn--outline">' . $next . '</span>';
          ?>
        </div>
      <?php else : ?>
        <p>Ei vielä artikkeleita.</p>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php get_footer(); ?>
