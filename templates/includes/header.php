<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo TAGLINE?></title>
    <link href="<?php echo BASE_URL?>templates/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL?>templates/css/style.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo BASE_URL?>dashboard.php"><?php echo TAGLINE?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
         
          <ul class="nav navbar-nav navbar-right">
           <?php $user = new User(); if($user->isLoggedIn()) : ?>
            <li><a href="#">Welcome, <?php echo  $_SESSION['name'] . " as ".  getUserType();?></a></li>
            <li><a href="logoutUser.php">Logout</a></li>
           <!-- <li><a type="button" data-toggle="modal" data-target="#addPass">Change Password</a> -->
          <?php endif;?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
  