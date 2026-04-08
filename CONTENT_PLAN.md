# Content Plan — Uudenmaan Vihreät verkkosivusto

Per-page breakdown of blocks, images, text, and interactive elements.
Text marked `[COPY FROM LIVE SITE]` should be pasted in manually from https://www.uudenmaanvihreat.fi/

---

## Etusivu (`/`)

### 1. Hero
- **Kuva:** `Ryhmäkuva luonnossa.jpg` (16:9, cropped for mobile)
- **H1:** Rakennetaan parempaa Uusimaata yhdessä
- **Ingressi:** Uudenmaan Vihreät tekee vihreää politiikkaa kaikkialla Uudellamaalla — kunnissa, hyvinvointialueilla ja eduskunnassa.
- **CTA-painike:** "Tule mukaan" → `/tule-mukaan/`

### 2. Pikalinkit (3 korttia, kohderyhmittäin)
| Kortti | Otsikko | Teksti | Linkki | Kuva |
|---|---|---|---|---|
| Vapaaehtoisille | Tule mukaan toimintaan | Lyhyt kutsu (1 virke) | `/tule-mukaan/` | `Kampanjointia teltalla.jpg` |
| Medialle | Medialle | Yhteystiedot ja tiedotteet | `/medialle/` | `Tarinankerrontaa ryhmässä.jpg` |
| Kysy piiriltä | Ota yhteyttä | Löydä oikea henkilö | `/yhteystiedot/` | `Kolme ihmistä lähikuva.jpg` |

### 3. Ajankohtaista (3 uusinta artikkelia)
- **Otsikko:** "Ajankohtaista"
- Dynaaminen WP-artikkelilista (3 kpl), korttiformaatti 3:2
- Kortin rakenne: kuva + kategoria + otsikko + päivämäärä
- Placeholder-kortti kuva: `Iloisia ihmisiä lähikuva.jpg`
- **"Kaikki uutiset" -linkki** → `/ajankohtaista/`

### 4. Tapahtumat
- **Otsikko:** "Tapahtumat"
- **Kuva:** `Yleiskokouskuva.jpg` (3:2)
- **Teksti:** Tule mukaan Uudenmaan Vihreiden tapahtumiin — tavatkaamme, keskustellaan ja tehdään politiikkaa yhdessä.
- **CTA:** "Katso tapahtumakalenteri" → `/tapahtumakalenteri/`

### 5. CTA-painikkeet (3 kpl vierekkäin)
- "Liity jäseneksi" → `[Linkki puolueen jäsenrekisteriin tähän]`
- "Lahjoita" → `[Linkki lahjoitussivulle tähän]`
- "Lähde ehdolle" → `[Linkki puolueen ehdokassivulle tähän]`
- **Taustaväri:** `#284734` (dark green), valkoinen teksti

### 6. STT / Uutishuone-tiedotteet
- **Otsikko:** "Viimeisimmät tiedotteet"
- Placeholder-lista (3 kpl) + linkki uutishuoneeseen
- Tavoite: server-side WP cron fetch → `https://www.sttinfo.fi/uutishuone/69818932/vihreat---de-grona`

### 7. Verde-lehti
- **Otsikko:** "Verde-lehti"
- Placeholder: Vihreät ajatukset, tarinat ja puheenvuorot koottuna Verde-lehdessä.
- RSS-lähde: `https://www.verdelehti.fi/rss/` (lisätään myöhemmin)
- **CTA:** "Lue Verde-lehteä" → `[URL tähän]`

---

## Ajankohtaista (`/ajankohtaista/`)

### Rakenne
- **H1:** "Ajankohtaista"
- **Ingressi:** Uutisia, kannanottoja ja tietoa Uudenmaan Vihreiden toiminnasta.
- WP-artikkeliarkisto, grid-näkymä (3 saraketta), paginaatio
- Kortissa: kuva (3:2) + otsikko + päivämäärä + kategoria
- Placeholder-artikkelit: 3–6 kpl lorem ipsum -sisällöllä

### Alasivut

#### Yleiskokous (`/yleiskokous/`) — säilytä tämä slug
- **H1:** "Yleiskokous"
- **Ingressi:** Yleiskokous on Uudenmaan Vihreiden ylin päättävä elin, joka kokoontuu kerran vuodessa.
- Sisältölohkot:
  1. Mitä yleiskokous on: Yleiskokouksessa jäsenet valitsevat piirin hallituksen, hyväksyvät toimintasuunnitelman ja budjetin sekä päättävät piirin keskeisistä linjauksista. Jokainen jäsen voi osallistua ja vaikuttaa.
  2. Seuraava yleiskokous: päivämäärä + paikka `[Tiedot tähän]`
  3. Materiaalit / pöytäkirjat: lista `[Linkki tähän]`
  4. CTA: "Ilmoittaudu" → `[Linkki tähän]`

