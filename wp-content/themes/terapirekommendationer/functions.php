<?php

define('TERAPIREKOMMENDATIONER_PATH', get_stylesheet_directory() . '/');

//Include vendor files
if (file_exists(dirname(ABSPATH) . '/vendor/autoload.php')) {
    require_once dirname(ABSPATH) . '/vendor/autoload.php';
}

require_once TERAPIREKOMMENDATIONER_PATH . 'library/Vendor/Psr4ClassLoader.php';
$loader = new TERAPIREKOMMENDATIONER\Vendor\Psr4ClassLoader();
$loader->addPrefix('Terapirekommendationer', TERAPIREKOMMENDATIONER_PATH . 'library');
$loader->addPrefix('Terapirekommendationer', TERAPIREKOMMENDATIONER_PATH . 'source/php/');
$loader->register();

new Terapirekommendationer\App();
