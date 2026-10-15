# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Espoir Vie ASBL is a Laravel 12 (PHP 8.2+) web application for a Belgian/Congolese nonprofit association (ASBL). It serves a public marketing/donation site plus a Filament v4 admin panel for managing donors, donations, activities, expenses, and donor reports. Mobile Money / card payments are handled via a custom FlexPay integration.

## Commands

- Install PHP deps: `composer install`
- Install JS deps: `npm install`
- Full local setup (env, key, migrate, npm build): `composer run setup`
- Dev server (serves PHP, queue listener, Pail logs, Vite, concurrently): `composer run dev`
- Build frontend assets: `npm run build`
- Frontend dev (Vite only): `npm run dev`
- Run tests: `composer run test` (clears config cache, then `php artisan test`, PHPUnit-based)
- Lint/format PHP: `vendor/bin/pint` (Laravel Pint is installed but not wired into a composer script)

No JS linter is configured. No Filament resource generation script beyond standard `php artisan make:filament-resource`.

## Architecture

### Stack
- Backend: Laravel 12, Filament 4 (admin panel, package `filament/filament`), `devonab/filament-easy-footer` plugin for admin footer branding.
- Frontend (public site): Blade templates + Alpine.js + Tailwind CSS 3 (via `@tailwindcss/forms`), Vite + `laravel-vite-plugin`, Axios. No Vue/React/Inertia — server-rendered Blade only.
- Auth scaffolding: Laravel Breeze (dev dependency) provides the `users` auth flow; a second, separate `admin` guard/provider exists for the Filament panel.
- Queue: database driver by default; `php artisan queue:listen` runs alongside the dev server.

### Auth
Two independent guards defined in `config/auth.php`:
- `web` guard → `users` provider → `App\Models\User` (public donor accounts, password resets via `password_reset_tokens`).
- `admin` guard → `admins` provider → `App\Models\Admin` (Filament panel accounts, password resets via `admin_password_reset_tokens`).

The Filament panel (`app/Providers/Filament/AdminPanelProvider.php`) is mounted at `/admin`, uses `authGuard('admin')`/`authPasswordBroker('admins')`, auto-discovers Resources/Pages/Widgets under `app/Filament/`, and is branded with the site's primary color (`#0172b8`) and a custom Easy Footer.

### Routing & Controllers
`routes/web.php` is organized as:
- Public marketing routes (home, about, team, events, articles/blog, contact, legal pages) served by `HomeController`.
- Donation flow: `/faire-un-don` (donation form + processing), `/faire-un-don-spontane` (spontaneous/one-off donation), `/devenir-donateur` (donor registration) — all in `HomeController`.
- FlexPay payment endpoints: `POST /flexpay/callback` (webhook, CSRF-exempt) → `FlexPayCallbackController`; `GET /api/donation-status/{orderNumber}` for JS polling; `GET /paid/{reference}/{amount}/{currency}/{status}` for card payment return redirects.
- Authenticated donor space (`auth` middleware): `/mon-profil`, `/mes-dons`, `/mes-activites` served by `DonorDashboardController`.
- Newsletter subscribe/unsubscribe and a simple `/api/search` global search endpoint.
- `routes/auth.php` holds Breeze's standard auth routes (login/register/password reset/verify).

### Services
- `App\Services\FlexPayService` — wraps the FlexPay REST API (`config/flexpay.php`): `payment()` initiates mobile money (type 1) or card (type 2) transactions, plus a check-transaction-status call. Config supports both `FLEXPAY_*` env var naming variants for merchant/token/gateway URLs.
- `App\Services\MailService` — centralizes outgoing transactional email (see `app/Mail/`: donation confirmation, donor welcome, contact message received, newsletter/partner subscription emails).
- Reference integration docs live in `docs/integration-paiement-flexpay/` (French): configuration, backend service code, frontend form/JS, routes, migrations, and a donation-specific adaptation guide — treat as the source of truth for how FlexPay is wired into the donation flow.

### Data Model (see `DATABASE_STRUCTURE.md` for full detail, in French)

Core nonprofit/donation domain:
- **donors** — donor records (personal info, communication preferences, total given, last donation).
- **donations** — every donation (one_time or recurring), amount/currency, payment status (pending/completed/failed/refunded), tax receipt tracking; links to `donors` and optionally `recurring_donations` and `activities`.
- **recurring_donations** — recurring donation subscriptions (frequency: monthly/quarterly/biannual/annual; status: active/paused/cancelled/expired/failed; tracks next charge date and stats).
- **donation_reminders** — scheduled email reminders for recurring donors (upcoming/overdue/payment_failed/renewal), with open/click tracking.
- **activities** — the ASBL's projects/events/campaigns (dates, location, budget vs. collected/spent, status, beneficiaries/impact metrics).
- **expenses** — spending for financial transparency, categorized (program/administrative/fundraising), with an approval workflow (`approved_by` → `admins`), optionally linked to an `activity`.
- **reports** — donor-facing transparency reports (quarterly/biannual/annual/custom), HTML/JSON content, PDF/image attachments, aggregated stats.
- **donor_reports** — join table tracking which report was sent to which donor and engagement (opened/clicked/viewed), unique on (`donor_id`, `report_id`).
- **admins** — Filament panel users (separate from public `users`), extended with team fields.

Additional entities beyond the core doc (found in migrations/models): `articles` (blog), `testimonials`, `contact_messages`, `newsletter_subscriptions`, and donor-related fields added directly to `users` (donation description/currency, phone, photo) to support the authenticated donor dashboard.

Conventions: most domain tables use `softDeletes()`, JSON columns for flexible metadata, consistent `status` enums for workflow state, and `decimal(15,2)` for monetary amounts.

### Frontend structure
`resources/views/` — Blade views grouped into `auth`, `components`, `donor` (donor dashboard), `emails`, `layouts`, `pages`, `parties` (partials), plus `welcome.blade.php`. Styling via Tailwind (`resources/css/app.css`, `tailwind.config.js`) and interactivity via Alpine.js (`resources/js/app.js`), bundled by Vite.
