<?php

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
    <link rel="stylesheet" href="../styling/adminStyle.css" />
    <title>Update data processing...</title>
  </head>
  <body>
    <div class="global-container">

      <?php
      if(isset($_GET["deleteAdmin_id"])){
      
        $delID = $_GET['deleteAdmin_id'];
        $deleteCommand = "DELETE FROM administrator WHERE admin_id='$delID'";
        $deleteExecute = mysqli_query($connect, $deleteCommand);
        mysqli_close($connect);
        header("Location:../adminViewAdmin.php#scroll-to-view");
      
      }
    
      if(isset($_GET['delete_id'])){
      
        $delID = $_GET['delete_id'];
        $deleteCommand = "DELETE FROM user WHERE userid='$delID'";
        $deleteExecute = mysqli_query($connect, $deleteCommand);
        if($deleteExecute)
          $word = "Successfully Deleted User.";
        else
          $word = "Participant is registered to a category.";
        mysqli_close($connect);
        // header("Location:../adminViewUser.php#scroll-to-view");
      
      }
      else{
      
          echo "Error Deleting Record<br/>";
          echo "<a href='../adminViewUser.php#scroll-to-view'>Try Again Here</a>";
      
      }

    ?>

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
        <?php
          if($adminSession || $userSession) 
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
        <a href="../sign.php" class="sign">Login/Register</a>
        <?php
          }
        ?>
      </header>

      <div class="no-session">
        <?php 
          if($deleteExecute){
            echo "
              <img src='../images/icon/Success.png' />
              <h6>" . $word . "
              <a href='../admin.php#scroll-to-view' class='gradient-text'>Return to admin management</a></h6>";
          }
          else if(!$deleteExecute){
            echo "
              <img src='../images/icon/Password.png' />
              <h6>" . $word . "
              <a href='../userEdit.php?edit_id=$delID' class='gradient-text'>Please click here to remove all registered category before deleting</a></h6>";
          }
        ?>
      </div>
      
    </div>
  </body>
</html>

      