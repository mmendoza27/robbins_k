<?php
require_once(dirname(__FILE__). '/../WebContent/UrlModel.php');
require_once(dirname(__FILE__). '/../WebContent/ControllerFactory.php');
class test_UserModel_validate extends UnitTestCase {
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
	
	function testReturnsErrorWhenProtocolIsMissing(){
		$this->expectException(new PatternExpectation("/Invalid URL/i"));
		$inarray = array ('url_name' => 'www.cs.utsa.edu',
				          'url_category' => 'First',
				          'url_description' => 'My description');
		$outarray = $this->model->validate($inarray);
	}
	
	function testReturnsErrorParameterNotArray(){
		$this->expectException(new PatternExpectation("/Input argument not an array/i"));
		$inarray = 'temp';
		$outarray = $this->model->validate($inarray);	
	}
	
	function testReturnsErrorWhenFieldsAreMissing(){
		$this->expectException(new PatternExpectation("/Missing form field/i"));
		$inarray = array ('first_name' => 'george');
		$outarray = $this->model->validate($inarray);
	}	

}
?>