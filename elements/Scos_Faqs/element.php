<?php
// v1.1 | 2026-05-19
//
// SCOS FAQs — Breakdance element that renders FAQs from the Site Essentials
// FAQ submodule. Delegates rendering to the `[faqs]` shortcode (so the same
// markup, accordion behaviour, and FAQPage schema graph integration that the
// Gutenberg block uses applies here too).
//
// Two modes:
//   - selector: editor picks specific FAQs by post ID via a repeater.
//   - topic:    editor enters a scos_topic slug; every FAQ tagged with it renders.
//
// Property path layout (must match contentControls section nesting):
//   content.faq_source.mode
//   content.faq_source.selected_faqs[].id
//   content.faq_source.topic_slug
//   content.display.format
//   content.display.heading
//   content.display.schema_enabled
//
// Schema is contributed to the unified site `@graph` by
// site-essentials/Modules/CustomPosts/FAQ/FAQ_Schema_Graph.php — that class
// walks `_breakdance_data` looking for nodes of type
// `BreakdanceCustomElements\ScosFaqs`. The slug string and property paths
// here MUST stay in sync with FAQ_Schema_Graph::walk_bd_tree() on the MU
// plugin side, plus Content_Analysis::bd_tree_has_scos_faqs().

namespace BreakdanceCustomElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

\Breakdance\ElementStudio\registerElementForEditing(
    "BreakdanceCustomElements\\ScosFaqs",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class ScosFaqs extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return 'TextIcon';
    }

    static function tag()
    {
        return 'div';
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
        return 'SCOS FAQs';
    }

    static function className()
    {
        return 'bde-scos-faqs';
    }

    static function category()
    {
        // Custom categories don't render in the sidebar Add panel — Scos_Tldr
        // and Scos_Breadcrumbs use 'basic' for the same reason.
        return 'Site Essentials';
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
        // Section IDs in contentControls (`faq_source`, `display`) become
        // segments in the property path — defaults MUST mirror that nesting
        // or BD will silently ignore them.
        return [
            'content' => [
                'faq_source' => [
                    'mode' => 'selector',
                ],
                'display' => [
                    'format'         => 'accordion',
                    'heading'        => 'h3',
                    'schema_enabled' => true,
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
            getPresetSection(
                'EssentialElements\\simpleLayout',
                'Layout',
                'layout',
                [
                    'condition' => [[['path' => 'design.layout', 'operand' => 'is set', 'value' => '']]],
                    'type'      => 'popout',
                ],
            ),
            getPresetSection(
                'EssentialElements\\LayoutV2',
                'Layout',
                'layout_v2',
                [
                    'condition' => [[['path' => 'design.layout', 'operand' => 'is not set', 'value' => '']]],
                    'type'      => 'popout',
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
                        'question_color',
                        'Question Color',
                        [],
                        ['type' => 'color', 'layout' => 'inline'],
                        false,
                        false,
                        [],
                    ),
                    c(
                        'answer_color',
                        'Answer Color',
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
        return [
            c(
                'faq_source',
                'FAQ Source',
                [
                    c(
                        'mode',
                        'Source Mode',
                        [],
                        [
                            'type'   => 'dropdown',
                            'layout' => 'vertical',
                            'items'  => [
                                ['text' => 'Selected FAQs', 'value' => 'selector'],
                                ['text' => 'By Topic',      'value' => 'topic'],
                            ],
                        ],
                        false,
                        false,
                        [],
                    ),
                    c(
                        'selected_faqs',
                        'Selected FAQs',
                        [
                            c(
                                'id',
                                'FAQ ID',
                                [],
                                [
                                    'type'        => 'number',
                                    'layout'      => 'vertical',
                                    'description' => 'Enter the FAQ post ID. You can find IDs in the FAQs admin list URL.',
                                ],
                                false,
                                false,
                                [],
                            ),
                        ],
                        [
                            'type'      => 'repeater',
                            'layout'    => 'vertical',
                            'condition' => [[['path' => '%%CURRENTPATH%%.mode', 'operand' => 'equals', 'value' => 'selector']]],
                        ],
                        false,
                        false,
                        [],
                    ),
                    c(
                        'topic_slug',
                        'Topic Slug',
                        [],
                        [
                            'type'        => 'text',
                            'layout'      => 'vertical',
                            'description' => 'scos_topic slug, e.g. pricing. Renders every published FAQ assigned to this topic.',
                            'condition'   => [[['path' => '%%CURRENTPATH%%.mode', 'operand' => 'equals', 'value' => 'topic']]],
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
                'display',
                'Display',
                [
                    c(
                        'format',
                        'Format',
                        [],
                        [
                            'type'   => 'dropdown',
                            'layout' => 'inline',
                            'items'  => [
                                ['text' => 'Accordion', 'value' => 'accordion'],
                                ['text' => 'Plain',     'value' => 'plain'],
                            ],
                        ],
                        false,
                        false,
                        [],
                    ),
                    c(
                        'heading',
                        'Heading Level',
                        [],
                        [
                            'type'      => 'dropdown',
                            'layout'    => 'inline',
                            'items'     => [
                                ['text' => 'H2', 'value' => 'h2'],
                                ['text' => 'H3', 'value' => 'h3'],
                                ['text' => 'H4', 'value' => 'h4'],
                                ['text' => 'P',  'value' => 'p'],
                            ],
                            'condition' => [[['path' => '%%CURRENTPATH%%.format', 'operand' => 'equals', 'value' => 'plain']]],
                        ],
                        false,
                        false,
                        [],
                    ),
                    c(
                        'schema_enabled',
                        'Contribute to FAQPage schema',
                        [],
                        [
                            'type'        => 'toggle',
                            'layout'      => 'inline',
                            'description' => 'When on, this element\'s FAQs are merged into the page\'s unified FAQPage JSON-LD.',
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
        ];
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
                'location'             => 'outside-top',
                'cssProperty'          => 'margin-top',
                'affectedPropertyPath' => 'design.spacing.margin_top.%%BREAKPOINT%%',
            ],
            [
                'location'             => 'outside-bottom',
                'cssProperty'          => 'margin-bottom',
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
        return 12;
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
        return false;
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        // List specific leaf paths (matches Scos_Review_Card's pattern). A
        // top-level `'content'` here causes BD to re-fire SSR on transient
        // sub-state changes too, which previously triggered AJAX wrapper
        // errors when the SSR echoed placeholder text.
        return [
            'content.faq_source.mode',
            'content.faq_source.selected_faqs',
            'content.faq_source.topic_slug',
            'content.display.format',
            'content.display.heading',
            'content.display.schema_enabled',
        ];
    }
}
