# Acumen-Org — Project Setup

> Living reference for the Acumen Organization WordPress theme. Read this (and `openmemory.md`) before implementing any feature, block, or architectural change.

---

## 1. Project Overview

| Property | Value |
|---|---|
| Project | Acumen Organization website |
| Theme name | Sage Starter Theme (customised) |
| Theme version | 10.7.0 |
| WordPress path | `/wp-content/themes/sage/` |
| PHP namespace | `App\` |
| Text domain | `sage` |
| Composer name | `roots/sage` |
| Node package name | `sage` |
| Min PHP | 8.0 |
| Min WP | 5.9 |

---

## 2. Tech Stack

### Back-end (PHP)
| Package | Version | Role |
|---|---|---|
| PHP | ≥ 8.0 | Language |
| `roots/acorn` | ^3.2 | Laravel IoC container inside WordPress |
| `log1x/acf-composer` | ^2.1 | Register ACF blocks/fields as PHP classes |
| `log1x/sage-svg` | ^1.1 | Inline SVG directive for Blade |
| `spatie/once` | ^3.1 | Memoization helper |
| Composer | — | PHP dependency management; PSR-4 autoloading (`App\` → `app/`) |

### Front-end (JS/CSS)
| Package | Version | Role |
|---|---|---|
| `@roots/bud` | ^6.17.0 | Asset bundler (Webpack wrapper) |
| `@roots/bud-tailwindcss` | ^6.17.0 | Tailwind CSS integration |
| `@roots/bud-vue` | ^6.17.0 | Vue 3 support in Bud |
| `@roots/bud-postcss` | ^6.17.0 | PostCSS pipeline |
| `@roots/sage` | ^6.17.0 | Sage-specific Bud extensions |
| Alpine.js | ^3.13.2 | Reactive UI (accordion, nav, carousel, modals) |
| `@alpinejs/collapse` | ^3.13.3 | Alpine collapse plugin |
| `@alpinejs/focus` | ^3.13.2 | Alpine focus trap plugin |
| `@alpinejs/intersect` | ^3.13.3 | Alpine intersection observer plugin |
| Vue 3 | ^3.3.4 | Complex interactive islands (grids, maps) |
| GSAP | ^3.12.4 | Animation engine |
| SplitType | ^0.3.4 | Text line-splitting for GSAP animations |
| Swiper | ^11.0.5 | Carousel/slider |
| `vue-inline-svg` | ^3.1.2 | SVG rendering inside Vue components |
| `@vueuse/components` | ^10.7.2 | Vue composition utilities |
| `focus-trap` | ^7 | Keyboard focus trap for modals |
| Tailwind CSS | (via bud) | Utility-first CSS |

---

## 3. Directory Layout

```
acumen-org/                       ← WordPress theme root
├── app/                          ← PHP application code
│   ├── Blocks/                   ← ACF block definitions (29 blocks)
│   ├── Concerns/                 ← Shared traits/utilities
│   │   └── Colors/               ← Color system sub-classes
│   ├── Endpoints/                ← WP REST API endpoint classes (6)
│   ├── Fields/                   ← ACF field group definitions
│   │   └── Partials/             ← Reusable field partial sets
│   ├── Models/                   ← Data wrapper/serialization classes
│   ├── Options/                  ← Admin options page definitions (9)
│   ├── PostTypes/                ← Custom post type registration (11)
│   ├── Providers/                ← Laravel service providers (8)
│   ├── Repositories/             ← WP_Query abstraction layer (13 + base)
│   ├── Taxonomies/               ← Custom taxonomy registration (16)
│   ├── View/
│   │   ├── Components/           ← PHP backing classes for Blade <x-*> components
│   │   └── Composers/            ← View composers (auto-inject data into views)
│   ├── filters.php               ← WordPress filter/action hooks
│   └── setup.php                 ← Theme setup (enqueue, nav menus, WP supports)
│
├── config/                       ← Acorn/Laravel config files
│   ├── app.php                   ← Service provider registration, app env
│   ├── acf.php                   ← ACF config
│   ├── assets.php                ← Asset manifest config
│   ├── view.php                  ← Blade view paths
│   └── svg.php                   ← SVG helper config
│
├── directives/                   ← AI agent / developer reference docs
│   └── project-setup.md          ← THIS FILE
│
├── public/                       ← Build output (DO NOT edit manually)
│   ├── css/                      ← Compiled CSS (content-hashed)
│   ├── js/                       ← Compiled JS (content-hashed)
│   ├── fonts/                    ← Copied font files
│   ├── images/                   ← Copied image/SVG assets
│   ├── json/                     ← Copied JSON assets
│   ├── manifest.json             ← Asset hash manifest
│   └── entrypoints.json          ← Entry point → file mapping (used by Acorn)
│
├── resources/                    ← Front-end source files
│   ├── fonts/                    ← Custom woff2 font files + stylesheet.css per family
│   │   ├── big-shoulders-display/
│   │   ├── copernicus/
│   │   └── gellix/
│   ├── images/                   ← SVG icons + block preview thumbnails
│   │   ├── admin-icons/          ← WP admin menu icons
│   │   ├── previews/             ← Block editor preview JPGs
│   │   └── tax-icons/            ← Taxonomy term icons
│   ├── json/                     ← Static data (country-data.json)
│   ├── scripts/                  ← JavaScript source
│   │   ├── app.js                ← Main JS entry point
│   │   ├── editor.js             ← Gutenberg editor JS entry
│   │   ├── blocks/               ← Alpine.js component modules
│   │   ├── filters/              ← Filter/search helpers
│   │   ├── util/                 ← Shared utilities (animations.js)
│   │   └── vue/                  ← Vue 3 apps
│   │       ├── components/       ← Vue single-file components
│   │       │   └── map/          ← InteractiveMap + MapDrawer components
│   │       └── composables/      ← useFetch.js, useFilters.js
│   └── styles/                   ← CSS source
│       ├── app.css               ← Main CSS entry
│       ├── editor.css            ← Editor CSS entry
│       ├── common/               ← global.css, typography.css, wysiwyg.css, gutenberg.css
│       ├── components/           ← 3rd-party component style overrides
│       └── editor/               ← Block editor styles
│
├── resources/views/              ← Blade templates
│   ├── layouts/app.blade.php     ← Root HTML layout (<!doctype html>…)
│   ├── blocks/                   ← One .blade.php per ACF block
│   ├── components/               ← Blade component templates
│   ├── partials/                 ← nav-desktop, nav-mobile, content-*, page-header
│   ├── sections/                 ← header.blade.php, sidebar.blade.php
│   ├── 404.blade.php
│   ├── index.blade.php
│   ├── page.blade.php
│   ├── search.blade.php
│   └── single.blade.php
│
├── storage/                      ← Acorn cache / compiled views (git-ignored)
├── vendor/                       ← Composer packages (git-ignored)
├── bud.config.js                 ← Bud.js build configuration
├── composer.json
├── functions.php                 ← WP theme bootstrap (boots Acorn, loads setup/filters)
├── index.php                     ← WP theme index stub
├── jsconfig.json                 ← JS path aliases for IDE
├── package.json
├── style.css                     ← WP theme header (name, version, text domain)
├── stylelint.config.cjs
├── tailwind.config.js
└── theme.json                    ← WP block editor theme config (auto-generated by Bud)
```

---

## 4. Build System

### Commands

```bash
yarn dev        # Start Bud dev server (HMR proxy on port 3000)
yarn build      # Production build → public/
```

For translations:

```bash
yarn translate         # make-pot + update-po
yarn translate:compile # make-mo + make-json
```

PHP linting:

```bash
composer run lint      # PHP_CodeSniffer PSR-12 on app/
```

### Entry Points (`bud.config.js`)

| Entry name | Source | Output type |
|---|---|---|
| `app` | `@scripts/app` + `@styles/app` | JS + CSS |
| `editor` | `@scripts/editor` + `@styles/editor` | JS + CSS (Gutenberg) |
| `peopleGrid` | `@scripts/vue/people-grid` | JS + CSS (Vue island) |
| `companyGrid` | `@scripts/vue/company-grid` | JS + CSS (Vue island) |
| `postGridFilter` | `@scripts/vue/post-grid-filter` | JS + CSS (Vue island) |
| `interactiveMap` | `@scripts/vue/interactive-map` | JS + CSS (Vue island) |
| `foundryGrid` | `@scripts/vue/foundry-grid` | JS + CSS (Vue island) |
| `knowledgeHubHeroPostsSlider` | `@scripts/vue/knowledge-hub-hero-posts-slider` | JS (Vue island) |

### Key Bud Configuration Details

- **Public path**: `/wp-content/themes/sage/public/` (set via `BUD_PUBLIC_PATH` env or hard-coded fallback)
- **Dev server proxy**: reads `WP_HOME` env variable, serves on port 3000
- **Watched files**: `resources/views/` and `app/` (triggers browser reload)
- **SVG for Vue**: SVG files imported inside `.vue` files are emitted as `asset/resource` (not inlined) so `vue-inline-svg` can load them by URL
- **Tailwind color imports**: `app.tailwind.generateImports(['colors'])` makes Tailwind's named colors importable inside Vue as `@tailwind/colors`
- **Output**: all files in `public/` get a content hash (`app.a457be.css`); `manifest.json` and `entrypoints.json` map entry names → hashed paths
- **Asset loading in PHP**: use Acorn's `bundle('entry-name')->enqueue()` — it reads the manifest automatically

---

## 5. PHP Architecture

### Bootstrap Flow

```
WordPress loads theme
  → functions.php
    → Composer autoloader (vendor/autoload.php)
    → \Roots\bootloader()->boot()        ← boots Acorn (Laravel container)
    → app/setup.php                      ← enqueue bundles, register nav menus, WP supports
    → app/filters.php                    ← WordPress hooks/filters
    → config/app.php providers boot      ← all service providers register/boot
