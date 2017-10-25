<?php
/*
Plugin Name: Custom Diff
Description: Diff it!
Version:     1.0
Author:      Sebastian Marcusson
*/

namespace CustomOwfDiff;
use Caxy\HtmlDiff\HtmlDiff;

class CustomOwfDiff
{
    public function __construct()
    {
        \add_filter( 'owf_inbox_row_actions', array($this, 'custom_inbox_row_actions'), 10, 2 );
        \add_action('admin_menu', array($this, 'my_menu'));
        //add_menu_page( 'Test Plugin Page', 'Test Plugin', 'manage_options', 'test-plugin', 'test_init' );
    }

    function my_menu() {
    	add_menu_page( 'Test Plugin Page', 'Test Plugin', 'manage_options', 'test-plugin', array($this, 'test_init') );
    	remove_submenu_page( 'admin.php', '?page=test-plugin' );
	}

	function test_init(){
		$revision_post_id = intval( $_GET['post'] );

		$original_post_id = get_post_meta( $revision_post_id, '_oasis_original', true );

		if(!$original_post_id) return;

		$post = get_post( $original_post_id );
		$revision_post = get_post( $revision_post_id );

		$post_content = apply_filters('the_content', $post->post_content);
		$post_content = str_replace(']]>', ']]&gt;', $post->post_content);

		$revision_post_content = apply_filters('the_content', $revision_post->post_content);
		$revision_post_content = str_replace(']]>', ']]&gt;', $revision_post->post_content);

		$post_id = $_GET["post"];
		$htmlDiff = new HtmlDiff($post_content, $revision_post_content);
		$content = $htmlDiff->build();


		echo '<link rel="stylesheet" type="text/css" href="https://regionhalland.github.io/styleguide-web/dist/css/hbg-prime-blue.min.css?ver=latest">';

		echo '<style>ins {
    border: 1px solid rgb(192,255,192);
    background: rgb(224,255,224);
    text-decoration:none;
}
del {
	text-decoration:none;
    border: 1px solid rgb(255,192,192);
    background: rgb(255,224,224);
}</style><div style="padding-top:2em;width:60%;margin:auto;">'. $content . '</div>';
	}


    public function custom_inbox_row_actions($post_id, $inbox_row_actions){
    	unset( $inbox_row_actions['compare'] );

		/** Add a Thumbnail link **/
		$link_info = "<span><a href=admin.php?page=test-plugin&post=". $post_id["post_id"] . " class='edit'>" . __( "Compare", "oasisworkflow" ) . "</a></span>";

		$my_custom_inbox_action = array(
			'thumbnail' => $link_info
		); 

		$inbox_row_actions = array_merge( $inbox_row_actions, $my_custom_inbox_action );
 
    	return $inbox_row_actions;
    }


}

new \CustomOwfDiff\CustomOwfDiff();