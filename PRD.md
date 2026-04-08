# PRD — Uudenmaan Vihreät verkkosivusto (WordPress-teema)  
Domain: uudenmaanvihreat.fi

## 1) Tausta ja tavoite
Tavoite on uudistaa Uudenmaan Vihreiden sivusto selkeäksi ja helposti ylläpidettäväksi. Ensimmäinen versio tuotetaan tiedostoina Claude Coden avulla, mutta jatkossa työntekijöiden tulee pystyä päivittämään sisältöjä käsin ilman koodia.

**Keskeinen ratkaisu:** Toteuta sivusto WordPress-teemana käyttäen Gutenberg-editoria (ei raskaita page buildereita).

## 2) Kohderyhmät
1. Vihreiden vapaaehtoiset ja jäsenet (tule mukaan, tapahtumat, materiaalit)
2. Toimittajat/media (mediasivu, yhteyshenkilöt, tiedotteet, logot/kuvat)
3. Henkilöt, joilla on selkeä piiriin liittyvä kysymys (yhteystiedot ja oikean henkilön löydettävyys)

## 3) Laajuus (Scope)
### In scope (tähän versioon)
- WordPress-teema (Gutenberg-yhteensopiva)
- Navigaatio ja sivurakenne täsmälleen alla olevan sitemapin mukaan
- Placeholder-sisällöt kaikille sivuille (lorem ipsum sallittu)
- Selkeät kuvan paikat (placeholder-kuvat tai tyyliblokit)
- Tapahtumakalenterisivu (upotuspaikka + ohje/placeholder)
- Tiedotteet- ja RSS-osioiden placeholder (sekä mahdollisuuksien mukaan toteutettu feed-komponentti)
- Brändityylit Vihreiden graafisen ohjeen mukaan (värit, typografia, ilme)

### Out of scope (tähän versioon)
- Räätälöity back office -integraatio tai käyttäjähallinta
- Täysi toiminnallinen ehdokasgalleria/vaaliplugari (vain paikat ja linkitykset)
- Julkaisualustan lopullinen valinta (tehdään ohjeistus, mutta ei lukita palveluntarjoajaa)

## 4) Informaatioarkkitehtuuri (IA) — PAKOLLINEN
### Monikielisyys
- Sivustosta tehdään identtiset versiot suomeksi, ruotsiksi ja englanniksi
- kieliversioiden välillä liikutaan yläpalkin napit Fi / Sv / En

### 4.1 Yläpalkki / Navigaatio
- Uudenmaan Vihreät -logo erillisenä logoelementtinä (visuaalisesti erillään navigaatiopalkista)
- Päänavigaatio:
  - Etusivu
  - Ajankohtaista
    - Yleiskokous
    - Tapahtumakalenteri
    - Tiedotteet
  - Tule mukaan
  - Vaalit
  - Hyvinvointialueet
    - Länsi-Uusimaa
    - Keski-Uusimaa
    - Itä-Uusimaa
    - Vantaa–Kerava
    - HUS ja maakunnalliset luottamustoimet
    - Kuntapolitiikka (oma sivu; käytännössä sama sivu kuin missä yhdistyslista)
  - Yhteystiedot
    - Meistä
    - Piiritoimisto
    - Piirihallitus
    - Medialle (alavalikossa, ei yläpalkin erillinen linkki)
    - Kansanedustajamme

### 4.2 Etusivu — osiot (järjestys)
1) Alkukuva + pääviesti (hero)  
2) Pikalinkit (kohderyhmät)
   - Vapaaehtoisille (Tule mukaan)
   - Medialle
   - Kysy piiriltä (Yhteystiedot / oikea henkilö)
3) Ajankohtaista (uusimmat)
4) Tapahtumat (kiva kuva + teksti + linkki tapahtumakalenterisivulle; tapahtumat tulevat upotuksena omalla sivullaan)
5) CTA-painikkeet
   - Liity jäseneksi
   - Lahjoita
   - Lähde ehdolle
6) Puolueen STT-tiedotteet (RSS/uutishuone listaus)
7) Verde-lehti RSS (toimitetaan myöhemmin; placeholder)

### 4.3 Ajankohtaista
- Yleiskokous = staattinen sivu (existing URL on vanhassa: /yleiskokous/; pidä tämä slug)
- Tapahtumakalenteri = erillinen sivu, johon tulee kalenteriupotus (WordPress shortcode ICS Calendar -plugin)
- Tiedotteet = feed-näkymä (STT/uutishuone + myöhemmin Verde)

