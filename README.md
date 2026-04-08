# Uudenmaan Vihreät — WordPress-teema

WordPress-teema osoitteelle [uudenmaanvihreat.fi](https://www.uudenmaanvihreat.fi/).
Gutenberg-yhteensopiva, ei riippuvuutta kaupallisesta page builderista.

---

## Paikallinen kehitys (Docker Compose)

**Vaatimukset:** Docker Desktop tai Docker Engine + Compose v2

```bash
# 1. Käynnistä WordPress + MariaDB
docker compose up -d

# 2. Avaa selaimessa
open http://localhost:8080

# 3. Asenna WordPress (seuraa ohjattua asennusta)
#    Tietokanta-asetukset täytetään automaattisesti docker-compose.yml:stä

# 4. Aktivoi teema
#    WordPress-hallinta → Ulkoasu → Teemat → Uudenmaan Vihreät → Aktivoi

# 5. Luo menu
#    Hallinta → Ulkoasu → Valikot → Luo "Päänavigaatio" ja aseta sijaintiin "Päänavigaatio"
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

1. **Pysyvät linkit:** Hallinta → Asetukset → Pysyvät linkit → Valitse "Julkaisun nimi" → Tallenna
2. **Valikko:** Hallinta → Ulkoasu → Valikot → Luo valikko ja aseta sijaintiin "Päänavigaatio"
3. **Etusivu:** Hallinta → Asetukset → Lukeminen → Etusivu näyttää → Staattinen sivu → valitse "Etusivu"

### Luo sivut näillä slugeilla

| Sivu | Slug |
|---|---|
| Etusivu | `/` |
| Ajankohtaista | `/ajankohtaista/` |
| Yleiskokous | `/yleiskokous/` |
| Tapahtumakalenteri | `/tapahtumakalenteri/` |
| Tiedotteet | `/tiedotteet/` |
| Tule mukaan | `/tule-mukaan/` |
| Vaalit | `/vaalit/` |
| Hyvinvointialueet | `/hyvinvointialueet/` |
| — Länsi-Uusimaa | `/hyvinvointialueet/lansi-uusimaa/` |
| — Keski-Uusimaa | `/hyvinvointialueet/keski-uusimaa/` |
| — Itä-Uusimaa | `/hyvinvointialueet/ita-uusimaa/` |
| — Vantaa–Kerava | `/hyvinvointialueet/vantaa-kerava/` |
| — HUS ja maakunnalliset | `/hyvinvointialueet/hus-ja-maakunnalliset/` |
| — Kuntapolitiikka | `/hyvinvointialueet/kuntapolitiikka/` |
| Yhteystiedot | `/yhteystiedot/` |
| — Meistä | `/yhteystiedot/meista/` |
| — Piiritoimisto | `/yhteystiedot/piiritoimisto/` |
| — Piirihallitus | `/yhteystiedot/piirihallitus/` |
| Medialle | `/medialle/` |
| — Kansanedustajamme | `/yhteystiedot/kansanedustajat/` |

### Asenna lisäosat

- **ICS Calendar** — tapahtumakalenteria varten (`/tapahtumakalenteri/`)

---

## Teeman rakenne

```
uudenmaan-vihreat-theme/
├── style.css           — Teemaotsikko
├── theme.json          — Gutenberg design tokens (värit, typografia)
├── functions.php       — Enqueue, valikot, kuva-ajot, feed-haut
├── header.php          — Sivuston yläosa + navigaatio
├── footer.php          — Sivuston alaosa
├── front-page.php      — Etusivu (7 osiota)
├── page.php            — Yleinen sivupohja
├── single.php          — Yksittäinen artikkeli
├── archive.php         — Artikkeliarkisto
├── templates/          — Sivukohtaiset pohjat
│   ├── page-ajankohtaista.php
│   ├── page-yleiskokous.php
│   ├── page-tapahtumakalenteri.php
│   ├── page-tiedotteet.php
│   ├── page-tule-mukaan.php
│   ├── page-vaalit.php
│   ├── page-hyvinvointialueet.php
│   ├── page-alue.php           — Jaettu pohja hyvinvointialueille
│   ├── page-kuntapolitiikka.php
│   ├── page-yhteystiedot.php
│   ├── page-meista.php
│   ├── page-piiritoimisto.php
│   ├── page-piirihallitus.php
│   ├── page-medialle.php
│   └── page-kansanedustajat.php
├── parts/              — Uudelleenkäytettävät osat
│   ├── nav.php
│   ├── hero.php
│   ├── cta-buttons.php
│   ├── feed-list.php
│   ├── cards-latest.php
│   └── people-list.php
└── assets/
    ├── css/main.css    — Kaikki tyylit
    ├── js/main.js      — Navigaatio + pienet toiminnallisuudet
    ├── images/
    │   ├── logo/       — Vihreiden logot (RGB + NEG)
    │   ├── staff/      — Henkilöstön kuvat
    │   └── placeholders/
    └── fonts/          — Krana Fat A/B (.woff2, jos saatavilla)
```

---

## Avoimet placeholder-kohdat

Etsi tiedostoista nämä merkkijonot ja korvaa oikeilla arvoilla:

| Placeholder | Kohde |
|---|---|
| `[Linkki puolueen jäsenrekisteriin tähän]` | Vihreiden jäseneksi liittyminen |
| `[Linkki lahjoitussivulle tähän]` | Lahjoitussivu |
| `[Linkki puolueen ehdokassivulle tähän]` | Ehdokkaaksi ilmoittautuminen |
| `[Linkki Google Forms -lomakkeeseen tähän]` | Vapaaehtoislomake |
| `[Uusimaa-kalenteri-URL tähän]` | ICS-kalenteri URL |
| `[Facebook-URL tähän]` | Facebook-sivu |
| `[Instagram-URL tähän]` | Instagram-tili |
| `[X-URL tähän]` | X (Twitter) -tili |
| `[Google Drive -URL tähän]` | Kuvapankki |
| `[Tietosuoja-linkki tähän]` | Tietosuojaseloste |
| `[Mediayhteyshenkilön nimi tähän]` | Mediavastaava |
| `[Mediayhteyshenkilön sähköposti tähän]` | Mediavastaavan sähköposti |
