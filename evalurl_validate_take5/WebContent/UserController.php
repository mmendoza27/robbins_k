<?php
class UserController {
	private $db;
	private $user;
	
	public function _construct($db) {
		$this->$db = $db;
	}
	
}

?>