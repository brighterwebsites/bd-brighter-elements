<?php
// v2.1 | 2026-06-04
//
// SCOS FAQs — Breakdance element that renders FAQs from the Site Essentials
// FAQ submodule using the bde-faq__* HTML structure and BreakdanceFaq JS,
// matching the design system of the Frequently Asked Questions element.
//
// Two source modes:
//   - selector: editor picks specific FAQs from a dropdown repeater.
//   - topic:    editor enters a scos_topic slug; every FAQ tagged with it renders.
//
// v2.0 changes:
//   - Replaced shortcode delegation with direct FAQ_Module calls in ssr.php
//   - Replaced details/summary HTML with bde-faq__* accordion structure
//   - Full design controls: wrapper, item, typography, borders, spacing
//   - Added BreakdanceFaq JS initialization via dependencies() and actions()
//   - Added first_item_opened content toggle
//   - heading level moved to design.typography.title_tag
//
// Schema is contributed to the unified site @graph by
// site-essentials/Modules/CustomPosts/FAQ/FAQ_Schema_Graph.php — that class
// walks `_breakdance_data` for nodes of type BreakdanceCustomElements\ScosFaqs.
// The slug and property paths here MUST stay in sync with FAQ_Schema_Graph and
// Content_Analysis::bd_tree_has_scos_faqs() in the MU plugin.

namespace BreakdanceCustomElements;

