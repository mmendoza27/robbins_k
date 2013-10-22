<?php
class EvalUrlModel {
	private $hostname;
	private $username;
	private $userpass;
	private $dbname;


	
	public function __construct($hostname, $username, $userpass, $dbname) {
		$this->hostname = $hostname;
		$this->username = $username;
		$this->userpass = $userpass;
		$this->dbname = $dbname;
	
	}
	
	public function create($vals) {
		$results = array();
		$con = mysqli_connect($this->hostname, $this->username, $this->userpass, $this->dbname);
		if (mysqli_connect_errno()) {
			$results['error'] = "Couldn't connect to database evalurls: " . mysqli_connect_errno();
			return $results;
		}
		extract($vals);
		$sql =  "INSERT INTO urlentry (url_eval, url_description, url_category)
		VALUES ('$url_eval', '$url_description', '$url_category')";
		

        if (!mysqli_query($con, $sql)) {
			$results['error'] = "Coundn't perform the insertion" . mysqli_error($con);
		}
		mysqli_close($con);
		return $results;
	}
	
	public function showAll() {
		$results = array ();
		$con = mysqli_connect ($this->hostname, $this->username, $this->userpass, $this->dbname);
		if (mysqli_connect_errno ()) {
			$results['error'] =  "Couldn't connect to database evalurls: " . mysqli_connect_errno ();
			return $results;
		}
		
		$results['result'] = mysqli_query ($con, "SELECT * FROM urlentry");
		mysqli_close ( $con );
		return $results;
	}
}