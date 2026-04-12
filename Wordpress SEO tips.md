# The definitive WordPress SEO settings checklist for every page

Every WordPress page lives or dies by a handful of critical settings — meta tags, schema markup, URL structure, performance, and security. **The most impactful per-page settings are the SEO title, meta description, canonical URL, schema type, and image alt text**, yet most site owners either leave them at defaults or configure them inconsistently. This guide covers every setting that must be checked on individual pages, where to find each one, and exactly what values to use. It spans all ten core areas of WordPress SEO, from plugin-level controls to server-side HTTPS configuration.

---

## 1. On-page SEO: the meta tags that control your search appearance

### Meta title (title tag)

The title tag is the single most influential on-page SEO element. Without an SEO plugin, WordPress generates titles using the post title plus site name (controlled by the theme's `wp_title()` function or `title-tag` support). All three major plugins — Yoast SEO, Rank Math, and All in One SEO — override this with customizable per-page fields and template variable systems.

**Best practices:** Keep titles under **50–60 characters** (Google measures by pixel width, roughly 580–600px on desktop). Front-load the primary keyword within the first 30–35 characters. Use the format `Primary Keyword – Secondary Keyword | Brand Name`. If left blank, plugins fall back to their template defaults (e.g., `%%title%% %%sep%% %%sitename%%` in Yoast). Google may rewrite titles it considers irrelevant, duplicative, or keyword-stuffed, so write for humans first.

### Meta description

Set in the SEO plugin meta box when editing any post or page. Target **150–160 characters** (430–920 pixels). Include the focus keyword naturally, write a compelling call to action, and make each description unique. If left blank, Google auto-generates a snippet from page content — which often works poorly for conversion. Yoast and AIOSEO may fall back to the post excerpt as an intermediate default.

### Canonical URLs

Every page should include a self-referencing canonical tag (`<link rel="canonical" href="...">`), which prevents duplicate-content issues caused by URL parameters, UTM tracking codes, or protocol/www variants. All three major plugins add self-referencing canonicals automatically. For cross-domain canonicalization (syndicated content), override the canonical per-page in the plugin's Advanced tab. Note that search engines treat canonical tags as a strong suggestion, not an absolute directive.

**Where to set per-page:** Yoast → Advanced tab → "Canonical URL" field. Rank Math → Advanced tab → "Canonical URL." AIOSEO → Advanced tab → "Canonical URL."

### Robots meta tags

Robots directives control search engine behavior at the page level via `<meta name="robots" content="...">`. The critical directives and when to use them:

| Directive | Purpose | When to apply |
|---|---|---|
| `noindex` | Hides page from search results | Thank-you pages, login pages, thin content, internal search results |
| `nofollow` | Stops link equity passing from links on the page | Rarely needed page-wide; use selectively |
| `noarchive` | Blocks cached version in search results | Rapidly changing content |
| `max-snippet:-1` | Unlimited text snippet length | Default; override to limit snippet size |
| `max-image-preview:large` | Allows large image previews | WordPress 5.7+ adds this by default |

All three plugins provide per-page toggles in their Advanced tabs. Rank Math additionally offers granular controls for `noarchive`, `noimageindex`, `nosnippet`, and numeric fields for `max-snippet`, `max-video-preview`, and `max-image-preview`. WordPress's global "Discourage search engines from indexing this site" checkbox (Settings → Reading) adds `noindex,nofollow` to every page — this is a nuclear option that should only be checked on staging environments.

---

## 2. How Yoast, Rank Math, and AIOSEO handle per-page settings

All three plugins place their controls either in the WordPress editor sidebar or in a meta box below the content area. The differences lie in free-tier generosity, schema flexibility, and template variable syntax.

**Yoast SEO** uses the `%%variable%%` syntax for templates (e.g., `%%title%%`, `%%sitename%%`, `%%sep%%`). The free version limits you to one focus keyphrase per page, provides basic schema types, and auto-generates Open Graph tags without social preview cards. Yoast Premium (~€99/year) adds unlimited keyphrases, social previews, a redirect manager, AI title/description generation, and internal linking suggestions. Yoast's schema approach uses a unified schema graph — an interconnected entity model linking organization, authors, and content automatically.

**Rank Math** uses `%variable%` syntax and is the most generous free plugin. The free tier offers **up to 5 focus keywords per page**, 16+ schema types with a per-page schema generator, social media preview cards, a built-in redirect manager with 404 monitoring, and Google Search Console integration. Rank Math Pro (~$6.99/month) adds a custom schema builder, Content AI, keyword rank tracking, and advanced analytics. Rank Math's manual schema approach gives users explicit control over which schema types apply to each page, with the ability to stack multiple types per page in Pro.

**All in One SEO (AIOSEO)** uses `#variable` syntax (e.g., `#post_title`, `#site_title`, `#separator`). The free Lite version includes one keyphrase, basic schema, social media settings, and its TruSEO On-Page Analysis scoring system. AIOSEO Pro (~$49.50/year) adds unlimited keyphrases, a redirect manager, Link Assistant for internal linking, search statistics, and advanced schema controls. A unique feature is its URL Slug Monitor, which alerts you when slugs change accidentally.

| Feature | Yoast Free | Rank Math Free | AIOSEO Free |
|---|---|---|---|
| Focus keywords per page | 1 | 5 | 1 |
| Social preview cards | ✗ | ✓ | ✓ |
| Redirect manager | ✗ | ✓ | ✗ |
| Schema types available | Basic | 16+ | Basic |
| Breadcrumbs | ✓ | ✓ | ✓ |
| Content analysis score | Traffic light | 0–100 score | TruSEO score |
| Template variable syntax | `%%title%%` | `%title%` | `#post_title` |

---

## 3. WordPress core settings that silently affect indexing

### Permalink structure

Navigate to Settings → Permalinks and select **"Post name"** (`/%postname%/`). This creates clean, keyword-rich URLs like `example.com/my-post-title/` and is the recommended structure for virtually all WordPress sites. Avoid plain (`?p=123`), numeric, or date-based structures unless running a news publication. Changing permalink structure on a live site creates mass 404 errors — always implement 301 redirects via a plugin (Redirection, Rank Math, or Yoast Premium) before switching.

Per-page slugs are editable in the Block Editor by clicking the URL field below the post title. In the Classic Editor, click "Edit" next to the permalink.

### Reading settings and page visibility

The **"Discourage search engines from indexing this site"** checkbox (Settings → Reading) adds `noindex,nofollow` to every page and modifies robots.txt to `Disallow: /`. This is the most dangerous SEO setting in WordPress — accidental activation on a live site will de-index the entire domain. Always verify it's unchecked after migrations or plugin updates.

WordPress page visibility settings have distinct SEO implications. **Public** pages are crawlable and indexable. **Password-protected** pages are discoverable by URL but content is inaccessible to crawlers — set these to noindex. **Private** pages are invisible to search engines entirely. Only pages with "Published" status appear in XML sitemaps; drafts, pending, and scheduled posts are excluded automatically.

### Categories, tags, and sitemaps

Category and tag archive pages can create duplicate content issues. Best practice: keep categories indexed if they contain curated, unique content, but **noindex tag archives** on most sites (especially smaller ones). Configure this in your SEO plugin's taxonomy settings. For XML sitemaps, use your SEO plugin's sitemap (at `/sitemap_index.xml`) rather than WordPress's built-in basic sitemap (added in 5.5), which lacks customization, image sitemaps, and per-content exclusion controls. Submit the sitemap URL to Google Search Console and reference it in robots.txt.

---

## 4. Structured data controls and the schema types that still matter

### Which schema types deliver rich results in 2026

Google has significantly narrowed which schema types trigger visible rich results. **FAQ schema was restricted in August 2023** to authoritative government and health websites only — it no longer generates rich results for most sites. **HowTo schema was deprecated entirely** for rich results in September 2023. Both can remain on pages without penalty, but investing effort in adding them is no longer worthwhile.

The schema types worth implementing per-page are **Article** (for blog posts and news), **Product** (requires name plus review, aggregateRating, or offers), **BreadcrumbList** (recommended for all sites), **LocalBusiness** (for physical locations), **Video**, **Event**, and **Review/AggregateRating**. Use JSON-LD format exclusively — it's Google's recommended implementation method, and all WordPress SEO plugins generate it natively.

### Per-page schema configuration

Rank Math provides the most flexible free schema controls: its Schema tab in the editor lets you select from 16+ types, set default types per content type (Rank Math → Titles & Meta → Posts), and in Pro, stack multiple schema types on a single page and build custom schemas. Yoast's unified schema graph automatically applies appropriate types (Article to posts, WebPage to pages) and links entities in a connected model — less manual control but more technically sophisticated for standard content. Validate markup using the **Google Rich Results Test** and **Schema Markup Validator** (validator.schema.org).

---

## 5. Open Graph and Twitter Card tags for social sharing

Every page needs Open Graph tags to control how it appears when shared on Facebook, LinkedIn, and other platforms. The essential tags are `og:title`, `og:description`, `og:image`, `og:url`, `og:type`, and `og:site_name`. The **recommended og:image size is 1200×630 pixels** (1.91:1 ratio), which works universally across platforms. Images below 200×200px won't display on Facebook at all. Keep files under 8MB and use JPEG for photos or PNG for graphics with text.

For Twitter/X, use `twitter:card` (set to `summary_large_image` for most content), `twitter:title`, `twitter:description`, and `twitter:image` (optimal at 1200×675px). All three SEO plugins auto-generate these tags from your SEO title, description, and featured image. Rank Math and AIOSEO offer per-page social media overrides (custom title, description, and image for Facebook and Twitter separately) in their free versions; Yoast requires Premium for social preview cards.

**Debugging social previews:** Use Facebook's Sharing Debugger (developers.facebook.com/tools/debug/) and click "Scrape Again" to force-refresh cached data. LinkedIn has its Post Inspector tool. OG tags must be in server-rendered HTML — tags injected via JavaScript are invisible to social platform crawlers.

---

## 6. URL and slug optimization, one page at a time

**Optimal slugs are 3–5 words**, hyphenated, lowercase, and include the primary keyword. Remove stop words ("a," "the," "in," "and") and avoid dates unless content is strictly time-sensitive. Use `/wordpress-security-tips/` not `/the-best-wordpress-security-tips-for-2026/`. WordPress defaults to hyphens as word separators, which Google treats correctly — never use underscores.

When changing slugs on existing pages, **always set up 301 redirects** first. These pass 90–99% of link equity to the new URL. Rank Math includes a free redirect manager; Yoast requires Premium; or use the standalone Redirection plugin. Avoid excessive URL nesting (`/category/subcategory/sub-subcategory/post/`) — flat URLs perform better and are more shareable. For most blogs, skip including `/%category%/` in the permalink structure, as it creates longer URLs and causes problems during category reorganization.

---

## 7. Internal linking strategy and breadcrumbs

Internal links distribute PageRank, establish topical relevance, and help crawlers discover content. Target **2–5 internal links per 1,000 words** using descriptive, keyword-rich anchor text (never "click here"). Link from high-authority pages to newer or weaker pages to transfer equity, and build topical clusters where cornerstone pages link bidirectionally to supporting content.

**Orphan pages** — posts with zero inbound internal links — are essentially invisible to search engines. Link Whisper (the leading internal linking plugin with 50,000+ installs) uses AI-powered suggestions to identify and fix orphan pages in real time. Yoast Premium and AIOSEO Pro offer similar internal linking suggestion features within their ecosystems.

**Breadcrumbs** provide both navigational UX and SEO benefits. One documented case study showed a site's organic CTR dropped from **6.6% to 4.1%** (a ~40% decline) when breadcrumb schema was accidentally removed, then recovered to 7% within three weeks of restoration. Google displays breadcrumb trails in search results instead of raw URLs.

Enable breadcrumbs in Yoast (Settings → Advanced → Breadcrumbs), Rank Math (General Settings → Breadcrumbs), or AIOSEO (General Settings → Breadcrumbs). All three generate BreadcrumbList JSON-LD schema automatically. Implement via Gutenberg block, shortcode, or PHP function (e.g., `yoast_breadcrumb()` for Yoast). Ensure only one plugin or theme is generating breadcrumbs to avoid duplicate markup.

---

## 8. Core Web Vitals and the WordPress performance features that matter

Google's three Core Web Vitals are confirmed ranking signals. The thresholds to target: **LCP ≤ 2.5 seconds** (loading speed), **INP ≤ 200 milliseconds** (interactivity, replaced FID in March 2024), and **CLS ≤ 0.1** (visual stability). Mobile scores directly affect rankings due to mobile-first indexing.

Recent WordPress releases have added significant built-in performance features. **WordPress 6.3** automatically adds `fetchpriority="high"` to the likely LCP image, typically improving LCP by 5–10%. **WordPress 6.8** introduced the Speculation Rules API, which prefetches or prerenders linked pages when users hover or begin clicking — real-world testing showed a ~1.9% boost in LCP passing rates across 50,000+ sites. **WordPress 6.9** extends fetchpriority to scripts, increases the inline CSS limit from 20KB to 40KB, and deprioritizes non-critical JavaScript, with block themes seeing roughly **25% LCP improvement** in benchmarks.

Per-page performance actions: ensure hero/above-the-fold images are not lazy-loaded (WordPress 6.3+ handles this automatically but verify), compress and serve images in WebP format, minimize render-blocking CSS/JS, and set explicit width and height on all images to prevent CLS. Test individual pages with PageSpeed Insights (prioritize field data over lab data) and monitor sitewide in Google Search Console's Core Web Vitals report.

---

## 9. Image SEO requires attention on every single page

**Alt text** is the most important per-page image setting — it serves both accessibility (screen readers) and SEO (helping Google understand image content). Set alt text in the WordPress media library or directly in the Block Editor's image block sidebar. Write descriptive, natural-language alt text that includes relevant keywords without stuffing. Every meaningful image needs unique alt text; decorative images can use empty alt attributes.

**File names** matter before upload. Rename files to lowercase, hyphenated, descriptive names (`blue-running-shoes.jpg` not `IMG_4392.jpg`). This cannot be changed after upload without plugins, so it must be done pre-upload. Featured images double as the default `og:image` for social sharing, making them critical for both SEO and social appearance.

For image formats, **WebP** (supported natively since WordPress 5.8) delivers 25–34% smaller files than JPEG with ~95% browser support and is safe for social sharing. **AVIF** offers up to 50% compression gains but is not yet safe for `og:image` tags — always maintain JPEG/PNG fallbacks for Open Graph. Use plugins like ShortPixel, Imagify, or EWWW Image Optimizer for automated compression and format conversion. Yoast and Rank Math automatically include images in their XML sitemaps, which Bing actively uses for image discovery.

WordPress generates responsive images automatically via `srcset` and `sizes` attributes, serving appropriately sized versions to different devices. Always set explicit `width` and `height` attributes on images (the Block Editor does this by default) to reserve layout space and prevent CLS.

---

## 10. Mobile-first indexing and HTTPS are non-negotiable baselines

Since July 2024, **all websites are evaluated by mobile Googlebot first**, regardless of their age or traffic. The mobile version is used for both indexing and ranking. The viewport meta tag (`<meta name="viewport" content="width=device-width, initial-scale=1">`) must be present — nearly all WordPress themes include it, but verify in your theme's `header.php` or via View Source. Ensure content parity between mobile and desktop: identical text, metadata, structured data, and internal links. Tap targets must be at least 48×48 pixels, and body text should be minimum 16px. **AMP is no longer a ranking factor** and is unnecessary for most sites in 2026 — focus on responsive design and Core Web Vitals instead.

**HTTPS is a confirmed ranking signal** (lightweight, tiebreaker-level) and a practical necessity, as browsers actively warn users on non-HTTPS sites. Both URLs in Settings → General ("WordPress Address" and "Site Address") must use `https://`. After enabling SSL, the critical follow-up is resolving **mixed content** — HTTPS pages loading resources over HTTP. Use Really Simple SSL for automatic detection and rewriting, or Better Search Replace for a database-level `http://` → `https://` swap. Set up a 301 redirect from HTTP to HTTPS (typically via .htaccess or hosting panel).

For security headers, implement **HSTS** (`Strict-Transport-Security: max-age=31536000; includeSubDomains; preload`) to force HTTPS-only connections, which improves both security and speed. Add **Content-Security-Policy**, **X-Content-Type-Options**, and **X-Frame-Options** headers at the server level. While security headers don't directly affect rankings, a site flagged by Google Safe Browsing for malware or phishing triggers interstitial warnings that cause ~95% of visitors to leave immediately, with potential de-indexing. Prevention through regular updates, a WAF (Wordfence or Sucuri), and strong login protection is far easier than recovery.

---

## Conclusion: the per-page checklist that ties it all together

The settings that matter most on every WordPress page fall into three tiers. **Tier one (check on every page):** SEO title under 60 characters with front-loaded keywords, unique meta description under 160 characters, self-referencing canonical URL, correct robots directives, descriptive image alt text, a short keyword-rich slug, and at least 2–5 internal links with varied anchor text. **Tier two (configure once, verify periodically):** appropriate schema type per page, Open Graph image at 1200×630px, breadcrumb markup, and Core Web Vitals passing thresholds. **Tier three (site-wide foundations that affect every page):** `/%postname%/` permalink structure, HTTPS with resolved mixed content, HSTS header, mobile-responsive theme with viewport tag, and the "Discourage search engines" checkbox firmly unchecked.

Rank Math offers the most complete free toolset for per-page SEO management (5 keywords, schema generator, redirect manager, social previews). Yoast's unified schema graph is the most technically elegant approach for standard content. AIOSEO's TruSEO scoring and slug monitoring fill useful niches. Whichever plugin you choose, the actionable principle is the same: every page deserves individual attention to its title, description, schema, images, links, and URL — because Google evaluates pages individually, not sites as a whole.