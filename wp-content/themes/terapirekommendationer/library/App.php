<?php
namespace Terapirekommendationer;

class App
{
    public function __construct()
    {
        new \Terapirekommendationer\Theme\Enqueue();
    }
}
