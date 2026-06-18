<?php
// v1.0 | 2026-06-01

namespace BrighterElements;

/**
 * Platform taxonomy options for Breakdance dropdown controls (SCOS Aggregate Review element).
 *
 * Returns bw_review_platform terms as dropdown items keyed by slug.
 * Reusable from element contentControls(), REST, or WP-CLI later.
 */
class Platform_Picker_Options {

    /**
     * Dropdown items for Breakdance: [ ['text' => 'Google', 'value' => 'google'], ... ].
     *
     * @return list<array{text: string, value: string}>
     */
    public static function dropdown_items(): array {
        if ( ! taxonomy_exists( 'bw_review_platform' ) ) {
            return [
                [
                    'text'  => __( 'Platform taxonomy not found — activate Site Essentials Reviews CPT module', 'breakdance' ),
                    'value' => '',
                ],
            ];
        }

        $terms = get_terms( [
            'taxonomy'   => 'bw_review_platform',
            'hide_empty' => false,
            'orderby'    => 'name',
            'order'      => 'ASC',
        ] );

        if ( is_wp_error( $terms ) || empty( $terms ) ) {
            return [
                [
                    'text'  => __( 'No platforms found — add platforms in Reviews › Platforms', 'breakdance' ),
                    'value' => '',
                ],
            ];
        }

        $items = [];
        foreach ( $terms as $term ) {
            if ( ! $term instanceof \WP_Term ) {
                continue;
            }
            $items[] = [
                'text'  => $term->name,
                'value' => $term->slug,
            ];
        }

        return $items;
    }
}
