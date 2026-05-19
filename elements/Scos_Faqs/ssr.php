<?php
/**
 * Server-side render for SCOS FAQs.
 *
 * Delegates to the [faqs] shortcode in the Site Essentials MU plugin
 * (FAQ_Module::shortcode). That shortcode owns:
 *   - the HTML output (accordion / plain)
 *   - the FAQPage schema contribution to the unified site graph
 *   - the empty-state fallback (`<p>No FAQs selected.</p>`)
 *
 * This SSR file just translates Breakdance content props → shortcode atts.
 * It deliberately does NOT echo placeholder text on empty selection — BD's
 * AJAX wrapper rejects unexpected output during certain editor lifecycle
 * calls, so we let the shortcode render a tiny "No FAQs selected." message
 * instead.
 *
 * Property paths (must mirror element.php contentControls section nesting):
 *   content.faq_source.mode
 *   content.faq_source.selected_faqs[].id
 *   content.faq_source.topic_slug
 *   content.display.format
 *   content.display.heading
 *   content.display.schema_enabled
 *
 * @var array $propertiesData
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! shortcode_exists( 'faqs' ) ) {
    // Editor-only hint; never echoes on the front end. Matches Scos_Review_Card pattern.
    if ( defined( 'BREAKDANCE_BUILDER' ) && BREAKDANCE_BUILDER ) {
        echo '<div class="bde-scos-faqs__placeholder">'
            . esc_html__( 'The [faqs] shortcode is not registered. Activate the Site Essentials FAQ submodule.', 'site-essentials' )
            . '</div>';
    }
    return;
}

$content = isset( $propertiesData['content'] ) && is_array( $propertiesData['content'] )
    ? $propertiesData['content']
    : [];

$source  = isset( $content['faq_source'] ) && is_array( $content['faq_source'] ) ? $content['faq_source'] : [];
$display = isset( $content['display'] )    && is_array( $content['display'] )    ? $content['display']    : [];

$mode    = isset( $source['mode'] )      ? (string) $source['mode']      : 'selector';
$format  = isset( $display['format'] )   ? (string) $display['format']   : 'accordion';
$heading = isset( $display['heading'] )  ? (string) $display['heading']  : 'h3';

// schema_enabled defaults true; missing/null → on.
$schema_enabled = array_key_exists( 'schema_enabled', $display )
    ? (bool) $display['schema_enabled']
    : true;

$atts = [
    'format'  => $format,
    'heading' => $heading,
    'schema'  => $schema_enabled ? 'true' : 'false',
];

if ( 'topic' === $mode ) {
    $topic_slug = isset( $source['topic_slug'] ) ? sanitize_title( (string) $source['topic_slug'] ) : '';
    if ( '' !== $topic_slug ) {
        $atts['topic'] = $topic_slug;
    }
    // Empty topic falls through with no `topic`/`ids` att → shortcode renders
    // its own "No FAQs selected." message. No echo from this file.
} else {
    // Selector mode — pull post IDs out of the repeater rows.
    $rows = isset( $source['selected_faqs'] ) && is_array( $source['selected_faqs'] )
        ? $source['selected_faqs']
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

    if ( ! empty( $ids ) ) {
        $atts['ids'] = implode( ',', $ids );
    }
    // Empty IDs falls through with no `ids` att → shortcode renders its own
    // "No FAQs selected." message. No echo from this file.
}

$att_string = '';
foreach ( $atts as $k => $v ) {
    $att_string .= ' ' . $k . '="' . esc_attr( (string) $v ) . '"';
}

echo do_shortcode( '[faqs' . $att_string . ']' );
