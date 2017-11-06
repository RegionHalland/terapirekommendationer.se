<?php

namespace Halland\Theme;

class Enqueue
{
    public function __construct()
    {
        // Enqueue scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'style'), 5);
    }


	/**
    * Enqueue styles
    * @return void
    */
    public function style()
    {
        wp_register_style('halland', HALLAND_PATH . '/assets/dist/' . \Municipio\Helper\CacheBust::name('css/main.min.css'), '', null);
        wp_enqueue_style('halland');
    }

}
