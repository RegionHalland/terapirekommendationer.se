<?php

namespace RegionHalland\Search;

class Algolia
{
    public function __construct()
    {
        add_filter('algolia_post_shared_attributes', array($this, 'my_post_attributes'), 10, 3);
        add_filter('algolia_searchable_post_shared_attributes', array($this, 'my_post_attributes'), 10, 3);
    }

    /**
    * @param array   $attributes
    * @param WP_Post $post
    *
    * @return array
    */
    public function my_post_attributes(array $shared_attributes, \WP_Post $post) {
        if ( $post->post_type !== 'page' ) {
            // We only want to add an attribute for the 'speaker' post type.
            // Here the post isn't a 'speaker', so we return the attributes unaltered.
            return $shared_attributes;
        }
        // Get the field value with the 'get_field' method and assign it to the attributes array.
        // @see https://www.advancedcustomfields.com/resources/get_field/
        $breadcrumbs = \RegionHalland\Theme\Navigation::getBreadcrumbs($post);
        if(isset($breadcrumbs)){
            $shared_attributes['breadcrumbs'] = $breadcrumbs;
        }
        // Always return the value we are filtering.
        return $shared_attributes;
    }
}
