<?php
//installer/db.php

//This file contains the code to actually create and populate the database

//Variables

$userq = "CREATE TABLE users (id int(255) AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY, username varchar(255) UNIQUE NOT NULL, email varchar(255) NOT NULL, fullname varchar(255) NOT NULL, passhash varchar(255) NOT NULL, primarygid int(255) NOT NULL, gids varchar(255) NOT NULL, adminnotes varchar(255), registered DATETIME NOT NULL)";

$sessq = "CREATE TABLE sessions (id varchar(255) UNIQUE NOT NULL PRIMARY KEY, userid int(255) UNIQUE NOT NULL, start DATETIME NOT NULL, expire DATETIME NOT NULL)";

$admsessq = "CREATE TABLE adminsessions (id varchar(255) UNIQUE NOT NULL PRIMARY KEY, userid int(255) UNIQUE NOT NULL, start DATETIME NOT NULL, expire DATETIME NOT NULL)";

$templateq = "CREATE TABLE templates (id int(255) AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY, hook varchar(255) UNIQUE NOT NULL, created DATETIME NOT NULL, lastedit DATETIME NOT NULL, content varchar(10240) NOT NULL)";

$styleq = "CREATE TABLE styles (id int(255) AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY, hook varchar(255) UNIQUE NOT NULL, created DATETIME NOT NULL, lastedit DATETIME NOT NULL, content varchar(10240) NOT NULL)";

$fpostq = "CREATE TABLE fposts (id int(255) AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY, author int(255) NOT NULL, sectiontree varchar(255) NOT NULL, created DATETIME NOT NULL, lastedit DATETIME NOT NULL, body varchar(10240) NOT NULL)";

$fcommentq = "CREATE TABLE fcomments (id int(255) AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY, author int(255) NOT NULL, created DATETIME NOT NULL, lastedit DATETIME NOT NULL, body varchar(10240) NOT NULL, replyto int(255) NOT NULL)";

$bpostq = "CREATE TABLE fposts (id int(255) AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY, author int(255) NOT NULL, sectiontree varchar(255) NOT NULL, created DATETIME NOT NULL, lastedit DATETIME NOT NULL, body varchar(10240) NOT NULL)";

$bcommentq = "CREATE TABLE fcomments (id int(255) AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY, author int(255) NOT NULL, created DATETIME NOT NULL, lastedit DATETIME NOT NULL, body varchar(10240) NOT NULL, replyto int(255) NOT NULL)";

$groupsq = "CREATE TABLE groups (id int(255) AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY, name varchar(255) UNIQUE NOT NULL, parent int(255), level int(255) NOT NULL, imagepath varchar(255))";

$pagesq = "CREATE TABLE pages (id int(255) AUTO_INCREMENT UNIQUE NOTNULL PRIMARY KEY, name varchar(255) UNIQUE NOT NULL, title varchar(255), mastertemplate int(255) NOT NULL, gid int(255) NOT NULL)";


?>
