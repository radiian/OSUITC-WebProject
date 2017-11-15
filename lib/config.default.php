<?php
//config.default.php
//This file contains the default configuration for the site
//This file will be overwritten during installation
//This file only shows the layout of how the config file should look
$testVar = "Hello, world!";


//MySQL settings
$config['sql']['db_host'] = "127.0.0.1";
$config['sql']['db_username'] = "dbuser";
$config['sql']['db_password'] = "verybadpass";
$config['sql']['db_database'] = "mydatabase";

//General config
$config['general']['sitename'] = "MyWebsite";
$config['general']['title'] = "MyWebsite";
$config['general']['rootpath'] = "";//Leave blank for the base of the web dir

?>
