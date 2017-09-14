<?php
$name = substr(preg_replace('/[^a-z\d]/i', '', __DIR__), -30);
session_name($name);
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// $baseFolder = $_SERVER["HTTP_HOST"];
// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";
// die();
