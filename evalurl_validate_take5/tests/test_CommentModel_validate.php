<?php
require_once(dirname(__FILE__). '/../WebContent/CommentModel.php');
require_once(dirname(__FILE__). '/../WebContent/ControllerFactory.php');
class test_CommentModel_validate extends UnitTestCase {
	private $model;

	function setUp() {
		$con = mysqli_connect("localhost", "krobbins", "abc123", "evalurls_test");
		$sql = "DELETE FROM comments";
		mysqli_query($con, $sql);
		$db = ControllerFactory::buildDb("localhost", "krobbins", "abc123", "evalurls_test");
		$this->model = new UrlModel($db);
	}

	function tearDown() {

	}
	
	function testReturnsErrorWhenProtocolIsMissing(){
		$this->expectException();
		$inarray = array ('comment_url' => 'www.cs.utsa.edu',
				          'comment_body' => 'Test description');
		$outarray = $this->model->validate($inarray);
	}
	
	function testReturnsErrorParameterNotArray(){
		$this->expectException(new PatternExpectation("/Input argument not an array/i"));
		$inarray = 'comment_url';
		$outarray = $this->model->validate($inarray);
	}
	
	function testReturnsErrorWhenFieldsAreMissing(){
		$this->expectException(new PatternExpectation("/Missing form field/i"));
		$inarray = array ('comment_url' => 'www.cs.utsa.edu');
		$outarray = $this->model->validate($inarray);
	}
}
?>