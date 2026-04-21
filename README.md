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
| Ehdokassivusto | `/vaalit2027/` | Valmis — salasanasuojattu (ei valikossa), WYSIWYG-muokattava |

### SEO-asetukset (tee ennen julkaisua)

Teema sisältää valmiit SEO-perusteet ilman lisäosaa (Open Graph, schema, canonical, leivänmurunavigaatio), mutta täysi hakukonenäkyvyys vaatii seuraavat toimet WordPress-hallinnassa.

**1. Tarkista ensin**
- Hallinta → Asetukset → Lukeminen — varmista että "Estä hakukoneet indeksoimasta tätä sivustoa" on **ilman ruksia**
- Hallinta → Asetukset → Pysyvät linkit — valitse **"Julkaisun nimi"** (`/%postname%/`)
- Hallinta → Asetukset → Yleiset — varmista että WordPress-osoite käyttää **https://**

**2. Asenna Rank Math SEO -laajennus**

Rank Math on suositeltava SEO-laajennus (ilmainen, kattavin perusominaisuuksiltaan).

1. Hallinta → Lisäosat → Lisää uusi → etsi "Rank Math SEO" → Asenna ja aktivoi
2. Suorita Rank Math -asennusvelho:
   - Sivustotyyppi: **Organisation**
   - Organisaation nimi: `Uudenmaan Vihreät`
   - Logo: käytä RGB-logoa (vaalea tausta)
   - Yhdistä Google Search Console
3. Rank Math → Otsikot ja meta → Yleiset asetukset:
   - Etusivun SEO-otsikko: `Uudenmaan Vihreät – Vihreää politiikkaa koko Uudellamaalla`
   - Etusivun metakuvaus: `Uudenmaan Vihreät on Vihreiden piirijärjestö Uudellamaalla. Teemme vihreää politiikkaa kunnissa, hyvinvointialueilla ja eduskunnassa.`
4. Rank Math → Otsikot ja meta → Artikkelit — aseta oletusskeematyypiksi **Article**
5. Rank Math → Sivustokartta — ota käyttöön XML-sivustokartta ja kuvasivustokartta

> **Huom:** Kun Rank Math on aktiivinen, teeman omat SEO-fallback-tagit (Open Graph, schema, canonical) poistuvat automaattisesti käytöstä — ei päällekkäistä koodia.

**3. Lisää sivustokartta Google Search Consoleen**

