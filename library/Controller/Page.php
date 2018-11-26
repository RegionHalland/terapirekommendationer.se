<?php

namespace RegionHalland\Controller;

class Page extends \RegionHalland\Controller\BaseController
{
    public function __construct()
    {
        global $post;
        global $wpdb;

        if (!is_a($post, 'WP_Post')) {
            return;
        }

        var_dump($myrows);

        $author_id = $post->post_author;
        //$opt = get_user_option( $option, $user ); 

        var_dump(get_current_blog_id());

        // WP_User_Query arguments
        $args = array(
            'blog_id' => 2,
            'search' => '',
            'search_columns' => array('ID')
        );

        // The User Query
        $user_query = new \WP_User_Query( $args );

        var_dump($user_query->get_results());
    }
}
