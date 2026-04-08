<?php get_header(); if ( have_posts() ) the_post(); ?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1>Tiedotteet</h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">
        Uudenmaan Vihreiden tiedotteet, kannanotot ja puheenvuorot medialle.
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


      <h2>Uudenmaan Vihreiden tiedotteet</h2>
      <?php
      $piiri_posts = get_posts( [ 'numberposts' => -1, 'post_status' => 'publish', 'post_type' => 'post' ] );
      if ( $piiri_posts ) : ?>
        <div class="grid-3" style="margin-bottom:2rem;">
          <?php foreach ( $piiri_posts as $p ) : setup_postdata( $p ); ?>
            <article class="card">
              <div class="card__image">
                <?php if ( has_post_thumbnail( $p ) ) : echo get_the_post_thumbnail( $p, 'card-thumb', [ 'alt' => get_the_title( $p ), 'loading' => 'lazy' ] );
                else : ?><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/placeholders/card-placeholder.jpg' ); ?>" alt="" loading="lazy"><?php endif; ?>
              </div>
              <div class="card__body">
                <p class="card__meta"><time datetime="<?php echo get_the_date( 'Y-m-d', $p ); ?>"><?php echo get_the_date( 'j.n.Y', $p ); ?></time><?php $cats = get_the_category( $p->ID ); if ( $cats ) echo ' · ' . esc_html( $cats[0]->name ); ?></p>
                <h2 class="card__title" style="font-size:1.1rem;"><a href="<?php echo get_permalink( $p ); ?>"><?php echo get_the_title( $p ); ?></a></h2>
                <p class="card__excerpt"><?php echo get_the_excerpt( $p ); ?></p>
                <a class="card__link" href="<?php echo get_permalink( $p ); ?>">Lue lisää →</a>
              </div>
            </article>
          <?php endforeach; wp_reset_postdata(); ?>
        </div>
      <?php else : ?>
        <p style="color:#666;margin-bottom:2rem;">Ei vielä omia tiedotteita.</p>
      <?php endif; ?>

      <h2>Vihreiden tiedotteet</h2>
      <p style="margin-bottom:1.5rem;">Vihreiden valtakunnalliset tiedotteet STT:n uutishuoneesta.</p>
      <?php
      $stt_items = uuvi_get_stt_feed( 10 );
      set_query_var( 'feed_items',      $stt_items );
      set_query_var( 'feed_more_url',   'https://www.sttinfo.fi/uutishuone/69818932/vihreat---de-grona' );
      set_query_var( 'feed_more_label', 'Kaikki tiedotteet STT:n uutishuoneessa →' );
      get_template_part( 'parts/feed-list' );
      ?>

      <div style="margin-top:3rem;">
        <h2>Verde-lehti</h2>
        <p style="margin-bottom:1.5rem;">Vihreät ajatukset ja tarinat Verde-lehdessä.</p>
        <?php
        $verde_items = uuvi_get_verde_feed( 5 );
        if ( $verde_items ) :
            set_query_var( 'feed_items',      $verde_items );
            set_query_var( 'feed_more_url',   'https://www.verdelehti.fi/' );
            set_query_var( 'feed_more_label', 'Lue Verde-lehteä →' );
            get_template_part( 'parts/feed-list' );
        else : ?>
          <p><a href="https://www.verdelehti.fi/" target="_blank" rel="noopener noreferrer">Siirry Verde-lehden sivuille →</a></p>
        <?php endif; ?>
      </div>

    </div>
  </section>
</main>
<?php get_footer(); ?>
