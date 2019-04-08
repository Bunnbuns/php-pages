<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 

include('db.inc.php');
$connection = new PDO($dsn, $username, $password, $options);
$sql = "SELECT * 
				FROM test
                ";
$statement = $connection->prepare($sql);
$statement->execute();
$data = $statement->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT);
?>