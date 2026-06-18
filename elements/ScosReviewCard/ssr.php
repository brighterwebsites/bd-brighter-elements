<?php
// v1.0 | 2026-06-18
//
// PHP rendering template for the ScosReviewCard Breakdance element.
// Executed by phpTemplate() — $properties is injected by Breakdance's renderer.
//
// Modes:
//   loop      — renders the review for the current post in the WP loop
//   specific  — renders a single review by post ID (set via the Review Post ID control)
//   connected — queries all bw_reviews where bw_related_project = current post ID;
//               designed for use on project single templates

if ( ! defined( 'ABSPATH' ) ) {
    return;
}

if ( ! class_exists( 'SiteEssentials\\Modules\\CustomPosts\\Review_Card_Renderer' ) ) {
    echo '<p style="color:#a00;">SCOS Review Card: Review_Card_Renderer not found. Ensure the site-essentials plugin is active.</p>';
    return;
}

$source = isset( $properties['content']['source'] ) && is_array( $properties['content']['source'] )
    ? $properties['content']['source']
    : [];

$fields = isset( $properties['content']['fields'] ) && is_array( $properties['content']['fields'] )
    ? $properties['content']['fields']
    : [];

$mode   = isset( $source['mode'] ) ? (string) $source['mode'] : 'loop';
$layout = isset( $source['layout'] ) ? (string) $source['layout'] : 'stacked';

// Field defaults — match Review_Card_Renderer shortcode defaults
$field_defaults = [
    'show_rating'        => true,
    'show_excerpt'       => true,
    'show_full_text'     => false,
    'show_outcome'       => true,
    'show_name'          => true,
    'show_detail'        => true,
    'show_date'          => true,
    'show_platform'      => true,
    'show_verify'        => true,
    'show_featured'      => false,
    'show_platform_icon' => true,
    'show_project_image' => true,
    'show_project_name'  => true,
    'show_project_link'  => true,
];
$fields = array_merge( $field_defaults, $fields );

// Convert boolean toggles to '1'/'0' strings for the renderer
$atts = [ 'layout' => $layout ];
foreach ( $field_defaults as $key => $default ) {
    $atts[ $key ] = ! empty( $fields[ $key ] ) ? '1' : '0';
}

$renderer = new \SiteEssentials\Modules\CustomPosts\Review_Card_Renderer();

if ( 'specific' === $mode ) {

    $raw_id    = $source['review_id'] ?? 0;
    $review_id = 0;
    if ( is_numeric( $raw_id ) ) {
        $review_id = (int) $raw_id;
    } elseif ( is_array( $raw_id ) ) {
        $review_id = (int) ( $raw_id['id'] ?? $raw_id['value'] ?? $raw_id['post']['id'] ?? 0 );
    }

    if ( $review_id > 0 ) {
        echo $renderer->render( $review_id, $atts ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

} elseif ( 'connected' === $mode ) {

    $project_id = get_the_ID();
    if ( ! $project_id ) {
        return;
    }

    $reviews_query = new WP_Query( [
        'post_type'              => 'bw_reviews',
        'post_status'            => 'publish',
        'posts_per_page'         => -1,
        'no_found_rows'          => true,
        'update_post_term_cache' => true,
        'meta_query'             => [ [
            'key'     => 'bw_related_project',
            'value'   => $project_id,
            'compare' => '=',
            'type'    => 'NUMERIC',
        ] ],
    ] );

    if ( $reviews_query->have_posts() ) {
        // Batch-prime meta cache for all connected reviews
        update_meta_cache( 'post', wp_list_pluck( $reviews_query->posts, 'ID' ) );
        foreach ( $reviews_query->posts as $review_post ) {
            echo $renderer->render( (int) $review_post->ID, $atts ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }

    wp_reset_postdata();

} else { // loop

    $review_id = get_the_ID();
    if ( $review_id ) {
        echo $renderer->render( $review_id, $atts ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

}
