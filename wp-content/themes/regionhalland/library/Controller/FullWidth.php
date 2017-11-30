<?php

namespace RegionHalland\Controller;

class FullWidth extends \RegionHalland\Controller\BaseController
{
    public function init()
    {
        $this->data['contentGridSize'] = 'grid-md-12';
    }
}
