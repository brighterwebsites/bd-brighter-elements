<?php
// v1.1 | 2026-06-20
//
// SCOS Aggregate Review — displays aggregate rating widget for bw_reviews.
//
// Layouts:
//   simple        — "[avg] From [count] Reviews" text
//   google-simple — platform logo + stars
//   google-full   — platform logo + stars + business name + reviews link
//
// Rendering delegated to [bw_aggregate_review] → Aggregate_Review_Renderer (site-essentials).

namespace BreakdanceCustomElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;
use BrighterElements\Platform_Picker_Options;

\Breakdance\ElementStudio\registerElementForEditing(
    'BreakdanceCustomElements\\ScosAggregateReview',
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder( __DIR__ )
);

class ScosAggregateReview extends \Breakdance\Elements\Element {

    static function uiIcon() {
        return 'StarIcon';
    }

    static function tag() {
        return 'div';
    }

    static function tagOptions() {
        return [];
    }

    static function tagControlPath() {
        return false;
    }

    static function name() {
        return 'SCOS Aggregate Review';
    }

    static function className() {
        return 'bde-scos-aggregate-review-wrapper';
    }

    static function category() {
        return 'other';
    }

    static function badge() {
        return [ 'backgroundColor' => 'var(--black)', 'textColor' => 'var(--white)', 'label' => 'SCOS' ];
    }

    static function slug() {
        return __CLASS__;
    }

    static function template() {
        return file_get_contents( __DIR__ . '/html.twig' );
    }

    static function defaultCss() {
        return file_get_contents( __DIR__ . '/default.css' );
    }

    static function defaultProperties() {
        return [
            'content' => [
                'display' => [
                    'layout'   => 'google-full',
                    'platform' => 'google',
                ],
                'link' => [
                    'reviews_url' => '',
                ],
                'show' => [
                    'icon'  => true,
                    'stars' => true,
                    'name'  => true,
                    'link'  => true,
                ],
            ],
        ];
    }

    static function defaultChildren() {
        return false;
    }

    static function cssTemplate() {
        return file_get_contents( __DIR__ . '/css.twig' );
    }

    // =========================================================================
    // DESIGN CONTROLS
    // =========================================================================

    static function designControls() {
        return [
            getPresetSection(
                'EssentialElements\\simpleLayout',
                'Layout',
                'layout',
                [
                    'condition' => [ [ [ 'path' => 'design.layout', 'operand' => 'is set', 'value' => '' ] ] ],
                    'type'      => 'popout',
                ],
            ),
            getPresetSection(
                'EssentialElements\\LayoutV2',
                'Layout',
                'layout_v2',
                [
                    'condition' => [ [ [ 'path' => 'design.layout', 'operand' => 'is not set', 'value' => '' ] ] ],
                    'type'      => 'popout',
                ],
            ),
            getPresetSection( 'EssentialElements\\LessFancyBackground', 'Background', 'background', [ 'type' => 'popout' ] ),
            c(
                'container',
                'Container',
                [
                    getPresetSection( 'EssentialElements\\spacing_padding_all', 'Padding', 'padding', [ 'type' => 'popout' ] ),
                    getPresetSection( 'EssentialElements\\borders', 'Borders', 'borders', [ 'type' => 'popout' ] ),
                ],
                [ 'type' => 'section' ],
                false,
                false,
                [],
            ),
            c(
                'platform_icon',
                'Platform Icon',
                [
                    c(
                        'size',
                        'Width',
                        [],
                        [ 'type' => 'unit', 'layout' => 'inline', 'unitOptions' => [ 'types' => [ 'px', 'rem', 'em' ], 'defaultType' => 'px' ] ],
                        true,
                        false,
                        [],
                    ),
                ],
                [ 'type' => 'section' ],
                false,
                false,
                [],
            ),
            c(
                'stars',
                'Stars',
                [
                    c(
                        'size',
                        'Star Size',
                        [],
                        [ 'type' => 'unit', 'layout' => 'inline', 'unitOptions' => [ 'types' => [ 'px', 'rem', 'em' ], 'defaultType' => 'em' ] ],
                        true,
                        false,
                        [],
                    ),
                    c(
                        'color_filled',
                        'Star Color',
                        [],
                        [ 'type' => 'color', 'layout' => 'inline' ],
                        false,
                        false,
                        [],
                    ),
                ],
                [ 'type' => 'section' ],
                false,
                false,
                [],
            ),
            c(
                'text',
                'Text',
                [
                    c( 'color',      'Text Color',  [], [ 'type' => 'color', 'layout' => 'inline' ], false, false, [] ),
                    c( 'link_color', 'Link Color',  [], [ 'type' => 'color', 'layout' => 'inline' ], false, false, [] ),
                    getPresetSection(
                        'EssentialElements\\typography_with_effects_and_align',
                        'Typography',
                        'typography',
                        [ 'type' => 'popout' ],
                    ),
                ],
                [ 'type' => 'section' ],
                false,
                false,
                [],
            ),
            getPresetSection( 'EssentialElements\\spacing_margin_y', 'Spacing', 'spacing', [ 'type' => 'popout' ] ),
        ];
    }