```

### Service Providers (registered in `config/app.php`)

| Provider | Responsibility |
|---|---|
| `GutenbergProvider` | Adds `acumen` + `bw-blox` block categories; filters allowed block types to ACF blocks + core basics |
| `CustomPostTypeProvider` | Registers all 11 custom post types via `init` hook |
| `TaxonomyProvider` | Registers all 16 custom taxonomies |
| `AdminSettingsProvider` | Registers admin options pages (9 settings panels) |
| `EndpointProvider` | Registers all 6 REST API endpoint classes |
| `AcfProvider` | ACF field filters (e.g. excludes current post from post-object fields) |
| `GravityFormsProvider` | Gravity Forms customizations |
| `PageCacheProvider` | Page cache integration |

### Blocks (`app/Blocks/`)

Every block extends `Log1x\AcfComposer\Block`. Anatomy:

```php
class MyBlock extends Block
{
    public $name        = 'My Block';       // Display name
    public $description = '...';
    public $category    = 'acumen';         // Always 'acumen' for custom blocks
    public $icon        = 'cover-image';    // Dashicon slug
    public $mode        = 'edit';
    public $supports    = ['jsx' => true, 'multiple' => true, ...];

    public function with(): array           // Data passed to Blade view
    {
        return [
            'title'  => get_field('title') ?? '',
            'colors' => new ButtonColors(get_field('color') ?? ''),
            ...ButtonOrModal::getFields(),
            ...ModuleBackground::getFields(),
        ];
    }

