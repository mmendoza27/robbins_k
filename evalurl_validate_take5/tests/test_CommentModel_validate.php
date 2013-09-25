<?php
require_once(dirname(__FILE__). '/../WebContent/CommentModel.php');
class test_EvalCommentModel_validate extends UnitTestCase {
	private $model;

	function setUp() {
		$con = mysqli_connect("localhost", "krobbins", "abc123", "evalurls_test");
		$sql = "DELETE FROM comments";
		mysqli_query($con, $sql);
		mysqli_close($con);
		$this->model = new CommentModel("localhost", "krobbins", "abc123", "evalurls_test");
	}

	function tearDown() {

	}
	
	function testReturnsErrorWhenProtocolIsMissing(){
		$inarray = array ('comment_url' => 'www.cs.utsa.edu',
				          'comment_body' => 'Test description');
		$outarray = $this->model->validate($inarray);
		$this->assertEqual($outarray, 0, 
		         'CommentModel should return 0 when the protocol is missing');
		$this->assertTrue($this->model->getError(),
				 'CommentModel error should be set to indicate error');
	}
	
	function testReturnsErrorParameterNotArray(){
		$inarray = 'comment_url';
		$outarray = $this->model->validate($inarray);
		$this->assertEqual($outarray, 0,
				'CommentModel should return 0 when the the parameter is not an array');
		$this->assertTrue($this->model->getError(),
				'CommentModel error should be set to indicate error');
	
	}
	
	function testReturnsErrorWhenFieldsAreMissing(){
		$inarray = array ('comment_url' => 'www.cs.utsa.edu');
		$outarray = $this->model->validate($inarray);
		$this->assertEqual($outarray, 0,
				'It should return 0 when the there is no comment body argument');
		$this->assertTrue($this->model->getError(),
				'The EvalCommentModel error should be set to indicate error');
		$inarray = array ('comment_body' => 'Test description');
		$this->assertEqual($outarray, 0,
				'It should return 0 when the there is no comment url argument');
		$this->assertTrue($this->model->getError(),
				'The EvalCommentModel error should be set to indicate error');
	}
}
?>