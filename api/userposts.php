<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 
include('../inc/common.inc.php');
include('../inc/db.inc.php');
$Username = $_GET['username'];

    try {
        include('../inc/db.inc.php');
        $connection = new PDO($dsn, $username, $password, $options);
        $sql = "SELECT `id`, `username`, `date`, `title`, `content`, `tags` 
                        FROM pages 
                        WHERE username = :username
                        ORDER BY id DESC";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $Username, PDO::FETCH_ASSOC);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
    echo $sql . "<br />" . $error->getMessage() . '';
        }

    if ($result && $statement->rowCount() > 0) {
        foreach ($result as $row) { 
            $postLink = str_replace(' ', '_', escape($row['title']));
    ?>
    <a style="text-decoration:none;" href="/<?= $postLink ?>">
        <div class="page">
            <div class="content">
                <h5><?= escape($row['title']) ?></h5>
                <p><?= escape($row['content']) ?></p></div>
            <div class="page-bottom">
                <img class="pfp" src="https://apis.buncode.com/pages/pfp/<?= escape(getUserInfo($row['username'])[0]['profile_pic']); ?>">
                <span class="pfp-text"><a class="user-link" href="/u/<?= escape($row['username']) ?>"><?= escape(getUserInfo($row['username'])[0]['name']); ?></a> <span class="pfp-date">
                    <?php $tags = explode(":",$row['tags']); foreach ($tags as $tag) { ?>
                    <span class="tag"><?= escape($tag) ?></span>
                    <?php } ?>
                    </span></span></div>
        </div></a>
    <?php
                                  }
    }else{ //no pages
    ?>
    <h5 class="center grey-text">No pages to show</h5>
    <?php
    }
?>