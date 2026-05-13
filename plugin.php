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
