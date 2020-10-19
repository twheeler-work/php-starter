<?php

///////////////////////////////
//* Vendor Library
///////////////////////////////

require_once __DIR__ . '/../../vendor/autoload.php';

///////////////////////////////
//* Project Variables
///////////////////////////////

//* Site Info --------------------------- //

// Set site title
define('TITLE', 'PHP Starter');

// Set production url
define('PROD_URL', 'www.phpstarter.com');

// Set current version
define('VERSION', '1.0');

//* Structure --------------------------- //

// Default home directory
define('HOME_DIR', 'home');

// Set views directory
define('VIEWS', 'templates/');

// Default component directory
define('COMPONENT_DIR', '_components');

// Set ajax allowed directory
define('SCRIPTS', 'app/');

//* System ------------------------------ //

// Set DB connection info
define('DBDATA', include 'db.php');

// Set Session timeout
define('TIMEOUT', 1800); // 30 mins 1800

// Set Stage Env
define('STAGE', true);

// Set the default timezone
date_default_timezone_set('America/Chicago');

// Set local Env
if ($_SERVER["REMOTE_ADDR"] === '127.0.0.1') {
  define('LOCAL', true);
} else {
  define('LOCAL', false);
}

///////////////////////////////
//* Auto load all classes
///////////////////////////////

spl_autoload_register('autoloader');

function autoloader($classname)
{
  include_once __DIR__ . "/../Models/" . $classname . '.php';
}

///////////////////////////////
//* Error Handling
///////////////////////////////

if (!STAGE) {
  error_reporting(E_ALL ^ E_WARNING);
} else {
  error_reporting(E_ALL);
  ini_set("display_errors", "On");
}

///////////////////////////////
//* Initialize Classes
///////////////////////////////

$session = new Session();
$router = new Router();
$link = new Link();

// Connect DB
$db = (new DB())->start();
