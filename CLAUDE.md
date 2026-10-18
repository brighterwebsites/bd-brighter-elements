# CLAUDE.md — Brighter BD Elements (bd-brighter-elements)

Custom Breakdance elements for Brighter Websites sites. Most of the `Scos_*` elements are front ends for
data owned by the SCOS MU plugin (wp-scos-strategic-content-operating-system, "Site Essentials").

**The repo is PUBLIC.** No hostnames, usernames, IPs, key paths, client data or secrets in tracked files.
Placeholders only (see commit 26a99f7).

## Layout

| Path | What |
|---|---|
| `plugin.php` | Bootstrap. Registers the `site_essentials` element category and the Element Studio save locations (`elements/`, `macros/`, `presets/`) on `breakdance_loaded` priority 9. |
| `elements/<Name>/` | One element per folder, Element Studio format: `element.php` (class, controls), `html.twig`, `css.twig`, `default.css`, optional `ssr.php`. Namespace `BreakdanceCustomElements`. |
| `includes/class-*-picker-options.php` | Namespace `BrighterElements`. Dropdown option providers for element controls (FAQ, review, platform). Logic kept out of `element.php` so REST / WP-CLI / MCP can reuse it. |
| `macros/`, `presets/` | Registered but empty (`.gitkeep`). The form macros/presets were untracked in 39550f2. |
| `scripts/` | **Legacy** deploy scripts. Not the deploy path any more, see Deploy. |
| `docs/` | `CHANGELOG.md` (releases), `TODO.md`, `decisions.md`, `work-log.md`. |
| `.github/workflows/version-check.yml` | CI: version bump + changelog required on PRs that change shipped code. |
| `.cursor/rules/` | Cursor rules (ways of working, dev-notes capture). This file is the Claude source; keep the two consistent. |

## Elements and their SCOS dependencies

SSR elements must degrade quietly: if the SCOS piece is missing, render a placeholder in the builder
(`BrighterElements\Builder_Context::is_builder()`) and nothing on the front end. Never echo during other AJAX
requests (`Builder_Context::is_front_end()` is false there): Breakdance's AJAX handler rejects stray output.
There is **no** `BREAKDANCE_BUILDER` constant. Follow the pattern in `elements/Scos_Faqs/ssr.php`.

| Element | Depends on |
|---|---|
| `Scos_Faqs` | `SiteEssentials\Modules\CustomPosts\FAQ\FAQ_Module` (direct calls) + `Faq_Picker_Options` + `Faq_Providers` (provider mode). Fires `scos_faq_ids_rendered` for SCOS schema. |
| `Scos_Aggregate_Review` | `SiteEssentials\Modules\CustomPosts\Aggregate_Review_Renderer` + `Platform_Picker_Options` |
| `Scos_Review_Card` | `[bw_review_card]` shortcode (Reviews CPT submodule) + `Review_Picker_Options` |
| `Scos_Tldr` | `[tldr]` shortcode |
| `Scos_Breadcrumbs` | `bw_render_breadcrumbs()` |
| `Accordion_Content_Extended`, `Table*`, `Text_Extended` | None (pure Breakdance) |
| `Definition`, `Definitions_Box`, `Description_Text`, `Extended_Wrapper`, `Section_Simple`, `Summary` | None. **Hidden** from the Add panel (`alwaysHide`), kept registered for existing pages. Don't delete until no live site uses them. |

Changing a SCOS class, shortcode or function name breaks these elements. Check this table from the SCOS side too.

**FAQ schema is not generated here.** SCOS `FAQ_Schema_Graph` walks the *queried post's own* `_breakdance_data`
for `ScosFaqs` nodes, so an element in a Breakdance **template**, or on an **archive**, gets no FAQPage from the
head graph. Since 1.2.0, `ssr.php` fires `scos_faq_ids_rendered` with the IDs it rendered. SCOS `FAQ_Schema_Graph` collects them and
prints a separate footer FAQPage (`<script id="scos-faq-graph">`, `@id` = URL + `#faq`). Open SCOS follow-ups in `docs/TODO.md`.

