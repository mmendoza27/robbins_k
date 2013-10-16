<?php
require_once(dirname(__FILE__). '/../WebContent/controllers/FrontController.php');
class test_FrontController extends UnitTestCase {

	
	function setUp() {

	}
	
	function tearDown() {
		//unlink($this->outfile);
		
	}
	
  function testMakeFrontController(){
  	$myTest = array("controller"=>"test", "action"=>"show", "params" => array("This is a test"));
  	$testFront = new FrontController($myTest);
  	$this->assertTrue(is_a($testFront, 'FrontController'));
  	$testFront->run();
  }
  
  function testInitializeUri(){
  	$myTest = array("controller"=>"test", "action"=>"show", "params" => array("This is a test"));
  	$testFront = new FrontController($myTest);
  	$uri = "/evalurl_master/url/show/0";
  	$testFront->initializeUri($uri);
  	$newVals = $testFront->getValues();
  	$this->assertTrue($newValues('controller') == 'UriController');
  }
  
 
}
?>