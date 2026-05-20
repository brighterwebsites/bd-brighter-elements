<?php

namespace BreakdanceCustomElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
    "BreakdanceCustomElements\\SectionSimple",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class SectionSimple extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return 'RectangleWideIcon';
    }

    static function tag()
    {
        return 'section';
    }

    static function tagOptions()
    {
        return ['div', 'header', 'footer', 'article', 'main', 'aside', 'nav', 'a'];
    }

    static function tagControlPath()
    {
        return false;
    }

    static function name()
    {
        return 'Section Simple';
    }

    static function className()
    {
        return 'bde-section-simple';
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
        return ['design' => ['layout_v2' => ['layout' => 'vertical']]];
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
       ['condition' => [[['path' => 'design.layout', 'operand' => 'is set', 'value' => '']]], 'type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\LayoutV2",
      "Layout",
      "layout_v2",
       ['condition' => [[['path' => 'design.layout', 'operand' => 'is not set', 'value' => '']]], 'type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\fancy_background",
      "Background",
      "background",
       ['type' => 'popout']
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
        
      ), c(
        "buttons",
        "Buttons",
        [getPresetSection(
      "EssentialElements\\AtomV1CustomButtonDesign",
      "Primary",
      "primary",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\AtomV1CustomButtonDesign",
      "Secondary",
      "secondary",
       ['type' => 'popout']
     )],
        ['type' => 'section'],
        false,
        false,
        [],
        
      ), c(
        "size",
        "Size",
        [c(
        "height",
        "Height",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'fit-content', 'text' => 'Fit Content'], ['text' => 'Viewport', 'value' => 'viewport'], ['text' => 'Custom', 'value' => 'custom']]],
        true,
        false,
        [],
        
      ), c(
        "custom_height",
        "Custom Height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['path' => 'design.size.height', 'operand' => 'equals', 'value' => 'custom']],
        true,
        false,
        [],
        
      ), c(
        "min_height",
        "Min Height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['path' => 'design.size.height', 'operand' => 'equals', 'value' => 'custom']],
        true,
        false,
        [],
        
      ), c(
        "width",
        "Width",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'contained', 'text' => 'Contained'], ['text' => 'Full', 'value' => 'full'], ['text' => 'Custom', 'value' => 'custom']]],
        true,
        false,
        [],
        
      ), c(
        "container_width",
        "Container Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['path' => 'design.size.width', 'operand' => 'equals', 'value' => 'custom']],
        true,
        false,
        [],
        
      )],
        ['type' => 'section'],
        false,
        false,
        [],
        
      ), c(
        "spacing",
        "Spacing",
        [c(
        "padding",
        "Padding",
        [],
        ['type' => 'spacing_complex', 'layout' => 'vertical'],
        true,
        false,
        [],
        
      ), c(
        "margin_top",
        "Margin Top",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
        
      ), c(
        "margin_bottom",
        "Margin Bottom",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
        
      )],
        ['type' => 'section'],
        false,
        false,
        [],
        
      ), c(
        "dividers",
        "Dividers",
        [getPresetSection(
      "EssentialElements\\Shape",
      "Shape Dividers",
      "shape_dividers_section",
       ['type' => 'accordion']
     )],
        ['type' => 'section'],
        false,
        false,
        [],
        
      ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
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
        return ['0' =>  ['inlineScripts' => ['{% if design.background.type == \'slideshow\' %}
window.BreakdanceSwiper().update({
  selector:\'%%SELECTOR%%\',
  id: \'%%UNIQUESLUG%%\',
  isBuilder: false,
  settings: {
     allowTouchMove: false,
     {% if design.background.slideshow_settings.play_only_once is empty %}
        infinite: "enabled",
      {% endif %}
      speed: { number: {{ design.background.slideshow_settings.effect_duration.number ?? 300 }} },
      autoplay: "enabled",
      autoplay_settings: {
        speed: { number: {{ design.background.slideshow_settings.slide_duration.number ?? 3000 }} },
        pause_on_hover: false,
        stop_on_interaction: false,
      },
      {% if design.background.slideshow_settings.transition_effect and design.background.slideshow_settings.transition_effect != "slide" %}
        effect: "{{ design.background.slideshow_settings.transition_effect }}",
      {% endif %}
      {% if design.background.slideshow_settings.slide_direction %}
        direction: "{{ design.background.slideshow_settings.slide_direction }}",
      {% endif %}
  },
  paginationSettings: {},
  advancedSettings: {},
  extras : {
  	autoplay: true
  }
});
{% endif %}'],'scripts' => ['%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/swiper@8/swiper-bundle.min.js','%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/breakdance-swiper/breakdance-swiper.js'],'inlineStyles' => ['',''],'styles' => ['%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/swiper@8/swiper-bundle.min.css'],'builderCondition' => '{% if design.background.type == \'slideshow\' %}
return true;
{% else%}
 return false;
{% endif %}','frontendCondition' => '{% if design.background.type == \'slideshow\' %}
return true;
{% else%}
 return false;
{% endif %}','title' => 'Slideshow',],'1' =>  ['scripts' => ['https://www.youtube.com/iframe_api','%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/breakdance-youtube@1/breakdance-youtube.js'],'inlineScripts' => ['window.YT.ready(() => {
  
  const { matchMedia } = window.BreakdanceFrontend.utils;
  if ({{ design.background.video_settings.play_on_mobile ? \'false\' : \'true\' }} && matchMedia(\'breakpoint_phone_landscape\')) {
    return;
  }
  const element = document.querySelector(\'#youtubeEmbed%%ID%%\');
  window.breakdanceYoutube.createInstance(%%ID%%, {
    videoId: "{{ design.background.video.videoId }}",
    loop: {{ design.background.video_settings.no_loop == 1 ? \'false\' : \'true\' }},
    start_time: {{ design.background.video_settings.start_time ?? 0 }},
    end_time: {{ design.background.video_settings.end_time ?? \'null\' }},
    pause_when_out_of_view: {{ design.background.video_settings.pause_when_out_of_view == 1 ? \'true\' : \'false\' }},
    privacy_mode: {{ design.background.video_settings.youtube_privacy_mode ? \'true\' : \'false\' }},
  });
});'],'frontendCondition' => '{% if design.background.type == \'video\' 
  and \'youtube\' in design.background.video.embedUrl  
%}
return true;
{% else%}
 return false;
{% endif %}','title' => 'Youtube','builderCondition' => '{% if design.background.type == \'video\' 
  and \'youtube\' in design.background.video.embedUrl  
%}
return true;
{% else%}
 return false;
{% endif %}',],'2' =>  ['title' => 'Vimeo','scripts' => ['https://player.vimeo.com/api/player.js','%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/breakdance-vimeo@1/breakdance-vimeo.js'],'inlineScripts' => ['(function() {
  const element = document.querySelector(\'%%SELECTOR%% #vimeoEmbed%%ID%%\');
  window.breakdanceVimeo.createInstance(element, %%ID%%, {
                                     id: "{{ design.background.video.embedUrl }}",
                                     loop: {{ design.background.video_settings.no_loop == 1 ? \'false\' : \'true\' }},
  start_time: {{ design.background.video_settings.start_time ?? 0 }},
    end_time: {{ design.background.video_settings.end_time ?? \'null\' }},
      pause_when_out_of_view: {{ design.background.video_settings.pause_when_out_of_view == 1 ? \'true\' : \'false\' }},
    playsinline: {{ design.background.video_settings.play_on_mobile ? \'true\' : \'false\' }},
});
})();'],'frontendCondition' => '{% if design.background.type == \'video\' 
  and \'vimeo\' in design.background.video.embedUrl  
%}
return true;
{% else%}
 return false;
{% endif %}','builderCondition' => '{% if design.background.type == \'video\' 
  and \'vimeo\' in design.background.video.embedUrl  
%}
return true;
{% else%}
 return false;
{% endif %}',],'3' =>  ['title' => 'Video - on mobile','inlineScripts' => ['(function() {
let video = document.querySelector("%%SELECTOR%% video");

const { matchMedia } = window.BreakdanceFrontend.utils;
if (matchMedia(\'breakpoint_phone_landscape\') || matchMedia(\'breakpoint_phone_portrait\')) {
  video.removeAttribute(\'autoplay\');
}})();
'],'frontendCondition' => '{% if design.background.type == \'video\'
  and design.background.video.type == \'video\' 
  and design.background.video_settings.play_on_mobile == 0 %}
return true;
{% else%}
 return false;
{% endif %}','builderCondition' => '{% if design.background.type == \'video\'
  and design.background.video.type == \'video\' 
  and design.background.video_settings.play_on_mobile == 0 %}
return true;
{% else%}
 return false;
{% endif %}',],'4' =>  ['title' => 'Video - auto pause','inlineScripts' => ['let video = document.querySelector("%%SELECTOR%% video");

let isPaused = false;
let observer = new IntersectionObserver((entries, observer) => {
  entries.forEach(entry => {
    if (entry.intersectionRatio != 1  && !video.paused) {
      video.pause(); isPaused = true;
    } else if (isPaused) {
      video.play(); isPaused=false;
    }
  });
}, {threshold: 0.2});
observer.observe(video) ;'],'builderCondition' => '{% if design.background.type == \'video\'
  and design.background.video.type == \'video\' 
  and design.background.video_settings.pause_when_out_of_view == 1 %}
return true;
{% else%}
 return false;
{% endif %}','frontendCondition' => '{% if design.background.type == \'video\'
  and design.background.video.type == \'video\' 
  and design.background.video_settings.pause_when_out_of_view == 1 %}
return true;
{% else%}
 return false;
{% endif %}',],];
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
        return [

'onMountedElement' => [['script' => '{% if design.background.type == \'slideshow\' %}
window.BreakdanceSwiper().update({
  selector:\'%%SELECTOR%%\',
  id: \'%%ID%%\',
  isBuilder: true,
  settings: {
    allowTouchMove: false,
    allowTouchMove: false,
    {% if design.background.slideshow_settings.play_only_once %}
        infinite:false,
      {% else %}
        infinite: "enabled",
      {% endif %}
	  speed: { number: {{ design.background.slideshow_settings.effect_duration.number ?? 300 }} },
      autoplay: "enabled",
      autoplay_settings: {
        speed: { number: {{ design.background.slideshow_settings.slide_duration.number ?? 3000 }} },
        pause_on_hover: false,
        stop_on_interaction: false,
      },
      {% if design.background.slideshow_settings.transition_effect and design.background.slideshow_settings.transition_effect != "slide" %}
        effect: "{{ design.background.slideshow_settings.transition_effect }}",
      {% endif %}
      {% if design.background.slideshow_settings.slide_direction %}
        direction: "{{ design.background.slideshow_settings.slide_direction }}",
      {% endif %}
  },
  paginationSettings: {},
  advancedSettings: {},
  extras : {
  	autoplay: true
  }
});
{% endif %}',
],],

'onPropertyChange' => [['script' => '{% if design.background.type == \'slideshow\' %}
window.BreakdanceSwiper().update({
  selector:\'%%SELECTOR%%\',
  id: \'%%ID%%\',
  settings: {
    allowTouchMove: false,
    {% if design.background.slideshow_settings.play_only_once %}
        infinite:false,
      {% else %}
        infinite: "enabled",
      {% endif %}
	  speed: { number: {{ design.background.slideshow_settings.effect_duration.number ?? 300 }} },
      autoplay: "enabled",
      autoplay_settings: {
        speed: { number: {{ design.background.slideshow_settings.slide_duration.number ?? 3000 }} },
        pause_on_hover: false,
        stop_on_interaction: false,
      },
      {% if design.background.slideshow_settings.transition_effect and design.background.slideshow_settings.transition_effect != "slide" %}
        effect: "{{ design.background.slideshow_settings.transition_effect }}",
      {% endif %}
      {% if design.background.slideshow_settings.slide_direction %}
        direction: "{{ design.background.slideshow_settings.slide_direction }}",
      {% endif %}
  },
  paginationSettings: {},
  advancedSettings: {},
  extras : {
  	autoplay: true
  }
});
{% endif %}',
],['script' => '{% if design.background.type == \'video\' and design.background.video.type == \'oembed\' %}
  {% if \'youtube\' in design.background.video.embedUrl %}
    window.YT.ready(() => {
      const element = document.querySelector(\'%%SELECTOR%% .section-youtube-wrapper\');
      window.breakdanceYoutube.updateInstance(element, %%ID%%, {
        videoId: "{{ design.background.video.videoId }}",
        loop: {{ design.background.video_settings.no_loop == 1 ? \'false\' : \'true\' }},
        start_time: {{ design.background.video_settings.start_time ?? 0 }},
        end_time: {{ design.background.video_settings.end_time ?? \'null\' }},
        pause_when_out_of_view: {{ design.background.video_settings.pause_when_out_of_view == 1 ? \'true\' : \'false\' }},
        privacy_mode: {{ design.background.video_settings.youtube_privacy_mode ?? \'false\' }},
      });
    });
  {% endif %} 
  {% if \'vimeo\' in design.background.video.embedUrl %}
    (function() {
      const element = document.querySelector(\'%%SELECTOR%% #vimeoEmbed%%ID%%\');
      window.breakdanceVimeo.updateInstance(element, %%ID%%, {
        id: "{{ design.background.video.embedUrl }}",
        loop: {{ design.background.video_settings.no_loop == 1 ? \'false\' : \'true\' }},
        start_time: {{ design.background.video_settings.start_time ?? 0 }},
        end_time: {{ design.background.video_settings.end_time ?? \'null\' }},
        pause_when_out_of_view: {{ design.background.video_settings.pause_when_out_of_view == 1 ? \'true\' : \'false\' }},
      });
    })();
  {%endif%}
{% endif %}',
],],

'onMovedElement' => [['script' => '{% if design.background.type == \'slideshow\' %}
window.BreakdanceSwiper().update({
  selector:\'%%SELECTOR%%\',
  id: \'%%ID%%\',
  isBuilder: false,
  settings: {
    allowTouchMove: false,
    {% if design.background.slideshow_settings.play_only_once %}
        infinite:false,
      {% else %}
        infinite: "enabled",
      {% endif %}
	  speed: { number: {{ design.background.slideshow_settings.effect_duration.number ?? 300 }} },
      autoplay: "enabled",
      autoplay_settings: {
        speed: { number: {{ design.background.slideshow_settings.slide_duration.number ?? 3000 }} },
        pause_on_hover: false,
        stop_on_interaction: false,
      },
      {% if design.background.slideshow_settings.transition_effect and design.background.slideshow_settings.transition_effect != "slide" %}
        effect: "{{ design.background.slideshow_settings.transition_effect }}",
      {% endif %}
      {% if design.background.slideshow_settings.slide_direction %}
        direction: "{{ design.background.slideshow_settings.slide_direction }}",
      {% endif %}
  },
  paginationSettings: {},
  advancedSettings: {},
  extras : {
  	autoplay: true
  }
});
{% endif %}',
],],

'onBeforeDeletingElement' => [['script' => '{% if design.background.type == \'slideshow\' %}
window.BreakdanceSwiper().destroy(
  \'%%ID%%\'
);
{% endif %}',
],],];
    }

    static function nestingRule()
    {
        return ['type' => 'section'];
    }

    static function spacingBars()
    {
        return [['cssProperty' => 'padding-top', 'location' => 'inside-top', 'affectedPropertyPath' => 'design.spacing.padding.%%BREAKPOINT%%.top'], ['cssProperty' => 'padding-bottom', 'location' => 'inside-bottom', 'affectedPropertyPath' => 'design.spacing.padding.%%BREAKPOINT%%.bottom']];
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
        return ['design.layout.align_children', 'design.layout.advanced.flex_direction', 'design.layout.advanced.align_items', 'design.layout.advanced.justify_content', 'design.layout.advanced.flex_wrap', 'design.layout.advanced.align_content', 'design.layout.advanced.gap', 'design.background.image', 'design.background.overlay.image', 'design.background.type', 'design.background.image_settings.unset_image_at', 'design.background.image_settings.size', 'design.background.image_settings.height', 'design.background.image_settings.repeat', 'design.background.image_settings.position', 'design.background.image_settings.left', 'design.background.image_settings.top', 'design.background.image_settings.attachment', 'design.background.image_settings.custom_position', 'design.background.image_settings.width', 'design.background.overlay.image_settings.custom_position', 'design.background.image_size', 'design.background.overlay.image_size', 'design.background.overlay.type', 'design.layout.horizontal.vertical_at', 'design.background.image_settings', 'design.dividers.shape_dividers_section.dividers[].position', 'design.dividers.shape_dividers_section.dividers[].flip_horizontally', 'design.layout_v2.layout', 'design.layout_v2.h_vertical_at', 'design.layout_v2.h_alignment_when_vertical', 'design.layout_v2.a_display', 'design.buttons.primary.custom.size.full_width_at', 'design.buttons.secondary.custom.size.full_width_at', 'design.buttons.primary.styles.size.full_width_at', 'design.buttons.primary.styles', 'design.buttons.secondary.styles.size.full_width_at', 'design.buttons.secondary.styles'];
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}