    // =========================================================================
    // CONTENT CONTROLS
    // =========================================================================

    static function contentControls() {
        return [
            c(
                'display',
                'Display',
                [
                    c(
                        'layout',
                        'Layout',
                        [],
                        [
                            'type'        => 'dropdown',
                            'layout'      => 'vertical',
                            'description' => 'Simple: text only. Google Simple: logo + stars. Google Full: logo + stars + business name + link.',
                            'items'       => [
                                [ 'text' => 'Simple',        'value' => 'simple' ],
                                [ 'text' => 'Google Simple', 'value' => 'google-simple' ],
                                [ 'text' => 'Google Full',   'value' => 'google-full' ],
                            ],
                        ],
                        false,
                        false,
                        [],
                    ),
                    c(
                        'platform',
                        'Platform',
                        [],
                        [
                            'type'        => 'dropdown',
                            'layout'      => 'vertical',
                            'items'       => Platform_Picker_Options::dropdown_items(),
                            'description' => 'Filters count and average to this platform. Also sources the logo. List refreshes on builder reload.',
                            'condition'   => [ [ [ 'path' => '%%CURRENTPATH%%.layout', 'operand' => 'not equals', 'value' => 'simple' ] ] ],
                        ],
                        false,
                        false,
                        [],
                    ),
                ],
                [ 'type' => 'section', 'layout' => 'vertical' ],
                false,
                false,
                [],
            ),
            c(
                'show',
                'Visibility',
                [
                    c( 'icon',  'Platform icon',  [], [ 'type' => 'toggle', 'layout' => 'inline', 'condition' => [ [ [ 'path' => 'content.display.layout', 'operand' => 'not equals', 'value' => 'simple' ] ] ] ], false, false, [] ),
                    c( 'stars', 'Stars',           [], [ 'type' => 'toggle', 'layout' => 'inline', 'condition' => [ [ [ 'path' => 'content.display.layout', 'operand' => 'not equals', 'value' => 'simple' ] ] ] ], false, false, [] ),
                    c( 'name',  'Business name',   [], [ 'type' => 'toggle', 'layout' => 'inline', 'condition' => [ [ [ 'path' => 'content.display.layout', 'operand' => 'equals', 'value' => 'google-full' ] ] ] ], false, false, [] ),
                    c( 'link',  'Reviews link',    [], [ 'type' => 'toggle', 'layout' => 'inline', 'condition' => [ [ [ 'path' => 'content.display.layout', 'operand' => 'equals', 'value' => 'google-full' ] ] ] ], false, false, [] ),
                ],
                [ 'type' => 'section', 'layout' => 'vertical' ],
                false,
                false,
                [],
            ),
            c(
                'link',
                'Link',
                [
                    c(
                        'reviews_url',
                        'Reviews URL',
                        [],
                        [
                            'type'        => 'text',
                            'layout'      => 'vertical',
                            'description' => 'URL for the reviews link (e.g. your Google Business profile). Leave empty to show text without a link.',
                        ],
                        false,
                        false,
                        [],
                    ),
                ],
                [
                    'type'      => 'section',
                    'layout'    => 'vertical',
                    'condition' => [ [ [ 'path' => 'content.display.layout', 'operand' => 'equals', 'value' => 'google-full' ] ] ],
                ],
                false,
                false,
                [],
            ),
        ];
    }

    static function settingsControls() {
        return [];
    }

    static function dependencies() {
        return false;
    }

    static function settings() {
        return false;
    }

    static function addPanelRules() {
        return false;
    }

    static public function actions() {
        return false;
    }

    static function nestingRule() {
        return [ 'type' => 'final' ];
    }

    static function spacingBars() {
        return [
            [ 'location' => 'outside-top',    'cssProperty' => 'margin-top',    'affectedPropertyPath' => 'design.spacing.margin_top.%%BREAKPOINT%%' ],
            [ 'location' => 'outside-bottom', 'cssProperty' => 'margin-bottom', 'affectedPropertyPath' => 'design.spacing.margin_bottom.%%BREAKPOINT%%' ],
        ];
    }

    static function attributes() {
        return false;
    }

    static function experimental() {
        return false;
    }

    static function availableIn() {
        return [ 'breakdance' ];
    }

    static function order() {
        return 21;
    }

    static function dynamicPropertyPaths() {
        return false;
    }

    static function additionalClasses() {
        return false;
    }

    static function projectManagement() {
        return [ 'looksGood' => 'yes', 'optionsGood' => 'yes', 'optionsWork' => 'yes' ];
    }

    static function propertyPathsToWhitelistInFlatProps() {
        return false;
    }

    static function propertyPathsToSsrElementWhenValueChanges() {
        return [
            'content.display.layout',
            'content.display.platform',
            'content.link.reviews_url',
            'content.show.icon',
            'content.show.stars',
            'content.show.name',
            'content.show.link',
        ];
    }
}
