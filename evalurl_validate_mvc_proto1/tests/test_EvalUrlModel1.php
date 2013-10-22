<?php
require_once(dirname(__FILE__). '/../WebContent/EvalUrlModel.php');
class test_EvalUrlModel1 extends UnitTestCase {
	private $model;
	
	function setUp() {
		$con = mysqli_connect("localhost", "krobbins", "abc123", "evalurls_test");
		$sql = "DELETE FROM urlentry";
		mysqli_query($con, $sql);
		mysqli_close($con);
		$this->model = new EvalUrlModel("localhost", "krobbins", "abc123", "evalurls_test");	
	}
	
	function tearDown() {
		
	}
	
  function testMakeEvalUrlModel(){
  	$this->assertTrue(class_exists('EvalUrlModel'), 
  			'The EvalUrlModel class should be defined');
  	$this->assertTrue(is_a($this->model, 'EvalUrlModel'), 
  			'EvalUrlModel should have a constructor');
  }
  
  function testCreateSimpleInsertion(){
  	$newvals = array('url_eval' => 'http://www.cs.utsa943.edu',
  			'url_category' => 'first',
  			'url_description' => 'test');
  	$vals1 = $this->model->create($newvals);
  	$this->assertTrue(!array_key_exists('error', $vals1), 
  			'It should not produce an error when input is correct');	
  }
  
  function testShowOnEmptyDatabase() {
  	   $result = $this->model->showAll();
  	   $this->assertTrue(!array_key_exists('error', $result),
  	   		'It should not give an error when no URLs are in the database');
  	   $rowset = $result['result'];
  	   $numVals = $rowset->num_rows;
  	   $this->assertEqual($numVals, 0, 'It should return 0 rows when database is empty');
  }
  
  function testShowAll(){
  	$result = $this->model->showAll();
  	$this->assertTrue(!array_key_exists('error', $result),
  			'It should not produce an error when input is correct');
  	$rowset = $result['result'];
  	$numVals = $rowset->num_rows;
  	$this->assertTrue($numVals >= 0, 
  			   'The number of rowsets must not be negative');
  	$newvals = array('url_eval' => 'http://www.cs.utsa943.edu',
  			         'url_category' => 'first',
  			         'url_description' => 'test');
  	$vals1 = $this->model->create($newvals);
  	$this->assertTrue(!array_key_exists('error', $vals1), 'It should do a valid insertion');
  	$result1 = $this->model->showAll();
  	$this->assertTrue(!array_key_exists('error', $result1), 
  			'It should show the table after a valid insertion');
  	$rowset1 = $result1['result'];
  	$numVals1 = $rowset1->num_rows;
  	$this->assertEqual($numVals + 1, $numVals1, 
  			'The number of urls in the database should increase by one after valid insertion');
  	
  }
}
?>