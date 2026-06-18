<?php
// v1.0 | 2026-06-18

namespace BreakdanceCustomElements;

use function Breakdance\Elements\c;

\Breakdance\ElementStudio\registerElementForEditing(
    "BreakdanceCustomElements\\ScosReviewCard",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class ScosReviewCard extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg aria-hidden="true" focusable="false" class="svg-inline--fa fa-star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/></svg>';
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
        return 'SCOS Review Card';
    }

    static function className()
    {
        return 'bde-scos-review-card-wrap';
    }

    static function category()
    {
        return 'blocks';
    }

    static function badge()
    {
        return false;
    }

    static function slug()
    {
        return __CLASS__;
    }

    static function template()
    {
        // phpTemplate() handles rendering — this Twig string is a fallback placeholder
        // shown only if phpTemplate() is not supported by this Breakdance version.
        return '<!-- SCOS Review Card: phpTemplate not supported -->';
    }

    static function phpTemplate()
    {
        return file_get_contents(__DIR__ . '/ssr.php');
    }

    static function defaultCss()
    {
        return file_get_contents(__DIR__ . '/default.css');
    }

    static function defaultProperties()
    {
        return [
            'content' => [
                'source' => [
                    'mode'   => 'loop',
                    'layout' => 'stacked',
                ],
                'fields' => [
                    'show_rating'        => true,
                    'show_excerpt'       => true,
                    'show_full_text'     => false,
                    'show_outcome'       => true,
                    'show_name'          => true,
                    'show_detail'        => true,
                    'show_date'          => true,
                    'show_platform'      => true,
                    'show_verify'        => true,
                    'show_featured'      => false,
                    'show_platform_icon' => true,
                    'show_project_image' => true,
                    'show_project_name'  => true,
                    'show_project_link'  => true,
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
        return [];
    }

    static function contentControls()
    {
        return [
            c(
                "source",
                "Source",
                [
                    c(
                        "mode",
                        "Mode",
                        [],
                        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [
                            ['value' => 'loop',      'text' => 'Post Loop (current post)'],
                            ['value' => 'specific',  'text' => 'Specific Review'],
                            ['value' => 'connected', 'text' => 'Connected to Current Project'],
                        ]],
                        false,
                        false,
                        []
                    ),
                    c(
                        "review_id",
                        "Review Post ID",
                        [],
                        ['type' => 'number', 'layout' => 'inline'],
                        false,
                        false,
                        []
                    ),
                    c(
                        "layout",
                        "Layout",
                        [],
                        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [
                            ['value' => 'stacked',    'text' => 'Stacked'],
                            ['value' => 'horizontal', 'text' => 'Horizontal'],
                            ['value' => 'quote',      'text' => 'Quote'],
                            ['value' => 'hero',       'text' => 'Hero'],
                        ]],
                        false,
                        false,
                        []
                    ),
                ],
                ['type' => 'section', 'layout' => 'vertical'],
                false,
                false,
                []
            ),
            c(
                "fields",
                "Display Fields",
                [
                    c("show_rating",        "Rating",         [], ['type' => 'toggle', 'layout' => 'inline'], false, false, []),
                    c("show_excerpt",       "Excerpt",        [], ['type' => 'toggle', 'layout' => 'inline'], false, false, []),
                    c("show_full_text",     "Full Text",      [], ['type' => 'toggle', 'layout' => 'inline'], false, false, []),
                    c("show_outcome",       "Outcome",        [], ['type' => 'toggle', 'layout' => 'inline'], false, false, []),
                    c("show_name",          "Name",           [], ['type' => 'toggle', 'layout' => 'inline'], false, false, []),
                    c("show_detail",        "Detail",         [], ['type' => 'toggle', 'layout' => 'inline'], false, false, []),
                    c("show_date",          "Date",           [], ['type' => 'toggle', 'layout' => 'inline'], false, false, []),
                    c("show_platform",      "Platform",       [], ['type' => 'toggle', 'layout' => 'inline'], false, false, []),
                    c("show_verify",        "Verify Link",    [], ['type' => 'toggle', 'layout' => 'inline'], false, false, []),
                    c("show_featured",      "Featured Badge", [], ['type' => 'toggle', 'layout' => 'inline'], false, false, []),
                    c("show_platform_icon", "Platform Icon",  [], ['type' => 'toggle', 'layout' => 'inline'], false, false, []),
                    c("show_project_image", "Project Image",  [], ['type' => 'toggle', 'layout' => 'inline'], false, false, []),
                    c("show_project_name",  "Project Name",   [], ['type' => 'toggle', 'layout' => 'inline'], false, false, []),
                    c("show_project_link",  "Project Link",   [], ['type' => 'toggle', 'layout' => 'inline'], false, false, []),
                ],
                ['type' => 'section', 'layout' => 'vertical'],
                false,
                false,
                []
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
        return ['proOnly' => true];
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
            ['location' => 'outside-top',    'cssProperty' => 'margin-top',    'affectedPropertyPath' => 'design.spacing.wrapper.margin_top.%%BREAKPOINT%%'],
            ['location' => 'outside-bottom', 'cssProperty' => 'margin-bottom', 'affectedPropertyPath' => 'design.spacing.wrapper.margin_bottom.%%BREAKPOINT%%'],
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
        return 900;
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
            'content.source.mode',
            'content.source.review_id',
            'content.source.layout',
            'content.fields.show_rating',
            'content.fields.show_excerpt',
            'content.fields.show_full_text',
            'content.fields.show_outcome',
            'content.fields.show_name',
            'content.fields.show_detail',
            'content.fields.show_date',
            'content.fields.show_platform',
            'content.fields.show_verify',
            'content.fields.show_featured',
            'content.fields.show_platform_icon',
            'content.fields.show_project_image',
            'content.fields.show_project_name',
            'content.fields.show_project_link',
        ];
    }
}
