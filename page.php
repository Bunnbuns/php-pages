<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 
include('inc/common.inc.php');
include('inc/db.inc.php');

try {
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT `id`, `username`, `date`, `title`, `content`, `tags` 
                    FROM pages 
                    WHERE title = :postLink
                    ";
    $postLink = str_replace('_', ' ', trim(urldecode($_SERVER["REQUEST_URI"]),'/'));
    
    $statement = $connection->prepare($sql);
    $statement->bindParam(':postLink', $postLink, PDO::FETCH_ASSOC);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $error) {
echo $sql . "<br />" . $error->getMessage();
	}
echo escape($postLink);
// --- Title --- //
$title = escape($result[0]['title']);
// --- Tags --- //
$tags = explode(":",$result[0]['tags']);
// --- Username --- //
$Username = escape($result[0]['username']);
// --- Date --- //
$date = date_create($result[0]['date']);
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
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
    
<div class="page-content this">
    <div class="top-area">
        <div class="back" style="margin:1rem 0 .5rem 0;"><a href="/home.php">Back</a></div>
        <h3 class="normal-title"><?php echo $title; ?></h3>
        
        <div class="tag-area">
            <?php foreach ($tags as $tag){ ?>
          <span class="tag"><?php echo escape($tag); ?></span>
            <?php } ?>
        </div>
            <div class="user-info-area">
            <a href="/u/<?= $Username ?>">
                <img class="pfp medium" src="https://apis.buncode.com/pages/pfp/<?= escape(getUserInfo($Username)[0]['profile_pic']); ?>">
                <div class="name-area">
                    <span class="name"><?= escape(getUserInfo($Username)[0]['name']); ?></span>
                    <span class="username"><?= escape($Username); ?></span>
                </div>
            </a>
        
            <div>
                <span class="date"><?php echo date_format($date, 'M d, Y').' at '.date_format($date, 'H:m'); ?></span>
            </div>
        </div>
    </div><!-- End top area -->
  <div class="pages a-page">
  <p>
      <?php echo escape($result[0]['content']); ?>
  </p>
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