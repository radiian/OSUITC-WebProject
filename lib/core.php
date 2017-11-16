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

		$regx = "/\'+/";//Sanitize '
		$output = preg_replace($regx, "&#39;", $output);

		$regx = "/\"+/";//Sanitize "
		$output = preg_replace($regx, "&quot;", $output);

		$regx = "/\`+/";//Sanitize `
		$output = preg_replace($regx, "&#96;", $output);

		return $output;//Return the output with sanitized text 
	}

//This class holds functions for creating different levels of logs
//Usefull for logging errors when the actual php error log cannot be accessed
class LogR {
	
	private $dir;	

	public function __construct($_dir){
		$this->dir = $_dir;
	}

	//Log an error
	//Level determines how bad the error is. 0 is a warning, 1 is an error, 2 is fatal and will usually be followed by a die()
	public function logerror($message, $level = 0){
		$errorloghandle = fopen("../" . $this->dir . "error.log", "a");
		$loglevel = "";
		switch($level){
			case 0 : $loglevel = "--WARNING--";
				break;
			case 1 : $loglevel = "==ERROR==";
				break;
			case 2: $loglevel = "**FATAL**";
				break;
		}	
		
		$datetime = date("Y-m-d h:i:sa");
		fwrite($errorloghandle, $datetime . " " . $loglevel . " " . $message . "\r\n");
		fclose($errorloghandle);
	}

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
		$this->server = $_server;
		$this->username = $_user;
		$this->pass = $_pass;
		$this->dbname = $_dbname;
		$this->connectDB();

	}

	public function __destruct(){
		mysqli_close($this->conn);//Close the database connection on object destruction
	}

	public function connectDB(){
		$this->conn = mysqli_connect($this->server, $this->username, $this->pass, $this->dbname);
		if(!$this->conn){
			$lgr = new LogR("");
			$lgr->logerror("Fatal error on database connect: " . mysqli_connect_error(), 2);
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
	private $sessid;

	public function Context($SessionId){
		$this->sessid = $SessionId;
	}

}


?>
