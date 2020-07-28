<?php
require_once("./src/Config/index.php");
require_once("./src/Controllers/Route.php");

$site = include_once('./info.php');
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
$router = new Router($site['VIEWS']);
$page = $router->trimURI(true);
$links = include_once('./links.php');
require __DIR__ . $router->route();
