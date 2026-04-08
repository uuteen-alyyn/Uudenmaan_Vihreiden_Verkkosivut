<?php
/**
 * index.php — WordPress-teeman pakollinen fallback-pohja.
 * Ohjaa archive.php:hen jos mikään muu template ei täsmää.
 */
get_header();
?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1><?php bloginfo( 'name' ); ?></h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);"><?php bloginfo( 'description' ); ?></p>
    </div>
  </div>
  <section class="section">
    <div class="container">
      <?php if ( have_posts() ) : ?>
        <div class="grid-3">
          <?php while ( have_posts() ) : the_post(); ?>
            <article class="card">
              <div class="card__image">
                <?php if ( has_post_thumbnail() ) :
                  the_post_thumbnail( 'card-thumb', [ 'alt' => get_the_title(), 'loading' => 'lazy' ] );
                else : ?>
                  <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/placeholders/card-placeholder.jpg' ); ?>" alt="" loading="lazy">
                <?php endif; ?>
              </div>
              <div class="card__body">
                <h2 class="card__title" style="font-size:1.1rem;">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <p class="card__excerpt"><?php the_excerpt(); ?></p>
                <a class="card__link" href="<?php the_permalink(); ?>">Lue lisää →</a>
              </div>
            </article>
          <?php endwhile; ?>
        </div>
      <?php else : ?>
        <p>Ei sisältöä.</p>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php get_footer(); ?>
