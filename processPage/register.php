<?php
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
    <title>Register user processing...</title>
  </head>
  <body>
    <div class="global-container">

    <?php

      $username = $_POST["username"];
      $email = $_POST["email"];
      $pwd = $_POST["pwd"];
      $phone = $_POST["phone"];
      $age = $_POST["age"];

      $findCommand = "SELECT * FROM user WHERE username='$username'";
      $findExecute = mysqli_query($connect, $findCommand);

      $insertCommand = "INSERT INTO user (username, pass, email, phone, age) VALUES ('$username', '$pwd', '$email', '$phone', '$age')";

      $success = false;
      if(mysqli_num_rows($findExecute) > 0)
          header("Location:userExist.php");
      else{

          $insertExecute = mysqli_query($connect, $insertCommand);

          if($insertExecute){
              $word = "You have successfully registered as an ABSTRAKT member.";
              $success = true;
          }
          else{
              echo "Error!";
          }   
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
        />
      </a>
      <nav>
        <a href="index.php">Home</a>
        <a href="events.php">Events</a>
      </nav>
      <a href="../sign.php" class="sign">Login/Register</a>
    </header>
         <div class="no-session">
        <?php
          if($success)
            echo "<img src='../images/icon/Success.png' />";
          else
            echo "<img src='../images/icon/Password.png' />";

          if(isset($word)){
              echo "
              <h6>$word <a href='../sign.php' class='gradient-text'> Proceed to Log in now.</a></h6>";
          }
          else{
              echo "
              <h6>This area serves as a process page. <a href='../index.php' class='gradient-text'>Back to Home.</a></h6>";
          }
        ?>
      </div>

    </div>

  </body>
</html>
