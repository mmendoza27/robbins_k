<?php 

function __autoload($className) {
    $filename = __DIR__ . DIRECTORY_SEPARATOR . $className . ".php";
    if (is_readable($filename)) {
    	require $filename;
    	return;
    } 
    $filename = __DIR__ . DIRECTORY_SEPARATOR . "controllers". DIRECTORY_SEPARATOR . $className . ".php";
    if (is_readable($filename)) {
    	require $filename;
    } 
    $filename = __DIR__ . DIRECTORY_SEPARATOR . "models". DIRECTORY_SEPARATOR . $className . ".php";
    if (is_readable($filename)) {
    	require $filename;
    }
    $filename = __DIR__ . DIRECTORY_SEPARATOR . "views". DIRECTORY_SEPARATOR . $className . ".php";
    if (is_readable($filename)) {
    	require $filename;
    }
}


?>