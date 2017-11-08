<?php

namespace RegionHalland;

class App
{
	public function __construct()
	{
		///**
		// * Template
		// */
		new \RegionHalland\Template();

		///**
		// * Theme
		// */
		new \RegionHalland\Theme\Navigation();
		
		/**
		 * Helpers
		 */
	   //new \RegionHalland\Helper\GravityForm();

	   ///**
	   // * Template
	   // */
	   //new \RegionHalland\Template();

	   ///**
	   // * Theme
	   // */
	   //new \RegionHalland\Theme\Enqueue();
	   //new \RegionHalland\Theme\Support();
	   //new \RegionHalland\Theme\Sidebars();
	   //new \RegionHalland\Theme\Navigation();
	   //new \RegionHalland\Theme\General();
	   //new \RegionHalland\Theme\OnTheFlyImages();
	   //new \RegionHalland\Theme\ImageSizeFilter();
	   //new \RegionHalland\Theme\CustomCodeInput();
	   //new \RegionHalland\Theme\Blog();
	   //new \RegionHalland\Theme\FileUploads();
	   //new \RegionHalland\Theme\Archive();
	   //new \RegionHalland\Theme\EventArchive();
	   //new \RegionHalland\Theme\CustomTemplates();
	   //new \RegionHalland\Theme\Font();
	   //new \RegionHalland\Theme\ColorScheme();

	   //new \RegionHalland\Search\General();

	   ///**
	   // * Content
	   // */
	   //new \RegionHalland\Content\CustomPostType();
	   //new \RegionHalland\Content\CustomTaxonomy();
	   //new \RegionHalland\Content\PostFilters();
	   //new \RegionHalland\Content\ShortCode();
	   //new \RegionHalland\Content\Cache();

	   ///**
	   // * Widget
	   // */
	   //new \RegionHalland\Widget\RichEditor();
	   //new \RegionHalland\Widget\Contact();

	   ///**
	   // * Comments
	   // */
	   //new \RegionHalland\Comment\HoneyPot();
	   //new \RegionHalland\Comment\LikeButton();
	   //new \RegionHalland\Comment\CommentsFilters();

	   //add_action('widgets_init', function () {
	   //    register_widget('\RegionHalland\Widget\Contact');
	   //});

		/**
		 * Admin
		 
		new \RegionHalland\Admin\General();
		new \RegionHalland\Admin\Customizer();

		new \RegionHalland\Admin\Options\Theme();
		new \RegionHalland\Admin\Options\Timestamp();
		new \RegionHalland\Admin\Options\Favicon();
		new \RegionHalland\Admin\Options\GoogleTranslate();
		new \RegionHalland\Admin\Options\Archives();
		new \RegionHalland\Admin\Options\ContentEditor();

		new \RegionHalland\Admin\Roles\General();
		new \RegionHalland\Admin\Roles\Editor();

		new \RegionHalland\Admin\UI\VarnishPurge();
		new \RegionHalland\Admin\UI\BackEnd();
		new \RegionHalland\Admin\UI\FrontEnd();
		new \RegionHalland\Admin\UI\Editor();

		new \RegionHalland\Admin\TinyMce\LoadPlugins();

		/**
		 * Api
		 
		new \RegionHalland\Api\Navigation();

		add_filter('Modularity/CoreTemplatesSearchPaths', function ($paths) {
			$paths[] = get_stylesheet_directory() . '/views';
			$paths[] = get_template_directory() . '/views';
			return $paths;
		});*/
	}
}
