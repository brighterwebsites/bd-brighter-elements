<?php

/**
 * Global Styles: CSS Design Tokens + Selector Seeding for Breakdance
 *
 * This class does two things:
 *
 * 1. DESIGN TOKENS — outputs a <style> block with CSS custom properties on :root
 *    so they are available site-wide as variables (e.g. var(--spacing-sm)).
 *
 * 2. SELECTOR SEEDING — outputs an empty CSS rule for every seeded selector
 *    (e.g. `.ga-hrcy-atif {}`) so Breakdance does not mark them as "ghosted"
 *    when they are assigned to an element but the CSS was removed.
 *    It also (on first run) attempts to inject them into Breakdance's own
 *    global selector store so they appear in the Selectors panel.
 */

namespace BreakdanceCustomElements;

class GlobalStyles {

    /** @var array<string,string>  name => value pairs for CSS custom properties */
    private static array $tokens = [];

    /** @var string[]  CSS selectors to keep alive in the output */
    private static array $selectors = [];

    // -------------------------------------------------------------------------
    // Initialise
    // -------------------------------------------------------------------------

    public static function init(): void {
        // Output our <style> block as early as possible in <head>.
        add_action('wp_head',    [self::class, 'outputStyles'], 1);
        add_action('admin_head', [self::class, 'outputStyles'], 1);

        // Breakdance renders its own CSS; piggy-back on that too so the
        // selectors are always present when Breakdance scans its output.
        add_filter('breakdance_head_css', [self::class, 'appendToBreakdanceCSS']);

        // Try to seed Breakdance's selector store once.
        add_action('init', [self::class, 'seedBreakdanceSelectors'], 20);
    }

    // -------------------------------------------------------------------------
    // Registration helpers — call these from plugin.php before init fires
    // -------------------------------------------------------------------------

    /**
     * Register a single CSS custom property.
     *
     * @param string $name  The full variable name, e.g. '--spacing-sm'
     *                      or just 'spacing-sm' (-- is prepended automatically).
     * @param string $value e.g. '10px', '#ff0000', '1.5rem'
     */
    public static function token(string $name, string $value): void {
        if (strpos($name, '--') !== 0) {
            $name = '--' . $name;
        }
        self::$tokens[$name] = $value;
    }

    /**
     * Register a group of tokens with a shared prefix.
     *
     * Example:
     *   GlobalStyles::tokenGroup('spacing', ['sm' => '10px', 'md' => '20px']);
     *   → --spacing-sm: 10px; --spacing-md: 20px;
     *
     * @param array<string,string> $tokens
     */
    public static function tokenGroup(string $prefix, array $tokens): void {
        foreach ($tokens as $name => $value) {
            self::token("{$prefix}-{$name}", $value);
        }
    }

    /**
     * Register one or more CSS selectors to keep alive (prevent ghosting).
     *
     * @param string|string[] $selectors
     */
    public static function seedSelector($selectors): void {
        foreach ((array) $selectors as $selector) {
            self::$selectors[] = $selector;
        }
    }

    // -------------------------------------------------------------------------
    // CSS output
    // -------------------------------------------------------------------------

    /**
     * Emits a <style> block containing:
     *  - :root { … CSS custom properties … }
     *  - one empty rule per seeded selector
     */
    public static function outputStyles(): void {
        $css = self::buildCSS();
        if ($css === '') {
            return;
        }
        echo "\n<style id=\"brighter-global-styles\">\n{$css}</style>\n";
    }

    /**
     * Filter callback: append our CSS to whatever Breakdance already outputs.
     *
     * @param string $existing
     * @return string
     */
    public static function appendToBreakdanceCSS(string $existing): string {
        return $existing . "\n" . self::buildCSS();
    }

    // -------------------------------------------------------------------------
    // Breakdance selector store
    // -------------------------------------------------------------------------

    /**
     * Attempt to seed Breakdance's own selector panel database so the
     * selectors show up in the "Selectors" list without having to add
     * them manually.
     *
     * Breakdance stores global CSS rules in the WordPress options table under
     * the key 'breakdance_global_css'.  Each entry is an array with at least:
     *   [ 'selector' => '.my-class', 'css' => '' ]
     *
     * We only add selectors that are not already stored.
     *
     * NOTE: this option key is reverse-engineered from Breakdance's behaviour;
     * if Breakdance changes its internals the key may differ.  The CSS output
     * (outputStyles / appendToBreakdanceCSS) works regardless.
     */
    public static function seedBreakdanceSelectors(): void {
        if (empty(self::$selectors)) {
            return;
        }

        // Bail if we are not in the admin — seeding only needs to happen once.
        // (Remove this guard if you want to seed on every front-end request too.)
        if (!is_admin()) {
            return;
        }

        $option_key = 'breakdance_global_css';
        $stored     = get_option($option_key, []);

        if (!is_array($stored)) {
            $stored = [];
        }

        // Build a lookup of already-stored selectors for fast deduplication.
        $existing = [];
        foreach ($stored as $entry) {
            if (!empty($entry['selector'])) {
                $existing[$entry['selector']] = true;
            }
        }

        $changed = false;
        foreach (self::$selectors as $selector) {
            if (isset($existing[$selector])) {
                continue;
            }
            // Add a minimal entry: selector with an empty rule body.
            // Breakdance will render this as:  .selector {}
            // which is enough to prevent the "no longer present" ghost warning.
            $stored[]          = ['selector' => $selector, 'css' => ''];
            $existing[$selector] = true;
            $changed           = true;
        }

        if ($changed) {
            update_option($option_key, $stored, false);
        }
    }

    // -------------------------------------------------------------------------
    // Internal helpers
    // -------------------------------------------------------------------------

    private static function buildCSS(): string {
        $css = '';

        if (!empty(self::$tokens)) {
            $css .= ":root {\n";
            foreach (self::$tokens as $property => $value) {
                // Basic sanitisation — strip anything that could break the block.
                $property = preg_replace('/[^a-zA-Z0-9\-_]/', '', $property);
                $value    = str_replace(["\n", "\r", '</'], '', $value);
                $css .= "  {$property}: {$value};\n";
            }
            $css .= "}\n";
        }

        if (!empty(self::$selectors)) {
            foreach (self::$selectors as $selector) {
                // Only allow characters that are valid in a CSS selector.
                // Adjust the regex if you need attribute selectors, pseudo-classes, etc.
                $safe = preg_replace('/[^a-zA-Z0-9\s\-_#.:,>+~\[\]="\'*^$|()%]/', '', $selector);
                if ($safe !== '') {
                    $css .= "{$safe} {}\n";
                }
            }
        }

        return $css;
    }
}
