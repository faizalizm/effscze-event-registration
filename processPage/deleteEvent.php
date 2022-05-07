<?php
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "abstrakt") or die("Couldn't connect to server");
  
    //error checking for availability of user or admin session 
    if(isset($_SESSION["admin"])){
      $adminSession = true;
    }
    else{
      $adminSession = false;
    }
  
    if(isset($_SESSION["user"])){
      $userSession = true;
    }
    else{
      $userSession = false;
    }
  ?>
  
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="stylesheet" href="../styling/styleSetup.css" />
      <link rel="stylesheet" href="../styling/indexStyle.css" />
      <title>Abstrakt - Home</title>
    </head>
    <body>
      <div class="global-container">
        <?php
            if($adminSession || $userSession) 
            {
          ?>
        <!--Navigation Bar-->
        <header>
          <a href="index.php">
            <img
              src="../images/logo/AbstraktLogo.png"
              alt="Abstrakt Logo"
              width="200px"
              class="site-icon disabled-pointer"
              style="z-index: 1"
          /></a>
          
          <!--if user or admin session is available, use class "session-nav" for <nav> tag-->
          
          
          <nav class="session-nav">
          <?php }else { ?>
            <nav>
          <?php
            }
          ?>
            <a href="../index.php">Home</a>
            <a href="../events.php">Events</a>
            
            <!-- if admin session available, display management tab, if user session available, display profile tab-->
            <?php
              if($adminSession){
            ?>
            <a href="../admin.php">Management</a>
            <?php } ?>
            <?php
              if($userSession){
            ?>
            <a href="../user.php">Profile</a>
            <?php } ?>
          </nav>
  
          <!--if user or admin session is available, display logout button, if not, display login/register buttton-->
          <?php
            if($adminSession || $userSession) 
            {
          ?>
          
          <a href="processPage/logout.php" class="sign">Logout</a>
          <?php
            }
            else {  
          ?>
          <a href="sign.php" class="sign">Login/Register</a>
          <?php
            }
          ?>
        </header>

        <?php

          if($adminSession || $userSession) 
          {

            $delID = $_GET['delete_id'];
            $userID = $_GET['userid'];

            $deleteCommand = "DELETE FROM webparticipant WHERE webparticipantid='$delID'";
            if(isset($delID)){
              $deleteExecute = mysqli_query($connect, $deleteCommand);
              mysqli_close($connect);
              if($_SESSION["admin"])
                header("Location:../userEdit.php?edit_id=$userID#scroll");
              else
                header("Location:../user.php?edit_id=$userID#scroll");
            }
            else{
                echo "Error Deleting Record<br/>";
                echo "<a href='../userEdit.php?edit_id=$userID#scroll'>Try Again Here</a>";
            }

          } 
          else{
          ?>
          
            <div class="no-session">
              <img src="../images/icon/Password.png">
              <h6>This area is admin and user only. No session exist or session is expired. <a href='../sign.php' class="gradient-text">Please log in again</a></h6>
            </div>
          
          <?php
          }
          ?>

    </div>
  </body>
</html>
