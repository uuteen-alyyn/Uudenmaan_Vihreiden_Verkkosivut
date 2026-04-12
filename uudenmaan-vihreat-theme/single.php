<?php
/**
 * Single post template.
 */
get_header();
?>
<main id="main-content">
  <?php while ( have_posts() ) : the_post(); ?>
    <div class="page-hero">
      <div class="container">
        <h1><?php the_title(); ?></h1>
        <p class="ingress" style="color:rgba(255,255,255,.75);margin-top:.5rem;font-size:1rem;">
          <time datetime="<?php the_date( 'Y-m-d' ); ?>"><?php the_date( 'j.n.Y' ); ?></time>
          <?php
          $cats = get_the_category();
          if ( $cats ) echo ' · ' . esc_html( $cats[0]->name );
          ?>
        </p>
      </div>
    </div>
    <?php uuvi_breadcrumb_html(); ?>
    <div class="page-content">
      <div class="container">
        <?php if ( has_post_thumbnail() ) : ?>
          <div style="margin-bottom:2rem;border-radius:8px;overflow:hidden;">
            <?php the_post_thumbnail( 'large', [ 'alt' => get_the_title(), 'style' => 'width:100%;height:auto;' ] ); ?>
          </div>
        <?php endif; ?>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
        <div style="margin-top:2.5rem;padding-top:1.5rem;border-top:1px solid var(--color-grey);">
          <a class="btn btn--outline" href="<?php echo esc_url( home_url( '/ajankohtaista/' ) ); ?>">← Takaisin uutisiin</a>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
</main>
<?php get_footer(); ?>
