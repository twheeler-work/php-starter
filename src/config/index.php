<?php

///////////////////////////////
// Project Variables
///////////////////////////////

/**
 * DB Table
 * @var \Array
 * Enter table names as array for easy changes
 * 
 * 0 - table1
 * 
 * 1 - table2
 */
$table = [];
define('DBDATA', include('db.php'));
$siteURL =  $_SERVER['HTTP_HOST'];

///////////////////////////////
// Set Current Time
///////////////////////////////

// Set the default timezone
date_default_timezone_set('America/Chicago');
$today = date('Y-m-d H:i:s');

///////////////////////////////
// Set Stage Env
///////////////////////////////

define('ENV', true);

///////////////////////////////
// Error Handling
///////////////////////////////

if (!$stage) {
    error_reporting(E_ALL ^ E_WARNING);
} else {
    error_reporting(E_ALL);
    ini_set("display_errors", "On");
}

///////////////////////////////
// Get ip address
///////////////////////////////

$ipAddress = htmlspecialchars($_SERVER["REMOTE_ADDR"]);

///////////////////////////////
// Check for Stage Env
///////////////////////////////

if ($ipAddress === '127.0.0.1') {
    $local = true;
    $loginRequired = false;
} else {
    $local = false;
    $loginRequired = true;
}

///////////////////////////////
// Set login state
///////////////////////////////

if (!$local) {
    if ($ipAddress !== '127.0.0.1') {
        $loginRequired = true;
    }
}

///////////////////////////////
// Vendor Library
///////////////////////////////

require_once(__DIR__ . '/../../../vendor/autoload.php');

///////////////////////////////
// Class Libraries 
// - No need to link classes
///////////////////////////////

spl_autoload_register('autoloader');

function autoloader($class)
{
    include_once __DIR__ . "/../Models/" . $class . '.php';
}

///////////////////////////////
// Connect DB
///////////////////////////////

$connection = new DB();
$db = $connection->start();
