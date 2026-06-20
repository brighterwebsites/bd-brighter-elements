<?php
/**
 * Server-side render: SCOS Review Card
 *
 * $render_card() builds HTML via its own ob_start/ob_get_clean and returns a
 * string. The dispatch section then echoes that string at the TOP LEVEL of
 * ssr.php. This mirrors the pattern used by the old working do_shortcode path
 * (render() → ob_start → ob_get_clean → return → top-level echo) and ensures
 * Breakdance's SSR ob_start capture layer receives a simple top-level echo
 * rather than output originating from deep inside a closure call stack, which
 * LiteSpeed PHP 8.0 does not reliably buffer.
 *
 * @var array $propertiesData
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ─── Parse properties ─────────────────────────────────────────────────────────

$content = isset( $propertiesData['content'] ) && is_array( $propertiesData['content'] )
	? $propertiesData['content']
	: [];

$mode      = (string) ( $content['source']['mode'] ?? 'loop' );
$review_id = absint( $content['source']['review_id'] ?? 0 );
$layout    = (string) ( $content['display']['layout'] ?? 'stacked' );

if ( ! in_array( $layout, [ 'stacked', 'horizontal', 'quote', 'hero' ], true ) ) {
	$layout = 'stacked';
}

$fields  = is_array( $content['fields']  ?? null ) ? $content['fields']  : [];
$project = is_array( $content['project'] ?? null ) ? $content['project'] : [];

$bool = static function ( $val, bool $default = true ): bool {
	if ( $val === null || $val === '' ) {
		return $default;
	}
	return (bool) $val;
};

$show = [
	'rating'        => $bool( $fields['show_rating']        ?? null ),
	'excerpt'       => $bool( $fields['show_excerpt']       ?? null ),
	'full_text'     => $bool( $fields['show_full_text']     ?? null, false ),
	'outcome'       => $bool( $fields['show_outcome']       ?? null ),
	'name'          => $bool( $fields['show_name']          ?? null ),
	'detail'        => $bool( $fields['show_detail']        ?? null ),
	'date'          => $bool( $fields['show_date']          ?? null ),
	'platform'      => $bool( $fields['show_platform']      ?? null ),
	'verify'        => $bool( $fields['show_verify']        ?? null ),
	'featured'      => $bool( $fields['show_featured']      ?? null, false ),
	'platform_icon' => $bool( $fields['show_platform_icon'] ?? null ),
	'proj_image'    => $bool( $project['show_image']        ?? null ),
	'proj_name'     => $bool( $project['show_name']         ?? null ),
	'proj_link'     => $bool( $project['show_link']         ?? null ),
];

// ─── Stars helper (returns string, no output) ─────────────────────────────────

$render_stars = static function ( int $rating ): string {
	$rating   = max( 1, min( 5, $rating ) );
	$svg_path = 'M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z';
	$star_svg = '<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="' . $svg_path . '"/></svg>';
	$out      = '<div class="bde-review-card__stars-inner">';
	for ( $i = 1; $i <= 5; $i++ ) {
		$state = ( $i <= $rating ) ? 'filled' : 'empty';
		$out  .= '<span class="bde-review-card__star bde-review-card__star--' . $state . '">' . $star_svg . '</span>';
	}
	return $out . '</div>';
};

// ─── Date formatter (returns string, no output) ───────────────────────────────

$format_date = static function ( string $raw, string $precision ): string {
	if ( ! $raw ) {
		return '';
	}
	$ts = strtotime( $raw );
	if ( ! $ts ) {
		return esc_html( $raw );
	}
	switch ( $precision ) {
		case 'year':       return date_i18n( 'Y', $ts );
		case 'month-year': return date_i18n( 'F Y', $ts );
		default:           return date_i18n( get_option( 'date_format' ), $ts );
	}
};

// ─── Single card — builds and returns HTML string (never echoes directly) ────
// Top-level echo in the dispatch section ensures output hits Breakdance's ob
// capture layer rather than being lost inside a closure call stack.

$render_card = static function ( int $id ) use ( $show, $layout, $render_stars, $format_date ): string {
	$post = get_post( $id );
	if ( ! $post || $post->post_type !== 'bw_reviews' ) {
		return '';
	}

	// Data — get_post_meta only, no ACF get_field() to avoid side effects
	$rating          = (int) get_post_meta( $id, 'bw_rating', true );
	$raw_date        = (string) get_post_meta( $id, 'bw_date', true );
	$precision       = (string) ( get_post_meta( $id, 'bw_date_precision', true ) ?: 'full' );
	$excerpt_meta    = (string) get_post_meta( $id, 'bw_review_excerpt', true );
	$excerpt         = $excerpt_meta ?: wp_trim_words( wp_strip_all_tags( $post->post_content ), 25, '&hellip;' );
	$outcome         = (string) get_post_meta( $id, 'bw_success_outcome', true );
	$customer_name   = (string) get_the_title( $id );
	$customer_detail = (string) get_post_meta( $id, 'bw_customer_detail', true );
	$verify_url      = (string) get_post_meta( $id, 'bw_verify_url', true );
	$is_featured     = get_post_meta( $id, 'bw_is_featured', true ) === '1';
	$project_id      = (int) get_post_meta( $id, 'bw_related_project', true );
	$date_str        = $format_date( $raw_date, $precision );

	$platform_name    = '';
	$platform_slug    = '';
	$platform_logo_id = 0;
	$platforms        = get_the_terms( $id, 'bw_review_platform' );
	if ( $platforms && ! is_wp_error( $platforms ) ) {
		$platform_name    = (string) $platforms[0]->name;
		$platform_slug    = (string) $platforms[0]->slug;
		$platform_logo_id = absint( get_term_meta( $platforms[0]->term_id, 'bw_platform_logo_id', true ) );
	}

	$project_title    = $project_id ? (string) get_the_title( $project_id ) : '';
	$project_url      = $project_id ? (string) get_permalink( $project_id ) : '';
	$project_thumb_id = $project_id ? (int) get_post_thumbnail_id( $project_id ) : 0;
	$has_project      = $project_id && $project_title && ( $show['proj_image'] || $show['proj_name'] );
	$has_proj_image   = $has_project && $show['proj_image'] && $project_thumb_id;

	// Capture all output into a buffer and return as string.
	// The caller (dispatch) is responsible for echoing the return value at the
	// top level of ssr.php — this is what Breakdance's ob_start layer captures.
	ob_start();

	echo '<div class="bde-review-card bde-review-card--layout-' . esc_attr( $layout ) . '">';

	if ( $show['featured'] && $is_featured ) {
		echo '<span class="bde-review-card__featured-badge">' . esc_html__( 'Featured', 'site-essentials' ) . '</span>';
	}

	if ( $show['platform_icon'] && $platform_logo_id ) {
		$logo_url = (string) wp_get_attachment_image_url( $platform_logo_id, 'full' );
		if ( $logo_url ) {
			echo '<div class="bde-review-card__platform-icon">'
				. '<img src="' . esc_url( $logo_url ) . '" alt="' . esc_attr( $platform_name ) . '" class="bde-review-card__platform-icon-img" loading="lazy">'
				. '</div>';
		}
	}

	if ( $show['rating'] && $rating ) {
		echo '<div class="bde-review-card__stars" aria-label="' . esc_attr( $rating . ' out of 5 stars' ) . '" role="img">'
			. $render_stars( $rating ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			. '</div>';
	}

	if ( $show['excerpt'] && $excerpt ) {
		echo '<div class="bde-review-card__quote">'
			. '<p class="bde-review-card__quote-text">' . esc_html( $excerpt ) . '</p>'
			. '</div>';
	}

	if ( $show['full_text'] && ! $show['excerpt'] && $post->post_content ) {
		echo '<div class="bde-review-card__full-text">'
			. wp_kses_post( wpautop( do_shortcode( $post->post_content ) ) ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			. '</div>';
	}

	if ( $show['outcome'] && $outcome ) {
		echo '<p class="bde-review-card__outcome">' . esc_html( $outcome ) . '</p>';
	}

	if ( ( $show['name'] && $customer_name ) || ( $show['detail'] && $customer_detail ) ) {
		echo '<div class="bde-review-card__author">';
		if ( $show['name'] && $customer_name ) {
			echo '<strong class="bde-review-card__name">' . esc_html( $customer_name ) . '</strong>';
		}
		if ( $show['detail'] && $customer_detail ) {
			echo '<span class="bde-review-card__detail">' . esc_html( $customer_detail ) . '</span>';
		}
		echo '</div>';
	}

	if ( ( $show['platform'] && $platform_name ) || ( $show['date'] && $date_str ) || ( $show['verify'] && $verify_url ) ) {
		echo '<div class="bde-review-card__meta">';
		if ( $show['platform'] && $platform_name ) {
			echo '<span class="bde-review-card__platform bde-review-card__platform--' . esc_attr( $platform_slug ) . '">' . esc_html( $platform_name ) . '</span>';
		}
		if ( $show['date'] && $date_str ) {
			echo '<time class="bde-review-card__date" datetime="' . esc_attr( $raw_date ) . '">' . esc_html( $date_str ) . '</time>';
		}
		if ( $show['verify'] && $verify_url ) {
			echo '<a class="bde-review-card__verify" href="' . esc_url( $verify_url ) . '" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Verify review', 'site-essentials' ) . '</a>';
		}
		echo '</div>';
	}

	if ( $has_project ) {
		echo '<div class="bde-review-card__project-meta">';
		if ( $show['proj_name'] && $project_title ) {
			if ( $show['proj_link'] && $project_url ) {
				echo '<a class="bde-review-card__project-link" href="' . esc_url( $project_url ) . '">' . esc_html( $project_title ) . '</a>';
			} else {
				echo '<span class="bde-review-card__project-name">' . esc_html( $project_title ) . '</span>';
			}
		}
		echo '</div>';
	}

	if ( $has_proj_image ) {
		$img_url = (string) wp_get_attachment_image_url( $project_thumb_id, 'medium_large' );
		if ( $img_url ) {
			echo '<div class="bde-review-card__media">'
				. '<img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $project_title ) . '" class="bde-review-card__project-img" loading="lazy">'
				. '</div>';
		}
	}

	echo '</div>';

	return (string) ob_get_clean();
};

// ─── Mode dispatch ────────────────────────────────────────────────────────────

// DISABLED: connected mode temporarily removed for SSR isolation testing.
// Suspected cause of AJAX output leak — WP_Query in a global block renders
// on every page load, including during Breakdance SSR AJAX requests for
// other elements. Will be re-enabled or moved to a separate element once
// specific/loop modes are confirmed clean.
if ( 'connected' === $mode ) {
	echo '<div class="bde-scos-review-card__placeholder">' . esc_html__( '[Connected mode temporarily disabled — use Specific mode.]', 'site-essentials' ) . '</div>';
	return;
}

if ( 'specific' === $mode ) {
	if ( ! $review_id ) {
		echo '<div class="bde-scos-review-card__placeholder">' . esc_html__( 'Select a review in the sidebar.', 'site-essentials' ) . '</div>';
		return;
	}
	echo $render_card( $review_id ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	return;
}

// Loop mode (default): current bw_reviews post in a Breakdance loop.
echo $render_card( (int) get_the_ID() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
