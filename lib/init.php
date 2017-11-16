<?php
//init.php
require_once 'core.php';
require_once 'hookr.php';
//This file contains all the initializations for the core classes
//Here the database connection is established and the main HookR class is created

define('DEBUG', "DEBUG");

if(!defined('DEBUG')){
	if(!file_exists("config.default.php")) die ("System has not been installed yet");
	if(file_exists("installer/beacon.md")) die ("Installer is still alive");
	require_once 'config.php';
}
else require_once 'config.default.php';



//Global object references for the rest of the project
$DBGlobal = new DBCon($config['sql']['db_host'], $config['sql']['db_username'], $config['sql']['db_password'], $config['sql']['db_database']);

$HKRGlobal = new HookR();

$query = "CREATE TABLE users (id int(128) AUTO_INCREMENT NOT NULL PRIMARY KEY UNIQUE, username varchar(255) NOT NULL UNIQUE, email varchar(255) NOT NULL, pass varchar(255) NOT NULL, gid int(128) NOT NULL DEFAULT '1')";

$DBGlobal->queryDB($query);

echo "Finished init";

?>
