<?php
// v1.0 | 2026-05-18

namespace BreakdanceCustomElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

\Breakdance\ElementStudio\registerElementForEditing(
    "BreakdanceCustomElements\\ScosBreadcrumbs",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class ScosBreadcrumbs extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return 'ChevronRightIcon';
    }

    static function tag()
    {
        return 'motion.div';
    }

    static function tagOptions()
    {
        return [];
    }

    static function tagControlPath()
    {
        return false;
    }

    static function name()
    {
        return 'SCOS Breadcrumbs';
    }

    static function className()
    {
        return 'bde-scos-breadcrumbs';
    }

    static function category()
    {
        return 'site_essentials';
    }

    static function badge()
    {
        return ['backgroundColor' => 'var(--black)', 'textColor' => 'var(--white)', 'label' => 'SCOS'];
    }

    static function slug()
    {
        return __CLASS__;
    }

    static function template()
    {
        return file_get_contents(__DIR__ . '/html.twig');
    }

    static function defaultCss()
    {
        return file_get_contents(__DIR__ . '/default.css');
    }

    static function defaultProperties()
    {
        return [
            'design' => [
                'theme' => ['preset' => 'dark'],
                'size' => [
                    'width' => [
                        'breakpoint_base' => [
                            'number' => 100,
                            'unit' => '%',
                            'style' => '100%',
                        ],
                    ],
                ],
                'list' => [
                    'list_style' => 'square',
                ],
            ],
        ];
    }

    static function defaultChildren()
    {
        return false;
    }

    static function cssTemplate()
    {
        return file_get_contents(__DIR__ . '/css.twig');
    }

    static function designControls()
    {
        return [
            c(
                'theme',
                'Theme',
                [
                    c(
                        'preset',
                        'Preset',
                        [],
                        [
                            'type' => 'dropdown',
                            'layout' => 'inline',
                            'items' => [
                                ['text' => 'Dark', 'value' => 'dark'],
                                ['text' => 'Light', 'value' => 'light'],
                                ['text' => 'Custom', 'value' => 'custom'],
                            ],
                        ],
                        false,
                        false,
                        [],
                    ),
                ],
                ['type' => 'section', 'layout' => 'vertical'],
                false,
                false,
                [],
            ),
            c(
                'size',
                'Size',
                [
                    c(
                        'width',
                        'Width',
                        [],
                        [
                            'type' => 'unit',
                            'layout' => 'inline',
                            'rangeOptions' => ['min' => 0, 'max' => 1200, 'step' => 1],
                            'unitOptions' => ['types' => ['%', 'px', 'vw'], 'defaultType' => '%'],
                        ],
                        true,
                        false,
                        [],
                    ),
                ],
                ['type' => 'section'],
                false,
                false,
                [],
            ),
            getPresetSection(
                'EssentialElements\\typography_with_effects_and_align',
                'Typography',
                'typography',
                [
                    'type' => 'popout',
                    'condition' => [[['path' => 'design.theme.preset', 'operand' => 'equals', 'value' => 'custom']]],
                ],
            ),
            c(
                'links',
                'Links',
                [
                    c(
                        'color',
                        'Color',
                        [],
                        ['type' => 'color', 'layout' => 'inline'],
                        false,
                        false,
                        [],
                    ),
                    c(
                        'color_hover',
                        'Hover Color',
                        [],
                        ['type' => 'color', 'layout' => 'inline'],
                        false,
                        true,
                        [],
                    ),
                ],
                ['type' => 'section'],
                false,
                false,
                [],
            ),
            c(
                'list',
                'List',
                [
                    c(
                        'marker_color',
                        'Marker Color',
                        [],
                        ['type' => 'color', 'layout' => 'inline'],
                        false,
                        false,
                        [],
                    ),
                    c(
                        'list_style',
                        'List Style',
                        [],
                        [
                            'type' => 'dropdown',
                            'layout' => 'inline',
                            'items' => [
                                ['text' => 'Square', 'value' => 'square'],
                                ['text' => 'Disc', 'value' => 'disc'],
                                ['text' => 'Circle', 'value' => 'circle'],
                                ['text' => 'None', 'value' => 'none'],
                            ],
                        ],
                        false,
                        false,
                        [],
                    ),
                ],
                ['type' => 'section'],
                false,
                false,
                [],
            ),
            getPresetSection(
                'EssentialElements\\spacing_margin_y',
                'Spacing',
                'spacing',
                ['type' => 'popout'],
            ),
        ];
    }

    static function contentControls()
    {
        return [];
    }

    static function settingsControls()
    {
        return [];
    }

    static function dependencies()
    {
        return false;
    }

    static function settings()
    {
        return false;
    }

    static function addPanelRules()
    {
        return false;
    }

    static public function actions()
    {
        return false;
    }

    static function nestingRule()
    {
        return ['type' => 'final'];
    }

    static function spacingBars()
    {
        return [
            [
                'location' => 'outside-top',
                'cssProperty' => 'margin-top',
                'affectedPropertyPath' => 'design.spacing.margin_top.%%BREAKPOINT%%',
            ],
            [
                'location' => 'outside-bottom',
                'cssProperty' => 'margin-bottom',
                'affectedPropertyPath' => 'design.spacing.margin_bottom.%%BREAKPOINT%%',
            ],
        ];
    }

    static function attributes()
    {
        return false;
    }

    static function experimental()
    {
        return false;
    }

    static function availableIn()
    {
        return ['breakdance'];
    }

    static function order()
    {
        return 10;
    }

    static function dynamicPropertyPaths()
    {
        return false;
    }

    static function additionalClasses()
    {
        return [
            [
                'name' => 'bde-scos-breadcrumbs--theme-dark',
                'template' => "{{ design.theme.preset == 'dark' }}",
            ],
            [
                'name' => 'bde-scos-breadcrumbs--theme-light',
                'template' => "{{ design.theme.preset == 'light' }}",
            ],
            [
                'name' => 'bde-scos-breadcrumbs--theme-custom',
                'template' => "{{ design.theme.preset == 'custom' }}",
            ],
        ];
    }

    static function projectManagement()
    {
        return ['looksGood' => 'yes', 'optionsGood' => 'yes', 'optionsWork' => 'yes'];
    }

    static function propertyPathsToWhitelistInFlatProps()
    {
        return false;
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}