    public function fields(): array         // ACF field group definition
    {
        $builder = new FieldsBuilder('my_block');
        $builder
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addFields($this->get(ModuleBackground::class))
            ->addText('title', ['label' => 'Title', 'required' => 1]);
        return $builder->build();
    }

    public function enqueue(): void {}      // Optional: enqueue block-specific assets
}
```

The corresponding Blade view lives at `resources/views/blocks/kebab-case-name.blade.php`.

Every block view receives `$block` (the block object) and the variables returned from `with()`. Always guard with `@if ($block->preview)` to show the editor preview image.

### Fields (`app/Fields/`)

- **Standalone field groups** (e.g. `HeroSettings.php`) — attach ACF field groups to specific post types or options pages
- **Partials** (`app/Fields/Partials/`) — reusable field sets mixed into blocks via `->addFields($this->get(PartialClass::class))`; key partials:
  - `Button.php` / `ButtonOrModal.php` — CTA button fields
  - `ModuleBackground.php` — background color/media fields
  - `HeadingIntro.php` — heading + intro text
  - `ImageOrVideo.php` — media format selector
  - `Stats.php` / `StatsSettings.php` — statistics fields

### Models (`app/Models/`)

Data wrapper/serialization classes used by Repositories and Endpoints. Key models:

- `Query` — serializes `WP_Query` results for REST responses
- `Term` — taxonomy term helpers including `getByPostType()`
- Content models: `Author`, `Blog`, `CaseStudy`, `Company`, `Foundry`, `NavItem`, `News`, `Partner`, `Post`, `Problem`, `Program`, `Region`, `Report`, `Resource`, `Search`, `Team`, `Taxonomy`

### Repositories (`app/Repositories/`)

`BaseRepository` provides `buildQuery()` which handles:
- Post type, pagination (`posts_per_page`, `paged`)
- Ordering (`order`, `orderby`)
- Post inclusion/exclusion (`post__in`, `post__not_in`)
- Taxonomy term filtering (`terms` JSON param)
- Taxonomy term exclusion (`exclude_terms`)
- Full-text search (`search`)
- WPML language switching

Each content-specific repository extends `BaseRepository` and sets `$postType`.

### Endpoints (`app/Endpoints/`)

All endpoints registered via `EndpointProvider`. Base namespace: `sage-api/v2/`

| Class | Routes |
|---|---|
| `PostGridFilterEndpoint` | `GET /post-grid/filters/` — returns available taxonomy filters; `GET /post-grid/posts/` — returns paginated posts |
| `CompanyEndpoint` | Company CPT data |
| `FoundryEndpoint` | Foundry CPT data |
| `ProgramEndpoint` | Program CPT data |
| `TeamEndpoint` | Team CPT data |
| `TermEndpoint` | Taxonomy term lookups |

All endpoints are public (`permission_callback` returns `true`).

### View Components (`app/View/Components/`)

PHP classes backing Blade `<x-*>` components. Component → template mapping:

| `<x-component>` | PHP Class | Blade Template |
|---|---|---|
| `<x-button>` | `Button.php` | `components/button.blade.php` |
| `<x-card>` | `Card.php` | `components/card.blade.php` |
| `<x-image>` | `Image.php` | `components/image.blade.php` |
| `<x-parallax-image>` | `ParallaxImage.php` | `components/parallax-image.blade.php` |
| `<x-modal-video>` | `ModalVideo.php` | `components/modal-video.blade.php` |
| `<x-local-video-loop>` | `LocalVideoLoop.php` | `components/local-video-loop.blade.php` |
| `<x-footer>` | `Footer.php` | `components/footer.blade.php` |
| `<x-pagination>` | `Pagination.php` | `components/pagination.blade.php` |
| `<x-stats>` | `Stats.php` | `components/stats.blade.php` |
| `<x-title>` | `Title.php` | `components/title.blade.php` |
| `<x-topic-label>` | `TopicLabel.php` | `components/topic-label.blade.php` |
| `<x-author-card>` | `AuthorCard.php` | `components/author-card.blade.php` |
| `<x-featured-posts>` | `FeaturedPosts.php` | `components/featured-posts.blade.php` |
| `<x-translation-bar>` | `TranslationBar.php` | `components/translation-bar.blade.php` |
| `<x-search-form>` | `SearchForm.php` | `components/search-form.blade.php` |
| `<x-social-media>` | `SocialMedia.php` | `components/social-media.blade.php` |
| `<x-preview>` | `Preview.php` | `components/preview.blade.php` |
| `<x-alert>` | `Alert.php` | `components/alert.blade.php` |

### View Composers (`app/View/Composers/`)

| Composer | Views | Injects |
|---|---|---|
| `App` | `*` (all views) | `$siteName` |
| `HeaderNav` | Header/nav views | Navigation data |
| `Post` | Post-related views | Post meta |
| `Single` | `single.*` | Single post data |
| `Search` | `search.*` | Search results |
| `ErrorPage` | `404.*` | Error page data |

---

## 6. Custom Post Types (11)

| Post Type | Class | Slug |
|---|---|---|
| Case Study | `CaseStudyPostType` | `case-study` |
| Company | `CompanyPostType` | `company` |
| Foundry | `FoundryPostType` | `foundry` |
| News | `NewsPostType` | `news` |
| Partner | `PartnerPostType` | `partner` |
| Post (standard) | `Post` | `post` |
| Problem | `ProblemPostType` | `problem` |
| Program | `ProgramPostType` | `program` |
| Region | `RegionPostType` | `region` |
| Report | `ReportPostType` | `report` |
| Team | `TeamPostType` | `team` |

---

## 7. Custom Taxonomies (16)

| Taxonomy | Class | Notes |
|---|---|---|
| Author | `AuthorTaxonomy` | Content authorship |
| Blog Type | `BlogTypeTaxonomy` | Blog post categories |
| Case Study Type | `CaseStudyTypeTaxonomy` | |
| Company Status | `CompanyStatusTaxonomy` | Portfolio company status |
| Fellowship | `FellowshipTaxonomy` | Fellowship programs |
| Media Format | `MediaFormatTaxonomy` | Resource media type (video, PDF, etc.) |
| News Type | `NewsTypeTaxonomy` | |
| Office | `OfficeTaxonomy` | Acumen office locations |
| Problem | `ProblemTaxonomy` | Social problem areas |
| Problem (Info) | `ProblemTaxonomyInfo` (Field) | ACF fields for Problem taxonomy |
| Program Type | `ProgramTypeTaxonomy` | |
| Region | `RegionTaxonomy` | Geographic regions |
| Report Type | `ReportTypeTaxonomy` | |
| Team Function | `TeamFunctionTaxonomy` | Team member roles |
| Team Type | `TeamTypeTaxonomy` | Fellow, staff, etc. |
| Year | `YearTaxonomy` | Publication/program year |

---

## 8. ACF Blocks (29)

All blocks use the `acumen` Gutenberg category. Each block has a preview image in `resources/images/previews/`.

| Block Class | Blade Template | Description |
|---|---|---|
| `Accordion` | `accordion.blade.php` | Collapsible Q&A sections |
| `AnimatedBlockquote` | `animated-blockquote.blade.php` | Pull quote with animation |
| `Banner` | `banner.blade.php` | Full-width banner (color or media variants) |
| `Carousel` | `carousel.blade.php` | General content carousel |
| `CarouselCaseStudyCard` | `carousel-case-study-card.blade.php` | Case study card carousel |
| `CarouselLarge` | `carousel-large.blade.php` | Large format carousel |
| `CompanyGrid` | `company-grid.blade.php` | Filterable portfolio company grid (Vue) |
| `FeaturedPosts` | `featured-posts.blade.php` | Manually selected featured posts |
| `FeatureImage` | `feature-image.blade.php` | Full-width editorial image |
| `FiftyFifty` | `fifty-fifty.blade.php` | 50/50 split content + media |
| `Form` | `form.blade.php` | Gravity Forms embed |
| `FoundryGrid` | `foundry-grid.blade.php` | Foundry companies grid (Vue) |
| `Hero` | `hero.blade.php` | Page hero (color or media bg, optional video modal) |
| `Image` | `image.blade.php` | Standalone image block |
| `InteractiveMap` | `interactive-map.blade.php` | World map with region data (Vue + Leaflet) |
| `Intro` | `intro.blade.php` | Section introduction text |
| `KnowledgeHubHero` | `knowledge-hub-hero.blade.php` | Knowledge Hub featured posts hero |
| `LargeCTA` | `large-c-t-a.blade.php` | Full-width call to action |
| `LogoTiles` | `logo-tiles.blade.php` | Partner/sponsor logo grid |
| `Numbers` | `numbers.blade.php` | Impact statistics with large numbers |
| `PeopleGrid` | `people-grid.blade.php` | Filterable team/people grid (Vue) |
| `PostGridWithFilter` | `post-grid-with-filter.blade.php` | Filterable post grid (Vue, REST API) |
| `RelatedFeaturedPosts` | `related-featured-posts.blade.php` | Related content recommendations |
| `RowOfCards` | `row-of-cards.blade.php` | Horizontal row of content cards |
| `ShareButtons` | `share-buttons.blade.php` | Social share links |
| `Stats` | `stats.blade.php` | Statistics / data highlights |
| `Tabs` | `tabs.blade.php` | Tabbed content sections |
| `TextCard` | `text-card.blade.php` | Text-only card |
| `Tiles` | `tiles.blade.php` | Grid of tiles with optional colors |
| `Title` | `title.blade.php` | Section heading block |
| `UnstructuredCards` | `unstructured-cards.blade.php` | Freeform card layout |

---

## 9. REST API Endpoints

Base namespace: `sage-api/v2/`

| Route | Method | Class | Returns |
|---|---|---|---|
| `/post-grid/filters/` | GET | `PostGridFilterEndpoint` | Available taxonomy filter options for a post type |
| `/post-grid/posts/` | GET | `PostGridFilterEndpoint` | Paginated, filtered posts |
| `/company/` | GET | `CompanyEndpoint` | Company CPT data |
| `/foundry/` | GET | `FoundryEndpoint` | Foundry CPT data |
| `/program/` | GET | `ProgramEndpoint` | Program CPT data |
| `/team/` | GET | `TeamEndpoint` | Team member data |
| `/term/` | GET | `TermEndpoint` | Taxonomy term data |

**Query parameters** (shared, via `BaseRepository::buildQuery`):

| Param | Type | Description |
|---|---|---|
| `post_type` | string | Post type slug |
| `per_page` | int | Results per page (default 14) |
| `page` | int | Page number |
| `order` | `ASC\|DESC` | Sort direction |
| `orderby` | string | WP_Query orderby value |
| `terms` | JSON string | Array of `{taxonomy, ID}` objects for filtering |
| `exclude_terms` | JSON string | `{taxonomy: [slugs]}` to exclude |
| `search` | string | Full-text search query |
| `post__in` | string | Comma-separated post IDs to include |
| `post__not_in` | string | Comma-separated post IDs to exclude |

---

## 10. View Layer (Blade)

### Template Hierarchy

```
layouts/app.blade.php          ← Root: <html>, <head>, <body>, header, footer
  ├── sections/header.blade.php
  │     ├── partials/nav-desktop.blade.php
  │     ├── partials/nav-mobile.blade.php
  │     ├── partials/subnav-desktop.blade.php
  │     └── partials/subnav-mobile.blade.php
  ├── @yield('content')        ← filled by page templates below
  │     ├── page.blade.php          → partials/content-page.blade.php
  │     ├── single.blade.php        → partials/content-single.blade.php
  │     ├── index.blade.php         → partials/content.blade.php
  │     ├── search.blade.php
  │     └── 404.blade.php
  └── <x-footer />
