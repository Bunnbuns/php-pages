<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 
include('../inc/common.inc.php');
include('../inc/db.inc.php');

try {
$connection = new PDO($dsn, $username, $password, $options);
$sql = "SELECT id, name, username, email, bio, date 
				FROM users
				WHERE username = :username";
$username = $_GET['username'];
$statement = $connection->prepare($sql);
$statement->bindParam(':username', $username, PDO::FETCH_ASSOC);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $error) {
    echo $sql . "<br />" . $error->getMessage() . '';
	}
if($result && $statement->rowCount() > 0){
    $error = "not_found";
}else{
    $error = null;
}
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= ($error !== "not_found") ? "User not found" : escape($username) ?></title>
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
<?php include('../inc/navbar.inc.php'); ?>

<div class="this">
<div class="container">
<br />
<div class="user-page">
<?php
    if ($error == 'not_found') {
?>
    <img class="pfp large-3" src="https://apis.buncode.com/pages/pfp/<?= escape(getUserInfo($username)[0]['profile_pic']); ?>">
    <div class="name-area">
        <span class="name"><?= escape(getUserInfo($username)[0]['name']); ?></span>
        <span class="username"><?= escape($username); ?></span>
    </div>
    <div class="bio-area">
        <div class="bio">
            <?= escape($result[0]['bio']); ?>
        </div>
    </div>
<?php   
    }else{
?>
<h3 class="center red-text text-darken-4">User not found</h3>
    <br />
    <div class="center">
        <a class="btn blue darken-2" href="/">Home</a>
    </div>
<?= 
die;
    } ?>
</div>

<br />
<div class="divider"></div>
    <h5 style="margin: 1rem 0 .25rem 0;">Pages</h5>
    <div class="section">
        <div id="loading-posts" class="center">
            <br />
          <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-blue-only">
              <div class="circle-clipper left">
                <div class="circle"></div>
              </div><div class="gap-patch">
                <div class="circle"></div>
              </div><div class="circle-clipper right">
                <div class="circle"></div>
              </div>
            </div>
          </div>
        </div>
        <div id="user-posts">
        </div>
    </div>


    </div>
</div>

<script>
getUserPosts("<?= $username ?>");
function getUserPosts(username){
    // Make request //
    var xhttpPostCount = new XMLHttpRequest(); 
    xhttpPostCount.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Request is complete //
            var posts = document.getElementById("user-posts");
            document.getElementById("loading-posts").style.display ="";
            var tmp = this.responseText;
                document.getElementById("user-posts").innerHTML += tmp;
                document.getElementById("loading-posts").style.display ="none";
            }
    };
    xhttpPostCount.open("GET", "/api/userposts.php?username="+username, true);
    xhttpPostCount.send();
}
</script>
<script type="text/javascript" src="/static/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/static/js/materialize.min.js"></script>
<script>
 $(document).ready(function(){
    $('.sidenav').sidenav();
  }); 
</script>
</body>
</html>