<?php

namespace RegionHalland\Theme;

class CustomTemplates
{

    public function __construct()
    {
        add_action('after_setup_theme', array($this, 'addCampaignTemplate'));
    }

    public function addCampaignTemplate()
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

        \RegionHalland\Helper\Template::add(
            __('Whole Chapter', 'regionhalland'),
            \RegionHalland\Helper\Template::locateTemplate('whole-chapter.blade.php'),
            'all'
        );

        \RegionHalland\Helper\Template::add(
            __('All Headings', 'regionhalland'),
            \RegionHalland\Helper\Template::locateTemplate('all-headings.blade.php'),
            'all'
        );

        \RegionHalland\Helper\Template::add(
            __('All Reklistor', 'regionhalland'),
            \RegionHalland\Helper\Template::locateTemplate('all-reklistor.blade.php'),
            'all'
        );

        \RegionHalland\Helper\Template::add(
            __('All Reklistor (Sjuksköterskor)', 'regionhalland'),
            \RegionHalland\Helper\Template::locateTemplate('all-reklistor-ssk.blade.php'),
            'all'
        );
        
        \RegionHalland\Helper\Template::add(
            __('Stripped', 'regionhalland'),
            \RegionHalland\Helper\Template::locateTemplate('page-stripped.blade.php'),
            'all'
        );
    }
}
