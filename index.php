<?php
require_once("./src/Controller/Route.php");
require_once("./src/Entities/Browser.php");

//  Get and clean current URI
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

$site = include_once('./info.php');
$links = include_once('./links.php');
$page = Router::trimURI($uri, true);
$isIE = Browser::isIE();

/*
 |----------------------------------------------------------------------------|
 | Router finds valid pages from views directory
 |----------------------------------------------------------------------------|
 - Add additional pages in views directory* 
 - Any additional directories will be validated for pages
 - EX:
 - es/
    - index.php
    - 404.php
 */
$router = new Router($uri, Router::getPages($site['VIEWS']));
$router->views = $site['VIEWS'];
require __DIR__ . $router->redirect();
