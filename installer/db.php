<?php
require_once 'dbcreds.php';
session_start();
//installer/db.php

//This file contains the code to actually create and populate the database

//Variables

$tableprefix = "";

$userq = "CREATE TABLE ".$tableprefix."users (id int(255) AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY, username varchar(255) UNIQUE NOT NULL, email varchar(255) NOT NULL, fullname varchar(255) NOT NULL, passhash varchar(255) NOT NULL, primarygid int(255) NOT NULL, gids varchar(255) NOT NULL, adminnotes varchar(255), registered DATETIME NOT NULL)";

$sessq = "CREATE TABLE ".$tableprefix."sessions (id varchar(255) UNIQUE NOT NULL PRIMARY KEY, userid int(255) UNIQUE NOT NULL, start DATETIME NOT NULL, expire DATETIME NOT NULL)";

$admsessq = "CREATE TABLE ".$tableprefix."adminsessions (id varchar(255) UNIQUE NOT NULL PRIMARY KEY, userid int(255) UNIQUE NOT NULL, start DATETIME NOT NULL, expire DATETIME NOT NULL)";

$templateq = "CREATE TABLE ".$tableprefix."templates (id int(255) AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY, hook varchar(255) UNIQUE NOT NULL, created DATETIME NOT NULL, lastedit DATETIME NOT NULL, content varchar(10240) NOT NULL)";

$styleq = "CREATE TABLE ".$tableprefix."styles (id int(255) AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY, hook varchar(255) UNIQUE NOT NULL, created DATETIME NOT NULL, lastedit DATETIME NOT NULL, content varchar(10240) NOT NULL)";

$fpostq = "CREATE TABLE ".$tableprefix."fposts (id int(255) AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY, author int(255) NOT NULL, sectiontree varchar(255) NOT NULL, created DATETIME NOT NULL, lastedit DATETIME NOT NULL, body varchar(10240) NOT NULL)";

$fcommentq = "CREATE TABLE ".$tableprefix."fcomments (id int(255) AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY, author int(255) NOT NULL, created DATETIME NOT NULL, lastedit DATETIME NOT NULL, body varchar(10240) NOT NULL, replyto int(255) NOT NULL)";

$bpostq = "CREATE TABLE ".$tableprefix."fposts (id int(255) AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY, author int(255) NOT NULL, sectiontree varchar(255) NOT NULL, created DATETIME NOT NULL, lastedit DATETIME NOT NULL, body varchar(10240) NOT NULL)";

$bcommentq = "CREATE TABLE ".$tableprefix."fcomments (id int(255) AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY, author int(255) NOT NULL, created DATETIME NOT NULL, lastedit DATETIME NOT NULL, body varchar(10240) NOT NULL, replyto int(255) NOT NULL)";

$groupsq = "CREATE TABLE ".$tableprefix."groups (id int(255) AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY, name varchar(255) UNIQUE NOT NULL, parent int(255), level int(255) NOT NULL, imagepath varchar(255))";

$pagesq = "CREATE TABLE ".$tableprefix."pages (id int(255) AUTO_INCREMENT UNIQUE NOTNULL PRIMARY KEY, name varchar(255) UNIQUE NOT NULL, title varchar(255), mastertemplate int(255) NOT NULL, gid int(255) NOT NULL)";

if(isset($_POST['verify'])){
	if(!isset($_POST['host']) || !isset($_POST['user']) || !isset($_POST['pass']) || !isset($_POST['database'])){
		echo "nodata";
	}
	else {
		$host = $_POST['host'];
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$database = $_POST['database'];
		$testConn = mysqli_connect($host, $user, $pass, $database);
		if(!$testConn) echo "error";
		else {
			echo "connected";
			mysqli_close($testConn);
	}
}
return;
//die();//Die to be sure that no more code gets executed
}

if(isset($_POST['startsession'])){
	//setup the session for further work
	if(!isset($_POST['host']) || !isset($_POST['user']) || !isset($_POST['pass']) || !isset($_POST['database'])){
		echo "error";
	}
	else{
		$_SESSION['DBLOGINDONE'] = "TRUE";
		$_SESSION['DBHOST'] = $_POST['host'];
		$_SESSION['DBUSER'] = $_POST['user'];
		$_SESSION['DBPASS'] = $_POST['pass'];
		$_SESSION['DBDB'] = $_POST['database'];
		echo "done";
	}
	return;
}

if(!isset($_SESSION['DBLOGINDONE']))die("The database credentials have not yet been setup!");
if(!isset($_SESSION['DBHOST'])) die("Database settings not set!");
if(!isset($_SESSION['DBUSER'])) die("Database settings not set!");
if(!isset($_SESSION['DBPASS'])) die("Database settings not set!");
if(!isset($_SESSION['DBDB'])) die ("Database settings not set!");


if(isset($_GET['debug'])){
	doDebug();
}

$hostname = $_SESSION['DBHOST'];
$username = $_SESSION['DBUSER'];
$pass = $_SESSION['DBPASS'];
$database = $_SESSION['DBDB'];

$conn = mysqli_connect($hostname, $username, $pass, $database);
if(!$conn) die ("Failed to connect to database: " . mysqli_connect_error());

if(isset($_POST['DO'])){
	$action = $_POST['DO'];
	switch($action){
		case "debug_test": doDebug();
			break;
		case "user_setup": runUserSetup();
			break;
		case "forum_setup": runForumSetup();
			break;
		case "forum_comment_setup": runFCommentSetup();
			break;
		case "blog_setup": runBlogSetup();
			break;
		case "blog_comment_setup": runBCommentSetup();
			break;
		case "sess_setup": runSessSetup();
			break;
		case "adm_sess_setup": runAdmSessSetup();
			break;
		case "group_setup": runGroupSetup();
			break;
		case "template_setup": runTemplateSetup();
			break;
		case "style_setup": runStyleSetup();
			break;
		case "page_setup": runPageSetup();
			break;
		default: echo "Nothing to do";
			break;
	}
}

function doDebug(){
	echo $GLOBALS["userq"] . "<br>";
	echo $GLOBALS["sessq"] . "<br>";
	echo $GLOBALS["admsessq"] . "<br>";
	echo $GLOBALS["templateq"] . "<br>";
	echo $GLOBALS["styleq"] . "<br>";
	echo $GLOBALS["fpostq"] . "<br>";
	echo $GLOBALS["fcommentq"] . "<br>";
	echo $GLOBALS["bpostq"] . "<br>";
	echo $GLOBALS["bcommentq"] . "<br>";
	echo $GLOBALS["groupsq"] . "<br>";
	echo $GLOBALS["pagesq"] . "<br>";
}

function runUserSetup(){}

function runForumSetup(){}

function runFCommentSetup(){}

function runBlogSetup(){}

function runBCommentSetup(){}

function runSessSetup(){}

function runAdmSessSetup(){}

function runGroupSetup(){}

function runTemplateSetup(){}

function runStyleSetup(){}

function runPageSetup(){}

?>
