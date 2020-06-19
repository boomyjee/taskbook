<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

spl_autoload_register(
    function ($className) {
        $path = str_replace("\\", "/", $className.".php");
        $path = __DIR__."/../src/".ltrim($path,'/');

        if (file_exists($path)) {
            require_once($path);
        } else {
            die('Class could not be loaded: '.$className);
        }
    }
);

require_once __DIR__."/../db.php";

$uri = !empty($_GET['q']) ? $_GET['q'] : '';
$uri_parts = explode("/",trim($uri,"/"));

$qs_length = strlen($_SERVER['QUERY_STRING']) - (isset($_GET['q']) ? strlen("&q="):0);
define('INDEX_URL',"//" . $_SERVER['HTTP_HOST'] . rtrim(substr($_SERVER['REQUEST_URI'],0,-($qs_length+1)),"/"));

$controller = new \Controllers\Tasks;
$action = $uri_parts[0] ?: 'index';
if (!method_exists($controller,$action)) $action = 'notFound';

call_user_func_array([$controller,$action],array_slice($uri_parts,1));