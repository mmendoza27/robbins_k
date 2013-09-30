<?php
class CommentModel {
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
		$Url = $this->getUrl($vals['comment_url']);
		print_r($Url);
		if (!$Url) {
			$this->error = "URL doesn't exist";
		}
		
		$stmt = $this->db->prepare ( "INSERT INTO comments 
				        (comment_url, comment_body)
		                VALUES (:comment_url, :comment_body)" );
		$stmt->execute ($vals);
	}
	
	public function getCount() {
		if (! isset ($this->results ) or ! $this->results) {
			$stmt = $this->db->query ( "SELECT * FROM comments" );
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
	
	public function nextComment() {
		if (!isset ( $this->results ) or ! $this->results) {
			$this->results = $this->db->query ( 'SELECT * FROM comments' );
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