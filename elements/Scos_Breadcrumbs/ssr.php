<?php
/**
 * Server-side render: MU plugin breadcrumb output.
 *
 * @var array $propertiesData
 */

if (!defined('ABSPATH')) {
    exit;
}

$html = '';

if (function_exists('bw_render_breadcrumbs')) {
    $html = bw_render_breadcrumbs();
} elseif (shortcode_exists('breadcrumbs')) {
    $html = do_shortcode('[breadcrumbs]');
} elseif (shortcode_exists('bw_breadcrumbs')) {
    $html = do_shortcode('[bw_breadcrumbs]');
}

echo $html;
