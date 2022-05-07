<?php

  session_start();
  $connect = mysqli_connect("localhost", "root", "", "abstrakt") or die("Couldn't connect to server");

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
        if(isset($_SESSION["admin"]) || isset($_SESSION["user"])){

          $adminUpdateUser = false;
          $adminUpdateAdmin = false;

          if(isset($_POST["userid"])){
          
            $userid = $_POST["userid"];
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["pwd"];
            $phone = $_POST["phone"];
            $age = $_POST["age"];

            $updateCommand = "UPDATE user SET username = '$username', email= '$email', pass = '$password', phone = '$phone', age = '$age' WHERE userid='$userid'";

            if($_SESSION["admin"])
              $adminUpdateUser = true;
            else
              $userUpdateUser = true;
          }
          else if(isset($_POST["adminid"])){

            $adminid = $_POST["adminid"];
            $adminname = $_POST["adminname"];
            $adminemail = $_POST["adminemail"];
            $adminpwd = $_POST["adminpwd"];
          
            $updateCommand = "UPDATE administrator SET admin_name = '$adminname', admin_email = '$adminemail', admin_pass = '$adminpwd' WHERE admin_id='$adminid'";
          
            $adminUpdateAdmin = true;

          }

          $updateExecute = mysqli_query($connect, $updateCommand);
        
          if($updateExecute){

            mysqli_close($connect);
            if($adminUpdateAdmin || $adminUpdateUser){
              if($adminUpdateAdmin)
                header("Location:../adminEdit.php?edit_id=$adminid#scroll");
              else if($adminUpdateUser)
                header("Location:../userEdit.php?edit_id=$userid#scroll");

            }
            else
              header("Location:../user.php#scroll");
          }
          else{
            $word = "Error Updating Record";
            echo "<a href='../admin.php'>Try Again</a>";
          }
        } 
        else{

      ?>

      <header>
        <a href="index.php">
          <img
            src="../images/logo/AbstraktLogo.png"
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
        <a href="../sign.php" class="sign">Login/Register</a>
      </header>

      <div class="no-session">
        <img src="../images/icon/Password.png">
        <?php
          if(isset($word)){
            echo "
            <h6>$word. <a href='index.php' class='gradient-text'>Back to Home</a></h6>";
          }
          else{
            echo"
            <h6>This area serves as a process page. <a href='index.php' class='gradient-text'>Back to Home</a></h6>";
          }
        ?>
      </div>
          
      <?php
      }
      ?>
    </div>

  </body>
</html>
