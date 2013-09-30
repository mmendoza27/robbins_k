<?php
class UrlModel {
	private $db;
	private $error;
	private $results;

	public function __construct($db) {
        $this->db = $db;
        $this->error = 0;
	}
	
	public function create($vals) {
		$vals = $this->validate ( $vals );
		if (!$vals) {
			return;
		}
		$stmt = $this->db->prepare ( "INSERT INTO urls 
				        (url_name, url_description, url_category)
		                VALUES (:url_name, :url_description, :url_category)" );
		$stmt->execute ($vals);
	}
	
	public function getCount() {
		if (! isset ($this->results ) or ! $this->results) {
			$stmt = $this->db->query ( "SELECT * FROM urls" );
			return $stmt->rowCount ();
		} else {
			return $this->results->rowCount ();
		}
	}
	
	public function getError() {
		return $this->error;
	}
	
	public function getUrl($urlname) {
		$stmt = $this->db->prepare ( "SELECT * FROM urls WHERE url_name=?" );
		$stmt->execute ( array ($urlname ) );
		return $stmt->fetch ( PDO::FETCH_ASSOC );
	}
	
	public function nextUrl() {
		if (!isset ( $this->results ) or ! $this->results) {
			$this->results = $this->db->query ( 'SELECT * FROM urls' );
		}
		return $this->results->fetch ( PDO::FETCH_ASSOC );
	}
	
	public function validate($vals) {
		if (!is_array($vals)) {
			$this->error = "Input argument not an array";
			return 0;
		}
		if (!array_key_exists('url_name', $vals) or !array_key_exists('url_category', $vals)
		    or !array_key_exists('url_description', $vals)) {
			$this->error = "Missing form field on create_url form";
			return 0;
		}
		
		$url_name = trim ( filter_var ( $vals ['url_name'], FILTER_SANITIZE_URL ) );
		if (! filter_var ( $url_name, FILTER_VALIDATE_URL )) {
			$this->error = "Invalid URL ";
			return 0;
		}
		
		$url_category = trim ( filter_var ( $vals ['url_category'], FILTER_SANITIZE_STRING ) );
		if (!$url_category or strlen($url_category)==0) {
			$this->error = "Invalid URL category";
			return 0;
		}
	
		$url_description = trim ( filter_var ( $vals ['url_description'], FILTER_SANITIZE_STRING ) );
// 			if (!$url_description) {
// 				$this->error = "Invalid URL description";
// 				return 0;
// 			}
			
		$newvals = array ('url_name' => $url_name,'url_category' => $url_category,
				          'url_description' => $url_description);
		return $newvals;
	}
}

?>