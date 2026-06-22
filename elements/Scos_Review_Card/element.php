<?php
// v2.0 | 2026-06-22
//
// SCOS Review Card — preconfigured review card for bw_reviews CPT.
//
// Modes:
//   loop      — drop inside a Breakdance loop querying bw_reviews; uses get_the_ID()
//   specific  — pick a review by post ID; drop anywhere on the page
//   connected — drop on a project single template; renders every bw_reviews post
//               whose bw_related_project meta equals the current project ID
//
// Layout presets: stacked | horizontal | quote | hero
// All rendering delegated to [bw_review_card] → Review_Card_Renderer (site-essentials).

namespace BreakdanceCustomElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;
use BrighterElements\Review_Picker_Options;

\Breakdance\ElementStudio\registerElementForEditing(
    'BreakdanceCustomElements\\ScosReviewCard',
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder( __DIR__ )
);

class ScosReviewCard extends \Breakdance\Elements\Element {

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
        return 'SCOS Review Card';
    }

    static function className() {
        return 'bde-scos-review-card-wrapper';
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
                'source' => [
                    'mode' => 'loop',
                ],
                'display' => [
                    'layout' => 'stacked',
                ],
                'fields' => [
                    'show_rating'    => true,
                    'show_excerpt'   => true,
                    'show_full_text' => false,
                    'show_outcome'   => true,
                    'show_name'      => true,
                    'show_detail'    => true,
                    'show_date'      => true,
                    'show_platform'  => true,
                    'show_verify'    => true,
                    'show_featured'       => false,
                    'show_platform_icon'  => true,
                ],
                'project' => [
                    'show_image' => true,
                    'show_name'  => true,
                    'show_link'  => true,
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
            c(
                'container',
                'Container',
                [
                    c(
                        'gap',
                        'Inner Gap',
                        [],
                        [ 'type' => 'unit', 'layout' => 'inline', 'unitOptions' => [ 'types' => [ 'px', 'rem', 'em' ], 'defaultType' => 'rem' ] ],
                        true,
                        false,
                        [],
                    ),
                    getPresetSection( 'EssentialElements\\spacing_padding_all', 'Padding', 'padding', [ 'type' => 'popout' ] ),
                    getPresetSection( 'EssentialElements\\LessFancyBackground', 'Background', 'background', [ 'type' => 'popout' ] ),
                    getPresetSection( 'EssentialElements\\borders', 'Borders', 'borders', [ 'type' => 'popout' ] ),
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
                        'Filled Star',
                        [],
                        [ 'type' => 'color', 'layout' => 'inline' ],
                        false,
                        false,
                        [],
                    ),
                    c(
                        'color_empty',
                        'Empty Star',
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
                'typography',
                'Typography',
                [
                    getPresetSection(
                        'EssentialElements\\typography_with_effects_and_align',
                        'Quote',
                        'quote',
                        [ 'type' => 'popout' ],
                    ),
                    getPresetSection(
                        'EssentialElements\\typography_with_effects_and_align',
                        'Outcome',
                        'outcome',
                        [ 'type' => 'popout' ],
                    ),
                    getPresetSection(
                        'EssentialElements\\typography_with_effects_and_align',
                        'Author',
                        'author',
                        [ 'type' => 'popout' ],
                    ),
                    getPresetSection(
                        'EssentialElements\\typography_with_effects_and_align',
                        'Meta',
                        'meta',
                        [ 'type' => 'popout' ],
                    ),
                    getPresetSection(
                        'EssentialElements\\typography_with_effects_and_align',
                        'Links',
                        'links',
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
                'source',
                'Data Source',
                [
                    c(
                        'mode',
                        'Mode',
                        [],
                        [
                            'type'        => 'dropdown',
                            'layout'      => 'vertical',
                            'description' => 'Post loop: drop inside a Breakdance loop querying bw_reviews. Specific: display one review anywhere. Connected: drop on a project single template to show every review linked to that project.',
                            'items'       => [
                                [ 'text' => 'Post loop (dynamic)',           'value' => 'loop' ],
                                [ 'text' => 'Specific review',               'value' => 'specific' ],
                                [ 'text' => 'Connected to current project',  'value' => 'connected' ],
                            ],
                        ],
                        false,
                        false,
                        [],
                    ),
                    c(
                        'review_id',
                        'Review',
                        [],
                        [
                            'type'        => 'dropdown',
                            'layout'      => 'vertical',
                            'items'       => Review_Picker_Options::dropdown_items(),
                            'description' => 'Choose a published review. List refreshes when you reload the Breakdance builder.',
                            'condition'   => [ [ [ 'path' => '%%CURRENTPATH%%.mode', 'operand' => 'equals', 'value' => 'specific' ] ] ],
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
                            'description' => 'Stacked: column card. Horizontal: project image in sidebar. Quote: large centred quote. Hero: project image full-width at top.',
                            'items'       => [
                                [ 'text' => 'Stacked',    'value' => 'stacked' ],
                                [ 'text' => 'Horizontal', 'value' => 'horizontal' ],
                                [ 'text' => 'Quote',      'value' => 'quote' ],
                                [ 'text' => 'Hero',       'value' => 'hero' ],
                            ],
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
                'fields',
                'Review Fields',
                [
                    c( 'show_rating',    'Rating (stars)',    [], [ 'type' => 'toggle', 'layout' => 'inline' ], false, false, [] ),
                    c( 'show_excerpt',   'Review excerpt',   [], [ 'type' => 'toggle', 'layout' => 'inline' ], false, false, [] ),
                    c( 'show_full_text', 'Full review text', [], [ 'type' => 'toggle', 'layout' => 'inline', 'description' => 'Only shown when excerpt is off.' ], false, false, [] ),
                    c( 'show_outcome',   'Success outcome',  [], [ 'type' => 'toggle', 'layout' => 'inline' ], false, false, [] ),
                    c( 'show_name',      'Customer name',    [], [ 'type' => 'toggle', 'layout' => 'inline' ], false, false, [] ),
                    c( 'show_detail',    'Customer detail',  [], [ 'type' => 'toggle', 'layout' => 'inline' ], false, false, [] ),
                    c( 'show_date',      'Date',             [], [ 'type' => 'toggle', 'layout' => 'inline' ], false, false, [] ),
                    c( 'show_platform',  'Platform',         [], [ 'type' => 'toggle', 'layout' => 'inline' ], false, false, [] ),
                    c( 'show_verify',    'Verify link',      [], [ 'type' => 'toggle', 'layout' => 'inline' ], false, false, [] ),
                    c( 'show_featured',      'Featured badge',    [], [ 'type' => 'toggle', 'layout' => 'inline' ], false, false, [] ),
                    c( 'show_platform_icon', 'Platform icon',     [], [ 'type' => 'toggle', 'layout' => 'inline', 'description' => 'Logo image set on the platform taxonomy term.' ], false, false, [] ),
                ],
                [ 'type' => 'section', 'layout' => 'vertical' ],
                false,
                false,
                [],
            ),
            c(
                'project',
                'Related Project',
                [
                    c( 'show_image', 'Project image',  [], [ 'type' => 'toggle', 'layout' => 'inline', 'description' => 'Shown only when a project is linked to the review.' ], false, false, [] ),
                    c( 'show_name',  'Project name',   [], [ 'type' => 'toggle', 'layout' => 'inline' ], false, false, [] ),
                    c( 'show_link',  'Link to project', [], [ 'type' => 'toggle', 'layout' => 'inline' ], false, false, [] ),
                ],
                [ 'type' => 'section', 'layout' => 'vertical' ],
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
        return 20;
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
            'content.source.mode',
            'content.source.review_id',
            'content.display.layout',
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
            'content.project.show_image',
            'content.project.show_name',
            'content.project.show_link',
        ];
    }
}
