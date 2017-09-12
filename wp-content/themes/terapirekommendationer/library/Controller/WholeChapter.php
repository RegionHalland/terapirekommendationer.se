<?php

namespace Terapirekommendationer\Controller;

//require_once('prince.php');

/**
 * To add a custom template and load it's controller do the following:
 *
 * 1. Create a view file inside the /views directory (example: custom-template-view.blade.php)
 * 2. Create a controller file inside library/Controller (example: name it CustomTemplateView.php and name the class CustomTemplateView)
 * 3. Initialize your template and view by calling the below function (preferabily from a /library/Theme/xxxx.php class)
 *    \Municipio\Helper\Template::add(__('Custom template', 'municipio'), \Municipio\Helper\Template::locateTemplate('custom-template-view.blade.php'));
 */

class WholeChapter extends \Municipio\Controller\BaseController
{
    public function init()
    {
    	$page_id = get_the_id();
    	$args = array(
		    'post_type'      => 'page',
		    'posts_per_page' => -1,
		    //'p' => 473,
		    'post_parent'    => $page_id,
		    'order'          => 'ASC',
		    'orderby'        => 'menu_order'
		 );

		$parent = new \WP_Query( $args );
		//return $parent;
    	/*$prince = new PrinceWrapper('/home/vagrant/Code/Region_Halland/terapirekommendationer.se/wp-content/themes/terapirekommendationer/library/Controller/prince');

    	//$prince->convert_file("/Users/sema0703/Code/Region_Halland/terapirekommendationer.se/vendor/gridonic/princexml-php/lib/readme.html");
    	wp_die(json_encode($prince));*/
		//$prince = new Prince('./prince');
		/*foreach ($parent->posts as $key => $post) {
			echo '<h1>' . $post->post_title  .'</h1>';
			echo '<p>' . $post->post_content  .'</p>';
		}
		die();*/

		$this->data["parent"] = $parent;

    }


    public function getChapters(){
    	$page_id = get_the_id();
    	
    	$args = array(
		    'post_type'      => 'page',
		    'posts_per_page' => -1,
		    'post_parent'    => $page_id,
		    'order'          => 'ASC',
		    'orderby'        => 'menu_order'
		 );

		$parent = new \WP_Query( $args );
    	return $parent;
    }
}
