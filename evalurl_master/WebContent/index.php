<?php  
require_once (dirname(__FILE__). DIRECTORY_SEPARATOR . "autoload.php");
$front = new FrontController();
$front->run();
$front->getResponse()->send();
?>