### 4.4 Tule mukaan
Sivun lohkot:
- Näin pääset mukaan
- Ilmoittaudu tekijäksi (lomake/linkki)
- Mitä voin tehdä? (30 min / 2 h / 2 pv)
- Koulutus & materiaalit
- Ehdokkuus
  - Kiinnostaako ehdokkuus? (infovälisivu)
  - Lähde ehdolle (suora linkki puolueen polkuun)

### 4.5 Vaalit
Sivu pidetään rakenteessa. Sisältö voi olla placeholderia.
- Koonti + osiot (placeholder)
- Ehdokkaat: "Puolueen ehdokasgalleria plugari" = placeholder (ei toteutusta tässä PRD:ssä)

### 4.6 Hyvinvointialueet
- Aluesivut yllä olevan listan mukaan
- Paikallisyhdistykset / yhdistyslista kuuluu tähän kokonaisuuteen:
  - Kotikuntasi Vihreät (haku / A–Ö / alueittain) — placeholder-rakenne
  - Yhdistyksille “dummy-page”-pohja (mallisivu + ohje custom domain linkitykseen) — placeholder

Huom: Kuntapolitiikka on oma sivu ja käytännössä sama kuin yhdistyslista. Toteuta niin, että sisältöä voi jakaa/kierrättää (esim. sama template).

### 4.7 Yhteystiedot (Kysy piiriltä)
Alasivut ja sisältö:
- Meistä
  - Piiri lyhyesti (missio, mitä teemme)
  - Hallinto & dokumentit:
    - Säännöt
    - Toimintatavat / palvelulupaus
    - Tietosuoja
    - (valinnainen) Graafinen ohjeistus
- Piiritoimisto
  - Puheenjohtaja (kuva + placeholder-nimi)
  - Työntekijät (kuvat + roolikuvaukset)
  - Yleinen sähköposti: info@uudenmaanvihreat.fi
- Piirihallitus
  - Jäsenet ja varajäsenet
  - Piirin työalat (koulutus, vaalit, vapaaehtoiset, politiikka)
  - Vaalityöryhmän yhteystiedot
- Medialle (ks. kohta 4.8)
- Kansanedustajamme (lista + placeholder)

### 4.8 Medialle (sisältövaatimukset)
- Mediayhteyshenkilö (nimi, puh, email placeholder)
- Faktaa piiristä (nopea laatikko; placeholder)
- Viimeisimmät tiedotteet / kannanotot (feed-listaus; placeholder ok)
- Logot & kuvat (kuratoitu osio + latauslinkit; placeholder)
- Kuvapankki (linkki Google Driveen; placeholder jos URL puuttuu)

## 5) Sisältöperiaate (Placeholder)
Sivut voidaan täyttää placeholderilla.
- Jokaisella sivulla tulee olla:
  - H1-otsikko
  - ingressi (1–2 virkettä)
  - 2–5 sisältölohkoa (kortit/listat/CTA)
- Käytä selkeitä placeholder-merkintöjä:
  - `[Puheenjohtajan nimi tähän]`
  - `[Puhelinnumero tähän]`
  - `[Mediayhteyshenkilön sähköposti tähän]`
  - `[Linkki ilmoittautumislomakkeeseen tähän]`

Lorem ipsum sallittu leipätekstissä.

## 6) Valokuvat ja placeholderit
Kuvia EI tarvitse toimittaa etukäteen. Tee kuville paikat ja käytä placeholderia:
- Vaihtoehto A: paikalliset placeholder-kuvat teeman assets-kansiossa
- Vaihtoehto B: CSS “image skeleton” -blokki (ei ulkoisia riippuvuuksia)

Suositellut kuvasuhteet:
- Hero: 16:9 (mobiilissa rajautuu hyvin)
- Kortit (ajankohtaista/tapahtumat): 3:2
- Henkilökuvat: 1:1
- Teemakuvat: 16:9

Alt-tekstit: placeholderina tai kuvailevasti.

## 7) Brändi ja visuaalinen ilme (Vihreiden ohje)
Toteuta Vihreiden graafisen ohjeiston mukainen yleisilme: rauhallinen, pohjoismainen, luonnonläheinen, selkeä.

