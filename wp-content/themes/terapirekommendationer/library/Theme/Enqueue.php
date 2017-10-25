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

        // Image plugin
        add_action('wp_enqueue_media', $func =
            function() {
                remove_action('admin_footer', 'wp_print_media_templates');
                add_action('admin_footer',  array($this, 'tr_custom_image_view') );
            }
        );


        // Attach callback to 'tiny_mce_before_init' 
        add_filter( 'tiny_mce_before_init', array($this, 'tr_modify_block_formats') );
        //add_filter( 'tiny_mce_before_init', array($this, 'my_mce_before_init') );
        add_filter( 'tiny_mce_before_init', array($this, 'my_mce4_options') );
        
        // Load the TinyMCE plugin : editor_plugin.js (wp2.5)
        add_filter( 'mce_external_plugins', array($this, 'myplugin_register_tinymce_javascript'));
        add_filter( 'mce_buttons_2', array($this, 'tr_register_mce_buttons') );
        add_filter( 'mce_buttons_3', array($this, 'tr_register_mce_target_audience') );
        add_filter( 'mce_buttons', array($this, 'tr_remove_mce_buttons') );
        add_filter( 'mce_buttons_2', array($this, 'tr_remove_mce_2_buttons') );
        //add_filter( 'mce_buttons_3', array($this, 'tr_register_mce_3_buttons') );
        

        add_filter( 'image_send_to_editor', array($this, 'html5_insert_image'), 10, 8 );

        // Wrap all images in figure tag
        // add_filter( 'image_send_to_editor', array($this, 'html5_insert_image'), 10, 8 );
        
        add_filter( 'revision_text_diff_options', array($this, 'modifyVersion') );
        
        //add_filter( 'process_text_diff_html', array($this, 'custom_hook'), 10, 3 );

        // Admin style
        add_action('admin_enqueue_scripts', array($this, 'adminStyle'), 999);
        
    }

    public function adminStyle()
    {
        wp_enqueue_style('tr-admin', get_stylesheet_directory_uri(). '/assets/dist/css/admin.min.css', '', '');
    }

    function modifyVersion(){
        $arrayName = array('show_split_view' => false);
        return $arrayName;
    }

    function custom_hook( $processed_line, $line, $string ) {
        //echo "<pre>" . $line . "</pre>";

        //$line = html_entity_decode($line);
        //$processed_line .= html_entity_decode($processed_line) . $string;
        //echo $line;
        //echo $string;
        //echo "<br />";
        //$line = html_entity_decode($line);
        //$line = "asd";
        //$processed_line = "asd2";
        //echo "<pre>" . $line . $string . "</pre>";
        
        //$processed_line = $line;
        return html_entity_decode($line);
    }

    function my_mce4_options( $init ) {
        $default_colours = '
            "000000", "Black",
            "ffffff", "White",
            "00579d", "Blue",
            "438011", "Green",
            "fdb813", "Yellow",
            "f44242", "Red"
        ';

        $init['textcolor_map'] = '['.$default_colours.']';
        //$init['textcolor_rows'] = 6; // expand colour grid to 6 rows
        return $init;
    }

        /**
     * Add stylesheet to editor
     * @return void
     */
    function editorStyle()
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
    array_unshift( $buttons, 'table' );

    $buttons[] = 'superscript';
    $buttons[] = 'subscript';

    return $buttons;
}

// Insert figure tag around image
// function html5_insert_image($html, $id, $caption, $title, $align, $url, $size, $alt) {
// $url = wp_get_attachment_url($id);
// $src = wp_get_attachment_image_src( $id, $size, false );
// $html5 = "<a href='$url'><figure class='align$align'>";
// $html5 .= "<img src='$src[0]' alt='$alt' />";
// if ($caption) {
// $html5 .= "<figcaption>$caption</figcaption>";
// }
// $html5 .= "</figure></a>";
// return $html5;
// }
function html5_insert_image($html, $id, $caption, $title, $align, $url, $size, $alt ) {
  //Always return an image with a <figure> tag, regardless of link or caption

  //Grab the image tag
  $image_tag = get_image_tag($id, '', $title, $align, $size);

  //Let's see if this contains a link
  $linkptrn = "/<a[^>]*>/";
  $found = preg_match($linkptrn, $html, $a_elem);

  // If no link, do nothing
  if($found > 0) {
    $a_elem = $a_elem[0];

    if(strstr($a_elem, "class=\"") !== false){ // If link already has class defined inject it to attribute
        $a_elem = str_replace("class=\"", "class=\"colorbox ", $a_elem);
    } else { // If no class defined, just add class attribute
        $a_elem = str_replace("<a ", "<a class=\"colorbox\" ", $a_elem);
    }
  } else {
    $a_elem = "";
  }
  // Set up the attributes for the caption <figure>
  $attributes  = (!empty($id) ? ' id="attachment_' . esc_attr($id) . '"' : '' );
  $attributes .= ' class="thumbnail wp-caption ' . 'align'.esc_attr($align) . '"';
  $output  = '<figure' . $attributes .'>';
  //add the image back in
  $output .= $a_elem;
  $output .= $image_tag;
  if($a_elem != "") {
    $output .= '</a>';
  }
  
  if ($caption) {
    $output .= '<figcaption class="caption wp-caption-text">'.$caption.'</figcaption>';
  }
  $output .= '</figure>';
  return $output;
}


// Add plugin to add options to images
function tr_custom_image_view() {
    ob_start();
    wp_print_media_templates();
    $tpl = ob_get_clean();
    if ( ( $idx = strpos( $tpl, 'tmpl-image-details' ) ) !== false
            && ( $before_idx = strpos( $tpl, '<div class="advanced-section">', $idx ) ) !== false ) {
        ob_start();
        ?>
        <div class="my_setting-section">
            <h2><?php _e( 'Tryck' ); ?></h2>
            <div>
                <label class="setting">
                    <span style="margin: 0 1% 0"><?php _e( 'Fullbredd i tryck' ); ?></span>
                        <input type="checkbox" data-setting="my_setting" value="{{ data.model.my_setting }}" />
                    </label>
                </div>
            </div>
        <?php
        $my_section = ob_get_clean();
        $tpl = substr_replace( $tpl, $my_section, $before_idx, 0 );
    }
    echo $tpl;
}


function tr_register_mce_target_audience( $buttons ) {
    array_push( $buttons, 'figure_comment', 'infobox_background', 'infobox_border', 'infobox_elder', 'infobox_children', 'print_formats' );

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
    $plugin_array['tr'] = $this->get_template_directory_child() . '/assets/dist/mce-js/mce_content_types_plugin.js';
    $plugin_array['table'] = $this->get_template_directory_child() . '/assets/dist/mce-js/mce_table_plugin.js';
    $plugin_array['images'] = $this->get_template_directory_child() . '/assets/dist/mce-js/image_plugin.js';

    return $plugin_array;
}

/*
* Callback function to filter the MCE settings
*/
function tr_modify_block_formats( $init ) {
    $init['block_formats'] = 'Paragraph=p;Mellanrubrik 1=h3;Mellanrubrik 2=h4;Mellanrubrik 3=h5;Mellanrubrik 4=h6;';

    return $init;
}

// function tr_register_mce_3_buttons( $buttons ) {
//     array_unshift( $buttons, 'styleselect' );
//     return $buttons;
// }


/*function my_mce_before_init( $init_array ) {
 
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
