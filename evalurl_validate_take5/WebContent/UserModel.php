<?php

class UserModel {
	private $db;
	private $error;
	private $results;
	public function __construct($db) {
		$this->db = $db;
		$this->error = 0;
	}
	
	public function create($vals) {
		$vals = $this->validate ( $vals );
		if (! $vals) {
			return;
		}
		$stmt = $this->db->prepare ( "INSERT INTO users
				        (user_firstname, user_lastname, user_email)
		                VALUES (:user_firstname, :user_lastname, :user_email)" );
		$stmt->execute ( $vals );
	}
	
	public function get($email) {
		$stmt = $this->db->prepare ( "SELECT * FROM users WHERE user_email=?" );
		$stmt->execute (array ($user_email) );
		return $stmt->fetch ( PDO::FETCH_ASSOC );
	}
	
	public function getCount() {
		if (! isset ( $this->results ) or ! $this->results) {
			$stmt = $this->db->query ( "SELECT * FROM users" );
			return $stmt->rowCount ();
		} else {
			return $this->results->rowCount ();
		}
	}
	public function getError() {
		return $this->error;
	}
	
	public function nextUser() {
		if (! isset ( $this->results ) or ! $this->results) {
			$this->results = $this->db->query ( 'SELECT * FROM users' );
		}
		return $this->results->fetch ( PDO::FETCH_ASSOC );
	}
	
	public function validate($vals) {
		if (! is_array ( $vals )) {
			$this->error = "Input argument not an array";
			return 0;
		}
		if (! array_key_exists ( 'url_firstname', $vals ) or !array_key_exists ( 'url_lastname', $vals ) or !array_key_exists ( 'user_email', $vals )) {
			$this->error = "Missing form field on create_user form";
			return 0;
		}
		
		$user_firstname = trim ( filter_var ( $vals ['user_firstname'], FILTER_SANITIZE_URL ) );
		if (! filter_var ( $user_firstname, FILTER_VALIDATE_URL )) {
			$this->error = "Invalid user first name ";
			return 0;
		}
		
		$user_lastname = trim ( filter_var ( $vals ['user_lastname'], FILTER_SANITIZE_STRING ) );
		if (! $user_lastname or strlen ( $user_lastname ) == 0) {
			$this->error = "Invalid user last name";
			return 0;
		}
		
		$user_email = trim ( filter_var ( $vals ['user_email'], FILTER_SANITIZE_EMAIL ) );
		if (! filter_var ( $user_email, FILTER_VALIDATE_EMAIL )) {
			$this->error = "Invalid email address";
			return 0;
		}
		
		$newvals = array (
				'user_firstname' => $user_firstname,
				'user_lastname' => $user_lastname,
				'user_email' => $user_email 
		);
		return $newvals;
	}
}