#### Tapahtumakalenteri (`/tapahtumakalenteri/`)
- **H1:** "Tapahtumakalenteri"
- **Ingressi:** "Uudenmaan Vihreiden tulevat tapahtumat"
- ICS Calendar -shortcode -paikka:
  ```
  [ics_calendar url="[Uusimaa-kalenteri-URL tähän]" view="basic" linktitles="true" format="j.n.Y"]
  ```
- Ohjeteksti ylläpitäjälle: miten shortcode päivitetään

#### Tiedotteet (`/tiedotteet/`)
- **H1:** "Tiedotteet"
- **Ingressi:** Uudenmaan Vihreiden tiedotteet, kannanotot ja puheenvuorot medialle.
- Feed-listaus: STT/uutishuone + Verde (placeholder ok)
- Linkki: "Kaikki tiedotteet uutishuoneessa" → STT-URL

---

## Tule mukaan (`/tule-mukaan/`)

- **H1:** "Tule mukaan"
- **Ingressi:** Vihreä politiikka syntyy ihmisten yhteisestä tekemisestä. Löydä oma tapasi vaikuttaa.
- **Hero-kuva:** `Kampanjointia teltalla 2.jpg`

### Lohkot
1. **Näin pääset mukaan** — vaiheistettu lista tai ikonit:
   1. Liity jäseneksi — Jäsenyys on helppo tapa tukea vihreää politiikkaa ja saada äänesi kuuluviin.
   2. Ilmoittaudu vapaaehtoiseksi — Tule mukaan kampanjointiin, tapahtumiin tai hallintoon.
   3. Osallistu tapahtumiin — Kokous, koulutus tai kahvitilaisuus — tervetuloa sellaisena kuin olet.
2. **Ilmoittaudu tekijäksi** — CTA-painike: "Ilmoittaudu tekijäksi" → `[Linkki Google Forms -lomakkeeseen tähän]`
3. **Mitä voin tehdä?** — 3 korttia:
   | Kortti | Otsikko | Teksti |
   |---|---|---|
   | 1 | 30 minuuttia | Jaa julkaisu somessa, allekirjoita vetoomus tai ota yhteyttä kansanedustajaan. Pienetkin teot merkitsevät. |
   | 2 | 2 tuntia | Tule mukaan tapahtumaan tai kokoukseen. Tapaat samanmielisiä ihmisiä ja opit lisää vihreästä politiikasta. |
   | 3 | 2 päivää | Osallistu kampanjointiin vaalien alla tai lähde mukaan talkooviikonloppuun. Tehdään yhdessä näkyviä tuloksia. |
   - Kuva: `Iloisia ihmisiä_pienryhmä.jpg`
4. **Koulutus & materiaalit** — Tarjoamme jäsenille ja aktiiveille koulutuksia politiikasta, viestinnästä ja vaikuttamisesta. Lista + linkit `[Linkit tähän]`
5. **Kiinnostaako ehdokkuus?** — Vihreät tarvitsee rohkeita ehdokkaita joka kunnasta. Sinulla on annettavaa — autamme sinut matkaan.
   - CTA: "Lähde ehdolle" → `[Linkki puolueen ehdokassivulle tähän]`
   - Kuva: `Ryhmä ihmisiä_6 hlö.jpg`

---

## Vaalit (`/vaalit/`)

- **H1:** "Vaalit"
- **Ingressi:** Vaalit ovat demokratian sydän — ja me olemme mukana joka kerta. Tutustu ehdokkaisiimme ja vihreään vaaliohjelmaan.
- **Kuva:** `Kävelevä ryhmä syksyllä.jpg`

### Lohkot
1. **Koonti** — teksti placeholder
2. **Ehdokkaat** — placeholder: "Puolueen ehdokasgalleria tulossa" + linkki puolueen sivuille
3. **CTA:** "Lähde ehdolle" → `[Linkki tähän]`

---

## Hyvinvointialueet (`/hyvinvointialueet/`)

- **H1:** "Hyvinvointialueet"
- **Ingressi:** Uusimaa jakautuu viiteen hyvinvointialueeseen. Vihreät vaikuttavat jokaisella alueella — sosiaali- ja terveyspalveluissa, pelastustoimessa ja ympäristöasioissa.
- Aluekortit (grid): linkit alasivuille

### Alasivujen rakenne (sama template kaikille):
- H1: alueen nimi
- Ingressi: placeholder
- Luottamushenkilöt: lista `[Nimet tähän]`
- Ajankohtaista alueelta: placeholder
- Yhteystiedot: `[Tiedot tähän]`

