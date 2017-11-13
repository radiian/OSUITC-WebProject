<?php
require_once 'settings.php';

$config = new Settings();
$config->db_host = "127.0.0.1";
$config->db_username = "dbuser";
$config->db_password = "verybadpass";
$config->connectDB();


?>
