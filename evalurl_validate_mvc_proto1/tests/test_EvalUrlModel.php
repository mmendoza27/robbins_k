<?php
require_once(dirname(__FILE__). '/../WebContent/EvalUrlModel.php');
class test_EvalUrlModel extends UnitTestCase {
	
	function setUp() {
		
	}
	
	function tearDown() {
		
	}
	
  function testMakeEvalUrlModel(){
  	$model = new EvalUrlModel("localhost", "krobbins", "abc123", "evalurls");
  	$this->assertTrue(class_exists('EvalUrlModel'), 
  			'The EvalUrlModel class should be defined');
  	$this->assertTrue(is_a($model, 'EvalUrlModel'), 
  			'EvalUrlModel should have a constructor');
  }
  
  function testCreateSimpleInsertion(){
  	$model = new EvalUrlModel("localhost", "krobbins", "abc123", "evalurls");
  	$newvals = array('url_eval' => 'http://www.cs.utsa943.edu',
  			'url_category' => 'first',
  			'url_description' => 'test');
  	$vals1 = $model->create($newvals);
  	$this->assertTrue(!array_key_exists('error', $vals1), 
  			'It should not produce an error when input is correct');
  	
  }
  
  function testShowAll(){
  	$model = new EvalUrlModel("localhost", "krobbins", "abc123", "evalurls"); 	
  	$result = $model->showAll();
  	$this->assertTrue(!array_key_exists('error', $result),
  			'It should not produce an error when input is correct');
  	$rowset = $result['result'];
  	$numVals = $rowset->num_rows;
  	$this->assertTrue($numVals >= 0, 
  			   'The number of rowsets must not be negative');
  	$newvals = array('url_eval' => 'http://www.cs.utsa943.edu',
  			         'url_category' => 'first',
  			         'url_description' => 'test');
  	$vals1 = $model->create($newvals);
  	$this->assertTrue(!array_key_exists('error', $vals1), 'It should do a valid insertion');
  	$result1 = $model->showAll();
  	$this->assertTrue(!array_key_exists('error', $result1), 
  			'It should show the table after a valid insertion');
  	$rowset1 = $result1['result'];
  	$numVals1 = $rowset1->num_rows;
  	$this->assertEqual($numVals + 1, $numVals1, 
  			'The number of urls in the database should increase by one after valid insertion');
  	
  }
}
?>