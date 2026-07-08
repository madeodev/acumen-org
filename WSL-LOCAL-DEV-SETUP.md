# WSL Local Development Setup Guide

This document records the issues encountered while setting up **acumen-org** (Sage / Bud.js theme) on **WSL2**, what was done to fix them, and how to run **dev** and **build** reliably going forward.

---

## Table of contents

1. [Environment overview](#environment-overview)
2. [Issues we hit and how they were fixed](#issues-we-hit-and-how-they-were-fixed)
3. [First-time setup (step by step)](#first-time-setup-step-by-step)
4. [Project configuration you need](#project-configuration-you-need)
5. [Running the dev server](#running-the-dev-server)
6. [Running a production build](#running-a-production-build)
7. [Recommended project tweaks (optional)](#recommended-project-tweaks-optional)
8. [Troubleshooting](#troubleshooting)
9. [Quick reference](#quick-reference)

---

## Environment overview

| Item | Value |
|------|-------|
| OS | WSL2 (Linux on Windows) |
| Project path | `/mnt/c/My Files/Work/Madeo/Github/acumen-org` |
| Theme stack | [Sage 10](https://roots.io/sage/) + [@roots/bud](https://bud.js.org/) |
| Node (installed) | v20.20.2 via nvm v0.40.3 |
| npm (installed) | v10.8.2 |
| Package manager scripts | `dev` → `bud dev`, `build` → `bud build` |

This theme compiles assets into `public/` and expects a local WordPress install for the dev proxy. The dev server URL and proxy target are configured in `bud.config.js` using the `WP_HOME` environment variable.

---

## Issues we hit and how they were fixed

### 1. nvm was not installed

**Symptoms**

```text
Command 'nvm' not found
```

**Cause**

The nvm install script was never run successfully. These commands were tried:

```bash
curl -o- https://githubusercontent.com | bash
wget -qO- https://githubusercontent.com | bash
```

Both failed because:

- `https://githubusercontent.com` is **not** the nvm installer URL (incomplete/wrong host).
- At one point DNS also failed: `Could not resolve host: githubusercontent.com`.

Sourcing nvm manually had no effect because `~/.nvm` did not exist yet:

```bash
export NVM_DIR="$HOME/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && . "$NVM_DIR/nvm.sh"
```

**Fix**

Install nvm from the official script:

```bash
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.3/install.sh | bash
source ~/.bashrc
nvm install 20
nvm use 20
node -v   # v20.20.2
npm -v    # 10.8.2
```

The installer adds nvm to `~/.bashrc`, so new terminals load it automatically.

**Note:** During install you may see:

```text
/mnt/c/nvm4w/nodejs/npm: exec: node: not found
```

That refers to **Windows nvm4w** on `/mnt/c/`. It is separate from WSL nvm in `~/.nvm`. As long as `node -v` works inside WSL after `source ~/.bashrc`, you can ignore it.

---

### 2. `npm install` failed with EPERM (chmod)

**Symptoms**

```text
npm error code EPERM
npm error syscall chmod
npm error path .../node_modules/@babel/parser/bin/babel-parser.js
npm error Error: EPERM: operation not permitted, chmod '...'
```

**Cause**

The repo lives on the **Windows filesystem** (`/mnt/c/...`). WSL cannot apply Unix file permissions (chmod) on NTFS the same way as on a native Linux disk. npm tries to chmod binaries when creating `node_modules/.bin` symlinks.

**Fix**

Install with bin links disabled:

```bash
npm install --no-bin-links
```

This completed successfully (1280 packages). To avoid passing the flag every time, add a project `.npmrc` (see [Recommended project tweaks](#recommended-project-tweaks-optional)).

---

### 3. `npm run dev` failed — `bud: not found`

**Symptoms**

```text
> dev
> bud dev

sh: 1: bud: not found
```

**Cause**

With `--no-bin-links`, npm does not create executable symlinks in `node_modules/.bin/`, so the `bud` CLI is not on PATH when npm runs the `dev` script.

**Wrong workaround (do not use)**

```bash
npx bud dev
```

`npx` may install an unrelated npm package named `bud` (v4.x), **not** `@roots/bud`. That is the wrong tool for this project.

**Fix**

Call the local Bud binary directly:

```bash
node node_modules/@roots/bud/bin/bud.mjs dev
```

---

### 4. Dev server failed — port was `NaN`

**Symptoms**

```text
BudError

✘ options.port should be >= 0 and < 65536. Received type number (NaN).
```

**Cause**

`bud.config.js` configures the dev server from `WP_HOME`:

```js
app
  .setUrl(`${process.env['WP_HOME']}:3000`)
  .setProxyUrl(process.env['WP_HOME'])
```

There was **no `.env` file** and `WP_HOME` was unset. The URL became `"undefined:3000"`, which Bud could not parse → invalid port (`NaN`).

**Fix**

Set `WP_HOME` to your local WordPress URL before starting dev (see below). Example:

```bash
export WP_HOME=http://acumen.test
node node_modules/@roots/bud/bin/bud.mjs dev
```

For the session we used `http://localhost` as a placeholder so the compiler could start. **Replace this with your real local WP URL** for the proxy and hot reload to work correctly.

---

### 5. Dev server started successfully

After setting `WP_HOME` and using the local Bud binary, the dev server compiled all entrypoints and reported:

```text
› Proxy  ┄ http://localhost/
› Dev    ┄ http://localhost:3000/
```

Entrypoints built include: `app`, `editor`, `peopleGrid`, `companyGrid`, `postGridFilter`, `interactiveMap`, `foundryGrid`, `knowledgeHubHeroPostsSlider`.

---

## First-time setup (step by step)

Run these in **WSL**, from any directory unless noted.

### Step 1 — Install nvm and Node 20

```bash
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.3/install.sh | bash
source ~/.bashrc
nvm install 20
nvm use 20
```

Verify:

```bash
node -v   # expect v20.x
npm -v
```

### Step 2 — Clone / open the project

```bash
cd "/mnt/c/My Files/Work/Madeo/Github/acumen-org"
```

### Step 3 — Install dependencies

```bash
npm install --no-bin-links
```

### Step 4 — Create `.env`

Create a file named `.env` in the theme root (same folder as `package.json`):

```env
# Your local WordPress site URL (no trailing slash)
WP_HOME=http://your-local-wp-url.test

# Optional: skip weekly browserslist update check in WSL if it errors
BUD_BROWSERSLIST_UPDATE=false
```

Examples of valid `WP_HOME` values (use the one that matches **your** setup):

- Local by Flywheel: `http://acumen.local`
- Laravel Valet: `http://acumen.test`
- Custom hosts entry: `http://acumen-org.test`
- Plain local server: `http://localhost:8080`

Bud loads `.env` automatically; you do not need to `export` variables manually if this file exists.

### Step 5 — Ensure WordPress is running

The dev server **proxies** to `WP_HOME`. WordPress must be running at that URL, with this theme active, for full dev workflow (live reload through the site). Asset compilation alone can still run if WP is down, but you will not get the proxied browsing experience.

---

## Project configuration you need

### `bud.config.js` (already in repo)

Relevant dev settings:

| Setting | Source | Purpose |
|---------|--------|---------|
| Dev server URL | `` `${WP_HOME}:3000` `` | Where Bud serves compiled assets |
| Proxy URL | `WP_HOME` | WordPress site Bud proxies to |
| Watch paths | `resources/views`, `app` | File changes that trigger rebuild |
| Public path | `/wp-content/themes/sage/public/` | Where assets are referenced in WP |

### `.env` (you must create)

Minimum required variable for dev:

```env
WP_HOME=http://your-local-wp-url.test
```

Without it, `npm run dev` / `bud dev` will fail with the port `NaN` error described above.

---

## Running the dev server

### Option A — Direct Bud command (recommended on WSL + `/mnt/c/`)

From the theme root:

```bash
source ~/.bashrc
cd "/mnt/c/My Files/Work/Madeo/Github/acumen-org"

# If you don't have .env yet:
export WP_HOME=http://your-local-wp-url.test
export BUD_BROWSERSLIST_UPDATE=false

node node_modules/@roots/bud/bin/bud.mjs dev
```

### Option B — npm script (after optional tweaks below)

```bash
npm run dev
```

This only works reliably on WSL when `node_modules/.bin/bud` is available (see [Optional tweaks](#recommended-project-tweaks-optional)).

### What to expect when dev is running

- **Dev server:** `http://localhost:3000` (or `{WP_HOME}:3000`)
- **Proxy:** your `WP_HOME` URL
- Rebuilds on changes under `resources/` and `app/`
- Compiled output in `public/`

Open the **proxy URL** (`WP_HOME`) in the browser to work on the site with hot module replacement. Use port **3000** only if you are checking the dev server directly.

### Stop the dev server

Press `Ctrl+C` in the terminal where it is running.

---

## Running a production build

Build compiles and minifies assets for deployment (no dev server, no proxy).

### Command

```bash
source ~/.bashrc
cd "/mnt/c/My Files/Work/Madeo/Github/acumen-org"

node node_modules/@roots/bud/bin/bud.mjs build
```

Or, if bin links work on your machine:

```bash
npm run build
```

### Output

- Assets written to `public/` (JS, CSS, images, fonts, etc.)
- `theme.json` regenerated on each build (see `bud.config.js`)

### When to run build

- Before deploying the theme
- To verify production compilation locally
- When you need optimized assets without the dev server

---

## Recommended project tweaks (optional)

These make day-to-day use easier on WSL without repeating flags and long commands.

### 1. Add `.npmrc` (persist `--no-bin-links`)

Create `.npmrc` in the theme root:

```ini
bin-links=false
```

Then a plain `npm install` is enough on `/mnt/c/`.

### 2. Update `package.json` scripts for WSL

Replace the `bud` shorthand with the direct Node path so `npm run dev` and `npm run build` work without bin links:

```json
"scripts": {
  "dev": "node node_modules/@roots/bud/bin/bud.mjs dev",
  "build": "node node_modules/@roots/bud/bin/bud.mjs build"
}
```

### 3. Add `.env.example` for the team

Commit a template (without secrets):

```env
WP_HOME=http://acumen.test
BUD_BROWSERSLIST_UPDATE=false
```

Copy to `.env` and adjust `WP_HOME` per developer machine.

### 4. Best long-term fix: move repo to Linux filesystem

If you hit ongoing WSL + Windows path issues (slow installs, permission errors), clone the project under the Linux home directory instead:

```bash
# Example
~/projects/acumen-org
```

Then a normal `npm install` (without `--no-bin-links`) usually works and `npm run dev` behaves as documented upstream.

---

## Troubleshooting

| Problem | Likely cause | What to do |
|---------|--------------|------------|
| `nvm: command not found` | New shell without nvm loaded | `source ~/.bashrc` or open a new terminal |
| `Could not resolve host` during curl | DNS / network blip | Retry; check internet; try `ping raw.githubusercontent.com` |
| `EPERM` / `chmod` on `npm install` | Project on `/mnt/c/` | Use `npm install --no-bin-links` or add `.npmrc` with `bin-links=false` |
| `bud: not found` | No bin links on WSL | Use `node node_modules/@roots/bud/bin/bud.mjs` instead of `bud` or `npx bud` |
| `npx bud` installs wrong package | Unrelated npm package named `bud` | Never use bare `npx bud`; use `@roots/bud` path above |
| Port `NaN` / BudError on dev | Missing `WP_HOME` | Create `.env` with `WP_HOME=...` or `export WP_HOME=...` |
| Proxy shows wrong site | `WP_HOME` mismatch | Set `WP_HOME` to exact local WP URL (scheme + host + port) |
| Dev works but WP page broken | WP not running or theme not active | Start local WP; activate Sage theme |
| Slow compiles on WSL | Windows mount latency | Consider project on `~/` Linux path |
| Tailwind safelist warning `^cp-/` | Harmless config warning | Does not block dev; fix in Tailwind config if desired |

---

## Quick reference

```bash
# Load Node (each new WSL session)
source ~/.bashrc

# Project directory
cd "/mnt/c/My Files/Work/Madeo/Github/acumen-org"

# Install (WSL on /mnt/c/)
npm install --no-bin-links

# Dev
node node_modules/@roots/bud/bin/bud.mjs dev

# Production build
node node_modules/@roots/bud/bin/bud.mjs build
```

**Required env (dev only):**

```env
WP_HOME=http://your-local-wp-url.test
```

**Versions verified in this setup session:**

- nvm 0.40.3  
- Node 20.20.2  
- npm 10.8.2  
- @roots/bud ^6.17.0 (resolved 6.24.0 in lockfile)

---

## Related files in this repo

| File | Role |
|------|------|
| `package.json` | npm scripts and dependencies |
| `bud.config.js` | Bud/Sage compiler and dev server config |
| `public/` | Compiled assets (generated; do not edit by hand) |
| `.env` | Local env vars (`WP_HOME`) — create this on your machine |

For Sage and Bud documentation:

- [Sage docs](https://roots.io/docs/sage/)
- [Bud.js docs](https://bud.js.org/)
