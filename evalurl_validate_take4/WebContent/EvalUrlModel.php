<?php
require_once ('EvalUrl.php');
class EvalUrlModel {
	private $db;
	private $error;
	private $results;

	public function __construct($hostname, $username, $userpass, $dbname) {
		$this->error = 0;	
		$hostStr = "mysql:host=$hostname;dbname=$dbname;charset=utf8";
		$this->db = new PDO ( $hostStr, $username, $userpass );
		$this->db->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$this->db->setAttribute ( PDO::ATTR_EMULATE_PREPARES, false );
	}
	
	public function createUrl($vals) {
		$vals = $this->validate ( $vals );
		if (!$vals) {
			return;
		}
		$stmt = $this->db->prepare ( "INSERT INTO urlentry 
				        (url_eval, url_description, url_category)
		                VALUES (:url_eval, :url_description, :url_category)" );
		$stmt->execute ($vals);
	}
	
	public function getCount() {
		if (! isset ($this->results ) or ! $this->results) {
			$stmt = $this->db->query ( "SELECT * FROM urlentry" );
			return $stmt->rowCount ();
		} else {
			return $this->results->rowCount ();
		}
	}
	
	public function getError() {
		return $this->error;
	}
	
	public function getUrl($urlname) {
		$stmt = $this->db->prepare ( "SELECT * FROM urlentry WHERE url_eval=?" );
		$stmt->execute ( array ($urlname ) );
		return $stmt->fetch ( PDO::FETCH_ASSOC );
	}
	
	public function nextUrl() {
		if (!isset ( $this->results ) or ! $this->results) {
			$this->results = $this->db->query ( 'SELECT * FROM urlentry' );
		}
		return $this->results->fetch ( PDO::FETCH_ASSOC );
	}
	
	public function validate($vals) {
		$url_eval = trim ( filter_var ( $vals ['url_eval'], FILTER_SANITIZE_URL ) );
		if (! filter_var ( $url_eval, FILTER_VALIDATE_URL )) {
			$this->error = "Invalid URL ";
			return 0;
		}
		$newvals = array (
				'url_eval' => $url_eval,
				'url_category' => $vals ['url_category'],
				'url_description' => $vals ['url_description'] 
		);
		return $newvals;
	}
}

?>