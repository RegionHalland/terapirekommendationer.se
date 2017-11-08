<?php

/**
 * Composer autoloader from municipio
 */
if (file_exists(REGIONHALLAND_PATH . 'vendor/autoload.php')) {
    require_once REGIONHALLAND_PATH . 'vendor/autoload.php';
}

/**
 * Composer autoloader from abspath
 */
if (file_exists(dirname(ABSPATH) . '/vendor/autoload.php')) {
    require_once dirname(ABSPATH) . '/vendor/autoload.php';
}

/**
 * Psr4ClassLoader
 */
require_once REGIONHALLAND_PATH . 'library/Vendor/Psr4ClassLoader.php';

/**
 * Initialize autoloader (psr4)
 */
$loader = new RegionHalland\Vendor\Psr4ClassLoader();
$loader->addPrefix('RegionHalland', REGIONHALLAND_PATH . 'library');
$loader->addPrefix('RegionHalland', REGIONHALLAND_PATH . 'source/php/');
$loader->register();

/**
 * Initialize app
 */

new RegionHalland\App();