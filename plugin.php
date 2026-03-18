<?php

/**
 * Plugin Name: Brighter BD Elements
 * Plugin URI: https://breakdance.com/
 * Description: Custom elements created with Element Studio.
 * Author: Breakdance
 * Author URI: https://breakdance.com/
 * License: GPLv2
 * Text Domain: breakdance
 * Domain Path: /languages/
 * Version: 0.0.1
 */

namespace BreakdanceCustomElements;

use function Breakdance\Util\getDirectoryPathRelativeToPluginFolder;

// ─────────────────────────────────────────────────────────────────────────────
// Global Styles: CSS design tokens + selector seeding
// ─────────────────────────────────────────────────────────────────────────────
require_once __DIR__ . '/includes/class-global-styles.php';

// Register tokens and seeded selectors before WordPress fires init/wp_head.
require_once __DIR__ . '/includes/config/global-styles-config.php';

// Boot the hooks.
GlobalStyles::init();

// ─────────────────────────────────────────────────────────────────────────────

add_action('breakdance_loaded', function () {
    \Breakdance\ElementStudio\registerSaveLocation(
        getDirectoryPathRelativeToPluginFolder(__DIR__) . '/elements',
        'BreakdanceCustomElements',
        'element',
        'Custom Elements',
        false
    );

    \Breakdance\ElementStudio\registerSaveLocation(
        getDirectoryPathRelativeToPluginFolder(__DIR__) . '/macros',
        'BreakdanceCustomElements',
        'macro',
        'Custom Macros',
        false,
    );

    \Breakdance\ElementStudio\registerSaveLocation(
        getDirectoryPathRelativeToPluginFolder(__DIR__) . '/presets',
        'BreakdanceCustomElements',
        'preset',
        'Custom Presets',
        false,
    );
},
    // register elements before loading them
    9
);
