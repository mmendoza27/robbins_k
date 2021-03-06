<?php
class EvalCommentModel {
	private $db;
	private $error;
	private $results;

	public function __construct($hostname, $username, $userpass, $dbname) {
		//try {
			$this->error = 0;
			$hostStr = "mysql:host=$hostname;dbname=$dbname;charset=utf8";
			$this->db = new PDO ( $hostStr, $username, $userpass );
			$this->db->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$this->db->setAttribute ( PDO::ATTR_EMULATE_PREPARES, false );
		//} catch(PDOException $pe) {
		//	$this->error = "Bad connection: ".$pe->getMessage();
		//}

	}
	
	public function create($vals) {
		$vals = $this->validate ( $vals );
		if (!$vals) {
			return;
		}
		$Url = $this->getUrl($vals['comment_url']);
		print_r($Url);
		if (!$Url) {
			$this->error = "URL doesn't exist";
		}
		
		$stmt = $this->db->prepare ( "INSERT INTO urlcomment 
				        (comment_url, comment_body)
		                VALUES (:comment_url, :comment_body)" );
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
		if (!is_array($vals)) {
			$this->error = "Input argument not an array";
			return 0;
		}
		
		if (!array_key_exists('comment_url', $vals) or !array_key_exists('comment_body', $vals)) {
			$this->error = "Missing form field on create_comment form";
			return 0;
		}
		
		$comment_url = trim ( filter_var ( $vals ['comment_url'], FILTER_SANITIZE_URL ) );
		if (! filter_var ( $comment_url, FILTER_VALIDATE_URL )) {
			$this->error = "Invalid URL ";
			return 0;
		}
		$comment_body = trim ( filter_var ( $vals ['comment_body'], FILTER_SANITIZE_STRING ) );
// 		if (!$comment_body) {
// 			return 0;
// 		}
		return array ('comment_url' => $comment_url, 'comment_body' => $comment_body);
	}
}

?>