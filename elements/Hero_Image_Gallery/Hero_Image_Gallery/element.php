<?php

namespace BreakdanceClientSpecificElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
    "BreakdanceClientSpecificElements\\HeroImageGallery",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class HeroImageGallery extends \Breakdance\Elements\Element
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
        return 'Hero Image Gallery';
    }

    static function className()
    {
        return 'bde-hero-gallery-div';
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
        return [['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'media_library', 'lazy_load' => true, 'alt' => 'from_media_library', 'media' => ['id' => 3038, 'filename' => 'gisborne-country-garden-native-mass-planting-paal-grant-030.jpg', 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-native-mass-planting-paal-grant-030.jpg', 'alt' => 'Mass planted native garden with orange flowering plants, grasses and boulders beside modern home in Gisborne Macedon Ranges', 'caption' => 'Mass plantings of natives create seasonal colour and movement around natural boulders. We layered grasses and perennials for year-round structure that handles Macedon Ranges frost.', 'mime' => 'image/jpeg', 'type' => 'image', 'sizes' => ['thumbnail' => ['height' => 96, 'width' => 96, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-native-mass-planting-paal-grant-030-150x150.jpg', 'orientation' => 'landscape'], 'medium' => ['height' => 225, 'width' => 300, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-native-mass-planting-paal-grant-030-300x225.jpg', 'orientation' => 'landscape'], 'og-image' => ['height' => 630, 'width' => 1200, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-native-mass-planting-paal-grant-030-1200x630.jpg', 'orientation' => 'landscape'], 'medium_large' => ['height' => 576, 'width' => 768, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-native-mass-planting-paal-grant-030-768x576.jpg', 'orientation' => 'landscape'], '1536x1536' => ['height' => 1152, 'width' => 1536, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-native-mass-planting-paal-grant-030-1536x1152.jpg', 'orientation' => 'landscape'], 'social-square' => ['height' => 1080, 'width' => 1080, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-native-mass-planting-paal-grant-030-1080x1080.jpg', 'orientation' => 'landscape'], 'full' => ['url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-native-mass-planting-paal-grant-030.jpg', 'height' => 1800, 'width' => 2400, 'orientation' => 'landscape']], 'attributes' => ['srcset' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-native-mass-planting-paal-grant-030.jpg 2400w, https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-native-mass-planting-paal-grant-030-300x225.jpg 300w, https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-native-mass-planting-paal-grant-030-768x576.jpg 768w, https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-native-mass-planting-paal-grant-030-1536x1152.jpg 1536w', 'sizes' => '(max-width: 2400px) 100vw, 2400px']]]], 'settings' => ['advanced' => ['classes' => ['hslide'], 'id' => 'hs2']], 'meta' => ['imageDimensions' => ['renderedWidthPx' => 0, 'renderedHeightPx' => 0]]], 'children' => []], ['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'media_library', 'lazy_load' => true, 'alt' => 'from_media_library', 'media' => ['id' => 3040, 'filename' => 'gisborne-country-garden-stone-garden-steps-paal-grant-032.jpg', 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-stone-garden-steps-paal-grant-032.jpg', 'alt' => 'Natural stone steps through native plantings with purple flowers and red foliage on modern rooftop garden in Gisborne', 'caption' => 'Bluestone treads create gentle movement through layered natives, with kangaroo paw and purple perennials softening the transition between levels.', 'mime' => 'image/jpeg', 'type' => 'image', 'sizes' => ['thumbnail' => ['height' => 96, 'width' => 96, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-stone-garden-steps-paal-grant-032-150x150.jpg', 'orientation' => 'landscape'], 'medium' => ['height' => 225, 'width' => 300, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-stone-garden-steps-paal-grant-032-300x225.jpg', 'orientation' => 'landscape'], 'og-image' => ['height' => 630, 'width' => 1200, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-stone-garden-steps-paal-grant-032-1200x630.jpg', 'orientation' => 'landscape'], 'medium_large' => ['height' => 576, 'width' => 768, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-stone-garden-steps-paal-grant-032-768x576.jpg', 'orientation' => 'landscape'], '1536x1536' => ['height' => 1152, 'width' => 1536, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-stone-garden-steps-paal-grant-032-1536x1152.jpg', 'orientation' => 'landscape'], 'social-square' => ['height' => 1080, 'width' => 1080, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-stone-garden-steps-paal-grant-032-1080x1080.jpg', 'orientation' => 'landscape'], 'full' => ['url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-stone-garden-steps-paal-grant-032.jpg', 'height' => 1800, 'width' => 2400, 'orientation' => 'landscape']], 'attributes' => ['srcset' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-stone-garden-steps-paal-grant-032.jpg 2400w, https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-stone-garden-steps-paal-grant-032-300x225.jpg 300w, https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-stone-garden-steps-paal-grant-032-768x576.jpg 768w, https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-stone-garden-steps-paal-grant-032-1536x1152.jpg 1536w', 'sizes' => '(max-width: 2400px) 100vw, 2400px']]]], 'settings' => ['advanced' => ['classes' => ['hslide'], 'id' => 'hs1']], 'meta' => ['imageDimensions' => ['renderedWidthPx' => 0, 'renderedHeightPx' => 0]]], 'children' => []], ['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'media_library', 'lazy_load' => true, 'alt' => 'from_media_library', 'media' => ['id' => 3031, 'filename' => 'gisborne-country-garden-curved-aggregate-paths-paal-grant-023.jpg', 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-023.jpg', 'alt' => 'Curved exposed aggregate paths wind through landscaped courtyard with basalt boulders and native plants in Gisborne', 'caption' => 'Exposed aggregate curves through the garden for grip and drainage on clay, connecting deck to pool while framing views toward the paddock beyond.', 'mime' => 'image/jpeg', 'type' => 'image', 'sizes' => ['thumbnail' => ['height' => 96, 'width' => 96, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-023-150x150.jpg', 'orientation' => 'landscape'], 'medium' => ['height' => 225, 'width' => 300, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-023-300x225.jpg', 'orientation' => 'landscape'], 'og-image' => ['height' => 630, 'width' => 1200, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-023-1200x630.jpg', 'orientation' => 'landscape'], 'medium_large' => ['height' => 576, 'width' => 768, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-023-768x576.jpg', 'orientation' => 'landscape'], '1536x1536' => ['height' => 1152, 'width' => 1536, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-023-1536x1152.jpg', 'orientation' => 'landscape'], 'social-square' => ['height' => 1080, 'width' => 1080, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-023-1080x1080.jpg', 'orientation' => 'landscape'], 'full' => ['url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-023.jpg', 'height' => 1800, 'width' => 2400, 'orientation' => 'landscape']], 'attributes' => ['srcset' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-023.jpg 2400w, https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-023-300x225.jpg 300w, https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-023-768x576.jpg 768w, https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-023-1536x1152.jpg 1536w', 'sizes' => '(max-width: 2400px) 100vw, 2400px']]]], 'settings' => ['advanced' => ['classes' => ['hslide'], 'id' => 'hs3']], 'meta' => ['imageDimensions' => ['renderedWidthPx' => 0, 'renderedHeightPx' => 0]]], 'children' => []], ['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'media_library', 'lazy_load' => true, 'alt' => 'from_media_library', 'media' => ['id' => 3030, 'filename' => 'gisborne-country-garden-curved-aggregate-paths-paal-grant-022.jpg', 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-022.jpg', 'alt' => 'Curved exposed aggregate pathways winding through open lawn areas in Gisborne Macedon Ranges country garden design', 'caption' => 'Exposed aggregate curves through open lawn, creating grip and drainage while guiding movement from deck to pool. We chose the textured finish for wet traction and freeze-thaw resilience in regional conditions.', 'mime' => 'image/jpeg', 'type' => 'image', 'sizes' => ['thumbnail' => ['height' => 96, 'width' => 96, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-022-150x150.jpg', 'orientation' => 'landscape'], 'medium' => ['height' => 225, 'width' => 300, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-022-300x225.jpg', 'orientation' => 'landscape'], 'og-image' => ['height' => 630, 'width' => 1200, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-022-1200x630.jpg', 'orientation' => 'landscape'], 'medium_large' => ['height' => 576, 'width' => 768, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-022-768x576.jpg', 'orientation' => 'landscape'], '1536x1536' => ['height' => 1152, 'width' => 1536, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-022-1536x1152.jpg', 'orientation' => 'landscape'], 'social-square' => ['height' => 1080, 'width' => 1080, 'url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-022-1080x1080.jpg', 'orientation' => 'landscape'], 'full' => ['url' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-022.jpg', 'height' => 1800, 'width' => 2400, 'orientation' => 'landscape']], 'attributes' => ['srcset' => 'https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-022.jpg 2400w, https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-022-300x225.jpg 300w, https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-022-768x576.jpg 768w, https://dev.paalgrant.com/wp-content/uploads/2026/03/gisborne-country-garden-curved-aggregate-paths-paal-grant-022-1536x1152.jpg 1536w', 'sizes' => '(max-width: 2400px) 100vw, 2400px']]]], 'settings' => ['advanced' => ['classes' => ['hslide'], 'id' => 'hs4']], 'meta' => ['imageDimensions' => ['renderedWidthPx' => 0, 'renderedHeightPx' => 0]]], 'children' => []]];
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
       ['condition' => [[['path' => 'design.layout', 'operand' => 'is set', 'value' => '']]], 'type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\LayoutV2",
      "Layout",
      "layout_v2",
       ['condition' => [[['path' => 'design.layout', 'operand' => 'is not set', 'value' => '']]], 'type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\LessFancyBackground",
      "Background",
      "background",
       ['type' => 'popout']
     ), getPresetSection(
      "BreakdanceClientSpecificElements\\LessFancyForeground",
      "Foreground",
      "foreground",
       ['type' => 'popout']
     ), c(
        "container",
        "Container",
        [c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
        
      ), c(
        "min_height",
        "Min Height",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
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
        return [];
    }

    static function settingsControls()
    {
        return [];
    }

    static function dependencies()
    {
        return ['0' =>  ['inlineScripts' => ['let slides = document.querySelectorAll(\'.bde-hero-gallery-div img\');



const delayBetweenSlides = 1; // Delay in seconds

const speed = 3; // Animation speed in seconds

const shuffleOnLoad = true; // Set to true to shuffle, false to keep order



const reduceMotion = window.matchMedia(\'(prefers-reduced-motion: reduce)\').matches;



if (shuffleOnLoad) {

    slides = Array.from(slides).sort(() => Math.random() - 0.5);

    slides.forEach(slide => slide.parentNode.appendChild(slide));

}



// If user prefers reduced motion, just show the first slide and stop.

if (reduceMotion) {

    slides.forEach((slide, i) => {

        slide.style.opacity = i === 0 ? 1 : 0;

    });

    return;

}



const tl = gsap.timeline({

    defaults: { duration: speed, ease: "none" },

    scrollTrigger: {

        trigger: \'.bde-hero-gallery-div\',

        toggleActions: "play pause play pause"

    }

});



slides.forEach((slide, index) => {

    const nextIndex = (index + 1) % slides.length;

    tl.to(slide, {

            opacity: 0,

            delay: delayBetweenSlides

        })

        .to(slides[nextIndex], {

            opacity: 1,

        }, `-=${speed}`);

});



tl.repeat(-1);

'],],];
    }

    static function settings()
    {
        return ['proOnly' => true, 'disableAI' => true];
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
        return ['design.background.type', 'design.layout.horizontal.vertical_at', 'design.layout_v2.layout', 'design.layout_v2.h_vertical_at', 'design.layout_v2.h_alignment_when_vertical', 'design.layout_v2.a_display', 'design.foreground.image', 'design.foreground.overlay.image', 'design.foreground.image_settings.unset_image_at', 'design.foreground.image_settings.size', 'design.foreground.image_settings.height', 'design.foreground.image_settings.repeat', 'design.foreground.image_settings.position', 'design.foreground.image_settings.left', 'design.foreground.image_settings.top', 'design.foreground.image_settings.attachment', 'design.foreground.image_settings.custom_position', 'design.foreground.image_settings.width', 'design.foreground.overlay.image_settings.custom_position', 'design.foreground.image_size', 'design.foreground.overlay.image_size', 'design.foreground.overlay.type', 'design.foreground.image_settings'];
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}
