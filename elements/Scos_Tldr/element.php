<?php
// v1.0 | 2026-05-18

namespace BreakdanceCustomElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

\Breakdance\ElementStudio\registerElementForEditing(
    "BreakdanceCustomElements\\ScosTldr",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class ScosTldr extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return 'TextIcon';
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
        return 'SCOS TLDR';
    }

    static function className()
    {
        return 'bde-scos-tldr';
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
        return false;
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
            getPresetSection(
                'EssentialElements\\simpleLayout',
                'Layout',
                'layout',
                [
                    'condition' => [[['path' => 'design.layout', 'operand' => 'is set', 'value' => '']]],
                    'type' => 'popout',
                ],
            ),
            getPresetSection(
                'EssentialElements\\LayoutV2',
                'Layout',
                'layout_v2',
                [
                    'condition' => [[['path' => 'design.layout', 'operand' => 'is not set', 'value' => '']]],
                    'type' => 'popout',
                ],
            ),
            getPresetSection(
                'EssentialElements\\LessFancyBackground',
                'Background',
                'background',
                ['type' => 'popout'],
            ),
            c(
                'container',
                'Container',
                [
                    c(
                        'width',
                        'Width',
                        [],
                        ['type' => 'unit', 'layout' => 'inline'],
                        true,
                        false,
                        [],
                    ),
                    c(
                        'min_height',
                        'Min Height',
                        [],
                        ['type' => 'unit', 'layout' => 'inline'],
                        true,
                        false,
                        [],
                    ),
                    getPresetSection(
                        'EssentialElements\\spacing_padding_all',
                        'Padding',
                        'padding',
                        ['type' => 'popout'],
                    ),
                    getPresetSection(
                        'EssentialElements\\borders',
                        'Borders',
                        'borders',
                        ['type' => 'popout'],
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
                ['type' => 'popout'],
            ),
            c(
                'typography_colors',
                'Typography Colors',
                [
                    c(
                        'heading_color',
                        'Heading Color',
                        [],
                        ['type' => 'color', 'layout' => 'inline'],
                        false,
                        false,
                        [],
                    ),
                    c(
                        'content_color',
                        'Content Color',
                        [],
                        ['type' => 'color', 'layout' => 'inline'],
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
        return 11;
    }

    static function dynamicPropertyPaths()
    {
        return false;
    }

    static function additionalClasses()
    {
        return false;
    }

    static function projectManagement()
    {
        return ['looksGood' => 'yes', 'optionsGood' => 'yes', 'optionsWork' => 'yes'];
    }

    static function propertyPathsToWhitelistInFlatProps()
    {
        return [
            'design.background.type',
            'design.layout.horizontal.vertical_at',
            'design.background.image',
            'design.background.overlay.image',
            'design.background.image_settings.unset_image_at',
            'design.background.image_settings.size',
            'design.background.image_settings.height',
            'design.background.image_settings.repeat',
            'design.background.image_settings.position',
            'design.background.image_settings.left',
            'design.background.image_settings.top',
            'design.background.image_settings.attachment',
            'design.background.image_settings.custom_position',
            'design.background.image_settings.width',
            'design.background.overlay.image_settings.custom_position',
            'design.background.image_size',
            'design.background.overlay.image_size',
            'design.background.overlay.type',
            'design.background.image_settings',
            'design.layout_v2.layout',
            'design.layout_v2.h_vertical_at',
            'design.layout_v2.h_alignment_when_vertical',
            'design.layout_v2.a_display',
        ];
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}
