<?php
/**
 * Server-side render for SCOS FAQs.
 *
 * Delegates to the [faqs] shortcode in the Site Essentials MU plugin
 * (FAQ_Module::shortcode). That shortcode owns:
 *   - the HTML output (accordion / plain)
 *   - the FAQPage schema contribution to the unified site graph
 *
 * This SSR file just translates Breakdance content props → shortcode atts.
 * Schema is collected separately by FAQ_Schema_Graph which walks
 * `_breakdance_data` looking for our element class name.
 *
 * @var array $propertiesData
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$content = isset( $propertiesData['content'] ) && is_array( $propertiesData['content'] )
    ? $propertiesData['content']
    : [];

$mode    = isset( $content['mode'] )    ? (string) $content['mode']    : 'selector';
$format  = isset( $content['format'] )  ? (string) $content['format']  : 'accordion';
$heading = isset( $content['heading'] ) ? (string) $content['heading'] : 'h3';

// `schema_enabled` defaults true; treat null/missing as on.
$schema_enabled = array_key_exists( 'schema_enabled', $content )
    ? (bool) $content['schema_enabled']
    : true;

$atts = [
    'format'  => $format,
    'heading' => $heading,
    'schema'  => $schema_enabled ? 'true' : 'false',
];

if ( 'topic' === $mode ) {
    $topic_slug = isset( $content['topic_slug'] ) ? sanitize_title( (string) $content['topic_slug'] ) : '';
    if ( '' === $topic_slug ) {
        // Editor placeholder so the canvas doesn't render silent emptiness.
        echo '<div class="bde-scos-faqs__placeholder">'
            . esc_html__( 'Enter a scos_topic slug in the element sidebar to render FAQs by topic.', 'site-essentials' )
            . '</div>';
        return;
    }
    $atts['topic'] = $topic_slug;
} else {
    // Selector mode — pull post IDs out of the repeater rows.
    $rows = isset( $content['selected_faqs'] ) && is_array( $content['selected_faqs'] )
        ? $content['selected_faqs']
        : [];

    $ids = [];
    foreach ( $rows as $row ) {
        if ( is_array( $row ) && isset( $row['id'] ) && is_numeric( $row['id'] ) ) {
            $id = (int) $row['id'];
            if ( $id > 0 ) {
                $ids[] = $id;
            }
        } elseif ( is_numeric( $row ) ) {
            $ids[] = (int) $row;
        }
    }

    if ( empty( $ids ) ) {
        echo '<div class="bde-scos-faqs__placeholder">'
            . esc_html__( 'Add one or more FAQ IDs in the element sidebar.', 'site-essentials' )
            . '</div>';
        return;
    }

    $atts['ids'] = implode( ',', $ids );
}

if ( ! shortcode_exists( 'faqs' ) ) {
    // Fail loudly in the editor but quietly on the front end. Without the
    // shortcode there's nothing this element can render.
    if ( defined( 'BREAKDANCE_BUILDER' ) && BREAKDANCE_BUILDER ) {
        echo '<div class="bde-scos-faqs__placeholder">'
            . esc_html__( 'The [faqs] shortcode is not registered. Activate the Site Essentials FAQ submodule.', 'site-essentials' )
            . '</div>';
    }
    return;
}

$att_string = '';
foreach ( $atts as $k => $v ) {
    $att_string .= ' ' . $k . '="' . esc_attr( (string) $v ) . '"';
}

echo do_shortcode( '[faqs' . $att_string . ']' );
