<?php

namespace RegionHalland\Theme;

class Enqueue
{

    public function __construct()
    {
        // Enqueue styles
        add_action('wp_enqueue_scripts', array($this, 'style'));

        // Enqueue scripts
        add_action('wp_enqueue_scripts', array($this, 'scripts'));
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

    /**
     * Enqueue scripts
     * @return void
    */

    public function scripts()
    {
        wp_enqueue_script('regionhalland', get_template_directory_uri() . '/assets/dist/js/app.min.js');
        //wp_enqueue_script('regionhalland');
    }    
}
