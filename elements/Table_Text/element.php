<?php

namespace BreakdanceCustomElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
    "BreakdanceCustomElements\\TableText",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class TableText extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return 'TextIcon';
    }

    static function tag()
    {
        return 'td';
    }

    static function tagOptions()
    {
        return ['td', 'th', 'caption', 'span', 'p'];
    }

    static function tagControlPath()
    {
        return "content.tag.text_tag";
    }

    static function name()
    {
        return 'Table Text';
    }

    static function className()
    {
        return 'bde-table__text';
    }

    static function category()
    {
        return 'basic';
    }

    static function badge()
    {
        return ['textColor' => 'var(--white)', 'backgroundColor' => 'var(--black)', 'label' => 'Table'];
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
        return ['content' => ['content' => ['text' => '17mm black form ply (lower) + 4mm heavy-duty galvanised mesh (upper)', 'data_label' => 'Configuration'], 'tag' => ['text_tag' => 'td']], 'design' => ['typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]]]]]];
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
        return [c(
        "size",
        "Size",
        [c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 1200, 'step' => 1], 'unitOptions' => ['types' => [], 'defaultType' => 'px']],
        true,
        false,
        [],
        
      )],
        ['type' => 'section'],
        false,
        false,
        [],
        
      ), getPresetSection(
      "EssentialElements\\typography_with_effects_and_align",
      "Typography",
      "typography",
       ['type' => 'popout']
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
        "content",
        "Content",
        [c(
        "text",
        "Text",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true, 'format' => 'plain']],
        false,
        false,
        [],
        ['accepts' => 'string']
      ), c(
        "data_label",
        "Data Label",
        [],
        ['type' => 'text', 'layout' => 'inline', 'textOptions' => ['format' => 'plain'], 'placeholder' => 'Col'],
        false,
        false,
        [],
        
      )],
        ['type' => 'section', 'layout' => 'vertical', 'sectionOptions' => ['type' => 'accordion']],
        false,
        false,
        [],
        
      ), c(
        "tag",
        "Tag",
        [c(
        "text_tag",
        "Text Tag",
        [],
        ['type' => 'dropdown', 'layout' => 'vertical', 'items' => [['text' => 'td', 'value' => 'td'], ['text' => 'span', 'value' => 'span'], ['text' => 'caption', 'value' => 'caption'], ['text' => 'th', 'value' => 'th']]],
        false,
        false,
        [],
        
      )],
        ['type' => 'section', 'layout' => 'vertical', 'sectionOptions' => ['type' => 'popout']],
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
        return ['disableRootHtmlTag' => true];
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
        return [['template' => 'content.content.text', 'name' => 'data-content-editable-property-path']];
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
        return 75;
    }

    static function dynamicPropertyPaths()
    {
        return false;
    }

    static function additionalClasses()
    {
        return [['name' => 'test', 'template' => 'yes']];
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
