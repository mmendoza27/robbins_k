<?php
require_once ('EvalUrl.php');
class DBConn {
	private $hostname;
	private $username;
	private $userpass;
	private $dbname;
	private $con;
	private $error;
	private $results;
	
	public function __construct($hostname, $username, $userpass, $dbname) {
		$this->hostname = $hostname;
		$this->username = $username;
		$this->userpass = $userpass;
		$this->dbname = $dbname;
		$this->con = mysqli_connect ( $this->hostname, $this->username, $this->userpass, $this->dbname );
		if (mysqli_connect_errno ()) {
			$this->error = "Couldn't connect to database evalurls: " . mysqli_connect_errno ();
		}
		$this->error = 0;
	}
	
	public function clear() {
		if (isset ( $this->results )) {
			$this->results->free ();
			unset ( $this->results );
		}
	}
	
	public function create($sql) {
		$this->clear;
		if (! mysqli_query ( $this->con, $sql )) {
			$this->error = "Couldn't perform the insertion " . mysqli_error ( $this->con );
		}
	}
	
	public function getCount($table) {
		$sql = "SELECT * FROM $table";
		$temp_rows = mysqli_query ( $this->con, $sql );
		if (mysqli_connect_errno ()) {
			$this->error = "Couldn't get a rowset: " . mysqli_connect_errno ();
			return 0;
		}
		return $temp_rows->results->num_rows;
	}
	
	public function getError() {
		return $this->error;
	}
	
	public function get($table, $field, $val) {
		$newVal = mysqli_real_escape_string ( $this->con, $val );
		$sql = "SELECT * FROM $table WHERE $field='$newVal'";
		$myResults = mysqli_query ( $this->con, $sql );
		if (mysqli_connect_errno ()) {
			$this->error = "Couldn't get a $newVal: " . mysqli_connect_errno ();
			return 0;
		}
		return mysqli_fetch_array ( $myResults );
	}
	
	public function first($table) {
		$this->clear ();
		$sql = "SELECT * FROM $table";
		$this->results = mysqli_query ( $this->con, $sql );
		if (mysqli_connect_errno ()) {
			$this->error = "Couldn't get a rowset: " . mysqli_connect_errno ();
			return 0;
		}
		return mysqli_fetch_array ( $this->results );
	}
	
	public function next() {
		return mysqli_fetch_array ( $this->results );
	}
}

?>