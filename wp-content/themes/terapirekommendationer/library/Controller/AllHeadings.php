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

class AllHeadings extends \RegionHalland\Controller\BaseController
{
    public function init()
    {
    	/*$page_id = 473;
    	$post = get_post($page_id);
    	var_dump($content = $post->post_content);
        preg_match_all("/<(h\d.*)>(\w[^<]*)/i", $content, $matches);
        var_dump($matches);

        
        foreach ($matches[1] as $key => $value) {
        	echo preg_match("/(h\d)/i", $value, $matchesTwo);
        	//preg_match_all("/(h\d)/i", $value, $matchesTwo);
        	# code...
        	//var_dump(preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $value));
        }

        var_dump($matchesTwo);

        //var_dump($matchesTwo);

        
        die();
        if (isset($matches[0]) && isset($matches[1]) && isset($matches[2]) ){
            $uniqueArr = array_unique($matches[1]);
            $arrTwo = array_fill_keys($uniqueArr, []);
            
            /*foreach ($matches[2] as $key => $value) {
                array_push($arrTwo[$matches[1][$key]], [
                        'post_title' => $value,
                        'slug' => sanitize_title($value)
                    ]
                );
            }
            if (isset($arrTwo)){
            	var_dump($arrTwo);
                //$shared_attributes['headings'] = $arrTwo;
            }
        }



    	die();*/

    	/*$breadcrumbs = \RegionHalland\Theme\Navigation::getBreadcrumbs($post);

    	var_dump($breadcrumbs);
    	die();
    	/*$breadcrumbsArray = [];
    	foreach ($breadcrumbs as $key => $value) {
    		$breadcrumbsArray[] = trim(strip_tags($value));
    	}
    	if (isset($breadcrumbsArray[0])) {
    		unset($breadcrumbsArray[0]);
    	}
    	var_dump($breadcrumbsArray);
    	die();*/

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
			array_push($chapters, $value);
		}

		foreach ($chapters as $key => $chapter) {
			$argsTwo = array(
				'sort_order' => 'asc',
				'sort_column' => 'menu_order',
				'parent' => $chapter->ID,
			);
			$chapters[$key]->children = get_pages($argsTwo);

		}



		foreach ($chapters as $key => $value) {
			foreach ($value->children as $k => $v) {
					$v->headings = array();
					
					if ($v->post_content !== "") {
						$domd = new \DOMDocument();
						libxml_use_internal_errors(true);
						$domd->loadHTML(mb_convert_encoding($v->post_content, 'HTML-ENTITIES', 'UTF-8'));
						libxml_use_internal_errors(false);
						$domx = new \DOMXPath($domd);
						$items = $domx->query("//h3 | //h4 | //h5 | //h6");

						foreach ($items as $k => $item) {
							array_push($v->headings, $item);
						}
					}
			}
		}

        $this->VIEWS_PATHS = apply_filters('RegionHalland/blade/view_paths', array(
            get_stylesheet_directory() . '/views',
            get_template_directory() . '/views'
        ));
		$this->CACHE_PATH = WP_CONTENT_DIR . '/uploads/cache/blade-cache';

        $blade = new Blade($this->VIEWS_PATHS, $this->CACHE_PATH);
        //echo $blade->view()->make($view, $data)->render();
    	
    	echo $myString = $blade->view()->make('all-headings', [
    		"chapters" => $chapters
    	])->render();
    }
}
