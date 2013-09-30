<?php
class ControllerFactory {
	
	public static function buildUrl($config) {
		
	}
	
	public static function buildDb($hostname, $username, $userpass, $dbname) {
	  try {
		$hostStr = "mysql:host=$hostname;dbname=$dbname;charset=utf8";
		$db = new PDO ( $hostStr, $username, $userpass );
		$db->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$db->setAttribute ( PDO::ATTR_EMULATE_PREPARES, false );
		return $db;
	   } catch(PDOException $pe) {
		 echo "Bad connection: ".$pe->getMessage(); // replace with logger later
		 return null;
	   }
	}
		
	
}