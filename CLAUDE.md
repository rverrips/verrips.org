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

===

<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

## Foundational Context

This application is a Laravel application running on PHP 8.4. Always use the APIs that match the installed major version of each package — do not assume a version.

Before relying on a package's API, confirm its installed version:
- PHP packages: run `composer show --direct` to list direct dependencies with versions, or `composer show <vendor/package>` for a single package.
- JS packages: check `package.json` for the installed versions.

## Skills Activation

This project has domain-specific skills available in `**/skills/**`. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If a frontend change doesn't show in the UI or you get a "Unable to locate file in Vite manifest" error, run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

=== boost rules ===

# Laravel Boost

## Tools

- Laravel Boost is an MCP server with tools designed specifically for this application. Prefer Boost tools over manual alternatives like shell commands or file reads.
- Use `database-query` to run read-only queries against the database instead of writing raw SQL in tinker.
- Use `database-schema` to inspect table structure before writing migrations or models.
- Use `get-absolute-url` to resolve the correct scheme, domain, and port for project URLs. Always use this before sharing a URL with the user.
- Use `browser-logs` to read browser logs, errors, and exceptions. Only recent logs are useful, ignore old entries.

## Searching Documentation (IMPORTANT)

- Use `search-docs` before changes that depend on Laravel ecosystem APIs, behavior, configuration, or version-specific syntax. Skip it for copy-only edits and other changes where package documentation is irrelevant. Reuse sufficient results already in context instead of searching again.
- Pass a `packages` array to scope results when you know which packages are relevant.
- Use multiple broad, topic-based queries: `['rate limiting', 'routing rate limiting', 'routing']`. Expect the most relevant results first.
- Do not add package names to queries because package info is already shared. Use `test resource table`, not `filament 4 test resource table`.

### Search Syntax

1. Use words for auto-stemmed AND logic: `rate limit` matches both "rate" AND "limit".
2. Use `"quoted phrases"` for exact position matching: `"infinite scroll"` requires adjacent words in order.
3. Combine words and phrases for mixed queries: `middleware "rate limit"`.
4. Use multiple queries for OR logic: `queries=["authentication", "middleware"]`.

## Project Rules

- This project contains committed, area-grouped rules in `.ai/rules` when that directory exists, including path-scoped framework guidelines under `.ai/rules/boost`. Before you enter plan mode or create/edit any file, you MUST first: open @.ai/rules/index.md (it maps file globs to rule files), read every rule file whose globs cover the path(s) in scope, and run `grep -rin 'keyword' .ai/rules` to catch what a path match alone misses. Do not write code until you have read and are following every matching rule. If `.ai/rules` does not exist, continue without it.

## Artisan

- Run Artisan commands directly via the command line (e.g., `php artisan route:list`). Use `php artisan list` to discover available commands and `php artisan [command] --help` to check parameters.
- Inspect routes with `php artisan route:list`. Filter with: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Read configuration values using dot notation: `php artisan config:show app.name`, `php artisan config:show database.default`. Or read config files directly from the `config/` directory.

## Tinker

- Execute PHP in app context for debugging and testing code. Do not create models without user approval, prefer tests with factories instead. Prefer existing Artisan commands over custom tinker code.
- Always use single quotes to prevent shell expansion: `php artisan tinker --execute 'Your::code();'`
  - Double quotes for PHP strings inside: `php artisan tinker --execute 'User::where("active", true)->count();'`

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.
- Use PHP 8 constructor property promotion: `public function __construct(public GitHub $github) { }`. Do not leave empty zero-parameter `__construct()` methods unless the constructor is private.
- Use explicit return type declarations and type hints for all method parameters: `function isAccessible(User $user, ?string $path = null): bool`
- Use TitleCase for Enum keys: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefer PHPDoc blocks over inline comments. Only add inline comments for exceptionally complex logic.
- Use array shape type definitions in PHPDoc blocks.

=== deployments rules ===

# Deployment

- Laravel can be deployed using [Laravel Cloud](https://cloud.laravel.com/), which is the fastest way to deploy and scale production Laravel applications.
- Activate the `deploying-to-cloud` skill whenever deploying to Laravel Cloud, configuring Cloud environments or resources, using the Cloud CLI, or troubleshooting Cloud deployments.

=== herd rules ===

# Laravel Herd

- The application is served by Laravel Herd at `https?://[kebab-case-project-dir].test`. Use the `get-absolute-url` tool to generate valid URLs. Never run commands to serve the site. It is always available.
- Use the `herd` CLI to manage services, PHP versions, and sites (e.g. `herd sites`, `herd services:start <service>`, `herd php:list`). Run `herd list` to discover all available commands.

=== folio/core rules ===

# Laravel Folio

- Laravel Folio is a powerful page-based router that simplifies routing in Laravel applications.
- Routes are generated automatically by creating Blade templates in `resources/views/pages`.
- IMPORTANT: Activate 'folio-routing' when working with Folio, pages, routes, route parameters, model binding, middleware, or `resources/views/pages`.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using `php artisan list` and check their parameters with `php artisan [command] --help`.
- If you're creating a generic PHP class, use `php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `php artisan make:model --help` to check the available options.

## APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

=== livewire/core rules ===

# Livewire

- Livewire allows you to build dynamic, reactive interfaces in PHP without writing JavaScript.
- You can use Alpine.js for client-side interactions instead of JavaScript frameworks.
- Keep state server-side so the UI reflects it. Validate and authorize in actions as you would in HTTP requests.

=== pint/core rules ===

# Laravel Pint Code Formatter

- If you have modified any PHP files, you must run `vendor/bin/pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test --format agent`, simply run `vendor/bin/pint --format agent` to fix any formatting issues.

=== pest/core rules ===

# Pest

- This project uses Pest. Create tests with `php artisan make:test --pest {name}`.
- Do not include the test suite directory in `{name}`. Use `SomeFeatureTest`, not `Feature/SomeFeatureTest`.
- Read the `testing-best-practices` skill for guidance on coverage, naming, structure, dependency isolation, and review.
- Do not delete tests or test files without approval. They are part of the application.

## Running Tests

- Run the narrowest set of tests that covers the change. Pass a file path or `--filter=testName` to `php artisan test --compact`.
- Rerun a test after each change to it.
- Run `vendor/bin/pest` to call the test runner directly. It accepts the same file path and `--filter=testName` arguments.
- After the feature tests pass, ask the user to run the complete suite with `php artisan test --compact`.

</laravel-boost-guidelines>
