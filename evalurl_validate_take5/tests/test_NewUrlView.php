<?php
require_once(dirname(__FILE__). '/../WebContent/UrlModel.php');
require_once(dirname(__FILE__). '/../WebContent/NewUrlView.php');
require_once(dirname(__FILE__). '/../WebContent/ControllerFactory.php');
class test_NewUrlView extends UnitTestCase {
	private $model;
	private $view;
	
	function setUp() {
		$con = mysqli_connect("localhost", "krobbins", "abc123", "evalurls_test");
		$sql = "DELETE FROM urls";
		mysqli_query($con, $sql);
		mysqli_close($con);
		$db = ControllerFactory::buildDb("localhost", "krobbins", "abc123", "evalurls_test");
		$this->model = new UrlModel($db);	
		$this->view = new NewUrlView($this->model);
	}
	
	function tearDown() {
		
	}
	
  function testMakeNewUrlView(){
  	$this->assertTrue(class_exists('NewUrlView'), 
  			'The NewUrlView class should be defined');
  	$this->assertTrue(is_a($this->view, 'NewUrlView'), 
  			'NewUrlView should have a constructor');
  }
  
}
?>