<?php
require_once(dirname(__FILE__). '/../WebContent/controllers/FrontController.php');
class test_FrontController extends UnitTestCase {
	private $infile;
	private $outfile;
	
	function setUp() {
		$this->infile = dirname(__FILE__). '/../WebContent/images/Jellyfish.jpg';
		$this->outfile = dirname(__FILE__). '/../WebContent/images/TestJellyfish.jpg';
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
  
 
}
?>