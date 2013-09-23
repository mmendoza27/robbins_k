<?php
require_once(dirname(__FILE__). '/../WebContent/EvalUrlModel.php');
class test_EvalUrlModel_validate extends UnitTestCase {
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
	
	function testReturnsErrorWhenProtocolIsMissing(){
		$inarray = array ('url_eval' => 'www.cs.utsa.edu',
				          'url_category' => 'First',
				          'url_description' => 'My description');
		$outarray = $this->model->validate($inarray);
		$this->assertEqual($outarray, 0, 
		         'It should return 0 when the protocol is missing');
		$this->assertTrue($this->model->getError(),
				 'The EvalUrlModel error should be set to indicate error');
	}
}
?>