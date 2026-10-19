# Work log — bd-brighter-elements

Newest at the top. One line per meaningful change; link commits/PRs.

## 2026-10-19
- 1.2.1 (PR #14, bb24db8) deployed to guerillasteelstables from master. Builder AJAX error confirmed gone. Rollout to other sites deferred.

## 2026-10-18
- PR #13 (1.2.0) merged; master 6640b4e + SCOS 260a53a (footer FAQ listener) deployed to guerillasteelstables only.
  Verified provider union order, term archives, footer `scos-faq-graph` FAQPage.
- Found + fixed: `BREAKDANCE_BUILDER` doesn't exist → builder hint shown to visitors, builder AJAX error. New
  `Builder_Context`, release 1.2.1 (PR #14, CI green), branch tested on GS.
- Found (SCOS, not fixed): footer FAQPage not linked to WebPage, WebPage `@id` keeps query string, CollectionPage
  wrong on term archives, duplicate BreadcrumbList. Written up in TODO.

| date | client/site | deliverable | qty | value est. (non-AI hrs) | billable |
|---|---|---|---|---|---|
| 2026-10-17 | internal (BDE) | Versioning + CI version check + project docs (1.1.0) | 1 | 3 | internal |
| 2026-10-17/18 | guerillasteelstables | Per-term FAQs on product/archive templates with FAQ schema (BDE 1.2.0/1.2.1 + SCOS listener), deployed and verified | 1 | 10 | unbilled |
| 2026-10-18 | internal (SCOS) | Schema audit of archive output, 4 SCOS defects written up | 1 | 1.5 | internal |

## 2026-10-17
- 1.2.0 BDE side on `feature/scos-faqs-query-providers`: Faq_Providers registry + built-in related-terms provider,
  Scos_Faqs provider mode / hide-if-empty / `scos_faq_ids_rendered`. Lint clean (PHP 8.3); provider logic tested with
  stubbed WP functions (union order, parents, limit, draft filtering, term context, custom provider). Not run in WP yet.
- PR #12 (1.1.0) merged.
- Added CLAUDE.md, docs/TODO.md, docs/decisions.md, docs/work-log.md; expanded README. Board card created.
- 1.1.0 prepared on branch `release/1.1.0`: `BDE_VERSION`, `Version: 1.1.0`, docs/CHANGELOG.md, CI version-check
  (simulated locally: pass on bump; fail on no bump, header/const mismatch, missing changelog entry).
- Found: FAQ schema misses Scos_Faqs in templates and on archives (SCOS walks only the queried post's own BD data).
  1.2.0 plan in TODO.

## 2026-10-13 (servers project)
- deploy-wp enabled for 100up.com.au after audit; guerillasteelstables, coastalnativesupply, paalgrant,
  cubewebservices confirmed on master 6f55487 (accidental unscoped deploy-bde run).

## 2026-10-08 (servers project)
- deploy-wp enabled for brighterwebsites.com.au after audit (dropped unused CPT-submission action + FormDesignOptions).

## 2026-08-25
- PR #9 Section_Simple: container styles flattened onto the section; default max-width/padding dropped (a1e4590, 4d962d1).
- PR #10 Scos_Faqs: CSS simplified so the item owns padding and borders (a16f2a7).
- PR #8: forms untracked; deploy scripts hardened (stage-and-swap, path validation); identifiers scrubbed.
- Table elements: native tags, table styles, stacked-row collapse (1c46d36).
