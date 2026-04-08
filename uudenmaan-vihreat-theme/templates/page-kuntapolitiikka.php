<?php get_header(); ?>
<main id="main-content">
  <div class="page-hero">
    <div class="container">
      <h1>Kuntapolitiikka</h1>
      <p class="ingress" style="color:rgba(255,255,255,.85);">
        Paikallisyhdistykset ja kuntavaikuttaminen ympäri Uusimaata.
      </p>
    </div>
  </div>
  <section class="section">
    <div class="container">
      <h2>Kotikuntasi Vihreät</h2>
      <p>Löydä oman kuntasi Vihreät alta tai käytä hakua.</p>

      <div class="highlight-box" style="margin:2rem 0;">
        <h3>Paikallisyhdistyslistaus</h3>
        <p>[Yhdistyslista A–Ö tähän — voidaan rakentaa alueittain tai hakutoiminnolla]</p>
      </div>

      <h2 style="margin-top:2.5rem;">Perusta tai kehitä yhdistystä</h2>
      <p>Haluatko perustaa Vihreiden paikallisyhdistyksen kuntaasi tai kehittää olemassa olevaa? Autamme alkuun.</p>
      <ul style="list-style:disc;padding-left:1.5rem;margin-top:1rem;">
        <li><a href="[Linkki mallisääntöihin tähän]">Mallisäännöt paikallisyhdistykselle</a></li>
        <li><a href="[Linkki ohjeeseen tähän]">Ohje custom domain -linkitykseen</a></li>
        <li><a href="mailto:info@uudenmaanvihreat.fi">Ota yhteyttä piiriin</a></li>
      </ul>

      <p style="margin-top:2.5rem;">
        <a class="btn btn--outline" href="<?php echo esc_url( home_url( '/hyvinvointialueet/' ) ); ?>">← Hyvinvointialueet</a>
      </p>
    </div>
  </section>
</main>
<?php get_footer(); ?>
