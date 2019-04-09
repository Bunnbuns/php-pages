<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 
include('inc/common.inc.php');
include('inc/db.inc.php');

try {
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT `id`, `username`, `date`, `title`, `content`, `tags` 
                    FROM pages 
                    WHERE title = :title
                    ";
    $title = str_replace('_', ' ', escape(trim ($_SERVER["REQUEST_URI"],'/')););
    
    $statement = $connection->prepare($sql);
    $statement->bindParam(':title', $title, PDO::FETCH_ASSOC);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $error) {
echo $sql . "<br />" . $error->getMessage();
	}

?>