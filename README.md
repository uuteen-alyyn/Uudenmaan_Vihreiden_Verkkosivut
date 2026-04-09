# Uudenmaan Vihreät — WordPress-teema

WordPress-teema osoitteelle [uudenmaanvihreat.fi](https://www.uudenmaanvihreat.fi/).
Gutenberg-yhteensopiva, ei riippuvuutta kaupallisesta page builderista.
Kolmikielinen: **FI / SV / EN** (Polylang 3.8+).

---

## Sivuston nykytila

### Valmiit sivut

| Sivu | URL | Tila |
|---|---|---|
| Etusivu | `/` | Valmis — hero, pikavalinnat, ajankohtaista, tapahtumat-linkki, CTA-napit, uutiskirje, STT-feed, Verde-feed |
| Ajankohtaista | `/ajankohtaista/` | Valmis |
| Yleiskokous | `/yleiskokous/` | Valmis — kuva + sisältö |
| Tapahtumakalenteri | `/tapahtumakalenteri/` | Valmis — custom ICS-parseri, filtterit (kategoria + kaupunki), manuaalinen päivitysnappi |
| Tiedotteet | `/ajankohtaista/tiedotteet/` | Valmis — omat tiedotteet + STT-feed + Verde-feed |
| Tule mukaan | `/tule-mukaan/` | Valmis |
| Vaalit | `/vaalit/` | Valmis |
| — Vaalitavoitteemme | `/vaalit/vaalitavoitteemme/` | Valmis |
| — Ehdolle vaaleihin | `/vaalit/ehdolle-vaaleihin/` | Valmis — kuva + sisältö |
| — Aiemmat vaalit | `/vaalit/aiemmat-vaalit/` | Valmis — vaalit 2003–2025 taulukoina |
| Hyvinvointialueet ja kunnat | `/hyvinvointialueet/` | Valmis |
| — Länsi-Uusimaa | `/hyvinvointialueet/lansi-uusimaa/` | Valmis — ryhmäkuva + karttakuva |
| — Keski-Uusimaa | `/hyvinvointialueet/keski-uusimaa/` | Valmis — karttakuva |
| — Itä-Uusimaa | `/hyvinvointialueet/ita-uusimaa/` | Valmis — ryhmäkuva + karttakuva |
| — Vantaa–Kerava | `/hyvinvointialueet/vantaa-kerava/` | Valmis — ryhmäkuva + karttakuva |
| — HUS ja maakunnalliset | `/hyvinvointialueet/hus-ja-maakunnalliset/` | Valmis |
| — Kuntapolitiikka | `/hyvinvointialueet/kunnat/` | Valmis — 25 kuntakorttia yhdistyslinkeillä |
| Yhteystiedot | `/yhteystiedot/` | Valmis — kortit käyttävät käännettyä URL:ia |
| — Meistä | `/meista/` | Valmis — tietosuojalinkki käännetty |
| — Piiritoimisto | `/yhteystiedot/piiritoimisto/` | Valmis — henkilöstökortit CPT:stä, laskutustiedot käännetty |
| — Piirihallitus | `/yhteystiedot/piirihallitus/` | Valmis |
| — Kansanedustajamme | `/yhteystiedot/kansanedustajat/` | Valmis |
| Medialle | `/medialle/` | Valmis — mediayhteyshenkilöt, faktalaatikko, omat tiedotteet, STT-feed, logot |
| Tietosuojaseloste | `/tietosuojaseloste/` | Valmis — alkuperäisen sivuston teksti + Google Docs -linkit |

### Avoimet placeholder-kohdat

Etsi tiedostoista nämä merkkijonot ja korvaa oikeilla arvoilla:

| Placeholder | Sijainti | Kohde |
|---|---|---|
| `[Linkki Google Forms -lomakkeeseen tähän]` | page-tule-mukaan.php | Vapaaehtoislomake |
| `[Facebook-URL tähän]` | footer.php | Facebook-sivu |
| `[Instagram-URL tähän]` | footer.php | Instagram-tili |
| `[X-URL tähän]` | footer.php | X (Twitter) -tili |
| `[Google Drive -URL tähän]` | page-medialle.php | Kuvapankki |
| `[Latauslinkki tähän]` | page-medialle.php | Logotiedostojen latauslinkit |
| `[lkm]` | faktalaatikot | Numerot jotka muuttuvat |

### Ulkoiset integraatiot

| Integraatio | Tila | Huomio |
|---|---|---|
| ICS-tapahtumakalenteri | Toimii | URL: `https://tapahtumat.vihreaturku.fi/events.ics?region=01` — välimuisti 1 h, manuaalinen päivitysnappi adminille |
| STT-uutisfeed | Toimii | Vihreät-uutishuone, välimuisti 1 h |
| Verde RSS | Toimii | verdelehti.fi/rss/, välimuisti 1 h |
| Uutiskirje | Toimii | actionnetwork.org/forms/uutiskirje |
| Sosiaalinen media | Placeholder | Facebook, Instagram, X-linkit puuttuvat |

---

## Monikielisyys (FI / SV / EN)

Sivusto käyttää **Polylang**-laajennosta. Jokaisesta FI-sivusta luodaan SV- ja EN-käännössivu WP-adminissa.

### Käännöstiedostot

```
languages/
├── uudenmaan-vihreat.pot      — Lähdetiedosto (kaikki merkkijonot)
├── uudenmaan-vihreat-sv_SE.po — Ruotsinkieliset käännökset (muokattava)
├── uudenmaan-vihreat-sv_SE.mo — Käännetty binääri (generoitu)
├── uudenmaan-vihreat-en_US.po — Englanninkieliset käännökset (muokattava)
└── uudenmaan-vihreat-en_US.mo — Käännetty binääri (generoitu)
```

Muokkaa aina `.po`-tiedostoa, jonka jälkeen generoi `.mo`-tiedosto. Koska host-käyttäjällä ei ole kirjoitusoikeutta Docker-kontin tiedostoihin, kompiloi `.mo` näin:

```bash
# Kompiloi .po → .mo Python-skriptillä (msgfmt ei tarvita)
python3 compile_po.py languages/uudenmaan-vihreat-sv_SE.po /tmp/uudenmaan-vihreat-sv_SE.mo

# Kopioi konttiin
docker cp /tmp/uudenmaan-vihreat-sv_SE.mo wordpress:/tmp/
docker exec wordpress cp /tmp/uudenmaan-vihreat-sv_SE.mo \
  /var/www/html/wp-content/themes/uudenmaan-vihreat-theme/languages/
```

### Apufunktiot käännetyille linkeille

Kaikki sivupohjat käyttävät FI-sivutunnisteita navigointilinkeissä:

```php
uuvi_translated_url( int $fi_page_id )   // palauttaa käännetyn sivun URL:n
uuvi_translated_title( int $fi_page_id ) // palauttaa käännetyn sivun otsikon
```

Tärkeimmät FI-sivutunnisteet:

| ID | Sivu |
|---|---|
| 7 | Ajankohtaista |
| 8 | Tule mukaan |
| 9 | Vaalit |
| 10 | Hyvinvointialueet |
| 11 | Yhteystiedot |
| 12 | Medialle |
| 13 | Yleiskokous |
| 17 | Ehdolle vaaleihin |
| 25 | Piiritoimisto |
| 26 | Piirihallitus |
| 27 | Kansanedustajat |
| 130 | Meistä |

---

## Paikallinen kehitys (Docker Compose)

**Vaatimukset:** Docker Desktop tai Docker Engine + Compose v2

```bash
# 1. Käynnistä WordPress + MariaDB
docker compose up -d

# 2. Avaa selaimessa
open http://localhost:8081

# 3. Asenna WordPress (seuraa ohjattua asennusta)
#    Tietokanta-asetukset täytetään automaattisesti docker-compose.yml:stä

# 4. Aktivoi teema
#    WordPress-hallinta → Ulkoasu → Teemat → Uudenmaan Vihreät → Aktivoi
```

Teeman tiedostot on liitetty Docker-volyymiin — muutokset näkyvät suoraan selaimessa ilman kontin uudelleenkäynnistystä.

```bash
# Pysäytä
docker compose down

# Pysäytä ja poista data (aloita puhtaalta)
docker compose down -v
```

---

## Asennus olemassa olevaan WordPress-sivustoon

```bash
# 1. Pakkaa teemakansio
zip -r uudenmaan-vihreat-theme.zip uudenmaan-vihreat-theme/

# 2. WordPress-hallinta → Ulkoasu → Teemat → Lisää uusi → Lataa teema
# 3. Valitse zip-tiedosto → Asenna → Aktivoi
```

### Ensiasetukset aktivoinnin jälkeen

1. **Pysyvät linkit:** Hallinta → Asetukset → Pysyvät linkit → "Julkaisun nimi" → Tallenna
2. **Valikko:** Hallinta → Ulkoasu → Valikot → Luo valikko ja aseta sijaintiin "Päänavigaatio"
3. **Etusivu:** Hallinta → Asetukset → Lukeminen → Etusivu näyttää → Staattinen sivu → valitse "Etusivu"
4. **Polylang:** Asenna ja aktivoi Polylang-laajennus. Luo käännössivut jokaiselle FI-sivulle.

### Sisällön tuominen (WP Export)

Repossa on valmis sisältöexport kansiossa `db-export/`. **Tämä on suositeltava tapa** — se luo kaikki sivut oikeilla slugeilla ja sisällöillä automaattisesti, eikä sinun tarvitse luoda sivuja käsin alla olevan taulukon mukaan.

1. Hallinta → **Työkalut → Tuo → WordPress** (asenna tuoja-laajennus jos pyydetään)
2. Valitse tiedosto `db-export/uudenmaanvihret.WordPress.2026-04-09.xml`
3. Klikkaa **Lataa tiedosto ja tuo**
4. Valitse tekijäksi oma WordPress-käyttäjäsi
5. Ruksaa **Lataa ja tuo liitetiedostot** jos haluat kuvat mukaan
6. Klikkaa **Lähetä**

> **Huom:** Export päivitetään aina kun sivujen sisältöä muutetaan merkittävästi. Uusin versio löytyy aina `db-export/`-kansiosta.

### Luo sivut näillä slugeilla

| Sivu | Slug | Yläsivu |
|---|---|---|
| Etusivu | `etusivu` | — |
| Ajankohtaista | `ajankohtaista` | — |
| Yleiskokous | `yleiskokous` | Ajankohtaista |
| Tapahtumakalenteri | `tapahtumakalenteri` | Ajankohtaista |
| Tiedotteet | `tiedotteet` | Ajankohtaista |
| Tule mukaan | `tule-mukaan` | — |
| Vaalit | `vaalit` | — |
| Vaalitavoitteemme | `vaalitavoitteemme` | Vaalit |
| Ehdolle vaaleihin | `ehdolle-vaaleihin` | Vaalit |
| Aiemmat vaalit | `aiemmat-vaalit` | Vaalit |
| Hyvinvointialueet ja kunnat | `hyvinvointialueet` | — |
| Länsi-Uusimaa | `lansi-uusimaa` | Hyvinvointialueet |
| Keski-Uusimaa | `keski-uusimaa` | Hyvinvointialueet |
| Itä-Uusimaa | `ita-uusimaa` | Hyvinvointialueet |
| Vantaa–Kerava | `vantaa-kerava` | Hyvinvointialueet |
| HUS ja maakunnalliset | `hus-ja-maakunnalliset` | Hyvinvointialueet |
| Kuntapolitiikka | `kunnat` | Hyvinvointialueet |
| Yhteystiedot | `yhteystiedot` | — |
| Meistä | `meista` | — |
| Piiritoimisto | `piiritoimisto` | Yhteystiedot |
| Piirihallitus | `piirihallitus` | Yhteystiedot |
| Kansanedustajamme | `kansanedustajat` | Yhteystiedot |
| Medialle | `medialle` | — |
| Tietosuojaseloste | `tietosuojaseloste` | — |

---

## Sisällön päivittäminen

### Tavallinen tekstisisältö

Suurin osa sivuista käyttää `the_content()` — muokkaa sisältöä suoraan WordPress-editorista (**Sivut → valitse sivu → Muokkaa**).

Poikkeukset — nämä sivut renderöivät sisällön PHP-templatesta, ei editorista:

| Sivu | Template | Mitä muokataan |
|---|---|---|
| Kuntapolitiikka | `templates/page-kunnat.php` | Kuntien tiedot suoraan PHP-arrayssä |
| Aiemmat vaalit | `templates/page-aiemmat-vaalit.php` | Vaalitulokset HTML-taulukoissa |
| Hyvinvointialueet-lista | `templates/page-hyvinvointialueet.php` | Korttien kuvaukset PHP-arrayssä |
| Yhteystiedot-lista | `templates/page-yhteystiedot.php` | Korttien kuvaukset PHP-arrayssä |

### Artikkelit (Ajankohtaista)

Uudet tiedotteet ja uutiset lisätään normaalisti **Artikkelit → Lisää uusi**. Artikkelin kuva asetetaan editorin oikeasta sivupalkista kohdasta **Pääkuva** — jos pääkuvaa ei aseteta, artikkeli näytetään kuvattomana.

### Henkilöstö (piiritoimisto)

Henkilöstö hallitaan Custom Post Type -rakenteella:

1. WordPress-hallinta → **Henkilöstö → Lisää uusi**
2. Täytä: nimi, titteli, sähköposti, puhelin, kuva
3. Aseta **Ryhmä**-taksonomiasta oikea ryhmä: `Johto`, `Poliittiset sihteerit`, `Paikallisyhdistykset`, `Vaalityöntekijät`
4. Julkaise — henkilö ilmestyy automaattisesti piiritoimisto-sivulle

### Tapahtumakalenteri

Tapahtumat haetaan automaattisesti ICS-syötteestä tunnin välein. Voit pakottaa päivityksen:

- Kirjaudu sisään adminina
- Avaa `/tapahtumakalenteri/`
- Klikkaa **"Päivitä kalenteri"** -linkkiä sivun yläreunassa

### Faktalaatikko (medialle-sivu)

Päivitä luvut suoraan tiedostossa `templates/page-medialle.php`:

```php
<div class="fact-item__value">1 500</div>  <!-- Jäseniä -->
<div class="fact-item__value">25</div>     <!-- Kuntaa -->
<div class="fact-item__value">3</div>      <!-- Kansanedustajia -->
<div class="fact-item__value">97</div>     <!-- Valtuutettuja -->
```

### Vaalitulokset (aiemmat vaalit)

Lisää uusi rivi tiedostossa `templates/page-aiemmat-vaalit.php` oikean taulukon `<tbody>`-osioon:

```html
<tr><td>2029</td><td>XX XXX</td><td>XX,X %</td><td>X</td></tr>
```

### Tietosuojaseloste

Sisältö on tallennettu WordPress-tietokantaan — muokkaa normaalisti editorista sivulla `/tietosuojaseloste/`.

### Yhteystiedot (puheenjohtaja, toiminnanjohtaja)

Päivitä WordPress-hallinnasta: **Ulkoasu → Mukauta → Yhteystiedot**

### Kuntapolitiikka-kortit

Muokkaa tiedostoa `templates/page-kunnat.php` — jokainen kunta on yksi taulukkorivi PHP-arrayssä:

```php
[ 'kunta' => 'Espoo', 'yhdistys' => 'Espoon Vihreät', 'yh_url' => '...', 'yh_pj' => '...', 'yh_email' => '...', 'vr_pj' => '...', 'vr_email' => '...' ],
```

---

## Teeman rakenne

```
uudenmaan-vihreat-theme/
├── style.css                    — Teemaotsikko (versio)
├── theme.json                   — Gutenberg design tokens (värit, typografia)
├── functions.php                — Enqueue, valikot, kuva-ajot, feed-haut, template loader,
│                                  uuvi_translated_url/title() apufunktiot
├── header.php / footer.php      — Sivuston ylä- ja alaosa
├── front-page.php               — Etusivu (myös SV/EN etusivut template_include-filtterin kautta)
├── page.php / single.php / archive.php
├── inc/
│   ├── setup-pages.php          — Sivujen ja valikkojen luonti asennuksessa
│   ├── customizer.php           — Yhteystiedot Customizer-paneelissa
│   ├── henkilosto-cpt.php       — Henkilöstö Custom Post Type
│   └── tapahtumat-parser.php    — ICS-kalenteri parseri + [uuvi_tapahtumat]-shortcode
├── templates/
│   ├── page-ajankohtaista.php
│   ├── page-yleiskokous.php
│   ├── page-tapahtumakalenteri.php
│   ├── page-tiedotteet.php
│   ├── page-tule-mukaan.php
│   ├── page-vaalit.php
│   ├── page-aiemmat-vaalit.php
│   ├── page-hyvinvointialueet.php   — Kortit käyttävät uuvi_translated_url/title()
│   ├── page-alue.php                — Jaettu pohja hyvinvointialueille
│   ├── page-kunnat.php              — Kuntapolitiikka (25 kuntaa)
│   ├── page-yhteystiedot.php        — Kortit käyttävät uuvi_translated_url/title()
│   ├── page-meista.php
│   ├── page-piiritoimisto.php
│   ├── page-piirihallitus.php
│   ├── page-medialle.php
│   ├── page-kansanedustajat.php
│   └── page-tietosuojaseloste.php
├── parts/
│   ├── nav.php
│   ├── hero.php
│   ├── cta-buttons.php
│   ├── feed-list.php
│   ├── cards-latest.php
│   └── people-list.php
├── languages/
│   ├── uudenmaan-vihreat.pot
│   ├── uudenmaan-vihreat-sv_SE.po / .mo
│   └── uudenmaan-vihreat-en_US.po / .mo
└── assets/
    ├── css/main.css             — Kaikki tyylit
    ├── js/main.js               — Navigaatio + toiminnallisuudet
    ├── js/tapahtumat.js         — Tapahtumakalenteri-filtterit
    ├── images/
    │   ├── logo/                — Vihreiden logot (RGB + NEG)
    │   ├── hva/                 — Hyvinvointialueiden ryhmä- ja karttakuvat
    │   ├── staff/               — Henkilöstön kuvat
    │   └── placeholders/
    └── fonts/                   — Krana Fat A/B (.woff2)
```
