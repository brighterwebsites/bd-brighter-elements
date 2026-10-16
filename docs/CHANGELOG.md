# Changelog — Brighter BD Elements

The release number is the `Version:` header in `plugin.php` (mirrored in `BDE_VERSION`). Semver:
- **patch** (1.1.x): fixes, CSS tweaks, no new controls
- **minor** (1.x.0): new element, new control or mode, new hook
- **major** (x.0.0): removed or renamed element/class/property path (breaks saved Breakdance data or SCOS schema)

Every PR into master that touches `plugin.php`, `elements/` or `includes/` bumps the version and adds an entry
here under a `## <version> — <date>` heading. CI (`.github/workflows/version-check.yml`) enforces both.

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
