<?php

namespace Terapirekommendationer\Controller;

use PrinceXMLPhp\PrinceWrapper;
use Philo\Blade\Blade;

/**
 * To add a custom template and load it's controller do the following:
 *
 * 1. Create a view file inside the /views directory (example: custom-template-view.blade.php)
 * 2. Create a controller file inside library/Controller (example: name it CustomTemplateView.php and name the class CustomTemplateView)
 * 3. Initialize your template and view by calling the below function (preferabily from a /library/Theme/xxxx.php class)
 *    \Municipio\Helper\Template::add(__('Custom template', 'municipio'), \Municipio\Helper\Template::locateTemplate('custom-template-view.blade.php'));
 */

class WholeChapter extends \RegionHalland\Controller\BaseController
{
    public function init()
    {
    	//var_dump(expression)
    	//$blade = New View();
    	//return $blade('whole-chapter', ['name' => 'James']);
    	$page_id = 3913;
    	$page_id_chapter1 = 183;
    	$chapterOne = get_page($page_id_chapter1);

		$args = array(
			'sort_order' => 'asc',
			'sort_column' => 'menu_order',
			//'child_of' => 0,
			'parent' => $page_id,
		);
		$pages = get_pages($args);

		$chapters = array();

		foreach ($pages as $key => $value) {
			if ($key < 9) {
				array_push($chapters, $value);
			}
		}
		

		// var_dump($chapters);
		// die();

		foreach ($chapters as $key => $chapter) {
			$argsTwo = array(
				'sort_order' => 'asc',
				'sort_column' => 'menu_order',
				'parent' => $chapter->ID,
			);
			$chapters[$key]->children = get_pages($argsTwo);

			/*foreach ($pages[$key]->children as $k => $grand) {
				# code...
				//echo json_encode($grand);
				$argsThree = array(
					'sort_order' => 'asc',
					'sort_column' => 'menu_order',
					'parent' => $grand->ID,
				);

				$grand->grand_children = get_pages($argsThree);
			}
			//wp_die();
			//wp_die(json_encode($children));
			/*foreach ($variable as $key => $value) {
				# code...
			}*/
			/*$argsThree = array(
				'sort_order' => 'asc',
				'sort_column' => 'menu_order',
				'parent' => $child->ID,
			);*/

			//$pages[$key]->hello =

			/*foreach ($child as $k => $grand_child) {
				$argsThree = array(
					'sort_order' => 'asc',
					'sort_column' => 'menu_order',
					'parent' => $child->ID,
				);

				echo get_pages($argsThree);

				//$child[$k]->grand_children = get_pages($argsThree);
			}*/

		}

		//var_dump($pages[0]->children[2]->grand_children);


		//$pages->children = get_page_children($portfolio->ID, $pages);

	/*$myArr = array(
		"chapters" => $pages,
		"chapter_children" => $chapter_children,
		"chapter_grand_children" => $pages
	);*/
		//print_r($pages);

		//die()

		$views = __DIR__;
		$cache = __DIR__;
    	$blade = new Blade($views, $cache);
    	
    	echo $myString = $blade->view()->make('print', [
    		"chapter_one" => $chapterOne,
    		"chapters" => $chapters
    	])->render();

		/*$file = 'tr.html';
		// Open the file to get existing content
		$current = file_get_contents($file);
		// Append a new person to the file
		$current .= "John Smith\n";
		// Write the contents back to the file
		file_put_contents($file, $current);*/

		if (!is_dir('wp-content/themes/terapirekommendationer/assets/dist/html/')) {
  			// dir doesn't exist, make it
  			mkdir('wp-content/themes/terapirekommendationer/assets/dist/html/');
		}

		echo file_put_contents("wp-content/themes/terapirekommendationer/assets/dist/html/tr.html", $myString);

    	die();




    	$prince = new PrinceWrapper('/usr/bin/prince');
    	$prince->addStyleSheet(__DIR__.'/min.css');
		$err = [];
		$prince->convert_string_to_file($myString, './tr.pdf', $err);
		var_dump($err);

    	die();
    	//var_dump(Blade);
		//echo $blade->view()->make('print', ['name' => 'James'])->render();

    	//return \Illuminate::view('whole-chapter', ['name' => 'James']);

    	/*$book = "";
    	$page_id = 3913;
    	$args = array(
		    'post_type'      => 'page',
		    'posts_per_page' => -1,
		    //'p' => 473,
		    'post_parent'    => $page_id,
		    'order'          => 'ASC',
		    'orderby'        => 'menu_order'
		 );

		$parent = new \WP_Query( $args );

		/*foreach ($parent->posts as $key => $post) {
			$book = boo $post->post_title;
		}
		
		echo $book;
		die();


		$prince = new PrinceWrapper('/usr/bin/prince');
		$err = [];
		$prince->convert_string_to_file('', './tr.pdf', $err);
		var_dump($err);

		/* DO NOT REMOVE */
		//die();
    }


    public function getChapters(){
    	/*$page_id = get_the_id();
    	
    	$args = array(
		    'post_type'      => 'page',
		    'posts_per_page' => -1,
		    'post_parent'    => $page_id,
		    'order'          => 'ASC',
		    'orderby'        => 'menu_order'
		 );

		$parent = new \WP_Query( $args );
    	return $parent;*/
    }
}
