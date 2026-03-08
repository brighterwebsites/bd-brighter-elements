<?php

namespace BreakdanceCustomElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
    "BreakdanceCustomElements\\AtomV1Button",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class AtomV1Button extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return 'SquareIcon';
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
        return 'Atom V1 Button';
    }

    static function className()
    {
        return 'bde-atom-v1-button';
    }

    static function category()
    {
        return 'other';
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
        $template = file_get_contents(__DIR__ . '/css.twig');
        return $template;
    }

    static function designControls()
    {
        return [c(
        "button",
        "Button",
        [c(
        "style",
        "Style",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => [['value' => 'primary', 'text' => 'Primary'], ['text' => 'Secondary', 'value' => 'secondary'], ['text' => 'Custom', 'value' => 'custom'], ['text' => 'Text', 'value' => 'text']], 'buttonBarOptions' => ['size' => 'small', 'layout' => 'default']],
        false,
        false,
        [],
        
      ), c(
        "text",
        "Text",
        [getPresetSection(
      "EssentialElements\\typography_with_hoverable_everything",
      "Typography",
      "typography",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), c(
        "fancy_underline",
        "Fancy Underline",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'style-1', 'text' => 'Style 1'], ['text' => 'Style 2', 'value' => 'style-2'], ['text' => 'Style 3', 'value' => 'style-3'], ['text' => 'Style 4', 'value' => 'style-4'], ['text' => 'Style 5', 'value' => 'style-5'], ['text' => 'Style 6', 'value' => 'style-6'], ['text' => 'Style 7', 'value' => 'style-7'], ['text' => 'Style 8', 'value' => 'style-8']]],
        false,
        false,
        [],
        
      ), c(
        "underline_color",
        "Underline Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        true,
        [],
        
      ), c(
        "arrow",
        "Arrow",
        [c(
        "arrow",
        "Arrow",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'arrow-1', 'text' => 'Arrow 1'], ['text' => 'Arrow 2', 'value' => 'arrow-2'], ['text' => 'Arrow 3', 'value' => 'arrow-3'], ['text' => 'Custom', 'value' => 'custom']]],
        false,
        false,
        [],
        
      ), c(
        "custom_arrow",
        "Custom Arrow",
        [],
        ['type' => 'icon', 'layout' => 'vertical', 'condition' => ['path' => '%%CURRENTPATH%%.arrow', 'operand' => 'equals', 'value' => 'custom']],
        false,
        false,
        [],
        
      ), c(
        "space_before",
        "Space Before",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
        
      ), c(
        "hover_transform",
        "Hover Transform",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['path' => '%%CURRENTPATH%%.arrow', 'operand' => 'not equals', 'value' => 'arrow-3']],
        false,
        false,
        [],
        
      ), c(
        "arrow_size",
        "Arrow Size",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
        
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
        
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout'], 'condition' => ['path' => '%%CURRENTPATH%%.style', 'operand' => 'equals', 'value' => 'text']],
        false,
        false,
        [],
        
      ), c(
        "custom_type",
        "Custom Type",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'noLabel' => true, 'items' => [['value' => 'custom', 'text' => 'Custom'], ['text' => 'Preset', 'value' => 'preset']], 'condition' => [[['path' => '%%CURRENTPATH%%.style', 'operand' => 'equals', 'value' => 'custom']]]],
        false,
        false,
        [],
        
      ), c(
        "custom",
        "Custom",
        [c(
        "size",
        "Size",
        [c(
        "size",
        "Size",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['text' => 'Custom', 'value' => 'custom'], ['text' => 'Small', 'value' => 'small'], ['value' => 'default', 'text' => 'Default'], ['text' => 'Large', 'value' => 'large']], 'buttonBarOptions' => ['layout' => 'multiline', 'size' => 'small']],
        true,
        false,
        [],
        
      ), c(
        "padding",
        "Padding",
        [],
        ['type' => 'spacing_complex', 'layout' => 'vertical', 'condition' => ['path' => '%%CURRENTPATH%%.size', 'operand' => 'equals', 'value' => 'custom']],
        true,
        false,
        [],
        
      ), c(
        "override_width",
        "Override Width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
        
      ), c(
        "full_width_at",
        "Full Width At",
        [],
        ['type' => 'breakpoint_dropdown', 'layout' => 'inline'],
        false,
        false,
        [],
        
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
        
      ), c(
        "background",
        "Background",
        [],
        ['type' => 'color', 'layout' => 'inline', 'colorOptions' => ['type' => 'solidAndGradient']],
        false,
        true,
        [],
        
      ), c(
        "outline",
        "Outline",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'items' => [['value' => 'solid', 'text' => 'Solid'], ['text' => 'Outline', 'value' => 'outline']]],
        false,
        false,
        [],
        
      ), c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline', 'condition' => ['path' => '%%CURRENTPATH%%.outline', 'operand' => 'is set', 'value' => '']],
        false,
        true,
        [],
        
      ), c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 20, 'step' => 1], 'condition' => ['path' => '%%CURRENTPATH%%.outline', 'operand' => 'is set', 'value' => '']],
        false,
        false,
        [],
        
      ), c(
        "no_fill_on_hover",
        "No Fill On Hover",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => ['path' => '%%CURRENTPATH%%.outline', 'operand' => 'is set', 'value' => '']],
        false,
        false,
        [],
        
      ), getPresetSection(
      "EssentialElements\\typography_with_hoverable_color",
      "Typography",
      "typography",
       ['type' => 'popout']
     ), c(
        "corners",
        "Corners",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => [['value' => 'square', 'text' => 'Square'], ['text' => 'Round', 'value' => 'round'], ['text' => 'Custom', 'value' => 'custom']]],
        false,
        false,
        [],
        
      ), c(
        "corner_radius",
        "Corner Radius",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['path' => '%%CURRENTPATH%%.corners', 'operand' => 'equals', 'value' => 'custom']],
        true,
        false,
        [],
        
      ), c(
        "icon",
        "Icon",
        [c(
        "icon",
        "Icon",
        [],
        ['type' => 'icon', 'layout' => 'vertical'],
        false,
        false,
        [],
        
      ), c(
        "position",
        "Position",
        [],
        ['type' => 'button_bar', 'layout' => 'inline', 'items' => [['value' => 'before', 'text' => 'Before'], ['text' => 'After', 'value' => 'after']]],
        false,
        false,
        [],
        
      ), c(
        "size",
        "Size",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
        
      ), c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        true,
        [],
        
      ), c(
        "space_before",
        "Space Before",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
        
      ), c(
        "space_after",
        "Space After",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
        
      ), c(
        "hover_transform",
        "Hover Transform",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
        
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
        
      ), c(
        "effects",
        "Effects",
        [c(
        "transition_duration",
        "Transition Duration",
        [],
        ['type' => 'unit', 'layout' => 'vertical', 'unitOptions' => ['types' => ['ms'], 'defaultType' => 'ms'], 'rangeOptions' => ['min' => 0, 'max' => 1000, 'step' => 1]],
        true,
        false,
        [],
        
      ), c(
        "scale_on_hover",
        "Scale On Hover",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 3, 'step' => 0.1]],
        true,
        false,
        [],
        
      ), c(
        "shadow",
        "Shadow",
        [],
        ['type' => 'shadow', 'layout' => 'vertical'],
        true,
        true,
        [],
        
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
        
      )],
        ['type' => 'section', 'sectionOptions' => ['type' => 'popout'], 'condition' => [[['path' => '%%CURRENTPATH%%.style', 'operand' => 'equals', 'value' => 'custom'], ['path' => '%%CURRENTPATH%%.custom_type', 'operand' => 'equals', 'value' => 'custom']], [['path' => '%%CURRENTPATH%%.style', 'operand' => 'equals', 'value' => 'custom'], ['path' => '%%CURRENTPATH%%.custom_type', 'operand' => 'is not set', 'value' => '']]]],
        false,
        false,
        [],
        
      ), c(
        "preset",
        "Preset",
        [],
        ['type' => 'button_preset', 'layout' => 'vertical', 'condition' => [[['path' => '%%CURRENTPATH%%.style', 'operand' => 'equals', 'value' => 'custom'], ['path' => '%%CURRENTPATH%%.custom_type', 'operand' => 'equals', 'value' => 'preset']]]],
        false,
        false,
        [],
        
      )],
        ['type' => 'section'],
        false,
        false,
        [],
        
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
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
        ['accepts' => 'string']
      ), c(
        "link",
        "Link",
        [],
        ['type' => 'link', 'layout' => 'vertical'],
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
        return ['alwaysHide' => true];
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
        return [];
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
        return 0;
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
        return false;
    }

    static function propertyPathsToWhitelistInFlatProps()
    {
        return ['design.button.styles'];
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}
