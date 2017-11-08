<?php

namespace RegionHalland\Theme;

class Enqueue
{

    public function __construct()
    {
        // Enqueue styles
        add_action('wp_enqueue_scripts', array($this, 'style'));
    }

    /**
     * Enqueue styles
     * @return void
    */
    public function style()
    {
        wp_register_style('regionhalland', "https://regionhalland.github.io/styleguide/dist/css/main.min.css", '', null);
        wp_enqueue_style('regionhalland');
    }
}
