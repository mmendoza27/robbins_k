<?php  
require_once (dirname(__FILE__). DIRECTORY_SEPARATOR . "autoload.php");
echo "On index page";

$frontController = new FrontController();
$frontController->run();
echo "Front controller has run: request path is:";
echo  $_SERVER['REQUEST_URI'] + "<br>";
?>
