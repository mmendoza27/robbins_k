<?php
require_once('EvalUrl.php');
class EvalUrlModel {
	private $hostname;
	private $username;
	private $userpass;
	private $dbname;
	private $con;
	private $error;
	private $results;
	private $sqlGet = "SELECT * FROM urlentry";
	
	public function __construct($hostname, $username, $userpass, $dbname) {
		$this->hostname = $hostname;
		$this->username = $username;
		$this->userpass = $userpass;
		$this->dbname = $dbname;
		$this->con = mysqli_connect($this->hostname, $this->username, $this->userpass, $this->dbname);
		if (mysqli_connect_errno()) {
			$this->error = "Couldn't connect to database evalurls: " . mysqli_connect_errno();
		}
		$this->error = 0;
	}
	
	public function createUrl($vals) {
		if (isset($this->results)) {
			$this->results->free();
		    unset($this->results);
		}
		$vals = $this->validate($vals);
		if (!$vals) {
			return;
		}
		extract($vals);
		$sql =  "INSERT INTO urlentry (url_eval, url_description, url_category)
		VALUES ('$url_eval', '$url_description', '$url_category')";	
		if (!mysqli_query($this->con, $sql)) {
			$this->error = "Couldn't perform the insertion " . mysqli_error($this->con);
		}
	}
	

	public function getCount() {
		if (!isset($this->results)){
			$this->results = mysqli_query ($this->con, $this->sqlGet);
			if (mysqli_connect_errno()) {
				$this->error = "Couldn't get a rowset: " . mysqli_connect_errno();
				return 0;
			}
		}
		return $this->results->num_rows; 	
	}
	
	public function getError() {
		return $this->error;
	}
	
	public function getUrl($urlname) {
		$url = mysqli_real_escape_string($urlname);
	    $sql = "SELECT * FROM urlentry WHERE url_eval='$url'";
		$myResults = mysqli_query ($this->con, $sql);
	    if (mysqli_connect_errno()) {
				$this->error = "Couldn't get a $urlname: " . mysqli_connect_errno();
			return 0;
		}
		print_r($myResult);
		return mysqli_fetch_array($myResults);
	}
	
	public function nextUrl() {
		if (!isset($this->results)){
			$this->results = mysqli_query ($this->con, $this->sqlGet);
			if (mysqli_connect_errno()) {
				$this->error = "Couldn't get a rowset: " . mysqli_connect_errno();
				return 0;
			}
		}
		if (!$this->results) {
			$retval = 0;
		} else {
			$retval = mysqli_fetch_array($this->results);
		}
		return $retval;
	}
	
	
	public function validate($vals) {
		$url_eval = trim(filter_var($vals['url_eval'], FILTER_SANITIZE_URL));
		if (!filter_var($url_eval, FILTER_VALIDATE_URL)) {
			$this->error = "Invalid URL ";
			return 0;
		}
		$newvals = array ('url_eval' => $url_eval,
				          'url_category' => $vals['url_category'],
				          'url_description' => $vals['url_description']);
		return $newvals;
	}
}

?>