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

class AllReklistor extends \RegionHalland\Controller\BaseController
{
    public function init()
    {	
		$args = array(
			'post_type'       => 'page',
			'posts_per_page'  => -1,
		    'post_title_like' => 'Rekommenderade läkemedel'
		);
		$pages = new \WP_Query( $args );
		$pages = $pages->get_posts();

		$lists = array();

		foreach ($pages as $key => $page) {
			$parent = get_post($page->post_parent);

			if ( isset($parent) ) {
				$page->parent_menu_order = $parent->menu_order;
				$page->parent_title = $parent->post_title;
			}

			array_push($lists, $page);
		}

		usort($lists, function($a, $b) {
			return $a->parent_menu_order <=> $b->parent_menu_order;
		});

 		$this->data['lists'] = $lists;
    }
}
