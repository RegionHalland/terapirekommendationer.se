<?php

namespace Halland;

class App
{
    public function __construct()
    {
        /**
         * Theme
         */
        new \Halland\Theme\Enqueue();
    }
}