1. Avaa [Google Search Console](https://search.google.com/search-console/)
2. Lisää sivusto `https://www.uudenmaanvihreat.fi/`
3. Lähetä sivustokartta: `https://www.uudenmaanvihreat.fi/sitemap_index.xml`

**4. Aseta per-sivukohtaiset SEO-otsikot ja -kuvaukset**

Avaa jokainen sivu WordPress-editorissa ja täytä Rank Mathin meta-kentät (otsikko max. 60 merkkiä, kuvaus max. 160 merkkiä). Tärkeimmät ensin:

| Sivu | Esimerkki-otsikko |
|---|---|
| Etusivu | `Uudenmaan Vihreät – Vihreää politiikkaa Uudellamaalla` |
| Ajankohtaista | `Ajankohtaista – Uudenmaan Vihreät` |
| Tule mukaan | `Tule mukaan – Vaikuta lähellä sinua` |
| Vaalit | `Vaalit – Ehdokkaat ja vaalitavoitteet` |
| Yhteystiedot | `Yhteystiedot – Uudenmaan Vihreät` |

Aseta tietosuojaseloste-sivu **noindex**-tilaan (Rank Math → Lisäasetukset → Robots Meta).

**5. Lisää some-profiilit**

Hallinta → Ulkoasu → Mukauta → Piirin tiedot → **Some-profiilit**

Täytä Facebook- ja Instagram-URLit (X-tiliä ei ole). Footerin "Seuraa meitä" -osio ilmestyy automaattisesti kun vähintään yksi URL on asetettu.

**6. Asenna kuvien optimointilaajennus**

Asenna **ShortPixel** tai **Imagify** pakkaamaan kuvia ja muuntamaan ne WebP-muotoon automaattisesti. Tämä parantaa sivuston latausnopeutta (Core Web Vitals).

---

### Avoimet placeholder-kohdat

Etsi tiedostoista nämä merkkijonot ja korvaa oikeilla arvoilla:

| Placeholder | Sijainti | Kohde |
|---|---|---|
| `[Linkki Google Forms -lomakkeeseen tähän]` | page-tule-mukaan.php | Vapaaehtoislomake |
| Some-URLit (Instagram, Facebook) | Asetettu valmiiksi — tarkista Ulkoasu → Mukauta → Some-profiilit | X-tiliä ei ole |
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
| Sosiaalinen media | Toimii | Facebook ja Instagram asetettu oletuksena; X-tiliä ei ole |

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

## Paikallinen kehitys

### Vaihtoehto A — Docker Compose (suositeltava)

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

### Vaihtoehto B — Local by Flywheel

1. Lataa ja asenna [Local](https://localwp.com/) (ilmainen)
2. Luo uusi sivusto: **+ New site** → anna nimi → valitse PHP 8.2 → luo
3. Kopioi teemakansio Local-sivuston teemoihin:
   - **Windows:** `C:\Users\<käyttäjänimi>\Local Sites\<sivuston-nimi>\app\public\wp-content\themes\`
   - **Mac:** `~/Local Sites/<sivuston-nimi>/app/public/wp-content/themes/`
4. Avaa wp-admin (`http://<sivuston-nimi>.local/wp-admin`) → Ulkoasu → Teemat → aktivoi teema
5. Aseta kieli: Asetukset → Yleiset → Sivuston kieli → **Suomi** (teema asettaa tämän automaattisesti aktivoinnissa, mutta tarkista)

### Vaihtoehto C — wp-env (Node.js)

**Vaatimukset:** Node.js 20+, Docker

```bash
# Asenna wp-env globaalisti
npm install -g @wordpress/env

# Käynnistä (projektin juuressa)
npx wp-env start

# Avaa selaimessa: http://localhost:8888
# wp-admin: http://localhost:8888/wp-admin  (admin / password)
```

Kopioi teemakansio `wp-content/themes/`-hakemistoon tai lisää `.wp-env.json`-tiedosto projektin juureen:

```json
{
  "themes": [ "./uudenmaan-vihreat-theme" ]
}
```

### Vaihtoehto D — XAMPP / MAMP / Laragon

1. Asenna XAMPP (Windows/Linux) tai MAMP (Mac) tai Laragon (Windows)
2. Luo MySQL-tietokanta nimeltä `wordpress`
3. Lataa WordPress osoitteesta wordpress.org/download/ ja pura `htdocs/` (XAMPP) tai `www/` (MAMP/Laragon) -kansioon
4. Kopioi teemakansio `wp-content/themes/`-hakemistoon
5. Asenna WordPress selaimessa ja aktivoi teema

> **Kieliongelma kaikissa vaihtoehdoissa:** Jos sivusto käynnistyy englanniksi, teema korjaa kielen automaattisesti suomeksi heti aktivoinnin yhteydessä (`update_option('WPLANG', 'fi')`). Jos kieli on silti väärä, korjaa se manuaalisesti: Hallinta → Asetukset → Yleiset → Sivuston kieli → Suomi.

---

## Asennus olemassa olevaan WordPress-sivustoon

```bash
# 1. Pakkaa teemakansio
zip -r uudenmaan-vihreat-theme.zip uudenmaan-vihreat-theme/

# 2. WordPress-hallinta → Ulkoasu → Teemat → Lisää uusi → Lataa teema
# 3. Valitse zip-tiedosto → Asenna → Aktivoi
```

### Ensiasetukset aktivoinnin jälkeen

Teema hoitaa automaattisesti: sivujen luonnin oikeilla slugeilla, pysyvien linkkien rakenteen (`/%postname%/`), navigaatiovalikon luonnin ja etusivun asettamisen. Tarkista silti nämä:

1. **Kieli:** Hallinta → Asetukset → Yleiset → Sivuston kieli → **Suomi** (teema asettaa tämän automaattisesti, mutta tarkista jos sivusto on englanniksi)
2. **Pysyvät linkit:** Hallinta → Asetukset → Pysyvät linkit → varmista "Julkaisun nimi" → Tallenna (pakottaa mod_rewrite-sääntöjen päivityksen)
3. **Laajennokset:** asenna alla olevat laajennokset (teema näyttää adminissa varoituksen jos ne puuttuvat)
4. **Etusivu:** Hallinta → Asetukset → Lukeminen → Etusivu näyttää → Staattinen sivu → valitse "Etusivu"

### Vaadittavat laajennokset

Asenna nämä **ennen** kuin alat muokata sisältöä:

| Laajennus | Tarkoitus | Asenna |
|---|---|---|
| **Polylang** | Monikielisyys (FI / SV / EN) | Lisäosat → Lisää uusi → etsi "Polylang" |
| **ICS Calendar** | Tapahtumakalenteri | Lisäosat → Lisää uusi → etsi "ICS Calendar" |

> **Huom:** Teema toimii ilman Polylangia (sivusto on silloin pelkästään suomenkielinen), mutta monikielisyys ei toimi. Ilman ICS Calendaria tapahtumakalenteri-sivu on tyhjä. Teema näyttää adminissa varoituksen kummastakin, jos ne puuttuvat.

### Sisällön tuominen (WP Export)

Repossa on valmis sisältöexport kansiossa `db-export/`. **Tämä on suositeltava tapa** — se luo kaikki sivut oikeilla slugeilla ja sisällöillä automaattisesti, eikä sinun tarvitse luoda sivuja käsin alla olevan taulukon mukaan.

1. Hallinta → **Työkalut → Tuo → WordPress** (asenna tuoja-laajennus jos pyydetään)
2. Valitse tiedosto `db-export/uudenmaanvihret.WordPress.2026-04-21.xml`
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
│   ├── customizer.php           — Yhteystiedot + some-profiilit Customizer-paneelissa
│   ├── seo.php                  — Open Graph, Twitter Card, canonical, JSON-LD schema,
│   │                              leivänmurunavigaatio (fallback, ei käytössä jos SEO-lisäosa aktiivinen)
│   ├── henkilosto-cpt.php       — Henkilöstö Custom Post Type
│   ├── henkilosto-import.php    — Henkilöstön kuvien ja CPT-merkintöjen automaattituonti
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

---

## Yleisiä asennusongelmia

### Sivusto on englanniksi eikä suomeksi

**Oireet:** WordPress-hallinta tai sivuston teksti on englanniksi asennuksen jälkeen.

**Syy:** WordPress-asennusvelho kysyy kielen ja oletuksena on englanti. Docker-asennuksessa kieli pitää asettaa erikseen.

**Korjaus:**
1. Hallinta → Asetukset → Yleiset → Sivuston kieli → valitse **Suomi** → Tallenna
2. Teema yrittää asettaa kielen automaattisesti (`WPLANG = fi`) ensimmäisellä aktivoinnilla, mutta WordPress-asennuswizardin valinta voi ohittaa tämän.
3. Docker-asennuksessa `docker-compose.yml` sisältää nyt `WORDPRESS_CONFIG_EXTRA: "define('WPLANG', 'fi');"` — tämä toimii vain **uusissa** asennuksissa (jos kontti on jo luotu, se ei vaikuta takautuvasti).

**Jos Docker-kontti on jo olemassa ja kieli on väärä:**
```bash
# Aseta kieli suoraan tietokantaan WP-CLI:llä
docker compose exec wordpress wp option update WPLANG fi --allow-root
```

---

### Monikielisyys ei toimi / käännösvaihtoehtoa ei näy

**Oireet:** Kielivalintaa ei näy sivustolla. `uuvi_translated_url()` palauttaa suomenkielisen URL:n kaikille kielille.

**Syy:** Polylang-laajennus ei ole asennettu tai aktivoitu. Teema näyttää adminissa oranssin varoitusbannerin jos Polylang puuttuu.

**Korjaus:**
1. Lisäosat → Lisää uusi → etsi **"Polylang"** → Asenna ja aktivoi
2. Polylang käynnistää asennusvelhon — seuraa sen ohjeita
3. Aseta FI pääkieleksi ja lisää SV ja EN
4. Luo jokaiselle FI-sivulle SV- ja EN-käännössivu (Sivut → valitse sivu → "+" käännössarakkeessa)

> Teema toimii normaalisti ilman Polylangia — sivusto on silloin pelkästään suomenkielinen eikä kaadu.

---

### Tapahtumakalenteri on tyhjä

**Oireet:** `/tapahtumakalenteri/`-sivu näyttää "Ei tulevia tapahtumia" tai sivupohja puuttuu kokonaan.

**Syy A — ICS Calendar -laajennus puuttuu:**
Asenna Lisäosat → Lisää uusi → etsi **"ICS Calendar"** → Asenna ja aktivoi.

**Syy B — Kalenterin URL puuttuu:**
Teema käyttää omaa ICS-parseria (`inc/tapahtumat-parser.php`) eikä ICS Calendar -laajennosta suoraan. Varmista, että teeman ICS-URL on asetettu oikein tiedostossa `inc/tapahtumat-parser.php`.

---

### Sivut on luotu mutta niillä on väärä pohja (näyttää pelkän tekstin)

**Oireet:** Sivu kuten `/tule-mukaan/` näyttää vain otsikon ilman visuaalista rakennetta.

**Syy:** WordPress-sivun `_wp_page_template`-meta ei ole asetettu, tai sivu on luotu ennen kuin teema tunnisti sen slugin.

**Korjaus:** Poista sivu ja anna teeman luoda se uudelleen:
```bash
# Nollaa teeman sivujen luontimerkki jotta setup ajetaan uudelleen
docker compose exec wordpress wp option delete uuvi_pages_created --allow-root
# Päivitä sivu selaimessa — teema luo sivut uudelleen
```
Tai manuaalisesti: Sivut → valitse ongelmasivu → Sivupohja (oikea palkki) → valitse oikea pohja.

---

### "Ei konfiguraatiotiedostoa" Docker Compose -komennossa

**Oireet:** `docker compose` palauttaa `no configuration file provided: not found`.

**Syy:** Komento ajetaan väärästä hakemistosta.

**Korjaus:** Siirry ensin projektikansioon. Huomaa **välilyönti** kansion nimessä:
```bash
cd "/home/santeri-leinonen/Documents/Ohjelmointiprojektit/Vihreät/UUVI verkkosivut "
docker compose up -d
```
