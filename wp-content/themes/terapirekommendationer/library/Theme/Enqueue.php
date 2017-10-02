<?php

namespace Terapirekommendationer\Theme;

class Enqueue
{
    public function __construct()
    {
        // Enqueue scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'style'));
        add_action('wp_enqueue_scripts', array($this, 'script'));
        add_action('admin_init', array($this, 'editorStyle'));
        
        // Attach callback to 'tiny_mce_before_init' 
        add_filter( 'tiny_mce_before_init', array($this, 'tr_modify_block_formats') );
        // Load the TinyMCE plugin : editor_plugin.js (wp2.5)
        add_filter( 'mce_external_plugins', array($this, 'myplugin_register_tinymce_javascript'));
        add_filter( 'mce_buttons_2', array($this, 'tr_register_mce_buttons') );
        add_filter( 'mce_buttons', array($this, 'tr_remove_mce_buttons') );
        add_filter( 'mce_buttons_2', array($this, 'tr_remove_mce_2_buttons') );
        

        
    }

        /**
     * Add stylesheet to editor
     * @return void
     */
    public function editorStyle()
    {
        add_editor_style(apply_filters('Municipio/admin/editor_stylesheet', '//regionhalland.github.io/styleguide-web/dist/css/hbg-prime-' . \Municipio\Theme\Enqueue::getStyleguideTheme() . '.min.css'));
    }

// create a URL to the child theme
function get_template_directory_child() {
    $directory_template = get_template_directory_uri(); 
    $directory_child = str_replace('municipio', '', $directory_template) . 'terapirekommendationer';

    return $directory_child;
}

function tr_register_mce_buttons( $buttons ) {
    array_push( $buttons, 'dropcap', 'content_types' );
    $buttons[] = 'superscript';
    $buttons[] = 'subscript';


    return $buttons;
}

function tr_remove_mce_buttons( $buttons ) {
    $remove = array('blockquote', 'wp_more', 'alignleft', 'aligncenter', 'alignright');

    return array_diff( $buttons, $remove );
}

function tr_remove_mce_2_buttons( $buttons ) {
    $remove = array( 'indent', 'outdent', 'hr');

    return array_diff( $buttons, $remove );
}

function myplugin_register_tinymce_javascript( $plugin_array ) {
   $plugin_array['tr'] = $this->get_template_directory_child() . '/assets/dist/mce-js/editor_plugin.js';

   return $plugin_array;
}

/*
* Callback function to filter the MCE settings
*/
function tr_modify_block_formats( $init ) {
    $init['block_formats'] = 'Paragraph=p;Mellanrubrik 1=h3;Mellanrubrik 2=h4;Mellanrubrik 3 Blå=h5;Mellanrubrik 4=h6;';

    return $init;
}
/*function my_mce_before_init_insert_formats( $init_array ) {
 
// Define the style_formats array
 
    $style_formats = array(  
/*
* Each array child is a format with it's own settings
* Notice that each array has title, block, classes, and wrapper arguments
* Title is the label which will be visible in Formats menu
* Block defines whether it is a span, div, selector, or inline style
* Classes allows you to define CSS classes
* Wrapper whether or not to add a new block-level element around any selected elements

        array(  
            'title' => 'Content Block',  
            'block' => 'div',  
            'classes' => 'box',
            'wrapper' => true,  
        ),  
        /*array(  
            'title' => 'Blue Button',  
            'block' => 'span',  
            'classes' => 'blue-button',
            'wrapper' => true,
        )
    );  
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );  
     
    return $init_array;  
   
} */


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
