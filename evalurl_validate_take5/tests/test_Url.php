<?php
require_once(dirname(__FILE__). '/../WebContent/EvalUrl.php');
class test_EvalUrl extends UnitTestCase {
	private $model;
	
	function setUp() {
	}
	
	function tearDown() {
		
	}
	
  function testMakeEvalUrl(){
  	$this->assertTrue(class_exists('EvalUrl'), 
  			'The EvalUrl class should be defined');
  }
  
  function testCreateSimpleExample(){
  	$array = array('url_id' => 1, 
  			       'url_eval' => 'http://www.cs.utsa.edu',
  	               'url_category' => 'best',
  			       'url_timestamp' => 'xxx',
  			       'url_description' => 'Test url');
  	$myUrl = new EvalUrl($array);
  	$this->assertTrue(is_a($myUrl, 'EvalUrl'),
  			'EvalUrl should have a constructor');
  }
}
?>