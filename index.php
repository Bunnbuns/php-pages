<?php

?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pages</title>

<meta name="msapplication-TileColor" content="#455a64">
<meta name="theme-color" content="#455a64">
    <!-- css -->
    <link href="/static/css/main.css" rel="stylesheet" type="text/css" />
<style>

</style>
</head>
<body>
<div id="content-wrapper">
    <div class="this">

<div class="hero">
    <div class="mui--appbar-height"></div>
  <h1 class="hero-text"><center>Pages</center></h1>
</div>
<div class="page-content">
  <div class="pages">
      <div class="note-light yellow" style="margin-bottom:.5rem;font-weight:500;">Pages is not completed! Check back later.</div>
    <?php 
    if ($result && $statement->rowCount() > 0) {
        foreach ($result as $row) { ?>

      <a style="text-decoration:none;" href="<?php echo str_replace(' ', '_', $row['title']); ?>">
    <div class="page">
      <div class="content">
      <h2><?php echo escape($row['title']); ?></h2>
        <p><?php echo escape($row['content']); ?></p></div>
      <div class="page-bottom">
        <img class="pfp" src="pfp/<?php echo getUserInfo($row['username'])[0]['profile_pic']; ?>">
        <span class="pfp-text"><?php echo escape(getUserInfo($row['username'])[0]['name']); ?> <span class="pfp-date">
            <?php $tags = explode(":",$row['tags']); foreach ($tags as $tag) { ?>
                <span class="tag"><?php echo escape($tag); ?></span>
            <?php } ?>
            </span></span></div>
    </div></a>
      <?php
        }
    }
    ?>

 <!--     
    <div class="page">
      <div class="content">
      <h2>This is a page</h2>
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
  
  </div><!-- End .this -->
</div>
</body>
</html>