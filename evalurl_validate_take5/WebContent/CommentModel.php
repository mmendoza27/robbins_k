<?php
class CommentModel {
	private $db;
	private $results;

	public function __construct($db) {
		$this->db = $db;
	}
	
	public function create($vals) {
		$vals = $this->validate ( $vals );
		$Url = $this->getUrl($vals['comment_url']);
		if (!$Url) {
			throw new Exception("CommentModel:create--URL doesn't exist");
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
			throw new Exception("CommentModel:validate---Input argument not an array");
		}
		if (!array_key_exists('comment_url', $vals) or !array_key_exists('comment_body', $vals)) {
			throw new Exception("CommentModel:validate---Missing form field on create_comment form");
		}
		
		$comment_url = trim ( filter_var ( $vals ['comment_url'], FILTER_SANITIZE_URL ) );
		if (! filter_var ( $comment_url, FILTER_VALIDATE_URL )) {
			throw new Exception("CommentModel:validate---Invalid URL");
		}
		$comment_body = trim ( filter_var ( $vals ['comment_body'], FILTER_SANITIZE_STRING ) );
		return array ('comment_url' => $comment_url, 'comment_body' => $comment_body);
	}
}

?>