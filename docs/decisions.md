# Decisions — bd-brighter-elements

Append-only. Newest at the bottom. Reconstructed entries are marked (from git history).

## 2026-08 (from git history) — Form elements and CPT submission action untracked
Form elements, macros, presets and the CPT Form Submission action were not used on any site.
Untracked (39550f2), kept locally via `.gitignore`. The option `brighter_cpt_submission_configs` is left in
the database as a harmless orphan. Sites audited before enabling deploy confirmed 0 uses.

## 2026-08 (from git history) — Client-specific elements kept out of the plugin
`Gallery`, `Hero_Image_Gallery`, `Scrolling_Marquess_` untracked (fcc8100). The plugin ships generic elements only.

## 2026-08 (from git history) — Public repo, placeholders only
Real infrastructure identifiers removed from scripts (26a99f7). Nothing identifying goes in tracked files.

## 2026-09-30 / 2026-10-08 (servers project) — deploy-wp is the only deploy path
BDE became the `bd-brighter-elements` deploy-wp component. Sites are enabled one by one after an audit.
`deploy-bde` (host4) is unscoped with no dry run and is not to be used. See `servers/deploy/README.md`.

## 2026-10-17 — CLAUDE.md + docs/ added
CLAUDE.md is the Claude-side rule source for this repo; `docs/` holds TODO, decisions, work-log.
Live status is on the board card, not in the repo.

## 2026-10-17 — Release versioning is mandatory and CI-enforced (1.1.0)
Problem: every site reported `Version: 1.0` while running different code. Now `plugin.php` `Version:` +
`BDE_VERSION` is the single release number (semver), bumped with a CHANGELOG entry on every PR into master that
touches shipped code, enforced by `.github/workflows/version-check.yml`. Per-file `// vX.Y` headers stay as change
markers only. Versioning ships as 1.1.0 and the FAQ work as 1.2.0, separately.

## 2026-10-17 — Scos_Faqs gets a pluggable "Query provider" mode (1.2.0)
Need: FAQs on product single + term archive templates, picked per term (product_cat, pa_*), with schema.
- A filter-based provider registry (`bde_scos_faq_providers`), so any plugin or snippet can supply a query.
  Plus one built-in generic provider that reads a term relationship field across ordered taxonomies.
- Term matching = **union, most specific taxonomy first**, deduped, capped. Intersection was rejected
  (usually empty); "most specific only" was rejected (it drops the category FAQs).
- **Rejected:** registering product_cat / pa_* on the FAQ post type. It pollutes Woo term counts and
  layered-nav "hide empty".
- **Schema: render-time collection, FAQPage printed as a separate JSON-LD block in the footer.** Reason: the head
  graph only walks the queried post's own `_breakdance_data`, so templates and archives get nothing. Re-resolving
  Breakdance templates in `wp_head` was rejected as fragile and dependent on Breakdance internals. This accepts a
  second JSON-LD block (valid for Google), which is an exception to SCOS's "one graph" rule for this case.
