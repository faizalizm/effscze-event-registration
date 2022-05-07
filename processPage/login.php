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
    <title>Update Process Page</title>
  </head>
  <body>
    <div class="global-container">

<?php

  $username= $_POST["username"];
  $password = $_POST["pwd"];

  $searchAdmin = "SELECT * FROM administrator WHERE admin_name = '$username'";
  $adminResult = mysqli_query($connect, $searchAdmin);

  $searchUser = "SELECT * FROM user WHERE username = '$username'";
  $userResult = mysqli_query($connect, $searchUser);

  if(mysqli_num_rows($adminResult) == 0 && mysqli_num_rows($userResult) == 0){
    $word = "Username does not exist.";
  }
  else{
    if(mysqli_num_rows($adminResult) != 0){
      $checkPass = mysqli_fetch_array($adminResult, MYSQLI_BOTH);
      if($checkPass["admin_pass"] == $password){
        session_start();
        $_SESSION["admin"] = $username;
        $_SESSION["adminid"] = $checkPass["admin_id"];
        $_SESSION["adminpriv"] = $checkPass["admin_priv"];
        header("Location:../admin.php");
      }
      else
        $word = "Wrong password entered.";
    }
    else if(mysqli_num_rows($userResult) != 0){
      $checkPass = mysqli_fetch_array($userResult, MYSQLI_BOTH);

      if($checkPass["pass"] == $password){
        session_start();
        $_SESSION["user"] = $username;
        $_SESSION["userid"] = $checkPass["userid"];
        header("Location:../user.php");
      }
      else
        $word = "Wrong password entered.";
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
          <img src="../images/icon/Password.png">
          <h6><?php echo $word ?><a href='../sign.php' class="gradient-text"> Please try again</a></h6>
        </div>

    </div>
  </body>
</html>
