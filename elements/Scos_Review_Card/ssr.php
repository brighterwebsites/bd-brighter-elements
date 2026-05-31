<?php
/**
 * Server-side render: SCOS Review Card
 *
 * Maps Breakdance element content props → [bw_review_card] shortcode attributes.
 * The Review_Card_Renderer in site-essentials owns all HTML/logic.
 *
 * @var array $propertiesData
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! shortcode_exists( 'bw_review_card' ) ) {
    if ( defined( 'BREAKDANCE_BUILDER' ) && BREAKDANCE_BUILDER ) {
        echo '<div class="bde-scos-review-card__placeholder">'
            . esc_html__( '[bw_review_card] shortcode not found. Ensure Site Essentials Reviews CPT submodule is active.', 'site-essentials' )
            . '</div>';
    }
    return;
}

$content = isset( $propertiesData['content'] ) && is_array( $propertiesData['content'] )
    ? $propertiesData['content']
    : [];

// Source
$mode      = isset( $content['source']['mode'] ) ? (string) $content['source']['mode'] : 'loop';
$review_id = isset( $content['source']['review_id'] ) ? absint( $content['source']['review_id'] ) : 0;

// Layout
$layout = isset( $content['display']['layout'] ) ? (string) $content['display']['layout'] : 'stacked';

// Field toggles — 1/0 strings for shortcode
$bool = function ( $val, bool $default = true ): string {
    if ( $val === null || $val === '' ) {
        return $default ? '1' : '0';
    }
    return $val ? '1' : '0';
};

$fields  = isset( $content['fields'] )  && is_array( $content['fields'] )  ? $content['fields']  : [];
$project = isset( $content['project'] ) && is_array( $content['project'] ) ? $content['project'] : [];
$schema  = isset( $content['schema'] )  && is_array( $content['schema'] )  ? $content['schema']  : [];

$atts = [
    'layout'             => $layout,
    'show_rating'        => $bool( $fields['show_rating']        ?? null ),
    'show_excerpt'       => $bool( $fields['show_excerpt']       ?? null ),
    'show_full_text'     => $bool( $fields['show_full_text']     ?? null, false ),
    'show_outcome'       => $bool( $fields['show_outcome']       ?? null ),
    'show_name'          => $bool( $fields['show_name']          ?? null ),
    'show_detail'        => $bool( $fields['show_detail']        ?? null ),
    'show_date'          => $bool( $fields['show_date']          ?? null ),
    'show_platform'      => $bool( $fields['show_platform']      ?? null ),
    'show_verify'        => $bool( $fields['show_verify']        ?? null ),
    'show_featured'      => $bool( $fields['show_featured']      ?? null, false ),
    'show_platform_icon' => $bool( $fields['show_platform_icon'] ?? null ),
    'show_project_image' => $bool( $project['show_image']        ?? null ),
    'show_project_name'  => $bool( $project['show_name']         ?? null ),
    'show_project_link'  => $bool( $project['show_link']         ?? null ),
    // Schema
    'show_item_reviewed'  => $bool( $schema['show_item_reviewed'] ?? null ),
    'item_reviewed_type'  => in_array( $schema['item_reviewed_type'] ?? 'Service', [ 'Service', 'Product' ], true )
        ? ( $schema['item_reviewed_type'] ?? 'Service' )
        : 'Service',
];

// Add review ID only in specific mode
if ( 'specific' === $mode ) {
    if ( ! $review_id ) {
        echo '<div class="bde-scos-review-card__placeholder">'
            . esc_html__( 'Select a review in the element sidebar.', 'site-essentials' )
            . '</div>';
        return;
    }
    $atts['id'] = $review_id;
}

// Build shortcode attribute string
$att_string = '';
foreach ( $atts as $k => $v ) {
    $att_string .= ' ' . $k . '="' . esc_attr( (string) $v ) . '"';
}

echo do_shortcode( '[bw_review_card' . $att_string . ']' );