Alasivut:
- `/hyvinvointialueet/lansi-uusimaa/`
- `/hyvinvointialueet/keski-uusimaa/`
- `/hyvinvointialueet/ita-uusimaa/`
- `/hyvinvointialueet/vantaa-kerava/`
- `/hyvinvointialueet/hus-ja-maakunnalliset/`
- `/hyvinvointialueet/kuntapolitiikka/` (sama template kuin yhdistyslista)

### Kuntapolitiikka / Yhdistyslista (`/hyvinvointialueet/kuntapolitiikka/`)
- **H1:** "Kuntapolitiikka"
- Haku tai A–Ö -lista paikallisyhdistyksistä: placeholder
- Yhdistys-dummy-pohja (malli + ohje custom domain -linkitykseen)

---

## Yhteystiedot (`/yhteystiedot/`)

- **H1:** "Yhteystiedot"
- **Ingressi:** Löydä oikea henkilö tai ota yhteyttä piiriin — olemme täällä sinua varten.
- Linkkikortit alasivuille (4 kpl): Meistä, Piiritoimisto, Piirihallitus, Kansanedustajamme

### Meistä (`/yhteystiedot/meista/`)
- **H1:** "Meistä"
- **Ingressi:** Uudenmaan Vihreät on Vihreiden piirijärjestö, joka toimii koko Uudenmaan alueella.
- Lohkot:
  1. Piiri lyhyesti / missio — Uudenmaan Vihreät edistää ekologisesti ja sosiaalisesti kestävää politiikkaa Uudellamaalla. Toimimme kuntatasolta hyvinvointialueille ja eduskuntaan saakka — lähellä ihmisiä, siellä missä päätökset tehdään. Piiri tukee paikallisyhdistyksiä, kouluttaa ehdokkaita ja koordinoi vaalityötä koko maakunnan alueella.
  2. Hallinto & dokumentit — linkit:
     - Säännöt `[Linkki tähän]`
     - Toimintatavat / palvelulupaus `[Linkki tähän]`
     - Tietosuoja `[Linkki tähän]`
     - Graafinen ohjeistus (valinnainen)

### Piiritoimisto (`/yhteystiedot/piiritoimisto/`)
- **H1:** "Piiritoimisto"
- **Ingressi:** Piiritoimisto palvelee jäseniä, yhdistyksiä ja mediaa. Ota rohkeasti yhteyttä — löydät oikean henkilön alla olevasta listasta.
- **Puheenjohtaja** (kuva placeholder 1:1):
  - Santeri Leinonen — Puheenjohtaja
  - santeri.p.leinonen@hotmail.fi
- **Toiminnanjohtaja:**
  | Kuva | Nimi | Rooli | Sähköposti | Puhelin |
  |---|---|---|---|---|
  | `OskariSundstrom.jpeg` | Oskari Sundström | Toiminnanjohtaja | oskari.sundstrom@vihreat.fi | +358 45 124 2818 |
- **Poliittiset sihteerit:**
  | Kuva | Nimi | Rooli | Sähköposti | Puhelin |
  |---|---|---|---|---|
  | `MikkoKoivisto.jpg` | Mikko Koivisto | Vihreän aluevaltuustoryhmän poliittinen sihteeri — Itä-Uusimaa & Vantaa-Kerava | mikko.koivisto@vihreat.fi | +358 44 738 0292 |
  | `Hiltunen_Hanna.jpg` | Hanna Hiltunen | Vihreän aluevaltuustoryhmän poliittinen sihteeri — Länsi-Uusimaa & Keski-Uusimaa | hanna.hiltunen@vihreat.fi | +358 44 4936131 |
- **Paikallisyhdistysten toiminnanjohtajat:**
  | Kuva | Nimi | Rooli | Sähköposti | Puhelin |
  |---|---|---|---|---|
  | `KuukkaReimaVirallinen.jpg` | Reima Kuukka | Espoon Vihreiden toiminnanjohtaja | reima.kuukka@vihreat.fi | 050 3631288 |
  | `Minttu-Massinen.jpg` | Minttu Massinen | Vantaan Vihreiden toiminnanjohtaja | minttu.massinen@vihreat.fi | 050 558 71 28 |
- **Yleinen sähköposti:** info@uudenmaanvihreat.fi
- **Osoite:** Uudenmaan Vihreät ry, Mannerheimintie 15b, A-porras, 4.krs, 00260 Helsinki

