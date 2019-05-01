<?php
// LOGIN //
include('../../inc/common.inc.php');
include('../../inc/db.inc.php');

// LOGIN //
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pages Login</title>
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
<?php include('../../inc/navbar.inc.php'); ?>

<div class="container">
    <h4 class="form-title center">Login</h4>
  <div class="row">
    <form class="col s12">
      <div class="row">
          <div class="input-field col s12">
          <input id="email" type="email" class="validate" autofocus>
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
      </div>
        <div class="grow-container">
        <button class="waves-effect waves-light btn blue darken-3">Submit<i class="material-icons right">send</i></button>
        <div class="grow"></div><a class="form-link" href="/">Don't have an account?</a>
        </div>
    </form>
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