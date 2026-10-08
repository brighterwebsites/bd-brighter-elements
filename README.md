# Brighter Websites Custom  Breakdance Elements - for SCOS MU 


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
