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
        \Municipio\Helper\Template::add(
            __('Whole chapter', 'municipio'),
            \Municipio\Helper\Template::locateTemplate('whole-chapter.blade.php'),
            'all'
        );
    }

}
