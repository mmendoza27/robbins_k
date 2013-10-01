<?php
class UrlModel {
	private $db;
	private $results;

	public function __construct($db) {
        $this->db = $db;
	}
	
	public function create($vals) {
		$vals = $this->validate ( $vals );
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
	
	public function get($urlName) {
		$urlName = $this->validateName($urlName);
		$stmt = $this->db->prepare ("SELECT * FROM urls WHERE url_name=?" );
		$stmt->execute ( array ($urlName ) );
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
			throw new Exception("UrlModel:validate---Input argument not an array");
		} 
		
		if (!array_key_exists('url_name', $vals) or !array_key_exists('url_category', $vals)
		    or !array_key_exists('url_description', $vals)) {
			throw new Exception("UrlModel:validate---Missing form field on create_url form");
		}
		
		$url_name = trim ( filter_var ( $vals ['url_name'], FILTER_SANITIZE_URL ) );
		if (! filter_var ( $url_name, FILTER_VALIDATE_URL )) {
			throw new Exception("UrlModel:validate---Invalid URL");
		}
		
		$url_category = trim ( filter_var ( $vals ['url_category'], FILTER_SANITIZE_STRING ) );
		if (!$url_category or strlen($url_category)==0) {
			throw new Exception("UrlModel:validate---Invalid URL category");
		}
	
		$url_description = trim ( filter_var ( $vals ['url_description'], FILTER_SANITIZE_STRING ) );

		$newvals = array ('url_name' => $url_name,'url_category' => $url_category,
				          'url_description' => $url_description);
		return $newvals;
	}
	
	public function validateName($inName) {
  	   $url_name = trim ( filter_var ( $inName, FILTER_SANITIZE_URL ) );
	   if (! filter_var ( $url_name, FILTER_VALIDATE_URL )) {
		   throw new Exception("UrlModel:validateName---Invalid URL");
	   } 
	   return $url_name;
	}
	
}

?>