<?php
require_once(dirname(__FILE__). '/../WebContent/UrlModel.php');
require_once(dirname(__FILE__). '/../WebContent/ControllerFactory.php');
class test_UrlModel extends UnitTestCase {
	private $model;
	
	function setUp() {
		$con = mysqli_connect("localhost", "krobbins", "abc123", "evalurls_test");
		$sql = "DELETE FROM urls";
		mysqli_query($con, $sql);
		mysqli_close($con);
		$db = ControllerFactory::buildDb("localhost", "krobbins", "abc123", "evalurls_test");
		$this->model = new UrlModel($db);	
	}
	
	function tearDown() {
		
	}
	
  function testMakeUrlModel(){
  	$this->assertTrue(class_exists('UrlModel'), 
  			'The UrlModel class should be defined');
  	$this->assertTrue(is_a($this->model, 'UrlModel'), 
  			'UrlModel should have a constructor');
  }
  
  function testCreateSimpleInsertion(){
  	$this->assertEqual($this->model->getCount(), 0,
  			'getCount should return 0 rows when database is empty');
  	$newvals = array('url_name' => 'http://www.cs.utsa943.edu',
  			'url_category' => 'first',
  			'url_description' => 'test');
  	$this->model->create($newvals);
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
  		$newvals = array('url_name' => "http://www.cs.utsa$k.edu",
  				         'url_category' => 'first',
  				         'url_description' => 'test');
  		$this->model->create($newvals);
  	}
  	$this->assertEqual($this->model->getCount(), 10, 
  	         'The database should have 10 rows after inserting 10 URLs');
  }
  
  function testGetUrl(){
  	$this->assertEqual($this->model->getCount(), 0,
  			'It should return 0 rows when database is empty');
    
  	for ($k = 1; $k <= 10; $k++) {
  		$newvals = array('url_name' => "http://www.cs.utsa$k.edu",
  				'url_category' => 'first',
  				'url_description' => 'test');
  		$this->model->create($newvals);
  	}
  	$this->assertEqual($this->model->getCount(), 10,
  			'The database should have 10 rows after inserting 10 URLs');
  	
  	for ($k = 1; $k <= 10; $k++) {
  		$myUrl = "http://www.cs.utsa$k.edu";
  		$myResult = $this->model->get($myUrl);
  		$this->assertTrue(is_array($myResult));
  		$this->assertEqual(strcmp($myResult['url_name'], $myUrl), 0);
  	}
  }
  
  function testTryConnectionWithBadCredentials () {
  	//$this->expectException();
  	//$this->expectError(new PatternExpectation("/Bad connection/i"));
  	$db = ControllerFactory::buildDb("localhost", "jrobbins", "abc123", "evalurls_test");
  	$this->assertEqual($db, null);
  	$this->model = new UrlModel($db);
  	//$this->assertTrue(is_a($mod, 'EvalUrlModel'));
  	//$this->assertTrue($mod->getError());
  }
}
?>