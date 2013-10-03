<?php     
require_once __DIR__ . DIRECTORY_SEPARATOR . "autoload.php";
echo "On index page";

$myTest = array("controller"=>"test", "action"=>"show", "params" => array("This is a test"));

$testFront = new FrontController($myTest);
$testFront->run();
// $frontController = new FrontController();
// $frontController->run();
?>