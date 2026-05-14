# Windows Build Fix — Bud.js 6 on Node.js 18+

> **Applies to:** All team members developing on Windows.  
> **Symptom:** `npm run build` or `npm run dev` fails immediately with `BudError: Only URLs with a scheme in: file, data, and node are supported by the default ESM loader. On Windows, absolute paths must be valid file:// URLs. Received protocol 'c:'`

---

## Root Cause

Bud.js 6.x was written with Unix/macOS in mind. On Windows, several internal functions pass raw Windows paths (e.g. `C:\My Files\...`) directly to Node.js's `import()` or `fileURLToPath()`, both of which require proper `file://` URLs. This affects **every** version of Node.js on Windows (18, 20, 22).

---

## One-Time Fix: Patch `node_modules`

Apply these 5 patches **after every `npm install`** (or set up `patch-package` — see below).

### Patch 1 — `@roots/bud-framework/lib/module/index.js`

**Problem A:** `import()` receives a raw `C:\...` path.

Find this block (around line 130):
```js
const code = await import(this.getResolution(signifier)).catch(async (error) => {
```
Replace with:
```js
const _res = this.getResolution(signifier);
const _resUrl = (_res && !_res.startsWith(`file:`)) ? pathToFileURL(_res).href : _res;
const code = await import(_resUrl).catch(async (error) => {
```

---

**Problem B:** `makeContextURL()` double-encodes an existing `file:` URL string by running it through `pathToFileURL()` again.

Find:
```js
makeContextURL(context) {
    if (context instanceof URL)
        return context;
    if (context)
        return pathToFileURL(context);
    return pathToFileURL(join(this.app.context.basedir, `package.json`));
}
```
Replace with:
```js
makeContextURL(context) {
    if (context instanceof URL)
        return context;
    if (typeof context === `string` && context.startsWith(`file:`))
        return new URL(context);
    if (context)
        return pathToFileURL(context);
    return pathToFileURL(join(this.app.context.basedir, `package.json`));
}
```

---

**Problem C:** `fileURLToPath()` throws when `import-meta-resolve` returns a `node:` scheme URL for built-in modules.

Find:
```js
const attemptResolution = (path, context) => {
    const resolvedPath = resolve(path, context);
    if (!resolvedPath)
        return false;
    return normalize(fileURLToPath(resolvedPath));
};
```
Replace with:
```js
const attemptResolution = (path, context) => {
    const resolvedPath = resolve(path, context);
    if (!resolvedPath)
        return false;
    if (typeof resolvedPath === `string` && !resolvedPath.startsWith(`file:`))
        return resolvedPath;
    return normalize(fileURLToPath(resolvedPath));
};
```

---

### Patch 2 — `@roots/bud-framework/lib/bootstrap/files/index.js`

**Problem:** Config files (`.cjs`, `.js`, `.mjs`) are imported with raw Windows paths.

Add `pathToFileURL` to the imports at the top:
```js
// Add this line after the existing node:path import
import { pathToFileURL } from 'node:url';
```

Find (around line 119):
```js
const path = `${file.path}?v=${current.sha1}`;
const value = await import(path).catch(origin => {
```
Replace with:
```js
const path = `${pathToFileURL(file.path).href}?v=${current.sha1}`;
const value = await import(path).catch(origin => {
```

Find (around line 148):
```js
const value = await import(tmpfile).catch(makeTmpFileImportError(tmpfile));
```
Replace with:
```js
const value = await import(pathToFileURL(tmpfile).href).catch(makeTmpFileImportError(tmpfile));
```

---

### Patch 3 — `@roots/bud-framework/lib/methods/path/index.js`

**Problem:** Path segments like `@src/scripts` are split by `\` (Windows path separator), so the `@src` alias is never resolved — resulting in broken webpack aliases like `@scripts → C:\...\@src\scripts`.

Find:
```js
values = values.flatMap(value => value.split(sep));
```
Replace with:
```js
values = values.flatMap(value => value.split(/[\\/]/));
```

---

### Patch 4 — `@roots/bud-tailwindcss/lib/extension/index.js`

**Problem:** `path.join('tailwindcss', 'nesting', 'index.js')` on Windows produces `tailwindcss\nesting\index.js` (backslashes), which is not a valid module specifier.

Find:
```js
const nesting = await this.resolve(join(`tailwindcss`, `nesting`, `index.js`), import.meta.url);
```
Replace with:
```js
const nesting = await this.resolve(`tailwindcss/nesting/index.js`, import.meta.url);
```

---

## Dev Server: `options.port NaN` Error

`npm run dev` needs a `.env` file at the project root with `WP_HOME` set. Without it, `process.env['WP_HOME']` is `undefined` and the proxy URL can't be parsed.

Create a `.env` file (copy from a teammate or server config):
```env
WP_HOME=http://acumen.test
```

The dev server proxies webpack HMR to your local WordPress install, so `WP_HOME` must match your local site URL exactly.

---

## Making Patches Permanent with `patch-package`

To avoid re-applying all patches after every `npm install`:

```bash
npm install --save-dev patch-package
```

Apply all patches above manually, then run:
```bash
npx patch-package @roots/bud-framework
npx patch-package @roots/bud-tailwindcss
```

This creates patch files in a `patches/` folder. Then add to `package.json` scripts:
```json
"postinstall": "patch-package"
```

Now patches auto-apply whenever anyone runs `npm install`.

---

## Quick Checklist

- [ ] Patch 1 applied to `node_modules/@roots/bud-framework/lib/module/index.js` (3 changes)
- [ ] Patch 2 applied to `node_modules/@roots/bud-framework/lib/bootstrap/files/index.js` (3 changes)
- [ ] Patch 3 applied to `node_modules/@roots/bud-framework/lib/methods/path/index.js` (1 change)
- [ ] Patch 4 applied to `node_modules/@roots/bud-tailwindcss/lib/extension/index.js` (1 change)
- [ ] `.env` file exists with `WP_HOME` set
- [ ] Run `npm run build` to verify — all 8 entry points should compile ✔
