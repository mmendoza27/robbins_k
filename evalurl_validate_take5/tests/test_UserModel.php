<?php
require_once(dirname(__FILE__). '/../WebContent/UserModel.php');
class test_UserModel extends UnitTestCase {
	private $model;
	
	function setUp() {
		$con = mysqli_connect("localhost", "krobbins", "abc123", "evalurls_test");
		$sql = "DELETE FROM urls";
		mysqli_query($con, $sql);
		mysqli_close($con);
		$db = ControllerFactory::buildDb("localhost", "krobbins", "abc123", "evalurls_test");
		$this->model = new UserModel($db);	
	}
	
	function tearDown() {
		
	}
	
  function testMakeUserModel(){
  	$this->assertTrue(class_exists('UserModel'), 
  			'The UserModel class should be defined');
  	$this->assertTrue(is_a($this->model, 'UserModel'), 
  			'UserModel should have a constructor');
  }
  
  function testCreateSimpleInsertion(){
  	$this->assertEqual($this->model->getCount(), 0,
  			'getCount should return 0 rows when database is empty');
  	$newvals = array('user_firstname' => 'John',
  			         'user_lastname' => 'Doe',
  			         'user_email' => 'John.Doe@gmail.com');
  	$this->model->create($newvals);
  	$this->assertEqual(0, $this->model->getError(), 
  			'createUser should not produce an error when input is correct');
  	$this->assertEqual($this->model->getCount(), 1,
  			'createUser should increase the number of database rows by 1');
  }
  
  function testOnEmptyDatabase() {
  	   $this->assertEqual($this->model->nextUser(), 0, 
  	       'getNextUrl should return false when trying to get a user from an empty database');
  	   $this->assertEqual($this->model->getCount(), 0, 
  	   	   'getCount should return 0 rows when database is empty');
  }
  
  function testGetNextUserMultipleRows(){
  	$this->assertEqual($this->model->getCount(), 0, 
  			'It should return 0 rows when database is empty');

  	for ($k = 1; $k <= 10; $k++) {
  		$newvals = array('user_firstname' => "John$k",
  				'user_lastname' => "Doe",
  				'user_email' => "John$k.Doe@gmail.com");
  		$this->model->create($newvals);
  	}
  	$this->assertEqual($this->model->getCount(), 10, 
  	         'The database should have 10 rows after inserting 10 users');
  }
  
  function testGetUser(){
  	$this->assertEqual($this->model->getCount(), 0,
  			'It should return 0 rows when database is empty');
    
    for ($k = 1; $k <= 10; $k++) {
  		$newvals = array('user_firstname' => "John$k",
  				'user_lastname' => "Doe",
  				'user_email' => "John$k.Doe@gmail.com");
  		$this->model->create($newvals);
  	}
  	$this->assertEqual($this->model->getCount(), 10,
  			'The database should have 10 rows after inserting 10 users');
  	
  	for ($k = 1; $k <= 10; $k++) {
  		$myEmail = "John$k.Doe@gmail.com";
  		$myResult = $this->model->get($myEmail);
  		$this->assertTrue(is_array($myResult));
  		$this->assertEqual(strcmp($myResult['user_email'], $myEmail), 0);
  	}
  }
  
  function testTryConnectionWithBadCredentials () {
  	//$this->expectException();
  	//$this->expectError(new PatternExpectation("/Bad connection/i"));
  	$db = ControllerFactory::buildDb("localhost", "jrobbins", "abc123", "evalurls_test");
  	$this->assertEqual($db, null);
  	$this->model = new UserModel($db);
  	//$this->assertTrue(is_a($mod, 'EvalUrlModel'));
  	//$this->assertTrue($mod->getError());
  }
}
?>