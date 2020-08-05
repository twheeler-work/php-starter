<?php

///////////////////////////////
// Vendor Library
///////////////////////////////

require_once(__DIR__ . '/../../vendor/autoload.php');

///////////////////////////////
// Project Variables
///////////////////////////////

$siteURL =  $_SERVER['HTTP_HOST'];

///////////////////////////////
// Set Globals
///////////////////////////////

// DB connection info
define('DBDATA', include('db.php'));

// Set Session Timeout
define('TIMEOUT', 1800); // 30 mins 1800

// Set Stage Env
define('STAGE', true);

// Set local env
if ($_SERVER["REMOTE_ADDR"] === '127.0.0.1') {
    define('LOCAL', true);
} else {
    define('LOCAL', false);
}

// Set the default timezone
date_default_timezone_set('America/Chicago');

///////////////////////////////
// Error Handling
///////////////////////////////

if (!STAGE) {
    error_reporting(E_ALL ^ E_WARNING);
} else {
    error_reporting(E_ALL);
    ini_set("display_errors", "On");
}

///////////////////////////////
// Class Libraries 
// - No need to link classes
///////////////////////////////

spl_autoload_register('autoloader');

function autoloader($classname)
{
    include_once __DIR__ . "/../Models/" . $classname . '.php';
}

///////////////////////////////
// Connect DB
///////////////////////////////

$conn = new DB();
$db = $conn->start();

///////////////////////////////
// Initialize session
///////////////////////////////

$session = new Session;
$session->requireLogin = false; // Comment out if login required
$session->start();
