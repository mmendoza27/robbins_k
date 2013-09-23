<?php
require_once(dirname(__FILE__). '/../WebContent/EvalUrlModel.php');
require_once(dirname(__FILE__). '/../WebContent/EvalUrl.php');
class test_EvalUrlModel extends UnitTestCase {
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
  	$this->assertEqual($this->model->getCount(), 0,
  			'getCount should return 0 rows when database is empty');
  	$newvals = array('url_eval' => 'http://www.cs.utsa943.edu',
  			'url_category' => 'first',
  			'url_description' => 'test');
  	$this->model->createUrl($newvals);
  	$this->assertEqual(0, $this->model->getError(), 
  			'createUrl should not produce an error when input is correct');
  	$this->assertEqual($this->model->getCount(), 1,
  			'createUrl should increase the number of database rows by 1');
  }
  
  function testOnEmptyDatabase() {
  	   $this->assertEqual($this->model->nextUrl(), 0, 
  	       'getNextUrl should return false when trying to get a URL from an empty database');
  	   $this->assertEqual($this->model->getCount(), 0, 
  	   	   'getCount should return 0 rows when database is empty');
  }
  
  function testGetNextUrlMultipleRows(){
  	$this->assertEqual($this->model->getCount(), 0, 
  			'It should return 0 rows when database is empty');

  	for ($k = 1; $k <= 10; $k++) {
  		$newvals = array('url_eval' => "http://www.cs.utsa$k.edu",
  				         'url_category' => 'first',
  				         'url_description' => 'test');
  		$this->model->createUrl($newvals);
  	}
  	$this->assertEqual($this->model->getCount(), 10, 
  	         'The database should have 10 rows after inserting 10 URLs');
  }
  
  function testGetUrl(){
  	$this->assertEqual($this->model->getCount(), 0,
  			'It should return 0 rows when database is empty');
    
  	for ($k = 1; $k <= 10; $k++) {
  		$newvals = array('url_eval' => "http://www.cs.utsa$k.edu",
  				'url_category' => 'first',
  				'url_description' => 'test');
  		$this->model->createUrl($newvals);
  	}
  	$this->assertEqual($this->model->getCount(), 10,
  			'The database should have 10 rows after inserting 10 URLs');
  	
  	for ($k = 1; $k <= 10; $k++) {
  		$myUrl = "http://www.cs.utsa$k.edu";
  		$myResult = $this->model->getUrl($myUrl);
  		$this->assertTrue(is_array($myResult));
  		$this->assertEqual(strcmp($myResult[1], $myUrl), 0);
  	}
  }
}
?>