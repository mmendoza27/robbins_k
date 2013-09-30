<?php
require_once(dirname(__FILE__). '/../WebContent/ControllerFactory.php');
class test_ControllerFactory extends UnitTestCase {
	private $user;
	private $host;
	private $dbname;
	private $password;

	function setUp() {
	    $this->host = "localhost";
	    $this->user = "krobbins";
	    $this->password = "abc123";
	    $this->dbname = "evalurls_test";
	}

	function tearDown() {

	}

	function testValid(){
		$db = ControllerFactory::buildDb($this->host, $this->user, $this->password, $this->dbname);
		$this->assertTrue($db != null, 
               "A valid connection should not be null");
	
	}
}

?>