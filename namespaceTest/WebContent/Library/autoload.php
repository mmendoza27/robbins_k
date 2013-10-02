<?php 

function __autoload($className) {
    $filename = $className . ".php";
    if (is_readable($filename)) {
    	require $filename;
    	return;
    } 
    $filename = "AppLib". DIRECTORY_SEPARATOR . $className . ".php";
    if (is_readable($filename)) {
    	require $filename;
    } 
}


?>