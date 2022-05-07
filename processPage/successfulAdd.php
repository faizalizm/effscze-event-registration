<?php
  session_start();

  if(isset($_SESSION["admin"]))
    $haveSession = true;
  else
    $haveSession = false;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styling/styleSetup.css" />
    <link rel="stylesheet" href="../styling/adminStyle.css" />
    <title>Adding category processing...</title>
  </head>
  <body>
    <div class="global-container">
      <?php

        if($haveSession){

      ?>
        <header>
          <a href="../index.php">
            <img
              src="../images/logo/AbstraktLogo.png"
              alt="Abstrakt Logo"
              width="200px"
              class="site-icon disabled-pointer"
              style="z-index: 1"
          /></a>
          
          <?php
            if($haveSession)
            {
          ?>

          <nav class="session-nav">
          <?php }else { ?>
            <nav>
          <?php
            }
          ?>
            <a href="../index.php">Home</a>
            <a href="../events.php">Events</a>

            <?php
              if($haveSession){
            ?>
            <a href="../admin.php">Management</a>
            <?php 
              }
            ?>
          </nav>
          <?php
            if($haveSession) 
            {
          ?>

          <a href="logout.php" class="sign">Logout</a>
          <?php
            }
            else {
          ?>
          <a href="../sign.php" class="sign">Login/Register</a>
          <?php
            }
          ?>
        </header>

        <div class="no-session">
          <img src="../images/icon/Success.png" />
          <h6>
            Successfully created new category.
            <a href="../admin.php" class="gradient-text"> Back to admin management.</a>
          </h6>
        </div>
      <?php
        }
        else{
      ?>

      <header>
        <a href="index.php">
          <img
            src="images/logo/AbstraktLogo.png"
            alt="Abstrakt Logo"
            width="200px"
            class="site-icon disabled-pointer"
            style="z-index: 1"
          />
        </a>
        <nav>
          <a href="index.php">Home</a>
          <a href="events.php">Events</a>
        </nav>
        <a href="sign.php" class="sign">Login/Register</a>
      </header>
      
      <div class="no-session">
        <img src="images/icon/Password.png">
        <h6>This area is admin-only. No session exist or session is expired. <a href='sign.php' class="gradient-text">Please log in again</a></h6>
      </div>
          
      <?php
      }
      ?>

    </div>
  </body>
</html>