<?php
//common functions and such
function getUserInfo($Username){
    try {
        include("db.inc.php");
        $connection = new PDO($dsn, $username, $password, $options);
        $sql = "SELECT `id`, `name`, `username`, `profile_pic`, `email`, `bio`, `date` 
                        FROM users
                        WHERE username = :username";
        //$Username = $Username;
        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $Username, PDO::FETCH_ASSOC);
        $statement->execute();
        $userInfo = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
    echo $sql . "<br />" . $error->getMessage() . '';
        }
    return $userInfo;
}
function getUserPosts($Username){
    try {
        include("db.inc.php");
        $connection = new PDO($dsn, $username, $password, $options);
        $sql = "SELECT `id`, `username`, `date`, `title`, `content`, `tags` 
                        FROM pages 
                        WHERE username = :username
                        ORDER BY id DESC";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $Username, PDO::FETCH_ASSOC);
        $statement->execute();
        $userPosts = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
    echo $sql . "<br />" . $error->getMessage() . '';
        }
    return $userPosts;
}
function escape($html) {
	return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}
?>