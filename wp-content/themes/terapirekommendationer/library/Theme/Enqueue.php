<?php

namespace Terapirekommendationer\Theme;

class Enqueue
{
    public function __construct()
    {
        // Enqueue scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'style'));
        add_action('wp_enqueue_scripts', array($this, 'script'));
        // Attach callback to 'tiny_mce_before_init' 
        add_filter( 'tiny_mce_before_init', array($this, 'my_mce_before_init_insert_formats') );
    }

/*
* Callback function to filter the MCE settings
*/
 
function my_mce_before_init_insert_formats( $init_array ) {  
 
// Define the style_formats array
 
    $style_formats = array(  
/*
* Each array child is a format with it's own settings
* Notice that each array has title, block, classes, and wrapper arguments
* Title is the label which will be visible in Formats menu
* Block defines whether it is a span, div, selector, or inline style
* Classes allows you to define CSS classes
* Wrapper whether or not to add a new block-level element around any selected elements
*/
        array(  
            'title' => 'Content Block',  
            'block' => 'span',  
            'classes' => 'box-filled-1',
            'wrapper' => true,  
        ),  
        /*array(  
            'title' => 'Blue Button',  
            'block' => 'span',  
            'classes' => 'blue-button',
            'wrapper' => true,
        )*/
    );  
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );  
     
    return $init_array;  
   
} 


    /**
     * Enqueue styles
     * @return void
     */
    public function style()
    {
        wp_register_style('hbg-prime', 'https://regionhalland.github.io/styleguide-web/dist/css/hbg-prime-blue.min.css?ver=latest', '', '1.0.0');
        wp_enqueue_style('hbg-prime');

        wp_enqueue_style('Terapirekommendationer-css', get_stylesheet_directory_uri(). '/assets/dist/css/app.min.css', '', filemtime(get_stylesheet_directory() . '/assets/dist/css/app.min.css'));
    }

    /**
     * Enqueue scripts
     * @return void
     */
    public function script()
    {
        wp_register_script('hbg-prime', 'http://helsingborg-stad.github.io/styleguide-web-cdn/styleguide.dev/dist/js/hbg-prime.min.js', '', '1.0.0', true);
        wp_enqueue_script('hbg-prime');

        wp_enqueue_script('Terapirekommendationer-js', get_stylesheet_directory_uri(). '/assets/dist/js/app.min.js', '', filemtime(get_stylesheet_directory() . '/assets/dist/js/app.min.js'), true);
    }
}