```

### Block Template Convention

Each ACF block class points to `resources/views/blocks/{kebab-name}.blade.php`.

Every block template must:
1. Guard `@if ($block->preview)` → render `<x-preview :block="$block" :variant="$module_bg" />`
2. Use variables injected from the block's `with()` method
3. Apply color classes via `$colors->classes('section-key')` (never hard-code color utilities)

Example:

```blade
@if ($block->preview)
  <x-preview :block="$block" :variant="$module_bg" />
@else
  <section class="{{ $block->classes }} {{ $colors->classes('wrapper') }}">
    ...
  </section>
@endif
```

---

## 11. JavaScript Architecture

### Entry Points & Their Role

| File | Entry | Technology | Purpose |
|---|---|---|---|
| `resources/scripts/app.js` | `app` | Alpine.js | Init Alpine plugins, register Alpine components, call animations |
| `resources/scripts/editor.js` | `editor` | — | Gutenberg editor customisations |
| `resources/scripts/vue/people-grid.js` | `peopleGrid` | Vue 3 | Mount PeopleGrid Vue app(s) |
| `resources/scripts/vue/company-grid.js` | `companyGrid` | Vue 3 | Mount CompanyGrid Vue app(s) |
| `resources/scripts/vue/post-grid-filter.js` | `postGridFilter` | Vue 3 | Mount PostGridFilter Vue app(s) |
| `resources/scripts/vue/interactive-map.js` | `interactiveMap` | Vue 3 | Mount InteractiveMap Vue app(s) |
| `resources/scripts/vue/foundry-grid.js` | `foundryGrid` | Vue 3 | Mount FoundryGrid Vue app(s) |
| `resources/scripts/vue/knowledge-hub-hero-posts-slider.js` | `knowledgeHubHeroPostsSlider` | Vue 3 | Mount KnowledgeHub slider |

### Alpine.js Components (in `app.js`)

All Alpine components are registered as `Alpine.data('name', importedFn)` and applied via `x-data="name"` in Blade templates.

| Alpine data name | Source file | Block |
|---|---|---|
| `accordion` | `blocks/accordion.js` | Accordion |
| `tabs` | `blocks/tabs.js` | Tabs |
| `nav` | `blocks/nav.js` | Navigation |
| `logoAnimation` | `blocks/logoAnimation.js` | Logo animation |
| `localVideo` | `blocks/localVideo.js` | Local video loop |
| `videoModal` | `blocks/videoModal.js` | Video modal |
| `carousel` | `blocks/carousel.js` | Carousel |
| `carouselCaseStudyCard` | `blocks/carouselCaseStudyCard.js` | Carousel - Case Study |
| `carouselLarge` | `blocks/carouselLarge.js` | Carousel Large |
| `carouselKnowledgeHub` | `blocks/carouselKnowledgeHub.js` | Knowledge Hub carousel |
| `stats` | `blocks/stats.js` | Stats counter |
| `shareButtons` | `blocks/shareButtons.js` | Share buttons |
| `parallaxBlockquote` | `blocks/parallaxBlockquote.js` | Animated Blockquote |

### Vue 3 Islands

Each Vue island mounts on all elements matching a CSS selector (e.g. `.post-grid-filter-vue`). The pattern:

```js
import { createApp } from 'vue';
import MyComponent from './components/MyComponent.vue';