### Piirihallitus (`/yhteystiedot/piirihallitus/`)
- **H1:** "Piirihallitus"
- **Ingressi:** Piirihallitus vastaa Uudenmaan Vihreiden toiminnan johtamisesta yleiskokouksien välillä.
- Lohkot:
  1. **Hallitus 2026:**
     - Santeri Leinonen, Hyvinkää (PJ)
     - Teemu Ojanne, Myrskylä (VPJ)
     - Säde Heikinheimo, Vantaa
     - Maija Linkola, Vantaa
     - Marjo Hinkkala, Espoo
     - Heidi Anttila, Vantaa
     - Aarni Hyvönen, Kirkkonummi
     - Rhea Lind, Espoo
     - Daniela Metsäranta, Espoo
     - Ismo Salonen, Vihti
  2. **Varajäsenet 2026** (sisääntulojärjestyksessä):
     - Kari Laalo, Vantaa
     - Riku Cajander, Kirkkonummi
     - Erja Väyrynen, Vihti
     - Börje Uimonen, Loviisa
     - Hanna Valtanen, Vantaa
     - Sanna Tuhkunen, Tuusula (VPJ)
  3. **Puoluehallituksen jäsenet** (2025–2027):
     - Jarno Lappalainen
     - Peppi Seppälä
  4. **Puoluevaltuusto** (2025–2027):
     - Anu Kantola (varalla: Cosmo Jenytinin)
     - Sanna Tilli (varalla: Timo Huhta)
     - Lennart Nybergh (varalla: Satu Mali)
     - Niko Kostia (varalla: Jaana Carlenius)
     - Mari Lotila (Vihreät Naiset)
  5. **Piirin työalat** — 4 korttia: Koulutus / Vaalit / Vapaaehtoiset / Politiikka
  6. **Vaalityöryhmän yhteystiedot** — `[Tiedot tähän]`

### Medialle (`/medialle/`)
- **H1:** "Medialle"
- **Ingressi:** Tervetuloa — löydät täältä yhteystiedot, taustatietoa piiristä sekä ladattavan kuva- ja logomateriaalin.
- Lohkot:
  1. Mediayhteyshenkilö — nimi + `[Puhelinnumero tähän]` + `[Mediayhteyshenkilön sähköposti tähän]`
  2. Faktaa piiristä — nopea tietolaatikko (placeholder-luvut)
  3. Viimeisimmät tiedotteet — feed-listaus (placeholder)
  4. Logot & kuvat — kortit + latauslinkit `[Linkit tähän]`
  5. Kuvapankki — "Kuvapankki Google Drivessä" → `[Google Drive -URL tähän]`

### Kansanedustajamme (`/yhteystiedot/kansanedustajat/`)
- **H1:** "Kansanedustajamme"
- **Ingressi:** Uudellamaalta valitut Vihreiden kansanedustajat työskentelevät eduskunnassa Uudenmaan ja koko Suomen parhaaksi.
- Lista kansanedustajista (kuva 1:1 + nimi + sähköposti + linkki eduskunnan sivulle):

| Kuva | Nimi | Sähköposti |
|---|---|---|
| `[placeholder 1:1]` | Inka Hopsu | inka.hopsu@eduskunta.fi |
| `[placeholder 1:1]` | Saara Hyrkkö | saara.hyrkko@eduskunta.fi |
| `[placeholder 1:1]` | Tiina Elo | tiina.elo@eduskunta.fi |

---

## Sivupalkki / Footer (kaikilla sivuilla)

### Footer
- Logo: `Vihreat_Logo_HOR_NEG_FIN_SWE.png` (valkoinen, dark bg `#284734`)
- Sarakkeet:
  1. Yhteystiedot: info@uudenmaanvihreat.fi · Mannerheimintie 15b, A-porras, 4.krs, 00260 Helsinki
  2. Pikalinkit: Etusivu / Ajankohtaista / Tule mukaan / Medialle
  3. Some-linkit: `[Facebook, Instagram, X -URLit tähän]`
- Copyright: "© [vuosi] Uudenmaan Vihreät ry"
- Y-tunnus: 1087570-8
- Tietosuoja-linkki → `[Linkki tähän]`

---

## Avoimet sisältökohdat (täytä ennen julkaisua)

- [x] Puheenjohtajan nimi ja sähköposti
- [x] Kaikkien työntekijöiden roolinimikkeet ja yhteystiedot
- [x] Piirihallituksen jäsenlista 2026
- [x] Kansanedustajien nimet ja sähköpostit
- [ ] Kansanedustajien valokuvat (lisää `Pictures/`-kansioon)
- [ ] Jäsenrekisteri-, lahjoitus- ja ehdokaslinkit
- [ ] Some-profiilit (Facebook, Instagram, X)
- [ ] Kalenteri-URL (Uusimaa ICS)
- [ ] Google Drive kuvapankin URL
- [ ] Verde RSS -URL vahvistus
- [ ] Hallintodokumenttien linkit (säännöt, tietosuoja jne.)
- [ ] Mediayhteyshenkilön nimi ja puhelinnumero (eri kuin puheenjohtaja?)
