<?php

  session_start();

  if(isset($_SESSION["userid"])){

    $connect = mysqli_connect("localhost", "root", "", "abstrakt") or die("Couldn't connect to server");
    
    $userid = $_SESSION["userID"];
    $categoryid = $_GET['category_id'];
  
    $insertCommand = "INSERT INTO webparticipant (userid, categoryid) VALUES ('$userid', 'categoryid'";
    $insertExecute = mysqli_query($connect, $insertCommand);

    if($insertExecute)
      header("Location:../events.php");
    else{
      echo "Error!";   
    }
  }
  else{

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styling/styleSetup.css" />
    <link rel="stylesheet" href="../styling/adminStyle.css" />
    <title>Register category processing...</title>
  </head>
  <body>
    <div class="global-container">
      
      <header>
        <a href="index.php">
          <img
            src="images/logo/AbstraktLogo.png"
            alt="Abstrakt Logo"
            width="200px"
            class="site-icon disabled-pointer"
            style="z-index: 1"
        /></a>
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
    </div>

<?php
  }
?>