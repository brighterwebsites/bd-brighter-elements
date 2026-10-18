# TODO — bd-brighter-elements

Newest at the top within each section. Move done items to `work-log.md`.

## 1.2.0 — Scos_Faqs "Query provider" source mode (agreed 2026-10-17, see decisions)

Driver: GS product single + product_cat / pa_* archive templates need FAQs picked per term (about 10 sets
across 40+ products), with FAQ schema. Test on guerillasteelstables.com.au (`--only`) before rolling wider.

BDE side done on branch `feature/scos-faqs-query-providers` (see CHANGELOG 1.2.0). Remaining:

- [ ] **SCOS side (wp-scos project):** `FAQ_Schema_Graph` listens for
      `scos_faq_ids_rendered( int[] $ids, array $context )` and prints the collected FAQs as one FAQPage
      JSON-LD block in `wp_footer`.
      - Only accept a context that is the **queried object**, or `none`. Ignore loop-post contexts, so an
        archive post loop doesn't merge every product's FAQs into the archive's FAQPage.
      - Skip IDs the head graph already emitted, so pages that work today don't get a duplicate FAQPage.
      - `@id` = current URL + `#faq` (archives included); reuse `FAQ_Module::get_schema_answer()`.
      - Ship SCOS before or together with BDE 1.2.0. BDE degrades gracefully if no listener exists.
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
