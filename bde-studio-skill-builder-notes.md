# BDE Element Dev Notes

## 2026-05-19 — Ghost elements + SCOS browse

**Task:** Curate published elements; remove orphans; SCOS only visible via search.

**Expected:** Element list matches git repo only.

**Actually happened:** Breakdance settings showed `SummaryDetails`, `Text` (Summary Title), `Div`, `Breadcrumbs`, `DivTables` even after repo cleanup. SCOS Breadcrumbs/TLDR found via search "scos" but not when browsing categories.

**Why:**
- Deploy uses `tar -xf` into existing plugin dir — **does not delete** removed element folders. Old Element Studio exports stayed on server.
- SCOS elements used custom category `site_essentials`. Breakdance Add panel browse uses built-in category tabs (`basic`, etc.); custom slugs often work for search but not sidebar browse.

**Fix:**
- Remove `DivTables` from repo.
- Rename display name `TableRows` → `Table Outers` (class `Tablerows` unchanged for existing layouts).
- SCOS elements: `category()` → `basic`, keep SCOS badge.
- `deploy-plink.ps1`: `find …/elements -mindepth 1 -exec rm -rf` before tar extract.

**Result:** success (pending deploy to production).

**Lesson:** Any element removed from git must either wipe `elements/` on deploy or run a one-time server cleanup; otherwise Breakdance keeps loading orphaned `element.php` files.

## 2026-05-19 — Scos_Faqs element + cross-plugin schema collection

**Task:** Build a Breakdance FAQ element that mirrors the Gutenberg `brighter/faq-selector` block and contributes to the same unified FAQPage JSON-LD on the site graph.

**Pattern that worked — BD element → shortcode delegation:**

The element's `ssr.php` does no rendering of its own. It maps content controls to shortcode atts and prints `do_shortcode('[faqs ...]')`. The `[faqs]` shortcode lives in `site-essentials/Modules/CustomPosts/FAQ/FAQ_Module.php` and was extended to accept `topic="slug"` so this element can offer a "By Topic" mode without duplicating query logic.

Benefits:
- One renderer (FAQ_Block::render) → identical markup across Gutenberg, shortcode, and Breakdance.
- The element file stays tiny and almost entirely declarative (sidebar controls + design controls).
- Per-FAQ accessibility/escaping rules live in one place.

**Pattern that worked — tree-walk schema collection:**

JSON-LD is NOT emitted by the element. Instead, the MU plugin's `FAQ_Schema_Graph` class hooks the `scos_schema_graph_items` filter at `wp_head` time and walks two sources:

1. `$post->post_content` via `parse_blocks()` — catches the Gutenberg `brighter/faq-selector` block.
2. `_breakdance_data` post meta — catches every `BreakdanceCustomElements\ScosFaqs` node in the BD tree.

IDs from both passes are deduplicated, then a single `FAQPage` entry is appended to the graph. This avoids two FAQPage blocks fighting on the same page, and removes any runtime "collector" / output-buffering plumbing.

The element class name string is the contract between the two repos: it's hard-coded in `FAQ_Schema_Graph::BD_ELEMENT_TYPE` and must match the class declared in `elements/Scos_Faqs/element.php`. Comments in both files reference each other so renames don't silently break collection.

**Lesson:** When schema needs to span Gutenberg + Breakdance, read both data sources from the same filter at render time. Do not try to make each editor emit its own JSON-LD — you'll end up with duplicates and per-source bugs.
