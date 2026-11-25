<?php
// v1.0 | 2026-11-25

namespace BreakdanceCustomElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
    "BreakdanceCustomElements\\Bwcopytext",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class Bwcopytext extends \Breakdance\Elements\Element
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
        return 'Bw_copy_text';
    }

    static function className()
    {
        return 'bw-copy';
    }

    static function category()
    {
        return 'other';
    }

    static function badge()
    {
        return false;
    }

    static function description()
    {
        return '';
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
        return [];
    }

    static function contentControls()
    {
        return [c(
        "text",
        "Text",
        [c(
        "copy_text",
        "Copy Text",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true, 'format' => 'plain'], 'description' => 'Click to Copy Text that is copied'],
        false,
        false,
        ['Click to Copy Text'],
        ['accepts' => 'string', 'proOnly' => false]
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
        return ['0' =>  ['inlineScripts' => ['if (window.bwCopyInit) return; window.bwCopyInit = true;
(() => {
  const copy = el => {
    const text = el.dataset.copy || el.innerText.trim();
    navigator.clipboard.writeText(text).then(() => {
      el.classList.add(\'is-copied\');
      setTimeout(() => el.classList.remove(\'is-copied\'), 1800);
    });
  };
  document.addEventListener(\'click\', e => {
    const el = e.target.closest(\'.bw-copy\');
    if (el) copy(el);
  });
  document.addEventListener(\'keydown\', e => {
    const el = e.target.closest?.(\'.bw-copy\');
    if (el && (e.key === \'Enter\' || e.key === \' \')) { e.preventDefault(); copy(el); }
  });
})();
'],],];
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
        return false;
    }

    static function attributes()
    {
        return [['name' => 'role', 'template' => 'button'], ['name' => 'tabindex', 'template' => '0']];
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
        return false;
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}
