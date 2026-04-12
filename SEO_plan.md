# SEO Plan — Uudenmaan Vihreät

Based on audit of the codebase and the WordPress SEO tips document.

---

## Findings Summary

### What's already done right
- `add_theme_support('title-tag')` — WordPress controls the title tag, compatible with SEO plugins
- Viewport meta tag present in `header.php`
- `language_attributes()` on `<html>` — correct for multilingual indexing
- Skip link and semantic HTML landmarks (`role="banner"`, `role="contentinfo"`, `aria-label` on nav and sections)
- `fetchpriority="high"` and `loading="eager"` on hero image in `parts/hero.php`
- `<time datetime="Y-m-d">` machine-readable dates in cards and single posts
- Card thumbnails pass `alt` from post title (`the_post_thumbnail('card-thumb', ['alt' => get_the_title()])`)
- Logo images have proper `alt` text
- External links use `rel="noopener noreferrer"`
- Custom image sizes registered: `card-thumb` (600×400), `hero-full` (1920×1080), `portrait` (400×400)
- Google Fonts URL includes `display=swap` — prevents invisible text during load
- WP Cron-based feed caching for STT and Verde (good for performance)

### Critical gaps found
1. **No SEO plugin installed** — no Open Graph tags, no Twitter Cards, no XML sitemap with image/hreflang support, no per-page meta descriptions, no schema/JSON-LD, no canonical URLs beyond WP defaults
2. **No breadcrumbs** anywhere in theme
3. **No structured data** — no Organization/LocalBusiness schema, no Article schema for posts
4. **No preconnect hints** for Google Fonts — render-blocking on first load
5. **No hreflang implementation verified** — Polylang should add these but this needs to be confirmed in production
6. **Placeholder hrefs in footer** — `[Facebook-URL tähän]` etc. are invalid link values
7. **Missing accessibility statement page** (`/saavutettavuus/`) — linked in footer but not in page setup
8. **No WebP images** — all assets are JPEG/PNG
9. **Single post thumbnail** — `the_post_thumbnail('large')` in `single.php` doesn't pass `alt` attribute; relies on media library alt which may be empty
10. **No Google Search Console or Analytics** setup documented
11. **Social media profiles not connected** — unknown URLs for Facebook, Instagram, X
12. **Archive page ingress is not translatable** — hardcoded Finnish text in `archive.php` line 19

---

## Actionable To-Do List

Tasks are grouped by area and ordered by impact. Do not modify code until each step is confirmed.

---

### STEP 1 — WordPress Admin Settings (do first, before any code changes)

- [ ] **1.1** Go to Settings → Reading — verify "Discourage search engines from indexing this site" is **unchecked**
- [ ] **1.2** Go to Settings → Permalinks — confirm structure is set to **Post name** (`/%postname%/`)
- [ ] **1.3** Go to Settings → General — confirm both WordPress Address and Site Address use **https://**
- [ ] **1.4** Verify that all page slugs match the spec in CLAUDE.md (yleiskokous, tapahtumakalenteri, hyvinvointialueet etc.)

---

### STEP 2 — Install an SEO Plugin (highest impact, solves many issues at once)

> **Note:** The theme now ships with fallback Open Graph tags, Twitter Cards, canonical URLs, Organization schema, NewsArticle schema, and BreadcrumbList schema via `inc/seo.php`. These fire automatically when no SEO plugin is detected. Installing Rank Math will silently disable the theme fallbacks and take over — zero duplicate output.

**Recommended: Rank Math (free tier)**
Reason: most generous free tier — 5 keywords/page, 16+ schema types, built-in redirect manager, social preview cards, Google Search Console integration.

- [ ] **2.1** Install and activate **Rank Math SEO** from the WordPress plugin directory
- [ ] **2.2** Run Rank Math's setup wizard:
  - Set site type to **Organization** (not personal blog)
  - Enter organization name: `Uudenmaan Vihreät`
  - Enter logo URL (use the RGB/light version for schema purposes)
  - Connect Google Search Console in the wizard
- [ ] **2.3** In Rank Math → Titles & Meta → Global settings:
  - Set separator character
  - Set homepage SEO title: `Uudenmaan Vihreät – Vihreää politiikkaa koko Uudellamaalla`
  - Set homepage meta description: `Uudenmaan Vihreät on Vihreiden piirijärjestö Uudellamaalla. Teemme vihreää politiikkaa kunnissa, hyvinvointialueilla ja eduskunnassa.` (max 160 chars)
