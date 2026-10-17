<?php
// v1.0 | 2026-10-17

namespace BrighterElements;

/**
 * FAQ query providers for the SCOS FAQs element ("Query provider" source mode).
 *
 * A provider turns the current request context (the product on a single, the
 * term on an archive, the loop post inside a post loop) into an ordered list of
 * FAQ post IDs. Other plugins or snippets register providers with a filter, on
 * `init` or earlier, so they appear in the element's dropdown:
 *
 *   add_filter( 'bde_scos_faq_providers', function ( array $providers ) {
 *       $providers['gs_models'] = [
 *           'label'    => 'GS: stable model FAQs',
 *           'callback' => [ My_Provider::class, 'resolve' ], // ( array $context, array $args ): int[]
 *       ];
 *       return $providers;
 *   } );
 *
 * `$context` is [ 'type' => 'post'|'term'|'none', 'object' => WP_Post|WP_Term|null ].
 * `$args` is the element's "Provider args" field parsed as a query string
 * (e.g. `taxonomies=pa_stable-model,product_cat&field=related_faqs`).
 *
 * resolve() validates the IDs (published FAQ posts only), dedupes, keeps the
 * provider's order and applies the limit, so providers can return raw IDs.
 * Logic lives here, not in ssr.php, so REST / WP-CLI / MCP can call resolve().
 */
class Faq_Providers {

    const FILTER = 'bde_scos_faq_providers';

    /** Built-in provider id. */
    const RELATED_TERMS = 'bde_related_terms';

    /**
     * Registered providers, validated.
     *
     * @return array<string, array{label: string, callback: callable}>
     */
    public static function all(): array {
        $providers = [
            self::RELATED_TERMS => [
                'label'    => __( 'Related FAQs from current terms', 'breakdance' ),
                'callback' => [ self::class, 'related_terms' ],
            ],
        ];

        $providers = apply_filters( self::FILTER, $providers );
        if ( ! is_array( $providers ) ) {
            return [];
        }

        $valid = [];
        foreach ( $providers as $id => $provider ) {
            if ( ! is_string( $id ) || '' === $id || ! is_array( $provider ) || empty( $provider['callback'] ) || ! is_callable( $provider['callback'] ) ) {
                continue;
            }
            $valid[ $id ] = [
                'label'    => isset( $provider['label'] ) ? (string) $provider['label'] : $id,
                'callback' => $provider['callback'],
            ];
        }

        return $valid;
    }

    /**
     * Dropdown items for the Breakdance control.
     *
     * @return list<array{text: string, value: string}>
     */
    public static function dropdown_items(): array {
        $items = [];
        foreach ( self::all() as $id => $provider ) {
            $items[] = [ 'text' => $provider['label'], 'value' => $id ];
        }
        return $items;
    }

    /**
     * Current request context. The loop post wins inside a post loop, so the
     * element works per item on archive templates.
     *
     * @return array{type: string, object: \WP_Post|\WP_Term|null}
     */
    public static function context_from_request(): array {
        if ( in_the_loop() ) {
            $post = get_post();
            if ( $post instanceof \WP_Post ) {
                return [ 'type' => 'post', 'object' => $post ];
            }
        }

        $queried = get_queried_object();
        if ( $queried instanceof \WP_Post ) {
            return [ 'type' => 'post', 'object' => $queried ];
        }
        if ( $queried instanceof \WP_Term ) {
            return [ 'type' => 'term', 'object' => $queried ];
        }

        return [ 'type' => 'none', 'object' => null ];
    }

    /**
     * Parse the element's args field. Accepts query-string format; newlines and
     * semicolons also work as separators.
     */
    public static function parse_args( string $raw ): array {
        $raw = trim( str_replace( [ "\r\n", "\n", ';' ], '&', $raw ) );
        if ( '' === $raw ) {
            return [];
        }
        $args = [];
        wp_parse_str( $raw, $args );
        return array_map( static fn( $v ) => is_string( $v ) ? trim( $v ) : $v, $args );
    }

