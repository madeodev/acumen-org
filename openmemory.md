# OpenMemory Guide — Acumen-Org

> Living project index for AI agents. Updated as the project evolves. Details live in `directives/project-setup.md`.

---

## Overview

| Property | Value |
|---|---|
| Project | Acumen Organization website |
| Type | WordPress theme (Sage 10 / Roots Acorn) |
| Repo | `madeodev/acumen-org` |
| Default branch | `staging` |
| Theme path | `/wp-content/themes/sage/` |
| PHP namespace | `App\` |
| Text domain | `sage` |

---

## Architecture

```
WordPress + ACF Pro
  └── Sage 10 theme (roots/sage v10.7.0)
        ├── Roots Acorn 3  (Laravel IoC inside WP)
        ├── ACF Composer   (PHP class → ACF block/field registration)
        ├── Bud.js 6       (Webpack asset pipeline)
        ├── Alpine.js 3    (lightweight reactive UI)
        ├── Vue 3          (complex interactive islands)
        ├── GSAP 3         (scroll animations)
        ├── Swiper 11      (carousels)
        └── Tailwind CSS   (utility-first styles)
```

---

## File Layout

| Path | Purpose |
|---|---|
| `app/Blocks/` | 29 ACF block PHP classes |
| `app/Concerns/` | Shared traits (Colors, AcfUtils, Video, Image…) |
| `app/Concerns/Colors/` | Color system sub-classes (ButtonColors, ModuleBgColors…) |
| `app/Endpoints/` | 6 WP REST API endpoint classes (`sage-api/v2/`) |
| `app/Fields/` | ACF field groups; `Partials/` for reusable partial field sets |
| `app/Models/` | Data wrapper/serialization classes |
| `app/Options/` | 9 admin options page definitions |
| `app/PostTypes/` | 11 custom post type classes |
| `app/Providers/` | 8 Laravel service providers (wired in `config/app.php`) |
| `app/Repositories/` | WP_Query wrappers (BaseRepository + 13 typed repos) |
| `app/Taxonomies/` | 16 custom taxonomy classes |
| `app/View/Components/` | PHP backing classes for Blade `<x-*>` components |
| `app/View/Composers/` | View composers (auto-inject data into views) |
| `config/app.php` | Service provider registration, app environment |
| `directives/project-setup.md` | **Full technical reference — read before any code work** |
| `resources/scripts/app.js` | Main JS entry (Alpine.js init + block modules) |
| `resources/scripts/blocks/` | Alpine.js component modules |
| `resources/scripts/util/animations.js` | GSAP/ScrollTrigger animation engine |
| `resources/scripts/vue/` | Vue 3 entry points, components, composables |
| `resources/styles/app.css` | Main CSS entry (fonts → Tailwind → overrides) |
| `resources/views/layouts/app.blade.php` | Root HTML layout template |
| `resources/views/blocks/` | Blade templates for each ACF block |
| `resources/views/components/` | Blade component templates |
| `public/` | Build output — DO NOT edit manually |
| `bud.config.js` | Bud.js build configuration (8 entry points) |
| `tailwind.config.js` | Design tokens: colors, fonts, spacing, breakpoints |

---

## User Defined Namespaces

- `blocks` — ACF block classes, block Blade templates, block JS
- `components` — Blade components (PHP + template) and Vue components
- `endpoints` — REST API endpoints and repositories
- `post-types` — Custom post types, taxonomies, fields, models
- `styles` — CSS, Tailwind config, design tokens, color system
- `build` — Bud.js config, package.json, build workflow

---

## Components

### ACF Blocks (29)
Accordion, AnimatedBlockquote, Banner, Carousel, CarouselCaseStudyCard, CarouselLarge, CompanyGrid (Vue), FeaturedPosts, FeatureImage, FiftyFifty, Form, FoundryGrid (Vue), Hero, Image, InteractiveMap (Vue), Intro, KnowledgeHubHero, LargeCTA, LogoTiles, Numbers, PeopleGrid (Vue), PostGridWithFilter (Vue), RelatedFeaturedPosts, RowOfCards, ShareButtons, Stats, Tabs, TextCard, Tiles, Title, UnstructuredCards

### Blade Components (18)
`<x-alert>`, `<x-author-card>`, `<x-button>`, `<x-card>`, `<x-featured-posts>`, `<x-footer>`, `<x-image>`, `<x-local-video-loop>`, `<x-modal-video>`, `<x-pagination>`, `<x-parallax-image>`, `<x-preview>`, `<x-search-form>`, `<x-social-media>`, `<x-stats>`, `<x-title>`, `<x-topic-label>`, `<x-translation-bar>`

### Vue 3 Islands (6)
PeopleGrid, CompanyGrid, PostGridFilter, InteractiveMap, FoundryGrid, KnowledgeHubHeroPostsSlider

---

## Patterns

### New Block Checklist
1. `app/Blocks/MyBlock.php` (extends `Block`, `$category = 'acumen'`)
2. `resources/views/blocks/my-block.blade.php` (with `@if ($block->preview)` guard)
3. `resources/images/previews/my-block.jpg`
4. Alpine JS in `resources/scripts/blocks/myBlock.js` + register in `app.js` if needed

### Color System Usage
```php
// In Block::with():
'colors' => new ModuleBgColors(get_field('color') ?? ''),
```
```blade
<section class="{{ $colors->classes('wrapper') }}">
```

### Animation Attributes (Blade templates)
- `animate` → fade-up on scroll
- `animate-text` → line-by-line text reveal (SplitType + GSAP)
- `parallax` → parallax scroll on child `<img>`
- `animate-image="reveal"` → clip-path image reveal

### Container
Always use `.container-fluid` (not `.container`).

### REST API
Vue islands fetch from `sage-api/v2/` endpoints. Use `useFetch.js` and `useFilters.js` composables.

### Build
```bash
yarn dev    # HMR dev server (port 3000, proxied to WP_HOME)
yarn build  # Production output → public/
```
