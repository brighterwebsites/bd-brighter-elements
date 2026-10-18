<?php
// v1.0 | 2026-10-18

namespace BrighterElements;

/**
 * Where an element's ssr.php is running.
 *
 * Breakdance defines no BREAKDANCE_BUILDER constant, so checks against it were
 * always false. The builder renders SSR elements through the
 * `breakdance_server_side_render` AJAX action (or inside the builder iframe);
 * Breakdance's own helpers detect both.
 *
 * Any other AJAX request that renders a template must not echo placeholders:
 * Breakdance's AJAX handler rejects stray output ("Unexpected output during
 * AJAX request").
 */
class Builder_Context {

    /** True while rendering for the Breakdance builder (SSR preview or iframe). */
    public static function is_builder(): bool {
        if ( function_exists( 'Breakdance\\isRequestFromBuilderSsr' ) && \Breakdance\isRequestFromBuilderSsr() ) {
            return true;
        }
        return function_exists( 'Breakdance\\isRequestFromBuilderIframe' ) && \Breakdance\isRequestFromBuilderIframe();
    }

    /** True for a real visitor page view: not the builder, not AJAX, REST or cron. */
    public static function is_front_end(): bool {
        if ( self::is_builder() || wp_doing_ajax() || wp_doing_cron() ) {
            return false;
        }
        return ! ( defined( 'REST_REQUEST' ) && REST_REQUEST );
    }
}
