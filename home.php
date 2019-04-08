<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 
include('inc/common.inc.php');
include('inc/db.inc.php');

try {
$connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT `id`, `username`, `date`, `title`, `content`, `tags` 
                    FROM pages 
                    ORDER BY id DESC
                    ";
$statement = $connection->prepare($sql);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $error) {
    echo $sql . "<br />" . $error->getMessage() . '';
	}
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pages</title>
<link rel="apple-touch-icon" sizes="180x180" href="/static/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/static/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/static/favicon/favicon-16x16.png">
<link rel="manifest" href="/static/favicon/site.webmanifest">
<meta name="msapplication-TileColor" content="#455a64">
<meta name="theme-color" content="#455a64">
    <!-- css -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="/static/css/materialize.min.css" rel="stylesheet" type="text/css" />
    <link href="/static/css/main.css" rel="stylesheet" type="text/css" />
<style>
*{
    -webkit-font-smoothing: antialiased;
}
</style>
</head>
<body class="grey-bg">
<?php include('inc/navbar.inc.php'); ?>

<div class="this">
<div class="container">
<br />
      <div class="pages">
      <!--<div class="note-light yellow-bg" style="margin-bottom:.5rem;font-weight:500;">Pages is not completed! Check back later.</div>-->
    <?php 
    if ($result && $statement->rowCount() > 0) {
        foreach ($result as $row) { ?>

      <a style="text-decoration:none;" href="<?php echo str_replace(' ', '_', $row['title']); ?>">
    <div class="page">
      <div class="content">
      <h5><?php echo escape($row['title']); ?></h5>
        <p><?php echo escape($row['content']); ?></p></div>
      <div class="page-bottom">
        <img class="pfp" src="https://benworld.net/protected/u/<?= getUserInfo($row['username'])[0]['profile_pic']; ?>">
        <span class="pfp-text"><a class="user-link" href="user.php?username=<?= $row['username'] ?>"><?= escape(getUserInfo($row['username'])[0]['name']); ?></a> <span class="pfp-date">
            <?php $tags = explode(":",$row['tags']); foreach ($tags as $tag) { ?>
                <span class="tag"><?= escape($tag) ?></span>
            <?php } ?>
            </span></span></div>
    </div></a>
      <?php
        }
    }else{ //no pages
    ?>
        <h4 class="center red-text text-darken-4">No pages to show</h4>
        <h6 class="center">Try refreshing the page or create one.</h6>
        <br />
        <div class="center">
            <a class="btn blue darken-2" href="/">Home</a>
            <a class="btn blue darken-2" href="<?= basename($_SERVER["SCRIPT_FILENAME"], '.php') ?>.php">Reload</a>
        </div>
    <?php
    }
    ?>
    
<!--
        <div class="page">
          <div class="content">
          <h5>This is a page</h5>
            <p>A description about this page for you to read and enjoy...</p></div>
          <div class="page-bottom">
            <img class="pfp" src="https://benworld.net/protected/u/default.png">
            <span class="pfp-text">A_Guy <span class="pfp-date">
                    <span class="tag">First</span><span class="tag">Page</span>
                </span></span></div>
        </div>
-->
    </div>
</div>


<script type="text/javascript" src="/static/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/static/js/materialize.min.js"></script>
<script>
 $(document).ready(function(){
    $('.sidenav').sidenav();
  }); 
</script>
</body>
</html>