<?php
// v1.0 | 2026-08-11

namespace BreakdanceCustomElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
    "BreakdanceCustomElements\\Tablerows",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class Tablerows extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return 'SquareIcon';
    }

    static function tag()
    {
        return 'table';
    }

    static function tagOptions()
    {
        return [];
    }

    static function tagControlPath()
    {
        return "content.the_table_tags.table_outer_tags";
    }

    static function name()
    {
        return 'Table Outers';
    }

    static function className()
    {
        return 'bde-table__table';
    }

    static function category()
    {
        return 'other';
    }

    static function badge()
    {
        return ['backgroundColor' => 'var(--black)', 'textColor' => 'var(--white)', 'label' => 'outer'];
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
        return ['content' => ['the_table_tags' => ['table_outer_tags' => 'table'], 'settings' => ['table_behaviour' => 'standard']]];
    }

    static function defaultChildren()
    {
        return [['slug' => 'BreakdanceCustomElements\TableText'], ['slug' => 'BreakdanceCustomElements\TableText'], ['slug' => 'BreakdanceCustomElements\TableCell']];
    }

    static function cssTemplate()
    {
        $template = file_get_contents(__DIR__ . '/css.twig');
        return $template;
    }

    static function designControls()
    {
        return [getPresetSection(
      "EssentialElements\\LessFancyBackground",
      "Background",
      "background",
       ['condition' => [[['path' => 'content.the_table_tags.table_outer_tags', 'operand' => 'equals', 'value' => 'table']]], 'type' => 'popout']
     ), c(
        "text",
        "Text",
        [getPresetSection(
      "EssentialElements\\typography",
      "Headings",
      "headings",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography",
      "Cell Text",
      "cell_text",
       ['type' => 'popout']
     )],
        ['type' => 'section', 'condition' => [[['path' => '', 'operand' => 'equals', 'value' => '']]]],
        false,
        false,
        [],
        
      ), c(
        "table_styles",
        "Table Styles",
        [getPresetSection(
      "EssentialElements\\background",
      "Header BG",
      "header_bg",
       ['type' => 'popout']
     ), c(
        "even_rows_bg",
        "Even Rows BG",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        true,
        [],
        
      ), c(
        "odd_rows_bg",
        "Odd Rows BG",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        true,
        [],
        
      ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding (All)",
      "spacing_padding_all",
       ['type' => 'popout']
     ), c(
        "header_align_text",
        "Header Align Text",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'Top', 'text' => 'Top'], ['text' => 'Center', 'value' => 'Center'], ['text' => 'Bottom', 'value' => 'Bottom']]],
        false,
        false,
        [],
        
      ), c(
        "cell_align_text",
        "Cell Align Text",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'center', 'text' => 'Center'], ['text' => 'Top', 'value' => 'top'], ['text' => 'bottom', 'value' => 'bottom']]],
        false,
        false,
        [],
        
      ), c(
        "border_width",
        "Border Width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
        
      ), c(
        "border_color",
        "Border Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
        
      ), c(
        "border_radius",
        "Border Radius",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
        
      )],
        ['type' => 'section', 'condition' => [[['path' => 'content.the_table_tags.table_outer_tags', 'operand' => 'equals', 'value' => 'table']]]],
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
        "the_table_tags",
        "The Table Tags",
        [c(
        "table_outer_tags",
        "Table Outer Tags",
        [],
        ['type' => 'dropdown', 'layout' => 'vertical', 'items' => [['text' => 'Table', 'value' => 'table'], ['text' => 'Table Head (thead)', 'value' => 'thead'], ['value' => 'tbody', 'text' => 'Table Body (tbody)'], ['value' => 'tfoot', 'text' => 'Table Foot (tfoot)'], ['value' => 'tr', 'text' => 'Table Row (tr)'], ['value' => 'td', 'text' => 'Table Cell (td)'], ['value' => 'th', 'text' => 'Header Cell (th)'], ['value' => 'figure', 'text' => 'Figure']]],
        false,
        false,
        [],
        
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
        
      ), c(
        "settings",
        "Settings",
        [c(
        "table_behaviour",
        "Table Behaviour",
        [],
        ['type' => 'dropdown', 'layout' => 'vertical', 'items' => [['text' => 'Standard Table', 'value' => 'standard'], ['value' => 'collapse-row-labels', 'text' => 'ROW COLLAPSE WITH LABELS'], ['text' => 'ROW COLLAPSE NO LABELS', 'value' => 'collapse-row'], ['text' => 'COLUMN COLLAPSE CARDS', 'value' => 'collapse-col']]],
        false,
        false,
        [],
        
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.the_table_tags.table_outer_tags', 'operand' => 'equals', 'value' => 'table']]]],
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
        return ['0' =>  ['title' => 'JS_TableControl','inlineScripts' => ['document.addEventListener(\'DOMContentLoaded\', function () {

  const BREAKPOINT = 680;


  // ============================================================
  // UTILITY: get table element from a figure.wp-block-table
  // ============================================================
  function getTable(el) {
    return el.tagName === \'TABLE\' ? el : el.querySelector(\'table\');
  }


  // ============================================================
  // 1. ROW COLLAPSE WITH LABELS
  // Pure CSS job — JS just stamps data-label on each td.
  // Runs once, no teardown needed (labels are harmless on desktop).
  // ============================================================
document.querySelectorAll(
  \'.bde-table__table.bw-collapse-row-labels\'
).forEach(function (wrapper) {
    const table = getTable(wrapper);
    if (!table) return;

const headers = Array.from(table.querySelectorAll(\'thead th, thead td\'))
  .map(th => th.textContent.trim());
    table.querySelectorAll(\'tbody tr\').forEach(function (tr) {
      tr.querySelectorAll(\'td\').forEach(function (td, i) {
        if (headers[i]) td.setAttribute(\'data-label\', headers[i]);
      });
    });
  });


'],],];
    }

    static function settings()
    {
        return ['disableRootHtmlTag' => false];
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
        return 73;
    }

    static function dynamicPropertyPaths()
    {
        return false;
    }

    static function additionalClasses()
    {
        return [['name' => 'bw-collapse-row-labels', 'template' => '{{ content.settings.table_behaviour == \'collapse-row-labels\' }}']];
    }

    static function projectManagement()
    {
        return ['looksGood' => 'yes', 'optionsGood' => 'yes', 'optionsWork' => 'yes'];
    }

    static function propertyPathsToWhitelistInFlatProps()
    {
        return ['design.background.type', 'design.layout.horizontal.vertical_at', 'design.layout_v2.layout', 'design.layout_v2.h_vertical_at', 'design.layout_v2.h_alignment_when_vertical', 'design.layout_v2.a_display', 'design.background.image', 'design.background.overlay.image', 'design.background.image_settings.unset_image_at', 'design.background.image_settings.size', 'design.background.image_settings.height', 'design.background.image_settings.repeat', 'design.background.image_settings.position', 'design.background.image_settings.left', 'design.background.image_settings.top', 'design.background.image_settings.attachment', 'design.background.image_settings.custom_position', 'design.background.image_settings.width', 'design.background.overlay.image_settings.custom_position', 'design.background.image_size', 'design.background.overlay.image_size', 'design.background.overlay.type', 'design.background.image_settings'];
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}
