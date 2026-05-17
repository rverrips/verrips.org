# verrips.org — Claude Code Context

## Project Overview

Personal family website for Roy Verrips (IT Director, Auro Hotels). A static-content Laravel site with no database — all family data lives in `config/family.php`.

## Stack

- **Laravel 13** · PHP 8.4 · Composer 2
- **Laravel Folio** — file-based routing (`resources/views/pages/` maps to URLs)
- **Livewire v4** + **Alpine.js** (bundled with Livewire)
- **FluxUI Pro v2** (`livewire/flux` + `livewire/flux-pro`)
- **Tailwind CSS v4** — using `@import 'tailwindcss'` + `@theme {}` in `app.css`
- **Vite 8** with Rolldown bundler (strict ESM — no CommonJS)
- **Laravel Herd** — local dev at `http://verrips.org.test`

## Key Files

| File | Purpose |
|------|---------|
| `config/family.php` | Single source of truth — all photos and family member data |
| `resources/views/pages/index.blade.php` | Home page (Folio) — gallery, about, family cards, belief |
| `resources/views/components/layouts/app.blade.php` | Main layout — nav, footer, Vite/Livewire/Flux scripts |
| `resources/views/components/family-card.blade.php` | Reusable family member card component |
| `resources/css/app.css` | Tailwind v4 theme + custom mosaic grid CSS |
| `resources/js/app.js` | ESM entry: `import './bootstrap'` |
| `routes/web.php` | Redirect shortcuts (`/roy` → `/#roy` etc.) |
| `auth.json` | FluxUI Pro credentials — **gitignored, do not commit** |

## Build Commands

```bash
# Frontend
NODE_TLS_REJECT_UNAUTHORIZED=0 npm run build   # production build (SSL bypass needed)
NODE_TLS_REJECT_UNAUTHORIZED=0 npm run dev     # dev server

# Laravel
php artisan view:clear       # clear Blade cache (required after template changes)
php artisan cache:clear
php artisan optimize:clear   # clears everything
```

> **SSL note:** Microsoft Global Secure Access performs TLS inspection. Always use `NODE_TLS_REJECT_UNAUTHORIZED=0` for npm. Composer uses a system CA bundle exported to `/tmp/system-ca.pem`.

## Active Branch

`redesign/tailwind-livewire` — full redesign in progress, not yet merged to `main`.

## Design System — "Garden Warmth"

**Fonts:** Merriweather (serif/headings) · Inter (sans/body) — loaded from Google Fonts

**Palette (defined in `@theme {}` in `app.css`):**

| Token | Hex | Use |
|-------|-----|-----|
| `cream` | `#fdfaf5` | Page background |
| `bark` | `#2d2a24` | Primary text, footer bg |
| `bark-light` | `#4a3f33` | Body text |
| `sage` | `#6a7c59` | Accents, nav hover |
| `sage-light` | `#eef4e8` | Section backgrounds |
| `linen` | `#e8dfc9` | Borders |
| `muted` | `#9a8c78` | Secondary text |

## Photo Mosaic Grid

Defined in `app.css`. Uses explicit `grid-template-rows` to keep differently-sized spans proportional:

```css
.mosaic        { grid-template-columns: repeat(4, 1fr);
                 grid-template-rows: 190px 190px 250px 250px 250px 190px 190px 190px 190px;
                 grid-auto-rows: 250px; gap: 6px; }
.mosaic-wide   { grid-column: span 2; }            /* 2 cols × 1 row = 250px tall */
.mosaic-xwide  { grid-column: span 3; }            /* 3 cols × 1 row */
.mosaic-tall   { grid-row: span 2; }
.mosaic-big    { grid-column: span 2; grid-row: span 2; }   /* 380px tall (rows 1-2 or 6-9) */
.mosaic-xbig   { grid-column: span 2; grid-row: span 2; }   /* semantic alias for big */
```

> If you add more `big`/`xbig` photos beyond row 9, extend `grid-template-rows` with additional `190px` pairs.

## config/family.php — Data Schema

### Photos

```php
[
  'src'      => 'docs/images/verrips-2025.png',
  'alt'      => 'Full description — Location Year',
  'people'   => 'Names shown in hover caption',
  'location' => 'City, Country',
  'year'     => '2025',
  'span'     => 'big',       // '', 'wide', 'xwide', 'tall', 'big', 'xbig'
  'focus'    => 'center',    // CSS object-position value: 'top', 'center 20%', '50% 30%', etc.
]
```

### Members

```php
[
  'id'            => 'roy',
  'name'          => 'Roy',
  'photo'         => 'docs/images/Roy-2021-Smile-300x300.png',
  'focus'         => 'center',     // CSS object-position for headshot crop
  'role'          => 'IT Director',
  'bio'           => 'HTML allowed via {!! !!}',
  'links'         => [
      ['label' => 'LinkedIn', 'url' => 'https://...'],
  ],
  // Memorial members only:
  'memorial'      => true,
  'memorial_year' => '2004',
]
```

## Lightbox

Gallery photos open a full-image modal on click. Implemented with Alpine.js `x-data` on the `<section>` in `index.blade.php`. Close via X button, backdrop click, or Escape.

**Important:** Photo data is passed via `data-photo` attribute using `{!! e(json_encode([...])) !!}` — must use `{!! !!}` (not `{{ }}`) to avoid double HTML-encoding that breaks `JSON.parse`.

## FluxUI

- Free tier: `livewire/flux` from Packagist
- Pro tier: `livewire/flux-pro` from `https://composer.fluxui.dev`
- Credentials in `auth.json` (gitignored): username `roy@verrips.org`
- Layout uses `@fluxAppearance` and `@fluxScripts` — **not** `@fluxStyles` (that directive does not exist)

## Common Gotchas

- After editing any Blade template, run `php artisan view:clear` or changes may not appear
- After editing `app.css` or JS, run `npm run build` (with SSL bypass)
- `@fluxStyles` is not a real directive — use `@fluxAppearance` in the `<head>`
- `grid-auto-rows` alone can't give different heights to `big` vs `wide` cells — use explicit `grid-template-rows`
- `focus` values in `config/family.php` are raw CSS `object-position` values (`center`, `top`, `center 20%`), not Tailwind class names
