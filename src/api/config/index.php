<?php

///////////////////////////////
// Project Variables
///////////////////////////////

$table = []; // Enter db table name in array
$dbData = include('db.php');
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

$stage = true;

///////////////////////////////
// Error Handling
///////////////////////////////

if (!$stage) {
    error_reporting(E_ALL ^ E_WARNING);
} else {
    error_reporting(E_ALL);
    ini_set("display_errors", "On");
    // $stagingURL = "/scholarships";
    // $stagingURL = "";
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
// Connect DB
///////////////////////////////

if ($local === true) {

    $dbSQL = array( //Staging DB 
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'db' => $dbData['DB']['db'],
        'port' => 3306
    );

    // Call Staging  DB
    $db = new Mysqlidb($dbSQL);

    if (!$db) {
        die("Please try again later.");
    };
} else {

    $dbSQL = array( //Production DB
        'host' => $dbData['DB']['host'],
        'username' => $dbData['DB']['username'],
        'password' => $dbData['DB']['password'],
        'db' => $dbData['DB']['db'],
        'port' => 3306
    );

    // Call Production  DB
    $db = new Mysqlidb($dbSQL);

    if (!$db) {
        die("Please try again later.");
    };
}
