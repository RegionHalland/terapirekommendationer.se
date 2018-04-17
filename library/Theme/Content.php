<?php

namespace Terapirekommendationer\Theme;

use Sunra\PhpSimple\HtmlDomParser;

class Content
{
    public function __construct()
    {
        add_filter( 'the_content', array($this, 'auto_id_headings'));
        add_filter( 'the_content', array($this, 'auto_wrap_tables'));
    }

    /**
     * Automatically add IDs to headings such as <h2></h2>
     */
    function auto_id_headings($content) {
        $content = preg_replace_callback( '/(\<h[1-6](.*?))\>(.*)(<\/h[1-6]>)/i', function($matches) {
            if ( ! stripos( $matches[0], 'id=' ) ) :
                $matches[0] = $matches[1] . $matches[2] . ' id="' . sanitize_title( $matches[3] ) . '">' . $matches[3] . $matches[4];
            endif;
            return $matches[0];
        }, $content );

        return $content;
    }

    /**
    * Wrap tables in div to prevent overflow.
    */

    function auto_wrap_tables($content) {
        $content = HtmlDomParser::str_get_html($content);
        
        if ($content) {
            foreach ($content->find('table') as $element) 
                $element->outertext = '<div class="table-container">' . $element . '</div>';
        }

        return $content;
    }
}
