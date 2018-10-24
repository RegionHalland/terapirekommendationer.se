<?php

namespace RegionHalland\Theme;

class Enqueue
{
    protected $COMPONENT_LIB_URL = '//regionhalland.github.io/styleguide/dist/css/main.min.css';
    
    public function __construct() 
    {
        // We have a new styleguide at:
        // https://github.com/regionhalland/styleguide-v2

        // We want to use this as soon as possible.
        
        // Enqueue Region Halland Component Library
        // if (!empty(env('COMPONENT_LIB_URL'))) {
        //     $this->COMPONENT_LIB_URL = env('COMPONENT_LIB_URL');
        // }

        // Enqueue styles
        add_action('wp_enqueue_scripts', array($this, 'style'));

        // Enqueue scripts
        add_action('wp_enqueue_scripts', array($this, 'script'));
        
        // Add styleguide to tinymce editor
        add_editor_style( $this->COMPONENT_LIB_URL );
 
        // Enqueue admin styles
        add_action( 'admin_enqueue_scripts', array($this, 'tr_admin_styles'));

        // Get posts by post_title
        add_filter( 'posts_where', array($this, 'title_like_posts_where'), 10, 2 );

        // Image plugin
        add_action('wp_enqueue_media', $func =
            function() {
                remove_action('admin_footer', 'wp_print_media_templates');
                add_action('admin_footer',  array($this, 'tr_custom_image_view') );
            }
        );

        // Allow SVG uploads
        add_filter('upload_mimes', array($this, 'cc_mime_types') );

        // Attach callback to 'tiny_mce_before_init' 
        add_filter( 'tiny_mce_before_init', array($this, 'tr_modify_block_formats') ); 
        add_filter( 'tiny_mce_before_init', array($this, 'tr_extended_valid_elements') );
        add_filter( 'tiny_mce_before_init', array($this, 'my_mce4_options') );
        add_filter( 'tiny_mce_before_init', array($this, 'tr_tinymce_body_class') );
        
        // Load the TinyMCE plugin : editor_plugin.js (wp2.5)
        add_filter( 'mce_external_plugins', array($this, 'myplugin_register_tinymce_javascript'));
        add_filter( 'mce_buttons_2', array($this, 'tr_register_mce_buttons') );
        add_filter( 'mce_buttons_3', array($this, 'tr_register_mce_target_audience') );
        add_filter( 'mce_buttons', array($this, 'tr_remove_mce_buttons') );
        add_filter( 'mce_buttons_2', array($this, 'tr_remove_mce_2_buttons') );

        add_filter( 'image_send_to_editor', array($this, 'html5_insert_image'), 10, 8 );
        add_filter( 'disable_captions', function($a) { return true; });

        add_filter( 'revision_text_diff_options', array($this, 'modifyVersion') );
    }
    
    /**
     * Enqueue styles
     * @return void
    */
    function tr_admin_styles() {
        wp_enqueue_style( 'tr_admin_css', get_template_directory_uri() . '/assets/dist/css/admin.min.css');
        add_editor_style( get_template_directory_uri() . '/assets/dist/css/editor.min.css');
    }

    /**
     * Enqueue styles
     * @return void
    */
    public function style()
    {
        wp_register_style('regionhalland', $this->COMPONENT_LIB_URL);
        wp_enqueue_style('regionhalland');
        wp_enqueue_style('docsearch', "//cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.css");
        
        wp_register_style('theme_css', get_template_directory_uri() . '/assets/dist/css/main.min.css');
        wp_enqueue_style('theme_css');

    }

    /**
     * Add stylesheet to editor
     * @return void
     */
    function editorStyle()
    {
        add_editor_style(apply_filters('editor', 'assets/dist/css/editor.min.css'));
    }

    /**
     * Enqueue scripts
     * @return void
    */
    public function script()
    {
        wp_enqueue_script('waypoints', 'https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js', array('jquery'), null, true);
        wp_enqueue_script('waypoints-sticky', 'https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/shortcuts/sticky.min.js', array('jquery', 'waypoints'), null, true);
        wp_enqueue_script('regionhalland', get_template_directory_uri() . '/assets/dist/js/app.min.js', array('jquery'), null, true);
        wp_enqueue_script('algolia-search', '//cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js', true);
        wp_enqueue_script('algolia-search-autocomplete', '//cdn.jsdelivr.net/autocomplete.js/0/autocomplete.jquery.min.js', true);
        wp_enqueue_script('algolia-docsearch', "https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.js", true);
    }

    function my_mce4_options( $init )
    {
        $default_colours = '
            "000000", "Black",
            "ffffff", "White",
            "00579d", "Blue",
            "438011", "Green",
            "fdb813", "Yellow",
            "f44242", "Red"
        ';

        $init['textcolor_map'] = '['.$default_colours.']';

        return $init;
    }

    function cc_mime_types($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }

    /**
     * Add option to look for posts where post_title is *
     * @return string
     */
    function title_like_posts_where( $where, $wp_query ) {
        global $wpdb;
        if ( $post_title_like = $wp_query->get( 'post_title_like' ) ) {
            $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $post_title_like ) ) . '%\'';
        }
        return $where;
    }

    /**
     * Register buttons
     */
    function tr_register_mce_buttons( $buttons ) {
        array_unshift( $buttons, 'table' );

        $buttons[] = 'superscript';
        $buttons[] = 'subscript';

        return $buttons;
    }

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

            if(strstr($a_elem, "class=\"") !== false){ 
                // If link already has class defined inject it to attribute
                $a_elem = str_replace("class=\"", "class=\"colorbox ", $a_elem);
            } else { 
                // If no class defined, just add class attribute
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

    /**
     * Add plugin to add options to images
     * @return void
     */
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
        $plugin_array['tr'] = get_template_directory_uri() . '/assets/dist/mce-js/mce_content_types_plugin.js';
        $plugin_array['table'] = get_template_directory_uri() . '/assets/dist/mce-js/mce_table_plugin.js';
        $plugin_array['images'] = get_template_directory_uri() . '/assets/dist/mce-js/image_plugin.js';
    
        return $plugin_array;
    }

    /**
     * Callback function to filter the MCE settings
     * @return void
     */
    function tr_modify_block_formats( $init ) {
        $init['block_formats'] = 'Paragraph=p;Rubrik 1=h3;Rubrik 2=h4;Rubrik 3=h5;Rubrik 4=h6;';
        return $init;
    }

    function tr_extended_valid_elements( $init ) {
        $init['extended_valid_elements'] = 'svg[*],use[*],text[*]';
        return $init;
    }
    
    function tr_tinymce_body_class( $mce ) {
        $mce['body_class'] .= ' article';
        return $mce;
    }
}