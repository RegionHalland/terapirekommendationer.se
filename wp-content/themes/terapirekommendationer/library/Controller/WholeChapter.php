<?php

namespace Terapirekommendationer\Controller;

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
        // This will make a variable with name "exampleVariable"
        // accessible from the view of this controller

        $this->data['parent'] = $this->getChapters();
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
