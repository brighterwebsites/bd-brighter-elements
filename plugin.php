<?php
// v0.3.4 | 2026-07-02

/**
 * Plugin Name: Brighter BD Elements
 * Plugin URI: https://brighterwebsites.com.au/
 * Description: Custom Breakdance elements.
 * Author: Brighter Websites
 * Author URI: https://brighterwebsites.com.au/
 * License: GPLv2
 * Text Domain: breakdance
 * Domain Path: /languages/
 * Version: 1.0
 */

namespace BreakdanceCustomElements;

use function Breakdance\Util\getDirectoryPathRelativeToPluginFolder;

require_once __DIR__ . '/includes/class-faq-picker-options.php';
require_once __DIR__ . '/includes/class-review-picker-options.php';
require_once __DIR__ . '/includes/class-platform-picker-options.php';

// The CPT Form Submission action and its admin settings page were removed from
// this plugin — they are untracked local-only files (see .gitignore). Their
// require_once calls lived here; leaving them would fatal once the files are
// absent from a deploy. The stored option `brighter_cpt_submission_configs`
// is left in the database as a harmless orphan.

add_filter('breakdance_element_categories', function (array $categories) {
    $categories['site_essentials'] = 'Site Essentials';
    return $categories;
});

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