### 7.1 Värit (CSS variables / design tokens)
Pakolliset brändivärit (hex):
- Dark green (background): `#284734`
- Dark green (text): `#006845`
- Bright green: `#009639`
- Light green: `#D9EA9A`
- Black: `#000000`
- Grey: `#EBEBEC`
- White: `#FFFFFF`

Lisävärit (käytettävissä, mutta digitaalinen saavutettavuus huomioiden):
- Fire: `#F06400` (vältä digissä; jos käytät, tausta + musta teksti)
- Peach: `#F8CFA9`
- Evening: `#006272`
- Moss: `#5A5E00`
- Ochre: `#DAAA00` (vältä digissä; jos käytät, tausta + musta teksti)
- Plum: `#70273D`
- Sand: `#D6D2C4`
- Sky: `#BBDDE6`
- Oat: `#E4D77E`

### 7.2 Typografia
- Otsikot: Krana Fat A/B (jos fonttitiedostot saatavilla)
- Leipäteksti: IBM Plex Sans
- Metatiedot/tekniset: IBM Plex Mono
Fallbackit:
- Otsikot: Barlow Semi Condensed ExtraBold
- Leipäteksti: Arial

### 7.3 Logon käyttö (toteutusperiaate)
- Ensisijainen suomenkielinen logo
- Tummalla taustalla käytä valkoista “nega”-versiota
- Huomioi minimikoko ja turva-alue (ei elementtejä logon lähelle)

### 7.4 Kuvamaailman tyyli
- Henkilökuvat: luonnollinen ympäristö, auringonvalo, toiveikas/ratkaisukeskeinen
- Teemakuvat: realistinen, uskottava, ei ylikliininen

### 7.5 Graafinen materiaali
- Projektikansioon on ladattu vihreiden graafinen ohje sekä valokuvia

## 8) Integraatiot ja ulkoiset sisällöt
### 8.1 STT / Vihreät uutishuone
Lähde:
- https://www.sttinfo.fi/uutishuone/69818932/vihreat---de-grona

Toteutus:
- Etusivulle ja/tai Tiedotteet-sivulle listaus “Viimeisimmät tiedotteet”
- Ensimmäisessä versiossa riittää:
  - linkki uutishuoneeseen + placeholder-lista
- BONUS (jos helposti toteutettavissa): tee server-side fetch / WP cron + cache ja näytä otsikot (huomioi ettei lähde välttämättä tarjoa RSS/CORS-ystävällistä syötettä)

### 8.2 Verde RSS
Lähde:
- https://www.verdelehti.fi/rss/

Toteutus:
- Sivustolle uusimmat artikkelit

### 8.3 Tapahtumakalenteri (ICS Calendar)
Kalenteri on konsepti vihreästä tapahtumakalenterista. Ylläpitäjä: Jyri-Petteri Paloposki (etu.suku@vihreat.fi)

WordPress-upotusohje:
- Asenna lisäosa: “ICS Calendar”
- Lisää sivulle Shortcode-lohko, esim:
  `[ics_calendar url="https://tapahtumat.vihreaturku.fi/events.ics?city=853" view="basic" linktitles="true" format="j.n.Y"]`
- Upotettava maakunta: Uusimaa

- Huomio: URL vaihtuu region/city/organiser parametrien mukaan

## 9) Lomake “Ilmoittaudu tekijäksi”
Tämän PRD:n oletus (helpoin ylläpidolle):
- Google Forms -lomake
- Sivulle “Tule mukaan” CTA-linkki:
  `[Linkki Google Forms -lomakkeeseen tähän]`

Vaihtoehto (jos halutaan WP:ssä):
- WPForms / Contact Form 7 (ei pakollinen)

## 10) Tekninen toteutus — WordPress teema (Gutenberg)
### 10.1 Teeman tavoitteet
- Kevyt, nopea, saavutettava
- Gutenberg-lohkoihin perustuva
- Ei riippuvuutta kaupallisesta builderista
- Selkeät template-tiedostot sivuille, jotka vastaavat IA:ta

### 10.2 Repo- ja tiedostorakenne (pakollinen ehdotus)
Teema:
```

uudenmaan-vihreat-theme/
style.css
functions.php
theme.json
header.php
footer.php
front-page.php
page.php
single.php
archive.php
templates/
page-ajankohtaista.php
page-yleiskokous.php
page-tapahtumakalenteri.php
page-tiedotteet.php
page-tule-mukaan.php
page-vaalit.php
page-hyvinvointialueet.php
page-yhteystiedot.php
page-meista.php
page-piiritoimisto.php
page-piirihallitus.php
page-medialle.php
page-kansanedustajat.php
parts/
nav.php
hero.php
cta-buttons.php
feed-list.php
cards-latest.php
people-list.php
assets/
images/
logo/
vihreat-logo.svg
vihreat-logo-white.svg
placeholders/
hero-placeholder.jpg
card-placeholder.jpg
person-placeholder.jpg
fonts/
krana-fat-a.woff2
krana-fat-b.woff2
brand/
Vihreat_Identity_Guideline_v1.2.pdf
README.md

```

