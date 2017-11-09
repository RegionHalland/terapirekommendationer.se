<?php

namespace RegionHalland\Theme;

class CustomTemplates
{
    public function __construct()
    {
        \RegionHalland\Helper\Template::add(
            __('Full width', 'regionhalland'),
            \RegionHalland\Helper\Template::locateTemplate('full-width.blade.php'),
            'all'
        );

        \RegionHalland\Helper\Template::add(
            __('One page (no article)', 'regionhalland'),
            \RegionHalland\Helper\Template::locateTemplate('one-page.blade.php'),
            'all'
        );
    }
}