document.querySelectorAll('.my-component-vue').forEach((el) => {
  createApp({ components: { MyComponent } }).mount(el);
});
```

Vue islands communicate with the back-end through the `sage-api/v2/` REST API.

**Composables** (`resources/scripts/vue/composables/`):
- `useFetch.js` — data fetching helper
- `useFilters.js` — shared filter state management

### Utility: `animations.js`

Initialised once in `app.js` via `animations()`. Registers GSAP + ScrollTrigger and sets up four animation systems triggered by HTML attributes (see Section 12).

---

## 12. Animation Conventions

All GSAP animations are scroll-triggered. Apply the following HTML attributes in Blade templates to opt in:

| Attribute | Effect |
|---|---|
| `animate` | Element fades up from `y: 100%` + `opacity: 0` when scrolled into view |
| `animate-text` | Text is split into lines by SplitType; each line animates in sequentially. SplitType is reverted on completion. |
| `parallax` | The child `<img>` scrolls at a slower rate than the page (25% `yPercent` over full scroll range) |
| `animate-image="reveal"` | Image animates from `inset(15% 20%)` clip-path to `inset(0%)` while simultaneously scaling `1.1 → 1.0` |

Global animation settings: `duration: 1.1s`, `ease: power1.out`, `stagger: 0.15s` between items.

On window resize, `SplitType` re-splits text (debounced, 100ms) via `ResizeObserver`.

---

## 13. CSS Architecture

### Import Order (`resources/styles/app.css`)

1. Custom font `@font-face` stylesheets (Big Shoulders Display, Gellix, Copernicus)
2. `tailwindcss/base`
3. `tailwindcss/components`
4. `tailwindcss/utilities`
5. `common/global.css` — base resets and global styles
6. `common/typography.css` — heading/body type scale
7. `common/wysiwyg.css` — WordPress editor prose styles
8. `common/gutenberg.css` — block editor overrides
9. `components/convertpro.css` — ConvertPro popup overrides
10. `components/gravityforms.css` — Gravity Forms styles
11. `components/datepicker.css` — Date picker overrides
12. `components/footer.css` — Footer component styles
13. `components/swiper.css` — Swiper carousel overrides
14. `components/scrollbar.css` — Custom scrollbar styles
15. `components/thriveleads.css` — ThriveLeads embed overrides

### Container Convention

This project uses `.container-fluid` **not** `.container`. Always use `.container-fluid` for full-width sections with padding.

### Tailwind Purge Paths

```js
content: ['./index.php', './app/**/*.php', './resources/**/*.{php,vue,js}']
```

Dynamic classes used in PHP logic (e.g. color classes assembled at runtime) must be safelisted or fully spelled out in source — never constructed as string fragments.

---

## 14. Design Tokens

### Typography

| Token | Family | Weights | Usage |
|---|---|---|---|
| `font-display` | Big Shoulders Display | Bold | Hero headlines, display type |
| `font-sans` | Gellix | Regular (350), Regular Italic, SemiBold, Bold | Body text, UI |
| `font-serif` | Copernicus | Book, Book Italic, Medium, Medium Italic | Editorial / long-form prose |

Custom font-weight: `font-book` = `350`.

### Type Scale (rem, base 16px)

| Class | px |
|---|---|
| `text-8xl` | 120px |
| `text-7xl` | 100px |
| `text-6xl` | 90px |
| `text-5.5xl` | 80px |
| `text-5xl` | 66px |
| `text-4xl` | 52px |
| `text-3xl` | 42px |
| `text-2xl` | 32px |
| `text-1.5xl` | 28px |
| `text-xl` | 24px |
| `text-lg` | 22px |
| `text-2md` | 20px |
| `text-md` | 18px |
| `text-base` | 16px |

### Color Palette

| Name | Hex |
|---|---|
| `white` | `#ffffff` |
| `black` | `#000000` |
| `stone` | `#F7F2EA` |
| `racecar` | `#064F23` |
| `cactus` | `#087323` |
| `lime` | `#0F8C29` |
| `maize` | `#F4D682` |
| `mizuna` | `#09B064` |
| `woad` | `#004969` |
| `verdigris` | `#007076` |
| `turquoise` | `#00A0CC` |
| `sapphire` | `#002F71` |
| `lapis` | `#2C2CB8` |
| `provence` | `#2A6EEB` |
| `amethyst` | `#70147D` |
| `tulip` | `#AB2182` |
| `azalea` | `#E52D87` |
| `cinnabar` | `#CE242B` |
| `spice` | `#E45313` |
| `ember` | `#FF3500` |
| `orange` | `#EC7404` |
| `nutmeg-light` | `#CE4B11` |
| `gold` | `#FFA000` |
| `daisy` | `#FDCA00` |
| `ocean` | `#03364F` |
| `plum` | `#4F005E` |
| `gray` | `#4b5563` |

