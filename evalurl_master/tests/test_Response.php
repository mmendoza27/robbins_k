<?php
require_once(dirname(__FILE__). '/../WebContent/controllers/Response.php');
class test_Response extends UnitTestCase {

	
	function setUp() {

	}
	
	function tearDown() {
		//unlink($this->outfile);
		
	}
	
  function testMakeResponse(){
  	$myTest = new Response();
  	$this->assertTrue(is_a($myTest, 'Response'), 'You should be able to create a Response Object');
  	$myTest->addResponse('my');
  	$myTest->addHeader('head');
  	$ret = $myTest->send();
  	$this->assertTrue($ret,'You should be able to add headers after responses');
  	$ret = $myTest->send();
  	$this->assertTrue(is_a($ret, 'Response'), 'You should not be able to send twice');
  }
  
}
?>