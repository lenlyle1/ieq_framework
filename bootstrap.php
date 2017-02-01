<?php

/*----------------------------------------------------------------------
 |
 |  Bootstrap for site.  Sets environment and loads key libraries
 |
 ---------------------------------------------------------------------*/

// Autoloader
require __DIR__ . '/vendor/autoload.php';

// Check environment and get config
if( preg_match('/\.dev|\.len|\.local/', $_SERVER['SERVER_NAME'])) {
    include (__DIR__ . '/App/Configs/config.dev.php');
} else {
    include (__DIR__ . '/App/Configs/config.live.php');
}

// error reporting

error_reporting(E_ALL & ~E_NOTICE);

if(!IS_LIVE){
    ini_set('display_errors', 1);
}

define('SITE_ROOT', __DIR__);

// Load router
$router = new AltoRouter();

// Configure DB


// Set up smarty
$smarty = new Smarty();
if(!IS_LIVE){
    $smarty->debugging = true;
}
$smarty->addPluginsDir(__DIR__ . '/App/Lib/Smarty/Plugins/');
$smarty->setTemplateDir(__DIR__ . '/Views');
$smarty->setCompileDir(__DIR__ . '/templates_c/');
$smarty->setCacheDir(__DIR__ . '/smarty_cache/');

// Load routes
require_once(__DIR__ . '/App/Router/routingLoader.php');
