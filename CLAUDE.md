# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a WordPress theme for **Uudenmaan Vihreät** (uudenmaanvihreat.fi) — the Uusimaa district of the Finnish Green Party. The theme must be Gutenberg-compatible with no dependency on commercial page builders.

The full specification is in [PRD.md](PRD.md). Key constraints:
- All pages use placeholder content; workers should be able to edit content without code
- Multilingual support (FI / SV / EN) is planned but deferred — keep structure extensible
- Accessibility (WCAG contrast, keyboard navigation, semantic HTML) is mandatory

## Local Development

The recommended local setup uses Docker Compose (WP + MariaDB):

```bash
docker compose up -d
# Open http://localhost:8080
# Install WordPress, then activate the theme from wp-admin
```

Alternative: use `wp-env` (requires Node.js):
```bash
npx wp-env start
```

Copy the theme folder to `wp-content/themes/uudenmaan-vihreat-theme/` and activate via Appearance → Themes.

## Theme File Structure

The theme lives in `uudenmaan-vihreat-theme/` with this layout:

```
uudenmaan-vihreat-theme/
├── style.css           # Theme header + base styles
├── functions.php       # Enqueue scripts/styles, register menus, theme supports
├── theme.json          # Gutenberg design tokens (colours, typography, spacing)
├── header.php / footer.php
├── front-page.php      # Custom homepage template
├── page.php / single.php / archive.php
├── templates/          # Per-page templates (page-ajankohtaista.php, etc.)
├── parts/              # Reusable partials: nav.php, hero.php, cta-buttons.php,
│                         feed-list.php, cards-latest.php, people-list.php
└── assets/
    ├── images/logo/    # vihreat-logo.svg + vihreat-logo-white.svg
    ├── images/placeholders/  # hero, card, person placeholder images
    ├── fonts/          # Krana Fat A/B .woff2 (if available)
    └── brand/          # Vihreiden graafinen ohje PDF
```

## Brand & Design Tokens

Define all colours as CSS custom properties (and in `theme.json`):

| Token | Hex |
|---|---|
| `--color-dark-bg` | `#284734` |
| `--color-dark-text` | `#006845` |
| `--color-bright-green` | `#009639` |
| `--color-light-green` | `#D9EA9A` |
| `--color-grey` | `#EBEBEC` |

Accent colours (Fire `#F06400`, Ochre `#DAAA00`) must only be used as backgrounds with black text due to contrast requirements.

Typography:
- Headings: Krana Fat A/B → fallback Barlow Semi Condensed ExtraBold
- Body: IBM Plex Sans → fallback Arial
- Meta/code: IBM Plex Mono

Logo: use `Pictures/Logot/Vihreat_Logo_HOR_NEG_FIN_SWE.png` on dark (`#284734`) backgrounds, `Vihreat_Logo_HOR_RGB_FIN_SWE.png` on light backgrounds. Copy both to `assets/images/logo/` in the theme.

## Page Slugs (WordPress setup)

Create pages with exactly these slugs (some have legacy URLs that must not change):
- `/yleiskokous/` — keep existing slug, static page
- `/tapahtumakalenteri/` — contains ICS Calendar shortcode placeholder
- `/hyvinvointialueet/` with children: `lansi-uusimaa`, `keski-uusimaa`, `ita-uusimaa`, `vantaa-kerava`, `hus-ja-maakunnalliset`, `kuntapolitiikka`
- `/yhteystiedot/` with children: `meista`, `piiritoimisto`, `piirihallitus`, `medialle`, `kansanedustajat`

`kuntapolitiikka` and the associations list share the same template structure — keep them as the same template type.

## External Integrations (Placeholders)

- **STT / Vihreät news feed**: `https://www.sttinfo.fi/uutishuone/69818932/vihreat---de-grona` — show link + placeholder list; bonus: server-side WP cron fetch with cache
- **Verde RSS**: `https://www.verdelehti.fi/rss/` — show latest articles
- **ICS Calendar** (events): Install WP plugin "ICS Calendar", use shortcode `[ics_calendar url="..." view="basic" linktitles="true" format="j.n.Y"]`; exact Uusimaa URL TBD
- **Volunteer sign-up form**: Google Forms link (placeholder: `[Linkki Google Forms -lomakkeeseen tähän]`)

## Content Reference

The current live site at **https://www.uudenmaanvihreat.fi/** can be used as a reference for **text content only**. Reuse or adapt existing copy where appropriate rather than writing new placeholder text from scratch. The design and page structure are being redesigned from scratch — do not replicate the current site's layout or visual style.

## Placeholder Conventions

Use these exact strings so content editors can find and replace them:
- `[Puheenjohtajan nimi tähän]`
- `[Puhelinnumero tähän]`
- `[Mediayhteyshenkilön sähköposti tähän]`
- `[Linkki ilmoittautumislomakkeeseen tähän]`

Every page needs: H1, 1–2 sentence ingress, and 2–5 content blocks (cards/lists/CTAs). Lorem ipsum is allowed in body text.

## Available Image Assets

Real photos are in `Pictures/`:
- `Pictures/Kuvituskuvat/` — 19 campaign/nature/group photos (use as hero/card images)
- `Pictures/Työntekijät/` — staff portraits: Hiltunen_Hanna.jpg, KuukkaReimaVirallinen.jpg, MikkoKoivisto.jpg, Minttu-Massinen.jpg, OskariSundstrom.jpeg
- `Pictures/Logot/` — official logos: `Vihreat_Logo_HOR_RGB_FIN_SWE.png` (light backgrounds), `Vihreat_Logo_HOR_NEG_FIN_SWE.png` (dark/negative backgrounds)

Recommended aspect ratios: hero 16:9, cards 3:2, portraits 1:1.

## Definition of Done

The theme is complete when:
1. Navigation matches PRD section 4 exactly
2. All pages exist with the correct slugs and placeholder content
3. Homepage has all 7 sections (hero, quick-links, news, events-link, CTAs, STT placeholder, Verde placeholder)
4. Brand colours and typography implemented via `theme.json` + CSS variables, with fallbacks
5. White logo variant used on dark backgrounds
6. README includes Docker Compose and manual installation instructions
