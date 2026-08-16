# Acumen Org (Sage / Acorn WordPress theme)

## Overview

Roots Sage WordPress theme with Acorn, ACF Composer field groups in PHP, Bud front-end builds, and Blade templates.

## Architecture

- **Theme PHP:** `app/` (blocks, fields, models, providers, post types)
- **Views:** `resources/views/`
- **Assets:** Bud builds `resources/` → `public/`
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

## Interactive Map

ACF block `acf/interactive-map` (`app/Blocks/InteractiveMap.php`) loads all Region and Problem CPTs, then mounts Vue on `.interactive-map-vue`.

- Vue: `resources/scripts/vue/interactive-map.js` → `InteractiveMap.vue` + `MapDrawer.vue`
- World map is `resources/images/world-map.svg`, hashed in `public/` (Bud). Country `<g id="...">` IDs must match ACF country codes.
- PHP inlines the current hashed SVG into a Vue slot (`map_svg` from `\Roots\asset('images/world-map.svg')->contents()`). Icon URLs go through an `assets` prop (`->uri()`). Never hardcode hashed filenames in Vue — a stale hash 404s silently (`vue-inline-svg` does not throw).
- After map Vue/SVG changes, run `npm run build` so `public/js/interactiveMap.*.js` and `entrypoints.json` update (filename hash cache-busts).
- Related programs load from `GET /wp-json/sage-api/v2/programs/` when a drawer opens.

## User Defined Namespaces

- [Leave blank - user populates]
