<?php
include('../../db-info.inc.php'); // include db info //
//$host       = "localhost";
//$username   = "username";
//$password   = "password";
//$dbname     = "db-name";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
//$connection = new PDO("mysql:host=$host", $username, $password, $options);
?>