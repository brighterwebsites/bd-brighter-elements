<?php
/**
 * Server-side render: MU plugin TLDR output. Empty when no field value.
 *
 * @var array $propertiesData
 */

if (!defined('ABSPATH')) {
    exit;
}

$html = '';

if (shortcode_exists('tldr')) {
    $html = do_shortcode('[tldr]');
}

echo $html;
