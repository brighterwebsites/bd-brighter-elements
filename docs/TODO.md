# TODO — bd-brighter-elements

Newest at the top within each section. Move done items to `work-log.md`.

## 1.2.0 — Scos_Faqs "Query provider" source mode (agreed 2026-10-17, see decisions)

Driver: GS product single + product_cat / pa_* archive templates need FAQs picked per term (about 10 sets
across 40+ products), with FAQ schema. Test on guerillasteelstables.com.au (`--only`) before rolling wider.

BDE side done on branch `feature/scos-faqs-query-providers` (see CHANGELOG 1.2.0). Remaining:

- [x] SCOS listener shipped (SCOS 260a53a, deployed to GS 2026-10-18). Footer `scos-faq-graph` FAQPage verified on
      product singles, product_cat archives and the shop page.
- [ ] **SCOS follow-ups (wp-scos project), found 2026-10-18 on a product_cat archive:**
      1. **Link the footer FAQPage to the page.** `FAQ_Schema_Graph::print_footer_graph` (~line 296) outputs only
         `@type`, `@id`, `mainEntity`. Add `url` and `isPartOf: {"@id": <WebPage @id>}` so it joins the head
         graph by `@id`. Don't merge it into the head `<script>` with output buffering: the head prints at
         `wp_head` before the template renders, and buffering fights LiteSpeed.
      2. **WebPage `@id` / `url` keep the query string.** `brighter-core/includes/scos-schema-output.php` ~line 611
         uses `home_url($_SERVER['REQUEST_URI'])`, so `?utm_…` / `?nocache=` end up in the `@id`. Use the canonical
         URL (same helper as `FAQ_Schema_Graph::current_url()`, which already strips it), otherwise fix 1's
         `isPartOf` won't match.
      3. **CollectionPage is wrong on taxonomy archives** (same file ~line 655-697):
         - `@id`/`url` = `get_post_type_archive_link()`, so a product_cat archive claims the shop URL
           (`/<shop>/#collection`). Use `get_term_link()` on term archives.
         - `mainEntity` = latest 5 posts of the post type, not posts in the term, and always typed `BlogPosting`
           (wrong for products). Query the queried term; type by post type (`Product` → skip or `ListItem`/`ItemList`).
         - The page ends up with both WebPage and CollectionPage for one URL. Consider typing the WebPage node
           as `CollectionPage` on archives instead of a second node.
      4. Minor: a second, separate BreadcrumbList block is printed in the body (likely a breadcrumb element's own
         schema) alongside the head graph's `#breadcrumb`. Check which one to keep.
- [ ] **gs-conversion-tools:** register the ACF `related_faqs` relationship field (post type `faq`, max ~5,
      return format ID) on `product_cat` + `pa_stable-model`. Then fill in the ~10 FAQ sets.
- [ ] **GS template setup:** Scos_Faqs → Query Provider → "Related FAQs from current terms", args
      `taxonomies=pa_stable-model,product_cat&field=related_faqs`, Max 5, Hide if no FAQs on.
- [ ] **Test on GS (`--only`):** a product with both terms, a product with only a category, a pa_stable-model
      archive, a product_cat archive. Check rendered order and limit, the empty case and the builder placeholder;
      after SCOS ships, run Rich Results Test on one product + one archive.

## Open

- [ ] **Deploy payload ships `docs/` and `scripts/`.** `bd-brighter-elements.conf` has `EXCLUDE="README.md"` only.
      Proposed: `EXCLUDE="README.md docs scripts"`. Owner: servers project (edit `servers/deploy/components/`, push to hosts).
- [ ] **Retire `scripts/` deploy tooling.** `deploy.sh`, `deploy.ps1`, `deploy-plink.ps1`, `install-deploy-alias.ps1`,
      `ssh-agent-setup.ps1`, `enable-ssh-agent-admin.ps1`, `deploy.env.example` predate deploy-wp. Decider: Vanessa.
      Leaning: delete (deploy-wp is the only path), or keep the ssh-agent helpers if still used elsewhere.
- [ ] **Audit + enable remaining sites** (pending in the .conf): mensfinanceadvice.com.au, ballaratlawncare.com.au,
      daylesfordgardener.com.au, bodynurturemassage.com, oneteamqld.com.au. Diff installed copy vs master,
      check postmeta/options for elements master would drop, then add to SITES. Needed before any "all sites" rollout.
- [ ] **Add version headers** to elements without one: Accordion_Content_Extended, Definition, Definitions_Box,
      Description_Text, Extended_Wrapper, Scos_Breadcrumbs, Section_Simple, Summary, Text_Extended (on next edit).
- [ ] **Dev-notes capture file missing.** `.cursor/rules/bde-element-dev.mdc` writes to `.cursor/bde-elements-dev-notes.md`
      (gitignored) which doesn't exist on this machine. Decide whether that capture is still wanted.
- [ ] **Optional: branch protection on master** requiring the `version-check` status, so CI can't be merged around.
