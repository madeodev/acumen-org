# Frontend static testing

How to add static Blade files to preview new blocks and other front-end updates in this Sage theme, and how to view them in the browser.

## Important

This project has **no built-in static file URL**. Blade templates under `resources/views/` are only rendered when something **includes** them (layout, page template, or a temporary `@include`). They are **not** opened like `/partials/foo.blade.php`.

---

## Theme layout (relevant paths)

| Path | Role |
|------|------|
| `resources/views/layouts/app.blade.php` | Site shell (header/footer) |
| `resources/views/sections/header.blade.php` | Includes `nav-desktop` / `nav-mobile` |
| `resources/views/partials/*` | Partials — only shown if included |
| `resources/views/blocks/*` | ACF block templates |
| `app/Blocks/*.php` | Block registration, fields, and `with()` data |
| `npm run dev` / `npm run build` | Compiles CSS/JS into `public/` |

---

## Pattern: `*-static` partials

Example used for the Knowledge Hub megamenu:

- `resources/views/partials/subnav-desktop-static.blade.php`
- `resources/views/partials/subnav-mobile-static.blade.php`

These are **not** public URLs. They appear when temporarily included from a live template, for example:

```blade
@include('partials.subnav-desktop-static')
```

inside `resources/views/partials/nav-desktop.blade.php` (as a temporary hardcoded stub).

### How to access that kind of static file

1. Create the mock: `resources/views/partials/your-feature-static.blade.php`.
2. Temporarily `@include` it from a template that already loads on the site (header/nav) or from a single test page template.
3. If CSS/JS changed, run: `npm run dev` (or `npm run build`).
4. Open **any front-end page** on local/staging, e.g. `https://your-site.example/` — the header/nav loads on every page.

There is no special path like `/static/...`. **Access = visit a normal WordPress page that includes the partial.**

---

## Testing a new block (recommended)

Static Blade alone is usually the wrong tool for blocks, because blocks need ACF fields and the block wrapper.

### Preferred flow

1. Add the block class: `app/Blocks/YourBlock.php`.
2. Add the view: `resources/views/blocks/your-block.blade.php`.
3. (Optional) Hardcode sample markup first, or use `$block->preview` with `<x-preview :block="$block" />` and an image under `resources/images/previews/`.
4. In WP admin: edit a **draft page** → Insert block (category **Acumen**) → fill fields → **Preview**.
5. Front-end URL: that page’s permalink (for drafts, use the Preview link).

### Optional static block markup while designing

1. Create `resources/views/blocks/your-block-static.blade.php` with hardcoded HTML.
2. Temporarily in the real block blade:

```blade
@include('blocks.your-block-static')
```

3. Or include it from a temporary page template / override on one draft page only.
4. Open that draft page’s front-end preview URL.

---

## Testing other front-end updates (CSS / JS / partials)

| What you’re changing | How to see it |
|----------------------|----------------|
| Header / nav / footer | Temporary `@include` of `*-static` → visit any site URL |
| Global CSS/JS | `npm run dev` → refresh any page |
| Single block | Draft WP page with that block → Preview |
| Component (`x-card`, etc.) | Use it inside a static partial or a draft page block |

---

## Practical recipe (same as Knowledge Hub nav)

```text
1. Create:  resources/views/partials/my-new-thing-static.blade.php
2. Wire:    @include('partials.my-new-thing-static')   // e.g. in header or nav
3. Assets:  npm run dev
4. Open:    https://<your-wp-site>/   (or any page that loads that layout)
5. When done: remove the temporary include; keep or delete the *-static file
```

---

## Guidelines

- Static Blade files are **not** browsable by filename.
- They only appear after an `@include` (or a view that renders them).
- On production, use the real dynamic partials / blocks; keep `*-static` for design reference if useful, but do not leave temporary includes on live nav.
