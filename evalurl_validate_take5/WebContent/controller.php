<?php 
require_once('NewUrlController.php');
require_once('ControllerFactory.php');
require_once('dumpSupers.php');

dumpSupers("Entering createUrl");

$db = ControllerFactory::buildDb("localhost", "krobbins", "abc123", "evalurls");

if (array_key_exists('url_controller', $_POST)) {
	$ctrl = new NewUrlController($db);
	$ctrl->action();
}
?>