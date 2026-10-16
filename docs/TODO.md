# TODO — bd-brighter-elements

Newest at the top within each section. Move done items to `work-log.md`.

## 1.2.0 — Scos_Faqs "Query provider" source mode (agreed 2026-10-17, see decisions)

Driver: GS product single + product_cat / pa_* archive templates need FAQs picked per term (about 10 sets
across 40+ products), with FAQ schema. Test on guerillasteelstables.com.au (`--only`) before rolling wider.

- [ ] `includes/class-faq-providers.php` (`BrighterElements\Faq_Providers`): registry built from
      `apply_filters( 'bde_scos_faq_providers', [] )`. Each entry is `id => [ 'label', 'callback' ]`, where the
      callback is `( array $context, array $args ): int[]`. Expose `options()` for the dropdown and
      `resolve( $id, $context, $args )`, reusable by REST/WP-CLI/MCP.
- [ ] Context = the queried object: `[ 'type' => 'post'|'term', 'object' => WP_Post|WP_Term ]`. Build it from
      `get_queried_object()`, falling back to the loop post inside post loops.
- [ ] Built-in provider `bde_related_terms` ("Related FAQs from current terms"). Args: `taxonomies`
      (ordered, most specific first, e.g. `pa_stable-model,product_cat`) and `field` (term meta / ACF
      relationship name, e.g. `related_faqs`).
      - Single post: **union** of FAQs from the post's terms, most specific taxonomy first, deduped, capped at the limit.
      - Term archive: that term's FAQs.
      - Read via `get_term_meta` so ACF isn't a hard dependency. Handle ACF storing IDs as an array or a serialized string.
- [ ] `element.php`: mode `provider`, plus controls `provider_id` (dropdown), `provider_args` (text), `limit`
      (number) and `hide_if_empty` (toggle). Update the property-path list in the `ssr.php` header.
- [ ] `ssr.php`: resolve provider IDs. Respect `hide_if_empty`: render nothing on the front end, a placeholder in the builder.
- [ ] Hand the rendered IDs to SCOS for schema (only when `schema_enabled`), via
      `do_action( 'scos_faq_ids_rendered', $ids, $context )`. Fire it for **all** modes, not just provider.
- [ ] **SCOS side (wp-scos project):** `FAQ_Schema_Graph` listens for `scos_faq_ids_rendered`, collects
      the IDs and prints the FAQPage as its own JSON-LD block in `wp_footer`. Skip post IDs the head
      graph already emitted (dedupe, so pages that work today don't get two FAQPages). Archives included.
      Ship SCOS first or together; BDE degrades gracefully if no listener exists.
- [ ] gs-conversion-tools: register the ACF `related_faqs` relationship field on `product_cat` + `pa_stable-model`
      (post type `faq`, max ~5). No custom provider needed unless the matching rules change.
- [ ] Update this repo's CLAUDE.md dependency table and the SCOS schema note when it ships.

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
