<?php

namespace BreakdanceCustomElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
    "BreakdanceCustomElements\\TableCell",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class TableCell extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return 'SquareIcon';
    }

    static function tag()
    {
        return 'null';
    }

    static function tagOptions()
    {
        return [];
    }

    static function tagControlPath()
    {
        return "content.tag.cell_tag";
    }

    static function name()
    {
        return 'Table Cell';
    }

    static function className()
    {
        return 'bde-table__cell';
    }

    static function category()
    {
        return 'basic';
    }

    static function badge()
    {
        return ['backgroundColor' => 'var(--black)', 'textColor' => 'var(--white)', 'label' => 'cell'];
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
        return ['content' => ['tag' => ['cell_tag' => 'td']]];
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
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\LessFancyBackground",
      "Background",
      "background",
       ['type' => 'popout']
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
        "tag",
        "Tag",
        [c(
        "cell_tag",
        "Cell Tag",
        [],
        ['type' => 'dropdown', 'layout' => 'vertical', 'items' => [['text' => 'td  (data cell)', 'value' => 'td'], ['text' => 'th  (header cell)', 'value' => 'th']]],
        false,
        false,
        [],

      ), c(
        "data_label",
        "Data Label",
        [],
        ['type' => 'text', 'layout' => 'inline', 'textOptions' => ['format' => 'plain'], 'placeholder' => 'Column name (for responsive)'],
        false,
        false,
        [],

      ), c(
        "colspan",
        "Colspan",
        [],
        ['type' => 'number', 'layout' => 'inline', 'numberOptions' => ['min' => 1, 'max' => 20]],
        false,
        false,
        [],

      ), c(
        "rowspan",
        "Rowspan",
        [],
        ['type' => 'number', 'layout' => 'inline', 'numberOptions' => ['min' => 1, 'max' => 20]],
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
        return ['type' => 'container'];
    }

    static function spacingBars()
    {
        return [['location' => 'outside-top', 'cssProperty' => 'margin-top', 'affectedPropertyPath' => 'design.spacing.margin_top.%%BREAKPOINT%%'], ['location' => 'outside-bottom', 'cssProperty' => 'margin-bottom', 'affectedPropertyPath' => 'design.spacing.margin_bottom.%%BREAKPOINT%%']];
    }

    static function attributes()
    {
        return [['name' => 'data-bde-lazy-bg', 'template' => '{{ design.background.lazy_load ? \'waiting\' }}']];
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
        return 76;
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
        return ['design.background.type', 'design.background.image', 'design.background.overlay.image', 'design.background.image_settings.unset_image_at', 'design.background.image_settings.size', 'design.background.image_settings.height', 'design.background.image_settings.repeat', 'design.background.image_settings.position', 'design.background.image_settings.left', 'design.background.image_settings.top', 'design.background.image_settings.attachment', 'design.background.image_settings.custom_position', 'design.background.image_settings.width', 'design.background.overlay.type'];
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}
