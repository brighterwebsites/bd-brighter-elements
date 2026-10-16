# Brighter BD Elements

Custom [Breakdance](https://breakdance.com/) elements by [Brighter Websites](https://brighterwebsites.com.au/).
The `Scos_*` elements render content from the SCOS / Site Essentials MU plugin (FAQs, reviews, TL;DR, breadcrumbs);
the rest are general-purpose layout and content elements.

## Requirements

- WordPress with Breakdance
- SCOS / Site Essentials MU plugin for the `Scos_*` elements (they show a builder placeholder without it)

## Element status

**Active** (shown in the builder Add panel):
`Scos_*` (Aggregate Review, Breadcrumbs, FAQs, Review Card, TL;DR), `Accordion_Content_Extended`, `TableRows`, `Table_Cell`, `Table_Text`, `Text_Extended`.

**Hidden** (replaced by Breakdance fundamental elements):
`Definition`, `Definitions_Box`, `Description_Text`, `Extended_Wrapper`, `Section_Simple`, `Summary`.

Hidden elements are still registered, so pages that already use them keep rendering and stay editable. They only drop out of the Add panel. This is Element Studio's "Always hide" setting, stored in `element.php` as:

```php
static function addPanelRules()
{
    return ['alwaysHide' => true];
}
```

Don't delete a hidden element's folder until no live site uses it. Removing it breaks any page that still contains it.

## Structure

- `plugin.php` registers the element, macro and preset save locations with Breakdance Element Studio
- `elements/<Name>/` one element per folder (`element.php`, `html.twig`, `css.twig`, `default.css`, optional `ssr.php`)
- `includes/` dropdown option providers used by element controls

Licence: GPLv2.
