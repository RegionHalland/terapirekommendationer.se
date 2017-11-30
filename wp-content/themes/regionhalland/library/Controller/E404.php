<?php

namespace RegionHalland\Controller;

class E404 extends \RegionHalland\Controller\BaseController
{
    public function init()
    {
        $searchKeyword = $_SERVER['REQUEST_URI'];
        $searchKeyword = str_replace('/', ' ', $searchKeyword);
        $searchKeyword = trim($searchKeyword);

        $this->data['keyword'] = $searchKeyword;
    }
}
