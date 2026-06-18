<?php
/**
 * Server-side render for SCOS FAQs.
 *
 * Calls FAQ_Module::get_by_ids() / get_ids_by_topic() directly and renders
 * bde-faq__* HTML compatible with the BreakdanceFaq JS accordion and the
 * Frequently_Asked_Questions element CSS system.
 *
 * Property paths (must mirror element.php section nesting):
 *   content.faq_source.mode
 *   content.faq_source.selected_faqs[].id
 *   content.faq_source.topic_slug
 *   content.display.format
 *   content.display.first_item_opened
 *   content.display.schema_enabled
 *   design.typography.title_tag  (heading tag for question; default h3)
 *   design.item.icon.icon.svgCode
 *   design.item.icon.active_icon.svgCode
 *
 * @var array $propertiesData
 */

use SiteEssentials\Modules\CustomPosts\FAQ\FAQ_Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SiteEssentials\\Modules\\CustomPosts\\FAQ\\FAQ_Module' ) ) {
	if ( defined( 'BREAKDANCE_BUILDER' ) && BREAKDANCE_BUILDER ) {
		echo '<div class="bde-scos-faqs__placeholder">'
			. esc_html__( 'Site Essentials FAQ module is not active.', 'site-essentials' )
			. '</div>';
	}
	return;
}

$content = isset( $propertiesData['content'] ) && is_array( $propertiesData['content'] )
	? $propertiesData['content']
	: [];
$design  = isset( $propertiesData['design'] ) && is_array( $propertiesData['design'] )
	? $propertiesData['design']
	: [];

$source  = isset( $content['faq_source'] ) && is_array( $content['faq_source'] ) ? $content['faq_source'] : [];
$display = isset( $content['display'] )    && is_array( $content['display'] )    ? $content['display']    : [];

$mode         = isset( $source['mode'] )              ? (string) $source['mode']              : 'selector';
$format       = isset( $display['format'] )           ? (string) $display['format']           : 'accordion';
$first_opened = ! empty( $display['first_item_opened'] );

$allowed_tags  = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p' ];
$heading_level = 'h3';
if ( isset( $design['typography']['title_tag'] ) && in_array( $design['typography']['title_tag'], $allowed_tags, true ) ) {
	$heading_level = $design['typography']['title_tag'];
}

// Resolve FAQ IDs from selector or topic mode.
$faq_ids = [];
if ( 'topic' === $mode ) {
	$topic_slug = isset( $source['topic_slug'] ) ? sanitize_title( (string) $source['topic_slug'] ) : '';
	if ( '' !== $topic_slug ) {
		$faq_ids = FAQ_Module::get_ids_by_topic( $topic_slug );
	}
} else {
	$rows = isset( $source['selected_faqs'] ) && is_array( $source['selected_faqs'] ) ? $source['selected_faqs'] : [];
	foreach ( $rows as $row ) {
		if ( is_array( $row ) && isset( $row['id'] ) && is_numeric( $row['id'] ) ) {
			$id = (int) $row['id'];
			if ( $id > 0 ) {
				$faq_ids[] = $id;
			}
		} elseif ( is_numeric( $row ) ) {
			$faq_ids[] = (int) $row;
		}
	}
}

if ( empty( $faq_ids ) ) {
	echo '<p>' . esc_html__( 'No FAQs selected.', 'site-essentials' ) . '</p>';
	return;
}

$faqs = FAQ_Module::get_by_ids( array_values( $faq_ids ) );

if ( empty( $faqs ) ) {
	echo '<p>' . esc_html__( 'No FAQs found.', 'site-essentials' ) . '</p>';
	return;
}

// Icon SVGs from design properties (set by Breakdance icon picker — admin-only).
$icon_svg        = isset( $design['item']['icon']['icon']['svgCode'] )        ? $design['item']['icon']['icon']['svgCode']        : '';
$active_icon_svg = isset( $design['item']['icon']['active_icon']['svgCode'] ) ? $design['item']['icon']['active_icon']['svgCode'] : '';

// Default chevron — matches Frequently_Asked_Questions fallback.
$default_icon = '<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 12"><path d="M.59 10.59 5.17 6 .59 1.41 2 0l6 6-6 6-1.41-1.41Z" /></svg>';

$prefix = wp_unique_id( 'scos-faq-' );

foreach ( $faqs as $index => $faq ) {
	$open       = $first_opened && ( 0 === $index );
	$btn_id     = esc_attr( $prefix . '-btn-' . $index );
	$panel_id   = esc_attr( $prefix . '-panel-' . $index );
	$item_class = 'bde-faq__item' . ( $open ? ' is-active' : '' );

	echo '<div class="' . esc_attr( $item_class ) . '">';

	if ( 'accordion' === $format ) {
		echo '<' . esc_attr( $heading_level ) . ' class="bde-faq__title-tag">';
		echo '<button type="button"'
			. ' id="' . $btn_id . '"'
			. ' aria-controls="' . $panel_id . '"'
			. ' aria-expanded="' . ( $open ? 'true' : 'false' ) . '"'
			. ' class="bde-faq__question js-faq-item">';
		echo '<span class="bde-faq__title">' . esc_html( get_the_title( $faq->ID ) ) . '</span>';

		// Icon slot — mirrors Frequently_Asked_Questions/html.twig logic.
		if ( '' === $icon_svg && '' === $active_icon_svg ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<div aria-hidden="true" class="bde-faq__icon bde-faq__icon--rotate">' . $default_icon . '</div>';
		} elseif ( '' !== $icon_svg && '' === $active_icon_svg ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<div aria-hidden="true" class="bde-faq__icon bde-faq__icon--rotate">' . $icon_svg . '</div>';
		} else {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<div aria-hidden="true" class="bde-faq__icon bde-faq__icon--inactive">' . $icon_svg . '</div>';
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<div aria-hidden="true" class="bde-faq__icon bde-faq__icon--active">' . $active_icon_svg . '</div>';
		}

		echo '</button>';
		echo '</' . esc_attr( $heading_level ) . '>';

		echo '<div role="region"'
			. ' aria-labelledby="' . $btn_id . '"'
			. ' id="' . $panel_id . '"'
			. ' class="bde-faq__answer">';
		echo '<div class="bde-faq__answer-content">';
		echo '<div class="breakdance-rich-text-styles">';
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo apply_filters( 'the_content', $faq->post_content );
		echo '</div>';
		echo '</div>';
		echo '</div>';

	} else {
		// Plain format: semantic heading + answer, no accordion behavior.
		echo '<' . esc_attr( $heading_level ) . ' class="bde-faq__title-tag bde-faq__question">'
			. esc_html( get_the_title( $faq->ID ) )
			. '</' . esc_attr( $heading_level ) . '>';
		echo '<div class="bde-faq__answer">';
		echo '<div class="bde-faq__answer-content">';
		echo '<div class="breakdance-rich-text-styles">';
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo apply_filters( 'the_content', $faq->post_content );
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}

	echo '</div>';
}
