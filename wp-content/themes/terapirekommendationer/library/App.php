<?php
namespace Terapirekommendationer;

class App
{
    public function __construct()
    {
    	/* THEME */
        new \Terapirekommendationer\Theme\Enqueue();
        new \Terapirekommendationer\Theme\CustomTemplates();
        new \Terapirekommendationer\Theme\Content();
    }
}
