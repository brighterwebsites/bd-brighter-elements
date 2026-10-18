# Changelog — Brighter BD Elements

The release number is the `Version:` header in `plugin.php` (mirrored in `BDE_VERSION`). Semver:
- **patch** (1.1.x): fixes, CSS tweaks, no new controls
- **minor** (1.x.0): new element, new control or mode, new hook
- **major** (x.0.0): removed or renamed element/class/property path (breaks saved Breakdance data or SCOS schema)

Every PR into master that touches `plugin.php`, `elements/` or `includes/` bumps the version and adds an entry
here under a `## <version> — <date>` heading. CI (`.github/workflows/version-check.yml`) enforces both.

## 1.2.0 — 2026-10-17
- Scos_Faqs: new **Query Provider** source mode. Controls: Provider (dropdown), Provider args (query string), Max FAQs.
  Providers come from `BrighterElements\Faq_Providers` and the `bde_scos_faq_providers` filter. Final IDs pass
  through `bde_scos_faq_provider_ids`.
- Built-in provider `bde_related_terms`: FAQs from a term field (e.g. ACF relationship `related_faqs`) across
  ordered taxonomies. Union, most specific first, deduped, published only, capped. Optional `parents=1`.
  Context = loop post, otherwise the queried post or term.
- Scos_Faqs: **Hide if no FAQs** toggle (all modes). The front end renders nothing; the builder keeps a placeholder.
- Scos_Faqs: fires `do_action( 'scos_faq_ids_rendered', $ids, $context )` after a front-end render with schema on.
  FAQ schema for templates and archives needs the matching SCOS listener; without it the FAQs still display.

## 1.1.0 — 2026-10-17
- Versioning made consistent: single release number in `plugin.php` + `BDE_VERSION` constant, this changelog,
  and a CI check. The old `// v0.3.4` comment in `plugin.php` is gone.
- Sites deployed before this release all report `Version: 1.0` despite running different code. Use
  `deploy-wp --status bd-brighter-elements` for the deployed commit per site.
- Docs: CLAUDE.md, README, docs/ (TODO, decisions, work-log, changelog).
- Includes 029a99e (2026-10-04, previously tagged `// v0.3.5` only): `Definition`, `Definitions_Box`,
  `Description_Text`, `Extended_Wrapper`, `Section_Simple` and `Summary` hidden from the builder Add panel
  (`addPanelRules` → `alwaysHide`). They are still registered, so existing pages keep rendering.

## 1.0 — before 2026-10-17
Unversioned history. Everything up to master c406244 (2026-08-25). See git log.
