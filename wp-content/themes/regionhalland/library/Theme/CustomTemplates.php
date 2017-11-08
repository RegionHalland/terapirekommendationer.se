<?php

namespace RegionHalland\Theme;

class CustomTemplates
{
    public function __construct()
    {
        \RegionHalland\Helper\Template::add(
            __('Full width', 'municipio'),
            \RegionHalland\Helper\Template::locateTemplate('full-width.blade.php'),
            'all'
        );

        \RegionHalland\Helper\Template::add(
            __('One page (no article)', 'municipio'),
            \RegionHalland\Helper\Template::locateTemplate('one-page.blade.php'),
            'all'
        );
    }
}
