<?php
class DbUtil{
	public static $loginUser = "asz5sc"; 
	public static $loginPass = "3b40U5FT";
	public static $host = "mysql.cs.virginia.edu"; // DB Host
	public static $schema = "asz5sc_..."; // DB Schema
	
	public static function loginConnection(){
		$db = new mysqli(DbUtil::$host, DbUtil::$loginUser, DbUtil::$loginPass, DbUtil::$schema);
	
		if($db->connect_errno){
			echo("Could not connect to db");
			$db->close();
			exit();
		}
		
		return $db;
	}
	
}
?>

