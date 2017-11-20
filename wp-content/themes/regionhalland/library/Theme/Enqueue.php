<?php

namespace RegionHalland\Theme;

class Enqueue
{

    public function __construct()
    {
        // Enqueue styles
        add_action('wp_enqueue_scripts', array($this, 'style'));
        // Enqueue scripts
        add_action('wp_enqueue_scripts', array($this, 'script'));
        // Add styleguide to tinymce editor
        add_editor_style( '//regionhalland.github.io/styleguide/dist/css/main.min.css' );
    }

    /**
     * Enqueue styles
     * @return void
    */
    public function style()
    {
        wp_register_style('regionhalland', "//regionhalland.github.io/styleguide/dist/css/main.min.css");
        wp_enqueue_style('regionhalland');
    }

    /**
     * Enqueue scripts
     * @return void
    */
    public function script()
    {
        wp_enqueue_script('regionhalland', get_template_directory_uri() . '/assets/dist/js/app.min.js', array('jquery'), null, true);
        wp_enqueue_script('algolia-search', '//cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js', true);
        wp_enqueue_script('algolia-search-autocomplete', '//cdn.jsdelivr.net/autocomplete.js/0/autocomplete.jquery.min.js', true);
    }    
}