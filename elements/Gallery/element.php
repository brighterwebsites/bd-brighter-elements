<?php

namespace BreakdanceClientSpecificElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
    "BreakdanceClientSpecificElements\\Gallery",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class Gallery extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return 'ImageAndVideIcon';
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
        return 'SliderGallery';
    }

    static function className()
    {
        return 'bde-slider-gallery';
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
        return ['content' => ['content' => ['images' => [['type' => 'image', 'image' => ['id' => 133664, 'filename' => 'venti-views-Rk8IRfQLx0s-unsplash.jpg', 'url' => 'https://breakdance.com/wp-content/uploads/2024/10/venti-views-Rk8IRfQLx0s-unsplash.jpg', 'alt' => '', 'caption' => '', 'mime' => 'image/jpeg', 'type' => 'image', 'sizes' => ['thumbnail' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/venti-views-Rk8IRfQLx0s-unsplash-150x150.jpg', 'height' => 150, 'width' => 150, 'orientation' => 'landscape'], 'medium' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/venti-views-Rk8IRfQLx0s-unsplash-300x200.jpg', 'height' => 200, 'width' => 300, 'orientation' => 'landscape'], 'large' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/venti-views-Rk8IRfQLx0s-unsplash-1024x681.jpg', 'height' => 681, 'width' => 1024, 'orientation' => 'landscape'], 'medium_large' => ['height' => 511, 'width' => 768, 'url' => 'https://breakdance.com/wp-content/uploads/2024/10/venti-views-Rk8IRfQLx0s-unsplash-768x511.jpg', 'orientation' => 'landscape'], '1536x1536' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/venti-views-Rk8IRfQLx0s-unsplash-1536x1022.jpg', 'height' => 1022, 'width' => 1536, 'orientation' => 'landscape'], 'sl-small' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/venti-views-Rk8IRfQLx0s-unsplash-128x128.jpg', 'height' => 128, 'width' => 128, 'orientation' => 'landscape'], 'sl-large' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/venti-views-Rk8IRfQLx0s-unsplash-256x256.jpg', 'height' => 256, 'width' => 256, 'orientation' => 'landscape'], 'full' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/venti-views-Rk8IRfQLx0s-unsplash.jpg', 'height' => 1277, 'width' => 1920, 'orientation' => 'landscape']], 'attributes' => ['srcset' => 'https://breakdance.com/wp-content/uploads/2024/10/venti-views-Rk8IRfQLx0s-unsplash.jpg 1920w, https://breakdance.com/wp-content/uploads/2024/10/venti-views-Rk8IRfQLx0s-unsplash-300x200.jpg 300w, https://breakdance.com/wp-content/uploads/2024/10/venti-views-Rk8IRfQLx0s-unsplash-1024x681.jpg 1024w, https://breakdance.com/wp-content/uploads/2024/10/venti-views-Rk8IRfQLx0s-unsplash-768x511.jpg 768w, https://breakdance.com/wp-content/uploads/2024/10/venti-views-Rk8IRfQLx0s-unsplash-1536x1022.jpg 1536w', 'sizes' => '(max-width: 1920px) 100vw, 1920px']]], ['type' => 'image', 'image' => ['id' => 133657, 'filename' => 'andrea-ferrario-2XjzoIvMGHs-unsplash.jpg', 'url' => 'https://breakdance.com/wp-content/uploads/2024/10/andrea-ferrario-2XjzoIvMGHs-unsplash.jpg', 'alt' => '', 'caption' => '', 'mime' => 'image/jpeg', 'type' => 'image', 'sizes' => ['thumbnail' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/andrea-ferrario-2XjzoIvMGHs-unsplash-150x150.jpg', 'height' => 150, 'width' => 150, 'orientation' => 'landscape'], 'medium' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/andrea-ferrario-2XjzoIvMGHs-unsplash-200x300.jpg', 'height' => 300, 'width' => 200, 'orientation' => 'portrait'], 'large' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/andrea-ferrario-2XjzoIvMGHs-unsplash-683x1024.jpg', 'height' => 1024, 'width' => 683, 'orientation' => 'portrait'], 'medium_large' => ['height' => 1152, 'width' => 768, 'url' => 'https://breakdance.com/wp-content/uploads/2024/10/andrea-ferrario-2XjzoIvMGHs-unsplash-768x1152.jpg', 'orientation' => 'portrait'], '1536x1536' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/andrea-ferrario-2XjzoIvMGHs-unsplash-1024x1536.jpg', 'height' => 1536, 'width' => 1024, 'orientation' => 'portrait'], '2048x2048' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/andrea-ferrario-2XjzoIvMGHs-unsplash-1365x2048.jpg', 'height' => 2048, 'width' => 1365, 'orientation' => 'portrait'], 'sl-small' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/andrea-ferrario-2XjzoIvMGHs-unsplash-128x128.jpg', 'height' => 128, 'width' => 128, 'orientation' => 'landscape'], 'sl-large' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/andrea-ferrario-2XjzoIvMGHs-unsplash-256x256.jpg', 'height' => 256, 'width' => 256, 'orientation' => 'landscape'], 'full' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/andrea-ferrario-2XjzoIvMGHs-unsplash.jpg', 'height' => 2880, 'width' => 1920, 'orientation' => 'portrait']], 'attributes' => ['srcset' => 'https://breakdance.com/wp-content/uploads/2024/10/andrea-ferrario-2XjzoIvMGHs-unsplash.jpg 1920w, https://breakdance.com/wp-content/uploads/2024/10/andrea-ferrario-2XjzoIvMGHs-unsplash-200x300.jpg 200w, https://breakdance.com/wp-content/uploads/2024/10/andrea-ferrario-2XjzoIvMGHs-unsplash-683x1024.jpg 683w, https://breakdance.com/wp-content/uploads/2024/10/andrea-ferrario-2XjzoIvMGHs-unsplash-768x1152.jpg 768w, https://breakdance.com/wp-content/uploads/2024/10/andrea-ferrario-2XjzoIvMGHs-unsplash-1024x1536.jpg 1024w, https://breakdance.com/wp-content/uploads/2024/10/andrea-ferrario-2XjzoIvMGHs-unsplash-1365x2048.jpg 1365w', 'sizes' => '(max-width: 1920px) 100vw, 1920px']]], ['type' => 'image', 'image' => ['id' => 133659, 'filename' => 'jeremy-doddridge-efhEncQLi4w-unsplash.jpg', 'url' => 'https://breakdance.com/wp-content/uploads/2024/10/jeremy-doddridge-efhEncQLi4w-unsplash.jpg', 'alt' => '', 'caption' => '', 'mime' => 'image/jpeg', 'type' => 'image', 'sizes' => ['thumbnail' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/jeremy-doddridge-efhEncQLi4w-unsplash-150x150.jpg', 'height' => 150, 'width' => 150, 'orientation' => 'landscape'], 'medium' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/jeremy-doddridge-efhEncQLi4w-unsplash-300x200.jpg', 'height' => 200, 'width' => 300, 'orientation' => 'landscape'], 'large' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/jeremy-doddridge-efhEncQLi4w-unsplash-1024x683.jpg', 'height' => 683, 'width' => 1024, 'orientation' => 'landscape'], 'medium_large' => ['height' => 512, 'width' => 768, 'url' => 'https://breakdance.com/wp-content/uploads/2024/10/jeremy-doddridge-efhEncQLi4w-unsplash-768x512.jpg', 'orientation' => 'landscape'], '1536x1536' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/jeremy-doddridge-efhEncQLi4w-unsplash-1536x1024.jpg', 'height' => 1024, 'width' => 1536, 'orientation' => 'landscape'], 'sl-small' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/jeremy-doddridge-efhEncQLi4w-unsplash-128x128.jpg', 'height' => 128, 'width' => 128, 'orientation' => 'landscape'], 'sl-large' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/jeremy-doddridge-efhEncQLi4w-unsplash-256x256.jpg', 'height' => 256, 'width' => 256, 'orientation' => 'landscape'], 'full' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/jeremy-doddridge-efhEncQLi4w-unsplash.jpg', 'height' => 1280, 'width' => 1920, 'orientation' => 'landscape']], 'attributes' => ['srcset' => 'https://breakdance.com/wp-content/uploads/2024/10/jeremy-doddridge-efhEncQLi4w-unsplash.jpg 1920w, https://breakdance.com/wp-content/uploads/2024/10/jeremy-doddridge-efhEncQLi4w-unsplash-300x200.jpg 300w, https://breakdance.com/wp-content/uploads/2024/10/jeremy-doddridge-efhEncQLi4w-unsplash-1024x683.jpg 1024w, https://breakdance.com/wp-content/uploads/2024/10/jeremy-doddridge-efhEncQLi4w-unsplash-768x512.jpg 768w, https://breakdance.com/wp-content/uploads/2024/10/jeremy-doddridge-efhEncQLi4w-unsplash-1536x1024.jpg 1536w', 'sizes' => '(max-width: 1920px) 100vw, 1920px']], 'caption' => null], ['type' => 'image', 'image' => ['id' => 133658, 'filename' => 'carlos-D2OlaAuuOSA-unsplash.jpg', 'url' => 'https://breakdance.com/wp-content/uploads/2024/10/carlos-D2OlaAuuOSA-unsplash.jpg', 'alt' => '', 'caption' => '', 'mime' => 'image/jpeg', 'type' => 'image', 'sizes' => ['thumbnail' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/carlos-D2OlaAuuOSA-unsplash-150x150.jpg', 'height' => 150, 'width' => 150, 'orientation' => 'landscape'], 'medium' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/carlos-D2OlaAuuOSA-unsplash-200x300.jpg', 'height' => 300, 'width' => 200, 'orientation' => 'portrait'], 'large' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/carlos-D2OlaAuuOSA-unsplash-683x1024.jpg', 'height' => 1024, 'width' => 683, 'orientation' => 'portrait'], 'medium_large' => ['height' => 1151, 'width' => 768, 'url' => 'https://breakdance.com/wp-content/uploads/2024/10/carlos-D2OlaAuuOSA-unsplash-768x1151.jpg', 'orientation' => 'portrait'], '1536x1536' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/carlos-D2OlaAuuOSA-unsplash-1025x1536.jpg', 'height' => 1536, 'width' => 1025, 'orientation' => 'portrait'], '2048x2048' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/carlos-D2OlaAuuOSA-unsplash-1366x2048.jpg', 'height' => 2048, 'width' => 1366, 'orientation' => 'portrait'], 'sl-small' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/carlos-D2OlaAuuOSA-unsplash-128x128.jpg', 'height' => 128, 'width' => 128, 'orientation' => 'landscape'], 'sl-large' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/carlos-D2OlaAuuOSA-unsplash-256x256.jpg', 'height' => 256, 'width' => 256, 'orientation' => 'landscape'], 'full' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/carlos-D2OlaAuuOSA-unsplash.jpg', 'height' => 2878, 'width' => 1920, 'orientation' => 'portrait']], 'attributes' => ['srcset' => 'https://breakdance.com/wp-content/uploads/2024/10/carlos-D2OlaAuuOSA-unsplash.jpg 1920w, https://breakdance.com/wp-content/uploads/2024/10/carlos-D2OlaAuuOSA-unsplash-200x300.jpg 200w, https://breakdance.com/wp-content/uploads/2024/10/carlos-D2OlaAuuOSA-unsplash-683x1024.jpg 683w, https://breakdance.com/wp-content/uploads/2024/10/carlos-D2OlaAuuOSA-unsplash-768x1151.jpg 768w, https://breakdance.com/wp-content/uploads/2024/10/carlos-D2OlaAuuOSA-unsplash-1025x1536.jpg 1025w, https://breakdance.com/wp-content/uploads/2024/10/carlos-D2OlaAuuOSA-unsplash-1366x2048.jpg 1366w', 'sizes' => '(max-width: 1920px) 100vw, 1920px']]], ['type' => 'image', 'image' => ['id' => 133660, 'filename' => 'kellen-riggin-ZZ_uPf5oLFE-unsplash.jpg', 'url' => 'https://breakdance.com/wp-content/uploads/2024/10/kellen-riggin-ZZ_uPf5oLFE-unsplash.jpg', 'alt' => '', 'caption' => '', 'mime' => 'image/jpeg', 'type' => 'image', 'sizes' => ['thumbnail' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/kellen-riggin-ZZ_uPf5oLFE-unsplash-150x150.jpg', 'height' => 150, 'width' => 150, 'orientation' => 'landscape'], 'medium' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/kellen-riggin-ZZ_uPf5oLFE-unsplash-300x200.jpg', 'height' => 200, 'width' => 300, 'orientation' => 'landscape'], 'large' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/kellen-riggin-ZZ_uPf5oLFE-unsplash-1024x682.jpg', 'height' => 682, 'width' => 1024, 'orientation' => 'landscape'], 'medium_large' => ['height' => 512, 'width' => 768, 'url' => 'https://breakdance.com/wp-content/uploads/2024/10/kellen-riggin-ZZ_uPf5oLFE-unsplash-768x512.jpg', 'orientation' => 'landscape'], '1536x1536' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/kellen-riggin-ZZ_uPf5oLFE-unsplash-1536x1023.jpg', 'height' => 1023, 'width' => 1536, 'orientation' => 'landscape'], 'sl-small' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/kellen-riggin-ZZ_uPf5oLFE-unsplash-128x128.jpg', 'height' => 128, 'width' => 128, 'orientation' => 'landscape'], 'sl-large' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/kellen-riggin-ZZ_uPf5oLFE-unsplash-256x256.jpg', 'height' => 256, 'width' => 256, 'orientation' => 'landscape'], 'full' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/kellen-riggin-ZZ_uPf5oLFE-unsplash.jpg', 'height' => 1279, 'width' => 1920, 'orientation' => 'landscape']], 'attributes' => ['srcset' => 'https://breakdance.com/wp-content/uploads/2024/10/kellen-riggin-ZZ_uPf5oLFE-unsplash.jpg 1920w, https://breakdance.com/wp-content/uploads/2024/10/kellen-riggin-ZZ_uPf5oLFE-unsplash-300x200.jpg 300w, https://breakdance.com/wp-content/uploads/2024/10/kellen-riggin-ZZ_uPf5oLFE-unsplash-1024x682.jpg 1024w, https://breakdance.com/wp-content/uploads/2024/10/kellen-riggin-ZZ_uPf5oLFE-unsplash-768x512.jpg 768w, https://breakdance.com/wp-content/uploads/2024/10/kellen-riggin-ZZ_uPf5oLFE-unsplash-1536x1023.jpg 1536w', 'sizes' => '(max-width: 1920px) 100vw, 1920px']]], ['type' => 'image', 'image' => ['id' => 133661, 'filename' => 'marek-piwnicki-T1wi0CbzUQI-unsplash.jpg', 'url' => 'https://breakdance.com/wp-content/uploads/2024/10/marek-piwnicki-T1wi0CbzUQI-unsplash.jpg', 'alt' => '', 'caption' => '', 'mime' => 'image/jpeg', 'type' => 'image', 'sizes' => ['thumbnail' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/marek-piwnicki-T1wi0CbzUQI-unsplash-150x150.jpg', 'height' => 150, 'width' => 150, 'orientation' => 'landscape'], 'medium' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/marek-piwnicki-T1wi0CbzUQI-unsplash-300x188.jpg', 'height' => 188, 'width' => 300, 'orientation' => 'landscape'], 'large' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/marek-piwnicki-T1wi0CbzUQI-unsplash-1024x640.jpg', 'height' => 640, 'width' => 1024, 'orientation' => 'landscape'], 'medium_large' => ['height' => 480, 'width' => 768, 'url' => 'https://breakdance.com/wp-content/uploads/2024/10/marek-piwnicki-T1wi0CbzUQI-unsplash-768x480.jpg', 'orientation' => 'landscape'], '1536x1536' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/marek-piwnicki-T1wi0CbzUQI-unsplash-1536x960.jpg', 'height' => 960, 'width' => 1536, 'orientation' => 'landscape'], 'sl-small' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/marek-piwnicki-T1wi0CbzUQI-unsplash-128x128.jpg', 'height' => 128, 'width' => 128, 'orientation' => 'landscape'], 'sl-large' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/marek-piwnicki-T1wi0CbzUQI-unsplash-256x256.jpg', 'height' => 256, 'width' => 256, 'orientation' => 'landscape'], 'full' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/marek-piwnicki-T1wi0CbzUQI-unsplash.jpg', 'height' => 1200, 'width' => 1920, 'orientation' => 'landscape']], 'attributes' => ['srcset' => 'https://breakdance.com/wp-content/uploads/2024/10/marek-piwnicki-T1wi0CbzUQI-unsplash.jpg 1920w, https://breakdance.com/wp-content/uploads/2024/10/marek-piwnicki-T1wi0CbzUQI-unsplash-300x188.jpg 300w, https://breakdance.com/wp-content/uploads/2024/10/marek-piwnicki-T1wi0CbzUQI-unsplash-1024x640.jpg 1024w, https://breakdance.com/wp-content/uploads/2024/10/marek-piwnicki-T1wi0CbzUQI-unsplash-768x480.jpg 768w, https://breakdance.com/wp-content/uploads/2024/10/marek-piwnicki-T1wi0CbzUQI-unsplash-1536x960.jpg 1536w', 'sizes' => '(max-width: 1920px) 100vw, 1920px']]], ['type' => 'image', 'image' => ['id' => 133662, 'filename' => 'matt-hardy-_RlH3Vax15w-unsplash.jpg', 'url' => 'https://breakdance.com/wp-content/uploads/2024/10/matt-hardy-_RlH3Vax15w-unsplash.jpg', 'alt' => '', 'caption' => '', 'mime' => 'image/jpeg', 'type' => 'image', 'sizes' => ['thumbnail' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/matt-hardy-_RlH3Vax15w-unsplash-150x150.jpg', 'height' => 150, 'width' => 150, 'orientation' => 'landscape'], 'medium' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/matt-hardy-_RlH3Vax15w-unsplash-300x225.jpg', 'height' => 225, 'width' => 300, 'orientation' => 'landscape'], 'large' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/matt-hardy-_RlH3Vax15w-unsplash-1024x768.jpg', 'height' => 768, 'width' => 1024, 'orientation' => 'landscape'], 'medium_large' => ['height' => 576, 'width' => 768, 'url' => 'https://breakdance.com/wp-content/uploads/2024/10/matt-hardy-_RlH3Vax15w-unsplash-768x576.jpg', 'orientation' => 'landscape'], '1536x1536' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/matt-hardy-_RlH3Vax15w-unsplash-1536x1152.jpg', 'height' => 1152, 'width' => 1536, 'orientation' => 'landscape'], 'sl-small' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/matt-hardy-_RlH3Vax15w-unsplash-128x128.jpg', 'height' => 128, 'width' => 128, 'orientation' => 'landscape'], 'sl-large' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/matt-hardy-_RlH3Vax15w-unsplash-256x256.jpg', 'height' => 256, 'width' => 256, 'orientation' => 'landscape'], 'full' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/matt-hardy-_RlH3Vax15w-unsplash.jpg', 'height' => 1440, 'width' => 1920, 'orientation' => 'landscape']], 'attributes' => ['srcset' => 'https://breakdance.com/wp-content/uploads/2024/10/matt-hardy-_RlH3Vax15w-unsplash.jpg 1920w, https://breakdance.com/wp-content/uploads/2024/10/matt-hardy-_RlH3Vax15w-unsplash-300x225.jpg 300w, https://breakdance.com/wp-content/uploads/2024/10/matt-hardy-_RlH3Vax15w-unsplash-1024x768.jpg 1024w, https://breakdance.com/wp-content/uploads/2024/10/matt-hardy-_RlH3Vax15w-unsplash-768x576.jpg 768w, https://breakdance.com/wp-content/uploads/2024/10/matt-hardy-_RlH3Vax15w-unsplash-1536x1152.jpg 1536w', 'sizes' => '(max-width: 1920px) 100vw, 1920px']]], ['type' => 'image', 'image' => ['id' => 133663, 'filename' => 'nic-y-c-u7hKg-Lgzm0-unsplash.jpg', 'url' => 'https://breakdance.com/wp-content/uploads/2024/10/nic-y-c-u7hKg-Lgzm0-unsplash.jpg', 'alt' => '', 'caption' => '', 'mime' => 'image/jpeg', 'type' => 'image', 'sizes' => ['thumbnail' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/nic-y-c-u7hKg-Lgzm0-unsplash-150x150.jpg', 'height' => 150, 'width' => 150, 'orientation' => 'landscape'], 'medium' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/nic-y-c-u7hKg-Lgzm0-unsplash-300x200.jpg', 'height' => 200, 'width' => 300, 'orientation' => 'landscape'], 'large' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/nic-y-c-u7hKg-Lgzm0-unsplash-1024x683.jpg', 'height' => 683, 'width' => 1024, 'orientation' => 'landscape'], 'medium_large' => ['height' => 512, 'width' => 768, 'url' => 'https://breakdance.com/wp-content/uploads/2024/10/nic-y-c-u7hKg-Lgzm0-unsplash-768x512.jpg', 'orientation' => 'landscape'], '1536x1536' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/nic-y-c-u7hKg-Lgzm0-unsplash-1536x1024.jpg', 'height' => 1024, 'width' => 1536, 'orientation' => 'landscape'], 'sl-small' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/nic-y-c-u7hKg-Lgzm0-unsplash-128x128.jpg', 'height' => 128, 'width' => 128, 'orientation' => 'landscape'], 'sl-large' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/nic-y-c-u7hKg-Lgzm0-unsplash-256x256.jpg', 'height' => 256, 'width' => 256, 'orientation' => 'landscape'], 'full' => ['url' => 'https://breakdance.com/wp-content/uploads/2024/10/nic-y-c-u7hKg-Lgzm0-unsplash.jpg', 'height' => 1280, 'width' => 1920, 'orientation' => 'landscape']], 'attributes' => ['srcset' => 'https://breakdance.com/wp-content/uploads/2024/10/nic-y-c-u7hKg-Lgzm0-unsplash.jpg 1920w, https://breakdance.com/wp-content/uploads/2024/10/nic-y-c-u7hKg-Lgzm0-unsplash-300x200.jpg 300w, https://breakdance.com/wp-content/uploads/2024/10/nic-y-c-u7hKg-Lgzm0-unsplash-1024x683.jpg 1024w, https://breakdance.com/wp-content/uploads/2024/10/nic-y-c-u7hKg-Lgzm0-unsplash-768x512.jpg 768w, https://breakdance.com/wp-content/uploads/2024/10/nic-y-c-u7hKg-Lgzm0-unsplash-1536x1024.jpg 1536w', 'sizes' => '(max-width: 1920px) 100vw, 1920px']]]], 'image_size' => 'large', 'link' => 'lightbox', 'images_dynamic_meta' => null, 'type' => 'single', 'lazy_load' => true]], 'design' => ['layout' => ['type' => 'grid', 'gap' => ['breakpoint_base' => ['number' => 10, 'unit' => 'px', 'style' => '10px']], 'columns' => ['breakpoint_base' => 3, 'breakpoint_phone_portrait' => 1], 'aspect_ratio' => '100%', 'slider' => ['settings' => ['advanced' => ['slides_per_view' => ['breakpoint_base' => 3], 'one_per_view_at' => 'breakpoint_phone_landscape']]]], 'images' => ['aspect_ratio' => '75%', 'background' => '#00000030'], 'captions' => ['show_captions' => 'always', 'background' => ['points' => [['left' => 0, 'red' => 0, 'green' => 0, 'blue' => 0, 'alpha' => 0.7], ['left' => 61, 'red' => 0, 'green' => 0, 'blue' => 0, 'alpha' => 0.35], ['left' => 100, 'red' => 0, 'green' => 0, 'blue' => 0, 'alpha' => 0]], 'type' => 'linear', 'degree' => 0, 'svgValue' => '<linearGradient gradientTransform="matrix(1,0,0,1,0,0)" id="%%GRADIENTID%%"><stop stop-opacity="0.7" stop-color="#000000" offset="0"></stop><stop stop-opacity="0.35" stop-color="#000000" offset="0.609090909090909"></stop><stop stop-opacity="0" stop-color="#000000" offset="1"></stop></linearGradient>', 'value' => 'linear-gradient(0deg,rgba(0, 0, 0, 0.7) 0%,rgba(0, 0, 0, 0.35) 61%,rgba(0, 0, 0, 0) 100%)'], 'typography' => null, 'hide_below' => null], 'lightbox' => ['thumbnails' => true, 'animated_thumbnails' => false, 'zoom' => true, 'autoplay' => false, 'background' => '#000000', 'controls' => '#999999', 'thumbnail' => '#ffffff', 'thumbnail_active' => '#01d2e8f0', 'autoplay_videos' => false]]];
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
        "layout",
        "Layout",
        [c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['step' => 10, 'min' => 0, 'max' => 1120]],
        true,
        false,
        [],
        
      ), c(
        "type",
        "Type",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => [['text' => 'Grid', 'label' => 'Label', 'value' => 'grid'], ['text' => 'Masonry', 'value' => 'masonry'], ['text' => 'Justified', 'value' => 'justified'], ['text' => 'Slider', 'value' => 'slider']]],
        false,
        false,
        [],
        
      ), c(
        "row_height",
        "Row Height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => [[['path' => 'design.layout.type', 'operand' => 'equals', 'value' => 'justified']]], 'rangeOptions' => ['min' => 100, 'max' => 500, 'step' => 1]],
        true,
        false,
        [],
        
      ), c(
        "aspect_ratio",
        "Aspect Ratio",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['text' => '1:1', 'value' => '100%'], ['text' => '3:2', 'value' => '66.67%'], ['text' => '4:3', 'value' => '75%'], ['text' => '16:9', 'label' => 'Label', 'value' => '56.25%'], ['text' => '21:9', 'value' => '42.85%'], ['text' => 'Custom', 'value' => 'custom']], 'condition' => ['path' => 'design.layout.type', 'operand' => 'equals', 'value' => 'grid']],
        false,
        false,
        [],
        
      ), c(
        "custom_height",
        "Custom Height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['path' => 'design.layout.aspect_ratio', 'operand' => 'equals', 'value' => 'custom'], 'rangeOptions' => ['min' => 100, 'max' => 500, 'step' => 1]],
        false,
        false,
        [],
        
      ), c(
        "columns",
        "Columns",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['step' => 1, 'min' => 1, 'max' => 10], 'condition' => ['path' => 'design.layout.type', 'operand' => 'is one of', 'value' => ['grid', 'masonry']]],
        true,
        false,
        [],
        
      ), c(
        "gap",
        "Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 1], 'unitOptions' => ['types' => [], 'defaultType' => 'px'], 'condition' => ['path' => 'design.layout.type', 'operand' => 'not equals', 'value' => 'slider']],
        true,
        false,
        [],
        
      ), c(
        "vertical_at",
        "Vertical At",
        [],
        ['type' => 'breakpoint_dropdown', 'layout' => 'inline', 'breakpointOptions' => ['enableNever' => true], 'condition' => [[['path' => 'design.layout.type', 'operand' => 'not equals', 'value' => 'slider']]]],
        false,
        false,
        [],
        
      ), getPresetSection(
      "EssentialElements\\AtomV1SwiperSettings",
      "Slider",
      "slider",
       ['condition' => ['path' => 'design.layout.type', 'operand' => 'equals', 'value' => 'slider'], 'type' => 'popout']
     ), c(
        "slider_images",
        "Slider Images",
        [c(
        "aspect_ratio",
        "Aspect Ratio",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['text' => '1:1', 'value' => '100%'], ['text' => '3:2', 'value' => '66.67%'], ['text' => '4:3', 'value' => '75%'], ['text' => '16:9', 'label' => 'Label', 'value' => '56.25%'], ['text' => '21:9', 'value' => '42.85%'], ['text' => 'Custom', 'value' => '0']]],
        false,
        false,
        [],
        
      ), c(
        "vertical_align",
        "Vertical Align",
        [],
        ['type' => 'button_bar', 'layout' => 'inline', 'items' => [['value' => 'flex-start', 'text' => 'fTop', 'icon' => 'FlexAlignTopIcon'], ['text' => 'center', 'icon' => 'FlexAlignCenterVerticalIcon', 'value' => 'center'], ['text' => 'Bottom', 'icon' => 'FlexAlignBottomIcon', 'value' => 'flex-end']], 'condition' => ['path' => 'design.layout.slider_images.aspect_ratio', 'operand' => 'equals', 'value' => '0']],
        false,
        false,
        [],
        
      ), c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 1, 'max' => 100, 'step' => 1], 'unitOptions' => ['types' => ['%', 'px'], 'defaultType' => '%']],
        true,
        false,
        [],
        
      ), c(
        "height",
        "Height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 10, 'max' => 800, 'step' => 1], 'unitOptions' => ['types' => ['px', '%']], 'condition' => ['path' => 'design.layout.slider_images.aspect_ratio', 'operand' => 'equals', 'value' => '0']],
        true,
        false,
        [],
        
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout'], 'condition' => ['path' => 'design.layout.type', 'operand' => 'equals', 'value' => 'slider']],
        false,
        false,
        [],
        
      )],
        ['type' => 'section'],
        false,
        false,
        [],
        
      ), c(
        "thumbs",
        "Thumbs",
        [c(
        "background",
        "Background",
        [],
        ['type' => 'color', 'layout' => 'inline', 'colorOptions' => ['type' => 'solidAndGradient']],
        false,
        true,
        [],
        
      ), c(
        "opacity",
        "Opacity",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 1, 'step' => 0.1]],
        false,
        true,
        [],
        
      ), getPresetSection(
      "EssentialElements\\filter",
      "Filters",
      "filters",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     ), c(
        "shadow",
        "Shadow",
        [],
        ['type' => 'shadow', 'layout' => 'vertical', 'condition' => ['path' => 'design.layout.type', 'operand' => 'not equals', 'value' => 'slider']],
        false,
        true,
        [],
        
      ), c(
        "hover_animation",
        "Hover Animation",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'zoom-in', 'text' => 'Zoom In'], ['text' => 'Zoom Out', 'value' => 'zoom-out'], ['value' => 'slide-up', 'text' => 'Slide Up'], ['value' => 'slide-bottom', 'text' => 'Slide Bottom'], ['text' => 'Slide Left', 'value' => 'slide-left'], ['text' => 'Slide Right', 'value' => 'slide-right']]],
        false,
        false,
        [],
        
      ), c(
        "duration",
        "Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['ms', 's'], 'defaultType' => 'ms']],
        false,
        false,
        [],
        
      )],
        ['type' => 'section'],
        false,
        false,
        [],
        
      ), c(
        "image",
        "Image",
        [c(
        "background",
        "Background",
        [],
        ['type' => 'color', 'layout' => 'inline', 'colorOptions' => ['type' => 'solidAndGradient']],
        false,
        true,
        [],
        
      ), c(
        "opacity",
        "Opacity",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 1, 'step' => 0.1]],
        false,
        true,
        [],
        
      ), getPresetSection(
      "EssentialElements\\filter",
      "Filters",
      "filters",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     ), c(
        "shadow",
        "Shadow",
        [],
        ['type' => 'shadow', 'layout' => 'vertical', 'condition' => ['path' => 'design.layout.type', 'operand' => 'not equals', 'value' => 'slider']],
        false,
        true,
        [],
        
      ), c(
        "hover_animation",
        "Hover Animation",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'zoom-in', 'text' => 'Zoom In'], ['text' => 'Zoom Out', 'value' => 'zoom-out'], ['value' => 'slide-up', 'text' => 'Slide Up'], ['value' => 'slide-bottom', 'text' => 'Slide Bottom'], ['text' => 'Slide Left', 'value' => 'slide-left'], ['text' => 'Slide Right', 'value' => 'slide-right']]],
        false,
        false,
        [],
        
      ), c(
        "duration",
        "Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['ms', 's'], 'defaultType' => 'ms']],
        false,
        false,
        [],
        
      )],
        ['type' => 'section'],
        false,
        false,
        [],
        
      ), c(
        "captions",
        "Captions",
        [c(
        "show_captions",
        "Show Captions",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => [['value' => 'never', 'text' => 'Never'], ['text' => 'Always', 'value' => 'always'], ['text' => 'On Hover', 'value' => 'on_hover']]],
        false,
        false,
        [],
        
      ), c(
        "animation",
        "Animation",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'condition' => ['path' => 'design.captions.show_captions', 'operand' => 'equals', 'value' => 'on_hover'], 'items' => [['value' => 'fade', 'text' => 'Fade'], ['text' => 'Zoom In', 'value' => 'zoom-in'], ['text' => 'Zoom Out', 'value' => 'zoom-out'], ['text' => 'Slide Up', 'value' => 'slide-up'], ['text' => 'Slide Down', 'value' => 'slide-down'], ['text' => 'Slide Left', 'value' => 'slide-left'], ['text' => 'Slide Right', 'value' => 'slide-right']]],
        false,
        false,
        [],
        
      ), c(
        "duration",
        "Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['path' => 'design.captions.show_captions', 'operand' => 'equals', 'value' => 'on_hover'], 'unitOptions' => ['types' => ['ms', 's']]],
        false,
        false,
        [],
        
      ), c(
        "position",
        "Position",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => [['value' => 'top', 'text' => 'Top'], ['text' => 'Bottom', 'value' => 'bottom'], ['text' => 'Stretch', 'value' => 'stretch']]],
        false,
        false,
        [],
        
      ), c(
        "background",
        "Background",
        [],
        ['type' => 'color', 'layout' => 'inline', 'colorOptions' => ['type' => 'solidAndGradient']],
        false,
        false,
        [],
        
      ), getPresetSection(
      "EssentialElements\\typography",
      "Typography",
      "typography",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), c(
        "hide_below",
        "Hide below",
        [],
        ['type' => 'breakpoint_dropdown', 'layout' => 'inline'],
        false,
        false,
        [],
        
      )],
        ['type' => 'section'],
        false,
        false,
        [],
        
      ), getPresetSection(
      "EssentialElements\\lightbox_design",
      "Lightbox",
      "lightbox",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\tabs_design",
      "Filter Bar",
      "filter_bar",
       ['condition' => [[['path' => 'content.content.type', 'operand' => 'equals', 'value' => 'multiple']]], 'type' => 'popout']
     ), c(
        "spacing",
        "Spacing",
        [getPresetSection(
      "EssentialElements\\spacing_margin_y",
      "Container",
      "container",
       ['condition' => [[['path' => 'design.spacing.container', 'operand' => 'is set', 'value' => ''], ['path' => 'design.spacing.margin_top', 'operand' => 'is not set', 'value' => '']], [['path' => 'design.spacing.container', 'operand' => 'is set', 'value' => ''], ['path' => 'design.spacing.container.margin_bottom', 'operand' => 'is not set', 'value' => '']]], 'type' => 'popout']
     ), c(
        "margin_top",
        "Margin Top",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => [[['path' => 'design.spacing.container', 'operand' => 'is not set', 'value' => '']], [['path' => 'design.spacing.margin_top', 'operand' => 'is set', 'value' => '']], [['path' => 'design.spacing.margin_bottom', 'operand' => 'is set', 'value' => '']]]],
        true,
        false,
        [],
        
      ), c(
        "margin_bottom",
        "Margin Bottom",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => [[['path' => 'design.spacing.container', 'operand' => 'is not set', 'value' => '']], [['path' => 'design.spacing.margin_bottom', 'operand' => 'is set', 'value' => '']], [['path' => 'design.spacing.margin_top', 'operand' => 'is set', 'value' => '']]]],
        true,
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
        "type",
        "Type",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => [['value' => 'single', 'text' => 'Single'], ['text' => 'Multiple', 'value' => 'multiple']]],
        false,
        false,
        [],
        
      ), c(
        "images",
        "Images",
        [c(
        "type",
        "Type",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => [['value' => 'image', 'text' => 'Image', 'icon' => 'ImageIcon'], ['text' => 'Video', 'value' => 'video', 'icon' => 'VideoIcon']], 'buttonBarOptions' => ['size' => 'small']],
        false,
        false,
        [],
        
      ), c(
        "image",
        "Image",
        [],
        ['type' => 'wpmedia', 'layout' => 'vertical', 'condition' => [[['path' => '%%CURRENTPATH%%.type', 'operand' => 'equals', 'value' => 'image']]], 'mediaOptions' => ['acceptedFileTypes' => ['image', 'video'], 'multiple' => false]],
        false,
        false,
        [],
        ['accepts' => 'image_url']
      ), c(
        "video",
        "Video",
        [],
        ['type' => 'video', 'layout' => 'vertical', 'condition' => ['path' => '%%CURRENTPATH%%.type', 'operand' => 'equals', 'value' => 'video']],
        false,
        false,
        [],
        ['accepts' => 'video']
      ), c(
        "caption",
        "Caption",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
        ['accepts' => 'string']
      ), c(
        "custom_url",
        "Custom URL",
        [],
        ['type' => 'url', 'layout' => 'vertical', 'condition' => ['path' => 'content.content.link', 'operand' => 'equals', 'value' => 'custom_url']],
        false,
        false,
        [],
        ['accepts' => 'string']
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '', 'defaultTitle' => 'Image / Video', 'buttonName' => 'Add media', 'galleryMode' => true, 'galleryMediaPath' => 'image', 'defaultNewValue' => ['type' => 'image']], 'condition' => [[['path' => 'content.content.type', 'operand' => 'not equals', 'value' => 'multiple']]]],
        false,
        false,
        [],
        ['accepts' => 'gallery']
      ), c(
        "galleries",
        "Galleries",
        [c(
        "title",
        "Title",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
        ['accepts' => 'string']
      ), c(
        "images",
        "Images",
        [c(
        "type",
        "Type",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => [['value' => 'image', 'text' => 'Image', 'icon' => 'ImageIcon'], ['text' => 'Video', 'value' => 'video', 'icon' => 'VideoIcon']], 'buttonBarOptions' => ['size' => 'small']],
        false,
        false,
        [],
        
      ), c(
        "image",
        "Image",
        [],
        ['type' => 'wpmedia', 'layout' => 'vertical', 'condition' => [[['path' => '%%CURRENTPATH%%.type', 'operand' => 'equals', 'value' => 'image']]], 'mediaOptions' => ['acceptedFileTypes' => ['image', 'video'], 'multiple' => false]],
        false,
        false,
        [],
        ['accepts' => 'image_url']
      ), c(
        "video",
        "Video",
        [],
        ['type' => 'video', 'layout' => 'vertical', 'condition' => ['path' => '%%CURRENTPATH%%.type', 'operand' => 'equals', 'value' => 'video']],
        false,
        false,
        [],
        ['accepts' => 'video']
      ), c(
        "caption",
        "Caption",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
        ['accepts' => 'string']
      ), c(
        "custom_url",
        "Custom URL",
        [],
        ['type' => 'url', 'layout' => 'vertical', 'condition' => ['path' => 'content.content.link', 'operand' => 'equals', 'value' => 'custom_url']],
        false,
        false,
        [],
        ['accepts' => 'string']
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '', 'defaultTitle' => 'Image / Video', 'buttonName' => 'Add media', 'galleryMode' => true, 'galleryMediaPath' => 'image', 'defaultNewValue' => ['type' => 'image']]],
        false,
        false,
        [],
        ['accepts' => 'gallery']
      ), c(
        "icon",
        "Icon",
        [],
        ['type' => 'icon', 'layout' => 'vertical'],
        false,
        false,
        [],
        
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{title}', 'defaultTitle' => 'Gallery', 'buttonName' => 'Add Gallery', 'defaultNewValue' => ['title' => 'Untitled']], 'condition' => ['path' => 'content.content.type', 'operand' => 'equals', 'value' => 'multiple']],
        false,
        false,
        [],
        
      ), c(
        "filter_bar",
        "Filter Bar",
        [c(
        "all_filter",
        "All Filter",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
        
      ), c(
        "all_label",
        "All Label",
        [],
        ['type' => 'text', 'layout' => 'inline', 'condition' => ['path' => 'content.content.filter_bar.all_filter', 'operand' => 'is set', 'value' => null]],
        false,
        false,
        [],
        
      )],
        ['type' => 'section', 'layout' => 'vertical', 'sectionOptions' => ['type' => 'popout'], 'condition' => ['path' => 'content.content.type', 'operand' => 'equals', 'value' => 'multiple']],
        false,
        false,
        [],
        
      ), c(
        "link",
        "Link",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['text' => 'None', 'label' => 'Label', 'value' => 'none'], ['text' => 'Lightbox', 'value' => 'lightbox'], ['text' => 'Custom URL', 'value' => 'custom_url'], ['text' => 'Media File', 'value' => 'media_file']]],
        false,
        false,
        [],
        
      ), c(
        "new_tab",
        "New Tab",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => [[['path' => 'content.content.link', 'operand' => 'equals', 'value' => 'custom_url']]]],
        false,
        false,
        [],
        
      ), c(
        "image_size",
        "Image Size",
        [],
        ['type' => 'media_size_dropdown', 'layout' => 'inline'],
        false,
        false,
        [],
        
      ), c(
        "lazy_load",
        "Lazy Load",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'items' => [['text' => 'Eager: loads immediately', 'label' => 'Label', 'value' => 'eager'], ['text' => 'Lazy: loads on scroll', 'value' => 'lazy'], ['text' => 'Auto: browser decides what is best', 'value' => 'auto']]],
        false,
        false,
        [],
        
      ), c(
        "advanced",
        "Advanced",
        [c(
        "disable_srcset_sizes",
        "Disable Srcset & Sizes",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
        
      )],
        ['type' => 'section', 'layout' => 'vertical', 'sectionOptions' => ['type' => 'popout']],
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
        return ['0' =>  ['title' => 'Slider','scripts' => ['%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/swiper@12/swiper-bundle.min.js','%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/breakdance-swiper/breakdance-swiper.js'],'styles' => ['%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/swiper@12/swiper-bundle.min.css','%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/swiper@12/breakdance-swiper-preset-defaults.css'],'inlineScripts' => ['window.BreakdanceSwiper().update({
  id: \'%%UNIQUESLUG%%\', selector:\'%%SELECTOR%%\',
  settings:{{ design.layout.slider.settings|json_encode }},
  paginationSettings:{{ design.layout.slider.pagination|json_encode }},
});'],'builderCondition' => 'return {{ design.layout.type == \'slider\' }};','frontendCondition' => 'return {{ design.layout.type == \'slider\' }};',],'1' =>  ['title' => 'Isotope','scripts' => ['%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/isotope-layout@3.0.6/isotope.pkgd.min.js'],],'2' =>  ['scripts' => ['%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/isotope-layout@3.0.6/packery-mode.pkgd.min.js','%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/justified-layout/justified-layout.js'],'title' => 'Justified','frontendCondition' => '{% if design.layout.type == \'justified\' %}
return true;
{% else%}
 return false;
{% endif %}
',],'3' =>  ['title' => 'Masonry','scripts' => ['%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/imagesloaded@4/imagesloaded.pkgd.min.js'],'builderCondition' => '{% if design.layout.type == \'masonry\' %}
return true;
{% else%}
 return false;
{% endif %}

','frontendCondition' => '{% if design.layout.type == \'masonry\' %}
return true;
{% else%}
 return false;
{% endif %}
',],'4' =>  ['scripts' => ['%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/lightgallery@2/lightgallery-bundle.min.js','%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/elements-reusable-code/lightbox.js'],'inlineScripts' => ['new BreakdanceLightbox(\'%%SELECTOR%%\', {
  itemSelector: \'.ee-gallery-item\',
  ...{{ design.lightbox|json_encode }}
});'],'styles' => ['%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/lightgallery@2/css/lightgallery-bundle.min.css'],'builderCondition' => 'return false;','frontendCondition' => '{% if content.content.link == \'lightbox\' %}
return true;
{% else %}
return false;
{% endif %}','title' => '"lightbox" for frontend',],'5' =>  ['styles' => ['%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/custom-tabs@1/tabs.css'],'title' => 'Tabs CSS','builderCondition' => '{% if content.content.type == \'multiple\' %}
return true;
{% else%}
 return false;
{% endif %}

','frontendCondition' => '{% if content.content.type == \'multiple\' %}
return true;
{% else%}
 return false;
{% endif %}
',],'6' =>  ['scripts' => ['%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/breakdance-gallery@1/gallery.js'],'title' => 'Breakdance Gallery',],'7' =>  ['inlineScripts' => ['new BreakdanceGallery(
  \'%%SELECTOR%%\',
  {
    ...{{ design.layout|json_encode|striptags }},
    mode: {{ content.content.type|json_encode }}
  }
);'],'builderCondition' => 'return false;','title' => 'BreakdanceGallery init for frontend',],'8' =>  ['inlineScripts' => ['function setThumb(el) {
  document.querySelectorAll(\'.pkgd-thumb\').forEach(function(t) {
    t.classList.remove(\'active\');
  });
  el.classList.add(\'active\');
  var main = document.getElementById(\'pkgd-main\');
  main.style.opacity = \'0\';
  setTimeout(function() {
    main.src = el.getAttribute(\'data-src\');
    main.style.opacity = \'1\';
  }, 300);
}

// Set first thumb active on load
document.addEventListener(\'DOMContentLoaded\', function() {
  var first = document.querySelector(\'.pkgd-thumb\');
  if (first) first.classList.add(\'active\');
});'],],];
    }

    static function settings()
    {
        return ['bypassPointerEvents' => false, 'proOnly' => true];
    }

    static function addPanelRules()
    {
        return false;
    }

    static public function actions()
    {
        return [

'onPropertyChange' => [['script' => '{% if design.layout.type == \'slider\' %}
window.BreakdanceSwiper().update({
  id: \'%%UNIQUESLUG%%\', selector:\'%%SELECTOR%%\',
  settings: {{ design.layout.slider.settings|json_encode }},
  paginationSettings: {{ design.layout.slider.pagination|json_encode }},
});
{% else %}
window.swiperInstances && window.swiperInstances[\'%%UNIQUESLUG%%\'] && window.BreakdanceSwiper().destroy(
  \'%%UNIQUESLUG%%\'
);
{% endif %}',
],['script' => 'if (window.breakdanceGalleryInstances && window.breakdanceGalleryInstances[%%ID%%]) {
  window.breakdanceGalleryInstances[%%ID%%].update({
    ...{{ design.layout|json_encode|striptags }},
    mode: {{ content.content.type|json_encode }}
  });
}',
],],

'onMountedElement' => [['script' => '{% if design.layout.type == \'slider\' %}
  window.BreakdanceSwiper().update({
    id: \'%%UNIQUESLUG%%\',selector:\'%%SELECTOR%%\',
    settings: {{ design.layout.slider.settings|json_encode }},
    paginationSettings: {{ design.layout.slider.pagination|json_encode }},
  });
{% endif %}',
],['script' => 'if (!window.breakdanceGalleryInstances) window.breakdanceGalleryInstances = {};

if (window.breakdanceGalleryInstances && window.breakdanceGalleryInstances[%%ID%%]) {
  window.breakdanceGalleryInstances[%%ID%%].destroy();
}

window.breakdanceGalleryInstances[%%ID%%] = new BreakdanceGallery(
  \'%%SELECTOR%%\',
  {
    ...{{ design.layout|json_encode|striptags }},
    mode: {{ content.content.type|json_encode }}
  }
);



',
],],

'onMovedElement' => [['script' => 'if (window.breakdanceGalleryInstances && window.breakdanceGalleryInstances[%%ID%%]) {
  window.breakdanceGalleryInstances[%%ID%%].update();
}
',
],],

'onBeforeDeletingElement' => [['script' => 'if (window.breakdanceGalleryInstances && window.breakdanceGalleryInstances[%%ID%%]) {
  window.breakdanceGalleryInstances[%%ID%%].destroy();
  delete window.breakdanceGalleryInstances[%%ID%%];
}
',
],['script' => '{% if design.layout.type == \'slider\' %}
window.swiperInstances && window.swiperInstances[\'%%UNIQUESLUG%%\'] && window.BreakdanceSwiper().destroy(
  \'%%UNIQUESLUG%%\'
);
{% endif %}',
],],];
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
        return 750;
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
        return ['design.layout.gap', 'design.layout.vertical_at', 'design.captions.hide_below', 'design.filter_bar.responsive.visible_at', 'design.filter_bar.responsive.show_as_dropdown', 'design.filter_bar.horizontal_at', 'design.layout.slider.settings.advanced.one_per_view_at', 'design.layout.slider.settings.advanced.slides_per_group', 'design.layout.slider.arrows.overlay', 'design.layout.slider.arrows.disable', 'content.content.type'];
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}
