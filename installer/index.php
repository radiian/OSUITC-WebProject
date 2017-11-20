<?php
//installer/index.php

//This is the starting page for the installer program.
$maintemplate = file_get_contents("./templates/main.html");

$progress = "Start";
$body = "Need Template!";

if(!file_exists("./beacon.md")){
	//already installed????
	$progress = "Already Installed!";
	$body = file_get_contents("./templates/alreadyinstalled.html");
	$maintemplate = preg_replace("/\{progress\}/", $progress, $maintemplate);
	$maintemplate = preg_replace("/\{content\}/", $body, $maintemplate);
	echo $maintemplate;
}

if(isset($_GET['progress']) || isset($_POST['progress'])){
	//handle progression and continue
	
	$progressvar = "start";
	if(isset($_GET['progress'])) $progressvar = $_GET['progress'];
	else $progressvar = $_POST['progress'];	

	switch($progressvar){
		case 'sqlsetup': doSQLSetup();
			break;
		case 'config': doConfig();
			break;
		case 'sqlinstall': doSQLInstall();
			break;
		default: invalidPage();
			break;
	}

	echo $maintemplate;
}
else {
	//No progression, start from beginning

	$progress = "Welcome";
	$body = file_get_contents("./templates/welcome.html");

	$maintemplate = preg_replace("/\{progress\}/", $progress, $maintemplate);
	$maintemplate = preg_replace("/\{content\}/", $body, $maintemplate);
	echo $maintemplate;
}

function insertData($template, $progress, $body){
	$temp = $template;
	$temp = preg_replace("/\{progress\}/", $progress, $temp);
	$temp = preg_replace("/\{content\}/", $body, $temp);
	return $temp;
}

function invalidPage(){
	global $maintemplate;
	$progress = "Invalid Page";
	$body = file_get_contents("./templates/wrongturn.html");
	$maintemplate = insertData($maintemplate, $progress, $body);
	//echo $maintemplate;
}

function doSQLSetup(){
	global $maintemplate;
	$progress = "Welcome/SQL Setup";
	$body = file_get_contents("./templates/sqlsetup.html");
	$maintemplate = insertData($maintemplate, $progress, $body);
	//echo $maintemplate;
}

function doConfig(){
	global $maintemplate;
	$progress = "Welcome/SQL Setup/General Config";
	$body = file_get_contents("./templates/config.html");
	$maintemplate = insertData($maintemplate, $progress, $body);
}

function doSQLInstall(){

}

?>