**FAQ query providers** (`includes/class-faq-providers.php`): register with the `bde_scos_faq_providers` filter on
`init` or earlier. A callback is `( array $context, array $args ): int[]`. `resolve()` does validation, dedupe and the limit.

## Gitignored, local-only

`.gitignore` keeps Breakdance built-in element copies (reference), client-specific elements
(`Gallery`, `Hero_Image_Gallery`, `Scrolling_Marquess_`), the form elements/macros/presets and the CPT
submission action out of the repo. Anything not in git **does not deploy**: deploy-wp `rsync --delete`s
the plugin folder, so a site that relied on an untracked element loses it.

## Deploy

One path only: **`/deploy-wp`** skill, component `bd-brighter-elements`, default ref `master`.
Config lives in `servers/deploy/components/bd-brighter-elements.conf` (servers project owns it).

```bash
ssh <alias> 'deploy-wp bd-brighter-elements master --only <domain> --dry-run'
ssh <alias> 'deploy-wp bd-brighter-elements master --only <domain> --yes'
```

- Never `scripts/deploy.*`, never the `deploy-bde` alias (unscoped, no dry run), never zip/scp/rsync.
- Sites are enabled one at a time, **after auditing** the installed copy against master (diff, and check
  postmeta/options for anything master would drop). Enabled + pending lists are in the .conf.
- Branches go to ONE site with `--only` for testing.
- Payload = repo minus `EXCLUDE` and always-excluded dev files (`.git*`, `.cursor`, `CLAUDE.md`).
  `docs/` and `scripts/` currently **do** ship. See TODO.

## Ways of working

- Clarify before building new functionality. Debug properly after 3–4 failed attempts (error_log,
  `/home/<domain>/logs/`, WP_DEBUG_LOG, Query Monitor, browser console). Full text: `.cursor/rules/ways-of-working-vw.mdc`.
- MCP-first: business logic in reusable classes (`includes/`), not inside `element.php` or twig.
- Element property paths in `ssr.php` must mirror the section nesting in `element.php`. Document them in
  the ssr.php header, as `Scos_Faqs` does.
- CSS selectors and tokens: follow the `breakdance-style-conventions` skill. Element classes are `bde-<element>__*`.
- Element Studio edits on a live site write into the plugin folder there. Pull them back into the repo
  before the next deploy or they are overwritten.

## Versioning (release number is mandatory, CI-enforced)

- **The release number is `plugin.php` `Version:`**, mirrored in `const BDE_VERSION`
  (`BreakdanceCustomElements\BDE_VERSION`). Semver, rules at the top of `docs/CHANGELOG.md`.
- **Every PR into master touching `plugin.php`, `elements/` or `includes/`** bumps both and adds a
  `## <version> — <date>` entry to `docs/CHANGELOG.md`. `.github/workflows/version-check.yml` fails the PR otherwise.
- One bump per PR, not per commit. Bump when opening the PR; re-check if master moved on.
- Renaming an element class, slug or property path is a **major** bump: it breaks saved Breakdance data
  and SCOS's `FAQ_Schema_Graph` / `Content_Analysis` lookups.
- Per-file `// vX.Y | YYYY-MM-DD` headers stay as change markers (add `v1.0` on first edit if missing).
  They are not the release number.
- Deploy refs: release from master after the PR merges. `deploy-wp --status` shows the commit per site;
  the WP admin version now means something too. Sites deployed before 1.1.0 all say `1.0`.

## Git

- Default branch `master`. Work on a branch, PR into master. Commit only when asked (`/wrap` excepted).
- History lives in `docs/work-log.md` and `docs/decisions.md`; live status lives on the board card
  (`~/.claude/board/bd-brighter-elements.md`).