### Breakpoints

| Key | Value |
|---|---|
| `sm` | 640px |
| `md` | 768px |
| `lg` | 1024px |
| `xl` | 1280px |
| `2xl` | 1536px |
| `3xl` | 1696px (custom) |

### Border Radius Tokens

| Class | Value |
|---|---|
| `rounded-card` | 30px |
| `rounded-image` | 80px |
| `rounded-image-xl` | 150px |

### Aspect Ratios

| Class | Ratio |
|---|---|
| `aspect-card` | 37/40 |
| `aspect-drawer` | 99/80 |
| `aspect-hero-card` | 159/118 |
| `aspect-hero-card-image` | 276/360 |

---

## 15. Color System

### Architecture

The color system in `app/Concerns/Colors.php` is a base PHP class used to:
1. Provide CMS color picker options as styled WP admin radio buttons
2. Return Tailwind class strings for a given color selection

#### Sub-classes in `app/Concerns/Colors/`

| Class | Use |
|---|---|
| `ButtonColors` | Button background + text color combinations |
| `CardColors` | Card component color variants |
| `Colorways` | Generic section/module color themes |
| `ColorwaysDark` | Dark variant colorways |
| `ColorwaysLight` | Light variant colorways |
| `ModuleBgColors` | Module/section background colors |
| `TileColors` | Tile component color variants |

