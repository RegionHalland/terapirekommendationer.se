<?php

namespace Terapirekommendationer\Controller;

use PrinceXMLPhp\PrinceWrapper;
use Philo\Blade\Blade;
use Sunra\PhpSimple\HtmlDomParser;

/**
 * To add a custom template and load it's controller do the following:
 *
 * 1. Create a view file inside the /views directory (example: custom-template-view.blade.php)
 * 2. Create a controller file inside library/Controller (example: name it CustomTemplateView.php and name the class CustomTemplateView)
 * 3. Initialize your template and view by calling the below function (preferabily from a /library/Theme/xxxx.php class)
 *    \Municipio\Helper\Template::add(__('Custom template', 'municipio'), \Municipio\Helper\Template::locateTemplate('custom-template-view.blade.php'));
 */

class AllReklistorSsk extends \RegionHalland\Controller\BaseController
{
	public function init()
	{	
		global $post;
		
		$content = HtmlDomParser::str_get_html($post->post_content);
        
        $lists = $content->find('table[class=table]');

       	foreach ($lists as $key => $list) {
			$lists[$key]->heading =
				$content->find('thead[class=table__header]', $key)->children(0)->children(0)->innertext;
       	}

        $this->data['lists'] = $lists;
    
		$this->VIEWS_PATHS = apply_filters('RegionHalland/blade/view_paths', array(
			get_stylesheet_directory() . '/views',
			get_template_directory() . '/views'
		));
		$this->CACHE_PATH = WP_CONTENT_DIR . '/uploads/cache/blade-cache';

		$blade = new Blade($this->VIEWS_PATHS, $this->CACHE_PATH);
		
		$blade->view()->make('all-reklistor')->render();

		$myString = $blade->view()->make('all-reklistor-ssk', [
			'lists' => $lists
		])->render();

		$htmlDir = 'wp-content/themes/terapirekommendationer/assets/dist/html/';

		if ( !is_dir($htmlDir) ) {
			mkdir($htmlDir);
		}
		echo file_put_contents($htmlDir . 'rek-ssk.html', $myString);
	}
}