use BrighterElements\Faq_Picker_Options;
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
        return 'other';
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
            'content' => [
                'faq_source' => [
                    'mode' => 'selector',
                ],
                'display' => [
                    'format'             => 'accordion',
                    'first_item_opened'  => false,
                    'schema_enabled'     => true,
                ],
            ],
            'design' => [
                'borders' => [
                    'border_width' => [
                        'number'         => 2,
                        'unit'           => 'px',
                        'style'          => '2px',
                        'breakpoint_base' => ['number' => 2, 'unit' => 'px', 'style' => '2px'],
                    ],
                    'border_color' => '#1B1B1BFF',
                ],
                'item' => [
                    'horizontal_padding' => [
                        'number'         => 16,
                        'unit'           => 'px',
                        'style'          => '16px',
                        'breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px'],
                    ],
                    'vertical_padding' => [
                        'number'         => 16,
                        'unit'           => 'px',
                        'style'          => '16px',
                        'breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px'],
                    ],
                    'icon' => [
                        'icon' => [
                            'slug'    => 'icon-plus',
                            'name'    => 'plus',
                            'svgCode' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M31 12h-11v-11c0-0.552-0.448-1-1-1h-6c-0.552 0-1 0.448-1 1v11h-11c-0.552 0-1 0.448-1 1v6c0 0.552 0.448 1 1 1h11v11c0 0.552 0.448 1 1 1h6c0.552 0 1-0.448 1-1v-11h11c0.552 0 1-0.448 1-1v-6c0-0.552-0.448-1-1-1z"/></svg>',
                        ],
                        'active_icon' => [
                            'slug'    => 'icon-minus.',
                            'name'    => 'minus',
                            'svgCode' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/></svg>',
                        ],
                    ],
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
                'wrapper',
                'Wrapper',
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
                        'background',
                        'Background',
                        [],
                        ['type' => 'color', 'layout' => 'inline'],
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
                'item',
                'Item',
                [
                    c(
                        'horizontal_padding',
                        'Horizontal Padding',
                        [],
                        ['type' => 'unit', 'layout' => 'inline'],
                        true,
                        false,
                        [],
                    ),
                    c(
                        'vertical_padding',
                        'Vertical Padding',
                        [],
                        ['type' => 'unit', 'layout' => 'inline'],
                        true,
                        false,
                        [],
                    ),
                    c(
                        'icon',
                        'Icon',
                        [
                            c(
                                'icon',
                                'Icon',
                                [],
                                ['type' => 'icon', 'layout' => 'vertical'],
                                false,
                                false,
                                [],
                            ),
                            c(
                                'active_icon',
                                'Active Icon',
                                [],
                                ['type' => 'icon', 'layout' => 'vertical'],
                                false,
                                false,
                                [],
                            ),
                            c(
                                'size',
                                'Size',
                                [],
                                ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 4, 'max' => 100, 'step' => 1], 'unitOptions' => ['types' => ['px']]],
                                true,
                                false,
                                [],
                            ),
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
                                'active_color',
                                'Active Color',
                                [],
                                ['type' => 'color', 'layout' => 'inline'],
                                false,
                                false,
                                [],
                            ),
                        ],
                        ['type' => 'section', 'sectionOptions' => ['type' => 'popout']],
                        false,
                        false,
                        [],
                    ),
                    c(
                        'background',
                        'Background',
                        [],
                        ['type' => 'color', 'layout' => 'inline'],
                        false,
                        false,
                        [],
                    ),
                    c(
                        'active_background',
                        'Active Background',
                        [],
                        ['type' => 'color', 'layout' => 'inline'],
                        false,
                        false,
                        [],
                    ),
                    c(
                        'below_title',
                        'Below Title',
                        [],
                        ['type' => 'unit', 'layout' => 'inline'],
                        true,
                        false,
                        [],
                    ),
                    c(
                        'after_item',
                        'After Item',
                        [],
                        ['type' => 'unit', 'layout' => 'inline'],
                        true,
                        false,
                        [],
                    ),
                    c(
                        'transition_duration',
                        'Transition Duration',
                        [],
                        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s', 'ms']]],
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
                'typography',
                'Typography',
                [
                    c(
                        'title_tag',
                        'Title Tag',
                        [],
                        [
                            'type'   => 'dropdown',
                            'layout' => 'inline',
                            'items'  => [
                                ['value' => 'h1', 'text' => 'H1'],
                                ['value' => 'h2', 'text' => 'H2'],
                                ['value' => 'h3', 'text' => 'H3'],
                                ['value' => 'h4', 'text' => 'H4'],
                                ['value' => 'h5', 'text' => 'H5'],
                                ['value' => 'h6', 'text' => 'H6'],
                            ],
                        ],
                        false,
                        false,
                        [],
                    ),
                    getPresetSection(
                        'EssentialElements\\typography_with_align',
                        'Title',
                        'title',
                        ['type' => 'popout'],
                    ),
                    c(
                        'active_title',
                        'Active Title',
                        [],
                        ['type' => 'color', 'layout' => 'inline'],
                        false,
                        false,
                        [],
                    ),
                    getPresetSection(
                        'EssentialElements\\typography_with_align',
                        'Content',
                        'content',
                        ['type' => 'popout'],
                    ),
                ],
                ['type' => 'section', 'layout' => 'vertical'],
                false,
                false,
                [],
            ),
            c(
                'borders',
                'Borders',
                [
                    c(
                        'below_only',
                        'Below Only',
                        [],
                        ['type' => 'toggle', 'layout' => 'inline'],
                        false,
                        false,
                        [],
                    ),
                    c(
                        'border_color',
                        'Border Color',
                        [],
                        ['type' => 'color', 'layout' => 'inline'],
                        false,
                        false,
                        [],
                    ),
                    c(
                        'border_width',
                        'Border Width',
                        [],
                        ['type' => 'unit', 'layout' => 'inline'],
                        true,
                        false,
                        [],
                    ),
                    c(
                        'border_radius',
                        'Border Radius',
                        [],
                        [
                            'type'      => 'unit',
                            'layout'    => 'inline',
                            'condition' => ['path' => 'design.borders.below_only', 'operand' => 'is not set', 'value' => ''],
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
                                'FAQ',
                                [],
                                [
                                    'type'        => 'dropdown',
                                    'layout'      => 'vertical',
                                    'items'       => Faq_Picker_Options::dropdown_items(),
                                    'description' => 'Choose a published FAQ. List refreshes when you reload the Breakdance builder.',
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
                        'first_item_opened',
                        'First item opened',
                        [],
                        [
                            'type'      => 'toggle',
                            'layout'    => 'inline',
                            'condition' => [[['path' => '%%CURRENTPATH%%.format', 'operand' => 'equals', 'value' => 'accordion']]],
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
        return [
            '0' => [
                'scripts' => [ '%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/breakdance-faq@1/faq.js' ],
                'title'   => 'FAQ.js',
            ],
            '1' => [
                'title'          => 'FAQ Frontend',
                'inlineScripts'  => [
                    '(function() {
  if ({{ content.display.format|json_encode }} !== \'accordion\') return;
  new BreakdanceFaq(\'%%SELECTOR%%\', { accordion: true, openFirst: {{ content.display.first_item_opened|json_encode }} });
})();',
                ],
                'builderCondition'  => 'return false;',
                'frontendCondition' => 'return true;',
            ],
        ];
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
        return [

'onMountedElement' => [['script' => '(function() {
  if (!window.breakdanceFaqInstances) window.breakdanceFaqInstances = {};

  if (window.breakdanceFaqInstances[%%ID%%]) {
    window.breakdanceFaqInstances[%%ID%%].destroy();
  }

  if ({{ content.display.format|json_encode }} === \'accordion\') {
    window.breakdanceFaqInstances[%%ID%%] = new BreakdanceFaq(\'%%SELECTOR%%\', { accordion: true, openFirst: {{ content.display.first_item_opened|json_encode }} });
  }
}());',
]],

'onPropertyChange' => [['script' => '(function() {
  if (window.breakdanceFaqInstances && window.breakdanceFaqInstances[%%ID%%]) {
    window.breakdanceFaqInstances[%%ID%%].destroy();
    delete window.breakdanceFaqInstances[%%ID%%];
  }

  if ({{ content.display.format|json_encode }} === \'accordion\') {
    window.breakdanceFaqInstances[%%ID%%] = new BreakdanceFaq(\'%%SELECTOR%%\', { accordion: true, openFirst: {{ content.display.first_item_opened|json_encode }} });
  }
}());',
]],

'onBeforeDeletingElement' => [['script' => '(function() {
  if (window.breakdanceFaqInstances && window.breakdanceFaqInstances[%%ID%%]) {
    window.breakdanceFaqInstances[%%ID%%].destroy();
    delete window.breakdanceFaqInstances[%%ID%%];
  }
}());',
]],

        ];
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
        return [
            'content.faq_source.mode',
            'content.faq_source.selected_faqs',
            'content.faq_source.topic_slug',
            'content.display.format',
            'content.display.first_item_opened',
            'content.display.schema_enabled',
            'design.typography.title_tag',
            'design.item.icon.icon',
            'design.item.icon.active_icon',
        ];
    }
}
