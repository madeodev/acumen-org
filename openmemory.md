# Acumen Org (Sage / Acorn WordPress theme)

## Overview

Roots Sage WordPress theme with Acorn, ACF Composer field groups in PHP, Bud front-end builds, and Blade templates.

## Architecture

- **Theme PHP:** `app/` (blocks, fields, models, providers, post types)
- **Views:** `resources/views/`
- **Assets:** Bud builds `resources/` → `public/`. Vue icons import `@images/*.svg` so the emitted URL matches the hashed file. Do not hardcode `public/images/*.hash.svg`.
- **ACF:** Code-defined via `log1x/acf-composer` (`app/Fields`, `app/Blocks`, `app/Options`) — not DB field groups

## Navigation

- Locations registered in `app/setup.php` (`main_navigation`, etc.)
- Loaded via `InteractsWithMenus` → `NavItem` → `HeaderNav` composer
- Partials: `nav-desktop` / `nav-mobile` branch on featured vs classic submenu

### Knowledge Hub featured posts (main nav only)

**CMS:** Appearance → Menus → Primary Navigation → edit the Knowledge Hub **parent** menu item.

**ACF** (`app/Fields/MainNavItemInfo.php`, location `nav_menu_item` / `main_navigation`):

- `featured_heading` (text) — label above featured cards; default “Featured”; Blade falls back to `__('Featured', 'sage')`
- `featured_posts` (relationship, max 1) — selects the main feature from `news`, `post`, `report`, or `case-study`; child menu links stay normal WP children

**Data** (`app/Models/NavItem.php`):

- Uses the one CMS-selected published post as the primary feature
- Queries the latest **2 published** items across `news`, `post`, `report`, and `case-study`, excluding the selected post
- Returns `[]` → classic submenu if the selected post is invalid or two automatic posts are unavailable
- Uses `News` / `Report` / `CaseStudy` / `Blog` serialize (title, link, excerpt, featured image, external URL/target)

**Views:**

- Featured (count === 3): `partials/subnav-desktop-featured`, `partials/subnav-mobile-featured`
  - Desktop: Featured heading → large card (image + title + description) → two title-only cards → children links
  - Mobile: first card only (image + title, no description) → children links
- Fallback: `partials/subnav-desktop`, `partials/subnav-mobile` (classic hover preview)
- Design mocks kept as: `subnav-desktop-static`, `subnav-mobile-static` (not wired in production nav)

**Not related:** Knowledge Hub Hero block / post grids — this is main navigation only.

### Knowledge Hub Hero posts slider

Vue carousel on `.knowledge-hub-hero-posts-slider-vue` (`KnowledgeHubHeroPostsSlider.vue`, Swiper `slidesPerView: 'auto'`).

Desktop slides use a definite width (`lg:w-636`, token `636` = 39.75rem). `lg:w-auto` made the 49/51 image-and-text split indefinite, so a wide featured image stretched the row and `overflow-hidden` clipped the text. The image is absolutely positioned in its column so its intrinsic size cannot change the card width.

## Interactive Map

ACF block `acf/interactive-map` (`app/Blocks/InteractiveMap.php`) loads all Region and Problem CPTs, then mounts Vue on `.interactive-map-vue`.

- Vue: `resources/scripts/vue/interactive-map.js` → `InteractiveMap.vue` + `MapDrawer.vue`
- World map is `resources/images/world-map.svg`, hashed in `public/` (Bud). Country `<g id="...">` IDs must match ACF country codes.
- Map SVG is loaded with `vue-inline-svg` using `\Roots\asset('images/world-map.svg')->uri()` (`assets` prop). Do not inline the SVG through a Vue slot — Vue strips the SVG `<style>` and countries render black instead of `#dad4c9`. Land fill/stroke is also set in `InteractiveMap.vue` as a fallback. Never hardcode hashed filenames in Vue.
- After map Vue/SVG changes, run `npm run build` so `public/js/interactiveMap.*.js` and `entrypoints.json` update (filename hash cache-busts).
- Related programs load from `GET /wp-json/sage-api/v2/programs/` when a drawer opens.

## Donation tracking (Funraise)

Classy is retired. The theme bridge lives in `resources/views/layouts/app.blade.php` (head, before Funraise create) for Giving Forms `49641` and `49591`.

- `onSetup` → `funraiseFormLoaded` (`form_id` only, once per form per page)
- `onInfo` → `funraiseFormInfo` (`form_id` only; donor fields are never pushed)
- `onSuccess` → `funraiseDonation` with `transaction_id`, `value`, `currency`, `form_id`, `form_name`, `frequency`, `recurring`, `payment_type`, `tip_amount`, `base_amount`, and GA4 `items` (`item_name` is the form name, `item_category` is frequency). Deduped by transaction id.
- `onFailure` → `funraiseDonationFailed` with `form_id` plus `value`, `currency`, and `frequency` when Funraise sends a donation object. Deduped separately from success.

GTM container `GTM-KWQG4Z9L` is not in the theme runtime. The importable workspace file is `gtm/GTM-KWQG4Z9L-retire-classy.json`: Classy folder removed, Funraise purchase enriched, form/info/failure events on `G-V0LRFNH5BY`, and a second purchase tag for Ad Grant property `G-FTSR3M5LED`. Import into a workspace and preview before publishing. Confirm the Ad Grant mirror with Nicole if that property no longer needs donation conversions.

## User Defined Namespaces

- [Leave blank - user populates]