#### Usage Pattern (in a Block)

```php
// In Block::with():
return [
    'colors' => new ModuleBgColors(get_field('color') ?? ''),
];
```

```blade
{{-- In block Blade template: --}}
<section class="{{ $colors->classes('wrapper') }}">
  <div class="{{ $colors->classes('text') }}">
    ...
  </div>
</section>
```

#### Convenience Methods

```php
$colors->classes('section')       // Returns Tailwind class string for named section
$colors->hasSection('section')    // Returns bool — safe to check before using
(new ButtonColors())->getColorOptions()   // Returns all options as styled WP buttons
(new ButtonColors())->getColorOptions(['racecar', 'cactus'])  // Subset
Colors::getSiteTheme()            // Returns active site color theme key from DB
```

#### Site Color Themes

Optionally, the site can use a colour theme (stored in WP options as `site_theme`). The theme key is matched against the `siteColorThemes()` array in each Colors sub-class to filter which colors are offered to editors.

---

## 16. Required WordPress Plugins

| Plugin | Purpose | Required? |
|---|---|---|
| **ACF Pro** | Block and field group definitions | Yes |
| **Gravity Forms** | Form handling in the Form block | Yes |
| **WPML** | Multilingual content, language switching | Yes |
| **Relevanssi** | Enhanced search indexing | Yes |
| **ThriveLeads** | Email capture / lead generation embeds | Yes |
| **ConvertPro** | Conversion popup integration | Yes |
| **Roots Soil** | WP cleanup utilities (`clean-up`, `nav-walker`, `nice-search`, `relative-urls`) | Optional but recommended |