    /**
     * Run a provider and return valid, ordered, deduped FAQ IDs.
     *
     * @param int $limit 0 = no limit.
     * @return int[]
     */
    public static function resolve( string $provider_id, array $context, array $args = [], int $limit = 0 ): array {
        $providers = self::all();
        if ( ! isset( $providers[ $provider_id ] ) ) {
            return [];
        }

        $ids = call_user_func( $providers[ $provider_id ]['callback'], $context, $args );
        $ids = self::normalise_ids( $ids );

        if ( ! empty( $ids ) ) {
            // Keep only published FAQs, in provider order.
            $ids = get_posts(
                [
                    'post_type'      => Faq_Picker_Options::post_type(),
                    'post_status'    => 'publish',
                    'post__in'       => $ids,
                    'orderby'        => 'post__in',
                    'posts_per_page' => -1,
                    'fields'         => 'ids',
                    'no_found_rows'  => true,
                ]
            );
            $ids = array_map( 'intval', $ids );
        }

        if ( $limit > 0 ) {
            $ids = array_slice( $ids, 0, $limit );
        }

        return (array) apply_filters( 'bde_scos_faq_provider_ids', $ids, $provider_id, $context, $args );
    }

    /**
     * Built-in: FAQs linked to terms via a term field (e.g. an ACF relationship
     * field `related_faqs` on product_cat and pa_stable-model).
     *
     * Args:
     *   taxonomies  Comma list, most specific first. Default: product_cat.
     *   field       Term meta key. Default: related_faqs.
     *   parents     1 = also use ancestor terms (after the direct terms of that taxonomy).
     *
     * Post context: union of the post's terms' FAQs, in taxonomy order.
     * Term context: that term's FAQs (plus ancestors with parents=1).
     *
     * @return int[]
     */
    public static function related_terms( array $context, array $args ): array {
        $taxonomies = array_filter( array_map( 'trim', explode( ',', (string) ( $args['taxonomies'] ?? 'product_cat' ) ) ) );
        $field      = sanitize_key( (string) ( $args['field'] ?? 'related_faqs' ) );
        $parents    = ! empty( $args['parents'] );

        if ( '' === $field || empty( $taxonomies ) ) {
            return [];
        }

        $term_ids = [];
        $object   = $context['object'] ?? null;

        if ( 'post' === ( $context['type'] ?? '' ) && $object instanceof \WP_Post ) {
            foreach ( $taxonomies as $taxonomy ) {
                if ( ! taxonomy_exists( $taxonomy ) ) {
                    continue;
                }
                $terms = wp_get_post_terms( $object->ID, $taxonomy, [ 'fields' => 'ids' ] );
                if ( is_wp_error( $terms ) ) {
                    continue;
                }
                $term_ids = array_merge( $term_ids, self::with_parents( $terms, $taxonomy, $parents ) );
            }
        } elseif ( 'term' === ( $context['type'] ?? '' ) && $object instanceof \WP_Term ) {
            if ( in_array( $object->taxonomy, $taxonomies, true ) ) {
                $term_ids = self::with_parents( [ $object->term_id ], $object->taxonomy, $parents );
            }
        }

        $ids = [];
        foreach ( array_unique( $term_ids ) as $term_id ) {
            $ids = array_merge( $ids, self::normalise_ids( get_term_meta( (int) $term_id, $field, true ) ) );
        }

        return $ids;
    }

    /**
     * @param int[] $term_ids
     * @return int[]
     */
    private static function with_parents( array $term_ids, string $taxonomy, bool $parents ): array {
        $out = array_map( 'intval', $term_ids );
        if ( $parents ) {
            foreach ( $term_ids as $term_id ) {
                $out = array_merge( $out, array_map( 'intval', get_ancestors( (int) $term_id, $taxonomy, 'taxonomy' ) ) );
            }
        }
        return $out;
    }

    /**
     * Accepts what term meta / providers hand back: int[], string[] (ACF
     * relationship), a single ID, a comma list, or WP_Post objects.
     *
     * @param mixed $value
     * @return int[]
     */
    private static function normalise_ids( $value ): array {
        if ( is_string( $value ) ) {
            $value = maybe_unserialize( $value );
        }
        if ( is_string( $value ) ) {
            $value = explode( ',', $value );
        }
        if ( ! is_array( $value ) ) {
            $value = [ $value ];
        }

        $ids = [];
        foreach ( $value as $item ) {
            $id = $item instanceof \WP_Post ? (int) $item->ID : ( is_numeric( $item ) ? (int) $item : 0 );
            if ( $id > 0 ) {
                $ids[] = $id;
            }
        }

        return array_values( array_unique( $ids ) );
    }
}
