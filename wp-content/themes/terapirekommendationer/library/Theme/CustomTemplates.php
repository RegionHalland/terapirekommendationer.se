<?php

namespace Terapirekommendationer\Theme;

class CustomTemplates
{
    public function __construct()
    {
        add_action('after_setup_theme', array($this, 'addCampaignTemplate'));
    }

    public function addCampaignTemplate()
    {
        \RegionHalland\Helper\Template::add(
            __('Whole Chapter', 'Terapirekommendationer'),
            \RegionHalland\Helper\Template::locateTemplate('whole-chapter.blade.php'),
            'all'
        );

        \RegionHalland\Helper\Template::add(
            __('All Headings', 'Terapirekommendationer'),
            \RegionHalland\Helper\Template::locateTemplate('all-headings.blade.php'),
            'all'
        );

        \RegionHalland\Helper\Template::add(
            __('All Reklistor', 'Terapirekommendationer'),
            \RegionHalland\Helper\Template::locateTemplate('all-reklistor.blade.php'),
            'all'
        );

        \RegionHalland\Helper\Template::add(
            __('All Reklistor (Sjuksköterskor)', 'Terapirekommendationer'),
            \RegionHalland\Helper\Template::locateTemplate('all-reklistor-ssk.blade.php'),
            'all'
        );

        // Demo
        \RegionHalland\Helper\Template::add(
            __('Demo', 'Terapirekommendationer'),
            \RegionHalland\Helper\Template::locateTemplate('demo.blade.php'),
            'all'
        );        
    }

}
