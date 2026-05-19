<?php
// v0.3.0 | 2026-05-19

/**
 * Plugin Name: Brighter BD Elements
 * Plugin URI: https://brighterwebsites.com.au/
 * Description: Custom Breakdance elements for Brighter Websites (SCOS, tables, definitions).
 * Author: Brighter Websites
 * Author URI: https://brighterwebsites.com.au/
 * License: GPLv2
 * Text Domain: breakdance
 * Domain Path: /languages/
 * Version: 0.3.0
 */

namespace BreakdanceCustomElements;

use function Breakdance\Util\getDirectoryPathRelativeToPluginFolder;

// CPT Form Submission action + admin settings
add_action('init', function () {
    if (!function_exists('\Breakdance\Forms\Actions\registerAction')) {
        return;
    }
    require_once __DIR__ . '/form-actions/CptSubmissionAction.php';
    \Breakdance\Forms\Actions\registerAction(new \BrighterElements\FormActions\CptSubmissionAction());
});

add_action('init', function () {
    if (!is_admin()) {
        return;
    }
    require_once __DIR__ . '/form-actions/CptSubmissionAdmin.php';
    (new \BrighterElements\FormActions\CptSubmissionAdmin())->init();
});

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
