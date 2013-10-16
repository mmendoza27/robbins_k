<?php
require_once(dirname(__FILE__). '/../WebContent/controllers/FrontController.php');
require_once(dirname(__FILE__). '/../WebContent/controllers/TestController.php');
class test_FrontController extends UnitTestCase {

	
	function setUp() {

	}
	
	function tearDown() {
		//unlink($this->outfile);
		
	}
	
  function testMakeFrontController(){
//   	$myTest = array("controller"=>"TestController", "action"=>"show", "params" => array("This is a test"));
//   	$testFront = new FrontController($myTest);
//   	$this->assertTrue(is_a($testFront, 'FrontController'));
//   	$testFront->run();
  }
  
  function testInitializeUri(){
  	$_SERVER["REQUEST_URI"] = "/evalurl_master/url/show/0";
  	$testFront = new FrontController();
  	$this->assertTrue(is_a($testFront, 'FrontController'), 'initializeUrl should return a Front Controller');
  	$req = $testFront->getRequest();
  	$this->assertTrue(is_a($req, 'Request'), 'FrontController:getRequest should return a request object');
  	$ctrl = $req->getController();
  	$this->assertTrue($ctrl == 'UrlController', "The controller should be UrlController, but is $ctrl<br ");
  } 
}
?>