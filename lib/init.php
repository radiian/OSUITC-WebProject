<?php
//init.php
require_once 'core.php';
//require_once 'hookr.php';
//This file contains all the initializations for the core classes
//Here the database connection is established and the main HookR class is created

define('DEBUG', "DEBUG");

if(!defined('DEBUG')){
	if(!file_exists("config.default.php")) die ("System has not been installed yet");
	if(file_exists("installer/beacon.md")) die ("Installer is still alive");
	require_once 'config.php';
}
else require_once 'config.default.php';

//print_r(get_included_files());

global $DBGlobal = new DBCon($config['sql']['db_host'], $config['sql']['db_username'], $config['sql']['db_password'], $config['sql']['db_database']);

echo $config['sql']['db_host'];
echo $testVar;
echo "<br>";
echo "Finished init";
?>
