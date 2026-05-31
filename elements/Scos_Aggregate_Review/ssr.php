<?php
/**
 * Server-side render: SCOS Aggregate Review
 *
 * Maps Breakdance element content props → [bw_aggregate_review] shortcode attributes.
 * Aggregate_Review_Renderer in site-essentials owns all HTML and data logic.
 *
 * @var array $propertiesData
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! shortcode_exists( 'bw_aggregate_review' ) ) {
    if ( defined( 'BREAKDANCE_BUILDER' ) && BREAKDANCE_BUILDER ) {
        echo '<div class="bde-scos-aggregate-review__placeholder">'
            . esc_html__( '[bw_aggregate_review] shortcode not found. Ensure Site Essentials Reviews CPT submodule is active.', 'site-essentials' )
            . '</div>';
    }
    return;
}

$content = isset( $propertiesData['content'] ) && is_array( $propertiesData['content'] )
    ? $propertiesData['content']
    : [];

$display = isset( $content['display'] ) && is_array( $content['display'] ) ? $content['display'] : [];
$link    = isset( $content['link'] )    && is_array( $content['link'] )    ? $content['link']    : [];
$show    = isset( $content['show'] )    && is_array( $content['show'] )    ? $content['show']    : [];

$layout      = isset( $display['layout'] )   ? (string) $display['layout']   : 'google-full';
$platform    = isset( $display['platform'] ) ? (string) $display['platform'] : 'google';
$reviews_url = isset( $link['reviews_url'] ) ? (string) $link['reviews_url'] : '';

$bool = function ( $val, bool $default = true ): string {
    if ( $val === null || $val === '' ) {
        return $default ? '1' : '0';
    }
    return $val ? '1' : '0';
};

$atts = [
    'layout'      => $layout,
    'platform'    => sanitize_title( $platform ),
    'reviews_url' => $reviews_url,
    'show_icon'   => $bool( $show['icon']  ?? null ),
    'show_stars'  => $bool( $show['stars'] ?? null ),
    'show_name'   => $bool( $show['name']  ?? null ),
    'show_link'   => $bool( $show['link']  ?? null ),
];

$att_string = '';
foreach ( $atts as $k => $v ) {
    $att_string .= ' ' . $k . '="' . esc_attr( (string) $v ) . '"';
}

echo do_shortcode( '[bw_aggregate_review' . $att_string . ']' );