### 10.3 Brändiresurssit kansio
Sijoita logo/fontit/graafinen ohje tähän:
```

/assets/images/logo/
/assets/fonts/
/assets/brand/

```

### 10.4 WordPress-konfiguraatio (asetukset)
- Luo WP Menus: “Primary”
- Aseta etusivuksi “Etusivu”
- Permalinks: “Post name”
- Luo sivut valmiiksi oikeilla slugeilla:
  - `/` (Etusivu)
  - `/ajankohtaista/`
  - `/yleiskokous/`
  - `/tapahtumakalenteri/`
  - `/tiedotteet/`
  - `/tule-mukaan/`
  - `/vaalit/`
  - `/hyvinvointialueet/` + alue-alasivut
  - `/yhteystiedot/` + alasivut (meista, piiritoimisto, piirihallitus, medialle, kansanedustajat)
- Lisää sisältö blokkeina (placeholder)

## 11) Projektin perustaminen (Claude Code -ohje)
Claude Coden tulee tuottaa:
1) WordPress-teema yllä olevalla rakenteella  
2) Ohjeet paikalliseen kehitykseen (Docker-suositus)  
3) Ohjeet teeman asentamiseen olemassa olevaan WP:hen  

### 11.1 Paikallinen kehitys (suositus)
Tarjoa READMEssä joko:
- WP + Docker Compose (mariadb + wordpress)
tai
- `wp-env` (jos Node käytössä)

**Minimivaatimus:** README sisältää komennot, joilla kehittäjä saa WP:n käyntiin ja teeman käyttöön.

Esimerkki (Docker Compose -linja):
- `docker compose up -d`
- avaa `http://localhost:8080`
- asenna WP
- kopioi/aktivoi teema

### 11.2 Asennus olemassa olevaan sivustoon
README:
- zip teema
- WordPress Admin → Appearance → Themes → Add New → Upload
- Activate
- lisää menu
- luo sivut slugeilla

## 12) Saavutettavuus ja laatu
Pakolliset:
- Kontrasti: tekstillä riittävä kontrasti taustaan
- Näppäimistönavigointi: fokus-tilat näkyvät
- Semanttiset otsikot (H1 yksi per sivu)
- Linkeillä kuvaavat tekstit (ei “klikkaa tästä”)
- Kuvilla alt-tekstit (placeholder ok)
- Lomakkeissa labelit (jos WP-lomake)

## 13) SEO ja metatiedot
- Jokaiselle sivulle title + meta description (placeholder)
- Open Graph -kuva placeholderina
- Yhtenäinen sivupohjien otsikointi

## 14) Definition of Done (DoD)
Valmis, kun:
1) Navigaatio vastaa täsmälleen kohtaa 4  
2) Kaikki sivut on luotu teemapohjilla ja niissä on placeholder-sisältö  
3) Etusivulla on kaikki osiot (hero, pikalinkit, ajankohtaiset, tapahtumat-linkki, CTA:t, STT-listauspaikka, Verde-paikka)  
4) Tapahtumakalenteri-sivu sisältää ICS Calendar -shortcode -paikan ja ohjeen  
5) Ilmoittautumislinkki on olemassa (placeholder)  
6) Brändivärit ja typografiat on toteutettu (theme.json / CSS variables), fallbackit mukana  
7) Logoille on paikat ja valkoinen versio tummaan taustaan  
8) README sisältää projektin perustamisen ja käyttöönoton ohjeet  

## 15) Avoimet asiat (jätetään placeholderiksi)
- Verde RSS -URL (lisätään myöhemmin)
- Google Drive kuvapankin URL (jos ei saatavilla, placeholder)
- Lopullinen hosting (webhotelli päätetään myöhemmin)
- Monikielisyys (päätetään myöhemmin)
- Tarkat kalenteri-URLit (city/region/organiser) Uusimaa-konfiguraatiolle (lisätään myöhemmin)
