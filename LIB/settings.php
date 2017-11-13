<?php
//This file contains the global settings object that should be included in all library files

class Settings {
	
	//basic site settings
	public $siteTitle;

	//database settings
	public $db_server;
	public $db_username;
	public $db_password;
	public $db_dbname;
	public $db_con;

	public function connectDB(){
		$this->db_con = mysqli_connect($this->db_server, $this->db_username, $this->db_password);
		if(!$this->db_con) {
			echo "<br>";
			die("Fatal error. Could not establish connection to the database: " . mysqli_connect_error());	
		}

	}



}
?>