- [ ] **2.4** In Rank Math → Titles & Meta → Posts — set default Article schema for blog posts
- [ ] **2.5** In Rank Math → Sitemap — enable XML sitemap, enable image sitemap
- [ ] **2.6** Submit sitemap URL to **Google Search Console**: `https://www.uudenmaanvihreat.fi/sitemap_index.xml`
- [ ] **2.7** Submit sitemap to **Bing Webmaster Tools**

---

### STEP 3 — Per-Page SEO Titles and Meta Descriptions

For every page listed below, open it in the WordPress editor, scroll to the Rank Math meta box, and fill in the SEO title and meta description. Titles: max 60 characters, front-load the keyword. Descriptions: 150–160 characters, include a call to action.

- [ ] **3.1** Homepage (`/`) — SEO title + meta description (see 2.3 above)
- [ ] **3.2** Ajankohtaista (`/ajankohtaista/`) — e.g. `Ajankohtaista – Uudenmaan Vihreät | Uutiset ja kannanotot`
- [ ] **3.3** Tule mukaan (`/tule-mukaan/`) — e.g. `Tule mukaan – Uudenmaan Vihreät | Vaikuta lähellä sinua`
- [ ] **3.4** Vaalit (`/vaalit/`) — e.g. `Vaalit – Uudenmaan Vihreät | Ehdokkaat ja vaalitavoitteet`
- [ ] **3.5** Hyvinvointialueet (`/hyvinvointialueet/`) + all 5 sub-pages — each needs a unique description naming the specific region
- [ ] **3.6** Yhteystiedot (`/yhteystiedot/`) + all sub-pages (Meistä, Piiritoimisto, Piirihallitus, Medialle, Kansanedustajat)
- [ ] **3.7** Tapahtumakalenteri (`/tapahtumakalenteri/`)
- [ ] **3.8** Yleiskokous (`/yleiskokous/`)
- [ ] **3.9** Tiedotteet (`/tiedotteet/`)
- [ ] **3.10** Tietosuojaseloste — set to `noindex` in Rank Math (this page doesn't need to rank)
- [ ] **3.11** Set any thank-you or login pages to `noindex`

---

### STEP 4 — Structured Data / Schema Markup

- [ ] **4.1** In Rank Math → Titles & Meta → Local SEO: add **Organization** schema with:
  - Name: `Uudenmaan Vihreät ry`
  - URL: `https://www.uudenmaanvihreat.fi/`
  - Logo: link to RGB logo
  - Address: Mannerheimintie 15b, A-porras, 4.krs, 00260 Helsinki
  - Email: `info@uudenmaanvihreat.fi`
  - Business hours / contact info if applicable
- [ ] **4.2** In the WordPress post editor, set schema type to **Article** for each published blog post (Rank Math handles this automatically per the default set in 2.4)
- [ ] **4.3** For the Tapahtumakalenteri page, manually add **Event** schema (or rely on ICS Calendar plugin if it outputs schema — check plugin docs)
- [ ] **4.4** Validate all schema using **Google's Rich Results Test** (`search.google.com/test/rich-results`) after going live
- [ ] **4.5** Validate with **Schema Markup Validator** (`validator.schema.org`)

---

### STEP 5 — Open Graph & Social Sharing

- [ ] **5.1** In Rank Math → Titles & Meta → Social, set:
  - Default og:image: a 1200×630px image (create one from a campaign photo + brand overlay)
  - Facebook app ID (if available)
  - Twitter card type: `summary_large_image`
- [ ] **5.2** Create a dedicated **OG image** (1200×630px) for the homepage — this is what appears when the site is shared on social media. Use a campaign photo + "Uudenmaan Vihreät" text overlay in brand green.
- [ ] **5.3** For key pages (homepage, Tule mukaan, Vaalit), set custom og:image in Rank Math's Social tab in the editor
- [ ] **5.4** After configuring, test sharing URLs using **Facebook Sharing Debugger** (`developers.facebook.com/tools/debug/`) and click "Scrape Again" to force a fresh cache

---

### STEP 6 — Theme Code Improvements

These require code changes in the theme files.

- [x] **6.1** **Add `rel="preconnect"` for Google Fonts** — done in `inc/seo.php`, output at `wp_head` priority 1.

- [x] **6.2** **Add breadcrumbs** — `uuvi_breadcrumb_html()` implemented in `inc/seo.php`. Called from `page.php` and `single.php`. Outputs BreadcrumbList JSON-LD automatically. When Rank Math is installed and its breadcrumb output is enabled, it delegates to `rank_math_the_breadcrumbs()` automatically.

- [x] **6.3** **Fix single post thumbnail alt text** — `single.php` now passes `'alt' => get_the_title()` to `the_post_thumbnail()`.

- [x] **6.4** **Fix archive.php ingress text** — wrapped in `esc_html_e()` for translation.

- [x] **6.5** **Fix footer social media placeholders** — footer now reads URLs from Customizer settings (`uuvi_social_facebook`, `uuvi_social_instagram`, `uuvi_social_twitter`). The "Seuraa meitä" block is hidden entirely when all three are empty. Set URLs at wp-admin → Ulkoasu → Mukauta → Piirin tiedot → Some-profiilit.

- [x] **6.6** **Create accessibility statement page** — `/saavutettavuus/` added to `inc/setup-pages.php` with placeholder content. It will be auto-created on next theme activation or first `init` run.

- [ ] **6.7** **Add `width` and `height` to all `<img>` tags** — verify all images in templates have explicit `width` and `height` attributes. This prevents Cumulative Layout Shift (CLS). WordPress's Block Editor does this automatically, but template-hardcoded images should be checked manually.

---

### STEP 7 — Image SEO

- [ ] **7.1** **Review all media library images** — in wp-admin → Media, verify every uploaded image has a meaningful alt text set. Especially: staff photos, event photos used as featured images.
- [ ] **7.2** **Rename image files before upload** — ensure all future uploads follow lowercase hyphenated naming (e.g., `kampanjointia-teltalla.jpg` not `Kampanjointia teltalla 2.jpg`). Files already in the media library cannot be renamed without plugins.
- [ ] **7.3** **Install an image optimization plugin** — install **ShortPixel** or **Imagify** to:
  - Compress existing JPEG/PNG images
  - Auto-convert uploads to **WebP** format (25–34% smaller than JPEG)
  - Maintain JPEG fallbacks for Open Graph (AVIF is not safe for og:image yet)
- [ ] **7.4** **Set featured images on all posts** — every published post needs a featured image. This becomes the `og:image` for social sharing and appears in cards across the site.

---

### STEP 8 — Internal Linking

- [ ] **8.1** **Audit for orphan pages** — after all pages are published, use Rank Math's "Link Counter" column in the Pages list to identify any pages with zero inbound internal links. Link to them from relevant content.
- [ ] **8.2** **Add internal links in post content** — when publishing blog posts and news articles, include 2–5 internal links per article using descriptive anchor text (not "klikkaa tästä"). Link to relevant pages like Tule mukaan, Vaalit, Hyvinvointialueet.
- [ ] **8.3** **Link the homepage quick-cards to key conversion pages** — currently the quick-cards link to page IDs (8, 12, 11). Confirm these resolve to the correct pages in production.
- [ ] **8.4** **Cross-link hyvinvointialue sub-pages** — each regional sub-page should link to the parent Hyvinvointialueet page and to neighboring regions.

---

### STEP 9 — Multilingual SEO (Polylang)

- [ ] **9.1** **Verify hreflang tags are generated** — Polylang should add `<link rel="alternate" hreflang="fi|sv|en">` tags automatically. Confirm this by viewing page source on the live site after Polylang is configured. If missing, check Polylang settings → SEO → Hreflang.
- [ ] **9.2** **Set SEO titles and descriptions in all 3 languages** — Rank Math integrates with Polylang. For each translated page (SV, EN), open the translated version in the editor and fill in the Rank Math meta fields in that language.
- [ ] **9.3** **Set the correct language for each page in Polylang** — ensure every page is assigned a language in Polylang's page list, and all translations are connected.
- [ ] **9.4** **Translate the sitemap** — Polylang + Rank Math should include all language variants in the XML sitemap automatically. Verify this after configuration.

---

### STEP 10 — Performance & Core Web Vitals

Targets: LCP ≤ 2.5s, INP ≤ 200ms, CLS ≤ 0.1

- [ ] **10.1** **Install a caching plugin** — install **WP Super Cache** or **LiteSpeed Cache** (depending on hosting). This dramatically reduces TTFB and LCP for returning visitors and crawlers.
- [ ] **10.2** **Measure baseline performance** — run the live site through **PageSpeed Insights** (`pagespeed.web.dev`) on both mobile and desktop. Note the LCP, INP, and CLS scores before making changes.
- [ ] **10.3** **Check for render-blocking resources** — Google Fonts is loaded as a synchronous stylesheet. After adding preconnect hints (Step 6.1), re-measure to see if LCP improves.
- [ ] **10.4** **Enable GZIP/Brotli compression** at the server/hosting level if not already enabled.
- [ ] **10.5** **Set far-future cache headers** for static assets (CSS, JS, images) — typically configured via `.htaccess` or hosting panel.
- [ ] **10.6** **Verify hero image is not lazy-loaded** — `parts/hero.php` correctly uses `loading="eager"` and `fetchpriority="high"`. Confirm these attributes survive in the rendered HTML on all pages that use the hero partial.

---

### STEP 11 — URL & Slug Hygiene

- [ ] **11.1** **Verify all page slugs** match CLAUDE.md spec before publishing. Especially the legacy URL `/yleiskokous/` which must not change.
- [ ] **11.2** **Set up 301 redirects** if any pages are moved or slugs change after launch — use Rank Math's built-in redirect manager.
- [ ] **11.3** **No dates in post slugs** — verify that WordPress is not auto-including date in blog post URLs (controlled by permalink structure, which should already be `/%postname%/` per Step 1.2).

---

### STEP 12 — Analytics & Monitoring Setup

- [ ] **12.1** **Create a Google Search Console property** for `https://www.uudenmaanvihreat.fi/` (if not already done). Verify ownership via the HTML tag method (Rank Math can insert this automatically).
- [ ] **12.2** **Install Google Analytics 4** — either via Rank Math's integration or a dedicated plugin (e.g., **Site Kit by Google**). Set up a GA4 property for the domain.
- [ ] **12.3** **Submit the XML sitemap** to Google Search Console (see Step 2.6).
- [ ] **12.4** **Submit sitemap to Bing Webmaster Tools** (Step 2.7) — Bing actively uses image sitemaps for image indexing.
- [ ] **12.5** **Set up Core Web Vitals monitoring** — after submitting to GSC, the Core Web Vitals report will populate with field data after ~28 days of traffic.
- [ ] **12.6** **Set up a Bing Places for Business listing** if the organization has a public-facing location (helps local search).

---

### STEP 13 — Security Headers (indirect SEO)

A site flagged by Google Safe Browsing triggers interstitials that cause ~95% of visitors to leave immediately, risking de-indexing.

- [ ] **13.1** **Verify HTTPS is enforced** and there are no mixed content warnings (HTTP resources on HTTPS pages). Use **Really Simple SSL** plugin if mixed content is found.
- [ ] **13.2** **Add HSTS header** (`Strict-Transport-Security: max-age=31536000; includeSubDomains`) at the server/hosting level.
- [ ] **13.3** **Install a security plugin** — Wordfence (free) for firewall and malware scanning.
- [ ] **13.4** **Set strong admin password** and enable two-factor authentication on all admin accounts.
- [ ] **13.5** **Keep WordPress core, theme, and plugins updated** — schedule monthly update checks.

---

### STEP 14 — Content Tasks (ongoing, before and after launch)

- [ ] **14.1** Fill in all open items from `CONTENT_PLAN.md` — especially social media URLs, Google Forms link, calendar URL, and staff contact details. These are currently placeholder strings in the codebase.
- [ ] **14.2** **Write real excerpt text** for the first batch of blog posts — the default `excerpt_length` is set to 20 words, which may be too short. Consider increasing to 30 words for better card snippets and meta description fallbacks.
- [ ] **14.3** **Create initial blog posts** — 3–6 articles on relevant local political topics for Uusimaa. Regular publishing signals to Google that the site is active.
- [ ] **14.4** **Category strategy for posts** — create 3–5 meaningful categories (e.g., Kannanotot, Uutiset, Tapahtumat, Hyvinvointialueet). Avoid creating too many. Set tag archives to `noindex` in Rank Math to avoid thin duplicate content.
- [ ] **14.5** **Unique H1 on every page** — confirm every template and page has exactly one H1. Currently `page.php` and `single.php` both use `the_title()` as H1 — this is correct. Verify no template accidentally outputs two H1s.

---

### Priority Order Summary

| Priority | Step | Why |
|---|---|---|
| 🔴 Critical | 1, 2 | These must be done before launch. Wrong reading settings will de-index everything. |
| 🔴 Critical | 6.5, 6.6 | Broken links and missing pages harm credibility and UX |
| 🟠 High | 3, 4, 5 | Direct ranking impact: titles, schema, social sharing |
| 🟠 High | 7.3, 7.4 | Image optimization and featured images improve LCP and social appearance |
| 🟡 Medium | 6.1–6.4, 8, 9 | Performance, breadcrumbs, internal links, multilingual |
| 🟡 Medium | 10, 12 | Performance measurement and analytics baseline |
| 🟢 Ongoing | 11, 13, 14 | URL hygiene, security, content publishing cadence |
