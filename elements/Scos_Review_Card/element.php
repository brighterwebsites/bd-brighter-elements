<?php

namespace BreakdanceCustomElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
    "BreakdanceCustomElements\\ScosReviewCard",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class ScosReviewCard extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return 'StarIcon';
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
        return 'bde-scos-review-card-wrapper';
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
        return ['content' => ['source' => ['mode' => 'loop'], 'display' => ['layout' => 'stacked'], 'fields' => ['show_rating' => true, 'show_excerpt' => true, 'show_full_text' => false, 'show_outcome' => true, 'show_name' => true, 'show_detail' => true, 'show_date' => true, 'show_platform' => true, 'show_verify' => true, 'show_featured' => false, 'show_platform_icon' => true], 'project' => ['show_image' => true, 'show_name' => true, 'show_link' => true]]];
    }

    static function defaultChildren()
    {
        return false;
    }

    static function cssTemplate()
    {
        $template = file_get_contents(__DIR__ . '/css.twig');
        return $template;
    }

    static function designControls()
    {
        return [getPresetSection(
      "EssentialElements\\simpleLayout",
      "Layout",
      "layout",
       ['type' => 'popout']
     ), c(
        "container",
        "Container",
        [getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     ), c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
        
      ), c(
        "min_height",
        "Min Height",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
        
      )],
        ['type' => 'section'],
        false,
        false,
        [],
        
      ), getPresetSection(
      "EssentialElements\\LessFancyBackground",
      "Background",
      "background",
       ['type' => 'popout']
     ), c(
        "stars",
        "Stars",
        [c(
        "size",
        "Star Size",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'rem', 'em'], 'defaultType' => 'px']],
        true,
        false,
        [],
        
      ), c(
        "color_filled",
        "Filled Star",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
        
      ), c(
        "color_empty",
        "Empty Star",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
        
      )],
        ['type' => 'section'],
        false,
        false,
        [],
        
      ), c(
        "platform_icon",
        "Platform Icon",
        [c(
        "size",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'rem', 'em'], 'defaultType' => 'px']],
        true,
        false,
        [],
        
      )],
        ['type' => 'section'],
        false,
        false,
        [],
        
      ), c(
        "typography",
        "Typography",
        [getPresetSection(
      "EssentialElements\\typography_with_effects_and_align",
      "Review Text",
      "review_text",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography_with_effects_and_align",
      "Outcome",
      "outcome",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography",
      "Customer Name",
      "customer_name",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography",
      "Customer Detail",
      "customer_detail",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography",
      "Date",
      "date",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography",
      "Platform",
      "platform",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography_with_align_with_hoverable_color",
      "Verify Link",
      "verify_link",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography_with_align_with_hoverable_color",
      "Project Text",
      "project_text",
       ['type' => 'popout']
     )],
        ['type' => 'section'],
        false,
        false,
        [],
        
      ), getPresetSection(
      "EssentialElements\\spacing_margin_y",
      "Spacing",
      "spacing",
       ['type' => 'popout']
     )];
    }

    static function contentControls()
    {
        return [c(
        "source",
        "Data Source",
        [c(
        "mode",
        "Mode",
        [],
        ['type' => 'dropdown', 'layout' => 'vertical', 'description' => 'Post loop: drop inside a Breakdance loop querying bw_reviews. Specific: display one review anywhere. Connected: drop on a project single template to show every review linked to that project.', 'items' => [['text' => 'Post loop (dynamic)', 'value' => 'loop'], ['text' => 'Specific review', 'value' => 'specific'], ['text' => 'Connected to current project', 'value' => 'connected']]],
        false,
        false,
        [],
        
      ), c(
        "review_id",
        "Review",
        [],
        ['type' => 'dropdown', 'layout' => 'vertical', 'items' => [['text' => 'Andrew (29561)', 'value' => '29561'], ['text' => 'C Hughes (29554)', 'value' => '29554'], ['text' => 'Cath V (29568)', 'value' => '29568'], ['text' => 'Dallas Carr (29564)', 'value' => '29564'], ['text' => 'Edward phillips (29557)', 'value' => '29557'], ['text' => 'Ellie-Rae Lomax (29553)', 'value' => '29553'], ['text' => 'Helaman Setu (29560)', 'value' => '29560'], ['text' => 'Helen (29555)', 'value' => '29555'], ['text' => 'Kaiden Grennan (29570)', 'value' => '29570'], ['text' => 'Lauren Williams (29562)', 'value' => '29562'], ['text' => 'Leish ParsBail (29558)', 'value' => '29558'], ['text' => 'Lillie Kiwi Kiwi (29563)', 'value' => '29563'], ['text' => 'Lucy Wharrier (29559)', 'value' => '29559'], ['text' => 'Michael (29566)', 'value' => '29566'], ['text' => 'Michael (29571)', 'value' => '29571'], ['text' => 'Morbias (29569)', 'value' => '29569'], ['text' => 'Myra Henderson (29565)', 'value' => '29565'], ['text' => 'Rob Underdown (29556)', 'value' => '29556'], ['text' => 'Sammy Makasini (29552)', 'value' => '29552'], ['text' => 'Steve (29567)', 'value' => '29567'], ['text' => 'Wendy Nunn (29573)', 'value' => '29573'], ['text' => 'William Liehr (29572)', 'value' => '29572']], 'description' => 'Choose a published review. List refreshes when you reload the Breakdance builder.', 'condition' => [[['path' => '%%CURRENTPATH%%.mode', 'operand' => 'equals', 'value' => 'specific']]]],
        false,
        false,
        [],
        
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
        
      ), c(
        "display",
        "Display",
        [c(
        "layout",
        "Layout",
        [],
        ['type' => 'dropdown', 'layout' => 'vertical', 'description' => 'Stacked: column card. Horizontal: project image in sidebar. Quote: large centred quote. Hero: project image full-width at top.', 'items' => [['text' => 'Stacked', 'value' => 'stacked'], ['text' => 'Horizontal', 'value' => 'horizontal'], ['text' => 'Quote', 'value' => 'quote'], ['text' => 'Hero', 'value' => 'hero']]],
        false,
        false,
        [],
        
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
        
      ), c(
        "fields",
        "Review Fields",
        [c(
        "show_rating",
        "Rating (stars)",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
        
      ), c(
        "show_excerpt",
        "Review excerpt",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
        
      ), c(
        "show_full_text",
        "Full review text",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'description' => 'Only shown when excerpt is off.'],
        false,
        false,
        [],
        
      ), c(
        "show_outcome",
        "Success outcome",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
        
      ), c(
        "show_name",
        "Customer name",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
        
      ), c(
        "show_detail",
        "Customer detail",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
        
      ), c(
        "show_date",
        "Date",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
        
      ), c(
        "show_platform",
        "Platform",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
        
      ), c(
        "show_verify",
        "Verify link",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
        
      ), c(
        "show_featured",
        "Featured badge",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
        
      ), c(
        "show_platform_icon",
        "Platform icon",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'description' => 'Logo image set on the platform taxonomy term.'],
        false,
        false,
        [],
        
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
        
      ), c(
        "project",
        "Related Project",
        [c(
        "show_image",
        "Project image",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'description' => 'Shown only when a project is linked to the review.'],
        false,
        false,
        [],
        
      ), c(
        "show_name",
        "Project name",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
        
      ), c(
        "show_link",
        "Link to project",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
        
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
        
      )];
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
        return [['location' => 'outside-top', 'cssProperty' => 'margin-top', 'affectedPropertyPath' => 'design.spacing.margin_top.%%BREAKPOINT%%'], ['location' => 'outside-bottom', 'cssProperty' => 'margin-bottom', 'affectedPropertyPath' => 'design.spacing.margin_bottom.%%BREAKPOINT%%']];
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
        return 20;
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
        return ['design.container.background.image', 'design.container.background.overlay.image', 'design.container.background.image_settings.unset_image_at', 'design.container.background.image_settings.size', 'design.container.background.image_settings.height', 'design.container.background.image_settings.repeat', 'design.container.background.image_settings.position', 'design.container.background.image_settings.left', 'design.container.background.image_settings.top', 'design.container.background.image_settings.attachment', 'design.container.background.image_settings.custom_position', 'design.container.background.image_settings.width', 'design.container.background.overlay.image_settings.custom_position', 'design.container.background.image_size', 'design.container.background.overlay.image_size', 'design.container.background.overlay.type', 'design.container.background.design.layout.horizontal.vertical_at', 'design.container.background.image_settings', 'design.container.background.type', 'design.background.image', 'design.background.overlay.image', 'design.background.image_settings.unset_image_at', 'design.background.image_settings.size', 'design.background.image_settings.height', 'design.background.image_settings.repeat', 'design.background.image_settings.position', 'design.background.image_settings.left', 'design.background.image_settings.top', 'design.background.image_settings.attachment', 'design.background.image_settings.custom_position', 'design.background.image_settings.width', 'design.background.overlay.image_settings.custom_position', 'design.background.image_size', 'design.background.overlay.image_size', 'design.background.overlay.type', 'design.background.image_settings', 'design.layout.layout', 'design.layout.h_vertical_at', 'design.layout.h_alignment_when_vertical', 'design.layout.a_display', 'design.layout.horizontal.vertical_at'];
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return ['content.source.mode', 'content.source.review_id', 'content.display.layout', 'content.fields.show_rating', 'content.fields.show_excerpt', 'content.fields.show_full_text', 'content.fields.show_outcome', 'content.fields.show_name', 'content.fields.show_detail', 'content.fields.show_date', 'content.fields.show_platform', 'content.fields.show_verify', 'content.fields.show_featured', 'content.fields.show_platform_icon', 'content.project.show_image', 'content.project.show_name', 'content.project.show_link'];
    }
}