---

## 17. Git & Team Conventions

- **Never push to `main`** without explicit team confirmation — always use feature branches and PRs
- Default branch is `staging`; all development work branches off `staging`
- PHP code style: **PSR-12** — run `composer run lint` before committing PHP changes
- Asset compilation is **not committed** — `public/` is git-ignored; CI/CD or the server handles builds
- When creating a new block, always create all four artefacts together:
  1. `app/Blocks/MyBlock.php`
  2. `resources/views/blocks/my-block.blade.php`
  3. `resources/images/previews/my-block.jpg` (block editor preview image)
  4. Any new `resources/scripts/blocks/myBlock.js` or Vue component if needed

---

## 18. Adding New Content Types — Checklists

### New ACF Block

1. Create `app/Blocks/MyBlock.php` extending `Block`; set `$category = 'acumen'`
2. Use `FieldsBuilder` in `fields()`; always begin with `AcfUtils::blockTitle()`
3. Return data in `with()` including a `$colors` instance if block has color options
4. Create `resources/views/blocks/my-block.blade.php` with `@if ($block->preview)` guard
5. Add a preview image to `resources/images/previews/my-block.jpg`
6. Add any Alpine.js logic in `resources/scripts/blocks/myBlock.js` and register in `app.js`

### New Custom Post Type

1. Create `app/PostTypes/MyPostType.php`
2. Add to `$postTypes` array in `app/Providers/CustomPostTypeProvider.php`
3. Create `app/Fields/MyPostTypeInfo.php` for ACF fields
4. Create `app/Models/MyPostType.php` for data serialization
5. Create `app/Repositories/MyPostTypeRepository.php` extending `BaseRepository`
6. Add `app/Options/MyPostTypeSettings.php` if an admin settings page is needed

### New Taxonomy

1. Create `app/Taxonomies/MyTaxonomy.php`
2. Add to `TaxonomyProvider`
3. Add SVG icon to `resources/images/tax-icons/` if needed for the UI

### New REST Endpoint

1. Create `app/Endpoints/MyEndpoint.php`; call `register_rest_route('sage-api/v2', '/my-endpoint/', ...)`
2. Add to `EndpointProvider`
3. Create a corresponding Vue composable in `resources/scripts/vue/composables/` if a new Vue island consumes it
