<?php

namespace Halland\Theme;

class CustomTemplates
{
    public function __construct()
    {
        \Halland\Helper\Template::add(
            __('Full width', 'halland'),
            \Halland\Helper\Template::locateTemplate('full-width.blade.php'),
            'all'
        );

        \Halland\Helper\Template::add(
            __('One page (no article)', 'halland'),
            \Halland\Helper\Template::locateTemplate('one-page.blade.php'),
            'all'
        );
    }
}
