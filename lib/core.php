<?php
//core.php
//This file contains core functions and classes for the project

	
	//This function is used to remove restricted characters from user input
	//It will remove hook characters, html, and SQL special characters to sanitize strings
	//**********
	//cleaner
	//**********
	//INPUT: A string to be sanitized
	//OUTPUT: A string for which special characters have been replaced with html equivalents

	//All user input must pass through this function BEFORE being stored in the database
	function cleanr($input){
		$regx = "/\{+/";//Sanitize {
		$output = preg_replace($regx, "&#123;", $input);
		
		$regx = "/\}+/";//Sanitize }
		$output = preg_replace($regx, "&#125;", $output);
		
		$regx = "/\;+/";//Sanitize ;
		$output = preg_replace($regx, "&#59;", $output);	
	
		$regx = "/\/+/";//Sanitize/
		$output = preg_replace($regx, "&#47;", $output);

		$regx = "/<+/";//Sanitize <
		$output = preg_replace($regx, "&lt;", $output);

		$regx = "/>+/";//Sanitize >
		$output = preg_replace($regx, "&gt;", $output);

		$regx = "/\'+/"//Sanitize '
		$output = preg_replace($regx, "&#39;", $output);

		$regx = "/\"+/"//Sanitize "
		$output = preg_replace($regx, "&quot;", $output);

		$regx = "/\`+/"//Sanitize `
		$output = preg_replace($regx, "&#96;", $output);

		return $output;//Return the output with sanitized text 
	}


//This class holds all of the methods for communicating with the database backend
//All queries should go through this class
class DBCon {

	private $server;
	private $username;
	private $pass;
	private $dbname;
	private $conn;

	public function __construct($_server, $_user, $_pass, $_dbname){
		$server = $_server;
		$username = $_user;
		$pass = $_pass;
		$dbname = $_dbname;
		$this->connectDB();
	}

	public function __destruct(){
		mysqli_close($this->conn);//Close the database connection on object destruction
	}

	public function connectDB(){
		$this->conn = mysqli_connect($this->server, $this->username, $this->pass, $this->dbname);
		if(!$this->conn){
			die("Fatal error. DB connection failed: " . mysqli_connect_error());
		}
	}

	public function isConnected(){
		if(!$this->conn) return false;
		else return true;
	}

	public function queryDB($sql){
		if(!$this->conn) return false;
		else{
			return mysqli_query($this->conn, $sql);	
		}
	}
			
}


class Context{
	public $path;
	public $GETVars;
	public $POSTVars;
	public $sessid;

	public function Context($SessionId){
		$this->sessid = $SessionId;
	}

}


?>
