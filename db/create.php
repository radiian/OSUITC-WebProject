<?php


//These SQL queries have syntax errors that need to be corrected

//This string is used to create the site wide settings table
$createSettingsTableString = "CREATE TABLE 'settings' ('id' int NOT NULL PRIMARY KEY AUTO_INCREMENT, 'name' varchar NOT NULL, 'hook' varchar, 'value' varchar)";

$createBlogTableString = "CREATE TABLE 'blogs' ('id' int NOT NULL PRIMARY KEY AUTO_INCREMENT, 'title' varchar NOT NULL, 'author' int NOT NULL, 'body' varchar NOT NULL')";

//This string is used to create the users table
$createUserTableString = "CREATE TABLE `users` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,  `username` varchar(255) NOT NULL UNIQUE,  `email` varchar(255) NOT NULL UNIQUE,  `fullname` varchar(255) NOT NULL,  `magic` varchar(255) NOT NULL,  `primaryGID` int(255) NOT NULL,  `GIDlist` varchar(255) NOT NULL,  `userlevel` int(255) NOT NULL DEFAULT '0',  `reputation` int(255) NOT NULL DEFAULT '0')";
