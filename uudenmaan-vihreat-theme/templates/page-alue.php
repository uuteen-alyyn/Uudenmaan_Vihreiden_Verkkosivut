<?php
/**
 * Shared template for all hyvinvointialue sub-pages.
 */
get_header();
if ( have_posts() ) the_post();
$title = get_the_title();
$slug  = basename( get_permalink() );
$hva   = get_template_directory_uri() . '/assets/images/hva/';

// Ryhmäkuvat slugin mukaan (Keski-Uusimaasta ei ole)
$ryhma_map = [
    'lansi-uusimaa'  => $hva . 'ryhma-lansi-uusimaa.png',
    'ita-uusimaa'    => $hva . 'ryhma-ita-uusimaa.png',
    'vantaa-kerava'  => $hva . 'ryhma-vantaa-kerava.png',
];
// Karttakuvat slugin mukaan
$kartta_map = [
    'lansi-uusimaa'  => $hva . 'kartta-lansi-uusimaa.png',
    'keski-uusimaa'  => $hva . 'kartta-keski-uusimaa.png',
    'ita-uusimaa'    => $hva . 'kartta-ita-uusimaa.png',
    'vantaa-kerava'  => $hva . 'kartta-vantaa-kerava.png',
];
$ryhma_url  = $ryhma_map[ $slug ]  ?? '';
$kartta_url = $kartta_map[ $slug ] ?? '';
?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1><?php echo esc_html( $title ); ?></h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">
        Vihreät vaikuttavat <?php echo esc_html( $title ); ?>n hyvinvointialueella — sosiaali- ja terveyspalveluissa sekä alueen kehittämisessä.
      </p>
    </div>
  </div>
  <section class="section">
    <div class="container">

      <?php if ( $ryhma_url ) : ?>
      <div style="margin-bottom:2rem;border-radius:8px;overflow:hidden;aspect-ratio:16/9;">
        <img src="<?php echo esc_url( $ryhma_url ); ?>" alt="<?php echo esc_attr( $title ); ?> – ryhmäkuva" loading="lazy" style="width:100%;height:100%;object-fit:cover;">
      </div>
      <?php endif; ?>

      <?php if ( get_the_content() ) : ?>
        <div class="entry-content"><?php the_content(); ?></div>
      <?php else : ?>
        <div class="entry-content">
          <h2>Luottamushenkilöt</h2>
          <p>[Luottamushenkilöiden nimet tähän]</p>
          <h2 style="margin-top:2rem;">Ajankohtaista alueelta</h2>
          <p>[Ajankohtainen sisältö tähän]</p>
          <h2 style="margin-top:2rem;">Yhteystiedot</h2>
          <p>[Yhteystiedot tähän]</p>
        </div>
      <?php endif; ?>

      <?php if ( $kartta_url ) : ?>
      <div style="margin-top:2.5rem;">
        <img src="<?php echo esc_url( $kartta_url ); ?>" alt="<?php echo esc_attr( $title ); ?> – kartta" loading="lazy" style="max-width:100%;border-radius:8px;">
      </div>
      <?php endif; ?>

      <p style="margin-top:2.5rem;">
        <a class="btn btn--outline" href="<?php echo esc_url( home_url( '/hyvinvointialueet/' ) ); ?>">← Kaikki hyvinvointialueet</a>
      </p>
    </div>
  </section>
</main>
<?php get_footer(); ?>
