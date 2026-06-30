<?php

namespace BreakdanceCustomElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
    "BreakdanceCustomElements\\AccordionContentExtended",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class AccordionContentExtended extends \Breakdance\Elements\Element
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
        return 'Accordion Content Extended';
    }

    static function className()
    {
        return 'bde-accordion__content-wrapper';
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
        "container",
        "Container",
        [c(
        "background",
        "Background",
        [],
        ['type' => 'color', 'layout' => 'inline', 'colorOptions' => ['type' => 'solidAndGradient']],
        false,
        false,
        [],
        
      ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     )],
        ['type' => 'section'],
        false,
        false,
        [],
        
      ), getPresetSection(
      "EssentialElements\\simpleLayout",
      "Layout",
      "layout",
       ['condition' => [[['path' => 'design.layout', 'operand' => 'is set', 'value' => '']]], 'type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\LayoutV2",
      "Layout",
      "layout_v2",
       ['condition' => [[['path' => 'design.layout', 'operand' => 'is not set', 'value' => '']]], 'type' => 'popout']
     ), c(
        "text_colors",
        "Text Colors",
        [c(
        "headings",
        "Headings",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
        
      ), c(
        "text",
        "Text",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
        
      ), c(
        "link",
        "Link",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        true,
        [],
        
      ), c(
        "brand",
        "Brand",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
        
      )],
        ['type' => 'section', 'condition' => [[['path' => 'design.text_colors', 'operand' => 'is set', 'value' => '']]]],
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
        "title",
        "Title",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true]],
        false,
        false,
        [],
        ['accepts' => 'string', 'proOnly' => false]
      ), c(
        "title_tag",
        "Title Tag",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'h1', 'text' => 'h1'], ['text' => 'h2', 'value' => 'h2'], ['text' => 'h3', 'value' => 'h3'], ['text' => 'h4', 'value' => 'h4'], ['text' => 'h5', 'value' => 'h5'], ['text' => 'h6', 'value' => 'h6'], ['text' => 'p', 'value' => 'p']], 'placeholder' => 'h3'],
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
        return ['shareStateWithChildSSR' => true, 'bypassPointerEvents' => false];
    }

    static function addPanelRules()
    {
        return ['alwaysHide' => false];
    }

    static public function actions()
    {
        return [

'onCreatedElement' => [['script' => 'window.manageBreakdanceAdvancedAccordion && window.manageBreakdanceAdvancedAccordion().update(\'%%SELECTOR%%\')

window.manageBreakdanceAdvancedAccordion && window.manageBreakdanceAdvancedAccordion().activateTabFromStructurePanel(\'%%SELECTOR%%\')',
],],

'onActivatedElement' => [['script' => 'window.manageBreakdanceAdvancedAccordion && window.manageBreakdanceAdvancedAccordion().activateTabFromStructurePanel(\'%%SELECTOR%%\')','runForAllChildren' => true,
],],

'onMovedElement' => [['script' => ' window.manageBreakdanceAdvancedAccordion && window.manageBreakdanceAdvancedAccordion().update(\'%%SELECTOR%%\')

window.manageBreakdanceAdvancedAccordion && window.manageBreakdanceAdvancedAccordion().activateTabFromStructurePanel(\'%%SELECTOR%%\')','runForAllChildren' => true,
],],

'onBeforeDeletingElement' => [['script' => ' window.manageBreakdanceAdvancedAccordion && window.manageBreakdanceAdvancedAccordion().update(\'%%SELECTOR%%\')',
],],];
    }

    static function nestingRule()
    {
        return ['type' => 'container', 'restrictedToBeADirectChildOf' => ['EssentialElements\AdvancedAccordion']];
    }

    static function spacingBars()
    {
        return false;
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
        return ['breakdance', 'oxygen'];
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
        return ['design.layout_v2.layout', 'design.layout_v2.h_vertical_at', 'design.layout_v2.h_alignment_when_vertical', 'design.layout_v2.a_display'];
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}
