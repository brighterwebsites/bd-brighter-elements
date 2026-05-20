<?php
// v1.0 | 2026-05-21

namespace BrighterElements;

/**
 * FAQ post options for Breakdance dropdown controls (SCOS FAQs element).
 *
 * Reusable from element contentControls(), REST, or WP-CLI later.
 */
class Faq_Picker_Options {

    /**
     * Post type slug for FAQ CPT (filterable for site-essentials naming).
     */
    public static function post_type(): string {
        $filtered = apply_filters( 'bd_brighter_elements_faq_post_type', '' );
        if ( is_string( $filtered ) && '' !== $filtered && post_type_exists( $filtered ) ) {
            return $filtered;
        }

        foreach ( [ 'faq', 'bw_faq', 'scos_faq', 'faqs' ] as $candidate ) {
            if ( post_type_exists( $candidate ) ) {
                return $candidate;
            }
        }

        return 'faq';
    }

    /**
     * Dropdown items for Breakdance: [ ['text' => '...', 'value' => '123'], ... ].
     *
     * @return list<array{text: string, value: string}>
     */
    public static function dropdown_items(): array {
        $post_type = self::post_type();

        if ( ! post_type_exists( $post_type ) ) {
            return [
                [
                    'text'  => __( 'FAQ post type not found — activate Site Essentials FAQ module', 'breakdance' ),
                    'value' => '',
                ],
            ];
        }

        $posts = get_posts(
            [
                'post_type'              => $post_type,
                'post_status'            => 'publish',
                'posts_per_page'         => 500,
                'orderby'                => 'title',
                'order'                  => 'ASC',
                'no_found_rows'          => true,
                'update_post_meta_cache' => false,
                'update_post_term_cache' => false,
            ]
        );

        if ( empty( $posts ) ) {
            return [
                [
                    'text'  => __( 'No published FAQs yet', 'breakdance' ),
                    'value' => '',
                ],
            ];
        }

        $items = [];
        foreach ( $posts as $post ) {
            if ( ! $post instanceof \WP_Post ) {
                continue;
            }

            $title = trim( (string) get_the_title( $post ) );
            if ( '' === $title ) {
                $title = sprintf( __( 'FAQ #%d', 'breakdance' ), (int) $post->ID );
            }

            $items[] = [
                'text'  => sprintf( '%s (%d)', $title, (int) $post->ID ),
                'value' => (string) (int) $post->ID,
            ];
        }

        return $items;
    }
}
