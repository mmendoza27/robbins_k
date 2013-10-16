<?php
require_once(dirname(__FILE__). '/../WebContent/controllers/Request.php');
class test_Request extends UnitTestCase {

	
	function setUp() {

	}
	
	function tearDown() {
		//unlink($this->outfile);
		
	}
	
  function testMakeRequest(){
  	$myTest = new Request();
  	$this->assertTrue(is_a($myTest, 'Request'), 'You should be able to create a Request Object');
  	$myTest->setParam('db', 'myDB');
  	$this->assertEqual($myTest->getParam('db'), 'myDB', 'You should be able to add a parameter');
  	$this->assertEqual(strlen($myTest->getController()), 0, 'Empty controller');
  	$myTest->setController('IndexController');
  	$this->assertTrue($myTest->getController()== 'IndexController', 'You should be able to set a controller');
  }
  
  function testGetController(){
  	$myTest = new Request();
  	$this->assertTrue(is_a($myTest, 'Request'), 'You should be able to create a Request Object');
  	$myTest->setController('IndexController');
  	$this->assertTrue($myTest->getController() == 'IndexController');
  }
  
}
?>