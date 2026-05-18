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
