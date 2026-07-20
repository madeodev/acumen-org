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
- Main nav parent items can optionally set ACF **Featured Knowledge Hub Posts** (`featured_posts`, exactly 3 of news/post/report/case-study)
- When 3 featured posts are set: `subnav-desktop-featured` / `subnav-mobile-featured`
- Otherwise: classic `subnav-desktop` / `subnav-mobile`

## User Defined Namespaces

- [Leave blank - user populates]
